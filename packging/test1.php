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
	
$sql_arr_home2=mysqli_query($link,"SELECT * FROM tbl_mpmain WHERE plantcode='$plantcode' and mpmain_trtype='PACKSMC'") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
$t=1;
//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
if($tot_arr_home2 >0) 
{
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
			//echo $t." ";
			
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where plantcode='$plantcode' and varietyid='".$row_arr_home2['mpmain_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
			$srnonew=0;
			
			$p1_array=explode(",",$rowvariety['gm']);
			$p1_array2=explode(",",$rowvariety['wtmp']);
			$p1_array3=explode(",",$rowvariety['mptnop']);
			$p1=array();
			foreach($p1_array as $val1)
			{
				if($val1<>"")
				{
					$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
					$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
					$row12=mysqli_fetch_array($res);
					$ups=$row12['ups']." ".$row12['wt'];
					if($row_arr_home2['mpmain_upssize']==$ups)
					{
						$wtmp=$p1_array2[$srnonew];
						$nopinmp=$p1_array3[$srnonew];
					}
				}
				$srnonew++;
			}
			
			$sql="update tbl_unpkgsub set unpkgsub_qty='$wtmp', unpkgsub_nop='$nopinmp' where unpkgsub_variety='".$row_arr_home2['mpmain_variety']."' and unpkgsub_ups='".$row_arr_home2['mpmain_upssize']."'";
			//echo "<br>";
			$sadf=mysqli_query($link,$sql) or die(mysqli_error($link));
			$sql2="update tbl_mpmain set mpmain_wtmp='$wtmp', mpmain_mptnop='$nopinmp', mpmain_lotnop='$nopinmp' where mpmain_id='".$row_arr_home2['mpmain_id']."'";
			$sadf2=mysqli_query($link,$sql2) or die(mysqli_error($link));
			
			$sql3="update tbl_lot_ldg_pack set wtinmp='$wtmp' where lotldg_variety='".$row_arr_home2['mpmain_variety']."' and packtype='".$row_arr_home2['mpmain_upssize']."'";
			//echo "<br>";
			$sadf3=mysqli_query($link,$sql3) or die(mysqli_error($link));
			//echo $row_arr_home2['lotldg_variety']." - ".$noticia_item['varietyid'];
			/*echo "<br>";
			$t++;
		else
		echo $row_arr_home2['lotldg_variety'];
		echo "<br>";echo "<br>";*/
	}
	
}
 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>