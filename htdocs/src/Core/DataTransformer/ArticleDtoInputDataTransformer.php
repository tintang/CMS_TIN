<?php

namespace App\Core\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Core\Dto\ArticleInputDto;
use App\Core\Entity\Article;
use App\Core\Entity\ArticleTranslation;

class ArticleDtoInputDataTransformer implements DataTransformerInterface
{

    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
    
    /**
     * @param ArticleInputDto $object
     * @param string $to
     * @param array $context
     * @return Article
     */
    public function transform($object, string $to, array $context = [])
    {
        $this->validator->validate($object);
        $article = new Article();
        /** @var ArticleTranslation $translationObject */
        $translationObject = $article->translate($object->getLocale());
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