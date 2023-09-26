<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\Equipe;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EquipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <11; $i++){
            $equipe = new Equipe([
                'nom' => rand(1,6),
                'categorieAge' => 'U'.rand(5, 19),
                'categorieGenre' => $faker->randomElement(['G', 'B']),
            ]);
        }
        
        $manager->persist($equipe);

        $manager->flush();
    }
}
