<?php

namespace App\DataFixtures\Geo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use League\Csv\Reader;
use League\Csv\SyntaxError;
use App\Entity\Geo\Pays;

class APays extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $reader = Reader::createFromPath(__DIR__.'\..\..\..\var\sql-pays.csv', 'r');

        foreach ($reader->getRecords() as $key => $value) {
            $p = new Pays();
            $p->setCode(intval($value[1]));
            $p->setAlpha2($value[2]);
            $p->setAlpha3($value[3]);
            $p->setNomEnGb($value[4]);
            $p->setNomFrFr($value[5]);
            $manager->persist($p);
        }
        $manager->flush();
    }
}
