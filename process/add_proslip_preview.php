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
	$connnew = mysqli_connect("localhost","wfuser","P1o5RSOloG8jCAN8") or die("Error:".mysqli_error($connnew));
	$dbnew = mysqli_select_db($connnew,"wmsfocusdb") or die("Error:".mysqli_error($connnew));
	
	$sql_arr=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	$sql_arrsub=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$a_arrsub=mysqli_num_rows($sql_arrsub);
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$crop=$row_arr['proslipmain_crop'];
		$variety=$row_arr['proslipmain_variety'];
		$lotno=$row_arrsub['proslipsub_lotno'];
		$arrival_date=$row_arr['proslipmain_date'];
		$drefno=$row_arr['proslipmain_proslipno'];
		$lotstage=$row_arr['proslipmain_stage'];
		$protyp=$row_arrsub['proslipsub_processtype'];
		$conqty=$row_arrsub['proslipsub_conqty'];
		
		$ttype=$row_arr['proslipmain_ttype'];
		
		$zzz=implode(",", str_split($row_arrsub['proslipsub_lotno']));
		
		
		$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
		$abc6=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
		$ycr=$zzz[2];
		$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where SUBSTRING(lotldg_lotno,1,13)='$abc6' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		
		$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where SUBSTRING(lotno,1,13)='$abc6' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		$row_month23=mysqli_fetch_array($sql_month23);
		
		$abc2=0;
		if($row_month[0]>$row_month23[0])
		$abc2=$row_month[0];
		if($row_month[0]<$row_month23[0])
		$abc2=$row_month23[0];
		else
		$abc2=$row_month[0];
		
		$abc2=sprintf("%02d",($abc2+1));
		$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2;
		$lotnumb=$zzz[4];
		
		if($protyp=="P")
		$lot=$abc24;
		else
		$lot=$abc;
		
		$orlot2=$lot;
		
		$lot=$lot."C";
		
		$ycr=$zzz[2];
		
		//echo $lot;
		//exit;
		/*else
		$lot=$lotno;*/

		

		$cnnt=0;
		$otrid=0;
		$sql_arrsubsub=mysqli_query($link,"select * from tbl_proslipsubsub where proslipmain_id='".$pid."' and proslipsub_id='".$row_arrsub['proslipsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$a_sub=mysqli_num_rows($sql_arrsubsub);
		while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
		{
		
		$onob=$row_arrsubsub['proslipsubsub_onob'];
		$oqty=$row_arrsubsub['proslipsubsub_oqty'];
		$nob1=$row_arrsubsub['proslipsubsub_pnob'];
		$qty1=$row_arrsubsub['proslipsubsub_pqty'];
		$bnob=$row_arrsubsub['proslipsubsub_bnob'];
		$bqty=$row_arrsubsub['proslipsubsub_bqty'];
		
		$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_arrsubsub['proslipsubsub_subbin']."' and lotldg_binid='".$row_arrsubsub['proslipsubsub_bin']."' and lotldg_whid='".$row_arrsubsub['proslipsubsub_wh']."' and lotldg_variety='".$variety."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode' order by lotldg_balqty desc") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{
				$otrid=$row_issuetbl['lotldg_id'];
				
				$whid=$row_issuetbl['lotldg_whid'];
				$binid=$row_issuetbl['lotldg_binid'];
				$subbinid=$row_issuetbl['lotldg_subbinid'];
				$opups=$row_issuetbl['lotldg_balbags'];
				$opqty=$row_issuetbl['lotldg_balqty'];
				
				if($protyp=="P")
				{
				$balups=$opups-$nob1;
				$balqty=$opqty-$qty1;
				}
				else
				{
				$balups=0;
				$balqty=0;
				}
				if($balqty<=0){$balqty=0; $balups=0;}
				if($balqty>0 && $balups==0){$balups=1;}
				
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
				$srtype=$row_issuetbl['lotldg_srtyp'];
				$srflg=$row_issuetbl['lotldg_srflg'];
				
				$sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','PROSLIPSUO', '$pid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob1', '$qty1', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$srtype', '$srflg', '$plantcode')";
				//exit;
				mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
			
			$cntg=0;
				
			$sql_issueg=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));

			while($row_issueg=mysqli_fetch_array($sql_issueg))
			 { 
				$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."'") or die(mysqli_error($link));
				$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
				$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$totnog=mysqli_num_rows($sql_issuetblg);
				if($totnog > 0)
				{
				  $cntg++;
				} 
			}
			
			$sql_issueg=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
			
			while($row_issueg=mysqli_fetch_array($sql_issueg))
			 { 
				$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$subbinid."' and lotno='".$row_issueg['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_issueg1=mysqli_fetch_array($sql_issueg1); 
				
				$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
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
		$frnsloc='';
		$sql_arrsubsub2=mysqli_query($link,"select * from tbl_proslipsubsub2 where proslipmain_id='".$pid."' and proslipsub_id='".$row_arrsub['proslipsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$a_sub2=mysqli_num_rows($sql_arrsubsub2);
		while($row_arrsubsub2=mysqli_fetch_array($sql_arrsubsub2))
		{
		
		$onob2=$row_arrsubsub2['proslipsubsub_onob'];
		$oqty2=$row_arrsubsub2['proslipsubsub_oqty'];
		$nob12=$row_arrsubsub2['proslipsubsub_pnob'];
		$qty12=$row_arrsubsub2['proslipsubsub_pqty'];
		$balups2=$row_arrsubsub2['proslipsubsub_bnob'];
		$balqty2=$row_arrsubsub2['proslipsubsub_bqty'];
		$whid2=$row_arrsubsub2['proslipsubsub_wh'];
		$binid2=$row_arrsubsub2['proslipsubsub_bin'];
		$subbinid2=$row_arrsubsub2['proslipsubsub_subbin'];
		$sstage2="Condition";
		
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid2."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$binid2."' and whid='".$whid2."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$subbinid2."' and binid='".$binid2."' and whid='".$whid2."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		if($frnsloc!='') {$frnsloc=$frnsloc.",".$wareh."/".$binn."/".$subbinn;}	 else {$frnsloc=$wareh."/".$binn."/".$subbinn;}	
			$sstatus2=""; $moist2=""; $gemp2=""; $vchk2=""; $got12=""; $qc2=""; $gotstatus2=""; $qctestdate2=""; $gottestdate2=""; $gs2=""; $resverstatus2=""; $revcomment2="";
			
			$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$otrid."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
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
				//$orlot2=$row_issuetbl22['orlot'];
				$gs2=$row_issuetbl22['lotldg_gs'];
				$resverstatus2=$row_issuetbl22['lotldg_resverstatus'];
				$revcomment2=$row_issuetbl22['lotldg_revcomment'];
				$geneticpurity2=$row_issuetbl22['lotldg_genpurity'];
				$srtype2=$row_issuetbl22['lotldg_srtyp'];
				$srflg2=$row_issuetbl22['lotldg_srflg'];
			}	
				if($qc2!="UT" && $qc2!="RT"  && $croptype!='Field Crop'  && $ttype!="Re-Processing Slip")
				{
					$qc2='UT';
				}	
				  if($srtype=="condition" || $srtype=="Condition")
				  {$srtype=""; $srflg=0;}
				  $sql_ins_main22="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','PROSLIPSUC', '$pid', '$arrival_date', '$lot', '$crop', '$variety', '$whid2', '$binid2', '$subbinid2', '$onob2', '$oqty2', '$nob12', '$qty12', '$balups2', '$balqty2', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlot2', '$gs2', '$resverstatus2', '$revcomment2', '$geneticpurity2', '$srtype', '$srflg', '$plantcode')";
				//exit;
				mysqli_query($link,$sql_ins_main22) or die(mysqli_error($link));
				
				$sql_itmg22="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
				mysqli_query($link,$sql_itmg22) or die(mysqli_error($link));
				
				if($srflg>0)
				{
					if($protyp=="P")
					{
						$srdt=""; $type="";
						$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub WHERE softrsub_lotno='".$orlot."' ") or die(mysqli_error($link));
						$tot_srsub2=mysqli_num_rows($sql_srsub2);
						$row_srsub2=mysqli_fetch_array($sql_srsub2);
						$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."' ") or die(mysqli_error($link));
						$tot_srsub=mysqli_num_rows($sql_srsub);
						while($row_srsub=mysqli_fetch_array($sql_srsub))
						{
							$type=$row_srsub['softrsub_srtyp'];	 
							$sql_srmain=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_srsub['softr_id']."' ") or die(mysqli_error($link));
							$tot_srmain=mysqli_num_rows($sql_srmain);
							$row_srmain=mysqli_fetch_array($sql_srmain);	
							$srdt=$row_srmain['softr_date'];
							if($srdt=="" || $srdt=="0000-00-00"){$srdt="";}
							$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr  where yearcode='$yearid_id' and plantcode='$plantcode' ORDER BY softr_tcode DESC";
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
							$sql_code2="SELECT MAX(softr_code) FROM tbl_softr  where yearcode='$yearid_id' and plantcode='$plantcode' ORDER BY softr_code DESC";
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
							$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub2 WHERE softrsub_lotno='".$orlot."' ") or die(mysqli_error($link));
							$tot_srsub2=mysqli_num_rows($sql_srsub2);
							$row_srsub2=mysqli_fetch_array($sql_srsub2);
							$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 WHERE softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."' ") or die(mysqli_error($link));
							$tot_srsub=mysqli_num_rows($sql_srsub);
							while($row_srsub=mysqli_fetch_array($sql_srsub))
							{
								$type=$row_srsub['softrsub_srtyp'];	 
								$sql_srmain=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_srsub['softr_id']."' ") or die(mysqli_error($link));
								$tot_srmain=mysqli_num_rows($sql_srmain);
								$row_srmain=mysqli_fetch_array($sql_srmain);	
								$srdt=$row_srmain['softr_date'];
								if($srdt=="" || $srdt=="0000-00-00"){$srdt="";}
								$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr2  where yearcode='$yearid_id' and plantcode='$plantcode' ORDER BY softr_tcode DESC";
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
								$sql_code2="SELECT MAX(softr_code) FROM tbl_softr2  where yearcode='$yearid_id' and plantcode='$plantcode' ORDER BY softr_code DESC";
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
						if($srdt=="") {$srdt=date("Y-m-d");}	
						$sql_srmain="Insert into tbl_softr (softr_tcode, softr_code, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode, softr_tflg, plantcode) values('$code1', '$code', '$srdt', '$crop', '$variety', 'sllot', '$whid2', '$binid2', '$subbinid2', '$yearid_id', '1', '$plantcode')";
						if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
						{
							$id=mysqli_insert_id($link);
							$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg, plantcode) values('$id', '$orlot2', '$type', '1', '$plantcode')";
							$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
						}	
					}
				}
				
				$sql_qc1=mysqli_query($link,"Select Max(tid) from tbl_qctest where oldlot='".$orlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_qc1=mysqli_fetch_array($sql_qc1);
				$yrco="";	
				
				$sql_got1=mysqli_query($link,"Select Max(gottest_tid) from tbl_gottest  where gottest_oldlot='".$orlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_got1=mysqli_fetch_array($sql_got1);
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
				else*/
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
					
					//$sql_qc2=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."'") or die(mysqli_error($link));
					//$row_qc2=mysqli_fetch_array($sql_qc2);
					//$ncode1=$row_qc2['sampleno'];
					//$arrivaldate=$row_qc2['srdate'];
					//$yrco=$row_qc2['yearid'];
				}		
					if(($qc2=="UT" || $qc2=="RT") && $ttype=="Re-Processing Slip")
					{
						$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."' ") or die(mysqli_error($link));
						$row_qc=mysqli_fetch_array($sql_qc);
						$ncode1=$row_qc['sampleno'];
					}
					
					$sampno=$plantcode.$yearid_id.sprintf("%000006d",$ncode1);
					
					if($yrco=="")$yrco=$ycr;
											
					$sql_got=mysqli_query($link,"Select * from tbl_gottest where gottest_tid='".$row_got1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$row_got=mysqli_fetch_array($sql_got);
					

					$classqry=mysqli_query($link,"select * from tblcrop where cropid='".$crop."' ") or die(mysqli_error($link));
					$noticia_class=mysqli_fetch_array($classqry);
					$croptype=$noticia_class['noticia_class'];
					
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
					
					//"insert into tbl_qctest(spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['gotdate']."','".$row_qc['dosdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['got']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['gotstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gotflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['gotrefno']."','".$row_qc['gotauth']."','".$row_qc['doswdate']."','".$row_qc['gotsmpdflg']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$row_qc['genpurity']."')"
					
					
					/*if($qc2=="UT" || $got1=="UT")
					{
						$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, gotdate, dosdate, pp, moist, got, qc, variety, crop, gemp, srdate, qcstatus, gotstatus, sampleno, aflg, bflg, cflg, qcflg, gotflg, gsflg, gs, gotrefno, gotauth, doswdate, gotsmpdflg, stsno, qcrefno, genpurity, lotno, oldlot, yearid, logid, state, trstage) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['gotdate']."','".$row_qc['dosdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['got']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$row_qc['gotstatus']."','".$row_qc['sampleno']."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gotflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['gotrefno']."','".$row_qc['gotauth']."','".$row_qc['doswdate']."','".$row_qc['gotsmpdflg']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$row_qc['genpurity']."','".$lot."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$sstage2')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}*/
					
					$state="P/M/G";	 
					if($qc2=="UT" && $croptype!='Field Crop')
					{
						$sql_sub_sub1244="insert into tbl_qctest(pp, moist, lotno, srdate, crop, variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid, plantcode) values ('$vchk2', '$moist2', '$lot', '$arrival_date', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1 ,'$orlot2', '$yearid_id', '$logid', '$plantcode')";
						mysqli_query($link,$sql_sub_sub1244) or die(mysqli_error($link));
						if(($qc2=="UT" || $qc2=="RT") && $ttype=="Re-Processing Slip")
						{
							$sql_qc=mysqli_query($link,"Select * from tbl_qctest where tid='".$row_qc1[0]."' ") or die(mysqli_error($link));
							$row_qc=mysqli_fetch_array($sql_qc);
							$ncode1=$row_qc['sampleno'];
							$sampno=$plantcode.$yearid_id.sprintf("%000006d",$ncode1);
							
							$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$ncode1."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$lot."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$sstage2','".$sampno."', '$plantcode')";
							mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
						}
					}	
					/*if($qc2=="UT")
					{
						$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$ncode1."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$lot."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$sstage2','".$sampno."', '$plantcode')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
							
					if($got1=="UT")
					{
						$sql_sub_sub123="insert into tbl_gottest (gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_srdate, gottest_gotstatus, gottest_sampleno, gottest_aflg, gottest_bflg, gottest_cflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, genpurity, gottest_lotno, gottest_oldlot, yearid, logid, gottest_trstage, gottest_sampno, plantcode) values('".$row_got['gottest_spdate']."','".$row_got['gottest_gotdate']."','".$row_got['gottest_dosdate']."','".$row_got['gottest_got']."','".$row_got['gottest_variety']."','".$row_got['gottest_crop']."','".$row_got['gottest_srdate']."','".$row_got['gottest_gotstatus']."','".$ncode1."','".$row_got['gottest_aflg']."','".$row_got['gottest_bflg']."','".$row_got['gottest_cflg']."','".$row_got['gottest_gotflg']."','".$row_got['gottest_gotrefno']."','".$row_got['gottest_gotauth']."','".$row_got['gottest_gotsampdflg']."','".$row_got['genpurity']."','".$lot."','".$orlot2."','$yrco','$logid', '$sstage2','".$sampno."', '$plantcode')";
						mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
							
					else if($qc2=="UT" && $got1!="UT")
					{
						$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, bflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$lot', '".$arrivaldate."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot2', '".$row_qc['spdate']."',1,'$yrco','$logid')";
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
					}
					else if($got1=="UT" && $qc2!="UT")
					{
						$sql_sub_sub13="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, qcstatus,gotsmpdflg,yearid,logid)values('$vchk2', '$moist2', '$got1', '$lot', '".$row_qc['srdate']."', '$crop', '$variety', '$ncode2', '$sstage2', '$qc2', '$state2',1,'$orlot2', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1, '$qc2',0,'$yrco','$logid')";
						mysqli_query($link,$sql_sub_sub13) or die(mysqli_error($link));
					}	
					else
					{
						//$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, gotdate, gotflg, qcstatus,gotsmpdflg, gotstatus,yearid,logid)values('$vchk2', '$moist2', '$got1', '$lot', '".$arrival_date."', '$crop', '$variety', '$ncode1', '$sstage2', '$qc2', '$state',1,'$orlot2', '".$row_qc['spdate']."', '".$row_qc['dosdate']."',1,'".$row_qc['testdate']."',1,'".$row_qc['gotdate']."',1, '$qc2',1, '$got1','$yrco','$logid')";
					}	*/
						
				}
		//}
		
		
		
		if($lotstage=="Raw")
		{
			$sql_fnyear=mysqli_query($link,"select * from tblfnyears where years_flg=1") or die(mysqli_error($link));
			$row_fnyear=mysqli_fetch_array($sql_fnyear);
			$fnyear=$row_fnyear['ycode'];
			
			$zzz=implode(",", str_split($row_arrsub['proslipsub_lotno']));
			$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
			$abc2=$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
			$lotnumb=$zzz[4];
			$blendorlot=$abc."/00000/00";
				
			$sql_focusdbcode1="SELECT * FROM tbl_frn where wffrn_batch='$abc' and (wffrn_trtype='Processing' OR wffrn_trtype='GOT') ORDER BY wffrn_batch DESC";
			$res_focusdbcode1=mysqli_query($connnew,$sql_focusdbcode1)or die(mysqli_error($connnew));
			if(mysqli_num_rows($res_focusdbcode1) > 0)
			{
				while($row_focusdbcode1=mysqli_fetch_row($res_focusdbcode1))
				{
					$ploss=$row_focusdbcode1['wffrn_ploss']+$row_arrsub['proslipsub_tlqty'];
					$plossper=($ploss/$row_arrsub['proslipsub_pqty'])*100;
					$sqltblwfsub="update tbl_frn set wffrn_ploss='".$ploss."', wffrn_pper='".$plossper."' where wffrn_id='".$row_focusdbcode1['wffrn_id']."' ";
					$cxwfcx=mysqli_query($connnew,$sqltblwfsub) or die(mysqli_error($connnew));
				}
			}
			else
			{
				$tdt=explode("-",$arrival_date);
				$monthNum  = $tdt[1];
				$monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // Mar
				
				
				$sql_focusdbcode1="SELECT MAX(wffrn_code) FROM tbl_frn where wffrn_month='$monthName' and wffrn_yearcode='$fnyear' and (wffrn_trtype='Processing' OR wffrn_trtype='GOT')  ORDER BY wffrn_code DESC";
				$res_focusdbcode1=mysqli_query($connnew,$sql_focusdbcode1)or die(mysqli_error($connnew));
				
				if(mysqli_num_rows($res_focusdbcode1) > 0)
				{
					$row_focusdbcode1=mysqli_fetch_row($res_focusdbcode1);
					$t_focusdbcode1=$row_focusdbcode1['0'];
					$doccode=$t_focusdbcode1+1;
					if($doccode==0){$doccode=1;}
					$doccode2=sprintf("%00005d",$doccode);
				}
				else
				{
					$doccode=1; 
					$doccode2=sprintf("%00005d",$doccode);
				}
				$sql_fnyear=mysqli_query($link,"select * from tblfnyears where years_flg=1") or die(mysqli_error($link));
				$row_fnyear=mysqli_fetch_array($sql_fnyear);
				$fnyear=$row_fnyear['ycode'];
				
				$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
				$row_crp=mysqli_fetch_array($sql_crp);
				$crp=$row_crp['cropname'];
				$cropcode=$row_crp['cropcode'];
				$crptype="PRODUCTION - ".$row_crp['croptype'];
				if($row_crp['croptype']=='Fruit Crop'){$crptype="PRODUCTION - ".'Vegetable Crop';}
		
				$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
				$row_var=mysqli_fetch_array($sql_var);
				$ver=$row_var['popularname'];
				$itemcode=$row_var['variety_newcode'];
				
				$sql_arrsubtbl=mysqli_query($link,"select * from tblarrival_sub where old='".$abc2."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_arrsubtbl=mysqli_fetch_array($sql_arrsubtbl);
				$frnno=$row_arrsubtbl['ncode'];
				$blendedcontlots='';
				if($lotnumb==9)
				{
					$sql_arrsubtbl=mysqli_query($link,"select * from tbl_blends where blends_orlot='".$blendorlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
					while($row_arrsubtbl=mysqli_fetch_array($sql_arrsubtbl))
					{
						$zzz5=implode(",", str_split($blendorlot));
						$abcnew=$zzz5[2].$zzz5[4].$zzz5[6].$zzz5[8].$zzz5[10].$zzz5[12];
						
						$qryarrsub="select * from tbllotimp where lotnumber='".$abcnew."' and plantcode='$plantcode'";
						$sqlarrsub=mysqli_query($link,$qryarrsub) or die(mysqli_error($link));
						$rowarrsub=mysqli_fetch_array($sqlarrsub);
						$farmername=$rowarrsub['lotfarmer'];
						if(trim($rowarrsub['farmer_id'])!='' && trim($rowarrsub['farmer_id'])!='0' && trim($rowarrsub['farmer_id'])!=NULL)
						{ $farmercode=trim($rowarrsub['farmer_id']);  }
						else if(trim($rowarrsub['farmer_code'])!='' && trim($rowarrsub['farmer_code'])!='0' && trim($rowarrsub['farmer_code'])!=NULL)
						{ $farmercode=trim($rowarrsub['farmer_code']); }
						else 
						{
							$sql_prodlocw=mysqli_query($link,"select * from tbl_productionlocation where productionlocation='".$rowarrsub['lotploc']."' and state='".$rowarrsub['lotstate']."' ") or die(mysqli_error($link)); 
							$row_prodlocw=mysqli_fetch_array($sql_prodlocw);
							
							$sql_farmerw=mysqli_query($link,"select * from tblfarmer where farmername='".$rowarrsub['lotfarmer']."' and productionlocationid='".$row_prodlocw['productionlocationid']."'") or die(mysqli_error($link)); 
							$row_farmerw=mysqli_fetch_array($sql_farmerw);
							if(trim($row_farmerw['farmercode'])!='' && trim($row_farmerw['farmercode'])!='0' && trim($row_farmerw['farmercode'])!=NULL)
							{ $farmercode=$row_farmerw['farmercode']; }
							else if(trim($row_farmerw['farmer_code'])!='' && trim($row_farmerw['farmer_code'])!='0' && trim($row_farmerw['farmer_code'])!=NULL)
							{ $farmercode=$row_farmerw['farmer_code']; }
							else
							{ $farmercode=''; }
						}
						$ltn=$row_arrsubtbl['blends_lotno']."~".$farmername."~".$farmercode;
						if($blendedcontlots!='') { $blendedcontlots=$blendedcontlots.",".$ltn; }
						else  { $blendedcontlots=$ltn; }
					}
				}
				else if($lotnumb==8)
				{
					$sql_arrsubtbl=mysqli_query($link,"select * from tbl_cobdryingsub where norlot='".$blendorlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
					while($row_arrsubtbl=mysqli_fetch_array($sql_arrsubtbl))
					{
						$zzz5=implode(",", str_split($blendorlot));
						$abcnew=$zzz5[2].$zzz5[4].$zzz5[6].$zzz5[8].$zzz5[10].$zzz5[12];
						
						$qryarrsub="select * from tbllotimp where lotnumber='".$abcnew."' and plantcode='$plantcode'";
						$sqlarrsub=mysqli_query($link,$qryarrsub) or die(mysqli_error($link));
						$rowarrsub=mysqli_fetch_array($sqlarrsub);
						$farmername=$rowarrsub['lotfarmer'];
						if(trim($rowarrsub['farmer_id'])!='' && trim($rowarrsub['farmer_id'])!='0' && trim($rowarrsub['farmer_id'])!=NULL)
						{ $farmercode=trim($rowarrsub['farmer_id']);  }
						else if(trim($rowarrsub['farmer_code'])!='' && trim($rowarrsub['farmer_code'])!='0' && trim($rowarrsub['farmer_code'])!=NULL)
						{ $farmercode=trim($rowarrsub['farmer_code']); }
						else 
						{
							$sql_prodlocw=mysqli_query($link,"select * from tbl_productionlocation where productionlocation='".$rowarrsub['lotploc']."' and state='".$rowarrsub['lotstate']."' ") or die(mysqli_error($link)); 
							$row_prodlocw=mysqli_fetch_array($sql_prodlocw);
							
							$sql_farmerw=mysqli_query($link,"select * from tblfarmer where farmername='".$rowarrsub['lotfarmer']."' and productionlocationid='".$row_prodlocw['productionlocationid']."'") or die(mysqli_error($link)); 
							$row_farmerw=mysqli_fetch_array($sql_farmerw);
							if(trim($row_farmerw['farmercode'])!='' && trim($row_farmerw['farmercode'])!='0' && trim($row_farmerw['farmercode'])!=NULL)
							{ $farmercode=$row_farmerw['farmercode']; }
							else if(trim($row_farmerw['farmer_code'])!='' && trim($row_farmerw['farmer_code'])!='0' && trim($row_farmerw['farmer_code'])!=NULL)
							{ $farmercode=$row_farmerw['farmer_code']; }
							else
							{ $farmercode=''; }
						}
						
						$ltn=$row_arrsubtbl['blends_lotno']."~".$farmername."~".$farmercode;
						if($blendedcontlots!='') { $blendedcontlots=$blendedcontlots.",".$ltn; }
						else  { $blendedcontlots=$ltn; }
					}
				}
				else
				{
					$qryarrsub="select * from tbllotimp where lotnumber='".$abc2."' and plantcode='$plantcode'";
					$sqlarrsub=mysqli_query($link,$qryarrsub) or die(mysqli_error($link));
					$rowarrsub=mysqli_fetch_array($sqlarrsub);
					$farmername=$rowarrsub['lotfarmer'];
					if(trim($rowarrsub['farmer_id'])!='' && trim($rowarrsub['farmer_id'])!='0' && trim($rowarrsub['farmer_id'])!=NULL)
					{ $farmercode=trim($rowarrsub['farmer_id']);  }
					else if(trim($rowarrsub['farmer_code'])!='' && trim($rowarrsub['farmer_code'])!='0' && trim($rowarrsub['farmer_code'])!=NULL)
					{ $farmercode=trim($rowarrsub['farmer_code']); }
					else 
					{
						$sql_prodlocw=mysqli_query($link,"select * from tbl_productionlocation where productionlocation='".$rowarrsub['lotploc']."' and state='".$rowarrsub['lotstate']."' ") or die(mysqli_error($link)); 
						$row_prodlocw=mysqli_fetch_array($sql_prodlocw);
						
						$sql_farmerw=mysqli_query($link,"select * from tblfarmer where farmername='".$rowarrsub['lotfarmer']."' and productionlocationid='".$row_prodlocw['productionlocationid']."'") or die(mysqli_error($link)); 
						$row_farmerw=mysqli_fetch_array($sql_farmerw);
						if(trim($row_farmerw['farmercode'])!='' && trim($row_farmerw['farmercode'])!='0' && trim($row_farmerw['farmercode'])!=NULL)
						{ $farmercode=$row_farmerw['farmercode']; }
						else if(trim($row_farmerw['farmer_code'])!='' && trim($row_farmerw['farmer_code'])!='0' && trim($row_farmerw['farmer_code'])!=NULL)
						{ $farmercode=$row_farmerw['farmer_code']; }
						else
						{ $farmercode=''; }
					}
				}
				
				$doc_code="DPN/".$fnyear."/".$monthName."/".$doccode2;
				$tdt=date("Y-m-d");
				
				$ploss=$row_arrsub['proslipsub_tlqty'];
				$plossper=($ploss/$row_arrsub['proslipsub_pqty'])*100;
				
				$narration='Processing Slip  No. '.$row_arr['proslipmain_proslipno']." FRN NO ".$frnno; 
				
				$sql_focusdb="insert into tbl_frn (wffrn_arrid, wffrn_docno, wffrn_date, wffrn_businessentity, wffrn_narration, wffrn_crop, wffrn_item, wffrn_batch, wffrn_code, wffrn_month, wffrn_yearcode, wffrn_trtype, wffrn_unit, wffrn_warehouse, wffrn_qty, wffrn_farmername, Doc_Type, wffrn_ploss, wffrn_pper, wffrn_vendorac, wffrn_department, wffrn_itemcode, account_code, account_name, wffrn_cropcode, constituent_lotnos) values('$pid', '".$doc_code."', '".$arrival_date."', 'HEAD OFFICE', '".$narration."', '".$crp."', '".$ver."', '".$abc."', '".$doccode."', '".$monthName."', '".$fnyear."', 'Processing', 'KGS', 'Raw Seed', '".$conqty."', '".$farmername."', 'Purchase Debit-CS-Seedtrac', '".$ploss."', '".$plossper."', '".$farmercode."', '".$crptype."', '".$itemcode."', 'DEBIT NOTE PROCESSING LOSS', 'DEBIT NOTE PROCESSING LOSS', '".$cropcode."', '".$blendedcontlots."')";
				if($focusdb_xz=mysqli_query($connnew,$sql_focusdb) or die(mysqli_error($connnew)))
				{
					//$wfid=mysqli_insert_id($connnew);
				}
			}
		}
		
	}
	}
	
	$sql_code1="SELECT MAX(proslipmain_tcode) FROM tbl_proslipmain where plantcode='$plantcode' ORDER BY proslipmain_tcode DESC";
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
	
	$sql_main="update tbl_proslipmain set proslipmain_tflag=1, proslipmain_tcode=$ncode1  where proslipmain_id ='$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	//exit;
	echo "<script>window.location='home_pslip.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW -Transaction - Processing Slip- Preview</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('proslip_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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

</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_process.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Processing slip - Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
   <?php
   $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['proslipmain_id'];

$tdate=$row_tbl['proslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;?>
 	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="850"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Processing Slip Preview</td>
</tr>
 <tr class="Dark" height="30">
<td width="134" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID&nbsp;</td>
<td width="144"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['proslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="95" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="182" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>

<td width="137" align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['proslipmain_proslipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['proslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="133" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="145" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['proslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="95" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="182" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="137" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="144" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['proslipmain_stage'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where promac_id='".$row_tbl['proslipmain_promachcode']."' and plantcode='$plantcode' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where proopr_id='".$row_tbl['proslipmain_proopr']."' and plantcode='$plantcode'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['proslipmain_treattype']?>" /></td>
	</tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="3" valign="middle" class="smalltblheading">V. Lot No.</td>-->
	<td width="100" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <!--<td width="10%" align="center" valign="middle" class="smalltblheading" colspan="2">Raw Seed </td>-->
	 <td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="60" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
	 <td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
	 <td align="center" valign="middle" class="smalltblheading" colspan="2">Condition Seed </td>
     <td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>

	 	 <td align="center" valign="middle" class="smalltblheading"  rowspan="2">IM </td>
<td width="50"  rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
<td align="center" valign="middle" class="smalltblheading"  colspan="2">Total C. Loss</td>
		  <!--/*<td width="9%" rowspan="3" align="center" valign="middle" class="smalltblheading">QC Status </td>	 
		   <td width="12%" rowspan="3" align="center" valign="middle" class="smalltblheading">GOT Type </td>*/-->
    <td width="107" colspan="1" rowspan="2" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="54" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
    </tr>
   <tr class="tblsubtitle">
    
     <!--<td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="smalltblheading">%</td>-->
     <td width="45" align="center" valign="middle" class="smalltblheading">NoB </td>
    <td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<!--<td width="4%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="2%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="4%" align="center" valign="middle" class="smalltblheading">%</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="5%" align="center" valign="middle" class="smalltblheading">%</td>-->
	    <td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
	  <td width="30" align="center" valign="middle" class="smalltblheading">%</td>
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
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_proslipsubsub2 where proslipsub_id='".$row_tbl_sub['proslipsub_id']."' and proslipmain_id='".$arrival_id."' and plantcode='$plantcode' order by proslipsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_subsub['proslipsubsub_bin']."' and whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_subsub['proslipsubsub_subbin']."' and binid='".$row_tbl_subsub['proslipsubsub_bin']."' and whid='".$row_tbl_subsub['proslipsubsub_wh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nb1=$row_tbl_subsub['proslipsubsub_bnob']; 

$diq=explode(".",$row_tbl_subsub['proslipsubsub_bqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['proslipsubsub_bqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlper'];?></td>
	<td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['proslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['proslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['proslipsub_remarks'];?>">Details</a><?php } ?></td>
        </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pnob'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_pqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['proslipsub_processtype'];?></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_connob'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_conqty'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>
	<!--<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_rm'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_im'];?></td>
	<!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>-->
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_pl'];?></td>
	<!--<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>-->
	<td width="50" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlqty'];?></td>
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['proslipsub_tlper'];?></td>
	<td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['proslipsub_remarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['proslipsub_remarks'];?>" onmouseover="<?php echo $row_tbl_sub['proslipsub_remarks'];?>">Details</a><?php } ?></td>
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
<td valign="top" align="right"><a href="edit_processing_slip.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex=""  >&nbsp;&nbsp;</td>
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

  
