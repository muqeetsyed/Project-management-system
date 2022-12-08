<?php

namespace App\Controller;

use App\UseCase\AddEmployee\AddEmployee;
use App\UseCase\AddEmployee\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class Index extends AbstractController
{
    public function __construct(
        private AddEmployee $addEmployee
    )
    {
    }

    #[Route(path: '/list',name: 'list-records')]
    public function getAllRecords():JsonResponse
    {
        return new JsonResponse(
            ['one','two','three']
        );
    }

    #[Route(path:'/save-details',name: 'save_employee_details')]
    public function saveEmployeeDetails(Request $request): JsonResponse
    {
        $employeeCommand = Employee::create(
            code: $request->request->get('code'),
            firstname: $request->request->get('firstName'),
            gender: $request->request->get('gender'),
            department: $request->request->get('department'),
            email: $request->request->get('email'),
            password: $request->request->get('password'),
            status: $request->request->get('status'),
            middleName: $request->request->get('middleName'),
            lastName: $request->request->get('lastName'),
            position: $request->request->get('password'),
            avatar: $request->files->get('avatar')
        );

        $isSaved = ($this->addEmployee)($employeeCommand);

        return new JsonResponse(['data' => $isSaved]);
    }
}