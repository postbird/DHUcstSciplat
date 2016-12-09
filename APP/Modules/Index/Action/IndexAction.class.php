<?php
class IndexAction extends Action{
	public function _initialize(){
		// //ip追踪描述desc 说明是哪个module 并且是谁
		// $description=__ACTION__."-";
		$user='';
		if(isset($_SESSION['uid'])){
			$user=M('user')->where(array('uid'=>$_SESSION['uid']))->find();
			// p($user);die;
			//$description=$description.$user['unum']."-".$user['uname'];
			// p($description);die;
		}

		// //开启ip追踪
		// $ip=get_client_ip2();
		// $data['description']=$description;
		// $data['ip']=$ip;
		// $data['time_stamp']=time();
		// $data['time_date']=date("Y-m-d H:i:s",$data['time_stamp']);
		// // p($data);die;
		// $ipCheck=M("lastip")->where(array("ip"=>$data['ip']))->order("time_stamp desc")->find();
		// if(count($ipCheck)>0){
		// 	//五分钟以内的，不进行更改
		// 	//超过五分钟,进行新的记录
		// 	// p($data['time_stamp']-$ipCheck[0]['time_stamp']);die;
		// 	if($data['time_stamp']-$ipCheck['time_stamp'] <= 300 ){
		// 		;
		// 	}else{
		// 		M("lastip")->add($data);
		// 	}
		// }else{
		// 		M("lastip")->add($data);
		// 	}
		$this->user=$user;
	}
	//判断结果是否为空，为空则重定向到入口
	//防止查询空结果
	public function redirectParam($param){
		if(count($param)==0){
			$this->redirect("Index.html");
			return;
		}
	}
	//判断参数内容，防止sql注入
	//如果发现非法参数则直接重定向
	public function checkParam($param){
		if(strpos($param,';')||strpos($param,'"')||strpos($param,',')||strpos($param,'(')||strpos($param,')')||strpos($param,'*')||strpos($param,"'")){
			$description=$param."-".$this->user."-".__ACTION__;
			$ip=get_client_ip2();
			$data['description']=$description;
			$data['ip']=$ip;
			$data['time_stamp']=time();
			$data['time_date']=date("Y-m-d H:i:s",$data['time_stamp']);
			M("lastsql")->add($data);
			$this->redirect("Index.html");
		}else{
			return true;
		}
	}

