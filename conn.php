<?php
//phpinfo();
header("content-type:text/html;charset:utf-8");

define("USER","root");//用户名
define("PASS","hebeifangju");//密码
define("DB","guangfu");//数据库
define("SERVER","localhost");//数据库服务器
define("PORT","3306");//端口号
$conn=mysql_connect(SERVER,USER,PASS);
if($conn==false)
{
	echo "链接服务器失败";
	die();
}

mysql_select_db(DB,$conn);//选择数据库
mysql_query("set names utf8");//设置数据库编码
date_default_timezone_set("PRC");//设置为北京时间

?>