<?php

namespace App\Tests\UseCase;

use App\Model\Contract\EmployeeContract;
use App\UseCase\AddEmployee\AddEmployee;
use PHPUnit\Framework\TestCase;
use App\UseCase\AddEmployee\Employee as EmployeeDTO;

class SaveEmployeeTest extends TestCase
{

    /**
     * @dataProvider employeeDetails
     */
    public function test__employee_get_saved(EmployeeDTO $employees)
    {
        $contract = $this->createMock(EmployeeContract::class);

        $contract
            ->expects($this->once())
            ->method('addNewEmployee');

        $addEmployee = new AddEmployee($contract);
        $isSaved = ($addEmployee)($employees);

        self::assertSame(true,$isSaved);
    }

    public function employeeDetails(): array
    {

        return [
            [
                EmployeeDTO::create(
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