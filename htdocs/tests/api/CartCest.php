<?php

namespace App\Tests;


use App\Core\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;

class CartCest
{

    public function _before(ApiTester $I)
    {
    }

    public function testAddToCart(ApiTester $I)
    {
        $em = $I->grabService(EntityManagerInterface::class);
        $cartRepository = $em->getRepository(Cart::class);

        $newUser = $I->getNewUser('test_cart@test.de', 'Test', 'Cart', 'tintang');
        $token = $I->getToken($newUser->getEmail(), 'tintang');
        $article = $I->createArticle();

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->amBearerAuthenticated($token);
        $I->sendPost('api/carts', [
            'orderPositions' => [
                [
                    'article' => 'api/articles/'.$article->getId(),
                    'amount' => 3,
                ],
            ]
        ]);

        $I->seeResponseCodeIsSuccessful();
        $cart = $cartRepository->findOneBy([
            'customer' => $newUser
        ]);

        $I->assertNotNull($cart);
    }

}