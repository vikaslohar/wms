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
		if(isset($_REQUEST['txtonob'])) { $txtonob = $_REQUEST['txtonob']; }
		if(isset($_REQUEST['txtoqty'])) { $txtoqty = $_REQUEST['txtoqty']; }
		if(isset($_REQUEST['txtclotno'])) { $txtclotno = $_REQUEST['txtclotno']; }
		
		if(isset($_REQUEST['txtconnob'])) { $txtconnob= $_REQUEST['txtconnob']; }
		if(isset($_REQUEST['txtconqty'])) { $txtconqty= $_REQUEST['txtconqty']; }
		if(isset($_REQUEST['txtconrem'])) { $txtconrem= $_REQUEST['txtconrem']; }
		if(isset($_REQUEST['txtconim'])) { $txtconim= $_REQUEST['txtconim']; }
		if(isset($_REQUEST['txtconpl'])) { $txtconpl= $_REQUEST['txtconpl']; }
		if(isset($_REQUEST['txtconloss'])) { $txtconloss= $_REQUEST['txtconloss']; }
		if(isset($_REQUEST['txtconper'])) { $txtconper= $_REQUEST['txtconper']; }
		
		if(isset($_REQUEST['txtslwhg1'])) { $txtslwhg1= $_REQUEST['txtslwhg1']; }
		if(isset($_REQUEST['txtslbing1'])) { $txtslbing1= $_REQUEST['txtslbing1']; }
		if(isset($_REQUEST['txtslsubbg1'])) { $txtslsubbg1= $_REQUEST['txtslsubbg1']; }
		
		if(isset($_REQUEST['pcktype'])) { $pcktype= $_REQUEST['pcktype']; }
		if(isset($_REQUEST['avlnobpck'])) { $avlnobpck= $_REQUEST['avlnobpck']; }
		if(isset($_REQUEST['avlqtypck'])) { $avlqtypck= $_REQUEST['avlqtypck']; }
		if(isset($_REQUEST['picqtyp'])) { $picqtyp= $_REQUEST['picqtyp']; }
		if(isset($_REQUEST['balcnob'])) { $balcnob= $_REQUEST['balcnob']; }
		if(isset($_REQUEST['balcqty'])) { $balcqty= $_REQUEST['balcqty']; }
		
		if(isset($_REQUEST['srno2'])) { $srno2= $_REQUEST['srno2']; }
		
		if(isset($_REQUEST['sno6'])) { $sno6= $_REQUEST['sno6']; }
		if(isset($_REQUEST['txtremarks'])) { $txtremarks= $_REQUEST['txtremarks']; }
		if(isset($_REQUEST['txtitem'])) { $maintrid= $_REQUEST['txtitem']; }
	$pid=$maintrid;
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$maintrid."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
		$subtid=$row_tbl_sub['pnpslipsub_id'];
		
		$s_sub="delete from tbl_pnpslipsubsub where pnpslipsub_id='".$subtid."' and pnpslipmain_id='".$maintrid."'";
		mysqli_query($link,$s_sub) or die(mysqli_error($link));
		
		$nnob=0; $qqty=0; $bnob=0; $bqty=0;
		for($i=1; $i<=$srno2; $i++)
		{
			$extslwhgx="extslwhg".$i;
			$extslbingx="extslbing".$i;
			$extslsubbgx="extslsubbg".$i;
			$txtextnobx="txtextnob".$i;
			$txtextqtyx="txtextqty".$i;
			
			$recnobpx="recnobp".$i;
			$recqtypx="recqtyp".$i;
			$txtbalnobpx="txtbalnobp".$i;
			$txtbalqtypx="txtbalqtyp".$i;
			
			if(isset($_REQUEST[$extslwhgx])) { $extslwhg = $_REQUEST[$extslwhgx]; }
			if(isset($_REQUEST[$extslbingx])) { $extslbing = $_REQUEST[$extslbingx]; }
			if(isset($_REQUEST[$extslsubbgx])) { $extslsubbg = $_REQUEST[$extslsubbgx]; }
			if(isset($_REQUEST[$txtextnobx])) { $txtextnob = $_REQUEST[$txtextnobx]; }
			if(isset($_REQUEST[$txtextqtyx])) { $txtextqty = $_REQUEST[$txtextqtyx]; }
			
			if(isset($_REQUEST[$recnobpx])) { $recnobp = $_REQUEST[$recnobpx]; }
			if(isset($_REQUEST[$recqtypx])) { $recqtyp = $_REQUEST[$recqtypx]; }
			if(isset($_REQUEST[$txtbalnobpx])) { $txtbalnobp = $_REQUEST[$txtbalnobpx]; }
			if(isset($_REQUEST[$txtbalqtypx])) { $txtbalqtyp = $_REQUEST[$txtbalqtypx]; }
			$nnob=$nnob+$recnobp;
			$qqty=$qqty+$recqtyp;
			$bnob=$bnob+$txtbalnobp;
			$bqty=$bqty+$txtbalqtyp;
			
			$sql_subsub="insert into tbl_pnpslipsubsub (pnpslipsub_id, pnpslipmain_id, pnpslipsubsub_wh, pnpslipsubsub_bin, pnpslipsubsub_subbin, pnpslipsubsub_onob, pnpslipsubsub_oqty, pnpslipsubsub_pnob, pnpslipsubsub_pqty, pnpslipsubsub_bnob, pnpslipsubsub_bqty, plantcode) values ('$subtid', '$maintrid', '$extslwhg', '$extslbing', '$extslsubbg', '$txtextnob', '$txtextqty', '$recnobp', '$recqtyp', '$txtbalnobp', '$txtbalqtyp', '$plantcode')";
			mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
		}
//echo "<br />";

		
		
		for($i=1; $i<=$sno6; $i++)
		{
			$txtconstlotx="txtconstlot".$i;
			$txtconstremx="txtconstrem".$i;
			$txtconstimx="txtconstim".$i;
			$txtconstplx="txtconstpl".$i;
			$txtconstlossx="txtconstloss".$i;
			$txtconstperx="txtconstper".$i;
			
			if(isset($_REQUEST[$txtconstlotx])) { $txtconstlot = $_REQUEST[$txtconstlotx]; }
			if(isset($_REQUEST[$txtconstremx])) { $txtconstrem = $_REQUEST[$txtconstremx]; }
			if(isset($_REQUEST[$txtconstimx])) { $txtconstim = $_REQUEST[$txtconstimx]; }
			if(isset($_REQUEST[$txtconstplx])) { $txtconstpl = $_REQUEST[$txtconstplx]; }
			if(isset($_REQUEST[$txtconstlossx])) { $txtconstloss = $_REQUEST[$txtconstlossx]; }
			if(isset($_REQUEST[$txtconstperx])) { $txtconstper = $_REQUEST[$txtconstperx]; }
			
			$sql_subsubpl="insert into tbl_proslipblotloss (proslipsub_id, proslipmain_id, lotnumber, rm, im, pl, tpl, tplper) values ('$subtid', '$maintrid', '$txtconstlot', '$txtconstrem', '$txtconstim', '$txtconstpl', '$txtconstloss', '$txtconstper')";
			mysqli_query($link,$sql_subsubpl) or die(mysqli_error($link));
		}		
 	//echo "<br />";	
			
		$sql_sub="Update tbl_pnpslipsub SET pnpslipsub_packtype='$pcktype', pnpslipsub_availpnob='$avlnobpck', pnpslipsub_availpqty='$avlqtypck', pnpslipsub_pickpqty='$picqtyp', pnpslipsub_balcnob='$balcnob', pnpslipsub_balcqty='$balcqty', pnpslipsub_pnob='$nnob', pnpslipsub_pqty='$qqty', pnpslipsub_bnob='$bnob', pnpslipsub_bqty='$bqty', pnpslipsub_connob='$txtconnob', pnpslipsub_conqty='$txtconqty', pnpslipsub_rm='$txtconrem', pnpslipsub_im='$txtconim', pnpslipsub_pl='$txtconpl', pnpslipsub_tlqty='$txtconloss', pnpslipsub_tlper='$txtconper' where pnpslipmain_id='$maintrid'";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
