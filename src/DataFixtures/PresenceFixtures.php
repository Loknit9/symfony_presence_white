<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Presence;
use App\Entity\Evenement;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\EvenementFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class PresenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $etat = array('yes', 'no');
        $complement = array('present', 'absent', 'excusé', 'malade', 'renfort');

        // obtenir un User au hasard
        $repUser = $manager->getRepository(User::class);
        $arrayUsers = $repUser->findAll();

        // obtenir un Evenement au hasard
        $repEvenement = $manager->getRepository(Evenement::class);
        $arrayEvenements = $repEvenement->findAll();



        for ($i = 0; $i < 40; $i++) {
            $presence = new Presence([
                'etat' => $etat[mt_rand(0, count($etat) - 1)],
                'complement' => $complement[mt_rand(0, count($complement) - 1)],
            ]);

            $randomUser = $arrayUsers[array_rand($arrayUsers)];
            $presence->setUser($randomUser);
            $randomEvenement = $arrayEvenements[array_rand($arrayEvenements)];
            $presence->setEvenement($randomEvenement);
            

            $manager->persist($presence);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return ([
            UserFixtures::class,
            EvenementFixtures::class,
        ]);
    }
}
