<?php

namespace App\Tests;

use App\Member\Entity\Member;
use App\Member\Factory\MemberFactory;
use App\Member\Model\MemberDto;
use App\Tests\ApiTester;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTestLogin(ApiTester $I)
    {
        $newUser = $I->getNewUser('test@test.de', 'test', 'test', 'test');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/api/login_check', [
            'username' => 'test@test.de',
            'password' => 'test'
        ]);

        $I->seeResponseCodeIsSuccessful();
    }
}
