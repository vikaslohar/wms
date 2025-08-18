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
$id="barcvaldchk".$b;
$wtpd="ok";
$tot_mpmain=0; $tot_pnpslipbarcodes=0;
$sql_mpmain=mysqli_query($link,"select mpmain_barcode from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$a."'")or die(mysqli_error($link));
$tot_mpmain=mysqli_num_rows($sql_mpmain);

/*$sql_btsl=mysqli_query($link,"select btslsub_barcode from tbl_btslsub where btslsub_barcode='".$a."'")or die(mysqli_error($link));
$tot_btsl=mysqli_num_rows($sql_btsl);*/

/*$sql_barcodes=mysqli_query($link,"select bar_barcode from tbl_barcodes where bar_barcode='".$a."'")or die(mysqli_error($link));
$tot_barcodes=mysqli_num_rows($sql_barcodes);

$sql_barcodestmp=mysqli_query($link,"select bar_barcodes from tbl_barcodestmp where bar_barcodes='".$a."'")or die(mysqli_error($link));
$tot_barcodestmp=mysqli_num_rows($sql_barcodestmp);*/

$sql_pnpslipbarcodes=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_barcode='".$a."'")or die(mysqli_error($link));
$tot_pnpslipbarcodes=mysqli_num_rows($sql_pnpslipbarcodes);

//if($tot_mpmain>0 || $tot_btsl>0 || $tot_barcodes>0 || $tot_barcodestmp>0 || $tot_pnpslipbarcodes>0)$wtpd='fail';
if($tot_mpmain>0 || $tot_pnpslipbarcodes>0)$wtpd='fail';
?><input name="barcvaldchk" id="<?php echo $id?>" type="hidden" value="<?php echo $wtpd?>"  />