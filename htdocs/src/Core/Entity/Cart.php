<?php

namespace App\Core\Entity;

use App\Member\Entity\Member;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Cart
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class Cart
{

    /**
     * @var ?int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @var Member
     * @ORM\ManyToOne(targetEntity="App\Member\Entity\Member")
     */
    private Member $customer;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?DateTimeImmutable $created = null;


}