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
$sql_arr_home=mysqli_query($link,"select * from tblfarmernew and plantcode='$plantcode' order by farmerid asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sqlmonth3=mysqli_query($link,"select farmerid from tblfarmer where farmerid='".$row_arr_home25['farmerid']."'")or die("Error:".mysqli_error($link));
		$totarrhome=mysqli_num_rows($sqlmonth3);
		if($totarrhome==0) 
		{
			$rowmonth3=mysqli_fetch_array($sqlmonth3);
			$sql_itmg="INSERT INTO tblfarmer (farmerid, farmername, fathername, farmer_tcode, farmer_code, farmercode, productionlocationid) VALUES ('".$row_arr_home25['farmerid']."', '".$row_arr_home25['farmername']."', '".$row_arr_home25['fathername']."', '".$row_arr_home25['farmer_tcode']."', '".$row_arr_home25['farmer_code']."', '".$row_arr_home25['farmercode']."', '".$row_arr_home25['productionlocationid']."')";
			echo $sql_itmg."<br />";
			mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
			$cnt++; 
		}
	}
}
echo $cnt;
exit;
 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>