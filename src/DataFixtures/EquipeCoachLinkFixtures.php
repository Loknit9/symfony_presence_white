<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Equipe;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\EquipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EquipeCoachLinkFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // 1. Obtenir tous les coachs
        $users = $manager
            ->getRepository(User::class)
            ->findAll();
        $coaches = [];
        foreach ($users as $user) {
            if (in_array("ROLE_COACH", $user->getRoles(), true)) {
                $coaches[] = $user;
            }
        }

        // 2. Obtenir tous les Equipes
        $repEquipes = $manager->getRepository(Equipe::class);
        $arrayObjEquipes = $repEquipes->findAll();

        // 3. Parcourir tous les Users. Pour chaque User, rajouter (add) un Equipe aléatoire
        foreach ($coaches as $coach) {
            $randomIndex = array_rand ($arrayObjEquipes); // l'index d'un Equipe, random
            $user->addEquipesCoach($arrayObjEquipes[$randomIndex]);
            $manager->persist($coach);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            EquipeFixtures::class,

        ];
    }
}
