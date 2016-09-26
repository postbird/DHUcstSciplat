<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/bootstrap/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="__PUBLIC__/css/login.css"/>
	<title>科创管理平台登陆页面</title>
    <script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.js"></script>
    
    <script type="text/javascript">
   			var verifyUrl='<?php echo U("Admin/Login/verify",'','');?>';
   			var loginindexUrl='<?php echo U("Admin/Login/index",'','');?>';
   			var loginloginUrl='<?php echo U("Admin/Login/login",'','');?>';
   			var indexUrl='<?php echo U("Admin/Index/index",'','');?>';
           
    </script>
  <style>
  	.loginbtn{float:right;}
  </style>  
</head>
<body onkeydown='onEnterDown();'>
   	<div id="header">
        <div style="font-size:2.5em;font-weight:bold;margin:0 auto;width:40%;text-align:center;padding-top:0.8em;">科创管理平台登陆界面</div>
    </div>
	
    <div  id="login_body">
     <div id="login_left">
	
     <marquee behavior="scroll" height="150" direction=up scrollamount=2 scrolldelay=5 onmouseover="this.stop()" onmouseout="this.start()">
    <div style="color:#7F8D18;">
	<p>欢迎访问科创管理平台</P>
	<p>温馨提示：</p>
	<p>用户名填写学号或者工号</p>
	
	</div>
	</marquee>
     </div>
        <span id="loginContainer">
        	<img id="login_img" src="__PUBLIC__/images/login.png"/>
            <!--<form  id="loginForm" >-->
                <table>
                    <tr>
                        <th><span class="login-input"><label for="name">用户名：</label></span></th>
                    </tr>
                    <tr>
                        <td><input type="text" class="input-xlarge" tabindex="1" name="username" id="username" /></td>
                    </tr>
                    <tr>
                        <th><span class="login-input"><label for="pwd">密码：</label><a href=""></a></span> </th>
                    </tr>
                    <tr>
                        <td><input type="password" class="input-xlarge" tabindex="2" name="password" id="password" /></td>
                    </tr>
                   
                    <tr>
                        <th><span class="login-input"><label for="code">验证码：</label></span></th>
                    </tr>
                    <tr>
                        <td class="code">
                            <input type="text" class="input-mini" tabindex="3" name="code" id="code" />
                            <img id="verify_code" src="<?php echo U('Admin/Login/verify','','');?>" onclick="change_code()"/>
                            <a href="javascript:void(0)" onclick="change_code()">看不清，换一张</a>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                <tr id="login">
                	<td>
                		<a href="__ROOT__" style="font-size:1.1em;display:inline-block;margin-top:0.5em;">前台首页</a>
                		<div class='loginbtn'>
                				 <button onclick="logincheck()" type="button" tabindex="3" class="btn btn-info"><i class="icon-edit icon-white"></i>&nbsp;&nbsp;登录</button>
            			</div>
                   </td>
                </tr>
                </table>
            <!--</form>-->
        </span>
    </div>
    <script type="text/javascript">
    
    //登录页面,验证码
    function change_code(){
    	$('#verify_code').attr("src",verifyUrl+'/'+Math.random());
    	return false;
    }
   function logincheck(){
	   var username = $('#username');
		var password = $('#password');
		var verify_code = $('#code');
		
		if(username.val() == ''){
			alert('用户名不能为空');
			username.focus();
			return ;
		}
		if(password.val() == ''){
			alert('密码名不能为空');
			password.focus();
			return ;
		}
		
		if(verify_code.val() == ''){
			alert('验证码码不能为空');
			verify_code.focus();
			return ;
		}
		
		$.post(loginloginUrl,{username:username.val(),password:password.val(),verify_code:verify_code.val()},function (data) {
			if(data.status == 2){
				alert('验证码错误');
				window.location.href = loginindexUrl;
			}else if(data.status == 3){
				
				window.location.href = indexUrl ;
			}else if(data.status == 0){
				alert('登录失败，请重新尝试');
				window.location.href = loginindexUrl;
			}else if(data.status==4)
			{
				alert('用户名或密码错误');
				window.location.href = loginindexUrl;
			}
			else{
				
				alert('用户名或密码错误');
				window.location.href = loginindexUrl;
			}
			
		},'json');
	  }
    //enter响应
    function onEnterDown(){
		if(window.event.keyCode==13){
				logincheck();
			}
        } 
    
    </script>
</body>
</html>