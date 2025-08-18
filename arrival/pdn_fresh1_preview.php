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
	if(isset($_REQUEST['dcdate1']))
	{
	$dcdate1 = $_REQUEST['dcdate1'];
	}
	if(isset($_REQUEST['dcdate']))
	{
	$dcdate = $_REQUEST['dcdate'];
	}
	if(isset($_REQUEST['txtdcnumber']))
	{
	$txtdcnumber = $_REQUEST['txtdcnumber'];
	}
	if(isset($_REQUEST['txt11']))
	{
	$txt11 = $_REQUEST['txt11'];
	}
	if(isset($_REQUEST['txttname']))
	{
	$txttname = $_REQUEST['txttname'];
	}
	if(isset($_REQUEST['txtlrn']))
	{
	$txtlrn = $_REQUEST['txtlrn'];
	}
	if(isset($_REQUEST['txtvn']))
	{
	$txtvn = $_REQUEST['txtvn'];
	}
	if(isset($_REQUEST['txt14']))
	{
	$txt14 = $_REQUEST['txt14'];
	}
	if(isset($_REQUEST['txtcname']))
	{
	$txtcname = $_REQUEST['txtcname'];
	}
	if(isset($_REQUEST['txtdc']))
	{
	$txtdc = $_REQUEST['txtdc'];
	}
	if(isset($_REQUEST['txtpname']))
	{
	$txtpname = $_REQUEST['txtpname'];
	}
	if(isset($_REQUEST['remarks']))
	{
	$remarks = $_REQUEST['remarks'];
	}
	
		$ddate1=explode("-",$dcdate);
		$ddate=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
		$hdate12=explode("-",$dcdate1);
		$hdate1=$hdate12[2]."-".$hdate12[1]."-".$hdate12[0];
		
