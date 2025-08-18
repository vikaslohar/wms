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
$id="txtwtpdn".$b;
$wtpd="";
$bcwtsql=mysqli_query($link,"SELECT mpmain_wtmp from tbl_mpmain where mpmain_barcode='$a' and plantcode='$plantcode' order by mpmain_barcode Asc ") or die(mysqli_error($link));
if($tot=mysqli_num_rows($bcwtsql) > 0)
$rowbcwt=mysqli_fetch_array($bcwtsql);
$wtpd=$rowbcwt['mpmain_wtmp'];
?><input name="txtwtpdn" id="<?=$id?>" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="<?=$wtpd?>" />