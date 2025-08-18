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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$b = $_GET['b'];	 
}
$extbar="";
$sql_month=mysqli_query($link,"select mpmain_barcode from tbl_mpmain where plantcode='$plantcode' and mpmain_crop='".$b."' and mpmain_variety='".$a."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0 and mpmain_rvflg=0 order by mpmain_barcode Asc")or die(mysqli_error($link));
while($row_month=mysqli_fetch_array($sql_month))
{
if($extbar!="")
$extbar=$extbar.",".$row_month['mpmain_barcode'];
else
$extbar=$row_month['mpmain_barcode'];
}
?><input type="hidden" name="extbarcod" value="<?php echo $extbar;?>" />