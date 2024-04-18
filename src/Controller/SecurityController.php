<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Security\EmailVerifier;
use App\Entity\User\Visitor;
use App\Entity\User\Registered;
use App\Entity\Visitor\Location;
use App\Entity\Visitor\Information;
use App\Form\RegisterFormType;
use App\Form\VisitorFormType;

class SecurityController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }


    /**
     * @Route("/loading", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();


        $em = $this->getDoctrine()->getManager();

        if($request->getSession()->has("user_id") && !is_null($request->getSession()->get("user_id"))){
            $user = $this->getDoctrine()->getRepository(Registered::class)->find($request->getSession()->get("user_id"));
            if(!$user){
                return $this->redirectToRoute("logout");
            }
            $user->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($user);
            $em->flush();
        }
        else if($request->getSession()->has("visitor_id") && !is_null($request->getSession()->get("visitor_id"))){
            $visitor = $this->getDoctrine()->getRepository(Visitor::class)->find($request->getSession()->get("visitor_id"));
            if(!$visitor){
                return $this->redirectToRoute("logout");
            }
            $visitor->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($visitor);
            $em->flush();
        }
        else{
            $visitor = new Visitor();
            $visitor->setSessionId($request->getSession()->getId());

            // encode the plain password
            $visitor->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $visitor,
                    $visitor->getPasswordClear()
                )
            );

            $location = new Location();
            $location->setPostalCode(0);
            $visitor->setLocation($location);

            $information = new Information();
            $information->setIp(0);
            $visitor->setInformation($information);

            $request->getSession()->save();
            $em->persist($visitor);
            $em->flush();

            $request->getSession()->set("visitor_id", $visitor->getId());
            $request->getSession()->save();
        }




        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        if($visitor){
            $lastUsername = is_null($lastUsername) || !$lastUsername ? $visitor->getUuid() : $lastUsername;
            $lastPassword = $visitor->getPasswordClear();
        }else if($user){
            $lastUsername = is_null($lastUsername) || !$lastUsername ? $user->getUuid() : $lastUsername;
            $lastPassword = null;
        }



        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'last_password' => $lastPassword,
            'error' => $error,
        ));
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request): Response
    {
        $request->getSession()->clear();
        $request->getSession()->save();
        return $this->render('security/logout.html.twig');
    }


    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new Registered();

        $visitor = $this->getDoctrine()->getRepository(Visitor::class)->find($request->getSession()->get("visitor_id"));
        $user->setInformation($visitor->getInformation());
        $user->setLocation($visitor->getLocation());

        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            
            // encode the plain password
            $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $request->getSession()->set("user_id", $user->getId());
            $request->getSession()->save();

            // generate a signed url and email it to the user
/*            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('loic5488@gmail.com', 'loic'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );*/

            $lastUsername = $user->getEmail();
            $lastPassword = $form->get('plainPassword')->getData();

            return $this->render('security/login.html.twig', array(
                'last_username' => $lastUsername,
                'last_password' => $lastPassword,
                'error' => NULL,
            ));
        }

        return $this->render('security/register.html.twig', [
            'registrationForm'=>$form->createView()
        ]);
    }


    /**
     * @Route("/verify/email", name="verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
