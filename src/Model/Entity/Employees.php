<?php

namespace App\Model\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeesRepository::class)]
class Employees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code;

    #[ORM\Column(length: 50)]
    private ?string $firstname;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $middlename = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 50)]
    private ?string $gender;

    #[ORM\Column(length: 50)]
    private ?string $department = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $position = null;

    #[ORM\Column(length: 100)]
    private ?string $email;

    #[ORM\Column(length: 50)]
    private ?string $password;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(length: 20)]
    private ?string $status;

    private function __construct(
        int $code,
        string $firstname,
        string $department,
        string $gender,
        string $email,
        string $password,
        string $status
    )
    {
        $this->code = $code;
        $this->firstname = $firstname;
        $this->department = $department;
        $this->gender = $gender;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
    }

    public static function AddNewEmployee(
        int $code,
        string $firstname,
        string $gender,
        string $department,
        string $email,
        string $password,
        string $status
    ) {
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(?string $middlename): self
    {
        $this->middlename = $middlename;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
