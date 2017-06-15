<?php
	include ("inc/conn.php");
	session_start();
	$sql="select usershebei.用户名称,shebeiinfo.设备名称,shebeiinfo.设备编号 from usershebei,shebeiinfo where usershebei.设备编号 = shebeiinfo.设备编号 and usershebei.用户名称='".$_SESSION['user']."'" ;
	$res=mysql_query($sql,$conn);
	$row=mysql_fetch_array($res);
    
    // $sql="delete from shebeiinfo where 设备编号 = '".$row['设备编号']."'";
   	// $res1=mysql_query($sql,$conn); 
    // $sql="delete from usershebei where 设备编号 ='".$row['设备编号']."'";
   	// $res2=mysql_query($sql,$conn);
   	//判断用户的设备在用户表中是否就一个，如果就一个，就删了，不是一个，就留着
   	$sql="select * from usershebei where 设备编号='".$row['设备编号']."'";
   	$query=mysql_query($sql);
    $rows = mysql_num_rows($query);
    //用户设备表中存在，就只删除用户表中的
 	if($rows > 0){
 	$sql="delete from usershebei where 设备编号 ='".$row['设备编号']."' and 用户名称='".$_SESSION['user']."'";
   	$res2=mysql_query($sql,$conn);
 	}
 	//不存在就都删除
 	else{
 	$sql="delete from shebeiinfo where 设备编号 = '".$row['设备编号']."'";
   	$res1=mysql_query($sql,$conn);
   	$sql="delete from usershebei where 设备编号 ='".$row['设备编号']."' and 用户名称='".$_SESSION['user']."'";
   	$res2=mysql_query($sql,$conn); 
   	$tbname='te'.$row['设备编号'];
    $sql="drop table ".$tbname."";
 	}
	// $tbname='te'.$row['设备编号'];
 //    $sql="drop table ".$tbname."";
	//echo $sql;
   	$res3=mysql_query($sql,$conn); 
	
	
	echo "<script>window.location.href='main.html';</script>";
  
   ?>
   
   

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
</body>
</html>
