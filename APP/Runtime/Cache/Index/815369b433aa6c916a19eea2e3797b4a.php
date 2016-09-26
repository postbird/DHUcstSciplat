<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css">
<style>
	.head{text-align:center;}
	a{target:"opt";}
	.page-header{height:400px;}
	.menu{font-size:1.2em;}
	.menu-title{font-size:1.1em;}
	li a{color:black;}
	li span{float:right;}
</style>
</head>
<body>
	<div class='container'>
		<h3 class='head'><?php echo ($news['ntitle']); ?></h3>
		<hr/>
	 	<form id="form1" method='post'  class="form-horizontal" enctype="multipart/form-data">
		 			
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <?php echo ($news['ncontent']); ?>
					    </div>
					</div>
					<hr/>
					
					<div class="form-group">
						<?php if($news['naccessory'] == ''): else: ?>
					   		 <label for="username" class="col-sm-2  control-label" >附件:</label>
					    	 <label  class="col-sm-2 control-label normalfont" ><a href="<?php echo U('Index/Index/downfile');?>?filename=.<?php echo ($news["nraccessory"]); ?>">附件下载</a></label><?php endif; ?>   
					</div>
					
			  		<div class="modal-footer">
		   			 	 <a class="btn btn-primary" href="<?php echo U('Index/Index/newslist');?>" target="opt"><span>返回</span></a>
					</div>
		</form>
	</div>
	

</body>
</html>