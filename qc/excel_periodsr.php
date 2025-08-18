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
	$txtpname=$_REQUEST['txtpname'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	$txtlocaion=$_REQUEST['txtlocaion'];
	$txtups=$_REQUEST['txtups'];
	$txtsrnno=$_REQUEST['txtsrnno'];
	
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	{$txtpp="C&F";}
	
	$sd=split("-",$sdate);
	$ed=split("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	
	$crp="ALL"; $variet="ALL"; $locname="ALL"; $pname="ALL"; $srnno="ALL";
	
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
	if($txtlocaion!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocaion."' order by productionlocation") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$locname=$row31['productionlocation'];		
	}
	if($txtpname!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtpname."' order by business_name") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$pname=$row31['business_name'];		
	}	
	if($txtsrnno!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tbl_salesrv where salesr_id='$txtsrnno' order by salesr_yearcode Asc, salesr_slrno ASC") or die(mysqli_error($link));
		$row_tbl=mysqli_fetch_array($sql_crop);
		$srnno="SRN"."/".$row_tbl['salesr_yearcode']."/".sprintf("%00005d",$row_tbl['salesr_slrno']);
	}	
	
	$dh="Periodical_Sales_Return_Report";
	$datahead = array("Periodical Sales Return Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	
	$datahead1 = array("Period From: ",$sdate,"To: ",$edate);
	$datahead2 = array("State: ",$txtstatesl,"Location: ",$locname);
	$datahead3 = array("Party Type: ",$txtpp,"Party Name: ",$pname);
	$datahead4 = array("Crop: ",$crp,"Variety: ",$variet);
	$datahead5 = array("UPS wise: ",$txtups,"SRN No.: ",$srnno);
	$datahead6 = array("#","Date","Party Type","Party Name","Location","SRN No.","State","Crop","Veriety","Lot No."); 
	 if($txtups=="Yes")
	 {
	 array_push($datahead6,"UPS");
	 }
	array_push($datahead6,"Total Qty","Actual Received Qty","Damage Qty","Ex.(+)/ Sh.(-) Qty","QC Status","QC DoT","Moist. %","Germ. %");
	
$mid=""; $cnt=0; $d=1;

$sq="select * from tbl_salesrv where salesr_trtype='Sales Return' ";
if($txtstatesl!="ALL")
$sq.=" and salesr_state='".$txtstatesl."' ";
if($txtlocaion!="ALL")
$sq.=" and salesr_loc='".$txtlocaion."' ";
if($txtpp!="ALL")
$sq.=" and salesr_partytype='".$txtpp."' ";
if($txtpname!="ALL")
$sq.=" and salesr_party='".$txtpname."' ";
if($txtsrnno!="ALL")
$sq.=" and salesr_id='".$txtsrnno."' ";

$sq.=" order by salesr_id ASC ";
$sql_srretm=mysqli_query($link,$sq) or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
	$mid=$row_srretm['salesr_id'];
	//echo $mid;
	if($txtups=="Yes")
	$sqlsrrets="select distinct salesrs_variety, salesrs_crop, salesrs_ups, salesrs_newlot, salesrs_id from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesr_id=$mid  and salesrs_vflg=1 ";
	else
	$sqlsrrets="select distinct salesrs_variety, salesrs_crop, salesrs_newlot, salesrs_id from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesr_id=$mid  and salesrs_vflg=1 ";
	
	if($crop!="ALL")
	{
		$sqlsrrets.=" and salesrs_crop='".$crop."' ";
	}
	if($variety!="ALL")
	{
		$sqlsrrets.=" and salesrs_variety='".$variety."' ";
	}
	if($txtups=="Yes")
	{
		//$sqlsrrets.=" group by salesrs_ups,salesrs_variety   ";
	}
	$sqlsrrets.="  order by salesrs_variety ";
	$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
	while($row_srrets=mysqli_fetch_array($sql_srrets))
	{
		$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $lotnp=""; $ups='';
		
		
		if($txtups=="Yes")
		{
			$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesrs_ups='".$row_srrets['salesrs_ups']."' and salesr_id='".$mid."' and salesrs_vflg=1 and salesrs_id='".$row_srrets['salesrs_id']."' ") or die(mysqli_error($link));
		}
		else
		{	
		$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id='".$mid."' and salesrs_vflg=1 and salesrs_id='".$row_srrets['salesrs_id']."' ") or die(mysqli_error($link));
		}
		while($row_srretsub=mysqli_fetch_array($sql_srretsub))
		{
			if($row_srretsub['salesrs_typ']=="verrec") 
			$totqty=$totqty+$row_srretsub['salesrs_qty'];
			$okqty=$okqty+$row_srretsub['salesrs_qtydc']; 
			$failqty=$failqty+$row_srretsub['salesrs_qtydamage'];
			
			$ups=$row_srretsub['salesrs_ups'];
			
			$tdate=$row_srretsub['salesrs_dovfy'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$trdate=$tday."-".$tmonth."-".$tyear;
		}	
	
		$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets['salesrs_crop']."'");
		$noticia = mysqli_fetch_array($quer3);
		$cropn=$noticia['cropname'];
		
		$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets['salesrs_variety']."' "); 
		$noticia_item = mysqli_fetch_array($quer4);
		$varietyn=$noticia_item['popularname'];
		
		/*$sql_srretsub2=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$rowsrretsub['salesr_id']."' and salesr_vflg=1") or die(mysqli_error($link));
		$row_srretsub2=mysqli_fetch_array($sql_srretsub2);*/
		
		//$ltno=$row_srretsub2['salesrs_newlot'];
		
		
		/*$tdate=$row_srretm['salesr_date'];
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$trdate=$tday."-".$tmonth."-".$tyear;*/
		$lotnos=$row_srrets['salesrs_newlot'];
		$ptype=$row_srretm['salesr_partytype'];
		
		$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_srretm['salesr_party']."' order by business_name")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month24);
		$panme=$noticia['business_name'];
		
		$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
		$noticia240 = mysqli_fetch_array($sql_month240);
		$locn=$noticia240['productionlocation'];
		if($ptype=="Export Buyer")
		$locn=$row_srretm['salesr_loc'];
		
		$srn_no="SRN"."/".$row_srretm['salesr_yearcode']."/".sprintf("%00005d",$row_srretm['salesr_slrno']);	
		$srstate=$row_srretm['salesr_state'];			
		//$totqty=$okqty+$failqty+$utqty;
		$exshqty=($okqty+$failqty)-$totqty;
		
		$qcsts=''; $dot=''; $germp=''; $moistp='';
		$sql_lot_ldg=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$row_srrets['salesrs_orlot']."' order by lotldg_id desc") or die(mysqli_error($link));
		$row_lot_ldg=mysqli_fetch_array($sql_lot_ldg);
		$tddate=explode("-",$row_lot_ldg['lotldg_qctestdate']);
		$dot=$tddate[2]."-".$tddate[1]."-".$tddate[0];
		if($dot=="00-00-0000" || $dot=="- -" || $dot=="--") {$dot="";}
		$qcsts=$row_lot_ldg['lotldg_qc'];
		$germp=$row_lot_ldg['lotldg_gemp']; 
		$moistp=$row_lot_ldg['lotldg_moisture'];

	if($totqty>0 || $okqty>0)						
	{
		$data1[$d]=array($d,$trdate,$ptype,$panme,$locn,$srn_no,$srstate,$cropn,$varietyn,$lotnos);
		if($txtups=="Yes")
		{
		array_push($data1[$d],$ups);
		}
		array_push($data1[$d],$totqty,$okqty,$failqty,$exshqty,$qcsts,$dot,$germp,$moistp);
		$d++;$cnt++;
	}
	}
	}
	if($cnt==0)
	{	
		$data1[$d]=array("","","","","","Record Not Found","","","","","","");
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
echo implode("\t", $datahead5) ;
echo "\n";
echo implode("\t", $datahead6) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
