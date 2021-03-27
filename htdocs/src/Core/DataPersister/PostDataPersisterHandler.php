<?php

namespace App\Core\DataPersister;

interface PostDataPersisterHandler
{
    public function handlePostPersist($object, array $context = []);
}