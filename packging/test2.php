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
	
$sql_arr_home2=mysqli_query($link,"SELECT * FROM tbl_lot_ldg WHERE plantcode='$plantcode' and lotldg_trtype='Sales Return' and lotldg_got1 IS NULL") or die(mysqli_error($link));
 $tot_arr_home2=mysqli_num_rows($sql_arr_home2);
$t=1;
//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
			//echo $t." ";
			$sql="update tbl_lot_ldg set lotldg_got1='GOT-NR OK', lotldg_got='OK', lotldg_gottestdate='".$row_arr_home2['lotldg_trdate']."' where lotldg_id='".$row_arr_home2['lotldg_id']."'";
			$sadf=mysqli_query($link,$sql) or die(mysqli_error($link));
			//echo $row_arr_home2['lotldg_variety']." - ".$noticia_item['varietyid'];
			/*echo "<br>";
			$t++;
		else
		echo $row_arr_home2['lotldg_variety'];
		echo "<br>";*/
	}
	
}
 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>