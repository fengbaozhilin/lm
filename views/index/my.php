<?php include ('header.php') ?>
<div class="w_container">
<div class="panel panel-default" style="margin-top: 50px">


    <div class="panel-body">
        <div class="panel-heading">
            <h3 class="panel-title">我的文章</h3>
        </div>
        <!--文章列表开始-->
        <div class="contentList">


            <?php foreach ($arrs as $key => $arr) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h4><a class="title" href="?m=view&f=detail&article_id=<?= ($arr['id']) ?>"><?= $arr['name'] ?></a>
                        </h4>
<!--                        <p>-->
<!--                            <a class="label label-default">--><?//= $arr['cate_name'] ?><!--</a>-->
<!---->
<!--                        </p>-->
                        <p><span class="count">
                            <span class="count"> <img src="/statics/index/img/star-off.png">阅读:<?= $arr['hits'] ?></span><span
                                class="count">
                                                <span class="count"> <img src="/statics/index/img/star-off.png"><?= $arr['created_at'] ?></span>
                        </p>

                    </div>
                </div>
            <?php } ?>


        </div>
        <!--文章列表结束-->

    </div>
</div>
</div>

<?php include ('footer.php') ?>
