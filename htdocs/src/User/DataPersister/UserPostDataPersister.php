<?php

namespace App\User\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Core\DataPersister\PostDataPersisterHandlerRegistry;
use App\User\Entity\User;
use App\User\Event\RegistrationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class UserPostDataPersister implements ContextAwareDataPersisterInterface
{

    private ContextAwareDataPersisterInterface $decorated;
    private EventDispatcherInterface $eventDispatcher;
    private PostDataPersisterHandlerRegistry $registry;

    public function __construct(ContextAwareDataPersisterInterface $decorated, PostDataPersisterHandlerRegistry $registry)
    {
        $this->decorated = $decorated;
        $this->registry = $registry;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        $result = $this->decorated->persist($data, $context);

        $this->registry->handlePostPersist($data, $context);

        return $result;
    }

    public function remove($data, array $context = [])
    {
        $this->decorated->remove($data, $context);
    }
}