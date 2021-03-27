<?php


namespace App\User\Event;


use App\User\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class RegistrationEvent extends Event
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): RegistrationEvent
    {
        $this->user = $user;
        return $this;
    }
}