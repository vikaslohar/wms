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
	
$sql_arr_home=mysqli_query($link,"select agriimp_id from tbl_agriimportsub where contcat_group LIKE '%Not Catalogued%' order by agriimp_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$contgroup='';
		$sql_arr_home24=mysqli_query($link,"select agriimpss_catalogue from tbl_agriimportsub_sub where agriimpsub_id='".$row_arr_home25['agriimp_id']."' order by agriimpsub_id, agriimpss_catalogue asc") or die(mysqli_error($link));
		$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
		while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
		{ 
			if($contgroup!='') { $contgroup=$contgroup.",".$row_arr_home24['agriimpss_catalogue']; }
			else { $contgroup=$row_arr_home24['agriimpss_catalogue']; }
		}
		if($contgroup!='') 
		{ 
			$cataloguecode12=explode(",",$contgroup);
			$cataloguecode22=array_unique($cataloguecode12);
			sort($cataloguecode22);
			$cataloguecode6=implode(",",$cataloguecode22);
			$t++;
	echo		$sql_sub2="UPDATE tbl_agriimportsub SET contcat_group='".$cataloguecode6."' where agriimp_id='".$row_arr_home25['agriimp_id']."'";
			$xcv2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
			echo "<br />";
		}
	}
}
echo $t; exit;
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>