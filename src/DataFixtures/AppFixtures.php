<?php

namespace App\DataFixtures;

use App\Entity\Feature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $features = [];
        for ($i = 0; $i < 20; $i++) {
            $features[$i] = new Feature();
            $features[$i]->setTitle($faker->sentence(2));
            $features[$i]->setDescription($faker->paragraph(3));
            $features[$i]->setLink($faker->url());
            $features[$i]->setIsDone($faker->boolean(75));

            $manager->persist($features[$i]);
        }

        $manager->flush();
    }
}
