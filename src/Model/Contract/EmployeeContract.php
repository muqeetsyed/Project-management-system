<?php

namespace App\Model\Contract;

use App\Model\Entity\Employee;

/** This contract is made with Employee Business Class*/
interface EmployeeContract
{
    public function addNewEmployee(Employee $employees): void;

    public function removeEmployee(Employee $employees): bool;

    public function updateEmployeeDetails(Employee $oldDetails, Employee $newDetails): Employee;

    public function findEmployee(int $employeeCode): Employee;
}