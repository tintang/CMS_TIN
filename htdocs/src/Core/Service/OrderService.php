<?php

use App\Core\Entity\Order;
use App\Core\Mailer\BaseMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class OrderService
{

    private EntityManagerInterface $entityManager;

    private BaseMailer $mailer;

    private Security $security;

    public function __construct(
        EntityManagerInterface $entityManager,
        BaseMailer $mailer,
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