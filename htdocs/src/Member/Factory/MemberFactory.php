<?php

namespace App\Member\Factory;

use App\Member\Entity\Member;
use App\Member\Model\MemberDto;
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

    public function createMember(MemberDto $memberDto): Member
    {
        $member = new Member();
        $member
            ->setEmail($memberDto->getEmail())
            ->setPassword($this->passwordEncoder->encodePassword($member, $memberDto->getPassword()))
            ->setFirstname($memberDto->getFirstname())
            ->setLastname($memberDto->getLastname());

        $this->entityManager->persist($member);
        $this->entityManager->flush();
        return $member;
    }
}