<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/bootstrap.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/font-awesome.min.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/animate.min.css">
  <link rel="stylesheet" href="__PUBLICFILE__/css/all.css">
  <script src="__PUBLICFILE__/js/jquery.min.js"></script>
  <script src="__PUBLICFILE__/js/bootstrap.min.js"></script>
  <script src="__PUBLICFILE__/js/wow.min.js"></script>
<style>
	
	a{target:"opt";}
	.page-header{height:400px;}
	.menu{font-size:1.2em;}
	li a{color:black;}
	li span{float:right;}
</style>
</head>
<body>
<div class="">
	<div class="panel panel-info">
	  <!-- Default panel contents -->
	  
	  <div class="panel-heading menu-title"><h4>讲座列表</h4></div>

	  <!-- List group -->
	  <ul class="list-group"style="font-size:17px;">
	  	<?php if(is_array($lecture)): foreach($lecture as $key=>$v): ?><li class="list-group-item"><a href="<?php echo U('Index/Index/lecture',array('lid'=>$v['lid']));?>"><?php echo ($v["ltitle"]); ?></a><span><?php echo ($v["ldatestart"]); ?></span></li><?php endforeach; endif; ?>	
      </ul>
	</div>
	<div style="height:4em;margin:0 auto;text-align:center;">
		<?php echo ($page); ?>
	</div>
</div>
</body>