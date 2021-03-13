<?php

namespace App\Core\Dto;

class ArticleInputDto
{

    private ?string $language = null;

    protected ?string $name = null;

    private ?string $description = null;

    protected ?float $price = null;

    public function __construct(?string $language, ?string $name, ?float $price)
    {
        $this->language = $language;
        $this->name = $name;
        $this->price = $price;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): ArticleInputDto
    {
        $this->language = $language;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ArticleInputDto
    {
        $this->description = $description;
        return $this;
    }
}