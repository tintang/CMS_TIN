<?php


use App\Core\Entity\Article;
use App\Core\Entity\Storage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StorageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Storage::class);
    }

    public function getItemCount(Article $article, string $country)
    {
        $queryBuilder = $this->createQueryBuilder('storage');
        $queryBuilder
            ->select('storageArticle.amount')
            ->innerJoin('storage.storageArticle', 'storageArticle')
            ->andWhere(
                $queryBuilder->expr()->eq('storage.country', ':country'),
                $queryBuilder->expr()->eq('storageArticle.article', ':article')
            )
            ->setParameters(
                [
                    'country' => $country,
                    'article' => $article
                ]
            );

        $queryBuilder->getQuery()->execute();
    }
}