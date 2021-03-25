<?php

namespace App\Tests;

use App\Tests\ApiTester;

class ArticleCest
{
    public function _before(ApiTester $I)
    {
    }

    public function tryToPostArticle(ApiTester $I)
    {
        /**
         * $I->haveHttpHeader('Content-Type', 'application/json');
         * $I->sendPost('/api/articles', [
         * 'locale' => 'de',
         * 'name' => 'string',
         * 'description' => 'string',
         * 'price' => 20.32
         * ]);
         * $I->seeResponseCodeIsSuccessful();
         **/
    }
}
