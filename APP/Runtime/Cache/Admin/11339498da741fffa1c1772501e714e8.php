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
	<h2 align="center">用户列表</h2>
	<hr/>
		<form id="form" method='post' action="__URL__/insertuser" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group">
				 <label for="username" class="col-sm-1  control-label" >导入:</label>
			 	<div class="col-sm-8">
			 	请选择需要导入的Excel文件(大小不超过10M，文件类型为.xls、.xlsx)：
			     <input type='file' name="newsFile"/>
			    </div>	
			 </div>
			
			<div class="modal-footer" style="width:32%;">
				<label  class="control-label normalfont" style="margin-right:6em;"><a href="<?php echo U('Admin/SuperManage/downfile');?>?filename=.<?php echo ($userFilePath); ?>">用户导入模板下载</a></label>	
	   			<input type="submit" class="btn btn-primary" value="导 入" >
		   </div>
	  	</form>
  	<div style="margin:10px 0;"></div>
	<hr/>		
	
	<table id="dg" title="用户列表" style="width:1200px;height:380px" >
	<?php if(is_array($user)): foreach($user as $key=>$u): ?><tr>
		<td><?php echo ($u["uid"]); ?></td>
		<td><?php echo ($u["unum"]); ?></td>
		<td><?php echo ($u["uname"]); ?></td>
		<td><?php echo ($u['utel']); ?></td>
		<td><?php echo ($u["uprofession"]); ?></td>
		<td><?php echo ($u["upoint"]); ?></td>
		<td><?php echo ($u['role'][0]['name']); ?></td>
		<td>
			<a href="<?php echo U('Admin/SuperManage/userread',array('uid'=>$u['uid'],'unum'=>$unum,'uname'=>$uname));?>">读取&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
			<a href="javascript:void(0)" onclick="pwdreset(<?php echo ($u["uid"]); ?>)">密码重置</a>
		</td>		
	</tr><?php endforeach; endif; ?>
	</table>
	<div style="padding-left:500px;">
	<?php echo ($page); ?>&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
	</div>
	
		<!-- Modal 添加信息开始-->
	<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
					      <input type="text" class="form-control " id="director" name="director" placeholder="不能为空">
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
	  </div>
	</div>
	<!-- Modal 添加信息结束-->
	<script>
	//密码重置
		pwdreset
	function pwdreset(uid){
		alert("重置后不可恢复，确认删除？");
		if(confirm("确认重置")){
			$.ajax({
				type:"POST",
				url:"__URL__/pwdreset/uid/"+uid,
				success:function(data,textStatus,jqXHR){
				alert("重置成功");
					window.location.reload();
	
				},
				error:function(jqXHR,textStatus,errorThrown){
					alert("重置失败");
				}
			})
				
			}
			else{
			
				return;
			}
	}
				
	function deletenews(nid){
		alert("删除后不可恢复，确认删除？");
		if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/newsdelete/nid/"+nid,
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
				if($('#adduserModal #director').val() ==''){
					alert("讲座负责人不能为空");
					return false;
				}
				if($('#adduserModal #dateend').val() ==''){
					alert("报名截止日期不能为空");
					return false;
				}
													
			});
			
		});
		
		
	

		$(function(){
			
			$('#dg').datagrid({
			       fitColumns:true,
					rownumbers:true,
					singleSelect:true,
					autoRowHeight:false,
					columns:[[
					{field:'uid',hidden:true},
					{field:'unum',title:"学号/工号",width:30},
			        {field:'uname',title:'姓名',width:30},
			        {field:'utel',title:"电话",width:60},
			        {field:'uprofession',title:"职称",width:30},
			        {field:'upoint',title:"科创积分",width:30},
			        {field:'role',title:"角色",width:30},
			        {field:'ss',title:"操作",width:40},
			        		        
			   	  ]]
				});
		});
	</script>
</body>
</html>