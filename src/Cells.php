<?php

declare(strict_types=1);

namespace Yoshioka\LifeGame;

class Cells
{
    /**
     * @param <int, <int, Cell>> $cells
     */
    public function __construct(
        private array $cells,
        private int $maxY,
        private int $maxX,
    ) {
    }

    public function next()
    {
        $ret = [];
        foreach($this->cells as $y => $value) {
            foreach($value as $x => $cell) {
                $around = $this->around($y, $x);
                $ret[$y][$x] = false;
                if ($cell->isLive()) {
                    if ($around >= 2 || $around <= 3) {
                        $alive = true;
                    }
                    if ($around <= 1) {
                        $alive = false;
                    }

                    if ($around >= 4) {
                        $alive = false;
                    }
                } else {
                    if ($around === 3) {
                        $alive = true;
                    } else {
                        $alive = false;
                    }
                }
                $ret[$y][$x] = new Cell($alive);
            }
        }
        return new self(
            $ret,
            $this->maxY,
            $this->maxX
        );
    }

    private function around($y, $x): int
    {
        return 
              $this->life($y - 1, $x - 1)
            + $this->life($y    , $x - 1)
            + $this->life($y + 1, $x - 1)
            + $this->life($y - 1, $x)
            + $this->life($y + 1, $x)
            + $this->life($y - 1, $x + 1)
            + $this->life($y    , $x + 1)
            + $this->life($y + 1, $x + 1)
            ;
    }

    private function life($y, $x)
    {
        /** @var Cell $cell */
        $cell = $this->cells[$y][$x] ?? null;
        if (is_null($cell)) {
            return 0;
        }
        return $cell->isLive();
    }

    public function maxX()
    {
        return $this->maxX;
    }

    public function maxY()
    {
        return $this->maxY;
    }

    public function getCell(int $y, int $x): Cell
    {
        return $this->cells[$y][$x];
    }

    public static function generate(
        array $input,
        int $maxY,
        int $maxX
    ): self
    {
        $cleanMap = array_fill(0, $maxY, array_fill(0, $maxX, 0));

        $ret = [];
        foreach($cleanMap as $y => $value) {
            foreach($value as $x => $cell) {
                $ret[$y][$x] = new Cell(
                    isset($input[$y + 1][$x + 1])
                );
            }
        }
        return new self($ret, $maxY, $maxX);
    }
}
