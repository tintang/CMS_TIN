<?php


namespace App\User\ForgetPassword;


use App\User\Entity\ForgetPasswordRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class PasswordResetHandler implements MessageHandlerInterface
{

    private EntityManagerInterface $entityManager;

    private UserPasswordEncoderInterface $userPasswordEncoderInterface;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $userPasswordEncoderInterface
    )
    {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }

    public function __invoke(PasswordReset $passwordReset)
    {
        $passwordResetRepo = $this->entityManager->getRepository(ForgetPasswordRequest::class);

        $passwordResetEntity = $passwordResetRepo->findOneBy([
            'token' => $passwordReset->getToken()
        ]);

        if (!$passwordResetEntity) {
            throw new \InvalidArgumentException('Invalid code');
        }

        $passwordResetEntity->setApproved();
        $user = $passwordResetEntity->getUser();
        $user->setPassword(
            $this->userPasswordEncoderInterface->encodePassword($user, $passwordReset->getNewPassword())
        );

        $this->entityManager->persist($user);
        $this->entityManager->persist($passwordResetEntity);
        $this->entityManager->flush();
    }
}