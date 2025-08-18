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
	$sql_issue1=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  `disp_party`=784 AND `disp_dodc`>='2016-01-01' order by disp_id asc") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
			
		$dispid=$row_issue1['disp_id'];
		
		$tdate=$row_issue1['disp_dodc'];
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$tdate=$tday."-".$tmonth."-".$tyear;
		$z++;
		
		$sql_sub_sub="Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='".$dispid."' order by disps_id ";
		$ad=mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));				
		$t=mysqli_num_rows($ad);
		if($t> 0)
		{
			while($rw=mysqli_fetch_array($ad))
			{
				$crop=$rw['disps_crop'];
				$variety=$rw['disps_variety'];
				$orderno=$rw['disps_ordno'];
				$ups=$rw['disps_ups'];
				$dispvariety=$rw['disps_nvariety'];
				
				$sql_subsub="Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='".$dispid."' and disps_id='".$rw['disps_id']."' ";
				$adsub=mysqli_query($link,$sql_subsub) or die(mysqli_error($link));				
				$tsub=mysqli_num_rows($adsub);
				if($tsub> 0)
				{
					
					while($rwsub=mysqli_fetch_array($adsub))
					{
						$ltno=$rwsub['dpss_lotno'];
						$wt=0; $gwt=0;
						$sql_subsub2="Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='".$dispid."' and disps_id='".$rw['disps_id']."' and dpss_lotno='".$rwsub['dpss_lotno']."'";
						$adsub2=mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));				
						$tsub2=mysqli_num_rows($adsub2);
						if($tsub2> 0)
						{
							while($rwsub2=mysqli_fetch_array($adsub2))
							{
								$wt=$wt+$rwsub2['dpss_qty'];
								$gwt=$gwt+1;
								
							}
						}
						echo $z."=".$tdate."=".$crop."=".$variety."=".$orderno."=".$ups."=".$ltno."=".$gwt."=".$wt."=".$dispvariety."<br>";
					}
				}
			}
		}
	}
	
	/*echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";*/
?>