	public function index(){
		$this->home();
		$this->page_title="计算机学院科创管理系统";
		$this->display();
	}
	public function home(){
		$news=M('news')->where(array('nstatus'=>1,))->order('ntop desc,ndate desc,nid desc')->limit(5)->select();
		//p($news);
		$lecture=M('lecture')->where(array('lcheckstatus'=>1,'lstatus'=>1,))->limit(5)->order('ldatestart desc')->select();
		$stu=M('user')->where("usuper = 0 AND upoint >0 AND uflag <> '教师'")->limit(10)->order('upoint desc')->select();
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
		if(count($stu)==0){
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
		$this->stu=$stu;
		$this->race=$race;
		$this->projectnews=$projectnews;
		$this->elite=$elite;
		// $this->display();
	}
	public function pointlist(){
		// p(UU());
		import("ORG.Util.Page");
		$count=M('user')->where("usuper = 0 AND upoint >0 AND uflag <> '教师'")->count();
		$page=new Page($count,100,'',UU());
		$page->setConfig('header','人');
		$page->setConfig('prev','<i class="fa fa-chevron-left"></i>');
		$page->setConfig('next','<i class="fa fa-chevron-right"></i>');
		$page->setConfig("theme","<li  class='total-span'><a>共 %totalRow% %header% </a></li> <li> %first% </li> <li> %upPage% </li> <li> %linkPage% </li> <li> %downPage% </li> <li> %end% </li>");
		$limit = $page->firstRow . ',' . $page->listRows;
		$stu=M('user')->limit($limit)->where("usuper = 0 AND upoint >0 AND uflag <> '教师'")->order('upoint desc')->select();
		$this->redirectParam($stu);
		$this->stu=$stu;
		$this->page=$page->show();
		$this->page_title="科创积分榜 | 计算机学院科创管理系统";
		$this->display();
	}
	public function newslist(){
		import("ORG.Util.Page");
		$count=M('news')->count();
		$page=new Page($count,30,'',UU());
		$page->setConfig('header','条新闻');
		$page->setConfig('prev','<i class="fa fa-chevron-left"></i>');
		$page->setConfig('next','<i class="fa fa-chevron-right"></i>');
		$page->setConfig("theme","<li class='total-span'><a>共 %totalRow% %header% </a></li> <li> %first% </li> <li> %upPage% </li> <li> %linkPage% </li> <li> %downPage% </li> <li> %end% </li>");
		$limit = $page->firstRow . ',' . $page->listRows;
		$news=M('news')->limit($limit)->where(array('nstatus'=>1,))->order('ntop desc,ndate desc,nid desc')->select();
		$this->news=$news;
		$this->redirectParam($news);
		
		$this->page=$page->show ();
		$this->page_title="新闻 | 计算机学院科创管理系统";
		$this->display();
	}
	public function news(){
		$nid=I("view");
		$this->checkParam($nid);
		$news=M('news')->where(array('nid'=>$nid))->find();
		$this->redirectParam($news);
		// $news['nview']=$news['nview']+1;
		$this->news=$news;
		$this->page_title=$news['ntitle']." | 计算机学院科创管理系统";
		
		//p($news);
		$this->display();
	}
	//统计浏览量 使用ajax请求
	//ajax参数为 view 
	public function newsView(){
		$nid=I("view");
		$this->checkParam($nid);
		M('news')->where(array('nid'=>$nid))->setInc('nview',1);
		$data['status']="ok";
		$data['msg']="checked";
	}
	public function lecturelist(){
		import("ORG.Util.Page");
		$count=M('lecture')->count();
		$page=new Page($count,20,'',UU());
		$page->setConfig('header','场讲座');
		$page->setConfig('prev','<i class="fa fa-chevron-left"></i>');
		$page->setConfig('next','<i class="fa fa-chevron-right"></i>');
		$page->setConfig("theme","<li class='total-span'><a>共 %totalRow% %header% </a></li> <li> %first% </li> <li> %upPage% </li> <li> %linkPage% </li> <li> %downPage% </li> <li> %end% </li>");
		$limit = $page->firstRow . ',' . $page->listRows;
		$lecture=M('lecture')->limit($limit)->where(array('lcheckstatus'=>1,'lstatus'=>1,))->order('ldatestart desc')->select();
		$this->redirectParam($lecture);
		$this->page_title="讲座 | 计算机学院科创管理系统";
		$this->lecture=$lecture;
		
		$this->page=$page->show ();
		$this->display();
	}
	public function lecture(){
		$lid=I("view");
		$this->checkParam($lid);
		$unum=$this->user['unum'];
		$lecture=M('lecture')->where(array('lid'=>$lid))->find();
		$this->redirectParam($lecture);
		//判定是否过期
		$sub=time()-strtotime($lecture['ldateend']." 00:00:00");
		if($sub>0){
			$lecture['subtime']=1;
		}
		else 
			$lecture['subtime']=0;
		//判定是否已经报名
		$lectureuser=M('lecture_user')->where(array('lecture_id'=>$lid,'user_num'=>$unum))->find();
		if(empty($lectureuser))
			$isapply=0;
		else
			$isapply=1;
		$userCount=M("lecture_user")->where(array("lecture_id"=>$lid,))->count();
		//判断人数满了
		if($userCount>=$lecture['lnum']){
			$userSpill=1;
		}else{
			$userSpill=0;
		}
		// p($userCount);
		$this->userspill=$userSpill;
		//输出
		$this->lecture=$lecture;
		$this->usercount=$userCount;
		$this->isapply=$isapply;
		$this->page_title=$lecture['ltitle']." | 计算机学院科创管理系统";
		$this->display();
	}
	
	public function racelist(){
		import("ORG.Util.Page");
		$count=M('race')->count();
		$page=new Page($count,20,'',UU());
		$page->setConfig('header','场竞赛');
		$page->setConfig('prev','<i class="fa fa-chevron-left"></i>');
		$page->setConfig('next','<i class="fa fa-chevron-right"></i>');
		$page->setConfig("theme","<li class='total-span'><a>共 %totalRow% %header% </a></li> <li> %first% </li> <li> %upPage% </li> <li> %linkPage% </li> <li> %downPage% </li> <li> %end% </li>");
		$limit = $page->firstRow . ',' . $page->listRows;
		$race=M('race')->limit($limit)->where(array('rstatus'=>1,))->order('rdatestart desc, rid desc')->select();
		$this->redirectParam($race);
		$this->race=$race;
		$this->page_title="竞赛 | 计算机学院科创管理系统";
		$this->page=$page->show ();
		$this->display();
	}
	public function race(){
		$rid=I("view");
		$this->checkParam($rid);
		$race=M('race')->where(array('rid'=>$rid))->find();
		$this->race=$race;
		$this->redirectParam($race);
		//p($race);
		//p($news);
		$this->page_title=$race['rname']." | 计算机学院科创管理系统";
		$this->display();
	}
	public function projectnewslist(){
		import("ORG.Util.Page");
		$count=M('projectnews')->count();
		$page=new Page($count,20,'',UU());
		$page->setConfig('header','个项目');
		$page->setConfig('prev','<i class="fa fa-chevron-left"></i>');
		$page->setConfig('next','<i class="fa fa-chevron-right"></i>');
		$page->setConfig("theme","<li class='total-span'><a>共 %totalRow% %header% </a></li> <li> %first% </li> <li> %upPage% </li> <li> %linkPage% </li> <li> %downPage% </li> <li> %end% </li>");
		$limit = $page->firstRow . ',' . $page->listRows;
		$projectnews=M('projectnews')->limit($limit)->where(array('pstatus'=>1,))->order('pdatestart desc, pid desc')->select();
		$this->projectnews=$projectnews;
		$this->page=$page->show ();
		$this->page_title="项目 | 计算机学院科创管理系统";
		$this->display();
	}
	public function projectnews(){
		$pid=I("view");
		$this->checkParam($pid);
		$projectnews=M('projectnews')->where(array('pid'=>$pid))->find();
		$this->projectnews=$projectnews;
		$this->redirectParam($projectnews);
		//p($race);
		//p($news);
		$this->page_title=$projectnews['ptitle']." | 计算机学院科创管理系统";
		$this->display();
	}

	public function elite(){
		$elitegroup=D('EliteRelation')->relation(true)->order('eid ')->select();
		//p($elitegroup);
		$this->elitegroup=$elitegroup;
		$this->page_title="科创人才库 | 计算机学院科创管理系统";
		$this->display();
	}
	public function downfile(){
			header("Content-type:text/html;charset=utf-8"); 
			$filename=I('back');
			
			header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
			header('Content-Length:'.filesize($filename)); //指定下载文件的大小
			//将文件内容读取出来并直接输出，以便下载
			readfile($filename);
	}
	public function about(){
		$this->page_title="版本历史 | 计算机学院科创管理系统";
		$this->display();
	}
	public function suggest(){
		$this->page_title="建议反馈 | 计算机学院科创管理系统";
		$this->display();
	}
	//用户注册行为
	//school master unum uname ugrade
	//默认设置  uprofession = 学生 
	//默认设置 邮箱为空
	//默认设置 电话为空
	//默认设置 密码为md5(学号)
	public function regist(){
		$data["unum"]=trim($_POST['unum']);
		$data["master"]=trim($_POST['master']);
		$data["uname"]=trim($_POST['uname']);
		$data["school"]=trim($_POST['school']);
		$data["ugrade"]=trim($_POST['ugrade']);
		$data['uflag']="学生";
		$data['uprofession']='学生';
		$data["umail"]="";
		$data["utel"]="";
		$data["upassword"]=md5($data["unum"]);
		// p(" ".md5($data["unum"])."  ".$data['upassword']." ".md5("151100206"));die;
		 // p(strlen($data["unum"]));exit();
		if(strlen($data["unum"])!=9 || strlen($data["master"])==0 || strlen($data["uname"])==0  || strlen($data["school"])==0 || strlen($data["ugrade"])==0 || strlen($data["upassword"])==0 ){
			$this->error("信息填写有误！");
			// echo "unum error".$data["unum"];
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
				$postUrl="http://cst.shiroimagnolia.com/accounts/kc_sign/";//url
				// $postUrl="http://localhost/sciplat/Admin/Test/postTest/";
				$res=$this->sendPost($postUrl,$data);
				// p($res);exit();
				if($res){
					$this->success("添加成功,请修改个人信息！","__URL__/Index/");
				}else{
					$this->error("添加成功,但是兴趣小组信息同步失败,请联系管理员！","__URL__/Index/");
				}//发送
				// echo $res;
				// exit();
				//成功跳转

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
	        exit();
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