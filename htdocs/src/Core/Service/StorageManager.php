<?php

namespace App\Core\Service;

use App\Core\Entity\OrderPosition;
use App\Core\Entity\Storage;
use App\Core\Entity\StorageArticle;
use App\Core\Repository\StorageArticleRepository;
use Doctrine\ORM\EntityManagerInterface;

class StorageManager
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateStorageItemCount(Storage $storage, OrderPosition $orderPosition)
    {
        /** @var StorageArticleRepository $storageArticleRepo */
        $storageArticleRepo = $this->entityManager->getRepository(StorageArticle::class);
        /** @var StorageArticle $storageArticle */
        $storageArticle = $storageArticleRepo->getStorageArticle($storage, $orderPosition->getArticle());
        $storageArticle->decreaseAmount($orderPosition->getAmount());
    }
}