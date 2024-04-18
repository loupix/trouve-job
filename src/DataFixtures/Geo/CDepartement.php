<?php

namespace App\DataFixtures\Geo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use League\Csv\Reader;
use League\Csv\SyntaxError;
use App\Entity\Geo\Regions;
use App\Entity\Geo\Departements;

class CDepartement extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $reg = $manager->getRepository(Regions::class);

        $reader = Reader::createFromPath(__DIR__.'\..\..\..\var\departements-france.csv', 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        foreach ($records as $key => $value) {
            $r = $reg->findOneBy(['code'=>$value['code_region']]);
            $d = new Departements();
            $d->setRegion($r);
            $d->setNom($value['nom_departement']);
            $d->setCode($value['code_departement']);
            $manager->persist($d);
        }

        $manager->flush();
    }
}
