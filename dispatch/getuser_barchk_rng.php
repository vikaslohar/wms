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
	

if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$b = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$tid = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	$vrids = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$upids = trim($_GET['g']);	 
}
if(isset($_GET['l']))
{
	$itmno = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	$eupstpy = $_GET['m'];	 
}
if(isset($_GET['n']))
{
	$barcodefrom = $_GET['n'];	 
}
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$vrids' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];

$verids=$vt;
$upsids=$upids;
$flg=0;

$sqlbarcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode1=mysqli_num_rows($sqlbarcode1);
$rowbarcode1=mysqli_fetch_array($sqlbarcode1);
if($totbarcode1==0)$flg=1;

$sqlbarcode11=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$barcodefrom."' and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode11=mysqli_num_rows($sqlbarcode11);
$rowbarcode11=mysqli_fetch_array($sqlbarcode11);
if($totbarcode11==0)$flg=1;

$sqlbarcode2=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and (mpmain_dflg=1 OR mpmain_spremflg=1) and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode2=mysqli_num_rows($sqlbarcode2);
if($totbarcode2>0){if($flg==0)$flg=2;}

$sqlbarcode22=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$barcodefrom."' and (mpmain_dflg=1 OR mpmain_spremflg=1) and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode22=mysqli_num_rows($sqlbarcode22);
if($totbarcode22>0){if($flg==0)$flg=2;}

$sqlbarcode3=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_dflg=2 and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode3=mysqli_num_rows($sqlbarcode3);
if($totbarcode3>0){if($flg==0)$flg=3;}

$sqlbarcode33=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$barcodefrom."' and mpmain_dflg=2 and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode33=mysqli_num_rows($sqlbarcode33);
if($totbarcode33>0){if($flg==0)$flg=3;}

$sqlbarcode4=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_upflg=1 and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode4=mysqli_num_rows($sqlbarcode4);
if($totbarcode4>0){if($flg==0)$flg=9;}

$sqlbarcode44=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$barcodefrom."' and mpmain_upflg=1 and bar_bctyp='range'") or die(mysqli_error($link));
$totbarcode44=mysqli_num_rows($sqlbarcode44);
if($totbarcode44>0){if($flg==0)$flg=9;}

$vr1=$rowbarcode1['mpmain_variety'];
$ui1=$rowbarcode1['mpmain_upssize'];
$uitp=$rowbarcode1['mpmain_trtype'];
if($vr1!=$verids){if($flg==0)$flg=4;} 
if($ui1!=$upids){if($flg==0)$flg=5;}
if($eupstpy!="")
{
	$utpy="";
	if($uitp=="PACKSMC" || $uitp=="PACKLMC")$utpy="ST";
	if($uitp=="PACKNMC" || $uitp=="PACKNLC")$utpy="NST";
	if($eupstpy!=$utpy){if($flg==0)$flg=5;}
}
/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_porderno='$a'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$arrivalid=$row_month['orderm_id'];
$sql_mon=mysqli_query($link,"select * from tbl_order_sub where orderm_id='".$arrivalid."' order by order_sub_crop")or die("Error:".mysqli_error($link));*/
 
$dt=date("Y-m-d");
	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and bar_bctyp='range'") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	if($tot_barcode1>0)
	{
		$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes plantcode='".$plantcode."' and where bar_barcode='".$b."' and bar_bctyp='range'") or die(mysqli_error($link));
		$totbarcode=mysqli_num_rows($sqlbarcode);
		$rowbarcode=mysqli_fetch_array($sqlbarcode);
		$grweight=$rowbarcode['bar_grosswt'];
	}
	
	$lotno=$row_barcode1['mpmain_lotno'];

$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno' and packtype='$ui1' order by lotdgp_id DESC") or die(mysqli_error($link));
$tot_lot2=mysqli_num_rows($sql_lot2);
$row_lot2=mysqli_fetch_array($sql_lot2);

$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where lplantcode='".$plantcode."' and otdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
$tot_lot=mysqli_num_rows($sql_lot);
$row_lot=mysqli_fetch_array($sql_lot);

$diff = abs(strtotime($row_lot['lotldg_valupto']) - strtotime($dt));
$days = floor($diff / (60*60*24));
if($days<=30){if($flg==0)$flg=8;}

$sql_spc=mysqli_query($link,"select * from tbl_lemain where plantcode='".$plantcode."' and le_lotno='".$lotn."'") or die(mysqli_error($link));
$row_spc=mysqli_fetch_array($sql_spc);
if($xx=mysqli_num_rows($sql_spc)>0)
{
	$diff = abs(strtotime($row_lot['le_upto']) - strtotime($dt));
	$days = floor($diff / (60*60*24));
	if($days<=30){if($flg==0)$flg=8;}
}

if($row_lot['lotldg_resverstatus'] > 0){if($flg==0)$flg=10;}

$zz=explode(" ", $row_lot['lotldg_got1']);
if($row_lot['lotldg_got']=="BL")
$flg=7;
if($row_lot['lotldg_qc']=="BL")
$flg=7;
if($zz[0]=="GOT-NR")
{
	if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
	{
		if($flg==0)$flg=6;
	}
	if(($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
	{
		if($flg==0)$flg=7;
	}
}
else
{
	if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
	{
		if($flg==0)$flg=6;
	} 
	if(($row_lot['lotldg_got']=="UT" || $row_lot['lotldg_got']=="RT") && $row_lot['lotldg_srflg']==0)
	{
		if($flg==0)$flg=7;
	}
}
?>
<input type="hidden" name="brflg" value="<?php echo $flg;?>" /><input type="hidden" name="brchflg" value="1" />