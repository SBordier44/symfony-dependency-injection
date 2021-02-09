<?php

declare(strict_types=1);

namespace App;

class Logger
{
    public function log(string $message): void
    {
        var_dump('LOGGER : ' . $message);
    }
}
