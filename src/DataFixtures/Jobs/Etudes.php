<?php

namespace App\DataFixtures\Jobs;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Jobs\Etudes as Etude;

class Etudes extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vals = array(
            array("nom"=>"CAP", "value"=>"Certificat"),
            array("nom"=>"BEP", "value"=>"Brevet"),
            array("nom"=>"BAC", "value"=>"Baccalaureat"),
            array("nom"=>"BAC+2", "value"=>"DEA"),
            array("nom"=>"BAC+3", "value"=>"Licence"),
            array("nom"=>"BAC+5", "value"=>"Maitrise"),
            array("nom"=>"BAC+8", "value"=>"Doctorat")
        );

        foreach ($vals as $key => $value) {
            $e = new Etude();
            $e->setValue($value['value']);
            $e->setNom($value['nom']);
            $manager->persist($e);
        }

        $manager->flush();
    }
}
