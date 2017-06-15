<?php
include ("conn.php");
	//include ("inc/user.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

session_start();
if(!isset($_SESSION['logined']))
{
	echo '{"records":" ","Login":"ERR"}';
}
else
{
	// $sql="select usershebei.用户名称,shebeiinfo.设备名称,shebeiinfo.设备编号 from usershebei,shebeiinfo where usershebei.设备编号 = shebeiinfo.设备编号 and usershebei.用户名称='".$_SESSION['user']."'" ;
	$sql="select distinct usershebei.用户名称,usershebei.设备名称,usershebei.设备编号 from usershebei,shebeiinfo where usershebei.设备编号 = shebeiinfo.设备编号 and usershebei.用户名称='".$_SESSION['user']."'  " ;

  //$sql="select * from usershebei where usershebei.用户名称='".$_SESSION['user']."'";
	$res=mysql_query($sql,$conn); 
/*	$row=mysql_fetch_array($res);
	
	$tbname='te'.$row['设备编号'];
	$time="select 时间 from ".$tbname.""; 
	$rest=mysql_query($time,$conn);*/
	$res=mysql_query($sql,$conn);
	$outp="";
	while($row=mysql_fetch_array($res)){
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"Name":"'  . $row["设备名称"] . '",';
		$outp .= '"YongHu":"'. $_SESSION['user'] . '",';
		$outp .= '"ID":"'. $row["设备编号"]     . '"}';
	}
	$outp ='{"records":['.$outp.'],"Login":"OK"}';
	echo $outp;
}
?>