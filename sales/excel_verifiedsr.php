<?php
	ob_start();session_start();
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
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtptype=$_REQUEST['txtptype'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	{$txtpp="C&F";}
	$txtppname=trim($_REQUEST['txtppname']);
	$txtcity=trim($_REQUEST['txtcity']);
	
	
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	
	$crp="ALL"; $variet="ALL";  $cityname="ALL"; $partyname="ALL";
	
	if($crop!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$crp=$row31['cropname'];		
	}
	if($variety!="ALL")
	{
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
			$rowvv=mysqli_fetch_array($sql_variety);
			$variet=$rowvv['popularname'];
		}
		else
		{
			$variet=$variety;
		}
	}
	if($txtcity!="ALL")
	{
		$quer3=mysqli_query($link,"select productionlocation from tblproductionlocation where productionlocationid='".$txtcity."'");
		$noticia = mysqli_fetch_array($quer3);
		$cityname=$noticia['productionlocation'];
	}
	if($txtppname!="ALL")
	{
		$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser where p_id='".$txtppname."'");
		$noticia = mysqli_fetch_array($quer3);
		$partyname=$noticia['business_name'];
	}
	
	$dh="Periodical_Verified_Sales_Return_Report";
	$datahead = array("Periodical Verified Sales Return Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	
	$datahead1 = array("Period From: ",$sdate,"To: ",$edate);
	$datahead2 = array("State: ",$txtstatesl,"Location: ",$cityname);
	$datahead3 = array("Party Type: ",$txtpp,"Party Name: ",$partyname);
	$datahead4 = array("Crop: ",$crp,"Variety: ",$variet);
	$datahead5 = array("#","SR Transaction ID","Crop","Variety","UPS","NoP/NoB","Qty"); 
	
$mid=""; $cnt=0; $d=1;

$sq="select salesr_id from tbl_salesrv where plantcode='$plantcode'and salesr_date<='".$edt."' and salesr_date>='".$sdt."'  and salesr_flg=1 and salesr_vflg=1 ";
if($txtstatesl!="ALL")
{
$sq.=" AND salesr_state='".$txtstatesl."'  ";
}
if($txtcity!="ALL")
{
$sq.=" and salesr_loc='".$txtcity."'  ";
}
if($txtpp!="ALL")
{
$sq.="  and salesr_partytype='".$txtpp."' ";
}
if($txtppname!="ALL")
{
$sq.=" and salesr_party='".$txtppname."' ";
}
$sq.=" order by salesr_id ASC ";
$sql_srretm=mysqli_query($link,$sq) or die(mysqli_error($link));

$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
if($mid!="")
$mid=$mid.",".$row_srretm['salesr_id'];
else
$mid=$row_srretm['salesr_id'];
}
//echo $mid;
if($mid==""){$mid='NULL';
$sqlsrrets="select distinct salesrs_variety, salesrs_ups, salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id=$mid ";}
else{
$sqlsrrets="select distinct salesrs_variety, salesrs_ups, salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id IN ($mid) ";}

if($crop!="ALL")
{
$sqlsrrets.=" and salesrs_crop='".$crop."' ";
}
if($variety!="ALL")
{
$sqlsrrets.=" and salesrs_variety='".$variety."' ";
}
$sqlsrrets.="  and salesrs_vflg=1 group by salesrs_variety, salesrs_ups order by salesrs_crop, salesrs_variety, salesrs_ups ";
$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
while($row_srrets=mysqli_fetch_array($sql_srrets))
{

$sql_srretsub2=mysqli_query($link,"select salesr_slrno, salesr_id, salesr_yearcode, salesr_logid from tbl_salesrv where salesr_id IN ($mid) ") or die(mysqli_error($link));
while($row_srretsub2=mysqli_fetch_array($sql_srretsub2))
{ 
$lotnp=""; $srnno=''; $cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $ups='';
	$srnno="SR".$row_srretsub2['salesr_slrno']."/".$row_srretsub2['salesr_yearcode']."/".$row_srretsub2['salesr_logid'];
	
$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_variety='".$row_srrets['salesrs_variety']."' and salesrs_ups= '".$row_srrets['salesrs_ups']."'and salesr_id='".$row_srretsub2['salesr_id']."' and salesrs_vflg=1") or die(mysqli_error($link));
while($row_srretsub=mysqli_fetch_array($sql_srretsub))
{
	$lotnp=$lotnp+$row_srretsub['salesrs_nob'];
	$totqty=$totqty+$row_srretsub['salesrs_qty'];
}	
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets['salesrs_crop']."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets['salesrs_variety']."' "); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	$ups=$row_srrets['salesrs_ups'];
	
if($totqty>0)	
{
	
		$data1[$d]=array($d,$srnno,$cropn,$varietyn,$ups,$lotnp,$totqty);
		$d++;$cnt++;
}
}

	if($cnt==0)
	{	
		$data1[$d]=array("","","","Record Not Found","","","");
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
echo implode("\t", $datahead4) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
