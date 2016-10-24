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
		$(document).ready(function(){
			
             $("#checkAll").click(function(){
            	 var a=0;
				  $(".sub-box").each(function(){
				  	if(a>=($(".sub-box").length/2)){
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
	<h2 align="center">项目信息列表</h2>
	<hr/>
	
	<br/>
	<!-- data-toggle="modal" data-target="#adduserModal" -->
	<a class="btn btn-default " href="__URL__/addProject/unum/<?php echo ($unum); ?>/uname/<?php echo ($uname); ?>" >
					发布项目
			</a>

	<div style="margin:10px 0;"></div>
	
	<form method='post' action="__URL__/projectnewslistset" >
		<table id="dg" title="项目信息列表" style="width:1080px;height:380px" >
		<?php if(is_array($projectnews)): foreach($projectnews as $key=>$u): ?><tr>
			<td><?php echo ($u["pid"]); ?></td>
			<td><input type="checkbox" value="<?php echo ($u["pid"]); ?>" name="subBox[]" class="sub-box"></td>
			<td><?php echo ($u["ptitle"]); ?></td>
			<td><?php echo ($u["pdatestart"]); ?></td>
			<td><?php echo ($u["pdateend"]); ?></td>
			<td>
				<?php if($u["pstatus"] == 1): ?>是
				<?php else: ?>
					否<?php endif; ?>
			</td>
			<td>
				<?php if($u["ptop"] == 1): ?><span class='red'>是</span>
				<?php else: ?>
					否<?php endif; ?>
			</td>
			<td>
				<a href="<?php echo U('Admin/SuperManage/projectnewsread',array('pid'=>$u['pid'],'unum'=>$unum,'uname'=>$uname));?>">编辑</a>
				<a href="<?php echo U('Admin/SuperManage/searchproject',array('searchfid'=>$u['pid'],'unum'=>$unum,'uname'=>$uname));?>">察看申报</a>
				<a href="javascript:void(0)" onclick="deleteproject(<?php echo ($u["pid"]); ?>)">删除</a>
			</td>		
		</tr><?php endforeach; endif; ?>
		</table>
		<div style="padding-left:400px;">
		<?php echo ($page); ?>
		</div>
		<a id="checkAll" href="javascript:;"class="btn btn-default">全选</a>
		<a id="delAll" href="javascript:;" class="btn btn-default">取消全选</a>
		<input type="submit" name='option1' value="选中置顶" class="btn btn-primary">
		<input type="submit" name='option2' value="取消置顶" class="btn btn-primary">
		&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
	</form>
	<!-- Modal 添加信息开始-->
		<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">发布项目</h4>
		      </div>
		      <div class="modal-body">
		        <form id="form1" method='post' action="__URL__/projectnewsinsert" class="form-horizontal" enctype="multipart/form-data">
			
				  	<div class="form-group">
					 	<div class="col-sm-10 col-sm-offset-1">
					      <input type='text' class="form-control " id="title" name="title"  placeholder="项目信息标题">
					    </div>
				    </div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label" >开始日期:</label>
					    <div class="col-sm-3">
					      <input type="text" class="form-control " id="datestart" name="datestart"  onClick="WdatePicker()" >
					    </div>
					    <label for="username" class="col-sm-2  control-label" >截止日期:</label>
					    <div class="col-sm-3">
					      <input type="text" class="form-control " id="dateend" name="dateend"  onClick="WdatePicker()" placeholder="不能为空">
					    </div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label" >项目级别:</label>
					    <div class="col-sm-3">
					     <select id='level' name="level" class='form-control'>
					     	<option value="0">=请选择级别=</option>
					     	<option value="国家级">国家级</option>
					     	<option value="上海市级">上海市级</option>
					     	<option value="校级">校级</option>
					     	<option value="院级">院级</option>
					     </select>
					    </div>
					    <label for="username" class="col-sm-2  control-label" >项目类型:</label>
					    <div class="col-sm-3">
						      <select id='class' name="class" class='form-control'>
						     	<option value="0">=请选择类型=</option>
						     	<option value="创新训练">创新训练</option>
						     	<option value="创业训练">创业训练</option>
						     	<option value="创业实践">创业实践</option>
						     	
						     </select>
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <textarea  id="content" name="content" ></textarea>
					    </div>
					</div>
					
				 <div class="form-group">
					 <label for="username" class="col-sm-2  control-label" >附件:</label>
				 	<div class="col-sm-8">
				     请选择需要上传的项目申请书模版(大小不超过10M，文件类型为.doc,.docx)：
				     <input type='file' name="raceFile"/>
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
		
	function deleteproject(pid=0){
		if(confirm("确认删除?")){
			$.ajax({
				type:"json",
				url:"__URL__/projectDelete/pid/"+pid,
				success:function(data){
					if(data.status=="ok"){
						window.location.reload();
					}else{
						alert("删除失败");
					}
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
						alert("项目信息标题不能为空");
						return false;
					}
				if($('#adduserModal #dateend').val() ==''){
					alert("截止日期不能为空");
					return false;
				}
				if($('#adduserModal #level').val() ==0){
					alert("请选择项目级别");
					return false;
				}
				if($('#adduserModal #class').val() ==0){
					alert("请选择项目类型");
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
					{field:'pid',hidden:true},
					{field:' ',title:" ",width:15},	
					{field:'ptitle',title:"项目信息标题",width:200},
			        {field:'pdatestart',title:'开始日期',width:45},
			        {field:'pdateend',title:"结束日期",width:45},
			        {field:'pstatus',title:"发布状态",width:40},
			        {field:'ptop',title:"是否置顶",width:40},
			        {field:'op',title:"操作",width:65},
			        		        
			   	  ]]
				});
		});
	</script>
</body>
</html>