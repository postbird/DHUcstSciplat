<?php
class ResignAction extends Action{
	public function index(){

		$this->display();
	}
	public function resignCheck(){
		//职称
		if($_POST['role']=='学生'){
			$profession='学生';
		}
		else 
			$profession=$_POST['profession'];
			
		$num=$_POST['usernum'];
		$people=M('people')->where(array('pnum'=>$num,))->find();
		if(!empty($people)){
			if($people['pname']==$_POST['username']){
				$people=array(
						'unum'=>$num,
						'uname'=>$people['pname'],
						'upassword'=>md5($_POST['password']),
						'utel'=>$_POST['tel'],
						'uflag'=>$_POST['role'],
						'uprofession'=>$profession,	
				);
				$result=M('user')->add($people);
				if($_POST['role']=='学生'){
					$role=M('role')->where(array('name'=>'学生'))->find();
					$newone=array('role_id'=>$role['id'],'user_id'=>$result);
					$result2=M('role_user')->add($newone);
				}else{
					$role=M('role')->where(array('name'=>'教师'))->find();
					$newone=array('role_id'=>$role['id'],'user_id'=>$result);
					$result2=M('role_user')->add($newone);
				}
				if($result&&$result2)
					$this->success("注册成功！",U('Admin/Login/index'));
				else 
					$this->error("写入失败！");	
			}else
			$this->error("姓名不匹配！"); 
		}else 
		$this->error("该学号不存在数据库中！");
	}
}