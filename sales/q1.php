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

$sql_arr_home2=mysqli_query($link,"select *  from tbl_salesr_sub order where plantcode='$plantcode' by salesrs_id asc") or die(mysqli_error($link));
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
	$zzz=implode(",", str_split($row_arr_home2['salesrs_newlot']));
	$olotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
	
	$sql_sub="update tbl_salesr_sub set salesrs_orlot='$olotno' where salesrs_id='".$row_arr_home2['salesrs_id']."'";
	mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}

$sql_arr_home2=mysqli_query($link,"select *  from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trtype='Sales Return' order by lotldg_id asc") or die(mysqli_error($link));
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
	$zzz=implode(",", str_split($row_arr_home2['lotldg_lotno']));
	$olotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
	
	$lotno=$row_arr_home2['lotldg_lotno'];
	
	$sql_sub2="update tbl_qctest set lotno='$lotno', oldlot='$olotno' where oldlot='".$row_arr_home2['orlot']."'";
	mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
	
	$sql_sub="update tbl_lot_ldg set orlot='$olotno' where lotldg_id='".$row_arr_home2['lotldg_id']."'";
	mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}

?>