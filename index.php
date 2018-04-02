<?php
error_reporting(0);
function __autoload($className){
    require './controllers/'.$className.'.class.php';
}

$test = new  login();

var_dump($test);