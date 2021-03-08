<?php


use App\Member\Entity\Member;

interface MemberFactoryInterface
{
    public function createMember(MemberDto $memberDto): Member;
}