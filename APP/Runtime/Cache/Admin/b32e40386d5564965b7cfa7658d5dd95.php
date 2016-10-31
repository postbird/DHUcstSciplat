<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css"><script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script><script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script><script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script><style css='text/css'>
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:50%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
		
	</style><script>
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
</script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script></head><body style="padding:20px 20px 0px 20px"><h2 align="center">讲座列表</h2><hr/><br/><!-- data-toggle="modal" data-target="#adduserModal" --><a class="btn btn-default "  href="__URL__/addLecture/unum/<?php echo ($unum); ?>/uname/<?php echo ($uname); ?>">
					发布讲座
			</a><div style="margin:10px 0;"></div><table id="dg" title="讲座列表" style="width:1280px;height:380px" ><?php if(is_array($lecture)): foreach($lecture as $key=>$u): ?><tr><td><?php echo ($u["lid"]); ?></td><td><?php echo ($u["ltitle"]); ?></td><td><?php echo ($u["llecturer"]); ?></td><td><?php echo ($u["ldate"]); ?></td><td><?php echo ($u["lplace"]); ?></td><td><?php echo ($u["ldirectorname"]); ?></td><td><?php echo ($u["ldatestart"]); ?></td><td><?php echo ($u["ldateend"]); ?></td><td><?php if($u["lsheet"] == 1): ?>是
			<?php else: ?>
				否<?php endif; ?></td><td><?php echo ($u["lnum"]); ?></td><td><?php if($u["lcheckstatus"] == 0): ?>未审核
			<?php else: if($u["lcheckstatus"] == 1): ?>已通过
				<?php else: ?>
					未通过<?php endif; endif; ?></td><td><?php if($u["lstatus"] == 1): ?>是
			<?php else: ?>
				否<?php endif; ?></td><td><a href="<?php echo U('Admin/SuperManage/lectureread',array('lid'=>$u['lid'],'unum'=>$unum,'uname'=>$uname));?>">读取</a><a href="<?php echo U('Admin/SuperManage/lectureapply',array('lid'=>$u['lid'],'unum'=>$unum,'uname'=>$uname,));?>">查看报名</a><a href="javascript:void(0)" onclick="deletelecture(<?php echo ($u["lid"]); ?>)">删除</a></td></tr><?php endforeach; endif; ?></table><div style="padding-left:500px;"><?php echo ($page); ?>&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span></div><!-- Modal 添加信息开始--><div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  ><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel">发布信息</h4></div><div class="modal-body"><form id="form1" method='post' action="__URL__/insertlecture" class="form-horizontal" enctype="multipart/form-data"><div class="form-group"><div class="col-sm-10 col-sm-offset-1"><input type="text" class="form-control " id="title" name="title" placeholder="主题"></div></div><div class="form-group"><div class="col-sm-10 col-sm-offset-1"><textarea  id="content" name="content" ></textarea></div></div><div class="form-group"><label for="username" class="col-sm-2 control-label" >报名开始时间:</label><div class="col-sm-4"><input type="text" class="form-control " id="datestart" name="datestart" onClick="WdatePicker()"  ></div><label for="username" class="col-sm-2 control-label" >报名结束时间:</label><div class="col-sm-4"><input type="text" class="form-control " id="dateend" name="dateend" onClick="WdatePicker()" placeholder="不能为空"></div></div><hr/><div class="form-group"><label for="username" class="col-sm-2 control-label" >主讲人:</label><div class="col-sm-4"><input type="text" class="form-control " id="lecturer" name="lecturer" placeholder="不能为空"></div></div><div class="form-group"><label for="username" class="col-sm-2 control-label" >讲座时间:</label><div class="col-sm-4"><input type="text" class="form-control " id="date" name="date" placeholder="不能为空"></div></div><div class="form-group"><label for="username" class="col-sm-2 control-label" >讲座地点:</label><div class="col-sm-4"><input type="text" class="form-control " id="place" name="place" placeholder="不能为空"></div></div><div class="form-group"><label for="username" class="col-sm-2 control-label" >负责人:</label><div class="col-sm-4"><input type="text" class="form-control " id="director" name="director" value="<?php echo ($uname); ?>(<?php echo ($unum); ?>)" readonly="true"></div><label for="username" class="col-sm-2 control-label" >负责人电话:</label><div class="col-sm-4"><input type="text" class="form-control " id="diretortel" name="directortel"></div></div><div class="form-group"><label for="username" class="col-sm-2 control-label" >是否有讲座单子:</label><div class="col-sm-4"><input type="radio"   name="sheet" value='1' checked="checked" style="width: 50px"/>&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
				       		<input type="radio"   name="sheet" value='0' style="width: 50px"/>&nbsp;&nbsp;否
					     </div><label for="username" class="col-sm-2 control-label" >预计人数:</label><div class="col-sm-4"><input type="text" class="form-control " id="num" name="num"></div></div><div class="modal-footer"><input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'><input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'><input type="submit" class="btn btn-primary" value="保 存" id="adduserbtn" name="adduserbtn"></div></form></div></div></div></div><!-- Modal 添加信息结束--><script>	function deletelecture(lid){
		if(confirm("确认删除？")){
			$.ajax({
				type:"json",
				url:"__URL__/lectureDelete/lid/"+lid,
				success:function(data){
					if(data.status=="ok"){
						alert("删除成功");
						window.location.reload();
					}else{
						alert("删除失败");
					}
					
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
					{field:'lid',hidden:true},
					{field:'ltitle',title:"主题",width:90},
			        {field:'llecturer',title:'主讲人',width:30},
			        {field:'ldate',title:"讲座时间",width:60},
			        {field:'lplace',title:"讲座地点",width:60},
			        {field:'ldirectorname',title:"负责人",width:30},
			        {field:'ldatestart',title:"报名开始时间",width:30},
			        {field:'ldateend',title:"报名结束时间",width:30},
			        {field:'lsheet',title:"是否有讲座单",width:20},
			        {field:'lnum',title:"预计人数",width:15},
			        {field:'lcheckstatus',title:"审核状态",width:20},
			        {field:'lstatus',title:"是否生效",width:20},
			        {field:'ss',title:"操作",width:45},
			        		        
			   	  ]]
				});
		});
	</script></body></html>