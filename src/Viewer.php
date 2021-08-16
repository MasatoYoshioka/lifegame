<?php

declare(strict_types=1);

namespace Yoshioka\LifeGame;

class Viewer
{
    public static function show(Cells $cells): void
    {
        for($y = 0; $y < $cells->maxY(); $y++) {
            for($x = 0; $x < $cells->maxX(); $x++) {
                echo $cells->getCell($y, $x)->isLive() ? '■' : '□';
            }
            echo PHP_EOL;
        }
    }
}
