<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;

use App\Entity\Equipe;
use Doctrine\Persistence\ObjectManager;

use App\DataFixtures\PersonneUserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        $categorieAge = array(5, 6, 7, 8, 9, 10, 11, 12, 14, 16, 19);
        $nom = array(1, 2, 3, 4, 5, 6);

        for ($i = 0; $i < 11; $i++) {
            $equipe = new Equipe([
                'nom' => $nom[mt_rand(0, count($nom) - 1)],
                'categorieAge' => $categorieAge[mt_rand(0, count($categorieAge) - 1)],

                'categorieGenre' => $faker->randomElement(['G', 'B']),
            ]);

            $manager->persist($equipe);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return ([
            PersonneUserFixtures::class,
        ]);
    }
}
