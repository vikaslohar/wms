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
	
	$ycr=$yearid_id;
	$sql_arr=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	
	$sql_arrsub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$pid."'") or die(mysqli_error($link));
	$a_arrsub=mysqli_num_rows($sql_arrsub);
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$crop=$row_arr['pnpslipmain_crop'];
		$variety=$row_arr['pnpslipmain_variety'];
		$lotno=$row_arrsub['pnpslipsub_lotno'];
		$arrival_date=$row_arr['pnpslipmain_date'];
		$drefno=$row_arr['pnpslipmain_proslipno'];
		$lotstage=$row_arr['pnpslipmain_stage'];
		$protyp=$row_arr['pnpslipsub_packtype'];
		$packtype=$row_arrsub['pnpslipsub_ups'];
		$upsid=$row_arrsub['pnpslipsub_upsid'];
		$packnob=$row_arrsub['pnpslipsub_pnob'];
		$packqty=$row_arrsub['pnpslipsub_pqty'];
		$zzz=implode(",", str_split($row_arrsub['pnpslipsub_lotno']));
		$subtranid=$row_arrsub['pnpslipsub_id'];
		$dop=$row_arr['pnpslipmain_dop'];
		$valperiod=$row_arrsub['pnpslipsub_valperiod'];
		$valupto=$row_arrsub['pnpslipsub_valupto'];
		$packlabels=$row_arrsub['pnpslipsub_lblschar'].$row_arrsub['pnpslipsub_lblsno']."-".$row_arrsub['pnpslipsub_lbechar'].$row_arrsub['pnpslipsub_lbeno'];
		
		$packlotno=$row_arrsub['pnpslipsub_plotno'];
		
		$zzz=implode(",", str_split($row_arrsub['pnpslipsub_lotno']));
		$oldlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
		
		$zzz3=implode(",", str_split($row_arrsub['pnpslipsub_plotno']));
		$poldlot=$zzz3[0].$zzz3[2].$zzz3[4].$zzz3[6].$zzz3[8].$zzz3[10].$zzz3[12].$zzz3[14].$zzz3[16].$zzz3[18].$zzz3[20].$zzz3[22].$zzz3[24].$zzz3[26].$zzz3[28].$zzz3[30];
		
		//$orlot2=$oldlot;
		
		/*if($lotstage=="Raw")
		$lot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24]."C";
		else
		$lot=$lotno;*/
		
		$a="";
		$sql_barcode2=mysqli_query($link,"Select * from tbl_barcodestmp where plantcode='$plantcode' and bar_lotno='".$row_arrsub['pnpslipsub_plotno']."' and bar_psrn='".$drefno."'") or die(mysqli_error($link));
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
				
				$sql_barcode="Insert into tbl_barcodes (bar_trid, bar_trtype, bar_subtrid, bar_lotno, bar_orlot, bar_barcode, bar_grosswt, bar_wtdate, bar_wttime, bar_poprid, logid, yearid, bar_crop, bar_variety, bar_ups, bar_dop, bar_vdate, bar_netweight, plantcode, plantcode) values('$pid', 'PNPSLIP', '$subtranid', '$packlotno', '$poldlot', '$barcode', '$grosswt', '$dt', '$tim', '$poprid', '$logid', '$yearid_id', '$bar_crop', '$bar_variety', '$bar_ups', '$bar_dop', '$bar_vdate', '$bar_netweight', '$plantcode', '$plantcode')";
				//echo "<br/>";
				mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
			}
		}
		$cnnt=0;
		$otrid=0;
		$sql_arrsubsub=mysqli_query($link,"select * from tbl_pnpslipsubsub where plantcode='$plantcode' and pnpslipmain_id='".$pid."' and pnpslipsub_id='".$row_arrsub['pnpslipsub_id']."'") or die(mysqli_error($link));
		$a_sub=mysqli_num_rows($sql_arrsubsub);
		while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
		{
		
		$onob=$row_arrsubsub['pnpslipsubsub_onob'];
		$oqty=$row_arrsubsub['pnpslipsubsub_oqty'];
		$nob1=$row_arrsubsub['pnpslipsubsub_pnob'];
		$qty1=$row_arrsubsub['pnpslipsubsub_pqty'];
		$bnob=$row_arrsubsub['pnpslipsubsub_bnob'];
		$bqty=$row_arrsubsub['pnpslipsubsub_bqty'];
		$tot_isstblman=0;
		$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_arrsubsub['pnpslipsubsub_subbin']."' and lotldg_binid='".$row_arrsubsub['pnpslipsubsub_bin']."' and lotldg_whid='".$row_arrsubsub['pnpslipsubsub_wh']."' and lotldg_variety='".$variety."' and lotldg_lotno='".$lotno."' order by lotldg_balqty desc") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		$tot_isstblman=mysqli_num_rows($sql_issuetbl);
		/*if($tot_isstblman==0)
		{
			$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_variety='".$variety."' and lotldg_lotno='".$lotno."' and lotldg_balqty>0 order by lotldg_id desc") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty>0") or die(mysqli_error($link)); 
			$tot_isstblman=mysqli_num_rows($sql_issuetbl);
		}*/
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty>0") or die(mysqli_error($link)); 
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{
				$otrid=$row_issuetbl['lotldg_id'];
				
				$whid=$row_issuetbl['lotldg_whid'];
				$binid=$row_issuetbl['lotldg_binid'];
				$subbinid=$row_issuetbl['lotldg_subbinid'];
				$opups=$row_issuetbl['lotldg_balbags'];
				$opqty=$row_issuetbl['lotldg_balqty'];
				
				//if($protyp=="P")
				//{
				$balups=$opups-$nob1;
				$balqty=$opqty-$qty1;
				/*}
				else
				{
				$balups=0;
				$balqty=0;
				}*/
				if($balqty<=0){$balqty=0; $balups=0;}
				
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
				
				//if($balqty<=0){ $srtype=""; $srflg=0;}
				
				 $sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearcode','PNPSLIPSUO', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob1', '$qty1', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$srtype', '$srflg', '$plantcode')";
				//exit;
				if(mysqli_query($link,$sql_ins_main) or die(mysqli_error($link)))
				{
				$oldtid=mysqli_insert_id($link);
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
		
		$sql_arrsubsub2=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipmain_id='".$pid."' and pnpslipsub_id='".$row_arrsub['pnpslipsub_id']."'") or die(mysqli_error($link));
		$a_sub2=mysqli_num_rows($sql_arrsubsub2);
		if($a_sub2 > 0)
		{
		while($row_arrsubsub2=mysqli_fetch_array($sql_arrsubsub2))
		{
			$sstatus2=""; $moist2=""; $gemp2=""; $vchk2=""; $got12=""; $qc2=""; $gotstatus2=""; $qctestdate2=""; $gottestdate2=""; $orlot2=""; $gs2=""; $resverstatus2=""; $revcomment2="";
			$onob2=$row_arrsubsub2['pnpslipsubsub_onob'];
			$oqty2=$row_arrsubsub2['pnpslipsubsub_oqty'];
			$nob12=$row_arrsubsub2['pnpslipsubsub_pnob'];
			$qty12=$row_arrsubsub2['pnpslipsubsub_pqty'];
			$balups2=$row_arrsubsub2['pnpslipsubsub_bnob'];
			$balqty2=$row_arrsubsub2['pnpslipsubsub_bqty'];
			$whid2=$row_arrsubsub2['pnpslipsubsub_wh'];
			$binid2=$row_arrsubsub2['pnpslipsubsub_bin'];
			$subbinid2=$row_arrsubsub2['pnpslipsubsub_subbin'];
			$sstage2="Condition";
		
			/*$sql_issue122=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_arrsubsub2['pnpslipsubsub_subbin']."' and lotldg_binid='".$row_arrsubsub2['pnpslipsubsub_bin']."' and lotldg_whid='".$row_arrsubsub2['pnpslipsubsub_wh']."' and lotldg_variety='".$variety."' and lotldg_lotno='".$lotno."' order by lotldg_balqty desc") or die(mysqli_error($link));
			$row_issue122=mysqli_fetch_array($sql_issue122); 
			$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue122[0]."' and lotldg_balqty>0") or die(mysqli_error($link)); */
			
			$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$oldtid."'") or die(mysqli_error($link)); 
			while($row_issuetbl22=mysqli_fetch_array($sql_issuetbl22))
			{
				$sstatus2=$row_issuetbl22['lotldg_sstatus'];
				$moist2=$row_issuetbl22['lotldg_moisture'];
				$gemp2=$row_issuetbl22['lotldg_gemp'];
				$vchk2=$row_issuetbl22['lotldg_vchk'];
				$got12=$row_issuetbl22['lotldg_got1'];
				$qc2=$row_issuetbl22['lotldg_qc'];
				
				$gotstatus2=$row_issuetbl22['lotldg_got'];
				$qctestdate2=$row_issuetbl22['lotldg_qctestdate'];
				$gottestdate2=$row_issuetbl22['lotldg_gottestdate'];
				$orlot2=$poldlot;
				$gs2=$row_issuetbl22['lotldg_gs'];
				$resverstatus2=$row_issuetbl22['lotldg_resverstatus'];
				$revcomment2=$row_issuetbl22['lotldg_revcomment'];
				$geneticpurity2=$row_issuetbl22['lotldg_genpurity'];
				$yearcode2=$row_issuetbl22['yearcode'];
				$srtype2=$row_issuetbl22['lotldg_srtyp'];
				$srflg2=$row_issuetbl22['lotldg_srflg'];
			}		
				 if($srtype=="Condition" || $srtype=="condition"){ $srtype=""; $srflg=0;}
				  $sql_ins_main22="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearcode2','PNPSLIPSUC', '$pid', '$arrival_date', '$packlotno', '$crop', '$variety', '$whid2', '$binid2', '$subbinid2', '$onob2', '$oqty2', '$nob12', '$qty12', '$balups2', '$balqty2', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlot2', '$gs2', '$resverstatus2', '$revcomment2', '$geneticpurity2', '$srtype', '$srflg', '$plantcode')";
				//exit;
				mysqli_query($link,$sql_ins_main22) or die(mysqli_error($link));
				
				$sql_itmg22="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
				mysqli_query($link,$sql_itmg22) or die(mysqli_error($link));
				
				if($srflg>0)
				{
					if($protyp=="P")
					{
						$srdt=""; $type="";
						$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."'") or die(mysqli_error($link));
						$tot_srsub2=mysqli_num_rows($sql_srsub2);
						$row_srsub2=mysqli_fetch_array($sql_srsub2);
						$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."'") or die(mysqli_error($link));
						$tot_srsub=mysqli_num_rows($sql_srsub);
						while($row_srsub=mysqli_fetch_array($sql_srsub))
						{
							$type=$row_srsub['softrsub_srtyp'];	 
							$sql_srmain=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_srsub['softr_id']."'") or die(mysqli_error($link));
							$tot_srmain=mysqli_num_rows($sql_srmain);
							$row_srmain=mysqli_fetch_array($sql_srmain);	
							$srdt=$row_srmain['softr_date'];
							
							$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
							$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
							if(mysqli_num_rows($res_code) > 0)
							{
								$row_code=mysqli_fetch_row($res_code);
								$t_code=$row_code['0'];
								$code1=$t_code+1;
							}
							else
							{
								$code1=1;
							}
							$sql_code2="SELECT MAX(softr_code) FROM tbl_softr  where yearcode='$yearid_id'  ORDER BY softr_code DESC";
							$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
							if(mysqli_num_rows($res_code2) > 0)
							{
								$row_code2=mysqli_fetch_row($res_code2);
								$t_code=$row_code2['0'];
								$code=$t_code+1;
							}
							else
							{
								$code=1;
							}
						}	
						if($srdt=="")
						{
							$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub2 WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."'") or die(mysqli_error($link));
							$tot_srsub2=mysqli_num_rows($sql_srsub2);
							$row_srsub2=mysqli_fetch_array($sql_srsub2);
							$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."'") or die(mysqli_error($link));
							$tot_srsub=mysqli_num_rows($sql_srsub);
							while($row_srsub=mysqli_fetch_array($sql_srsub))
							{
								$type=$row_srsub['softrsub_srtyp'];	 
								$sql_srmain=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_srsub['softr_id']."'") or die(mysqli_error($link));
								$tot_srmain=mysqli_num_rows($sql_srmain);
								$row_srmain=mysqli_fetch_array($sql_srmain);	
								$srdt=$row_srmain['softr_date'];
								
								$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr2  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
								$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
								if(mysqli_num_rows($res_code) > 0)
								{
									$row_code=mysqli_fetch_row($res_code);
									$t_code=$row_code['0'];
									$code1=$t_code+1;
								}
								else
								{
									$code1=1;
								}
								$sql_code2="SELECT MAX(softr_code) FROM tbl_softr2  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY softr_code DESC";
								$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
								if(mysqli_num_rows($res_code2) > 0)
								{
									$row_code2=mysqli_fetch_row($res_code2);
									$t_code=$row_code2['0'];
									$code=$t_code+1;
								}
								else
								{
									$code=1;
								}
							}	
						}	
						$sql_srmain="Insert into tbl_softr (softr_tcode, softr_code, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode, softr_tflg, plantcode) values('$code1', '$code', '$srdt', '$crop', '$variety', 'sllot', '$whid2', '$binid2', '$subbinid2', '$yearid_id', '1', '$plantcode')";
						if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
						{
							$id=mysqli_insert_id($link);
							$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg, plantcode) values('$id', '$orlot2', '$type', '1', '$plantcode')";
							$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
						}	
					}
				}
				
				
				
				$dt=date("Y-m-d"); $leduration=''; $ledate=''; 
				
				$sqlisstbl2=mysqli_query($link,"select * from tbl_lemain where plantcode='$plantcode' and le_lotno='".$lotno."'") or die(mysqli_error($link)); 
				if($totisstbl2=mysqli_num_rows($sqlisstbl2)>0)
				{
					$rowisstbl2=mysqli_fetch_array($sqlisstbl2);
					$leduration=$rowisstbl2['le_duration'];
					$ledate=$rowisstbl2['le_upto'];
				}	
				$sqlisstbl=mysqli_query($link,"select * from tbl_lemain where plantcode='$plantcode' and le_lotno='".$packlotno."'") or die(mysqli_error($link)); 
				if($totisstbl=mysqli_num_rows($sqlisstbl)>0)
				{
					$rowisstbl=mysqli_fetch_array($sqlisstbl);
					//$sqlsubsub1="UPDATE tbl_lemain SET le_duration='$leduration', le_upto='$ledate'  where le_lotno='$packlotno' and le_stage='$sstage2'";
					//mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
				}
				else
				{
					$sqlsubsub1="insert into tbl_lemain (le_lotno, le_stage, le_duration, le_upto, plantcode) values( '$packlotno' ,'$txtstage', '$leduration','$ledate', '$plantcode')";
					mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
				
				
					$sqlsubsub13="insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid, plantcode) values( '$packlotno' ,'$sstage2', '$leduration','$ledate', '$dt', 'Packing Slip', '$logid' , '$plantcode')";
					mysqli_query($link,$sqlsubsub13) or die(mysqli_error($link));
				}
				
				
				$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where plantcode='$plantcode' and oldlot='".$orlot."'") or die(mysqli_error($link));
				$row_qc1=mysqli_fetch_array($sql_qc1);
				$yrco="";	
				/*if($protyp=="P")
				{
					$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearid_id."' ORDER BY tid DESC";
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
					$arrivaldate=$arrival_date;
					$yrco=$yearid_id;
				}
				else
				{*/
					$sql_qc2=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_qc1[0]."'") or die(mysqli_error($link));
					$row_qc2=mysqli_fetch_array($sql_qc2);
					$ncode1=$row_qc2['sampleno'];
					$arrivaldate=$row_qc2['srdate'];
					$yrco=$row_qc2['yearid'];
				//}		
					$sql_qc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_qc1[0]."'") or die(mysqli_error($link));
					$row_qc=mysqli_fetch_array($sql_qc);
					$ncode2=$row_qc['sampleno'];
					
					$sql_got1=mysqli_query($link,"Select Max(gottest_tid) from tbl_gottest  where plantcode='$plantcode' and gottest_oldlot='".$orlot."'") or die(mysqli_error($link));
					$row_got1=mysqli_fetch_array($sql_got1);
					$sql_got=mysqli_query($link,"Select * from tbl_gottest where plantcode='$plantcode' and gottest_tid='".$row_got1[0]."'") or die(mysqli_error($link));
					$row_got=mysqli_fetch_array($sql_got);
					
					if($yrco=="")$yrco=$ycr;
						
					$got="";$got1="";
					if($got12=="GOT-R UT")
					{
						$got1="UT";	
					}
					else if($got12=="GOT-NR UT")
					{
						$got1="UT";
					}
					else if($got12=="GOT-R UT")
					{
						$got1="UT";
					}
					else if($got12=="GOT-NR UT")
					{
						$got1="UT";
					}	
					else
					{
						$got1="";
					}
						//$got1="UT";
				
					if($got1=="UT")
					{
						$got="T";
					}
					/*$state="P/M/G";	
					$state2="P/M/G/".$got;
					$state3="P/M/G/T";		
					if($row_arrsub['qc']=="UT")
					{*/
					
					if($qc=="UT")
					{
						$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$packlotno."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$sstage2','".$row_qc['sampno']."', '$plantcode')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
										
					if($got12=="UT")
					{
						$sql_sub_sub123="insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_srdate, gottest_gotstatus, gottest_sampleno, gottest_aflg, gottest_bflg, gottest_cflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, genpurity, gottest_lotno, gottest_oldlot, yearid, logid, gottest_trstage, gottest_sampno, plantcode) values('".$row_got['gottest_spdate']."','".$row_got['gottest_gotdate']."','".$row_got['gottest_dosdate']."','".$row_got['gottest_got']."','".$row_got['gottest_variety']."','".$row_got['gottest_crop']."','".$row_got['gottest_srdate']."','".$row_got['gottest_gotstatus']."','".$row_got['gottest_sampleno']."','".$row_got['gottest_aflg']."','".$row_got['gottest_bflg']."','".$row_got['gottest_cflg']."','".$row_got['gottest_gotflg']."','".$row_got['gottest_gotrefno']."','".$row_got['gottest_gotauth']."','".$row_got['gottest_gotsampdflg']."','".$row_got['genpurity']."','".$packlotno."','".$orlot2."','$yrco','$logid', '$sstage2','".$row_got['gottest_sampno']."', '$plantcode')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
				
					/*if(($qc2=="UT" || $got1=="UT")||($qc2=="RT" || $got1=="RT"))
					{
						$sql_sub_sub12="insert into tbl_qctest(spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity, lotno, oldlot, yearid, logid, state, trstage) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['gotdate']."','".$row_qc['dosdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['got']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['gotstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gotflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['gotrefno']."','".$row_qc['gotauth']."','".$row_qc['doswdate']."','".$row_qc['gotsmpdflg']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$row_qc['genpurity']."','".$packlotno."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$sstage2')";
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
					}*/
					/*else if($qc2=="UT" && $got1!="UT")
					{
						$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, bflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$arrivaldate."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot2', '".$row_qc['spdate']."',1,'$yrco','$logid')";
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
					}
					if($got1=="UT" && $qc2!="UT")
					{
						$sql_sub_sub13="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, qcstatus,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode2', '$sstage2', '$qc2', '$state2',1,'$orlot2', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1, '$qc2',0,'$yrco','$logid')";
						mysqli_query($link,$sql_sub_sub13) or die(mysqli_error($link));
					}*/	
					//else
					//{
						//$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, gotdate, gotflg, qcstatus,gotsmpdflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot2', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1,'".$row_qc['gotdate']."',1, '$qc2',1, '$got1','$yrco','$logid')";
					//}	
							//mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));	
				//}
		}
		}
		
		$orlot3=$poldlot;
		
		
		/*$sstatus3=""; $moist3=""; $gemp3=""; $vchk3=""; $got13=""; $qc3=""; $gotstatus3=""; $qctestdate3=""; $gottestdate3=""; $orlot3=""; $gs3=""; $resverstatus3=""; $revcomment3="";
		
			$sql_issuetbl23=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$oldtid."'") or die(mysqli_error($link)); 
			while($row_issuetbl23=mysqli_fetch_array($sql_issuetbl23))
			{
				$sstatus3=$row_issuetbl23['lotldg_sstatus'];
				$moist3=$row_issuetbl23['lotldg_moisture'];
				$gemp3=$row_issuetbl23['lotldg_gemp'];
				$vchk3=$row_issuetbl23['lotldg_vchk'];
				$got13=$row_issuetbl23['lotldg_got1'];
				$qc3=$row_issuetbl23['lotldg_qc'];
				
				$gotstatus3=$row_issuetbl23['lotldg_got'];
				$qctestdate3=$row_issuetbl23['lotldg_qctestdate'];
				$gottestdate3=$row_issuetbl23['lotldg_gottestdate'];
				$orlot3=$row_issuetbl23['orlot'];
				$gs3=$row_issuetbl23['lotldg_gs'];
				$resverstatus3=$row_issuetbl23['lotldg_resverstatus'];
				$revcomment3=$row_issuetbl23['lotldg_revcomment'];
			}	
			
			
				$sql_ins_main23="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment) values('$yearid_id','PNPSLIP', '$pid', '$arrival_date', '$lot2', '$crop', '$variety', '$whid3', '$binid3', '$subbinid3', '0', '0', '$packnob', '$packqty', '$packnob', '$packqty', 'Pack', '$sstatus3', '$moist3', '$gemp3', '$vchk3', '$got13', '$qc3', '$gotstatus3', '$qctestdate3', '$gottestdate3', '$orlot3', '$gs3', '$resverstatus3', '$revcomment3')";
				//exit;
				if(mysqli_query($link,$sql_ins_main23) or die(mysqli_error($link)))
				{
					$newtid=mysqli_insert_id($link);
				}*/
				
				/*$sql_itmg23="update tbl_subbin set status='$sstage3' where sid='$subbinid3'";
				mysqli_query($link,$sql_itmg23) or die(mysqli_error($link));*/
		
		
		$sql_arrsubsub3=mysqli_query($link,"select * from tbl_pnpslipsubsub3 where plantcode='$plantcode' and pnpslipmain_id='".$pid."' and pnpslipsub_id='".$row_arrsub['pnpslipsub_id']."'") or die(mysqli_error($link));
		$a_sub3=mysqli_num_rows($sql_arrsubsub3);
		if($a_sub3 > 0)
		{
		while($row_arrsubsub3=mysqli_fetch_array($sql_arrsubsub3))
		{
		
			$onop3=$row_arrsubsub3['pnpslipsubsub_onop'];
			$onomp3=$row_arrsubsub3['pnpslipsubsub_onomp'];
			$oqty3=$row_arrsubsub3['pnpslipsubsub_oqty'];
			$nop13=$row_arrsubsub3['pnpslipsubsub_totpouches'];
			$nomp3=$row_arrsubsub3['pnpslipsubsub_nomp'];
			$qty13=$row_arrsubsub3['pnpslipsubsub_totqty'];
			$balnop3=$row_arrsubsub3['pnpslipsubsub_bnop'];
			$balnomp3=$row_arrsubsub3['pnpslipsubsub_bnomp'];
			$balqty3=$row_arrsubsub3['pnpslipsubsub_bqty'];
			$whid3=$row_arrsubsub3['pnpslipsubsub_wh'];
			$binid3=$row_arrsubsub3['pnpslipsubsub_bin'];
			$subbinid3=$row_arrsubsub3['pnpslipsubsub_subbin'];
			$sstage3="Pack";
			
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
			$sno=1; $srnonew=0;
			//echo $rowvariety['varietyid'];
			$p1_array=explode(",",$rowvariety['gm']);
			$p1_array2=explode(",",$rowvariety['wtmp']);
			$p1_array3=explode(",",$rowvariety['mptnop']);
			$p1=array();
			foreach($p1_array as $val1)
			{
			if($val1<>"" && $val1==$upsid)
			{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			
			$wtmp=$p1_array2[$srnonew];
			$nopinmp=$p1_array3[$srnonew];
			
			}$srnonew++;
			}
			$nobcd="";
			$b_arr=explode(",",$a);
			foreach($b_arr as $bval1)
			{
				if($bval1<>"")
				{
					$sql_barcode24="update tbl_barcodes set bar_wtmp='$wtmp', bar_orlot='$orlot3' where bar_trid='$pid' and bar_subtrid='$subtranid' and bar_lotno='$packlotno' and bar_barcode='$bval1'";
					mysqli_query($link,$sql_barcode24) or die(mysqli_error($link));
					
					$sql_tbl_barsub=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btslsub_barcode='".$bval1."'") or die(mysqli_error($link));
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
					if($balqty3>0)
					{
						$sql_ins_main24="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_lotnop, plantcode) values('$arrival_date', '$pid', 'PACKSMC', '$crop', '$variety', '$packlotno', '$packtype', '$bval1', '$wtmp', '$nopinmp', '0', '0', '$balnop3', '$balqty3', '$balnop3', '$balqty3', '$whid3', '$binid3', '$subbinid3', '$yearcode', '$logid', '$nopinmp', '$plantcode')";
						mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));
					}
				}
			}
			if($srtype=="pack" || $srtype=="Pack")
			{$srtype=""; $srflg=0;}
			if($qty13>0)
			{
				$sql_ins_main231="insert into tbl_lot_ldg_pack (lotldg_id,trtype, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid, subbinid, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, lotldg_sstage , lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, yearcode, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_crop, lotldg_variety, lotldg_srtyp, lotldg_srflg, plantcode) values('$pid','PNPSLIP', '$sstage3', '$packtype', '$packlotno', '$packlabels', '$a', '$wtmp', '$onop3', '$onomp3', '$oqty3', '$whid3', '$binid3', '$subbinid3', '$nop13', '$nomp3', '$qty13', '$balnop3', '$balnomp3', '$balqty3', '$arrival_date', '$sstage3', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot3', '$resverstatus', '$revcomment', '$yearcode', '$dop', '$valperiod', '$valupto', '$crop', '$variety', '$srtype', '$srflg', '$plantcode')";
					//exit;
				mysqli_query($link,$sql_ins_main231) or die(mysqli_error($link));
				
					
				$sql_itmg231="update tbl_subbin set status='$sstage3' where sid='$subbinid3'";
				mysqli_query($link,$sql_itmg231) or die(mysqli_error($link));
			}
			if($srflg>0)
			{
				//if($row_arrsub['pnpslipsub_packtype']=="P")
				{
					$srdt=""; $type="";
					$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."'") or die(mysqli_error($link));
					$tot_srsub2=mysqli_num_rows($sql_srsub2);
					$row_srsub2=mysqli_fetch_array($sql_srsub2);
					$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."'") or die(mysqli_error($link));
					$tot_srsub=mysqli_num_rows($sql_srsub);
					while($row_srsub=mysqli_fetch_array($sql_srsub))
					{
						$type=$row_srsub['softrsub_srtyp'];	 
						$sql_srmain=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_srsub['softr_id']."'") or die(mysqli_error($link));
						$tot_srmain=mysqli_num_rows($sql_srmain);
						$row_srmain=mysqli_fetch_array($sql_srmain);	
						$srdt=$row_srmain['softr_date'];
						
						$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
						$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
						if(mysqli_num_rows($res_code) > 0)
						{
							$row_code=mysqli_fetch_row($res_code);
							$t_code=$row_code['0'];
							$code1=$t_code+1;
						}
						else
						{
							$code1=1;
						}
						$sql_code2="SELECT MAX(softr_code) FROM tbl_softr  where yearcode='$yearid_id'  ORDER BY softr_code DESC";
						$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
						if(mysqli_num_rows($res_code2) > 0)
						{
							$row_code2=mysqli_fetch_row($res_code2);
							$t_code=$row_code2['0'];
							$code=$t_code+1;
						}
						else
						{
							$code=1;
						}
					}	
					if($srdt=="")
					{
						$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub2 WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."'") or die(mysqli_error($link));
						$tot_srsub2=mysqli_num_rows($sql_srsub2);
						$row_srsub2=mysqli_fetch_array($sql_srsub2);
						$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."'") or die(mysqli_error($link));
						$tot_srsub=mysqli_num_rows($sql_srsub);
						while($row_srsub=mysqli_fetch_array($sql_srsub))
						{
							$type=$row_srsub['softrsub_srtyp'];	 
							$sql_srmain=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_srsub['softr_id']."'") or die(mysqli_error($link));
							$tot_srmain=mysqli_num_rows($sql_srmain);
							$row_srmain=mysqli_fetch_array($sql_srmain);	
							$srdt=$row_srmain['softr_date'];
							
							$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr2  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
							$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
							if(mysqli_num_rows($res_code) > 0)
							{
								$row_code=mysqli_fetch_row($res_code);
								$t_code=$row_code['0'];
								$code1=$t_code+1;
							}
							else
							{
								$code1=1;
							}
							$sql_code2="SELECT MAX(softr_code) FROM tbl_softr2  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY softr_code DESC";
							$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
							if(mysqli_num_rows($res_code2) > 0)
							{
								$row_code2=mysqli_fetch_row($res_code2);
								$t_code=$row_code2['0'];
								$code=$t_code+1;
							}
							else
							{
								$code=1;
							}
						}	
					}	
					$sql_srmain="Insert into tbl_softr (softr_tcode, softr_code, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode, softr_tflg, plantcode) values('$code1', '$code', '$srdt', '$crop', '$variety', 'sllot', '$whid3', '$binid3', '$subbinid3', '$yearid_id', '1', '$plantcode')";
					if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
					{
						$id=mysqli_insert_id($link);
						$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg, plantcode) values('$id', '$orlot3', '$type', '1', '$plantcode')";
						$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
					}	
				}
			}
			
			$zxcd1=explode(",", $nobcd);
			$zxcd=array_unique($zxcd1);
			foreach($zxcd as $bstlval)
			{
				if($bstlval<>"")
				{
					$sqlbstls=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='".$bstlval."'") or die(mysqli_error($link));
					if($totbstls=mysqli_num_rows($sqlbstls)==0)
					{
						$sqlbstlm="delete from tbl_btslmain where btsl_id='".$bstlval."'";
						mysqli_query($link,$sqlbstlm) or die(mysqli_error($link));
					}
				}
			}
							
				$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where plantcode='$plantcode' and oldlot='".$orlot."'") or die(mysqli_error($link));
				$row_qc1=mysqli_fetch_array($sql_qc1);
					
				/*if($row_arrsub['pnpslipsub_packtype']=="P")
				{
					$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearid_id."' ORDER BY tid DESC";
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
					$arrivaldate=$arrival_date;
				}
				else
				{*/
					$sql_qc2=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_qc1[0]."'") or die(mysqli_error($link));
					$row_qc2=mysqli_fetch_array($sql_qc2);
					$ncode1=$row_qc2['sampleno'];
					$arrivaldate=$row_qc2['srdate'];
					$yrco=$row_qc2['yearid'];	
				//}
					$sql_qc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_qc1[0]."'") or die(mysqli_error($link));
					$row_qc=mysqli_fetch_array($sql_qc);
					$ncode2=$row_qc['sampleno'];
					
					$sql_got1=mysqli_query($link,"Select Max(gottest_tid) from tbl_gottest  where plantcode='$plantcode' and gottest_oldlot='".$orlot."'") or die(mysqli_error($link));
					$row_got1=mysqli_fetch_array($sql_got1);
					$sql_got=mysqli_query($link,"Select * from tbl_gottest where plantcode='$plantcode' and gottest_tid='".$row_got1[0]."'") or die(mysqli_error($link));
					$row_got=mysqli_fetch_array($sql_got);
					
					if($yrco=="")$yrco=$ycr;
						
					$got="";$got1="";
					if($got12=="GOT-R UT")
					{
						$got1="UT";	
					}
					else if($got12=="GOT-NR UT")
					{
						$got1="UT";
					}
					else if($got12=="GOT-R UT")
					{
						$got1="UT";
					}
					else if($got12=="GOT-NR UT")
					{
						$got1="UT";
					}	
					else
					{
						$got1="";
					}
						//$got1="UT";
				
					if($got1=="UT")
					{
						$got="T";
					}
					/*$state="P/M/G";	
					$state2="P/M/G".$got;
					$state3="P/M/G/T";		
					if($row_arrsub['qc']=="UT")
					{*/
					
					if($qc=="UT")
					{
						$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$packlotno."','".$orlot3."','$yrco','$logid', '".$row_qc['state']."', '$sstage2','".$row_qc['sampno']."', '$plantcode')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
										
					if($got12=="UT")
					{
						$sql_sub_sub123="insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_srdate, gottest_gotstatus, gottest_sampleno, gottest_aflg, gottest_bflg, gottest_cflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, genpurity, gottest_lotno, gottest_oldlot, yearid, logid, gottest_trstage, gottest_sampno, plantcode) values('".$row_got['gottest_spdate']."','".$row_got['gottest_gotdate']."','".$row_got['gottest_dosdate']."','".$row_got['gottest_got']."','".$row_got['gottest_variety']."','".$row_got['gottest_crop']."','".$row_got['gottest_srdate']."','".$row_got['gottest_gotstatus']."','".$row_got['gottest_sampleno']."','".$row_got['gottest_aflg']."','".$row_got['gottest_bflg']."','".$row_got['gottest_cflg']."','".$row_got['gottest_gotflg']."','".$row_got['gottest_gotrefno']."','".$row_got['gottest_gotauth']."','".$row_got['gottest_gotsampdflg']."','".$row_got['genpurity']."','".$packlotno."','".$orlot3."','$yrco','$logid', '$sstage2','".$row_got['gottest_sampno']."', '$plantcode')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
					
					/*if(($qc=="UT" || $got1=="UT")||($qc=="RT" || $got1=="RT"))
					{
						$sql_sub_sub12="insert into tbl_qctest(spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity, lotno, oldlot, yearid, logid, state, trstage) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['gotdate']."','".$row_qc['dosdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['got']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['gotstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gotflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['gotrefno']."','".$row_qc['gotauth']."','".$row_qc['doswdate']."','".$row_qc['gotsmpdflg']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$row_qc['genpurity']."','".$packlotno."','".$orlot3."','$yrco','$logid', '".$row_qc['state']."', '$sstage3')";
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
					}*/
					/*else if($qc=="UT" && $got1!="UT")
					{
						$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, bflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$arrivaldate."', '$crop', '$variety', '$ncode1', '$sstage3', '$qc', '$state',1,'$orlot3', '".$row_qc['spdate']."',1,'$yrco','$logid')";
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
					}
					if($got1=="UT" && $qc!="UT")
					{
						$sql_sub_sub13="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, qcstatus,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode2', '$sstage3', '$qc', '$state2',1,'$orlot3', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1, '$qc2',1,'$yrco','$logid')";
						mysqli_query($link,$sql_sub_sub13) or die(mysqli_error($link));
					}*/	
					//else
					//{
						//$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, gotdate, gotflg, qcstatus,gotsmpdflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot2', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1,'".$row_qc['gotdate']."',1, '$qc2',1, '$got1','$yrco','$logid')";
					//}	
							//mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));	
				//}
				
				/*if($row_arrsub['pnpslipsub_packtype']=="P")
				{
					$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearid_id."' ORDER BY tid DESC";
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
						
						$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where lotno='".$lotno."'") or die(mysqli_error($link));
						$row_qc1=mysqli_fetch_array($sql_qc1);
						
						$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1['tid']."'") or die(mysqli_error($link));
						$row_qc=mysqli_fetch_array($sql_qc);
						
						$got="";$got1="";
						if($got12=="GOT-R UT")
						{
						$got1="UT";	
						}
						else if($got12=="GOT-NR UT")
						{
						$got1="UT";
						}
						else if($got12=="GOT-R UT")
						{
						$got1="UT";
						}
						else if($got12=="GOT-NR UT")
						{
						$got1="UT";
						}	
						else
						{
						$got1="";
						}
						//$got1="UT";
				
						if($got1=="UT")
						{
						$got="T";
						}
						$state="P/M/G"."/".$got;	
						/*if($row_arrsub['qc']=="UT")
						{
							if($qc2=="UT" && $got1!="UT")
							{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, gotdate, gotflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot3', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['gotdate']."',1, '$got1','$yearid_id','$logid')";
							}
							else if($qc2!="UT" && $got1=="UT")
							{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, qcstatus,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot3', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1, '$qc2',1,'$yearid_id','$logid')";
							}	
							else if($qc2=="UT" || $got1=="UT")
							{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot3', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,1,'$yearid_id','$logid')";
							}	
							else
							{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, gotdate, gotflg, qcstatus,gotsmpdflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$packlotno', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot3', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1,'".$row_qc['gotdate']."',1, '$qc2',1, '$got1','$yearid_id','$logid')";
							}	
							mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));	
				}*/
				
		}
	}	
		
	}
	}
		$sql_code1="SELECT MAX(pnpslipmain_tcode) FROM tbl_pnpslipmain where pnpslipmain_ttype='Packing Slip MU' ORDER BY pnpslipmain_tcode DESC";
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
	
	 $sql_main="update tbl_pnpslipmain set pnpslipmain_tflag=1, pnpslipmain_tcode=$ncode1  where pnpslipmain_id ='$pid'";
	 $a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	 //exit;
	echo "<script>window.location='home_packslip.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Packing Slip- Preview</title>
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
		winHandle=window.open('packslip_mu_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Packing slip - Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
   <?php
   $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

	$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['pnpslipmain_dop'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
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
  <td colspan="8" align="center" class="tblheading">Packing Slip Preview</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packing&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="157" align="right"  valign="middle" class="smalltblheading">Packing Slip Ref. No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="152" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="166" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="107" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' and promac_id='".$row_tbl['pnpslipmain_promachcode']."' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_id='".$row_tbl['pnpslipmain_proopr']."'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
	</tr>

</table><br />

<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="1%"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">E/P</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Qty for Packing</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">CC</td>
	<td width="9%" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="11%" colspan="1" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
	<td width="10%" align="center" valign="middle" class="smalltblheading">Pack Details</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Remarks</td>
	</tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pnpslipsubsub2 where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['pnpslipsubsub_subbin']."' and binid='".$row_tbl_subsub['pnpslipsubsub_bin']."' and whid='".$row_tbl_subsub['pnpslipsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['pnpslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['pnpslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['pnpslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_onob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_oqty'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packtype'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pickpqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packloss'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packcc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_ups'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nop'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
	</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_onob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_oqty'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packtype'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_pickpqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packloss'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packcc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_ups'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nop'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_remarks'];?>">Details</a><?php } ?></td>
	</tr>
  <?php
}
$srno++;
}
}
?>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_packslip_slip_mu.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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