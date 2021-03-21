<?php

namespace App\User\DataFixtures;

use App\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    public const DEFAULT_MEMBER_REFERENCE = 'default';

    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * UserFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setEmail('t-tang@live.de')
            ->setPassword($this->userPasswordEncoder->encodePassword($user, 'password'))
            ->setFirstname('Tin')
            ->setLastname('Tang');

        $manager->persist($user);
        $manager->flush();

        $this->setReference(self::DEFAULT_MEMBER_REFERENCE, $user);
    }
}