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
	
	ini_set("memory_limit","80M");
	
$sql_arr_home=mysqli_query($link,"select distinct(lotldg_lotno) from tbl_lot_ldg where orlot='' OR orlot IS NULL  order by lotldg_lotno asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		$ltno=$row_arr_home['lotldg_lotno'];
		
		$sq="update tbl_qctest set oldlot=SUBSTRING('$ltno',1,16) WHERE lotno='$ltno'";
		$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
		$sq1="update tbl_lot_ldg set orlot=SUBSTRING('$ltno',1,16) WHERE lotldg_lotno='$ltno'";
		$xc1=mysqli_query($link,$sq1) or die(mysqli_error($link));
		$sq2="update tblarrival_sub set orlot=SUBSTRING('$ltno',1,16) WHERE lotno='$ltno'";
		$xc2=mysqli_query($link,$sq2) or die(mysqli_error($link));
		//echo "<br />";
	}
	
}
$s1="update `tblarrival_sub` set orlot=SUBSTRING(orlot,1,16) WHERE SUBSTRING(orlot,17,1)='R'";
$x1=mysqli_query($link,$s1) or die(mysqli_error($link));
$s2="update `tblarrival_sub` set orlot=SUBSTRING(orlot,1,16) WHERE SUBSTRING(orlot,17,1)='C'";
$x2=mysqli_query($link,$s2) or die(mysqli_error($link));
$s3="update `tblarrival_sub` set orlot=SUBSTRING(orlot,1,16) WHERE SUBSTRING(orlot,17,1)='P'";
$x3=mysqli_query($link,$s3) or die(mysqli_error($link));
$s4="update `tbl_lot_ldg` set orlot=SUBSTRING(orlot,1,16) WHERE SUBSTRING(orlot,17,1)='R'";
$x4=mysqli_query($link,$s4) or die(mysqli_error($link));
$s5="update `tbl_lot_ldg` set orlot=SUBSTRING(orlot,1,16) WHERE SUBSTRING(orlot,17,1)='C'";
$x5=mysqli_query($link,$s5) or die(mysqli_error($link));
$s6="update `tbl_lot_ldg` set orlot=SUBSTRING(orlot,1,16) WHERE SUBSTRING(orlot,17,1)='P'";
$x6=mysqli_query($link,$s6) or die(mysqli_error($link));
$s7="update `tbl_qctest` set oldlot=SUBSTRING(oldlot,1,16) WHERE SUBSTRING(oldlot,17,1)='R'";
$x7=mysqli_query($link,$s7) or die(mysqli_error($link));
$s8="update `tbl_qctest` set oldlot=SUBSTRING(oldlot,1,16) WHERE SUBSTRING(oldlot,17,1)='C'";
$x8=mysqli_query($link,$s8) or die(mysqli_error($link));
$s9="update `tbl_qctest` set oldlot=SUBSTRING(oldlot,1,16) WHERE SUBSTRING(oldlot,17,1)='P'";
$x9=mysqli_query($link,$s9) or die(mysqli_error($link));
//exit;
 echo "<script>alert('Sample No Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>