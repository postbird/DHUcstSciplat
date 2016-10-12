<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css">
	<script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script>
	<script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script>
<style>
		.head{text-align:center;}
		.container{width:1000px;}
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:100%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
	</style>

</head>
<body>
	<div class="container">
	<h1>
		<br>
		<br>
	</h1>
	<hr>
	<table class="table table-hover table-striped">
		<thead>
			<th>Number</th>
			<th>Name</th>
			<th>LastIp</th>
		</thead>
		<tbody>
			<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($u["unum"]); ?></td>
					<td><?php echo ($u["uname"]); ?></td>
					<td><?php echo ($u["lastip"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>	
	<div class="col-md-12" style="text-align: right;">
		 <a href="<?php echo U('Admin/SuperManage/lastip',array('uid'=>$us['uid'],'uname'=>$us['uname'],'unum'=>$us['unum']));?>" class="btn btn-primary"target="opt">返回</a>
	</div>
	</div>
</body>
</html>