<?php

namespace App\Core\Entity;

use App\Member\Entity\Member;
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

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Member\Entity\Member")
     */
    private Member $member;

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


    public function __construct(Member $member, ArrayCollection $orderPositions)
    {
        $this->member = $member;
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

    public function getMember(): Member
    {
        return $this->member;
    }

    public function setMember(Member $member): Order
    {
        $this->member = $member;
        return $this;
    }

    public function getOrderCreated(): DateTimeImmutable
    {
        return $this->orderCreated;
    }
}