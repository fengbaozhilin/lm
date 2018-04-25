<?php
include('../init.php');
use controllers\controller;
include ('controller.class.php');
class login
{
    public function loginCheck(){

        var_dump($_POST['password']);
    }



    public function registerCheck(){
        if($_POST['username'] == ''|| $_POST['password'] == ''){
           echo '<script> alert("请填写完整信息") </script>';
        }
        else{
           try{
               $sql="Insert into users ('username','password') VALUES ('username','password')";

                    $controller =  Controller::getInstance();

               $controller->query($sql);
           }catch (\Exception $e){
               echo '<script> alert("失败"); </script>';
           }
           echo  '233';
        }
    }
}