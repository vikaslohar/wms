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
	
	$sql_arr_home=mysqli_query($link,"select distinct(arrival_id) from tblarrival where  plantcode='".$plantcode."'  and arrival_type='Fresh Seed with PDN' order by arrival_id asc") or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	if($tot_arr_home >0) 
	{
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			$t=0;
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$row_arr_home['arrival_id']."' order by arrsub_id asc") or die(mysqli_error($link));
			while($subtbltot=mysqli_fetch_array($sql_tbl_sub))
			{
				$t++; $subtrid=$subtbltot['arrsub_id'];
				$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$subtbltot['old']."' and lottrtype='Fresh Seed with PDN'")or die (mysqli_error($link));
				if($tot_row=mysqli_num_rows($lotqry) > 0)
				{
					$row= mysqli_fetch_array($lotqry);
					$statename=$row['lotstate'];
					$sql_sub="update tblarrival_sub set lotstate='$statename' where arrsub_id='$subtrid'";
					$xcs=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				}
			}
		}
	}
	echo "<script>alert('Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";
?>