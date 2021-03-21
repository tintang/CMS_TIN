<?php

use App\Core\Entity\Order;
use App\Core\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class OrderService
{

    private EntityManagerInterface $entityManager;

    private Mailer $mailer;

    private Security $security;

    public function __construct(
        EntityManagerInterface $entityManager,
        Mailer $mailer,
        Security $security
    )
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public function handleOrder(Order $oder)
    {

        $oder->getCustomer();
    }

}