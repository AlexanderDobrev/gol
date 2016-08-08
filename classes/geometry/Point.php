<?php

namespace AlexD\gol\geometry;


/**
 * Class Point
 * Used to determine cell position
 * @package AlexD\gol\geometry
 */
class Point
{
    /**
     * @var $x integer
     */
    private $x;

    /**
     * @var $y integer
     */
    private $y;

    public function __construct($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param integer $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param integer $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }
}