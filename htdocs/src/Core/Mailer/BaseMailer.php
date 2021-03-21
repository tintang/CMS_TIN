<?php


namespace App\Core\Mailer;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class BaseMailer
{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param array $options
     * @throws TransportExceptionInterface
     */
    public function sendMail(array $options)
    {
        $mail = new TemplatedEmail();
        $mail
            ->from('t-tang@live.de')
            ->subject('Das ist ein Test')
            ->htmlTemplate('templates/mail/test.html.twig')
            ->text('Das ist ein Test')
            ->context([]);

        $this->mailer->send($mail);
    }

}