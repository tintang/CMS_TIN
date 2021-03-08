<?php

namespace App\Member\Factory;

use App\Member\Entity\Member;
use App\Member\Model\MemberDto;

interface MemberFactoryInterface
{
    public function createMember(MemberDto $memberDto): Member;
}