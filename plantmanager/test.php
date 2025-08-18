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
	
$sql_arr_home=mysqli_query($link,"select distinct(lotldg_lotno) from tbl_lot_ldg where orlot='' and plantcode='$plantcode' order by lotldg_lotno asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		$zzz=implode(",", str_split($row_arr_home['lotldg_lotno']));
		$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
		$sql="update tbl_lot_ldg set orlot='".$abc."' where lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and orlot='' ";
		$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
	}
}
 echo "<script>alert('orlot Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>