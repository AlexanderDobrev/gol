<?php

namespace AlexD\gol\geometry;

/**
 * Class Rectangle
 * This class represents grid sizes
 * @package AlexD\gol\geometry
 */
class Rectangle extends Point
{

    private $width;
    private $height;

    public function __construct($x, $y, $width, $height)
    {
        parent::__construct($x, $y);
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param integer $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param integer $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }
}