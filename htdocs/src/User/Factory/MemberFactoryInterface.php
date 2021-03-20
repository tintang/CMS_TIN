<?php

namespace App\User\Factory;

use App\User\Entity\User;
use App\User\Model\MemberDto;

interface MemberFactoryInterface
{
    public function createMember(MemberDto $memberDto): User;
}