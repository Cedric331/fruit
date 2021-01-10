<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Aliment;
use App\Repository\AlimentRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $type = new Type();
        $type->setLibelle('Fruits')
             ->setImage('fruits.jpg');

        $manager->persist($type);

         $type1 = new Type();
         $type1->setLibelle('Legumes')
              ->setImage('legumes.jpg');

        $manager->persist($type1);

        $alimentRepository = $manager->getRepository(Aliment::class);

        $a1 = $alimentRepository->findOneBy(["nom" => "Patate"]);
        $a1->setType($type1);
        $manager->persist($a1);

        $a2 = $alimentRepository->findOneBy(["nom" => "Carotte"]);
        $a2->setType($type1);
        $manager->persist($a2);

        $a3 = $alimentRepository->findOneBy(["nom" => "Tomate"]);
        $a3->setType($type);
        $manager->persist($a3);

        $manager->flush();
    }
}
