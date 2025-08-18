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
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
	$sql_arr=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	
	$sql_arrsub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$pid."'") or die(mysqli_error($link));
	$a_arrsub=mysqli_num_rows($sql_arrsub);
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
	
	$oldtid="";
	$sql_arrsubsub=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packaging_id='".$pid."' and packagingsub_id='".$row_arrsub['packagingsub_id']."'") or die(mysqli_error($link));
	$a_arrsubsub=mysqli_num_rows($sql_arrsubsub);
	while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
	{
		$crop=$row_arrsub['packagingsub_crop'];
		$variety=$row_arrsub['packagingsub_variety'];
		$lotno=$row_arrsubsub['packagingsubsub_lotno'];
		$arrival_date=$row_arr['packaging_tdate'];
		$drefno=$row_arr['packaging_slipno'];
		$lotstage="Pack";
		$packtype=$row_arrsubsub['packagingsubsub_upssize'];
		$packnomp=$row_arrsubsub['packagingsubsub_nomp'];
		$packnob=$row_arrsubsub['packagingsubsub_extnop'];
		$packqty=$row_arrsubsub['packagingsubsub_extqty'];
		$subtranid=$row_arrsub['packagingsub_id'];
		$dop=$row_arr['packaging_date'];
		$packnop=$row_arrsubsub['packagingsubsub_balpch'];
		$zxcv=$packnob-$packnop;
		$zzz=implode(",", str_split($lotno));
		$oldlot2=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26];
		$a="";
		$sql_barcode2=mysqli_query($link,"Select * from tbl_barcodestmp where bar_lotno='".$lotno."' and bar_psrn='".$drefno."'") or die(mysqli_error($link));
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
				
				
				$sql_mainbarc=mysqli_query($link,"select bar_barcode from tbl_barcodes where bar_barcode='".$barcode."' ") or die(mysqli_error($link));
				$a_mainbarc=mysqli_num_rows($sql_mainbarc);
				if($a_mainbarc == 0)
				{
					if($a!="")
					$a=$a.",".$barcode;
					else
					$a=$barcode;
					
					$sql_barcode="Insert into tbl_barcodes (bar_trid, bar_trtype, bar_subtrid, bar_lotno, bar_orlot, bar_barcode, bar_grosswt, bar_wtdate, bar_wttime, bar_poprid, logid, yearid, bar_crop, bar_variety, bar_ups, bar_dop, bar_vdate, bar_netweight, plantcode) values('$pid', 'PACKSLIP', '$subtranid', '$lotno', '$oldlot2', '$barcode', '$grosswt', '$dt', '$tim', '$poprid', '$logid', '$yearid_id', '$bar_crop', '$bar_variety', '$bar_ups', '$bar_dop', '$bar_vdate', '$bar_netweight', '$plantcode')";
					//echo "<br/>";
					mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
				}
			}
		}
		
		$cnnt=0;
		$otrid=0; 
		$sql_arrsubsub=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."' and packtype='".$packtype."'") or die(mysqli_error($link));
		$a_sub=mysqli_num_rows($sql_arrsubsub);
		while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
		{
		
		$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_arrsubsub['subbinid']."' and binid='".$row_arrsubsub['binid']."' and whid='".$row_arrsubsub['whid']."' and lotldg_variety='".$variety."' and lotno='".$lotno."' order by balqty desc") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty>0") or die(mysqli_error($link)); 
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{
				$otrid=$row_issuetbl['lotldg_id'];
				
					$whid=$row_issuetbl['whid'];
					$binid=$row_issuetbl['binid'];
					$subbinid=$row_issuetbl['subbinid'];
					$packlabels=$row_issuetbl['packlabels'];
					$barcodes=$row_issuetbl['barcodes'];
					$wtinmp=$row_issuetbl['wtinmp'];
					$opnop=$row_issuetbl['balnop'];
					$opnomp=$row_issuetbl['balnomp'];
					$optqty=$row_issuetbl['balqty'];
					$pcktyp=$row_issuetbl['packtype'];
					$packtp=explode(" ",$pcktyp);
					
					
					$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
					$totvariety=mysqli_num_rows($sqlvsriety);
					$rowvariety=mysqli_fetch_array($sqlvsriety);
					$srnonew=0;
					$p1_array=explode(",",$rowvariety['gm']);
					$p1_array2=explode(",",$rowvariety['wtmp']);
					$p1_array3=explode(",",$rowvariety['mptnop']);
					$p1_array4=explode(",",$row_var['mtype']);
					foreach($p1_array as $val1)
					{
						if($val1<>"")
						{
							$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
							$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
							if($row1234=mysqli_num_rows($res)>0)
							{
								$row12=mysqli_fetch_array($res);
								$uom=$row12['uom'];
								$wtmp=$p1_array2[$srnonew];
								$mptnop=$p1_array3[$srnonew];
								$mpptyp=$p1_array4[$srnonew];
							}
						}
						$srnonew++;
					}
					if($wtinmp<=0)
					{	
						$sqlsmain="update tbl_lot_ldg_pack set  wtinmp='$wtmp' where lotdgp_id='".$row_issuetbl['lotdgp_id']."'";
						$sdlk=mysqli_query($link,$sqlsmain) or die(mysqli_error($link));
	
						$wtinmp=$wtmp;
					}
					
					$pckt=explode(" ",$pcktyp);
					$ptp=0; $nopinmp=0;
					if($pckt[1]=="Gms")
					{
						$ptp=(($pckt[0]*$zxcv)/1000);
						$nnoopp=$pckt[0];
						$nopinmp=$wtinmp*(1000/$nnoopp);
					}
					else
					{
						$ptp=($pckt[0]*$zxcv);
						$nnoopp=$pckt[0]*1000;
						$nopinmp=$wtinmp*(1000/$pckt[1]);
					}
						//echo $nopinmp;
					$balnop=$packnop-$opnop;
					$balnomp=$opnomp+$packnomp;
					$balqty=$optqty;
						
					$sstage=$row_issuetbl['lotldg_sstage'];
					$sstatus=$row_issuetbl['lotldg_sstatus'];
					$moist=$row_issuetbl['lotldg_moisture'];
					$gemp=$row_issuetbl['lotldg_gemp'];
					$vchk=$row_issuetbl['lotldg_vchk'];
					$got1=$row_issuetbl['lotldg_got1'];
					$qc=$row_issuetbl['lotldg_qc'];
						
					$gotstatus=$row_issuetbl['lotldg_got'];
					$qctestdate=$row_issuetbl['lotldg_qctestdate'];
					$gottestdate=$row_issuetbl['lotldg_gottestdate'];
					$orlot=$row_issuetbl['orlot'];
					$srtyp=$row_issuetbl['lotldg_srtyp'];
					$srflg=$row_issuetbl['lotldg_srflg'];
					$resverstatus=$row_issuetbl['lotldg_resverstatus'];
					$revcomment=$row_issuetbl['lotldg_revcomment'];
					$geneticpurity=$row_issuetbl['lotldg_genpurity'];
					$yearcode=$row_issuetbl['yearcode'];
					$dop1=$row_issuetbl['lotldg_dop'];
					$valperiod=$row_issuetbl['lotldg_valperiod'];
					$valupto=$row_issuetbl['lotldg_valupto'];
					
					$rvflg=$row_issuetbl['lotldg_rvflg'];
					$alflg=$row_issuetbl['lotldg_alflg'];
					$dispflg=$row_issuetbl['lotldg_dispflg'];
					$altrids=$row_issuetbl['lotldg_altrids'];
					$alqtys=$row_issuetbl['lotldg_alqtys'];
					$alnomps=$row_issuetbl['lotldg_alnomps'];
					$spremflg=$row_issuetbl['lotldg_spremflg'];
						
					$barcodes2=$barcodes;
					if($barcodes2!="")
						$barcodes2=$barcodes2.",".$a;
					else
						$barcodes2=$a;
									
					$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_srtyp, lotldg_srflg, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, trstage, packtype, packlabels, barcodes, wtinmp, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$yearcode','PACKSMC', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opnop', '$opnomp', '$optqty', '$zxcv', '$packnomp', '$ptp', '$balnop', '$balnomp', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$srtyp', '$srflg', '$resverstatus', '$revcomment', '$geneticpurity', '$sstage', '$packtype', '$packlabels', '$barcodes2', '$wtinmp', '$dop1', '$valperiod', '$valupto', '$rvflg', '$alflg', '$dispflg', '$altrids', '$alqtys', '$alnomps', '$spremflg', '$plantcode')";
					
				//$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_srtyp, lotldg_srflg, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, trstage, packtype, packlabels, barcodes, wtinmp, lotldg_dop, lotldg_valperiod, lotldg_valupto) values('$yearcode','PACKSMC', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opnop', '$opnomp', '$optqty', '$opnop', '$opnomp', '$optqty', '$balnop', '$balnomp', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$srtyp', '$srflg', '$resverstatus', '$revcomment', '$geneticpurity', '$sstage', '$packtype', '$packlabels', '$barcodes', '$wtinmp', '$dop1', '$valperiod', '$valupto')";
				//exit;
				if(mysqli_query($link,$sql_ins_main) or die(mysqli_error($link)))
				{
					$oldtid1=mysqli_insert_id($link);
					if($oldtid!="")
					$oldtid=$oldtid.",".$oldtid1;
					else
					$oldtid=$oldtid1;
				}
				
			$cntg=0;
			
			$sql_issueg=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));

			while($row_issueg=mysqli_fetch_array($sql_issueg))
			 { 
				$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."'") or die(mysqli_error($link));
				$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
				$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
				$totnog=mysqli_num_rows($sql_issuetblg);
				if($totnog > 0)
				{
				  $cntg++;
				} 
			}
			
			$sql_issueg=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
			
			while($row_issueg=mysqli_fetch_array($sql_issueg))
			 { 
				$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and lotno='".$row_issueg['lotno']."'") or die(mysqli_error($link));
				$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
				$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
				$totnog=mysqli_num_rows($sql_issuetblg);
				if($totnog > 0)
				{
				  $cntg++;
				} 
			}
			  	if($cntg==0)
  				{
			    	$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
					mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
				}
		}
		}
		
				
		//echo $oldtid;
		
			$p1array=explode(",",$oldtid);
			$p1array=array_unique($p1array);
			foreach($p1array as $pval1)
			{
			
				if($pval1<>"")
				{
					$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$pval1."'") or die(mysqli_error($link)); 
					while($row_issuetbl22=mysqli_fetch_array($sql_issuetbl22))
					{
						$packtype2=$row_issuetbl22['packtype'];
						$packlabels2=$row_issuetbl22['packlabels'];
						$barcodes2=$row_issuetbl22['barcodes'];
						$wtinmp2=$row_issuetbl22['wtinmp'];
						$opnop2=$row_issuetbl22['opnop'];
						$opnomp2=$row_issuetbl22['opnomp'];
						$optqty2=$row_issuetbl22['optqty'];
						
						$sstage2=$row_issuetbl22['lotldg_sstage'];
						$sstatus2=$row_issuetbl22['lotldg_sstatus'];
						$moist2=$row_issuetbl22['lotldg_moisture'];
						$gemp2=$row_issuetbl22['lotldg_gemp'];
						$vchk2=$row_issuetbl22['lotldg_vchk'];
						$got12=$row_issuetbl22['lotldg_got1'];
						$qc2=$row_issuetbl22['lotldg_qc'];
						
						$gotstatus2=$row_issuetbl22['lotldg_got'];
						$qctestdate2=$row_issuetbl22['lotldg_qctestdate'];
						$gottestdate2=$row_issuetbl22['lotldg_gottestdate'];
						$orlot2=$row_issuetbl22['orlot'];
						$srtyp2=$row_issuetbl22['lotldg_srtyp'];
						$srflg2=$row_issuetbl22['lotldg_srflg'];
						$resverstatus2=$row_issuetbl22['lotldg_resverstatus'];
						$revcomment2=$row_issuetbl22['lotldg_revcomment'];
						$geneticpurity2=$row_issuetbl22['lotldg_genpurity'];
						$yearcode2=$row_issuetbl22['yearcode'];
						$dop12=$row_issuetbl22['lotldg_dop'];
						$valperiod2=$row_issuetbl22['lotldg_valperiod'];
						$valupto2=$row_issuetbl22['lotldg_valupto'];
						$lotno2=$row_issuetbl22['lotno'];
						
						$rvflg2=$row_issuetbl22['lotldg_rvflg'];
						$alflg2=$row_issuetbl22['lotldg_alflg'];
						$dispflg2=$row_issuetbl22['lotldg_dispflg'];
						$altrids2=$row_issuetbl22['lotldg_altrids'];
						$alqtys2=$row_issuetbl22['lotldg_alqtys'];
						$alnomps2=$row_issuetbl22['lotldg_alnomps'];
						$spremflg2=$row_issuetbl22['lotldg_spremflg'];
						
						$sql_arrsubsub3=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packaging_id='".$pid."' and packagingsub_id='".$row_arrsub['packagingsub_id']."'") or die(mysqli_error($link));
						$a_sub3=mysqli_num_rows($sql_arrsubsub3);
						if($a_sub3 > 0)
						{
						while($row_arrsubsub3=mysqli_fetch_array($sql_arrsubsub3))
						{
						
							$nop12=$row_arrsubsub3['packagingsubsub_nopch'];
							$nomp2=$row_arrsubsub3['packagingsubsub_nomp'];
							$qty12=$row_arrsubsub3['packagingsubsub_totqty'];
							$balnop2=$row_arrsubsub3['packagingsubsub_nopch'];
							$balnomp2=$opnomp2+$row_arrsubsub3['packagingsubsub_nomp'];
							$balqty2=$row_arrsubsub3['packagingsubsub_totqty'];
							$whid2=$row_arrsubsub3['packagingsubsub_wh'];
							$binid2=$row_arrsubsub3['packagingsubsub_bin'];
							$subbinid2=$row_arrsubsub3['packagingsubsub_subbin'];
							$sstage2="Pack";
							$ltnop=$packnob-$packnop;
							$b_arr=explode(",",$a);
							
							$nobcd="";
							foreach($b_arr as $bval1)
							{
								if($bval1<>"")
								{
									$sql_barcode24="update tbl_barcodes set bar_wtmp='$wtinmp2', bar_orlot='$orlot2' where bar_trid='$pid' and bar_subtrid='$subtranid' and bar_lotno='$lotno' and bar_barcode='$bval1'";
									mysqli_query($link,$sql_barcode24) or die(mysqli_error($link));
									
									$sql_tbl_barsub=mysqli_query($link,"select * from tbl_btslsub where btslsub_barcode='".$bval1."'") or die(mysqli_error($link));
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
									
									$sql_mpmainbarc=mysqli_query($link,"select mpmain_barcode from tbl_mpmain where mpmain_barcode='".$bval1."' ") or die(mysqli_error($link));
									$a_mpmainbarc=mysqli_num_rows($sql_mpmainbarc);
									if($a_mpmainbarc == 0)
									{
										$sql_ins_main24="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_lotnop, mpmain_mptype, plantcode) values('$arrival_date', '$pid', 'PACKSMC', '$crop', '$variety', '$lotno2', '$packtype', '$bval1', '$wtinmp', '$nopinmp', '0', '0', '$balnop2', '$balqty2', '$balnop2', '$balqty2', '$whid', '$binid', '$subbinid', '$yearcode', '$logid', '$ltnop', '$mpptyp', '$plantcode')";
										mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));
									}
								}
							}
							
							$zxcd1=explode(",", $nobcd);
							$zxcd=array_unique($zxcd1);
							foreach($zxcd as $bstlval)
							{
								if($bstlval<>"")
								{
									$sqlbstls=mysqli_query($link,"select * from tbl_btslsub where  btsl_id='".$bstlval."'") or die(mysqli_error($link));
									if($totbstls=mysqli_num_rows($sqlbstls)==0)
									{
										$sqlbstlm="delete from tbl_btslmain where btsl_id='".$bstlval."'";
										mysqli_query($link,$sqlbstlm) or die(mysqli_error($link));
									}
								}
							}
							/*if($barcodes2!="")
							$barcodes2=$barcodes2.",".$a;
							else
							$barcodes2=$a;
							$sql_ins_main24="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid) values('$arrival_date', '$pid', 'PACKSMC', '$crop', '$variety', '$lotno2', '$packtype', '$barcodes2', '$wtinmp', '$nopinmp', '0', '0', '$balnop2', '$balqty2', '$balnop2', '$balqty2', '$whid', '$binid', '$subbinid', '$yearcode', '$logid')";
							mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));*/
							//$sql_ins_main231="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_srtyp, lotldg_srflg, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, trstage, packtype, packlabels, barcodes, wtinmp, lotldg_dop, lotldg_valperiod, lotldg_valupto) values('$yearcode2','PACKSUC', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid2', '$binid2', '$subbinid2', '$opnop2', '$opnomp2', '$optqty2', '$nop12', '$nomp2', '$qty12', '$balnop2', '$balnomp2', '$balqty2', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlot2', '$srtyp2', '$srflg2', '$resverstatus2', '$revcomment2', '$geneticpurity2', '$sstage2', '$packtype2', '$packlabels2', '$barcodes2', '$wtinmp2', '$dop12', '$valperiod2', '$valupto2')";
								//exit;
							//mysqli_query($link,$sql_ins_main231) or die(mysqli_error($link));
								
							$sql_itmg231="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
							mysqli_query($link,$sql_itmg231) or die(mysqli_error($link));
				
						}
						}	
					}
				}
			}
		}
		}
		}
		$sql_code1="SELECT MAX(packaging_tcode) FROM tbl_packaging  ORDER BY packaging_tcode DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$ncode1=$t_code1+1;
		}
		else
		{ 
			$ncode1=1;
		}
	
	 $sql_main="update tbl_packaging set packaging_tflg=1, packaging_tcode=$ncode1  where packaging_id ='$pid'";
	 $a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	//exit;
	echo "<script>window.location='home_packaging_smc.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Packaging Slip- Preview</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading.js"></script>
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
	//alert(txtcrop);
	if(document.frmaddDepartment.txtitem.value!="")
	{
		var itm=document.frmaddDepartment.txtitem.value;
		winHandle=window.open('packagingslip_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		alert("Please Select Crop first.");
		document.frmaddDepartment.txtcrop.focus();
	}
}

