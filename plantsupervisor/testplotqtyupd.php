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
	
$sql_arr_home=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotno IN ('HX80010/00000/00P','HX80013/00000/00P','HX80015/00000/00P') and plantcode='$plantcode' order by lotno, lotdgp_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		$opqty=0.000; $balqty=0.000;
		$opqty=$row_arr_home['opnomp']*$row_arr_home['wtinmp'];
		$balqty=$row_arr_home['balnomp']*$row_arr_home['wtinmp'];
		
		$sql="update tbl_lot_ldg_pack set opnop='0', optqty='".$opqty."', balnop='0', balqty='".$balqty."' where lotno='".$row_arr_home['lotno']."' and lotdgp_id='".$row_arr_home['lotdgp_id']."' ";
		$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
	}
}
 echo "<script>alert('Lots Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>