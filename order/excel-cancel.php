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
	
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }

	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
	$tdate2=explode("-",$edate);
	$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];
		
	$dh="Cancel_Order_Report_Period_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array("Cancel Order Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	$cnt=1;
$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and order_candate<='$edate' and order_candate>='$sdate' and orderm_cancelflag=1 order by order_candate asc ") or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

	
		$datahead1= array("Period From ".$_REQUEST['sdate']." To ".$_REQUEST['edate']);
		$datahead2= array("#","Date","Order No","Party Name"); 
		
		$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['order_candate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	
	$orno=""; $party=""; 
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party'] > 0)
	$party=$row3['business_name'];
	else
	$party=$row_arr_home['orderm_partyname'];
	
	$orno=$row_arr_home['orderm_porderno'];
		if($tot_arr_home > 0)
		{ 
		$data1[$d]=array($d,$trdate,$orno,$party); 
		$d++;
		}
}

		echo implode($datahead) ;
		echo "\n";
		echo implode($datahead1) ;
		echo "\n";
		echo implode("\t", $datahead2) ;
		echo "\n";
		foreach($data1 as $row1)
		 { 
			echo implode("\t", array_values($row1))."\n"; 
		 }