<?php
class IndexAction extends Action{
	
	public function index(){
		//ip追踪描述desc 说明是哪个module 并且是谁
		$description=__ACTION__."-";
		if(isset($_SESSION['uid'])){
			$user=M('user')->where(array('uid'=>$_SESSION['uid']))->find();
			// p($user);die;
			$description=$description.$user['unum']."-".$user['uname'];
			// p($description);die;
		}

		//开启ip追踪
		$ip=get_client_ip2();
		$data['description']=$description;
		$data['ip']=$ip;
		$data['time_stamp']=time();
		$data['time_date']=date("Y-m-d H:i:s",$data['time_stamp']);
		// p($data);die;
		$ipCheck=M("lastip")->where(array("ip"=>$data['ip']))->order("time_stamp desc")->find();
		if(count($ipCheck)>0){
			//五分钟以内的，不进行更改
			//超过五分钟,进行新的记录
			// p($data['time_stamp']-$ipCheck[0]['time_stamp']);die;
			if($data['time_stamp']-$ipCheck['time_stamp'] <= 300 ){
				;
			}else{
				M("lastip")->add($data);
			}
		}else{
				M("lastip")->add($data);
			}

		$this->user=$user;
		$this->display();
	}
	public function home(){
		$news=M('news')->where(array('nstatus'=>1,))->order('ntop desc,ndate desc,nid desc')->limit(5)->select();
		//p($news);
		$lecture=M('lecture')->where(array('lcheckstatus'=>1,'lstatus'=>1,))->limit(5)->order('ldatestart desc')->select();
		$user=M('user')->where("usuper = 0 AND upoint >0 AND uflag <> '教师'")->limit(10)->order('upoint desc')->select();
		$race=M('race')->where(array('rstatus'=>1,))->order('rdatestart desc, rid desc')->limit(5)->select();
		$projectnews=M('projectnews')->where(array('pstatus'=>1,))->order('pdatestart desc, pid desc')->limit(5)->select();
		$elite=M('elite')->select();
		if(count($news)==0){
			$newsFlag=0;
		}else{
			$newsFlag=1;
		}
		if(count($lecture)==0){
			$lectureFlag=0;
		}else{
			$lectureFlag=1;
		}
		if(count($user)==0){
			$userFlag=0;
		}else{
			$userFlag=1;
		}
		if(count($race)==0){
			$raceFlag=0;
		}else{
			$raceFlag=1;
		}
		if(count($projectnews)==0){
			$projectnewsFlag=0;
		}else{
			$projectnewsFlag=1;
		}
		if(count($elite)==0){
			$eliteFlag=0;
		}else{
			$eliteFlag=1;
		}
		$this->lectureFlag=$lectureFlag;
		$this->newsFlag=$newsFlag;
		$this->userFlag=$userFlag;
		$this->raceFlag=$raceFlag;
		$this->projectnewsFlag=$projectnewsFlag;
		$this->eliteFlag=$eliteFlag;
		$this->news=$news;
		$this->lecture=$lecture;
		$this->user=$user;
		$this->race=$race;
		$this->projectnews=$projectnews;
		$this->elite=$elite;
		$this->display();
	}
	public function newslist(){
		import("ORG.Util.Page");
		$count=M('news')->count();
		$page=new Page($count,20);
		$limit = $page->firstRow . ',' . $page->listRows;
		$news=M('news')->limit($limit)->where(array('nstatus'=>1,))->order('ntop desc,ndate desc,nid desc')->select();
		
		$this->news=$news;
		$this->page=$page->show ();
		$this->display();
		
	}
	public function news(){
		$nid=I("nid");
		$news=M('news')->where(array('nid'=>$nid))->find();
		$this->news=$news;
		//p($news);
		$this->display();
	}
	public function lecturelist(){
		import("ORG.Util.Page");
		$count=M('lecture')->count();
		$page=new Page($count,20);
		$limit = $page->firstRow . ',' . $page->listRows;
		$lecture=M('lecture')->limit($limit)->where(array('lcheckstatus'=>1,'lstatus'=>1,))->order('ldatestart desc')->select();
		
		$this->lecture=$lecture;
		$this->page=$page->show ();
		$this->display();
	}
	public function lecture(){
		$lid=I("lid");
		$lecture=M('lecture')->where(array('lid'=>$lid))->find();
		$this->lecture=$lecture;
		//p($news);
		$this->display();
	}
	
