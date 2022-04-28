<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Project;
use DateTimeImmutable;
use joshtronic\LoremIpsum;
use App\Entity\SocialEvent;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $lipsum = new LoremIpsum();
        $date = new DateTimeImmutable('2000-01-01');

        // 6 Events
        for ($i = 0; $i < 6; $i++) {
            $socialEvent = new SocialEvent();
            $socialEvent->setTitle($lipsum->word());
            $socialEvent->setDescription($lipsum->sentence(2));
            $socialEvent->setImage('https://picsum.photos/200');
            $socialEvent->setIcon('https://picsum.photos/20');
            $socialEvent->setLink('https://www.facebook.com/');
            $manager->persist($socialEvent);
        }

        $firstNameCollection = [
            "Harry Seldon",
            "Ross Kurtain",
            "Bruce Woyne",
            "Cook Thehook",
        ];

        $titlesArray = [
          "Writer",
          "Webmaster",
          "Partner",
          "Founder"
        ];

        // 4 members teams
        for ($i = 0; $i < 4; $i++) {
            $teamMember = new Team();
            $teamMember->setName($firstNameCollection[$i]);
            $teamMember->setImage('https://picsum.photos/600/600');
            $teamMember->setDescription($lipsum->sentence(1));
            $teamMember->setTitle($titlesArray[$i]);
            $manager->persist($teamMember);
        }

        // 9 Projects
        // Sort generation

        $arrayTitlesSort = ['App ', 'Card ', 'Web '];
        $filterTitle = '';



        for ($i = 0; $i < 9; $i++) {
            $sortSystem = $arrayTitlesSort[array_rand($arrayTitlesSort)];
            if ($sortSystem === 'App ') {
                $filterTitle = 'filter-app';
            } elseif ($sortSystem === 'Card ') {
                $filterTitle = 'filter-card';
            } else {
                $filterTitle = 'filter-web';
            }
            $project = new Project();
            $project->setTitle($lipsum->word());
            $project->setDescription($lipsum->word(5));
            $project->setLongDescription('');
            $project->setImage('https://picsum.photos/800/600');
            $project->setLink('#');
            $project->setCreatedAt($date);
            $project->setSortTitle($sortSystem. rand(1, 3));
            $project->setFilterSortTitle($filterTitle);
            $manager->persist(($project));
        }

        $manager->flush();
    }
}