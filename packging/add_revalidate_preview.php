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

	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	if(isset($_REQUEST['sid']))
	{
	$sid = $_REQUEST['sid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$pid=trim($_POST['txtitem']);
		$sid=trim($_POST['sid']);
			
		$sql_arr=mysqli_query($link,"select * from tbl_revalidatetemp where  rv_id='".$sid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$trdate=$row_arr['rv_date'];
			$lotno=$row_arr['rv_lotno'];
			$newlotno=$row_arr['rv_newlot'];
						
			$crop=$row_arr['rv_crop'];
			$variety=$row_arr['rv_variety'];
			$ststus="Pack";
			$oldlotno=$row_arr['rv_orlot'];
			$stage="Pack";
			$ptptype=$row_arr['rv_rvtyp'];
			
			
			
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_arr['rv_variety']."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
			$sno=0; $srnonew=0;
			//echo $rowvariety['varietyid'];
			$p1_array=explode(",",$rowvariety['gm']);
			$p1_array2=explode(",",$rowvariety['wtmp']);
			$p1_array3=explode(",",$rowvariety['mptnop']);
			$p1=array();
			foreach($p1_array as $val1)
			{
				if($val1<>"")
				{
					$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
					$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
					$row12=mysqli_fetch_array($res);
					$upsid= $row12['ups']." ".$row12['wt'];
					//echo $row12['ups']; echo "  -  ";
					//echo $row12['wt']; echo "<br/>";
					if($upsid==$row_arr['rv_ups'])
					{
						$wtmp=$p1_array2[$srnonew];
						$mptnop=$p1_array3[$srnonew];
						$wtnopkg=$row12['uom'];
					}
				}
				$srnonew++;
			}
			
			
			
			
			$zzz=implode(",", str_split($row_arr['rv_newlot']));
			$gln=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
			$orlot=$gln;
			
			$zzz=implode(",", str_split($row_arr['rv_lotno']));
			$gln23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
			$orlot23=$gln23;
			
			$upss=$row_arr['rv_ups'];
			$labels=$row_arr['rv_slable']."-".$row_arr['rv_elable'];
			
			$sql_variety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_variety);
			
						
			$a="";
			$sql_barcode2=mysqli_query($link,"Select * from tbl_barcodestmp where bar_lotno='".$row_arr['rv_newlot']."' and bar_psrn='".$row_arr['rv_rvpsrn']."' and bar_tid='".$row_arr['rv_pid']."' and bar_logid='".$row_arr['rv_logid']."'") or die(mysqli_error($link));
			$tot_barcode2=mysqli_num_rows($sql_barcode2);
			if($tot_barcode2 > 0)
			{
				while($row_barcode2=mysqli_fetch_array($sql_barcode2))
				{
					$barcode=$row_barcode2['bar_barcodes'];
					$grosswt=$row_barcode2['bar_grosswt'];
					$dt=$row_barcode2['bar_wtdate'];
					$tim=$row_barcode2['bar_wttime'];
					$poprid=$row_barcode2['bar_poprid'];
					$bar_crop=$row_barcode2['bar_crop'];
					$bar_variety=$row_barcode2['bar_variety'];
					$bar_ups=$row_barcode2['bar_ups'];
					$bar_dop=$row_barcode2['bar_dop'];
					$bar_vdate=$row_barcode2['bar_vdate'];
					$bar_netweight=$row_barcode2['bar_netweight'];
					if($a!="")
					$a=$a.",".$barcode;
					else
					$a=$barcode;
					
					$sql_barcode="Insert into tbl_barcodes (bar_trid, bar_trtype, bar_subtrid, bar_lotno, bar_orlot, bar_barcode, bar_grosswt, bar_wtdate, bar_wttime, bar_poprid, logid, yearid, bar_crop, bar_variety, bar_ups, bar_dop, bar_vdate, bar_netweight, plantcode) values('$pid', 'PACKRV', '$subtranid', '$newlotno', '$oldlotno', '$barcode', '$grosswt', '$dt', '$tim', '$poprid', '$logid', '$yearid_id', '$bar_crop', '$bar_variety', '$bar_ups', '$bar_dop', '$bar_vdate', '$bar_netweight', '$plantcode')";
					//echo "<br/>";
					mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
				}
			}
			$dop=$row_arr['rv_dorvp'];			
			$dovalidy=$row_arr['rv_valperiod'];
			$dov=$row_arr['rv_valupto'];
			$dovdays=$row_arr['rv_valdays'];
			$oldtid="";
			$sql_arrsub=mysqli_query($link,"select * from tbl_revalidatetmp_sub2 where  rv_id ='".$row_arr['rv_id'] ."'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				/*$sql_issueg=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotno='".$lotno."' and packtype='".$upss."' and subbinid='".$row_arrsub['rvs_sbinid']."'") or die(mysqli_error($link));
				while($row_issueg=mysqli_fetch_array($sql_issueg))
				{ */
					$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."' and packtype='".$upss."' and subbinid='".$row_arrsub['rvs_sbinid']."'") or die(mysqli_error($link));
					$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
					$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty>0") or die(mysqli_error($link)); 				$totnog=mysqli_num_rows($sql_issuetblg);
					$row_issuetblg=mysqli_fetch_array($sql_issuetblg);
						
					
					$moist=$row_issuetblg['lotldg_moisture'];
					$gemp=$row_issuetblg['lotldg_gemp'];
					$vchk=$row_issuetblg['lotldg_vchk'];
					$genpurity=$row_issuetblg['lotldg_genpurity'];
					$qc=$row_issuetblg['lotldg_qc'];
					$dot=$row_issuetblg['lotldg_qctestdate'];
					$got=$row_issuetblg['lotldg_got'];
					$got1=$row_issuetblg['lotldg_got1'];
					$dogr=$row_issuetblg['lotldg_gottestdate'];
					$gs=$row_issuetblg['lotldg_gs'];
					$resverstatus=$row_issuetblg['lotldg_resverstatus'];
					$revcomment=$row_issuetblg['lotldg_revcomment'];
					$whid=$row_issuetblg['whid'];
					$binid=$row_issuetblg['binid'];
					$subbinid=$row_issuetblg['subbinid'];
					
					$ups=$row_arrsub['rvs_nop'];
					$nomp=0;
					$qty=$row_arrsub['rvs_qty'];
						
					$dop2=$row_issuetblg['lotldg_dop'];
					$dovalidy2=$row_issuetblg['lotldg_valperiod'];
					$dov2=$row_issuetblg['lotldg_valupto'];
							
					$opnop=$row_issuetblg['balnop'];
					$opnomp=$row_issuetblg['balnomp'];
					$optqty=$row_issuetblg['balqty'];
					
					$alflg=$row_issuetblg['lotldg_alflg'];
					$dspflg=$row_issuetblg['lotldg_dispflg'];
				
					$balups=$opnop-$ups;
					$balnomp=$opnomp-$nomp;
					$balqty=$optqty-$qty;
					$rvflg=0;
					//if($ptptype!="entire")$rvflg=1;
					
						
					$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid,  subbinid,  nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, plantcode) values('$yearid_id', 'PACKRVO', '$pid', '$stage', '$upss', '$lotno', '', '', '$wtmp', '$opnop', '$opnomp', '$optqty', '$whid', '$binid', '$subbinid', '$ups', '$nomp' ,'$qty', '$balups', '$balnomp', '$balqty', '$trdate', '$crop', '$variety', '$stage', '', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$dot', '$orlot23', '$resverstatus', '$revcomment', '$dogr', '$got', '', '', '$genpurity', '$dop2', '$dovalidy2', '$dov2', '$rvflg', '$alflg', '$dspflg', '$plantcode')";
					if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
					{
						$oldtid1=mysqli_insert_id($link);
						if($oldtid!="")
							$oldtid=$oldtid.",".$oldtid1;
						else
							$oldtid=$oldtid1;
						/*if($ptptype=="entire")	
						{
							$sql_sub_sub65="update tbl_lot_ldg_pack set lotldg_rvflg=0 where orlot='$orlot23'";
							$awcmyt=mysqli_query($link,$sql_sub_sub65) or die(mysqli_error($link));
						}*/
					}	
					
				//}
				$sql_sub_sub2="insert into tbl_revalidate_sub2 (rv_id, rvs_whid, rvs_binid, rvs_sbinid, rvs_nop, rvs_qty, plantcode) values('$pid', '$whid', '$binid', '$subbinid', '$ups', '$qty', '$plantcode')";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));	
			}	
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_revalidatetmp_sub where rv_id ='".$row_arr['rv_id'] ."'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$whid=$row_arrsub['rvs_whid'];
				$binid=$row_arrsub['rvs_binid'];
				$subbinid=$row_arrsub['rvs_sbinid'];
				$ups=$row_arrsub['rvs_nop'];
				$nomp=$row_arrsub['rvs_nomp'];
				$qty=$row_arrsub['rvs_qty'];
					
				$opups=0;
				$opnomp=0;
				$opqty=0;
				$balups=$opups+$ups;
				$balnomp=$opnomp+$nomp;
				$balqty=$opqty+$qty;
				$rvflg=0;
				//if($lotno!=$newlotno && $ptptype!="entire")$rvflg=1;		
				
				$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid,  subbinid,  nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, plantcode) values('$yearid_id', 'PACKRV', '$pid', '$stage', '$upss', '$newlotno', '$labels', '$a', '$wtmp', '0', '0', '0', '$whid', '$binid', '$subbinid', '$ups', '$nomp' ,'$qty', '$balups', '$balnomp', '$balqty', '$trdate', '$crop', '$variety', '$stage', '', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$dot', '$orlot', '', '', '$dogr', '$got', '', '', '$genpurity', '$dop', '$dovalidy', '$dov', '$rvflg', '$alflg', '$dspflg', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));

				$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
				mysqli_query($link,$sql_itm) or die(mysqli_error($link));
				
				$sql_sub_sub2="insert into tbl_revalidate_sub (rv_id, rvs_whid, rvs_binid, rvs_sbinid, rvs_nop, rvs_nomp, rvs_qty, plantcode) values('$pid', '$whid', '$binid', '$subbinid', '$ups', '$nomp', '$qty', '$plantcode')";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));
			}
			
			$pckt=explode(" ",$upss);
			$ptp=0; $nopinmp=0;
			if($pckt[1]=="Gms")
			{
				$nnoopp=$pckt[0];
				$nopinmp=$wtmp*(1000/$nnoopp);
				//$ptp=(($pckt[0]*$nopinmp)/1000);
			}
			else
			{
				$nnoopp=$pckt[0]*1000;
				$nopinmp=$wtmp*(1000/$pckt[1]);
				//$ptp=($pckt[0]*$nopinmp);
			}
					
			$b_arr=explode(",",$a);
							
			$nobcd="";
			foreach($b_arr as $bval1)
			{
				if($bval1<>"")
				{
					$sql_barcode24="update tbl_barcodes set bar_wtmp='$wtmp', bar_orlot='$orlot' where bar_trid='$pid' and bar_lotno='$lotno' and bar_barcode='$bval1'";
					mysqli_query($link,$sql_barcode24) or die(mysqli_error($link));
									
					$sql_tbl_barsub=mysqli_query($link,"select * from tbl_btslsub where  btslsub_barcode='".$bval1."'") or die(mysqli_error($link));
					$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
					while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
					{
						$brcod=$rowbarcsub['btsl_id'];
						if($nobcd!="")
							$nobcd=$nobcd.",".$brcod;
						else
							$nobcd=$brcod;
					}
									
					$sql_bstls="delete from tbl_btslsub where btslsub_barcode='".$bval1."'";
					mysqli_query($link,$sql_bstls) or die(mysqli_error($link));
									
					$sql_ins_main24="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_lotnop, plantcode) values('$trdate', '$pid', 'PACKSMC', '$crop', '$variety', '$newlotno', '$upss', '$bval1', '$wtmp', '$nopinmp', '0', '0', '$nopinmp', '$wtmp', '$nopinmp', '$wtmp', '$whid', '$binid', '$subbinid', '$yearcode', '$logid', '$nopinmp', '$plantcode')";
					mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));
				}
			}
			
			
			
				
				
				$dt=date("Y-m-d"); $leduration=''; $ledate=''; 
				
				$sqlisstbl2=mysqli_query($link,"select * from tbl_lemain where  le_lotno='".$lotno."'") or die(mysqli_error($link)); 
				if($totisstbl2=mysqli_num_rows($sqlisstbl2)>0)
				{
					$rowisstbl2=mysqli_fetch_array($sqlisstbl2);
					$leduration=$rowisstbl2['le_duration'];
					$ledate=$rowisstbl2['le_upto'];
				}	
				$sqlisstbl=mysqli_query($link,"select * from tbl_lemain where  le_lotno='".$newlotno."'") or die(mysqli_error($link)); 
				if($totisstbl=mysqli_num_rows($sqlisstbl)>0)
				{
					$rowisstbl=mysqli_fetch_array($sqlisstbl);
					//$sqlsubsub1="UPDATE tbl_lemain SET le_duration='$leduration', le_upto='$ledate'  where le_lotno='$newlotno' and le_stage='$sstage2'";
					//mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
				}
				else
				{
					$sqlsubsub1="insert into tbl_lemain (le_lotno, le_stage, le_duration, le_upto, plantcode) values( '$newlotno' ,'$txtstage', '$leduration','$ledate', '$plantcode')";
					mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
				
				
					$sqlsubsub13="insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid, plantcode) values( '$newlotno' ,'$sstage2', '$leduration','$ledate', '$dt', 'Packing Slip', '$logid' , '$plantcode')";
					mysqli_query($link,$sqlsubsub13) or die(mysqli_error($link));
				}
				
				
				
		}
		
		$sql_code="SELECT MAX(rv_code) FROM tbl_revalidate where rv_yearcode='$yearid_id'  ORDER BY rv_code DESC";
		$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
		{
			$row_code=mysqli_fetch_row($res_code);
			$t_code=$row_code['0'];
			$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
		$sql_tbl25=mysqli_query($link,"select * from tbl_revalidatetemp where rv_id='".$sid."'") or die(mysqli_error($link));
		$row_tbl25=mysqli_fetch_array($sql_tbl25);	
				
		$sql_sub24="update tbl_revalidate set rv_date='".$row_tbl25['rv_date']."', rv_newlot='".$row_tbl25['rv_newlot']."', rv_orlot='".$row_tbl25['rv_orlot']."', rv_rvpsrn='".$row_tbl25['rv_rvpsrn']."', rv_dorvp='".$row_tbl25['rv_dorvp']."', rv_qcnop='".$row_tbl25['rv_qcnop']."', rv_bnop='".$row_tbl25['rv_bnop']."', rv_bqty='".$row_tbl25['rv_bqty']."', rv_valperiod='".$row_tbl25['rv_valperiod']."', rv_valupto='".$row_tbl25['rv_valupto']."', rv_valdays='".$row_tbl25['rv_valdays']."', rv_slable='".$row_tbl25['rv_slable']."', rv_elable='".$row_tbl25['rv_elable']."', rv_rvtyp='".$row_tbl25['rv_rvtyp']."', rv_mptyp='".$row_tbl25['rv_mptyp']."', rv_pl='".$row_tbl25['rv_pl']."', rv_pnomp='".$row_tbl25['rv_pnomp']."', rv_bpch='".$row_tbl25['rv_bpch']."', rv_rvflg=1, rv_code='$code' where rv_id='$pid'";
		mysqli_query($link,$sql_sub24) or die(mysqli_error($link));
				
		$sql_btslm23="update tbl_revalidatetemp set rv_tflg=1, rv_rvflg=1 where rv_id='$sid'";
		$xcvb3=mysqli_query($link,$sql_btslm23) or die(mysqli_error($link));
		
		/*if($ptptype!="entire")
		{
			$sql_code2="SELECT MAX(rv_tcode) FROM tbl_revalidate where rv_yearcode='$yearid_id'  ORDER BY rv_tcode DESC";
			$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
				
			if(mysqli_num_rows($res_code2) > 0)
			{
				$row_code2=mysqli_fetch_row($res_code2);
				$t_code2=$row_code2['0'];
				$code2=$t_code2+1;
			}
			else
			{
				$code2=1;
			}
				
			$sql_tbl=mysqli_query($link,"select * from tbl_revalidate where rv_id='".$pid."'") or die(mysqli_error($link));
			$row_tbl=mysqli_fetch_array($sql_tbl);
			
			$zxcv=$row_tbl25['rv_qcnop']+$row_tbl25['rv_pl'];
			$pckt=explode(" ",$row_tbl['rv_ups']);
			$ptp=0; $nopinmp=0;
			if($pckt[1]=="Gms")
			{
				$ptp=(($pckt[0]*$zxcv)/1000);
				//$nnoopp=$pckt[0];
				//$nopinmp=$wtmp*(1000/$nnoopp);
			}
			else
			{
				$ptp=($pckt[0]*$zxcv);
				//$nnoopp=$pckt[0]*1000;
				//$nopinmp=$wtmp*(1000/$pckt[1]);
			}
			
			$np=$row_tbl25['rv_bnop']+$zxcv;
			$qt=round($row_tbl25['rv_bqty'],3)+round($ptp,3);
			$bnop=$row_tbl25['rv_enop']-$np;
			$bqty=round($row_tbl25['rv_eqty'],3)-round($qt,3);
			
			$sql_sub="insert into tbl_revalidate (rv_date, rv_crop, rv_variety, rv_lotno, rv_ups, rv_enop, rv_enomp, rv_eqty, rv_qc, rv_dot, rv_got, rv_got1, rv_dogt, rv_tcode, rv_logid, rv_yearcode) values('".$row_tbl['rv_date']."', '".$row_tbl['rv_crop']."', '".$row_tbl['rv_variety']."', '".$row_tbl['rv_lotno']."', '".$row_tbl['rv_ups']."', '".$bnop."', '', '$bqty', '".$row_tbl['rv_qc']."', '".$row_tbl['rv_dot']."', '".$row_tbl['rv_got']."', '".$row_tbl['rv_got1']."', '".$row_tbl['rv_dogt']."', '$code2', '$logid', '$yearid_id')";
			mysqli_query($link,$sql_sub) or die(mysqli_error($link));
		}*/
		//exit;
		echo "<script>window.location='select_rv_op.php?p_id=$pid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Transaction - Pack Seed Re-Printing - Preview</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="rv.js"></script>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}


function openslocpopprint()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
var sid=document.frmaddDepartment.sid.value;

winHandle=window.open('rv_details_print.php?itmid='+itm+'&sid='+sid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}



function mySubmit()
{ 
	if(document.frmaddDepartment.verflg.value!=0)
	{
		alert("Please Verify the Sales Return Lots first");
		return false;
	}
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		return true;	 
	}
	else
	{
		return false;
	} 
}
function detailspop(totnomp,tid,lotno,txtpsrn,subtid,dval)
{
winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}					
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed Re-Printing - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$sid;
$sql_tbl2=mysqli_query($link,"select * from tbl_revalidate where plantcode='$plantcode' and rv_id='".$pid."'") or die(mysqli_error($link));
$row_tbl2=mysqli_fetch_array($sql_tbl2);	

