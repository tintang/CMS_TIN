<?php

namespace App\Tests;

use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    /**
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @param string $password
     */
    public function getNewUser(string $email, string $firstname, string $lastname, string $password)
    {
        $em = $this->grabService(EntityManagerInterface::class);
        $passwordEncoder = $this->grabService(UserPasswordEncoderInterface::class);
        $memberRepository = $em->getRepository(User::class);

        if ($user = $memberRepository->findOneBy(['email' => $email])) {
            $em->remove($user);
            $em->flush();
        }

        $newUser = new User();
        $newUser
            ->setFirstname($firstname)
            ->setLastname($lastname)
            ->setEmail($email)
            ->setPassword($passwordEncoder->encodePassword($newUser, $password));

        $em->persist($newUser);
        $em->flush();
        return $newUser;
    }

    public function getToken(string $email, string $password)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPost('/api/login_check', [
            'username' => $email,
            'password' => $password
        ]);

        list($token) = $this->grabDataFromResponseByJsonPath('$.token');
        return $token;
    }
}
