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
	
	$sql="SELECT * FROM `tbl_gottest` WHERE `gottest_srdate` >= '2017-08-01' ORDER BY `tbl_gottest`.`gottest_oldlot` ASC";
	//$sql.=" order by dosdate asc, oldlot asc ";
	
	$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	if($tot_arr_home > 0)
	{
		while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
		{
			$sqlmax2="select * from tbl_qctest where sampleno='".$row_arr_home2['gottest_sampleno']."' and oldlot='".$row_arr_home2['gottest_oldlot']."' and  srdate >= '2017-08-01'";
			$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
			$tot_max2=mysqli_num_rows($sql_max2);
			while($row_arr_home3=mysqli_fetch_array($sql_max2))
			{
				 $sql_tbl_sub="update tbl_gottest set gottest_spdate='".$row_arr_home3['spdate']."', gottest_bflg='1' WHERE gottest_oldlot='".$row_arr_home2['gottest_oldlot']."' and gottest_srdate ='".$row_arr_home2['gottest_srdate']."' and gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' ";
				$zz=mysqli_query($link,$sql_tbl_sub) or die(mysqli_error($link));
				
			}	
		}
	}
	//exit;
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>