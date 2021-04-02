<?php


namespace App\Core\EventListener;


use App\Core\Entity\ArticlePrice;
use App\Core\Entity\OrderPosition;
use App\User\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use LogicException;
use Symfony\Component\Security\Core\Security;

class SetPriceEventListener implements EventSubscriberInterface
{

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $em = $event->getEntityManager();
        $articlePriceRepository = $em->getRepository(ArticlePrice::class);
        $orderPosition = $event->getEntity();
        /** @var OrderPosition $orderPosition */
        if ($orderPosition instanceof OrderPosition) {
            /** @var User $user */
            $user = $this->security->getUser();
            $articlePrice = $articlePriceRepository->findOneBy([
                'article' => $orderPosition->getArticle(),
                'countryCode' => $user->getAddress()->getCountry()
            ]);
            $orderPosition->setCurrentArticlePrice($articlePrice->getPrice());
        }

        throw new LogicException('No user logged in');
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist
        ];
    }
}