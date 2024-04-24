<?php

namespace App\DataFixtures;

use App\Entity\OffreClient;
use App\Entity\Offres;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OffreClientFixture extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $manager->getReference(User::class, 1);
        $offre = $manager->getReference(offres::class, 1);
        $dateDebut = DateTime::createFromFormat('Y-m-d', '2024-04-27');
        $dateFin = DateTime::createFromFormat('Y-m-d', '2024-05-27');
        $oc = new OffreClient();
        $oc->setClient($user);
        $oc->setOffre($offre);
        $oc->setDateDebut($dateDebut);
        $oc->setDateFin($dateFin);
        $manager->persist($oc);
        $manager->flush();
    }

    public static function getGroups(): array
    {
       return ['offreClient'];
    }
}
