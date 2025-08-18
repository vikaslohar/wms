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
	$sql_issue1=mysqli_query($link,"select * from tbl_arrpack_sub where plantcode='".$plantcode."' and  arrpacks_lotno IN ('HB80070/00000/00P','HB80043/00000/00P','HB90101/00000/00P') and arrpack_id=14") or die(mysqli_error($link));
	while($row_issue1=mysqli_fetch_array($sql_issue1))
	{
			
		$sql_issuetbl2=mysqli_query($link,"SELECT * FROM tbl_arrpack_subsub WHERE plantcode='".$plantcode."' and  arrpackss_lotno='".$row_issue1['arrpacks_lotno']."' and arrpack_id=14 ORDER BY arrpackss_id ASC") or die(mysqli_error($link));
		$row_issuetbl2=mysqli_fetch_array($sql_issuetbl2);
		
		
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='".$row_issue1['arrpacks_crop']."'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cp=$row_dept5['cropid'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='".$row_issue1['arrpacks_variety']."'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vt=$row_dept4['varietyid'];		
		
		$zz=str_split($row_issue1['arrpacks_lotno']);
 		$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
		$got1="GOT-NR ".$row_issue1['arrpacks_gotstatus'];
		$quer6=mysqli_query($link,"SELECT * FROM tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$row_issue1['arrpacks_lotno']."'"); 
		if($tot6=mysqli_num_rows($quer6)==0)
		{
			$sql_sub_sub="INSERT INTO tbl_lot_ldg_pack (lotldg_id, trtype, trstage, packtype, lotno, packlabels, wtinmp, opnop, opnomp, optqty, whid, binid, subbinid, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, yearcode, lotldg_variety, lotldg_crop, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_spremflg) VALUES (14,'Stock Transfer Arrival - Pack', 'Pack', '".$row_issue1['arrpacks_ups']."', '".$row_issue1['arrpacks_lotno']."', '".$row_issue1['arrpacks_pklable1']."', '".$row_issue1['arrpacks_wtmp']."', '0', '0', '0.000', '".$row_issuetbl2['arrpackss_whid']."', '".$row_issuetbl2['arrpackss_binid']."', '".$row_issuetbl2['arrpackss_subbinid']."', '".$row_issue1['arrpacks_nop']."', '".$row_issue1['arrpacks_nomp']."', '".$row_issue1['arrpacks_qty']."', '".$row_issue1['arrpacks_nop']."', '".$row_issue1['arrpacks_nomp']."', '".$row_issue1['arrpacks_qty']."', '2018-04-17', 'B', '".$vt."', '".$cp."', 'Pack', '', '".$row_issue1['arrpacks_moist']."', '".$row_issue1['arrpacks_germ']."', '".$row_issue1['arrpacks_pp']."', '".$got1."', '".$row_issue1['arrpacks_qcstatus']."', '".$row_issue1['arrpacks_qcdot']."', '".$ltno."', '', '', '".$row_issue1['arrpacks_gotdate']."', '".$row_issue1['arrpacks_gotstatus']."', '".$row_issue1['arrpacks_srtype']."', '".$row_issue1['arrpacks_srstatus']."', '".$row_issue1['arrpacks_dop']."', '0', '".$row_issue1['arrpacks_dov']."', '0', '0', '0', '', '0', '0')";
			if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
			{		
				$id=mysqli_insert_id($link);
				$a='';	
				$sql_issuetbl=mysqli_query($link,"SELECT * FROM tbl_arrpack_barcode WHERE plantcode='".$plantcode."' and  arrpackss2_lotno='".$row_issue1['arrpacks_lotno']."' and arrpack_id=14 ORDER BY arrpackss2_id ASC") or die(mysqli_error($link));
				$t=mysqli_num_rows($sql_issuetbl); 
				if($t>0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{						
						if($a!="")
						$a=$a.",".$row_issuetbl['arrpackss2_barcode'];
						else
						$a=$row_issuetbl['arrpackss2_barcode'];
						$quer7=mysqli_query($link,"SELECT * FROM tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$row_issuetbl['arrpackss2_barcode']."'"); 
						if($tot7=mysqli_num_rows($quer7)==0)
						{
							$sql_ins_main24="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_lotnop, mpmain_mptype,plantcode) values('2018-04-17', '14', 'PACKSMC', '$cp', '$vt', '".$row_issue1['arrpacks_lotno']."', '".$row_issue1['arrpacks_ups']."', '".$row_issuetbl['arrpackss2_barcode']."', '".$row_issue1['arrpacks_wtmp']."', '".$row_issue1['arrpackss2_lotnop']."', '0', '0', '".$row_issue1['arrpackss2_lotnop']."', '".$row_issue1['arrpackss2_lotqty']."', '".$row_issue1['arrpackss2_lotnop']."', '".$row_issue1['arrpackss2_barqty']."', '".$row_issuetbl2['arrpackss_whid']."', '".$row_issuetbl2['arrpackss_binid']."', '".$row_issuetbl2['arrpackss_subbinid']."', 'B', 'AR3', '".$row_issue1['arrpackss2_lotnop']."', '".$row_issuetbl['arrpackss2_bartype']."','$plantcode')";
							mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));
						}
						//echo $row_issue1['orlot']."<br />";
						//echo "<br />";
						$z++;
					}
				}
				
				$sqlsmain="update tbl_lot_ldg_pack set barcodes='$a' where lotdgp_id='".$id."'";
				$sdlk=mysqli_query($link,$sqlsmain) or die(mysqli_error($link));
			
			}
		}
		else
		{
			$row_dept6=mysqli_fetch_array($quer6);
			$id=$row_dept6['lotdgp_id'];
			$a='';	
			$sql_issuetbl=mysqli_query($link,"SELECT * FROM tbl_arrpack_barcode WHERE plantcode='".$plantcode."' and  arrpackss2_lotno='".$row_issue1['arrpacks_lotno']."' and arrpack_id=14 ORDER BY arrpackss2_id ASC") or die(mysqli_error($link));
			$t=mysqli_num_rows($sql_issuetbl); 
			if($t>0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{						
					if($a!="")
					$a=$a.",".$row_issuetbl['arrpackss2_barcode'];
					else
					$a=$row_issuetbl['arrpackss2_barcode'];
					
					$quer7=mysqli_query($link,"SELECT * FROM tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$row_issuetbl['arrpackss2_barcode']."'"); 
					if($tot7=mysqli_num_rows($quer7)==0)
					{
						$sql_ins_main24="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_lotnop, mpmain_mptype,plantcode) values('2018-04-17', '14', 'PACKSMC', '$cp', '$vt', '".$row_issue1['arrpacks_lotno']."', '".$row_issue1['arrpacks_ups']."', '".$row_issuetbl['arrpackss2_barcode']."', '".$row_issue1['arrpacks_wtmp']."', '".$row_issue1['arrpackss2_lotnop']."', '0', '0', '".$row_issue1['arrpackss2_lotnop']."', '".$row_issue1['arrpackss2_lotqty']."', '".$row_issue1['arrpackss2_lotnop']."', '".$row_issue1['arrpackss2_barqty']."', '".$row_issuetbl2['arrpackss_whid']."', '".$row_issuetbl2['arrpackss_binid']."', '".$row_issuetbl2['arrpackss_subbinid']."', 'B', 'AR3', '".$row_issue1['arrpackss2_lotnop']."', '".$row_issuetbl['arrpackss2_bartype']."','$plantcode')";
						mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));
					}
					//echo $row_issue1['orlot']."<br />";
					//echo "<br />";
					$z++;
				}
			}
			$sqlsmain="update tbl_lot_ldg_pack set barcodes='$a' where lotdgp_id='".$id."'";
			$sdlk=mysqli_query($link,$sqlsmain) or die(mysqli_error($link));	
		}					
	}
	//echo $z;
	echo "<script>alert('Updated......')</script>";
 	echo "<script>window.location='index1.php'</script>";
?>