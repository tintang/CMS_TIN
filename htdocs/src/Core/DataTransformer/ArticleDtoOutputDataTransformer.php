<?php

namespace App\Core\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Core\Dto\ArticleOutputDto;
use App\Core\Entity\Article;
use App\Core\Entity\ArticleTranslation;
use Doctrine\ORM\EntityManagerInterface;

class ArticleDtoOutputDataTransformer implements DataTransformerInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Article $object
     * @param string $to
     * @param array $context
     * @return ArticleOutputDto
     */
    public function transform($object, string $to, array $context = [])
    {
        $article = new ArticleOutputDto();
        $article->setTranslations($object->getTranslations()->toArray());
        return $article;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ($data instanceof Article) && $to === ArticleOutputDto::class && null !== ($context['input']['class'] ?? null);
    }
}