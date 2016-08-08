<?php

namespace AlexD\gol\drawing;

use AlexD\gol\GameOfLife;

interface GridDrawInterface
{

    function draw(GameOfLife $gameOfLife);
}