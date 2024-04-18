<?php

namespace App\DataFixtures\Geo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use League\Csv\Reader;
use League\Csv\SyntaxError;
use App\Entity\Geo\Regions;
use App\Entity\Geo\Departements;
use App\Entity\Geo\Cantons;
use App\Entity\Geo\Villes;

ini_set('memory_limit','-1');

class DVilles extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dep = $manager->getRepository(Departements::class);
        $can = $manager->getRepository(Cantons::class);
        $vil = $manager->getRepository(Villes::class);

        $depts = [];
        $cants = [];

        $reader = Reader::createFromPath(__DIR__.'\..\..\..\var\villes_france.csv', 'r');
        $records = $reader->getRecords();
        foreach ($records as $key => $value) {
            $id = $value[0];
            $nDept = intval($value[1]);
            $slug = $value[2];
            $nom = $value[3];
            $nomSimple = $value[4];
            $nomReel = $value[5];
            $soundex = $value[6];
            $metaphone = $value[7];
            $codePostal = $value[8];
            $numCommune = $value[9];
            $codeCommune = $value[10];
            $arrondissement = $value[11];
            $canton = $value[12];
            $amdi = intval($value[13]);
            $pop2010 = intval($value[14]);
            $pop1999 = intval($value[15]);
            $pop2012 = intval($value[16]);
            $dens2010 = intval($value[17]);
            $surface = floatval($value[18]);
            $longDeg = floatval($value[19]);
            $latDeg = floatval($value[20]);
            $longGrd = floatval($value[21]);
            $latGrd = floatval($value[22]);
            $longDms = floatval($value[23]);
            $latDms = floatval($value[24]);
            $altMin = floatval($value[25]);
            $altMax = floatval($value[26]);

            if(!in_array($nDept, array_keys($depts))){
                $d = $dep->findOneBy(Array("code"=>$nDept));
                if(!$d)
                    continue;
                $depts[$nDept] = $d;
            }else{
                $d = $depts[$nDept];
            }

            if(!in_array($canton, array_keys($cants))){
                $c = $can->findOneBy(Array("code"=>$canton));
                if(!$c){
                    $c = new Cantons();
                    $c->setCode($canton);
                    $manager->persist($c);
                }
                $cants[$canton] = $c;
            }else{
                $c = $cants[$canton];
            }


            if(count(explode("-", $codePostal)) > 1){
                foreach (explode("-", $codePostal) as $key => $cp) {
                    $v = new Villes();
                    $v->setDepartement($d)->setSlug($slug)->setNom($nom)->setNomSimple($nomSimple)->setNomReel($nomReel)->setNomSoundex($soundex)->setNomMetaphone($metaphone)->setCodePostal($cp)->setCommune($numCommune)->setCodeCommune($codeCommune)->setArrondissement($arrondissement)->setCanton($c)->setAmdi($amdi)->setRegion($d->getRegion())->setPopulation2010($pop2010)->setPopulation1999($pop1999)->setPopulation2012($pop2012)->setDensite2010($dens2010)->setSurface($surface)->setLongitudeDeg($longDeg)->setLatitudeDeg($latDeg)->setLongitudeGrd($longGrd)->setLatitudeGrd($latGrd)->setLongitudeDms($longDms)->setLatitudeDms($latDms)->setZmin($altMin)->setZmax($altMax);
                    $manager->persist($v);
                }
            }else{
                $v = new Villes();
                $v->setDepartement($d)->setSlug($slug)->setNom($nom)->setNomSimple($nomSimple)->setNomReel($nomReel)->setNomSoundex($soundex)->setNomMetaphone($metaphone)->setCodePostal($codePostal)->setCommune($numCommune)->setCodeCommune($codeCommune)->setArrondissement($arrondissement)->setCanton($c)->setAmdi($amdi)->setRegion($d->getRegion())->setPopulation2010($pop2010)->setPopulation1999($pop1999)->setPopulation2012($pop2012)->setDensite2010($dens2010)->setSurface($surface)->setLongitudeDeg($longDeg)->setLatitudeDeg($latDeg)->setLongitudeGrd($longGrd)->setLatitudeGrd($latGrd)->setLongitudeDms($longDms)->setLatitudeDms($latDms)->setZmin($altMin)->setZmax($altMax);
                $manager->persist($v);
            }

            if($key % 20 == 0){
                $manager->flush();
                $manager->clear();
            }


        }
        $manager->flush();
    }
}
