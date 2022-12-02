<?php

namespace App\Tests\DoctrineRepository;

use App\DoctrineRepository\EmployeeRepository;
use App\Model\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use PHPUnit\Framework\TestCase;

class EmployeeRepositoryUsingMockTest extends TestCase
{
    /**
     * @dataProvider employeeDetails
     * @throws EntityNotFoundException
     */
    final public function test_data_gets_persisted_into_the_database(Employee $employee): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($employee)
        ;

        $repository = new EmployeeRepository($entityManager);

        $repository->addNewEmployee($employee);

        $entityManager
            ->expects($this->once())
            ->method('find')
            ->with(Employee::class, $employee->getCode())
            ->willReturn($employee)
        ;

        $existingEmployee = $repository->findEmployee($employee->getCode());

        self::assertSame($employee,$existingEmployee);
    }


    /**
     * @dataProvider employeeDetails
     * @throws EntityNotFoundException
     */
    final public function test_if_employee_exist(Employee $employee): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $employeeCode = 101;

        $entityManager
            ->expects($this->once())
            ->method('find')
            ->with(Employee::class,$employeeCode)
            ->willReturn($employee)
        ;

        $repository = new EmployeeRepository($entityManager);

        $existingEmployee = $repository->findEmployee($employeeCode);


        self::assertSame($employee, $existingEmployee);
    }

    /**
     * @return void
     */
    final public function test_if_employee_does_not_exist(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $employeeCode = 200;

        $entityManager
            ->expects($this->once())
            ->method('find')
            ->with(Employee::class, $employeeCode)
        ;

        $this->expectException(EntityNotFoundException::class);

        $repository = new EmployeeRepository($entityManager);

        $repository->findEmployee($employeeCode);
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

}