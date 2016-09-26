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
	<h2 class='head'>信息读取修改</h2>
	<hr/>
	 <form id="form2" method='post' action="__URL__/newsupdate" class="form-horizontal" enctype="multipart/form-data">
	 		<div class="form-group">
	 			<label for="usernum" class="col-sm-1  control-label" >发布者:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="publishname" name="publishname" value='<?php echo ($news["npublishname"]); ?>' readonly='true' >
			    </div>
			    <label for="usernum" class="col-sm-2 col-sm-offset-1 control-label" >发布日期:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="date" name="date" value='<?php echo ($news["ndate"]); ?>' readonly='true' >
			    </div>
	 		</div>
	 		<hr/>
	 		<div class="form-group">
	 			<label for="usernum" class="col-sm-1 control-label">发布状态:</label>
				    <div class="col-sm-3">
				       <?php if($news['nstatus'] == 1): ?><input type="radio"   name="status" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
				       		<input type="radio"   name="status" value='0' style="width: 50px"/>&nbsp;&nbsp;否
					    <?php else: ?>
					   		 <input type="radio"   name="status" value='1' style="width: 50px"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
					    	<input type="radio"   name="status" value='0'  checked="checked" style="width: 50px"/>&nbsp;&nbsp;否<?php endif; ?>
				       
				    </div>
			</div>
			<hr/>
			<div class="form-group">
	 			<label for="usernum" class="col-sm-1 control-label">置顶状态:</label>
				    <div class="col-sm-3">
				       <?php if($news['ntop'] == 1): ?><input type="radio"   name="top" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
				       		<input type="radio"   name="top" value='0' style="width: 50px"/>&nbsp;&nbsp;否
					    <?php else: ?>
					   		 <input type="radio"   name="top" value='1' style="width: 50px"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
					    	<input type="radio"   name="top" value='0'  checked="checked" style="width: 50px"/>&nbsp;&nbsp;否<?php endif; ?>
				       
				    </div>
			</div>
			<hr/>	    
	 		<div class="form-group">
	 				<label for="usernum" class="col-sm-1 control-label" >标题:</label>
				    <div class="col-sm-8 ">
				      <input type="text" class="form-control " id="title" name="title"  value='<?php echo ($news["ntitle"]); ?>' >
				    </div>
				    
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1">
				      <textarea  id="content" name="content" >
				      	<?php echo ($news["ncontent"]); ?>
				      </textarea>
			    </div>
			</div>
 	 	   <div class="form-group">
				<label for="username" class="col-sm-1  control-label" >附件:</label>
			 	<div class="col-sm-8">
			      请选择需要上传的文件(大小不超过10M，文件类型为.doc,.pdf,.zip)：
				     <input type='file' name="newsFile" />
				     当前文件为：<?php echo ($news["naccessory"]); ?><br/>
				    <?php if($news['naccessory'] == ''): else: ?>
				    	 <a href="<?php echo U('Admin/SuperManage/downnewsfile');?>?filename=.<?php echo ($news["naccessory"]); ?>">文件下载</a><?php endif; ?>   			    	
			    </div>	
			</div>
		   <div class="modal-footer">
		   			<input type='hidden' name='newsfile' value='<?php echo ($news["naccessory"]); ?>'>
	 			    <input type='hidden',id='nid' name='nid' value='<?php echo ($news["nid"]); ?>'>
			  		<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
		   			<input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'>
				   	 <a class="btn btn-primary" href="<?php echo U('Admin/SuperManage/news',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
				   	 <input type="submit" class="btn btn-primary" value="保 存" >
				   	 &nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
			   </div>
		  </form>
		  
   
	</div>
	<script>

	</script>
	
</body>
</html>