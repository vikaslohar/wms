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
	
$sql_arr_home2=mysqli_query($link,"SELECT distinct lotno FROM tbl_lot_ldg_pack WHERE plantcode='$plantcode' and trtype='PSWSUO' or trtype='PSWSUC'") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);

if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$gemp="";
		$sql_ck=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and trtype='PSWSUO' and lotno='".$row_arr_home2['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_ck);
		
		$sql_ck1=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and trtype='PSWSUC' and lotno='".$row_arr_home2['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
		$t1=mysqli_num_rows($sql_ck1);
		if($t1>$t)
		{
			while($row_ck=mysqli_fetch_array($sql_ck))
			{
				$tid=$row_ck['lotdgp_id'];
				$dt=$row_ck['lotldg_valupto'];
				echo $row_arr_home2['lotno']."<br/>";
			}
		}
	}
}


?>