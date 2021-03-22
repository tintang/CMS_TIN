<?php

namespace App\User\Mail;

use App\User\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ForgetPasswordMail extends TemplatedEmail
{

    public static function createMailFromUser(User $user)
    {

        $templatedEmail = (new TemplatedEmail())
            ->setSubject('')
        ;
    }
}