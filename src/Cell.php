<?php

declare(strict_types=1);

namespace Yoshioka\LifeGame;

class Cell
{
    public function __construct(
        private bool $live
    ) {
    }

    public function isLive(): bool
    {
        return $this->live;
    }
}
