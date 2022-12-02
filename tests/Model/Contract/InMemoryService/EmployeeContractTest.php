<?php

namespace App\Tests\Model\Contract\InMemoryService;

use App\Model\Entity\Employee;
use PHPUnit\Framework\TestCase;

class EmployeeContractTest extends TestCase
{
    public function test_employees_details_are_saved(): void
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

        $employeesContract = new EmployeeContract();

        $employeesContract->addNewEmployee($employee);

        self::assertSame($employee,$employeesContract->findEmployee($employee->getCode()));
    }
}