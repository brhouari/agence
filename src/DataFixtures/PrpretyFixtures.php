<?php

namespace App\DataFixtures;

use App\Entity\Prprety;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Migrations\Version\Factory;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PrpretyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 100; $i++) {
            $proprety = new Prprety();
            $proprety
                ->setTitle ($faker->words(3, true))
                ->setDescription ($faker->sentences(3, true))
                ->setSurface ($faker->numberBetween(20,350))
                ->setRooms ($faker->numberBetween(2,10))
                ->setBedrooms ($faker->numberBetween(1,9))
                ->setFloor ($faker->numberBetween(0,5))
                ->setPrice ($faker->numberBetween(60000,80000))
                ->setCity ($faker->city)
                ->setAdresse ($faker->streetAddress)
                ->setPostaleCode ($faker->postcode)
                ->setSold (false);
            $manager->persist ($proprety);

        }

        $manager->flush();
    }
}
