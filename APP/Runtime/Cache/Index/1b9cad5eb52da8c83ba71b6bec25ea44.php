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
		<h3 class='head'><?php echo ($race['rname']); ?></h3>
		<hr/>
	 	<form id="form1" method='post'  class="form-horizontal" enctype="multipart/form-data">
		 			
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <?php echo ($race['rcontent']); ?>
					    </div>
					</div>
					<hr/>
					<div class="form-group">
						<label  class="col-sm-2 control-label" >开始日期:</label>
						<label  class="col-sm-2 control-label normalfont" ><?php echo ($race['rdatestart']); ?></label>
					    <label  class="col-sm-2  control-label" >截止日期:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($race['rdateend']); ?></label>
				    </div>
				    <hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label" >主办/承办单位:</label>
						<label for="username" class="col-sm-2 control-label normalfont" > <?php echo ($race['rsponsor']); ?></label>
				 	</div>
				 	 <hr/>
					<div class="form-group">
						<label  class="col-sm-2  control-label" >竞赛级别:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($race['rlevel']); ?></label>							
					</div>
					<hr/>
					<div class="form-group">
						<?php if($race['raccessory'] == ''): else: ?>
					   		 <label for="username" class="col-sm-2  control-label" >附件:</label>
					    	 <label  class="col-sm-2 control-label normalfont" ><a href="<?php echo U('Index/Index/downfile');?>?filename=.<?php echo ($race["raccessory"]); ?>">附件下载</a></label><?php endif; ?>   
					</div>
					
			  		<div class="modal-footer">
		   			 	 <a class="btn btn-primary" href="<?php echo U('Index/Index/racelist');?>" target="opt"><span>返回</span></a>
					</div>
		</form>
	</div>
	

	
</body>
</html>