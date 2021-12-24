<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Event;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use PhpParser\Node\Expr\Array_;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $articles = Array();
        for ($i = 0; $i < 5; $i++) {
            $articles[$i] = new Article();
            $articles[$i]->setTitle($faker->word);
            $articles[$i]->setContent($faker->sentence(30, true));
            $articles[$i]->setCreatedAt(new \DateTimeImmutable('now'));

            $manager->persist($articles[$i]);
        }

        $events = Array();
        for ($i = 0; $i < 5; $i++) {
            $events[$i] = new Event();
            $events[$i]->setTitle($faker->word);
            $events[$i]->setContent($faker->sentence(30, true));
            $events[$i]->setCreatedAt(new \DateTimeImmutable('now'));

            $manager->persist($events[$i]);
        }

        $project = Array();
        for ($i = 0; $i < 5; $i++) {
            $project[$i] = new Project();
            $project[$i]->setTitle($faker->word);
            $project[$i]->setContent($faker->sentence(40, true));
            $project[$i]->setCreatedAt(new \DateTimeImmutable('now'));

            $manager->persist($project[$i]);
        }

        $manager->flush();
    }
}
