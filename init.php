<?php

error_reporting(0);//关闭错误提示

define('ROOT',__DIR__);

function __autoload($className){
    require ROOT.'/controllers/'.$className.'.class.php';//自动加载，不用include文件，实例化的时候可以自动加载

}

