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
		.modal-dialog{width:40%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
		.normalfont{font-weight:normal;}
		.stumargintop{margin-top:0.7em;}
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
						<label  class="col-sm-2 control-label normalfont" ><?php echo ($lecture['ldirector']); ?></label>
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
					<hr/>
					
					<div class="form-group">
						<div style="margin:1em auto;width:10%;">
							<?php if($lecture['subtime'] == 1): ?><label  class="control-label" >已截止</label>
							<?php else: ?>
								<?php if($isapply == 1): ?><label  class="control-label" >已申请</label>
								<?php else: ?>
									<a href="javascript:void(0)" onclick="lectureapply(<?php echo ($lecture["lid"]); ?>,<?php echo ($unum); ?>)">申请讲座</a><?php endif; endif; ?>
						</div>
						
					</div>
			  		<div class="modal-footer">
		   			 	 <a class="btn btn-primary" href="<?php echo U('Admin/Stu/lecture',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
					</div>
		</form>
	</div>
	
<script>
	
	function lectureapply(lid,unum){
		alert("申请后不可撤销，确认申请？");
		if(confirm("确认申请")){
			$.ajax({
				type:"POST",
				url:"__URL__/lectureapply/lid/"+lid+"/unum/"+unum,
				success:function(data,textStatus,jqXHR){
				alert("申请成功");
					window.location.reload();
	
				},
				error:function(jqXHR,textStatus,errorThrown){
					alert("申请失败");
				}
			})
				
			}
			else{
			
				return;
			}
	}
	$(function(){
		$('#adduserbtn').click(function(){
			if($('#adduserModal #bonus').val() =='0'){
					alert("请选择竞赛获奖级别！");
					return false;
				}
					
		});
		$('#adduserbtn').click(function(){
			if($('#adduserModal #raceFile').val() ==''){
					alert("请上传附件！");
					return false;
				}
					
		});
		$('#adduserbtn').click(function(){
			if($('#adduserModal #imageread').val() ==''){
					alert("请上传证书照片！");
					return false;
				}
					
		});
	});
</script>
	
</body>
</html>