<?php

namespace App\User\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\User\Dto\UserDto;
use App\User\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDtoDataTransformer implements DataTransformerInterface
{

    private ValidatorInterface $validator;

    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(ValidatorInterface $validator, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->validator = $validator;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function transform($object, string $to, array $context = []): User
    {
        $user = new User();
        $user
            ->setEmail($object->getEmail())
            ->setFirstname($object->getFirstname())
            ->setLastname($object->getLastname())
            ->setPassword(
                $this->userPasswordEncoder->encodePassword($user, $object->getPassword())
            );

        return $user;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof User) {
            return false;
        }

        return $data instanceof UserDto && $to === User::class && ($context['input']['class'] ?? null) !== null;
    }
}