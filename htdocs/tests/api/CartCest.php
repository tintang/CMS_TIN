<?php

namespace App\Tests;


use App\Core\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class CartCest
{

    private EntityManagerInterface $em;

    private ObjectRepository $cartRepository;

    /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
    public function _before(ApiTester $I)
    {
        $this->em = $I->grabService(EntityManagerInterface::class);
        $this->cartRepository = $this->em->getRepository(Cart::class);
    }

    public function testAddToCart(ApiTester $I)
    {

        $newUser = $I->getNewUser('test_cart@test.de', 'Test', 'Cart', 'tintang');
        $token = $I->getToken($newUser->getEmail(), 'tintang');
        $article = $I->createArticle();

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->amBearerAuthenticated($token);
        $I->sendPost('api/carts', [
            'orderPositions' => [
                [
                    'article' => 'api/articles/' . $article->getId(),
                    'amount' => 3,
                ],
            ]
        ]);

        $I->seeResponseCodeIsSuccessful();
        $cart = $this->cartRepository->findOneBy([
            'customer' => $newUser
        ]);

        $I->assertNotNull($cart);
    }

    public function testAddToCartWithoutOrderPositions(ApiTester $I)
    {
        $newUser = $I->getNewUser('test_cart_without@test.de', 'Test', 'Cart', 'tintang');
        $token = $I->getToken($newUser->getEmail(), 'tintang');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->amBearerAuthenticated($token);
        $I->sendPost('api/carts', [

        ]);

        $I->assertNotNull($this->cartRepository->findOneBy([
            'customer' => $newUser
        ]));

    }

}