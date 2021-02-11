<?php

declare(strict_types=1);

namespace App\Texter;

use App\HasLoggerInterface;
use App\Logger;

class SmsTexter implements TexterInterface, HasLoggerInterface
{
    public function __construct(protected string $serviceDsn, protected string $key)
    {
    }

    public function send(Text $text): void
    {
        var_dump('ENVOI DE SMS : ', $text);
    }

    public function setLogger(Logger $logger): void
    {
        $logger->log('Log de SmsTexter');
    }
}
