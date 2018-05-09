<?php

use controllers\controller;

include('base.class.php');

class view extends base
{

//前台首页页面
    public function index()
    {


        $controller = Controller::getInstance();

        //查询文章信息

        $sql = "select articles.id,  articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.username,users.avatar,users.id AS user_id  ,categorys.name AS cate_name from   articles,users ,categorys WHERE articles.user_id = users.id AND  articles.cate_id =  categorys.id order BY created_at DESC limit 7";


        $arrs = $controller->getArr($sql);


        $sql_hits = "select id,name  from  articles ORDER BY hits desc limit 3";


        $arrs_hits = $controller->getArr($sql_hits);

        $sql_cate = "select id,name from categorys";

        $arrs_cate = $controller->getArr($sql_cate);

        $this->assign('arrs', $arrs);

        $this->assign('hits', $arrs_hits);

        $this->assign('cates', $arrs_cate);

        $this->render('index');


    }
//前台登陆页面
    public function login()
    {

        $this->render('login');

    }
//前台注册页面
    public function register()
    {

        $this->render('register');

    }
//前台错误页面
    public function error_404()
    {

        $this->render('404');

    }

//前台分类页面
    public function cate()
    {

        if (isset($_GET['filter'])) {

            $filter = $_GET['filter'];

            $controller = Controller::getInstance();

            //查询文章信息

            $sql = "select articles.id,  articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.username,users.avatar,users.id AS user_id  ,categorys.name AS cate_name from   articles,users ,categorys WHERE articles.user_id = users.id AND  articles.cate_id =  categorys.id  AND categorys.id = '$filter' order BY created_at DESC ";


            $arrs = $controller->getArr($sql);


            $sql_hits = "select id,name  from  articles ORDER BY hits desc limit 3";


            $arrs_hits = $controller->getArr($sql_hits);

            $sql_cate = "select id,name from categorys";

            $arrs_cate = $controller->getArr($sql_cate);

            $this->assign('arrs', $arrs);

            $this->assign('hits', $arrs_hits);

            $this->assign('cates', $arrs_cate);

            $this->render('cate');
        } else {

        }
    }
//前台文章详情页面
    public function detail()
    {

        if (isset($_GET['article_id'])) {


            $artilce_id = urldecode($_GET['article_id']);

            $sql = "select   articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.username,users.id AS user_id  ,categorys.name AS cate_name from   articles,users ,categorys WHERE  articles.id = '$artilce_id' AND articles.user_id = users.id AND  articles.cate_id =  categorys.id limit 1";

            $controller = Controller::getInstance();

            $arrs = $controller->getArr($sql);

            $arr = $arrs[0];

            $comment_arr = "select comments.id,comments.user_id,comments.content,comments.created_at,users.username from comments,users WHERE comments.article_id = '$artilce_id' AND comments.user_id = users.id";

            $comment_arrs = $controller->getArr($comment_arr);

            $sql_cate = "select id,name from categorys";

            $arrs_cate = $controller->getArr($sql_cate);


//计算点击量
            if (isset($_SERVER['REMOTE_ADDR'])) {


                $table = 'articles';
                $hits = $arr['hits'] + 1;
                $data = array('hits' => $hits);
                $where = "id = '$artilce_id' ";
                $controller->db_update($table, $data, $where);

            }
            $this->assign('article_id', $artilce_id);

            $this->assign('arr', $arr);

            $this->assign('comment_arrs', $comment_arrs);

            $this->assign('cates', $arrs_cate);

            $this->render('detail');
        } else {

        }


    }

//前台文章上传页面
    public function articlePut()
    {
        $controller = Controller::getInstance();

        $sql_cate = "select id,name from categorys";

        $arrs_cate = $controller->getArr($sql_cate);

        $this->assign('cates', $arrs_cate);

        $this->render('articlePut');
    }

//前台文章上传
    public function articleAjax()
    {
        $controller = Controller::getInstance();

        if ($controller->loginInfo()) {

            $user_id = $_SESSION['user_id'];

            if (empty($_POST['cate_id']) || empty($_POST['title']) || empty($_POST['a_content'])) {

                echo json_encode(['code' => 100]);

            } else {

             $a=    $controller->db_insert('articles', ['user_id' => $user_id, 'cate_id' => $_POST['cate_id'], 'name' => $_POST['title'], 'content' => $_POST['a_content'], 'created_at' => date('Y-m-d H:i:s', time())]);

                echo json_encode(['code' => 200,'aa'=>$a]);
            }
        } else {
            echo json_encode(['code' => 300]);
        }
    }


