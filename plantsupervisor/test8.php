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
$wh="WH-CS"; $sbid=""; $t=0;
$sq_wh=mysqli_query($link,"Select * from tbl_warehouse where plantcode='$plantcode'") or die(mysqli_error($link));
while($row_wh=mysqli_fetch_array($sq_wh))
{
	//echo $row_wh['whid'];
	$sql_arr_home=mysqli_query($link,"select * from tbl_bin where whid='".$row_wh['whid']."' and plantcode='$plantcode' order by binname asc") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 
	if($tot_arr_home >0) 
	{
		while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
		{
			$sqlmonth=mysqli_query($link,"SELECT * FROM `tbl_subbin` WHERE `whid`='".$row_wh['whid']."' and `binid`='".$row_arr_home25['binid']."' and status!='Empty' and plantcode='$plantcode' order by sid asc")or die("Error:".mysqli_error($link));
			$totarrhome=mysqli_num_rows($sqlmonth);
			if($totarrhome>0) 
			{
				while($rowmonth=mysqli_fetch_array($sqlmonth))
				{
					$cnt=0; $subbinid=$rowmonth['sid'];
					$sqlmonth23=mysqli_query($link,"select distinct orlot from tbl_lot_ldg where lotldg_subbinid='".$rowmonth['sid']."' and  `lotldg_whid`='".$row_wh['whid']."' and `lotldg_binid`='".$row_arr_home25['binid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
					while($rowmonth23=mysqli_fetch_array($sqlmonth23))
					{
						$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$rowmonth['sid']."' and orlot='".$rowmonth23['orlot']."' and  `lotldg_whid`='".$row_wh['whid']."' and `lotldg_binid`='".$row_arr_home25['binid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
						$rowmonth2=mysqli_fetch_array($sqlmonth2);
						
						$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$rowmonth2[0]."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
						while($rowmonth3=mysqli_fetch_array($sqlmonth3))
						{
							if($rowmonth3['lotldg_balqty']>0)
							{
								$cnt++;
								//echo $rowmonth['sid']."  =  ".$rowmonth3['orlot']."  =  ".$rowmonth3['lotldg_balqty']."  =  ".$rowmonth3['lotldg_sstage'];
								//echo "<br />";
								//$qty=$qty+$rowmonth3['lotldg_balqty'];
							}
						}
					}
					$sqlmonth23=mysqli_query($link,"select distinct orlot from tbl_lot_ldg_pack where  subbinid='".$rowmonth['sid']."' and  `whid`='".$row_wh['whid']."' and `binid`='".$row_arr_home25['binid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
					while($rowmonth23=mysqli_fetch_array($sqlmonth23))
					{
						$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where  subbinid='".$rowmonth['sid']."' and orlot='".$rowmonth23['orlot']."' and  `whid`='".$row_wh['whid']."' and `binid`='".$row_arr_home25['binid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
						$rowmonth2=mysqli_fetch_array($sqlmonth2);
						$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$rowmonth2[0]."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
						while($rowmonth3=mysqli_fetch_array($sqlmonth3))
						{
							if($rowmonth3['balqty']>0)
							{
								$cnt++;
								//echo $rowmonth['sid']."  =  ".$rowmonth3['orlot']."  =  ".$rowmonth3['balqty']."  =  Pack";
								//echo "<br />";
								//$qty=$qty+$rowmonth3['lotldg_balqty'];
							}
						}
					}
					
					if($cnt==0)
					{ $t++;
						$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid' and `whid`='".$row_wh['whid']."' and `binid`='".$row_arr_home25['binid']."' and plantcode='$plantcode'";
						//echo $sql_itmg."<br />";
						mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
						//if($sbid!="")$sbid=$sbid.",".$subbinid; else $sbid=$subbinid;
					}
					
				}
			}
		}
	}
}
//echo $t;
//exit;

 echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
 ?>