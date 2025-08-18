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
	
	$dh="Periodical_State_wise_Sales_Return_Report";
	$datahead = array("Periodical State wise Sales Return Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	
	$datahead1 = array("Period From: ",$sdate,"To: ",$edate);
	$datahead2 = array("State: ",$txtstatesl);
	$datahead3 = array("Crop:$crp     Variety:$variet");
	$datahead4 = array("#","Crop","Variety","Total Qty","OK Qty","Fail Qty","UT Qty"); 
	
$mid=""; $cnt=0; $d=1;
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_state='".$txtstatesl."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' ") or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
if($mid!="")
$mid=$mid.",".$row_srretm['salesr_id'];
else
$mid=$row_srretm['salesr_id'];
}

if($mid==""){$mid='NULL';
$sqlsrrets="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id=$mid ";}
else{
$sqlsrrets="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id IN ($mid) ";}

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
$tot_arr_home=mysqli_num_rows($sql_srrets);
while($row_srrets=mysqli_fetch_array($sql_srrets))
{
$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $lotnp="";
$sql_srretsub25=mysqli_query($link,"select distinct salesrs_rettype from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id IN ($mid) and salesrs_vflg=1") or die(mysqli_error($link));

while($row_srretsub25=mysqli_fetch_array($sql_srretsub25))
{
$sql_srretsub2=mysqli_query($link,"select distinct salesrs_newlot from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_rettype='".$row_srretsub25['salesrs_rettype']."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id IN ($mid) and salesrs_vflg=1") or die(mysqli_error($link));
$tr=mysqli_num_rows($sql_srretsub2);
while($row_srretsub2=mysqli_fetch_array($sql_srretsub2))
{
	$ltno=$row_srretsub2['salesrs_newlot'];
	$ltno="'$ltno'";
	if($row_srretsub25['salesrs_rettype']=="P2C")
	{
		if($lotnc!="")
			$lotnc=$lotnc.",".$ltno;
		else
			$lotnc=$ltno;
	}
	if($row_srretsub25['salesrs_rettype']=="P2P")
	{
		if($lotnp!="")
			$lotnp=$lotnp.",".$ltno;
		else
			$lotnp=$ltno;
	}
}	
}
//echo $lotnc;
$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id IN ($mid) and salesrs_vflg=1") or die(mysqli_error($link));
while($row_srretsub=mysqli_fetch_array($sql_srretsub))
{
	/*$sql_srretss=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_srretsub['salesrs_id']."'") or die(mysqli_error($link));
	while($row_srretss=mysqli_fetch_array($sql_srretss))
	{
		if($row_srretsub['salesrs_qc']=="OK") 
		$okqty=$okqty+$row_srretss['salesrss_qty']; 
		
		if($row_srretsub['salesrs_qc']=="Fail") 
		$failqty=$failqty+$row_srretss['salesrss_qty'];
		
		if($row_srretsub['salesrs_qc']=="UT") 
		$utqty=$utqty+$row_srretss['salesrss_qty'];
	}*/
	
	$sql_srretss2=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_srretsub['salesrs_id']."'") or die(mysqli_error($link));
	while($row_srretss2=mysqli_fetch_array($sql_srretss2))
	{
		/*if($row_srretsub['salesrs_qc']=="OK") 
		$okqty=$okqty+$row_srretss2['salesrss_qty']; 
		
		if($row_srretsub['salesrs_qc']=="Fail") */
		$failqty=$failqty+$row_srretss2['salesrss_qty'];
		
		/*if($row_srretsub['salesrs_qc']=="UT") 
		$utqty=$utqty+$row_srretss2['salesrss_qty'];*/
	}
}
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets['salesrs_crop']."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets['salesrs_variety']."' "); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	if($lotnc!="")
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$row_srrets['salesrs_crop']."' and lotldg_variety='".$row_srrets['salesrs_variety']."' and lotldg_lotno IN($lotnc) and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trtype='Sales Return' order by lotldg_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						if($row_issuetbl['lotldg_qc']=="OK") 
						$okqty=$okqty+$row_issuetbl['lotldg_balqty']; 
						
						if($row_issuetbl['lotldg_qc']=="Fail") 
						$failqty=$failqty+$row_issuetbl['lotldg_balqty'];
						
						if($row_issuetbl['lotldg_qc']=="UT") 
						$utqty=$utqty+$row_issuetbl['lotldg_balqty'];
					}
				}
			}
		}
	}
	
	if($lotnp!="")
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$row_srrets['salesrs_crop']."' and lotldg_variety='".$row_srrets['salesrs_variety']."' and lotno IN($lotnp) and balqty > 0 and trtype='Sales Return' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0 and trtype='Sales Return' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and trtype='Sales Return' order by lotdgp_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0 and trtype='Sales Return' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						if($row_issuetbl['lotldg_qc']=="OK") 
						$okqty=$okqty+$row_issuetbl['balqty']; 
						
						if($row_issuetbl['lotldg_qc']=="Fail") 
						$failqty=$failqty+$row_issuetbl['balqty'];
						
						if($row_issuetbl['lotldg_qc']=="UT") 
						$utqty=$utqty+$row_issuetbl['balqty'];
					}
				}
			}
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
