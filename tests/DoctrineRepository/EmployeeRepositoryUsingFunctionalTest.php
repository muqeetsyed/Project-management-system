<?php

namespace App\Tests\DoctrineRepository;

use App\DoctrineRepository\EmployeeRepository;
use App\Model\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmployeeRepositoryUsingFunctionalTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface|null
     */
    public ?EntityManagerInterface $entityManager;

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
    final public function test_save_data_in_database(Employee $employee): void
    {

        if(null === $this->entityManager) {
            return;
        }

        $repository = new EmployeeRepository($this->entityManager);

        $repository->addNewEmployee($employee);

        $result =  $this->entityManager->getRepository(Employee::class)
            ->findOneBy(['code' => $employee->getCode()]);

        self::assertSame($employee, $result);
    }

    public function employeeDetails(): array
    {
        return [
            [
                Employee::AddNewEmployee(
                    code: 105,
                    firstname: 'jingha',
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