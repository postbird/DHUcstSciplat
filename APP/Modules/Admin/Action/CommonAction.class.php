<?php
class CommonAction extends Action{
	public function _initialize(){
		//判断登录成功
		if(!isset($_SESSION['uid'])){
			$this->redirect('Admin/Login/index');
		}
		
	}
}