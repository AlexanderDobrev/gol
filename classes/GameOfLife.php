<?php

namespace AlexD\gol;

use AlexD\gol\core\Grid;
use AlexD\gol\geometry\Point;

/**
 * Class GameOfLife
 * Entry point of the game
 * @package AlexD\gol
 */
class GameOfLife
{

    /**
     * @var
     */
    private $grid;

    /**
     * @param Grid $grid
     */
    public function __construct(Grid $grid = null)
    {
        $this->setGrid($grid);
    }

    /**
     * This method cycles throught the grid
     * marking cells as dead or alive based on selected pattern
     * or previous state of the grid
     */
    public function cycle()
    {
        $size = $this->getGrid()->getSize();

        for ($i = $size->getX(); $i < $size->getWidth(); $i++) {
            for ($j = $size->getY(); $j < $size->getHeight(); $j++) {
                $position = new Point($i, $j);
                if ($cell = $this->getGrid()->findCell($position)) {

                    $livingNeighborsCount = $this->getGrid()->getLivingNeighborsCount($position);

                    if ($cell->getIsAlive()) {
                        $cell->setIsAlive($livingNeighborsCount > 1 && $livingNeighborsCount < 4);
                    } else {
                        if ($livingNeighborsCount >= 3) {
                            $cell->setIsAlive(true);
                        }
                    }
                }
            }
        }
    }

    /**
     * @return Grid
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @param mixed $grid
     */
    public function setGrid($grid)
    {
        $this->grid = $grid;
    }
}