<?php

namespace AlexD\gol\core;

use AlexD\gol\geometry\Point;
use AlexD\gol\geometry\Rectangle;

/**
 * Class Grid
 * @package AlexD\gol\core
 */
class Grid
{

    private $cells = [];
    private $size;

    public function __construct(Rectangle $size)
    {
        $this->setSize($size);

        for ($i = $size->getX(); $i < $size->getWidth(); $i++) {
            for ($j = $size->getY(); $j < $size->getHeight(); $j++) {
                $this->cells[$i][$j] = new Cell();
            }
        }
    }

    /**
     * Creates a game grid from pattern
     * pattern should be 2 dimensional array/matrix
     * @param array $pattern
     * @return Grid
     */
    public static function createFromPattern(array $pattern)
    {
        $grid = new Grid(new Rectangle(0, 0, sizeof($pattern), sizeof($pattern[0])));

        $cells = [];
        $x = 0;
        $y = 0;

        foreach ($pattern as $row) {

            foreach ($row as $cell) {
                $cells[$x][$y] = new Cell($pattern[$x][$y]);
                $y++;
            }

            $y = 0;
            $x++;
        }

        $grid->setCells($cells);

        return $grid;
    }

    /**
     * @return array
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * @param array $cells
     */
    public function setCells($cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return Rectangle
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param Rectangle $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @param Point $cellPosition
     * @return int
     */
    public function getLivingNeighborsCount(Point $cellPosition)
    {
        $aliveCounter = 0;

        $neighbors = [
            [1, -1],
            [0, -1],
            [1, -1],
            [-1, 0],
            [1, 0],
            [-1, 1],
            [0, 1],
            [1, 1],
        ];

        foreach ($neighbors as $neighborCoordinates) {
            $position = new Point(
                $cellPosition->getX() + $neighborCoordinates[0],
                $cellPosition->getY() + $neighborCoordinates[1]
            );

            if ($neighboorCell = $this->findCell($position)) {
                if ($neighboorCell->getIsAlive()) {
                    $aliveCounter++;
                }
            }
        }

        return $aliveCounter;
    }

    /**
     * @param Point $position
     * @return bool|Cell
     */
    public function findCell(Point $position)
    {
        if (isset($this->cells[$position->getX()][$position->getY()])) {
            return $this->cells[$position->getX()][$position->getY()];
        }

        return false;
    }
}