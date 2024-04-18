<?php

namespace App\DataFixtures\Jobs;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Jobs\Metiers as Metier;
use App\Entity\Jobs\Secteurs;
use App\Entity\Jobs\Interets;

class BMetiers extends Fixture
{

    private $apiId = "PAR_informatiquelorraine_f9cc69d86afafa52e023b5ecf821bbda558c3a29c7c2ced5f9bd9727d33e8ba0";
    private $apiKey = "ce7a184a7d71317f53ae338165594e4338946ab9a45f5787a3dd4772c3255b02";
    private $accessToken = null;

    private $listMetiers = array();

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
            if($http_code != intval(200))
                throw new \Exception("Ressource introuvable : ".$http_code);

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

    private function getCodeRome(String $libelle, int $essais=0): String
    {
        $ch = curl_init();

        if(isset($this->listMetiers[$libelle]))
            return $this->listMetiers[$libelle];

        try{
            curl_setopt($ch, CURLOPT_URL, "https://api.emploi-store.fr/partenaire/rome/v1/appellation?qf=libelle&q=".urlencode($libelle));
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_VERBOSE,false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer ".$this->accessToken
            ));

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo curl_error($ch);
                throw new \Exception(curl_error($ch));
                die();
            }

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($http_code == intval(429) && $essais<5){
                sleep(1);
                return $this->getCodeRome($libelle, $essais+1);
            }

            if($http_code != intval(200))
                throw new \Exception("Ressource introuvable : ".$http_code);

            $response = json_decode($response,true);
            if(isset($response['error']))
                throw new \Exception("Error ".$response['error']."\r\n ".$response['error_description']);
            if(!is_null($response) && count($response)>0){

                foreach($response as $rep){
                    if(!isset($this->listMetiers[$rep['libelle']]))
                        $this->listMetiers[$rep['libelle']] = $rep['code'];
                }


                return $response[0]['code'];
            }else
                throw new \Exception("Aucunes Ressources");

        } catch (\Throwable $th) {
            throw $th;
        } finally {
            curl_close($ch);
        }

    }


    private function saveNewMetier($client, $manager, $page){
        $title = $page->evaluate('//h1[@itemprop="headline"]/span')->first()->text();
        $secteur = $page->evaluate('//li[@itemprop="about"]')->first()->text();
        $summary = $page->evaluate('//div[@itemprop="description"]')->first()->text();
        $description = $page->evaluate('//div[@itemprop="articleBody"]')->first()->text();

        $synonymes = array();
        if($page->evaluate('//div[@class="field-synonyme"]/p')->count()>0){
            $synonymes = $page->evaluate('//div[@class="field-synonyme"]/p')->first()->text();
            $synonymes = str_replace("Synonymes : ", "", $synonymes);
            $synonymes = explode(", ", $synonymes);
        }

        $sec = $manager->getRepository(Secteurs::class);
        $met = $manager->getRepository(Metier::class);

        $s = $sec->findOneBy(Array("nom"=>$secteur));
        $m = $met->findOneBy(Array("nom"=>$title));
        if(!$m || is_null($m)){
            $m = new Metier();
            $m->setNom($title);
            $m->setSummary($summary);
            $m->setDescription($description);
            $m->setSecteur($s);

            try{
                $code = $this->getCodeRome($title);
                $m->setCodeRome($code);
            }catch(\Exception $e){
                echo $secteur." : ".$title." : ".$e->getMessage()."\r\n";
            }

            $manager->persist($m);
        }

        foreach ($synonymes as $name) {
            $ms = $met->findOneBy(Array("nom"=>$name));
            if(!$ms || is_null($ms)){
                $ms = new Metier();
                $ms->setNom($name);
                $ms->setSummary($summary);
                $ms->setDescription($description);
                $ms->setSecteur($s);
                try{
                    $code = $this->getCodeRome($name);
                    $ms->setCodeRome($code);
                }catch(\Exception $e){
                    echo $secteur." : ".$name." : ".$e->getMessage()."\r\n";
                }
            }
            $ms->setParentSynonyme($m);
            $manager->persist($ms);
        }

        return $m;
    }

    public function load(ObjectManager $manager): void
    {

        try{
            $this->accessToken = $this->getAccessToken();
            $this->getCodeRome("");
        }catch(Exception $e){
            die($e->getMessage());
        }

        $elt = $this;

        $client = new \Goutte\Client();
        $crawler = $client->request('GET', 'https://www.cidj.com/metiers/metiers-par-secteur');
        $crawler->evaluate('//div[@class="cat"]/a')->each(function ($node) use($elt, $manager, $client) {

            $pages = $client->request('GET', 'https://www.cidj.com'.$node->attr("href"));
            $pages->evaluate('//ul[@class="pager__items js-pager__items"]/li[@class="pager__item"]/a')->each(function ($link) use($elt, $manager, $client, $node) {

                $list = $client->request('GET', 'https://www.cidj.com'.$node->attr("href").$link->attr("href"));
                $list->evaluate('//div[@class="infos-content-list"]/h2/a')->each(function($info) use($elt, $manager, $client){

                    $page = $client->request('GET', 'https://www.cidj.com'.$info->attr("href"));

                    try{
                        $me = $elt->saveNewMetier($client, $manager, $page);
                    }catch(Exception $e){
                        print($e->getMessage());
                    }
                    

/*                    //Same As
                    echo "SameAs \r\n";

                    if($page->evaluate('//ul[@class="orange-tags"][1]/li/a[@itemprop="sameAs"]')->count()>0){
                        $page->evaluate('//ul[@class="orange-tags"][1]/li/a[@itemprop="sameAs"]')->each(function($same) use($elt, $manager, $client, $me){
                            try{
                                $page = $client->request('GET', 'https://www.cidj.com'.$same->attr("href"));
                                $mt = $elt->saveNewMetier($client, $manager, $page);
                                $me->addSameAs($mt);
                                $manager->persist($me);
                            }catch(Exception $e){
                                print($e->getMessage());
                            }
                        });
                    }


                    // Interets
                    echo "Interets \r\n";

                    if($page->evaluate('//ul[@class="orange-tags"][2]/li/a[@itemprop="sameAs"]')->count()>0){
                        $page->evaluate('//ul[@class="orange-tags"][2]/li/a[@itemprop="sameAs"]')->each(function($interest) use($elt, $manager, $client, $me){

                            $int = $manager->getRepository(Interets::class);

                            try{
                                $name = $interest->text();
                                $i = $int->findOneBy(array("nom"=>$name));
                                if(!$i || is_null($i)){
                                    $i = new Interets();
                                    $i->setNom($name);
                                }
                                $i->addMetier($me);
                                $manager->persist($i);
                            }catch(Exception $e){
                                print($e->getMessage());
                            }
                        });
                    }*/


                });
            });
            $manager->flush();
        });

        $manager->flush();
    }
}
