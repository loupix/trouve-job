<?php

namespace App\DataFixtures\Jobs;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Jobs\Technologies as Technologie;

class Technologies extends Fixture
{

    private function save(ObjectManager $manager, array $childs, Technologie $parent): void{
        foreach ($childs as $child) {
            $p = new Technologie();
            $p->setNom($child['nom']);
            $p->setDescription($child['description']);
            if(!is_null($child['icone']))
                $p->setIcone($child['icone']);
            $p->setParent($parent);
            $manager->persist($p);

            if(!is_null($child['childs']))
                $this->save($manager, $child['childs'], $p);
        }
    }

    public function load(ObjectManager $manager): void
    {
        $vals = array(
            array("nom"=>"PHP", "description"=>null, "icone"=>null, "childs"=>array(
                array("nom"=>"Framework", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Symfony", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Laravel", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Cake", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Zend", "description"=>null, "icone"=>null, "childs"=>null),
                )),
                array("nom"=>"CMS", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Wordpress", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Drupal", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Prestashop", "description"=>null, "icone"=>null, "childs"=>null)
                ))
            )),

            array("nom"=>"Javascript", "description"=>null, "icone"=>null, "childs"=>array(
                array("nom"=>"JQuery", "description"=>null, "icone"=>null, "childs"=>null),
                array("nom"=>"Framework", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"NodeJs", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"MeteorJs", "description"=>null, "icone"=>null, "childs"=>null)
                )),
                array("nom"=>"TypeScript", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Angular", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"React", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Vue", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Ionic", "description"=>null, "icone"=>null, "childs"=>null)
                ))
            )),

            array("nom"=>"Java", "description"=>null, "icone"=>null, "childs"=>array(
                array("nom"=>"J2EE", "description"=>null, "icone"=>null, "childs"=>null),
                array("nom"=>"Library", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Apache", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Android", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Guava", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"JUnit", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Scala", "description"=>null, "icone"=>null, "childs"=>null)
                )),
                array("nom"=>"Framework", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Spring", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Hadoop", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Hibernate", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Struts", "description"=>null, "icone"=>null, "childs"=>null)
                ))
            )),

            array("nom"=>"Python", "description"=>null, "icone"=>null, "childs"=>array(
                array("nom"=>"Library", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Pandas", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Scikit Learn", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"OpenCV", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"TensorFlow", "description"=>null, "icone"=>null, "childs"=>null),
                )),
                array("nom"=>"Framework", "description"=>null, "icone"=>null, "childs"=>array(
                    array("nom"=>"Django", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Pyramid", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Flask", "description"=>null, "icone"=>null, "childs"=>null),
                    array("nom"=>"Bottle", "description"=>null, "icone"=>null, "childs"=>null)
                )),
            ))

        );
        
        foreach ($vals as $child) {
            $p = new Technologie();
            $p->setNom($child['nom']);
            $p->setDescription($child['description']);
            if(!is_null($child['icone']))
                $p->setIcone($child['icone']);
            $manager->persist($p);

            if(!is_null($child['childs']))
                $this->save($manager, $child['childs'], $p);
        }

        $manager->flush();
    }
}
