<?php
include('../init.php');

use controllers\controller;

include('controller.class.php');

class base
{

    public $variables = array();



    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }


    public function render($view,$m=null)
    {
        extract($this->variables);

        //默认为index，有第二个值为admin
        if(!isset($m)) {

            $controllerLayout = ROOT . '/views/index/' . $view . '.php';

            //判断视图文件是否存在
            if (is_file($controllerLayout)) {

                include($controllerLayout);

            } else {

                if (is_file($controllerLayout = ROOT . '/views/index/' . $view . '.html')) {

                    include($controllerLayout);

                } else {

                    echo "<h1>无法找到该页面</h1>";


                }


            }

        }else{

            $controllerLayout = ROOT . '/views/' . $m . '/' . $view . '.php';

            //判断视图文件是否存在
            if (is_file($controllerLayout)) {

                include($controllerLayout);

            } else {

                if (is_file($controllerLayout = ROOT . '/views/' . $m . '/' . $view . '.html')) {

                    include($controllerLayout);

                } else {

                    echo "<h1>无法找到该页面</h1>";


                }


            }

        }



    }


}