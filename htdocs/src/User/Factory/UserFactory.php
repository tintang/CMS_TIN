<?php

namespace App\User\Factory;

use App\Core\Factory\AbstractFactory;
use App\User\Entity\Address;
use App\User\Entity\User;
use App\User\Entity\UserSettings;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFactory extends AbstractFactory
{

    private UserPasswordEncoderInterface $passwordEncoder;

    private RequestStack $requestStack;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, RequestStack $requestStack)
    {
        parent::__construct();
        $this->passwordEncoder = $passwordEncoder;
        $this->requestStack = $requestStack;
    }

    public function buildObject(array $data = [])
    {
        $user = new User();
        $address = new Address();
        $userSettings = new UserSettings();

        $userSettings
            ->setUser($user)
            ->setLocale($this->requestStack->getCurrentRequest()->getLocale());

        $address
            ->setStreet($data['street'])
            ->setCity($data['city'])
            ->setPostalCode($data['postalCode'])
            ->setCountry($data['country']);

        $user
            ->setEmail($data['email'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setPassword(
                $this->passwordEncoder->encodePassword($user, $data['password'])
            )
            ->setAddress($address)
            ->setUserSettings($userSettings);

        return $user;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(
            [
                'email',
                'firstname',
                'lastname',
                'password',
                'street',
                'postalCode',
                'city',
                'country',
            ]
        );
    }

}