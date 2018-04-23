<?php
/**
 * 入口文件
 */
  error_reporting(0);
  define('ROOT',__DIR__);

  function __autoload($className)
  {
    include ROOT . '/controllers/' . $className . '.class.php';
  }

  if($_GET['f'] && $_GET['m']){          //方法名，通过url获得。在view类下

        $f= $_GET['f'];

        $m= $_GET['m'];

        if(class_exists($m) && method_exists($m,$f)){

                $index = new $m();

                $index->$f();


        }else{
            $index = new view();

            $index->error_404();
        }

  } else{

        $index = new view();

        $index->index();

        }