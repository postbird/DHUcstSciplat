<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title><?php echo ($page_title); ?></title><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css"><link rel="stylesheet" href="__PUBLICFILE__/css/bootstrap.css"><link rel="stylesheet" href="__PUBLICFILE__/css/font-awesome.min.css"><link rel="stylesheet" href="__PUBLICFILE__/css/animate.min.css"><link rel="stylesheet" href="__PUBLICFILE__/css/all.css"><script src="__PUBLICFILE__/js/jquery.min.js"></script><script src="__PUBLICFILE__/js/bootstrap.min.js"></script><script src="__PUBLICFILE__/js/wow.min.js"></script><script src="__PUBLICFILE__/js/jquery.goup.min.js"></script><link rel="icon" href="__PUBLICFILE__/image/icon.png" sizes="32x32" /><style>	.loginfont{font-size:1.1em;}
  .nav-font a{color:#333;}
  .navbar-inverse .navbar-nav > li > a {
    color: #fff ;
  }
  .navbar-inverse .navbar-nav  li a:hover{
    color: #000000 ;
    /*border-bottom: solid 1px #fff;*/
    background-color: #fdfdfd;
  }
  .content-top{margin-top:50px}
  .menu{font-size:1.2em;}
  .menu-title{font-size:1.1em;}
  li a{color:black;}
  li span{float:right;}
  .pagination .current{background-color: #cccccc;}
  .pagination .current:hover{background-color: #cccccc;}
  .pagination .total-span a{background-color: #fff;border:solid 1px #ccc;margin-right: 10px;}
  .pagination .total-span a:hover{background-color:#fff;border:solid 1px #ccc;margin-right: 10px;}
</style><script>  $(document).ready(function () {
            $.goup({
                trigger: 100,
                bottomOffset: 150,
                locationOffset: 100,
                titleAsText: true
            });
        });
</script></head><body style="padding-top:70px;"><!--登录 modal--><div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="loginModalLabel">登录</h4></div><div class="modal-body col-md-12"><p class="text-danger">              初始密码为学号，登录后请进行 【<strong>个人信息</strong>】的设置。
            </p><div class="col-md-12"><div class="col-sm-4 text-center"><label for="name"><h4 >用户名：</h4></label></div><div class="col-sm-6"><input type="text" tabindex="1" name="username" id="username" class="form-control"/></div></div><div class="col-md-12"><div class="col-sm-4 text-center"><label for="name"><h4>密码：</h4></label></div><div class="col-sm-6"><input type="password" class="form-control" tabindex="2" name="password" id="password" /></div></div><div class="col-md-12"><div class="col-sm-4 text-center"><label for="code"><h4>验证码：</h4></label></div><div class="col-sm-4"><input type="text" class="form-control" tabindex="3" name="code" id="code" /></div><div class="col-sm-4"><img id="verify_code" src="<?php echo U('Admin/Login/verify','','');?>" onclick="change_code()" style="cursor:pointer;"/></div></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><!-- <button type="submit" class="btn btn-primary">登录</button> --><button onclick="logincheck()" class="btn btn-primary" tabindex="3">登录</button></div></div></div></div><!--注册modal 结束--><!--注册 modal--><div class="modal fade" id="registModal" tabindex="-1" role="dialog" aria-labelledby="registModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="registModalLabel">注册</h4></div><form action="<?php echo U('Index/Index/regist');?>" method="post"><div class="modal-body col-md-12"><p class="text-danger text-indent">                本注册适用于无法登陆系统或外学院同学,系统已经录入学号，可以直接凭借学号(初始密码为学号)登陆.
            </p><p class="text-danger text-indent"><strong>本注册为简单注册,成功登陆后,建议根据后台指引修改密码以及个人信息.</strong></p><p class="text-danger text-indent">                教师请联系管理员加入.(暂行)
            </p><p class="text-danger text-indent">                外学院同学请直接选择计算机类专业即可,班级正确填写.(暂行)
            </p><div class="col-md-12"><div class="col-sm-2"><label for="school"><h4>学院：</h4></label></div><div class="col-sm-8"><select name="school" id="school" class="form-control"><option value="计算机科学与技术学院">计算机科学与技术学院</option><option value="机械工程学院">机械工程学院</option><option value="信息科学与技术学院">信息科学与技术学院</option><option value="化学化工与生物工程学院">化学化工与生物工程学院</option><option value="材料科学与工程学院">材料科学与工程学院</option><option value="环境科学与工程学院">环境科学与工程学院</option><option value="纺织学院">纺织学院</option><option value="人文学院">人文学院</option><option value="理学院">理 学 院</option><option value="外语学院">外语学院</option><option value="马克思主义学院">马克思主义学院</option><option value="服装与艺术设计学院">服装与艺术设计学院</option><option value="旭日工商管理学院">旭日工商管理学院</option></select></div></div><div class="col-md-12"><div class="col-sm-2"><label for="unum"><h4>学号：</h4></label></div><div class="col-sm-4"><input type="text" class="form-control" name="unum" id="unum" placeholder="学号..." required="true"></div><div class="col-sm-2"><label for="uname"><h4>姓名：</h4></label></div><div class="col-sm-4"><input type="text" class="form-control" name="uname" id="uname" placeholder="姓名..." required="true"></div></div><div class="col-md-12"><div class="col-sm-2"><label for="master"><h4>专业：</h4></label></div><div class="col-sm-4"><select name="master" id="master" class="form-control"><option value="计算机类">计算机类</option><option value="软件工程">软件工程</option><option value="网络工程">网络工程</option><option value="计算机科学与技术">计算机科学与技术</option><option value="信息安全">信息安全</option></select></div><div class="col-sm-2"><label for="ugrade"><h4>班级：</h4></label></div><div class="col-sm-4"><input type="text" class="form-control" name="ugrade" id="ugrade" placeholder="如：计算机类1601" required="true"></div></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">关闭</button><button type="submit" class="btn btn-primary">注册</button></div></form></div></div></div><!--注册modal 结束--><nav class="navbar navbar-inverse navbar-fixed-top" style="width:100%;background-color: #278DDE;border-color: #278DDE;border-radius: 0px;font-size:17px;"><div class="cfol-xs-12"style="background-color: #fff;"><div class="container" ><div class="col-md-6 col-xs-6"><h3 class="hidden-xs"><i class="fa fa-cubes"></i>   计算机科创中心管理平台</h3><h3 class="hidden-lg"><i class="fa fa-cubes"></i></h3></div><div class="col-md-6 col-xs-6"><div class=" text-right overflow-div"style="text-align:right;padding-top:20px;"><?php if($user != '' ): ?><h4 ><a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-user"></i>   用户:<?php echo ($user['uname']); ?>(<?php echo ($user['unum']); ?>)</a></h4><?php else: ?><h4 ><!-- <a href="<?php echo U('Admin/Login/index');?>"><i class="fa fa-user"></i>   登录</a> --><a  href="javascript:;"data-toggle="modal" data-target="#loginModal"><i class="fa fa-user"></i>   登录</a>                  &nbsp;|&nbsp;
                <a  href="javascript:;"data-toggle="modal" data-target="#registModal"><i class="fa fa-user-plus"></i>   注册</a></h4><?php endif; ?></div></div></div></div><div class="container-fluid"><!-- Brand and toggle get grouped for better mobile display --><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div><!-- Collect the nav links, forms, and other content for toggling --><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><div class="container"><ul class="nav navbar-nav menu"><li class="nav-font"><a href="__ROOT__/" >首页 <span class="sr-only">(current)</span></a></li><li class="nav-font"><a href="<?php echo U('Index/Index/newslist');?>.html" target="">新闻</a></li><li class="nav-font"><a href="<?php echo U('Index/Index/lecturelist');?>.html" target="">讲座</a></li><li class="nav-font"><a href="<?php echo U('Index/Index/racelist');?>.html" target="">竞赛</a></li><li class="nav-font"><a href="<?php echo U('Index/Index/projectnewslist');?>.html" target="">项目</a></li><li class="nav-font"><a href="<?php echo U('Index/Index/elite');?>.html" target="">人才库</a></li><li class="nav-font"><a href="<?php echo U('Index/Index/about');?>.html" target="">关于</a></li><li class="nav-font"><a href="<?php echo U('Index/Index/suggest');?>.html" target="">反馈</a></li></ul></div><ul class="nav navbar-nav navbar-right menu"></ul></div><!-- /.navbar-collapse --></div><!-- /.container-fluid --></nav><style>	.head{text-align:center;}
	.page-header{height:400px;}
	.menu{font-size:1.2em;}
	.menu-title{font-size:1.1em;}
	li a{color:black;}
</style><div class='container content-top'><h2 class="text-center"><i class="fa fa-cubes"></i></h2><h2 class="text-center">计算机科创中心管理平台</h2><h4 class="text-center"><small>当前版本:V2.3.0 | 更新时间:2016-10-27</small></h4><h4 class="text-center"><small>当前可访问局域网域名:<a href="http://cst.ptbird.cn">http://cst.ptbird.cn</a></small></h4></div><div class="container"><div class="panel panel-primary"><div class="panel-heading">				V 2.3.0
			</div><div class="panel-body"><p class="text-danger">讲座可以直接在查看前台页面时进行报名(需要进行登录),不需要跳转到后台</p><p>目前可直接查看所有人的积分排名(积分>0)</p><p>开启前台页面静态化,可以通过浏览器地址(支持全部)或插件(仅支持新闻)分享到任何地方</p><p class="text-danger">讲座人数限制,讲座人数满后将不能进行报名。</p><p class="text-danger">【暂行】讲座目前需要科创讲座中心负责人员现场签到,取消普通学生讲座发布者确认参加人员的权利，由科创管理员进行确认。</p><p class="text-danger">更新完善竞赛说明(系统竞赛表示在计算机学院认可的竞赛中录入自己参加竞赛的获奖信息,而不是报名参加竞赛)。</p><p class="text-danger">增加竞赛审核不通过的原因说明。</p><p class="text-danger">更新完善项目中心内容,增加项目审核不通过的原因，并允许在之前的基础上进行编辑重新申请。</p><p class="">修复和完善部分页面显示。</p><p class="">修复系统bug。</p><p></p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.7
			</div><div class="panel-body"><p>修复用户同步超时问题</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.6
			</div><div class="panel-body"><p>修复系统bug</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.5
			</div><div class="panel-body"><p>系统防护升级</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.4
			</div><div class="panel-body"><p>修复文件上传与修改bug</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.2
			</div><div class="panel-body"><p>系统防护升级</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.1
			</div><div class="panel-body"><p>开启全站IP追踪</p><p>修改部分界面</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.2.0
			</div><div class="panel-body"><p>放弃IIS,使用apache服务器（存在rewrite url中文参数问题）</p><p>教师数据导入（目前统一职称为"教师"）,教师目前无法登陆，为项目申报服务</p><p>修改项目申报的部分规则并重构部分界面</p><p>修改(修复)科创管理员部分管理规则</p><p>修复部分bug</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.1.0
			</div><div class="panel-body"><p>放弃原始版本登录界面以及验证规则</p><p>增加注册功能,但是已经导入的学生不需要注册，注册只是为没有导入学生以及外学院服务</p><p>放弃原始数据同步规则,增加自动化注册同步功能,不需要等待兴趣小组系统同步用户数据</p><p>开启首页注册以及登陆功能</p><p>修复部分bug</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.0.4
			</div><div class="panel-body"><p>修复部分导入数据缺失问题,进行数据同步更新</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.0.3
			</div><div class="panel-body"><p>更改项目删除规则.</p><p>更改讲座删除规则.</p><p>修复管理员部分bug.</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.0.2
			</div><div class="panel-body"><p>修改科创管理员内容添加的权限以及相关验证规则.</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.0.1
			</div><div class="panel-body"><p>修改发布讲座以及新闻等由于ueditor整合modal的bug.</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 2.0.0
			</div><div class="panel-body"><p>增加版本迭代历史,帮助反馈建议.</p><p>系统线上部署.</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.6.1 【内测】
			</div><div class="panel-body"><p>修复用户搜索部分显示bug及更新用户信息修改规则.</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.6.0 【内测】
			</div><div class="panel-body"><p>增加后台管理用户搜索功能.</p><p>整合搜索结果与信息更新功能</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.5.1 【内测】
			</div><div class="panel-body"><p>修复后台管理用户列表加载失败或时间长的问题.</p><p>修复后台管理部分链接失效问题</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.5.0 【内测】
			</div><div class="panel-body"><p>完成兴趣小组系统对接及相关用户验证规则.</p><p>用户信息系统完善.</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.2.0 【内测】
			</div><div class="panel-body"><p>用户录入规则更改,并完成用户录入.</p><p>修改部分用户信息修改权限,数据库字段更新.</p><p>修改部分bug</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.1.0 【内测】
			</div><div class="panel-body"><p>项目交接</p><p>修改部分界面：采用fixed naverbar,增加banner轮播,部分颜色修改</p><p>vendor文件引用更改(前端),消除冗余文件</p><p>修改部分bug</p></div><div class="panel-footer text-right">				powered by postbird.
			</div></div><div class="panel panel-default"><div class="panel-heading">				V 1.0.0 【内测】
			</div><div class="panel-body"><p>计算机科创中心管理平台核心架构及整体内容完成</p><p>本地服务器调试运行</p></div><div class="panel-footer text-right">				powered by liuqiang.
			</div></div><div class="container text-center" ><footer style="color:#cccccc;">©2016 Powered By 东华大学计算机科学与技术学院科技创新中心
  <div style="marin:0 auto;"><script>      document.write(Date());
    </script></div></footer></div></body><script type="text/javascript">    //需要的全局变量
        var verifyUrl='<?php echo U("Admin/Login/verify",'','');?>';
        var loginindexUrl='<?php echo U("Index/Index/index",'','');?>';
        var loginloginUrl='<?php echo U("Admin/Login/login",'','');?>';
        var indexUrl='<?php echo U("Index/Index/index",'','');?>';
        var indexUrl="__APP__/Index/";
           
    //登录页面,验证码
    function change_code(){
      $('#verify_code').attr("src",verifyUrl+'/'+Math.random());
      return false;
    }
   function logincheck(){
     var username = $('#username');
    var password = $('#password');
    var verify_code = $('#code');
    
    if(username.val() == ''){
      alert('用户名不能为空');
      username.focus();
      return ;
    }
    if(password.val() == ''){
      alert('密码名不能为空');
      password.focus();
      return ;
    }
    
    if(verify_code.val() == ''){
      alert('验证码码不能为空');
      verify_code.focus();
      return ;
    }
    
    $.post(loginloginUrl,{username:username.val(),password:password.val(),verify_code:verify_code.val()},function (data) {
      if(data.status == 2){
        alert('验证码错误');
        return false;
      }else if(data.status == 3){
        
        window.location.href = indexUrl ;
      }else if(data.status == 0){
        alert('登录失败，请重新尝试');
        return false;
        // window.location.href = loginindexUrl;
      }else if(data.status==4)
      {
        alert('用户名或密码错误');
        return false;
        // window.location.href = loginindexUrl;
      }
      else{
        
        alert('用户名或密码错误');
        return false;
        // window.location.href = loginindexUrl;
      }
      
    },'json');
    }
    //enter响应
    // function onEnterDown(){
    // if(window.event.keyCode==13){
    //     logincheck();
    //   }
    //     } 
    function lectureapply(lid=0,unum=0){
      if(lid==0 || unum==0){
        alert("请先登录");
        return ;
      }
      alert("报名后不可撤销，确认报名？");
      if(confirm("再次确认报名!")){
        $.ajax({
          type:"POST",
          url:"__APP__/Admin/Stu/lectureapply/",
          data:{'lid':lid,'unum':unum},
          success:function(data,textStatus,jqXHR){
          alert("报名成功");
            window.location.reload();
          },
          error:function(jqXHR,textStatus,errorThrown){
            alert("报名失败");
          }
        })
          
        }
        else{
        
          return;
        }
    }
    </script></html>