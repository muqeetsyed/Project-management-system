<?php

namespace App\DoctrineRepository;

use App\Model\Contract\EmployeeContract;
use App\Model\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class EmployeeRepository implements EmployeeContract
{
    public function __construct(
        public EntityManagerInterface $entityManager
    )
    {
    }

    public function addNewEmployee(Employee $employee): void
    {
        $this->entityManager->persist($employee);
        $this->entityManager->flush();
    }

    public function removeEmployee(Employee $employees): bool
    {
        // TODO: Implement removeEmployee() method.
    }

    public function updateEmployeeDetails(Employee $oldDetails, Employee $newDetails): Employee
    {
        // TODO: Implement updateEmployeeDetails() method.
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findEmployee(int $employeeCode): Employee
    {
        $employee = $this->entityManager->find(Employee::class,$employeeCode);

        if(!$employee instanceof Employee){
            throw new EntityNotFoundException();
        }

        return $employee;
    }
}