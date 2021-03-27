<?php


namespace App\User\Dto;


class UserDto
{

    private string $email;

    private string $firstname;

    private string $lastname;

    private string $password;

    private AddressDto $address;

    public function __construct(
        string $email,
        string $firstname,
        string $lastname,
        string $password,
        AddressDto $address
    ) {
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return AddressDto
     */
    public function getAddress(): AddressDto
    {
        return $this->address;
    }

    /**
     * @param AddressDto $address
     * @return UserDto
     */
    public function setAddress(AddressDto $address): UserDto
    {
        $this->address = $address;
        return $this;
    }
}