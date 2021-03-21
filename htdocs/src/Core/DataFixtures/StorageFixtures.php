<?php

namespace App\Core\DataFixtures;

use App\Core\Entity\Storage;
use App\Core\Entity\StorageArticle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StorageFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $germanStorage = new Storage();
        $germanStorage
            ->setCity('German Storage')
            ->setCountry('de')
            ->setStreet('Schewidnitzer Str')
            ->setZipCode('10709');

        $storageArticle = new StorageArticle();
        $storageArticle
            ->setAmount(3)
            ->setStorage($germanStorage)
            ->setArticle($this->getReference(ArticleFixtures::DEFAULT_ARTICLE));

        $manager->persist($germanStorage);
        $manager->persist($storageArticle);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ArticleFixtures::class];
    }
}