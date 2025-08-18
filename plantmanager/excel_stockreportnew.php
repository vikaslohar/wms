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
	
	date_default_timezone_set('Asia/Calcutta');
	set_time_limit(0);	
	ini_set("memory_limit","5000M");
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$slchk = $_REQUEST['slchk'];
	$slchk2 = $_REQUEST['slchk2'];
	$sdate = $_REQUEST['sdate'];
	$txtplant = $_REQUEST['txtplant'];
	if($txtplant=="Boriya"){$plantcode='B';}
	if($txtplant=="Deorjhal"){$plantcode='D';}
	if($txtplant=="Bandamailaram"){$plantcode='H';}
		
	$platc="";
	if($txtplant!="ALL" && $txtplant!="Bandamailaram")
	{
		$platc=" and plantcode='$plantcode' ";
	}
	
	//$dat=date("d-m-Y H:i:s");	
	
	$dh="Stock_Report_as_on_".$sdate;
	$datahead = array("Stock Report as on ".$sdate);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	$sd=explode("-",$sdate);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	
		$d=1;
		$datahead1= array("Crop:",$crpn,"Variety:",$vern,"Plant:",$plant);
		$datahead2= array("#","Crop","Variety","","","Deorjhal Plant","","","","","Boriya Plant","","","","","Bandamailaram Plant","","","","","All Plant Total","",""); 
		$datahead3= array("","","","Raw Seed Qty","Condition Seed Qty","Pack Seed Qty","Sales Return Qty","Total Qty","Raw Seed Qty","Condition Seed Qty","Pack Seed Qty","Sales Return Qty","Total Qty","Raw Seed Qty","Condition Seed Qty","Pack Seed Qty","Sales Return Qty","Total Qty","Raw Seed Qty","Condition Seed Qty","Pack Seed Qty","Sales Return Qty","Total Qty"); 
	
$sql_istbl=mysqli_query($link,"select * from tmp_pmstrep where replogid='".$logid."'  order by id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_istbl))
	{ 
	
	$crop1=""; $verty=""; $drawqty=0; $dconqty=0; $dpackqty=0; $dsrqty=0; $dtotalqty=0; $brawqty=0; $bconqty=0; $bpackqty=0; $bsrqty=0; $btoaltqty=0; $hrawqty=0; $hconqty=0; $hpackqty=0; $hsrqty=0; $htotalqty=0; $grawqty=0; $gconqty=0; $gpackqty=""; $gsrqty=0; $gtotalqty=0;
	
	
	$crop1=$row_issuetbl['crop']; 
	$verty=$row_issuetbl['variety']; 
	
	$drawqty=$row_issuetbl['drawqty']; 
	$dconqty=$row_issuetbl['dconqty']; 
	$dpackqty=$row_issuetbl['dpackqty']; 
	$dsrqty=$row_issuetbl['dsrqty']; 
	$dtotalqty=$row_issuetbl['dtotalqty']; 
	
	$brawqty=$row_issuetbl['brawqty']; 
	$bconqty=$row_issuetbl['bconqty']; 
	$bpackqty=$row_issuetbl['bpackqty']; 
	$bsrqty=$row_issuetbl['bsrqty']; 
	$btoaltqty=$row_issuetbl['btoaltqty']; 
	
	$hrawqty=$row_issuetbl['hrawqty']; 
	$hconqty=$row_issuetbl['hconqty']; 
	$hpackqty=$row_issuetbl['hpackqty']; 
	$hsrqty=$row_issuetbl['hsrqty']; 
	$htotalqty=$row_issuetbl['htotalqty']; 
	
	$grawqty=$row_issuetbl['grawqty']; 
	$gconqty=$row_issuetbl['gconqty']; 
	$gpackqty=$row_issuetbl['gpackqty']; 	
	$gsrqty=$row_issuetbl['gsrqty']; 	
	$gtotalqty=$row_issuetbl['gtotalqty']; 	

$data1[$d]=array($d,$crop1, $verty, $drawqty, $dconqty, $dpackqty, $dsrqty, $dtotalqty, $brawqty, $bconqty, $bpackqty, $bsrqty, $btoaltqty, $hrawqty, $hconqty, $hpackqty, $hsrqty, $htotalqty, $grawqty, $gconqty, $gpackqty, $gsrqty, $gtotalqty); 
$d++;
	$sql_rep="update tmp_pmstrep  set repflg=0 where id='".$row_issuetbl['id']."' and replogid='$logid'";
	$ins=mysqli_query($link,$sql_rep) or die(mysqli_error($link));
}
}


echo implode($datahead);
echo "\n";
echo implode("\t", $datahead1);
echo "\n";
echo implode("\t", $datahead2);
echo "\n";
echo implode("\t", $datahead3);
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
