<?php

namespace AlexD\gol\drawing;


/**
 * Class GdColor
 * @package AlexD\gol\drawing
 * This class is used as color pallete
 * for image drawing
 */
class GdColor
{

    /**
     * Returns black color
     * @param $image
     * @return int
     */
    public static function black($image)
    {
        return imagecolorallocate($image, 0, 0, 0);
    }

    /**
     * Returns white color
     * @param $image
     * @return int
     */
    public static function white($image)
    {
        return imagecolorallocate($image, 255, 255, 255);
    }
}