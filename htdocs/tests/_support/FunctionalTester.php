<?php

namespace App\Tests;

use App\Core\Entity\Article;
use App\Core\Entity\Storage;
use App\Core\Entity\StorageArticle;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * @param string $street
     * @param string $city
     * @param string $country
     * @param string $zipCode
     * @return Storage
     */
    public function createStorage(string $street, string $city, string $country, string $zipCode): Storage
    {
        $em = $this->grabService(EntityManagerInterface::class);
        $storage = new Storage();
        $storage
            ->setStreet($street)
            ->setCity($city)
            ->setCountry($country)
            ->setZipCode($zipCode);

        $em->persist($storage);
        $em->flush();
        return $storage;
    }

    public function createArticle(): Article
    {
        $em = $this->grabService(EntityManagerInterface::class);
        $article = new Article();
        $em->persist($article);
        $em->flush();
        return $article;
    }

    public function createStorageArticle(Storage $storage, Article $article, int $amount = 10)
    {
        $em = $this->grabService(EntityManagerInterface::class);
        $storageArticle = new StorageArticle();
        $storageArticle
            ->setStorage($storage)
            ->setArticle($article)
            ->setAmount($amount);

        $em->persist($storageArticle);
        $em->flush();
        return $storageArticle;
    }
}
