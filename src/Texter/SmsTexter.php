<?php

namespace App\Texter;

use App\HasLoggerInterface;
use App\Logger;

class SmsTexter implements TexterInterface, HasLoggerInterface
{
    protected string $serviceDsn;
    protected string $key;
    protected Logger $logger;

    public function __construct(string $serviceDsn, string $key)
    {
        $this->serviceDsn = $serviceDsn;
        $this->key = $key;
    }

    public function send(Text $text)
    {
        var_dump("ENVOI DE SMS : ", $text);
    }

    public function setLogger(Logger $logger): void
    {
        $this->logger = $logger;
        $this->logger->log('Log de SmsTexter');
    }
}
