<?php

namespace App\Core\Entity;

use App\User\Entity\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class Order
{

    public const STATE_PAYED = 'payed';

    public const STATE_NOT_PAYED = 'unpayed';

    public const STATE_CANCELED = 'canceled';

    public const STATE_DELIVERED = 'delivered';

    public const STATE_SENT = 'sent';

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User")
     */
    private User $user;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $orderCreated;


    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Core\Entity\OrderPosition", cascade="remove",mappedBy="order")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private ArrayCollection $orderPositions;


    public function __construct(User $member, ArrayCollection $orderPositions)
    {
        $this->user = $member;
        $this->orderCreated = new DateTimeImmutable();
        $this->orderPositions = $orderPositions;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Order
    {
        $this->user = $user;
        return $this;
    }

    public function getOrderCreated(): DateTimeImmutable
    {
        return $this->orderCreated;
    }
}