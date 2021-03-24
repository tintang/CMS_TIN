<?php


namespace api;


use App\Tests\ApiTester;
use App\User\Entity\ForgetPasswordRequest;
use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordCest
{


    // tests
    public function testPasswordReset(ApiTester $I)
    {
        $em = $I->grabService(EntityManagerInterface::class);
        $repo = $em->getRepository(ForgetPasswordRequest::class);
        $user = $I->getNewUser('t.tang@test.de', 'Tin', 'Tang', 'test');
        $token = $I->getToken($user->getEmail(), 'test');

        $I->amBearerAuthenticated($token);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/api/forget_password');
        $I->seeResponseCodeIsSuccessful();

        $forgetPasswordRequest = $repo->findOneBy([
            'user' => $user
        ]);

        $I->assertNotNull($forgetPasswordRequest);
    }
}