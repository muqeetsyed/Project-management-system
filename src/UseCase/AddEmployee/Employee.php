<?php

namespace App\UseCase\AddEmployee;

final class Employee
{
    public function __construct(
        public int $code,
        public string $firstname,
        public string $department,
        public string $gender,
        public string $email,
        public string $password,
        public string $status
    )
    {
    }

    public static function create(
        int $code,
        string $firstname,
        string $gender,
        string $department,
        string $email,
        string $password,
        string $status
    ): self
    {
        return new self(
            $code,
            $firstname,
            $department,
            $gender,
            $email,
            $password,
            $status
        );
    }
}