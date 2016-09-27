<?php
class IndexAction extends Action{
	
	public function index(){
		
		if(isset($_SESSION['uid'])){
			$user=M('user')->where(array('uid'=>$_SESSION['uid']))->find();
		}
		$this->user=$user;
		$this->display();
	}
	public function home(){
		$news=M('news')->where(array('nstatus'=>1,))->order('ntop desc,ndate desc')->limit(7)->select();

		//p($news);
		$lecture=M('lecture')->where(array('lcheckstatus'=>1,'lstatus'=>1,))->limit(7)->order('ldatestart desc')->select();
		$user=M('user')->where("usuper = 0 AND upoint >0")->limit(10)->order('upoint desc')->select();
		$race=M('race')->where(array('rstatus'=>1,))->order('rdatestart desc, rid desc')->limit(7)->select();
		$projectnews=M('projectnews')->where(array('pstatus'=>1,))->order('pdatestart desc, pid desc')->limit(7)->select();
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
		$news=M('news')->limit($limit)->where(array('nstatus'=>1,))->order('ntop desc,ndate desc')->select();
		
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
		$elitegroup=D('EliteRelation')->relation(true)->order('eid')->select();
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
}