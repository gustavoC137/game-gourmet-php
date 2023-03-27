<?php
//require "Prompt.php";
spl_autoload_register(function($class){
    require "$class.php";
});

$dishesArr = require "dishesDefault.php";
$propertyTreeNodeArr = require "propertyTreeNodeDefault.php";


$prompt = new Prompt(9, $dishesArr, $propertyTreeNodeArr);
$prompt->start();