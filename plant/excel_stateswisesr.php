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
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
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
	
	$dh="Periodical_State_wise_Sales_Return_Report";
	$datahead = array("Periodical State wise Sales Return Report");
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
	$sql_srretm2=mysqli_query($link,"select Distinct salesr_state from tbl_salesrv where salesr_state='".$txtstatesl."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return'AND plantcode='$plantcode'") or die(mysqli_error($link));
else
	$sql_srretm2=mysqli_query($link,"select Distinct salesr_state from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' AND plantcode='$plantcode'") or die(mysqli_error($link));
$tot_srretm2=mysqli_num_rows($sql_srretm2);
while($row_srretm2=mysqli_fetch_array($sql_srretm2))
{
	if($txtpp!="ALL")
		$sqlsrretm=mysqli_query($link,"select distinct salesr_partytype from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$txtpp."' and salesr_state='".$row_srretm2['salesr_state']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
	else
		$sqlsrretm=mysqli_query($link,"select distinct salesr_partytype from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_state='".$row_srretm2['salesr_state']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
	$totsrretm=mysqli_num_rows($sqlsrretm);
	while($rowsrretm=mysqli_fetch_array($sqlsrretm))
	{

		$mid="";
		$sql_srretm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$rowsrretm['salesr_partytype']."' and salesr_state='".$row_srretm2['salesr_state']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_srretm=mysqli_num_rows($sql_srretm);
		while($row_srretm=mysqli_fetch_array($sql_srretm))
		{
	
		if($mid!="")
		$mid=$mid.",".$row_srretm['salesr_id'];
		else
		$mid=$row_srretm['salesr_id'];
		}
		
		if($mid==""){$mid='NULL';
		$sqlsrrets2="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesr_id=$mid AND plantcode='$plantcode'";}
		else{
		$sqlsrrets2="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesr_id IN ($mid) AND plantcode='$plantcode'";}

			//$sqlsrrets2="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where salesr_id='".$row_srretm['salesr_id']."' ";
			if($crop!="ALL")
			{
				$sqlsrrets2.=" and salesrs_crop='".$crop."' ";
			}
			if($variety!="ALL")
			{
				$sqlsrrets2.=" and salesrs_variety='".$variety."' ";
			}
			$sqlsrrets2.="  order by salesrs_crop, salesrs_variety ";
			$sql_srrets2=mysqli_query($link,$sqlsrrets2) or die(mysqli_error($link));
			while($row_srrets2=mysqli_fetch_array($sql_srrets2))
			{
				
				$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $ups="";
				if($mid==""){$mid='NULL';
					$sql_srretsub="select * from tbl_salesrv_sub where salesr_id=$mid and salesrs_variety='".$row_srrets2['salesrs_variety']."' AND plantcode='$plantcode'";}
				else{
					$sql_srretsub="select * from tbl_salesrv_sub where salesr_id IN ($mid) and salesrs_variety='".$row_srrets2['salesrs_variety']."' AND plantcode='$plantcode'";}
				$sql_srretsub2=mysqli_query($link,$sql_srretsub) or die(mysqli_error($link));
				while($row_srretsub2=mysqli_fetch_array($sql_srretsub2))
				{
					$diq2=explode(".",$row_srretsub2['salesrs_qtydc']);
					if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_srretsub2['salesrs_qtydc'];}
					$okqty=$okqty+$difq2;
					
					$diq3=explode(".",$row_srretsub2['salesrs_qtydamage']);
					if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_srretsub2['salesrs_qtydamage'];}
					$failqty=$failqty+$difq3;
						
					$totqty=$totqty+$difq2+$difq3;
				}
				$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets2['salesrs_crop']."'");
				$noticia = mysqli_fetch_array($quer3);
				$cropn=$noticia['cropname'];
						
				$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets2['salesrs_variety']."' and actstatus='Active'"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$varietyn=$noticia_item['popularname'];	
					
				$ups=$row_srrets['salesrs_ups'];
				$state=$row_srretm2['salesr_state'];
				$partytype=$rowsrretm['salesr_partytype'];

	if($totqty>0)					
	{
		$data1[$d]=array($d,$state,$partytype,$cropn,$varietyn,$totqty,$okqty,$failqty);
		$d++;$cnt++;
	}
	}
	}
	}
	if($cnt==0)
	{	
		$data1[$d]=array("","","","Record Not Found","","","","");
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
