<?php

namespace App\Core\Dto;

use App\Core\Entity\ArticleTranslation;

class ArticleOutputDto
{

    /**
     * @var ArticleTranslation[]
     */
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
}