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
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		
	$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$dat=date("Y-m-d");	
	$sd=explode("-",$dat);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	
	$dh="Crop_Variety_wise_Stock_Report_As_on_".$stdate;
	$datahead = array("Crop Variety wise Stock Report As on - ".$stdate);
	$filename=$dh.".xls";   
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$d=1;
	$datahead1= array("Crop:$crp     Variety:$ver");
	$datahead2= array("#","Crop","Veriety","Raw Seed Qty","Condition Seed Qty","Pack Seed Qty","Sales Return Qty","Total Qty"); 

$sql_istbl=mysqli_query($link,"select * from tmp_vwcrsrep where plantcode='$plantcode' AND logid='".$logid."' order by crop asc, variety asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_istbl))
	{ 
		$crop1=""; $verty="";$tqty=0;$totrqty=0;$totcqty=0;$totpqty=0;$totsrqty=0;
		$crop1=$row_issuetbl['crop']; 
		$verty=$row_issuetbl['variety']; 
		$totrqty=$row_issuetbl['rsqty']; 
		$totcqty=$row_issuetbl['csqty']; 
		$totpqty=$row_issuetbl['psqty']; 
		$totsrqty=$row_issuetbl['srqty']; 
		$tqty=$row_issuetbl['totqty']; 

		$data1[$d]=array($d,$crop1,$verty,$totrqty,$totcqty,$totpqty,$totsrqty,$tqty); 
		$d++;
		$sql_rep="update tmp_vwcrsrep  set repflg=0 where tid='".$row_issuetbl['tid']."' and logid='$logid'";
		$ins=mysqli_query($link,$sql_rep) or die(mysqli_error($link));
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