	public function racelist(){
		import("ORG.Util.Page");
		$count=M('race')->count();
		$page=new Page($count,20);
		$limit = $page->firstRow . ',' . $page->listRows;
		$race=M('race')->limit($limit)->where(array('rstatus'=>1,))->order('rdatestart desc, rid desc')->select();
		
		$this->race=$race;
		$this->page=$page->show ();
		$this->display();
	}
	public function race(){
		$rid=I("rid");
		$race=M('race')->where(array('rid'=>$rid))->find();
		$this->race=$race;
		//p($race);
		//p($news);
		$this->display();
	}
	public function projectnewslist(){
		import("ORG.Util.Page");
		$count=M('projectnews')->count();
		$page=new Page($count,20);
		$limit = $page->firstRow . ',' . $page->listRows;
		$projectnews=M('projectnews')->limit($limit)->where(array('pstatus'=>1,))->order('pdatestart desc, pid desc')->select();
		$this->projectnews=$projectnews;
		$this->page=$page->show ();
		$this->display();
	}
	public function projectnews(){
		$pid=I("pid");
		$projectnews=M('projectnews')->where(array('pid'=>$pid))->find();
		$this->projectnews=$projectnews;
		//p($race);
		//p($news);
		$this->display();
	}
	
	public function elite(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$elitegroup=D('EliteRelation')->relation(true)->order('eid ')->select();
		//p($elitegroup);
		$this->elitegroup=$elitegroup;
		$this->display();
	}
	public function downfile(){
		
			header("Content-type:text/html;charset=utf-8"); 
			$filename=$_GET['filename'];
			
			header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
			header('Content-Length:'.filesize($filename)); //指定下载文件的大小
			//将文件内容读取出来并直接输出，以便下载
			readfile($filename);
	}
	public function about(){
		$this->display();
	}
	public function suggest(){
		$this->display();
	}
	//用户注册行为
	//school master unum uname ugrade
	//默认设置  uprofession = 学生 
	//默认设置 邮箱为空
	//默认设置 电话为空
	//默认设置 密码为md5(学号)
	public function regist(){
		$data["unum"]=$_POST['unum'];//141340120
		$data["master"]=$_POST['master'];
		$data["uname"]=$_POST['uname'];
		$data["school"]=$_POST['school'];
		$data["ugrade"]=$_POST['ugrade'];
		$data["umail"]="";
		$data["utel"]="";
		$data["upassword"]=md5($unum);
		// p($data);exit();
		if(strlen($data["unum"])!=9 || strlen($data["master"])==0 || strlen($data["uname"])==0  || strlen($data["school"])==0 || strlen($data["ugrade"])==0 || strlen($data["upassword"])==0 ){
			$this->error("信息填写有误！");
			echo "unum error".$data["unum"];
			exit();
		}

		if(count(M("user")->where(array("unum"=>$data['unum']))->select())>0){
			$this->error("用户已经存在,请使用学号(密码为学号)登录！");
			// echo "user already exists";
			exit();
		}
		if(M("user")->add($data)){
			//等级写入
			$roleData['role_id']=1;
			$roleData['user_id']=M("user")->where(array("unum"=>$data['unum']))->getField("uid");
			if(M("role_user")->add($roleData)){
				//添加成功后进行登陆
				//三个必要的session内容
				session('uid',$roleData['user_id']);
				session('unum',$data['unum']);
				session('uname',$data['uname']);
				//进行首页状态的更改
				//向兴趣小组系统发送post，添加数据
				//url和data
				$postUrl="";//url
				$res=$this->sendPost($postUrl,$data);//发送
				// echo $res;
				// exit();
				//成功跳转
				$this->success("添加成功,请修改个人信息！","__URL__/Index/");

				exit();
			}else{
				$this->error("用户等级写入失败,请联系维护人员反馈！");
				exit();
			}
			
		}else{
			$this->error("用户写入失败,请联系维护人员反馈！");
			exit();
		}
		$this->display();
	}
	//用户登录
	public function login(){

		


	}
	 public function sendPost($url, $param=array()){
	    if(!is_array($param)){
	        throw new Exception("参数必须为array");
	    }
	    $httph =curl_init($url);
	    curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 1);
	    curl_setopt($httph,CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	    curl_setopt($httph, CURLOPT_POST, 1);//设置为POST方式 
	    curl_setopt($httph, CURLOPT_POSTFIELDS, $param);
	    curl_setopt($httph, CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($httph, CURLOPT_HEADER,1);
	    $rst=curl_exec($httph);
	    curl_close($httph);
	    return $rst;
	 }

}