//echo "<br />";		
		$sql_arr=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_id='".$maintrid."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$a_arr=mysqli_num_rows($sql_arr);
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$crop=$row_arr['pnpslipmain_crop'];
			$variety=$row_arr['pnpslipmain_variety'];
			$arrival_date=$row_arr['pnpslipmain_date'];
			$lotstage=$row_arr['pnpslipmain_stage'];
			$drefno=$row_arr['pnpslipmain_proslipno'];
			$ttype=$row_arr['pnpslipmain_ttype'];
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$maintrid."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$a_arrsub=mysqli_num_rows($sql_arrsub);
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				
				$lotno=$row_arrsub['pnpslipsub_lotno'];
				$clotno=$row_arrsub['pnpslipsub_clotno'];
				$protyp=$row_arrsub['pnpslipsub_processtype'];
				$conqty=$row_arrsub['pnpslipsub_conqty'];
				
				$onob2=$row_arrsub['pnpslipsub_pnob'];
				$oqty2=$row_arrsub['pnpslipsub_pqty'];
				$nob12=$row_arrsub['pnpslipsub_connob'];
				$qty12=$row_arrsub['pnpslipsub_conqty'];
				$balups2=$row_arrsub['pnpslipsub_bnob'];
				$balqty2=$row_arrsub['pnpslipsub_bqty'];
	
				$whid2=$txtslwhg1;
				$binid2=$txtslbing1;
				$subbinid2=$txtslsubbg1;
				$sstage2="Condition";
				
				
				$zzz=implode(",", str_split($row_arrsub['pnpslipsub_lotno']));
				
			
				$orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
				$ycr=$zzz[2];
			
			
				$zzz=implode(",", str_split($row_arrsub['pnpslipsub_clotno']));
				$orlot2=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
			
				$cnnt=0;
				$otrid=0;
				$sql_arrsubsub=mysqli_query($link,"select * from tbl_pnpslipsubsub where pnpslipmain_id='".$maintrid."' and pnpslipsub_id='".$row_arrsub['pnpslipsub_id']."' ") or die(mysqli_error($link));
				$a_sub=mysqli_num_rows($sql_arrsubsub);
				while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
				{
				
					$onob=$row_arrsubsub['pnpslipsubsub_onob'];
					$oqty=$row_arrsubsub['pnpslipsubsub_oqty'];
					$nob1=$row_arrsubsub['pnpslipsubsub_pnob'];
					$qty1=$row_arrsubsub['pnpslipsubsub_pqty'];
					$bnob=$row_arrsubsub['pnpslipsubsub_bnob'];
					$bqty=$row_arrsubsub['pnpslipsubsub_bqty'];
					
					$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_arrsubsub['pnpslipsubsub_subbin']."' and lotldg_binid='".$row_arrsubsub['pnpslipsubsub_bin']."' and lotldg_whid='".$row_arrsubsub['pnpslipsubsub_wh']."' and lotldg_variety='".$variety."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode' order by lotldg_balqty desc") or die(mysqli_error($link));
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
	//echo "<br />";					
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
				if($srtype=="condition" || $srtype=="Condition")
				{$srtype=""; $srflg=0;}
				$sql_ins_main22="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','PROSLIPSUC', '$pid', '$arrival_date', '$clotno', '$crop', '$variety', '$whid2', '$binid2', '$subbinid2', '$onob2', '$oqty2', '$nob12', '$qty12', '$nob12', '$qty12', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlot2', '$gs2', '$resverstatus2', '$revcomment2', '$geneticpurity2', '$srtype', '$srflg', '$plantcode')";
				//exit;
				mysqli_query($link,$sql_ins_main22) or die(mysqli_error($link));
//echo "<br />";				
				$sql_itmg22="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
				mysqli_query($link,$sql_itmg22) or die(mysqli_error($link));
