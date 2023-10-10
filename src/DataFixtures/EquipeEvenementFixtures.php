<?php

namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Evenement;
use App\DataFixtures\EquipeFixtures;
use App\DataFixtures\EvenementFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EquipeEvenementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // obtenir toutes les equipes
        $repEquipes = $manager->getRepository(Equipe::class);
        $arrayObjetEquipes = $repEquipes->findAll();

        //obtenir tous les evenements
        $repEvenements = $manager->getRepository(Evenement::class);
        $arrayEvenements = $repEvenements->findAll();

        //parcourir les equipes et leur attribuer un evt
        foreach ($arrayObjetEquipes as $equipe) {
            $nombreEvenements = rand(6, 8);

            for ($i = 0; $i < $nombreEvenements; $i++) {
                $randomIndex = array_rand($arrayEvenements);
                $equipe->addEvenement($arrayEvenements[$randomIndex]);
            }
            $manager->persist($equipe);
        }
        $manager->flush();
    }

    //fixer les dépendances de cette fixture
    public function getDependencies()
    {
        return ([
            EvenementFixtures::class,
            EquipeFixtures::class,
        ]);
    }
}
