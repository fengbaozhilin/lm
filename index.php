<?php
define('ROOT',__DIR__);
function __autoload($className){
    require ROOT.'/controllers/'.$className.'.class.php';
}