//echo "<br />";	
				if($pcktype=="P")
				{
					if(isset($_REQUEST['txtbalconlotno'])) { $txtbalconlotno= $_REQUEST['txtbalconlotno']; }
					if(isset($_REQUEST['txtslwhp1'])) { $txtslwhp1= $_REQUEST['txtslwhp1']; }
					if(isset($_REQUEST['txtslbinp1'])) { $txtslbinp1= $_REQUEST['txtslbinp1']; }
					if(isset($_REQUEST['txtslsubbp1'])) { $txtslsubbp1= $_REQUEST['txtslsubbp1']; }
					if(isset($_REQUEST['txtconslnobp1'])) { $txtconslnobp1= $_REQUEST['txtconslnobp1']; }
					if(isset($_REQUEST['txtconslqtyp1'])) { $txtconslqtyp1= $_REQUEST['txtconslqtyp1']; }
					if(isset($_REQUEST['txtslwhp2'])) { $txtslwhp2= $_REQUEST['txtslwhp2']; }
					if(isset($_REQUEST['txtslbinp2'])) { $txtslbinp2= $_REQUEST['txtslbinp2']; }
					if(isset($_REQUEST['txtslsubbp2'])) { $txtslsubbp2= $_REQUEST['txtslsubbp2']; }
					if(isset($_REQUEST['txtconslnobp2'])) { $txtconslnobp2= $_REQUEST['txtconslnobp2']; }
					if(isset($_REQUEST['txtconslqtyp2'])) { $txtconslqtyp2= $_REQUEST['txtconslqtyp2']; }
					
					$zzz=implode(",", str_split($txtbalconlotno));
					$orlotnc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
					
					if($txtconslqtyp1!='')	
					{		
						$sql_ins_main223="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','PROSLIPSUC', '$pid', '$arrival_date', '$txtbalconlotno', '$crop', '$variety', '$txtslwhp1', '$txtslbinp1', '$txtslsubbp1', '$onob2', '$oqty2', '$txtconslnobp1', '$txtconslqtyp1', '$txtconslnobp1', '$txtconslqtyp1', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlotnc', '$gs2', '$resverstatus2', '$revcomment2', '$geneticpurity2', '$srtype', '$srflg', '$plantcode')";
						//exit;
						mysqli_query($link,$sql_ins_main223) or die(mysqli_error($link));
		//echo "<br />";				
						$sql_itmg223="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
						mysqli_query($link,$sql_itmg223) or die(mysqli_error($link));
	//echo "<br />";				
					}
					if($txtconslqtyp2!='')	
					{		
						$sql_ins_main223="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, plantcode) values('$yearid_id','PROSLIPSUC', '$pid', '$arrival_date', '$txtbalconlotno', '$crop', '$variety', '$txtslwhp2', '$txtslbinp2', '$txtslsubbp2', '$onob2', '$oqty2', '$txtconslnobp2', '$txtconslqtyp2', '$txtconslnobp2', '$txtconslqtyp2', '$sstage2', '$sstatus2', '$moist2', '$gemp2', '$vchk2', '$got12', '$qc2', '$gotstatus2', '$qctestdate2', '$gottestdate2', '$orlotnc', '$gs2', '$resverstatus2', '$revcomment2', '$geneticpurity2', '$srtype', '$srflg', '$plantcode')";
						//exit;
						mysqli_query($link,$sql_ins_main223) or die(mysqli_error($link));
		//echo "<br />";				
						$sql_itmg223="update tbl_subbin set status='$sstage2' where sid='$subbinid2'";
						mysqli_query($link,$sql_itmg223) or die(mysqli_error($link));
	//echo "<br />";				
					}
				}
				if($srflg>0)
				{
					if($protyp=="P")
					{
						$srdt=""; $type="";
						$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub WHERE softrsub_lotno='".$orlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$tot_srsub2=mysqli_num_rows($sql_srsub2);
						$row_srsub2=mysqli_fetch_array($sql_srsub2);
						$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$tot_srsub=mysqli_num_rows($sql_srsub);
						while($row_srsub=mysqli_fetch_array($sql_srsub))
						{
							$type=$row_srsub['softrsub_srtyp'];	 
							$sql_srmain=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_srsub['softr_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_srmain=mysqli_num_rows($sql_srmain);
							$row_srmain=mysqli_fetch_array($sql_srmain);	
							$srdt=$row_srmain['softr_date'];
							
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
							$sql_srsub2=mysqli_query($link,"SELECT MAX(softrsub_id) FROM tbl_softr_sub2 WHERE softrsub_lotno='".$orlot."' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_srsub2=mysqli_num_rows($sql_srsub2);
							$row_srsub2=mysqli_fetch_array($sql_srsub2);
							$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 WHERE softrsub_lotno='".$orlot."' and softrsub_id='".$row_srsub2[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_srsub=mysqli_num_rows($sql_srsub);
							while($row_srsub=mysqli_fetch_array($sql_srsub))
							{
								$type=$row_srsub['softrsub_srtyp'];	 
								$sql_srmain=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_srsub['softr_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
								$tot_srmain=mysqli_num_rows($sql_srmain);
								$row_srmain=mysqli_fetch_array($sql_srmain);	
								$srdt=$row_srmain['softr_date'];
								
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
	
				$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearid_id."'  ORDER BY tid DESC";
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
				
				$state="P/M/G";	 
				//if($qc2=="UT")
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
						
						$sql_sub_sub123="insert into tbl_qctest(spdate, testdate, pp, moist, qc, variety, crop, gemp, srdate, qcstatus, sampleno, aflg, bflg, cflg, qcflg, gsflg, gs, stsno, qcrefno, lotno, oldlot, yearid, logid, state, trstage, sampno, plantcode) values('".$row_qc['spdate']."','".$row_qc['testdate']."','".$row_qc['pp']."','".$row_qc['moist']."','".$row_qc['qc']."','".$row_qc['variety']."','".$row_qc['crop']."','".$row_qc['gemp']."','".$row_qc['srdate']."','".$row_qc['qcstatus']."','".$ncode1."','".$row_qc['aflg']."','".$row_qc['bflg']."','".$row_qc['cflg']."','".$row_qc['qcflg']."','".$row_qc['gsflg']."','".$row_qc['gs']."','".$row_qc['stsno']."','".$row_qc['qcrefno']."','".$clotno."','".$orlot2."','$yrco','$logid', '".$row_qc['state']."', '$sstage2','".$sampno."', '$plantcode')";
					mysqli_query($link,$sql_sub_sub123) or die(mysqli_error($link));
					}
				}
			}
		}
		
	 $sql_main="update tbl_pnpslipmain set pnpslipmain_prolossupdflg=1  where pnpslipmain_id ='$maintrid'";
	 $a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	//exit;
	echo "<script>window.location='home_pronpslip_fc.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing -Transaction - Processing and Packing Slip- Preview</title>
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
winHandle=window.open('pronpslip_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	
	if(document.frmaddDepartment.packedquantity.value=="" || parseFloat(document.frmaddDepartment.packedquantity.value)<=0)
	{
		alert("Please check. Packed Qty can not be empty or Zero");
		return false;
	}	
	if(document.frmaddDepartment.txtconqty.value=="" || parseFloat(document.frmaddDepartment.txtconqty.value)<=0)
	{
		alert("Please check. Condition Seed Qty can not be empty or Zero in Processing Loss section");
		return false;
	}
	if(document.frmaddDepartment.txtconloss.value=="")
	{
		alert("Please check. Total Condition Loss Qty can not be empty");
		return false;
	}
	if(parseInt(document.frmaddDepartment.sno6.value)>0)
	{
		var cnt=0;
		for( var i=1; i<=document.frmaddDepartment.sno6.value; i++)
		{
			var txtconstloss="txtconstloss"+i;
			if(document.getElementById(txtconstloss).value!="")
			{ cnt=parseInt(cnt)+1; }
		}
		if(parseInt(cnt)<=0)
		{
			alert("Please check. Constituent Lots Total Condition Loss Qty can not be empty");
			return false;
		}
		if(parseInt(cnt)!=parseInt(document.frmaddDepartment.sno6.value))
		{
			alert("Please check. Constituent Lots Total Condition Loss Qty can not be empty");
			return false;
		}
	}
	
	if(document.frmaddDepartment.txtconslqty1.value=="")
	{
		alert("Please update Condition Seed SLOC for Packing");
		return false;
	}
	
	if(document.frmaddDepartment.pcktype.value=="")
	{
		alert("Please select Picked for Packing");
		return false;
	}
	
	if(document.frmaddDepartment.pcktype.value=="P")
	{
		if(document.frmaddDepartment.txtconslqtyp1.value=="" && document.frmaddDepartment.txtconslqtyp2.value=="")
		{
			alert("Please update SLOC for Balance Condition Seed");
			return false;
		}
		var w1=document.getElementById('txtconslqtyp1').value;
		var w2=document.getElementById('txtconslqtyp2').value;
		if(w1==""){w1=0;}
		if(w2==""){w2=0;}
		var w=parseFloat(w1)+parseFloat(w2);
		w=parseFloat(w).toFixed(3);
		document.getElementById('balcqty').value=parseFloat(document.getElementById('balcqty').value).toFixed(3);
		//alert(w1);alert(w2);alert(w);alert(document.getElementById('balcqty').value);
		if((parseFloat(document.getElementById('balcqty').value)!=parseFloat(w)))
		{
			alert("Qty not matching with Balance Condition Seed after Packing.");
			//document.getElementById(nobb).value="";
			return false;
		}
	}
	
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		var a=formPost(document.getElementById('mainform'));
		//document.frmaddDepartment.submit();	
		//alert(a);
		return true;	
	}
	else
	{
		return false;
	} 
}

function openpackdetails(subtid,tid)
{
winHandle=window.open('packdetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}



function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
}


function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','1','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','2','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}


function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtconslnob1.value!="")
		var Bagsv1=document.frmaddDepartment.txtconslnob1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtconslqty1.value!="")
		var qtyv1=document.frmaddDepartment.txtconslqty1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbgc1',slocnogood,Bagsv1,qtyv1,trid);
		
		setTimeout(function() {
			document.frmaddDepartment.txtconslnob1.value=document.frmaddDepartment.txtconnob.value;
			document.frmaddDepartment.txtconslqty1.value=document.frmaddDepartment.txtconqty.value;
			document.frmaddDepartment.txtconslnob1.readOnly=true;
			document.frmaddDepartment.txtconslnob1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.txtconslqty1.readOnly=true;
			document.frmaddDepartment.txtconslqty1.style.backgroundColor="#cccccc";
		}, 500);
		
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		document.frmaddDepartment.txtslbing2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtconslnob2.value!="")
		var Bagsv2=document.frmaddDepartment.txtconslnob2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtconslqty2.value!="")
		var qtyv2=document.frmaddDepartment.txtconslqty2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbgc2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function qtyf1(qtyval, sval)
{
	var sbbin="txtconslnob"+sval;
	var nobb="txtconslqty"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagsf1(Bags1val, sval)
{
	var sbbin="sb"+sval;
	var nobb="txtconslnob"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}

function chkpronob()
{
	if(document.frmaddDepartment.srno2.value==2)
	{
		var srno2=document.frmaddDepartment.srno2.value;
		var eqty=0;
		for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
		{
			var recqtyp="recqtyp"+i;
			eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
		}
		if(parseFloat(eqty)<=0)
		{
			alert("Picked for Processing Qty cannot be Zero or less");
			return false;
		}
	}
}

function chkproqty()
{
	var f=0;
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslnob1.value="";
		document.frmaddDepartment.txtconslqty1.value="";
		document.frmaddDepartment.picqtyp.value="";
		document.frmaddDepartment.balcnob.value="";
		document.frmaddDepartment.balcqty.value="";
		
		document.frmaddDepartment.txtslwhg1.value="";
		document.frmaddDepartment.txtslbing1.value="";
		document.frmaddDepartment.txtslsubbg1.value="";
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
		document.frmaddDepartment.txtslbing1.selectedIndex=0;
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Enter Condition Seed NoB");
		document.frmaddDepartment.txtconqty.value="";
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslnob1.value="";
		document.frmaddDepartment.txtconslqty1.value="";
		f=0;
		return false;
	}
	var srno2=document.frmaddDepartment.srno2.value;
	var eqty=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="recqtyp"+i;
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
	}
	
	if(parseFloat(document.frmaddDepartment.txtconqty.value)>parseFloat(eqty))
	{
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Processing");
		document.frmaddDepartment.txtconqty.value="";
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslnob1.value="";
		document.frmaddDepartment.txtconslqty1.value="";
		f=0;
		return false;
	}
//	alert(parseFloat(document.frmaddDepartment.txtconqty.value)); alert(parseFloat(document.frmaddDepartment.packedquantity.value));
	if(parseFloat(document.frmaddDepartment.txtconqty.value)<parseFloat(document.frmaddDepartment.packedquantity.value))
	{
		alert("Condition Seed Qty cannot be less than Total Quantity Packed");
		document.frmaddDepartment.txtconqty.value="";
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslnob1.value="";
		document.frmaddDepartment.txtconslqty1.value="";
		f=0;
		return false;
	}
	
	
}

function chkconqty()
{
	var abc=0;
	
	document.frmaddDepartment.txtconim.value="";
	document.frmaddDepartment.txtconpl.value="";
	document.frmaddDepartment.txtconloss.value="";
	document.frmaddDepartment.txtconper.value="";
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Enter Condition Seed Qty");
		document.frmaddDepartment.txtconrem.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	var srno2=document.frmaddDepartment.srno2.value;
	var eqty=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="recqtyp"+i;
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
	}
	
	if(parseFloat(document.frmaddDepartment.txtconqty.value)>parseFloat(eqty))
	{
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Processing");
		document.frmaddDepartment.txtconqty.value="";
		return false;
	}
}
function chkrm()
{
	document.frmaddDepartment.txtconpl.value="";
	document.frmaddDepartment.txtconloss.value="";
	document.frmaddDepartment.txtconper.value="";
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Enter Remnant (RM)");
		document.frmaddDepartment.txtconim.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
}

function chkim(plval)
{
	document.frmaddDepartment.txtconloss.value="";
	document.frmaddDepartment.txtconper.value="";
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Enter Inert Material (IM)");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	var tpl=parseFloat(document.frmaddDepartment.txtconrem.value)+parseFloat(document.frmaddDepartment.txtconim.value)+parseFloat(plval);
	var srno2=document.frmaddDepartment.srno2.value;
	var plper=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="recqtyp"+i;
		plper=parseFloat(plper)+parseFloat(document.getElementById(recqtyp).value);
	}

	
	//alert(tpl);
	//alert(document.frmaddDepartment.txtconqty.value);
	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.txtconqty.value);
	//alert((Math.round(totalval*1000)/1000));
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not equal to sum total of Condition Seed & Total Condition Loss");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconpl.focus();
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.txtconloss.value=tpl;
		document.frmaddDepartment.txtconloss.value=parseFloat(document.frmaddDepartment.txtconloss.value).toFixed(3);
		document.frmaddDepartment.avlqtypck.value=parseFloat(document.frmaddDepartment.txtconqty.value);
		document.frmaddDepartment.picqtyp.value=parseFloat(document.frmaddDepartment.txtconqty.value);
		var vaal=parseFloat(document.frmaddDepartment.txtconloss.value)/parseFloat(plper)*100;
		document.frmaddDepartment.txtconper.value=Math.round((vaal)*100)/100;
		document.frmaddDepartment.txtconper.value=parseFloat(document.frmaddDepartment.txtconper.value).toFixed(3);
	}
	}
}

