<?php


namespace api;


use App\Tests\ApiTester;

class RegistrationCest
{

    public function testRegistration(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('api/users', [
            'email' => 'test@test.de',
            'password' => 'test123',
            'firstname' => 'test',
            'lastname' => 'test',
            "address" => [
                "street" => "string",
                "city" => "string",
                "postalCode" => "string",
                "country" => "string"
            ]
        ]);

        $TEST = json_decode($I->grabResponse());
        $I->seeResponseCodeIsSuccessful();
    }
}