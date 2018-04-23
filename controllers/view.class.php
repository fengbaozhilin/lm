<?php

include('../init.php');
use controllers\controller;
include ('controller.class.php');
class view
{

    public $variables = array();

//    public  function __construct()
//    {
//       $a = controller::getInstance();
//       var_dump($a->query('select * from USERS '));
//    }

    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }


    public function render($view)
    {
        extract($this->variables);

        $controllerLayout = ROOT . '/views/index/' . $view . '.php';

        //判断视图文件是否存在
        if (is_file($controllerLayout)) {

            include($controllerLayout);

        } else {

            echo "<h1>无法找到该页面</h1>";

        }


    }

    public function index()
    {

        $a = '黄智健';

        $controller =  Controller::getInstance();

        $sql = "select articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.nickname from   articles,users WHERE articles.user_id = users.id";

        $row = array();

        $result = $controller->query($sql);

        $arrs= [];

        while($row = mysqli_fetch_array($result)){

         $arrs[] = $row;

        }
//
        print_r($arrs);
//        $this->assign('arrs', $arrs);
//
//        $this->render('index');


    }

    public function login()
    {
        $a = '黄智健牛逼';
        $this->assign('a', $a);
        $this->render('login');

    }

    public function error_404()
    {

        $this->render('404');

    }


}