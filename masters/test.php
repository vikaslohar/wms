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
$arid="";	
$sql_arr_home=mysqli_query($link,"select distinct(arrival_id) from tblarrival where arrival_date<='2013-12-31' and arrival_date>='2013-01-01' and arrival_type='Fresh Seed with PDN'  order by arrival_date asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		if($arid!="")
		$arid=$arid.",".$row_arr_home['arrival_id'];
		else
		$arid=$row_arr_home['arrival_id'];
	}
}
$sql_tbl_sub=mysqli_query($link,"select sum(lotldg_trbags) from tbl_lot_ldg where lotldg_trdate<='2013-12-31' and lotldg_trdate>='2013-01-01' and lotldg_trtype='Fresh Seed with PDN' order by lotldg_trdate asc") or die(mysqli_error($link));
$subtbltot=mysqli_fetch_array($sql_tbl_sub);
echo $subtbllot[0];

?>