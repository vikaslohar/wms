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
	
	ini_set("memory_limit","100M");
$cnt=0;
$sql_arr_home=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' order by sid asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		 $subbinid=$row_arr_home25['sid'];
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$subbinid."' and lotldg_binid!='".$row_arr_home25['binid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$cnt++; echo $subbinid."-LDG-".$rowmonth3['orlot']."<br />";
		}
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where subbinid='".$subbinid."' and binid!='".$row_arr_home25['binid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$cnt++; echo $subbinid."-Pack-".$rowmonth3['orlot']."<br />";
		}
	}
}
//echo $sbid;
/* echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>