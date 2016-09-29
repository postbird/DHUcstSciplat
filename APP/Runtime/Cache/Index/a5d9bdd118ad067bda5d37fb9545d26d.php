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
	<div class=''>
		<h2 class='head'>科创人才分组列表</h2>
		<hr/>
		
	 	<?php if(is_array($elitegroup)): foreach($elitegroup as $i=>$v): ?><label for="usernum" class="col-sm-2 control-label" ><div class="primary-box"><h4>分组<?php echo ($i+1); ?>:&nbsp;&nbsp;&nbsp;<?php echo ($v['ename']); ?></h4></div></label>
			 	<div class="col-sm-10  ">
					<div class="col-sm-12 ">
						<table class="table table-hover table-striped table-responsive text-center" >
							<thead>
								<tr>
									<th class="text-center">学号</th>
									<th class="text-center">姓名</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($v["elite"])): foreach($v["elite"] as $key=>$u): ?><tr>
							    		<td>
							    			<?php echo ($u['unum']); ?>&nbsp;&nbsp;
							    		</td>
							    		<td>
							    			<?php echo ($u['uname']); ?>
							    		</td>
							    		
							    	</tr><?php endforeach; endif; ?>
						    </tbody>	
						</table>
					</div>
				</div>		
			   <div class="col-md-12">
			   		<hr/>
			   </div><?php endforeach; endif; ?>
	</div>
	

	
</body>
</html>