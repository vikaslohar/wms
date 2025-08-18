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
$sql_arr_home=mysqli_query($link,"select distinct orlot from tbl_lot_ldg where lotldg_gottestdate IS NOT NULL and lotldg_gottestdate!='0000-00-00' and lotldg_gottestdate!='' and (lotldg_got='' or lotldg_got IS NULL) and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$orlot=$row_arr_home25['orlot'];
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$orlot."' and plantcode='$plantcode' LIMIT 0,1")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$sqlmonth33=mysqli_query($link,"select * from tbl_qctest where oldlot='".$orlot."' and gotdate='".$rowmonth3['lotldg_gottestdate']."' and gotstatus!='' and gotstatus IS NOT NULL and plantcode='$plantcode' LIMIT 0,1")or die("Error:".mysqli_error($link));
			while($rowmonth33=mysqli_fetch_array($sqlmonth33))
			{
				$cnt++; 
				
				echo $orlot."  -  ".$rowmonth33['gotstatus']."  -  ".$rowmonth33['gotdate']."<br />";
			}
		}
	}
}
//echo $sbid;
/* echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>