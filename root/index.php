<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Yoshioka\LifeGame\Cells;
use Yoshioka\LifeGame\Viewer;

$maxX = 50;
$maxY = 25;

$input[5][4] = true;
$input[5][5] = true;
$input[5][6] = true;
$input[4][6] = true;
$input[3][5] = true;

$cells = Cells::generate($input, $maxY, $maxX);
while(1) {
    system('clear');
    Viewer::show($cells);
    $cells = $cells->next();
    //sleep(1);
}
