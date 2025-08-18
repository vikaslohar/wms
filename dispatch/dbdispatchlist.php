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
	$dt=date("Y-m-d");
	$dt1="2019-04-01";
	$sql_issue12=mysqli_query($link,"select Distinct disp_party from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$dt1' and disp_dodc<='$dt' and (disp_partytype='Dealer' OR disp_partytype='Branch') order by disp_partytype, disp_party, disp_id asc") or die(mysqli_error($link));
	while($row_issue12=mysqli_fetch_array($sql_issue12))
	{
		$party=''; 
		$sql_party=mysqli_query($link,"Select * from tbl_partymaser where p_id='".$row_issue12['disp_party']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);
		echo "Party Type: ".$row_party['classification'];
		echo "<br />";
		echo $party=$row_party['business_name']." - ".$row_party['city']." - ".$row_party['state'];
		echo "<br />";	
		$sql_issue1=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$dt1' and disp_dodc<='$dt' and disp_party='".$row_issue12['disp_party']."' and (disp_partytype='Dealer' OR disp_partytype='Branch') order by disp_partytype, disp_party, disp_id asc") or die(mysqli_error($link));
		while($row_issue1=mysqli_fetch_array($sql_issue1))
		{
			$x=0; $crop=''; $variety=''; $qty='';$gqty=''; $nomp='';
			
			$lotn=$row_issue1['disp_id'];
			
			$sql_sub="Select * from tbl_disp_sub where plantcode='".$plantcode."' and disp_id='".$lotn."' and disps_nvariety IN ('4226', '4325', '4266', '4343', '4388', '4001', '2377', '2245', '2355 Plus', '2233', '2111', '2375 Plus', 'Laxmi Plus', 'Mini Bhog', 'Virat') ";
			$adsub=mysqli_query($link,$sql_sub) or die(mysqli_error($link));				
			$tsub=mysqli_num_rows($adsub);
			if($tsub> 0)
			{
				while($rwsub=mysqli_fetch_array($adsub))
				{
					$wt=0; $gwt=0; $nmp=0;
					$sql_sub_sub="Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and disp_id='".$lotn."' and disps_id='".$rwsub['disps_id']."' ";
					$ad=mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));				
					$t=mysqli_num_rows($ad);
					if($t> 0)
					{
						while($rw=mysqli_fetch_array($ad))
						{
							$wt=$wt+$rw['dpss_qty'];
							$gwt=$gwt+$rw['dpss_grosswt'];
							$nmp++;
						}
						if($wt>0)
						{
							if($crop!="")$crop=$crop.",".$rwsub['disps_crop']; else $crop=$rwsub['disps_crop'];
							if($variety!="")$variety=$variety.",".$rwsub['disps_nvariety']; else $variety=$rwsub['disps_nvariety'];
							if($qty!="")$qty=$qty.",".$wt; else $qty=$wt;
							if($gqty!="")$gqty=$gqty.",".$gwt; else $gqty=$gwt;
							if($nomp!="")$nomp=$nomp.",".$nmp; else $nomp=$nmp;
							$x++;
						}
					}
					
					
				}
			}
			if($x>0)
			{
				
				$dts=explode("-",$row_issue1['disp_dodc']);
				
				echo "Dispatch Date: ".$dts[2]."-".$dts[1]."-".$dts[0];
				echo "<br />";
				$crparr=explode(",",$crop);
				$verarr=explode(",",$variety);
				$qtarr=explode(",",$qty);
				$gqtarr=explode(",",$gqty);
				$nmparr=explode(",",$nomp);
				$count=count($crparr);
				for($i=0; $i<$count; $i++)
				{
					echo $crparr[$i]." - ".$verarr[$i]." - Qty: ".$qtarr[$i]." NoMP: ".$nmparr[$i];
					echo "<br />";
				}
				echo "-----------------------------------------------------------------------------------------";
				echo "<br />";
			}
		}
		echo "==========================================================================================";
		echo "<br />";
	}
	/*echo $z."  -  ".$x;
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";*/
?>