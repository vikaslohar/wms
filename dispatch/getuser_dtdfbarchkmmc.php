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

$flg=0;
$sqlbarcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."'") or die(mysqli_error($link));
$totbarcode1=mysqli_num_rows($sqlbarcode1);
	if($totbarcode1>0)$flg=1;
	
$sqlbarcode2=mysqli_query($link,"Select * from tbl_barcodes where plantcode='".$plantcode."' and bar_barcode='".$b."'") or die(mysqli_error($link));
$totbarcode2=mysqli_num_rows($sqlbarcode2);
	if($totbarcode2>0)$flg=1;
	
$sqlbarcode23=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dmmc_barcode='".$b."'") or die(mysqli_error($link));
$totbarcode23=mysqli_num_rows($sqlbarcode23);
	if($totbarcode23>0)$flg=1;	
?>
<input type="hidden" name="brflg" value="<?php echo $flg;?>" /><input type="hidden" name="brchflg" value="1" />