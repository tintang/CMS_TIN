<?php

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Member
 * @ORM\Entity()
 */
class Member implements UserInterface
{

    private string $email;

    private string $password;

    private string $firstname;

    private string $lastname;

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}