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
	
	$z=0;
	$sql_issue1=mysqli_query($link,"select distinct mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode!='' order by mpmain_id desc") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
			
		$lotn=$row_issue1['mpmain_barcode'];
		$sqlmonth=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$lotn."' order by mpmain_id desc")or die("Error:".mysqli_error($link));
		$totmo=mysqli_num_rows($sqlmonth);
		if($totmo>1)
		{
			while($rowmonth=mysqli_fetch_array($sqlmonth))
			{
						
				echo $lotn." =  ".$rowmonth['mpmain_lotno']."  =  ".$rowmonth['mpmain_date']."<br />";
				$z++;
			}
		}					
	}
	echo $z;
	/*echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";*/
?>