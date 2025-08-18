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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$pid=trim($_POST['txtitem']);
			
		$sql_arr=mysqli_query($link,"select * from tbl_psunpp2c where plantcode='$plantcode' and unp_id='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$trdate=$row_arr['unp_date'];
			$ltn=$row_arr['unp_lotno'];
			$classid=$row_arr['unp_crop'];
			$itemid=$row_arr['unp_variety'];
			$trdate=$row_arr['unp_date'];
			$lotno=$row_arr['unp_lotno'];
			$protyp=$row_arr['unp_p2ctype'];
			
			$sql_sloc_sub22=mysqli_query($link,"select * from tbl_psunpp2c_sub where plantcode='$plantcode' and unp_id='".$pid."'") or die(mysqli_error($link));
			while($row_sloc_sub22=mysqli_fetch_array($sql_sloc_sub22))
			{
				$whid1=$row_sloc_sub22['unp_wh'];
				$binid1=$row_sloc_sub22['unp_bin'];
				$subbinid1=$row_sloc_sub22['unp_sbin'];
				$nop1=$row_sloc_sub22['unp_nop'];
				$ups1=0;
				$qty1=$row_sloc_sub22['unp_qty'];
					
				$sql_issue122=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid1."' and binid='".$binid1."' and whid='".$whid1."' and lotldg_variety='".$itemid."' and lotno='".$lotno."'") or die(mysqli_error($link));
				$t12322=mysqli_num_rows($sql_issue122);
				$row_issue122=mysqli_fetch_array($sql_issue122); 
	
				$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue122[0]."'and balqty>0") or die(mysqli_error($link)); 
				$tttttt22=mysqli_num_rows($sql_issuetbl22);
				if($tttttt22 == 0)
				{
					$sql_issue122=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_variety='".$itemid."' and lotno='".$lotno."'") or die(mysqli_error($link));
					$t12322=mysqli_num_rows($sql_issue122);
					$row_issue122=mysqli_fetch_array($sql_issue122); 
					
					$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."'and balqty>0") or die(mysqli_error($link)); 
					
					$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
				}
				else
				{
					$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
				}
				
				$opnop1=$row_issuetbl22['balnop'];
				$opups1=$row_issuetbl22['balnomp'];
				$opqty1=$row_issuetbl22['balqty'];
				$opnop1=$balnop1+$opnop1;
				//$opups1=$balups1+$opups1;
				//$opqty1=$balqty1+$opqty1;
				$balnop1=$opnop1-$nop1;
				$balups1=$opups1-$ups1;
				$balqty1=$opqty1-$qty1;
					
				$sstage1=$row_issuetbl22['lotldg_sstage'];
				$sstatus1=$row_issuetbl22['lotldg_sstatus'];
				$moist1=$row_issuetbl22['lotldg_moisture'];
				$gemp1=$row_issuetbl22['lotldg_gemp'];
				$vchk1=$row_issuetbl22['lotldg_vchk'];
				$got11=$row_issuetbl22['lotldg_got1'];
				$qc1=$row_issuetbl22['lotldg_qc'];
					
				$gotstatus1=$row_issuetbl22['lotldg_got'];
				$qctestdate1=$row_issuetbl22['lotldg_qctestdate'];
				$gottestdate1=$row_issuetbl22['lotldg_gottestdate'];
				$orlot1=$row_issuetbl22['orlot'];
				$resverstatus1=$row_issuetbl22['lotldg_resverstatus'];
				$revcomment1=$row_issuetbl22['lotldg_revcomment'];
				
				$yrcode1=$row_issuetbl22['yearcode'];
				$pcktyp1=$row_issuetbl22['packtype'];
				$packlabels1=$row_issuetbl22['packlabels'];
				$barcodes1=$row_issuetbl22['barcodes'];
				$wtinmp1=$row_issuetbl22['wtinmp'];
				$lotldg_dop1=$row_issuetbl22['lotldg_dop'];
				$lotldg_valperiod1=$row_issuetbl22['lotldg_valperiod'];
				$lotldg_valupto1=$row_issuetbl22['lotldg_valupto'];
				$lotldg_srtyp1=$row_issuetbl22['lotldg_srtyp'];
				$lotldg_srflg1=$row_issuetbl22['lotldg_srflg'];
				$geneticpurity1=$row_issuetbl['lotldg_genpurity'];
				
				if($sstage1=="") $sstage1="Pack";
					
				$sql_ins_sub11="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, plantcode) values('$yrcode1','P2C', '$sstage1', '$pid', '$trdate', '$lotno', '$pcktyp1', '$packlabels1', '$barcodes1', '$wtinmp1', '$classid', '$itemid', '$whid1', '$binid1', '$subbinid1', '$opnop1', '$opups1', '$opqty1', '$nop1', '$ups1', '$qty1', '$balnop1', '$balups1', '$balqty1', '$sstage1', '$sstatus1', '$moist1', '$gemp1', '$vchk1', '$got11', '$qc1', '$gotstatus1', '$qctestdate1', '$gottestdate1', '$orlot1', '$resverstatus1', '$revcomment1', '$lotldg_dop1', '$lotldg_valperiod1', '$lotldg_valupto1', '$lotldg_srtyp1', '$lotldg_srflg1', '$geneticpurity1', '$plantcode')";
				mysqli_query($link,$sql_ins_sub11) or die(mysqli_error($link));
					
				$sql_itmg="update tbl_subbin set status='$sstage1' where sid='$subbinid1'";
				mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
			}
			
			
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_psunpp2c_sub2 where plantcode='$plantcode' and unp_id='".$pid."'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$crop=$row_arr['unp_crop'];
				$variety=$row_arr['unp_variety'];
				$ststus="Condition";
				//$oldlotno=$row_arr['unp_newlotno'];
				$stage="Condition";
				$zzz=implode(",", str_split($row_arr['unp_newlotno']));
				$gln=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
				$lotno=$row_arr['unp_newlotno'];
				
				$whid=$row_arrsub['unp_wh'];
				$binid=$row_arrsub['unp_bin'];
				$subbinid=$row_arrsub['unp_sbin'];
				$ups=$row_arrsub['unp_nop'];
				$qty=$row_arrsub['unp_qty'];
					
				$opups=0;
				$opqty=0;
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				
				$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty,  lotldg_balbags,  lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, orlot, lotldg_qctestdate, lotldg_got1, lotldg_gottestdate, lotldg_got, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id', '$lotno', 'P2C', '$pid', '$trdate', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty' ,'$stage', '$moist1', '$gemp1', '$vchk1', '$qc1', '$gln', '$qctestdate1', '$got11', '$gottestdate1', '$gotstatus1', '$geneticpurity1', '$lotldg_srtyp1', '$lotldg_srflg1', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
				$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
				mysqli_query($link,$sql_itm) or die(mysqli_error($link));
			}
			
			
			$orlot2=$gln;
			
			if($lotldg_srflg1>0)
			{
				$srdt=""; $type="";
				$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot1."'") or die(mysqli_error($link));
				$tot_srsub2=mysqli_num_rows($sql_srsub2);
				$row_srsub2=mysqli_fetch_array($sql_srsub2);
				$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot1."' and softrsub_id='".$row_srsub2[0]."'") or die(mysqli_error($link));
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
					$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub2 WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot1."'") or die(mysqli_error($link));
					$tot_srsub2=mysqli_num_rows($sql_srsub2);
					$row_srsub2=mysqli_fetch_array($sql_srsub2);
					$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 WHERE plantcode='$plantcode' and softrsub_lotno='".$orlot1."' and softrsub_id='".$row_srsub2[0]."'") or die(mysqli_error($link));
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
				$sql_srmain="Insert into tbl_softr (softr_tcode, softr_code, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode, softr_tflg, plantcode) values('$code1', '$code', '$srdt', '$crop', '$variety', 'sllot', '$whid', '$binid', '$subbinid', '$yearid_id', '1', '$plantcode')";
				if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
				{
					$id=mysqli_insert_id($link);
					$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg, plantcode) values('$id', '$orlot2', '$type', '1', '$plantcode')";
					$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
				}	
			}
			
			
			$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where plantcode='$plantcode' and oldlot='".$orlot1."'") or die(mysqli_error($link));
			$row_qc1=mysqli_fetch_array($sql_qc1);
			$tot_qc1=mysqli_num_rows($sql_qc1);
			
			$yrco="";	
			if($tot_qc1==0)
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
			{
				$sql_qc2=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_qc1[0]."'") or die(mysqli_error($link));
				$row_qc2=mysqli_fetch_array($sql_qc2);
				$ncode1=$row_qc2['sampleno'];
				$arrivaldate=$row_qc2['srdate'];
				$yrco=$row_qc2['yearid'];
			}	
			
			$sql_qc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and tid='".$row_qc1[0]."'") or die(mysqli_error($link));
			$row_qc=mysqli_fetch_array($sql_qc);
			$tot_qc=mysqli_num_rows($sql_qc);
			$ncode2=$row_qc['sampleno'];
						
			if($yrco=="")$yrco=$yearid_id;
			
			$sql_got1=mysqli_query($link,"Select Max(gottest_tid) from tbl_gottest  where plantcode='$plantcode' and gottest_oldlot='".$orlot1."'") or die(mysqli_error($link));
			$row_got1=mysqli_fetch_array($sql_got1);
			$sql_got=mysqli_query($link,"Select * from tbl_gottest where plantcode='$plantcode' and gottest_tid='".$row_got1[0]."'") or die(mysqli_error($link));
			$row_got=mysqli_fetch_array($sql_got);
						
			$got="";
			if($gotstatus1=="UT")
			{
				$got="T";
			}
			$qc2=$qc1;
			
			$state="P/M/G";	
			$state2="P/M/G/T";
			$state3="T";		
			/*if($row_arrsub['qc']=="UT")
			{*/
			//if($protyp=="partial")
			{
				
				
				if($qc2=="UT")
				{
					$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$packlotno."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$stage','".$row_qc['sampno']."', '$plantcode')";
					mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
				}
										
				if($got1=="UT")
				{
					$sql_sub_sub123="insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_srdate, gottest_gotstatus, gottest_sampleno, gottest_aflg, gottest_bflg, gottest_cflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, genpurity, gottest_lotno, gottest_oldlot, yearid, logid, gottest_trstage, gottest_sampno, plantcode) values('".$row_got['gottest_spdate']."','".$row_got['gottest_gotdate']."','".$row_got['gottest_dosdate']."','".$row_got['gottest_got']."','".$row_got['gottest_variety']."','".$row_got['gottest_crop']."','".$row_got['gottest_srdate']."','".$row_got['gottest_gotstatus']."','".$row_got['gottest_sampleno']."','".$row_got['gottest_aflg']."','".$row_got['gottest_bflg']."','".$row_got['gottest_cflg']."','".$row_got['gottest_gotflg']."','".$row_got['gottest_gotrefno']."','".$row_got['gottest_gotauth']."','".$row_got['gottest_gotsampdflg']."','".$row_got['genpurity']."','".$packlotno."','".$orlot2."','$yrco','$logid', '$stage','".$row_got['gottest_sampno']."', '$plantcode')";
					mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
				}
					
				
				/*if($qc2=="UT" || $gotstatus1=="UT")
				{
					if($tot_qc>0)
					{	
						$sql_sub_sub12="insert into tbl_qctest(spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity, lotno, oldlot, yearid, logid, state, trstage) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['gotdate']."','".$row_qc['dosdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['got']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['gotstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gotflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['gotrefno']."','".$row_qc['gotauth']."','".$row_qc['doswdate']."','".$row_qc['gotsmpdflg']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$row_qc['genpurity']."','".$packlotno."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$stage')";
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
					
					}
					else
					{	
						if($qc2=="UT" && $gotstatus1=="UT")
						{	
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid)values('$vchk1', '$moist1', '$gotstatus1', '$lotno', '".$arrivaldate."', '$crop', '$variety', '$ncode1', '$stage', '$qc2', '$state2',1,'$orlot2', '$yrco','$logid')";
							mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
						}
						else if($qc2=="UT" && $gotstatus1!="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid)values('$vchk1', '$moist1', '$gotstatus1', '$lotno', '".$arrivaldate."', '$crop', '$variety', '$ncode1', '$stage', '$qc2', '$state',1,'$orlot2', '$yrco','$logid')";
							mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
						}
						if($gotstatus1=="UT" && $qc2!="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid)values('$vchk1', '$moist1', '$gotstatus1', '$lotno', '".$arrivaldate."', '$crop', '$variety', '$ncode1', '$stage', '$qc2', '$state3',1,'$orlot2', '$yrco','$logid')";
							mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
						}
					}
				}*/
				
				
			}	
		}
		
		$sql_code="SELECT MAX(unp_code) FROM tbl_psunpp2c where unp_yearcode='$yearid_id'  ORDER BY unp_code DESC";
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
		$sql_btslm2="update tbl_psunpp2c set unp_tflg=1, unp_code='$code' where unp_id='$pid'";
		$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));
		//exit;
		echo "<script>window.location='select_p2c_op.php?p_id=$pid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Pack Seed Unpacking - Pack to Condition (P2C) - Preview</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="farrival1.js"></script>
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

