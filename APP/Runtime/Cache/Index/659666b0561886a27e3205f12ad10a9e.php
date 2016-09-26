<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>科创管理平台首页</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css">
<style>
	body{width:90%;margin:0 auto;}
	.page-header{margin-left:5%;}
	.menu{font-size:1.2em;}
	.loginfont{font-size:1.1em;}
	.maincontent{width:90%;margin-left:5%;}
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
</head>
<body >
<div class="page-header">

  <img src="__PUBLIC__/Images/head.jpg" style="width:100%;" alt="东华大学计算机学院科创管理平台"></img>
 <ul class="page-header-lists loginfont" style="float:right;right:10%;">
 	<?php if($user != ''): ?><li><a href="<?php echo U('Admin/Index/index');?>">用户:<?php echo ($user['uname']); ?>(<?php echo ($user['unum']); ?>)</a></li>
 	<?php else: ?>
 		<li><a href="<?php echo U('Admin/Login/index');?>">登录</a></li><?php endif; ?>
 </ul>
</div>
<nav class="navbar navbar-default">
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
      <ul class="nav navbar-nav menu">
        <li><a href="<?php echo U('Index/Index/index');?>" >首页 <span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo U('Index/Index/newslist');?>" target="opt">新闻</a></li>
        <li><a href="<?php echo U('Index/Index/lecturelist');?>" target="opt">讲座</a></li>
        <li><a href="<?php echo U('Index/Index/racelist');?>" target="opt">竞赛</a></li>
        <li><a href="<?php echo U('Index/Index/projectnewslist');?>" target="opt">项目</a></li>
        <li><a href="<?php echo U('Index/Index/elite');?>" target="opt">人才库</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right menu">
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="maincontent">
        <iframe name="opt" id="iframepage" src="<?php echo U('Index/Index/home');?>" frameborder="0" scrolling="no" style="width:100%;" onLoad="iFrameHeight()"></iframe>
</div>	

<footer >©2016
	<div style="marin:0 auto;">
		<script>
			document.write(Date());
		</script>
	</div>
</footer>	
</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
</html>