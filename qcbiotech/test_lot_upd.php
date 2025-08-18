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

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where lotno='' order by tid asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	$sq="update tbl_qctest set trstage='Raw' WHERE SUBSTRING(lotno,17,1)='R' and (trstage='' or trstage IS NULL)";
	$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
	$sq1="update tbl_qctest set trstage='Condition' WHERE SUBSTRING(lotno,17,1)='C' and (trstage='' or trstage IS NULL)";
	$xc1=mysqli_query($link,$sq1) or die(mysqli_error($link));
	$sq2="update tbl_qctest set trstage='Pack' WHERE SUBSTRING(lotno,17,1)='P' and (trstage='' or trstage IS NULL)";
	$xc2=mysqli_query($link,$sq2) or die(mysqli_error($link));
}
 echo "<script>alert('Stage Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>