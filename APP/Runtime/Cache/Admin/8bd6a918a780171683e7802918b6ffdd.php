<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/default/easyui.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/jquery-easyui-1.3.5/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-theme.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/bootstrap-responsive.min.css"><script language="javascript" type="text/javascript" src="__PUBLIC__/My97DatePicker/WdatePicker.js"></script><script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script><script type="text/javascript" src="__PUBLIC__/bootstrap/bootstrap.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-easyui-1.3.5/jquery.easyui.min.js"></script><style>		.head{text-align:center;}
		.container{width:1000px;}
		.red{color:red;}
		.blue{color:blue;}
		.operate{color:#428bca;}
		.modal-dialog{width:100%;}
		.inputpadding{padding-left:1px;}
		.pantssize{font-size:14px;}
		.back{position:absolute;right:10px;top:10px;}
	</style></head><body><div class='container'><h3 class='head' id="ltitle"></h3><h2 class='head'><span class="text-danger">刷卡验证</span></h2><hr/><div class="well"><p class="text-danger">				刷卡时请保证每个输入框处于激活状态（可输入/页面打开时自动获取焦点）。
			</p><p class="text-danger">				未报名学号或已经刷过卡将弹窗显示，学号如果刷入正确将自动增加一个输入框。
			</p></div><form action="__URL__/lectureUserConfirm/" method="post"><div class="col-sm-12 "><table class="table"><thead><tr><th>学号</th><th>姓名</th></tr></thead><tbody class="card-body"><tr class="card-tr-1" guid="1"><td><input type="text" class="form-control" name="stunum[]" id="unum-1" placeholder="学号....." oninput="listenUnum(this);" onpropertychange="listenUnum(this);"></td><td><input type="text" class="form-control" name="stuname[]" id="uname-1"placeholder="姓名自动识别....."readonly="readonly" value=""></td></tr></tbody></table></div ><div class="modal-footer"style="margin-top:30px;"><input type="hidden" name="unum" value="<?php echo ($unum); ?>"><input type="hidden" name="uname" value="<?php echo ($uname); ?>"><input type="hidden" name="view" value="<?php echo ($lid); ?>"><a class="btn btn-primary" href="<?php echo U('Admin/Stu/mydirectlecture',array('unum'=>$unum,'uname'=>$uname));?>" target="opt"><span>返回</span></a><input type="submit" id="enterBtn" infoguid="<?php echo U('Admin/SuperManage/lectureInfo');?>" name='option1' value="确认参加" class="btn btn-primary"></div></form></div><script>		var u=$("#enterBtn").attr("infoguid");
		var view=<?php echo ($lid); ?>;
		var stu;
		var inpCount=1;
		var alArr=Array();
		var alArrCount=0;
		function getInfo(){
			var tstu;
			$.ajax({
				url:u+"/view/"+view,
				async:false,
				success:function(data){
					if(data.status=="ok"){
						tstu=data.stu;
						return tstu;
					}else{
						alert("加载失败,重新加载");
						window.reaload();
						return ;
					}
				}
			});
			return tstu;
		}
		function listenUnum(obj){
			var inp=$(obj);
			var tmpValue=inp.val().replace(" ","");
			if(tmpValue.length==9){
				var tmp=checkUnum(tmpValue);
				if(tmp==0){
					alert("未报名!");
					inp.val("");
					inp.focus();
				
				}else if(tmp==1){
					alert("已经刷过卡!");
					inp.val("");
					inp.focus();
				}else{
					$("#uname-"+inpCount).val(tmp['user_name']);
					inpCount++;
					var htm='<tr class="card-tr-'+inpCount+'" guid="'+inpCount+'">';
		 				htm+='<td><input type="text" class="form-control" name="unum[]" id="unum-'+inpCount+'" placeholder="学号....." oninput="listenUnum(this);" onpropertychange="listenUnum(this);"></td>';

		 				htm+='<td><input type="text" class="form-control" name="uname[]" id="uname-'+inpCount+'" placeholder="姓名自动识别....."readonly="readonly" value=""></td>'
		 				htm+='</tr>';
			 		$(".card-body").append(htm);
			 		$("#unum-"+inpCount).focus();
				}
			}
		}
		//每次输入检查卡号
		function checkUnum(unum){
			for(var i=0;i<stu.length;i++){
				if(stu[i].user_num==unum){
					//如果验证没有刷过，则保存在验证的数组中
					if(checkAlready(unum)==0){
						alArr[alArrCount]=stu[i];//保存
						alArrCount++;
						return stu[i];//正常
					}else{
						return 1;//已经刷过卡
					}
				}else{
					continue;
				}
			}
			return 0;//不存在
		}
		//每次检查是否已经刷过该卡。
		// 返回1 表示已经刷过 也就是数组中存了
		// 0 表示没有
		function checkAlready(unum){
			for(var i=0;i<alArr.length;i++){
				if(alArr[i].user_num==unum){
					return 1;//刷过卡了
				}else{
					continue;
				}
			}
			return 0; //没有刷过
		}
		$("document").ready(function(){
			stu=getInfo();
			if(stu.length>0){
				$("#ltitle").text(stu[0].lecture_title);
				alert("成功获取用户数据，正常刷卡操作");
			}else{
				alert("获取用户数据失败,重新获取");
				window.reaload();
			}
			$("#unum-1").focus();
		});
	</script></body></html>