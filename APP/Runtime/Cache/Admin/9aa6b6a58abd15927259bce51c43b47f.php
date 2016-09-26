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
	<h2 align="center">讲座列表</h2>
	<hr/>
	
	<div style="margin:10px 0;"></div>
	
	
	<table id="dg" title="讲座列表" style="width:1080px;height:380px" >
	<?php if(is_array($lecture)): foreach($lecture as $key=>$u): ?><tr>
		<td><?php echo ($u["lid"]); ?></td>
		<td><?php echo ($u["ltitle"]); ?></td>
		<td><?php echo ($u["llecturer"]); ?></td>
		<td><?php echo ($u["ldate"]); ?></td>
		<td><?php echo ($u["ldirector"]); ?></td>
		<td><?php echo ($u["ldatestart"]); ?></td>
		<td><?php echo ($u["ldateend"]); ?></td>
		<td>
			<?php if($u["lsheet"] == 1): ?>是
			<?php else: ?>
				否<?php endif; ?>
		</td>
		<td>
			<a href="<?php echo U('Admin/Stu/lectureread',array('lid'=>$u['lid'],'unum'=>$unum,'uname'=>$uname));?>">读取</a>
			
		</td>		
	</tr><?php endforeach; endif; ?>
	</table>
	<div style="padding-left:400px;">
	<?php echo ($page); ?>
	</div>
	
	<script>
			
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
		$(function(){
			
			$('#dg').datagrid({
			       fitColumns:true,
					rownumbers:true,
					singleSelect:true,
					autoRowHeight:false,
					
				  columns:[[
					{field:'lid',hidden:true},
					{field:'ltitle',title:"主题",width:90},
			        {field:'llecturer',title:'主讲人',width:30},
			        {field:'ldate',title:"讲座时间",width:60},
			        {field:'ldirector',title:"负责人",width:30},
			        {field:'ldatestart',title:"报名开始时间",width:30},
			        {field:'ldateend',title:"报名结束时间",width:30},
			        {field:'lsheet',title:"是否有讲座单",width:30},
			        {field:'op',title:"操作",width:35},
			        		        
			   	  ]]
				});
		});
	</script>
</body>
</html>