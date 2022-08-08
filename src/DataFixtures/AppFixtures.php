<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\User;
use DateTimeImmutable;
use joshtronic\LoremIpsum;
use App\Entity\SocialEvent;
use App\Entity\Responsible;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lipsum = new LoremIpsum();
        $date = new DateTimeImmutable('2000-01-01');

        ////////////////////////////////////
        // Real Content for first website //
        ////////////////////////////////////

        // Users admin
        $user = new User();
        $user->setEmail('paulbdelagerie@gmail.com');
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPassword("$2y$10\$tON9gTYh9TY.QFiB2cA.4Ovmh6K5PBUf37q/1OScpFWwBva8SNcYi");
        $manager->persist($user);

        $user = new User();
        $user->setEmail('peggylabat@gmail.com');
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPassword("$2y$10\$HcTMdMNk6QW9OETk8QuklukiUpzjt.5P7pT565yqa.f7ze0xrIg3C");
        $manager->persist($user);

        // Users not admin
        $user = new User();
        $user->setEmail('johndoe@john.fr');
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword("$2y$10\$wSeE7WRqAKsPsF9/6i8DLOozHc1LUCHlyqYqT66ZZdH0xMu83JqWm");
        $manager->persist($user);

        // Social events
        $socialEvent = new SocialEvent();
        $socialEvent->setTitle("Le Havre-Tampa School Challenge – 17-22 octobre 2022");
        $socialEvent->setDescription("Dans le cadre de l’anniversaire des 30 ans du 
        jumelage entre les villes du Havre et de
        Tampa, différentes actions seront menées pour sensibiliser les jeunes français et
        américains au jumelage.
        ");
        $socialEvent->setImage('https://picsum.photos/200');
        $socialEvent->setIcon('https://picsum.photos/20');
        $socialEvent->setLink('https://www.facebook.com/');
        $socialEvent->setArchived(false);
        $manager->persist($socialEvent);

        $socialEvent = new SocialEvent();
        $socialEvent->setTitle("Soirée d’inauguration -11 mai 2022");
        $socialEvent->setDescription("Le 11 mai, c’est la soirée d’inauguration de LH Connections. 
        Un moment qui réunira plus de 200 personnes, des quatre coins du Havre, et plus encore !    
        ");
        $socialEvent->setImage('https://picsum.photos/200');
        $socialEvent->setIcon('https://picsum.photos/20');
        $socialEvent->setLink('https://www.facebook.com/events/512116053722896');
        $socialEvent->setArchived(false);
        $manager->persist($socialEvent);

        // projects
        $project = new Project();
        $project->setImageName('temporary');
        //$project->setResponsible(['Project responsible']);
        $project->setTitle('Project Title');
        $project->setDescription('Description du projet');
        $project->setLongDescription('Description longue du projet');
        $project->setLink('Lien vers le slack');
        $project->setCreatedAt($date);
        $project->setSortTitle('Titre de classement');
        $project->setFilterSortTitle('filtre de classement');
        $project->setArchived(false);
        $project->setImageSize('20');
        $manager->persist($project);

        // Responsible + Roles

        $responsibleMembers = [
            'peggy labat' => 'présidente',
            'lise-lotte kirkegaard dusbosc' => 'vice-présidente',
            'hannah gallais' => 'vice-présidente',
            'alice dinh viet' => 'secrétaire',
            'andré labat' => 'trésorier',
            'paul barraud de lagerie' => 'responsable du site internet',
            'tom smith' => 'coordinateur des projets uk',
            'louise jeanne' => 'responsable partenaires',
            'marion hébert' => 'coordinatrice des événements',
            'marie amélie-laroze' => 'responsable communication'
        ];

        foreach ($responsibleMembers as $name => $role) {
            $responsibleMember = new Responsible();
            $responsibleMember->setName($name);
            $responsibleMember->setImage("https://i.imgur.com/lod8x1d.jpg");
            $responsibleMember->setDescription("La future description");
            $responsibleMember->setTitle($role);
            $manager->persist($responsibleMember);
        }

        // 6 Events
//        for ($i = 0; $i < 6; $i++) {
//            $socialEvent = new SocialEvent();
//            $socialEvent->setTitle($lipsum->word());
//            $socialEvent->setDescription($lipsum->sentence(2));
//            $socialEvent->setImage('https://picsum.photos/200');
//            $socialEvent->setIcon('https://picsum.photos/20');
//            $socialEvent->setLink('https://www.facebook.com/');
//            $manager->persist($socialEvent);
//        }

//        $firstNameCollection = [
//            "Harry Seldon",
//            "Ross Kurtain",
//            "Bruce Woyne",
//            "Cook Thehook",
//        ];
//
//        $titlesArray = [
//            "Writer",
//            "Webmaster",
//            "Partner",
//            "Founder"
//        ];
//
//        // 4 members responsibles
//        for ($i = 0; $i < 4; $i++) {
//            $responsibleMember = new Responsible();
//            $responsibleMember->setName($firstNameCollection[$i]);
//            $responsibleMember->setImage('https://picsum.photos/600/600');
//            $responsibleMember->setDescription($lipsum->sentence(1));
//            $responsibleMember->setTitle($titlesArray[$i]);
//            $manager->persist($responsibleMember);
//        }

        // 9 Projects
        // Sort generation

//        $filterTitle = '';
//        $arraySortTitles = ['filter-app', 'filter-card', 'filter-web'];
//
//        for ($i = 0; $i < 9; $i++) {
//            $sortSystem = $arraySortTitles[array_rand($arraySortTitles)];
//            $project = new Project();
//            $project->setTitle($lipsum->word());
//            $project->setDescription($lipsum->word(5));
//            $project->setLongDescription('');
//            $project->setImage('https://picsum.photos/800/600');
//            $project->setLink('#');
//            $project->setCreatedAt($date);
//            $project->setSortTitle($lipsum->word());
//            $project->setFilterSortTitle($sortSystem);
//            $manager->persist(($project));
//        }

        $manager->flush();
    }
}
