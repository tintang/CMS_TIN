<?php

namespace App\User\Dto;

class RegistrationDto
{
    private string $email;

    private string $password;

    private string $firstname;

    private string $lastname;

    public function __construct(string $email, string $password, string $firstname, string $lastname)
    {
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): RegistrationDto
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): RegistrationDto
    {
        $this->password = $password;
        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): RegistrationDto
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): RegistrationDto
    {
        $this->lastname = $lastname;
        return $this;
    }
}