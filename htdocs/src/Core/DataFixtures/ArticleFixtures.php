<?php

namespace App\Core\DataFixtures;

use App\Core\Entity\Article;
use App\Core\Entity\ArticleTranslation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{

    public const DEFAULT_ARTICLE = 'default__article';

    public function load(ObjectManager $manager)
    {
        $articles = $this->getArticles(10);
        foreach ($articles as $article) {
            $manager->persist($article);
        }

        $this->addReference(self::DEFAULT_ARTICLE, $articles[array_key_last($articles)]);
        $manager->flush();
    }

    public function getArticles(int $count): array
    {
        $articles = [];
        for ($i = 0; $i < $count; $i++) {
            $article = new Article();
            /** @var ArticleTranslation $translation */
            $translation = $article->translate('de');
            $translation
                ->setName('Test Article')
                ->setDescription('Das ist ein Article');
            $article->mergeNewTranslations();
            $articles[] = $article;
        }

        return $articles;
    }
}