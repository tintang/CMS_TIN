<?php

namespace App\Core\Repository;

use App\Core\Entity\Article;
use App\Core\Entity\Storage;
use App\Core\Entity\StorageArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StorageArticleRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StorageArticle::class);
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function getStorageArticle(Storage $storage, Article $article)
    {
        $queryBuilder = $this->createQueryBuilder('storageArticle');
        $queryBuilder
            ->andWhere(
                $queryBuilder->expr()->eq('storageArticle.article', ':article'),
                $queryBuilder->expr()->eq('storageArticle.storage', ':storage')
            )
            ->setParameters([
                'article' => $article,
                'storage' => $storage
            ]);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

}