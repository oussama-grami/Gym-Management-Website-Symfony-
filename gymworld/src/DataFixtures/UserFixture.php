<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
       /* $admin1 = new User();
        $admin1->setUsername('admin');
        $admin1->setPassword(password_hash('admin', PASSWORD_DEFAULT));
        $admin1->setRoles(["ROLE_ADMIN"]);
        $admin1->setEmail('admin@admin.com');
        $admin1->setName("oussama");
        $manager->persist($admin1);
        $manager->flush();
        $this->addReference('admin1', $admin1);*/
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
