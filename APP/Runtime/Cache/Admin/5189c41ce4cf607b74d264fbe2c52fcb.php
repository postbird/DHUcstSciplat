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
	
	<script>
	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
	window.onload=function(){
			window.UEDITOR_CONFIG.initialFrameHeight=320;
			//window.UEDITOR_CONFIG.getActionUrl = "<?php echo U(GROUP_NAME.'/Blog/upload');?>"; //提交页面
			//window.UEDITOR_CONFIG.imagePath = URL + "php/";
			//UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
			//UE.Editor.prototype.getActionUrl = function(action){
			//if(action == 'uploadimage') {
			//return '<?php echo U(GROUP_NAME.'/Blog/upload');?>';
			//}
			//return this._bkGetActionUrl(action);
			//}
			//window.UEDITOR_CONFIG.imageUrl='<?php echo U(GROUP_NAME.'/Blog/upload');?>';
			//window.UEDITOR_CONFIG.imagePath=URL+"php/";
			//上传文件的保存路径的修改再config.json里
			UE.getEditor('content');
			
		}
</script>

<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>
</head>
<body>
	<div class='container'>
	<h2 class='head'>用户信息读取修改</h2>
	<hr/>
	 <form id="form2" method='post' action="__URL__/updatepwdhandle" class="form-horizontal" enctype="multipart/form-data">
	 		 <div class="form-group">
						    <label for="usernum" class="col-sm-2 control-label">学号/工号:</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control"  name="unum"  value='<?php echo ($us["unum"]); ?>' readonly="true">
						     </div>
					  </div>
  					 <div class="form-group">
						    <label for="usernum" class="col-sm-2 control-label">姓名:</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control"  name="uname"  value='<?php echo ($us["uname"]); ?>' readonly="true">
						     </div>
				  	 </div>
  					 <div class="form-group">
						    <label for="usernum" class="col-sm-2 control-label">原始密码:</label>
						    <div class="col-sm-4">
						      <input type="password" class="form-control"  name="upasswordold" >
						     </div>
					  </div>
  					 <div class="form-group">
						    <label for="usernum" class="col-sm-2 control-label">新密码:</label>
						    <div class="col-sm-4">
						      <input type="password" class="form-control"  name="upasswordnew" >
						     </div>
					  </div>
  					 <div class="form-group">
						    <label for="usernum" class="col-sm-2 control-label">确认密码:</label>
						    <div class="col-sm-4">
						      <input type="password" class="form-control"  name="upasswordrenew" >
						     </div>
				  </div>
			  	 	      
		  	 <div class="modal-footer">
		   			<input type='hidden',id='uid' name='uid' value='<?php echo ($us["uid"]); ?>'>
			  		<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
		   			<input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'>
		   			<input type="submit" class="btn btn-primary" value="保 存" >
				   	 &nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
			   </div>
		  </form>
		  
   
	</div>
	<script>
		
	</script>
	
</body>
</html>