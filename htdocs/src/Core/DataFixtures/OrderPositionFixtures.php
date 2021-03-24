<?php


namespace App\Core\DataFixtures;


use App\Core\Entity\Article;
use App\Core\Entity\OrderPosition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderPositionFixtures extends Fixture implements DependentFixtureInterface
{

    public const DEFAULT_ORDER_POSITION = 'order_position';

    public function load(ObjectManager $manager)
    {
        /** @var Article $article */
        $article = $this->getReference(ArticleFixtures::DEFAULT_ARTICLE);
        $orderPosition = new OrderPosition(
            $article,
            100,
            3
        );

        $manager->persist($orderPosition);
        $manager->flush();
        $this->addReference(self::DEFAULT_ORDER_POSITION, $orderPosition);
    }

    public function getDependencies()
    {
        return [
            ArticleFixtures::class
        ];
    }
}