    //我的文章
    public function myArticle()
    {

        $controller = Controller::getInstance();

        if ($controller->loginInfo()) {

            $user_id = $_SESSION['user_id'];

            $sql = "select * from articles where user_id = '$user_id' ";

            $arrs = $controller->getArr($sql);

            $sql_cate = "select id,name from categorys";

            $arrs_cate = $controller->getArr($sql_cate);

            $this->assign('arrs', $arrs);

            $this->assign('cates', $arrs_cate);

            $this->render('my');
        } else {
            echo '<script> alert("请先登录");window.location.href="?m=view&f=login" </script>';
        }


    }
//前台文章回复
    public function detailReply()
    {
        $controller = Controller::getInstance();

        if ($controller->loginInfo()) {

            if (empty($_POST['contents']) || empty($_POST['article_id'])) {

                echo '<script> alert("内容不能为空");window.location.reload(); </script>';

            }else{

                $user_id = $_SESSION['user_id'];

                $time = date('Y-m-d H:i:s',time());

                $controller->db_insert('comments',['article_id'=>$_POST['article_id'],'user_id'=>$user_id,'content'=>$_POST['contents'],'created_at'=>$time,'updated_at'=>$time]);

                echo '<script> alert("评论成功");window.history.go(-1); </script>';
            }



        } else {
            echo '<script> alert("请先登录");window.location.href="?m=view&f=login" </script>';
        }
    }

//前台搜索结果页面
    public function search()
    {
        if (isset($_POST['search'])) {

            $filter = $_POST['search'];

            $controller = Controller::getInstance();

            //查询文章信息

            $sql = "select articles.id,  articles.user_id,articles.cate_id , articles.name ,articles.content ,articles.hits,articles.created_at ,users.username,users.avatar,users.id AS user_id  ,categorys.name AS cate_name from   articles,users ,categorys WHERE articles.name LIKE '%".$filter."%' AND articles.user_id = users.id AND  articles.cate_id =  categorys.id  order BY created_at DESC ";


            $arrs = $controller->getArr($sql);


            $sql_hits = "select id,name  from  articles ORDER BY hits desc limit 3";


            $arrs_hits = $controller->getArr($sql_hits);

            $sql_cate = "select id,name from categorys";

            $arrs_cate = $controller->getArr($sql_cate);

            $this->assign('arrs', $arrs);

            $this->assign('hits', $arrs_hits);

            $this->assign('cates', $arrs_cate);

            $this->render('cate');
        } else {

        }
    }
//前台编辑用户密码页面
    public function editMy()
    {
        $controller = Controller::getInstance();

        if ($controller->loginInfo()) {

            $user_id = $_SESSION['user_id'];

            $sql = "select * from users where id = '$user_id' limit 1";

            $arrs = $controller->getArr($sql);

            $arr = $arrs[0];

            $sql_cate = "select id,name from categorys";

            $arrs_cate = $controller->getArr($sql_cate);

            $this->assign('arr', $arr);

            $this->assign('cates', $arrs_cate);

            $this->render('editUser');



        } else {
            echo '<script> alert("请先登录");window.location.href="?m=view&f=login" </script>';
        }
    }


    //前台编辑用户密码功能
    public function editUser()

    {

        $controller = Controller::getInstance();

        if($controller->loginInfo())

        {

            $password = $_POST['password'];

            $id = $_POST['id'];

            $controller->db_update('users',['password'=>$password],"id = $id");

            echo '<script>alert("更新成功");window.history.go(-1)</script>';


        }else{

        }

    }





}