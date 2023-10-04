<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;

use App\Entity\Evenement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $type = array('match', 'entrainement', 'physique', 'gardien');

        for ($i = 0; $i<40; $i++){
            $evenement = new Evenement([
                'dateEvenement' => $faker->dateTimeBetween('-2 month', '+8 month'),
                'typeEvenement' => array_rand($type)
            ]);
            
            $manager->persist($evenement);
        }
        $manager->flush();

    }
}
