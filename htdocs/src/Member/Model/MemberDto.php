<?php

namespace App\Member\Model;

class MemberDto
{

    private string $email = '';

    private string $password = '';

    private string $firstname = '';

    private string $passwordConfirmation = '';

    private string $lastname = '';

    private array $userRoles = [];

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return MemberDto
     */
    public function setEmail(string $email): MemberDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return MemberDto
     */
    public function setPassword(string $password): MemberDto
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return MemberDto
     */
    public function setFirstname(string $firstname): MemberDto
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }

    /**
     * @param string $passwordConfirmation
     * @return MemberDto
     */
    public function setPasswordConfirmation(string $passwordConfirmation): MemberDto
    {
        $this->passwordConfirmation = $passwordConfirmation;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return MemberDto
     */
    public function setLastname(string $lastname): MemberDto
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getUserRoles(): array
    {
        return $this->userRoles;
    }

    public function setUserRoles(array $userRoles): MemberDto
    {
        $this->userRoles = $userRoles;
        return $this;
    }
}