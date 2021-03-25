<?php


namespace unit\Core\Helper;

use App\Core\Helper\TokenGenerator;
use Codeception\PHPUnit\TestCase;

class TokenGeneratorTest extends TestCase
{

    public function testTokenGenerator()
    {
        $classUnderTest = new TokenGenerator();
        $result = $classUnderTest->generateToken(100);
        $this->assertSame(100, strlen($result));
    }


    public function testTokenGeneratorWithNegativeNumber()
    {
        $classUnderTest = new TokenGenerator();
        $this->expectException(\InvalidArgumentException::class);
        $classUnderTest->generateToken(-100);
    }
}