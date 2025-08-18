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
	
$sql_arr_home=mysqli_query($link,"select * from tbl_salesrv_nsr where plantcode='$plantcode' AND srnsr_code='0' and srnsr_tflg='1' order by srnsr_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home >0) 
{
 $t=0;
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_arr_home24=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$row_arr_home25['salesrs_id']."' order by salesrs_id asc") or die(mysqli_error($link));
		while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
		{
			$t++;
			//echo $row_arr_home24['salesrs_orlot']."<br />";
			
			$subid=$row_arr_home24['salesrs_id'];
			$z=90001;	
						
			$sql_code12="SELECT MAX(srnsr_code) FROM tbl_salesrv_nsr where plantcode='$plantcode' AND srnsr_yearcode='$yearid_id' ORDER BY srnsr_code DESC";
			$res_code12=mysqli_query($link,$sql_code12)or die(mysqli_error($link));
			if(mysqli_num_rows($res_code12) > 0)
			{
				$row_code12=mysqli_fetch_row($res_code12);
				$t_code12=$row_code12['0'];
				if($t_code12>0)
				{
					$ncode12=$t_code12+1;
				}
				else
				{
					$ncode12=$z;
				}
				$ncode12=sprintf("%00005d",($ncode12));
			}
			else
			{
				$ncode12=$z;
			}
					
			$zzz=implode(",", str_split($row_arr_home24['salesrs_newlot']));
			$lotch1=$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
			$lotch3=$zzz[28].$zzz[30];
					
			$lotno=$zzz[0].$zzz[2].$lotch1."/".$ncode12."/".$lotch3.$zzz[32];
			$orlot=$zzz[0].$zzz[2].$lotch1."/".$ncode12."/".$lotch3;
				
			$sqlsubsub="update tbl_salesrv_nsr set srnsr_code='$ncode12' where srnsr_id='".$row_arr_home25['srnsr_id']."'";
			mysqli_query($link,$sqlsubsub) or die(mysqli_error($link));
				
			$sqlc2="UPDATE `tbl_lot_ldg` SET `lotldg_lotno`='$lotno', `orlot`='$orlot' WHERE `lotldg_lotno`='".$row_arr_home24['salesrs_newlot']."' and `orlot`='".$row_arr_home24['salesrs_orlot']."' and lotldg_balqty='".$row_arr_home24['salesrs_qtydc']."' and lotldg_trtype='Sales Return' ";	
			$zxc2=mysqli_query($link,$sqlc2) or die(mysqli_error($link));
				
			$sqlc="UPDATE `tbl_salesrv_sub` SET `salesrs_newlot`='$lotno', `salesrs_orlot`='$orlot' WHERE `salesrs_id`='".$subid."' ";	
			$zxc=mysqli_query($link,$sqlc) or die(mysqli_error($link));
			
			$sqlc3="UPDATE `tbl_qctest` SET `lotno`='$lotno', `oldlot`='$orlot' WHERE `lotno`='".$row_arr_home24['salesrs_newlot']."' ";	
			$zxc3=mysqli_query($link,$sqlc3) or die(mysqli_error($link));
			//echo "<br />";	
		}
	}
}
//echo $t;
 echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>