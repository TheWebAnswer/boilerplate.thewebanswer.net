<?php

namespace App\DataFixtures;

use App\Entity\Feature;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $features = [];
        for ($i = 0; $i < 50; $i++) {
            $features[$i] = new Feature();
            $features[$i]->setTitle($faker->sentence(2));
            $features[$i]->setDescription($faker->paragraph(3));
            $features[$i]->setLink($faker->url());
            $features[$i]->setIsDone($faker->boolean(75));

            $manager->persist($features[$i]);
        }

        $users = [];
        for ($i = 0; $i < 20; $i++) {
            $users[$i] = new User();
            $users[$i]->setFirstName($faker->firstName());
            $users[$i]->setLastName($faker->lastName());
            $users[$i]->setEmail($faker->email());
            $password = $this->hasher->hashPassword($users[$i], 'password');
            $users[$i]->setPassword($password);
            $users[$i]->setIsVerified($faker->boolean(80));

            $manager->persist($users[$i]);
        }

        $manager->flush();
    }
}
