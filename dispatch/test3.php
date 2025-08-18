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
	$sql_issue1=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno IN ('DF10511/00000/00P','DF10512/00000/00P','DK00033/00000/01P','DK00038/00000/02P','DN03807/00000/00P','DN03807/00001/01P','DN10158/00000/00P','DP00278/00000/00P','DP00279/00000/00P','DP00543/00000/00P')") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
			
		$sql_issuetbl2=mysqli_query($link,"SELECT Max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE plantcode='".$plantcode."' and  lotno='".$row_issue1['lotno']."' ORDER BY lotdgp_id ASC") or die(mysqli_error($link));
		$row_issuetbl2=mysqli_fetch_array($sql_issuetbl2);
							
		$sql_issuetbl=mysqli_query($link,"SELECT * FROM tbl_lot_ldg_pack WHERE plantcode='".$plantcode."' and  lotdgp_id='".$row_issuetbl2[0]."' ORDER BY lotdgp_id ASC") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_issuetbl); 
		if($t>0)
		{
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{						
				$sql_sub_sub="INSERT INTO tbl_lot_ldg_pack (lotldg_id, trtype, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid, subbinid, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_spremflg,plantcode) VALUES ('".$row_issuetbl['lotldg_id']."', 'PSWSUC', '".$row_issuetbl['trstage']."', '".$row_issuetbl['packtype']."', '".$row_issuetbl['lotno']."', '".$row_issuetbl['packlabels']."', '".$row_issuetbl['barcodes']."', '".$row_issuetbl['wtinmp']."', '0', '0', '0.000', '".$row_issuetbl['whid']."', '".$row_issuetbl['binid']."', '".$row_issuetbl['subbinid']."', '".$row_issuetbl['opnop']."', '".$row_issuetbl['opnomp']."', '".$row_issuetbl['optqty']."', '".$row_issuetbl['opnop']."', '".$row_issuetbl['opnomp']."', '".$row_issuetbl['optqty']."', '".$row_issuetbl['lotldg_trdate']."', '".$row_issuetbl['yearcode']."', '".$row_issuetbl['lotldg_variety']."', '".$row_issuetbl['lotldg_crop']."', '".$row_issuetbl['lotldg_sstage']."', '".$row_issuetbl['lotldg_sstatus']."', '".$row_issuetbl['lotldg_moisture']."', '".$row_issuetbl['lotldg_gemp']."', '".$row_issuetbl['lotldg_vchk']."', '".$row_issuetbl['lotldg_got1']."', '".$row_issuetbl['lotldg_qc']."', '".$row_issuetbl['lotldg_qctestdate']."', '".$row_issuetbl['orlot']."', '".$row_issuetbl['lotldg_resverstatus']."', '".$row_issuetbl['lotldg_revcomment']."', '".$row_issuetbl['lotldg_gottestdate']."', '".$row_issuetbl['lotldg_got']."', '".$row_issuetbl['lotldg_srtyp']."', '".$row_issuetbl['lotldg_srflg']."', '".$row_issuetbl['lotldg_genpurity']."', '".$row_issuetbl['lotldg_dop']."', '".$row_issuetbl['lotldg_valperiod']."', '".$row_issuetbl['lotldg_valupto']."', '".$row_issuetbl['lotldg_rvflg']."', '".$row_issuetbl['lotldg_alflg']."', '".$row_issuetbl['lotldg_dispflg']."', '".$row_issuetbl['lotldg_altrids']."', '".$row_issuetbl['lotldg_alqtys']."', '".$row_issuetbl['lotldg_spremflg']."','$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				//echo $row_issue1['orlot']."<br />";
				//echo "<br />";
				$z++;
			}
		}					
	}
	//echo $z;
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";
?>