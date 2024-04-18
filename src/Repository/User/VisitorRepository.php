<?php

namespace App\Repository\User;

use App\Entity\User\Visitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visitor[]    findAll()
 * @method Visitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visitor::class);
    }

    public function setSession(Session $session)
    {
        $this->session = $session;
        return $this;
    }

    public function getSession(): ? Session
    {
        return $this->session;
    }

    /**
     * @return Visitor
     */

    public function create(): ?Visitor
    {
        $v = new Visitor();
        $v->setSessionId($this->session->getId());
        $em = $this->getEntityManager();
        $em->persist($v);
        $em->flush();
        return $v;
    }



    /**
     * @return Visitor
     */

    public function getOrCreate(): ?Visitor
    {
        if($this->session->has("visitor_id"))
            $v = $this->find($this->session->get("visitor_id"));
        else{
            $v = $this->findOneBy(Array('sessionId'=>$this->session->getId()));
            if(is_null($v)){
                $v = $this->create();
                $this->session->set("visitor_id", $v->getId());
                $this->session->save();
                return $v;
            }
        }
        $v->setUpdatedAt(new \DateTimeImmutable);
        $em = $this->getEntityManager();
        $em->persist($v);
        $em->flush();
        return $v;
        
    }
}
