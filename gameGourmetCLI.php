<?php
require __DIR__.'/vendor/autoload.php';

use App\Game;
use App\UserDialogCLIBasic;

$dishesArr = require "app/dishesDefault.php";
$propertyTreeNodeArr = require "app/propertyTreeNodeDefault.php";

$userDialog = new UserDialogCLIBasic();
$game = new Game($userDialog, $dishesArr, $propertyTreeNodeArr);
$game->start();