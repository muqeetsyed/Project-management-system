<?php

namespace App\UseCase\AddEmployee;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class Employee
{
    public function __construct(
        public int $code,
        public string $firstname,
        public string $department,
        public string $gender,
        public string $email,
        public string $password,
        public string $status,
        public ?string $middleName = null,
        public ?string $lastName = null,
        public ?string $position = null,
        public ?UploadedFile $avatar = null,
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
        string $status,
        ?string $middleName = null,
        ?string $lastName = null,
        ?string $position = null,
        ?UploadedFile $avatar = null,
    ): self
    {
        return new self(
            $code,
            $firstname,
            $department,
            $gender,
            $email,
            $password,
            $status,
            $middleName,
            $lastName,
            $position,
            $avatar
        );
    }
}