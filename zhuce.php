<?php
	include ("conn.php");
	//点击注册按钮操作
	if(isset($_POST['zhuce']))
	{
		
		$username=$_POST["username"];	
		$password=$_POST["password"];
		$password=strtoupper(md5($password));
		$phone=$_POST["phone"];
		
		$sql="select 姓名  from yonghu where 姓名='$username'";
		$query=mysql_query($sql);
    	 $rows = mysql_num_rows($query);
 	     if($rows > 0){
			 echo "<script type='text/javascript'>alert('用户名已存在!');location='javascript:history.back()';</script>";
		 }

		if($username=="" || $password=="" || $phone=="")
		{
			echo "<script>alert('请填入相关信息')</script>";		
		}
		else{
		
/*		//查询用户名是否存在
		$sql="select * username  from yonghu where 姓名='$username'";
		 $query=mysql_query($sql)or die(mysql_error());;
 		 $rows = mysql_num_rows($query);
		 if($rows['姓名']==$username){
         echo "<script type='text/javascript'>alert('用户名已存在');location='javascript:history.back()';</script>";
     }
		 else{*/
		 //
		if(preg_match("/^1[34578]{1}\d{9}$/",$phone)){  
				//执行插入语句
		$sql="insert into yonghu (姓名,密码,电话,时间) values  ('".$username."','".$password."','".$phone."','".date("Y-m-d H:i:s")."')";
		$res=mysql_query($sql,$conn);
		if($res>0){
			echo "<script type='text/javascript'>alert('注册成功！！');location.href='index.html';</script>";
			//清空lable标签中的数据
	
		}
		else echo "插入数据失败";     
			}
		else{  
			    echo "<script>alert('手机号码格式不正确')</script>";  
			} 

			
		}
		}


 ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>用户注册</title>
<meta name="keywords" content="光伏逆变并网">
<meta name="description" content="光伏逆变并网">
<link href="css/bootstrap.min-3.3.6.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">
<link href="css/style.min.css" rel="stylesheet">
<link href="css/login.min.css" rel="stylesheet">
<!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;bjjx_ie.html" />
    <![endif]-->
<style>
body {
	background-color:#ADA9A9 !important;
	    background-size:100% 100% !important;
  
}

#check div {
	line-height: 32px;
	padding-right: 5px;
	color: #000000;
}
input {
	margin: 0px !important;
}
form div {
	margin-bottom: 15px;
}
</style>
</head>


<body class="signin">
<div class="signinpanel">


      <div class="row text-center" 
     >
            <div class="text-center">
                  <h2 class="login_title">用户注册</h2>
            </div>
            <div class="">
            <form  method="post" action="">
            <div class="form-group form-group-sm">
            
              <input  style="color:#000000" type="text" class="form-control" id="username" name="username" value=""  placeholder="用户名">
            </div>
           
            <div class="form-group form-group-sm">
             
              <input  style="color:#000000"  type="password" class="form-control" id="password" value="" name="password" placeholder="用户密码">
              
            </div>
            
            <div class="form-group form-group-sm">
              
              <input  style="color:#000000"  type="text" class="form-control" id="phone" value="" name="phone" placeholder="电话号码">
            </div>
            

             <div class="form-group form-group-sm">
            
            <button type="submit" id="zhuce" name="zhuce" value="" class="btn  btn-primary btn-block " onClick="form1.submit();form1.reset();">注册</button>
            </div>
            
            </form>
            </div>
      </div>
      <div class="signup-footer" style="align-content:center">
            <div class="text-center"> 光伏逆变并网云监测平台UI &copy; 2017-2020 </div>
      </div>
</div>
</body>
</html>