function pcksel(pkselval)
{ //alert(pkselval);
	document.frmaddDepartment.pcktype.value="";
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		for( var i=0; i<document.frmaddDepartment.paceptyp.length; i++)
		{
			document.getElementById('paceptyp').checked=false;
		}
		document.frmaddDepartment.pcktype.value="";
		return false;
	}
	else
	{
		if(pkselval=="P")
		{
			document.getElementById('picqtyp').value="";
			document.getElementById('picqtyp').readOnly=true;
			document.getElementById('picqtyp').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').readOnly=false;
			document.getElementById('balcnob').style.backgroundColor="#ffffff";
			document.getElementById('balcnob').value="";
			document.getElementById('balcqty').readOnly=false;
			document.getElementById('balcqty').style.backgroundColor="#ffffff";
			document.getElementById('balcqty').value="";
			document.getElementById('partialpack').style.display="Block";
			
			var sprintf = (str, ...argv) => !argv.length ? str : 
			sprintf(str = str.replace(sprintf.token||"$", argv.shift()), ...argv);
			sprintf.token = "%";				
			var sltn=document.frmaddDepartment.txtplotno.value.split("");
			var cltn2=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13];
			var cl=sltn[14]+sltn[15];
			c1=parseInt(cl)+1;
			var c2 = ('00'+c1).slice(-2);
			//var c2=sprintf("%0",(parseInt(cl)+1));
//alert(c2);
			pltn=cltn2+c2;
			cltn=cltn2+c2+"C";
			
			
			if(document.frmaddDepartment.protype.value=="P")
			{
				var sltn2=document.frmaddDepartment.txtclotno.value.split("");
				var cllotn=sltn2[0]+sltn2[1]+sltn2[2]+sltn2[3]+sltn2[4]+sltn2[5]+sltn2[6]+sltn2[7]+sltn2[8]+sltn2[9]+sltn2[10]+sltn2[11]+sltn2[12]+sltn2[13]+sltn2[14]+sltn2[15];
				if(cllotn==pltn)
				{
					var cl=sltn2[14]+sltn2[15];
					c1=parseInt(cl)+1;
					var c2 = ('00'+c1).slice(-2);
					cltn=cltn2+c2+"C";
				}
				/*else
				{
					var cltn=document.frmaddDepartment.txtclotno.value;
				}*/
				document.frmaddDepartment.txtbalconlotno.value=cltn;
			}
			else
			{
				document.frmaddDepartment.txtbalconlotno.value=cltn;
			}
			//alert(pkselval);
			document.getElementById('pcktype').value=pkselval;
			//alert(document.getElementById('pcktype').value);
		}
		else
		{
			document.getElementById('picqtyp').value=document.getElementById('avlqtypck').value;
			document.getElementById('picqtyp').readOnly=true;
			document.getElementById('picqtyp').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').readOnly=true;
			document.getElementById('balcnob').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').value=0;
			document.getElementById('balcqty').readOnly=true;
			document.getElementById('balcqty').style.backgroundColor="#cccccc";
			document.getElementById('balcqty').value=0;
			document.getElementById('partialpack').style.display="none";
			var pckloss=document.getElementById('pckloss').value;
			var ccloss=document.getElementById('ccloss').value;
			if(pckloss=="")pckloss=0;
			if(ccloss=="")ccloss=0;
			document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(pckloss)+parseFloat(ccloss))
			var sltn=document.frmaddDepartment.txtclotno.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"C";
			document.frmaddDepartment.txtbalconlotno.value=cltn;
		}
		document.getElementById('pcktype').value=pkselval;
		
	
	}
//alert(document.getElementById('pcktype').value);
}



function chkconstqty(snoval)
{
	var abc=0;
	var txtconstrem="txtconstrem"+snoval;
	var txtconstim="txtconstim"+snoval;
	var txtconstpl="txtconstpl"+snoval;
	var txtconstloss="txtconstloss"+snoval;
	var txtconstper="txtconstper"+snoval;
	
	document.getElementById(txtconstim).value="";
	document.getElementById(txtconstpl).value="";
	document.getElementById(txtconstloss).value="";
	document.getElementById(txtconstper).value="";
	
	var sno6=document.frmaddDepartment.sno6.value;
	var eqty=0;
	for( var i=1; i<=document.frmaddDepartment.sno6.value; i++)
	{
		var recqtyp="txtconstloss"+i;
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
	}
	
	if(parseFloat(eqty)>parseFloat(document.frmaddDepartment.txtconloss.value))
	{
		alert("Total Condition Loss of Constituent Lots cannot be more than Total Condition Loss of Blended Lot");
		document.getElementById(txtconstrem).value="";
		return false;
	}
}
function chkconstrm(snoval)
{
	var txtconstrem="txtconstrem"+snoval;
	var txtconstim="txtconstim"+snoval;
	var txtconstpl="txtconstpl"+snoval;
	var txtconstloss="txtconstloss"+snoval;
	var txtconstper="txtconstper"+snoval;
	
	document.getElementById(txtconstpl).value="";
	document.getElementById(txtconstloss).value="";
	document.getElementById(txtconstper).value="";
	
	if(document.getElementById(txtconstrem).value=="")
	{
		alert("Enter Remnant (RM)");
		document.getElementById(txtconstpl).value="";
		document.getElementById(txtconstloss).value="";
		document.getElementById(txtconstper).value="";
		return false;
	}
}

function chkconstim(plval,snoval)
{
	
	var txtconstrem="txtconstrem"+snoval;
	var txtconstim="txtconstim"+snoval;
	var txtconstpl="txtconstpl"+snoval;
	var txtconstloss="txtconstloss"+snoval;
	var txtconstper="txtconstper"+snoval;
	
	document.getElementById(txtconstloss).value="";
	document.getElementById(txtconstper).value="";
	
	if(document.getElementById(txtconstim).value=="")
	{
		alert("Enter Inert Material (IM)");
		document.getElementById(txtconstpl).value="";
		document.getElementById(txtconstloss).value="";
		document.getElementById(txtconstper).value="";
		return false;
	}
	else
	{
		var tpl=parseFloat(document.getElementById(txtconstrem).value)+parseFloat(document.getElementById(txtconstim).value)+parseFloat(plval);
		var sno6=document.frmaddDepartment.sno6.value;
		var eqty=0;
		for( var i=1; i<=document.frmaddDepartment.sno6.value; i++)
		{
			var recqtyp="txtconstloss"+i;
			eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
		}
		
		if(parseFloat(eqty)>parseFloat(document.frmaddDepartment.txtconloss.value))
		{
			alert("Total Condition Loss of Constituent Lots cannot be more than Total Condition Loss of Blended Lot");
			document.getElementById(txtconstrem).value="";
			return false;
		}
		else
		{
			var srno2=document.frmaddDepartment.srno2.value;
			var plper=0;
			for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
			{
				var recqtyp="recqtyp"+i;
				plper=parseFloat(plper)+parseFloat(document.getElementById(recqtyp).value);
			}
			document.getElementById(txtconstloss).value=tpl;
			document.getElementById(txtconstloss).value=parseFloat(document.getElementById(txtconstloss).value).toFixed(3);
			var vaal=parseFloat(document.getElementById(txtconstloss).value)/parseFloat(plper)*100;
			document.getElementById(txtconstper).value=Math.round((vaal)*100)/100;
		}
	}
}


function whp1(wh1val)
{ //alert(wh1val);
	if(document.getElementById('picqtyp').value=="")
	{
		alert("Enter Picked for Packing Qty");
		return false;
	}
	else if(document.getElementById('balcnob').value=="")
	{
		alert("Enter Picked for Packing Qty");
		return false;
	}
	else
	{
		showUser(wh1val,'binp1','wh','binp1','1','','','');
	}	
}

function whp2(wh2val)
{   
	showUser(wh2val,'binp2','wh','binp2','2','','','');
}


function binp1(bin1val)
{
	if(document.frmaddDepartment.txtslwhp1.value!="")
	{
		showUser(bin1val,'sbinp1','bin','txtslsubbp1','1','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function binp2(bin2val)
{
	if(document.frmaddDepartment.txtslwhp2.value!="")
	{
		showUser(bin2val,'sbinp2','bin','txtslsubbp2','2','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}


function subbinp1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbinp1.value!="")
	{	//alert("subbin");
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtconslnobp1.value!="")
		var Bagsv1=document.frmaddDepartment.txtconslnobp1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtconslqtyp1.value!="")
		var qtyv1=document.frmaddDepartment.txtconslqtyp1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrowp1','subbin',itemv,'txtslsubbp1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbinp1.focus();
	}
}

function subbinp2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbinp2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhp1.value+document.frmaddDepartment.txtslbinp1.value+document.frmaddDepartment.txtslsubbp1.value;
		var w2=document.frmaddDepartment.txtslwhp2.value+document.frmaddDepartment.txtslbinp2.value+document.frmaddDepartment.txtslsubbp2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('txtslsubbp2').selectedIndex=0;
		document.frmaddDepartment.txtslbinp2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbp1.value!="")
		
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtconslnobp2.value!="")
		var Bagsv2=document.frmaddDepartment.txtconslnobp2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtconslqtyp2.value!="")
		var qtyv2=document.frmaddDepartment.txtconslqtyp2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrowp2','subbin',itemv,'txtslsubbp2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbinp2.focus();
	}
}

