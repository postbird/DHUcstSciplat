<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css"><script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script><script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script><script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script><style>
		.head{text-align:center;}
		.container{width:1000px;}
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:100%;}
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
</script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script></head><body><div class='container'><h3 class='head'><?php echo ($race[0]['race_name']); ?></h3><hr/><form  method='post' action="__URL__/myraceupdate" class="form-horizontal" enctype="multipart/form-data"><div class="form-group"><label for="usernum" class="col-sm-2 control-label" >详细信息:</label><div class="col-sm-11 col-sm-offset-1 "><label for="usernum" class="col-sm-1 control-label" >成员:</label><div class="col-sm-11 col-sm-offset-1"><table><?php if(is_array($race)): foreach($race as $key=>$u): ?><tr><td><?php echo ($u['unum']); ?>&nbsp;&nbsp;
						    		</td><td><?php echo ($u['uname']); ?></td><td><?php if($u['unum'] == $u['captainnum']): ?>&nbsp;&nbsp;&nbsp;&nbsp;队长
						    			<?php else: ?>
						    				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?></td></tr><?php endforeach; endif; ?></table></div><label for="usernum" class="col-sm-1 control-label" >获奖:</label><div class="col-sm-11 col-sm-offset-1"><div class="col-sm-3 inputpadding"><?php if($race[0]['status'] == 1): ?><select id="bonus" name="bonus" class="form-control disabled" disabled="true"><?php else: ?><select id="bonus" name="bonus" class="form-control " ><?php endif; if($race[0]['bonus'] == '一等奖'): ?><option value='一等奖'  selected="selected">一等奖</option><?php else: ?><option value='一等奖'>一等奖</option><?php endif; if($race[0]['bonus'] == '二等奖'): ?><option value='二等奖'  selected="selected">二等奖</option><?php else: ?><option value='二等奖'>二等奖</option><?php endif; if($race[0]['bonus'] == '三等奖'): ?><option value='三等奖'  selected="selected">三等奖</option><?php else: ?><option value='三等奖'>三等奖</option><?php endif; if($race[0]['bonus'] == '优秀奖'): ?><option value='优秀奖'  selected="selected">优秀奖</option><?php else: ?><option value='优秀奖'>优秀奖</option><?php endif; ?></select></div></div><label for="username" class="col-sm-1  control-label" >图片上传:</label><div class="col-sm-11 col-sm-offset-1">
					     请上传证书照片(图片类型：.jpg,.gif,.png)：<label style='color:red;'>不需修改，则不用重新上传</label><?php if($race[0]['status'] == 1): ?><input type='file' name="imageFile" onchange="previewFile()" id='imageread' disabled="true"/><?php else: ?><input type='file' name="imageFile" onchange="previewFile()" id='imageread' /><?php endif; ?><img src="__ROOT__<?php echo ($race[0]['image']); ?>" height="200" width="300" alt="图片 预览..."/></div><label for="usernum" class="col-sm-1 control-label" >附件:</label><div class="col-sm-11 col-sm-offset-1">
						 请选择需要上传的文件(大小不超过10M，文件类型为.doc,.pdf,.zip)：<label style='color:red;'>不需修改，则不用重新上传</label><?php if($race[0]['status'] == 1): ?><input type='file' name="raceFile" disabled="true"/><?php else: ?><input type='file' name="raceFile" /><?php endif; ?>
					     当前文件为：<?php echo ($race[0]["accessory"]); ?><br/><div class="col-sm-8 inputpadding"><?php if($race[0]['accessory'] == ''): else: ?><a href="<?php echo U('Admin/SuperManage/downracefile');?>?filename=.<?php echo ($race[0]['accessory']); ?>">附件下载</a><?php endif; ?></div></div><label for="usernum" class="col-sm-1 control-label" >审核:</label><div class="col-sm-11 col-sm-offset-1"><div class="col-sm-8 inputpadding"><?php if($race[0]['status'] == 0): ?>未审核
						    <?php else: if($race[0]['status'] == 1): ?>已通过
					       		<?php else: ?>
									未通过
									<p class="text-danger"><?php echo ($race[0]['description']); ?></p><?php endif; endif; ?></div></div></div></div><div style="text-align:right;width:90%;"><input type='hidden' name='racefile' value='<?php echo ($u["accessory"]); ?>'><input type='hidden' name='imagefile' value='<?php echo ($u["image"]); ?>'><input type='hidden',id='race_id' name='race_id' value="<?php echo ($u['race_id']); ?>"><input type='hidden',id='captainnum' name='captainnum' value="<?php echo ($u['captainnum']); ?>"><input type='hidden',id='unum' name='unum' value='<?php echo ($unum); ?>'><input type='hidden',id='uname' name='uname' value='<?php echo ($uname); ?>'><a class="btn btn-primary" href="<?php echo U('Admin/Stu/myrace',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a><?php if($u['status'] == 1): ?>&nbsp;
	   	 	<?php else: ?><input type="submit" class="btn btn-primary" value="保 存" id="adduserbtn" name="adduserbtn"><?php endif; ?></div><hr/></form></div><script>
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
	$(function(){
		
		
	});
	</script></body></html>