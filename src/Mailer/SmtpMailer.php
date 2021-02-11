<?php

declare(strict_types=1);

namespace App\Mailer;

class SmtpMailer implements MailerInterface
{
    public function __construct(protected string $dsn, protected string $user, protected string $password)
    {
    }

    public function send(Email $email): void
    {
        var_dump("ENVOI VIA SMTPMAILER ({$this->dsn})", $email);
    }
}
