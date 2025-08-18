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

	$sql_issue1=mysqli_query($link,"select distinct orlot from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  trtype='Dispatch'") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
		$z=0;						
		$sql_issuetbl=mysqli_query($link,"SELECT * FROM tbl_lot_ldg_pack WHERE plantcode='".$plantcode."' and  trtype='Dispatch' and orlot='".$row_issue1['orlot']."' ORDER BY lotdgp_id ASC") or die(mysqli_error($link)); 
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{						
			if($z==0)
			$opqty=$row_issuetbl['optqty'];
			else
			$opqty=$balqty;
			
			$wtinmp=$row_issuetbl['wtinmp'];
			$balqty=$opqty-$wtinmp;
			
			$sql_sub_sub="update tbl_lot_ldg_pack set optqty='$opqty', tqty='$wtinmp', balqty='$balqty' where plantcode='".$plantcode."' and  lotdgp_id='".$row_issuetbl['lotdgp_id']."' and trtype='Dispatch' ";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			//echo $sql_sub_sub."<br />";
			$z++;
		}					
	}
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";
?>