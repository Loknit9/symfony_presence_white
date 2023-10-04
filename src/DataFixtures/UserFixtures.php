<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//Faker
use Faker;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        
        //creation des users sans role
        for($i=0; $i <5; $i++){
            $user = new User();
            $user->setEmail ("user".$i."@gmail.com");
            $user->setPassword($this->passwordHasher->hashPassword($user,'paswword'.$i ));
            $user->setNom ($faker->lastName);
            $user->setPrenom ($faker->firstName);
            $user->setRoles(['ROLE_USER']);
            $user->setDateNaissance ($faker->dateTime());
            $user->setContact1 ($faker->email);
            $user->setContact2 ($faker->email);
            
            $manager->persist($user);

        }

        //creation des users ROLE_ADMIN
        for($i=0; $i <4; $i++){
            $user = new User();
            $user->setEmail ("usera".$i."@gmail.com");
            $user->setPassword($this->passwordHasher->hashPassword($user,'paswword'.$i ));
            $user->setNom ($faker->lastName);
            $user->setPrenom ($faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setDateNaissance ($faker->dateTime());
            $user->setContact1 ($faker->email);
            $user->setContact2 ($faker->email);
            
            $manager->persist($user);
        }

        //creation des users ROLE_COACH
        for($i=0; $i <3; $i++){
            $user = new User();
            $user->setEmail ("userc".$i."@gmail.com");
            $user->setPassword($this->passwordHasher->hashPassword($user,'paswword'.$i ));
            $user->setNom ($faker->lastName);
            $user->setPrenom ($faker->firstName);
            $user->setRoles(['ROLE_COACH']);
            $user->setDateNaissance ($faker->dateTime());
            $user->setContact1 ($faker->email);
            $user->setContact2 ($faker->email);
            
            $manager->persist($user);
        }

        $manager->flush();

    }
}
