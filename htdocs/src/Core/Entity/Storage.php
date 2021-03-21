<?php

namespace App\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Storage
 * @package App\Core\Entity
 * @ORM\Entity()
 */
class Storage
{

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $city;

    /**
     * @ORM\Column(type="string")
     */
    private string $zipCode;

    /**
     * @ORM\Column(type="string")
     */
    private string $street;

    /**
     * @ORM\Column(type="string")
     */
    private string $country;

    /**
     * @ORM\OneToMany(targetEntity="StorageArticle", mappedBy="storage")
     */
    private ArrayCollection $storageArticle;

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Storage
     */
    public function setCity(string $city): Storage
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Storage
     */
    public function setZipCode(string $zipCode): Storage
    {
        $this->zipCode = $zipCode;
        return $this;
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
     * @return Storage
     */
    public function setStreet(string $street): Storage
    {
        $this->street = $street;
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
     * @return Storage
     */
    public function setCountry(string $country): Storage
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStorageArticle(): ArrayCollection
    {
        return $this->storageArticle;
    }

    /**
     * @param ArrayCollection $storageArticle
     * @return Storage
     */
    public function setStorageArticle(ArrayCollection $storageArticle): Storage
    {
        $this->storageArticle = $storageArticle;
        return $this;
    }
}