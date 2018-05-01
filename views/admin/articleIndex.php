<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/statics/admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/statics/admin/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/statics/admin/css/style.css" />
    <script type="text/javascript" src="/statics/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/statics/admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="/statics/admin/js/ckform.js"></script>
    <script type="text/javascript" src="/statics/admin/js/common.js"></script>

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<body>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>文章id</th>
        <th>文章标题</th>
        <th>作者</th>
        <th>点击量</th>
        <th>发表时间</th>
        <th>管理操作</th>
    </tr>
    </thead>

    <?php foreach ($arrs as $arr)  { ?>
        <tr>
                <td><?= $arr['id'] ?></td>
                <td><?= $arr['name'] ?></td>
                <td><?= $arr['username'] ?></td>
                <td><?= $arr['hits'] ?></td>
                <td><?= $arr['created_at'] ?></td>
                <td><a href="?m=admin&f=articleEdit&article_id=<?= $arr['id']?>">编辑</a>
                    <a href="?m=admin&f=articleDelete&article_id=<?= $arr['id']?>">删除</a>
                </td>

            </tr>
    <?php } ?>
</table>

</body>
</html>
<script>
    $(function () {
        

		$('#addnew').click(function(){

				window.location.href="?m=admin&f=articleAdd";
		 });


    });
	
</script>