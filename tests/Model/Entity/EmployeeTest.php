<?php

namespace App\Tests\Model\Entity;

use App\Model\Entity\Employee;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    public function test_add_detials_of_new_employee(): void
    {
        $employee = Employee::AddNewEmployee(
            code: 100,
            firstname: 'max',
            gender: 'male',
            department: 'Quality Assurance',
            email: 'max@yahoo.in',
            password: 'max#secret',
            status: 'active'
        );

        self::assertSame(100,$employee->getCode());
        self::assertSame('max', $employee->getFirstname());
        self::assertSame('male', $employee->getGender());
        self::assertSame('Quality Assurance', $employee->getDepartment());
        self::assertSame('max@yahoo.in', $employee->getEmail());
        self::assertSame('max#secret', $employee->getPassword());
        self::assertSame('active', $employee->getStatus());
    }

    public function test_construct_function_should_not_be_accessible(): void
    {
        $this->expectException(\Error::class);

        $test = new Employee(
            code: 100,
            firstname: 'max',
            gender: 'male',
            department: 'Quality Assurance',
            email: 'max@yahoo.in',
            password: 'max#secret',
            status: 'active'
        );
    }
}