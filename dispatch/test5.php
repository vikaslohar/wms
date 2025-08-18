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
	$sql_issue1=mysqli_query("select distinct orlot from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  orlot!=''") or die(mysqli_error($link$link));
	while($row_issue1=mysqli_fetch_array($link, $sql_issue1))
	{
			
		$lotn=$row_issue1['orlot'];
		$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  orlot='".$lotn."'")or die("Error:".mysqli_error($link));
		$totmo=mysqli_num_rows($sqlmonth);
		if($totmo>1)
		{
		while($rowmonth=mysqli_fetch_array($sqlmonth))
		{
			$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  orlot='".$lotn."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
			$rowmonth2=mysqli_fetch_array($sqlmonth2);
			
			$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$rowmonth2[0]."' and balqty>0 and balnomp<=0")or die("Error:".mysqli_error($link));
			while($rowmonth3=mysqli_fetch_array($sqlmonth3))
			{					
				$barcdss=$rowmonth3['barcodes'].",";
				$barcdsc=explode(",",$barcdss);
				foreach($barcdsc as $barcode)
				{
					if($barcode<>"")	
					{
						$sqlbar1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."' and (mpmain_dflg!=0 or mpmain_upflg!=0)") or die(mysqli_error($link));
						if($totbar1=mysqli_num_rows($sqlbar1) > 0)
						{			
							echo $row_issue1['orlot']."<br />";
							$z++;
						}
					}
				}			
			}
		}
		}					
	}
	echo $z;
	/*echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";*/
?>