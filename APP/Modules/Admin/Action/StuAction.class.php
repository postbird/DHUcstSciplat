<?php
class StuAction extends CommonAction{
	//========竞赛中心开始========
	public function race(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		import("ORG.Util.Page");
		$count=M('race')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		$race=M('race')->where(array('rstatus'=>'1',))->limit($limit)->order('rdatestart desc,rid desc')->select();
		$this->race=$race;
		$this->page=$page->show ();
		$this->display();
	}
	//添加讲座
	public function addLecture(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->display();
	}
	public function raceread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$rid=I('rid');
		$race=M('race')->where(array('rid'=>$rid))->find();
		//判定是否过期
		$sub=(time()-strtotime($race['rdateend']))-1*24*60*60;
		if($sub>0){
			$race['subtime']=1;
		}
		else 
		$race['subtime']=0;
		$this->race=$race;
		//判定是否已经报名
		$raceuser=M('race_user')->where(array('race_id'=>$rid,'unum'=>$unum))->find();
		if(empty($raceuser))
			$isapply=0;
		else
			$isapply=1;
		$this->isapply=$isapply;
		$this->display();
	}
	public function downracefile(){
			
			header("Content-type:text/html;charset=utf-8"); 
			$filename=$_GET['filename'];
			
			header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
			header('Content-Length:'.filesize($filename)); //指定下载文件的大小
			//将文件内容读取出来并直接输出，以便下载
			readfile($filename);
	}
	public function raceinsert(){
		//检查成员是否正确
		for($i=0;$i<count($_POST['num']);$i++){
			$num=$_POST['num'][$i];
			if(empty($num)){
				$this->error("学号不能为空！");
			}
			$result=M('user')->where(array('unum'=>$num))->find();
			if($_POST['name'][$i]!=$result['uname']){
				$this->error("学号为:".$num."的姓名不匹配！");
			}
		}
		//检测图片上传
		if($_FILES['imageFile']['error']){
				if($_FILES['imageFile']['error']==4){
					$imageFilePath="";
				}else{
					switch($_FILES['imageFileFile']['error']){
						case 1:
							$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
						case 2:
							$this->error("上传文件超过了表单文件最大值");break;	
						case 3:
							$this->error("文件被部分上传");break;
						case 6:
							$this->error("没有找到临时文件");break;
						case 7:
						case 8:
							$this->error("系统错误");break;		
					}
				}
			}else{
			//限制文件上传大小
				
			//限制文件上传类型
			$allowExt=array('jpg','png','gif');
			$imageext=pathinfo($_FILES['imageFile']['name'],PATHINFO_EXTENSION);
			if(!in_array($imageext,$allowExt)){
				$this->error("上传文件格式不正确！");
			}
			//生成随即文件名
			$imageuniName=md5(uniqid(microtime(true),true)).'.'.$imageext;
			$imageFilePath="/Uploads/race/".$imageuniName;
			$imageFilePathtmp=".".$imageFilePath;
			//将上传的临时文件保存到制定目录
			move_uploaded_file($_FILES['imageFile']['tmp_name'],$imageFilePathtmp);
							
			}
		//检测附件上传
		if($_FILES['raceFile']['error']){
				if($_FILES['raceFile']['error']==4){
					$raceFilePath="";
				}else{
					switch($_FILES['raceFile']['error']){
						case 1:
							$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
						case 2:
							$this->error("上传文件超过了表单文件最大值");break;	
						case 3:
							$this->error("文件被部分上传");break;
						case 6:
							$this->error("没有找到临时文件");break;
						case 7:
						case 8:
							$this->error("系统错误");break;		
					}
				}
			}else{
			//限制文件上传大小
				if($_FILES['raceFile']['size']>10*1024*1024){
					$this->error("上传文件过大！");
				}
				//限制文件上传类型
				$allowExt=array('doc','pdf','zip');
				$ext=pathinfo($_FILES['raceFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($ext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//生成随即文件名
				$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
				$raceFilePath="/Uploads/race/".$uniName;
				$raceFilePathtmp=".".$raceFilePath;
				//将上传的临时文件保存到制定目录
				move_uploaded_file($_FILES['raceFile']['tmp_name'],$raceFilePathtmp);
							
			}
		//循环添加记录至race_user表中
		$a=0;
		for($j=0;$j<count($_POST['num']);$j++){
			$data=array(
				'race_id'=>$_POST['rid'],
				'unum'=>$_POST['num'][$j],
				'uname'=>$_POST['name'][$j],
				'captainnum'=>$_POST['num'][0],
				'accessory'=>$raceFilePath,
				'bonus'=>$_POST['bonus'],
				'race_name'=>$_POST['race_name'],
				'race_level'=>$_POST['race_level'],
				'accessory'=>$raceFilePath,
				'image'=>$imageFilePath,
				
			);
			$result=M('race_user')->add($data);
			if(!$result)
			$a++;
		}
		if(!$a)
				$this->success("申请成功，请等待审核！");
			else 
				$this->error("申请失败，请联系管理员！");		
	}
		//我的竞赛
	public function myrace(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$myrace=M('race_user')->where(array('unum'=>$unum))->order('mid desc')->select();
		$this->myrace=$myrace;
		$this->display();
	}
	public function myraceread(){
		
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$race_id=I('race_id');
		$captainnum=I('captainnum');
		$race=M('race_user')->where(array('race_id'=>$race_id,'captainnum'=>$captainnum))->select();
	//p($race);
		$this->race=$race;
		$this->display();
		
	}
	public function myraceupdate(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$race_id=I('race_id');
		$captainnum=I('captainnum');
		$race=M('race_user')->where(array('race_id'=>$race_id,'captainnum'=>$captainnum))->select();
		//p($race);die;
		//检测图片上传
		if($_FILES['imageFile']['error']){
				if($_FILES['imageFile']['error']==4){
					
				}else{
					switch($_FILES['imageFileFile']['error']){
						case 1:
							$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
						case 2:
							$this->error("上传文件超过了表单文件最大值");break;	
						case 3:
							$this->error("文件被部分上传");break;
						case 6:
							$this->error("没有找到临时文件");break;
						case 7:
						case 8:
							$this->error("系统错误");break;		
					}
				}
			}else{
			//限制文件上传大小
				
			//限制文件上传类型
			$allowExt=array('jpg','png','gif');
			$imageext=pathinfo($_FILES['imageFile']['name'],PATHINFO_EXTENSION);
			if(!in_array($imageext,$allowExt)){
				$this->error("上传文件格式不正确！");
			}
			//生成随即文件名
			$imageuniName=md5(uniqid(microtime(true),true)).'.'.$imageext;
			$imageFilePath="/Uploads/race/".$imageuniName;
			$imageFilePathtmp=".".$imageFilePath;
			//将上传的临时文件保存到制定目录
			move_uploaded_file($_FILES['imageFile']['tmp_name'],$imageFilePathtmp);
			//删除之前的文件
			if(!empty($_POST['imagefile'])){
				$tmpfile=".".$_POST['imagefile'];
				unlink($tmpfile);
			}
			//循环添加记录至race_user表中
			$a=0;
			for($j=0;$j<count($race);$j++){
				$data=array(
					'mid'=>$race[$j]['mid'],
					'image'=>$imageFilePath,
					
				);
				$result=M('race_user')->save($data);
				if(!$result)
				$a++;
			}
			if(!$a)
					$this->success("保存成功，请等待审核！");
				else 
					$this->error("保存失败，请联系管理员！");						
			}
		//检测附件上传
		if($_FILES['raceFile']['error']){
				if($_FILES['raceFile']['error']==4){
					
				}else{
					switch($_FILES['raceFile']['error']){
						case 1:
							$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
						case 2:
							$this->error("上传文件超过了表单文件最大值");break;	
						case 3:
							$this->error("文件被部分上传");break;
						case 6:
							$this->error("没有找到临时文件");break;
						case 7:
						case 8:
							$this->error("系统错误");break;		
					}
				}
			}else{
			//限制文件上传大小
				if($_FILES['raceFile']['size']>10*1024*1024){
					$this->error("上传文件过大！");
				}
				//限制文件上传类型
				$allowExt=array('doc','pdf','zip');
				$ext=pathinfo($_FILES['raceFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($ext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//生成随即文件名
				$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
				$raceFilePath="/Uploads/race/".$uniName;
				$raceFilePathtmp=".".$raceFilePath;
				//将上传的临时文件保存到制定目录
				move_uploaded_file($_FILES['raceFile']['tmp_name'],$raceFilePathtmp);
				//删除之前的文件
				if(!empty($_POST['racefile'])){
					$tmpfile=".".$_POST['racefile'];
					unlink($tmpfile);
				}
				$b=0;
				for($j=0;$j<count($race);$j++){
					$data=array(
						'mid'=>$race[$j]['mid'],
						'accessory'=>$raceFilePath,
						
					);
					$result=M('race_user')->save($data);
					if(!$result)
					$b++;
				}
				if(!$b)
						$this->success("保存成功，请等待审核！");
					else 
						$this->error("保存失败，请联系管理员！");						
				}			
		//写入其他信息
		$c=0;
		for($j=0;$j<count($race);$j++){
			$data=array(
				'mid'=>$race[$j]['mid'],
				'bonus'=>$_POST['bonus'],
				
			);
			//p($data);die;
			$result=M('race_user')->save($data);
			if(!$result)
			$c++;
		}
		if(!$c)
				$this->success("申请成功，请等待审核！");
			else 
				$this->error("申请失败，请联系管理员！");						
	}	
	
	//========竞赛中心结束========
	//========项目中心开始========
	public function projectnews(){
		$unum=I("unum");
		$this->unum=$unum;
		$this->uname=I("uname");
		import("ORG.Util.Page");
		$count=M('projectnews')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		$projectnews=M('projectnews')->where(array('pstatus'=>'1',))->limit($limit)->order('pdateend desc,pid desc')->select();
		for($i=0;$i<count($projectnews);$i++){
			$isapply=M('project')->where(array('fid'=>$projectnews[$i]['pid'],'pcaptainnum'=>$unum))->find();
			if(empty($isapply))
				$projectnews[$i]['isleader']=0;
			else
				$projectnews[$i]['isleader']=1;
		
		}
		$this->projectnews=$projectnews;
		$this->page=$page->show ();
		$this->display();
	}
	public function projectnewsread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$pid=I('pid');
		$this->isleader=I('isleader');
		$projectnews=M('projectnews')->where(array('pid'=>$pid))->find();
		//判定是否过期
		$sub=(time()-strtotime($projectnews['pdateend']))-1*24*60*60;
		if($sub>0){
			$projectnews['subtime']=1;
		}
		else 
		$projectnews['subtime']=0;
		$this->projectnews=$projectnews;
		//知道老师列表
		$teacher=M('user')->where(array('uflag'=>"教师"))->field(array('unum','uname'))->order('unum')->select();
		$this->teacher=$teacher;
		//项目信息
		$this->pid=$pid;
		
		$this->display();
	}
	public function projectinsert(){
		//p($_POST);die;
		//p($_FILES);die;
		//检查成员是否正确
		for($i=0;$i<count($_POST['num']);$i++){
			$num=$_POST['num'][$i];
			if(empty($num)){
				$this->error("学号不能为空！");
			}
			$result=M('user')->where(array('unum'=>$num))->find();
			if($_POST['name'][$i]!=$result['uname']){
				$this->error("学号为:".$num."的姓名不匹配！");
			}
		}
		//检测老师是否正确
		if(empty($_POST['teachernum']))
			$this->error("教师工号不能为空");
		//查询项目信息
		$result=M('projectnews')->where(array('pid'=>$_POST['pid']))->field(array('pid','ptitle'))->find();
		$title=$result['ptitle'];	
		//检测附件上传
		if($_FILES['raceFile']['error']){
				if($_FILES['raceFile']['error']==4){
					$this->error("请上传附件！");
				}else{
					switch($_FILES['raceFile']['error']){
						case 1:
							$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
						case 2:
							$this->error("上传文件超过了表单文件最大值");break;	
						case 3:
							$this->error("文件被部分上传");break;
						case 6:
							$this->error("没有找到临时文件");break;
						case 7:
						case 8:
							$this->error("系统错误");break;		
					}
				}
			}else{
			//限制文件上传大小
				if($_FILES['raceFile']['size']>10*1024*1024){
					$this->error("上传文件过大！");
				}
				//限制文件上传类型
				$allowExt=array('doc','docx');
				$ext=pathinfo($_FILES['raceFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($ext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//生成随即文件名
				$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
				$raceFilePath="/Uploads/project/".$uniName;
				$raceFilePathtmp=".".$raceFilePath;
				//将上传的临时文件保存到制定目录
				move_uploaded_file($_FILES['raceFile']['tmp_name'],$raceFilePathtmp);
							
			}
		//添加记录至project表中
		$a=0;
		$data=array(
				'pname'=>$_POST['title'],
				'fid'=>$_POST['pid'],
				'ftitle'=>$title,
				'pclass'=>$_POST['class'],
				'pnumber'=>$_POST['number'],
				'pfather'=>$_POST['father'],
				'pcaptainnum'=>$_POST['num'][0],
				'pcaptainname'=>$_POST['name'][0],
				'pcontent'=>$_POST['content'],
				'paccessory'=>$raceFilePath,
				
			);
		
		$result=M('project')->add($data);
		//写入projet_user表中\
		$b=0;
		for($i=0;$i<count($_POST['num']);$i++){
			$user=M('user')->where(array('unum'=>$_POST['num'][$i]))->find();
			$data=array('project_id'=>$result,'user_id'=>$user['uid']);
			$tmpresult=M('project_user')->add($data);
			if(!$tmpresult)
				$b++;
		}
		$user=M('user')->where(array('unum'=>$_POST['teachernum']))->find();
		$data=array('project_id'=>$result,'user_id'=>$user['uid']);
		$tmpresult=M('project_user')->add($data);
		if(!$tmpresult)
				$b++;
		if(!$b)
				$this->success("申请成功！");
			else 
				$this->error("申请失败，请联系管理员！");		
	}
	public function myproject(){
		
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		import("ORG.Util.Page");
		//获取用户id
		$user=M('user')->where(array('unum'=>$unum))->find();
		$count=M('project_user')->where(array('user_id'=>$user['uid']))->order('project_id desc')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		//查询用户参加的项目的id
		$myprojectid=M('project_user')->where(array('user_id'=>$user['uid']))->order('project_id desc')->limit($limit)->select();
		$this->page=$page->show ();
		$myprojects=array();
		for($i=0;$i<count($myprojectid);$i++){
			$project=D('ProjectRelation')->relation(true)->where(array('pid'=>$myprojectid[$i]['project_id']))->find();
			array_push($myprojects,$project);
		}
		$this->myprojects=$myprojects;
		$this->display();
	}
	public function myprojectread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$pid=I('pid');
		$myproject=D('ProjectRelation')->relation(true)->where(array('pid'=>$pid))->find();
		//p($myproject);die;
		$this->myproject=$myproject;
		$this->display();
	}
	
	public function myprojectupdate(){
		//p($_POST);die;
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$pid=I('pid');
		//检测申请书上传
		if($_FILES['applyFile']['error']==4){
					$applyFilePath=$_POST['applyfile'];
				}
		else{
				switch($_FILES['applyFile']['error']){
					case 1:
						$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
					case 2:
						$this->error("上传文件超过了表单文件最大值");break;	
					case 3:
						$this->error("文件被部分上传");break;
					case 6:
						$this->error("没有找到临时文件");break;
					case 7:
					case 8:
						$this->error("系统错误");break;		
				}
				//限制文件上传大小
				if($_FILES['applyFile']['size']>10*1024*1024){
						$this->error("上传文件过大！");
					}	
				//限制文件上传类型
				$allowExt=array('doc','docx');
				$applyext=pathinfo($_FILES['applyFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($applyext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//生成随即文件名
				$applyuniName=md5(uniqid(microtime(true),true)).'.'.$applyext;
				$applyFilePath="/Uploads/project/".$applyuniName;
				$applyFilePathtmp=".".$applyFilePath;
				//将上传的临时文件保存到制定目录
				move_uploaded_file($_FILES['applyFile']['tmp_name'],$applyFilePathtmp);
				//删除之前的文件
				if(!empty($_POST['applyfile'])){
					$tmpfile=".".$_POST['applyfile'];
					unlink($tmpfile);
				}	
			}
			
		//检测中期表上传
		if($_FILES['middleFile']['error']==4){
					$middleFilePath=$_POST['middlefile'];
				}
		else{
				switch($_FILES['middleFile']['error']){
					case 1:
						$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
					case 2:
						$this->error("上传文件超过了表单文件最大值");break;	
					case 3:
						$this->error("文件被部分上传");break;
					case 6:
						$this->error("没有找到临时文件");break;
					case 7:
					case 8:
						$this->error("系统错误");break;		
				}
				//限制文件上传大小
				if($_FILES['middleFile']['size']>10*1024*1024){
						$this->error("上传文件过大！");
					}	
				//限制文件上传类型
				$allowExt=array('doc','docx');
				$middleext=pathinfo($_FILES['middleFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($middleext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//生成随即文件名
				$applyuniName=md5(uniqid(microtime(true),true)).'.'.$middleext;
				$middleFilePath="/Uploads/project/".$applyuniName;
				$middleFilePathtmp=".".$middleFilePath;
				//将上传的临时文件保存到制定目录
				move_uploaded_file($_FILES['middleFile']['tmp_name'],$middleFilePathtmp);
				//删除之前的文件
				if(!empty($_POST['middlefile'])){
					$tmpfile=".".$_POST['middlefile'];
					unlink($tmpfile);
				}	
			}
		//检测结题资料上传
		if($_FILES['lastFile']['error']==4){
					$lastFilePath=$_POST['lastfile'];
				}
		else{
				switch($_FILES['lastFile']['error']){
					case 1:
						$this->error("上传文件超过了PHP配置文件中upload_max_file的值");break;
					case 2:
						$this->error("上传文件超过了表单文件最大值");break;	
					case 3:
						$this->error("文件被部分上传");break;
					case 6:
						$this->error("没有找到临时文件");break;
					case 7:
					case 8:
						$this->error("系统错误");break;		
				}
				//限制文件上传大小
				if($_FILES['lastFile']['size']>30*1024*1024){
						$this->error("上传文件过大！");
					}	
				//限制文件上传类型
				$allowExt=array('rar','zip');
				$lastext=pathinfo($_FILES['lastFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($lastext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//生成随即文件名
				$applyuniName=md5(uniqid(microtime(true),true)).'.'.$lastext;
				$lastFilePath="/Uploads/project/".$applyuniName;
				$lastFilePathtmp=".".$lastFilePath;
				//将上传的临时文件保存到制定目录
				move_uploaded_file($_FILES['lastFile']['tmp_name'],$lastFilePathtmp);
				//删除之前的文件
				if(!empty($_POST['lastfile'])){
					$tmpfile=".".$_POST['lastfile'];
					unlink($tmpfile);
				}	
			}
			//循环添加记录至race_user表中
			$data=array(
				'pid'=>$pid,
				'pname'=>$_POST['title'],
				'pclass'=>$_POST['class'],
				'pnumber'=>$_POST['number'],
				'pfather'=>$_POST['father'],
				'pcontent'=>$_POST['content'],
				'paccessory'=>$applyFilePath,
				'pmiddleaccessory'=>$middleFilePath,
				'plastaccessory'=>$lastFilePath,
			);
			$result=M('project')->save($data);
			if($result)
				$this->success("保存成功！");
			else
				$this->error("保存失败！");	
		
	}
	public function addreport(){
		$data=array(
			'ryear'=>$_POST['year'],
			'rmonth'=>$_POST['month'],
			'rcontent'=>$_POST['reportcontent'],
			'rname'=>$_POST['uname'],
		);
		$result=M('report')->add($data);
		
		$data2=array('project_id'=>$_POST['project_id'],'report_id'=>$result);
		$result2=M('report_project')->add($data2);
		if($result2)
			$this->success("添加成功！");
		else
			$this->error("添加失败！");	
	}
	public function reportread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$rid=I('rid');
		$pid=I('pid');
		$this->pid=$pid;
		$report=M('report')->where(array('rid'=>$rid,))->find();
		//p($report);
		
		$this->report=$report;
		$this->display();
	}	
	public  function reportupdate(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$pid=I('pid');
		$rid=I('rid');
		$data=array(
			'rid'=>$rid,
			'ryear'=>$_POST['year'],
			'rmonth'=>$_POST['month'],
			'rcontent'=>$_POST['content'],
		);
		$result=M('report')->save($data);
		if($result)
			$this->success("保存成功！");
		else
			$this->error("保存失败！");	
	}
	public function reportdelete($pid,$rid){
		if (! empty ( $pid ) && ! empty ( $rid )) {
					M('report')->where(array('rid'=>$rid))->delete();
					M('report_project')->where(array('project_id'=>$pid,'report_id'=>$rid))->delete();
					
				}
		 else {
					$this->error ( '获取信息失败！' );
				}
	}
	//========项目中心结束========
	//========讲座中心开始========
	public function lecture(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		import("ORG.Util.Page");
		$count=M('lecture')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		$lecture=M('lecture')->where(array('lstatus'=>'1','lcheckstatus'=>'1',))->limit($limit)->order('lid desc')->select();
		$this->lecture=$lecture;
		$this->page=$page->show ();
		$this->display();
	}
	public function insertlecture(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$unum=I("unum");
		//判断如果是科创管理员添加的讲座 则不需要更改
		$uid=M("user")->where(array("unum"=>$unum))->getField("uid");
		// p($uid);die;
		$urole=M("role_user")->where(array("user_id"=>$uid))->getField("role_id");
		if($urole!=1){
			$lcheckstatus=1;
		}else{
			$lcheckstatus=0;
		}
		$data=array(
			'ltitle'=>$_POST['title'],
			'lcontent'=>$_POST['content'],
			'llecturer'=>$_POST['lecturer'],
			'ldate'=>$_POST['date'],
			'lplace'=>$_POST['place'],
			'ldirectornum'=>I("unum"),
			'ldirectorname'=>I("uname"),
			'ldirectortel'=>$_POST['directortel'],
			'ldatestart'=>$_POST['datestart'],
			'ldateend'=>$_POST['dateend'],
			'lsheet'=>$_POST['sheet'],
			'lnum'=>$_POST['num'],
			'lcheckstatus'=>$lcheckstatus,
			);
			//p($data);die;
		$db=M('lecture');
		$result=$db->add($data);
		if($result)
			$this->success("发布成功！");
		else 
			$this->error("发布失败！");
	}
	public function lectureread(){
		//p(I("uid"));die;
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$lid=I('lid');
		$lecture=M('lecture')->where(array('lid'=>$lid))->find();
		//判定是否过期
		$sub=(time()-strtotime($lecture['ldateend']))-1*24*60*60;
		if($sub>0){
			$lecture['subtime']=1;
		}
		else 
			$lecture['subtime']=0;
		$this->lecture=$lecture;
		//判定是否已经报名
		$lectureuser=M('lecture_user')->where(array('lecture_id'=>$lid,'user_num'=>$unum))->find();
		if(empty($lectureuser))
			$isapply=0;
		else
			$isapply=1;
		$this->isapply=$isapply;
		$this->display();
	}
	public function lectureapply($lid,$unum){
		if (! empty ( $lid ) && ! empty ( $unum )) {
				$lecture=M('lecture')->where(array('lid'=>$lid,))->find();
				$user=M('user')->where(array('unum'=>$unum))->find();
				$data=array("lecture_id"=>$lid,"lecture_title"=>$lecture['ltitle'],"user_num"=>$unum,"user_name"=>$user['uname']);
					M('lecture_user')->add($data);
				}
		 else {
					$this->error ( '获取信息失败！' );
				}
	}
	public function mydirectlecture(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$lecture=M('lecture')->where(array('ldirectornum'=>I("unum")))->order("lcheckstatus,lid desc")->select();
		$this->lecture=$lecture;
		$this->display();
	}	
	public function mylectureread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$lid=I('lid');
		$lecture=M('lecture')->where(array('lid'=>$lid))->find();
		$this->lecture=$lecture;
		$this->display();
	}
	public function mylectureupdate(){
		$unum=I("unum");
		$uname=I("uname");
		$receive=array(
			'lid'=>$_POST['lid'],
			'ltitle'=>$_POST['title'],
			'lcontent'=>$_POST['content'],
			'llecturer'=>$_POST['lecturer'],
			'ldate'=>$_POST['date'],
			'lplace'=>$_POST['place'],
			'ldirectortel'=>$_POST['directortel'],
			'ldatestart'=>$_POST['datestart'],
			'ldateend'=>$_POST['dateend'],
			'lsheet'=>$_POST['sheet'],
			'lnum'=>$_POST['num'],
			'lstatus'=>$_POST['status'],
			);
		$result=M('lecture')->save($receive);
		if($result)
			$this->success('修改成功！',U('Admin/Stu/mylectureread',array('unum'=>$unum,'uname'=>$uname,'lid'=>$_POST['lid'])));
		else
			$this->error('修改失败！',U('Admin/Stu/mylectureread',array('unum'=>$unum,'uname'=>$uname,'lid'=>$_POST['lid']))); 	
	}
	public function mylecturedelete($lid){
	if (! empty ( $lid )) {
					M('lecture')->where(array('lid'=>$lid))->delete();
					
				}
		 else {
					$this->error ( '获取信息失败！' );
				}
	}
	public function mylectureapply(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$lid=I('lid');
		$lecture=M('lecture_user')->where(array('lecture_id'=>$lid))->order('lpresent desc')->select();
		$this->lecture=$lecture;
		//p($lecture);die;
		$this->display();
	}
	public function mylecturelistset(){
		if(empty($_POST['subBox'])){
			$this->error("至少选择一条记录!");
		}
		$condition['user_num']=array('in',$_POST['subBox']);
		
		if($_POST['option1']=="选中标记"){
			//写入积分表
			for($i=0;$i<count($_POST['subBox']);$i++){
				$record=M('lecture_user')->where(array('lecture_id'=>$_POST['lecture_id'],'user_num'=>$_POST['subBox'][$i],'lpresent'=>0))->find();
				if(!empty($record)){
					$user=M('user')->where(array('unum'=>$record['user_num']))->field(array('uid,upoint'))->find();
					$user['upoint']+=1;
					M('user')->save($user);
				}
			
			}
			$condition['lecture_id']=$_POST['lecture_id'];
			$result=M('lecture_user')->where($condition)->setField('lpresent', '1');
			if($result)
				$this->success("保存成功！");
			else
				$this->error("部分数据保存失败！"); 
		}
		if($_POST['option2']=="取消标记"){
			//写入积分表
			for($i=0;$i<count($_POST['subBox']);$i++){
				$record=M('lecture_user')->where(array('lecture_id'=>$_POST['lecture_id'],'user_num'=>$_POST['subBox'][$i],'lpresent'=>1))->find();
				if(!empty($record)){
					$user=M('user')->where(array('unum'=>$record['user_num']))->field(array('uid,upoint'))->find();
					$user['upoint']-=1;
					M('user')->save($user);
				}
			
			}
			$condition['lecture_id']=$_POST['lecture_id'];
			$result=M('lecture_user')->where($condition)->setField('lpresent', '0');
			if($result)
				$this->success("保存成功！");
			else
				$this->error("部分数据保存失败！"); 
		}
		if($_POST['option3']=="选中导出"){
			$condition['lecture_id']=$_POST['lecture_id'];
			$user=M('lecture_user')->where($condition)->order('user_num')->select();
			
			vendor("PHPExcel.PHPExcel");
			$objPHPExcel = new \PHPExcel();
			$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
			//设置表格样式
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
			
			
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1',"学号");
			$objPHPExcel->getActiveSheet()->setCellValue('B1',"姓名");
			$objPHPExcel->getActiveSheet()->setCellValue('C1',"签到");
			
			
			
			
			//接下来就是写数据到表格里面去
			for($k=0;$k<count($user);$k++) {
				
					$objPHPExcel->getActiveSheet()->setCellValue('A'.($k+2),  $user[$k]['user_num']);//这里是设置A1单元格的内容
	                $objPHPExcel->getActiveSheet()->setCellValue('B'.($k+2),  $user[$k]['user_name']);
	                            
				  	          
				}
			  header("Pragma: public");
	          header("Expires: 0");
	          header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	          header("Content-Type:application/force-download");
	          header("Content-Type:application/vnd.ms-execl");
	          header("Content-Type:application/octet-stream");
	          header("Content-Type:application/download");;
	          header('Content-Disposition:attachment;filename=文件名称.xls');
	          header("Content-Transfer-Encoding:binary");
	          $objWriter->save('文件名称.xls');
	          $objWriter->save('php://output');
		}
	}
	public function mylecture(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$mylecture=M('lecture_user')->where(array('user_num'=>$unum))->order('lecture_id desc')->select();
		$this->mylecture=$mylecture;
		$this->display();
	}
	
	//========讲座中心结束========
	//=========用户名查询开始=======
	public function getstunum(){
		$num=I("unum");
		$user=M('user')->where(array('unum'=>$num))->find();
		$name=$user['uname'];
		echo json_encode($name);
	}
	//=========用户名查询结束=======
	//======个人信息设置开始=========
		public function updateselfmsg(){
			$unum=I("unum");
			$uname=I("uname");
			$this->unum=$unum;
			$this->uname=$uname;
			$this->msg=I('msg');
			$uid=I('uid');
			$user=D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
			$this->user=$user;
			$role=M('role')->select();
			$this->role=$role;
			$this->display();
			
		}
		public function updateselfmsghandle(){
			//p($_POST);die;
			$role=M('role')->where(array('id'=>$_POST['role']))->find();
			if($role['name']=="学生")
				$profession="学生";
			else 
				$profession=I("profession");	
			$unum=I("unum");
			$uname=I("uname");
			$this->unum=$unum;
			$this->uname=$uname;
			$receive=array(
				'uid'=>$_POST['uid'],
				'master'=>$_POST['master'],
				'ugrade'=>$_POST['grade'],
				'utel'=>$_POST['tel'],
				'umail'=>$_POST['mail'],
				'uprofession'=>$profession,
				'uckeck'=>1,
				
			);
			$result=M('user')->save($receive);
			if($result)
				$this->success("保存成功！");
			else 
				$this->error("保存失败！");	
			
		}
		public function updatepwd(){
			//p($_GET);die;
			$unum=I("unum");
			$uname=I("uname");
			$this->unum=$unum;
			$this->uname=$uname;
			$this->msg=I('msg');
			$uid=I('uid');
			$user=M('user')->where(array('uid'=>$uid))->find();
			$this->us=$user;
			$this->display();
		}
		public function updatepwdhandle(){
			
			if($_POST['upasswordnew']==$_POST['upasswordrenew']){
					$oldpwd=I('upasswordold','','md5');
					$user=M('user')->find($_POST['uid']);
					if($oldpwd==$user['upassword']){
						$save['uid']=$user['uid'];
						$save['upassword']=md5($_POST['upasswordnew']);
						$result=M('user')->save($save);
						if($result)$this->success("保存成功！");
						else 
						$this->error("修改失败！");
					}else 
						$this->error("原始密码错误!");
				}else 
						$this->error("两次输入的密码不一致!");
			
		}
	//======个人信息设置结束=========
}  