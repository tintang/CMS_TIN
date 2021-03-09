<?php


namespace unit\Member\Factory;


use App\Member\Entity\Member;
use App\Member\Factory\MemberFactory;
use App\Member\Model\MemberDto;
use Codeception\PHPUnit\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberFactoryTest extends TestCase
{

    public function testCreate()
    {
        $passwordEncoderInterface = $this->createMock(UserPasswordEncoderInterface::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $memberDto = new MemberDto();

        $memberDto
            ->setFirstname('tin')
            ->setLastname('tang')
            ->setPassword('tintang')
            ->setPasswordConfirmation('tintang')
            ->setEmail('t-tang@live.de');

        $passwordEncoderInterface->expects($this->once())->method('encodePassword')->willReturn('tintang');
        $memberFactory = new MemberFactory($passwordEncoderInterface, $entityManager);
        $memberFactory->createMember($memberDto);
    }
}