<?php


namespace App\User\Dto;


class AddressDto
{

    private string $street;

    private string $city;

    private string $postalCode;

    private string $country;

    /**
     * AddressDto constructor.
     * @param string $street
     * @param string $city
     * @param string $postalCode
     * @param string $country
     */
    public function __construct(string $street, string $city, string $postalCode, string $country)
    {
        $this->street = $street;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return AddressDto
     */
    public function setStreet(string $street): AddressDto
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return AddressDto
     */
    public function setCity(string $city): AddressDto
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return AddressDto
     */
    public function setPostalCode(string $postalCode): AddressDto
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return AddressDto
     */
    public function setCountry(string $country): AddressDto
    {
        $this->country = $country;
        return $this;
    }

}