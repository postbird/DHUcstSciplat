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
	<h2 class='head'>用户信息读取修改</h2>
	<hr/>
	 <form id="form2" method='post' action="__URL__/userupdate" class="form-horizontal" enctype="multipart/form-data">
	 		<div class="form-group">
	 			<label for="school" class="col-sm-2  control-label" >学院:</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" id="school" name="school" value='<?php echo ($user["school"]); ?>' readonly='true' >
			    </div>
	 		</div>
	 		<div class="form-group">
	 			<label for="num" class="col-sm-2  control-label" >学号/工号:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="num" name="num" value='<?php echo ($user["unum"]); ?>' readonly='true' >
			    </div>
			    <label for="name" class="col-sm-2  control-label" >姓名:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="name" name="name" value='<?php echo ($user["uname"]); ?>' readonly='true' >
			    </div>
	 		</div>
	 		
			<div class="form-group">
	 			<label for="master" class="col-sm-2  control-label" >专业:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="master" name="master" value='<?php echo ($user["master"]); ?>' readonly='true' >
			    </div>
			    <label for="grade" class="col-sm-2  control-label" >班级:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="grade" name="grade" value='<?php echo ($user["ugrade"]); ?>' readonly='true' >
			    </div>
			</div>
			<div class="form-group">
				<label for="usernum" class="col-sm-2  control-label" >角色:</label>
			    <div class="col-sm-3">
			     		<select id="role" name="role" class="form-control" >
							<?php if(is_array($role)): foreach($role as $key=>$v): if($user['role'][0]['name'] == $v['name']): ?><option value='<?php echo ($v["id"]); ?>' selected="selected"><?php echo ($v["name"]); ?></option>
								<?php else: ?>
									<option value='<?php echo ($v["id"]); ?>'><?php echo ($v["name"]); ?></option><?php endif; endforeach; endif; ?>
						</select>
			    </div>
	 			<label for="usernum" class="col-sm-2  control-label" >职称:</label>
			    <div class="col-sm-3">
	     			<select id="profession" name="profession" class="form-control">
	     					<?php if($user['uprofession'] == '学生'): ?><option value='学生' selected='selected'>学生</option>
							<?php else: ?>
								<option value='学生' >学生</option><?php endif; ?>
							<?php if($user['uprofession'] == '助教'): ?><option value='助教' selected='selected'>助教</option>
							<?php else: ?>
								<option value='助教' >助教</option><?php endif; ?>
							<?php if($user['uprofession'] == '讲师'): ?><option value='讲师' selected='selected'>讲师</option>
							<?php else: ?>
								<option value='讲师'>讲师</option><?php endif; ?>
							<?php if($user['uprofession'] == '副教授'): ?><option value='副教授' selected='selected'>副教授</option>
							<?php else: ?>
								<option value='副教授'>副教授</option><?php endif; ?>
							<?php if($user['uprofession'] == '教授'): ?><option value='教授' selected='selected'>教授</option>
							<?php else: ?>
								<option value='教授'>教授</option><?php endif; ?>
						</select>
			    </div>
			</div>
			<div class="form-group">
	 			<label for="usernum" class="col-sm-2  control-label" >电话:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="tel" name="tel" value='<?php echo ($user["utel"]); ?>' readonly='true' >
			    </div>
			    <label for="usernum" class="col-sm-2  control-label" >邮箱:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="mail" name="mail" value='<?php echo ($user["umail"]); ?>' readonly='true' >
			    </div>
	 		</div>
	 		<div class="form-group">
	 			<label for="usernum" class="col-sm-2  control-label" >科创积分:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" id="point" name="point" value='<?php echo ($user["upoint"]); ?>' >
			    </div>
			    <label for="usernum" class="col-sm-2  control-label" >人才库:</label>
			    <div class="col-sm-3" style="padding-top:7px;">
			    	<label>
				      <?php if(is_array($user['elite'])): foreach($user['elite'] as $key=>$v): echo ($v["ename"]); ?>&nbsp;&nbsp;<?php endforeach; endif; ?>
			      	</label>
			    </div>
	 		</div>
	 		<hr/>
	 		<div class="form-group">
	 			<label for="usernum" class="col-sm-2  control-label" >科创详情:</label>
	 			<div class="col-sm-10">
			    	<table class='table'>
			    		<thead>
			    			<th>类别</th>
			    			<th>名称</th>
			    			<th>描述</th>
			    			<th>分数</th>
			    		</thead>
			    		<tbody>
			    			<?php if(is_array($race)): foreach($race as $key=>$v): ?><tr>
			    					<td>竞赛</td>
			    					<td><?php echo ($v["race_name"]); ?></td>
			    					<td><?php echo ($v["bonus"]); ?></td>
			    					<td>
			    						<?php switch($v["bonus"]): case "参与奖": ?>+1<?php break;?>
			    							<?php case "三等奖": ?>+2<?php break;?>
			    							<?php case "二等奖": ?>+3<?php break;?>
			    							<?php case "一等奖": ?>+4<?php break; endswitch;?>
			    					</td>
			    				</tr><?php endforeach; endif; ?>
			    			<?php if(is_array($project)): foreach($project as $key=>$v): ?><tr>
			    					<td>项目</td>
			    					<td><?php echo ($v["pname"]); ?></td>
			    					<td><?php echo ($v["assign"]); ?></td>
			    					<td>
			    						<?php switch($v["assign"]): case "报名": ?>+1<?php break;?>
			    							<?php case "国家级": ?>+3<?php break;?>
			    							<?php case "上海市级": ?>+2<?php break;?>
			    							<?php case "校级": ?>+1<?php break;?>
			    							<?php case "院级": ?>+1<?php break;?>
			    							<?php case "中期答辩": ?>+1<?php break;?>
			    							<?php case "结题答辩": ?>+2<?php break; endswitch;?>
			    					</td>
			    					
			    				</tr><?php endforeach; endif; ?>
			    			<?php if(is_array($lecture)): foreach($lecture as $key=>$v): ?><tr>
			    					<td>讲座</td>
			    					<td><?php echo ($v["lecture_title"]); ?></td>
			    					<td>已参加</td>
			    					<td>
			    						+1
			    					</td>
			    				</tr><?php endforeach; endif; ?>
			    		</tbody>
			    	</table>
			    </div>
	 		</div>
		   <div class="modal-footer">
		   			<input type='hidden',id='uid' name='uid' value='<?php echo ($user["uid"]); ?>'>
			  		<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
		   			<input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'>
				   	 <a class="btn btn-primary" href="<?php echo U('Admin/SuperManage/user',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
				   	 <input type="submit" class="btn btn-primary" value="保 存" >
				   	 &nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span>
			   </div>
		  </form>
		  
   
	</div>
	<script>
		
	</script>
	
</body>
</html>