function Bagschkp1(Bags1val, sval)
{
	var sbbin="txtslsubbp1";
	var nobb="txtconslnobp1";
	//alert(sbbin);
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}

function qtychkp1(qtyval, sval)
{
	var sbbin="txtconslnobp1";
	var nobb="txtconslqtyp1";
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
		var w1=document.getElementById('txtconslqtyp1').value;
		var w2=document.getElementById('txtconslqtyp2').value;
		if(w1==""){w1=0;}
		if(w2==""){w2=0;}
		var w=parseFloat(w1)+parseFloat(w2);
		/*if(parseFloat(document.getElementById('balcqty').value)>parseFloat(w))
		{
			alert("Qty can not matching with Balance Condition Seed after Packing.");
			document.getElementById(nobb).value="";
		}*/
		document.getElementById('balcqty').value=parseFloat(document.getElementById('balcqty').value).toFixed(3);
		w=parseFloat(w).toFixed(3);
		if(w1>0 && w2>0 && (parseFloat(document.getElementById('balcqty').value)!=parseFloat(w)))
		{
			alert("Qty can not matching with Balance Condition Seed after Packing.");
			document.getElementById(nobb).value="";
		}
	}
}


function qtychkp2(qtyval, sval)
{
	var sbbin="txtconslnobp2";
	var nobb="txtconslqtyp2";
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
		var w1=document.getElementById('txtconslqtyp1').value;
		var w2=document.getElementById('txtconslqtyp2').value;
		if(w1==""){w1=0;}
		if(w2==""){w2=0;}
		var w=parseFloat(w1)+parseFloat(w2);
		if(parseFloat(document.getElementById('balcqty').value)!=parseFloat(w))
		{
			alert("Qty can not matching with Balance Condition Seed after Packing.");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagschkp2(Bags1val, sval)
{
	var sbbin="txtslsubbp2";
	var nobb="txtconslnobp2";
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}

function isNumberKey(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}
	  
function Bagschk1(qtyval1,srno)
{
	var sbin="txtconslqty1";
	var srno2=document.frmaddDepartment.srno2.value;
	var eqty=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="txtextnob"+i;
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
	}
	if(parseFloat(qtyval1)>parseFloat(eqty))
	{
		alert("NoB entered for Packing can be Equal to or Less than Existing NoB in Bin");
		return false;
	}
	
}

function qtychk1(qtyval1,srno)
{
	var actnob="txtconslqty1";
	var sbin="txtconslnob1";
	var srno2=document.frmaddDepartment.srno2.value;
	var eqty=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="txtextqty"+i;
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
	} 
	if(parseFloat(qtyval1)>parseFloat(eqty))
	{
		alert("Qty entered for Packing can be Equal to or Less than Existing Qty in Bin");
		return false;
	}
	
}


function pfpchk(pfpval)
{
	document.getElementById('balcqty').value=parseFloat(document.getElementById('avlqtypck').value)-parseFloat(pfpval);
	if(document.getElementById('balcqty').value<=0)
	{
		document.getElementById('balcqty').value=0;
		document.getElementById('balcnob').value=0;
	}
}

function chkbalnob(balqval)
{
	var pckloss=document.getElementById('pckloss').value;
	var ccloss=document.getElementById('ccloss').value;
	if(pckloss=="")pckloss=0;
	if(ccloss=="")ccloss=0;
	document.frmaddDepartment.txtconslnobp1.value='';
	document.frmaddDepartment.txtconslqtyp1.value='';
	document.frmaddDepartment.txtconslnobp2.value='';
	document.frmaddDepartment.txtconslqtyp2.value='';
	//alert(parseFloat(balqval)); alert(parseFloat(document.frmaddDepartment.txtconqty.value)); alert(parseFloat(document.frmaddDepartment.packedquantity.value));
	/*if(parseFloat(balqval)<parseFloat(document.frmaddDepartment.packedquantity.value))
	{
		alert("Qty entered for Packing can be Equal to or more than Packed Qty");
		document.getElementById('picqtyp').value='';
		document.frmaddDepartment.txtconslnobp1.value='';
		document.frmaddDepartment.txtconslqtyp1.value='';
		document.frmaddDepartment.txtconslnobp2.value='';
		document.frmaddDepartment.txtconslqtyp2.value='';
		document.frmaddDepartment.balcqty.value='';
		document.frmaddDepartment.balpck.value=0;
		return false;
	}
	else*/ if(parseFloat(balqval)>parseFloat(document.frmaddDepartment.txtconqty.value))
	{
		alert("Qty entered for Packing can be Equal to or less than Condition Qty");
		document.getElementById('picqtyp').value='';
		document.frmaddDepartment.txtconslnobp1.value='';
		document.frmaddDepartment.txtconslqtyp1.value='';
		document.frmaddDepartment.txtconslnobp2.value='';
		document.frmaddDepartment.txtconslqtyp2.value='';
		document.frmaddDepartment.balcqty.value='';
		document.frmaddDepartment.balpck.value=0;
		return false;
	}
	else
	{
		//alert(parseFloat(document.frmaddDepartment.txtconqty.value));
		//alert(parseFloat(balqval)); alert(parseFloat(pckloss)); alert(parseFloat(ccloss));
		var picqtyp=parseFloat(document.frmaddDepartment.txtconqty.value)-(parseFloat(balqval)+parseFloat(pckloss)+parseFloat(ccloss));
		if(parseFloat(picqtyp)<parseFloat(document.frmaddDepartment.packedquantity.value))
		{
			alert("Qty entered for Balance Condition can be Equal to or more than Packed Qty");
			document.getElementById('picqtyp').value='';
			document.frmaddDepartment.txtconslnobp1.value='';
			document.frmaddDepartment.txtconslqtyp1.value='';
			document.frmaddDepartment.txtconslnobp2.value='';
			document.frmaddDepartment.txtconslqtyp2.value='';
			document.frmaddDepartment.balcqty.value='';
			document.frmaddDepartment.balpck.value=0;
			return false;
		}
		else
		{
			document.getElementById('picqtyp').value=parseFloat(picqtyp);
			document.getElementById('picqtyp').value=parseFloat(document.getElementById('picqtyp').value).toFixed(3);
		}
	}
}


function oqtychk1(qtyval1,srno)
{
	var balnob="txtbalnobp"+srno;
	var balqty="txtbalqtyp"+srno;
	var srno2=document.frmaddDepartment.srno2.value;
	var eqty=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="txtextnob"+i;
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
	}
	if(parseFloat(qtyval1)>parseFloat(eqty))
	{
		alert("NoB entered for Packing can be Equal to or Less than Existing NoB in Bin");
		return false;
	}
	else
	{
		document.getElementById(balnob).value=parseFloat(eqty)-parseFloat(qtyval1);
	}
}
	  
