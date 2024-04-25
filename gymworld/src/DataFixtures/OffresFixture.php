<?php

namespace App\DataFixtures;

use App\Entity\Offres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OffresFixture extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $offre = new Offres();
        $offre->setName('12 month ');
        $offre->setDuration(12);
        $offre->setPrice(59.5);
        $manager->persist($offre);
        $manager->flush();
        $this->addReference('offre1', $offre);
    }

    public static function getGroups(): array
    {
        return ['offre'];
    }
}
