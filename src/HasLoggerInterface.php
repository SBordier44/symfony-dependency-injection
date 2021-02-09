<?php

declare(strict_types=1);

namespace App;

interface HasLoggerInterface
{
    public function setLogger(Logger $logger): void;
}
