<?php

namespace App\Core\Entity;

use App\User\Entity\User;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use \App\Core\Entity\OrderPosition;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Cart
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class Cart implements OwnerInterface
{

    /**
     * @var ?int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User")
     */
    private ?UserInterface $customer = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?DateTimeImmutable $created = null;

    /**
     * @ORM\OneToMany(targetEntity=OrderPosition::class, mappedBy="cart", cascade={"persist", "remove"})
     */
    private Collection $orderPositions;

    /**
     * Cart constructor.
     * @param User $customer
     * @param array $orderPositions
     */
    public function __construct()
    {
        $this->created = new \DateTimeImmutable();
        $this->orderPositions = new ArrayCollection();
    }

    /**
     * @return Collection|OrderPosition[]
     */
    public function getOrderPositions(): Collection
    {
        return $this->orderPositions;
    }

    public function addOrderPosition(OrderPosition $orderPosition): self
    {
        if (!$this->orderPositions->contains($orderPosition)) {
            $this->orderPositions[] = $orderPosition;
            $orderPosition->setCart($this);
        }

        return $this;
    }

    public function removeOrderPosition(OrderPosition $orderPosition): self
    {
        if ($this->orderPositions->removeElement($orderPosition)) {
            // set the owning side to null (unless already changed)
            if ($orderPosition->getCart() === $this) {
                $orderPosition->setCart(null);
            }
        }

        return $this;
    }

    public function getCustomer(): UserInterface
    {
        return $this->customer;
    }

    public function setCustomer(UserInterface $customer): Cart
    {
        $this->customer = $customer;
        return $this;
    }

    public function setOwner(UserInterface $owner)
    {
        $this->setCustomer($owner);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}