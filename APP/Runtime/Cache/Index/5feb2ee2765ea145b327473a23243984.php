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
						<label  class="col-sm-2  control-label" >主讲人:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['llecturer']); ?></label>							
					</div>
					<hr/>
					<div class="form-group">
						<label  class="col-sm-2  control-label" >讲座时间:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['ldate']); ?></label>							
					</div>
					<hr/>
					<div class="form-group">
						<label  class="col-sm-2  control-label" >讲座地点:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['lplace']); ?></label>							
					</div>
					<hr/>
					<div class="form-group">
						<label  class="col-sm-2 control-label" >开始日期:</label>
						<label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['ldatestart']); ?></label>
					    <label  class="col-sm-2  control-label" >截止日期:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['ldateend']); ?></label>
				    </div>
				    <hr/>
					<div class="form-group">
						<label  class="col-sm-2 control-label" >负责人:</label>
						<label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['ldirectorname']); ?></label>
					    <label  class="col-sm-2  control-label" >负责人电话:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['ldirectortel']); ?></label>
				    </div>
				 	 <hr/>
					<div class="form-group">
						<label  class="col-sm-2  control-label" >是否有讲座单:</label>
					    <?php if($lecture['lsheet'] == 1): ?><label  class="col-sm-2 control-label normalfont" >是</label>
					    <?php else: ?>
					    	<label  class="col-sm-2 control-label normalfont" >否</label><?php endif; ?>							
					</div>
					
			  		<div class="modal-footer">
		   			 	 <a class="btn btn-primary" href="<?php echo U('Index/Index/lecturelist');?>" target="opt"><span>返回</span></a>
					</div>
		</form>
	</div>
	

	
</body>
</html>