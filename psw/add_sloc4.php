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
	

	if(isset($_POST['frm_action'])=='submit')
	{ 
		$trid=trim($_POST['trid']);
		$code = trim($_POST['code']);
		$txtdate = trim($_POST['txtdate']);
		$txtcrop = trim($_POST['txtcrop']);
		$txtvariety = trim($_POST['txtvariety']);
		$txtlot1 = trim($_POST['txtlot1']);
		$oBags = trim($_POST['oBags']);
		$oqty = trim($_POST['oqty']);
		$txtwhfrom = trim($_POST['txtwhfrom']);
		$txtwhto = trim($_POST['txtwhto']);
		$txtslwhg1 = trim($_POST['txtslwhg1']);
		$txtslbing1 = trim($_POST['txtslbing1']);
		$txtslsubbg1 = trim($_POST['txtslsubbg1']);
		$txtep = trim($_POST['txtep']);
		$barcode = trim($_POST['barcode']);
		$txtnopsg = trim($_POST['txtnopsg']);
		$txtBagsg = trim($_POST['txtBagsg']);
		$txtqtyg = trim($_POST['txtqtyg']);
		$packtyp = trim($_POST['packtyp']);
		$orwoid = trim($_POST['orwoid']);
		$bar = trim($_POST['bar']);
		
		$tdate=$txtdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		if($txtep=="partial")
		{
			$tnop=0;$tnomp=0;$tqt=0;
			$sq230=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where plantcode='$plantcode' and slocid='$trid'") or die(mysqli_error($link));
			$totr230=mysqli_num_rows($sq230);
			while($row23=mysqli_fetch_array($sq230))
			{
				$tnop=$tnop+$row23['nop'];
				$tnomp=$tnomp+$row23['nomp'];
				$tqt=$tqt+$row23['qty'];
				$barcode=$row23['barcode'];
				$whid1=$row23['whid'];
				$binid1=$row23['binid'];
				$subbinid1=$row23['subbinid'];
				
				$sqlb1="update tbl_mpmain set mpmain_wh='$whid1', mpmain_bin='$binid1', mpmain_subbin='$subbinid1' where mpmain_barcode='".$barcode."'";
				$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
			}
			
			$qty=$tqt;
			$sqlissue12=mysqli_query($link,"select Distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$txtlot1."' and packtype='".$packtyp."'") or die(mysqli_error($link));
			while($rowissue12=mysqli_fetch_array($sqlissue12))
			{
								
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$txtlot1."' and packtype='".$packtyp."' and subbinid='".$rowissue12['subbinid']."'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 and balnomp > 0") or die(mysqli_error($link)); 
				$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
				if($tot_r=mysqli_num_rows($sql_issuetbl)>0)
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
					
					$balups=$opups-$tnop;
					$balnomp=$opnomp-$tnomp;
					$balqty=$opqty-$qty;
														
					if($balnomp<0)$balnomp=0;
					if($balqty<0)$balqty=0;
					if($qty>0 && $opqty>=$qty)
					{
						$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode) values('$ycode','PSWSUO', '$stage', '$trid', '$tdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$txtcrop', '$txtvariety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$tnop', '$tnomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty', '$plantcode')";
						mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
						$sql_sub_sub2="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode) values('$ycode','PSWSUC', '$stage', '$trid', '$tdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$txtcrop', '$txtvariety', '$whid1', '$binid1', '$subbinid1', '0', '0', '0', '$tnop', '$tnomp', '$qty', '$tnop', '$tnomp', '$qty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty', '$plantcode')";
						mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));				
						if($balqty == 0)
						{
							$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
							$cntg=0;
							while($row_issueg=mysqli_fetch_array($sql_issueg))
							{
								$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
								$row_issueg1=mysqli_fetch_array($sql_issueg1); 
													
								$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
								$totnog=mysqli_num_rows($sql_issuetblg);
								if($totnog == 0)
								{
									$cntg++;
								} 
							}
							  
							  
							$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
							//$cntg=0;
							while($row_issueg=mysqli_fetch_array($sql_issueg))
							{ 
								$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
								$row_issueg1=mysqli_fetch_array($sql_issueg1); 
											
								$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
		else
		{
			if($bar=="nobar")
			{
			
				$sql_in1="insert into tbl_sloc_psw (code, sldate, crop, variety, lotno, yearcode, surole, stage, whfrom, whto, sluptype, plantcode) values ('$code', '$tdate', '$txtcrop', '$txtvariety', '$txtlot1', '$yearid_id', '$lgnid', '$tp', '$txtwhfrom', '$txtwhto', 'barcodewise', '$plantcode')";
	 
				if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
				{
					$mainid=mysqli_insert_id($link);
					$trid=$mainid;
					$bnop=$txtnopsg; $bnomp=$txtBagsg-$b1; $bqt=$txtqtyg-$c1;
					$sql_in="insert into tbl_sloc_psw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opnop, opnomp, opqty, nop, nomp, qty, balnop, balnomp, balqty, rowid, wtinmp, packtype, sltype, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtnopsg', '$txtBagsg', '$txtqtyg', '$txtnopsg', '$txtBagsg', '$txtqtyg', '$bnop', '$bnomp', '$bqt', '$orwoid', '$wtinmp', '$packtyp', '$txtep', '$plantcode')";
					mysqli_query($link,$sql_in) or die(mysqli_error($link));
				
					/*$sq23=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where slocid='$mainid' and barcode='$barcode'") or die(mysqli_error($link));
					$totr=mysqli_num_rows($sq23);
					if($totr==0)
					{
						$sql_in2="insert into tbl_sloc_psw_sub2(slocid, crop, variety, lotno, whid, binid, subbinid, nop, nomp, qty, barcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtnopsg', '$txtBagsg', '$wtinmp', '$barcode')";
						mysqli_query($link,$sql_in2) or die(mysqli_error($link));
					}*/
				
				}
				
				$sql_sub=mysqli_query($link,"Select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='$trid'") or die(mysqli_error($link));
				$row_sub=mysqli_fetch_array($sql_sub);
				$c=$row_sub['crop'];
				$a=$row_sub['lotno'];
				$f=$row_sub['variety'];
				
				$whid1=$row_sub['whid'];
				$binid1=$row_sub['binid'];
				$subbinid1=$row_sub['subbinid'];
						
				$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotno='".$a."'") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
				
					$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$f."' and lotno='".$a."'") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
					
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						$nop1=0; $nop2=0; $b1=0; $b2=0;
						$ups=$row_issuetbl['packtype'];
						$wtinmp=$row_issuetbl['wtinmp'];
						$packtp=explode(" ",$row_issuetbl['packtype']);
						$packtyp=$packtp[0]; 
						if($packtp[1]=="Gms")
						{ 
							$ptp2=(1000/$packtp[0]);
						}
						else
						{
							$ptp2=$packtp[0];
						}
						$bl=($row_issuetbl['balqty']*100)/100;
						$b2=(($wtinmp*$row_issuetbl['balnomp'])*100)/100;
						if($b1===$b2)
						$penqty=0;
						else
						$penqty=$bl-$b2;
						
						
						if($penqty > 0)
						{
							if($packtp[1]=="Gms")
							{
								$nop1=($ptp2*$penqty);
							}
							else
							{
								$nop1=($penqty/$ptp2);
							}
						}
						if($packtp[1]=="Gms")
						{
							$nop2=($ptp2*$row_issuetbl['balqty']);
						}
						else
						{
							$nop2=($row_issuetbl['balqty']/$ptp2);
						}
						
						$nop2; $barcd="";
						$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
						$totextpouches=0; $totextqtys=0;
						$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
						$tot_mps=mysqli_num_rows($sql_mps);
						if($tot_mps > 0)
						{
							while($row_mps=mysqli_fetch_array($sql_mps))
							{
								$crparr=$row_mps['mpmain_crop'];
								$verarr=$row_mps['mpmain_variety'];
								$lotarr=explode(",", $row_mps['mpmain_lotno']);
								$upsarr=$row_mps['mpmain_upssize'];
								$noparr=explode(",", $row_mps['mpmain_mptnop']);
								
								$ct=0;
								$variety;
								$crop;
								for ($i=0; $i<count($lotarr); $i++)
								{
									if($a==$lotarr[$i] && $ups==$upsarr)
									{
										$nops=$nops+$noparr[$i];
										$ct++;
										$up=explode(" ", $ups);
										if($up[1]=="Gms")
										{
											$ptp=$up[0]/1000;
										}
										else
										{
											$ptp=$up[0];
										}
										$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct;
										
										if($barcd!="")
										$barcd=$barcd.",".$row_mps['mpmain_barcode'];
										else
										$barcd=$row_mps['mpmain_barcode'];
									}
								}
								
							}
						}
						
						$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$f' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0") or die(mysqli_error($link));
						$tot_mpl=mysqli_num_rows($sql_mpl);
						if($tot_mpl > 0)
						{
							while($row_mpl=mysqli_fetch_array($sql_mpl))
							{
								$crparr=$row_mpl['mpmain_crop'];
								$verarr=$row_mpl['mpmain_variety'];
								$lotarr=explode(",", $row_mpl['mpmain_lotno']);
								$upsarr=$row_mpl['mpmain_upssize'];
								$noparr=explode(",", $row_mpl['mpmain_lotnop']);
								
								$ct=0;
								$variety;
								$crop;
								for ($i=0; $i<count($lotarr); $i++)
								{
									if($a==$lotarr[$i] && $ups==$upsarr)
									{
										$nopl=$nopl+$noparr[$i];
										$ct++;
										$up=explode(" ", $ups);
										if($up[1]=="Gms")
										{
											$ptp=$up[0]/1000;
										}
										else
										{
											$ptp=$up[0];
										}
										$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
										
										if($barcd!="")
										$barcd=$barcd.",".$row_mps['mpmain_barcode'];
										else
										$barcd=$row_mps['mpmain_barcode'];
									}
								}
								
							}
						}
						

						$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$a' and mpmain_dflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
						$tot_mpns=mysqli_num_rows($sql_mpns);
						if($tot_mpns > 0)
						{
							while($row_mpns=mysqli_fetch_array($sql_mpns))
							{
								$crparr=$row_mpns['mpmain_crop'];
								$verarr=$row_mpns['mpmain_variety'];
								$lotarr=explode(",", $row_mpns['mpmain_lotno']);
								$upsarr=$row_mpns['mpmain_upssize'];
								$noparr=explode(",", $row_mpns['mpmain_lotnop']);
								
								$ct=0;
								$variety;
								$crop;
								for ($i=0; $i<count($lotarr); $i++)
								{
									if($a==$lotarr[$i] && $ups==$upsarr)
									{
										$nopns=$nopns+$noparr[$i];
										$ct++;
										$up=explode(" ", $ups);
										if($up[1]=="Gms")
										{
											$ptp=$up[0]/1000;
										}
										else
										{
											$ptp=$up[0];
										}
										$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct; 
										
										if($barcd!="")
										$barcd=$barcd.",".$row_mps['mpmain_barcode'];
										else
										$barcd=$row_mps['mpmain_barcode'];
									}
								}
								
							}
						}
						
						if($barcd!="")
						{
							$barcd1=explode(",",$barcd);
							$barcd2=array_unique($barcd1);
							foreach($barcd2 as $barcds)
							{
								if($barcds<>"")
								{
									$sqlb1="update tbl_mpmain set mpmain_wh='$whid1', mpmain_bin='$binid1', mpmain_subbin='$subbinid1' where mpmain_barcode='".$barcds."'";
									$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
								}
							}
						}
						
						//echo $nops."  -  ".$nopl;
						$totextpouches=$nops+$nopns+$nopl;
						$totextqtys=$qtys+$nompns+$nompl; 	
						$totextnomps=$nomps+$qtyns+$qtyl; 	
						$qty=$totextqtys;
						$nop=$totextpouches;
						$nomp=$totextnomps;
						
						$whid=$row_issuetbl['whid'];
						$binid=$row_issuetbl['binid'];
						$subbinid=$row_issuetbl['subbinid'];
						
						$opups=$row_issuetbl['balnop'];
						$opnomp=$row_issuetbl['balnomp'];
						$opqty=$row_issuetbl['balqty'];
						$olot=$row_issuetbl['orlot'];
							
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
										
						$balups=$opups-$nop;
						$balnomp=$opnomp-$nomp;
						$balqty=$opqty-$qty;
															
						if($balnomp<0)$balnomp=0;
						if($balqty<0)$balqty=0;
						if($qty>0 && $opqty>=$qty)
						{
							$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode) values('$ycode','PSWSUO', '$stage', '$trid', '$tdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$txtcrop', '$txtvariety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$nop', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty', '$plantcode')";
							mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
							
							$sql_sub_sub2="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode) values('$ycode','PSWSUC', '$stage', '$trid', '$tdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$txtcrop', '$txtvariety', '$whid1', '$binid1', '$subbinid1', '0', '0', '0', '$nop', '$nomp', '$qty', '$nop', '$nomp', '$qty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty', '$plantcode')";
							mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));		
											
							if($balqty == 0)
							{
								$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
								$cntg=0;
								while($row_issueg=mysqli_fetch_array($sql_issueg))
								{
									$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
									$row_issueg1=mysqli_fetch_array($sql_issueg1); 
														
									$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
									$totnog=mysqli_num_rows($sql_issuetblg);
									if($totnog == 0)
									{
										$cntg++;
									} 
								}
								  
								  
								$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
								//$cntg=0;
								while($row_issueg=mysqli_fetch_array($sql_issueg))
								{ 
									$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
									$row_issueg1=mysqli_fetch_array($sql_issueg1); 
												
									$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
			else
			{
				if($bar=="withbar")
				{
					$tnop=0;$tnomp=0;$tqt=0;
					$sq230=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where plantcode='$plantcode' and slocid='$trid'") or die(mysqli_error($link));
					$totr230=mysqli_num_rows($sq230);
					while($row23=mysqli_fetch_array($sq230))
					{
						$tnop=$tnop+$row23['nop'];
						$tnomp=$tnomp+$row23['nomp'];
						$tqt=$tqt+$row23['qty'];
						$barcode=$row23['barcode'];
						$whid1=$row23['whid'];
						$binid1=$row23['binid'];
						$subbinid1=$row23['subbinid'];
						
						$sqlb1="update tbl_mpmain set mpmain_wh='$whid1', mpmain_bin='$binid1', mpmain_subbin='$subbinid1' where mpmain_barcode='".$barcode."'";
						$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
					}
					
					$qty=$tqt;
					$sqlissue12=mysqli_query($link,"select Distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$txtlot1."' and packtype='".$packtyp."'") or die(mysqli_error($link));
					while($rowissue12=mysqli_fetch_array($sqlissue12))
					{
										
						$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$txtlot1."' and packtype='".$packtyp."' and subbinid='".$rowissue12['subbinid']."'") or die(mysqli_error($link));
						$row_issue1=mysqli_fetch_array($sql_issue1); 
							
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 and balnomp > 0") or die(mysqli_error($link)); 
						$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
						if($tot_r=mysqli_num_rows($sql_issuetbl)>0)
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
							
												
							$balups=$opups-$tnop;
							$balnomp=$opnomp-$tnomp;
							$balqty=$opqty-$qty;
																
							if($balnomp<0)$balnomp=0;
							if($balqty<0)$balqty=0;
							if($qty>0 && $opqty>=$qty)
							{
								$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode) values('$ycode','PSWSUO', '$stage', '$trid', '$tdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$txtcrop', '$txtvariety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$tnop', '$tnomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty', '$plantcode')";
								mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
								
								$sql_sub_sub2="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, lotldg_totalqty, plantcode) values('$ycode','PSWSUC', '$stage', '$trid', '$tdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$txtcrop', '$txtvariety', '$whid1', '$binid1', '$subbinid1', '0', '0', '0', '$tnop', '$tnomp', '$qty', '$tnop', '$tnomp', '$qty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$lotldg_rvflg', '$lotldg_alflg', '$lotldg_dispflg', '$lotalltrids', '$lotallqty', '$lotallnmp', '$lotldg_spremflg', '$lotldg_totalqty', '$plantcode')";
								mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));				
								if($balqty == 0)
								{
									$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
									$cntg=0;
									while($row_issueg=mysqli_fetch_array($sql_issueg))
									{
										$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
										$row_issueg1=mysqli_fetch_array($sql_issueg1); 
															
										$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
										$totnog=mysqli_num_rows($sql_issuetblg);
										if($totnog == 0)
										{
											$cntg++;
										} 
									}
									  
									  
									$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
									//$cntg=0;
									while($row_issueg=mysqli_fetch_array($sql_issueg))
									{ 
										$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
										$row_issueg1=mysqli_fetch_array($sql_issueg1); 
													
										$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
		
		
		$sql_code="SELECT MAX(scode) FROM tbl_sloc_psw where plantcode='$plantcode' and yearcode='$yearid_id' ORDER BY scode DESC";
		/*else
		$sql_code="SELECT MAX(scode) FROM tbl_sloc_psw  ORDER BY scode DESC";*/
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
		
				
		$sql_main="update tbl_sloc_psw set supflg=1, scode=$code  where slid='".$trid."'";
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		
		//exit;
		echo "<script>window.location='home_sloc4.php'</script>";	
	}
		
	
	$a="TSU";
	$sql_code="SELECT MAX(code) FROM tbl_sloc_psw  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1=$a.$code."/".$lgnid;
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW -Transaction  - Sloc Update-WH-RO</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
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
<script type="text/javascript" src="../include/validation.js"></script>
<script src="slocupbarcode.js"></script>
<script language="javascript" type="text/javascript">
var x = 0;

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

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isNumberKey1(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}

function clks(val)
{
	document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		f=1;
		return false;
	} 
	if(document.frmaddDepartment.txtep.value=="partial" && document.frmaddDepartment.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		f=1;
		return false;
	}
	if(f==0)
	{
		document.frmaddDepartment.submit();
		return true;	 
	}
	else
	{
		return false;
	}
}

function modetchk(classval) 
{
	if(document.frmaddDepartment.txtwhto.value=="")
	{
		alert("Please Select From Warehouse");
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		document.frmaddDepartment.txtcrop.value='';
		return false;
	}
	else
	{
		document.frmaddDepartment.txtlot1.value="";
		document.frmaddDepartment.trid.value=0;
		document.getElementById('subdiv').style.display="none";
		showUser(classval,'vitem','item','','','','','');
	}
}

function modetchk12(classval) 
{
	document.frmaddDepartment.txtlot1.value=""
	document.frmaddDepartment.trid.value=0;
	document.getElementById('subdiv').style.display="none";
	showUser(classval,'whitem','whitem1','','','','','');
}

function modetchk1(val)
{
	document.frmaddDepartment.txtlot1.value=""
	document.frmaddDepartment.trid.value=0;
	document.getElementById('subdiv').style.display="none";
}

function chktp(val)
{
	//document.frmaddDepartment.txtmtype.value=val;
	document.getElementById('subdiv').style.display="block";
	setTimeout('chktyp()',200);

}

function chktyp()
{ 
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		var trid=document.frmaddDepartment.trid.value;
		var txtwhto=document.frmaddDepartment.txtwhto.value;	
		if(opttyp !="")
		{
			document.getElementById("maindiv").style.display="block";
			document.getElementById("subsubdiv").style.display="none";
			showUser(opttyp,'subdiv','slocshowbar',txtwhto,clasid,itmid,trid,'');
		}
		else
		{
			alert("please select LOT Number");
		}
	}
	else
	{
		alert("please select LOT Number");
	}
}

function wh1(wh1val)
{ 
	showUser(wh1val,'bing1','wh','bing1','','','','');
}

/*function wh2(wh2val)
{   
	showUser(wh2val,'bing2','wh','bing2','','','','');
}

function wh3(wh3val)
{   
	showUser(wh3val,'bing3','wh','bing3','','','','');
}

function wh4(wh4val)
{   
	showUser(wh4val,'bing4','wh','bing4','','','','');
}

function wh5(wh5val)
{   
	showUser(wh5val,'bing5','wh','bing5','','','','');
}

function wh6(wh6val)
{   
	showUser(wh6val,'bing6','wh','bing6','','','','');
}

function wh7(wh7val)
{   
	showUser(wh7val,'bing7','wh','bing7','','','','');
}

function wh8(wh8val)
{   
	showUser(wh8val,'bing8','wh','bing8','','','','');
}*/


function bin1(bin1val)
{ //alert(bin1val);
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

/*function bin2(bin2val)
{ alert(bin2val);
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin3(bin3val)
{
	if(document.frmaddDepartment.txtslwhg3.value!="")
	{
		showUser(bin3val,'sbing3','bin','txtslsubbg3','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin4(bin4val)
{
	if(document.frmaddDepartment.txtslwhg4.value!="")
	{
		showUser(bin4val,'sbing4','bin','txtslsubbg4','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin5(bin5val)
{
	if(document.frmaddDepartment.txtslwhg5.value!="")
	{
		showUser(bin5val,'sbing5','bin','txtslsubbg5','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin6(bin6val)
{
	if(document.frmaddDepartment.txtslwhg6.value!="")
	{
		showUser(bin6val,'sbing6','bin','txtslsubbg6','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin7(bin7val)
{
	if(document.frmaddDepartment.txtslwhg7.value!="")
	{
		showUser(bin7val,'sbing7','bin','txtslsubbg7','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin8(bin8val)
{
	if(document.frmaddDepartment.txtslwhg8.value!="")
	{
		showUser(bin8val,'sbing8','bin','txtslsubbg8','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}*/

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		/*var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w1==w2) || (w1==w3) || (w1==w4) || (w1==w5) || (w1==w6) || (w1==w7) || (w1==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		}*/
		var slocnogood=document.frmaddDepartment.txtlot1.value;;
		var trid=document.frmaddDepartment.trid.value;
		/*if(document.frmaddDepartment.exnopsg1.value!="")
		var nopv1=document.frmaddDepartment.exnopsg1.value;
		else*/
		var nopv1="";
		/*if(document.frmaddDepartment.exBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.exBagsg1.value;
		else*/
		var Bagsv1="";
		/*if(document.frmaddDepartment.exqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.exqtyg1.value;
		else*/
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid,nopv1);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}
/*
function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w2==w1) || (w2==w3) || (w2==w4) || (w2==w5) || (w2==w6) || (w2==w7) || (w2==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg2.value!="")
		var nopv2=document.frmaddDepartment.exnopsg2.value;
		else
		var nopv2="";
		if(document.frmaddDepartment.exBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.exBagsg2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.exqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.exqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid,nopv2);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w3==w1) || (w3==w2) || (w3==w4) || (w3==w5) || (w3==w6) || (w3==w7) || (w3==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg3.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg3.value!="")
		var nopv3=document.frmaddDepartment.exnopsg3.value;
		else
		var nopv3="";
		if(document.frmaddDepartment.exBagsg3.value!="")
		var Bagsv3=document.frmaddDepartment.exBagsg3.value;
		else
		var Bagsv3="";
		if(document.frmaddDepartment.exqtyg3.value!="")
		var qtyv3=document.frmaddDepartment.exqtyg3.value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,Bagsv3,qtyv3,trid,nopv3);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing3.focus();
	}
}

function subbin4(subbin4val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing4.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w4==w1) || (w4==w2) || (w4==w3) || (w4==w5) || (w4==w6) || (w4==w7) || (w4==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg4.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg4.value!="")
		var nopv4=document.frmaddDepartment.exnopsg4.value;
		else
		var nopv4="";
		if(document.frmaddDepartment.exBagsg4.value!="")
		var Bagsv4=document.frmaddDepartment.exBagsg4.value;
		else
		var Bagsv4="";
		if(document.frmaddDepartment.exqtyg4.value!="")
		var qtyv4=document.frmaddDepartment.exqtyg4.value;
		else
		var qtyv4="";
		showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbg4',slocnogood,Bagsv4,qtyv4,trid,nopv4);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing4.focus();
	}
}

function subbin5(subbin5val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing5.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w5==w1) || (w5==w2) || (w5==w3) || (w5==w4) || (w5==w6) || (w5==w7) || (w5==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg5.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg5.value!="")
		var nopv5=document.frmaddDepartment.exnopsg5.value;
		else
		var nopv5="";
		if(document.frmaddDepartment.exBagsg5.value!="")
		var Bagsv5=document.frmaddDepartment.exBagsg5.value;
		else
		var Bagsv5="";
		if(document.frmaddDepartment.exqtyg5.value!="")
		var qtyv5=document.frmaddDepartment.exqtyg5.value;
		else
		var qtyv5="";
		showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbg5',slocnogood,Bagsv5,qtyv5,trid,nopv5);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing5.focus();
	}
}

function subbin6(subbin6val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing6.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w6==w1) || (w6==w2) || (w6==w3) || (w6==w4) || (w6==w5) || (w6==w7) || (w6==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg6.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg6.value!="")
		var nopv6=document.frmaddDepartment.exnopsg6.value;
		else
		var nopv6="";
		if(document.frmaddDepartment.exBagsg6.value!="")
		var Bagsv6=document.frmaddDepartment.exBagsg6.value;
		else
		var Bagsv6="";
		if(document.frmaddDepartment.exqtyg6.value!="")
		var qtyv6=document.frmaddDepartment.exqtyg6.value;
		else
		var qtyv6="";
		showUser(subbin6val,'slocrow6','subbin',itemv,'txtslsubbg6',slocnogood,Bagsv6,qtyv6,trid,nopv6);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing6.focus();
	}
}

function subbin7(subbin7val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing7.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w7==w1) || (w7==w3) || (w7==w4) || (w7==w5) || (w7==w6) || (w7==w2) || (w7==w8))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg7.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg7.value!="")
		var nopv7=document.frmaddDepartment.exnopsg7.value;
		else
		var nopv7="";
		if(document.frmaddDepartment.exBagsg7.value!="")
		var Bagsv7=document.frmaddDepartment.exBagsg7.value;
		else
		var Bagsv7="";
		if(document.frmaddDepartment.exqtyg7.value!="")
		var qtyv7=document.frmaddDepartment.exqtyg7.value;
		else
		var qtyv7="";
		showUser(subbin7val,'slocrow7','subbin',itemv,'txtslsubbg7',slocnogood,Bagsv7,qtyv7,trid,nopv7);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing7.focus();
	}
}

function subbin8(subbin8val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing8.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		if((w8==w1) || (w8==w3) || (w8==w4) || (w8==w5) || (w8==w6) || (w8==w7) || (w8==w2))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg8.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.exnopsg8.value!="")
		var nopv8=document.frmaddDepartment.exnopsg8.value;
		else
		var nopv8="";
		if(document.frmaddDepartment.exBagsg8.value!="")
		var Bagsv8=document.frmaddDepartment.exBagsg8.value;
		else
		var Bagsv8="";
		if(document.frmaddDepartment.exqtyg8.value!="")
		var qtyv8=document.frmaddDepartment.exqtyg8.value;
		else
		var qtyv8="";
		showUser(subbin8val,'slocrow8','subbin',itemv,'txtslsubbg8',slocnogood,Bagsv8,qtyv8,trid,nopv8);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing8.focus();
	}
}*/

function nopsf1(nops1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg1.value="";
	}
	if(document.frmaddDepartment.txtslnopsg1.value!="")
	{
		var exu=0; var x=0; var y=0; var z=0;
		if(document.frmaddDepartment.exnopsg1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg1.value);
		document.frmaddDepartment.balnopg1.value=parseInt(document.frmaddDepartment.txtslnopsg1.value,10);
		if(document.frmaddDepartment.txtslnopsg1.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				z=ptp[0];
			}
			
			x=(parseFloat(document.frmaddDepartment.txtslnopsg1.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				y=0;
			}
			document.frmaddDepartment.balqtyg1.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				y=0;
			}
			
			document.frmaddDepartment.balqtyg1.value=y;
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg1.value=document.frmaddDepartment.balqtyg1.value;
		document.frmaddDepartment.txtslqtyg1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value).toFixed(3);
	}
	else
	{
		document.frmaddDepartment.balnopg1.value="";
	}
}

function nopsf2(nops2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg2.value="";
	}
	if(document.frmaddDepartment.txtslnopsg2.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg2.value);
		document.frmaddDepartment.balnopg2.value=parseInt(document.frmaddDepartment.txtslnopsg2.value);
		if(document.frmaddDepartment.txtslnopsg2.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg2.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=y;
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg2.value=document.frmaddDepartment.balqtyg2.value;
		document.frmaddDepartment.txtslqtyg2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg2.value="";
	}
}

function nopsf3(nops3val)
{
	if(document.frmaddDepartment.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg3.value="";
	}
	if(document.frmaddDepartment.txtslnopsg3.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg3.value);
		document.frmaddDepartment.balnopg3.value=parseInt(document.frmaddDepartment.txtslnopsg3.value);
		if(document.frmaddDepartment.txtslnopsg3.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg3.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=y;
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg3.value=document.frmaddDepartment.balqtyg3.value;
		document.frmaddDepartment.txtslqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg3.value="";
	}
}

function nopsf4(nops4val)
{
	if(document.frmaddDepartment.txtslsubbg4.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg4.value="";
	}
	if(document.frmaddDepartment.txtslnopsg4.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg4.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg4.value);
		document.frmaddDepartment.balnopg4.value=parseInt(document.frmaddDepartment.txtslnopsg4.value);
		if(document.frmaddDepartment.txtslnopsg4.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg4.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=y;
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg4.value=document.frmaddDepartment.balqtyg4.value;
		document.frmaddDepartment.txtslqtyg4.value=parseFloat(document.frmaddDepartment.txtslqtyg4.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg4.value="";
	}
}

function nopsf5(nops5val)
{
	if(document.frmaddDepartment.txtslsubbg5.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg5.value="";
	}
	if(document.frmaddDepartment.txtslnopsg5.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg5.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg5.value);
		document.frmaddDepartment.balnopg5.value=parseInt(document.frmaddDepartment.txtslnopsg5.value);
		if(document.frmaddDepartment.txtslnopsg5.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg5.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=y;
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg5.value=document.frmaddDepartment.balqtyg5.value;
		document.frmaddDepartment.txtslqtyg5.value=parseFloat(document.frmaddDepartment.txtslqtyg5.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg5.value="";
	}
}

function nopsf6(nops6val)
{
	if(document.frmaddDepartment.txtslsubbg6.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg6.value="";
	}
	if(document.frmaddDepartment.txtslnopsg6.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg6.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg6.value);
		document.frmaddDepartment.balnopg6.value=parseInt(document.frmaddDepartment.txtslnopsg6.value);
		if(document.frmaddDepartment.txtslnopsg6.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg6.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=y;
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg6.value=document.frmaddDepartment.balqtyg6.value;
		document.frmaddDepartment.txtslqtyg6.value=parseFloat(document.frmaddDepartment.txtslqtyg6.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg6.value="";
	}
}

function nopsf7(nops7val)
{
	if(document.frmaddDepartment.txtslsubbg7.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg7.value="";
	}
	if(document.frmaddDepartment.txtslnopsg7.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg7.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg7.value);
		document.frmaddDepartment.balnopg7.value=parseInt(document.frmaddDepartment.txtslnopsg7.value);
		if(document.frmaddDepartment.txtslnopsg7.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg7.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=y;
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg7.value=document.frmaddDepartment.balqtyg7.value;
		document.frmaddDepartment.txtslqtyg7.value=parseFloat(document.frmaddDepartment.txtslqtyg7.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg7.value="";
	}
}

function nopsf8(nops8val)
{
	if(document.frmaddDepartment.txtslsubbg8.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslnopsg8.value="";
	}
	if(document.frmaddDepartment.txtslnopsg8.value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exnopsg8.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exnopsg8.value);
		document.frmaddDepartment.balnopg8.value=parseInt(document.frmaddDepartment.txtslnopsg8.value);
		if(document.frmaddDepartment.txtslnopsg8.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg8.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=y;
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg8.value=document.frmaddDepartment.balqtyg8.value;
		document.frmaddDepartment.txtslqtyg8.value=parseFloat(document.frmaddDepartment.txtslqtyg8.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnopg8.value="";
	}
}

function Bagsf1(Bags1val)
{	
	if(document.frmaddDepartment.txtslBagsg1.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg1.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg1.value);
		document.frmaddDepartment.balnompg1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value);
		if(document.frmaddDepartment.txtslnopsg1.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg1.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg1.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg1.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg1.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg1.value=y;
			document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.balqtyg1.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg1.value=document.frmaddDepartment.balqtyg1.value;
		document.frmaddDepartment.txtslqtyg1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg1.value="";
	}

}

function Bagsf2(Bags2val)
{
	if(document.frmaddDepartment.txtslBagsg2.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg2.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg2.value);
		document.frmaddDepartment.balnompg2.value=parseInt(document.frmaddDepartment.txtslBagsg2.value);
		if(document.frmaddDepartment.txtslnopsg2.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg2.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg2.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg2.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg2.value=y;
			document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.balqtyg2.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg2.value=document.frmaddDepartment.balqtyg2.value;
		document.frmaddDepartment.txtslqtyg2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg2.value="";
	}
}
function Bagsf3(Bags3val)
{
	if(document.frmaddDepartment.txtslBagsg3.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg3.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg3.value);
		document.frmaddDepartment.balnompg3.value=parseInt(document.frmaddDepartment.txtslBagsg3.value);
		if(document.frmaddDepartment.txtslnopsg3.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg3.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg3.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg3.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg3.value=y;
			document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.balqtyg3.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg3.value=document.frmaddDepartment.balqtyg3.value;
		document.frmaddDepartment.txtslqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg3.value="";
	}
}
function Bagsf4(Bags4val)
{
	if(document.frmaddDepartment.txtslBagsg4.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg4.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg4.value);
		document.frmaddDepartment.balnompg4.value=parseInt(document.frmaddDepartment.txtslBagsg4.value);
		if(document.frmaddDepartment.txtslnopsg4.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg4.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg4.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg4.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg4.value=y;
			document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.balqtyg4.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg4.value=document.frmaddDepartment.balqtyg4.value;
		document.frmaddDepartment.txtslqtyg4.value=parseFloat(document.frmaddDepartment.txtslqtyg4.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg4.value="";
	}
}
function Bagsf5(Bags5val)
{
	if(document.frmaddDepartment.txtslBagsg5.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg5.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg5.value);
		document.frmaddDepartment.balnompg5.value=parseInt(document.frmaddDepartment.txtslBagsg5.value);
		if(document.frmaddDepartment.txtslnopsg5.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg5.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg5.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg5.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg5.value=y;
			document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.balqtyg5.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg5.value=document.frmaddDepartment.balqtyg5.value;
		document.frmaddDepartment.txtslqtyg5.value=parseFloat(document.frmaddDepartment.txtslqtyg5.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg5.value="";
	}
}
function Bagsf6(Bags6val)
{
	if(document.frmaddDepartment.txtslBagsg6.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg6.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg6.value);
		document.frmaddDepartment.balnompg6.value=parseInt(document.frmaddDepartment.txtslBagsg6.value);
		if(document.frmaddDepartment.txtslnopsg6.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg6.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg6.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg6.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg6.value=y;
			document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.balqtyg6.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg6.value=document.frmaddDepartment.balqtyg6.value;
		document.frmaddDepartment.txtslqtyg6.value=parseFloat(document.frmaddDepartment.txtslqtyg6.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg6.value="";
	}
}
function Bagsf7(Bags7val)
{
	if(document.frmaddDepartment.txtslBagsg7.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg7.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg7.value);
		document.frmaddDepartment.balnompg7.value=parseInt(document.frmaddDepartment.txtslBagsg7.value);
		if(document.frmaddDepartment.txtslnopsg7.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg7.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg7.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg7.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg7.value=y;
			document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.balqtyg7.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg7.value=document.frmaddDepartment.balqtyg7.value;
		document.frmaddDepartment.txtslqtyg7.value=parseFloat(document.frmaddDepartment.txtslqtyg7.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg7.value="";
	}
}
function Bagsf8(Bags8val)
{
	if(document.frmaddDepartment.txtslBagsg8.value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exBagsg8.value=="")
		exq=0;
		else
		exq=parseInt(document.frmaddDepartment.exBagsg8.value);
		document.frmaddDepartment.balnompg8.value=parseInt(document.frmaddDepartment.txtslBagsg8.value);
		if(document.frmaddDepartment.txtslnopsg8.value > 0)
		{
			var ptp=document.frmaddDepartment.packtyp.value.split(" ");
			if(ptp[1]=="Gms")
			{
				var z=(parseFloat(ptp[0])/1000);
			}
			else
			{
				var z=ptp[0];
			}
			var x=(parseFloat(document.frmaddDepartment.txtslnopsg8.value)*parseFloat(z));
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=parseFloat(x)+parseFloat(y);
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		else
		{
			if(document.frmaddDepartment.txtslBagsg8.value>0)
			{
				var y=(parseFloat(document.frmaddDepartment.txtslBagsg8.value)*parseFloat(document.frmaddDepartment.wtinmp.value));
			}
			else
			{
				var y=0;
			}
			document.frmaddDepartment.balqtyg8.value=y;
			document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.balqtyg8.value).toFixed(3);
		}
		document.frmaddDepartment.txtslqtyg8.value=document.frmaddDepartment.balqtyg8.value;
		document.frmaddDepartment.txtslqtyg8.value=parseFloat(document.frmaddDepartment.txtslqtyg8.value).toFixed(3);
	}
	else
	{
	document.frmaddDepartment.balnompg8.value="";
	}
}



function pform()
{
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		f=1;
		return false;
	} 
	if((document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");
		f=1;	
		return false;
	} 
	if((document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		f=1;
		return false;
	} 
	if((document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		f=1;
		return false;		
	}
	if(document.frmaddDepartment.brflg.value>0)
	{
		alert("Cannot Shift Barcode.");	
		f=1;
		return false;		
	}
	if(document.frmaddDepartment.barcode.value!="")
	{
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'maindiv','mformcc','','','','','');
		}
	}
	else
	{
		alert("Please scan Barcode");
		return false;
	}
}	

function pformupdate()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslwhg3.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslbing3.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg3.value > 0) && (document.frmaddDepartment.txtslsubbg3.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg4.value>0) && (document.frmaddDepartment.txtslwhg4.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg4.value>0) && (document.frmaddDepartment.txtslbing4.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg4.value > 0) && (document.frmaddDepartment.txtslsubbg4.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg5.value>0) && (document.frmaddDepartment.txtslwhg5.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg5.value>0) && (document.frmaddDepartment.txtslbing5.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg5.value > 0) && (document.frmaddDepartment.txtslsubbg5.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg6.value>0) && (document.frmaddDepartment.txtslwhg6.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg6.value>0) && (document.frmaddDepartment.txtslbing6.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg6.value > 0) && (document.frmaddDepartment.txtslsubbg6.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg7.value>0) && (document.frmaddDepartment.txtslwhg7.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg7.value>0) && (document.frmaddDepartment.txtslbing7.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg7.value > 0) && (document.frmaddDepartment.txtslsubbg7.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if((document.frmaddDepartment.txtslqtyg8.value>0) && (document.frmaddDepartment.txtslwhg8.value==""))
	{
		alert("Warehouse Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg8.value>0) && (document.frmaddDepartment.txtslbing8.value==""))
	{
		alert("Bin Not selected");	
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg8.value > 0) && (document.frmaddDepartment.txtslsubbg8.value==""))
	{
		alert("Sub Bin Not selected");	
		return false;		
	}
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var u1=document.frmaddDepartment.balnompg1.value;
		var u2=document.frmaddDepartment.balnompg2.value;
		var u3=document.frmaddDepartment.balnompg3.value;
		var u4=document.frmaddDepartment.balnompg4.value;
		var u5=document.frmaddDepartment.balnompg5.value;
		var u6=document.frmaddDepartment.balnompg6.value;
		var u7=document.frmaddDepartment.balnompg7.value;
		var u8=document.frmaddDepartment.balnompg8.value;
		
		var q1=document.frmaddDepartment.balqtyg1.value;
		var q2=document.frmaddDepartment.balqtyg2.value;
		var q3=document.frmaddDepartment.balqtyg3.value;
		var q4=document.frmaddDepartment.balqtyg4.value;
		var q5=document.frmaddDepartment.balqtyg5.value;
		var q6=document.frmaddDepartment.balqtyg6.value;
		var q7=document.frmaddDepartment.balqtyg7.value;
		var q8=document.frmaddDepartment.balqtyg8.value;
		
		var n1=document.frmaddDepartment.balnopg1.value;
		var n2=document.frmaddDepartment.balnopg2.value;
		var n3=document.frmaddDepartment.balnopg3.value;
		var n4=document.frmaddDepartment.balnopg4.value;
		var n5=document.frmaddDepartment.balnopg5.value;
		var n6=document.frmaddDepartment.balnopg6.value;
		var n7=document.frmaddDepartment.balnopg7.value;
		var n8=document.frmaddDepartment.balnopg8.value;
		
		var n=document.frmaddDepartment.txtnopsg.value;
		var d=document.frmaddDepartment.txtqtyg.value;
		var u=document.frmaddDepartment.txtBagsg.value;
				
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;if(q6=="")q6=0;if(q7=="")q7=0;if(q8=="")q8=0;
		if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;if(u4=="")u4=0;if(u5=="")u5=0;if(u6=="")u6=0;if(u7=="")u7=0;if(u8=="")u8=0;
		if(n1=="")n1=0;if(n2=="")n2=0;if(n3=="")n3=0;if(n4=="")n4=0;if(n5=="")n5=0;if(n6=="")n6=0;if(n7=="")n7=0;if(n8=="")n8=0;
		if(n=="")n=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3)+parseFloat(q4)+parseFloat(q5)+parseFloat(q6)+parseFloat(q7)+parseFloat(q8);
		var Bagsd=parseInt(u1)+parseInt(u2)+parseInt(u3)+parseInt(u4)+parseInt(u5)+parseInt(u6)+parseInt(u7)+parseInt(u8);
		var nopsd=parseInt(n1)+parseInt(n2)+parseInt(n3)+parseInt(n4)+parseInt(n5)+parseInt(n6)+parseInt(n7)+parseInt(n8);
		var f=0;
		//alert(qtyd);
		if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			f=1;return false;
			
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			f=1;return false;
			
		}
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			f=1;return false;
			
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			f=1;return false;
			
		}
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'maindiv','mformccupdate','','','','','');
		}
	}
	else
	{
		alert("Please select Lot No.");
		return false;
	}
}

function showsloc(val1, val2, val3, classval)
{
	//alert(classval);
	document.frmaddDepartment.oBags.value=val1;
	document.frmaddDepartment.oqty.value=val2;
	document.frmaddDepartment.orwoid.value=val3;
	var trid=document.frmaddDepartment.trid.value;
	//alert(val3);
	var opttyp=document.frmaddDepartment.txtlot1.value;
	var clasid=document.frmaddDepartment.txtcrop.value;
	var itmid=document.frmaddDepartment.txtvariety.value;
	//alert(opttyp);			
	showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,classval);
	//document.getElementById('sloc1').style.display="block";
}

function chkbar(barval)
{
	//alert(barval);
	showUser(barval,'bardiv','scanbar','','','','','');
}

function editrec(v1,v2,v3,v4)
{
	showUser(v1,'subsubdiv','etdrecsl',v2,v3,v4,'','');
}

function openslocpop()
{
	document.frmaddDepartment.trid.value=0;
	//document.getElementById("maindiv").style.display="none";
	//document.getElementById("subsubdiv").style.display="none";	
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		//document.frmaddDepartment.txt1.focus();
	}
	else
	{
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var txtwhfrom=document.frmaddDepartment.txtwhfrom.value;
		winHandle=window.open('getuser_slocbar_lotno.php?crop='+crop+'&variety='+variety+'&txtwhfrom='+txtwhfrom,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}
function openprintsubbin(subid, bid, wid, lid)
{
	var itm="";
	var tp="";
	winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function subbin(subid)
{
	showUser(subid,'sbinstatus','status','','','','','');
}


function chkbarcode1(mltval)
{ //alert(mltval);
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
	document.getElementById(txtbarcode).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		if(document.frmaddDepartment.totbarcs.value!="")
		{
			var totbarcs=document.frmaddDepartment.totbarcs.value.split(",");
			var x=0;
			for(var i=0; i<totbarcs.length; i++)
			{
				if(totbarcs[i]==document.getElementById(txtbarcode).value)
				{
					x++;
				}
			}
			if(x>0)
			{
				alert("Duplicate Barcode.");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(flg==0)
	{
		var bardet=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		var ver=document.frmaddDepartment.txtvariety.value;
		var txtwhfrom=document.frmaddDepartment.txtwhfrom.value;
		/*var mchksel=document.frmaddDepartment.mchksel.value;
		var upstyp=document.frmaddDepartment.txteupstyp.value;*/
		showUser(bardet,'barchk','barchk1',mltval,trid,ver,txtwhfrom,'','')
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmode('+mltval+')', 1000);
	}
}

function showpmode(mltval)
{ //alert(mltval);
	var bardet=document.frmaddDepartment.txtlot1.value;
	var trid=document.frmaddDepartment.trid.value;
	var ver=document.frmaddDepartment.txtvariety.value;
	var txtwhfrom=document.frmaddDepartment.txtwhfrom.value;
	/*var ups=document.frmaddDepartment.txteups.value;
	var mchksel=document.frmaddDepartment.mchksel.value;
	var upstyp=document.frmaddDepartment.txteupstyp.value;*/
	var brflg=document.frmaddDepartment.brflg.value;
	//var upstyp=document.frmaddDepartment.txteupstyp.value;
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(bardet,'barchk','barchk1',mltval,trid,ver,txtwhfrom,'','')
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmode('+mltval+')', 1500);
	}
	else
	{
		//alert(document.frmaddDepartment.brflg.value);
		var txtbarcode="txtbarcod";
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Barcode not present in System");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==2)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Barcode already Dispatched");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==3)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Barcode already Loaded in Transaction");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==4)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Variety not matching with Selected Variety");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==5)
		{
			alert("Barcode cannot be Shifted.\n\nReason: UPS not matching with Selected Lot");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==6)
		{
			alert("Barcode cannot be Shifted.\n\nReason: This Lot's current QC/GOT Status is FAIL");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==7)
		{
			alert("Barcode cannot be Shifted.\n\nReason: This Lot's current QC/GOT Status is UT and Soft Release is not activated");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==8)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==9)
		{
			alert("Barcode cannot be Shifted.\n\nReason: This Barcode is already Unpackaged");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==10)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Lot is under Reserve Status");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==11)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Barcode Already sifted to the selected warehouse");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==12)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Allocated Qty has been already Loaded to Selected Party");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==13)
		{
			alert("Barcode cannot be Shifted.\n\nReason: Allocated Qty has been already Loaded to Selected Lot Number");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
		}
		pform();
	}
}
</script>
 <style>
   		 #table-wrapper {
                height:101px;
				width:800px;
                overflow:auto;
				/*overflow-y:scroll;*/  
                margin-top:0px;
                  }
          #table-wrapper table {
                 width:800px;
				 float:right;
                 color:#000;    
                 }
          #table-wrapper table thead tr .text {
                  position:fixed;   
                  top:0px;  
                  height:20px;
                  width:35%;
                  border:1px solid red;
               }
    </style>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation - WH-RO</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysqli_query($link,"select * from tbl_bin")or die(mysqli_error($link));
    	$noticia=mysqli_fetch_array($sql1);*/
	$trid=0;
	 ?> 
	  <tr >
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $code;?>" type="hidden">
	   <input name="txtmtype" value="" type="hidden">
	   <input type="hidden" name="rettyp" value="" />
	  <input type="hidden" name="oBags" value="" />
	  <input type="hidden" name="oqty" value="" />
	  <input type="hidden" name="txtdate" value="<?php echo date("d-m-Y");?>" />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<div id="maindiv">
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation - WH-RO</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
  
