<?php


namespace App\User\ForgetPassword;


class PasswordResetRequest
{

    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): PasswordResetRequest
    {
        $this->email = $email;
        return $this;
    }
}