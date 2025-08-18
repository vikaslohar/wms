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
	
$sql_arr_home=mysqli_query($link,"select distinct(lotno) from tbl_qctest where lotno IN ('DS08454/00000/00R','DA00090/00000/00R','DA00362/00000/00R','DA00527/00000/00R','DA00782/00000/00R','DA00967/00000/00R') order by lotno asc") or die(mysqli_error($link));
$sql_arr_home26=mysqli_query($link,"select distinct(lotno) from tbl_qctest where lotno IN ('DS08454/00000/00R','DA00090/00000/00R','DA00362/00000/00R','DA00527/00000/00R','DA00782/00000/00R','DA00967/00000/00R') order by lotno asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_arr_home23=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where lotno='".$row_arr_home25['lotno']."' order by tid asc") or die(mysqli_error($link));
		while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
		{
			$sql_tbl_sub21=mysqli_query($link,"select * from tbl_qctest where lotno='".$row_arr_home25['lotno']."' and sampleno='".$row_arr_home23['sampleno']."' order by tid asc") or die(mysqli_error($link));
			$subtbltot21=mysqli_fetch_array($sql_tbl_sub21);
			{ 	
				$genp=$subtbltot21['genpurity'];
				$sql21="update tbl_qctest set genpurity='".$genp."' where lotno='".$row_arr_home25['lotno']."' and sampleno='".$row_arr_home23['sampleno']."'";
				$xc21=mysqli_query($link,$sql21) or die(mysqli_error($link));
				//echo "<br />";
			}
		}
	}
	while($row_arr_home=mysqli_fetch_array($sql_arr_home26))
	{	
		
		$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where lotno='".$row_arr_home['lotno']."' and state='P/M/G/T' order by tid desc") or die(mysqli_error($link));
		$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
		$ttid=$row_arr_home2[0];

		$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where lotno='".$row_arr_home['lotno']."' and tid='".$ttid."' order by lotno asc") or die(mysqli_error($link));
		while($subtbltot=mysqli_fetch_array($sql_tbl_sub))
		{ $t++;
			$sql_arr_home24=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' and lotldg_got='UT' order by lotldg_lotno asc") or die(mysqli_error($link));
			$row_arr_home24=mysqli_fetch_array($sql_arr_home24);
			if($row_arr_home24['lotldg_got']=="UT" && ($subtbltot['gotstatus']=="OK" || $subtbltot['gotstatus']=="Fail"))
			{
			$sql="update tbl_lot_ldg set lotldg_got='".$subtbltot['gotstatus']."', lotldg_gottestdate='".$subtbltot['gotdate']."', lotldg_genpurity='".$subtbltot['genpurity']."' where lotldg_lotno='".$row_arr_home['lotno']."'";
			$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
			//echo "<br />";
			}
		}
	}
	
}
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>