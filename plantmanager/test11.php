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
$t=0; $qty=0;
	
$sql_arr_home=mysqli_query($link,"select distinct(orlot) from tbl_lot_ldg and plantcode='$plantcode' order by orlot asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where orlot='".$row_arr_home25['orlot']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		while($rowmonth=mysqli_fetch_array($sqlmonth))
		{
			$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where orlot='".$row_arr_home25['orlot']."' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			$rowmonth2=mysqli_fetch_array($sqlmonth2);
			
			$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$rowmonth2[0]."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			while($rowmonth3=mysqli_fetch_array($sqlmonth3))
			{
				if($rowmonth3['lotldg_balqty']>0)
				{$t++;
					/*echo $row_arr_home25['orlot']."  =  ".$rowmonth3['lotldg_balqty'];
					echo "<br />";
					$qty=$qty+$rowmonth3['lotldg_balqty'];*/
				}
			}
		}
	}
}
$sql_arr_homepk=mysqli_query($link,"select distinct(orlot) from tbl_lot_ldg_pack and plantcode='$plantcode' order by orlot asc") or die(mysqli_error($link));
$tot_arr_homepk=mysqli_num_rows($sql_arr_homepk);
if($tot_arr_homepk >0) 
{
	while($row_arr_homepk25=mysqli_fetch_array($sql_arr_homepk))
	{
		$sqlmonthpk=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where orlot='".$row_arr_homepk25['orlot']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		while($rowmonthpk=mysqli_fetch_array($sqlmonthpk))
		{
			$sqlmonthpk2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where orlot='".$row_arr_homepk25['orlot']."' and subbinid='".$rowmonthpk['subbinid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			$rowmonthpk2=mysqli_fetch_array($sqlmonthpk2);
			
			$sqlmonthpk3=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$rowmonthpk2[0]."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			while($rowmonthpk3=mysqli_fetch_array($sqlmonthpk3))
			{
				if($rowmonthpk3['balqty']>0)
				{$qty++;
					/*echo $row_arr_homepk25['orlot']."  =  ".$rowmonthpk3['lotldg_balqty'];
					echo "<br />";
					$qty=$qty+$rowmonthpk3['lotldg_balqty'];*/
				}
			}
		}
	}
}
echo "Bulk Lots: ".$t."<br/>Pack Lots: ".$qty."<br/>Total Lots: ".($t+$qty);
 /*echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>