<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
	echo '</script>';
	}
	else
	{
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	$plantcode=$_SESSION['plantcode'];
	$plantcode1=$_SESSION['plantcode1'];
	$plantcode2=$_SESSION['plantcode2'];
	$plantcode3=$_SESSION['plantcode3'];
	$plantcode4=$_SESSION['plantcode4'];
	}	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
	 //$pid = $_GET['pid'];	
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv = $_REQUEST['txtvariety'];
	
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;

	
	$age = $_REQUEST['age'];
	$qry="select distinct lotldg_lotno, lotldg_crop, lotldg_variety from tbl_lot_ldg where lotldg_sstage='Raw' and plantcode='$plantcode'";
	if($age=="morethan60")
	{	
	$dt=date("d-m-Y", strtotime("-60 days"));
	$qry.="and lotldg_trdate<'$dt' ";
	}
	$qry.="and lotldg_variety REGEXP '[A-Za-z]' order by lotldg_trdate asc";
	//echo $qry;
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	 
	$dh="Coded_Raw_Seed_Report ";
	$datahead = array($dh);
	$datahead2 = array("Coded_Raw_Seed_Report ");

	$data1 = array();
	
function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	   
	    # file name for download $filename = "Order Details.xls";
		
	    $filename=$dh.".xls";  
	   //exit;
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel");
		 //$datatitle1 = array("Preliminary QC");
 
	 $datatitle2 = array("#","Date of Arrival","Crop","Lot No. ","NoB","Qty","QC Status","GOT Status","Duration");
	 
	 $cdt=date("d-m-Y");

   function timeDiff($t1, $t2)
{
   if($t1 > $t2)
   {
      $time1 = $t2;
      $time2 = $t1;
   }
   else
   {
      $time1 = $t1;
      $time2 = $t2;
   }
   $diff = array(
      'Year(s)' => 0,
      'Month(s)' => 0,
	  'Day(s)' => 0
         );
   
   foreach(array('Year(s)','Month(s)','Day(s)')
         as $unit)
   {
      while(TRUE)
      {
         $next = strtotime("+1 $unit", $time1);
         if($next <= $time2)
         {
            $time1 = $next;
            $diff[$unit]++;
         }
         else
         {
            break;
         }
      }
   }
   return($diff);
}


$d=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$crop=""; $variety=""; $lotno="";  $slocs="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['lotldg_variety']."' order by popularname Asc"); 

$rowvv=mysqli_num_rows($quer4);

//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
   		 $crop=$row31['cropname'];
		
		 $lotno=$row_arr_home['lotldg_lotno'];
	 $variety=$crop."-"."Coded";
	 
$ccnt=0; $nob=0; $qty=0; $qc=""; $got="";$trdate="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and lotldg_variety='".$variety."' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and lotldg_variety='".$variety."' and plantcode='$plantcode' order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_sstage='Raw' and lotldg_variety='".$variety."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$row_istbl=mysqli_fetch_array($sql_istbl);
	$arrival_id=$row_istbl['lotldg_trid'];
	$nob=$nob+$row_istbl['lotldg_balbags'];
	$qty=$qty+$row_istbl['lotldg_balqty'];

	$trdate=$row_istbl['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$qc=$row_istbl['lotldg_qc'];
	$got=$row_istbl['lotldg_got'];

$ccnt++;	
}
}
//}
//echo $ccnt;
if($ccnt > 0)
{
	
if(trdate!="")
{
$start = strtotime($trdate);
$end = strtotime($cdt);
$diff = timeDiff($start, $end);
$output = "The difference is:";
$a="";
$b="";
foreach($diff as $unit => $value)
{
	$a=$a.$value.",";
	$b=$b.$unit.",";
}

			$p_array=explode(",",$a);
			$p_array1=explode(",",$b);
			$p=array();
			$i=0;
			$co="";
			foreach($p_array as $val)
				{foreach($p_array1 as $val1)
				if($val <> "" && $val1 <> "")
				{
				$co[$i]=$p_array[$i].$p_array1[$i];
				}$i++;
				}
				
	 $diff=$co[0]." ".$co[1]." ".$co[2];
}
else
$diff="";
if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$trdate,$crop,$lotno,$nob,$qty,$qc,$got,$diff); 
$d++;
}
}
}

# coading ends here............

echo implode($datahead2) ;
echo "\n";
echo implode("\t", $datatitle2) ;
echo "\n";
	
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
