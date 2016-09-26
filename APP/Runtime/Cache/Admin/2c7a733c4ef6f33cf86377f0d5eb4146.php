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
		
	</style>
	
	<script>
	
	</script>

<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>
</head>
<body>
	<div class='container'>
	<h2 class='head'>项目信息读取修改</h2>
	<hr/>
	 <form id="form2" method='post' action="__URL__/myprojectupdate" class="form-horizontal" enctype="multipart/form-data">
	 
				 <div class="form-group">
					<label for="username" class="col-sm-2  control-label" >项目来源:</label>	
					<div class="col-sm-9">
						<input type="text" class="form-control"  value="<?php echo ($myproject['ftitle']); ?>" readonly="true">
					</div>
					
				</div>
	 			<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >项目名称:</label>		
					<div class="col-sm-9">
						<input type="text" class="form-control" id="title" name="title" value="<?php echo ($myproject['pname']); ?>">
					</div>
					
				</div>
				<hr/>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >管理员审核:</label>
					<div class="col-sm-5" style="margin-top:7px;">
							<?php if($myproject['pstatus'] == 0): ?>未审核
							 <?php else: ?>
								<?php if($myproject['pstatus'] == 1): ?>已通过
								<?php else: ?>
									未通过<?php endif; endif; ?>
				       </div>
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >学校审核:</label>
					<div class="col-sm-5" style="margin-top:7px;">
							<?php if($myproject['pleaderstatus'] == 0): ?>未审核
							<?php else: ?>
								<?php if($myproject['pleaderstatus'] == 1): ?>已通过
								<?php else: ?>
								未通过<?php endif; endif; ?>
				       </div>
				</div>
				<div class="form-group" id='level'>
					<label for="username" class="col-sm-2  control-label" >项目级别:</label>
					<div class="col-sm-5" style="margin-top:7px;">
						<?php echo ($myproject['plevel']); ?>
					</div>	
				</div>
				<hr/>
				<div class="form-group" id='report' >
					<label for="username" class="col-sm-2  control-label" >月报:</label>
					<div class="col-sm-10 col-sm-offset-2">
						<div style="width:950px;">
							<div style="width:400px;height:50px;margin-right:0px;">
								<button class="btn btn-default "  data-toggle="modal" data-target="#adduserModal" style="float:right;">
									填写月报+
								</button>
							</div>
							<table id="dg" title="月报列表"  style="width:300px;">
									<?php if(is_array($myproject['report'])): foreach($myproject['report'] as $i=>$u): ?><tr>
											<td><?php echo ($u["rid"]); ?></td>
											<td><?php echo ($u["ryear"]); ?></td>
											<td><?php echo ($u["rmonth"]); ?></td>
											<td><?php echo ($u["rname"]); ?></td>
											<td>
												<a href="<?php echo U('Admin/Stu/reportread',array('pid'=>$myproject['pid'],'rid'=>$u['rid'],'unum'=>$unum,'uname'=>$uname));?>">读取<?php echo ($pid); ?></a>
												<a href="javascript:void(0)" onclick="deletereport(<?php echo ($myproject['pid']); ?>,<?php echo ($u['rid']); ?>)">删除</a>
											</td>		
										</tr><?php endforeach; endif; ?>
							</table>
						
						</div>
					</div>
				</div>	
				<hr/>
				<div class="form-group" id='middle'>
					<label for="username" class="col-sm-2  control-label" >中期检查:</label>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-2  control-label" >
							<?php if($myproject['pmiddleaccessory'] == ''): ?>未上传
							 <?php else: ?>
						    	已上传<?php endif; ?>
						</label>
						<label for="username" class="col-sm-2 control-label" >附件:</label>
						<label for="username" class="col-sm-2 control-label" >
							<?php if($myproject['pmiddleaccessory'] == ''): else: ?>
						    	<a href="<?php echo U('Admin/Stu/downracefile');?>?filename=.<?php echo ($myproject['pmiddleaccessory']); ?>">中期检查表下载</a><?php endif; ?>
						</label>	
						<label for="username" class="col-sm-2 control-label" >材料审核:</label>
						<label for="username" class="col-sm-2  control-label" >
							<?php if($myproject['pmiddlecheck'] == 1): ?>已通过
								 <?php else: ?>
							    	<?php if($myproject['pmiddlecheck'] == 0): ?>未审核
							    	<?php else: ?>
							    		未通过<?php endif; endif; ?>
						</label>    
					</div>
					
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					 <div class="col-sm-10 col-sm-offset-2">	
						<div class="col-sm-4" id='middlediv'>
							请上传中期检查表(大小不超过10M，文件类型为.doc,.docx)：
					    	<input type='file' name="middleFile" id='middleFile'/>
					    </div>
					</div>	 
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<?php if($myproject['pmiddlerank'] != 0): ?><label for="username" class="col-sm-2  control-label" >答辩排名:</label>
							<div class="col-sm-4">
								<label for="username" class="col-sm-2  control-label" ><?php echo ($myproject['pmiddlerank']); ?></label>
							</div>
						<?php else: endif; ?>
						<?php if($myproject['pmiddlescore'] != 0): ?><label for="username" class="col-sm-2  control-label" >答辩分数:</label>
							<div class="col-sm-4">
								<label for="username" class="col-sm-2  control-label" ><?php echo ($myproject['pmiddlescore']); ?></label>
							</div>
						<?php else: endif; ?>
						
					</div>       		
				</div>
				<hr/>
				<div class="form-group" id='last'>
					<label for="username" class="col-sm-2  control-label" >结题:</label>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-2  control-label" >
							<?php if($myproject['plastaccessory'] == ''): ?>未上传
							 <?php else: ?>
						    	已上传<?php endif; ?>
						</label>
						<label for="username" class="col-sm-2 control-label" >附件:</label>
						<label for="username" class="col-sm-2 control-label" >
							<?php if($myproject['plastaccessory'] == ''): else: ?>
						    	<a href="<?php echo U('Admin/Stu/downracefile');?>?filename=.<?php echo ($myproject['plastaccessory']); ?>">结题资料下载</a><?php endif; ?>
						</label>	
						<label for="username" class="col-sm-2 control-label" >材料审核:</label>
						<label for="username" class="col-sm-2  control-label" >
							<?php if($myproject['plastcheck'] == 1): ?>已通过
								 <?php else: ?>
							    	<?php if($myproject['plastcheck'] == 0): ?>未审核
							    	<?php else: ?>
							    		未通过<?php endif; endif; ?>
						</label>    
					</div>
					
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					 <div class="col-sm-10 col-sm-offset-2">	
						<div class="col-sm-4" id='lastdiv'>
							请上传解题资料(大小不超过30M，文件类型为.zip,.rar)：
					    	<input type='file' name="lastFile" id='lastFile'/>
					    </div>
					</div>	 
					
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<?php if($myproject['plastrank'] != 0): ?><label for="username" class="col-sm-2  control-label" >答辩排名:</label>
							<div class="col-sm-4">
								<label for="username" class="col-sm-2  control-label" ><?php echo ($myproject['plastrank']); ?></label>
							</div>
						<?php else: endif; ?>
						<?php if($myproject['plastscore'] != 0): ?><label for="username" class="col-sm-2  control-label" >答辩分数:</label>
							<div class="col-sm-4">
								<label for="username" class="col-sm-2  control-label" ><?php echo ($myproject['plastscore']); ?></label>
							</div>
						<?php else: endif; ?>
						
					</div>       		
				</div>
				<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >项目类型:</label>
						<div class="col-sm-3">
							<select id="class" name="class" class="form-control">
								<?php if($myproject['pclass'] == '创新训练'): ?><option value='创新训练' selected='selected'>创新训练</option>
								<?php else: ?>
									<option value='创新训练'>创新训练</option><?php endif; ?>
								<?php if($myproject['pclass'] == '创业训练'): ?><option value='创业训练' selected='selected'>创业训练</option>
								
								<?php else: ?>
									<option value='创业训练'>创业训练</option><?php endif; ?>
								<?php if($myproject['pclass'] == '创业实践'): ?><option value='创业实践' selected='selected'>创业实践</option>
								<?php else: ?>
									<option value='创业实践'>创业实践</option><?php endif; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >学生人数:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="number" name="number" value="<?php echo ($myproject['pnumber']); ?>">
						</div>
						<label for="username" class="col-sm-2  control-label" >一级学科:</label>
						<div class="col-sm-4">
							<select id="father" name="father" class="form-control">
								<?php if($myproject['pfather'] == '计算机科学与技术'): ?><option value='计算机科学与技术' selected='selected'>计算机科学与技术</option>
								<?php else: ?>
									<option value='计算机科学与技术'>计算机科学与技术</option><?php endif; ?>
								<?php if($myproject['pfather'] == '软件工程'): ?><option value='软件工程' selected='selected'>软件工程</option>
								
								<?php else: ?>
									<option value='软件工程'>软件工程</option><?php endif; ?>
								
							</select>
						</div>
					</div>
					
					<hr/>
					<div class="form-group">
						<table class='table'>
							<thead>
								<th>组成员序号</th>
								<th>姓名</th>
								<th>学号</th>
								<th>角色</th>
							</thead>
							<tbody>
								<?php if(is_array($myproject['user'])): foreach($myproject['user'] as $i=>$v): ?><tr>
										<?php if($v['uprofession'] == '学生'): ?><td><?php echo ($i+1); ?></td>
											<td><?php echo ($v['unum']); ?></td>
											<td><?php echo ($v['uname']); ?></td>
											<td>
												<?php if($v['unum'] == $myproject['pcaptainnum']): ?>队长
												<?php else: ?>
													队员<?php endif; ?>
											</td>
										<?php else: endif; ?>
									</tr><?php endforeach; endif; ?>
							</tbody>
						</div>
						</table>
					</div>
					<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >指导老师:</label>
						<div class="col-sm-9 col-sm-offset-1">
							<?php if(is_array($myproject['user'])): foreach($myproject['user'] as $key=>$v): if($v['uprofession'] != '学生'): ?><label for="username" class="col-sm-3  control-label" ><?php echo ($v["uname"]); ?>(<?php echo ($v["uprofession"]); ?>)</label>
									<?php else: endif; endforeach; endif; ?>
						</div>
					</div>
					<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >项目简介:</label>
						<label class="col-sm-3  control-label"  style='color:blue;'>字数在100字以内</label>
					</div>
					<div class="form-group">
					 <div class="col-sm-10 col-sm-offset-1">
					      <textarea  id="content" name="content" class="form-control" style="height:200px;"><?php echo ($myproject['pcontent']); ?></textarea>
					  </div>
					</div> 
					<div class="form-group" id="applydiv">
						 <label for="username" class="col-sm-2  control-label" >附件:</label>
						  请上传项目申请书(大小不超过10M，文件类型为.doc,.docx)：
						 <input type='file' name="applyFile" id='applyFile'/>
					 		
					</div>
					<div class="form-group" >
						<div class="col-sm-8 col-sm-offset-2" style='margin-top:7px;'>
					        <?php if($myproject['paccessory'] == ''): else: ?>
						    	 <a href="<?php echo U('Admin/Stu/downracefile');?>?filename=.<?php echo ($myproject['paccessory']); ?>">项目申请书下载</a><?php endif; ?>   			    	
					    </div>	
					</div>
				<div class="modal-footer">
					<input type='hidden',id='pid' name='pid' value="<?php echo ($myproject['pid']); ?>">
					<input type='hidden',id='applyfile' name='applyfile' value="<?php echo ($myproject['paccessory']); ?>">
					<input type='hidden',id='middlefile' name='middlefile' value="<?php echo ($myproject['pmiddleaccessory']); ?>">
					<input type='hidden',id='lastfile' name='lastfile' value="<?php echo ($myproject['plastaccessory']); ?>">
		   			<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
		   			<input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'>
				   	 <a class="btn btn-primary" href="<?php echo U('Admin/Stu/myproject',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
				   	 <?php if($myproject['pendstatus']): else: ?>
					   		 <input type="submit" class="btn btn-primary" value="保 存" ><?php endif; ?>
				   	
				   	 
			   </div>
		  </form>
		  
   
	</div>
	<!-- Modal 添加信息开始-->
		<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">填写月报</h4>
		      </div>
		      <div class="modal-body">
		        <form id="form1" method='post' action="__URL__/addreport" class="form-horizontal" enctype="multipart/form-data">
			
				  	<div class="form-group">
				  		<label for="username" class="col-sm-2 control-label" >年度:</label>
					 	<div class="col-sm-3 ">
					      	<input type='text' class="form-control " id="year" name="year"  value="20">
					    </div>
					    <label for="username" class="col-sm-2 col-sm-offset-1 control-label" >月份:</label>
					    <div class="col-sm-4">
						     <select id="month" name="month" class="form-control">
									<option value='0'>=请选择月份=</option>
									<option value='1'>一月</option>
									<option value='2'>二月</option>
									<option value='3'>三月</option>
									<option value='4'>四月</option>
									<option value='5'>五月</option>
									<option value='6'>六月</option>
									<option value='7'>七月</option>
									<option value='8'>八月</option>
									<option value='9'>九月</option>
									<option value='10'>十月</option>
									<option value='11'>十一月</option>
									<option value='12'>十二月</option>
								</select>
					    </div>
				    </div>
					<hr>
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label" >内容:</label>
						<div class="col-sm-10 " >
					      <textarea  id="reportcontent" name="reportcontent" class="form-control" style="height:200px;"></textarea>
					    </div>
					</div>
					
			   <div class="modal-footer">
			   <input type='hidden',id='project_id' name='project_id' value="<?php echo ($myproject['pid']); ?>">
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
	if(<?php echo ($myproject["pstatus"]); ?>=='1'){
		var z=document.getElementById('title');
		z.setAttribute('readonly','true');
		var z=document.getElementById('class');
		z.setAttribute('readonly','true');
		var z=document.getElementById('number');
		z.setAttribute('readonly','true');
		var z=document.getElementById('father');
		z.setAttribute('readonly','true');
		var z=document.getElementById('content');
		z.setAttribute('readonly','true');
		//隐藏项目申请书上传
		var z=document.getElementById('applydiv');
		z.style.display="none";
	}
	if(<?php echo ($myproject["pleaderstatus"]); ?>!='1'){
		//隐藏月报
		var z=document.getElementById('level');
		z.style.display="none";
		var z=document.getElementById('report');
		z.style.display="none";
		var z=document.getElementById('middle');
		z.style.display="none";	
		var z=document.getElementById('last');
		z.style.display="none";
				
		}
	//隐藏中期模块
	if(<?php echo ($myproject["pmiddlestatus"]); ?>!='1'){
			var z=document.getElementById('middle');
			z.style.display="none";	
			var z=document.getElementById('last');
			z.style.display="none";
		}
	//隐藏中期检查表上传
	if(<?php echo ($myproject["pmiddlecheck"]); ?>=='1'){
		var z=document.getElementById('middlediv');
		z.style.display="none";
		}
	//隐藏结题模块
	if(<?php echo ($myproject["plaststatus"]); ?>!='1'){
		var z=document.getElementById('last');
		z.style.display="none";
	}
	//隐藏结题资料上传
	if(<?php echo ($myproject["plastcheck"]); ?>=='1'){
		var z=document.getElementById('lastdiv');
		z.style.display="none";
		}
	
	
	//删除月报
	function deletereport(pid,rid){
		alert("删除后不可恢复，确认删除？");
		if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/reportdelete/pid/"+pid+"/rid/"+rid,
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
		$('#adduserbtn').click(function(){
			if($('#adduserModal #month').val() =='0'){
					alert("请选择月份！");
					return false;
				}
					
												
		});
		$('#dg').datagrid({
		       fitColumns:true,
				rownumbers:true,
				singleSelect:true,
				autoRowHeight:false,
				
			  columns:[[
				{field:'rid',hidden:true},
				{field:'ryear',title:"年度",width:200},
				{field:'rmonth',title:"月份",width:200},
				{field:'rname',title:"填写人",width:200},
		        {field:'op',title:"操作",width:200},
		        		        
		   	  ]]
			});
	});
	</script>
	
</body>
</html>