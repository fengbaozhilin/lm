<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>论坛首页</title>
    <link rel="stylesheet" href="/statics/index/css/reset.css"/>
    <link rel="stylesheet" href="/statics/index/css/public.css"/>
    <link rel="stylesheet" href="/statics/index/css/index.css"/>

    <link href="/statics/index/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/statics/index/css/common.css" />
    <script src="/statics/index/js/jquery.min.js"></script>
    <script src="/statics/index/js/bootstrap.min.js"></script>
    <script src="/statics/index/js/wangEditor.min.js"></script>
</head>
<body>

<div class="w_header">
    <div class="container">
        <div class="w_header_top">
            <a href="#" class="w_logo"></a>
            <span class="w_header_nav">
					<ul>
					            <li <?php if(!isset($_GET['filter'])) { ?> style="background-color: #ff4b68" <?php } ?>><a href="/">首页</a></li>


                        <?php if (isset($cates)) { ?>
                            <?php foreach ($cates as $key =>$cate) { ?>

                                <li <?php if(isset($_GET['filter']) && $_GET['filter'] == $cate['id']) { ?> style="background-color: #ff4b68" <?php } ?>><a href="?m=view&f=cate&filter=<?=$cate['id']?>"><?= $cate['name'] ?></a></li>
                            <?php } ?>
                        <?php } ?>
					</ul>
				</span>
            <div class="w_search" >
                <?php if(!session_id()){session_start();} ?>

                <?php if(isset($_SESSION['username'])) {?>

                    <div class="ltForm appear" style="width: 300px">
                        <ul>

                            <li><a href="?m=view&f=myArticle"><?=  $_SESSION['username']  ?></a></li>

                            <li><a href="?m=view&f=articlePut">发表文章</a></li>
                            <li><a href="?m=login&f=loginOut">注销</a></li>
                        </ul>
                    </div>

                <?php } else { ?>
                    <div class="ltForm appear">
                        <ul>

                            <li><a href="?m=view&f=login">登入</a></li>

                            <li><a href="?m=view&f=register">注册</a></li>
                        </ul>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>



