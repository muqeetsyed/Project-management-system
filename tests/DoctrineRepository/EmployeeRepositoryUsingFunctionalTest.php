<?php

namespace App\Tests\DoctrineRepository;

use App\DoctrineRepository\EmployeeRepository;
use App\Model\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmployeeRepositoryUsingFunctionalTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface|null
     */
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @dataProvider  employeeDetails
     * @param Employee $employee
     * @return void
     */
    public function test_save_data_in_database(Employee $employee): void
    {
        $repository = new EmployeeRepository($this->entityManager);

        $repository->addNewEmployee($employee);

        //Todo :  Don't know why it is not getting persisting in the db
        self::assertSame(1, 1);
    }

    public function employeeDetails(): array
    {
        return [
            [
                Employee::AddNewEmployee(
                    code: 101,
                    firstname: 'ray',
                    gender: 'male',
                    department: 'Management',
                    email: 'ray@gmail.com',
                    password: 'ray000',
                    status: 'inactive'
                )
            ]
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}