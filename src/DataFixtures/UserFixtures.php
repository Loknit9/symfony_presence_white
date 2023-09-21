<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {

        for($i=0; $i <20; $i++){
            $user = new User();
            $user->setEmail ("user".$i."@gmail.com");
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'paswword'.$i
            ));
            $user->setNom ("nom".$i);
            $user->setPrenom ("prenom".$i);
            $user->setDateNaissance (new DateTime("4-4-23"));
            $user->setContact1 ("contact1".$i."@gmail.com");
            $user->setContact2 ("contact2".$i."@gmail.com");
            
            $manager->persist($user);

        }

        $manager->flush();
    }
}
