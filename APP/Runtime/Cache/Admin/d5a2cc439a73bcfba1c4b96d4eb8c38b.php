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
		.modal-dialog{width:50%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
		.normalfont{font-weight:normal;}
		.stumargintop{margin-top:0.7em;}
		.delete{padding-top:7px;text-align:right;}
	</style>
	
	<script>

</script>

<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>
</head>
<body>
	<div class='container'>
		<h3 class='head'><?php echo ($projectnews['ptitle']); ?></h3>
		<hr/>
	 	<form id="form1" method='post'  class="form-horizontal" enctype="multipart/form-data">
		 			
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
					      <?php echo ($projectnews['pcontent']); ?>
					    </div>
					</div>
					<hr/>
					<div class="form-group">
						<label  class="col-sm-2 control-label" >开始日期:</label>
						<label  class="col-sm-2 control-label normalfont" ><?php echo ($projectnews['pdatestart']); ?></label>
					    <label  class="col-sm-2  control-label" >截止日期:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($projectnews['pdateend']); ?></label>
				    </div>
				    <hr/>
				    <div class="form-group">
						<label  class="col-sm-2 control-label" >项目级别:</label>
						<label  class="col-sm-2 control-label normalfont" ><?php echo ($projectnews['plevel']); ?></label>
					    <label  class="col-sm-2  control-label" >项目类型:</label>
					    <label  class="col-sm-2 control-label normalfont" ><?php echo ($projectnews['pclass']); ?></label>
				    </div>
				    <hr/>
					<div class="form-group">
						<?php if($projectnews['paccessory'] == ''): else: ?>
					   		 <label for="username" class="col-sm-2  control-label" >附件:</label>
					    	 <label  class="col-sm-2 control-label normalfont" ><a href="<?php echo U('Admin/Stu/downracefile');?>?filename=.<?php echo ($projectnews["paccessory"]); ?>">项目申请书模板下载</a></label><?php endif; ?>   
					</div>
					<hr/>
					<div class="form-group">
						<div style="margin:1em auto;width:10%;">
							<?php if($projectnews['subtime'] == 1): ?><label " class="control-label" >已截止</label>
							<?php else: ?>
								<?php if($isleader == 0): ?><button class="btn btn-default "  data-toggle="modal" data-target="#adduserModal">
										申报项目
									</button>
								<?php else: ?>
									<label " class="control-label" >已担任队长</label><?php endif; endif; ?>
						</div>
						
					</div>
			  		<div class="modal-footer">
		   			 	 <a class="btn btn-primary" href="<?php echo U('Admin/Stu/projectnews',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a>
					</div>
		</form>
	</div>
	<!-- Modal 添加信息开始-->
		<div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title head" id="myModalLabel"><?php echo ($projectnews['ptitle']); ?></h4>
		        <h3 class='head'>项目申报</h3>
		      </div>
		      <div class="modal-body">
		        <form id="form2" method='post' action="__URL__/projectinsert" class="form-horizontal" enctype="multipart/form-data">
			
				  	<div class="form-group">
				  		<div class="col-sm-10">
					 		<p style="text-align:center;color:red;">*填写说明*</p>
				 			<p>1、项目申报的填写由项目的负责人填写即可，其他成员不用填写；</p>
				 			<p>2、队长添加小组成员时，成员的学号和姓名一定要一致，否则会不通过；</p>
				 			<p>3、上传附件的材料包括项目申请书；</p>
					 	</div>	
				    </div>
					<hr/>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-1">
								<input type="text" class="form-control" id="title" name="title" placeholder="项目名称" >
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >项目类型:</label>
						<div class="col-sm-3">
							<select id="class" name="class" class="form-control">
								<option value='0'>=请选择项目类型=</option>
								<option value='创新训练'>创新训练</option>
								<option value='创业训练'>创业训练</option>
								<option value='创业实践'>创业实践</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >学生人数:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="number" name="number" >
						</div>
						<label for="username" class="col-sm-2  control-label" >一级学科:</label>
						<div class="col-sm-4">
							<select id="father" name="father" class="form-control">
								<option value='0'>=请选择一级学科=</option>
								<option value='计算机科学与技术'>计算机科学与技术</option>
								<option value='软件工程'>软件工程</option>
								</select>
						</div>
					</div>
					
					<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >组成员:</label>
						<label for="username" class="col-sm-2  control-label" >学号</label>
						<label for="username" class="col-sm-2 col-sm-offset-1  control-label" >姓名</label>
						<div class="col-sm-2 col-sm-offset-2 " style="padding-top:7px;">
							<a href="javascript:void(0)" onclick="addStu()">新增+</a>
						</div>
					</div>
					<div class="form-group" id="stugroup">
						<div>
							<div class="col-sm-3 col-sm-offset-2">
								<input type="text" class="form-control" id="num" name="num[]" value="<?php echo ($unum); ?>" readonly='true'>
							</div>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="name" name="name[]" value="<?php echo ($uname); ?>" readonly='true'>
							</div>
							<div class="col-sm-2 delete" >
								<a href="javascript:void(0)" onclick="deleterows(this)">删除</a>
							</div>
							<label for="username" class="col-sm-2  control-label" >队长</label>
						</div>
					</div>
					<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >指导老师:</label>
						<div class="col-sm-4">
							<select id="teachernum" name="teachernum" class="form-control">
								<option value='0'>=请选择指导老师=</option>
								<?php if(is_array($teacher)): foreach($teacher as $key=>$v): ?><option value="<?php echo ($v['unum']); ?>"><?php echo ($v['uname']); ?></option><?php endforeach; endif; ?>
							</select>
						</div>
					</div>
					
					<hr/>
					<div class="form-group">
						<label for="username" class="col-sm-2  control-label" >项目简介:</label>
						<label class="col-sm-3  control-label"  style='color:blue;'>字数在100字以内</label>
					</div>
					<div class="form-group">
					 <div class="col-sm-10 col-sm-offset-1">
					      <textarea  id="content" name="content" class="form-control" style="height:200px;"></textarea>
					  </div>
					</div> 
					<div class="form-group">
						 <label for="username" class="col-sm-2  control-label" >附件:</label>
					 	<div class="col-sm-8">
					     请上传项目申请书(大小不超过10M，文件类型为.doc,.docx)：
					     <input type='file' name="raceFile" id='raceFile'/>
					    </div>	
					 </div>
								  
				   <div class="modal-footer">
				   	<input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'>
				   	<input type='hidden',id='pid' name='pid' value='<?php echo ($pid); ?>'>
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
		function deleterows(id){
			var father1=id.parentNode;
			var father2=father1.parentNode;
			var childs=father2.childNodes;
			for(var i=childs.length-1;i>=0;i--){
				father2.removeChild(childs.item(i));		
			}
		}
	function previewFile() {
		var preview = document.querySelector('img');
		 var file  = document.getElementById('imageread').files[0];
		 var reader = new FileReader();
		 reader.onloadend = function () {
		  preview.src = reader.result;
		 }
		 if (file) {
		  reader.readAsDataURL(file);
		 } else {
		  preview.src = "";
		 }
		}
	function changeNext(){
		
		var parent=document.getElementById("stugroup");
		var inputs=parent.getElementsByTagName("input");
		var a=this.value;
		//alert(a);
		//for(var j=0;j<inputs.length;j++){
		//		alert(inputs[j].value);
		//	}
		$.ajax({
				url:"__URL__/getstunum/unum/"+a,
				type:"GET",
				dataType:'text',
				timeout:2000,
				success:function(data){
					var name=eval('('+data+')');
					for(var i=0;i<inputs.length;i++){
							if(a==inputs[i].value)
									inputs[i+1].value=name;
								
									
						}
				},
				error:function(){
					alert("fail");
				}
			})	
		}
		
	function addStu(){
		var stuinput=document.createElement("input");
		stuinput.className="form-control";
		stuinput.TYPE='text';
		stuinput.name="num[]";
		stuinput.onchange=changeNext;
		var studiv=document.createElement("div");
		studiv.className="col-sm-3 col-sm-offset-2 stumargintop";
		studiv.appendChild(stuinput);
		var father=document.createElement("div");
		father.appendChild(studiv);
		
		var stuinput=document.createElement("input");
		stuinput.className="form-control";
		stuinput.TYPE='text';
		//stuinput.redonly="true";
		stuinput.name="name[]";
		var studiv=document.createElement("div");
		studiv.className="col-sm-3 stumargintop";
		studiv.appendChild(stuinput);
		father.appendChild(studiv);
		
		var stuinput=document.createElement("a");
		stuinput.href="javascript:void(0)";
		stuinput.onclick=function(){
				var father1=stuinput.parentNode;
				var father2=father1.parentNode;
				var childs=father2.childNodes;
				for(var i=childs.length-1;i>=0;i--){
					father2.removeChild(childs.item(i));		
				}
			}
		stuinput.innerHTML="删除";
		var studiv=document.createElement("div");
		studiv.className="col-sm-2 delete";
		studiv.appendChild(stuinput);
		father.appendChild(studiv);
		document.getElementById('stugroup').appendChild(father);

	}
	$(function(){
		$('#adduserbtn').click(function(){
			if($('#adduserModal #title').val() ==''){
				alert("项目名称不能位空！");
				return false;
			}
			if($('#adduserModal #class').val() =='0'){
					alert("请选择项目类型！");
					return false;
				}
			if($('#adduserModal #number').val() ==''){
				alert("请选择学生人数！");
				return false;
			}
			if($('#adduserModal #father').val() =='0'){
				alert("请选择所属一级学科！");
				return false;
			}
			if($('#adduserModal #teachernum').val() =='0'){
				alert("请选择指导老师！");
				return false;
			}
			if($('#adduserModal #raceFile').val() ==''){
				alert("请上传附件！");
				return false;
			}
					
		});
		
		
	});
</script>
	
</body>
</html>