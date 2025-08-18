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

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$cnt=0;
	
$sql_arr_home=mysqli_query($link,"select * from tbl_gottest where (gottest_spdate IS NULL OR gottest_spdate='0000-00-00')order by gottest_tid asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		$smpno=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$row_arr_home['gottest_sampleno']);		
		$sql_tbl=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home['gottest_oldlot']."' and bflg>0 and sampleno='".$row_arr_home['gottest_sampleno']."' and yearid='".$row_arr_home['yearid']."'  ") or die(mysqli_error($link));
		$row_tbl=mysqli_fetch_array($sql_tbl);
		$tot11=mysqli_num_rows($sql_tbl);
		if($row_tbl['spdate']!=NULL && $row_tbl['spdate']!='0000-00-00')
		{
		//echo $row_arr_home['gottest_tid']." = ".$row_arr_home['gottest_oldlot']." = ".$smpno." = ".$row_arr_home['gottest_spdate']." = ".$row_tbl['spdate']."<br />";
		echo $sq="update tbl_gottest set gottest_spdate='".$row_tbl['spdate']."', gottest_bflg=1 WHERE gottest_oldlot='".$row_arr_home['gottest_oldlot']."'";
		$xc=mysqli_query($link,$sq) or die(mysqli_error($link));
		echo "<br />";
		$cnt++;
		}		
	}
}
echo $cnt;
exit;
 echo "<script>alert('Sample No Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>
