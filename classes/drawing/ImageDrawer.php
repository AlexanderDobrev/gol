<?php

namespace AlexD\gol\drawing;

use AlexD\gol\GameOfLife;
use AlexD\gol\geometry\Point;
use AlexD\gol\geometry\Rectangle;

/**
 * Class ImageDrawer
 * This class is responsible to draw
 * state of game of life as image
 * @package AlexD\gol\drawing
 */
class ImageDrawer implements GridDrawInterface
{
    const FORMAT_JPEG = 'jpg';
    const FORMAT_GIF = 'gif';
    const FORMAT_PNG = 'png';
    /**
     * @var $imageHandle resource
     */
    protected $imageHandle;
    /**
     * @var $filename string
     * Filename or stream
     */
    private $filename;
    /**
     * @var $zoom integer
     * Used for zooming the image
     */
    private $zoom;
    /**
     * @var $format string
     * Current selected format for output
     * must be choice between cons
     */
    private $format;

    /**
     * @param $filename
     * @param $format
     * @param int $zoom
     */
    public function __construct($filename, $format, $zoom = 1)
    {
        $this->setFilename($filename);
        $this->setFormat($format);
        $this->setZoom($zoom);
    }

    /**
     * @return mixed
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * @param mixed $zoom
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;
    }

    /**
     * Draws single state of Game of life as image
     * @param GameOfLife $gameOfLife
     */
    public function draw(GameOfLife $gameOfLife)
    {
        $gameOfLife->cycle();
        $size = $gameOfLife->getGrid()->getSize();
        $this->imageHandle = imagecreatetruecolor($size->getWidth(), $size->getHeight());
        imagefilledrectangle($this->imageHandle, 0, 0, $size->getWidth(), $size->getHeight(),
            GdColor::white($this->imageHandle));

        for ($x = $size->getX(); $x < $size->getWidth(); $x++) {
            for ($y = $size->getY(); $y < $size->getHeight(); $y++) {
                if ($gameOfLife->getGrid()->findCell(new Point($x, $y))->getIsAlive()) {
                    imagesetpixel($this->imageHandle, $x, $y, GdColor::black($this->imageHandle));
                }
            }
        }

        $this->zoom($size);
    }

    /**
     * @param Rectangle $size
     */
    private function zoom(Rectangle $size)
    {
        if (is_integer($this->zoom) && $this->zoom > 1) {

            $newWidth = $size->getWidth() * $this->zoom;
            $newHeight = $size->getHeight() * $this->zoom;
            $resizedHandle = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresampled($resizedHandle, $this->imageHandle, 0, 0, 0, 0, $newWidth, $newHeight, $size->getWidth(),
                $size->getHeight());
            $this->imageHandle = $resizedHandle;
        }
    }

    /**
     * Returns image contents as string
     * @return string
     */
    protected function getImageAsString()
    {
        ob_start();
        self::save('php://output');
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

    /**
     * Saves the image to file or stream
     * @param null $filename
     * @return mixed
     */
    public function save($filename = null)
    {
        $filename = $filename ? $filename : $this->getFilename();

        $format2SaveFunction = [
            self::FORMAT_JPEG => 'imagejpeg',
            self::FORMAT_GIF => 'imagegif',
            self::FORMAT_PNG => 'imagepng'
        ];

        if (isset($format2SaveFunction[$this->getFormat()])) {
            $saveFunction = $format2SaveFunction[$this->getFormat()];
            return $saveFunction($this->imageHandle, $filename);
        } else {
            throw new \RuntimeException('Unknown format');
        }
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }
}