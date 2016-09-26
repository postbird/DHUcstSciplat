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
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>
</head>
<body style="padding:20px 20px 0px 20px">
	<h2 align="center">竞赛列表</h2>
	<hr/>
	
	<br/>
	<button class="btn btn-default "  data-toggle="modal" data-target="#adduserModal">
					发布竞赛
			</button>

	<div style="margin:10px 0;"></div>
	
	<form method='post' action="__URL__/outputrace" >	
		<table id="dg" title="竞赛列表" style="width:1080px;height:380px" >
		<?php if(is_array($race)): foreach($race as $key=>$u): ?><tr>
			<td><?php echo ($u["rid"]); ?></td>
			<td><input type="checkbox" value="<?php echo ($u["rid"]); ?>" name="subBox[]" class="sub-box"></td>
			<td><?php echo ($u["rname"]); ?></td>
			<td><?php echo ($u["rdatestart"]); ?></td>
			<td><?php echo ($u["rdateend"]); ?></td>
			<td><?php echo ($u["rsponsor"]); ?></td>
			<td><?php echo ($u["rlevel"]); ?></td>
			<td>
				<?php if($u["rstatus"] == 1): ?>是
				<?php else: ?>
					否<?php endif; ?>
			</td>
			<td>
				<a href="<?php echo U('Admin/SuperManage/raceread',array('rid'=>$u['rid'],'unum'=>$unum,'uname'=>$uname));?>">读取</a>
				<a href="<?php echo U('Admin/SuperManage/racegroup',array('rid'=>$u['rid'],'unum'=>$unum,'uname'=>$uname,));?>">查看报名</a>
				<a href="javascript:void(0)" onclick="deleterace(<?php echo ($u["rid"]); ?>)">删除</a>
			</td>		
		</tr><?php endforeach; endif; ?>
		</table>
		<a id="checkAll" href="javascript:;"class="btn btn-default">全选</a>
		<a id="delAll" href="javascript:;" class="btn btn-default">取消全选</a>
		<input type="submit" name='option1' value="导出选中选项" class="btn btn-primary">
		&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
	</form>	
	<div style="padding-left:400px;">
	<?php echo ($page); ?>
	</div>
	
	<!-- Modal 添加信息开始-->
		<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">发布竞赛</h4>
		      </div>
		      <div class="modal-body">
		        <form id="form1" method='post' action="__URL__/raceinsert" class="form-horizontal" enctype="multipart/form-data">
			
				  	<div class="form-group">
					 	<div class="col-sm-10 col-sm-offset-1">
					      <input type='text' class="form-control " id="name" name="name"  placeholder="竞赛名称">
					    </div>
				    </div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label" >开始日期:</label>
					    <div class="col-sm-3">
					      <input type="text" class="form-control " id="datestart" name="datestart"  onClick="WdatePicker()" placeholder="不能为空">
					    </div>
					    <label for="username" class="col-sm-2  control-label" >截止日期:</label>
					    <div class="col-sm-3">
					      <input type="text" class="form-control " id="dateend" name="dateend"  onClick="WdatePicker()" placeholder="不能为空">
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <textarea  id="content" name="content" ></textarea>
					    </div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label" >主办/承办单位:</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control " id="sponsor" name="sponsor" placeholder="不能为空">
					    </div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >竞赛级别:</label>
					    <div class="col-sm-4">
				   		 	<select id="level" name="level" class="form-control">
								<option value='0'>=请选择竞赛级别=</option>
								<option value='院级'>院级</option>
								<option value='校级'>校级</option>
								<option value='市级'>市级</option>
								<option value='国家级及国家级以上'>国家级及国家级以上</option>
							</select>
					   </div>
					</div>
					
				 <div class="form-group">
					 <label for="username" class="col-sm-2  control-label" >附件:</label>
				 	<div class="col-sm-8">
				     请选择需要上传的文件(大小不超过10M，文件类型为.doc,.pdf,.zip)：
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
		
	function deleterace(rid){
		alert("删除后和此竞赛有关的数据不可恢复，确认删除？");
		if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/racedelete/rid/"+rid,
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
				if($('#adduserModal #name').val() ==''){
						alert("竞赛名称不能为空");
						return false;
					}
				if($('#adduserModal #datestart').val() ==''||$('#adduserModal #dateend').val() ==''){
					alert("日期不能为空");
					return false;
				}
				if($('#adduserModal #sponsor').val() ==''){
					alert("主办/承办单位不能为空");
					return false;
				}
				if($('#adduserModal #level').val() =='0'){
					alert("请选择一个级别");
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
					{field:'rid',hidden:true},
					{field:' ',title:" ",width:15},
					{field:'rname',title:"竞赛名称",width:200},
			        {field:'rdatestart',title:'开始日期',width:45},
			        {field:'rdateend',title:"结束日期",width:45},
			        {field:'rsponsor',title:"主办/承办单位",width:100},
			        {field:'rlevel',title:"竞赛级别",width:50},
			        {field:'rstatus',title:"发布状态",width:40},
			        {field:'op',title:"操作",width:70},
			        		        
			   	  ]]
				});
		});
	</script>
</body>
</html>