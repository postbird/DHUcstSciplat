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
	<h2 align="center">项目信息列表</h2>
	<hr/>
	
	<div style="margin:10px 0;"></div>
	
	
	<table id="dg" title="项目信息列表" style="width:1080px;height:380px" >
	<?php if(is_array($projectnews)): foreach($projectnews as $key=>$u): ?><tr>
		<td><?php echo ($u["pid"]); ?></td>
		<td><?php echo ($u["ptitle"]); ?></td>
		<td><?php echo ($u["pdatestart"]); ?></td>
		<td><?php echo ($u["pdateend"]); ?></td>
		<td>
			<a href="<?php echo U('Admin/Stu/projectnewsread',array('pid'=>$u['pid'],'unum'=>$unum,'uname'=>$uname,'isleader'=>$u['isleader']));?>">查看</a>
			<?php if($u['isleader'] == 1): ?>已担任队长
			<?php else: ?>
				&nbsp;<?php endif; ?>
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
			
			$('#dg').datagrid({
			       fitColumns:true,
					rownumbers:true,
					singleSelect:true,
					autoRowHeight:false,
					
				  columns:[[
					{field:'pid',hidden:true},
					{field:'ptitle',title:"项目信息标题",width:200},
			        {field:'pdatestart',title:'开始日期',width:45},
			        {field:'pdateend',title:"结束日期",width:45},
			          {field:'op',title:"操作",width:35},
			        		        
			   	  ]]
				});
		});
	</script>
</body>
</html>