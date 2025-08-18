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
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtptype=$_REQUEST['txtptype'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	$txtpp="C&F";
	
	
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	
	$crp="ALL"; $variet="ALL";
	
	if($crop!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$crp=$row31['cropname'];		
	}
	if($variety!="ALL")
	{
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
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
	
	$dh="Periodical_Party_Type_wise_Sales_Return_Report";
	$datahead = array("Periodical Party Type wise Sales Return Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	
	$datahead1 = array("Period From: ",$sdate,"To: ",$edate);
	$datahead2 = array("State: ",$txtstatesl,"Party Type: ",$txtpp);
	$datahead3 = array("Crop: ",$crp,"Variety: ",$variet);
	$datahead4 = array("#","Crop","Variety","Total Qty","OK Qty","Fail Qty","UT Qty"); 
	
$mid=""; $cnt=0; $d=1;
if($txtstatesl!="ALL")
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where salesr_state='".$txtstatesl."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$txtpp."' AND plantcode='$plantcode'") or die(mysqli_error($link));
else
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$txtpp."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
if($mid!="")
$mid=$mid.",".$row_srretm['salesr_id'];
else
$mid=$row_srretm['salesr_id'];
}

if($mid==""){$mid='NULL';
$sqlsrrets="select distinct salesrs_variety from tbl_salesrv_sub where salesr_id=$mid AND plantcode='$plantcode'";}
else{
$sqlsrrets="select distinct salesrs_variety from tbl_salesrv_sub where salesr_id IN ($mid) AND plantcode='$plantcode'";}

if($crop!="ALL")
{
$sqlsrrets.=" and salesrs_crop='".$crop."' ";
}
if($variety!="ALL")
{
$sqlsrrets.=" and salesrs_variety='".$variety."' ";
}
$sqlsrrets.="  and salesrs_vflg=1 group by salesrs_variety order by salesrs_crop, salesrs_variety ";
$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
while($row_srrets=mysqli_fetch_array($sql_srrets))
{
$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $lotnp="";
$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id IN ($mid) and salesrs_vflg=1 AND plantcode='$plantcode'") or die(mysqli_error($link));
while($row_srretsub=mysqli_fetch_array($sql_srretsub))
{
	if($row_srretsub['salesrs_qc']=="OK") 
	$okqty=$okqty+$row_srretsub['salesrs_qtydc']; 
		
	if($row_srretsub['salesrs_qc']=="Fail") 
	$failqty=$failqty+$row_srretsub['salesrs_qtydc'];
		
	if($row_srretsub['salesrs_qc']=="UT" || $row_srretsub['salesrs_qc']=="RT") 
	$utqty=$utqty+$row_srretsub['salesrs_qtydc'];

	$failqty=$failqty+$row_srretsub['salesrs_qtydamage'];
		
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srretsub['salesrs_crop']."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srretsub['salesrs_variety']."'"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
}
}		

	$totqty=$okqty+$failqty+$utqty;
	if($tot_arr_home > 0)
	{	
		$data1[$d]=array($d,$cropn,$varietyn,$totqty,$okqty,$failqty,$utqty);
		$d++;$cnt++;
	}
	if($cnt==0)
	{	
		$data1[$d]=array("","","","Record Not Found","","","");
	}
//}
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
