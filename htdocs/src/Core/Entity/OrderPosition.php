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
     * @var Article
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Article")
     * @ORM\JoinColumn()
     */
    private Article $article;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=2)
     */
    private string $currentArticlePrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Order", inversedBy="orderPositions")
     */
    private ?Order $order = null;

    /**
     * OrderPosition constructor.
     * @param Article $article
     * @param string $currentArticlePrice
     * @param Order|null $order
     */
    public function __construct(Article $article, string $currentArticlePrice, Order $order = null)
    {
        $this->article = $article;
        $this->currentArticlePrice = $currentArticlePrice;
        $this->order = $order;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @return string
     */
    public function getCurrentArticlePrice(): string
    {
        return $this->currentArticlePrice;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return OrderPosition
     */
    public function setOrder(Order $order): OrderPosition
    {
        $this->order = $order;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}