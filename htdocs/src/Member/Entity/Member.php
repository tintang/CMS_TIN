<?php

namespace App\Member\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Member
 * @ORM\Entity()
 */
class Member implements UserInterface
{

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private string $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=10000)
     */
    private string $password;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private string $firstname;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private string $lastname;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    public function getRoles()
    {
        return array_merge($this->roles, [
            'ROLE_MEMBER'
        ]);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setEmail(string $email): Member
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): Member
    {
        $this->password = $password;
        return $this;
    }

    public function setFirstname(string $firstname): Member
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname(string $lastname): Member
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setRoles(array $roles): Member
    {
        $this->roles = $roles;
        return $this;
    }
}
