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
		.margin-top{margin-top:7px;}
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
	 <form id="form2" method='post' action="__URL__/projectupdate" class="form-horizontal" enctype="multipart/form-data">
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >项目来源:</label>
					<div class="col-sm-10">
								<input type="text" class="form-control"  value="<?php echo ($project['ftitle']); ?>" readonly="true">
						</div>
				</div>	
	 			<div class="form-group">
	 				<label for="username" class="col-sm-2  control-label" >项目名称:</label>
					<div class="col-sm-10">
							<input type="text" class="form-control" id="title" name="title" value="<?php echo ($project['pname']); ?>" >
					</div>
				</div>
				<hr/>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >管理员审核:</label>
					<div class="col-sm-5">
							<?php if($project['pstatus'] == 0): ?><input type="radio" id="adminstatus" name="status" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       		<input type="radio" id="adminstatus" name="status" value='2' style="width: 50px"/>&nbsp;&nbsp;不通过
					       		<input type="radio" id="adminstatus"  name="status" value='0' checked='checked' style="width: 50px"/>&nbsp;&nbsp;未审核
						    <?php else: ?>
								<?php if($project['pstatus'] == 1): ?><label class='margin-top' >已通过</label>
					       			<input type="hidden" id="adminstatus" name="status" value='1' style="width: 50px"/>
					       		<?php else: ?>
									<input type="radio" id="adminstatus" name="status" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       			<input type="radio" id="adminstatus" name="status" value='2' checked='checked' style="width: 50px"/>&nbsp;&nbsp;不通过<?php endif; endif; ?>
				       </div>
				     <label for="username" class="col-sm-4  control-label" style='color:red;'>通过之后，不可更改！</label>
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >年度:</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="annual" name="annual" value="<?php echo ($project['pannual']); ?>">
						
					</div>	
					<label class="col-sm-1  control-label" style="text-align:left !important;">年</label>
				</div>
				<hr/>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >学校审核:</label>
					<div class="col-sm-5">
							<?php if($project['pleaderstatus'] == 0): ?><input type="radio" id="leaderstatus1" name="leaderstatus" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       		<input type="radio" id="leaderstatus2" name="leaderstatus" value='2' style="width: 50px"/>&nbsp;&nbsp;不通过
					       		<input type="radio" id="leaderstatus0" name="leaderstatus" value='0' checked='checked' style="width: 50px"/>&nbsp;&nbsp;未审核
						    <?php else: ?>
								<?php if($project['pleaderstatus'] == 1): ?><label class='margin-top'>已通过</label>
					       			<input type="hidden" id="leaderstatus1" name="leaderstatus" value='1' style="width: 50px"/>
				       			<?php else: ?>
									<input type="radio" id="leaderstatus1" name="leaderstatus" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       			<input type="radio" id="leaderstatus2" name="leaderstatus" value='2' checked='checked' style="width: 50px"/>&nbsp;&nbsp;不通过<?php endif; endif; ?>
				       </div>
				       <label for="username" class="col-sm-4  control-label" style='color:red;'>通过之后，不可更改而且部分信息不能变动！</label>
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >项目级别:</label>
					<div class="col-sm-3">
						<select id="level" name="level" class="form-control">
							<?php if($project['plevel'] == '0'): ?><option value='0' selected='selected'>=请选择级别=</option><?php else: endif; ?>
							<?php if($project['plevel'] == '国家级'): ?><option value='国家级' selected='selected'>国家级</option><?php else: ?><option value='国家级' >国家级</option><?php endif; ?>
							<?php if($project['plevel'] == '上海市级'): ?><option value='上海市级' selected='selected'>上海市级</option><?php else: ?><option value='上海市级' >上海市级</option><?php endif; ?>
							<?php if($project['plevel'] == '校级'): ?><option value='校级' selected='selected'>校级</option><?php else: ?><option value='校级' >校级</option><?php endif; ?>
							<?php if($project['plevel'] == '院级'): ?><option value='院级' selected='selected'>院级</option><?php else: ?><option value='院级' >院级</option><?php endif; ?>
						</select>
					</div>	
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2  control-label" >月报开始日期:</label>
					<div class="col-sm-3">
						 <input type="text" class="form-control " id="checkdate" name="checkdate"  onClick="WdatePicker()" value="<?php echo ($project['pcheckdate']); ?>">
					</div>	
				</div>
				<hr/>
				<div class="form-group" id='report'>
					<label for="username" class="col-sm-2  control-label" >月报:</label>
					<div class="col-sm-10 col-sm-offset-2">
						<div id='report' style="width:950px;">
							
							<table id="dg" title="月报列表"  style="width:300px;">
									<?php if(is_array($project['report'])): foreach($project['report'] as $i=>$u): ?><tr>
											<td><?php echo ($u["rid"]); ?></td>
											<td><?php echo ($u["ryear"]); ?></td>
											<td><?php echo ($u["rmonth"]); ?></td>
											<td><?php echo ($u["rname"]); ?></td>
											<td>
												<a href="<?php echo U('Admin/Stu/reportread',array('pid'=>$myproject['pid'],'rid'=>$u['rid'],'unum'=>$unum,'uname'=>$uname));?>">读取<?php echo ($pid); ?></a>
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
						<label for="username" class="col-sm-2  control-label" >是否答辩:</label>
						<div class="col-sm-4">
							<?php if($project['pmiddlestatus'] == 1): ?><input type="radio"  name="middlestatus" value='1' checked='checked' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
			       				<input type="radio"  name="middlestatus" value='0' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;否
							<?php else: ?>
								<input type="radio"  name="middlestatus" value='1'  style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
			       				<input type="radio"  name="middlestatus" value='0' checked='checked' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;否<?php endif; ?>
						</div>	
						<label for="username" class="col-sm-2  control-label" >中期检查表:</label>
						<div class="col-sm-4" style="margin-top:7px;">
							<?php if($project['pmiddleaccessory'] == ''): else: ?>
						    	 <a href="<?php echo U('Admin/SuperManage/downprojectfile',array('pid'=>$project['pid'],'class'=>'中期检查表'));?>">中期检查表</a><?php endif; ?> 
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-2  control-label" >材料审核:</label>
						<div class="col-sm-7">
							<?php if($project['pmiddlecheck'] == 0): ?><input type="radio"  name="middlecheck" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       		<input type="radio"  name="middlecheck" value='2' style="width: 50px"/>&nbsp;&nbsp;不通过
					       		<input type="radio"  name="middlecheck" value='0' checked='checked' style="width: 50px"/>&nbsp;&nbsp;未审核
						    <?php else: ?>
								<?php if($project['pmiddlecheck'] == 1): ?><input type="radio"  name="middlecheck" value='1' checked='checked' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       			<input type="radio"  name="middlecheck" value='2'  style="width: 50px"/>&nbsp;&nbsp;不通过
				       			<?php else: ?>
									<input type="radio"  name="middlecheck" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       			<input type="radio"  name="middlecheck" value='2' checked='checked' style="width: 50px"/>&nbsp;&nbsp;不通过<?php endif; endif; ?>
						</div>
					</div>	
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-1  control-label" >排名:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="middlerank" name="middlerank" value="<?php echo ($project['pmiddlerank']); ?>">
						</div>
						<label for="username" class="col-sm-1  control-label" >分数:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="middlescore" name="middlescore" value="<?php echo ($project['pmiddlescore']); ?>">
						</div>
						<label for="username" class="col-sm-2  control-label" >中期完结:</label>
						<div class="col-sm-3">
							<?php if($project['pmiddleend'] == 0): ?><input type="radio"  name="middleend" value='1'  style="width: 50px"/>是
					       		<input type="radio"  name="middleend" value='0' checked='checked' style="width: 50px"/>否<label class='red'>*通过后不可改*</label>
							<?php else: ?>
								<label>已通过</label>
								<input type="hidden"  name="middleend" value='1'  style="width: 50px"/><?php endif; ?>
						</div>
					</div>       		
				</div>
				<hr/>
				<div class="form-group" id='last'>
					<label for="username" class="col-sm-2  control-label" >结题:</label>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-2  control-label" >是否答辩:</label>
						<div class="col-sm-4">
							<?php if($project['plaststatus'] == 1): ?><input type="radio"  name="laststatus" value='1' checked='checked' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
			       				<input type="radio"  name="laststatus" value='0' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;否
							<?php else: ?>
								<input type="radio"  name="laststatus" value='1'  style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
			       				<input type="radio"  name="laststatus" value='0' checked='checked' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;否<?php endif; ?>
						</div>	
						<label for="username" class="col-sm-2  control-label" >结题材料:</label>
						<div class="col-sm-4" style="margin-top:7px;">
							<?php if($project['plastaccessory'] == ''): else: ?>
						    	 <a href="<?php echo U('Admin/SuperManage/downprojectfile',array('pid'=>$project['pid'],'class'=>'结题材料'));?>">结题材料</a><?php endif; ?> 
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-2  control-label" >材料审核:</label>
						<div class="col-sm-7">
							<?php if($project['plastcheck'] == 0): ?><input type="radio"  name="lastcheck" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       		<input type="radio"  name="lastcheck" value='2' style="width: 50px"/>&nbsp;&nbsp;不通过
					       		<input type="radio"  name="lastcheck" value='0' checked='checked' style="width: 50px"/>&nbsp;&nbsp;未审核
						    <?php else: ?>
								<?php if($project['plastcheck'] == 1): ?><input type="radio"  name="lastcheck" value='1' checked='checked' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       			<input type="radio"  name="lastcheck" value='2'  style="width: 50px"/>&nbsp;&nbsp;不通过
				       			<?php else: ?>
									<input type="radio"  name="lastcheck" value='1' style="width: 50px"/>&nbsp;&nbsp;通过&nbsp;&nbsp;&nbsp;&nbsp;
					       			<input type="radio"  name="lastcheck" value='2' checked='checked' style="width: 50px"/>&nbsp;&nbsp;不通过<?php endif; endif; ?>
						</div>
					</div>	
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-1  control-label" >排名:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="lastrank" name="lastrank" value="<?php echo ($project['plastrank']); ?>">
						</div>
						<label for="username" class="col-sm-1  control-label" >分数:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="lastscore" name="lastscore" value="<?php echo ($project['plastscore']); ?>">
						</div>
						<label for="username" class="col-sm-2  control-label" >结题完结:</label>
						<div class="col-sm-3">
							<?php if($project['plastend'] == 0): ?><input type="radio"  name="lastend" value='1'  style="width: 50px"/>是
					       		<input type="radio"  name="lastend" value='0' checked='checked' style="width: 50px"/>否<label class='red'>*通过后不可改*</label>
							<?php else: ?>
								<label>已通过</label>
								<input type="hidden"  name="lastend" value='1'  style="width: 50px"/><?php endif; ?>
						</div>
					</div>
					<div class="col-sm-10 col-sm-offset-2">
						<hr/>
					</div>
					 <div class="col-sm-10 col-sm-offset-2">
						<label for="username" class="col-sm-2  control-label" >项目结束:</label>
						<div class="col-sm-4">
							<?php if($project['pendstatus'] == 1): ?><input type="radio"  name="endstatus" value='1' checked='checked' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;已结束&nbsp;&nbsp;&nbsp;&nbsp;
			       				<input type="radio"  name="endstatus" value='0' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;未结束
							<?php else: ?>
								<input type="radio"  name="endstatus" value='1'  style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;已结束&nbsp;&nbsp;&nbsp;&nbsp;
			       				<input type="radio"  name="endstatus" value='0' checked='checked' style="width: 50px;padding-top:7px;"/>&nbsp;&nbsp;未结束<?php endif; ?>
						</div>
						<label for="username" class="col-sm-4  control-label" style='color:red;'>结束之后，相关信息不再通知！</label>
					</div>      		
				</div>
				<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >项目类型:</label>
						<div class="col-sm-3">
							<select id="class" name="class" class="form-control">
								<?php if($project['pclass'] == '创新训练'): ?><option value='创新训练' selected='selected'>创新训练</option>
								<?php else: ?>
									<option value='创新训练'>创新训练</option><?php endif; ?>
								<?php if($project['pclass'] == '创业训练'): ?><option value='创业训练' selected='selected'>创业训练</option>
								
								<?php else: ?>
									<option value='创业训练'>创业训练</option><?php endif; ?>
								<?php if($project['pclass'] == '创业实践'): ?><option value='创业实践' selected='selected'>创业实践</option>
								<?php else: ?>
									<option value='创业实践'>创业实践</option><?php endif; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >学生人数:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="number" name="number" value="<?php echo ($project['pnumber']); ?>">
						</div>
						<label for="username" class="col-sm-2  control-label" >一级学科:</label>
						<div class="col-sm-4">
							<select id="father" name="father" class="form-control">
								<?php if($project['pfather'] == '计算机科学与技术'): ?><option value='计算机科学与技术' selected='selected'>计算机科学与技术</option>
								<?php else: ?>
									<option value='计算机科学与技术'>计算机科学与技术</option><?php endif; ?>
								<?php if($project['pfather'] == '软件工程'): ?><option value='软件工程' selected='selected'>软件工程</option>
								
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
								<?php if(is_array($project['user'])): foreach($project['user'] as $i=>$v): ?><tr>
										<?php if($v['uprofession'] == '学生'): ?><td><?php echo ($i+1); ?></td>
											<td><?php echo ($v['unum']); ?></td>
											<td><?php echo ($v['uname']); ?></td>
											<td>
												<?php if($v['unum'] == $project['pcaptainnum']): ?>队长
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
							<?php if(is_array($project['user'])): foreach($project['user'] as $key=>$v): if($v['uprofession'] != '学生'): ?><label for="username" class="col-sm-3  control-label" ><?php echo ($v["uname"]); ?>(<?php echo ($v["unum"]); ?>)</label>
										<label for="username" class="col-sm-2  control-label" ><?php echo ($v["uprofession"]); ?></label>
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
					      <textarea  id="content" name="content"  class="form-control" style="height:200px;"><?php echo ($project['pcontent']); ?></textarea>
					  </div>
					</div> 
					<div class="form-group">
						 <label for="username" class="col-sm-2  control-label" >附件:</label>
					 	<div class="col-sm-8 inputpadding" style='margin-top:7px;'>
					        <?php if($project['paccessory'] == ''): else: ?>
						    	 <a href="<?php echo U('Admin/SuperManage/downprojectfile',array('pid'=>$project['pid'],'class'=>'项目申请书'));?>">项目申请书</a><?php endif; ?>   			    	
					    </div>		
					 </div>
				<div class="modal-footer">
					<input type='hidden',id='pid' name='pid' value="<?php echo ($project['pid']); ?>">
		   			<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
		   			<input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'>
				   	 <a class="btn btn-primary" href="<?php echo U('Admin/SuperManage/project',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
				   	 <input type="button" class="btn btn-primary" value="保 存" id='savebtn'>
				   	 &nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
			   </div>
		  </form>
		  
   
	</div>
	<script>
	if(<?php echo ($project["pleaderstatus"]); ?>=='1'){
		var z=document.getElementById('title');
		z.setAttribute('readonly','true');
		var z=document.getElementById('annual');
		z.setAttribute('readonly','true');
		var z=document.getElementById('class');
		z.setAttribute('readonly','true');
		var z=document.getElementById('number');
		z.setAttribute('readonly','true');
		var z=document.getElementById('father');
		z.setAttribute('readonly','true');
		var z=document.getElementById('checkdate');
		z.setAttribute('readonly','true');
		var z=document.getElementById('content');
		z.setAttribute('readonly','true');
		var z=document.getElementById('level');
		z.setAttribute('readonly','true');
		
	}
	if(<?php echo ($project["pleaderstatus"]); ?>!='1'){
		//隐藏月报中期、检查、结题
		
		var z=document.getElementById('report');
		z.style.display="none";
		var z=document.getElementById('middle');
		z.style.display="none";	
		var z=document.getElementById('last');
		z.style.display="none";
				
		}
	//隐藏结题
	if(<?php echo ($project["pmiddlecheck"]); ?>!='1'){
			var z=document.getElementById('last');
			z.style.display="none";	
		}
	
	
	$(function(){
		$('#savebtn').click(function(){
			if(document.getElementById('leaderstatus1').checked && $('#level').val()=='0' ){
				alert('请选择级别！');
				return false;
			}
			
			if(document.getElementById('leaderstatus1').checked  && $('#checkdate').val()=='0000-00-00' ){
				alert('请选择月报开始日期！');
				return false;
			}	
			$('#form2').submit();
									
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