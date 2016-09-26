<?php
class IndexAction extends CommonAction{
	//后台首页
	public function index(){
		
		$uid =$_SESSION['uid'];
		$result=D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
		
		$user=user_one($result);
		//p($user);die;
		$this->us=$user;
		//学生需要进行输出验证
		$userUrlNum=session("unum");//学号
		$userUrlName=md5(session("uname"));//姓名
		$userUrlCheck=md5(md5($userUrlNum).$userUrlName);//验证码
		//验证规则是
		//   发送学号和姓名 学号是正常的学号  姓名是md5加密的姓名
		//   验证码是 学号加密然后和姓名拼接 然后在进行同样的md5加密
		//关键的验证规则  
		// 发送学号，数据库查询姓名，进行md5验证，之后在进行验证码的验证
		
		//在兴趣小组选项中进行输出
		$this->userUrlNum=$userUrlNum;
		$this->userUrlName=$userUrlName;
		$this->userUrlCheck=$userUrlCheck;
		
		// var_dump($this->userUrlCheck);
		// exit();

		$this->display();
	}
	//显示后台中间主页
	public function home(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$uid =I('uid');
		$us = D('UserRelation')->relation(true)->where(array('uid'=>$uid,))->find();
		//p($us);die;
		
		$now=explode("-", date("Y-m-d"));

		
		//p($now);
		//角色判定
		switch($us['role'][0]['name']){
			case '学生':
					
					//竞赛信息通知
					$race=M('race_user')->where(array('status'=>2,'unum'=>$unum))->select();
					$this->race=$race;	
					//讲座通知
					$lecture=M('lecture')->where(array('lcheckstatus'=>2,'ldirectornum'=>$unum))->select();
					$this->lecture=$lecture;
					//个人信息设置
					$selfmsg=M('user')->where(array('uckeck'=>0,'unum'=>$unum))->find();
					if(empty($selfmsg))
						$selfmsg=0;
					//p($selfmsg);die;	
					$this->selfmsg=$selfmsg;
					//项目信息通知
					$profirstunckeck=array();
					$proleaderunckeck=array();
					$promiddleunckeck=array();
					$prolastunckeck=array();
					$middlecheck=array();
					$lastcheck=array();
					$reportinform=array();
					for($i=0;$i<count($us['project']);$i++){
						$project=D('ProjectRelation')->relation('report')->where(array('pid'=>$us['project'][$i]['pid']))->find();
						//判定中期检查表
						if($project['pendstatus']==0){
							//管理员审核未通过的
							if($project['pstatus']==2){
								$data=array('pid'=>$project['pid'],'pname'=>$project['pname']);
								array_push($profirstunckeck,$data);
							}
							//学校审核未通过的
							if( ($project['pstatus']==1) && ($project['pleaderstatus']==2)){
								$data=array('pid'=>$project['pid'],'pname'=>$project['pname']);
								array_push($proleaderunckeck,$data);
							}
							//中期材料未通过的
							if($project['pmiddlecheck']==2){
								$data=array('pid'=>$project['pid'],'pname'=>$project['pname']);
								array_push($promiddleunckeck,$data);
							}
							//结题材料未通过的
							if($project['plastcheck']==2){
								$data=array('pid'=>$project['pid'],'pname'=>$project['pname']);
								array_push($prolastunckeck,$data);
							}
							//判定未上传中期材料
							if(($project['pmiddlestatus']==1) && ($project['pmiddleaccessory']=="")){
								$data=array('pid'=>$project['pid'],'pname'=>$project['pname']);
								array_push($middlecheck, $data);
							}
							//判定未上传结题材料
							if(($project['plaststatus']==1) && ($project['plastaccessory']=="")){
								$data=array('pid'=>$project['pid'],'pname'=>$project['pname']);
								array_push($lastcheck, $data);
							}
							//判定月报
							
							if($project['pcheckdate']!='0000-00-00' && $project['pleaderstatus']){
								$date=explode("-", $project['pcheckdate']);
								for($year=$date[0];$year<=$now[0];$year++){
									if($year==$date[0])
										$month=$date[1]+1;
									else $month=1;
									if($year==$now[0])
										$endmonth=$now[1];
									else $endmonth=12; 		
									for(;$month<=$endmonth;$month++){
										$data=array('ryear'=>$year,'rmonth'=>$month);
										$result=myinarray($data, $project['report']);
										
										if(!$result){
											$news=array('pid'=>$project['pid'],'pname'=>$project['pname'],'ryear'=>$year,'rmonth'=>$month);
											array_push($reportinform,$news);
										}
										
									}
								}
								
							}
						}	
					}
				//	p($middlecheck);
				//	p($lastcheck);
				//p($reportinform);	
				$this->profirstunckeck=$profirstunckeck;
				$this->proleaderunckeck=$proleaderunckeck;
				$this->promiddleunckeck=$promiddleunckeck;
				$this->prolastunckeck=$prolastunckeck;
				$this->middlecheckinform=$middlecheck;
				$this->lastcheckinform=$lastcheck;
				$this->reportinform=$reportinform;
				break;
			case '教师':
				break;
			case '科创管理员':
				
			case '高级管理员':
				//竞赛部分
				$hererace=array();
				$race=M("race_user")->where(array('status'=>0,))->order('race_id desc,captainnum')->select();
				for($i=0;$i<count($race);$i++){
					if($race[$i+1]['race_id']==$race[$i]['race_id']){
						
					}else{
							array_push($hererace,$race[$i]);
					}
				}
				
				$this->race=$hererace;
				//项目部分
				$projectuncheck=array();
				$projectmiddleuncheck=array();
				$projectlastuncheck=array();
				
				$project=M('project')->where(array('pendstatus'=>0,))->select();
				//查询
				for($i=0;$i<count($project);$i++){
					//未审核的单子
					if(!$project[$i]['pstatus']){
						$data=array('pid'=>$project[$i]['pid'],'pname'=>$project[$i]['pname']);
						array_push($projectuncheck,$data);
					}
					//未审核中期材料的单子
					if($project[$i]['pmiddlestatus'] && !empty($project[$i]['pmiddleaccessory'])){
						if(!$project[$i]['pmiddlecheck']){
							$data=array('pid'=>$project[$i]['pid'],'pname'=>$project[$i]['pname']);
							array_push($projectmiddleuncheck,$data);
						}
					}
					//未审核结题材料的单子
					if($project[$i]['plaststatus'] && !empty($project[$i]['plastaccessory'])){
						if(!$project[$i]['plastcheck']){
							$data=array('pid'=>$project[$i]['pid'],'pname'=>$project[$i]['pname']);
							array_push($projectlastuncheck,$data);
						}
					}		
				}
				$this->projectunckeck=$projectuncheck;
				$this->projectmiddleuncheck=$projectmiddleuncheck;
				$this->projectlastuncheck=$projectlastuncheck;
				//p($projectuncheck);
				//讲座审核
				$lecture=M('lecture')->where(array('lcheckstatus'=>0))->select();
				$this->lecture=$lecture;
				break;	
		}
		$this->us=$us;
		$this->display();
	}