$sql_main="update tblarrival set grnno='$grnnumber', dc_date='$ddate', disp_date='$hdate1', dcno='$txtdcnumber', tmode='$txt11', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt14', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname', remarks='$remarks' where arrival_id = '$pid'";
$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));


	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		 $pid=trim($_POST['txtitem']);
		 
	$connnew = mysqli_connect("localhost","wfuser","P1o5RSOloG8jCAN8") or die("Error:".mysqli_error($connnew));
	$dbnew = mysqli_select_db($connnew,"wmsfocusdb") or die("Error:".mysqli_error($connnew));
	
	
	
	$sql_arr=mysqli_query($link,"select * from tblarrival where arrival_id='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
		//$partyid=$row_arr['party_id'];
		$trdate=$row_arr['arrival_date'];
		
		$tdt=explode("-",$trdate);
		$monthNum  = $tdt[1];
		$monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // Mar

		if($plantcode==""){$plantcode=$row_arr['plantcode'];}
		
		$sql_fnyear=mysqli_query($link,"select * from tblfnyears where years_flg=1") or die(mysqli_error($link));
		$row_fnyear=mysqli_fetch_array($sql_fnyear);
		$fnyear=$row_fnyear['ycode'];
	
		$sqlarrsub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$pid."'") or die(mysqli_error($link));
		$totarrsub=mysqli_num_rows($sqlarrsub);
		while($rowarrsub=mysqli_fetch_array($sqlarrsub))
		{		
			$crop11=$rowarrsub['lotcrop'];
			$variety11=$rowarrsub['lotvariety'];
			$vrnew11=$crop."-"."Coded";
			
			if($variety11!="" && $variety11==$vrnew11)
			{
				$sql_spcdec=mysqli_query($link,"select * from tblspcodes where spcodef='".$rowarrsub['spcodef']."' and spcodem='".$rowarrsub['spcodem']."'") or die(mysqli_error($link));
				$tot_spcdec=mysqli_num_rows($sql_spcdec);
				if($tot_spcdec > 0)
				{
					$row_spcdec=mysqli_fetch_array($sql_spcdec);
					
					if($row_spcdec['variety']!="")
					{
						$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_spcdec['variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
						$row_variety=mysqli_fetch_array($sql_veriety);
						$itemname=$row_variety['popularname'];	
						
						$sqltblarsub24="update tblarrival_sub set lotvariety='$itemname' where arrival_id='".$pid."' and arrsub_id='".$rowarrsub['arrsub_id']."'";	
						$asdf=mysqli_query($link,$sqltblarsub24) or die(mysqli_error($link));
					}
				}	
			}
		}
	
	$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$pid."'") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$crop=$row_arrsub['lotcrop'];
		$variety=$row_arrsub['lotvariety'];
		
		$vrnew=$crop."-"."Coded";
		$leduration=$row_arrsub['leduration'];
		$ledate=$row_arrsub['leupto'];
		
		
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='$crop'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		$classid=$row_crop['cropid'];

		if($variety!="" && $variety!=$vrnew)
		{
			$sql_veriety=mysqli_query($link,"select * from tblvariety where popularname='".$variety."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_veriety);
			$itemid=$row_variety['varietyid'];				
		}
		else
		{
			$itemid=$row_arrsub['lotvariety'];
		}
		
		$ststus=$row_arrsub['sstage'];
	    $lotno=$row_arrsub['lotno'];
		$oldlotno=$row_arrsub['old'];
		$stage=$row_arrsub['sstage'];
		$sstatus=$row_arrsub['sstatus'];
		$moist=$row_arrsub['moisture'];
		$gemp=$row_arrsub['gemp'];
		$vchk=$row_arrsub['vchk'];
		$qc=$row_arrsub['qc'];
		$got=$row_arrsub['got1'];
		$gln=$row_arrsub['orlot'];
		$gotrusl="";
		$ulflg=0;
		if($got!="")
		{
			$gotr=explode(" ",$got);
			$gotrusl=$gotr[1];
		}
		if($row_arrsub['prodtype']=="Potent")$ulflg=1;	
		$wfsloc='';
		$sql_arrsub_sub=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$pid."' and arr_id='".$row_arrsub['arrsub_id']."'") or die(mysqli_error($link));
		while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
		{
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbin'];
			$ups=$row_arrsub_sub['bags'];
			$qty=$row_arrsub_sub['qty'];
			//$ups1=$row_arrsub_sub['ups_damage'];
			//$qty1=$row_arrsub_sub['qty_damage'];
			
			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
			
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$binid."' and whid='".$whid."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
			
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$subbinid."' and binid='".$binid."' and whid='".$whid."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
			
			if($wfsloc!="")
			$wfsloc=$wfsloc.", ".$wareh.$binn.$subbinn;
			else
			$wfsloc=$wareh.$binn.$subbinn;
			
			/*if($row_arrsub_sub=="GOT-R UT")
		{
		$got="T";
		}
		$state="P/M/G"."/".$got;	*/
				/*$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_binid='".$binid."' and lotldg_whid='".$whid."' and lotldg_variety='".$itemid."' and lotldg_crop='".$classid."' and lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				$tot_issue1=mysqli_num_rows($sql_issue1);
				
				if($tot_issue1 > 0)
				{		
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
				$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['lotldg_opbags'];
				$opqty=$row_issuetbl['lotldg_opqty'];
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				}
				else
				{*/
				$opups=0;
				$opqty=0;
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				//}
				
			 	$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, lotldg_got1, lotldg_sstatus, orlot, lotldg_gs, lotldg_got, lotldg_unlistflg, leduration, leupto, plantcode) values('$yearid_id', '$lotno', 'Fresh Seed with PDN', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty' ,'$stage', '$moist', '$gemp', '$vchk', '$qc', '$got', '$sstatus', '$gln', '1', '$gotrusl', '$ulflg', '$leduration','$ledate', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				//exit;
	
		}
		
		
		$sql_lotimp=mysqli_query($link,"select * from tbllotimp where lotnumber='".$row_arrsub['old']."'") or die(mysqli_error($link)); 
		$row_lotimp=mysqli_fetch_array($sql_lotimp);
		//$farmerid=$row_lotimp['farmer_id'];
		if($row_lotimp['farmer_id']!='' && $row_lotimp['farmer_id']!='0' && $row_lotimp['farmer_id']!=NULL)
		{$farmerid=$row_lotimp['farmer_id'];}
		else if($row_lotimp['farmer_code']!='' && $row_lotimp['farmer_code']!='0' && $row_lotimp['farmer_code']!=NULL)
		{$farmerid=$row_lotimp['farmer_code'];}
		else
		{
			$sql_prodlocw=mysqli_query($link,"select * from tbl_productionlocation where productionlocation='".$row_lotimp['lotploc']."' and state='".$row_lotimp['lotstate']."' ") or die(mysqli_error($link)); 
			$row_prodlocw=mysqli_fetch_array($sql_prodlocw);
			
			$sql_farmerw=mysqli_query($link,"select * from tblfarmer where farmername='".trim($row_lotimp['lotfarmer'])."' and productionlocationid='".$row_prodlocw['productionlocationid']."'") or die(mysqli_error($link)); 
			$row_farmerw=mysqli_fetch_array($sql_farmerw);
			
			if($row_farmerw['farmercode']!='' && $row_farmerw['farmercode']!='0' && $row_farmerw['farmercode']!=NULL)
			{$farmerid=$row_farmerw['farmercode'];}
			else if($row_farmerw['farmer_code']!='' && $row_farmerw['farmer_code']!='0' && $row_farmerw['farmer_code']!=NULL)
			{$farmerid=$row_farmerw['farmer_code'];}
			else
			{$farmerid='';}
		}
		$agreementid=$row_lotimp['agreement_id'];
		
		
		
		
		
		/*$sql_focusdbcode1="SELECT MAX(wffrn_code) FROM tbl_frn where wffrn_month='$monthName' and wffrn_yearcode='$fnyear' and wffrn_trtype='Arrival' ORDER BY wffrn_code DESC";
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
		}*/
		
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropname='".$row_arrsub['lotcrop']."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp="PRODUCTION - ".$row_crp['croptype'];
		if($crp=='Fruit Crop'){$crp="PRODUCTION - ".'Vegetable Crop';}
		$cropcode=$row_crp['cropcode'];
		$sql_ver=mysqli_query($link,"select * from tblvariety where popularname='".$row_arrsub['lotvariety']."'") or die(mysqli_error($link));
		$row_ver=mysqli_fetch_array($sql_ver);
		$itemcode=$row_ver['variety_newcode'];
		
		$zzz=implode(",", str_split($row_arrsub['orlot']));
		$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
		
		
		$doc_code="GRN/".$fnyear."/".$monthName."/".$doccode2;
		$tname='';
		if($row_arr['tmode']=="Transport"){ $tname=$row_arr['trans_name'];}
		else if($row_arr['tmode']=="Courier"){ $tname=$row_arr['courier_name'];}
		else { $tname=$row_arr['pname_byhand'];}
		
		//$sql_focusdb="insert into tbl_frn (wffrn_arrid, wffrn_docno, wffrn_date, wffrn_vendorac, wffrn_businessentity, wffrn_warehouse, wffrn_narration, wffrn_vehicleno, wffrn_lrno, wffrn_lrdate, wffrn_crop, wffrn_item, wffrn_unit, wffrn_pdnqty, wffrn_qty, wffrn_diffqty, wffrn_batch, wffrn_code, wffrn_month, wffrn_yearcode, wffrn_farmername, wffrn_placeofsupply, wffrn_modeoftransport, wffrn_nameoftransport, wffrn_comment, wffrn_department, wffrn_itemcode, account_code, account_name, wffrn_cropcode, wffrn_noofbags) values('$pid', '".$doc_code."', '".$tdate."', '".$farmerid."', 'HEAD OFFICE', 'Raw Seed', 'Fresh Seed with PDN', '".$row_arr['trans_vehno']."', '".$row_arr['trans_lorryrepno']."', '".$row_arr['disp_date']."', '".$row_arrsub['lotcrop']."', '".$row_arrsub['lotvariety']."', 'KGS', '".$row_arrsub['qty']."', '".$row_arrsub['act']."', '".$row_arrsub['diff']."', '".$abc."', '".$doccode."', '".$monthName."', '".$fnyear."', '".$row_arrsub['farmer']."', '".$prodloc."', '".$row_arr['tmode']."', '".$tname."', '".$row_arr['remarks']."', '".$crp."', '".$itemcode."', 'PUR-RM-04', 'PURCHASE OF SEEDS', '".$cropcode."', '".$row_arrsub['act1']."')";
		//if($focusdb_xz=mysqli_query($connnew,$sql_focusdb) or die(mysqli_error($connnew)))
		//{
		//	$wfid=mysqli_insert_id($connnew);
		//}
		
		
		$sqlisstbl=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$lotno."'") or die(mysqli_error($link)); 
		if($totisstbl=mysqli_num_rows($sqlisstbl)>0)
		{
			$rowisstbl=mysqli_fetch_array($sqlisstbl);
			$sqlsubsub1="UPDATE tbl_lemain SET le_duration='$leduration', le_upto='$ledate'  where le_lotno='$lotno' and le_stage='$stage'";
			mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
		}
		else
		{
			$sqlsubsub1="insert into tbl_lemain (le_lotno, le_stage, le_duration, le_upto) values( '$lotno' ,'$stage', '$leduration','$ledate' )";
			mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
		}
		
		$sqlsubsub13="insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid) values( '$lotno' ,'$stage', '$leduration','$ledate', '$trdate', 'Arrival', '$logid' )";
		mysqli_query($link,$sqlsubsub13) or die(mysqli_error($link));
		
		
		$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
		mysqli_query($link,$sql_itm) or die(mysqli_error($link));
		
		
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
			
		$got="";$got1="";
		if($row_arrsub['got1']=="GOT-R UT")
		{
			$got1="UT";	
		}
		else if($row_arrsub['got1']=="GOT-NR UT")
		{
			$got1="UT";
		}
		else if($row_arrsub['got1']=="GOT-R UT")
		{
			$got1="UT";
		}
		else if($row_arrsub['got1']=="GOT-NR UT")
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
		//$state="P/M/G"."/".$got;	
		$state="P/M/G";	
		if($row_arrsub['qc']=="UT")
		{
			$sql_sub_sub1244="insert into tbl_qctest(pp, moist, lotno, srdate, crop, variety, sampleno, trstage, qc, state, gs, oldlot, yearid, logid, plantcode) values ('$vchk', '$moist', '$lotno', '$trdate', '$classid', '$itemid', '$ncode1', '$stage', '$qc', '$state',1 ,'$gln', '$yearid_id', '$logid', '$plantcode')";
			mysqli_query($link,$sql_sub_sub1244) or die(mysqli_error($link));
		}
		if($got1=="UT")
		{
			$sql_sub_sub1245="insert into tbl_gottest(gottest_got, gottest_lotno, gottest_srdate, gottest_crop, gottest_variety, gottest_sampleno, gottest_trstage, gottest_oldlot, yearid, logid, plantcode) values ('$got1', '$lotno', '$trdate', '$classid', '$itemid', '$ncode1', '$stage', '$gln', '$yearid_id', '$logid', '$plantcode')";
			mysqli_query($link,$sql_sub_sub1245) or die(mysqli_error($link));
		}
		//exit;
		$sql_sub_upd="update tbllotimp set lotimpflg=1, trid='".$pid."' where lotnumber='".$oldlotno."'";
		$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
	}
}

		
		$sql_code="SELECT MAX(arr_code) FROM tblarrival where yearcode='$yearid_id' and arrival_type='Fresh Seed with PDN' and plantcode='$plantcode' ORDER BY arr_code DESC";
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
		
		$sql_code1="SELECT MAX(ncode) FROM tblarrival_sub where plantcode='$plantcode' ORDER BY ncode DESC";
		$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$ncode=$t_code1;
			//$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=0;
		}
	
