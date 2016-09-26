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
		$(document).ready(function(){
			
             $("#checkAll").click(function(){
            	 var a=0;
				  $(".sub-box").each(function(){
				  	if(a>=($(".sub-box").length)){
				  		return 0;
				  	}else{
				  		$(this).prop("checked",true);
				  		a++;
				  	}
				  });
			 });
             $("#delAll").click(function(){  
			  $(".sub-box").each(function(){
			   $(this).prop("checked",false);
			  });  
			 });
        });

	</script>
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
	<h3 class='head'><?php echo ($lecture[0]['lecture_title']); ?></h3>
	<h2 class='head'>报名分组列表</h2>
	<hr/>
	<form method='post' action="__URL__/lecturelistset" >
		<div >
			<div class="col-sm-11 col-sm-offset-1 ">
			
			 	<table class="table">
			 			<thead>
			 				<tr>
				 				<th>序号</th>
				 				<th>选择</th>
				 				<th>学号</th>
				 				<th>姓名</th>
				 				<th>是否参加</th>
				 				
			 				</tr>
			 			</thead>
				 		<tbody>
				 			<?php if(is_array($lecture)): foreach($lecture as $i=>$v): ?><tr>
					 				<td><label><?php echo ($i+1); ?>：</label></td>
					 				<td><input type="checkbox" value="<?php echo ($v["user_num"]); ?>" name="subBox[]" class="sub-box"></td>
					 				<td><?php echo ($v["user_num"]); ?></td>
					 				<td><?php echo ($v["user_name"]); ?></td>
					 				<td>
					 					<?php if($v['lpresent'] == 1): ?>已参加
					 					<?php else: ?>
					 						<label style="color:blue;">未参加</label><?php endif; ?>
					 				</td>
					 				
					 			</tr><?php endforeach; endif; ?>
				 		</tbody>
			 	</table>
			 	
			</div >
				
		</div>
			
		
		<!--
		<div class="form-group">
			<form id="form" method='post' action="__URL__/insertlectureapply" class="form-horizontal" enctype="multipart/form-data">
				<label for="username" class="col-sm-1   col-sm-offset-1 control-label" >导入:</label>
			 	<div class="col-sm-6">
			 	<label style="color:blue;">每一条记录的格式为：学号/工号+空格+状态(1表示参加，0表示缺席)</label><br/>
			     请选择需要导入的txt文件(大小不超过10M，文件类型为.txt)：
			     <input type='file' name="newsFile"/>
			    </div>
			    <div class="col-sm-2">
			    	<input type='hidden' name="lid" value="<?php echo ($lecture[0]['lecture_id']); ?>"/>
			    	<input type="submit" class="btn btn-primary" value="导 入" >
		  		</div>
		  	</form>		
		 </div>
		 -->
		<div style="height:3em;">
			<hr/>
		</div>
		<div>
		
			<hr/>
			<input  type="hidden" name="lecture_id" value="<?php echo ($lecture[0]['lecture_id']); ?>"/>
			<a id="checkAll" href="javascript:;"class="btn btn-default">全选</a>
			<a id="delAll" href="javascript:;" class="btn btn-default">取消全选</a>
			<input type="submit" name='option3' value="选中导出" class="btn btn-primary">
			<input type="submit" name='option1' value="选中标记" class="btn btn-primary">
			<input type="submit" name='option2' value="取消标记" class="btn btn-primary">
			&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
		</div>
		<div class="modal-footer">
				
	   			<a class="btn btn-primary" href="<?php echo U('Admin/SuperManage/lecture',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
	   			
	   	 </div>
	</form>   	 
	</div>
	<script>
	
	</script>
	
</body>
</html>