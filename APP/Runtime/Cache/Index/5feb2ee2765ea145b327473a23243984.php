<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/main.css">
	<link rel="stylesheet" href="__PUBLICFILE__/css/bootstrap.css">
	<link rel="stylesheet" href="__PUBLICFILE__/css/all.css">
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
		<h3 class='head'><?php echo ($lecture['ltitle']); ?></h3>
		<hr/>
	 	<form id="form1" method='post'  class="form-horizontal" enctype="multipart/form-data">
		 			
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <?php echo ($lecture['lcontent']); ?>
					    </div>
					</div>
					<hr/>
					<div class="form-group">
						<div class="col-sm-2 primary-box text-center">主讲人:</div>
					    <div  class="col-sm-6 text-center " ><h4><?php echo ($lecture['llecturer']); ?></h4></div>							
					</div>
					<hr/>
					<div class="form-group">
						<div class="col-sm-2 primary-box text-center">讲座时间:</div>
					    <label  class="col-sm-6 text-center" ><h4><?php echo ($lecture['ldate']); ?></h4></label>							
					</div>
					<hr/>
					<div class="form-group">
						<div class="col-sm-2 primary-box text-center">讲座地点:</div>
					    <label  class="col-sm-6  text-center" ><h4><?php echo ($lecture['lplace']); ?></h4></label>							
					</div>
					<hr/>
					<div class="form-group">
						<div class="col-sm-2 primary-box text-center">开始日期:</div>
						<label  class="col-sm-4   text-center" ><h4><?php echo ($lecture['ldatestart']); ?></h4></label>
					    <div class="col-sm-2 primary-box text-center">截止日期:</div>
					    <label  class="col-sm-4   text-center" ><h4><?php echo ($lecture['ldateend']); ?></h4></label>
				    </div>
				    <hr/>
					<div class="form-group">
						<div class="col-sm-2 primary-box text-center">负责人:</div>
						<label  class="col-sm-4  text-center" ><h4><?php echo ($lecture['ldirectorname']); ?></h4></label>
					    <div class="col-sm-2 primary-box text-center">负责人电话:</div>
					    <label  class="col-sm-4  text-center" ><h4><?php echo ($lecture['ldirectortel']); ?></h4></label>
				    </div>
				 	 <hr/>
					<div class="form-group">
						<div class="col-sm-2 primary-box text-center">是否有讲座单:</div>
					    <?php if($lecture['lsheet'] == 1): ?><label  class="col-sm-6  text-center" ><h4>是</h4></label>
					    <?php else: ?>
					    	<label  class="col-sm-6 text-center" ><h4>否</h4></label><?php endif; ?>							
					</div>
					
			  		<div class="modal-footer">
		   			 	 <a class="btn btn-primary" href="<?php echo U('Index/Index/lecturelist');?>" target="opt"><span>返回</span></a>
					</div>
		</form>
	</div>
	

	
</body>
</html>