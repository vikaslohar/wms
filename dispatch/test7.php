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
	
	$z=0; $x=0;
	$sql_issue1=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' order by disp_id asc") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
			
		$lotn=$row_issue1['disp_id'];
		$wt=0; $gwt=0;
		$sql_sub_sub="Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='".$lotn."' ";
		$ad=mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));				
		$t=mysqli_num_rows($ad);
		if($t> 0)
		{
		while($rw=mysqli_fetch_array($ad))
		{
		$wt=$wt+$rw['dpss_qty'];
		$gwt=$gwt+$rw['dpss_grosswt'];
		}
		}
		echo $lotn." - ".$t." - ".$wt." - ".$gwt."<br />";
		if($t>$z)$z=$t;
		if($gwt>$x)$x=$gwt;
	}
	echo $z."  -  ".$x;
	/*echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";*/
?>