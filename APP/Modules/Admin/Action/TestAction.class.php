<?php
class TestAction extends Action{

	private $check="postbird2016926835";

	public function index(){
		$this->display();
	}
	public function showJson(){
		$check=$_REQUEST['check'];
		if($check!=$this->check){
			exit();
		}
		$User=M("user");
		$data=$User->where("usuper != 1")->select();
		$jsonStr= "[";
		for($i=0;$i<count($data);$i++){
			if($i==0){
			}else{
				$jsonStr=$jsonStr.",";
			}
			$jsonStr=$jsonStr.'{"unum":"'.$data[$i]["unum"].'","uname":"'.$data[$i]["uname"].'","master":"'.$data[$i]["master"].'","ugrade":"'.$data[$i]["ugrade"].'","school":"'.$data[$i]["school"].'"}';
		}
		$jsonStr=$jsonStr . "]";
		echo  $jsonStr;
	}
	public function returnJson(){
		$check=$_REQUEST['check'];
		if($check!=$this->check){
			exit();
		}

		$User=M("user");

		$data=$User->where("usuper != 1")->getField("unum,uname,master,ugrade,school");

		$this->ajaxReturn($data,"json");
	}
	public function showCheckInfo(){
		$check=$_REQUEST['check'];
		if($check!=$this->check){
			exit();
		}
		echo "<pre>";
			echo "目前使用 returnJson函数可以直接返回json数据";
		echo "</pre>";
	}
	public function postTest(){
		$data=$_POST;
		$str['name']=$data['uname'];
		M("test")->add($str);
		return "hello marker";
	}
}