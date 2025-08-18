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
	
$sql_arr_home=mysqli_query($link,"select distinct(orlot) from tbl_lot_ldg where lotldg_qc!='OK' and lotldg_qc!='Fail' order by orlot asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_arr_home24=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$row_arr_home25['orlot']."' and lotldg_qc!='OK' and lotldg_qc!='Fail' order by orlot asc") or die(mysqli_error($link));
		$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
		while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
		{ 
		
			$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home25['orlot']."' order by tid desc") or die(mysqli_error($link));
			$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
			$ttid=$row_arr_home2[0];
	
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home25['orlot']."' and tid='".$ttid."' order by lotno asc") or die(mysqli_error($link));
			while($subtbltot=mysqli_fetch_array($sql_tbl_sub))
			{ 
			//echo $subtbltot['qcstatus'];
				if(($row_arr_home24['lotldg_qc']!="OK" && $row_arr_home24['lotldg_qc']!="Fail")&& ($subtbltot['qcstatus']=="OK" || $subtbltot['qcstatus']=="Fail"))
				{$t++;
				
				echo $row_arr_home25['orlot']."  -  ".$subtbltot['qcstatus']."  =  ".$row_arr_home24['lotldg_qc']."  Condition";
				$sql="update tbl_lot_ldg set lotldg_qc='".$subtbltot['qcstatus']."', lotldg_qctestdate='".$subtbltot['testdate']."', lotldg_gemp='".$subtbltot['gemp']."' where orlot='".$row_arr_home25['orlot']."' and lotldg_qc!='OK' and lotldg_qc!='Fail'";
				//$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
				echo "<br />";
				}
			}
		}
	}
}
$sql_arr_home=mysqli_query($link,"select distinct(orlot) from tbl_lot_ldg_pack where lotldg_qc!='OK' and lotldg_qc!='Fail' order by orlot asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_arr_home24=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$row_arr_home25['orlot']."' and lotldg_qc!='OK' and lotldg_qc!='Fail' order by orlot asc") or die(mysqli_error($link));
		$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
		while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
		{ 
		
			$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where oldlot='".$row_arr_home25['orlot']."' order by tid desc") or die(mysqli_error($link));
			$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
			$ttid=$row_arr_home2[0];
	
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home25['orlot']."' and tid='".$ttid."' order by lotno asc") or die(mysqli_error($link));
			while($subtbltot=mysqli_fetch_array($sql_tbl_sub))
			{ 
			//echo $subtbltot['qcstatus'];
				if(($row_arr_home24['lotldg_qc']!="OK" && $row_arr_home24['lotldg_qc']!="Fail")&& ($subtbltot['qcstatus']=="OK" || $subtbltot['qcstatus']=="Fail"))
				{$t++;
				
				echo $row_arr_home25['orlot']."  -  ".$subtbltot['qcstatus']."  =  ".$row_arr_home24['lotldg_qc']."  Pack";
				$sql2="update tbl_lot_ldg_pack set lotldg_qc='".$subtbltot['qcstatus']."', lotldg_qctestdate='".$subtbltot['testdate']."', lotldg_gemp='".$subtbltot['gemp']."' where orlot='".$row_arr_home25['orlot']."' and lotldg_qc!='OK' and lotldg_qc!='Fail'";
				//$xc2=mysqli_query($link,$sql2) or die(mysqli_error($link));
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