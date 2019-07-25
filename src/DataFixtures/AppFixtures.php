<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Person;
use App\Entity\Poll;
use App\Entity\Choice;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * Poll
         */

        $poll1= new Poll();
        $poll1->setTitle("Anniversaire de Suzanne");
        $poll1->setSlug("anniversaire-de-suzanne");
        $poll1->setCreatedAt(new \DateTime('2019-07-14T12:00:00'));
        $manager->persist($poll1);

        $poll2 = new Poll();
        $poll2->setTitle("Randonnée nature");
        $poll2->setSlug("randonnée-nature");
        $poll2->setCreatedAt(new \DateTime('2019-07-18T10:00:00'));
        $manager->persist($poll2);

        $manager->flush();

        /**
         * Choice
         */

        $choice1= new Choice();
        $choice1-> setDate(new \DateTime('2019-10-28'));
        $choice1->setPoll($poll1);
        $manager->persist($choice1);

        $choice2= new Choice();
        $choice2-> setDate(new \DateTime('2019-10-30'));
        $choice2->setPoll($poll1);
        $manager->persist($choice2);

        $choice3= new Choice();
        $choice3-> setDate(new \DateTime('2019-11-02'));
        $choice3->setPoll($poll1);
        $manager->persist($choice3);

        $choice4= new Choice();
        $choice4-> setDate(new \DateTime('2019-12-05'));
        $choice4->setPoll($poll2);
        $manager->persist($choice4);

        $choice5= new Choice();
        $choice5-> setDate(new \DateTime('2019-12-12'));
        $choice5->setPoll($poll2);
        $manager->persist($choice5);

        $choice6= new Choice;
        $choice6-> setDate(new \DateTime('2019-10-19'));
        $choice6->setPoll($poll2);
        $manager->persist($choice6);

        $manager->flush();

        /**
         * Person
         */

        $person1 = new Person();

        $person1->setUsername("Paul Newman");
        $person1->setEmail("p.newman@gmail.com");
        $person1->setPoll($poll1);
        $person1->setPoll($poll2);
        $person1->addChoice($choice2);
        $person1->addChoice($choice3);
        $person1->addChoice($choice4);
        $person1->addChoice($choice5);
        $manager->persist($person1);

        $person2 = new Person();

        $person2->setUsername("Jack Nicholson");
        $person2->setEmail("j_nicholson@gmx.com");
        $person2->setPoll($poll1);
        $person2->setPoll($poll2);
        $person2->addChoice($choice1);
        $person2->addChoice($choice5);
        $person2->addChoice($choice6);
        $manager->persist($person2);

        $person3 = new Person();

        $person3->setUsername("Nathalie Wood");
        $person3->setEmail("nathalie.wood@laposte.net");
        $person3->setPoll($poll1);
        $person3->setPoll($poll2);
        $person3->addChoice($choice1);
        $person3->addChoice($choice2);
        $person3->addChoice($choice4);
        $person3->addChoice($choice6);
        $manager->persist($person3);

        $manager->flush();

    }
}
