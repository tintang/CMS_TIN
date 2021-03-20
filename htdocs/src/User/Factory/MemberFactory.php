<?php

namespace App\User\Factory;

use App\User\Entity\User;
use App\User\Model\MemberDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberFactory implements MemberFactoryInterface
{

    private UserPasswordEncoderInterface $passwordEncoder;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    public function createMember(MemberDto $memberDto): User
    {
        $member = new User();
        $member
            ->setEmail($memberDto->getEmail())
            ->setPassword($this->passwordEncoder->encodePassword($member, $memberDto->getPassword()))
            ->setFirstname($memberDto->getFirstname())
            ->setLastname($memberDto->getLastname());
        
        return $member;
    }
}