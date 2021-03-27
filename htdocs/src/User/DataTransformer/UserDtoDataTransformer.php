<?php

namespace App\User\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\User\Dto\UserDto;
use App\User\Entity\Address;
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

    /**
     * @param UserDto $object
     * @param string $to
     * @param array $context
     * @return User
     */
    public function transform($object, string $to, array $context = []): User
    {
        $user = new User();
        $address = new Address();
        $addressDto = $object->getAddress();


        $address
            ->setCity($addressDto->getCity())
            ->setStreet($addressDto->getStreet())
            ->setPostalCode($addressDto->getPostalCode())
            ->setCountry($addressDto->getCountry());

        $user
            ->setEmail($object->getEmail())
            ->setFirstname($object->getFirstname())
            ->setLastname($object->getLastname())
            ->setPassword(
                $this->userPasswordEncoder->encodePassword($user, $object->getPassword())
            )
            ->setAddress($address);

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