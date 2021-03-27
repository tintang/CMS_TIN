<?php

namespace App\Core\DataPersister;

interface PostDataPersisterSupportCheck
{
    public function support($object, array $context = []);
}