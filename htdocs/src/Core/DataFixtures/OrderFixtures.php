<?php


namespace App\Core\DataFixtures;


use App\Core\Entity\Order;
use App\User\DataFixtures\UserFixtures;
use App\User\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $orderPositions = new ArrayCollection(
            [
                $this->getReference(OrderPositionFixtures::DEFAULT_ORDER_POSITION)
            ]
        );
        /** @var User $user */
        $user = $this->getReference(UserFixtures::DEFAULT_MEMBER_REFERENCE);
        $order = new Order($user, $orderPositions);

        $manager->persist($order);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrderPositionFixtures::class,
            UserFixtures::class,
        ];
    }
}