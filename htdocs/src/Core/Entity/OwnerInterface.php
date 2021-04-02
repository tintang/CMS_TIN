<?php

namespace App\Core\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

interface OwnerInterface
{
    public function setOwner(UserInterface $owner);
}