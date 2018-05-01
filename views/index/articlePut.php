<?php include('header.php') ?>


    <div class="container main-container "  >

        <div class="col-md-10 col-md-offset-1 panel" style="margin-top: 200px">
            <div class="panel-body articles-create ">

                <h1 class="header text-center" style="line-height: 60px;font-size: 30px;color: #6d6b6b;"><i
                        class="fa fa-commenting-o"></i> 发表文章</h1>
                <hr>


                <div class="row">
                    <div class="col-sm-2 form-group">
                        <select class="selectpicker form-control" name="category_id" id="category-select"
                                required="require">
                            <option value="" disabled="" selected="">请选择分类</option>
                            <?php foreach ($cates as $key=>$cate) {  ?>
                            <option value="<?= $cate['id'] ?>"><?=$cate['name'] ?></option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="col-sm-10 form-group" style="padding-left:0">
                        <input class="form-control" id="topic-title" placeholder="请填写标题" name="title" type="text"
                               value="" required="require">
                    </div>
                </div>





                <div class="form-group">
                    <div id="editor">
                    </div>
                </div>


                <div onclick="upload_article()">
                    <button class="btn btn-primary submit-btn" id="" type="submit"> <i class="fa fa-paper-plane"></i> 发布文章</button>
                </div>


            </div>
        </div>


    </div>
    <script type="text/javascript">
        var E = window.wangEditor
        var editor = new E('#editor');
        // 或者 var editor = new E( document.getElementById('editor') )

        //debug模式开启
        editor.customConfig.debug = true

        editor.customConfig.uploadImgShowBase64 = true   // 使用 base64 保存图片

        // 将图片大小限制为 5M
        editor.customConfig.uploadImgMaxSize = 5 * 1024 * 1024

        // 限制一次最多上传 5 张图片
        editor.customConfig.uploadImgMaxLength = 10

        editor.customConfig.uploadImgParamsWithUrl = true

        editor.customConfig.uploadFileName = 'myfiles[]'

        // 自定义字体
        editor.customConfig.fontNames = [
            '宋体',
            '微软雅黑',
            'Arial',
            'Tahoma',
            'Verdana',
            '华文行楷',
            '黑体',
            '幼圆',
        ]


        // 自定义菜单配置
        editor.customConfig.menus = [
            'head',  // 标题
            'bold',  // 粗体
            'fontSize',  // 字号
            'fontName',  // 字体
            'italic',  // 斜体
            'underline',  // 下划线
            'strikeThrough',  // 删除线
            'foreColor',  // 文字颜色
            'backColor',  // 背景颜色
            'link',  // 插入链接
            'list',  // 列表
            'justify',  // 对齐方式
            'quote',  // 引用
            'emoticon',  // 表情
            'image',  // 插入图片
            'table',  // 表格
            'code',  // 插入代码
            'undo',  // 撤销
            'redo'  // 重复
//        'video',  // 插入视频
        ]

        editor.customConfig.onchange = function (html) {
            // html 即变化之后的内容
            //console.log(html)
            //获取字数 -- 不知道为什么 前后空格不能清除
            var edi_art_text = editor.txt.text();
            edi_art_text = edi_art_text.replace(/\s/g, '');
            edi_art_text = $.trim(edi_art_text);
            var edi_count = edi_art_text.length;
            $('#edi_count').text(edi_count);

        }

        editor.create()

    </script>

    <script>
        function upload_article() {


            var cate_id = $('#category-select').val();
            var title = $('#topic-title').val();
            var content = editor.txt.html();
            if (cate_id == null) {
                alert("请填写分类");

                return false;
            } else if (title == '') {
                alert("请填写标题");

                return false;
            }
            else if (content == '') {
                alert("请填写内容");

                return false;
            } else {

                $.post("?m=view&f=articleAjax",{
                    cate_id: cate_id, title: title, a_content: content
                },function (res) {
                    if (res.code == 200) {
                        alert("发表文章成功");
                        window.location.reload();
                    } else if(res.code == 300){
                        alert("未登陆，请先登陆");
                        window.location.href="?m=view&f=login";
                    }else {
                        alert("发表文章失败请重试");
                        window.location.reload();
                    }
                },'json')




            }


        }
    </script>

<?php include('footer.php') ?>