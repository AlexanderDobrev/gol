<?php

namespace AlexD\gol\drawing;

use AlexD\gol\GameOfLife;
use GifCreator\GifCreator;

/**
 * Class AnimatedGifDrawer
 * This class is resposible for drawing animation with
 * Game of life states.
 * @package AlexD\gol\drawing
 */
class AnimatedGifDrawer extends ImageDrawer
{

    /**
     * @var int $frameAmount
     * Amount of game cycles/gif frames that will be generated
     */
    private $frameAmount = 5;
    /**
     * @var GifCreator
     */
    private $gifCreator;

    /**
     * @param $filename
     * @param int $zoom
     * @param int $frameAmount
     */
    public function __construct($filename, $zoom = 1, $frameAmount = 5)
    {
        $this->setFrameAmount($frameAmount);
        $this->gifCreator = new GifCreator();

        parent::__construct($filename, self::FORMAT_GIF, $zoom);
    }

    /**
     * @return int
     */
    public function getFrameAmount()
    {
        return $this->frameAmount;
    }

    /**
     * @param int $frameAmount
     */
    public function setFrameAmount($frameAmount)
    {
        $this->frameAmount = $frameAmount;
    }

    /**
     * Draws animated gif image using parents
     * draw method to generate single gif image used as
     * a frame for the animation
     * @param GameOfLife $gameOfLife
     * @throws \Exception
     */
    public function draw(GameOfLife $gameOfLife)
    {
        $frameContents = [];

        for ($i = 0; $i < $this->frameAmount; $i++) {
            parent::draw($gameOfLife);
            $frameContents[] = parent::getImageAsString();
        }

        $this->gifCreator->create($frameContents, array_fill(0, sizeof($frameContents), 300));
    }

    /**
     * Saves the animation to file or stream
     * @param null $filename
     */
    public function save($filename = null)
    {
        $filename = $filename ? $filename : $this->getFilename();
        file_put_contents($filename, $this->gifCreator->getGif());
    }
}