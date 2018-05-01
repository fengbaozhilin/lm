<?php

use controllers\controller;

include('base.class.php');


class admin extends base
{

    public function login()

    {
        $this->render('login','admin');
    }

    public function index()
    {

        $this->loginInfo();

        $this->render('index','admin');

    }

    //TODO 用户
    public function userIndex()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $sql = "Select id,username,password FROM users";

        $arrs = $controller->getArr($sql);

        $this->assign('arrs',$arrs);

        $this->render('userIndex','admin');
    }

    public function userAdd()

    {
        $this->loginInfo();

        $this->render('userAdd','admin');
    }

    public function userEdit()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $user_id = $_GET['user_id'];

        $sql = "Select id,username,password FROM users where id = '$user_id' limit 1";

        $arrs = $controller->getArr($sql);

        $this->assign('arr',$arrs[0]);

        $this->render('userEdit','admin');
    }

    public function editUser()
    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $username = $_POST['username'];

        $password = $_POST['password'];

        $id = $_POST['id'];

        $controller->db_update('users',['username'=>$username,'password'=>$password],"id = $id");

        echo '<script>alert("更新成功");window.history.go(-1)</script>';

    }
    public function userDelete()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $user_id =  $_GET['user_id'];

        $controller->db_deleteone('users',['id'=>$user_id]);

        echo '<script>alert("删除成功");window.history.go(-1)</script>';

    }

    //TODO 分类

    public function cateIndex()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $sql = "Select id,name FROM categorys";

        $arrs = $controller->getArr($sql);

        $this->assign('arrs',$arrs);

        $this->render('cateIndex','admin');
    }


    public function cateAdd()

    {
        $this->loginInfo();

        $this->render('cateAdd','admin');
    }

    public function addCate()
    {

        if(empty($_POST['name'])){
            echo '<script>alert("分类名不能为空");window.history.go(-1)</script>';
        }else{
            $name = $_POST['name'];

            $sql = "SELECT id from categorys WHERE name = '$name'";

            $controller = Controller::getInstance();

            $result = $controller->query($sql);

            $rows = mysqli_num_rows($result);

            if ($rows > 0) {
                echo '<script> alert("分类名已经存在");window.history.go(-1) </script>';
            } else {

                try {

                    $controller->db_insert('categorys', ['name' => $name]);

                } catch (\Exception $e) {

                    echo '<script> alert("失败");window.history.go(-1) </script>';

                }

                echo '<script> alert("添加成功");window.history.go(-1) </script>';

            }
        }
    }

    public function cateEdit()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $id = $_GET['cate_id'];

        $sql = "Select id,name FROM categorys where id = '$id' limit 1";

        $arrs = $controller->getArr($sql);

        $this->assign('arr',$arrs[0]);

        $this->render('cateEdit','admin');
    }

    public function editCate()
    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $name = $_POST['name'];

        $id = $_POST['id'];

        $controller->db_update('categorys',['name'=>$name],"id = $id");

        echo '<script>alert("更新成功");window.history.go(-1)</script>';

    }
    public function cateDelete()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $cate_id =  $_GET['cate_id'];

        $controller->db_deleteone('categorys',['id'=>$cate_id]);

        echo '<script>alert("删除成功");window.history.go(-1)</script>';

    }




    //TODO 文章
    public function articleIndex()

    {
        $this->loginInfo();


        $controller = Controller::getInstance();

        $sql = "Select articles.id,articles.user_id,articles.name,articles.content,articles.created_at,articles.hits,users.id as user_id,users.username  FROM articles,users WHERE articles.user_id = users.id";

        $arrs = $controller->getArr($sql);

        $this->assign('arrs',$arrs);

        $this->render('articleIndex','admin');
    }



    public function articleEdit()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $id = $_GET['article_id'];

        $sql = "Select id,name,content FROM articles where id = '$id' limit 1";

        $arrs = $controller->getArr($sql);

        $this->assign('arr',$arrs[0]);


        $this->render('articleEdit','admin');
    }


    public function articleAjax()
    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        if (empty($_POST['name']) || empty($_POST['content'])) {

            echo json_encode(['code' => 100]);

        } else{

            $id =$_POST['id'];

            $controller->db_update('articles',['name'=>$_POST['name'],'content'=>$_POST['content']],"id=$id");

            echo json_encode(['code' => 200]);
        }


    }


    public function articleDelete()

    {
        $this->loginInfo();

        $controller = Controller::getInstance();

        $id =  $_GET['article_id'];

        $controller->db_deleteone('articles',['id'=>$id]);

        echo '<script>alert("删除成功");window.history.go(-1)</script>';

    }




    //TODO 登陆
    public function loginCheck()

    {
        $this->loginInfo();

        if(empty($_POST['username']) || empty($_POST['password']))
        {
            echo '<script>alert("请填写完整");window.history.go(-1)</script>';
        }else{

            if($_POST['usernmae'] !== 'admin' && $_POST['password'] !== 'admin')
            {
                echo '<script>alert("账号或者密码错误");window.history.go(-1)</script>';
            }
            else {
                session_start();
                $_SESSION['admin_login']  = 1;
                echo '<script> window.location.href="?m=admin&f=index"</script>';
            }

        }

    }


    public function loginOut()
    {
        $this->loginInfo();

        if(!session_id()){session_start();}

        unset($_SESSION['admin_login']);

        echo '<script>alert("注销成功");window.location.href="?m=admin&f=login"</script>';
    }

    public function loginInfo(){

        if(!session_id()){session_start();}

        if(!isset($_SESSION['admin_login'])){

            echo '<script>alert("请先登陆");window.location.href="?m=admin&f=login"</script>';
        }else{

        }

    }


}