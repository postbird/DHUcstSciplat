<?php
class CommonAction extends Action{
	
	public function _initialize(){
		//判断登录成功
		if(!isset($_SESSION['uid'])){
			$this->redirect('Admin/Login/index');
		}else{
			//ip追踪描述desc 说明是哪个module 并且是谁
			$description=substr(__ACTION__,strlen("index.php/Admin/"),strlen(__ACTION__)-1)."-";
			$user=M('user')->where(array('uid'=>$_SESSION['uid']))->find();
			// p($user);die;
			$description=$description.$user['unum']."-".$user['uname'];
			// p($description);die;
			//开启ip追踪
			$ip=get_client_ip2();
			$data['description']=$description;
			$data['ip']=$ip;

			$data['time_stamp']=time();
			$data['time_date']=date("Y-m-d H:i:s",$data['time_stamp']);
			// echo $data['time_stamp']."    ".$data['time_date'];
			// p($data);
			$ipCheck=M("lastip")->where(array("ip"=>$data['ip']))->order("time_stamp desc")->find();
			// p($ipCheck);die;
			if(count($ipCheck)>0){
				//五分钟以内的，不进行更改
				//超过五分钟,进行新的记录
				// p($data['time_stamp']-$ipCheck['time_stamp']);die;
				//暂时开启全部的ip操作记录
				// if($data['time_stamp']-$ipCheck['time_stamp'] <= 300 ){

				// }else{
				// 	M("lastip")->add($data);
				// }
				M("lastip")->add($data);
			}else{
				M("lastip")->add($data);
			}
		}
	}
}