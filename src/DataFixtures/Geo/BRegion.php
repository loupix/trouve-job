<?php

namespace App\DataFixtures\Geo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use League\Csv\Reader;
use League\Csv\SyntaxError;
use App\Entity\Geo\Pays;
use App\Entity\Geo\Regions;

class BRegion extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $pays = $manager->getRepository(Pays::class);

        $reader = Reader::createFromPath(__DIR__.'\..\..\..\var\regions-france.csv', 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        $p = $pays->findOneBy(['alpha3'=>'FRA']);
        foreach ($records as $key => $value) {
            $r = new Regions();
            $r->setPays($p);
            $r->setCode($value['code_region']);
            $r->setNom($value['nom_region']);
            $manager->persist($r);
        }
        $manager->flush();
    }
}
