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
 $ddate = $_REQUEST['ddate'];
 $sftyp = $_REQUEST['sftyp'];
 $itemid = $_REQUEST['txtcrop'];
 $vv = $_REQUEST['txtvariety'];
 $status = $_REQUEST['qcstatus'];
		
if($sftyp=="periodical")
{	 
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;
	
	$tdate=$edate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;
	if($itemid!="ALL" && $vv!="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv=="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_crop='".$itemid."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
}
else
{		
	$tdate=$ddate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$ddate=$tyear."-".$tmonth."-".$tday;
	if($itemid!="ALL" && $vv!="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv=="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_crop='".$itemid."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
}
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$var="ALL"; $crp="ALL";
if($itemid!="ALL")
{
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
	$row_dept=mysqli_fetch_array($quer2);
	$crp=$row_dept['cropname'];
}
if($vv!="ALL")
{
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
	$row_dept4=mysqli_fetch_array($quer4);
	$var=$row_dept4['popularname'];
}

$dh="Soft Release Status Report".$_REQUEST['sdate'];
$datahead = array($dh);
$datahead2 = array("Soft Release Status Report As on Date",$_REQUEST['sdate']);

$data1 = array();
$filename=$dh.".xls";  
	  //exit;
header("Content-Disposition: attachment; filename=$filename"); 
header("Content-Type: application/vnd.ms-excel");
//$datatitle1 = array("Preliminary QC");
$datatitle2 = array("#","Crop","Variety","Lot No. ","Qty","Dispatch Qty","SR Date","SR Status","QC Status","DoT");

$d=1;

if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['softr_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['softr_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $type=""; $remarks="";
	
		$sql_crop=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='".$row_arr_home['softr_crop']."'"); 
		$row_crop=mysqli_fetch_array($sql_crop);
		$crop=$row_crop['cropname'];

		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['softr_variety']."' "); 
		$row_var=mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
if($sftyp=="periodical")
{	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$arrival_id."' and and softrsub_srflg='1' and softrsub_srtyp!='condition' and  softrsub_srtyp!='raw' ") or die(mysqli_error($link));
}
else
{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$arrival_id."' and softrsub_srflg='1' and softrsub_srtyp!='condition' and  softrsub_srtyp!='raw' ") or die(mysqli_error($link));
}	
$subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$totqty=0; $totnob=0; $dqty=0; $qcstatus=""; $dot="";
if($status=="fail")
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 and lotldg_qc='Fail'") or die(mysqli_error($link));
}
else if($status=="ok")
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 and lotldg_qc='OK'") or die(mysqli_error($link));
}
else if($status=="RT/UT")
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 and (lotldg_qc='RT' or lotldg_qc='UT')") or die(mysqli_error($link));
}
else
{
//echo "select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 ";
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 ") or die(mysqli_error($link));
}
$row_issue_num=mysqli_num_rows($sql_issue);
while($row_issue=mysqli_fetch_array($sql_issue))
{ 

if($status=="fail")
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and lotldg_whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and lotldg_qc='Fail'") or die(mysqli_error($link));
}
if($status=="ok")
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and lotldg_qc='OK'") or die(mysqli_error($link));
}
else if($status=="RT/UT")
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and (lotldg_qc='RT' or lotldg_qc='UT')") or die(mysqli_error($link));
}
else
{
//echo "select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."'";
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."'") or die(mysqli_error($link));
}
//$row_issue1_num=mysqli_num_rows($sql_issue1);
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo "select * from tbl_lot_ldg_pack where lotldg_id='".$row_issue1[0]."' and balqty > 0";
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnomp'];
	//if($row_issuetbl['trtype']=="Qty-Rem" || $row_issuetbl['trtype']=="Dispatch" || $row_issuetbl['trtype']=="Dispatch TDF")
	//$dqty=$dqty+$row_issuetbl['tqty']; 
}
}
$sql_dqty=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$row_tbl_sub['softrsub_lotno']."'") or die(mysqli_error($link));
while($row_dqty=mysqli_fetch_array($sql_dqty))
{
	if($row_dqty['trtype']=="Qty-Rem" || $row_dqty['trtype']=="Dispatch" || $row_dqty['trtype']=="Dispatch TDF")
	$dqty=$dqty+$row_dqty['tqty'];  
}

$sql_is=mysqli_query($link,"select * from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."' order by lotdgp_id desc limit 0,1") or die(mysqli_error($link));
$row_is=mysqli_fetch_array($sql_is);
$qcstatus=$row_is['lotldg_qc']; 
$dot=$row_is['lotldg_qctestdate'];

$trdate1=$row_is['lotldg_qctestdate'];
$tryear=substr($trdate1,0,4);
$trmonth=substr($trdate1,5,2);
$trday=substr($trdate1,8,2);
$dot=$trday."-".$trmonth."-".$tryear;


$aq=explode(".",$totqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$totqty;}

$an=explode(".",$totnob);
if($an[1]==000){$acn=$an[0];}else{$acn=$totnob;}

		$lotno=$row_tbl_sub['softrsub_lotno'];
		$type=$row_tbl_sub['softrsub_srtyp'];
		$bags=$acn;
		$qty=$ac;
if($sftyp=="periodical")
{
	if($row_tbl_sub['softrsub_srflg']==0)
	$remarks="Completed";
	else
	$remarks="In Progress";
}
else
{
$remarks="In Progress";
} 

if($row_issue_num>0)
{
$data1[$d]=array($d,$crop,$variety,$lotno,$qty,$dqty,$trdate,$type,$qcstatus,$dot); 
$d++;
}
}
}
}
# coading ends here............
/*echo implode($datahead1) ;
echo "\n";*/
echo implode($datahead2) ;
echo "\n";

/*echo implode("\t", $datatitle1) ;
echo "\n";*/
/*echo implode("\t", $datatitle3) ;
echo "\n";*/

echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;