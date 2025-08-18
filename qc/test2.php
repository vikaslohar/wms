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
	
$sql_arr_home2=mysqli_query($link,"SELECT distinct(lotldg_variety) FROM tbl_lot_ldg WHERE lotldg_variety NOT RLIKE '^[-+0-9.E]+$'") or die(mysqli_error($link));
 $tot_arr_home2=mysqli_num_rows($sql_arr_home2);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where popularname='".$row_arr_home2['lotldg_variety']."' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_month);
		$noticia_item = mysqli_fetch_array($sql_month);
		if($ttt > 0)
		{
			$sql="update tbl_lot_ldg set lotldg_variety='".$noticia_item['varietyid']."' where lotldg_variety='".$row_arr_home2['lotldg_variety']."'";
			$sadf=mysqli_query($link,$sql) or die(mysqli_error($link));
			//echo $row_arr_home2['lotldg_variety']." - ".$noticia_item['varietyid'];
			//echo "<br>";
		}
		/*else
		echo $row_arr_home2['lotldg_variety'];
		echo "<br>";*/
	}
	
}
 echo "<script>alert('Variety Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>