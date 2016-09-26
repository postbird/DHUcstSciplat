<?php
class CommonAction extends Action{
	//�˺����ڱ�ʵ����֮��һ����һ��ִ��
	public function _initialize(){
		//判断登录成功
		if(!isset($_SESSION['uid'])){
			$this->redirect('Admin/Login/index');
		}
		
	}
}