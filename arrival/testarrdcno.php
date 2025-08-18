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
	
	ini_set("memory_limit","800M");
	$t=0;
	$sql_arr_home=mysqli_query($link,"select unldarr_trid, dcno from tblarrival_unld where unldarr_trid>0 order by arrival_id asc") or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	if($tot_arr_home >0) 
	{
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			
			$dcno=$row_arr_home['dcno'];
			$t++; $arrival_id=$row_arr_home['unldarr_trid'];
			$sql_sub="update tblarrival set dcno='$dcno' where arrival_id='$arrival_id'";
			$xcs=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			//echo "<br />";
		}
	}
	//echo $t;
	//exit;
	echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
?>