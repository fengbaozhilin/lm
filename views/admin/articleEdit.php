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
    <script src="/statics/index/js/wangEditor.min.js"></script>
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

<input type="hidden" id="id" value="<?=$arr['id']?>" />
<table class="table table-bordered table-hover m10">

    <tr>
        <td class="tableleft">文章标题</td>
        <td><input type="text" value="<?=$arr['name']?>" id="name"/></td>
    </tr>

</table>
    <div id="editor"><?=$arr['content']?></div>


        <div style="margin-top: 15px">
            <button type="submit" onclick="edit()" class="btn btn-primary" type="button">保存</button>
        </div>


</body>
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
    function edit() {
        var content = editor.txt.html();

        var name    = $('#name').val();

        var  id      = $('#id').val();

        if (name == null) {
            alert("请填写标题");

            return false;
        } else if (content == '') {
            alert("请填写内容");

            return false;
        }
      else {

            $.post("?m=admin&f=articleAjax",{
                name: name, content: content, id: id
            },function (res) {
                if (res.code == 200) {
                    alert("编辑文章成功");
                    window.location.reload();
                }else {
                    alert("编辑文章失败,请重试");
                    window.location.reload();
                }
            },'json')



        }



    }
</script>
</html>
