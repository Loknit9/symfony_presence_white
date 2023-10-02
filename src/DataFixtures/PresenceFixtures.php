<?php

namespace App\DataFixtures;

use App\Entity\Presence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class PresenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $type = array('yes', 'no');
        $complement = array('present', 'absent', 'prevenu', 'malade', 'renfort');

        for ($i = 0; $i<40; $i++){
            $presence = new Presence([
                'type' => array_rand($type),
                'complement' => array_rand($complement)
            ]);
        
        $manager->persist($presence);

    }
    $manager->flush();
}
}
