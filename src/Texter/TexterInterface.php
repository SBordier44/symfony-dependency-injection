<?php

declare(strict_types=1);

namespace App\Texter;

interface TexterInterface
{
    public function send(Text $text): void;
}
