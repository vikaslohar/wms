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
	
$sql_arr_home=mysqli_query($link,"select distinct(orlot) from tbl_lot_ldg where lotldg_got!='OK' and lotldg_got!='Fail'  order by orlot asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_arr_home24=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$row_arr_home25['orlot']."' and lotldg_got!='OK' and lotldg_got!='Fail' order by orlot asc") or die(mysqli_error($link));
		$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
		while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
		{ 
		
			$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home25['orlot']."' and (gotstatus='OK' or gotstatus='Fail') order by tid desc") or die(mysqli_error($link));
			$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
			$ttid=$row_arr_home2[0];
	
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home25['orlot']."' and tid='".$ttid."' and (gotstatus='OK' or gotstatus='Fail') order by lotno asc") or die(mysqli_error($link));
			while($subtbltot=mysqli_fetch_array($sql_tbl_sub))
			{ 
			//echo $subtbltot['qcstatus'];
				if(($row_arr_home24['lotldg_got']!="OK" && $row_arr_home24['lotldg_got']!="Fail")&& ($subtbltot['gotstatus']=="OK" || $subtbltot['gotstatus']=="Fail"))
				{$t++;
				
				echo $row_arr_home25['orlot']."  -  ".$subtbltot['gotstatus']."  =  ".$row_arr_home24['lotldg_got']."  ".$row_arr_home24['lotldg_gottestdate']."  ".$subtbltot['gotdate'];
				if($subtbltot['gotdate']!="0000-00-00")
				$sql="update tbl_lot_ldg set lotldg_got='".$subtbltot['gotstatus']."', lotldg_gottestdate='".$subtbltot['gotdate']."' where orlot='".$row_arr_home25['orlot']."' and lotldg_got!='OK' and lotldg_got!='Fail'";
				else
				$sql="update tbl_lot_ldg set lotldg_got='".$subtbltot['gotstatus']."' where orlot='".$row_arr_home25['orlot']."' and lotldg_got!='OK' and lotldg_got!='Fail'";
				//$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
				echo "<br />";
				}
			}
		}
	}
}
//echo $t;
/* echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>