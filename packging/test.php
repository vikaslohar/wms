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
	
$sql_arr_home2=mysqli_query($link,"SELECT distinct orlot FROM tbl_lot_ldg_pack WHERE plantcode='$plantcode' and lotldg_qc='UT' and lotldg_rvflg=0") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);

if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$gemp="";
		$sql_ck=mysqli_query($link,"select max(tid) from tbl_qctest where plantcode='$plantcode' and oldlot='".$row_arr_home2['orlot']."' order by tid desc") or die(mysqli_error($link));
		$row_ck=mysqli_fetch_array($sql_ck);
		
		$sql_ck1=mysqli_query($link,"select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_ck[0]."' and oldlot='".$row_arr_home2['orlot']."' order by tid desc") or die(mysqli_error($link));
		$row_ck1=mysqli_fetch_array($sql_ck1);
		$gemp=$row_ck1['gemp'];
		
		//echo $row_arr_home2['orlot']."  ".$row_ck[0]."  -  ".$row_ck1['qcstatus']." = ";
		if($row_ck1['qcstatus']=="OK" || $row_ck1['qcstatus']=="Fail")
		{
			if($gemp=="")
			{
				$sql="update tbl_lot_ldg_pack set lotldg_qc='".$row_ck1['qcstatus']."', lotldg_qctestdate='".$row_ck1['testdate']."', lotldg_moisture='".$row_ck1['moist']."' where orlot='".$row_arr_home2['orlot']."'";
			}
			else
			{
				$sql="update tbl_lot_ldg_pack set lotldg_qc='".$row_ck1['qcstatus']."', lotldg_qctestdate='".$row_ck1['testdate']."', lotldg_moisture='".$row_ck1['moist']."', lotldg_gemp='".$gemp."' where orlot='".$row_arr_home2['orlot']."'";
			}	
			$sadf=mysqli_query($link,$sql) or die(mysqli_error($link));
		}
	}
}
 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>