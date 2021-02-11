<?php

declare(strict_types=1);

namespace App\Mailer;

use App\HasLoggerInterface;
use App\Logger;

class GmailMailer implements MailerInterface, HasLoggerInterface
{
    public function __construct(protected string $user, protected string $password)
    {
    }

    public function send(Email $email): void
    {
        var_dump('ENVOI VIA GMAILMAILER', $email);
    }

    public function setLogger(Logger $logger): void
    {
        $logger->log('Log de GmailMailer');
    }
}
