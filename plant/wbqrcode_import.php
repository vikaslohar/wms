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
$sql_arr_home=mysqli_query($link,"select * from bvqrcode order by QR_Code_External asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sqlmonth3=mysqli_query($link,"select wb_extqrcode from tbl_wbqrcode where wb_extqrcode='".$row_arr_home25['QR_Code_External']."'   ")or die("Error:".mysqli_error($link));
		$tot3=mysqli_num_rows($sqlmonth3);
		if($tot3==0) 
		{
			echo $sql_itmg="INSERT INTO tbl_wbqrcode (wb_extqrcode, wb_intqrcode) VALUES('".$row_arr_home25['QR_Code_External']."','".$row_arr_home25['QR_Code_Internal']."')";
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