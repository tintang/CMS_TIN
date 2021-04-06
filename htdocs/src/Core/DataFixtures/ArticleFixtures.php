<?php

namespace App\Core\DataFixtures;

use App\Core\Entity\Article;
use App\Core\Entity\ArticleTranslation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
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

    /** @noinspection PhpParamsInspection */
    public function getArticles(int $count): array
    {
        $articles = [];
        for ($i = 0; $i < $count; $i++) {
            $article = new Article();
            /** @var ArticleTranslation $translation */
            $translation = $article->translate('de');
            $article->setCompany($this->getReference(CompanyFixtures::class));
            $translation
                ->setName('Test Article ' . $i)
                ->setDescription('Das ist ein Article');
            $article->mergeNewTranslations();
            $articles[] = $article;
        }

        return $articles;
    }

    public function getDependencies()
    {
        return [CompanyFixtures::class];
    }
}