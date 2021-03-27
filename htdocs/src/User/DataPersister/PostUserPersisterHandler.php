<?php

namespace App\User\DataPersister;

use App\Core\DataPersister\PostDataPersisterHandler;
use App\Core\DataPersister\PostDataPersisterSupportCheck;
use App\User\Entity\User;
use App\User\Event\RegistrationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PostUserPersisterHandler implements PostDataPersisterSupportCheck, PostDataPersisterHandler
{

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function support($object, array $context = []): bool
    {
        return $object instanceof User;
    }

    public function handlePostPersist($object, array $context = [])
    {
        $this->eventDispatcher->dispatch(new RegistrationEvent($object));
    }
}