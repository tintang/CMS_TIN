<?php

namespace App\User\Mail;

use App\User\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

class ForgetPasswordMailFactory
{

    private TranslatorInterface $translator;

    private string $sender;

    /**
     * ForgetPasswordMail constructor.
     * @param TranslatorInterface $translator
     * @param string $sender
     */
    public function __construct(TranslatorInterface $translator, string $sender)
    {
        $this->translator = $translator;
        $this->sender = $sender;
    }

    public function createMailFromUser(User $user): Email
    {
        return (new TemplatedEmail())
            ->from($this->sender)
            ->subject($this->translator->trans('forget_password_mail'))
            ->to($user->getEmail())
            ->htmlTemplate('')
            ->textTemplate('')
            ->context([
                'user' => $user
            ]);
    }
}