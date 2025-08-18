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
$t=0; $qty=0;
	
$sql_arr_home1=mysqli_query($link,"select gottest_tid  from tbl_gottest where gottest_crop IN (24,59) and plantcode='$plantcode' order by gottest_tid  asc") or die(mysqli_error($link));
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);
if($tot_arr_home1 >0) 
{
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_arr_home=mysqli_query($link,"select gottest_tid from tbl_gottestsub where gottest_tid='".$row_arr_home1['gottest_tid']."' and gottests_type='IN-SITU' and plantcode='$plantcode' order by gottest_tid asc") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
		if($tot_arr_home >0) 
		{
			while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
			{
				echo $row_arr_home25['gottest_tid'];
				echo "<br />";
				//$t++;
			}
		}
	}
}
exit;
 /*echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>