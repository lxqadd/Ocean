 <?php
 include ("conn.php");
  //include ("inc/user.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
//echo $_SESSION['user'];
      $idnum=$_GET['id'];
      $outp="";
      $dataavg=array();
      $gl="select * from ".'te'.$idnum." where 时间>='".date("Y-m-d 00:00:00")."'";
      $res=mysql_query($gl,$conn);
      //$row=mysql_fetch_array($res);
      for($i=1;$i<=24;$i++){
        $num=0;$n=1;
        $gl="select * from ".'te'.$idnum." where 时间>='".date("Y-m-d ".$i.":00:00")."' and  时间<='".date("Y-m-d ".($i+1).":00:00")."' ";
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
      $outp ='{"quxian":'.$jsonencode.'}';
       echo $outp;
      // 
      // echo $jsonencode;
         // $arrlength=count($dataavg);
         // for($x=0;$x<$arrlength;$x++) {
         //   if($dataavg[$x] == 0)
         //   {
         //     $date= 1-1;
         //     $jsonencode = json_encode($date);
         //     echo $jsonencode;
         //   }
         //    else{
         //      $date=$dataavg[$x];
         //      $jsonencode = json_encode($date);
         //      echo $jsonencode;
         //    } 
         // }
?>