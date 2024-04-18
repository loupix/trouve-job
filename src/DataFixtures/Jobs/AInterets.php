<?php

namespace App\DataFixtures\Jobs;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Jobs\Interets as Interet;

class AInterets extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = new \Goutte\Client();
        $crawler = $client->request('GET', 'https://www.cidj.com/metiers/metiers-par-centres-d-interets');
        $links = $crawler->evaluate('//div[@class="cat"]/a/h2')->each(function ($node) use($manager) {
            $s = new Interet();
            $s->setNom($node->text());
            $manager->persist($s);
        });

        $manager->flush();
    }
}
