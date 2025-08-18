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
	$txtcountryl=$_REQUEST['txtcountryl'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	$locationname=$_REQUEST['locationname'];
	$txtstfp=$_REQUEST['txtstfp'];	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[0])."-".sprintf("%02d",$sd[1]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[0])."-".sprintf("%02d",$ed[1]);
if($txtptype!="Export Buyer")
	{
		$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$locationname."' order by productionlocation")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month);
		$location=$noticia['productionlocation'];
	}
	else
	{
		$sql_month=mysqli_query($link,"select * from tblcountry where country='".$locationname."' order by country")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month);
		$location=$noticia['country'];
	}
	$sql_month2=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtstfp."' order by business_name")or die(mysqli_error($link));
	$noticia2 = mysqli_fetch_array($sql_month2);
	$pty=$noticia2['business_name'];
	
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
	
	$dh="Periodical_Party_wise_Sales_Return_Arrival_Report";
	$datahead = array("Periodical Party wise Sales Return Arrival Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	
	$datahead1 = array("Period From: ",$sdate,"To: ",$edate);
	$datahead2 = array("State: ",$txtstatesl,"Location: ",$location);
	$datahead3 = array("Party Type: ",$txtptype,"Party: ",$pty);
	$datahead4 = array("Crop:$crp     Variety:$variet");
	$datahead5 = array("#","Crop","Variety","As per DC","","","As per Actuals","","","","","Ex.(+) / Sh.(-)"); 
	$datahead6 = array("","","","UPS","NoP/NoB","Qty","UPS","NoP","Total Qty","Good","Damage"); 
	
$mid=""; $cnt=0; $d=1;
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_party='".$txtstfp."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' ") or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
$mid=$row_srretm['salesr_id'];

$sqlsrrets="select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id=$mid";
if($crop!="ALL")
{
$sqlsrrets.=" and salesrs_crop='".$crop."' ";
}
if($variety!="ALL")
{
$sqlsrrets.=" and salesrs_variety='".$variety."' ";
}
$sqlsrrets.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_srrets);
while($row_tbl_sub=mysqli_fetch_array($sql_srrets))
{

	$totqty=0; $cropn=""; $varietyn="";$slups=""; $slnob=""; $slqty="";
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	$slups=$row_tbl_sub['salesrs_ups']; 
	$slnob=$row_tbl_sub['salesrs_nob']; 
	$slqty=$row_tbl_sub['salesrs_qty'];
	
	$diq=explode(".",$slqty);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}
	
	$din=explode(".",$slnob);
	if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
	/*$slocs="";
	$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
	while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
	{
	
	$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sloc=$wareh.$binn.$subbinn;
	if($slocs!="")
	$slocs=$slocs."<br/>".$sloc;
	else
	$slocs=$sloc;
	}*/
	
	if($row_tbl_sub['salesrs_upstype']=="Standard")
	$upstyp="ST";
	if($row_tbl_sub['salesrs_upstype']=="Non-Standard")
	$upstyp="NST";
	else
	$upstyp="ST";
	
	$tdate1=$row_tbl_sub['salesrs_dov'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$dov=$tday1."-".$tmonth1."-".$tyear1;
	
	$nob=0; $qty=0;
	
	
	$diq2=explode(".",$row_tbl_sub['salesrs_qtydc']);
	if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_tbl_sub['salesrs_qtydc'];}
	$din2=explode(".",$row_tbl_sub['salesrs_nobdc']);
	if($din2[1]==000){$difn2=$din2[0];}else{$difn2=$row_tbl_sub['salesrs_nobdc'];}
	
	$diq3=explode(".",$row_tbl_sub['salesrs_qtydamage']);
	if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_tbl_sub['salesrs_qtydamage'];}
	$din3=explode(".",$row_tbl_sub['salesrs_nobdamage']);
	if($din3[1]==000){$difn3=$din3[0];}else{$difn3=$row_tbl_sub['salesrs_nobdamage'];}
	
	$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
	$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
	
	$totqty=$difq2+$difq3;
	$exsh=($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;
	if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
	if($tot_arr_home > 0)
	{	
		$data1[$d]=array($d,$cropn,$varietyn,$slups,$nob,$qty,$slups,$difn2,$totqty,$difq2,$difq3,$exsh);
		$d++;$cnt++;
	}
}
	if($cnt==0)
	{	
		$data1[$d]=array("","","","","","Record Not Found","","","","","","");
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
echo implode("\t", $datahead5) ;
echo "\n";
echo implode("\t", $datahead6) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
