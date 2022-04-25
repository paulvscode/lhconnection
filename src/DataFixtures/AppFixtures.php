<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use joshtronic\LoremIpsum;
use App\Entity\SocialEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $lipsum = new LoremIpsum();

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

        $manager->flush();
    }
}