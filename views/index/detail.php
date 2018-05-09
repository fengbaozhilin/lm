<?php include('header.php') ?>


    <div class="w_container">
        <div class="container">
            <div class="row w_main_row">

                <ol class="breadcrumb w_breadcrumb">
                    <li><a href="/">首页</a></li>
                    <li><a href="#"><?= $arr['cate_name'] ?></a></li>
                    <li class="active"><?= $arr['name'] ?></li>
                    <span class="w_navbar_tip">我们长路漫漫，只因学无止境。</span>
                </ol>

                <div class="col-lg-9 col-md-9 w_main_left">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2 class="c_titile"><?= $arr['name'] ?></h2>
                            <p class="box_c"><span class="d_time">发布时间：<?= $arr['created_at'] ?></span><span>&nbsp;&nbsp;编辑：<a href="mailto:wfyv@qq.com"><?= $arr['username'] ?></a></span><span>&nbsp;&nbsp;阅读（<?= $arr['hits'] ?>）</span></p>
                            <br><hr>
                            <ul class="infos">
                                <br>

                                <?= $arr['content'] ?>
                            </ul>



                        </div>
                    </div>


                    <?php foreach ($comment_arrs as $comment_arr) { ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="box_c"><span class="d_time">评论人：<?= $comment_arr['username'] ?></span><span class="d_time"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;评论时间：<?= $comment_arr['created_at'] ?></span></p>
                            <br>
                            <ul class="infos">
                                <?= $comment_arr['content'] ?>
                            </ul>



                        </div>
                    </div>
                    <?php } ?>

                    <h3 style="color: red">发表评论</h3>
                    <div class="reply-box form box-block">


                        <form method="POST" action="?m=view&f=detailReply" accept-charset="UTF-8" id="reply-form">
                            <input type="hidden" name="article_id" value="<?=$article_id?>">

                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 164px;" id="reply_content" name="contents" cols="50"></textarea>
                            </div>

                            <div class="form-group reply-post-submit">
                                <input class="btn btn-primary " id="reply-create-submit" type="submit" value="回复">

                            </div>

                            <div class="box preview markdown-reply" id="preview-box" style="display:none;"></div>

                        </form>
                    </div>

                </div>




                <div class="col-lg-3 col-md-3 w_main_right">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">最新发布</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled sidebar">
<?php foreach ($arrs as $arr) { ?>
                                <li><a href="?m=view&f=detail&article_id=<?=$arr['id']?>"><?= $arr['name'] ?></a></li>
    <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">友情链接</h3>
                        </div>
                        <div class="panel-body">
                            <div class="newContent">
                                <ul class="list-unstyled sidebar shiplink">
                                    <li><a href="https://www.baidu.com/" target="_blank">百度</a></li>
                                    <li><a href="https://www.oschina.net/" target="_blank">开源中国</a></li>
                                    <li><a href="http://www.ulewo.com/" target="_blank">有乐网</a></li>
                                    <li><a href="http://www.sina.com.cn/" target="_blank">新浪网</a></li>
                                    <li><a href="http://www.qq.com/" target="_blank">腾讯网</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include('footer.php') ?>