<?php

namespace App\DataFixtures\Jobs;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Jobs\Contrats as Contrat;

class Contrats extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vals = array(
            array("nom"=>"CDI", "value"=>"Contrat à durée indéterminée"),
            array("nom"=>"CDD", "value"=>"Contrat à durée indéterminée"),
            array("nom"=>"Interim", "value"=>"Contrat intérimaire"),
            array("nom"=>"Travail Tempo.", "value"=>"Contrat à travail temporaire"),
            array("nom"=>"Temps partiel", "value"=>"Contrat à temps partiel"),
            array("nom"=>"Apprentissage", "value"=>"Contrat d'apprentissage"),
            array("nom"=>"Contrat Pro.", "value"=>"Contrat de professionnalisation"),
            array("nom"=>"Insertion Pro.", "value"=>"Contrat unique d’insertion"),
        );

        foreach ($vals as $key => $value) {
            $c = new Contrat();
            $c->setValue($value['value']);
            $c->setNom($value['nom']);
            $manager->persist($c);
        }

        $manager->flush();
    }
}
