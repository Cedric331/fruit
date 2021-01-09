<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $aliment = new Aliment();
        $aliment->setNom('Carotte')
                  ->setCalorie(36)
                  ->setPrix(1.15)
                  ->setImage('/image/aliments/carotte.png')
                  ->setCalorie(25)
                  ->setGlucide(4)
                  ->setProteine(10)
                  ->setLipide(0);
        $manager->persist($aliment);

        $aliment2 = new Aliment();
        $aliment2->setNom('Patate')
                  ->setCalorie(48)
                  ->setPrix(1.99)
                  ->setImage('/image/aliments/patate.png')
                  ->setCalorie(45)
                  ->setGlucide(36)
                  ->setProteine(25)
                  ->setLipide(25);
        $manager->persist($aliment2);

        $aliment3 = new Aliment();
        $aliment3->setNom('Pomme')
                  ->setCalorie(12)
                  ->setPrix(0.65)
                  ->setImage('/image/aliments/pomme.png')
                  ->setCalorie(15)
                  ->setGlucide(14)
                  ->setLipide(8)
                  ->setProteine(2);
        $manager->persist($aliment3);


        $manager->flush();
    }
}
