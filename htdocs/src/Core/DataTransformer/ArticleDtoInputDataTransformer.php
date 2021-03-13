<?php

namespace App\Core\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Core\Dto\ArticleInputDto;
use App\Core\Dto\ArticleOutputDto;
use App\Core\Entity\Article;
use App\Core\Entity\ArticleTranslation;

class ArticleDtoInputDataTransformer implements DataTransformerInterface
{

    /**
     * @param ArticleInputDto $object
     * @param string $to
     * @param array $context
     * @return Article
     */
    public function transform($object, string $to, array $context = [])
    {
        $article = new Article();
        /** @var ArticleTranslation $translationObject */
        $translationObject = $article->translate($object->getLanguage());
        $translationObject->setName($object->getName());
        $translationObject->setDescription($object->getDescription());
        $translationObject->setPrice($object->getPrice());
        $article->mergeNewTranslations();
        return $article;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return !($data instanceof Article) && $to === Article::class && null !== ($context['input']['class'] ?? null);
    }
}