<?php
use AlexD\gol\core\Grid;
use AlexD\gol\drawing\AnimatedGifDrawer;
use AlexD\gol\GameOfLife;
use AlexD\gol\patterns\GridPattern;

include "config.php";

$grid = Grid::createFromPattern(GridPattern::createRandom(50, 50));


header('Content-type:image/gif');

$drawer = new AnimatedGifDrawer('php://output', 5, 20);
$gol = new GameOfLife($grid);
$drawer->draw($gol);
$drawer->save();