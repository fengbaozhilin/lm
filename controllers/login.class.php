<?php
include('../init.php');
use controllers\controller;
include ('controller.class.php');
class login
{
    public function loginCheck(){

        $username = $_POST['username'] ;
        $password = $_POST['password'] ;

        if($username == ''|| $password == ''){

            echo '<script> alert("请填写完整信息");window.history.go(-1) </script>';
        }else{

            $sql = "select id,username from users WHERE username = '$username' AND password = '$password' limit 1";

            $controller = Controller::getInstance();

            $result = $controller->query($sql);

            if (mysqli_num_rows($result) > 0 ){

                $arrs= [];

                while($row = mysqli_fetch_array($result)){

                    $arrs[] = $row;

                }

                session_start();

                $_SESSION['username'] = $arrs[0]['username'];

                $_SESSION['user_id']  = $arrs[0]['id'];

                echo '<script> alert("登陆成功");window.location.href="/" </script>';
            }else{
                echo '<script> alert("账号或者密码错误");window.history.go(-1) </script>';
            }

        }

    }



    public function registerCheck(){

        if($_POST['username'] == ''|| $_POST['password'] == ''){

           echo '<script> alert("请填写完整信息");window.history.go(-1) </script>';
        }
        else {

            $username = $_POST['username'];

            $sql = "SELECT id from users WHERE username = '$username'";

            $controller = Controller::getInstance();

            $result = $controller->query($sql);

            $rows = mysqli_num_rows($result);

            if ($rows > 0) {
                echo '<script> alert("用户名已经存在");window.history.go(-1) </script>';
            } else {

                try {


                    $user_id = $controller->db_insert('users', ['username' => $_POST['username'], 'password' => $_POST['password']]);


                } catch (\Exception $e) {

                    echo '<script> alert("失败");window.history.go(-1) </script>';

                }


                session_start();

                $_SESSION['username'] = $_POST['username'];

                $_SESSION['user_id'] = $user_id;

                echo '<script> alert("注册成功");window.history.go(-1) </script>';

            }
        }
    }



    public function loginOut(){

        session_start();

       unset($_SESSION['user_id']);

       unset($_SESSION['username']);

        echo '<script> alert("注销成功");window.location.href="/" </script>';

    }





}