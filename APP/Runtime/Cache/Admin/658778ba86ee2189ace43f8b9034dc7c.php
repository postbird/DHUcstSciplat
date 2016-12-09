<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css"><script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script><script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script><script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script><style css='text/css'>
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:50%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
		
	</style><script>
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

	</script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script></head><body style="padding:20px 20px 0px 20px"><h2 align="center">申报项目列表</h2><form id="searchform" method='post' action="__URL__/searchproject" class="form-horizontal"><table id = "search" ><tr><td>年度：</td><td><select id="searchannual" name="searchannual" class="form-control" ><?php if($searchyear == 0): ?><option value="0" selected="selected">=请选择年度=</option><?php else: ?><option value="0">=请选择年度=</option><?php endif; $__FOR_START_26030__=2014;$__FOR_END_26030__=2034;for($i=$__FOR_START_26030__;$i < $__FOR_END_26030__;$i+=1){ if($searchyear == $i): ?><option value="<?php echo ($i); ?>" selected="selected"><?php echo ($i); ?></option><?php else: ?><option value="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php endif; } ?></select></td><td style="padding-left:1em;">级别：</td><td><select id="searchlevel" name="searchlevel" class="form-control" ><?php if($searchlevel == '0'): ?><option value="0" selected="selected">=请选择级别=</option><?php else: ?><option value="0">=请选择级别=</option><?php endif; if($searchlevel == '国家级'): ?><option value="国家级" selected="selected">国家级</option><?php else: ?><option value="国家级">国家级</option><?php endif; if($searchlevel == '上海市级'): ?><option value="上海市级" selected="selected">上海市级</option><?php else: ?><option value="上海市级">上海市级</option><?php endif; if($searchlevel == '校级'): ?><option value="校级" selected="selected">校级</option><?php else: ?><option value="校级">校级</option><?php endif; if($searchlevel == '院级'): ?><option value="院级" selected="selected">院级</option><?php else: ?><option value="院级">院级</option><?php endif; ?></select></td><td style="padding-left:1em;">来源：</td><td><select id="searchfid" name="searchfid" class="form-control" ><?php if($searchfid == 0): ?><option value="0" selected="selected">=请选择来源=</option><?php else: ?><option value="0">=请选择来源=</option><?php endif; if(is_array($searchfids)): foreach($searchfids as $key=>$v): if($searchfid == $v['pid']): ?><option value="<?php echo ($v['pid']); ?>" selected="selected"><?php echo ($v['ptitle']); ?></option><?php else: ?><option value="<?php echo ($v['pid']); ?>" ><?php echo ($v['ptitle']); ?></option><?php endif; endforeach; endif; ?></select></td><td style="padding-left:1em;"><input type="hidden"  id="searchunum" name="searchunum" value="<?php echo ($unum); ?>"><input type="hidden"  id="searchuname" name="searchuname" value="<?php echo ($uname); ?>"><button class="btn  btn-default" id="searchbtn" name="searchbtn" type="button">查询&nbsp;<i class="icon-search icon-large icon-white"></i></button></td></tr></table></form><hr/><div style="margin:10px 0;"></div><form method='post' action="__URL__/outputproject" ><table id="dg" title="项目列表" style="width:1300px;height:800px" ><?php if(is_array($project)): foreach($project as $key=>$u): ?><tr><td><?php echo ($u["pid"]); ?></td><td><input type="checkbox" value="<?php echo ($u["pid"]); ?>" name="subBox[]" class="sub-box"></td><td><?php echo ($u["pname"]); ?></td><td><?php echo ($u["pclass"]); ?></td><td><?php echo ($u["pcaptainname"]); ?></td><td><?php echo ($u["pcaptainnum"]); ?></td><td><?php echo ($u["pnumber"]); ?></td><td><?php if(is_array($u['user'])): foreach($u['user'] as $key=>$v): if(($v['uprofession'] == '学生') and ($v['unum'] != $u['pcaptainnum'])): echo ($v['uname']); ?>（<?php echo ($v['unum']); ?>）
					<?php else: endif; endforeach; endif; ?></td><td><?php if(is_array($u['user'])): foreach($u['user'] as $key=>$v): if(($v['uprofession'] != '学生')): echo ($v['uname']); else: endif; endforeach; endif; ?></td><td><?php if(is_array($u['user'])): foreach($u['user'] as $key=>$v): if(($v['uprofession'] != '学生')): echo ($v['uprofession']); else: endif; endforeach; endif; ?></td><td><?php echo ($u["pfather"]); ?></td><td><?php if($u['pstatus'] == 0): ?>未审核
				<?php else: if($u['pstatus'] == 1): ?>通过
					<?php else: ?>
						不通过<?php endif; endif; ?></td><td><?php if($u['pleaderstatus'] == 0): ?>未审核
				<?php else: if($u['pleaderstatus'] == 1): ?>通过
					<?php else: ?>
						不通过<?php endif; endif; ?></td><td><a href="<?php echo U('Admin/SuperManage/projectread',array('pid'=>$u['pid'],'unum'=>$unum,'uname'=>$uname));?>">读取</a></td></tr><?php endforeach; endif; ?></table><div style="padding-left:600px;"><?php echo ($page); ?></div><a id="checkAll" href="javascript:;"class="btn btn-default">全选</a><a id="delAll" href="javascript:;" class="btn btn-default">取消全选</a><input type="submit" name='option1' value="导出选中选项" class="btn btn-primary"><input type="submit" name='option2' value="选中中期答辩" class="btn btn-primary"><input type="submit" name='option3'  value="选中结题答辩" class="btn btn-primary">
		&nbsp;&nbsp;<span class='red'><?php echo ($msg); ?></span></form><script>	$(function(){
			$('#searchbtn').click(function(){
				if($('#searchannual').val() == '' && $('#searchlevel').val()==''){
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
					{field:' ',title:" ",width:15},				            
					{field:'pname',title:"项目名称",width:200},
			        {field:'pclass',title:'项目类型',width:45},
			        {field:'pcaptainname',title:"负责人姓名",width:45},
			        {field:'pcaptainnum',title:"负责人学号",width:45},
			        {field:'pnumber',title:"人数",width:20},
			        {field:'anotherstu',title:"其他学生",width:100},
			        {field:'pteachername',title:"指导老师",width:45},
			        {field:'pteacherprofesion',title:"老师职称",width:40},
			        {field:'pfather',title:"所属一级学科",width:50},
			        {field:'status',title:"管理员审核",width:35},
			        {field:'leaderstatus',title:"学校审核",width:35},
			        {field:'op',title:"操作",width:35},
			        		        
			   	  ]]
				});
		});
	</script></body></html>