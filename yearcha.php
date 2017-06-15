 <?php
 include ("inc/conn.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
//按年查询
      $idnum=$_GET['id'];
      $outp="";
      $dataavg=array();
      $gl="select * from ".'te'.$idnum." where 时间>='".date("Y-1-1 00:00:00")."'";
      $res=mysql_query($gl,$conn);
      //$row=mysql_fetch_array($res);
      for($i=1;$i<=12;$i++){
        $num=0;$n=1;
        $gl="select * from ".'te'.$idnum." where 时间>='".date("Y-".$i."-1 00:00:00")."' and  时间<'".date("Y-".($i+1)."-1 00:00:00")."' ";
        $res=mysql_query($gl,$conn);{
        while($row=mysql_fetch_array($res)){
          
          $num+=$row['面板1电压'];
          $n++;
          }
        $dataavg[]=$num/$n;
        } 
      }
      $jsonencode = json_encode($dataavg);
      //echo $jsonencode;
      $outp ='{"quxianyear":'.$jsonencode.'}';
       echo $outp;
?>