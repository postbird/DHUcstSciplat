<?php
class LoginAction extends Action{
	public function index(){
		//之前的登录已经废弃
		//使用新的登录
		$url="/Index";
		$this->redirect($url);
		// $this->display();
	}
	
	//登陆处理
	public function login(){
		
		if (! IS_POST) halt( "页面不存在" );
		if(!IS_AJAX) halt('页面不存在');
		$data = array (
				'unum' => I ( 'username' ),
				'upassword' => md5(I ( 'password' )),
				'verify_code' => I('verify_code','','md5'),
		);
		
		if($data['verify_code'] != session('verify')){
			//验证码错误
			$this->ajaxReturn ( array ('status' => 2), 'json' );
		}
		else if($data['unum'] == '' || $data['upassword'] == ''){
			//服务器端未能接收到用户名或密码
			$this->ajaxReturn ( array ('status' => 0), 'json' );
		}
		else{
			//验证用户名密码
			$map['unum'] = $data['unum'];
			$result =M('user')->where ($map)->find();
			if ($result == null) {
				//数据库中没有这个用户
				$this->ajaxReturn ( array ('status' => 1), 'json' );
			}else if($data['upassword']!=$result['upassword']){
				//用户名或密码错误
				$this->ajaxReturn ( array ('status' => 4), 'json' );
			}
			else{
				
				$ip=get_client_ip2();
				$data['lastip']=$ip;
				$data['lasttime']=date("Y-m-d H:i:s");
				M("user")->where("uid=".$result['uid'])->save($data);			
				session('uid',$result['uid']);
				session('unum',$result['unum']);
				session('uname',$result['uname']);
				$this->ajaxReturn ( array ('status' => 3), 'json' );
				
			}
		}
		
	}
	//生成验证码
	public function verify() {
		import('ORG.Util.Image');
		Image::buildImageVerify (1,1,'png',60,26);
	}
	
}