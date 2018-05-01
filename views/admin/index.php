
<!DOCTYPE HTML>
<html>
 <head>
  <title>后台管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/statics/admin/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/statics/admin/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/statics/admin/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
       <!--<img src="/chinapost/Public/assets/img/top.png">-->
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user">Admin</span><a href="?m=admin&f=loginOut" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
        		<li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>

      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/statics/admin/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/statics/admin/js/bui-min.js"></script>
  <script type="text/javascript" src="/statics/admin/js/main-min.js"></script>
  <script type="text/javascript" src="/statics/admin/js/config-min.js"></script>
  <script>
    BUI.use('common/main',function(){
      var config = [{id:'1',menu:[{text:'系统管理',items:[{id:'4',text:'用户管理',href:'?m=admin&f=userIndex'},{id:'6',text:'分类管理',href:'?m=admin&f=cateIndex'},{id:'8',text:'文章管理',href:'?m=admin&f=articleIndex'}]}]}];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>