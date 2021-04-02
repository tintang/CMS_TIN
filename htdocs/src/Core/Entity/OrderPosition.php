<?php

namespace App\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class OrderPosition
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class OrderPosition
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Article")
     * @ORM\JoinColumn()
     */
    private Article $article;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private string $currentArticlePrice;

    /**
     * @ORM\Column(type="integer")
     */
    private int $amount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Order", inversedBy="orderPositions", cascade="all")
     */
    private ?Order $order = null;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="orderPositions", cascade={"persist"})
     */
    private ?Cart $cart = null;

    public function __construct(Article $article, int $amount)
    {
        $this->article = $article;
        $this->amount = $amount;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getCurrentArticlePrice(): string
    {
        return $this->currentArticlePrice;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): OrderPosition
    {
        $this->order = $order;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): OrderPosition
    {
        $this->cart = $cart;
        $cart->addOrderPosition($this);
        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): OrderPosition
    {
        $this->amount = $amount;
        return $this;
    }

    public function setCurrentArticlePrice(string $currentArticlePrice): OrderPosition
    {
        $this->currentArticlePrice = $currentArticlePrice;
        return $this;
    }
}