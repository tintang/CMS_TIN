<?php

namespace App\Core\Helper;

class TokenGenerator
{

    private const TOKEN_CHARACTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function generateToken(int $length): string
    {
        if ($length < 0) {
            throw new  \InvalidArgumentException('Number must be a positive integer');
        }

        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= self::TOKEN_CHARACTERS[rand(0, strlen(self::TOKEN_CHARACTERS) - 1)];
        }
        return $result;
    }
}