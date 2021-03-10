<?php

namespace App\Member\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity="App\Member\Entity\Roles")
     * @ORM\JoinTable(name="user_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private Collection $roles;

    /**
     * Member constructor.
     */
    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getRoles()
    {
        return $this->roles->toArray();
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
        $this->roles = new ArrayCollection($roles);
        return $this;
    }
}
