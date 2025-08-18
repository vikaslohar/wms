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
	
$sql_arr_home=mysqli_query($link,"SELECT * FROM tbl_qctest WHERE variety='' ORDER BY tid ASC") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{ 
		$crop=''; $variety='';
		$sql_user=mysqli_query($link,"select lotldg_crop, lotldg_variety from tbl_lot_ldg where orlot='".$row_arr_home['oldlot']."' ") or die(mysqli_error($link));
		if(mysqli_num_rows($sql_user)>0)
		{
			$row_user=mysqli_fetch_array($sql_user);
			$crop=$row_user['lotldg_crop']; 
			$variety=$row_user['lotldg_variety'];
		}
		else
		{
			$sql_user2=mysqli_query($link,"select lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where orlot='".$row_arr_home['oldlot']."' ") or die(mysqli_error($link));
			$row_user2=mysqli_fetch_array($sql_user2);
			$crop=$row_user2['lotldg_crop']; 
			$variety=$row_user2['lotldg_variety'];
		}
		if($crop!="" && $variety!="")
		{
			echo $sql_tbl_sub="update tbl_qctest set crop='".$crop."', variety='".$variety."' WHERE tid='".$row_arr_home['tid']."'";
			$zz=mysqli_query($link,$sql_tbl_sub) or die(mysqli_error($link));
			echo "<BR>";
		}	
	}
	
}
 
 ?>