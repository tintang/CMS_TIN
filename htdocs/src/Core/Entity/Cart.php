<?php

namespace App\Core\Entity;

use App\User\Entity\User;
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
     * @var User
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User")
     */
    private User $customer;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?DateTimeImmutable $created = null;


}