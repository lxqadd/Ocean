<?php
  include ("conn.php");
  //include ("inc/user.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
//echo $_SESSION['user'];
  $idnum=$_GET['id'];
 // echo $idnum;
//echo 'te';
  $names= 'te'.$idnum;
  $sql="select * from  $names" ;
  //echo $sql;
   $res=mysql_query($sql,$conn);
   $row=mysql_fetch_array($res);
    $outp="";
    $outp .= '{"shurugl":"'.$row["输入功率"]   . '",';
    $outp .= '"shuchugl":"'.$row["输出功率"]   . '",';
    $outp .= '"mb1dy":"'.$row["面板1电压"]   . '",';
    $outp .= '"mb1dl":"'.$row["面板1电流"]   . '",';
    $outp .= '"mb1gl":"'.$row["面板1功率"]   . '",';
    $outp .= '"mb2dy":"'.$row["面板2电压"]   . '",';
    $outp .= '"mb2dl":"'.$row["面板2电流"]   . '",';
    $outp .= '"mb2gl":"'.$row["面板2功率"]   . '",';
    $outp .= '"dianwangpl":"'.$row["电网频率"]   . '",';
    $outp .= '"dangrifd":"'.$row["当日发电总量"]   . '",';
    $outp .= '"YongHu":"'.$_SESSION['user']   . '",';
    $outp .= '"ID":"'.$idnum. '",';
    $outp .= '"zongfad":"'.$row["总发电量"]   . '",';
    $outp .= '"zonggzsj":"'.$row["总工作时间"]   . '"}';

  $outp ='{"records":['.$outp.']}';
  echo $outp;

     

?>