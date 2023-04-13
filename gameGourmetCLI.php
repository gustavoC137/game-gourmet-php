<?php
require __DIR__.'/vendor/autoload.php';

use App\Game;

$dishesArr = require "app/dishesDefault.php";
$propertyTreeNodeArr = require "app/propertyTreeNodeDefault.php";

$prompt = new Game(9, $dishesArr, $propertyTreeNodeArr);
$prompt->start();