	//注销
	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect(GROUP_NAME.'/Login/index');
	}
//	//修改个人信息
//	public function changemsg(){
//		
//		$uid = I ( 'uid', '', 'intval' );
//		$us = D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
//		$us=user_one($us);
//		$this->us = $us;
//		$this->display ();
//	}
	//处理修改个人信息方法
	public function update(){
		
		if($_POST['uflag']=='学生'){
			$user=array(
			'uid'=>$_POST['uid'],
			'master'=>$_POST['master'],
			'utel'=>$_POST['tel'],
			'umail'=>$_POST['mail'],
			);
		}
		else{
			$user=array(
			'uid'=>$_POST['uid'],
			'master'=>$_POST['master'],
			'utel'=>$_POST['tel'],
			'umail'=>$_POST['mail'],
			'uprofession'=>$_POST['profession'],
			);
		}
	//	p($user);die;
		$result=M('user')->save($user);
		
		if($result){
			$this->success("修改成功",U('Admin/Index/index'));
		}else
			$this->error("未改动",U('Admin/Index/index'));
	}
//	//修改密码
//	public function changepwd(){
//		$uid = I ( 'uid', '', 'intval' );
//    	$us = M ( 'user' )->find ( $uid );
//    	$this->us = $us;
//    	
//    	$this->display ();
//	}
	//处理修改密码
	public function updatepwd(){
		
		if($_POST['upasswordnew']==$_POST['upasswordrenew']){
			$oldpwd=I('upasswordold','','md5');
			$user=M('user')->find($_POST['uid']);
			if($oldpwd==$user['upassword']){
				$save['uid']=$user['uid'];
				$save['upassword']=md5($_POST['upasswordnew']);
				$result=M('user')->save($save);
				if($result)$this->success("修改成功",U("Admin/Index/index"));
				else 
				$this->error("修改失败",U("Admin/Index/index"));
			}else 
			$this->error("原始密码错误",U("Admin/Index/index"));
		}else 
		$this->error("两次输入的密码不一致",U("Admin/Index/index"));
		
	}
	//察看帮助
	public function help(){
		 $this->display ();
	}
}