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
        $em = $I->grabService(EntityManagerInterface::class);
        /** @var UserPasswordEncoderInterface $passwordEncoder */
        $passwordEncoder = $I->grabService(UserPasswordEncoderInterface::class);
        $newUser = new Member();
        $newUser
            ->setFirstname('tin')
            ->setLastname('tang')
            ->setEmail('test@test.de')
            ->setPassword($passwordEncoder->encodePassword($newUser, 'test'));

        $em->persist($newUser);
        $em->flush();
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/api/login_check', [
            'username' => 'test@test.de',
            'password' => 'test'
        ]);

        $I->seeResponseCodeIsSuccessful();
    }
}
