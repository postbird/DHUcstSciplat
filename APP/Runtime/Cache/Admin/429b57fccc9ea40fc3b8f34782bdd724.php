<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css"><script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script><script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script><script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script><style>
		.head{text-align:center;}
		.container{width:1000px;}
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:40%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
	</style><script>
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
</script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script></head><body><div class='container'><h3 class='head'>科创人才库管理</h3><h2 class='head'>分组列表</h2><hr/><button class="btn btn-default "  data-toggle="modal" data-target="#adduserModal">
						创建分组+
		</button>
		&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span><hr/><?php if(is_array($elitegroup)): foreach($elitegroup as $i=>$v): ?><div class="col-md-12"><div class="col-sm-10"><label for="usernum" class="col-sm-3 " >分组<?php echo ($i+1); ?> : <?php echo ($v['ename']); ?></label><div class="col-sm-9 "><div class="col-sm-12"><br><br></div><label for="usernum" class="col-sm-1 " >成员:</label><div class="col-sm-11 "><table class="table "><?php if(is_array($v["elite"])): foreach($v["elite"] as $key=>$u): ?><tr><td><?php echo ($u['unum']); ?>&nbsp;&nbsp;
								    		</td><td><?php echo ($u['uname']); ?></td><td><a href="javascript:void(0)" onclick="deleteelite(<?php echo ($v['eid']); ?>,<?php echo ($u["uid"]); ?>)">&nbsp;删除</a></td></tr><?php endforeach; endif; ?></table></div></div></div><div class="col-sm-2"><div style="text-align:right;width:95%;height:10em;"><a href="<?php echo U('Admin/SuperManage/addelite',array('eid'=>$v['eid'],'unum'=>$unum,'uname'=>$uname));?>">&nbsp;新增成员+&nbsp;&nbsp;&nbsp;</a><a href="javascript:void(0)" onclick="deleteelitegroup(<?php echo ($v["eid"]); ?>)">&nbsp;<label style='color:red;'>[删除此分组]</label></a></div></div></div><?php endforeach; endif; ?></div><!-- Modal 添加信息开始--><div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  ><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel">创建分组</h4></div><div class="modal-body"><form id="form1" method='post' action="__URL__/addelitegroup" class="form-horizontal" enctype="multipart/form-data"><div class="form-group"><div class="col-sm-10 col-sm-offset-1"><input type='text' class="form-control " id="name" name="name"  placeholder="分组名称"></div></div><div class="modal-footer"><input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'><input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'><input type="submit" class="btn btn-primary" value="保 存" id="adduserbtn" name="adduserbtn"></div></form></div></div></div></div><!-- Modal 添加信息结束--><script>
	function deleteelitegroup(eid){
		alert("删除后不可恢复，确认删除？");
		if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/deleteelitegroup/eid/"+eid,
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
			};
		}
	function deleteelite(eid,uid){
		alert("删除后不可恢复，确认删除？");
		if(confirm("确认删除")){
			$.ajax({
				type:"POST",
				url:"__URL__/deleteelite/eid/"+eid+"/uid/"+uid,
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
			};
		}
	
	$(function(){
		$('#adduserbtn').click(function(){
			if($('#adduserModal #name').val() ==''){
					alert("分组名称不能为空");
					return false;
				}
				
		});
		
	});
	</script></body></html>