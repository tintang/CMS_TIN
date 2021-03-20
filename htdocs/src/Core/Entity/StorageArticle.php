<?php

namespace App\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class StorageArticle
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class StorageArticle
{

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Article")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private Article $article;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Entity\Storage")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private Storage $storage;

    /**
     * @ORM\Column(type="integer")
     */
    private int $amount = 0;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return StorageArticle
     */
    public function setId(?int $id): StorageArticle
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return StorageArticle
     */
    public function setArticle(Article $article): StorageArticle
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return Storage
     */
    public function getStorage(): Storage
    {
        return $this->storage;
    }

    /**
     * @param Storage $storage
     * @return StorageArticle
     */
    public function setStorage(Storage $storage): StorageArticle
    {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return StorageArticle
     */
    public function setAmount(int $amount): StorageArticle
    {
        $this->amount = $amount;
        return $this;
    }
}