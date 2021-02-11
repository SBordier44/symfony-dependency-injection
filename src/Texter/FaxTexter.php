<?php

declare(strict_types=1);

namespace App\Texter;

class FaxTexter implements TexterInterface
{
    public function send(Text $text): void
    {
        var_dump('ENVOI D\'UN FAX :', $text);
    }
}
