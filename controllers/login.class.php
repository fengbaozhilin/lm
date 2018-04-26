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

           echo '<script> alert("请填写完整信息");window.history.go(-1) </script>';
        }
        else{

            $sql='SELECT * from user WHERE username = '.$_POST['username'].'';

            $controller =  Controller::getInstance();

            $result = $controller->query($sql);

            $arrs= [];


            while($row = mysqli_fetch_array($result)){

                $arrs[] = $row;

            }
             ;
            if(count($arrs)==0){
                echo '<script> alert("用户名重复");window.history.go(-1) </script>';
            }

           try{

               $this->db_insert('users',['username'=>$_POST['username'],'password'=>$_POST['password']]);


           }catch (\Exception $e){
               echo '<script> alert("失败");window.history.go(-1) </script>';
           }
           echo  '233';
        }
    }



    public function db_deleteone($table, $where,$www,$mes='删除成功'){
        if(is_array($where)){
            foreach ($where as $key => $val) {
                $condition = $key.'='.$val;
            }
        } else {
            $condition = $where;
        }

        $sql = "delete from $table where $condition";

        $controller =  Controller::getInstance();

        $result = $controller->query($sql);

        $arrs= [];


        while($row = mysqli_fetch_array($result)){

            $arrs[] = $row;

        }
        return $arrs;
    }



    /*添加函数*/

    public function db_insert($table,$data){
        //遍历数组，得到每一个字段和字段的值
        $key_str='';
        $v_str='';

        foreach($data as $key=>$v){
            if(empty($v)){
                die("error");
            }
            //$key的值是每一个字段s一个字段所对应的值
            $key_str.=$key.',';
            $v_str.="'$v',";
        }

        $key_str=trim($key_str,',');
        $v_str=trim($v_str,',');
        //判断数据是否为空
        $sql="insert into $table ($key_str) values ($v_str)";

        $controller =  Controller::getInstance();

        $result = $controller->query($sql);

        $arrs= [];


        while($row = mysqli_fetch_array($result)){

            $arrs[] = $row;

        }
        return $arrs;

    }

    /**
     * [修改操作description]
     * @param [type] $table [表名]
     * @param [type] $data [数据]
     * @param [type] $where [条件]
     * @return [type]
     */
    public function db_update($table,$data,$where){
        //遍历数组，得到每一个字段和字段的值
        $str='';
        foreach($data as $key=>$v){
            $str.="$key='$v',";
        }
        $str=rtrim($str,',');
        //修改SQL语句
        $sql="update $table set $str where $where";

        $controller =  Controller::getInstance();

        $result = $controller->query($sql);

        $arrs= [];


        while($row = mysqli_fetch_array($result)){

            $arrs[] = $row;

        }
        return $arrs;

    }



}