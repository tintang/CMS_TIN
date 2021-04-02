<?php


namespace api;


use App\Tests\ApiTester;
use App\User\Entity\ForgetPasswordRequest;
use Doctrine\ORM\EntityManagerInterface;

class ResetPasswordCest
{

    // tests
    public function testPasswordReset(ApiTester $I)
    {
        $em = $I->grabService(EntityManagerInterface::class);
        $requestRepo = $em->getRepository(ForgetPasswordRequest::class);
        $user = $I->getNewUser('t.tang@test.de', 'Tin', 'Tang', 'test');
        $token = $I->getToken($user->getEmail(), 'test');

        $I->amBearerAuthenticated($token);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/api/reset_password_request', ['email' => 't.tang@test.de']);
        $I->seeResponseCodeIsSuccessful();

        $forgetPasswordRequest = $requestRepo->findOneBy([
            'user' => $user
        ]);

        $I->assertNotNull($forgetPasswordRequest);

        $I->sendPost('/api/reset_password', [
            'token' => $forgetPasswordRequest->getToken(),
            'newPassword' => 'test123'
        ]);
        $I->seeResponseCodeIsSuccessful();

        $I->sendPost('/api/login_check', [
            'username' => $user->getEmail(),
            'password' => 'test123'
        ]);
        $I->seeResponseCodeIsSuccessful();
    }
}