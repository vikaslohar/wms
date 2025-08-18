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
	
	date_default_timezone_set("Asia/Calcutta");
		
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
	
	$dat=date("d-m-Y h:i:s A");
	
	$dh="Quality_based_Stock_Report As on -  ".$dat;
	$datahead = array("Quality based Stock Report As on - ".$dat);
	$filename=$dh.".xls";  
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$d=1;
	$datahead1= array("Crop:$crp     Variety:$ver");
	$datahead4= array("OK and UT Qty includes both Germination and GOT based seed stocks");
	
	$datahead3= array('','','','OK Qty','UT Qty','BL Qty','Total Qty','OK Qty','UT Qty','BL Qty','Total Qty');
$datahead2= array('#','Crop','Veriety','Raw Seed','','','Condition Seed','','','Pack Seed');
$upsizes=""; $upsids=""; $bsps=""; $i=0;
	$sql_ups=mysqli_query($link,"Select * from tblups") or die(mysqli_error($link));
	$tot_ups=mysqli_num_rows($sql_ups);
	while($row_ups=mysqli_fetch_array($sql_ups))
	{
		$i++;
		$ups=$row_ups['ups']." ".$row_ups['wt'];
		
		array_push($datahead3,$ups);
		array_push($datahead2,'');
		if($upsizes!="")
			$upsizes=$upsizes.",".$ups;
		else
			$upsizes=$ups;
		if($upsids!="")
			$upsids=$upsids.",".$row_ups['uid'];
		else
			$upsids=$row_ups['uid'];
		
		$uid='$upsid'.$i;	
		if($bsps!="")
			$bsps=$bsps.",".$uid;
		else
			$bsps=$uid;	
	}
array_push($datahead2,'','','Sales Return Seed','','','Grand Total'); 
array_push($datahead3,'OK Qty','UT Qty','BL Qty','Total Qty','OK Qty','UT Qty','Total Qty','OK Qty','UT Qty','BL Qty','Total Qty'); 
$sql_istbl=mysqli_query($link,"select * from tmp_vwasrrep where logid='".$logid."' order by crop asc, variety asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_istbl))
	{ 
	
		$crop1=""; $verty=""; $totrqok=0; $totrqut=0; $totrgotbl=0; $totrqty=0; $totcqok=0; $totcqut=0; $totcgotbl=0; $totcqty=0; $totpqok=0; $totpqut=0; $totpgotbl=0; $totpqty=0; $totsrqok=0; $totsrqut=0; $totsrqty=0; $totqok=0; $totqut=0; $totgotbl=0; $tqty=0;
		
		$crop1=$row_issuetbl['crop']; 
		$verty=$row_issuetbl['variety']; 
		$totrqok=$row_issuetbl['rsok']; 
		$totrqut=$row_issuetbl['rsut']; 
		$totrgotbl=$row_issuetbl['rsbl']; 
		$totrqty=$row_issuetbl['rstotal']; 
		$totcqok=$row_issuetbl['csok']; 
		$totcqut=$row_issuetbl['csut']; 
		$totcgotbl=$row_issuetbl['csbl']; 
		$totcqty=$row_issuetbl['cstotal']; 
		$totpqok=$row_issuetbl['psok']; 
		$totpqut=$row_issuetbl['psut']; 
		$totpgotbl=$row_issuetbl['psbl']; 
		$totpqty=$row_issuetbl['pstotal']; 
		$totsrqok=$row_issuetbl['srok']; 
		$totsrqut=$row_issuetbl['srut']; 
		$totsrqty=$row_issuetbl['srtotal']; 
		$totqok=$row_issuetbl['gtok']; 
		$totqut=$row_issuetbl['gtut']; 
		$totgotbl=$row_issuetbl['gtbl']; 
		$tqty=$row_issuetbl['gttotal']; 
		
		$data1[$d]=array($d,$crop1,$verty,$totrqok,$totrqut,$totrgotbl,$totrqty,$totcqok,$totcqut,$totcgotbl,$totcqty);
		$up=explode(",",$upsizes);
		$ct=count($up);
		for($i=0; $i<$ct; $i++)
		{
			$uidd=$ui[$i];
			$upsize=$up[$i];
			$sql_istblsub=mysqli_query($link,"select * from tmp_vwasrrep2 where plantcode='$plantcode' AND tid='".$row_issuetbl['tid']."' and upssize='".$upsize."'") or die(mysqli_error($link)); 
			while($row_issuetblsub=mysqli_fetch_array($sql_istblsub))
			{ 
			$uidd=$row_issuetblsub['upsval'];
			array_push($data1[$d],$uidd);
			}
		}
		array_push($data1[$d],$totpqok,$totpqut,$totpgotbl,$totpqty,$totsrqok,$totsrqut,$totsrqty,$totqok,$totqut,$totgotbl,$tqty); 
		
		$d++;
	}
}

echo implode($datahead) ;
echo "\n";
echo implode($datahead1) ;
echo "\n";
echo implode($datahead4) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}