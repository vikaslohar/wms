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
	
$sql_arr_home=mysqli_query($link,"SELECT distinct srdate FROM `tbl_qctest` WHERE srdate>='2015-01-01' and yearid='' order by `srdate` ASC, `tid` ASC") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{	$smp=0;
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{ //echo $row_arr_home['tid']."--".$row_arr_home['sampleno']."==";
		$sqlarrhome=mysqli_query($link,"SELECT distinct oldlot FROM `tbl_qctest` WHERE srdate>='2015-01-01' and srdate='".$row_arr_home['srdate']."' and yearid='' order by `srdate` ASC, `tid` ASC") or die(mysqli_error($link));
		while($rowarrhome=mysqli_fetch_array($sqlarrhome))
		{
			if($smp==0)
			{		
				$smp=1;
			}
			else
			{
				$smp=$smp+1;
			}
			$t=$smp;
			 $sql_tbl_sub="update tbl_qctest set sampleno='$t', yearid='P' WHERE oldlot='".$rowarrhome['oldlot']."' and srdate ='".$row_arr_home['srdate']."' and yearid='' ";
			//echo "<BR>";
			$zz=mysqli_query($link,$sql_tbl_sub) or die(mysqli_error($link));
		}
	}
	
}
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>