winHandle=window.open('p2c_details_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
//return false;
	/*if(document.frmaddDepartment.verflg.value!=0)
	{
		alert("Please Verify the Packaging Lots first");
		return false;
	}*/
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		return true;	 
	}
	else
	{
		return false;
	} 
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
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed Unpacking - Pack to Condition (P2C) - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_psunpp2c where plantcode='$plantcode' and unp_logid='".$logid."' and unp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['unp_id'];

	$tdate=$row_tbl['unp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where  plantcode='$plantcode' and cropid='".$row_tbl['unp_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where plantcode='$plantcode' and varietyid='".$row_tbl['unp_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);

?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Unpacking - Pack to Condition (P2C)</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TPC".$row_tbl['unp_tcode']."/".$row_tbl['unp_yearcode']."/".$row_tbl['unp_logid'];?></td>

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
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_ups'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_lotno'];?></td>
</tr>
</table>
<?php

$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

$nop=0; $qty=0; $qc=""; $dot=""; $got=""; $dogt=""; 
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
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
	$ptp=$packtp[0];
	$ptp1=$packtp[0];
}
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	$nop1=($ptp*$penqty);
	else
	$nop1=($penqty/$ptp);
}

$nop=$nop+$nop1; 
$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$qty+$row_issuetbl['balqty'];