<tr class="Light" height="25">
<td width="152"  align="right"  valign="middle" class="tblheading">&nbsp;From Warehouse&nbsp;</td>
<td width="244" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtwhfrom" style="width:170px;" onchange="modetchk12(this.value);">
<option value="" selected>--WH--</option>
<option value="WH-RO">WH-RO</option>
<option value="Deorjhal">Deorjhal</option></select>&nbsp;<font color="#FF0000">*</font>	</td>
<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
<td width="108" align="right" valign="middle" class="tblheading">To Warehouse&nbsp;</td>
<td width="286" align="left" valign="middle" class="tbltext" id="whitem" >&nbsp;<input name="txtwhto" id="whitem" type="text" class="tbltext" value="" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font></td>
</tr>
  
<?php 
$classqry=mysqli_query($link,"select * from tblcrop order by cropname") or die(mysqli_error($link));
?>
<tr class="Light" height="25">
 <td width="152"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
 <td width="244" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>	</td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
<td width="108" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="286" align="left" valign="middle" class="tbltext" id="vitem" >&nbsp;
  <select class="tbltext" name="txtvariety" id="itm" style="width:170px;" onchange="modetchk1(this.value);" >
    <option value="" selected>--Select Variety--</option>
  </select>  &nbsp;<font color="#FF0000">*</font></td>
</tr><input type="hidden" name="itmdchk" value="" />
 <tr class="Light" height="25">
            <td height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlot1" id="smt" type="text" class="tbltext" value="" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
         </tr>	
</table>
<br />
<div id="subdiv">

<div id="subsubdiv">
<div id="bardiv"><input type="hidden" name="trid" value="<?php echo $trid;?>" />
</div>
</div>
</div>
</div>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="left" class="smalltblheading">Note: <font color="#FF0000">Only NoMP Qty will be shifted. No Pouches will be shifted.</font></td>
</tr>
</table>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_sloc4.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<img name="Submit" src="../images/submit.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
