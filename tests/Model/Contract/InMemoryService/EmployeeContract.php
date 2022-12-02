<?php

namespace App\Tests\Model\Contract\InMemoryService;

use App\Model\Contract\Emplyess;
use App\Model\Entity\Employee;

class EmployeeContract implements \App\Model\Contract\EmployeeContract
{
    /**
     * @var array<string,Employee>
     */
    public array $employees = [];

    public function addNewEmployee(Employee $employees): void
    {
        $this->employees[$employees->getCode()] = $employees;
    }

    public function removeEmployee(Employee $employees): bool
    {
        // TODO: Implement removeEmployee() method.
    }

    public function updateEmployeeDetails(Employee $oldDetails, Emplyess $newDetails): Employee
    {
        // TODO: Implement updateEmployeeDetails() method.
    }

    public function findEmployee(int $employeeCode): Employee
    {
       return $this->employees[$employeeCode];
    }
}