<?php

namespace App\Core\Dto;

use App\Core\Entity\ArticleTranslation;
use App\Core\Entity\Company;

class ArticleOutputDto
{

    private string $companyName;

    private int $id;

    private array $translations = [];

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): ArticleOutputDto
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $name)
    {
        $this->companyName = $name;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ArticleOutputDto
    {
        $this->id = $id;
        return $this;
    }
}