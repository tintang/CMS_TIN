<?php

namespace App\User\ForgetPassword;

use App\Core\Helper\TokenGenerator;
use App\User\Entity\ForgetPasswordRequest;
use App\User\Event\ForgetPassword\ForgetPasswordEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Security;

class ForgetPasswordHandler implements MessageHandlerInterface
{

    private Security $security;

    private TokenGenerator $tokenGenerator;

    private EntityManagerInterface $em;

    private MessageBusInterface $messageBus;

    public function __construct(
        Security $security,
        TokenGenerator $tokenGenerator,
        EntityManagerInterface $entityManagerInterface,
        MessageBusInterface $messageBus
    )
    {
        $this->security = $security;
        $this->tokenGenerator = $tokenGenerator;
        $this->em = $entityManagerInterface;
        $this->messageBus = $messageBus;
    }

    public function __invoke(ForgetPassword $forgetPassword)
    {
        $forgetPasswordRequest = new ForgetPasswordRequest(
            $this->security->getUser(),
            $this->tokenGenerator->generateToken(10)
        );

        $this->em->persist($forgetPasswordRequest);
        $this->em->flush();
        $this->messageBus->dispatch(new ForgetPasswordEvent($forgetPassword));
    }

}