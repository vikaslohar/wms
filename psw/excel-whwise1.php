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
		
	$wh="ALL"; $bin="ALL"; $sbin="ALL";$wh1="ALL"; $bin1="ALL"; $sbin1="ALL";
	if($txtslwhg!='ALL')
	{ 
	if($txtslbing!="ALL" && $txtslsubbing2!="ALL")
	{	
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and subbinid='$txtslsubbing2' and binid='$txtslbing' and whid='$txtslwhg' order by whid";
	}
	else if($txtslbing!="ALL" && $txtslsubbing2=="ALL")
	{	
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and binid='$txtslbing' and whid='$txtslwhg' order by whid";
	}
	else
	{
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and whid='$txtslwhg' order by whid";
	}
	}
	else
	{
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' order by whid";
	}
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

if($txtslwhg!='ALL')
{ 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$txtslwhg."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wh1=$row_whouse['perticulars'];
}
if($txtslbing!='ALL')
{ 	
$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$txtslbing."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin1=$row_binn['binname'];
}	
if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$txtslsubbing2."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin1=$row_subbinn1['sname'];
}
	
	
	$dh="Warehouse_wise_Pack_Seed_Report";
	$datahead = array("Warehouse wise Pack Seed Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	$datahead1 = array("WH:$wh1  Bin:$bin1  Sub-Bin:$sbin1");
$cnt=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wh=$row_whouse['perticulars'];
if($txtslbing!='ALL')
{ 
$sql_binp=mysqli_query($link,"Select Distinct binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and binid='$txtslbing' and whid='".$row_arr_home1['whid']."' order by binid") or die(mysqli_error($link));
}
else
{
$sql_binp=mysqli_query($link,"Select Distinct binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and whid='".$row_arr_home1['whid']."' order by binid") or die(mysqli_error($link));
}
$tt=mysqli_num_rows($sql_binp);
while($row_binp=mysqli_fetch_array($sql_binp))
{

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_binp['binid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin=$row_binn['binname'];

if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$txtslsubbing2."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin=$row_subbinn1['sname'];
}

$d=1;
$datahead2[$cnt] = array("WH:$wh","Bin:$bin");
$datahead3[$cnt] = array("Subbin","Lot No.","Crop","Variety","Size","Qty"); 

if($txtslsubbing2=='ALL')
{ 
$sql_tb="select distinct(subbinid) from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' and binid='".$row_binp['binid']."' and lotldg_sstage='Pack' order by subbinid";  
}
else
{
$sql_tb="select distinct(subbinid) from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' and binid='".$row_binp['binid']."' and subbinid='".$txtslsubbing2."'  and lotldg_sstage='Pack' order by subbinid";  
}

$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  

while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' and binid='".$row_binp['binid']."' and subbinid='".$row_tbl['subbinid']."' and lotldg_sstage='Pack' group by lotno order by lotdgp_id desc") or die(mysqli_error($link));  
$t1=mysqli_num_rows($sql_tbl1);
while($row_tbl1=mysqli_fetch_array($sql_tbl1))
{
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_tbl1[0]."' and lotldg_sstage='Pack' and balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl['subbinid']."' and binid='".$row_binp['binid']."' and whid='".$row_arr_home1['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

$crop=""; $variety=""; $lotno=""; $upssize=""; $qty="";

$aq=explode(".",$row_tbl_sub['balnop']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['balnop'];}

$an=explode(".",$row_tbl_sub['balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['balqty'];}

		$lotno=$row_tbl_sub['lotno'];
		$bags=$ac;
		$qty=$acn;
		$upssize=$row_tbl_sub['packtype']; 

		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."'") or die(mysqli_error($link));
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
$subbin=$row_subbinn['sname'];
$crop=$row_crop['cropname'];

$data1[$cnt][$d]=array($subbin,$lotno,$crop,$variet,$upssize,$qty); 
$d++;
}
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
echo implode($datahead1) ;
echo "\n";
for($i=1; $i<$cnt; $i++)
{
	echo implode("\t", $datahead2[$i]) ;
	echo "\n";
	echo implode("\t", $datahead3[$i]) ;
	echo "\n";
foreach($data1[$i] as $row1)
 { 
	echo implode("\t", array_values($row1))."\n"; 
 }
}
	