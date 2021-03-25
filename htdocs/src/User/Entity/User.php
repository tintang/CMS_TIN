<?php

namespace App\User\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Member
 * @ORM\Entity()
 */
class User implements UserInterface
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

    /**
     * @ORM\OneToOne(targetEntity="UserSettings", inversedBy="user")
     */
    private ?UserSettings $userSettings = null;

    public function getRoles(): array
    {
        return array_merge($this->roles, ['ROLE_USER']);
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

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function setFirstname(string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname(string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setRoles(array $roles): User
    {
        $this->roles = new ArrayCollection($roles);
        return $this;
    }

    public function getUserSettings(): ?UserSettings
    {
        return $this->userSettings;
    }

    public function setUserSettings(?UserSettings $userSettings): User
    {
        $this->userSettings = $userSettings;
        return $this;
    }
}
