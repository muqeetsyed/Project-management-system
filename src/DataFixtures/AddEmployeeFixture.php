<?php

namespace App\DataFixtures;

use App\Model\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddEmployeeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $employee = Employee::AddNewEmployee(
            code: 101,
            firstname: 'ray',
            gender: 'male',
            department: 'Management',
            email: 'ray@gmail.com',
            password: 'ray000',
            status: 'inactive'
        );

        $manager->persist($employee);

        $manager->flush();
    }
}
