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
	
	ini_set("memory_limit","800M");
	
	$connnew = mysqli_connect("localhost","wfuser","P1o5RSOloG8jCAN8") or die("Error:".mysqli_error($connnew));
	$dbnew = mysqli_select_db($connnew,"wmsfocusdb") or die("Error:".mysqli_error($connnew));
	
	$qdate="2022-03-01"; $cnt=0;
	
	$sql_arr=mysqli_query($connnew,"select * from tbl_frn where wffrn_ploss>='0.000' ") or die(mysqli_error($link));
	$tot_arr=mysqli_num_rows($sql_arr);
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
		$lotno=$row_arr['wffrn_batch']."R";
		$stage="Raw";
		//echo "select * from tbl_proslipsub where proslipsub_lotno='".$lotno."'";
		//echo "<br />";
		$sqlarrsub=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$totarrsub=mysqli_num_rows($sqlarrsub);
		while($row_arrsub=mysqli_fetch_array($sqlarrsub))
		{	
			if($row_arrsub['proslipsub_tlqty']>0)
			{
				$ploss=$row_arr['wffrn_ploss']+$row_arrsub['proslipsub_tlqty'];
				$plossper=($ploss/$row_arr['wffrn_ploss'])*100;
					
			echo	$sqltblwfsub="update tbl_frn set wffrn_ploss='".$ploss."', wffrn_pper='".$plossper."' where wffrn_id='".$row_arr['wffrn_id']."' ";
				$cxwfcx=mysqli_query($connnew,$sqltblwfsub) or die(mysqli_error($connnew));
				echo "<br />";
			}
		}
	}			

echo $cnt;
?>