$qc=$row_issuetbl['lotldg_qc'];
$orlot=$row_issuetbl['orlot'];

$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];

$dgt=explode("-",$row_issuetbl['lotldg_gottestdate']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$gt=explode(" ",$row_issuetbl['lotldg_got1']);
$got=$gt[0]." ".$row_issuetbl['lotldg_got'];

if($dot=="0000-00-00" || $dot=="--" || $dot=="- -")$dot="";
if($dogt=="0000-00-00" || $dogt=="--" || $dogt=="- -")$dogt="";
}
}

$zzz=implode(",", str_split($row_tbl['unp_lotno']));
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
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."C";
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."C";

$tflg=0;
$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' and trtype='Qty-Rem'") or die(mysqli_error($link)); 
$tot_istbl=mysqli_num_rows($sql_istbl);

$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' and trtype='Dispatch'") or die(mysqli_error($link)); 
$tot_istbl2=mysqli_num_rows($sql_istbl2);

if($tot_istbl > 0 || $tot_istbl2 > 0)$tflg++;
if($nomp > 0)$tflg++;

?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<?php echo $nop;?></td>	
<td align="right" width="236" valign="middle" class="tblheading">NoMP&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<?php echo $nomp;?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>	
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<?php echo $got;?></td>
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $dogt;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">P2C&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<?php echo ucwords($row_tbl['unp_p2ctype']);?></td>
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;<?php if($row_tbl['unp_p2ctype']=="partial") echo "Batch No. Generated - <font color=red>YES</font>"; else if($row_tbl['unp_p2ctype']=="entire") echo "Batch No. Generated - <font color=red>NO</font>"; else echo ""; ?></td>
<td align="right"  valign="middle" class="tblheading">P2C Lot number&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['unp_newlotno'];?></td>
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />

