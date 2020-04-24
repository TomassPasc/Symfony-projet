<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Animal();
        $a1->setNom("Chien")
        ->setDescription("un gentil toutout")
        ->setImage("chien.png")
        ->setPoids(10)
        ->setDangereux(false)
        ;
        $manager->persist($a1);

        $a2 = new Animal();
        $a2->setNom("Cochon")
        ->setDescription("groin groin")
        ->setImage("cochon.png")
        ->setPoids(30)
        ->setDangereux(false)
        ;
        $manager->persist($a2);

        $a3 = new Animal();
        $a3->setNom("Serpent")
        ->setDescription("un animal dangereux")
        ->setImage("serpent.png")
        ->setPoids(5)
        ->setDangereux(true)
        ;
        $manager->persist($a3);

        $a4 = new Animal();
        $a4->setNom("Crocodile")
        ->setDescription("un animal très dangereux")
        ->setImage("croco.png")
        ->setPoids(400)
        ->setDangereux(true)
        ;
        $manager->persist($a4);

        $a5 = new Animal();
        $a5->setNom("Requin")
        ->setDescription("un animal marin très danger")
        ->setImage("requin.png")
        ->setPoids(700)
        ->setDangereux(true)
        ;
        $manager->persist($a5);


        $manager->flush();
    }
}
