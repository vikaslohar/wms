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

$sdate="2016-04-01";
$edate="2016-06-22";
$crop=24;
//$variety = $_REQUEST['txtvariety'];
		
$i=0;			
$sql_arr_home=mysqli_query($link,"select distinct proslipmain_variety from tbl_proslipmain where proslipmain_date<='".$edate."' and proslipmain_date>='".$sdate."' and proslipmain_crop='".$crop."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sql_crp23=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp23=mysqli_fetch_array($sql_crp23);
		$crp23=$row_crp23['cropname'];
	
		$sql_var23=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home25['proslipmain_variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$row_var23=mysqli_fetch_array($sql_var23);
		$ver23=$row_var23['popularname'];
		$rm=0; $im=0; $pl=0; $totloss=0;
		$sqlmonth=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_date<='".$edate."' and proslipmain_date>='".$sdate."' and proslipmain_crop='".$crop."' and proslipmain_variety='".$row_arr_home25['proslipmain_variety']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		$totarrhome=mysqli_num_rows($sqlmonth);
		if($totarrhome>0) 
		{	$i++;
			while($rowmonth=mysqli_fetch_array($sqlmonth))
			{
				$sqlmonth2=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$rowmonth['proslipmain_id']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
				$totarrhome2=mysqli_num_rows($sqlmonth2);
				if($totarrhome2>0) 
				{	
					while($rowmonth2=mysqli_fetch_array($sqlmonth2))
					{
						$rm=$rm+$rowmonth2['proslipsub_rm'];
						$im=$im+$rowmonth2['proslipsub_im'];
						$pl=$pl+$rowmonth2['proslipsub_pl'];
						$totloss=$rm+$im+$pl;
					}
				}		
			}
		}
		
		echo $i."=".$crp23."=".$ver23."=".$rm."=".$im."=".$pl."=".$totloss;
		echo "<br />";
	}
}
//echo $qty;
 /*echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>