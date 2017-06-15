<?php 
	include ("conn.php");
	session_start();	
	//点击登录按钮操作

	if(isset($_GET['name']) && isset($_GET['pass']))
	{
		$name=$_GET["name"];	
		$pass=$_GET["pass"];
		$pass=strtoupper(md5($pass));
		$sql="select * from yonghu where 姓名='".$name."' and 密码='".$pass."'";
		$res=mysql_query($sql,$conn);		
		$rec=mysql_fetch_array($res);//取出一条记录
		$query=mysql_query($sql);
        $rows = mysql_num_rows($query);
        //如果已经登陆过了，就直接可以跳转界面

 	     if($rows > 0){
			$_SESSION["logined"]=true;
			$_SESSION['user']=$name;  //记录当前登录用户。	
			echo json_encode(array('status'=>0,'result'=>'ok'));	
						
		}
		else{
			 echo json_encode(array('status'=>0,'result'=>'error'));
		}

	}

?>
 
