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
	
$sql_arr_home=mysqli_query($link,"select varietyid, popularname, cropid from tblvariety  where cropid='Paddy' and vt='Hybrid' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($tot_arr_home >0) 
{
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
	{
		$sqlmonth=mysqli_query($link,"SELECT blendm_id FROM tbl_blendm WHERE blendm_variety='".$row_arr_home25['varietyid']."' and `blendm_date`<='2015-10-31' and `blendm_date`>='2015-04-01' and blendm_bflg=1 and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		 $t=mysqli_num_rows($sqlmonth);
		while($rowmonth=mysqli_fetch_array($sqlmonth))
		{
			$sqlmonth2=mysqli_query($link,"SELECT distinct blends_newlot FROM tbl_blends WHERE blendm_id='".$rowmonth['blendm_id']."' and blends_delflg=0 and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			 $t2=mysqli_num_rows($sqlmonth2);
			while($rowmonth2=mysqli_fetch_array($sqlmonth2))
			{
				$lt="";
				$sqlmonth3=mysqli_query($link,"SELECT blends_lotno FROM tbl_blends WHERE blendm_id='".$rowmonth['blendm_id']."' and blends_newlot='".$rowmonth2['blends_newlot']."' and blends_delflg=0 and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
				 $t3=mysqli_num_rows($sqlmonth3);
				while($rowmonth3=mysqli_fetch_array($sqlmonth3))
				{
					if($lt!="")
					$lt=$lt.",".$rowmonth3['blends_lotno'];
					else
					$lt=$rowmonth3['blends_lotno'];
				}
				echo $row_arr_home25['cropid'].",".$row_arr_home25['popularname'].",".$rowmonth2['blends_newlot'].",".$lt;
				echo "<br />";
			}	
		}
	}
}
//echo $qty;
 /*echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>