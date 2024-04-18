<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PoleEmploiCommand extends Command
{
    protected static $defaultName = 'app:pole-emploi';
    protected static $defaultDescription = 'Recupére les annonces de pole-emploi.io';

    private $apiId = "PAR_informatiquelorraine_f9cc69d86afafa52e023b5ecf821bbda558c3a29c7c2ced5f9bd9727d33e8ba0";
    private $apiKey = "ce7a184a7d71317f53ae338165594e4338946ab9a45f5787a3dd4772c3255b02";

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }


    private function getAccessToken(): String
    {
        $ch = curl_init();

        try{
            curl_setopt($ch, CURLOPT_URL, "https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=%2Fpartenaire");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_VERBOSE,false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


            $datas = array(
                "grant_type"=>"client_credentials",
                "client_id"=>$this->apiId,
                "client_secret"=>$this->apiKey,
                "scope"=>"application_".$this->apiId." api_offresdemploiv2 o2dsoffre api_romev1 nomenclatureRome"
            );
            $data = "";
            foreach ($datas as $key => $value) {
                $data.=$key."=".$value."&";
            }
            $data = substr($data, 0, -1);


            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "content-type: application/x-www-form-urlencoded"
            ));


            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw curl_error($ch);
                die();
            }

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($http_code == intval(200)){
                echo "Ressource valide \r\n";
            }else{
                echo "Ressource introuvable : ".$http_code."\r\n";
            }

            $response = json_decode($response,true);
            if(isset($response['error']))
                throw new \Exception("Error ".$response['error']."\r\n ".$response['error_description']);

            return $response['access_token'];

        } catch (\Throwable $th) {
            throw $th;
        } finally {
            curl_close($ch);
        }
    }


    private function post(String $url, String $access_token, Array $data = null): Array
    {
        $ch = curl_init();
        try{
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_VERBOSE,false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$access_token
            ));

            if(!is_null($data)){
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "content-type: application/x-www-form-urlencoded"
                ));
            }

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw curl_error($ch);
                die();
            }

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($http_code == intval(200)){
                echo "Ressource valide \r\n";
            }else{
                echo "Ressource introuvable : ".$http_code."\r\n";
            }

            $response = json_decode($response,true);
            if(isset($response['error']))
                throw new \Exception("Error ".$response['error']."\r\n ".$response['error_description']);

            return $response;

        } catch (\Throwable $th) {
            throw $th;
        } finally {
            curl_close($ch);
        }
    }


    private function getCodeRome(String $libellé): Array
    {
        return $this->post("https://api.emploi-store.fr/partenaire/rome/v1/appellation?qf=libelle&limit=1&q=".urlencode($libellé), $access_token);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
