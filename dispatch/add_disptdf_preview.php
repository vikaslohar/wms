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
	
	if(isset($_REQUEST['p_id'])) { $tid = $_REQUEST['p_id']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$dt=date("Y-m-d");
		$sbmval=$_POST['sbmval'];
		$pid=$_POST['pid'];
		//exit; 
		if($sbmval==1)
		{
			echo "<script>window.location='add_dispdtdfmmc.php?pid=$pid'</script>";	
		}	
		else
		{
			//exit; 
			$sql_arr=mysqli_query($link,"select * from tbl_dtdf where dtdf_id='".$pid."'") or die(mysqli_error($link));
			while($row_arr=mysqli_fetch_array($sql_arr))
			{
				$ptype=$row_arr['dtdf_partytype'];
				if($ptype=="")$ptype="TDF";
				$arrival_date=$row_arr['dtdf_date'];
				
				if($arrival_date=='' || $arrival_date=='0000-00-00' || $arrival_date=NULL || $arrival_date='--')$arrival_date=date("Y-m-d");
				
				$sql_arrsub=mysqli_query($link,"select * from tbl_dtdf_sub where dtdf_id='".$pid."'") or die(mysqli_error($link));
				$a_arrsub=mysqli_num_rows($sql_arrsub);
				while($row_arrsub=mysqli_fetch_array($sql_arrsub))
				{
					$cro=$row_arrsub['dtdfs_crop'];
					$variet=$row_arrsub['dtdfs_variety'];
					$ordernos=$row_arrsub['dtdfs_ordno'];
					$subid=$row_arrsub['dtdfs_id'];
					$tqt=$row_arrsub['dtdfs_qty'];
					$dtdfstage=$row_arrsub['dtdfs_stage'];
					$tupsstype=$row_arrsub['dtdfs_upstype'];
					$oruptyp="Yes";
					$tupss=$row_arrsub['dtdfs_ups'];
					if($tupsstype=="NST")
					{
						$oruptyp="No";
						$zz=explode(" ",$row_arrsub['dtdfs_ups']);
						$dq=explode(".",$zz[0]);
						$xfd=count($dq);
						if($tupsstype=="NST")
						{
							//$qt1=$zz[0];
							if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
							//if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
						}
						else
						{
							if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
						}
						$tupss=$qt1." ".$zz[1];
						//$tupss=$row_arrsub['disps_ups'];
					}
					else
					{
						$tupss=$row_arrsub['dtdfs_ups'];
					}
					
					$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
					$row_dept5=mysqli_fetch_array($quer5);
					$crop=$row_dept5['cropid'];
					$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
					$row_dept4=mysqli_fetch_array($quer4);
					$variety=$row_dept4['varietyid'];	
	
					$sql_arrsub2=mysqli_query($link,"select * from tbl_dtdfsub_sub where dtdf_id='".$pid."' and dtdfs_id='".$subid."'") or die(mysqli_error($link));
					$a_arrsub2=mysqli_num_rows($sql_arrsub2);
					while($row_arrsub2=mysqli_fetch_array($sql_arrsub2))
					{
						$lotno=$row_arrsub2['dbss_lotno'];
						$ssid=$row_arrsub2['dbss_id'];
						
						$sql_arrsub3=mysqli_query($link,"select * from tbl_dtdfsub_sub2 where dtdf_id='".$pid."' and dtdfs_id='".$subid."' and dbss_is='".$ssid."'") or die(mysqli_error($link));
						$a_arrsub3=mysqli_num_rows($sql_arrsub3);
						while($row_arrsub3=mysqli_fetch_array($sql_arrsub3))
						{
							$owh=$row_arrsub3['dbsss_wh'];
							$obin=$row_arrsub3['dbsss_bin'];
							$osbin=$row_arrsub3['dbsss_subbin'];
							$nob=$row_arrsub3['dbsss_nob'];
							$qty=$row_arrsub3['dbsss_qty'];
							
							if($dtdfstage!="Pack")
							{
								$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$osbin."' and lotldg_binid='".$obin."' and lotldg_crop='".$crop."' and lotldg_lotno='".$lotno."' and lotldg_variety='".$variety."' order by lotldg_id desc ") or die(mysqli_error($link));
								$row_is1=mysqli_fetch_array($sql_is1); 
												
								$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
								$t=mysqli_num_rows($sql_istbl);
								if($t > 0)
								{
									while($row_issuetbl=mysqli_fetch_array($sql_istbl))
									{ 
										$whid=$row_issuetbl['lotldg_whid'];
										$binid=$row_issuetbl['lotldg_binid'];
										$subbinid=$row_issuetbl['lotldg_subbinid'];
										$opups=$row_issuetbl['lotldg_balbags'];
										$opqty=$row_issuetbl['lotldg_balqty'];
										
										$balups=$opups-$nob;
										$balqty=$opqty-$qty;
										
										if($balqty>0 && $balups<=0)$balups=1;
											
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
										$gs=$row_issuetbl['lotldg_gs'];
										$resverstatus=$row_issuetbl['lotldg_resverstatus'];
										$revcomment=$row_issuetbl['lotldg_revcomment'];
										$geneticpurity=$row_issuetbl['lotldg_genpurity'];
										$yearcode=$row_issuetbl['yearcode'];
										$srtype=$row_issuetbl['lotldg_srtyp'];
										$srflg=$row_issuetbl['lotldg_srflg'];
										
										if($qty>0 && $opqty>=$qty)
										{
											$sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg,plantcode) values('$yearcode','Dispatch TDF', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$srtype', '$srflg','$plantcode')";
											$scv=mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
										}
									}
								}
							}
							else
							{
						
								$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and   subbinid='".$osbin."' and binid='".$obin."' and lotldg_crop='".$crop."' and lotno='".$lotno."' and lotldg_variety='".$variety."' order by lotdgp_id desc ") or die(mysqli_error($link));
								$row_is1=mysqli_fetch_array($sql_is1); 
												
								$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where  lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
								$t=mysqli_num_rows($sql_istbl);
								if($t > 0)
								{
									while($row_issuetbl=mysqli_fetch_array($sql_istbl))
									{ 
										$whid=$row_issuetbl['whid'];
										$binid=$row_issuetbl['binid'];
										$subbinid=$row_issuetbl['subbinid'];
										$opups=$row_issuetbl['balnop'];
										$opnomp=$row_issuetbl['balnomp'];
										$opqty=$row_issuetbl['balqty'];
										$nomp=0;
										
										$sq_dtdfmmc=mysqli_query($link,"Select * from tbl_dtdfmmc where   dmmc_lotno='".$row_issuetbl['lotno']."' and dtdf_id='".$pid."' and dtdfs_id='".$subid."' ") or die(mysqli_error($link));
										$tot_dtdfmmc=mysqli_num_rows($sq_dtdfmmc);
										while($row_dtdfmmc=mysqli_fetch_array($sq_dtdfmmc))
										{
											$nomp++;
										}
										
										$balups=$opups-$nob;
										$balnomp=$opnomp-$nomp;
										$balqty=$opqty-$qty;
										
										//if($balqty>0 && $balups<=0)$balups=1;
											
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
										
										if($balnomp<0)$balnomp=0;
										if($balqty<0)$balqty=0;
										if($qty>0 && $opqty>=$qty)
										{
											$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty,plantcode) values('$ycode','Dispatch TDF', '$stage', '$pid', '$arrival_date', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotldg_altrids', '$lotldg_alqtys', '$lotldg_alnomps', '$lotldg_spremflg', '$lotldg_totalqty','$plantcode')";
											$scv=mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
											//$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode,trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg) values('$yearcode','Dispatch TDF', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$srtype', '$srflg')";
											
										}
									}
								}
								$sql_arrsub_sub=mysqli_query($link,"select distinct dmmc_barcode from tbl_dtdfmmc where  dtdf_id='".$pid."'") or die(mysqli_error($link));
								while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
								{
									$sql_subsub1="update tbl_mpmain set mpmain_dflg='1' where mpmain_barcode='".$row_arrsub_sub['dmmc_barcode']."'";
									$asdf1=mysqli_query($link,$sql_subsub1) or die(mysqli_error($link));	
								}
							
							}
							
							
						}
					}
					
					$tsid=""; $ordrid="";  $ordernos=$ordernos.",";
					$tid240=explode(",",$ordernos);  
					$tid240=array_keys(array_flip($tid240));
					foreach($tid240 as $tid230)
					{
						if($tid230<>"")
						{
							$sqordm=mysqli_query($link,"Select * from tbl_orderm where  orderm_porderno='$tid230' and orderm_tflag=1") or die(mysqli_error($link));
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
					//echo $ordrid;
					$tid24=explode(",",$ordrid);
					$tid24=array_keys(array_flip($tid24));
					//if(count($tid24)>1)
					//{$tid24=sort($tid24);}
					
					//print_r($tid24);
					foreach($tid24 as $tid23)
					{
						if($tid23<>"")
						{
							$orid=$tid23;
							$totsubqty=0;
					
							$sql_ordersub=mysqli_query($link,"Select * from tbl_order_sub where  orderm_id='".$orid."' and order_sub_crop='$crop' and order_sub_variety='$variety' and order_sub_ups_type='$oruptyp'") or die(mysqli_error($link));
							$tot_ordersub=mysqli_num_rows($sql_ordersub);
							while($row_ordersub=mysqli_fetch_array($sql_ordersub))
							{		
								if($tqt>0)
								{
									$totsubqty=$tqt-$row_ordersub['order_sub_totbal_qty'];
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
										$tqt=$totsubqty;
										$tsqty=$row_ordersub['order_sub_totbal_qty'];
									}
									if($tsubqty==0)
									{
										if($tsid!="")
											{$tsid=$tsid.$row_ordersub['orderm_id'];}
										else
											{$tsid=$row_ordersub['orderm_id'];}
										
										$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'") or die(mysqli_error($link));
										$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
										while($row_ordersubsub=mysqli_fetch_array($sql_ordersubsub))
										{
											$totsubsubqty=0;
											
											$sql_in="update tbl_order_sub_sub set order_sub_subbal_qty='$totsubsubqty' where order_sub_sub_id='".$row_ordersubsub['order_sub_sub_id']."' and order_sub_sub_ups='$tupss'";	
											$aasssd=mysqli_query($link,$sql_in)or die(mysqli_error($link));	
										}
									}
									else
									{
										$sql_ordersubsub=mysqli_query($link,"Select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  order_sub_id='".$row_ordersub['order_sub_id']."' and order_sub_sub_ups='$tupss'") or die(mysqli_error($link));
										$tot_ordersubsub=mysqli_num_rows($sql_ordersubsub);
										while($row_ordersubsub=mysqli_fetch_array($sql_ordersubsub))
										{
											if($tsqty>0)
											{
												$totsubsubqty=$row_ordersubsub['order_sub_subbal_qty']-$tsqty;
												if($totsubsubqty<=0)$totsubsubqty=0;
												$sql_in="update tbl_order_sub_sub set order_sub_subbal_qty='$totsubsubqty' where order_sub_sub_id='".$row_ordersubsub['order_sub_sub_id']."' and order_sub_sub_ups='$tupss'";	
												$aasssd=mysqli_query($link,$sql_in)or die(mysqli_error($link));	
												$tsqty=$tsqty-$row_ordersubsub['order_sub_subbal_qty'];
											}
										}
									}
									
									$sql_in1="update tbl_orderm set orderm_dispatchflag=2 where orderm_id='$orid'";	
									$aaaa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
										
									$sql_in="update tbl_order_sub set order_sub_totbal_qty='$tsubqty' where order_sub_id='".$row_ordersub['order_sub_id']."'";	
									$aaaaa=mysqli_query($link,$sql_in)or die(mysqli_error($link));	
								}
							}
						}
					}
					
					$tid2400=explode(",",$tsid); 
					$tid2400=array_keys(array_flip($tid2400)); 
					foreach($tid2400 as $tid)
					{
						if($tid25<>"")
						{
							$t=0; 
							$sqlordersub=mysqli_query($link,"Select * from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id='".$tid25."'") or die(mysqli_error($link));
							$totordersub=mysqli_num_rows($sql_ordersub);
							while($rowordersub=mysqli_fetch_array($sqlordersub))
							{	
								if($rowordersub['order_sub_totbal_qty']==0)$t++;
							}
							if($t==$totordersub)
							{
								$sql_in1234="update tbl_orderm set orderm_dispatchflag=1 where orderm_id='$tid25'";	
								$aaaaaaa=mysqli_query($link,$sql_in1234)or die(mysqli_error($link));	
							}
						}
					}
					
					$sql_main2="update tbl_dtdf_sub set dtdfs_flg=1 where dtdfs_id='$subid' and dtdf_id='$pid'";
					$a1234562=mysqli_query($link,$sql_main2) or die(mysqli_error($link));	
						
				}
			}
			
			$sql_code1="SELECT MAX(dtdf_code) FROM tbl_dtdf where plantcode='".$plantcode."' ORDER BY dtdf_code DESC";
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
			
			$sql_code12="SELECT MAX(dtdf_ncode) FROM tbl_dtdf where plantcode='".$plantcode."' ORDER BY dtdf_ncode DESC";
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
			
			$sql_main="update tbl_dtdf set dtdf_tflg=1, dtdf_code=$ncode1, dtdf_ncode=$ncode12, dtdf_ttime='$ttime'  where dtdf_id='$pid'";
			$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));	
			
			
			$quer33=mysqli_query($link,"select * from tblfnyears where years_flg =1 and years_status='a'"); 
			$noticia33 = mysqli_fetch_array($quer33);
			$yr=$noticia33['ycode'];
			
			$sql_code1="SELECT MAX(gid) FROM tbl_gatepass where plantcode='".$plantcode."' and yearcode='$yr'";
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
				
					
			$sql_main22="insert into tbl_gatepass (gid, trid, trtype, gdate, yearcode,plantcode) values ('$code1', '$pid', 'Dispatch TDF Seed' ,'$arrival_date', '$yr','$plantcode')";
			$aa22=mysqli_query($link,$sql_main22) or die(mysqli_error($link));
			
			$sql_code="SELECT MAX(dnote_code) FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_ptype IN('Dealer','TDF','Export Buyer') and dnote_yearcode='$yr'";
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
			
						
			$sql_main23="insert into tbl_dispnote (dnote_code, dnote_trid, dnote_trtype, dnote_date, dnote_ptype, dnote_logid, dnote_yearcode,plantcode) values ('$code', '$pid', 'Dispatch TDF Seed' ,'$arrival_date' ,'$ptype' ,'$logid' ,'$yr','$plantcode')";
			$aa23=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
			//exit; 		
			
			echo "<script>window.location='select_disptdf_op.php?p_id=$pid'</script>";	
		}
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
<title>Dispatch - Transaction - Dispatch TDF</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="dispsttrn.js"></script>
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
	winHandle=window.open('disptdf_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit(sbmval1)
{ 	
	document.getElementById('subbutn').disabled=true;
	document.frmaddDepartment.sbmval.value="";
	//alert(sbmval1);
	var flg=0;
	if(sbmval1==0)
	{
		if(document.frmaddDepartment.mflg.value>0)
		{
			if(confirm('MMC not made in this Transaction?\nDo You wish to Final Submit it without making MMC?')==true)
			{
				document.frmaddDepartment.sbmval.value=sbmval1;
				document.getElementById('subbutn').disabled=true;
				flg=0;//return true;	 
			}
			else
			{
				document.getElementById('subbutn').disabled=false;
				document.frmaddDepartment.sbmval.value="";
				flg=1;//return false;
			}
		}
		else
		{
			if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
			{
				document.frmaddDepartment.sbmval.value=sbmval1;
				document.getElementById('subbutn').disabled=true;
				flg=0;//return true;	 
			}
			else
			{
				document.getElementById('subbutn').disabled=false;
				document.frmaddDepartment.sbmval.value="";
				flg=1;//return false;
			}
		}
	}
	else if(sbmval1==1)
	{
		if(confirm('Have You completed the Transaction?\nDo You wish to Proceed for MMC Allocation?')==true)
		{
			document.frmaddDepartment.sbmval.value=sbmval1;
			flg=0;//return true;	 
		}
		else
		{
			document.getElementById('subbutn').disabled=false;
			document.frmaddDepartment.sbmval.value="";
			flg=1;//return false;
		}
	}
	else
	{
		document.frmaddDepartment.sbmval.value="";
		document.getElementById('subbutn').disabled=false;
		flg=1;//return false;
	}
	//alert(flg);
	if(flg==0)
	{document.frmaddDepartment.submit(); return true;}
	else
	{return false;}
}

function showmbarcodes(nlots, sid, trid, sn)
{
	//var pid=document.frmaddDepartment.pid.value;
	winHandle=window.open('disptdf_lotdet.php?&pid='+trid+'&sid='+sid+'&sn='+sn+'&nlots='+nlots,'WelCome','top=170,left=180,width=520,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch TDF</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
<?php
//$tid=$tid; 

$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and  dtdf_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

	$arrival_id=$row_tbl['dtdf_id'];

	$tdate=$row_tbl['dtdf_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dtdf_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
$subtid=0;
$subsubtid=0;

?> 
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt11" value="" type="hidden"> 
	<input name="txt14" value="" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input name="pid" type="hidden" value="<?php echo $tid;?>" />
	<input name="sbmval" type="hidden" value="" />

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch TDF</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="261"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dtdf_tcode']."/".$row_tbl['dtdf_yearcode']."/".$row_tbl['dtdf_logid'];?></td>

<td width="192" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<!--<tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="261" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?>
  <input name="dcdate" id="dcdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;</td>
<td width="192" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_dcno'];?><input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="<?php echo $row_tbl['dtdf_dcno'];?>" /></td>
</tr>

<?php
//$quer3=mysqli_query($link,"SELECT * FROM tblclassification  where (main='Channel' or main='Stock Transfer') order by classification"); 
?>
 <tr class="Dark" height="30">
<td width="229" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dtdf_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dtdf_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dtdf_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dtdf_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dtdf_state']."' and productionlocationid='".$row_tbl['dtdf_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="192"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="257" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?>
  <input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dtdf_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dtdf_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?>
  <input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dtdf_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >-->
<?php
$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
$tt=mysqli_num_rows($quer33);
	if($tt > 0)
	{
		
		$row33=mysqli_fetch_array($quer33);
		$name=$row33['business_name'];
		$address=$row33['address'];
		$city=$row33['city']; 
		$state=$row33['state'];
		$pincode=$row33['pin'];
	}
	else
	{
		$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and   order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
		$tt=mysqli_num_rows($sql_month2);
		$row_month2=mysqli_fetch_array($sql_month2);
		$name=$row_month2['orderm_partyname'];
		$address=$row_month2['orderm_partyaddress'];
		$city=$row_month2['orderm_partycity']; 
		$state=$row_month2['orderm_partystate'];
		$pincode=$row_month2['orderm_partypin'];
	}
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dtdf_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $name;?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dtdf_party'];?>"  /></td>
	</tr>
<?php
	
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
</div>
<div id="orderdetails">
<?php
if($tt=mysqli_num_rows($quer33)>0)
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and   orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
else
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and   orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid;
$ver="";
if($arrivalid!="")
{
$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and   orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_variety") or die(mysqli_error($link));
$totver2=mysqli_num_rows($sql_ver2);
while($row_ver2=mysqli_fetch_array($sql_ver2))
{
	if($ver!="")
		$ver=$ver.",".$row_ver2['order_sub_variety'];
	else
		$ver=$row_ver2['order_sub_variety'];
}
}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS Type</td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoP</td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">No. of Orders</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoB Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Released</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Balance</td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">Select</td>-->
</tr>
<?php 

/*$arid=explode(",",$arrivalid);
foreach($arid as atrid)
{
if($atrid<>"")
{*/

$sn=1; $sn24=0; $sid=0; $dflg=0;
//if($arrivalid!="")
{
/*$sql_crp=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_crp);
while($row_crp=mysqli_fetch_array($sql_crp))
{
$sql_ver=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and orderm_id in($arrivalid) order by order_sub_variety") or die(mysqli_error($link));
$totver=mysqli_num_rows($sql_ver);
while($row_ver=mysqli_fetch_array($sql_ver))
{*/
//$sqlver=mysqli_query($link,"select distinct order_sub_ups_type from tbl_order_sub where order_sub_crop='".$row_crp['order_sub_crop']."' and order_sub_variety='".$row_ver['order_sub_variety']."' and orderm_id in($arrivalid) order by order_sub_ups_type") or die(mysqli_error($link));
//$totv=mysqli_num_rows($sqlver);
//while($rowver=mysqli_fetch_array($sqlver))
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{
$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}

//$sqlmon=mysqli_query($link,"select * from tbl_order_sub where order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
//$totz=mysqli_num_rows($sqlmon);
//while($rowtblsub=mysqli_fetch_array($sqlmon))
//{
	$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and   orderm_id in($arrivalid)  and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
	$totvs=mysqli_num_rows($sqlsloc);
	while($rowsloc=mysqli_fetch_array($sqlsloc))
	{
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and   orderm_id in($arrivalid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{
	$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and   order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_id")or die("Error:".mysqli_error($link));
	$totz=mysqli_num_rows($sqlmon);
	while($rowtblsub=mysqli_fetch_array($sqlmon))
	{
		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and   orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
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
		if($lotno!="")
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
		}
		//echo $rowtblsub['order_sub_id'];

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";


	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($qt > 0 )	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		
$selups=$rowsloc['order_sub_sub_ups'];
$dq=explode(" ",$selups);
//if($upstyp=="ST")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and   dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdfs_flg!=1 and dtdf_id='$tid' and dtdfs_upstype='$upstyp' and dtdfs_ups='".$selups."'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $nolots=0;

if($to=mysqli_num_rows($sq) > 0)
{
$ro=mysqli_fetch_array($sq);
$nups=$ro['dtdfs_ups']; 
$nnob=$ro['dtdfs_nob']; 
$nqty=$ro['dtdfs_qty']; 
$nbqty=$ro['dtdfs_bqty'];
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['dtdfs_id'];
$sn24=$sn;

$sq23=mysqli_query($link,"Select distinct dbss_lotno from tbl_dtdfsub_sub where plantcode='".$plantcode."' and   dtdfs_id='$sid' and dtdf_id='$tid'") or die(mysqli_error($link));
$totre=mysqli_num_rows($sq23);
while($row23=mysqli_fetch_array($sq23))
{
	$nolots++;
}
$stageval=$ro['dtdfs_stage'];
$selups=$ro['dtdfs_ups'];
}
//$selups=$ro['dtdfs_ups'];

?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $ordno ?>"><?php echo $nord;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $ordno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $selups;?><input type="hidden" name="upstp<?php echo $sn;?>" id="upstp_<?php echo $sn;?>" value="<?php echo $selups;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nolots;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext"><?php if($nbqty>0){ $dflg=0;?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>" <?php if($to=mysqli_num_rows($sq) > 0) {echo "checked";} ?> /><?php } else { $dflg=1;?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selshow('<?php echo $sn;?>','<?php echo $cro?>','<?php echo $variet?>','<?php echo $ordno ?>')" value="<?php echo $sn;?>"  /><?php } ?></td>-->
</tr>
<?php
$sn++;
}
}
}
}
}
}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" />
</table>
</div>	
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_remarks'];?></td>
</tr>
</table>
<?php
$flg=0;
$sql_dtdfsub=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and  dtdf_id='".$tid."'") or die (mysqli_error($link));
while($row_dtdfsub=mysqli_fetch_array($sql_dtdfsub))
if($row_dtdfsub['dtdfs_stage']=="Pack")$flg++;
if($flg>0)
{
?>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><input name="Submit" id="subbutn" type="image" src="../images/mmc.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit(1);">&nbsp;&nbsp;<!--<a href="add_dispmmc.php?pid=<?php echo $tid;?>"><img src="../images/mmc.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;--></td>
<!--<td valign="top" align="right"><a href="#"><img src="../images/mmc.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;</td>-->
</tr>
</table>
<?php
}
?>
<input type="hidden" name="mflg" value="<?php echo $flg;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_dispatch_tdf.php?pid=<?php echo $tid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" id="subbutn" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit(0);">&nbsp;&nbsp;</td>
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

  
