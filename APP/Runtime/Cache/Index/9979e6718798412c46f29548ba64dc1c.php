<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">
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
	.menu-title{font-size:1.5em;}
	li a{color:black;}
	li span{float:right;}
</style>
</head>
<body style="font-size:16px;">
<div class="row">
  <div class="col-md-4">
	 	<div class="panel panel-primary panel_col panel-item-box">
			<div class="panel-heading menu-title"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;新闻</div>
			<?php if($newsFlag == 1): ?><ul class="list-group ">
					<?php if(is_array($news)): foreach($news as $key=>$v): ?><li class="list-group-item"><a href="<?php echo U('Index/Index/news',array('nid'=>$v['nid']));?>"><?php echo ($v["ntitle"]); ?></a><span><?php echo ($v["ndate"]); ?></span></li><?php endforeach; endif; ?>
			    </ul>
			    <ul class="text-right" style="padding-top:10px;padding-right:20px;">
					<a href="<?php echo U('Index/Index/newslist');?>" >更多>></a>
			    </ul>
			<?php else: ?>
				<h4 class="text-center red-font" style="padding-top:40px;">
					<i class="fa fa-warning"></i>
					<br>暂无新闻
				</h4><?php endif; ?>
		</div>
  </div> 

  <div class="col-md-4">
	 	<div class="panel panel-primary panel_col panel-item-box">
	  
			<div class="panel-heading menu-title"><i class="fa fa-qrcode"></i>&nbsp;&nbsp;讲座</div>

			<?php if($lectureFlag == 1): ?><ul class="list-group">
					<?php if(is_array($lecture)): foreach($lecture as $key=>$v): ?><li class="list-group-item"><a href="<?php echo U('Index/Index/lecture',array('lid'=>$v['lid']));?>"><?php echo ($v["ltitle"]); ?></a><span><?php echo ($v["ldatestart"]); ?></span></li><?php endforeach; endif; ?>
				</ul>
				 <ul class="text-right" style="padding-top:10px;padding-right:20px;">
					<a href="<?php echo U('Index/Index/lecturelist');?>" >更多>></a>
			    </ul>
		    <?php else: ?>
				<h4 class="text-center red-font" style="padding-top:40px;">
					<i class="fa fa-warning"></i>
					<br>暂无讲座
				</h4><?php endif; ?>
		</div>
  </div> 
  <div class="col-md-4">
	 	<div class="panel panel-danger panel_col panel-item-box">
	  
			<div class="panel-heading menu-title"><i class="fa fa-trophy"></i>&nbsp;&nbsp;科创达人榜</div>

		<?php if($userFlag == 1): ?><ul class="list-group">
				<?php if(is_array($user)): foreach($user as $key=>$v): ?><li class="list-group-item"><?php echo ($v["uname"]); ?>(<?php echo ($v["unum"]); ?>)<span><?php echo ($v["upoint"]); ?>分</span></li><?php endforeach; endif; ?>
			</ul>
		 <?php else: ?>
				<h4 class="text-center red-font" style="padding-top:40px;">
					<i class="fa fa-warning"></i>
					<br>等你上榜
				</h4><?php endif; ?>	
		</div>
  </div>  
</div>
<hr/>
<div class="row">
  <div class="col-md-4">
	 	<div class="panel panel-info panel_col panel-item-box">
	  
			<div class="panel-heading menu-title"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;竞赛</div>

			<?php if($raceFlag == 1): ?><ul class="list-group">
					<?php if(is_array($race)): foreach($race as $key=>$v): ?><li class="list-group-item"><a href="<?php echo U('Index/Index/race',array('rid'=>$v['rid']));?>"><?php echo ($v["rname"]); ?></a><span><?php echo ($v["rdatestart"]); ?></span></li><?php endforeach; endif; ?>
				</ul>
				 <ul class="text-right" style="padding-top:10px;padding-right:20px;">
					<a href="<?php echo U('Index/Index/racelist');?>" >更多>></a>
			    </ul>

		     <?php else: ?>
				<h4 class="text-center red-font" style="padding-top:40px;">
					<i class="fa fa-warning"></i>
					<br>暂无信息
				</h4><?php endif; ?>
		</div>
  </div> 

  <div class="col-md-4">
	 	<div class="panel panel-info panel_col panel-item-box">
	  
			<div class="panel-heading menu-title"><i class="fa fa-database"></i>&nbsp;&nbsp;项目</div>

			<?php if($projectnewsFlag == 1): ?><ul class="list-group">
					<?php if(is_array($projectnews)): foreach($projectnews as $key=>$v): ?><li class="list-group-item"><a href="<?php echo U('Index/Index/projectnews',array('pid'=>$v['pid']));?>"><?php echo ($v["ptitle"]); ?></a><span><?php echo ($v["pdatestart"]); ?></span></li><?php endforeach; endif; ?>
				</ul>
				<ul class="text-right" style="padding-top:10px;padding-right:20px;">
					<a href="<?php echo U('Index/Index/projectnewslist');?>">更多>></a>
			    </ul>
		    <?php else: ?>
				<h4 class="text-center red-font" style="padding-top:40px;">
					<i class="fa fa-warning"></i>
					<br>暂无信息
				</h4><?php endif; ?>
		</div>
  </div> 
  <div class="col-md-4">
	 	<div class="panel panel-info panel_col panel-item-box">
	  
			<div class="panel-heading menu-title"><i class="fa fa-mortar-board"></i>&nbsp;&nbsp;人才库</div>

			<?php if($eliteFlag == 1): ?><ul class="list-group">
					<?php if(is_array($elite)): foreach($elite as $key=>$v): ?><li class="list-group-item"><?php echo ($v["ename"]); ?></li><?php endforeach; endif; ?>
				</ul>
				<ul class="text-right" style="padding-top:10px;padding-right:20px;">
					<a href="<?php echo U('Index/Index/elite');?>" >详情>></a>
			    </ul>
		  	<?php else: ?>
				<h4 class="text-center red-font" style="padding-top:40px;">
					<i class="fa fa-warning"></i>
					<br>暂无信息
				</h4><?php endif; ?>  
		</div>
  </div>  
</div>
</body>