<?php


use App\Member\Entity\Member;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberFactory implements MemberFactoryInterface
{

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createMember(MemberDto $memberDto): Member
    {
        $member = new Member();
        $member
            ->setEmail($memberDto->getEmail())
            ->setPassword($this->passwordEncoder->encodePassword($member, $memberDto->getPassword()))
            ->setFirstname($memberDto->getFirstname())
            ->setLastname($memberDto->getLastname());

        return $member;
    }
}