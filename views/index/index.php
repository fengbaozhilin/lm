<?php include('header.php') ?>
    <div class="indexMain">
        <div class="indexMain_left">
            <div class="indexMain_left_btn">
                <ul>
                    <li><a href="javascript:" class="on">最新</a></li>
                    <li><a href="javascript:">热度</a></li>
                </ul>
            </div>
            <div class="indexMain_left_con">

                <?php foreach ($arrs as $k => $arr) { ?>


                    <div class="indexCon_msg">
                        <div class="indexCon_msg_pic"><img src="<?= $arr['avatar'] ?>"></div>
                        <div class="indexCon_msg_detail">
                            <a href="">
                                <div class="indexCon_msg_detail_tittle">
                                    <span>PHP</span>
                                    <p><?= $arr['name'] ?></p>
                                </div>
                            </a>
                            <div class="indexCon_msg_detail_other">
                                <ul>
                                    <li><?= $arr['nickname'] ?></li>
                                    <li><?= $arr['created_at'] ?></li>
                                    <li><?= $arr['hits'] ?></li>
                                    <li>28</li>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                <?php } ?>


            </div>
            <div class="indexFooter">
                <div class="indexFooter_con">
                    <a href="javascript:"><</a>
                    <a href="" class="on">1</a>
                    <a href="">2</a>
                    <a href="">3</a>
                    <a href="javascript:">></a>
                </div>
            </div>
        </div>
        <div class="indexMain_right">
            <div class="indexMain_rightCon">
                <a href="" class="newMsg">发新帖</a>
                <!--<div class="pwfb">-->
                <!--<div class="pwfbHead">-->
                <!--拍王发布-->
                <!--</div>-->
                <!--<div class="pwfbCon"></div>-->
                <!--<div class="pwfbFooter"></div>-->
                <!--</div>-->
                <div class="indexSearch">
                    <input type="text" placeholder="请输入关键词"/>
                    <input type="submit" value="搜索"/>
                </div>
                <div class="indexPublic">
                    <div class="indexPublic_head">
                        热议
                    </div>
                    <div class="indexPublic_con">
                        <ul class="weekHot">
                            <?php foreach ($hits as $k => $hit) { ?>
                                <li><a href=""><?=$hit['name']?></a><span></span></li>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="indexPublic">
                    <div class="indexPublic_head">
                        友情链接
                    </div>
                    <div class="indexPublic_con">
                        <ul class="indexLink">
                            <li><a href="">4399</a></li>
                            <li><a href="">百度</a></li>
                            <li><a href="">京东</a></li>
                            <li><a href="">阿里巴巴</a></li>
                            <li><a href="">腾讯</a></li>
                            <li><a href="">恒大</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php include('footer.php') ?>