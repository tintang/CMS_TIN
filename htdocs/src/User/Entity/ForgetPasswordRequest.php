<?php


namespace App\User\Entity;


use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class ForgetPasswordRequest
 * @package App\User\Entity
 * @ORM\Entity()
 */
class ForgetPasswordRequest
{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var UserInterface
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private UserInterface $user;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $token;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $approved = null;

    /**
     * ForgetPasswordRequest constructor.
     * @param UserInterface $user
     * @param string $token
     */
    public function __construct(UserInterface $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->created = new \DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return ForgetPasswordRequest
     */
    public function setUser(UserInterface $user): ForgetPasswordRequest
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return ForgetPasswordRequest
     */
    public function setToken(string $token): ForgetPasswordRequest
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @param DateTimeImmutable $created
     * @return ForgetPasswordRequest
     */
    public function setCreated(DateTimeImmutable $created): ForgetPasswordRequest
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getApproved(): ?DateTimeImmutable
    {
        return $this->approved;
    }

    /**
     * @param DateTimeImmutable $approved
     * @return ForgetPasswordRequest
     */
    public function setApproved(): ForgetPasswordRequest
    {
        $this->approved = new \DateTimeImmutable();
        return $this;
    }
}