function mySubmit()
{ 
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		return true;	 
	}
	else
	{
		return false;
	} 
}
function openpackdetails(subtid,tid)
{
	winHandle=window.open('packdetails_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Packaging slip - Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
   <?php
$tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['packaging_id'];

	$tdate=$row_tbl['packaging_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['packaging_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$sql_tblsub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
$subtid=0;
?>
 	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="970"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Edit Packaging Slip </td>
</tr>
<tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="25%"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>

<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['packaging_slipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tblsub['packagingsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="25%" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tblsub['packagingsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="25%" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
</tr>	
<input type="hidden" name="txtstage" value="Pack" />
</table><br />

<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="1%" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" rowspan="2" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="9%" rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="11%" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of MP</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td align="center" valign="middle" class="smalltblheading">PSW SLOC</td>
	<td width="8%" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
	</tr>
<tr class="tblsubtitle">
	<td width="262" align="center" valign="middle" class="smalltblheading">SLOC | MP | Loose Pchs | Total Pchs | Total Qty</td>
</tr>  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$lotno=""; $exqty=""; $expch=""; $upss=""; $nomps=""; $nopchs=""; $blpch=""; $nobarc="";
$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{
$lotno=$row_tbl_subsub2['packagingsubsub_lotno']; 
$exqty=$row_tbl_subsub2['packagingsubsub_extqty']; 
$expch=$row_tbl_subsub2['packagingsubsub_extnop']; 
$upss=$row_tbl_subsub2['packagingsubsub_upssize']; 
$nomps=$row_tbl_subsub2['packagingsubsub_nomp']; 
$remarks=$row_tbl_subsub2['packagingsubsub_remarks']; 
$blpch=$row_tbl_subsub2['packagingsubsub_balpch']; 
$nobarc=$row_tbl_subsub2['packagingsubsub_barcodes']; 

$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_lotno='$lotno' and packagingsubsub_upssize='$upss' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['packagingsubsub_subbin']."' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nomp=$row_tbl_subsub['packagingsubsub_nomp']; 
$nop=$row_tbl_subsub['packagingsubsub_nopch']; 
$totp=$row_tbl_subsub['packagingsubsub_totpch']; 

$diq=explode(".",$row_tbl_subsub['packagingsubsub_totqty']);
if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_tbl_subsub['packagingsubsub_totqty'];}
if($totqty > 0)
{
if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
}
}	

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	</tr>
  <?php
}
$srno++;
}
}
}
?>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_packagingslipsmc_slip.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
