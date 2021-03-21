<?php

namespace functional\Core\Repository;

use App\Core\Repository\StorageArticleRepository;
use App\Tests\FunctionalTester;

class StorageArticleRepositoryCest
{

    private function prepareTest(FunctionalTester $I)
    {
        $storage = $I->createStorage('Test str', 'Berlin', 'de', '10709');
        $article = $I->createArticle();
        $storageArticle = $I->createStorageArticle($storage, $article);
        return [$storage, $article, $storageArticle];
    }

    public function testGetStorageArticle(FunctionalTester $I)
    {
        $repository = $I->grabService(StorageArticleRepository::class);
        [$storage, $article, $storageArticle] = $this->prepareTest($I);
        $result = $repository->getStorageArticle($storage, $article);
        $I->assertSame($storageArticle, $result);
    }
}