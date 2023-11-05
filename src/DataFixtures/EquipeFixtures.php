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

        $numeroEquipe= array(1,2,3,4,5,6);
        $categorie = array('U5', 'U6', 'U7', 'U8', 'U9', 'U10', 'U11', 'U12', 'U14', 'U16', 'U19');

        for ($i = 0; $i < 4; $i++) {
            $equipe = new Equipe([
                'nom' => ($categorie[mt_rand(0, count($categorie) - 1)]).($faker->randomElement(['G', 'B'])).($numeroEquipe[mt_rand(0, count($numeroEquipe) - 1)]),
                'numeroEquipe' => $numeroEquipe[mt_rand(0, count($numeroEquipe) - 1)],

                'categorieGenre' => $faker->randomElement(['F', 'G']),
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