function oBagschk1(qtyval1,srno)
{
	var balnob="txtbalnobp"+srno;
	var balqty="txtbalqtyp"+srno;
	var recqty="recqtyp"+srno;
	var extbalqty="extbalqty"+srno;
	
	var srno2=document.frmaddDepartment.srno2.value;
	var eqty=0; var pqty=0;
	for( var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var recqtyp="txtextqty"+i;
		var recqt="recqtyp"+i;
		var pq=document.getElementById(recqt).value;
		if(pq=="" || pq=="NaN" || pq<=0){pq=0;}
		eqty=parseFloat(eqty)+parseFloat(document.getElementById(recqtyp).value);
		pqty=parseFloat(pqty)+parseFloat(pq);
	} 
	if(parseFloat(qtyval1)>parseFloat(document.getElementById(recqty).value))
	{
		alert("Qty entered for Processing can not be more than Existing Qty in Bin");
		document.getElementById(recqty).value='';
		document.getElementById(balqty).value='';
		document.frmaddDepartment.txtconqty.value='';
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslqty1.value='';
		return false;
	}
	else if(parseFloat(qtyval1)>parseFloat(eqty))
	{
		alert("Qty entered for Processing can be Equal to or Less than Total Existing Qty in Bins");
		document.getElementById(recqty).value='';
		document.getElementById(balqty).value='';
		document.frmaddDepartment.txtconqty.value='';
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslqty1.value='';
		return false;
	}
	else if(parseFloat(pqty)<parseFloat(document.frmaddDepartment.packedquantity.value))
	{
		alert("Total Qty entered for Processing can be Equal to or more than Packed Qty");
		document.getElementById(recqty).value='';
		document.getElementById(balqty).value='';
		document.frmaddDepartment.txtconqty.value='';
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslqty1.value='';
		return false;
	}
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(extbalqty).value))
	{
		alert("Qty entered for Processing can not more than previously picked for processing Qty");
		document.getElementById(recqty).value='';
		document.getElementById(balqty).value='';
		document.frmaddDepartment.txtconqty.value='';
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslqty1.value='';
		return false;
	}
	else
	{
		var recqtyp="txtextqty"+srno;
		eqty=parseFloat(document.getElementById(recqtyp).value);
		document.getElementById(balqty).value=(parseFloat(eqty)-parseFloat(qtyval1)).toFixed(3);
		document.frmaddDepartment.txtconqty.value='';
		document.frmaddDepartment.txtconrem.value='';
		document.frmaddDepartment.txtconim.value='';
		document.frmaddDepartment.txtconpl.value='';
		document.frmaddDepartment.txtconloss.value='';
		document.frmaddDepartment.txtconper.value='';
		document.frmaddDepartment.txtconslqty1.value='';
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Processing and Packing slip - Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
   <?php
   $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

	$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['pnpslipmain_mtndate'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$tdate3=$row_tbl['pnpslipmain_doindent'];
	$tyear3=substr($tdate3,0,4);
	$tmonth3=substr($tdate3,5,2);
	$tday3=substr($tdate3,8,2);
	$tdate3=$tday3."-".$tmonth3."-".$tyear3;
?>
 	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="Hidden" name="maintrid" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="970"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Processing Slip Preview</td>
</tr>
 <tr class="Light" height="30">
<td width="226" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="381"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="146" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="207" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="226" align="right" valign="middle" class="smalltblheading">&nbsp;Date of MTN&nbsp;</td>
<td width="381" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="mtndate" id="mtndate" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="146" align="right"  valign="middle" class="smalltblheading">MTN No.&nbsp;</td>
    <td width="207" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="mtnno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_mtnno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 <tr class="Light" height="30">
<td width="226" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Indent&nbsp;</td>
<td width="381" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="indentdate" id="indentdate" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate3;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="146" align="right"  valign="middle" class="smalltblheading">Indent No.&nbsp;</td>
    <td width="207" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="indentno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_indentsrn'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>




<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="226" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="381" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="146" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="207" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
</tr>	
<tr class="Dark" height="30">

	<td width="226" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="381" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
	</tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_trdetails_sub=mysqli_fetch_array($sql_tbl_sub);
$subtid=0; $txtremarks=''; $blendlot='no'; $ltno='';

$zz=str_split($row_trdetails_sub['pnpslipsub_lotno']);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
if($zz[2]=="9"){ $blendlot="yes"; }

?>

<?php
	//echo "select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$a."'  ";
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
  $tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
 $nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
 while($row_issue=mysqli_fetch_array($lotqry))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
	$nob=$nob+$row_issuetbl['lotldg_balbags']; 
	$qty=$qty+$row_issuetbl['lotldg_balqty'];
	$qc=$row_issuetbl['lotldg_qc'];
	if($qc=="OK")
	{
		$trdate=$row_issuetbl['lotldg_qctestdate'];
		$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		$qcdttype="DOT";
	}
//else
{
	$zz=str_split($row_trdetails_sub['pnpslipsub_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	//if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";
if($qcdot1=="00-00-0000" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="00-00-0000" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

$tdt="";
$sql_qcs=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='$ltno' and qcstatus='OK' order by tid desc Limit 0,2") or die(mysqli_error($link));
if($tot_qcs=mysqli_num_rows($sql_qcs)>=2)
{
	while($row_qcs=mysqli_fetch_array($sql_qcs))
	{
		if($tdt!="")
		$tdt=$tdt.",".$row_qcs['testdate'];
		else
		$tdt=$row_qcs['testdate'];
	}
}
$tdt1=""; $tdt2="";

$tdt=explode(",",$tdt);
$tdt1=$tdt[0];
$tdt2=$tdt[1];

if($qcdot1!="")
{
	$crdate=date("d-m-Y");
	$now = strtotime($qcdot1); // or your date as well
	$your_date = strtotime($crdate);
	$datediff2 = (($your_date - $now)/(60*60*24));
}
else
$datediff2 = 0;
//echo $qcdot2;
if($datediff2>15)	
{
	$qcdot2="";
}
else
{
	if($tdt2!="")
	{
		if($qcdot2!="" && $qcdot1!="")
		{
			$tdte2=explode("-",$qcdot2);
			$m=$tdte2[1];
			$de=$tdte2[0];
			$y=$tdte2[2];
		  	$tdte2=$y."-".$m."-".$de;
			
			$start_ts = strtotime($tdt2);
			$end_ts = strtotime($tdt1);
			$user_ts = strtotime($tdte2);
			
			//if((($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			if((($user_ts <= $start_ts) || ($user_ts >= $end_ts)))
			//if(!(($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			{
				$qcdot2="";
			}
		}
	}
}
if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";$dp4="";$dp5="";$dp6="";
if($qcdot1!="")
{
	$trdate2=explode("-",$qcdot1);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
if($qcdot2!="")
{
	$trdate2=explode("-",$qcdot2);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp4=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp4="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp5=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp5="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp6=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp6="";}
}	
?>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Picked for Processing</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td width="111" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="70" align="center" valign="middle" class="smalltblheading" >Total NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="81" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<td width="139" align="center" valign="middle" class="smalltblheading">Process Entire/Partial</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >Processed Lot No.</td>
    <!--<td width="112" align="center" valign="middle" class="smalltblheading">Qty</td>-->
  </tr>

  <tr class="Light" height="25">

    <td width="111" align="center" valign="middle" class="smalltblheading"><?php echo $row_trdetails_sub['pnpslipsub_lotno'];?>
    <input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $nob;?>
    <input type="hidden" name="txtonob" value="<?php echo $nob;?>" /></td>
    <td width="78" align="center" valign="middle" class="smalltblheading"><?php echo $qty;?>
    <input type="hidden" name="txtoqty" value="<?php echo $qty;?>" /></td>
	<td width="84" align="center" valign="middle" class="smalltblheading"><?php echo $qc;?>
    <input type="hidden" name="qcstatus" value="<?php echo $qc;?>" /></td>
	<td width="81" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot1;?><input type="hidden" name="qcdot1" value="<?php echo $qcdot1;?>" /></td>
	<td width="84" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot2;?><input type="hidden" name="qcdot2" value="<?php echo $qcdot2;?>" />
    <input type="hidden" name="qctestdate" value="<?php if($qcdot1!="") echo $qcdot1; else if($qcdot1=="" && $qcdot2!="") echo $qcdot2; else echo "";?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="dp4" value="<?php echo $dp4;?>" /><input type="hidden" name="dp5" value="<?php echo $dp5;?>" /><input type="hidden" name="dp6" value="<?php echo $dp6;?>" /><input type="hidden" name="qcdttype" value="<?php if($qcdot1!="") echo "DoT"; else if($qcdot1=="" && $qcdot2!="") echo "DoSF"; else ""; ?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" >
      <?php if($qcdot1=="" && $qcdot2==""){ ?>
      <option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
      <?php }	?>
      <?php if($qcdot1!="" || $qcdot2!=""){ ?>
      <option value="DoT" <?php if($qcdot1!="") echo "selected"; ?> >DoT</option>
      <option value="DoSF" <?php if($qcdot1=="" && $qcdot2!="") echo "selected"; ?> >DoSF</option>
      <?php }	?>
    </select></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_trdetails_sub['pnpslipsub_processtype']; ?></td>
  <td width="163" align="center" valign="middle" class="smalltblheading" id="cltno" ><input type="text" name="txtclotno" id="txtclotno" class="smalltbltext" value="<?php echo $row_trdetails_sub['pnpslipsub_clotno']; ?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
    <!-- <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="txtqty" class="smalltbltext" value="" size="8" /></td>-->
  </tr> <input name="protype" value="<?php echo $row_trdetails_sub['pnpslipsub_processtype']; ?>" type="hidden"> 
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Processing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Processing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;

$tdate44=$row_tbl['pnpslipsetup_date'];
$tyear44=substr($tdate44,0,4);
$tmonth44=substr($tdate44,5,2);
$tday44=substr($tdate44,8,2);
$tdate44=$tday44."-".$tmonth44."-".$tyear44;

$tdate4=$row_trdetails_sub['pnpslipsub_valupto'];
$tyear4=substr($tdate4,0,4);
$tmonth4=substr($tdate4,5,2);
$tday4=substr($tdate4,8,2);
$tdate4=$tday4."-".$tmonth4."-".$tyear4;

$crdate=date("d-m-Y");
$now = strtotime($tdate44); // or your date as well
$your_date = strtotime($tdate4);
$datediffn = (($your_date - $now)/(60*60*24));
$datediffn = round($datediffn);

$sql_pnpsubsub=mysqli_query($link,"select * from tbl_pnpslipsubsub where pnpslipsub_id='".$row_trdetails_sub['pnpslipsub_id']."' and pnpslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."' and pnpslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and pnpslipsubsub_wh='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_pnpsubsub=mysqli_fetch_array($sql_pnpsubsub);

?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><?php if($row_trdetails_sub['pnpslipsub_processtype']=="P" && $row_trdetails_sub['pnpslipsub_packtype']=="E") { echo "";?><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" size="7" class="smalltbltext" tabindex="" type="text" maxlength="7" onkeypress="return isNumberKey1(event)"   onchange="oqtychk1(this.value,<?php echo $srno2?>);" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pnob']; ?>"  />&nbsp;<?php } else { echo $row_pnpsubsub['pnpslipsubsub_pnob']; ?><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" size="7" class="smalltbltext" tabindex="" type="hidden" maxlength="7" onkeypress="return isNumberKey1(event)"   onchange="oqtychk1(this.value,<?php echo $srno2?>);" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pnob']; ?>"  />&nbsp;<?php } ?></td>

  <td  align="center"  valign="middle" class="smalltbltext"><?php if($row_trdetails_sub['pnpslipsub_processtype']=="P" && $row_trdetails_sub['pnpslipsub_packtype']=="E") { echo "";?><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onchange="oBagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pqty']; ?>" />&nbsp;<?php } else { echo $row_pnpsubsub['pnpslipsubsub_pqty']; ?><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true" onchange="oBagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pqty']; ?>" />&nbsp;<?php } ?><input type="hidden" name="extbalqty<?php echo $srno2?>" id="extbalqty<?php echo $srno2?>" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pqty']?>" /></td>
  
      <td align="center"  valign="middle" class="smalltbltext"><?php if($row_trdetails_sub['pnpslipsub_processtype']=="P" && $row_trdetails_sub['pnpslipsub_packtype']=="E") { echo "";?><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_pnpsubsub['pnpslipsubsub_bnob']; ?>" /><?php } else {echo $row_pnpsubsub['pnpslipsubsub_bnob']; ?><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="hidden" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_pnpsubsub['pnpslipsubsub_bnob']; ?>" /><?php } ?></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><?php if($row_trdetails_sub['pnpslipsub_processtype']=="P" && $row_trdetails_sub['pnpslipsub_packtype']=="E") { ?><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_pnpsubsub['pnpslipsubsub_bqty']; ?>" /><?php } else { echo $row_pnpsubsub['pnpslipsubsub_bqty']; ?><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_pnpsubsub['pnpslipsubsub_bqty']; ?>" /><?php } ?></td>
  </tr>
 <?php
  }
}
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
 
</table>
<br />


<?php
$arrival_id;
$sql_tbl_sub23=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."' ") or die(mysqli_error($link));
$subtbltot23=mysqli_num_rows($sql_tbl_sub23);
$subtid=0; $packedquantity=0;
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Pack Details</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
            <td width="18" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="63" align="center" rowspan="2" valign="middle" class="smalltblheading"> Lot No.</td>
	 <td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">Pack E/P</td>
    <td width="49" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty for Packing</td>
	 <td width="38" rowspan="2" align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	 <td align="center" rowspan="2" valign="middle" class="smalltblheading">CC</td>
     <td width="47"  rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	 <td width="47"  rowspan="2" align="center" valign="middle" class="smalltblheading">Total Gross Wt.</td>
	 	 <td width="72"  rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
<td width="48" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
		  <td width="72" rowspan="2" align="center" valign="middle" class="smalltblheading">Label Nos.</td>	 
		   <td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of MP</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">Validity Upto</td>
	<td align="center" valign="middle" class="smalltblheading">PSW SLOC</td>
    </tr>
   <tr class="tblsubtitle">
	  <td width="262" align="center" valign="middle" class="smalltblheading">SLOC | MP | Loose Pchs | Total Qty</td>
  </tr>
  <?php
 
$srno=1; 
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub23))
{
//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; $txtremarks=$row_tbl_sub['pnpslipsub_remarks'];
	$sql_barcode3=mysqli_query($link,"Select distinct pnpslipbar_subbinid from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
	$tot_barcode3=mysqli_num_rows($sql_barcode3);
	while($row_barcode3=mysqli_fetch_array($sql_barcode3))
	{
		$nopmpcs=0; $noppchs=0; $noptpchs=0; $noptqtys=0;
		 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1=""; $totgrosswt=0;
		 
		$sql_barcode23=mysqli_query($link,"Select * from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipsub_id='".$row_tbl_sub['pnpslipsub_id']."' and pnpslipmain_id='".$arrival_id."' ") or die(mysqli_error($link));
		$tot_barcode23=mysqli_num_rows($sql_barcode23);
		while($row_barcode23=mysqli_fetch_array($sql_barcode23))
		{
			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_barcode23['pnpslipbar_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
			
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_barcode23['pnpslipbar_binid']."' and whid='".$row_barcode23['pnpslipbar_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
			
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_barcode23['pnpslipbar_subbinid']."' and binid='".$row_barcode23['pnpslipbar_binid']."' and whid='".$row_barcode23['pnpslipbar_whid']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
			
			$bar_ups=$row_barcode23['pnpslipbar_ups'];
			$bar_nop=$row_barcode23['pnpslipbar_nop'];
			$bar_netweight=$row_barcode23['pnpslipbar_wtmp'];
			
			$totgrosswt=$totgrosswt+$row_barcode23['pnpslipbar_grosswt'];
			$nopmpcs=$nopmpcs+1;
			$noppchs=$bar_nop; 
			$noptpchs=$noppchs; 
			$noptqtys=$noptqtys+$bar_netweight;
		}
		
		$sql_ups=mysqli_query($link,"select * from tblups where CONCAT(ups,' ',wt)='".$bar_ups."'") or die(mysqli_error($link));
		$row_ups=mysqli_fetch_array($sql_ups);
		$totslqty=($row_ups['uom']*$noppchs);
		$noptqtys=$noptqtys+$totslqty;
	
		$diq=explode(".",$noptqtys);
		if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$noptqtys;}
		
		if($sloc!=""){
		$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nopmpcs." | ".$noppchs." | ".$noptqtys;}
		else{
		$sloc=$wareh.$binn.$subbinn." | ".$nopmpcs." | ".$noppchs." | ".$noptqtys;}
		
	}	
	$tdate4=$row_tbl_sub['pnpslipsub_valupto'];
	$tyear4=substr($tdate4,0,4);
	$tmonth4=substr($tdate4,5,2);
	$tday4=substr($tdate4,8,2);
	$tdate4=$tday4."-".$tmonth4."-".$tyear4;
	
/*$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}*/
$tot_barcnomp=0;
$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);

$packedquantity=$row_tbl_sub['pnpslipsub_pickpqty'];

$upsize=explode(" ", $row_tbl_sub['pnpslipsub_ups']);
	
if($upsize[1]=="Gms")
{ 
	$ptp=(1000/$upsize[0]);
	$ptp1=($upsize[0]/1000);
}
else
{
	$ptp=$upsize[0];
	$ptp1=$upsize[0];
}
//echo $ptp."  =>  ".$ptp1."  -  ";
if($upsize[1]=="Gms")
{
	$mmmpt=$ptp*$row_tbl_sub['pnpslipsub_wtmp'];
}
else
{
	$mmmpt=$row_tbl_sub['pnpslipsub_wtmp']/$ptp;
}
$totpackqty=$noptqtys;
$totpouches=$nopmpcs*$mmmpt;
?>
  <tr class="Light" height="20">
    <td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_plotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packtype'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_pickpqty'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipsub_packloss'];?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_packcc'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $totpackqty;?><input type="hidden" name="packedquantity" id="packedquantity" value="<?php echo $totpackqty;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgrosswt;?><input type="hidden" name="totalgrossweight" id="totalgrossweight" value="<?php echo $totgrosswt;?>" /></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_ups'];?></td>
	<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $totpouches;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_slabelno']." -- ".$row_tbl_sub['pnpslipsub_elabelno'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $nopmpcs;?></td>
	<td width="53" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_convtomp']=="Yes") echo $row_tbl_sub['pnpslipsub_pnop']; else echo $row_tbl_sub['pnpslipsub_nop'];?></td>
	<td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $nopmpcs;?></td>
	<td width="58" align="center" valign="middle" class="smalltbltext"><?php echo $tdate4;?></td>
	<td width="262" align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
        </tr>

<?php
$srno++;
}
}
?>
</table>
<br />



<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Processing Details</td>
  </tr>
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Condition Seed</td>
    <td width="180" rowspan="2" align="center" valign="middle" class="smalltblheading">Remnant (RM)</td>
	<td width="237" rowspan="2" align="center" valign="middle" class="smalltblheading">Inert Material (IM)</td>
    <td width="237" rowspan="2" align="center" valign="middle" class="smalltblheading">Processing Loss (PL)</td>
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Total Cond. Loss</td>
  </tr>
  <tr class="tblsubtitle" >
    <td align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="ce	nter" valign="middle" class="smalltblheading">Qty</td>
    <td width="121" align="center" valign="middle" class="smalltblheading" >Qty</td>
    <td width="112" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>

  <tr class="Light" height="25">
    <td width="86" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconnob" class="smalltbltext" value="" size="8" onchange="chkpronob()" /></td>
    <td width="100" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconqty" class="smalltbltext" value="" size="8" onchange="chkproqty()" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconrem" class="smalltbltext" value="" size="8" onchange="chkconqty()" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconim" class="smalltbltext" value="" size="8" onchange="chkrm()" /></td>
    <td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconpl" class="smalltbltext" value="" size="8" onchange="chkim(this.value)" /></td>
    <td width="121" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtconloss" class="smalltbltext" value="" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconper" class="smalltbltext" value="" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
  </tr>
</table>
<br />
<?php 
//echo $row_tbl['pnpslipmain_stage']."  =  ".$blendlot;
$sno6=0;
if($row_tbl['pnpslipmain_stage']=="Raw" && $blendlot=="yes")
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Constituent Lots Details</td>
  </tr>
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="136" rowspan="2" align="center" valign="middle" class="smalltblheading">Remnant (RM)</td>
	<td width="135" rowspan="2" align="center" valign="middle" class="smalltblheading">Inert Material (IM)</td>
    <td width="128" rowspan="2" align="center" valign="middle" class="smalltblheading">Processing Loss (PL)</td>
    <td colspan="2" align="center" valign="middle" class="smalltblheading" >Total Cond. Loss</td>
  </tr>
  <tr class="tblsubtitle" >
    <td width="98" align="center" valign="middle" class="smalltblheading" >Qty</td>
    <td width="95" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>
<?php 
//echo "SELECT blends_lotno from tbl_blends where blends_orlot='".$ltno."'  order by blends_lotno Asc";
$qry_blendlots=mysqli_query($link,"SELECT blends_lotno FROM tbl_blends where blends_orlot='".$ltno."'  order by blends_lotno Asc"); 
while($row_blendlots = mysqli_fetch_array($qry_blendlots))
{
$sno6=$sno6+1;
?>
  <tr class="Light" height="25">
    <td width="152" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconstlot<?php echo $sno6;?>" id="txtconstlot<?php echo $sno6;?>" class="smalltbltext" value="<?php echo $row_blendlots['blends_lotno'];?>" size="18" readonly="true" style="background-color:#CCCCCC"  /></td>
	
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconstrem<?php echo $sno6;?>" id="txtconstrem<?php echo $sno6;?>" class="smalltbltext" value="" size="8" onchange="chkconstqty(<?php echo $sno6;?>)" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconstim<?php echo $sno6;?>" id="txtconstim<?php echo $sno6;?>" class="smalltbltext" value="" size="8" onchange="chkconstrm(<?php echo $sno6;?>)" /></td>
    <td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconstpl<?php echo $sno6;?>" id="txtconstpl<?php echo $sno6;?>" class="smalltbltext" value="" size="8" onchange="chkconstim(this.value,<?php echo $sno6;?>)" /></td>
    <td width="98" align="center" valign="middle" class="smalltblheading" ><input type="text" name="txtconstloss<?php echo $sno6;?>" id="txtconstloss<?php echo $sno6;?>" class="smalltbltext" value="" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="95" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtconstper<?php echo $sno6;?>" id="txtconstper<?php echo $sno6;?>" class="smalltbltext" value="" size="8" readonly="true" style="background-color:#CCCCCC" /></td>
  </tr>
<?php
}
?>  
</table>

<?php
}
?>
<input type="hidden" name="sno6" value="<?php echo $sno6;?>" />
<br />


