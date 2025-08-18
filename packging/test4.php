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
	
$sql_arr_home2=mysqli_query($link,"SELECT unpkg_id, unpkgsub_lotno FROM where plantcode='$plantcode' tbl_unpkgsub") or die(mysqli_error($link));
echo $tot_arr_home2=mysqli_num_rows($sql_arr_home2);
$t=1;
//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$sqlvsriety=mysqli_query($link,"Select lotldg_id from tbl_lot_ldg_pack where plantcode='$plantcode' and trtype='UNPACKAGING' and lotldg_id='".$row_arr_home2['unpkg_id']."'") or die(mysqli_error($link));
		if($totvariety=mysqli_num_rows($sqlvsriety)==0)
		{
			$rowvariety=mysqli_fetch_array($sqlvsriety);
			//echo $t." ";
			echo $row_arr_home2['unpkgsub_lotno'];
			echo "<br>";$t++;
		}
		/*echo "<br>";
		else
		echo $row_arr_home2['lotldg_variety'];
		echo "<br>";echo "<br>";*/
	}
}
echo $t;
 /*echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>