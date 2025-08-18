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
	
	ini_set("memory_limit","180M");

$sql_arr_home=mysqli_query($link,"Select * from Variert_List_Updated order by Variety_Name asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{	
		$sql_sel="select * from tblvariety where popularname='".trim($row_arr_home['Variety_Name'])."' order by popularname Asc";
		$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
		$tot=mysqli_num_rows($res);
		while($row12=mysqli_fetch_array($res))
		{
			//echo $row_arr_home['varietyid']." - ".$row_arr_home['popularname']." - ".$mptnop."<br />";
			echo $sql="update tblvariety set variety_newcode='".trim($row_arr_home['Varierty_Code'])."' where varietyid='".$row12['varietyid']."' ";
			$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
			echo "<br />";
		}
	}
}
exit;
 echo "<script>alert('Varieties Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
?>