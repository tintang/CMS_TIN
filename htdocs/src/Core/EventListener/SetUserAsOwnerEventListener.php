<?php


namespace App\Core\EventListener;


use App\Core\Entity\OwnerInterface;
use App\User\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\Entity;
use LogicException;
use Symfony\Component\Security\Core\Security;

class SetUserAsOwnerEventListener implements EventSubscriberInterface
{

    private Security $security;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function prePersist(LifecycleEventArgs $lifecycleEventArgs)
    {
        /** @var OwnerInterface $ownable */
        $ownable = $lifecycleEventArgs->getObject();
        $owner = $this->security->getUser();
        if ($ownable instanceof OwnerInterface && $owner) {
            $ownable->setOwner($owner);
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