</table>
<br />
<div id="showlotsloc">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="10" align="center" valign="middle" class="tblheading">Existing SLOC Details</td>
</tr>
<tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="tblheading">#</td>
	<td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">Nop</td>
	<td width="107" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance Nop</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance Qty</td>
</tr>
<?php
$sno=0;

$sql_sub=mysqli_query($link,"Select * from tbl_psunpp2c_sub where plantcode='$plantcode' and unp_id='$tid'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$enop=$row_sub['unp_onop']; 
$eqty=$row_sub['unp_oqty'];
$nop=$row_sub['unp_nop']; 
$qty=$row_sub['unp_qty'];
$bnop=$row_sub['unp_bnop']; 
$bqty=$row_sub['unp_bqty'];


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sub['unp_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sub['unp_bin']."' and whid='".$row_sub['unp_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sub['unp_sbin']."' and binid='".$row_sub['unp_bin']."' and whid='".$row_sub['unp_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$sno++;


?>
<tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $sno;?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
    <td width="87" align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
    <td width="107" align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $enop;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $eqty;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $nop;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $bnop;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $bqty;?></td>
</tr>
<?php
}
}

?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" />
</table>
<br />

</div>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Condition Seed - SLOC Details</td>
  </tr>
  <!--<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>-->
  <tr class="tblsubtitle" height="20">
    <td width="157" align="center" valign="middle" class="tblheading">WH</td>
    <td width="145" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="173" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="183" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="180" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$sql_sub2=mysqli_query($link,"Select * from tbl_psunpp2c_sub2 where plantcode='$plantcode' and unp_id='$tid'") or die(mysqli_error($link));
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2 > 0)
{
while($row_sub2=mysqli_fetch_array($sql_sub2))
{

$nop2=$row_sub2['unp_nop']; 
$qty2=$row_sub2['unp_qty'];

$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sub2['unp_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sub2['unp_bin']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sub2['unp_sbin']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
?>
<tr class="Light" height="30" >
	<td width="157" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="145" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="173" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="183"  valign="middle" class="tbltext">&nbsp;<?php echo $nop2;?></td>
	<td width="180" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $qty2;?></td>
</tr>

<?php
}
}
?>
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_p2c.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  