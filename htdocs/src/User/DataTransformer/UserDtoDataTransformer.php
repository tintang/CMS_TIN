<?php

namespace App\User\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\User\Dto\UserDto;
use App\User\Entity\User;
use App\User\Factory\UserFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDtoDataTransformer implements DataTransformerInterface
{

    private ValidatorInterface $validator;

    private UserPasswordEncoderInterface $userPasswordEncoder;

    private UserFactory $userFactory;

    public function __construct(
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $userPasswordEncoder,
        UserFactory $userFactory
    )
    {
        $this->validator = $validator;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userFactory = $userFactory;
    }

    /**
     * @param UserDto $object
     * @param string $to
     * @param array $context
     * @return User
     */
    public function transform($object, string $to, array $context = []): User
    {
        $addressDto = $object->getAddress();
        return $this->userFactory->create([
            'firstname' => $object->getFirstname(),
            'lastname' => $object->getLastname(),
            'email' => $object->getEmail(),
            'password' => $object->getPassword(),
            'street' => $addressDto->getStreet(),
            'city' => $addressDto->getCity(),
            'country' => $addressDto->getCountry(),
            'postalCode' => $addressDto->getPostalCode()
        ]);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof User) {
            return false;
        }

        return $to === User::class && ($context['input']['class'] ?? null) === UserDto::class;
    }
}