<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	 //$pid = $_GET['pid'];	
	
		
	// Set timezone
  date_default_timezone_set("UTC");
 
  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }
  
  
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
	$qry="select distinct lotldg_lotno, lotldg_crop, lotldg_variety from tbl_lot_ldg where lotldg_sstage='Raw' ";
	if($age=="morethan60")
	{	
	$dt=date("d-m-Y", strtotime("-60 days"));
	$qry.="and lotldg_trdate<'$dt' ";
	}
	$qry.="and lotldg_variety REGEXP '[A-Za-z]'";
	
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	 $tot_arr_home=mysqli_num_rows($sql_arr_home);
	 
	$dh="Coded_Raw_Seed_Report";
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
 
	 $datatitle2 = array("#","Date of Arrival","Crop","SP Code-F","SP Code-M","Lot No. ","NoB","Qty","QC Status","GOT Status","Production Location","Farmer","Organiser","Duration");
	 
	 $cdt=date("d-m-Y");

$d=1;

			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$crop=""; $variety=""; $lotno="";  $slocs="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['lotldg_variety']."' and vertype='PV' order by popularname Asc"); 

$rowvv=mysqli_num_rows($quer4);

//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
   		 $crop=$row31['cropname'];
		
		 $lotno=$row_arr_home['lotldg_lotno'];
	 $variety=$crop."-"."Coded";
	 
$ccnt=0; $nob=0; $qty=0; $qc=""; $got="";$trdate="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and lotldg_variety='".$variety."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and lotldg_variety='".$variety."'  order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_sstage='Raw' and lotldg_variety='".$variety."'  order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$row_istbl=mysqli_fetch_array($sql_istbl);
	$arrival_id=$row_istbl['lotldg_trid'];
	$nob=$nob+$row_istbl['lotldg_balbags'];
	$qty=$qty+$row_istbl['lotldg_balqty'];

		
	$qc=$row_istbl['lotldg_qc'];
	$got=$row_istbl['lotldg_got'];

$ccnt++;	
}
}
//}
//echo $ccnt;
if($ccnt > 0)
{
$qry2="select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$variety."' and sstage='Raw' and lotno='".$row_arr_home['lotldg_lotno']."'";
$sql_rr=mysqli_query($link,$qry2) or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
$row_rr=mysqli_fetch_array($sql_rr);

$spcf=$row_rr['spcodef'];	
$spcm=$row_rr['spcodem'];	
$ploc=$row_rr['ploc'];	
$farmer=$row_rr['farmer'];
$organiser=$row_rr['organiser'];

$sql_arrmain=mysqli_query($link,"Select * from tblarrival where arrival_id='".$row_rr['arrival_id']."'") or die(mysqli_error($link));
$row_arrmain=mysqli_fetch_array($sql_arrmain);

$ardt=$row_arrmain['arrival_date'];
	$trdate=$ardt;
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;

$ardt=explode("-",$row_arrmain['arrival_date']);
$trdate24=$ardt[0]."-".$ardt[1]."-".$ardt[2];
$cdt24=date("Y-m-d");
		
if(trdate!="")
{
$date1 = strtotime($trdate24);
$date2 = strtotime($cdt24);//time();
$diff=dateDiff(date('Y-m-d H:i:s',$date1),date('Y-m-d H:i:s',$date2));
}
else
{
$diff="";	
}	 

$ccnntt++;
if($tot_arr_home > 0)			
{

$data1[$d]=array($d,$trdate,$crop,$spcf,$spcm,$lotno,$nob,$qty,$qc,$got,$ploc,$farmer,$organiser,$diff); 
$d++;
}
}
}

//},$per,$sstatus


# coading ends here............
/**/

/**/echo implode($datahead2) ;
echo "\n";
/*echo implode($datahead1) ;
echo "\n";
echo implode("\t", $datatitle1) ;
echo "\n";*/
/*echo implode("\t", $datatitle3) ;
echo "\n";*/

echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;