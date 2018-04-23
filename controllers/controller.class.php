<?php

namespace controllers;
class controller
{

    private $host = 'localhost'; //数据库主机
    private $name = 'root'; //数据库用户名
    private $pwd = ''; //数据库用户名密码
    private $dBase = 'game'; //数据库名
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
        $this->conn->query("set character set 'utf8'");

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

    public function test()
    {

        return '123';
    }


}


