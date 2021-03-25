<?php

namespace App\User\ForgetPassword;

use App\Core\Helper\TokenGenerator;
use App\User\Entity\ForgetPasswordRequest;
use App\User\Entity\User;
use App\User\Event\ForgetPassword\ForgetPasswordEvent;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Security;

class PasswordResetRequestHandler implements MessageHandlerInterface
{

    private Security $security;

    private TokenGenerator $tokenGenerator;

    private EntityManagerInterface $em;

    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        Security $security,
        TokenGenerator $tokenGenerator,
        EntityManagerInterface $entityManagerInterface,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->security = $security;
        $this->tokenGenerator = $tokenGenerator;
        $this->em = $entityManagerInterface;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(PasswordResetRequest $forgetPassword)
    {

        $userRepository = $this->em->getRepository(User::class);
        $user = $userRepository->findOneBy([
            'email' => $forgetPassword->getEmail()
        ]);

        $forgetPasswordRequest = new ForgetPasswordRequest(
            $user,
            $this->tokenGenerator->generateToken(10)
        );

        $this->em->persist($forgetPasswordRequest);
        $this->em->flush();
        $this->eventDispatcher->dispatch(new ForgetPasswordEvent($forgetPassword));
    }

}