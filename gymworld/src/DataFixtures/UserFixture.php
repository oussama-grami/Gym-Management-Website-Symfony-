<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
        /*$admin1 = new User();
        $admin1->setUsername('admin');
        $admin1->setPassword(password_hash('admin', PASSWORD_DEFAULT));
        $admin1->setRoles(["ROLE_ADMIN"]);
        $admin1->setEmail('admin@admin.com');
        $admin1->setName("oussama");
        $manager->persist($admin1);
        $manager->flush();
        $this->addReference('admin1', $admin1);*/
        $faker = Factory::create();
        for ($i=0;$i<100;$i++)
        {
            $client = new User();
            $client->setUsername($faker->userName().$i);
            $client->setName($faker->name().$i);
            $client->setEmail($faker->email().$i);
            $client->setPhoneNumber($faker->phoneNumber().$i);
            $client->setPassword($this->hasher->hashPassword($client,$faker->password)
                .$i);
            $manager->persist($client);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
