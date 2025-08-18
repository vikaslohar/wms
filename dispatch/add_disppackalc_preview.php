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
	
	date_default_timezone_set("Asia/Kolkata");
	
	if(isset($_REQUEST['pid'])) { $pid = $_REQUEST['pid']; }
	
	$sq=mysqli_query($link,"Select * from tbl_disp where disp_tflg=1 and  disp_id='$pid'") or die(mysqli_error($link));
	while($ro=mysqli_fetch_array($sq))
	{
		echo "<script>window.location='select_disppackalc_op.php?p_id=$pid'</script>";	
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$dt=date("Y-m-d");
		$sql_arr=mysqli_query($link,"select * from tbl_disp where disp_id='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$ptype=$row_arr['disp_partytype'];
			
		 	$sqlcode27="SELECT dalloc_id FROM tbl_dalloc where dalloc_dflg!=1 and dalloc_party='".$row_arr['disp_party']."' ORDER BY dalloc_id DESC";
			$rescode27=mysqli_query($link,$sqlcode27)or die(mysqli_error($link));
			$t27=mysqli_num_rows($rescode27);
			$rowcode27=mysqli_fetch_array($rescode27);
			$dalcid2=$rowcode27['dalloc_id'];
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_disp_sub where disp_id='".$pid."'") or die(mysqli_error($link));
			$a_arrsub=mysqli_num_rows($sql_arrsub);
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$arrival_date=$row_arr['disp_date'];
				$cro=$row_arrsub['disps_crop'];
				$variet=$row_arrsub['disps_variety'];
				$ordernos=$row_arrsub['disps_ordno'];
				$subid=$row_arrsub['disps_id'];
				$tqt=$row_arrsub['disps_qty'];
				$dispstqt=$row_arrsub['disps_qty'];
				$tupsstype=$row_arrsub['disps_upstype'];
				$oruptyp="Yes";
				$tupss=$row_arrsub['disps_ups'];
				$subupss=$row_arrsub['disps_ups'];
				if($tupsstype=="NST")
				{
					$oruptyp="No";
					$zz=explode(" ",$row_arrsub['disps_ups']);
					$dq=explode(".",$zz[0]);
					$xfd=count($dq);
					if($tupsstype=="NST")
					{
						$qt1=$zz[0];
						if($dq[1]==000){$qt123=$dq[0];}else{$qt123=$dq[0].".".$dq[1];}
						//if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
					}
					else
					{
						if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
					}
					$tupss=$qt1." ".$zz[1];
					$tupss23=$qt123." ".$zz[1];
					//$tupss=$row_arrsub['disps_ups'];
				}
				else
				{
					$tupss=$row_arrsub['disps_ups'];
				}
				//echo $subid."  ->  ".$cro."  =  ".$variet."  =  ".$oruptyp."  =  ".$tupss."  =  ".$subupss."<br/>";
				if($row_arrsub['disps_qty'] > 0)
				{
					$xc2=explode(" ",$row_arrsub['disps_ups']);
					if($xc2[1]=="Gms")
					{
						$ptp2=1000/$xc2[0];
					}
					else
					{
						$ptp2=$xc2[0];
					}
					$tnop=$ptp2*$tqt;
					
					$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
					$row_dept5=mysqli_fetch_array($quer5);
					$opcrop=$row_dept5['cropid'];
					
					$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
					$row_dept4=mysqli_fetch_array($quer4);
					$opvariety=$row_dept4['varietyid'];	
					
					$cntflg=0;
					$sql_arrsub2=mysqli_query($link,"select distinct dpss_barcode, dpss_lotno from tbl_dispsub_sub where disp_id='".$pid."' and disps_id='".$subid."' and dpss_crop='$opcrop' and dpss_variety='$opvariety' and dpss_ups='$subupss'") or die(mysqli_error($link));
					$a_arrsub2=mysqli_num_rows($sql_arrsub2);
					if($a_arrsub2 > 0)
					{
						while($row_arrsub2=mysqli_fetch_array($sql_arrsub2))
						{
							$barlotno=$row_arrsub2['dpss_lotno'];
							//$ssid=$row_arrsub2['dpss_id'];
							
							$sql_arrsub_sub=mysqli_query($link,"select * from tbl_mpmain where mpmain_barcode='".$row_arrsub2['dpss_barcode']."'") or die(mysqli_error($link));
							while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
							{
								
								/*$whid=$row_arrsub_sub['mpmain_wh'];
								$binid=$row_arrsub_sub['mpmain_bin'];
								$subbinid=$row_arrsub_sub['mpmain_subbin'];*/
								$upss=$row_arrsub_sub['mpmain_upssize'];
								$pty=$row_arrsub_sub['mpmain_trtype'];
								
								if($pty=="PACKSMC" || $pty=="PACKNMC")
								{
									$crop=$row_arrsub_sub['mpmain_crop'];
									$variety=$row_arrsub_sub['mpmain_variety'];
									$lot=$row_arrsub_sub['mpmain_lotno'];
									$qty=$row_arrsub_sub['mpmain_wtmp'];
									$ups=$row_arrsub_sub['mpmain_lotnop'];
									$nomp=1;
									$zflg=0;
									if($barlotno==$lot)
									{
										$sql_issuesbin=mysqli_query($link,"select Distinct subbinid from tbl_lot_ldg_pack where lotno='".$lot."' and packtype='".$upss."' and lotldg_crop='$opcrop' and lotldg_variety='$opvariety'") or die(mysqli_error($link));
										while($row_issuesbin=mysqli_fetch_array($sql_issuesbin))
										{
											if($zflg==0)
											{
												$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotno='".$lot."' and packtype='".$upss."' and lotldg_crop='$opcrop' and lotldg_variety='$opvariety' and subbinid='".$row_issuesbin['subbinid']."'") or die(mysqli_error($link));
												$row_issue1=mysqli_fetch_array($sql_issue1);
													
												$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
												while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
												{	
													
													$opups=$row_issuetbl['balnop'];
													$opnomp=$row_issuetbl['balnomp'];
													$opqty=$row_issuetbl['balqty'];
													$olot=$row_issuetbl['orlot'];
													
													$whid=$row_issuetbl['whid'];
													$binid=$row_issuetbl['binid'];
													$subbinid=$row_issuetbl['subbinid'];
													
													$stage='Pack';
													$status=$row_issuetbl['lotldg_sstatus'];
													$moist=$row_issuetbl['lotldg_moisture'];
													$gemp=$row_issuetbl['lotldg_gemp'];
													$vchk=$row_issuetbl['lotldg_vchk'];
													$got1=$row_issuetbl['lotldg_got1'];
													$qc=$row_issuetbl['lotldg_qc'];
													
													$lotno=$row_issuetbl['lotno'];
													$gotstatus=$row_issuetbl['lotldg_got'];
													$qctestdate=$row_issuetbl['lotldg_qctestdate'];
													$gottestdate=$row_issuetbl['lotldg_gottestdate'];
													$orlot=$row_issuetbl['orlot'];
													$resverstatus=$row_issuetbl['lotldg_resverstatus'];
													$revcomment=$row_issuetbl['lotldg_revcomment'];
													$geneticpurity=$row_issuetbl['lotldg_genpurity'];
													$ycode=$row_issuetbl['yearcode'];
													$pcktyp=$row_issuetbl['packtype'];
													
													$packlabels=$row_issuetbl['packlabels'];
													$barcodes=$row_issuetbl['barcodes'];
													$wtinmp=$row_issuetbl['wtinmp'];
													$lotldg_dop=$row_issuetbl['lotldg_dop'];
													$lotldg_valperiod=$row_issuetbl['lotldg_valperiod'];
													$lotldg_valupto=$row_issuetbl['lotldg_valupto'];
													$lotldg_srtyp=$row_issuetbl['lotldg_srtyp'];
													$lotldg_srflg=$row_issuetbl['lotldg_srflg'];
													
													$lotldg_rvflg=$row_issuetbl['lotldg_rvflg'];
													$lotldg_alflg=$row_issuetbl['lotldg_alflg'];
													$lotldg_dispflg=$row_issuetbl['lotldg_dispflg'];
													$lotldg_altrids=$row_issuetbl['lotldg_altrids'];
													$lotldg_alqtys=$row_issuetbl['lotldg_alqtys'];
													$lotldg_alnomps=$row_issuetbl['lotldg_alnomps'];
													$lotldg_spremflg=$row_issuetbl['lotldg_spremflg'];
													$lotldg_totalqty=$row_issuetbl['lotldg_totalqty'];
													
													$extlotnob=$row_lot['balnomp'];
																		
													$lotallqty=$row_lot['lotldg_alqtys'];
													$lotallqty=$lotallqty-$qty;
													if($lotallqty<=0)$lotallqty=0;
																	
													$lotallnmp=$row_lot['lotldg_alnomps'];
													$lotallnmp=$lotallnmp-$nomp;
													if($lotallnmp<=0)$lotallnmp=0;
																	
													$lotalltrids=$row_lot['lotldg_altrids'];
													if($lotallqty<=0){$lotalltrids='';$lotldg_alflg=0;}
													
													$balups=$opups-$ups;
													$balnomp=$opnomp-$nomp;
													$balqty=$opqty-$qty;
																	
													if($balnomp<0)$balnomp=0;
													if($balqty<0)$balqty=0;
													if($qty>0 && $opqty>=$qty)
													{
														$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty,plantcode) values('$ycode','Dispatch', '$stage', '$pid', '$dt', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty','$plantcode')";
														if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
														{
															$zflg++; $cntflg++;					
															$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=2, lotldg_altrids='$lotalltrids', lotldg_alqtys='".$lotallqty."', lotldg_alnomps='".$lotallnmp."' where lotno='$lotno' and packtype='$pcktyp'";
															$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
															
															$sqpck=mysqli_query($link,"Select lotldg_alqtys from tbl_lot_ldg_pack where lotno='$lotno' and packtype='$pcktyp'") or die(mysqli_error($link));
															$tosqpck=mysqli_num_rows($sqpck);
															$rowsqpck=mysqli_fetch_array($sqpck);
															
															if($rowsqpck['lotldg_alqtys']<=0)
															{
																$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=0, lotldg_altrids='', lotldg_alqtys=0, lotldg_alnomps=0 where lotno='$lotno' and packtype='$pcktyp'";
																$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
															}
															
															$sqllot2=mysqli_query($link,"Select * from tbl_dalloc_sub where dalloc_id='$dalcid2' and dallocs_variety='".$row_arrsub['disps_variety']."' and dallocs_upstype='".$tupsstype."' and dallocs_ups='".$row_arrsub['disps_ups']."'") or die(mysqli_error($link));
															if($totlot2=mysqli_num_rows($sqllot2)>0)
															{
																$rowlot2=mysqli_fetch_array($sqllot2);
																		
																$sqllot23=mysqli_query($link,"Select * from tbl_dallocsub_sub where dalloc_id='$dalcid2' and dallocs_id='".$rowlot2['dallocs_id']."' and dallocss_lotno='".$lotno."' and dallocss_ups='".$pcktyp."' and dallocss_mptnop='$ups'") or die(mysqli_error($link));
																$totlot23=mysqli_num_rows($sqllot23);
																$rowlot23=mysqli_fetch_array($sqllot23);
																		
																$alqt=$rowlot23['dallocss_dispqty'];
																$alqt=$alqt+$qty;
																		
																$sql_main23="update tbl_dallocsub_sub set dallocss_dispqty='$alqt' where dalloc_id='$dalcid2' and dallocss_id='".$rowlot2['dallocss_id']."' and dallocss_lotno='".$lotno."' and dallocss_ups='".$pcktyp."'";
																$a123456233=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
															}
															if($balqty == 0)
															{
															
																$x="";
																$sql_mainchk="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$olot'";
																mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
																$sql_subchk="update tbl_softr_sub set softrsub_srflg='2' where softrsub_lotno ='$olot'";
																mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
																$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=0, lotldg_altrids='', lotldg_alqtys='', lotldg_alnomps='' where lotno='$lotno' and packtype='$pcktyp'";
																$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
																			
																$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where subbinid='".$subbinid."'") or die(mysqli_error($link));
																$cntg=0;
																while($row_issueg=mysqli_fetch_array($sql_issueg))
																{
																	$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
																	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
																	
																	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
																	$totnog=mysqli_num_rows($sql_issuetblg);
																	if($totnog == 0)
																	{
																		$cntg++;
																	} 
																}
																  
																$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
																//$cntg=0;
																while($row_issueg=mysqli_fetch_array($sql_issueg))
																{ 
																	$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
																	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
																	
																	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
																	$totnog=mysqli_num_rows($sql_issuetblg);
																	if($totnog == 0)
																	{
																		$cntg++;
																	} 
																}				
																if($cntg == 0)
																{
																	$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
																	mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
																}
															}
														}
													}
												}
											}
										}
									}
								}
								else
								{
								
									$lotnst=$row_arrsub_sub['mpmain_lotno'].",";
									$ltnopds1=$row_arrsub_sub['mpmain_lotnop'].",";
									$upsds1=$row_arrsub_sub['mpmain_upssize'].",";
							
									$lotn=explode(",",$lotnst);
									$uups=explode(",",$upsds1);
									$ltnps=explode(",",$ltnopds1);
									$ltcount=count($lotn);
									for($q=0; $q<=$ltcount; $q++)
									{
										$lot=$lotn[$q];
										//$up=$uups[$q];
										if($lot<>"" && $barlotno==$lot)
										{
											$qty=0; $qt=0;
											if($pty=="PACKMMC")
											{
												$up=$uups[$q];
												//$ups=$ltnps[$q];
											}
											else
											{
												$up=$uups[0];
												//$ups=$ltnps[$q];
											}
											$ups=$ltnps[$q];
											
											$xc=explode(" ",$up);
											if($xc[1]=="Gms")
											{
												$ptp=$xc[0]/1000;
											}
											else
											{
												if($xc[0]<=0)
												$ptp=$xc[0]/1000;
												else
												$ptp=$xc[0];
											}
											$qt=$ptp*$ups;
											
											//echo $lot."  =  ".$up."  =  ".$qt."<br/>";
											$nomp=1;
											$qty=$qt;
											 $zflg=0;
											 //echo "select Distinct subbinid from tbl_lot_ldg_pack where lotno='".$lot."' and packtype='".$up."' and lotldg_crop='$opcrop' and lotldg_variety='$opvariety'";
											 //echo "<br/>";
											$sql_issuesbin=mysqli_query($link,"select Distinct subbinid from tbl_lot_ldg_pack where lotno='".$lot."' and packtype='".$up."' and lotldg_crop='$opcrop' and lotldg_variety='$opvariety'") or die(mysqli_error($link));
											while($row_issuesbin=mysqli_fetch_array($sql_issuesbin))
											{
												$lottot=0; $lots_tot=0;
												if($zflg==0)
												{
													$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotno='".$lot."' and packtype='".$up."' and subbinid='".$row_issuesbin['subbinid']."' and lotldg_crop='$opcrop' and lotldg_variety='$opvariety'") or die(mysqli_error($link));
													$lot_tot=mysqli_num_rows($sql_issue1);
													$row_issue1=mysqli_fetch_array($sql_issue1);
													
													$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
													$lots_tot=mysqli_num_rows($sql_issuetbl);
													
													if($lots_tot>0)
													{
														$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
														//echo "Insert Dispatch Row <br />";
														$opups=0; $opnomp=0; $opqty=0;
														
														$opups=$row_issuetbl['balnop'];
														$opnomp=$row_issuetbl['balnomp'];
														$opqty=$row_issuetbl['balqty'];
														$olot=$row_issuetbl['orlot'];
														
														$whid=$row_issuetbl['whid'];
														$binid=$row_issuetbl['binid'];
														$subbinid=$row_issuetbl['subbinid'];
												
														$stage='Pack';
														$status=$row_issuetbl['lotldg_sstatus'];
														$moist=$row_issuetbl['lotldg_moisture'];
														$gemp=$row_issuetbl['lotldg_gemp'];
														$vchk=$row_issuetbl['lotldg_vchk'];
														$got1=$row_issuetbl['lotldg_got1'];
														$qc=$row_issuetbl['lotldg_qc'];
														
														$lotno=$row_issuetbl['lotno'];
														$gotstatus=$row_issuetbl['lotldg_got'];
														$qctestdate=$row_issuetbl['lotldg_qctestdate'];
														$gottestdate=$row_issuetbl['lotldg_gottestdate'];
														$orlot=$row_issuetbl['orlot'];
														$resverstatus=$row_issuetbl['lotldg_resverstatus'];
														$revcomment=$row_issuetbl['lotldg_revcomment'];
														$geneticpurity=$row_issuetbl['lotldg_genpurity'];
														$ycode=$row_issuetbl['yearcode'];
														$pcktyp=$row_issuetbl['packtype'];
														
														$packlabels=$row_issuetbl['packlabels'];
														$barcodes=$row_issuetbl['barcodes'];
														$wtinmp=$row_issuetbl['wtinmp'];
														$lotldg_dop=$row_issuetbl['lotldg_dop'];
														$lotldg_valperiod=$row_issuetbl['lotldg_valperiod'];
														$lotldg_valupto=$row_issuetbl['lotldg_valupto'];
														$lotldg_srtyp=$row_issuetbl['lotldg_srtyp'];
														$lotldg_srflg=$row_issuetbl['lotldg_srflg'];
														
														$lotldg_rvflg=$row_issuetbl['lotldg_rvflg'];
														$lotldg_alflg=$row_issuetbl['lotldg_alflg'];
														$lotldg_dispflg=$row_issuetbl['lotldg_dispflg'];
														$lotldg_altrids=$row_issuetbl['lotldg_altrids'];
														$lotldg_alqtys=$row_issuetbl['lotldg_alqtys'];
														$lotldg_alnomps=$row_issuetbl['lotldg_alnomps'];
														$lotldg_spremflg=$row_issuetbl['lotldg_spremflg'];
														$lotldg_totalqty=$row_issuetbl['lotldg_totalqty'];
														
														$crop2=$row_issuetbl['lotldg_crop'];
														$variety2=$row_issuetbl['lotldg_variety'];
														
														$extlotnob=$row_lot['balnomp'];
																			
														$lotallqty=$row_lot['lotldg_alqtys'];
														$lotallqty=$lotallqty-$qty;
														if($lotallqty<=0)$lotallqty=0;
																		
														$lotallnmp=$row_lot['lotldg_alnomps'];
														$lotallnmp=$lotallnmp-$nomp;
														if($lotallnmp<=0)$lotallnmp=0;
																		
														$lotalltrids=$row_lot['lotldg_altrids'];
														if($lotallqty<=0){$lotalltrids='';$lotldg_alflg=0;}
														
														$balups=$opups-$ups;
														$balnomp=$opnomp-$nomp;
														$balqty=$opqty-$qty;
														$qty=round($qty,3);
														//echo $lot."  =  ".$lots_tot."  =  ".$qty."  =  ".$opqty."<br/>";						
														if($balnomp<0)$balnomp=0;
														if($balqty<0)$balqty=0;
														if($qty>0 && $opqty>=$qty)
														{
															$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty,plantcode) values('$ycode','Dispatch', '$stage', '$pid', '$dt', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$crop2', '$variety2', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty','$plantcode')";
															//echo "<br/>";
															if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
															{
																$zflg++; $cntflg++;
																$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=2, lotldg_altrids='$lotalltrids', lotldg_alqtys='".$lotallqty."', lotldg_alnomps='".$lotallnmp."' where lotno='$lotno' and packtype='$pcktyp'";
																$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
																
																$sqpck=mysqli_query($link,"Select lotldg_alqtys from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$pcktyp'") or die(mysqli_error($link));
																$tosqpck=mysqli_num_rows($sqpck);
																$rowsqpck=mysqli_fetch_array($sqpck);
																
																if($rowsqpck['lotldg_alqtys']<=0)
																{
																	$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=0, lotldg_altrids='', lotldg_alqtys=0, lotldg_alnomps=0 where plantcode='".$plantcode."' and   lotno='$lotno' and packtype='$pcktyp'";
																	$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
																}
																
																$sqllot2=mysqli_query($link,"Select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and   dalloc_id='$dalcid2' and dallocss3_barcode='".$row_arrsub2['dpss_barcode']."' and dallocss3_lotno='".$lotno."' and dallocss3_ups='".$row_arrsub['disps_ups']."'") or die(mysqli_error($link));
																if($totlot2=mysqli_num_rows($sqllot2)>0)
																{
																	$rowlot2=mysqli_fetch_array($sqllot2);
																	
																	$sqllot23=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and   dalloc_id='$dalcid2' and dallocss_id='".$rowlot2['dallocss_id']."' and dallocss_lotno='".$lotno."' and dallocss_ups='".$pcktyp."' and dallocss_mptnop='$ups'") or die(mysqli_error($link));
																	$totlot23=mysqli_num_rows($sqllot23);
																	$rowlot23=mysqli_fetch_array($sqllot23);
																	
																	$alqt=$rowlot23['dallocss_dispqty'];
																	$alqt=$alqt+$qty;
																	
																	$sql_main23="update tbl_dallocsub_sub set dallocss_dispqty='$alqt' where dalloc_id='$dalcid2' and dallocss_id='".$rowlot2['dallocss_id']."' and dallocss_lotno='".$lotno."' and dallocss_ups='".$pcktyp."'";
																	$a123456233=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
																}
																if($balqty == 0)
																{
																
																	$x="";
																	$sql_mainchk="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$olot'";
																	mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
																	$sql_subchk="update tbl_softr_sub set softrsub_srflg='2' where softrsub_lotno ='$olot'";
																	mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
																	$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=0, lotldg_altrids='', lotldg_alqtys='', lotldg_alnomps='' where lotno='$lotno' and packtype='$pcktyp'";
																	$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
																			
																	$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and   subbinid='".$subbinid."'") or die(mysqli_error($link));
																	$cntg=0;
																	while($row_issueg=mysqli_fetch_array($sql_issueg))
																	{
																		$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and   subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
																		$row_issueg1=mysqli_fetch_array($sql_issueg1); 
																		
																		$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and   lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
																		$totnog=mysqli_num_rows($sql_issuetblg);
																		if($totnog == 0)
																		{
																			$cntg++;
																		} 
																	}
																	  
																	$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
																	//$cntg=0;
																	while($row_issueg=mysqli_fetch_array($sql_issueg))
																	{ 
																		$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
																		$row_issueg1=mysqli_fetch_array($sql_issueg1); 
																		
																		$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
																		$totnog=mysqli_num_rows($sql_issuetblg);
																		if($totnog == 0)
																		{
																			$cntg++;
																		} 
																	}				
																	if($cntg == 0)
																	{
																		$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
																		mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						
							$sql_main2="update tbl_mpmain set mpmain_dflg=1 where mpmain_barcode='".$row_arrsub2['dpss_barcode']."'";
							$a123=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
							
							$sql_main23="update tbl_barcodes set bar_dispflg=1 where bar_barcode='".$row_arrsub2['dpss_barcode']."'";
							$a1234=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
							
							$sql_main260="update tbl_dallocsub_sub3 set dallocss3_dflg='1' where dalloc_id='$dalcid2' and dallocss3_barcode='".$row_arrsub2['dpss_barcode']."'";
							$a123456260=mysqli_query($link,$sql_main260) or die(mysqli_error($link));				
							
							$sqllot240=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dalloc_id='$dalcid2' and dallocs_variety='".$row_arrsub['disps_variety']."' and dallocs_upstype='".$tupsstype."' and dallocs_ups='".$row_arrsub['disps_ups']."'") or die(mysqli_error($link));
							$totlot240=mysqli_num_rows($sqllot240);
							$rowlot240=mysqli_fetch_array($sqllot240);
							
							$alnomp=$rowlot240['dallocs_nomp']-1;
							if($alnomp<=0)$alnomp=0;
							$sql_main27="update tbl_dalloc_sub set dallocs_nomp='$alnomp' where dalloc_id='$dalcid2' and dallocs_variety='".$row_arrsub['disps_variety']."' and dallocs_upstype='".$tupsstype."' and dallocs_ups='".$row_arrsub['disps_ups']."'";
							$a12345627=mysqli_query($link,$sql_main27) or die(mysqli_error($link));
						}
					}
					//echo $cntflg;
					//echo "<br/>";
					if($cntflg>0)
					{
						$tsid=""; $ordrid=""; $ordernos=$ordernos.","; //echo $ordernos=$ordernos.",";
						$tid240=explode(",",$ordernos);  
						$tid240=array_keys(array_flip($tid240));
						foreach($tid240 as $tid230)
						{
							if($tid230<>"")
							{
								$sqordm=mysqli_query($link,"Select * from tbl_orderm where plantcode='".$plantcode."' and   orderm_porderno='$tid230' and orderm_tflag=1 and orderm_dispatchflag!=1") or die(mysqli_error($link));
								$totordm=mysqli_num_rows($sqordm);
								while($rowordm=mysqli_fetch_array($sqordm))
								{
									if($ordrid!="")
										$ordrid=$ordrid.",".$rowordm['orderm_id'];
									else
										$ordrid=$rowordm['orderm_id'];
								}
							}
						}
						$ordrid=$ordrid.",";
						$tid24=explode(",",$ordrid);
						$tid24=array_keys(array_flip($tid24));
						
						//if(count($tid24)>1)
						//{$tid24=sort($tid24);}
						//echo "<br/>";
						//print_r($tid24);
						foreach($tid24 as $tid23)
						{
							if($tid23<>"")
							{ 
								$orid=$tid23;
								$totsubqty=0; $uptflg=0;
						//echo "Select * from tbl_order_sub where plantcode='".$plantcode."' and   orderm_id='".$orid."' and order_sub_crop='$opcrop' and order_sub_variety='$opvariety' and order_sub_ups_type='$oruptyp' ";
								$sql_ordersub=mysqli_query($link,"Select * from tbl_order_sub where plantcode='".$plantcode."' and   orderm_id='".$orid."' and order_sub_crop='$opcrop' and order_sub_variety='$opvariety' and order_sub_ups_type='$oruptyp' ") or die(mysqli_error($link));
								$tot_ordersub=mysqli_num_rows($sql_ordersub);
								while($row_ordersub=mysqli_fetch_array($sql_ordersub))
								{		
									//echo "Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'";
									$sqlordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'") or die(mysqli_error($link));
									$totordersubsub=mysqli_num_rows($sqlordersubsub);
									if($oruptyp=="No" && $totordersubsub==0)
									{
										//echo "Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss23'";
										$sqlordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss23'") or die(mysqli_error($link));
										$totordersubsub=mysqli_num_rows($sqlordersubsub);
										if($oruptyp=="No" && $totordersubsub==0)
										{
											$sqlordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'") or die(mysqli_error($link));
											$totordersubsub=mysqli_num_rows($sqlordersubsub);
										}
										$uptflg++;
									}
									if($totordersubsub>0)
									{
										//echo "<br/>";echo $tqt;echo "  =  <br/>";
										if($tqt>0)
										{
											$totsubqty=$tqt-$row_ordersub['order_sub_totbal_qty'];
											//echo "<br/>";echo $row_ordersub['order_sub_totbal_qty'];echo "  -=-  <br/>";
											//echo "<br/>  -=-  ";echo $totsubqty;echo "  -=-  <br/>";
											$tsqty=0;
											if($totsubqty<0)
											{
												$tsubqty=$row_ordersub['order_sub_totbal_qty']-$tqt;
												$tsqty=$tqt;
												$tqt=0;
											}
											else
											{
												$tsubqty=0;
												$tsqty=$row_ordersub['order_sub_totbal_qty'];
												$tqt=$totsubqty;
											}
											$vfg=0; //echo $tsubqty."  -  ";
											if($tsubqty==0)
											{
												if($tsid!="")
													{$tsid=$tsid.",".$row_ordersub['orderm_id'];}
												else
													{$tsid=$row_ordersub['orderm_id'];}
												
												$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'") or die(mysqli_error($link));
												$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
												if($oruptyp=="No" && $tot_ordersubsub==0)
												{
													$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss23'") or die(mysqli_error($link));
													$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
												}
												while($row_ordersubsub=mysqli_fetch_array($sql_ordersubsub))
												{
													//$totsubsubqty=0;
													//echo "<br/>";echo $row_ordersubsub['order_sub_subbal_qty'];echo "  -=-  <br/>";
													$totsubsubqty=$row_ordersubsub['order_sub_subbal_qty']-$tsqty;
													if($totsubsubqty<=0)$totsubsubqty=0;
													if($uptflg>0)
													$sql_in="update tbl_order_sub_sub set order_sub_subbal_qty='$totsubsubqty' where order_sub_sub_id='".$row_ordersubsub['order_sub_sub_id']."' and order_sub_sub_ups='$tupss23'";	
													else
													$sql_in="update tbl_order_sub_sub set order_sub_subbal_qty='$totsubsubqty' where order_sub_sub_id='".$row_ordersubsub['order_sub_sub_id']."' and order_sub_sub_ups='$tupss'";	
													if($aasssd=mysqli_query($link,$sql_in)or die(mysqli_error($link)))
													{$vfg++;}
													$tsqty=$tsqty-$row_ordersubsub['order_sub_subbal_qty'];
													//echo "<br/>";echo $tsqty;echo "  *  <br/>";
												}
												if($tsqty<0)$tsqty=0;
												$tsubqty=$tsqty;
												$tqt=$tqt+$tsqty;
								/*echo				$sql_in1="update tbl_orderm set orderm_dispatchflag=2 where orderm_id='$orid'";	
												$aaaa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
													
								echo				$sql_in="update tbl_order_sub set order_sub_totbal_qty='$tsubqty' where order_sub_id='".$row_ordersub['order_sub_id']."'";	
												$aaaaa=mysqli_query($link,$sql_in)or die(mysqli_error($link));	*/
											}
											else
											{
												$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'") or die(mysqli_error($link));
												$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
												if($oruptyp=="No" && $tot_ordersubsub==0)
												{
												$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss23'") or die(mysqli_error($link));
												$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
												}
												while($row_ordersubsub=mysqli_fetch_array($sql_ordersubsub))
												{
													//if($tsqty>0)
													{//echo "<br/>";echo $row_ordersubsub['order_sub_subbal_qty'];echo "  -=-  <br/>";
														$totsubsubqty=$row_ordersubsub['order_sub_subbal_qty']-$tsqty;
														if($totsubsubqty<=0)$totsubsubqty=0;
														if($uptflg>0)
														$sql_in="update tbl_order_sub_sub set order_sub_subbal_qty='$totsubsubqty' where order_sub_sub_id='".$row_ordersubsub['order_sub_sub_id']."' and order_sub_sub_ups='$tupss23'";	
														else
														$sql_in="update tbl_order_sub_sub set order_sub_subbal_qty='$totsubsubqty' where order_sub_sub_id='".$row_ordersubsub['order_sub_sub_id']."' and order_sub_sub_ups='$tupss'";															
														if($aasssd=mysqli_query($link,$sql_in)or die(mysqli_error($link)))
														{$vfg++;}
														$tsqty=$tsqty-$row_ordersubsub['order_sub_subbal_qty'];
														//echo "<br/>";echo $tsqty;echo "  *  <br/>";
													}
												}
												if($tsqty<0)$tsqty=0;
												$tsubqty=$tsqty;
												$tqt=$tsqty;
							/*echo					$sql_in1="update tbl_orderm set orderm_dispatchflag=2 where orderm_id='$orid'";	
												$aaaa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
													
							echo					$sql_in="update tbl_order_sub set order_sub_totbal_qty='$tsubqty' where order_sub_id='".$row_ordersub['order_sub_id']."'";	
												$aaaaa=mysqli_query($link,$sql_in)or die(mysqli_error($link));	*/
											}
											if($vfg>0)
											{
												$orbqt=0;
												$sql_in1="update tbl_orderm set orderm_dispatchflag=2 where orderm_id='$orid'";	
												$aaaa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
												$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   order_sub_id='".$row_ordersub['order_sub_id']."'") or die(mysqli_error($link));
												$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
												while($row_ordersubsub=mysqli_fetch_array($sql_ordersubsub))
												{
													$orbqt=$orbqt+$row_ordersubsub['order_sub_subbal_qty'];
												}
												$sql_in="update tbl_order_sub set order_sub_totbal_qty='$orbqt' where order_sub_id='".$row_ordersub['order_sub_id']."'";	
												$aaaaa=mysqli_query($link,$sql_in)or die(mysqli_error($link));	
											}
										}
									}
								}
							}
						}
						$tsid=$tsid.",";
						$tid2400=explode(",",$tsid); 
						$tid2400=array_keys(array_flip($tid2400)); 
						foreach($tid2400 as $tid25)
						{
							if($tid25<>"")
							{
								$t=0; 
								$sqlordersub=mysqli_query($link,"Select * from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id='".$tid25."'") or die(mysqli_error($link));
								$totordersub=mysqli_num_rows($sql_ordersub);
								while($rowordersub=mysqli_fetch_array($sqlordersub))
								{	
									if($rowordersub['order_sub_totbal_qty']>0)$t++;
								}
								if($t==0)
								{
									$sql_in1234="update tbl_orderm set orderm_dispatchflag=1 where orderm_id='$tid25'";	
									$aaaaaaa=mysqli_query($link,$sql_in1234)or die(mysqli_error($link));	
								}
							}
						}
						
						$sql_main2="update tbl_disp_sub set disps_flg=1 where disps_id='$subid' and disp_id='$pid'";
						$a1234562=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
					}	
				}
				else
				{
					$sql_main2="delete from tbl_disp_sub where disps_id='".$row_arrsub['disps_id']."' and disp_id='$pid'";
					$a1234562=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
				}	
				
				$sqllot2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dalloc_id='$dalcid2' and dallocs_variety='".$row_arrsub['disps_variety']."' and dallocs_upstype='".$tupsstype."' and dallocs_ups='".$row_arrsub['disps_ups']."'") or die(mysqli_error($link));
				$totlot2=mysqli_num_rows($sqllot2);
				$rowlot2=mysqli_fetch_array($sqllot2);
				
				$alqt=$rowlot2['dallocs_allocqty'];
				$dtq=$dispstqt+$rowlot2['dallocs_dispqty'];
				$dpsflg=2;
				if($alqt<=$dispstqt)$dpsflg=1;
				$alq=$alqt-$dispstqt;
				if($alq<=0){$alq=0; $dpsflg=1;}
				$sql_main2="update tbl_dalloc_sub set dallocs_dflg='$dpsflg', dallocs_dispqty='$dtq', dallocs_allocqty='$alq' where dalloc_id='$dalcid2' and dallocs_variety='".$row_arrsub['disps_variety']."' and dallocs_upstype='".$tupsstype."' and dallocs_ups='".$row_arrsub['disps_ups']."'";
				$a1234562=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
			
			
			
				
			}
		}
		
		$totlot233=0;
		$sqllot233=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and   dalloc_id='$dalcid2' and dallocs_dflg!=1") or die(mysqli_error($link));
		$totlot233=mysqli_num_rows($sqllot233);
		if($totlot233==0)
		{
			$sql_main23="update tbl_dalloc set dalloc_dflg=1, dalloc_alflg=1 where dalloc_id='$dalcid2'";
			$a12345623=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
		}
		
		$sql_code1="SELECT MAX(disp_code) FROM tbl_disp ORDER BY disp_code DESC";
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
		
		$sql_code12="SELECT MAX(disp_ncode) FROM tbl_disp where plantcode='".$plantcode."'  ORDER BY disp_ncode DESC";
		$res_code12=mysqli_query($link,$sql_code12)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code12) > 0)
		{
			$row_code12=mysqli_fetch_row($res_code12);
			$t_code12=$row_code12['0'];
			$ncode12=$t_code12+1;
		}
		else
		{ 
			$ncode12=1;
		}
		
		$ttime=date("h:i:s A");
		
		$sql_main="update tbl_disp set disp_tflg=1, disp_code=$ncode1, disp_ncode=$ncode12, disp_ttime='$ttime', disp_dodc='$dt'  where disp_id='$pid'";
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));	
		
		$quer33=mysqli_query($link,"select * from tblfnyears where years_flg =1 and years_status='a'"); 
		$noticia33 = mysqli_fetch_array($quer33);
		$yr=$noticia33['ycode'];
		
		$sql_code1="SELECT MAX(gid) FROM tbl_gatepass where plantcode='".$plantcode."' and  yearcode='$yr'";
		$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$code1=$t_code1+1;
		}
		else
		{
			$code1=1;
		}
				
		$sql_main22="insert into tbl_gatepass (gid, trid, trtype, gdate, yearcode,plantcode) values ('$code1', '$pid', 'Dispatch Pack Seed' ,'$arrival_date', '$yr','$plantcode')";
		$aa22=mysqli_query($link,$sql_main22) or die(mysqli_error($link));
		
		if($ptype=="Dealer" || $ptype=="Export Buyer")
			$sql_code="SELECT MAX(dnote_code) FROM tbl_dispnote where plantcode='".$plantcode."' and   dnote_ptype IN('Dealer','Bulk','Export Buyer') and dnote_yearcode='$yr'";
		if($ptype=="C&F" || $ptype=="Branch")
			$sql_code="SELECT MAX(dnote_code) FROM tbl_dispnote where plantcode='".$plantcode."' and   dnote_ptype IN('C&F','Branch') and dnote_yearcode='$yr'";
			
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
		
		$sql_main23="insert into tbl_dispnote (dnote_code, dnote_trid, dnote_trtype, dnote_date, dnote_ptype, dnote_logid, dnote_yearcode,plantcode) values ('$code', '$pid', 'Dispatch Pack Seed' ,'$arrival_date' ,'$ptype' ,'$logid' ,'$yr','$plantcode')";
		$aa23=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
		
		$sq2=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and   disp_id='$pid'") or die(mysqli_error($link));
		$totrec=mysqli_num_rows($sq2);
		while($ro2=mysqli_fetch_array($sq2))
		{
			$lot2=$ro2['dpss_lotno']; 
				
			$sql_code15="SELECT MAX(dpss_st1code) FROM tbl_dispsub_sub where plantcode='".$plantcode."' and   dpss_yearcode='$yr' order by dpss_st1code desc";
			$res_code15=mysqli_query($link,$sql_code15)or die(mysqli_error($link));
					
			if(mysqli_num_rows($res_code15) > 0)
			{
				$row_code15=mysqli_fetch_row($res_code15);
				$t_code15=$row_code15['0'];
				$code15=$t_code15+1;
			}
			else
			{
				$code15=0;
			}
				
			$min=5;
			$max=25;
			$rndval=rand($min,$max);
			$code15=$code15+$rndval;
				
			$sql_code14="SELECT MAX(dpss_st2code) FROM tbl_dispsub_sub where plantcode='".$plantcode."' and   dpss_yearcode='$yr' order by dpss_st2code desc";
			$res_code14=mysqli_query($link,$sql_code14)or die(mysqli_error($link));
			if(mysqli_num_rows($res_code14) > 0)
			{
				$row_code14=mysqli_fetch_row($res_code14);
				$t_code14=$row_code14['0'];
				$code14=$t_code14+1;
			}
			else
			{
				$code14=1;
			}
			
			$sqlmain24="update tbl_dispsub_sub set dpss_st1code=$code15, dpss_st2code=$code14, dpss_yearcode='$yr' where disp_id='$pid'";
			$a24=mysqli_query($link,$sqlmain24) or die(mysqli_error($link));	
		}		
		
		//exit; 		
		
		echo "<script>window.location='select_disppackalc_op.php?p_id=$pid&optype=preview'</script>";	
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Allocation Type - Preview</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="qtyremalc.js"></script>
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

var pid=document.frmaddDepartment.pid.value;
winHandle=window.open('disppackalc_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function showmbarcodes(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_mbarstatus.php?tp='+barcodes,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function mySubmit()
{ 	
	document.getElementById('subbutn').disabled=true;
	var flg=0;
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		flg=0;//return true;	 
	}
	else
	{
		document.getElementById('subbutn').disabled=false;
		flg=1;//return false;
	}
	//alert(flg);
	if(flg==0)
	{document.frmaddDepartment.submit(); return true;}
	else
	{return false;}
}

</script>

<body >

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch - Allocation Type - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
 <?php
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['disp_id'];

	$tdate=$row_tbl['disp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$subtid=0;
$subsubtid=0;

$sqlcode="SELECT dalloc_id FROM tbl_dalloc where plantcode='".$plantcode."' and  dalloc_dflg!=1 and dalloc_party='".$row_tbl['disp_party']."' ORDER BY dalloc_id DESC";
$rescode=mysqli_query($link,$sqlcode)or die(mysqli_error($link));
$t=mysqli_num_rows($rescode);
$rowcode=mysqli_fetch_array($rescode);
$dalcid=$rowcode['dalloc_id'];

?> 
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt11" value="" type="hidden"> 
	<input name="txt14" value="" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch - Allocation Type</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="smalltblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TDP".$row_tbl['disp_tcode']."/".$row_tbl['disp_yearcode']."/".$row_tbl['disp_logid'];?></td>

<td width="172" align="right" valign="middle" class="smalltblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate;?><input name="date" type="hidden" size="10" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="smalltblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<?php echo $row_tbl['disp_partytype']; ?><input type="hidden" class="smalltbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['disp_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['disp_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['disp_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="smalltblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['disp_state']; ?><input type="hidden"  class="smalltbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['disp_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['disp_state']."' and productionlocationid='".$row_tbl['disp_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="smalltblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="smalltbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="smalltbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['disp_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['disp_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['disp_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="230"  align="right"  valign="middle" class="smalltblheading">Country&nbsp;</td>
<td colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="smalltbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['disp_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['disp_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['disp_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['disp_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="smalltblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="smalltbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="smalltbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['disp_party'];?>"  /></td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['disp_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="smalltblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?><input name="txt11" value="<?php echo $row_tbl['tmode'];?>" type="hidden"> </td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['trans_name'];?><input name="txttname" value="<?php echo $row_tbl['trans_name'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?><input name="txtlrn" value="<?php echo $row_tbl['trans_lorryrepno'];?>" type="hidden"></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?><input name="txtvn" value="<?php echo $row_tbl['trans_vehno'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)<input name="txt13" value="<?php echo $row_tbl['trans_paymode'];?>" type="hidden"></td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['courier_name'];?><input name="txtcname" value="<?php echo $row_tbl['courier_name'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['docket_no'];?><input name="txtdc" value="<?php echo $row_tbl['docket_no'];?>" type="hidden"></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?><input name="txtpname" value="<?php echo $row_tbl['pname_byhand'];?>" type="hidden"></td>
</tr>
<?php
}
?>
</table>
</div>
<div id="orderdetails">
<?php

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_party='".$row_tbl['disp_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and (order_trtype='Order Sales' OR order_trtype='Order Stock') and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
	else
		$arrivalid=$rowtbl['orderm_id'];
}

$ver=""; $cpr="";
if($arrivalid!="")
{
$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_crop") or die(mysqli_error($link));
$totver1=mysqli_num_rows($sql_ver1);
while($row_ver1=mysqli_fetch_array($sql_ver1))
{
	if($cpr!="")
		$cpr=$cpr.",".$row_ver1['order_sub_crop'];
	else
		$cpr=$row_ver1['order_sub_crop'];
}
//echo $arrivalid;
$cp="";
$sq_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid IN ($cpr) order by cropname Asc") or die(mysqli_error($link));
while($ro_crp=mysqli_fetch_array($sq_crp))
{
	if($cp!="")
		$cp=$cp.",".$ro_crp['cropid'];
	else
		$cp=$ro_crp['cropid'];
}
$arid=explode(",",$cp);
foreach($arid as $atrid)
{
if($atrid<>"")
{
$ver1="";
$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and   orderm_id in($arrivalid) and order_sub_crop='$atrid' and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
$totver2=mysqli_num_rows($sql_ver2);
while($row_ver2=mysqli_fetch_array($sql_ver2))
{
	if($ver1!="")
		$ver1=$ver1.",".$row_ver2['order_sub_variety'];
	else
		$ver1=$row_ver2['order_sub_variety'];
}
$vp="";
$sq_vrp=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid IN ($ver1) and actstatus='Active' order by popularname Asc") or die(mysqli_error($link));
while($ro_vrp=mysqli_fetch_array($sq_vrp))
{
	if($vp!="")
		$vp=$vp.",".$ro_vrp['varietyid'];
	else
		$vp=$ro_vrp['varietyid'];
}
if($ver!="")
	$ver=$ver.",".$vp;
else
	$ver=$vp;

}
}
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Pending Order(s) in Progress</td>
</tr>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="150" align="center"  valign="middle" class="smalltblheading">PSDN Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Order No</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Allocated</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoMP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcodes</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Dispatched</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Balance</td>
	<!--<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>-->
</tr>
<?php 
$ordnos=""; $veridno=""; $upsnos=""; $sn=1; $totbarcs="";
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{

$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}


$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $nord=0; $ordno="";

$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

		

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
		if($tot=mysqli_num_rows($sql_m) > 0)
		{
			while($row_m=mysqli_fetch_array($sql_m))
			{
				if($ordno!="")
				$ordno=$ordno.",".$row_m['orderm_porderno'];
				else
				$ordno=$row_m['orderm_porderno'];
				$nord++;
			}
		}
		$orxd=explode(",",$ordno);
		$tid240=array_keys(array_flip($orxd));
		$ordno=implode(",",$tid240);
		
		if($reptyp1=="hold")
	    {	
			if($rowtblsub['order_sub_hold_flag']!=0)
				$statussub=$rowtblsub['order_sub_hold_type'];	
		}
		else
		{
			$statussub="";
		}


		$variet=$row_dept4['popularname'];
		$upstyp=$rowtblsub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		/*if($crop!="")
		{
		$crop=$crop."<br>".$rowtblsub['order_sub_crop'];
		// $rowtblsub['lotcrop'];
		}
		else
		{*/
		$crop=$rowtblsub['order_sub_crop'];
		//}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		/*if($variety!="")
		{
		$variety=$variety."<br>".$rowtblsub['order_sub_variety'];
		}
		else
		{*/
		$variety=$rowtblsub['order_sub_variety'];	
		//}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		/*if($lotno!="")
		{
			$lotno=$lotno."<br>".$rowtblsub['lotno'];
		}
		else
		{
			$lotno=$rowtblsub['lotno'];
		}
		if($bags!="")
		{
			$bags=$bags."<br>".$acn;
		}
		else
		{
			$bags=$acn;
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		if($qc!="")
		{
			$qc=$qc."<br>".$rowtblsub['qc'];
		}
		else
		{
			$qc=$rowtblsub['qc'];
		}
		if($got!="")
		{
			$got=$got."<br>".$rowtblsub['got'];
		}
		else
		{
			$got=$rowtblsub['got'];
		}
		if($stage!="")
		{
			$stage=$stage."<br>".$rowtblsub['order_sub_totbal_qty'];
		}
		else
		{
			$stage=$rowtblsub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
			$per=$per."<br>".$rowtblsub['pper'];
		}
		else
		{
			$per=$rowtblsub['pper'];
		}*/
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	$xfd=count($dq);
	if($upstyp=="NST")
	{
		//$dq[1]="000";
		//if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
		if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
	}
	else
	{
		if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
	}
	$up1=$qt1." ".$zz[1];
	
	/*if($up!="")
		$up=$up.$up1."<br/>";
	else*/
		$up=$up1;

	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	/*if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}*/
	$sstatus=$sstatus+$row_sloc['order_sub_sub_nop'];
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($ordnos!="")
{
	$ordnos=$ordnos.",".$ordno;
}
else
{
	$ordnos=$ordno;
}

if($veridno!="")
{
	$veridno=$veridno.",".$variety;
}
else
{
	$veridno=$variety;
}
if($upsnos!="")
{
	$upsnos=$upsnos.",".$up1;
}
else
{
	$upsnos=$up1;
}
if($qt > 0)	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		

$sq=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='$cro' and disps_variety='$variet' and disps_ups='$up1' and disps_flg!=1 and disps_upstype='$upstyp' and disp_id='$tid'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $totrec=0; $barcds="";

if($to=mysqli_num_rows($sq) > 0)
{
	$ro=mysqli_fetch_array($sq);
	$nups=$ro['disps_ups']; 
	$nnob=$ro['disps_nob']; 
	$nqty=$ro['disps_qty']; 
	//$nbqty=$ro['disps_bqty'];
	$newvariet=$ro['disps_nvariety'];
	$nbqty=$qt-$nqty;
	$crpnm=$cp; 
	$vernm=$vt;
	$sid=$ro['disps_id'];
	$sn24=$sn;
	$dbsflg=$ro['disps_flg'];
	$sq2=mysqli_query($link,"Select distinct dpss_barcode from tbl_dispsub_sub where plantcode='".$plantcode."' and   disps_id='$sid' and disp_id='$tid' order by dpss_id ASC") or die(mysqli_error($link));
	$totrec=mysqli_num_rows($sq2);
	while($row_2=mysqli_fetch_array($sq2))
	{
	if($barcds!="")
		$barcds=$barcds.",".$row_2['dpss_barcode'];
	else
		$barcds=$row_2['dpss_barcode'];
	if($totbarcs!="")
		$totbarcs=$totbarcs.",".$row_2['dpss_barcode'];
	else
		$totbarcs=$row_2['dpss_barcode'];	
	}
}
$sql_lot2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and   dalloc_id='$dalcid' and dallocs_ups='$up1' and dallocs_variety='$variet' and dallocs_upstype='$upstyp' and dallocs_allocqty>0 order by dallocs_variety ASC") or die(mysqli_error($link));
$tot_lot2=mysqli_num_rows($sql_lot2);
while($row_lot2=mysqli_fetch_array($sql_lot2))
//$row_lot2=mysqli_fetch_array($sql_lot2);
{
$ealqt=$row_lot2['dallocs_allocqty'];
if($newvariet=="")$newvariet=$variet;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $newvariet;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $up?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext" ><?php echo $ordno;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $ealqt;?><input type="hidden" name="ealqty<?php echo $sn;?>" id="ealqty_<?php echo $sn;?>" value="<?php echo $ealqt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $totrec;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $totrec;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext" title="<?php echo $barcds;?>"><?php if($barcds!=""){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $barcds;?>')">Details</a><?php } ?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $barcds;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="smalltbltext"><?php if($nbqty>0 && $dbsflg==0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $variety?>','<?php echo $up1 ?>','<?php echo $qt?>','<?php echo $ordno?>');" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $variety?>','<?php echo $up1 ?>','<?php echo $qt?>','<?php echo $ordno?>');"  /><?php } ?></td>-->
</tr>
<?php
$sn++;
}
//}
}
}
}
}
}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="" /><input type="hidden" name="txtornos" value="" /><input type="hidden" name="txtveridno" value="" /><input type="hidden" name="txtupsnos" value="" /><input type="hidden" name="txteqty" value="" /><input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" />
</table>
</div>	
<br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['disp_remarks'];?></td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_disppackalc.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0" style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" id="subbutn" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
