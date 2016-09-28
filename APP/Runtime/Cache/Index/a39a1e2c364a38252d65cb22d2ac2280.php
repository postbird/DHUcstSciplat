<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>科创管理平台首页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/bootstrap.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/font-awesome.min.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/animate.min.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/all.css">
  <script src="__PUBLICFILE__/js/jquery.min.js"></script>
  <script src="__PUBLICFILE__/js/bootstrap.min.js"></script>
  <script src="__PUBLICFILE__/js/wow.min.js"></script>
    <link rel="icon" href="__PUBLICFILE__/image/icon.png" sizes="32x32" />
<style>
	body{width:100%;margin:0 auto;}
	.menu{font-size:1.2em;}
	.loginfont{font-size:1.1em;}
  .nav-font a{color:#333;}
  .navbar-inverse .navbar-nav > li > a {
    color: #fff ;
  }
  .navbar-inverse .navbar-nav  li a:hover{
    color: #000000 ;
    /*border-bottom: solid 1px #fff;*/
    background-color: #fdfdfd;

  }
</style>
<script>
function iFrameHeight() {  
	var ifm= document.getElementById("iframepage");  
	var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;  
	if(ifm != null && subWeb != null) {
	   ifm.height = subWeb.body.scrollHeight;
	   ifm.width = subWeb.body.scrollWidth;
	}  
	}   
</script>
<!-- background-image: url(__PUBLICFILE__/image/bg.png);background-size: cover; -->
</head>
<body style="padding-top:70px;">

<nav class="navbar navbar-inverse navbar-fixed-top" style="width:100%;background-color: #278DDE;border-color: #278DDE;border-radius: 0px;font-size:17px;">
<div class="cfol-xs-12"style="background-color: #fff;">
  <div class="container" >
  <div class="col-md-6 col-xs-6">
    <h3 class="hidden-xs"><i class="fa fa-cubes"></i>   计算机科创中心管理平台</h3>
    <h3 class="hidden-lg"><i class="fa fa-cubes"></i></h3>
  </div>
  <div class="col-md-6 col-xs-6">
     <div class=" text-right overflow-div"style="text-align:right;padding-top:20px;">
            <?php if($user != ''): ?><h4 ><a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-user"></i>   用户:<?php echo ($user['uname']); ?>(<?php echo ($user['unum']); ?>)</a></h4>
            <?php else: ?>
              <h4 ><a href="<?php echo U('Admin/Login/index');?>"><i class="fa fa-user"></i>   登录</a></h4>
              <h4 ><a href="<?php echo U('Admin/Login/index');?>"><i class="fa fa-user"></i>   登录</a></h4><?php endif; ?> 
      </div>
  </div>
</div>
</div>

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <div class="container">
        <ul class="nav navbar-nav menu">
          <li class="nav-font"><a href="__ROOT__" >首页 <span class="sr-only">(current)</span></a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/newslist');?>" target="opt">新闻</a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/lecturelist');?>" target="opt">讲座</a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/racelist');?>" target="opt">竞赛</a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/projectnewslist');?>" target="opt">项目</a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/elite');?>" target="opt">人才库</a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/about');?>" target="opt">关于</a></li>
          <li class="nav-font"><a href="<?php echo U('Index/Index/suggest');?>" target="opt">反馈</a></li>
        </ul>
       
      </div>
        
      <ul class="nav navbar-nav navbar-right menu">
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="page-header">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <!-- <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> -->
      <li data-target="#carousel-example-generic" data-slide-to="1"  class="active"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
     <!--  <div class="item active">
        <img src="__PUBLICFILE__/image/banner1.jpg" alt="cstkc-banner1">
        <div class="carousel-caption">
        </div>
      </div> -->
      <div class="item active">
        <img src="__PUBLICFILE__/image/banner2.jpg" alt="cstkc-banner2">
        <div class="carousel-caption">
            <!-- 这里写文字  -->
        </div>
      </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
       <span class=""><i class="fa fa-chevron-left" style="margin-top:80%;"></i></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class=""><i class="fa fa-chevron-right" style="margin-top:80%;"></i></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div class="container">
  
<div class="maincontent">
        <iframe name="opt" id="iframepage" src="<?php echo U('Index/Index/home');?>" frameborder="0" scrolling="no" style="width:100%;" onLoad="iFrameHeight()"></iframe>
</div>
</div>

	

<footer >©2016 Powered By 东华大学计算机科学与技术学院科技创新中心
	<div style="marin:0 auto;">
		<script>
			document.write(Date());
		</script>
	</div>
</footer>	
</body>
</html>