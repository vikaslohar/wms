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
$t=0; $qty=0;
	
$sql_arr_home1=mysqli_query($link,"select arrival_id  from tbl_dryarrival where arrival_date>='2020-01-01' and plantcode='$plantcode' order by arrival_id  asc") or die(mysqli_error($link));
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);
if($tot_arr_home1 >0) 
{
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_arr_home=mysqli_query($link,"select distinct (batchorlot) from tbl_dryarrival_sub where arrival_id='".$row_arr_home1['arrival_id']."' and batchflg=1 and plantcode='$plantcode' order by batchorlot asc") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
		if($tot_arr_home >0) 
		{
			while($row_arr_home25=mysqli_fetch_array($sql_arr_home))
			{
				$sqlmonth=mysqli_query($link,"select distinct (trid) from tbl_cobdryingsub where norlot='".$row_arr_home25['batchorlot']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
				while($rowmonth=mysqli_fetch_array($sqlmonth))
				{
					$sqlmonth2=mysqli_query($link,"select * from tbl_cobdryingsubsub where trid='".$rowmonth['trid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
					while($rowmonth2=mysqli_fetch_array($sqlmonth2))
					{
						$oqty=0; $dryingloss=0; $dlper=0;
						$oqty=$rowmonth2['oqty'];
						$dryingloss=$rowmonth2['dryingloss'];
						$dlper=(($dryingloss/$oqty)*100);
						//echo "   =   ";
						$sqlmonth3=mysqli_query($link,"select * from tbl_cobdryingsub where trid='".$rowmonth['trid']."' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
						while($rowmonth3=mysqli_fetch_array($sqlmonth3))
						{
							$onqty=0; $dryloss=0; $nqty=0;
							$onqty=$rowmonth3['oqty'];
							$dryloss=(($onqty*$dlper)/100);
							$dryloss=round($dryloss,3);
							$nqty=($onqty)-($dryloss);
							$nqty=round($nqty,3);
							$sql="UPDATE tbl_cobdryingsub SET qty1='$nqty', adnob='$dryloss' where subtrid='".$rowmonth3['subtrid']."' ";
							$xc=mysqli_query($link,$sql) or die(mysqli_error($link));
							//echo "<br />";
							//$t++;
						}
					}
				}
			}
		}
	}
}
exit;
 /*echo "<script>alert('Result Updated......')</script>";
 echo "<script>window.location='index1.php'</script>";*/
 ?>