$fld="";		
$sql_tbl_arsub=mysqli_query($link,"select distinct organiser from tblarrival_sub where arrival_id='".$pid."' and organiser!='$fld' and organiser!='NULL'") or die(mysqli_error($link));
$arsubtbltot=mysqli_num_rows($sql_tbl_arsub);

while($row_tbl_arsub=mysqli_fetch_array($sql_tbl_arsub))
{
$ncode=$ncode+1;
 $sqltblarsub="update tblarrival_sub set ncode='$ncode' where arrival_id='".$pid."' and organiser='".$row_tbl_arsub['organiser']."' and (ncode='' or ncode='NULL' or ncode IS NULL)";
$cxcx=mysqli_query($link,$sqltblarsub) or die(mysqli_error($link));
}

$sql_tbl_arsub1=mysqli_query($link,"select distinct farmer from tblarrival_sub where arrival_id='".$pid."' and (organiser='$fld' or organiser='NULL')") or die(mysqli_error($link));
$arsubtbltot1=mysqli_num_rows($sql_tbl_arsub1);
while($row_tbl_arsub1=mysqli_fetch_array($sql_tbl_arsub1))
{
$ncode=$ncode+1;
 $sqltblarsub1="update tblarrival_sub set ncode='$ncode' where arrival_id='".$pid."' and farmer='".$row_tbl_arsub1['farmer']."' and (ncode='' or ncode='NULL' or ncode IS NULL)";
$cxcx1=mysqli_query($link,$sqltblarsub1) or die(mysqli_error($link));
}	
$sql_tbl_arsubfrn2=mysqli_query($link,"select farmer,ncode,lotcrop from tblarrival_sub where arrival_id='".$pid."'") or die(mysqli_error($link));
$arsubtbltotfrn2=mysqli_num_rows($sql_tbl_arsubfrn2);
while($row_tbl_arsubfrn2=mysqli_fetch_array($sql_tbl_arsubfrn2))
{
$narration='Fresh Seed with PDN of Crop Name '.$row_tbl_arsubfrn2['lotcrop']." FRN NO ".$row_tbl_arsubfrn2['ncode']; 
//$sqltblwfsub="update tbl_frn set wffrn_frnno='".$row_tbl_arsubfrn2['ncode']."', wffrn_narration='".$narration."' where wffrn_arrid='".$pid."' and wffrn_farmername='".$row_tbl_arsubfrn2['farmer']."' ";
//$cxwfcx=mysqli_query($connnew,$sqltblwfsub) or die(mysqli_error($connnew));

}		
 	 $sql_main="update tblarrival set arrtrflag=1, arr_code=$code where arrival_id='$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
//exit;
echo "<script>window.location='select_arrival_fpdnop.php?p_id=$pid'</script>";	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival -Transaction -Fresh Seed Arrival with PDN - Preview</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<script src="farrival.js"></script>
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
var remarks=document.frmaddDepartment.remarks.value
winHandle=window.open('fpdn_details_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	if(document.frmaddDepartment.date.value=="00-00-0000" || document.frmaddDepartment.date.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
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

</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Fresh Seed Arrival with PDN- Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate2=$row_tbl['disp_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;

?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAF".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="101" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="259" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Type of Arrival&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;Fresh Arrival with PDN</td>
	<td align="right"  valign="middle" class="tblheading">Dispatch Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>
           </tr>
		   <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?></td>
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
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="99" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' order by arrsub_id") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
    <td width="1%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
	<td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>
  	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
	<td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status </td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="smalltblheading">Production Grade</td>
    <td width="4%" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    </tr>
 
<tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Moist %</td>
    <td width="8%" align="center" valign="middle" class="tblheading">PP</td>
</tr>
<?php
	 	$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
		$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}

$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NACC";
}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
  
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['prodgrade'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
  
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['prodgrade'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    </tr>
<?php
}
$srno++;
}
}
?>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_fpdn_arrival.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  