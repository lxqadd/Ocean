<?php
include ("conn.php");
session_start();
//点击注册按钮操作isset($_POST['tianjias']) && 
if($_SESSION['logined'] &&isset($_POST['tianjias']))
{
	$mingcheng=$_POST["mingcheng"];	
	$bianhao=$_POST["bianhao"];
	$gonglv=$_POST["gonglv"];

	$sql="select 设备编号  from shebeiinfo where 设备编号='$bianhao' ";
	$query=mysql_query($sql);
	$rowr = mysql_num_rows($query);
	//如果设备表中存在，那就不要再添加了，检查一下用户表中有没有
	if($rowr>0){
	$sql="select 设备编号  from usershebei where 设备编号='$bianhao' and 用户名称='".$_SESSION['user']."'";
	$query=mysql_query($sql);
	$rows = mysql_num_rows($query);
	if($rows > 0){
		echo "<script>alert('该设备已经存在！');</script>";	
	echo "<script>window.location.href='about.html';</script>";	
	}
	else{
		if($mingcheng=="" || $bianhao=="" || $gonglv== "")
		{
			echo "<script>alert('请填入相关信息')</script>";			
		}
		else{
		//插入到用户设备表中
		$sql="insert into usershebei(用户名称,设备编号,设备名称) values ('".$_SESSION['user']."','".$bianhao."','".$mingcheng."')";
		$res=mysql_query($sql,$conn);
		//echo "<script>alert('添加成功！')</script>";

		 mysql_close($conn);	
		 echo "<script>window.location.href='main.html';</script>";	  
		}
	}
	}
			
//如果设备表中不存在，那么就要加入设备表
	else{
		if($mingcheng=="" || $bianhao=="" || $gonglv== "")
		{
			echo "<script>alert('请填入相关信息')</script>";	
			echo "<script>window.location.href='about.html';</script>";			
		}
		else{
		//执行插入语句,插入到设备表中
			$sql="insert into shebeiinfo (设备名称,设备编号,设备功率) values  ('".$mingcheng."','".$bianhao."','".$gonglv."')";
			$res1=mysql_query($sql,$conn);
			if($res1>0){
				$shebeidate="TE".$bianhao;
		  //插入到用户设备表中
		$sql="insert into usershebei(用户名称,设备编号,设备名称) values ('".$_SESSION['user']."','".$bianhao."','".$mingcheng."')";
		$res2=mysql_query($sql,$conn);
		  mysql_select_db("guangfu",$conn);//选择数据库
		  //创建新的数据表
		  $sql = "CREATE TABLE ".$shebeidate." 
		  (
		  时间 datetime,
		  状态 varchar(16),
		  输入功率 float,
		  输出功率 float,
		  面板1电压 float,
		  面板1电流 float,
		  面板1功率 float,
		  面板2电压 float,
		  面板2电流 float,
		  面板2功率 float,
		  电网频率 float,
		  当日发电总量 float,
		  总发电量 float,
		  总工作时间 float
		  )default character set utf8";		
		  // echo "<script type='text/javascript'> 
		  // alert('添加成功!');
		  // </script>";
		    echo "<script>window.location.href='main.html';</script>";	   
		  $res=mysql_query($sql,$conn);
		  mysql_close($conn);		  
		}
		else echo "插入数据失败";
	}  
}

	}

	


?>
<!DOCTYPE html>
<html>
<head>
</head>
	<!--样式加载结束-->

	
    <body>

    </body>
    </html>
    <script type="text/javascript">
		var websstatus =false;
		function start(id) {
			var inc = document.getElementById('incomming');
			var wsImpl = window.WebSocket || window.MozWebSocket;
			var form = document.getElementById('sendForm');
			var input = document.getElementById('sendText');
			var jso;
			var msg;
            //inc.innerHTML += "connecting to server ..<br/>";
            // create a new websocket and connect
            window.ws = new wsImpl('ws://110.249.208.230:8181/');
            // 分析服务器返回信息
            ws.onmessage = function (evt) {

            };

            //发送消息给服务器并建立连接
            ws.onopen = function () {
              //inc.innerHTML += '连接成功<br/>';
              websstatus=true;
              var strJSON="{'type':'new','user':'<?php echo $_SESSION['user']; ?>','te':'<?php echo  $bianhao; ?>','msg':''}";
              console.log(strJSON);
              ws.send(strJSON);
          };

			//如果连接失败，发送、接收数据失败或者处理数据出现错误，browser会触发onerror消息;
			ws.onerror = function(evt) {
				//inc.innerHTML += '连接错误<br/>';
			};
            // when the connection is closed, this method is called
            ws.onclose = function () {
            	websstatus=false;
                //inc.innerHTML += '连接关闭<br/>';
            }

            
        }

        function doSend(message) { 
				//writeToScreen("SENT: " + message);  
				websocket.send(message); 
			}  
        window.onload = start;
    </script>