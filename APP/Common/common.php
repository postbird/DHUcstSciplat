<?php
//用于进行数据输出开发使用。
function p($array){
dump($array,1,'<pre>',0);
die();
}

//解决系统由于使用了自定义分组产生的分页路径问题
// 函数说明 模拟U("")方法生成正确的当前地址,并且最后执行操作
/*
*	powered by postbird 
*	http://www.ptbird.cn
*	lience MIT
*	2016-10-24
*/
/*
	问题描述：
	 自定义分组路径为 APP/Modules/Index/IndexAction.class.php
	 发现 __ACTION__,U(""), 两种形式均少一个Index
	 正常路径应为 xxx/Index/Index/pointlist (分组名/模块名/操作名)
	 发现分组名没了
	 //后期发现的问题 ；发现只有分组名称为Index,而操作是Index/Action/的时候
	 	__ACTION__和U("")方法才会产生问题，
	 	从而导致在分页过程中使用U("")方法出现问题
*/
/**  主要用在 Page上的第四个参数  
	------------------------------------------
	| $page=new Page($count,100,'',UU()); |
    ------------------------------------------
     * array $totalRows  总的记录数
     *  array $listRows  每页显示记录数
     *  array $parameter  分页跳转的参数
     * public function __construct($totalRows,$listRows='',$parameter='',$url='')
     */
function UU(){
	//正确的__ACTION__应该为：
	// 		/二级目录(如果有)/index.php(如果文件)/Index(独立模块名 并加上GROUP_NAME)/Index(ACTION)/pointlist(操作)
	// 问题 ：/sciplat/index.php/Index/pointlist 可以看出少了一个Index(模块名称 并加上GROUP_NAME)
	$str =__ACTION__;
	//去掉index.php,并加上GROUP_NAME
	$str =GROUP_NAME.substr($str,strpos($str,"index.php/")+strlen("index.php/")-1,strlen($str))."/p/";
	// dump($str);
	// 效果 string(22) "/Index/Index/pointlist"
	return $str;
}