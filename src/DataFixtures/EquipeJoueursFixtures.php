<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Equipe;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\EquipeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EquipeJoueursFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Obtenir tous les users et puis tous les joueurs
        $users = $manager
                ->getRepository(User::class)
                ->findAll();
        $joueurs = [];
        foreach ($users as $user){
            if (in_array("ROLE_USER", $user->getRoles(), true)){
                $joueurs[] = $user;
            }
        }
        // Obtenir toutes les equipes
        $repEquipes = $manager->getRepository(Equipe::class);
        $arrayObjEquipes = $repEquipes->findAll();


        // Parcourir tous les users qui ont le role user et leur attribuer une equipe (avec add)
        foreach ($joueurs as $joueur) {
            $randomIndex = array_rand($arrayObjEquipes);
            $user->addEquipesJoueur($arrayObjEquipes[$randomIndex]);
            $manager->persist($joueur);
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