$sql_tbl=mysqli_query($link,"select * from tbl_revalidatetemp where plantcode='$plantcode' and rv_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['rv_id'];

	$tdate=$row_tbl['rv_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['rv_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['rv_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);

?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="Hidden" name="sid" value="<?php echo $sid?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Re-Printing</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRV".$row_tbl2['rv_tcode']."/".$row_tbl2['rv_yearcode']."/".$row_tbl2['rv_logid'];?></td>

<td width="138" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td width="234" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_lotno'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_ups'];?></td>
</tr>
<?php
$orlot=$row_tbl['rv_lotno'];
$dot="";
if($row_tbl['rv_dot']!="" && $row_tbl['rv_dot']!="0000-00-00")
{
$dt=explode("-",$row_tbl['rv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotno='".$lotno."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
	
if($dot=="" && ($qc=="OK" || $qc=="Fail"))
{
	$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
	$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
	
$dgt=explode("-",$row_tbl['rv_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$dvt=explode("-",$row_tbl['rv_dorvp']);
$dorvp=$dvt[2]."-".$dvt[1]."-".$dvt[0];

$dovt=explode("-",$row_tbl['rv_valupto']);
$dov=$dovt[2]."-".$dovt[1]."-".$dovt[0];

if($dot!="")
{
	$trdate2=explode("-",$dot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
//echo $dp3;


$np=$row_tbl['rv_bnop']+$row_tbl['rv_qcnop']+$row_tbl['rv_pl'];
$ups=explode(" ",$row_tbl['rv_ups']);
$pt="";
if($ups[1]=="Gms")
{
	$pt=(($ups[0])/1000);
}
else
{
	$pt=$ups[0];
}

$qt=$pt*$np;
$np=(int)$np;
$qt=(float)$qt;
$enp=(int)$row_tbl['rv_enop'];
$eqt=(float)$row_tbl['rv_eqty'];
$bnp=$enp-$np;
$bqt=$eqt-$qt;
if($row_tbl['rv_rvtyp']=="entire")
{
$bnp=0;
$bqt=0;
}
$lotno=$row_tbl2['rv_lotno'];

$zzz=implode(",", str_split($lotno));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where plantcode='$plantcode' and SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where plantcode='$plantcode' and SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."P";
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";

$tflg=0;
if($row_tbl['rv_enop'] == 1)$tflg++;
$tflg++;
?>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_enop'];?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_eqty'];?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_qc'];?></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $row_tbl['rv_got'];?></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?></td>
<input type="hidden" name="orlot" value="<?php echo $row_arrival['rv_orlot'];?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td align="right" width="105"  valign="middle" class="tblheading">Re-Printing&nbsp;</td>
<td align="left" width="191" valign="middle" class="tblheading"   >&nbsp;<?php echo ucwords($row_tbl['rv_rvtyp']);?></td>
<td align="left"  valign="middle" class="tblheading" colspan="2" id="batchchk">&nbsp;<?php if($row_tbl['rv_rvtyp']=="partial") echo "Batch No. Generated - <font color=red>YES</font>"; else if($row_tbl['rv_rvtyp']=="entire") echo "Batch No. Generated - <font color=red>YES</font>"; else echo ""; ?></td>
<td align="right" width="113"  valign="middle" class="tblheading">Lot number&nbsp;</td>
<td align="left" width="221"  valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_newlot'];?></td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="105"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<?php echo $np;?></td>	
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right" width="113" valign="middle" class="tblheading">Balance NoP&nbsp;</td>
<td align="left" width="221" valign="middle" class="tbltext">&nbsp;<?php echo $bnp;?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right" width="105"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<?php echo $qt;?></td>	
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right" width="113" valign="middle" class="tblheading">Balance Qty&nbsp;</td>
<td align="left" width="221" valign="middle" class="tbltext">&nbsp;<?php echo $bqt;?></td>	
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Re-Printing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Re-Printing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoP</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoP</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoP</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0; $rqty=0; $rnob=0; $blqty=0; $blnob=0;
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
{ 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgP_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;

$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 

if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
	$ptp1=($packtp[0]/1000);
}
else
{
	if($packtp[0]<1)
	{
		$ptp=(1000/$packtp[0])/1000;
		$ptp1=($packtp[0]/1000)*1000;
	}
	else
	{
		$ptp=$packtp[0];
		$ptp1=$packtp[0];
	}
	//$ptp=$packtp[0];
	//$ptp1=$packtp[0];
}
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp*$penqty);
	}
	else
	{
	if($packtp[0]<1)
		$nop1=($penqty*$ptp);
	else
		$nop1=($penqty/$ptp);
	}	
	//$nop1=($ptp*$penqty);
}

$nop=$nop1; 
//$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$row_issuetbl['balqty'];

$tqty=$qty;
$tnob=$nop; 
$totqty=$totqty+$tqty; 
$totnob=$totnob+$tnob; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;

$sql_sub2=mysqli_query($link,"Select * from tbl_revalidatetmp_sub2 where plantcode='$plantcode' and rv_id='$arrival_id' and rvs_sbinid='".$row_issuetbl['subbinid']."'") or die(mysqli_error($link));
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2 > 0)	
{
$row_sub2=mysqli_fetch_array($sql_sub2);
$rnob=$row_sub2['rvs_nop']; 
$rqty=$row_sub2['rvs_qty'];
}
$blqty=$tqty-$rqty; 
$blnob=$tnob-$rnob;

if($row_tbl['rv_rvtyp']=="entire")
{
$blnob=0;
$blqty=0;
}
?>
<tr class="Light" height="30">
	<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?></td>
	<td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $rnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $rqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $blnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $blqty;?></td>
</tr>
<?php
}
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Re-Printing Details</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Re-Printing/Packing Slip Ref. No.&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_rvpsrn'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">Date of Re-Printing/Packing&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<?php echo $dorvp;?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">NoP for QC Sample&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_qcnop'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">NoP - Re-Printing Packing Loss&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_pl'];?></td>
</tr>
<tr class="Light" height="25">
<td width="107" align="right" valign="middle" class="tblheading">Balance Pouches&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_bnop'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">Balance Quantity&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_bqty'];?></td>
</tr>
<tr class="Light" height="25">
<td width="191" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_valperiod'];?>&nbsp;Months</td>
<td width="107" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dov;?></td>
<td width="112" align="right" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_valdays'];?>&nbsp;Days From DoT</td>
</tr>
<tr class="Light" height="25">  
<td align="right" valign="middle" class="tblheading">Label No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $row_tbl['rv_slable']." - ".$row_tbl['rv_elable'];?></td>
</tr>
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table><br />
<div id="pkgshow">
<?php 

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Packaging Details</td>
</tr>

<tr class="Light">
<td width="116" align="right" valign="middle" class="tblheading">Convert to MP&nbsp;</td>
<td width="144" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_mptyp'];?></td>
<td width="76" align="center" valign="middle" class="tblheading">No. of MP</td>

<td width="83" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_pnomp'];?></td>
<td width="140" align="center" valign="middle" class="tblheading">Balance Pouches</td>

<td width="82" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_bpch'];?></td>
<td width="130" align="center" valign="middle" class="tblheading">Barcode Labels</td>
<td width="61" align="center" valign="middle" class="tbltext" id="dtail_1"><a href="Javascript:void(0)" onclick="detailspop('<?php echo $row_tbl['rv_pnomp'];?>','<?php echo $pid;?>','<?php echo $row_tbl['rv_newlot'];?>','<?php echo $row_tbl['rv_rvpsrn'];?>','0','1')">Details</a></td>
</tr>
</table>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
</div><br />
<?php
	
	$sql_sub=mysqli_query($link,"Select * from tbl_revalidatetmp_sub where plantcode='$plantcode' and rv_id='$arrival_id'") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_sub);
	
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">SR Condition Seed - SLOC Details</td>
  </tr>
  <!--<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>-->
  <tr class="tblsubtitle" height="20">
  	<td width="26" align="center" valign="middle" class="tblheading">#</td>
    <td width="143" align="center" valign="middle" class="tblheading">WH</td>
    <td width="140" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="167" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="179" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="181" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
  
$srno=1;
if($tot_sub>0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sub['rvs_whid']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sub['rvs_binid']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sub['rvs_sbinid']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
if($srno%2==0)
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_qty'];?></td>
</tr>
<?php
}$srno++;
}
}
?>
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_revalidate.php?pid=<?php echo $pid;?>&sid=<?php echo $sid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  
