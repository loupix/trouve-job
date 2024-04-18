<?php

namespace App\DataFixtures\Jobs;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Jobs\Secteurs as Secteur;

class ASecteurs extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $client = new \Goutte\Client();
        $crawler = $client->request('GET', 'https://www.cidj.com/metiers/metiers-par-secteur');
        $links = $crawler->evaluate('//div[@class="cat"]/a/h2')->each(function ($node) use($manager) {
            $s = new Secteur();
            $s->setNom($node->text());
            $manager->persist($s);
        });

        $manager->flush();
    }
}
