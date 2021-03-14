<?php

namespace App\Core\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class ArticlePrice
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class ArticlePrice
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Article", cascade="remove")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private Article $article;

    /**
     * @ORM\Column(type="decimal", precision=2)
     */
    private string $price;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private string $countryCode;

    /**
     * ArticlePrice constructor.
     * @param Article $article
     * @param string $price
     */
    public function __construct(Article $article, string $price, string $countryCode)
    {
        $this->article = $article;
        $this->price = $price;
        $this->countryCode = $countryCode;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): ArticlePrice
    {
        $this->article = $article;
        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): ArticlePrice
    {
        $this->price = $price;
        return $this;
    }
}