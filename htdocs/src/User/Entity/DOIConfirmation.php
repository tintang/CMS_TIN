<?php

namespace App\User\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class DOIConfirmation
 * @package App\User\Entity
 * @ORM\Entity()
 */
class DOIConfirmation
{

    /**
     * @var int|null
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id()
     */
    private ?int $id = null;

    /**
     * @var UserInterface
     * @ORM\OneToOne(targetEntity="User", )
     */
    private UserInterface $user;

    /**
     * @var DateTimeImmutable|null
     * @ORM\Column(type="datetime_immutable")
     */
    private ?DateTimeImmutable $confirmation = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?DateTimeImmutable $send = null;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getConfirmation(): ?DateTimeImmutable
    {
        return $this->confirmation;
    }

    /**
     * @param DateTimeImmutable|null $confirmation
     * @return DOIConfirmation
     */
    public function setConfirmation(?DateTimeImmutable $confirmation): DOIConfirmation
    {
        $this->confirmation = $confirmation;
        return $this;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getSend(): ?DateTimeImmutable
    {
        return $this->send;
    }

    /**
     * @param DateTimeImmutable|null $send
     * @return DOIConfirmation
     */
    public function setSend(?DateTimeImmutable $send): DOIConfirmation
    {
        $this->send = $send;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}