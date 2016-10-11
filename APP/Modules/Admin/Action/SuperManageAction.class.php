<?php
class SuperManageAction extends CommonAction{
	//=============信息中心开始============
	public function news(){
		
	//	$this->uid=I("uid");
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->msg=I('msg');
		import("ORG.Util.Page");
		$count=M('news')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		$news=M('news')->limit($limit)->order('ntop desc,ndate desc,nid desc')->select();
		$this->news=$news;
		$this->page=$page->show ();
		$this->display();
	}
	//添加新闻
	public function addNews(){
		$this->display();
	}
	//添加竞赛
	public function addRace(){
		$this->display();
	}
	//添加讲座
	public function addLecture(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->display();
	}
	//添加讲座
	public function addProject(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->display();
	}
	public function newsinsert(){
		//echo date('Y-m-d');
			
		if($_FILES['newsFile']['error']){
			if($_FILES['newsFile']['error']==4){
				$newsFilePath="";
			}else{
				switch($_FILES['newsFile']['error']){
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
			if($_FILES['newsFile']['size']>10*1024*1024){
				$this->error("上传文件过大！");
			}
			//限制文件上传类型
			$allowExt=array('rar','zip');
			$ext=pathinfo($_FILES['newsFile']['name'],PATHINFO_EXTENSION);
			if(!in_array($ext,$allowExt)){
				$this->error("上传文件格式不正确！");
			}
			//生成随即文件名
			$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
			$newsFilePath="/Uploads/news/".$uniName;
			$newsFilePathtmp=".".$newsFilePath;
			//将上传的临时文件保存到制定目录
			move_uploaded_file($_FILES['newsFile']['tmp_name'],$newsFilePathtmp);
			
		}
		
		$data=array(
			'ntitle'=>$_POST['title'],
			'ncontent'=>$_POST['content'],
			'npublishnum'=>$_POST['unum'],
			'npublishname'=>$_POST['uname'],
			'ndate'=>date('Y-m-d'),
			'nstatus'=>1,
			'naccessory'=>$newsFilePath,
		);
		
		$result=M('news')->add($data);
		if($result)
			$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布成功！"));
		else 
			$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布失败！"));	
	}
	public function newsread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$nid=I('nid');
		$this->msg=I('msg');
		$news=M('news')->where(array('nid'=>$nid))->find();
		$this->news=$news;
		$this->display();
	}
	public function newsupdate(){
		//处理文件上传
		if($_FILES['newsFile']['error']){
			if($_FILES['newsFile']['error']==4){
				$newsFilePath=$_POST['newsfile'];
			}else{
				switch($_FILES['newsFile']['error']){
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
			if($_FILES['newsFile']['size']>10*1024*1024){
				$this->error("上传文件过大！");
			}
			//限制文件上传类型
			$allowExt=array('doc','pdf','zip');
			$ext=pathinfo($_FILES['newsFile']['name'],PATHINFO_EXTENSION);
			if(!in_array($ext,$allowExt)){
				$this->error("上传文件格式不正确！");
			}
			//生成随即文件名
			$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
			$newsFilePath="/Uploads/news/".$uniName;
			$newsFilePathtmp=".".$newsFilePath;
			//将上传的临时文件保存到制定目录
			move_uploaded_file($_FILES['newsFile']['tmp_name'],$newsFilePathtmp);
			//删除之前的文件
			if(!empty($_POST['newsfile'])){
				$tmpfile=".".$_POST['newsfile'];
				unlink($tmpfile);
			}
			
		}
		
		$receive=array(
			'nid'=>$_POST['nid'],
			'ntitle'=>$_POST['title'],
			'ncontent'=>$_POST['content'],
			'nstatus'=>$_POST['status'],
			'ntop'=>$_POST['top'],
			'naccessory'=>$newsFilePath,
		);
		$result=M('news')->save($receive);
		if($result)
			$this->redirect('newsread',array('unum'=>$unum,'uname'=>$uname,'nid'=>$_POST['nid'],'msg'=>"修改成功！"));
		else
			$this->redirect('newsread',array('unum'=>$unum,'uname'=>$uname,'nid'=>$_POST['nid'],'msg'=>"修改失败！"));		
	}
	public function newsdelete($nid){
		if (! empty ( $nid )) {
					$news = M ( "news" );
					$onenews=$news->find($nid);
					//删除服务器上的文件
					if(!empty($onenews['naccessory'])){
						$tmpfile=".".$onenews['naccessory'];
						unlink($tmpfile);
					}
					$result = $news->delete ( $nid );
					
				}
		 else {
					$this->error ( '获取信息失败！' );
				}
	}
	public function downnewsfile(){
		
		header("Content-type:text/html;charset=utf-8"); 
		$filename=$_GET['filename'];
		
		header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
		header('Content-Length:'.filesize($filename)); //指定下载文件的大小
		//将文件内容读取出来并直接输出，以便下载
		readfile($filename);
	}
	public function newslistset(){
		//p($_POST);
		if(empty($_POST['subBox'])){
			$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"至少选择一条记录!"));
		}
		$condition['nid']=array('in',$_POST['subBox']);
		
		if($_POST['option1']=="选中置顶"){
			
			$result=M('news')->where($condition)->setField('ntop', '1');
			if($result)
				$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功！"));
			else
				$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"部分数据保存失败！"));
		}
		if($_POST['option2']=="取消置顶"){
			
			$result=M('news')->where($condition)->setField('ntop', '0');
			if($result)
				$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功！"));
			else
				$this->redirect('news',array('unum'=>$unum,'uname'=>$uname,'msg'=>"部分数据保存失败！"));
		}
	}
	//=============信息中心结束============	
	//=============竞赛中心开始============
	public function race(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->msg=I('msg');
		import("ORG.Util.Page");
		$count=M('race')->count();
		$page=new Page($count,12);
		$limit = $page->firstRow . ',' . $page->listRows;
		$race=M('race')->limit($limit)->order('rdatestart desc,rid desc')->select();
		$this->race=$race;
		$this->page=$page->show ();
		$this->display();
	}
	public function raceinsert(){
			
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
		
		$data=array(
			'rname'=>$_POST['name'],
			'rdatestart'=>$_POST['datestart'],
			'rdateend'=>$_POST['dateend'],
			'rcontent'=>$_POST['content'],
			'rsponsor'=>$_POST['sponsor'],
			'rlevel'=>$_POST['level'],
			'rstatus'=>1,
			'raccessory'=>$raceFilePath,
		);
		
		$result=M('race')->add($data);
		if($result)
			$this->redirect('race',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布成功！"));
		else 
			$this->redirect('race',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布失败！"));	
	}
	public  function raceread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->msg=I('msg');
		$this->unum=$unum;
		$this->uname=$uname;
		$rid=I('rid');
		$race=M('race')->where(array('rid'=>$rid))->find();
		$this->race=$race;
		$this->display();
	}
	public function raceupdate(){
		//处理文件上传
		if($_FILES['raceFile']['error']){
			if($_FILES['raceFile']['error']==4){
				$raceFilePath=$_POST['racefile'];
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
			
		}
		
		$receive=array(
			'rid'=>$_POST['rid'],
			'rname'=>$_POST['name'],
			'rdatestart'=>$_POST['datestart'],
			'rdateend'=>$_POST['dateend'],
			'rcontent'=>$_POST['content'],
			'rsponsor'=>$_POST['sponsor'],
			'rlevel'=>$_POST['level'],
			'rstatus'=>$_POST['status'],
			'raccessory'=>$raceFilePath,
		);
		$result=M('race')->save($receive);
		if($result)
			$this->redirect('raceread',array('unum'=>$unum,'uname'=>$uname,'rid'=>$_POST['rid'],'msg'=>"修改成功！"));
		else
			$this->redirect('raceread',array('unum'=>$unum,'uname'=>$uname,'rid'=>$_POST['rid'],'msg'=>"修改失败！"));	
	}
	public function racedelete($rid){
			if (! empty ( $rid )) {
						$race = M ( "race" );
						$onerace=$race->find($rid);
						//删除服务器上的文件
						if(!empty($onerace['raccessory'])){
							$tmpfile=".".$onerace['raccessory'];
							unlink($tmpfile);
						}
						$result = $race->delete ( $rid );
						//删除race_user表中的数据
						$raceuser=M('race_user')->where(array('race_id'=>$rid))->select();
						for($j=0;$j<count($raceuser);$j++){
								if(!$j){
									if(!empty($raceuser[$j]['accessory'])){
										$tmpfile=".".$raceuser[$j]['accessory'];
										unlink($tmpfile);
									}
									if(!empty($raceuser[$j]['image'])){
										$tmpfile=".".$raceuser[$j]['image'];
										unlink($tmpfile);
									}	
										
								}
							M('race_user')->delete($raceuser[$j]['mid']);
						}
						
						
					}
			 else {
						$this->error ( '获取信息失败！' );
					}
		}
		public function downracefile(){
			//p($_GET);die;
			$race=M('race_user')->where(array('mid'=>$_GET['mid']))->find();
			$tmp=M('user')->where(array('unum'=>$race['captainnum']))->field(array('uname'))->find();
			$ext=$race['accessory'];
			$ext=explode(".",$ext);
			$filename=$race['captainnum']."_".$tmp['uname']."_".$race['race_name'].".".$ext[1];
			$filename=urlencode($filename);
			//p($filename);die;
			$file=".".$race['accessory'];
			
			header("Content-type:text/html;charset=utf-8"); 
			header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
			header('Content-Length:'.filesize($file)); //指定下载文件的大小
			//将文件内容读取出来并直接输出，以便下载
			readfile($file);
		}
	public function racegroup(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$rid=I('rid');
		$captainnum=I('captainnum');
		$msg=I('msg');
		$db=M('race_user');
		//分组转换
		$racegroup=array();
		$captains=$db->query("select distinct captainnum from sp_race_user where race_id = $rid");
		//匹配队长的姓名
		for($m=0;$m<count($captains);$m++){
			$tmp=M('user')->where(array('unum'=>$captains[$m]['captainnum']))->field(array('uname'))->find();
			$captains[$m]['captainname']=$tmp['uname'];	
		}
		//p($captains);die;
		$raceuser=M('race_user')->where(array('race_id'=>$rid))->select();
		for($i=0;$i<count($captains);$i++){
			$k=0;
			for($j=0;$j<count($raceuser);$j++){
				if($raceuser[$j]['captainnum']==$captains[$i]['captainnum']){
					$racegroup[$i][$k]=$raceuser[$j];
					$racegroup[$i][$k]['captainname']=$captains[$i]['captainname'];
					//获取文件后缀名
					$tmp=explode(".",$racegroup[$i][$k]['accessory']);
					$racegroup[$i][$k]['fileext']=$tmp[1];
					$k++;
				}
			}
			if($captains[$i]['captainnum']==$captainnum){
				$racegroup[$i][0]['msg']=$msg;
			}
		}
		//p($racegroup);
		$this->racegroup=$racegroup;
		$this->display();
	}
	public function racegroupupdate(){
		//p($_POST);die;
		$oldrecord=M('race_user')->where(array('race_id'=>$_POST['race_id'],'captainnum'=>$_POST['captainnum']))->select();
		//p($oldrecord);die;
		//写入积分表
		if($_POST['status']==1){
			if($oldrecord[0]['status']!=1){
				switch($_POST['bonus']){
					case "一等奖":
						$plus=4;break;
					case "二等奖":
						$plus=3;break;
					case "三等奖":
						$plus=2;break;	
					case "参与奖":
						$plus=1;break;
				}
				for($k=0;$k<count($oldrecord);$k++){
					$tmp=M('user')->where(array('unum'=>$oldrecord[$k]['unum']))->field(array('uid','upoint'))->find();
					$tmp['upoint']+=$plus;
					M('user')->save($tmp);
				}
			}
		}
		//写入其他信息
		$b=0;
		//p($oldrecord);die;
		for($j=0;$j<count($oldrecord);$j++){
			
			$data=array(
				'mid'=>$oldrecord[$j]['mid'],
				'bonus'=>$_POST['bonus'],
				'status'=>$_POST['status'],
			);
			//p($data);die;
			$db=M('race_user');
			$result=$db->save($data);
			p($db->getDbError());
			if(!$result)$b++;
		}
		if($b)
			$this->redirect('racegroup',array('unum'=>$unum,'uname'=>$uname,'rid'=>$_POST['race_id'],'captainnum'=>$_POST['captainnum'],'msg'=>"修改失败！"));
		else
			$this->redirect('racegroup',array('unum'=>$unum,'uname'=>$uname,'rid'=>$_POST['race_id'],'captainnum'=>$_POST['captainnum'],'msg'=>"修改成功！"));
	}	
	public function outputrace(){
		
		if(empty($_POST['subBox'])){
			$this->redirect('race',array('unum'=>$unum,'uname'=>$uname,'msg'=>"至少选择一条记录!"));
		}
		$condition['race_id']=array('in',$_POST['subBox']);
		
		if($_POST['option1']=='导出选中选项'){
			$race=M('race_user')->where($condition)->field(array('race_name','race_level','uname','unum','captainnum','bonus'))->order('race_name,captainnum')->select();
			//p($race);
			$newrace=array();
			$newrace[0]=$race[0];
			$newrace[0]['captainnum']=1;
			$k=1;
			for($i=1;$i<count($race);$i++){
				if($race[$i]['race_name']==$race[$i-1]['race_name']){
					
					if($race[$i]['captainnum']==$race[$i-1]['captainnum']){
						$newrace[$i]=$race[$i];
						$newrace[$i]['captainnum']=$k;
					}else{
						$k++;
						$newrace[$i]=$race[$i];
						$newrace[$i]['captainnum']=$k;
					}
				}else{
					$k=1;
					$newrace[$i]=$race[$i];
					$newrace[$i]['captainnum']=$k;
				}
			}
		//	p($newrace);die;
			vendor("PHPExcel.PHPExcel");
			$objPHPExcel = new \PHPExcel();
			$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
			//设置表格样式
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
			
			
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1',"竞赛名");
			$objPHPExcel->getActiveSheet()->setCellValue('B1',"竞赛级别");
			$objPHPExcel->getActiveSheet()->setCellValue('C1',"组别");
			$objPHPExcel->getActiveSheet()->setCellValue('D1',"姓名");
			$objPHPExcel->getActiveSheet()->setCellValue('E1',"学号");
			$objPHPExcel->getActiveSheet()->setCellValue('F1',"获奖");
			
			
			
			//接下来就是写数据到表格里面去
			for($k=0;$k<count($race);$k++) {
				
					$objPHPExcel->getActiveSheet()->setCellValue('A'.($k+2),  $newrace[$k]['race_name']);//这里是设置A1单元格的内容
	                $objPHPExcel->getActiveSheet()->setCellValue('B'.($k+2),  $newrace[$k]['race_level']);
	                $objPHPExcel->getActiveSheet()->setCellValue('C'.($k+2),  $newrace[$k]['captainnum']);             
				  	$objPHPExcel->getActiveSheet()->setCellValue('D'.($k+2),  $newrace[$k]['uname']);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.($k+2),  $newrace[$k]['unum']);
		          	$objPHPExcel->getActiveSheet()->setCellValue('F'.($k+2),  $newrace[$k]['bonus']);             
				  	          
				}
			  $excfilename=urlencode("竞赛.xls");
	          
			  header("Pragma: public");
	          header("Expires: 0");
	          header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	          header("Content-type:text/html;charset=utf-8"); 
	          header("Content-Type:application/force-download");
	          header("Content-Type:application/vnd.ms-execl");
	          header("Content-Type:application/octet-stream");
	          header("Content-Type:application/download");;
	          header('Content-Disposition:attachment;filename="'.$excfilename.'"');
	          header("Content-Transfer-Encoding:binary");
	          $objWriter->save($excfilename);
	          $objWriter->save('php://output');
		}
		
	}
	//=============竞赛中心结束============
	//=============项目中心开始============
	public function projectnews(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$this->msg=I('msg');
		$projectnews=M('projectnews')->order('ptop desc,pdateend desc')->select();
		$this->projectnews=$projectnews;
		$this->display();
	}
	public function projectnewsinsert(){
		//p($_POST);die;
		if($_FILES['raceFile']['error']){
			if($_FILES['raceFile']['error']==4){
				$raceFilePath="/Uploads/modules/application book.doc";
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
		
		$data=array(
			'ptitle'=>$_POST['title'],
			'pdatestart'=>$_POST['datestart'],
			'pdateend'=>$_POST['dateend'],
			'pcontent'=>$_POST['content'],
			'plevel'=>$_POST['level'],
			'pclass'=>$_POST['class'],
			'paccessory'=>$raceFilePath,
		);
		
		$result=M('projectnews')->add($data);
		if($result)
			$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布成功！"));
		else 
			$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布失败！"));
	}
	public function projectnewsread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$pid=I('pid');
		$this->msg=I('msg');
		$projectnews=M('projectnews')->where(array('pid'=>$pid))->find();
		$this->projectnews=$projectnews;
		$this->display();
	}
	public function projectnewsupdate(){
		//p($_POST);die;
		//处理文件上传
		if($_FILES['raceFile']['error']){
			if($_FILES['raceFile']['error']==4){
				$raceFilePath=$_POST['racefile'];
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
		
		$receive=array(
			'pid'=>$_POST['pid'],
			'ptitle'=>$_POST['title'],
			'pdatestart'=>$_POST['datestart'],
			'pdateend'=>$_POST['dateend'],
			'pcontent'=>$_POST['content'],
			'pstatus'=>$_POST['status'],
			'ptop'=>$_POST['top'],
			'plevel'=>$_POST['level'],
			'pclass'=>$_POST['class'],
			'paccessory'=>$raceFilePath,
		);
		$result=M('projectnews')->save($receive);
		if($result)
			$this->redirect('projectnewsread',array('unum'=>$unum,'uname'=>$uname,'pid'=>$_POST['pid'],'msg'=>"修改成功！"));
		else
			$this->redirect('projectnewsread',array('unum'=>$unum,'uname'=>$uname,'pid'=>$_POST['pid'],'msg'=>"修改失败！"));	
	}
	public function projectnewslistset(){
		//p($_POST);
		if(empty($_POST['subBox'])){
			$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"至少选择一条记录!"));
		}
		$condition['pid']=array('in',$_POST['subBox']);
		
		if($_POST['option1']=="选中置顶"){
			
			$result=M('projectnews')->where($condition)->setField('ptop', '1');
			if($result)
				$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"成功！"));
			else
				$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"失败！"));
		}
		if($_POST['option2']=="取消置顶"){
			
			$result=M('projectnews')->where($condition)->setField('ptop', '0');
			if($result)
				$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"成功！"));
			else
				$this->redirect('projectnews',array('unum'=>$unum,'uname'=>$uname,'msg'=>"失败！"));
		}
	}
	public function project(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->msg=I('msg');
		import("ORG.Util.Page");
		$count=D('ProjectRelation')->relation(true)->count();
		$page=new Page($count,30);
		$limit = $page->firstRow . ',' . $page->listRows;
		$project=D('ProjectRelation')->relation('user')->limit($limit)->order('pid desc,pstatus,pleaderstatus,pid desc')->select();
		$this->project=$project;
		$this->page=$page->show ();
	//	p(I('searchyear'));die;
		//分配当年年份
		$searchyear=I('searchyear');
		if(empty($searchyear))
			$this->searchyear=0;
		else 
			$this->searchyear=$searchyear;	
		//分配级别
		$searchlevel=I('searchlevel');
		if(empty($searchlevel))
			$this->searchlevel="0";
		else 
			$this->searchlevel=$searchlevel;
			
		//分配来源
		$fids=M("projectnews")->field(array('pid','ptitle'))->order('pid desc')->select();
		$this->searchfids=$fids;
		$searchfid=I('searchfid');
		if(empty($searchfid))
			$this->searchfid=0;
		else 
			$this->searchfid=$searchfid;
		$this->display();
	}
	
	public function outputproject(){
		//p($_POST);die;
		//数据整理
		if(empty($_POST['subBox'])){
			$this->redirect('project',array('unum'=>$unum,'uname'=>$uname,'msg'=>"至少选择一条记录!"));
		}
		$condition['pid']=array('in',$_POST['subBox']);header("Content-type:text/html;charset=utf-8"); 
		
		if($_POST['option2']=='选中中期答辩'){
			$condition['pleaderstatus']='1';
			$result=M('project')->where($condition)->setField('pmiddlestatus', '1');
			if($result)
				$this->redirect('project',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功!"));
			else
				$this->redirect('project',array('unum'=>$unum,'uname'=>$uname,'msg'=>"部分数据保存失败！")); 	
		}
		
		
		if($_POST['option3']=='选中结题答辩'){
			$condition['pmiddlestatus']='1';
			$result=M('project')->where($condition)->setField('plaststatus', '1');
			if($result)
				$this->redirect('project',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功!"));
			else
				$this->redirect('project',array('unum'=>$unum,'uname'=>$uname,'msg'=>"部分数据保存失败！")); 	
		}
		
		
		if($_POST['option1']=='导出选中选项'){
			$project=D('ProjectRelation')->relation('user')->where($condition)->order('pannual,pid desc')->select();
			//p($project);die;
			$projects=array();
			//p($project);
			for($i=0;$i<count($project);$i++){
				
				$projects[$i]['pid']=$project[$i]['pid'];
				$projects[$i]['pname']=$project[$i]['pname'];
				$projects[$i]['pclass']=$project[$i]['pclass'];
				$projects[$i]['pcaptainname']=$project[$i]['pcaptainname'];
				$projects[$i]['pcaptainnum']=$project[$i]['pcaptainnum'];
				$projects[$i]['pnumber']=$project[$i]['pnumber'];
				$projects[$i]['stu']="";
				for($j=0;$j<count($project[$i]['user']);$j++){
					
					if($project[$i]['user'][$j]['uprofession']=='学生'){
						if($project[$i]['user'][$j]['unum']==$project[$i]['pcaptainnum']){
							
						}else{
							$projects[$i]['stu']=$projects[$i]['stu'].$project[$i]['user'][$j]['uname']."(".$project[$i]['user'][$j]['unum'].")";
						}
						
					}else{
						$projects[$i]['pteachername']=$project[$i]['user'][$j]['uname'];
						$projects[$i]['pteacherprofession']=$project[$i]['user'][$j]['uprofession'];
					}
				}
				$projects[$i]['pfather']=$project[$i]['pfather'];
				$projects[$i]['pcontent']=$project[$i]['pcontent'];
				$projects[$i]['plevel']=$project[$i]['plevel'];
				$projects[$i]['pannual']=$project[$i]['pannual'];
				$projects[$i]['pmiddlerank']=$project[$i]['pmiddlerank'];
				$projects[$i]['pmiddlescore']=$project[$i]['pmiddlescore'];
				$projects[$i]['plastrank']=$project[$i]['plastrank'];
				$projects[$i]['plastscore']=$project[$i]['plastscore'];
			}
			//p($projects);die;
			vendor("PHPExcel.PHPExcel");
			$objPHPExcel = new \PHPExcel();
			$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
			//设置表格样式
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
			
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1',"项目序号");
			$objPHPExcel->getActiveSheet()->setCellValue('B1',"项目名称");
			$objPHPExcel->getActiveSheet()->setCellValue('C1',"项目类型");
			$objPHPExcel->getActiveSheet()->setCellValue('D1',"负责人姓名");
			$objPHPExcel->getActiveSheet()->setCellValue('E1',"负责人学号");
			$objPHPExcel->getActiveSheet()->setCellValue('F1',"参与学生人数");
			$objPHPExcel->getActiveSheet()->setCellValue('G1',"项目其他成员信息（姓名，学号）");
			$objPHPExcel->getActiveSheet()->setCellValue('H1',"指导教师姓名");
			$objPHPExcel->getActiveSheet()->setCellValue('I1',"指导教师职称");
			$objPHPExcel->getActiveSheet()->setCellValue('J1',"项目所属一级学科");
			$objPHPExcel->getActiveSheet()->setCellValue('K1',"项目简介（100字以内）");
			$objPHPExcel->getActiveSheet()->setCellValue('L1',"项目级别");
			$objPHPExcel->getActiveSheet()->setCellValue('M1',"项目年度");
			$objPHPExcel->getActiveSheet()->setCellValue('N1',"中期答辩排名");
			$objPHPExcel->getActiveSheet()->setCellValue('O1',"中期答辩分数");
			$objPHPExcel->getActiveSheet()->setCellValue('P1',"结题答辩排名");
			$objPHPExcel->getActiveSheet()->setCellValue('Q1',"结题答辩分数");
			//接下来就是写数据到表格里面去
			for($k=0;$k<count($projects);$k++) {
				
					$objPHPExcel->getActiveSheet()->setCellValue('A'.($k+2),  $projects[$k]['pid']);//这里是设置A1单元格的内容
	                $objPHPExcel->getActiveSheet()->setCellValue('B'.($k+2),  $projects[$k]['pname']);
	                $objPHPExcel->getActiveSheet()->setCellValue('C'.($k+2),  $projects[$k]['pclass']);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.($k+2),  $projects[$k]['pcaptainname']);
		          	$objPHPExcel->getActiveSheet()->setCellValue('E'.($k+2),  $projects[$k]['pcaptainnum']);             
				  	$objPHPExcel->getActiveSheet()->setCellValue('F'.($k+2),  $projects[$k]['pnumber']);             
				  	$objPHPExcel->getActiveSheet()->setCellValue('G'.($k+2),  $projects[$k]['stu']);             
				  	$objPHPExcel->getActiveSheet()->setCellValue('H'.($k+2),  $projects[$k]['pteachername']);             
				  	$objPHPExcel->getActiveSheet()->setCellValue('I'.($k+2),  $projects[$k]['pteacherprofession']);             
				  	$objPHPExcel->getActiveSheet()->setCellValue('J'.($k+2),  $projects[$k]['pfather']);
				  	$objPHPExcel->getActiveSheet()->setCellValue('K'.($k+2),  $projects[$k]['pcontent']); 
				  	$objPHPExcel->getActiveSheet()->setCellValue('L'.($k+2),  $projects[$k]['plevel']); 
				  	$objPHPExcel->getActiveSheet()->setCellValue('M'.($k+2),  $projects[$k]['pannual']); 
				  	$objPHPExcel->getActiveSheet()->setCellValue('N'.($k+2),  $projects[$k]['pmiddlerank']); 
				  	$objPHPExcel->getActiveSheet()->setCellValue('O'.($k+2),  $projects[$k]['pmiddlescore']); 
				  	$objPHPExcel->getActiveSheet()->setCellValue('P'.($k+2),  $projects[$k]['plastrank']);  
				  	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($k+2),  $projects[$k]['plastscore']);          
				}
			  $excfilename=urlencode("项目.xls");
			  header("Pragma: public");
	          header("Expires: 0");
	          header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	          header("Content-Type:application/force-download");
	          header("Content-Type:application/vnd.ms-execl");
	          header("Content-Type:application/octet-stream");
	          header("Content-Type:application/download");;
	          header('Content-Disposition:attachment;filename="'.$excfilename.'"');
	          header("Content-Transfer-Encoding:binary");
	          $objWriter->save('文件名称.xls');
	          $objWriter->save('php://output');
		}
		
	}
	public function projectread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$this->msg=I('msg');
		$pid=I('pid');
		$project=D('ProjectRelation')->relation(true)->where(array('pid'=>$pid))->find();
		//获取年度信息
		$year=date("Y");
		if(!$project['pannual']){
			$project['pannual']=$year;
		}
		//设置月报日期
		if($project['pcheckdate']=="0000-00-00"){
			$project['pcheckdate']=date("Y-m-d");
		}
		//p($project);die;
		$this->project=$project;
		//p($project);die;
		$this->display();
	}
	public function projectupdate(){
		//p($_POST);die;
		//积分表---报名加1分
		if($_POST['status']){
			$record=M('project')->where(array('pid'=>$_POST['pid'],'pstatus'=>0))->find();
			
			if(!empty($record)){
				$user=M('project_user')->where(array('project_id'=>$record['pid']))->select();
				//p($user);die;
				for($k=0;$k<count($user);$k++){
					$tmp=M('user')->where(array('uid'=>$user[$k]['user_id']))->field(array('uid','upoint'))->find();
					$tmp['upoint']+=1;
					M('user')->save($tmp);
				}
			}
		}
		//积分表---学校审核
		if($_POST['leaderstatus']==1){
			$record=M('project')->where(array('pid'=>$_POST['pid']))->find();
			if($record['pleaderstatus']!=1){
				$user=M('project_user')->where(array('project_id'=>$record['pid']))->select();
				switch($_POST['level']){
					case "国家级":
						$plus=3;break;
					case "上海市级":
						$plus=2;break;
					case "校级":
						$plus=1;break;
					case "院级":
						$plus=1;break;			
						
				}
				for($k=0;$k<count($user);$k++){
					$tmp=M('user')->where(array('uid'=>$user[$k]['user_id']))->field(array('uid','upoint'))->find();
					$tmp['upoint']+=$plus;
					//p($tmp);die;
					M('user')->save($tmp);
				}
			}
		}
		//积分表---中期结束
		if($_POST['middleend']){
			$record=M('project')->where(array('pid'=>$_POST['pid'],'pmiddleend'=>0))->find();
			if(!empty($record)){
				$user=M('project_user')->where(array('project_id'=>$record['pid']))->select();
				//p($user);die;
				for($k=0;$k<count($user);$k++){
					$tmp=M('user')->where(array('uid'=>$user[$k]['user_id']))->field(array('uid','upoint'))->find();
					$tmp['upoint']+=1;
					M('user')->save($tmp);
				}
			}
		}
		//积分表---结题结束
		if($_POST['lastend']){
			$record=M('project')->where(array('pid'=>$_POST['pid'],'plastend'=>0))->find();
			if(!empty($record)){
				$user=M('project_user')->where(array('project_id'=>$record['pid']))->select();
				//p($user);die;
				for($k=0;$k<count($user);$k++){
					$tmp=M('user')->where(array('uid'=>$user[$k]['user_id']))->field(array('uid','upoint'))->find();
					$tmp['upoint']+=2;
					M('user')->save($tmp);
				}
			}
		}
		$data=array(
			'pid'=>$_POST['pid'],
			'pname'=>$_POST['title'],
			'pstatus'=>$_POST['status'],
			'pleaderstatus'=>$_POST['leaderstatus'],
			'pcheckdate'=>$_POST['checkdate'],
			'plevel'=>$_POST['level'],
			'pannual'=>$_POST['annual'],
			'pclass'=>$_POST['class'],
			'pnumber'=>$_POST['number'],
			'pfather'=>$_POST['father'],
			'pcontent'=>$_POST['content'],
			'pmiddlestatus'=>$_POST['middlestatus'],
			'pmiddlerank'=>$_POST['middlerank'],
			'pmiddlescore'=>$_POST['middlescore'],
			'plaststatus'=>$_POST['laststatus'],
			'plastrank'=>$_POST['lastrank'],
			'plastscore'=>$_POST['lastscore'],
			'pendstatus'=>$_POST['endstatus'],
			'pmiddlecheck'=>$_POST['middlecheck'],
			'plastcheck'=>$_POST['lastcheck'],
			'pmiddleend'=>$_POST['middleend'],
			'plastend'=>$_POST['lastend'],		
		);
		$result=M('project')->save($data);
		if($result)
			$this->redirect('projectread',array('unum'=>$unum,'uname'=>$uname,'pid'=>$_POST['pid'],'msg'=>"修改成功！"));
		else 
			$this->redirect('projectread',array('unum'=>$unum,'uname'=>$uname,'pid'=>$_POST['pid'],'msg'=>"修改失败！"));	
	}
	//项目下载
	public function downprojectfile(){
		//p($_GET);die;
		$project=M('project')->where(array('pid'=>$_GET['pid']))->find();
		
		if($_GET['class']=="项目申请书"){
			$ext=$project['paccessory'];
			$ext=explode(".",$ext);
			$filename=$project['pcaptainnum']."_".$project['pcaptainname']."_".$project['pname'].".".$ext[1];
			$filename=urlencode($filename);
			//p($filename);die;
			$file=".".$project['paccessory'];
		}
		
		if($_GET['class']=="中期检查表"){
			$ext=$project['pmiddleaccessory'];
			$ext=explode(".",$ext);
			$filename=$project['pcaptainnum']."_".$project['pcaptainname']."_".$project['pname'].".".$ext[1];
			$filename=urlencode($filename);
			//p($filename);die;
			$file=".".$project['pmiddleaccessory'];
		}
		
		if($_GET['class']=="结题材料"){
			$ext=$project['plastaccessory'];
			$ext=explode(".",$ext);
			$filename=$project['pcaptainnum']."_".$project['pcaptainname']."_".$project['pname'].".".$ext[1];
			$filename=urlencode($filename);
			//p($filename);die;
			$file=".".$project['plastaccessory'];
		}
		
		header("Content-type:text/html;charset=utf-8"); 
		header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
		header('Content-Length:'.filesize($file)); //指定下载文件的大小
		//将文件内容读取出来并直接输出，以便下载
		readfile($file);
	}	
		//查询
	public function searchproject(){
		//p($_POST);die;
		$this->msg=I('msg');
		if(I('searchannual'))
			$condition['pannual']=I('searchannual');
		if(I('searchlevel'))
			$condition['plevel']=I('searchlevel');
		if(I('searchfid'))	
			$condition['fid']=I('searchfid');
		$this->unum=I("unum");
		$this->uname=I("uname");
		import("ORG.Util.Page");
		$count=D('ProjectRelation')->relation(true)->where($condition)->count();
		$page=new Page($count,30);
		$limit = $page->firstRow . ',' . $page->listRows;
		$project=D('ProjectRelation')->relation('user')->limit($limit)->where($condition)->order('fid desc,pstatus,pleaderstatus,pid desc')->select();
		$this->project=$project;
		$this->page=$page->show ();
		$this->searchyear=I('searchannual');
		$this->searchlevel=I('searchlevel');
		$this->searchfid=I('searchfid');
		$fids=M("projectnews")->field(array('pid','ptitle'))->order('pid desc')->select();
		$this->searchfids=$fids;
		$this->display('project');
	}	
	//删除 projectNews
	public function projectDelete(){
		$pid=$_REQUEST['pid'];
		$projectnews = M ( "projectnews" );
		$data['status']="ok";
		$data['p']=$pid;
		if($projectnews->where('pid='.$pid)->delete()){
			$this->ajaxReturn($data,"json");
		}else{
			$data['status']="error";
			$this->ajaxReturn($data,"json");
		}
	}
	//删除 讲座
	public function lectureDelete(){
		$lid=$_REQUEST['lid'];
		$lecture = M ( "lecture" );
		$data['status']="ok";
		$data['l']=$lid;
		if($lecture->where('lid='.$lid)->delete()){
			$this->ajaxReturn($data,"json");
		}else{
			$data['status']="error";
			$this->ajaxReturn($data,"json");
		}
	}
	//=============项目中心结束============
	//=============人才库管理开始============
	public function elite(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->msg=I('msg');
		$elitegroup=D('EliteRelation')->relation(true)->order('eid')->select();
		//p($elitegroup);
		$this->elitegroup=$elitegroup;
		$this->display();
	}
	public function addelitegroup(){
		//p($_POST);die;
		$data=array(
			'ename'=>$_POST['name'],
		);
		
		$result=M('elite')->add($data);
		if($result)
			$this->redirect('elite',array('unum'=>$unum,'uname'=>$uname,'msg'=>"添加成功！"));
		else 
			$this->redirect('elite',array('unum'=>$unum,'uname'=>$uname,'msg'=>"添加失败！"));
	}
	public function addelite(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$eid=I('eid');
		$this->eid=$eid;
		$this->display();
	}
	public function addelitehandle(){
		
		//确定学号姓名是否匹配
		$user=M('user')->where(array('unum'=>$_POST['num']))->find();
		if(!empty($user)){
			if($user['uname']==$_POST['name']){
				$data=array('elite_id'=>$_POST['eid'],'user_id'=>$user['uid']);
				$result=M('elite_user')->add($data);
				if($result)
					$this->redirect('elite',array('unum'=>$unum,'uname'=>$uname,'msg'=>"添加成功！"));
				else 
					$this->redirect('elite',array('unum'=>$unum,'uname'=>$uname,'msg'=>"添加失败！"));	
			}else{
					$this->redirect('elite',array('unum'=>$unum,'uname'=>$uname,'msg'=>"此学号姓名不匹配！"));
			}
		}else{
			$this->redirect('elite',array('unum'=>$unum,'uname'=>$uname,'msg'=>"此学号不存在！"));
		}
	}
	public function deleteelitegroup($eid){
			if (! empty ( $eid )) {
						//解除elite_user表数据
						$result=M('elite_user')->where(array('elite_id'=>$eid))->delete();
						//删除此分组
						$result = M('elite')->where(array('eid'=>$eid,))->delete ();
						
					}
			 else {
						$this->error ( '获取信息失败！' );
					}
		}
	public function deleteelite($eid,$uid){
			if (! empty ( $eid ) && ! empty ( $uid )) {
						//解除elite_user表数据
						$result=M('elite_user')->where(array('elite_id'=>$eid,'user_id'=>$uid))->delete();
												
					}
			 else {
						$this->error ( '获取信息失败！' );
					}
	}	
	//=============人才库管理结束============
	//=============用户管理开始=============
	public function user(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->msg=I('msg');
		import("ORG.Util.Page");
		$count=M('user')->count();
		$page=new Page($count,30);
		$limit = $page->firstRow . ',' . $page->listRows;
		$user=D('UserRelation')->relation(true)->order('uid desc')->limit($limit)->select();
		$this->user=$user;
		//p($user);die;
		//模板路径
		// echo "<pre>";
		// 	print_r($this->user);
		// echo "</pre>";
		// exit();
		$this->userFilePath="/Uploads/modules/user.xls";
		$this->page=$page->show ();
		$this->display();
	}
	public function userread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$this->msg=I('msg');
		$uid=I('uid');
		$user=D('UserRelation')->relation(true)->where(array('uid'=>$uid))->find();
		$this->user=$user;
		//p($user);
		//导入角色
		$role=M('role')->select();
		$this->role=$role;
		//p($role);die;
		//查询用户学号
		
		//查询积分---竞赛
		$race=M('race_user')->where(array('unum'=>$user['unum'],'status'=>1))->field(array('race_name','bonus'))->select();
		
		$this->race=$race;
		//查询积分---项目
		$project=array();
		$projectid=M('project_user')->where(array('user_id'=>$uid))->select();
		//p($projectid);
		for($i=0;$i<count($projectid);$i++){
			$tmp=M('project')->where(array('pid'=>$projectid[$i]['project_id']))->field(array('pid','pname','pstatus','pleaderstatus','plevel','pmiddleend','plastend'))->find();
			
			if($tmp['pstatus']==1){
				$tmp['assign']="报名";
				array_push($project,$tmp);
			}
			if($tmp['pleaderstatus']==1){
				$tmp['assign']=$tmp['plevel'];
				array_push($project,$tmp);
			}
			if($tmp['pmiddleend']==1){
				$tmp['assign']="中期答辩";
				array_push($project,$tmp);
			}
			if($tmp['plastend']==1){
				$tmp['assign']="结题答辩";
				array_push($project,$tmp);
			}
		}
		//p($project);die;
		$this->project=$project;
		//查询积分---讲座
		$lecture=M('lecture_user')->where(array('user_num'=>$user['unum'],'lpresent'=>1))->select();
		$this->lecture=$lecture;
		$this->display();
	}
	//用户查询 根据姓名或者是学号
	// stu 学号或者是姓名   type 类型 0学号 1姓名
	public function getStudent(){
		$stu='';
		$type=0;
		$stu=$_REQUEST['stu'];
		$unum=$_REQUEST['unum'];
		$uname=$_REQUEST['uname'];
		$type=$_REQUEST['type'];
		if($type==0){
			// $user=M("user")->where(array('unum'=>$stu))->select();
			$user=D('UserRelation')->relation(true)->where(array('unum'=>$stu))->find();
		}else{
			// $user=M("user")->where('uname like "%'.$stu.'%"')->select();
			$user=D('UserRelation')->relation(true)->where('uname like "%'.$stu.'%"')->find();
		}
		// $this->
		// {:U('Admin/SuperManage/userread',array('uid'=>$u['uid'],'unum'=>$unum,'uname'=>$uname))}
		$this->unum=$unum;
		$this->uname=$uname;
		$this->user=$user;
		// p($user);die;
		//导入角色
		$role=M('role')->select();

		$this->role=$role;
		//p($role);die;
		//查询用户学号
		
		//查询积分---竞赛
		$race=M('race_user')->where(array('unum'=>$user['unum'],'status'=>1))->field(array('race_name','bonus'))->select();
		
		$this->race=$race;
		//查询积分---项目
		$project=array();
		$projectid=M('project_user')->where(array('user_id'=>$uid))->select();
		//p($projectid);
		for($i=0;$i<count($projectid);$i++){
			$tmp=M('project')->where(array('pid'=>$projectid[$i]['project_id']))->field(array('pid','pname','pstatus','pleaderstatus','plevel','pmiddleend','plastend'))->find();
			
			if($tmp['pstatus']==1){
				$tmp['assign']="报名";
				array_push($project,$tmp);
			}
			if($tmp['pleaderstatus']==1){
				$tmp['assign']=$tmp['plevel'];
				array_push($project,$tmp);
			}
			if($tmp['pmiddleend']==1){
				$tmp['assign']="中期答辩";
				array_push($project,$tmp);
			}
			if($tmp['plastend']==1){
				$tmp['assign']="结题答辩";
				array_push($project,$tmp);
			}
		}
		//p($project);die;
		$this->project=$project;
		//查询积分---讲座
		$lecture=M('lecture_user')->where(array('user_num'=>$user['unum'],'lpresent'=>1))->select();
		$this->lecture=$lecture;
		// var_dump($user);
		// echo "<hr>";
		// var_dump($project);
		// echo "<hr>";
		// var_dump($lecture);
		// echo "<hr>";
		// var_dump($unum);
		// echo "<hr>";
		// var_dump($uname);
		// exit();
		$this->display("getStudent");
	}
	public function userupdate(){
		
		// p($_POST);die;
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		
		$role=M('role')->where(array('id'=>$_POST['role']))->find();
		
		if($role['name']=='学生'){
			$flag='学生';
			$profession='学生';
			$receive=array(
			'uid'=>$_POST['uid'],
			'upoint'=>$_POST['point'],
			'master'=>$_POST['master'],
			'ugrade'=>$_POST['grade'],	
			'uflag'=>$flag,
			'uprofession'=>$profession,
			);
		}
			
		else if($role['name']=='教师'){
			$flag='教师';
			$profession=$_POST['profession'];
			$receive=array(
			'uid'=>$_POST['uid'],
			'upoint'=>$_POST['point'],
			'master'=>$_POST['master'],
			'ugrade'=>$_POST['grade'],	
			'uflag'=>$flag,
			'uprofession'=>$profession,
			);
		}
		else{
			$receive=array(
			'uid'=>$_POST['uid'],
			'master'=>$_POST['master'],
			'ugrade'=>$_POST['grade'],	
			'upoint'=>$_POST['point'],
			);
		}	 		
		
		$result=M('user')->save($receive);
		//写入角色信息
			//删除之前的信息
		M('role_user')->where(array('user_id'=>$_POST['uid']))->delete();
			//写入新的信息
		$data=array('user_id'=>$_POST['uid'],'role_id'=>$_POST['role']);
		$result2=M('role_user')->add($data);
				
		if($result && $result2)
			$this->redirect('userread',array('unum'=>$unum,'uname'=>$uname,'uid'=>$_POST['uid'],'msg'=>"保存成功！"));
		else
			$this->redirect('userread',array('unum'=>$unum,'uname'=>$uname,'uid'=>$_POST['uid'],'msg'=>"保存失败！"));		
	}

	public function pwdreset($uid){
		if (! empty ( $uid )) {
						$user=M('user')->where(array('uid'=>$uid))->find();
						$data=array(
						'uid'=>$uid,
						'upassword'=>md5($user['unum']),
					);
					M('user')->save($data);
						
					}
			 else {
						$this->error ( '获取信息失败！' );
					}
		
	}
	
	public function insertuser(){
	
	if($_FILES['newsFile']['error']){
			if($_FILES['newsFile']['error']==4){
				$this->redirect('user',array('unum'=>$unum,'uname'=>$uname,'msg'=>"请上传文件！"));
			}else{
				switch($_FILES['newsFile']['error']){
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
			
			//限制文件上传类型
			$allowExt=array('xls','xlsx');
			$ext=pathinfo($_FILES['newsFile']['name'],PATHINFO_EXTENSION);
			if(!in_array($ext,$allowExt)){
				$this->redirect('user',array('unum'=>$unum,'uname'=>$uname,'msg'=>"上传文件格式不正确！"));
			}
			if($_FILES['newsFile']['size']>10*1024*1024){
				$this->redirect('user',array('unum'=>$unum,'uname'=>$uname,'msg'=>"上传文件过大！"));
			}
			
			//读取文件
			$filePath=$_FILES['newsFile']['tmp_name'];
			//p($filename);die;
			vendor("PHPExcel.PHPExcel");
			$PHPExcel = new PHPExcel();

			/**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
			$PHPReader = new PHPExcel_Reader_Excel2007();
			if(!$PHPReader->canRead($filePath)){
				$PHPReader = new PHPExcel_Reader_Excel5();
				if(!$PHPReader->canRead($filePath)){
				echo 'no Excel';
				return ;
				}
			}
			
			$PHPExcel = $PHPReader->load($filePath);
			/**读取excel文件中的第一个工作表*/
			$currentSheet = $PHPExcel->getSheet(0);
			/**取得最大的列号*/
			$allColumn = $currentSheet->getHighestColumn();
			/**取得一共有多少行*/ 
			$allRow = $currentSheet->getHighestRow(); 
			//写入数据库
			$user=array();
			/**从第二行开始输出，因为excel表中第一行为列名*/
			for($currentRow = 2;$currentRow <= $allRow;$currentRow++){
			/**从第A列开始输出*/
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
					$val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
						if($currentColumn=='A'){
							$user[$currentRow-2]['unum']=$val;
						}
						if($currentColumn=='B'){
							$user[$currentRow-2]['uname']=$val;
						}
						if($currentColumn=='C'){
							$user[$currentRow-2]['uprofession']=$val;
						}
						if($currentColumn=='D'){
							$user[$currentRow-2]['school']=$val;
						}
						if($currentColumn=='E'){
							$user[$currentRow-2]['master']=$val;
						}
						if($currentColumn=='F'){
							$user[$currentRow-2]['ugrade']=$val;
						}
						if($currentColumn=='G'){
							$user[$currentRow-2]['uflag']=$val;
						}
					}
				}
			//写入数据库
			// p($user);die;
			$c=0;
			for($i=0;$i<count($user);$i++){
				if(!empty($user[$i]['unum'])){
					if(count(M('user')->where(array("unum"=>$user[$i]["unum"]))->select())>0){
					}else{
						if($user[$i]['uprofession']=="学生"){
							$data=$user[$i];
							$data['upassword']=md5($user[$i]['unum']);
							$result=M('user')->add($data);
							//插入role_user
							$role=M('role')->where(array('name'=>"学生"))->find();
							$data=array("role_id"=>$role['id'],"user_id"=>$result);
							$result2=M('role_user')->where($data)->add($data);
							if(!($result && $result2))
								$c++;
							
						}else{
							$data=$user[$i];
							$data['upassword']=md5($user[$i]['unum']);
							$result=M('user')->add($data);
							//插入role_user
							$role=M('role')->where(array('name'=>"教师"))->find();
							$data=array("role_id"=>$role['id'],"user_id"=>$result);
							$result2=M('role_user')->where($data)->add($data);
							if(!($result && $result2))
								$c++;
						}
					}
				}
			}
			if($c)
				$this->redirect('user',array('unum'=>$unum,'uname'=>$uname,'msg'=>"部分数据导入失败！"));
			else
				$this->redirect('user',array('unum'=>$unum,'uname'=>$uname,'msg'=>"导入成功！"));	
		}
	}
	public function downfile(){
			
			header("Content-type:text/html;charset=utf-8"); 
			$filename=$_GET['filename'];
			
			header('Content-Disposition: attachment; filename="'.$filename.'"'); //指定下载文件的描述
			header('Content-Length:'.filesize($filename)); //指定下载文件的大小
			//将文件内容读取出来并直接输出，以便下载
			readfile($filename);
		}
	//=============用户管理结束=============
	//=============讲座开始=============
	public function lecture(){
		$this->unum=I("unum");
		$this->uname=I("uname");
		$this->msg=I('msg');
		import("ORG.Util.Page");
		$count=M('lecture')->count();
		$page=new Page($count,20);
		$limit = $page->firstRow . ',' . $page->listRows;
		$lecture=M('lecture')->limit($limit)->order('lid desc')->select();
		$this->lecture=$lecture;
		$this->page=$page->show ();
		$this->display();
	}
	public function insertlecture(){
		$this->unum=I("unum");
		$this->uname=I("uname");
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
			'lcheckstatus'=>1,
			);
			//p($data);die;
		$db=M('lecture');
		$result=$db->add($data);
		if($result)
			$this->redirect('lecture',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布成功！"));
		else 
			$this->redirect('lecture',array('unum'=>$unum,'uname'=>$uname,'msg'=>"发布失败！"));	
	}
	public function lectureread(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$this->msg=I('msg');
		$lid=I('lid');
		$lecture=M('lecture')->where(array('lid'=>$lid))->find();
		$this->lecture=$lecture;
		$this->display();
	}
	public function lectureupdate(){
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
			'lcheckstatus'=>$_POST['checkstatus'],
			);
		$result=M('lecture')->save($receive);
		if($result)
			$this->redirect('lectureread',array('unum'=>$unum,'uname'=>$uname,'lid'=>$_POST['lid'],'msg'=>"修改成功！"));
		else
			$this->redirect('lectureread',array('unum'=>$unum,'uname'=>$uname,'lid'=>$_POST['lid'],'msg'=>"修改失败！")); 		
	
	}
	public function lectureapply(){
		$unum=I("unum");
		$uname=I("uname");
		$this->unum=$unum;
		$this->uname=$uname;
		$this->msg=I('msg');
		$lid=I('lid');
		$lecture=M('lecture_user')->where(array('lecture_id'=>$lid))->order('lpresent desc')->select();
		$this->lecture=$lecture;
		//p($lecture);die;
		$this->display();
	}
	public function insertlectureapply(){
		if($_FILES['newsFile']['error']){
				if($_FILES['newsFile']['error']==4){
					$this->error("请上传文件！");
				}else{
					switch($_FILES['newsFile']['error']){
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
				
				//限制文件上传类型
				$allowExt=array('txt');
				$ext=pathinfo($_FILES['newsFile']['name'],PATHINFO_EXTENSION);
				if(!in_array($ext,$allowExt)){
					$this->error("上传文件格式不正确！");
				}
				//读取文件
				$a=0;
				$str  = file_get_contents($_FILES['newsFile']['tmp_name']) or die("文件打开失败");
				$r = explode("\r\n",$str);
				//p($_POST);
				//p($r);die;
				for($i=0;$i<count($r);$i++){
					$record=explode("\t",$r[$i]);
					if(!empty($record)){
						if($record[1]){
							$data=array('lecture_id'=>$_POST['lid'],'user_num'=>$record[0],);
							$result=M('lecture_user')->where($data)->setField('lpresent',1);
							
						}
					}
				}
				if(!$a)
					$this->success("导入成功！");
				else
					$this->error("部分数据导入失败，请核实一下！"); 		
				
			}
	}
	public function lecturelistset(){
		//p($_POST);die;
		if(empty($_POST['subBox'])){
			$this->redirect('lectureapply',array('unum'=>$unum,'uname'=>$uname,'msg'=>"至少选择一条记录!",'lid'=>$_POST['lecture_id']));
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
				$this->redirect('lectureapply',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功！",'lid'=>$_POST['lecture_id']));
			else
				$this->redirect('lectureapply',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存失败！",'lid'=>$_POST['lecture_id'])); 
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
				$this->redirect('lectureapply',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功！",'lid'=>$_POST['lecture_id']));
			else
				$this->redirect('lectureapply',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存失败！",'lid'=>$_POST['lecture_id'])); 
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
	
	//=============讲座结束=============
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
				
			);
			$result=M('user')->save($receive);
			if($result)
				$this->redirect('updateselfmsg',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存成功！",'uid'=>$_POST['uid']));
			else 
				$this->redirect('updateselfmsg',array('unum'=>$unum,'uname'=>$uname,'msg'=>"保存失败！",'uid'=>$_POST['uid']));	
			
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
						if($result)$this->redirect('updatepwd',array('unum'=>$unum,'uname'=>$uname,'msg'=>"修改成功！",'uid'=>$_POST['uid']));
						else 
						$this->redirect('updatepwd',array('unum'=>$unum,'uname'=>$uname,'msg'=>"修改失败！",'uid'=>$_POST['uid']));
					}else 
						$this->redirect('updatepwd',array('unum'=>$unum,'uname'=>$uname,'msg'=>"原始密码错误!",'uid'=>$_POST['uid']));
				}else 
						$this->redirect('updatepwd',array('unum'=>$unum,'uname'=>$uname,'msg'=>"两次输入的密码不一致!",'uid'=>$_POST['uid']));
			
		}
	//======个人信息设置结束=========
	//=========用户名查询开始=======
	public function getstunum(){
		$num=I("unum");
		$user=M('user')->where(array('unum'=>$num))->find();
		$name=$user['uname'];
		echo json_encode($name);
	}
	//=========用户名查询结束=======
	//=========查看访问记录开始=======
	public function lastip(){
		import("ORG.Util.Page");
		$count=M('lastip')->where("ip != '127.0.0.1'")->count();
		$page=new Page($count,30);
		$limit = $page->firstRow . ',' . $page->listRows;
		$lastip=M('lastip')->where("ip != '127.0.0.1'")->limit($limit)->order('time_stamp desc')->select();
		$this->lastip=$lastip;
		$this->page=$page->show();
		$this->display();
	}
	//删除一定时间前的ip记录
	public function deleteip(){
		$day=$_POST['time'];
		if($day != 1 && $day != 2 && $day != 3 && $day != 4 && $day != 5){
			$this->error("非法操作");
			exit();
		}
		$time=time();
		$second = $day*24*60*60;
		// p($second);die;
		$allip=M("lastip")->where($time."-time_stamp > ".$second)->delete();
		if($allip){
			$this->redirect();
		}else{
			$this->error("删除失败");
		}
	}
	//根据ip查看是否是已经在系统中的用户
		public function ipread(){
			$ip=$_GET['ip'];
			$user= M("user")->where("lastip = ".$ip)->find();
			if(count($user) >0 ){
				$this->user=$user;
				$this->display();
			}else{
				$this->error("该IP未登录过");
			}
		}
	//=========查看访问记录关闭=======
	
}
