<?php


namespace App\User\ForgetPassword;


class PasswordReset
{
    private string $token;

    private string $newPassword;

    public function __construct(string $token, string $newPassword)
    {
        $this->token = $token;
        $this->newPassword = $newPassword;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): PasswordReset
    {
        $this->token = $token;
        return $this;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): PasswordReset
    {
        $this->newPassword = $newPassword;
        return $this;
    }
}