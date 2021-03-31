<?php


namespace unit\Member\Factory;


use App\User\Entity\User;
use App\User\Factory\UserFactory;
use App\User\Model\MemberDto;
use Codeception\PHPUnit\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberFactoryTest extends TestCase
{

    public function testCreate()
    {
        $requestStack = $this->createMock(RequestStack::class);
        $passwordEncoderInterface = $this->createMock(UserPasswordEncoderInterface::class);
        $currentRequest = $this->createMock(Request::class);
        $memberDto = new MemberDto();

        $requestStack->method('getCurrentRequest')->willReturn($currentRequest);
        $currentRequest->expects($this->once())->method('getLocale')->willReturn('de');

        $passwordEncoderInterface->expects($this->once())->method('encodePassword')->willReturn('tintang');
        $memberFactory = new UserFactory($passwordEncoderInterface, $requestStack);
        /** @var User $member */
        $member = $memberFactory->create([
            'password' => 'password',
            'lastname' => 'lastname',
            'email' => 'email',
            'firstname' => 'firstname',
            'postalCode' => 'postalCode',
            'street' => 'street',
            'country' => 'de',
            'city' => 'city',
        ]);

        $this->assertSame($member->getLastname(), 'lastname');
        $this->assertSame($member->getFirstName(), 'firstname');
        $this->assertSame($member->getLastname(), 'lastname');
        $this->assertSame($member->getEmail(), 'email');
    }
}