<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Updated SLOC for Condition Seed</td>
  </tr>
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Sub Bin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>

  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob1" id="txtconslnob1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty1" id="txtconslqty1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,1);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
</table><br />

<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="100" maxlength="100" ></td>
</tr>
</table>-->
<br />

<?php
$oqt=$row_trdetails_sub['pnpslipsub_pqty']-$packedquantity;
$oqtydiffper=($oqt/$row_trdetails_sub['pnpslipsub_pqty'])*100;

$zzz=implode(",", str_split($row_trdetails_sub['pnpslipsub_plotno']));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
//echo $a;
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
$abc2=$zzz[30];
if($abc2<$zzz[30]){$abc2=$zzz[30];}
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."C";
$abc240=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."P";

?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Picked for Packing Details</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="165" align="center" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="220" align="center" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial&nbsp;</td>
<td width="156" align="center" valign="middle" class="tblheading">Packed Lot No.&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $row_trdetails_sub['pnpslipsub_valperiod'];?>
  <!--<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="9" <?php //if($row_trdetails_sub['pnpslipsub_valperiod']=="9") {echo "Selected";}?> >9</option>
<option value="6" <?php //if($row_trdetails_sub['pnpslipsub_valperiod']=="6") {echo "Selected";}?> >6</option>
<option value="3" <?php //if($row_trdetails_sub['pnpslipsub_valperiod']=="3") {echo "Selected";}?> >3</option>
</select>-->&nbsp;Months</td>
<td width="165" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $tdate4;?>
  <input type="hidden" class="tbltext" name="validityupto" id="validityupto" value="<?php echo $tdate4;?>" size="15" readonly="true" style="background-color:#ECECEC"  /></td>
