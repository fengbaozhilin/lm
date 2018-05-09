<?php

namespace controllers;
class controller
{

    private $host = 'localhost'; //数据库主机
    private $name = 'root'; //数据库用户名
    private $pwd = ''; //数据库用户名密码
    private $dBase = 'lm'; //数据库名
    private $charset = 'utf8'; //数据库编码，GBK,UTF8,gb2312
    private $conn;             //数据库连接标识;
    private $rows;             //查询获取的多行数组
    static $_instance; //存储对象
    protected $variables = array();
    private $result;

    /**
     * 构造函数
     * 私有
     */
    private function __construct($host = '', $name = '', $pwd = '', $dBase = '')
    {
        if ($host != '')
            $this->host = $host;
        if ($name != '')
            $this->name = $name;
        if ($pwd != '')
            $this->pwd = $pwd;
        if ($dBase != '')
            $this->dBase = $dBase;

        $this->conn = new \mysqli($this->host, $this->name, $this->pwd, $this->dBase);
        $this->conn->query("set names 'utf8'");

        return $this->conn;
    }

    //重写clone防止用户进行clone
    public function __clone()
    {
        //当用户clone操作时产生一个错误信息
        trigger_error("Can't clone object", E_USER_ERROR);
    }

    //由类的自身来进行实例化
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function query($sql)
    {

        $this->result = mysqli_query($this->conn, $sql);

        return $this->result;
    }



    public function db_deleteone($table, $where){
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

         $controller->query($sql);

        $id = mysqli_insert_id($this->conn);

        return $id;

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

        if (!$result) {
            $a =  mysqli_error($this->conn);
           return $a;
        }

        $arrs= [];


        while($row = mysqli_fetch_array($result)){

            $arrs[] = $row;

        }
        return $arrs;

    }


    /**判断登陆
     * @return bool
     */
    public function loginInfo(){

 if(!session_id()){session_start();}

        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }


    public function getArr($sql){


        $result = $this->query($sql);


        $arrs= [];


        while($row = mysqli_fetch_array($result)){

            $arrs[] = $row;

        }

        return $arrs;

    }




}


