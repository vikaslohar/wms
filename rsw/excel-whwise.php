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
	
	$txtslwhg = $_REQUEST['txtslwhg'];
	$txtslbing = $_REQUEST['txtslbing'];
	$txtslsubbing2 = $_REQUEST['txtslsubbing2'];
		
	$bin="ALL"; $sbin="ALL";
	
	if($txtslbing!="ALL" && $txtslsubbing2!="ALL")
	{	
	$qry.="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_sstage='Raw' and lotldg_subbinid='$txtslsubbing2' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
	}
	else if($txtslbing!="ALL" && $txtslsubbing2=="ALL")
	{	
	$qry.="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_sstage='Raw' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
	}
	else
	{
	$qry.="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_sstage='Raw' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
	}
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	
	$dh="Warehouse_wise_Report";
	$datahead = array("Warehouse wise Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

		$cnt=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$txtslwhg."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_arr_home1['lotldg_binid']."' and whid='".$txtslwhg."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin=$row_binn['binname'];

if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$bid."' and whid='".$whid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin=$row_subbinn1['sname'];
}

		$d=1;
$wh=$row_whouse['perticulars'];
$datahead1[$cnt] = array("WH:$wh","Bin:$bin","Sub-Bin:$sbin");
$datahead2[$cnt] = array("Subbin","Lot No.","Crop","Variety","Stage","NoB","Qty","Qc Status","Moisture %","Germination %","DOT","GOT Status","Seed Status"); 

if($txtslsubbing2=='ALL')
{ 
  $sql_tb="select distinct(lotldg_subbinid) from tbl_lot_ldg where lotldg_whid='".$txtslwhg."' and lotldg_binid='".$row_arr_home1['lotldg_binid']."' and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_subbinid";  
}
 else
{
$sql_tb="select distinct(lotldg_subbinid) from tbl_lot_ldg where lotldg_whid='".$txtslwhg."' and lotldg_binid='".$row_arr_home1['lotldg_binid']."' and lotldg_subbinid='".$txtslsubbing2."'  and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_subbinid";  
 }

$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  

while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$txtslwhg."' and lotldg_binid='".$row_arr_home1['lotldg_binid']."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_sstage='Raw' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id desc") or die(mysqli_error($link));  
$t1=mysqli_num_rows($sql_tbl1);
while($row_tbl1=mysqli_fetch_array($sql_tbl1))
{

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_sstage='Raw' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_arr_home1['lotldg_binid']."' and whid='".$txtslwhg."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

		  
	$lrole=$row_tbl_sub['arr_role'];
	$arrival_id=$row_tbl_sub['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

				
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		$stage=$row_tbl_sub['lotldg_sstage'];
		$qc=$row_tbl_sub['lotldg_qc'];
		$moist=$row_tbl_sub['lotldg_moisture'];
		$gemp=$row_tbl_sub['lotldg_gemp'];
		$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
		$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
		$sststus=$row_tbl_sub['lotldg_sstatus'];
		$stage=$row_tbl_sub['lotldg_sstage'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($sststus!="")$sststus=$sststus."/"."S";
			else
			$sststus="S";
		}
		$trdate1=$row_tbl_sub['lotldg_qctestdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		$tot_variety=mysqli_num_rows($sql_variety);
		if($tot_variety>0)
		{
		$variet=$row_variety['popularname'];
		}
		else
		{
		$variet=$row_tbl_sub['lotldg_variety'];
		}	
if($gemp==0)$gemp="";
if($moist==0)$moist="";
if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
$subbin=$row_subbinn['sname'];
$crop=$row_crop['cropname'];

$data1[$cnt][$d]=array($subbin,$lotno,$crop,$variet,$stage,$bags,$qty,$qc,$trdate1,$moist,$gemp,$got,$sststus); 
$d++;
}
}
}
}
if($d==1)
$data1[$cnt][$d]=array("","","",""."","","Empty Bin","","","","","",""); 
$cnt++;
}


echo implode($datahead) ;
echo "\n";
for($i=1; $i<$cnt; $i++)
{
	echo implode($datahead1[$i]) ;
	echo "\n";
	echo implode("\t", $datahead2[$i]) ;
	echo "\n";
foreach($data1[$i] as $row1)
 { 
	echo implode("\t", array_values($row1))."\n"; 
 }
}
	