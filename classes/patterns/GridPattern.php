<?php

namespace AlexD\gol\patterns;

/**
 * Class GridPattern
 * Factory class used to generate patterns for the game grid
 * @package AlexD\gol\patterns
 */
class GridPattern
{

    /**
     * Generates random pattern
     * @param $xLen
     * @param $yLen
     * @return array
     */
    public static function createRandom($xLen, $yLen, $randomFactor = 52)
    {
        $result = [];

        for ($i = 0; $i < $xLen; $i++) {
            for ($j = 0; $j < $yLen; $j++) {
                $random = mt_rand(0, 100000);
                $result[$i][$j] = ($random % $randomFactor == 0);
            }
        }

        return $result;
    }
}