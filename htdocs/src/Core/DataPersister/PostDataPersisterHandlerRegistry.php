<?php

namespace App\Core\DataPersister;

class PostDataPersisterHandlerRegistry implements PostDataPersisterHandler
{

    /**
     * @var PostDataPersisterHandler[]
     */
    private array $postPersisterHandlers;

    public function __construct(iterable $handlers)
    {
        $this->postPersisterHandlers = iterator_to_array($handlers);
    }

    public function handlePostPersist($object, array $context = [])
    {
        foreach ($this->postPersisterHandlers as $handler) {
            if ($handler->support($object, $context)) {
                $handler->handlePostPersist($object, $context);
            }
        }
    }

}