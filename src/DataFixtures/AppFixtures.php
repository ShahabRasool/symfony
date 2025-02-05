<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use App\Factory\TeacherFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // // $product = new Product();
        // // $manager->persist($product);
        // $teacher= new Teacher;
        // $teacher->setName("Azmat sab");
        // $teacher->setFatherName("Azmat Shah");
        // $teacher->setEmail("azmat@gmail.com");
        // $teacher->setPhone("1234567890");
        // $teacher->setAddress("Wah Texila");
        // $teacher->setDBBirth(new \DateTimeImmutable('1976-01-01'));
        // $manager->persist($teacher);

        // $teacher2= new Teacher;
        // $teacher2->setName("Naveed sab");
        // $teacher2->setFatherName("Naveed Shah");
        // $teacher2->setEmail("naveed@gmail.com");
        // $teacher2->setPhone("000567890");
        // $teacher2->setAddress("Wah Texila");
        // $teacher2->setDBBirth(new \DateTimeImmutable('1987-01-01'));
        // $manager->persist($teacher2);
        // $manager->flush();
        TeacherFactory::createMany(50);
    }
}
