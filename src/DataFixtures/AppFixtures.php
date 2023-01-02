<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Club;
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

        $user = new User();
        $user->setEmail('calendar@lhconnections.com');
        $user->setRoles(["ROLE_USER", "ROLE_CALENDAR"]);
        $user->setPassword("$2y$13\$slgu05jUynRH81VLKdilZuVAdY2u.X2WudET7QWFcTBL33jRqfcqO");
        $manager->persist($user);

        // Users not admin
        $user = new User();
        $user->setEmail('johndoe@john.fr');
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword("$2y$10\$wSeE7WRqAKsPsF9/6i8DLOozHc1LUCHlyqYqT66ZZdH0xMu83JqWm");
        $manager->persist($user);

       /* // projects
        $project = new Project();
        $project->setImageName('temporary.jpg');
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
        $manager->persist($project);*/

        // Responsible + Roles

        /*$responsibleMembers = [
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
        ];*/

        $aResponsibles = [
            ['name' => 'peggy labat', 'role' => 'présidente', 'picture' => 'peggy.jpg'],
            ['name' => 'lise-lotte kirkegaard dusbosc', 'role' => 'vice-présidente', 'picture' => 'lise.jpg'],
            ['name' => 'hannah gallais', 'role' => 'vice-présidente', 'picture' => 'hannah.jpg'],
            ['name' => 'alice dinh viet', 'role' => 'secrétaire', 'picture' => 'alice.jpg'],
            ['name' => 'andré labat', 'role' => 'trésorier', 'picture' => 'andre.jpg'],
            ['name' => 'paul barraud de lagerie', 'role' => 'responsable du site internet', 'picture' => 'paul.jpg'],
            ['name' => 'tom smith', 'role' => 'coordinateur des projets uk', 'picture' => 'tom.jpg'],
            ['name' => 'louise jeanne', 'role' => 'responsable partenaires', 'picture' => 'louise.jpg'],
            ['name' => 'marion hébert', 'role' => 'coordinatrice des événements', 'picture' => 'marion.jpg'],
            ['name' => 'marie amélie-laroze', 'role' => 'responsable communication', 'picture' => 'marieam.jpg'],
        ];

        foreach ($aResponsibles as $responsible) {
            $responsibleMember = new Responsible();
            $responsibleMember->setName($responsible['name']);
            $responsibleMember->setImage($responsible['picture']);
            $responsibleMember->setDescription("La future description");
            $responsibleMember->setTitle($responsible['role']);
            $manager->persist($responsibleMember);
        }

        // clubs



       /* for ($i = 1; $i < 5; $i++) {
            $club = new Club();
            $club->setName('Let\'s swim');
            $club->setDescription('Nous nageons dans la mer chaque jour de l\'année');
            $club->setLongDescription('Une plus grande description que la description précédente à des fins de tests');
            $club->setImageName('picture.jpg');
            $club->setArchived(false);
            $club->setImageSize('20');
            $manager->persist($club);
        }*/

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