<td width="220" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $datediffn;?>
  <input type="hidden" name="valdays" id="valdays" size="4" class="tblheading" value="<?php echo $datediffn;?>" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="E" onclick="pcksel(this.value);"   /></td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp" value="P" onclick="pcksel(this.value);"   /></td>
<td width="156" align="center" valign="middle" class="smalltblheading" id="pltno"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="<?php echo $row_trdetails_sub['pnpslipsub_plotno'];?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
	<td align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td align="center" valign="middle" class="smalltblheading">Captive Consumption</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Packing</td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance Condition</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="86" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="111" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="92" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="avlnobpck" id="avlnobpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_trdetails_sub['pnpslipsub_pnob']; ?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="avlqtypck" id="avlqtypck" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  value="<?php echo $row_trdetails_sub['pnpslipsub_pickpqty']; ?>" />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="pfpchk(this.value)" value="<?php echo $row_trdetails_sub['pnpslipsub_qty']; ?>" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)"  value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true"   style="background-color:#CCCCCC" value="<?php echo $row_trdetails_sub['pnpslipsub_availpqty']-$row_trdetails_sub['pnpslipsub_pickpqty']; ?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="balcnob" id="balcnob" type="text" size="5" class="smalltbltext" tabindex="" maxlength="5" readonly="true"  style="background-color:#CCCCCC"  value="<?php echo $row_trdetails_sub['pnpslipsub_balcnob']; ?>" onkeypress="return isNumberKey1(event)" /></td>
   <td  align="center"  valign="middle" class="smalltbltext"><input name="balcqty" id="balcqty" type="text" size="8" class="smalltbltext" tabindex="" maxlength="9" readonly="true"  style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)" onchange="chkbalnob(this.value)" value="<?php echo $row_trdetails_sub['pnpslipsub_balcqty']; ?>"  />&nbsp;</td>
</tr>  
</table>
<div id="partialpack" style="display:<?php if($row_trdetails_sub['pnpslipsub_packtype']=="P") {echo "block";} else {echo "none";}?>">
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
<td width="477" align="right" valign="middle" class="tblheading" >Condition Lot&nbsp;</td>
<td width="487" align="left" valign="middle" class="tblheading" id="conltno">&nbsp;<input type="text" name="txtbalconlotno" id="txtbalconlotno" class="smalltbltext" value="<?php if($row_trdetails_sub['pnpslipsub_processtype']=="P") {echo $row_trdetails_sub['pnpslipsub_clotno'];} else {echo $abc24;} ?>" size="16" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="abc24" value="<?php $abc24;?>" /></td>
</tr>
</table>

<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >&nbsp;Updated SLOC for Balance Condition Seed</td>
  </tr>
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Sub Bin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>

  <tr class="Light" height="25">
    <?php
$whp1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhp1" name="txtslwhp1" style="width:70px;" onchange="whp1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whp1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$binp1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="binp1"><select class="smalltbltext" name="txtslbinp1" style="width:60px;" onchange="binp1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbinp1"><select class="smalltbltext" name="txtslsubbp1" id="txtslsubbp1" style="width:60px;" onchange="subbinp1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrowp1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnobp1" id="txtconslnobp1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="Bagschkp1(this.value,1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqtyp1" id="txtconslqtyp1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="qtychkp1(this.value,1);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
    <tr class="Light" height="25">
    <?php
$whp1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhp2" name="txtslwhp2" style="width:70px;" onchange="whp2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whp1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$binp1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="binp2"><select class="smalltbltext" name="txtslbinp2" style="width:60px;" onchange="binp2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbinp1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbinp2"><select class="smalltbltext" name="txtslsubbp2" id="txtslsubbp2" style="width:60px;" onchange="subbinp2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrowp2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnobp2" id="txtconslnobp2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="Bagschkp1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqtyp2" id="txtconslqtyp2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="qtychkp1(this.value,2);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
</table>
</div>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $txtremarks; ?></td>
</tr>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_pronpslip_fc.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;"  /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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


