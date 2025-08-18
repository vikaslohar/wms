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

	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['trid']))
	{
	$trid = $_REQUEST['trid'];
	}
$sql_sub=mysqli_query($link,"select * from tbl_softr_sub where softrsub_id='".$pid."' and softr_id='".$trid."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);
$lotno=$row_sub['softrsub_lotno'];

$s_sub="delete from tbl_softr_sub where softrsub_id='".$pid."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$sql_t_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$trid."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
if($tot_sub == 0)
{
$s_sub_sub="delete from tbl_softr where softr_id='".$trid."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));
}
$x="";
$sql_main="update tbl_lot_ldg set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$lotno'";
mysqli_query($link,$sql_main) or die(mysqli_error($link));
$sql_main2="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$lotno'";
mysqli_query($link,$sql_main2) or die(mysqli_error($link));
//exit;
echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	
?>