<?php


namespace App\Core\DataFixtures;


use App\Core\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $company = new Company();
        $company->setName('Adidas');
        $manager->persist($company);
        $this->addReference(self::class, $company);
        $manager->flush();
    }

}