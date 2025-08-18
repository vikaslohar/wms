<?php
	ob_start();
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
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
	
	$sd=explode("-",$sdate);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$ed=explode("-",$edate);
	$etdate=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$dt2=date('Y-m-d',mktime(0,0,0,$sd[1],($sd[0]-1),$sd[2]));
		
	$crp="ALL"; $ver="ALL";
	
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	//$dat=date("d-m-Y H:i:s");	
	
	$dh="Periodical_Crop_Variety_wise_Stock_Ledger_Report_From_".$sdate."_To_".$edate;
	$datahead = array("Periodical Crop Variety wise Stock Ledger Report Period From ",$sdate," To ",$edate);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$d=1;
	$datahead1= array("Crop",$crp,"Variety",$ver);
	$datahead2= array("#","Crop","Veriety","Type","Opening Stock","","","","Inward Qty","","","","","","","Outward Qty","","","","","Closing Stock"); 
	$datahead3= array("","","","","","Fresh FRN","Sales Return","Stock Transfer (Plant)","Stock Transfer (C&F)","IVT In","CI","Total Qty","Sales","Purchase Return","Stock Transfer (Plant)","Stock Transfer (C&F)","TDF","IVT Out","Loss","Total Qty","");
	
$sql_istbl=mysqli_query($link,"select * from tmp_pmsldgrep where logid='".$logid."' and plantcode='$plantcode' order by crop asc, variety asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_istbl))
	{ 
	
	$crop1=""; $verty=""; $totfrn=0; $totsrn=0; $totstp=0; $totstcnf=0; $totinw=0; $totdisp=0; $totpret=0; $totstpo=0; $totstcnfo=0; $totloss=0; $tottdf=0; $tototw=0; $totopqty=0; $ccnt=0; $totclqty=0; $totivtin=0; $totivtout=0; $vtyp=""; $cirec=0;
	
	$crop1=$row_issuetbl['crop']; 
	$verty=$row_issuetbl['variety']; 
	$vtyp=$row_issuetbl['vertype']; 
	$totopqty=$row_issuetbl['opstock']; 
	$totfrn=$row_issuetbl['frnstock']; 
	$totsrn=$row_issuetbl['srinstock']; 
	$totstp=$row_issuetbl['stinplant']; 
	
	$totstcnf=$row_issuetbl['stincnf']; 
	$totivtin=$row_issuetbl['ivtin']; 
	$cirec=$row_issuetbl['cistock']; 
	$totinw=$row_issuetbl['totinstock']; 
	$totdisp=$row_issuetbl['salesstock']; 
	$totpret=$row_issuetbl['purretstock']; 
	$totstpo=$row_issuetbl['stoutplant']; 
	$totstcnfo=$row_issuetbl['stoutcnf']; 
	$tottdf=$row_issuetbl['tdfstock']; 
	$totivtout=$row_issuetbl['ivtout']; 
	$totloss=$row_issuetbl['totloss']; 
	$tototw=$row_issuetbl['totoutstock']; 
	$totclqty=$row_issuetbl['clstock']; 	

$data1[$d]=array($d,$crop1,$verty,$vtyp,$totopqty,$totfrn,$totsrn,$totstp,$totstcnf,$totivtin,$cirec,$totinw,$totdisp,$totpret,$totstpo,$totstcnfo,$tottdf,$totivtout,$totloss,$tototw,$totclqty); 
$d++;
	$sql_rep="update tmp_pmsldgrep  set repflg=0 where tid='".$row_issuetbl['tid']."' and logid='$logid'";
	$ins=mysqli_query($link,$sql_rep) or die(mysqli_error($link));
}
}


echo implode($datahead) ;
echo "\n";
echo implode("\t", $datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}