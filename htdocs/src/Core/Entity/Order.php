<?php

namespace App\Core\Entity;

use App\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package App\Core\Entity
 * @ORM\Entity()
 * @ORM\Table(name="orders")
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
    private User $customer;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $orderCreated;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Core\Entity\OrderPosition", cascade="remove",mappedBy="order")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private Collection $orderPositions;


    public function __construct(User $user, Collection $orderPositions)
    {
        $this->customer = $user;
        $this->orderCreated = new \DateTimeImmutable();
        $this->orderPositions = new ArrayCollection();
        $this->addOrderPositions($orderPositions);
    }

    public function addOrderPositions(Collection $orderPositions)
    {
        /** @var OrderPosition $orderPosition */
        foreach ($orderPositions as $orderPosition) {
            $orderPosition->setOrder($this);
            $this->orderPositions[] = $orderPosition;
        }
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

    public function getCustomer(): User
    {
        return $this->customer;
    }

    public function setCustomer(User $customer): Order
    {
        $this->customer = $customer;
        return $this;
    }

    public function getOrderCreated():  \DateTimeImmutable
    {
        return $this->orderCreated;
    }
}