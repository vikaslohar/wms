<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
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
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	 $sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
 	
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
		
		$sql_arr_home=mysqli_query($link,"select * from tbllotimp where lotimpdate <='$edate' and  lotimpdate >='$sdate' order by lotimpdate asc ") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
			
		$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
		$row_month=mysqli_fetch_array($quer6);
		$a=$row_month['code'];
 	  
	$dh="Import_Acknowledgement_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	//$datahead1 = array("");
	$datahead2 = array("Import Acknowledgement Period From ".$_REQUEST['sdate']." To ".$_REQUEST['edate']);
	$data1 = array();
	
function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	   
	    # file name for download $filename = "Order Details.xls";
		
	    $filename=$dh.".csv";  
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$filename"); 
		//header("Content-Type: application/vnd.ms-excel"); 
	 $datatitle3 = array("#","Lot Number","Imp. Date"," Plant Code");
$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotimpdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;

	$lotno=$row_arr_home['lotnumber'];

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$lotno,$trdate,$a); 
$d++;
}
}

# coading ends here............

echo implode($datahead2);
echo "\n";
echo implode(",", $datatitle3);
echo "\n";
foreach($data1 as $row1)
 { 
 	#array_walk($row1, 'cleanData'); 
	echo implode(",", array_values($row1))."\n"; 
 }