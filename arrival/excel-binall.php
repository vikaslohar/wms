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
	set_time_limit(0);
	if(isset($_REQUEST['txtslwhg1']))
	{
	  $whid = $_REQUEST['txtslwhg1'];
	}
	else
	{
	$whid =1;
	}
		
		
	
	$dh="Bin_wise_SLOC_Status";
	$datahead = array("Bin wise SLOC Status");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

		$cnt=1;
$sid="ALL";		
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname,binid from tbl_bin where whid='".$whid."' and plantcode='$plantcode' order by binid asc") or die(mysqli_error($link));
$zx=mysqli_num_rows($sql_binn);
while($row_binn=mysqli_fetch_array($sql_binn))
{
$bid=$row_binn['binid'];

$subbinn="ALL";
$d=1;
$wh=$row_whouse['perticulars']."/".$row_binn['binname']."/".$subbinn;
	$datahead1[$cnt] = array("SLOC:$wh");
	$datahead2[$cnt] = array("#","Subbin","Crop","Variety","Lot Number","NoB","Qty","Stage","Moisture %","QC","DOT","GOT Status"); 

 	$sql_tb="select lotldg_subbinid, lotldg_variety, lotldg_crop,lotldg_lotno from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and plantcode='$plantcode' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid";  

  $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_variety='".$row_tbl['lotldg_variety']."' and lotldg_crop='".$row_tbl['lotldg_crop']."'  and lotldg_lotno='".$row_tbl['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
  $t1=mysqli_num_rows($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and plantcode='$plantcode' and lotldg_balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_class=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_tbl_sub['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_tbl_sub['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$varchk=$row_crop['cropname']."-"."Coded";
$varchk2=$row_crop['cropname']."-"."Unidentified";
$varty="";
if($row_tbl_sub['lotldg_variety']!=$varchk && $row_tbl_sub['lotldg_variety']!=$varchk2)
{		
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_veriety);
	$varty=$row_variety['popularname'];
}
else
{
$varty=$row_tbl_sub['lotldg_variety'];
}

$gotr=explode(" ",$row_tbl_sub['lotldg_got1']);
$gotresult=$gotr[0]." ".$row_tbl_sub['lotldg_got'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$bid."' and whid='".$whid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];

 	$tdate=$row_tbl_sub['lotldg_qctestdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
if($tdate == "00-00-0000")
$tdate="";
$sname=$row_subbinn['sname'];
$crname=$row_crop['cropname'];
$ltno=$row_tbl_sub['lotldg_lotno'];
$sstage=$row_tbl_sub['lotldg_sstage'];
$moist=$row_tbl_sub['lotldg_moisture'];
$qcr=$row_tbl_sub['lotldg_qc'];

if($total_tbl > 0)
{
$data1[$cnt][$d]=array($d,$sname,$crname,$varty,$ltno,$slups,$slqty,$sstage,$moist,$qcr,$tdate,$gotresult); 
$d++;
}
}
}
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
	