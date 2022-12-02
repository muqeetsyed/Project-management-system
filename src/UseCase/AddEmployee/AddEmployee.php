<?php

namespace App\UseCase\AddEmployee;

use App\Model\Contract\EmployeeContract;
use App\Model\Entity\Employee;
use App\UseCase\AddEmployee\Employee as EmployeeDTO;

class AddEmployee
{
    public function __construct(
        public EmployeeContract $contract
    )
    {
    }

    public function __invoke(EmployeeDTO $employee): bool
    {
        $employee = Employee::AddNewEmployee(
            code: $employee->code,
            firstname: $employee->firstname,
            gender: $employee->gender,
            department: $employee->department,
            email: $employee->email,
            password: $employee->password,
            status: $employee->status
        );

        $this->contract->addNewEmployee($employee);

        return true;
    }

}