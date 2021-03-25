<?php


namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserSettings
 * @package App\User\Entity
 * @ORM\Entity()
 */
class UserSettings
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=3)
     */
    private ?string $locale = null;

    /**
     * @var UserInterface
     * @ORM\OneToOne(targetEntity="User", mappedBy="userSettings")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private UserInterface $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): UserSettings
    {
        $this->locale = $locale;
        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): UserSettings
    {
        $this->user = $user;
        return $this;
    }
}