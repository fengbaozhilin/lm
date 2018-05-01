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
<form class="form-inline definewidth m20" action="" method="get">
   <button type="button" class="btn btn-success" id="addnew">新增分类</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>分类id</th>
        <th>分类名称</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php foreach ($arrs as $arr) { ?>
	     <tr>
            <td><?= $arr['id'] ?></td>
            <td><?= $arr['name'] ?></td>
            <td>
                <a href="?m=admin&f=cateEdit&cate_id=<?=$arr['id']?>">编辑</a>
                <a href="?m=admin&f=cateDelete&cate_id=<?=$arr['id']?>">删除</a>
            </td>
        </tr>

    <?php } ?>
</table>
</body>
</html>
<script>
    $(function () {


		$('#addnew').click(function(){

				window.location.href="?m=admin&f=cateAdd";
		 });


    });


</script>