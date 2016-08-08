<?php

namespace AlexD\gol\core;

/**
 * Class Cell
 * This class represents single dead/live cell on the game grid
 * @package AlexD\gol\core
 */
class Cell
{

    /**
     * @var bool
     */
    private $isAlive = false;

    /**
     * @param bool $isAlive
     */
    public function __construct($isAlive = false)
    {
        $this->setIsAlive($isAlive);
    }

    /**
     * @return bool
     */
    public function getIsAlive()
    {
        return $this->isAlive;
    }

    /**
     * @param bool $isAlive
     */
    public function setIsAlive($isAlive)
    {
        $this->isAlive = $isAlive;
    }
}