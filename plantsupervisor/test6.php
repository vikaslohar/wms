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
	
$sql_arr_home=mysqli_query($link,"select distinct salesrs_orlot from tbl_salesrv_sub and plantcode='$plantcode' order by salesrs_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sqlmonth=mysqli_query($link,"SELECT *  FROM `tbl_salesrv_sub` WHERE `salesrs_orlot`='".$row_arr_home25['salesrs_orlot']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		$totarrhome=mysqli_num_rows($sqlmonth);
		if($totarrhome>1) 
		{
			while($rowmonth=mysqli_fetch_array($sqlmonth))
			{
				echo $rowmonth['salesr_id']." = ".$row_arr_home25['salesrs_orlot']." = ".$rowmonth['salesrs_qtydc']." = ".$totarrhome;
				echo "<br />";
			}
		}
	}
}
//echo $qty;
 /*echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>