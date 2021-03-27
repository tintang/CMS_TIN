<?php

namespace App\User\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\User\Entity\User;
use App\User\Event\RegistrationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class UserPostDataPersister implements ContextAwareDataPersisterInterface
{

    private ContextAwareDataPersisterInterface $decorated;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher, ContextAwareDataPersisterInterface $decorated)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->decorated = $decorated;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        $result = $this->decorated->persist($data, $context);

        if ($data instanceof User && ($context['collection_operation_name'] ?? '') === 'POST') {
            $this->eventDispatcher->dispatch(new RegistrationEvent($data));
        }

        return $result;
    }

    public function remove($data, array $context = [])
    {
        $this->decorated->remove($data, $context);
    }
}