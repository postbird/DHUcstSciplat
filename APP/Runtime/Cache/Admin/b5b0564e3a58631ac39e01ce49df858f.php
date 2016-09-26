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
	<h2 align="center">我参加的项目列表</h2>
	<hr/>
	
	<div style="margin:10px 0;"></div>
	
	
	<table id="dg" title="项目列表" style="width:1300px;height:380px" >
	<?php if(is_array($myprojects)): foreach($myprojects as $key=>$u): ?><tr>
		<td><?php echo ($u["pid"]); ?></td>
		<td><?php echo ($u["pname"]); ?></td>
		<td><?php echo ($u["pclass"]); ?></td>
		<td><?php echo ($u["pcaptainname"]); ?></td>
		<td><?php echo ($u["pcaptainnum"]); ?></td>
		<td><?php echo ($u["pnumber"]); ?></td>
		<td>
			<?php if(is_array($u['user'])): foreach($u['user'] as $key=>$v): if(($v['uprofession'] == '学生') and ($v['unum'] != $u['pcaptainnum'])): echo ($v['uname']); ?>（<?php echo ($v['unum']); ?>）
				<?php else: endif; endforeach; endif; ?>
		</td>
		<td>
			<?php if(is_array($u['user'])): foreach($u['user'] as $key=>$v): if(($v['uprofession'] != '学生')): echo ($v['uname']); ?>
				<?php else: endif; endforeach; endif; ?>
		</td>
		<td>
			<?php if(is_array($u['user'])): foreach($u['user'] as $key=>$v): if(($v['uprofession'] != '学生')): echo ($v['uprofession']); ?>
				<?php else: endif; endforeach; endif; ?>
		</td>
		<td><?php echo ($u["pfather"]); ?></td>
		<td>
			<?php if($u['pstatus'] == 0): ?>未审核
			<?php else: ?>
				<?php if($u['pstatus'] == 1): ?>通过
				<?php else: ?>
					不通过<?php endif; endif; ?>
		</td>
		<td>
			<?php if($u['pleaderstatus'] == 0): ?>未审核
			<?php else: ?>
				<?php if($u['pleaderstatus'] == 1): ?>通过
				<?php else: ?>
					不通过<?php endif; endif; ?>
		</td>
		<td>
			<a href="<?php echo U('Admin/Stu/myprojectread',array('pid'=>$u['pid'],'unum'=>$unum,'uname'=>$uname));?>">读取</a>
			
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
					{field:'pname',title:"项目名称",width:180},
			        {field:'pclass',title:'项目类型',width:45},
			        {field:'pcaptainname',title:"负责人姓名",width:45},
			        {field:'pcaptainnum',title:"负责人学号",width:45},
			        {field:'pnumber',title:"学生人数",width:45},
			        {field:'anotherstu',title:"其他学生",width:100},
			        {field:'pteachername',title:"指导老师",width:45},
			        {field:'pteacherprofesion',title:"老师职称",width:45},
			        {field:'pfather',title:"所属一级学科",width:45},
			        {field:'status1',title:"管理员审核",width:50},
			        {field:'status2',title:"学校审核",width:50},
			        {field:'op',title:"操作",width:35},
			        		        
			   	  ]]
				});
		});
	</script>
</body>
</html>