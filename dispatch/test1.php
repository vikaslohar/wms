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

	$sql_issue1=mysqli_query($link,"select distinct orlot from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  orlot!=''") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
		$z=0;						
		$sql_issuetbl=mysqli_query($link,"SELECT distinct lotldg_variety FROM tbl_lot_ldg_pack WHERE plantcode='".$plantcode."' and  orlot='".$row_issue1['orlot']."' ORDER BY lotdgp_id ASC") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_issuetbl); 
		if($t>1)
		{
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{						
				if($z==0)
				{$verty=$row_issuetbl['lotldg_variety'];}
	
				if($z>0)
				{
					$sql_sub_sub="update tbl_lot_ldg_pack set lotldg_variety='$verty' where plantcode='".$plantcode."' and  orlot='".$row_issue1['orlot']."' ";
					mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				}
				//echo $row_issue1['orlot']."<br />";
				$z++;
			}
		}					
	}
	//echo $z;
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";
?>