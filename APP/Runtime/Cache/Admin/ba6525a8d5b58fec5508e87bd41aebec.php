<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<style css='text/css'>
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:50%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
		
	</style>
	
	<script>
	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
	window.onload=function(){
			window.UEDITOR_CONFIG.initialFrameHeight=250;
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
<body style="padding:20px 20px 0px 20px">
		<!-- Modal 添加信息开始-->
	    <div class="container col-md-12">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myModalLabel">发布信息</h4>
	      </div>
	      <div class="modal-body">
	        <form id="form1" method='post' action="__URL__/insertlecture" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <input type="text" class="form-control " id="title" name="title" placeholder="主题">
					    </div>
					</div>
			  		<div class="form-group">
			  			 <div class="col-sm-10 col-sm-offset-1">
					      <textarea  id="content" name="content" ></textarea>
					    </div>
			  		</div>
			  		<div class="form-group">
			  			<label for="username" class="col-sm-2 control-label" >报名开始时间:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="datestart" name="datestart" onClick="WdatePicker()"  >
					    </div>
					    <label for="username" class="col-sm-2 control-label" >报名结束时间:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="dateend" name="dateend" onClick="WdatePicker()" placeholder="不能为空">
					    </div>
			  		</div>
			  		
			  		<hr/>
			  		<div class="form-group">
			  			<label for="username" class="col-sm-2 control-label" >主讲人:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="lecturer" name="lecturer" placeholder="不能为空">
					    </div>
			  		</div>
			  		<div class="form-group">
			  			<label for="username" class="col-sm-2 control-label" >讲座时间:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="date" name="date" placeholder="不能为空">
					    </div>
			  		</div>
			  		<div class="form-group">
			  			<label for="username" class="col-sm-2 control-label" >讲座地点:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="place" name="place" placeholder="不能为空">
					    </div>
			  		</div>
			  		
			  		<div class="form-group">
			  			<label for="username" class="col-sm-2 control-label" >负责人:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="director" name="director" value="<?php echo ($uname); ?>(<?php echo ($unum); ?>)" readonly="true">
					    </div>
					    <label for="username" class="col-sm-2 control-label" >负责人电话:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="diretortel" name="directortel">
					    </div>
			  		</div>
			  		<div class="form-group">
			  			<label for="username" class="col-sm-2 control-label" >是否有讲座单子:</label>
			  			<div class="col-sm-4">
					     	<input type="radio"   name="sheet" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
				       		<input type="radio"   name="sheet" value='0' style="width: 50px"/>&nbsp;&nbsp;否
					     </div>
			  			<label for="username" class="col-sm-2 control-label" >预计人数:</label>
			  			<div class="col-sm-4">
					      <input type="text" class="form-control " id="num" name="num">
					    </div>
			  		</div>
					
			   <div class="modal-footer">
			   	
			   	<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
			   	<input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'>
			   	<input type="submit" class="btn btn-primary" value="保 存" id="adduserbtn" name="adduserbtn">
		      </div>
		  
		  </form>
	      </div>
	    </div>
	<!-- Modal 添加信息结束-->
	<script>
		
	function mylecturedelete(lid){
		alert("删除后不可恢复，确认删除？");
		if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/mylecturedelete/lid/"+lid,
				success:function(data,textStatus,jqXHR){
				alert("删除成功");
					window.location.reload();
	
				},
				error:function(jqXHR,textStatus,errorThrown){
					alert("删除失败");
				}
			})
				
			}
			else{
			
				return;
			}
	}
						
	$(function(){
			$('#searchbtn').click(function(){
				if($('#searchcontent').val() == ''){
					alert('请输入查询内容');
					return false;
				}else{
					$('#searchform').submit();
				}
										
			});
			
		});
		
		$(function(){
			$('#adduserbtn').click(function(){
				if($('#adduserModal #title').val() ==''){
						alert("标题不能为空");
						return false;
					}			
				if($('#adduserModal #lecturer').val() ==''){
					alert("主讲人不能为空");
					return false;
				}
				if($('#adduserModal #date').val() ==''){
					alert("讲座时间不能为空");
					return false;
				}
				if($('#adduserModal #place').val() ==''){
					alert("讲座地点不能为空");
					return false;
				}
				
				if($('#adduserModal #dateend').val() ==''){
					alert("报名截止日期不能为空");
					return false;
				}
													
			});
			
		});
		
	</script>
</body>
</html>