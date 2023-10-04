<?php

namespace App\DataFixtures;

use App\Entity\Presence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class PresenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $etat = array('yes', 'no');
        $complement = array('present', 'absent', 'excusé', 'malade', 'renfort');

        for ($i = 0; $i < 40; $i++) {
            $presence = new Presence([
                'etat' => $etat[mt_rand(0, count($etat) - 1)],
                'complement' => $complement[mt_rand(0, count($complement) - 1)],
            ]);

            $manager->persist($presence);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return ([
            UserFixtures::class,
            EvenementFixtures::class,
            EquipeFixtures::class
        ]);
    }
}
