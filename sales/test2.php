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
	
$sql_arr_home=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_rettype='P2P' order by salesrs_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$t++;
		$subid=$row_arr_home25['salesrs_id'];
		$lotno=$row_arr_home25['salesrs_newlot'];
		$zzz=implode(",", str_split($row_arr_home25['salesrs_newlot']));
		$lotch1=$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
		$lotch2=$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
		$lotch3=$zzz[28].$zzz[30];
					
		$nlotno=$zzz[0].$zzz[2].$lotch1."/".$lotch2."/".$lotch3."P";
		$orlot=$zzz[0].$zzz[2].$lotch1."/".$lotch2."/".$lotch3;
				
		$sqlc2="UPDATE `tbl_lot_ldg_pack` SET `lotno`='$lotno', `orlot`='$orlot' WHERE `lotno`='".$row_arr_home24['salesrs_newlot']."' and `orlot`='".$row_arr_home24['salesrs_orlot']."'";	
		$zxc2=mysqli_query($link,$sqlc2) or die(mysqli_error($link));
				
		$sqlc="UPDATE `tbl_salesrv_sub` SET `salesrs_newlot`='$nlotno', `salesrs_orlot`='$orlot', salesrs_stage='Pack' WHERE `salesrs_id`='".$subid."' ";	
		$zxc=mysqli_query($link,$sqlc) or die(mysqli_error($link));
			
		$sqlc3="UPDATE `tbl_qctest` SET `lotno`='$nlotno', `oldlot`='$orlot', trstage='Pack' WHERE `lotno`='".$lotno."' ";	
		$zxc3=mysqli_query($link,$sqlc3) or die(mysqli_error($link));
		
		$sqlc4="UPDATE `tbl_srrevalidate` SET `srrv_lotno`='$nlotno' WHERE `srrv_lotno`='".$lotno."' ";	
		$zxc4=mysqli_query($link,$sqlc4) or die(mysqli_error($link));
		
		//echo "<br /><br />";	
	}
}
//echo $t;
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>