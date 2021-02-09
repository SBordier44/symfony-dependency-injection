<?php

namespace App\Mailer;

use App\HasLoggerInterface;
use App\Logger;

class GmailMailer implements MailerInterface, HasLoggerInterface
{

    protected string $user;
    protected string $password;
    protected Logger $logger;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function send(Email $email)
    {
        var_dump("ENVOI VIA GMAILMAILER", $email);
    }

    public function setLogger(Logger $logger): void
    {
        $this->logger = $logger;
        $this->logger->log('Log de GmailMailer');
    }
}
