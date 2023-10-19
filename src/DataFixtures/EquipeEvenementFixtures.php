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
        foreach ($arrayEvenements as $evenement) {

            $randomIndex = array_rand($arrayObjetEquipes);
            $evenement->setEquipe($arrayObjetEquipes[$randomIndex]);
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
