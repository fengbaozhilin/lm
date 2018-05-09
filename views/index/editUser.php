<?php include('header.php') ?>



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
<body style="background-color: #fff2f6">

<form action="?m=view&f=editUser" method="post" class="definewidth m20" style="padding-top: 300px">
    <h2>编辑密码</h2>
    <input type="hidden" name="id" value="<?= $arr['id'] ?>" />
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">登录名</td>
            <td><input type="text" disabled="disabled" name="username" value="<?= $arr['username'] ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">密码</td>
            <td><input type="text" name="password" value="<?= $arr['password'] ?>"/></td>
        </tr>

        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">确认编辑</button>
            </td>
        </tr>
    </table>
</form>

<script>
    $(function () {
        $('#backid').click(function(){
            window.location.href="{:U('User/index')}";
        });

    });
</script>
<?php include('footer.php') ?>
