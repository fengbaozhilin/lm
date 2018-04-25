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

            if(is_file($controllerLayout = ROOT . '/views/index/' . $view . '.html')){

                include($controllerLayout);

            }else{

                echo "<h1>无法找到该页面</h1>";


            }


        }


    }

    public function index()
    {


        $controller =  Controller::getInstance();

        $sql = "select articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.nickname,users.avatar from   articles,users WHERE articles.user_id = users.id order BY created_at DESC ";

        if(isset($_GET['filter']) && $_GET['filter']='hits'){

            $sql = "select articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.nickname,users.avatar from   articles,users WHERE articles.user_id = users.id order BY hits DESC ";

        }

        $row = array();

        $result = $controller->query($sql);


        $arrs= [];


        while($row = mysqli_fetch_array($result)){

         $arrs[] = $row;

        }



        $sql_hits = "select id,name  from  articles ORDER BY hits desc limit 3";

        $row_hits = array();

        $result_hits = $controller->query($sql_hits);

        $arrs_hits= [];

        while($row_hits = mysqli_fetch_array($result_hits)){

            $arrs_hits[] = $row_hits;

        }

        $this->assign('arrs', $arrs);

        $this->assign('hits', $arrs_hits);

        $this->render('index');


    }

    public function login()
    {

        $this->render('login');

    }

    public function error_404()
    {

        $this->render('404');

    }


}