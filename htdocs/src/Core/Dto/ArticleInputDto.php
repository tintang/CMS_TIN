<?php

namespace App\Core\Dto;

class ArticleInputDto
{

    private ?string $locale = null;

    protected ?string $name = null;

    private ?string $description = null;

    protected ?float $price = null;

    public function __construct(?string $locale, ?string $name, ?float $price)
    {
        $this->locale = $locale;
        $this->name = $name;
        $this->price = $price;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): ArticleInputDto
    {
        $this->locale = $locale;
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