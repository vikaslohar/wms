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
	
	if(isset($_GET['tid']))
	{
		$a = $_GET['tid'];	 
	}
	if(isset($_GET['srno']))
	{
		$srno = $_GET['srno'];	 
	}
	if(isset($_GET['type']))
	{
		$type = $_GET['type'];	 
	}
	if(isset($_GET['insiturepl']))
	{
		$insiturepl = $_GET['insiturepl'];	 
	}
	if(isset($_GET['interrarepl']))
	{
		$interrarepl = $_GET['interrarepl'];	 
	}
	if(isset($_GET['dsowd']))
	{
		$dsowd = $_GET['dsowd'];	 
	}
	if(isset($_GET['trd']))
	{
		$trd = $_GET['trd'];	 
	}
	if(isset($_GET['seed']))
	{
		$seed = $_GET['seed'];	 
	}
	if(isset($_REQUEST['gotssid']))
	{
		$gotssid = $_REQUEST['gotssid'];	 
	}
	if(isset($_REQUEST['gotsid']))
	{
		$gotsid = $_REQUEST['gotsid'];	 
	}
	
	$tid=$a;
	$otid2="";
	$sql_ck2=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$a'") or die(mysqli_error($link));
	$row_ck2=mysqli_fetch_array($sql_ck2);
	$osamp2=$row_ck2['gottest_sampleno'];
	$olotno2=$row_ck2['gottest_lotno'];
	$yearid2=$row_ck2['yearid'];
	
	//echo "select * from tbl_qctest where lotno='$olotno2' and sampleno='$osamp2' and yearid='$yearid2' order by tid desc";
	$sql_ck23=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='$olotno2' and gottest_sampleno='$osamp2' and yearid='$yearid2' order by gottest_tid desc") or die(mysqli_error($link));
	$zxzx=mysqli_num_rows($sql_ck23);
	if($zxzx > 0)
	{
		$row_ck23=mysqli_fetch_array($sql_ck23);
		$otid2=$row_ck23['tid'];
	}
	if($otid2!="")
	$a=$otid2;
		
if(isset($_POST['frm_action'])=='submit')
{
	$connnew = mysqli_connect("localhost","wfuser","P1o5RSOloG8jCAN8") or die("Error:".mysqli_error($connnew));
	$dbnew = mysqli_select_db($connnew,"wmsfocusdb") or die("Error:".mysqli_error($connnew));
	
	$tid=trim($_POST['tid']);
	$txtinsitu=trim($_POST['insitu']);
	$txtinterra=trim($_POST['interra']);
	$gotss_id=trim($_POST['gotssid']);
	$gots_id=trim($_POST['gotsid']);
	$crop=trim($_POST['txtstfp']);
			  
	$crmsitu=trim($_POST['crmsitu']);
	$crmterra=trim($_POST['crmterra']);
	//$replnositu=trim($_POST['replnositu']);
	//$replnoterra=trim($_POST['replnoterra']);
	$crmsitu2=explode(",",$crmsitu);
	$crmterra2=explode(",",$crmterra);
	
	$crmterra1=count($crmterra2);
	$crmsitu1=count($crmsitu2);
	
	$crmsitu=implode(",",$crmsitu2);
	$crmterra=implode(",",$crmterra2);
	//exit;
	/*$plantpopn=trim($_POST['txtplantpopn']);
	$maleno=trim($_POST['txtno']);
	$maleper=trim($_POST['txtper']);
	$femaleno=trim($_POST['txtno1']);
	$femaleper=trim($_POST['txtper1']);
	$oofno=trim($_POST['txtoofno']);*/
	
	$refno=trim($_POST['txtloc']);
	$auth=trim($_POST['txttotal']);
	$result=trim($_POST['txtresult']);
	$genpurity=trim($_POST['txtgenpurity']);
	
	$sdate1=trim($_POST['sdate']);
	$ddate3=explode("-",$sdate1);
	$obdate=$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
	
	if($crop=="Maize Seed" || $crop=="Pearl Millet" || $crop=="Paddy Seed")
	{
		if($crmterra1>1)
			$sql_upd2="update tbl_gottestsub_sub4 set considered='Yes' where gottestss4_id in ($crmterra)";
		else
			$sql_upd2="update tbl_gottestsub_sub4 set considered='Yes' where gottestss4_id='$crmterra'";
		$upd2=mysqli_query($link,$sql_upd2) or die(mysqli_error($link));	
	}
	else
	{
		if($crmterra1>1)
			$sql_upd2="update tbl_gottestsub_sub3 set considered='Yes' where gottestss3_id in ($crmterra)";
		else
			$sql_upd2="update tbl_gottestsub_sub3 set considered='Yes' where gottestss3_id='".$crmterra."' ";
		$upd2=mysqli_query($link,$sql_upd2) or die(mysqli_error($link));		
	}
	//echo $crmsitu1;
	if($crmsitu1>1)
		$sql_upd3="update tbl_gottestsub_sub2 set considered='Yes' where gottestss2_id in ($crmsitu)";
	else
		$sql_upd3="update tbl_gottestsub_sub2 set considered='Yes' where gottestss2_id='".$crmsitu."' ";
	$upd3=mysqli_query($link,$sql_upd3) or die(mysqli_error($link));		
	
	$sql_ck=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$tid."' ") or die(mysqli_error($link));
	$row_ck=mysqli_fetch_array($sql_ck);
	
	$sql_s=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-TERRA' ") or die(mysqli_error($link));
	$row_s=mysqli_fetch_array($sql_s);
	
	$sql_ss=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_s['gottests_id']."' order by gottestss_id asc") or die(mysqli_error($link));
	while($row_ss=mysqli_fetch_array($sql_ss))
	{
		if($crop=="Maize Seed" || $crop=="Pearl Millet" || $crop=="Paddy Seed")
		{
			$sql_ss4=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottestss_id='".$row_ss['gottestss_id']."' ") or die(mysqli_error($link));
			$row_ss4=mysqli_num_rows($sql_ss4);
			//$row_ss4=mysqli_fetch_array($sql_ss4);
			if($row_ss4==0)
			{
				$sql_upd="update tbl_gottestsub_sub set gottestss_abortflg=1 where gottestss_id='".$row_ss['gottestss_id']."' ";
				$upd=mysqli_query($link,$sql_upd) or die(mysqli_error($link));
			}
		}
		else
		{
			$sql_ss3=mysqli_query($link,"select * from tbl_gottestsub_sub3 where gottestss_id='".$row_ss['gottestss_id']."' ") or die(mysqli_error($link));
			$row_ss3=mysqli_num_rows($sql_ss3);
			//$row_ss4=mysqli_fetch_array($sql_ss4);
			if($row_ss3==0)
			{
				$sql_upd1="update tbl_gottestsub_sub set gottestss_abortflg=1 where gottestss_id='".$row_ss['gottestss_id']."'";
				$upd1=mysqli_query($link,$sql_upd1) or die(mysqli_error($link));
			}
		}
	}
	
	//exit;
	$ores=$row_ck['gottest_gotstatus'];
	$osamp22=$row_ck['gottest_sampleno'];
	$olotno22=$row_ck['gottest_lotno'];
	$yearid22=$row_ck['yearid'];
	$oldlot22=$row_ck['gottest_oldlot'];
	$olot=$row_ck['gottest_lotno'];
	$crp=$row_ck['gottest_crop'];
	$ver=$row_ck['gottest_variety'];
	$srdt=$row_ck['gottest_srdate'];
	$spdt=$row_ck['gottest_spdate'];
	$smpno=$row_ck['gottest_sampleno'];
	$stge=$row_ck['gottest_trstage'];
	//$oref=$row_ck['qcrefno'];
	$ogotdate=$obdate;
	$odosdate=$row_ck['gottest_dosdate'];
	$ogot=$row_ck['gottest_got'];
	$ogotstatus=$row_ck['gottest_gotstatus'];
	$oaflg=$row_ck['gottest_aflg'];
	$obflg=$row_ck['gottest_bflg'];
	$ocflg=$row_ck['gottest_cflg'];
	$oresflg=$row_ck['gottest_resultflg'];
	$ogotflg=$row_ck['gottest_gotflg'];
	$ogotrefno=$row_ck['gottest_gotrefno'];
	$ogotauth=$row_ck['gottest_gotauth'];
	$ogotsmpdflg=$row_ck['gottest_gotsampdflg'];
	$logid=$row_ck['logid'];
	$logid1=$row_ck['logid1'];
	$logid2=$row_ck['logid2'];
  	$yearid=$row_ck['yearid'];
  	$opurity=$row_ck['genpurity'];
	$sampno=$row_ck['gottest_sampno'];
	
	/*if($ores=="RT")
	{//echo "RT";
		$sql_sub_sub="insert into tbl_gottest(gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno,  gottest_aflg, gottest_bflg, gottest_cflg, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gotstatus, gottest_gotauth, gottest_gotsampdflg, yearid, logid, logid1, logid2, genpurity, gottest_sampno) values('$spdt', '$ogotdate', '$odosdate', '$ogot', '$ver', '$crp', '$olot', '$oldlot22', '$srdt', '$stge', '$ogotstatus', '$smpno', '$oaflg', '$obflg', '$ocflg', '$oresflg', '$ogotflg', '$ogotrefno', '$ogotauth', '$ogotsmpdflg', '$yearid', '$logid', '$logid1', '$logid2', '$opurity', '$sampno')";
		if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
		{
			$id=mysqli_insert_id($link);
			if($result!="RT")
			{
				$sql_sub_sub12="update tbl_gottest set gottest_gotstatus='$result', gottest_gotdate='$obdate', gottest_gotrefno='$refno', gottest_gotauth='$auth', genpurity='$genpurity', gottest_gotflg=1 where gottest_tid='$id'";
				if(mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link)))
				{
					$x="";
					$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
					$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
					$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
					$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
					$sql_subchk="update tbl_softr_sub2 set softrsub_srflg='0' where softrsub_lotno ='$oldlot22'";
					mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
				}
			}
			else
			{
				$sql_sub_sub12="update tbl_gottest set gottest_gotstatus='$result', gottest_gotdate='$obdate', genpurity='$genpurity', gottest_gotflg=0 where gottest_tid='$id'";
				mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
				$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
				$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
				$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
			}
		}
	}
	else
	{//echo "Not RT";*/

	if($result!="RT")
	{
		$sql_sub_sub12="update tbl_gottest set gottest_gotstatus='$result', gottest_gotdate='$obdate', gottest_gotrefno='$refno', gottest_gotauth='$auth', genpurity='$genpurity', gottest_gotflg=1 where gottest_tid='$tid'";
		if(mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link)))
		{
			$x="";
			$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
			$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_srtyp='$x', lotldg_srflg='0', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
			$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
			$sql_subchk="update tbl_softr_sub2 set softrsub_srflg='0' where softrsub_lotno ='$oldlot22'";
			mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
		}
	}
	else
	{
		$sql_sub_sub="insert into tbl_gottest(gottest_spdate, gottest_gotdate, gottest_dosdate, gottest_got, gottest_variety, gottest_crop, gottest_lotno, gottest_oldlot, gottest_srdate, gottest_trstage, gottest_gotstatus, gottest_sampleno,  gottest_aflg, gottest_bflg, gottest_cflg, gottest_resultflg, gottest_gotflg, gottest_gotrefno, gottest_gotauth, gottest_gotsampdflg, yearid, logid, logid1, logid2, genpurity, gottest_sampno) values('$spdt', '$ogotdate', '$odosdate', '$ogot', '$ver', '$crp', '$olot', '$oldlot22', '$srdt', '$stge', '$result', '$smpno', '$oaflg', '$obflg', '$ocflg', '0', '$ogotflg', '$ogotrefno', '$ogotauth', '$ogotsmpdflg', '$yearid', '$logid', '$logid1', '$logid2', '$genpurity', '$sampno')";
		if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
		{
			$sql_sub_sub12="update tbl_gottest set gottest_gotstatus='$result', gottest_gotdate='$obdate', genpurity='$opurity', gottest_gotflg=1 where gottest_tid='$tid'";
	//exit;
			mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
			$sql_sub="update tbl_lot_ldg set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
			$qq=mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			$sql_sub2="update tbl_lot_ldg_pack set lotldg_got='$result', lotldg_gottestdate='$obdate', lotldg_genpurity='$genpurity' where orlot='$oldlot22'";
			$qq2=mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
		}
	}
	
	
	if($result=="OK" || $result=="BL" || $result=="Fail")
	{
		$sql_fnyear=mysqli_query($link,"select * from tblfnyears where years_flg=1") or die(mysqli_error($link));
		$row_fnyear=mysqli_fetch_array($sql_fnyear);
		$fnyear=$row_fnyear['ycode'];
		
		$zzz=implode(",", str_split($olotno22));
		$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
		$abc2=$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
		$lotnumb=$zzz[4];
		$blendorlot=$abc."00000/00";
		$blendedcontlots='';	
		$sql_focusdbcode1="SELECT * FROM tbl_frn where wffrn_batch='$abc' ORDER BY wffrn_batch DESC";
		$res_focusdbcode1=mysqli_query($connnew,$sql_focusdbcode1)or die(mysqli_error($connnew));
		if(mysqli_num_rows($res_focusdbcode1) > 0)
		{
			$rowfdb=mysqli_fetch_array($res_focusdbcode1);
			$doc_code="";
			$narration="GOT Result";
			if($result=="Fail")
			{
				$tdt=explode("-",$obdate);
				$monthNum  = $tdt[1];
				$monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // Mar
				
				$sql_fnyear=mysqli_query($link,"select * from tblfnyears where years_flg=1") or die(mysqli_error($link));
				$row_fnyear=mysqli_fetch_array($sql_fnyear);
				$fnyear=$row_fnyear['ycode'];	
					
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
				
				$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crp."'") or die(mysqli_error($link));
				$row_crp=mysqli_fetch_array($sql_crp);
				$crp=$row_crp['cropname'];
				$cropcode=$row_crp['cropcode'];
				$crptype="PRODUCTION - ".$row_crp['croptype'];
				if($row_crp['croptype']=='Fruit Crop'){$crptype="PRODUCTION - ".'Vegetable Crop';}
		
				$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$ver."'") or die(mysqli_error($link));
				$row_var=mysqli_fetch_array($sql_var);
				$ver=$row_var['popularname'];
				$itemcode=$row_var['variety_newcode'];
				
				$sql_arrsubtbl=mysqli_query($link,"select * from tblarrival_sub where old='".$abc2."'") or die(mysqli_error($link));
				$row_arrsubtbl=mysqli_fetch_array($sql_arrsubtbl);
				$frnno=$row_arrsubtbl['ncode'];
				
				if($lotnumb==9)
				{
					$sql_arrsubtbl=mysqli_query($link,"select * from tbl_blends where blends_orlot='".$blendorlot."'") or die(mysqli_error($link));
					while($row_arrsubtbl=mysqli_fetch_array($sql_arrsubtbl))
					{
						if($blendedcontlots!='') { $blendedcontlots=$blendedcontlots.",".$row_arrsubtbl['blends_lotno']; }
						else  { $blendedcontlots=$row_arrsubtbl['blends_lotno']; }
					}
				}
				
				if($lotnumb==8)
				{
					$sql_arrsubtbl=mysqli_query($link,"select * from tbl_cobdryingsub where norlot='".$blendorlot."'") or die(mysqli_error($link));
					while($row_arrsubtbl=mysqli_fetch_array($sql_arrsubtbl))
					{
						if($blendedcontlots!='') { $blendedcontlots=$blendedcontlots.",".$row_arrsubtbl['lotno']; }
						else  { $blendedcontlots=$row_arrsubtbl['lotno']; }
					}
				}
				
				$doc_code="DPN/".$fnyear."/".$monthName."/".$doccode2;
				$tdt=date("Y-m-d");
				
				$sql_arrsub=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_lotno='".$olotno22."'") or die(mysqli_error($link));
				if($a_arrsub=mysqli_num_rows($sql_arrsub)>0)
				{
					$row_arrsub=mysqli_fetch_array($sql_arrsub);
					$sql_arr=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$row_arrsub['proslipmain_id']."'") or die(mysqli_error($link));
					$row_arr=mysqli_fetch_array($sql_arr);
					$ogotrefno=$row_arr['proslipmain_proslipno'];
				}
				
				$farmercode=$rowfdb['wffrn_vendorac'];
				
				if($farmercode=="" || $farmercode==NULL || $farmercode=="NULL")
				{
					$qryarrsub="select * from tbllotimp where lotnumber='".$abc2."' ";
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
				$narration='Processing Slip  No. '.$ogotrefno." FRN NO ".$frnno; 
				
				$accode="DEBIT NOTE GOT-FAIL";
				$acname="DEBIT NOTE GOT-FAIL";
				
				$sql_focusdb="insert into tbl_frn (wffrn_arrid, wffrn_docno, wffrn_date, wffrn_businessentity, wffrn_narration, wffrn_crop, wffrn_item, wffrn_batch, wffrn_code, wffrn_month, wffrn_yearcode, wffrn_trtype, wffrn_unit, wffrn_warehouse, wffrn_qty, wffrn_farmername, Doc_Type, wffrn_ploss, wffrn_pper, wffrn_vendorac, wffrn_department, wffrn_itemcode, account_code, account_name, wffrn_cropcode, constituent_lotnos, got_result, gp_percentage) values('$tid', '".$doc_code."', '".$obdate."', 'HEAD OFFICE', '".$narration."', '".$rowfdb['wffrn_crop']."', '".$rowfdb['wffrn_item']."', '".$rowfdb['wffrn_batch']."', '".$doccode."', '".$monthName."', '".$fnyear."', 'GOT', 'KGS', 'Raw Seed', '".$rowfdb['wffrn_qty']."', '".$rowfdb['wffrn_farmername']."', 'Purchase Debit-CS-Seedtrac', '".$rowfdb['wffrn_ploss']."', '".$rowfdb['wffrn_pper']."', '".$farmercode."', '".$crptype."', '".$itemcode."', '".$accode."', '".$acname."', '".$cropcode."', '".$blendedcontlots."', '".$result."','".$genpurity."')";
				if($focusdb_xz=mysqli_query($connnew,$sql_focusdb) or die(mysqli_error($connnew)))
				{
					//$wfid=mysqli_insert_id($connnew);
				}
			}
			else
			{
			
			}
		}
	}
	
//}
//exit; 
echo "<script>window.location='home_result.php'</script>";
}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - GOT Result Pending List</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
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

function isNumberKey(evt)
{
	 var charCode = (evt.which) ? evt.which : evt.keyCode;
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
	  	
function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;
	var dtObject;
	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);

	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);

	return (dtObject);
}
function result()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please enter fill Genetic Purity");
		document.frmaddDept.txtresult.value="";
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	return true;
}
function resdate(rdate)
{
	//alert("Hiii...");
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please enter fill Genetic Purity");
		document.frmaddDept.sdate.value="";
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	if(document.frmaddDept.txtresult.value=="")
 	{
		alert("Please Select GOT Result");
		document.frmaddDept.sdate.value="";
		document.frmaddDept.txtresult.focus();
		return false;
 	}
	else
	{
		showCalendar(rdate);
	}
	return true;
}
function authorised()
{
	//alert("Hiii...");
	var flag=0; var flag1=0;
	//var dt2=getDateObject(document.frmaddDept.pdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	var dt4=getDateObject(document.frmaddDept.sdate.value,"-");
	var dt5=getDateObject(document.frmaddDept.dosdate.value,"-");
	//alert(document.frmaddDept.replnositu.value); alert(document.frmaddDept.replnoterra.value);
	if(document.frmaddDept.sdate.value!="")
	{
		for(i=1; i<document.frmaddDept.replnositu.value; i++)
		{	
			var dt7=getDateObject(document.getElementById('txtdate'+[i]).value,"-");
			if(dt7>dt4)
			{
				flag++;
			}
		}
		
		if(flag>0)
		{
			alert("Date of GOT Result can not be less than Observation Date");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
		for(i=1; i<document.frmaddDept.replnoterra.value; i++)
		{	
			var dt6=getDateObject(document.getElementById('txtdate1'+[i]).value,"-");
			if(dt6>dt4)
			{
				flag1++;
			}
		}
		
		if(flag1>0)
		{
			alert("Date of GOT Result can not be less than Observation Date");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
		if(dt5>dt4)
		{
			alert("Date of GOT Result can not be less than DOSD");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
		if(dt3<dt4)
		{
			alert("Date of GOT Result cannot be more than todays date");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
	}
	else
	{
		alert("Date of GOT Result cannot be Blank");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.sdate.focus();
		return false;
	}
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please enter fill Genetic Purity");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	if(document.frmaddDept.txtresult.value=="")
 	{
		alert("Please Select GOT Result");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.txtresult.focus();
		return false;
 	}
	if(document.frmaddDept.sdate.value=="")
 	{
		alert("Please Select Date of GOT Result");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.sdate.focus();
		return false;
 	}
	return true;
}
function docref()
{
	//alert("Hiii...");
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please enter fill Genetic Purity");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	if(document.frmaddDept.txtresult.value=="")
 	{
		alert("Please Select GOT Result");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.txtresult.focus();
		return false;
 	}
	if(document.frmaddDept.sdate.value=="")
 	{
		alert("Please Select Date of GOT Result");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.sdate.focus();
		return false;
 	}
	if(document.frmaddDept.txttotal.value=="")
 	{
		alert("Please enter the Got Result Authorised By");
		document.frmaddDept.txtloc.value="";
		document.frmaddDept.txttotal.focus();
		return false;
 	}
	return true;
}
function mySubmit()
{
	//alert("In Submit...");
	var dt5=getDateObject(document.frmaddDept.dosdate.value,"-");
	var dt3=getDateObject(document.frmaddDept.cdate.value,"-");
	var dt4=getDateObject(document.frmaddDept.sdate.value.value,"-");
	
	if(document.frmaddDept.txtgenpurity.value=="")
 	{
		alert("Please enter fill Genetic Purity");
		document.frmaddDept.txtgenpurity.focus();
		return false;
 	}
	if(document.frmaddDept.txtresult.value=="")
 	{
		alert("Please Select GOT Result");
		document.frmaddDept.txtresult.focus();
		return false;
 	}
	/*if(document.frmaddDept.sdate.value=="")
 	{
		alert("Please Select Date of GOT Result");
		document.frmaddDept.sdate.focus();
		return false;
 	}*/
	if(document.frmaddDept.txttotal.value=="")
 	{
		alert("Please enter the Got Result Authorised By");
		document.frmaddDept.txttotal.focus();
		return false;
 	}
	if(document.frmaddDept.txtloc.value=="")
 	{
		alert("Please enter the Got Document Ref. No.");
		document.frmaddDept.txtloc.focus();
		return false;
 	}
	if(document.frmaddDept.sdate.value!="")
	{
		for(i=1; i<document.frmaddDept.replnositu.value; i++)
		{	
			var dt7=getDateObject(document.getElementById('txtdate'+[i]).value,"-");
			if(dt7>dt4)
			{
				flag++;
			}
		}
		
		if(flag>0)
		{
			alert("Date of GOT Result can not be less than Observation Date");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
		for(i=1; i<document.frmaddDept.replnoterra.value; i++)
		{	
			var dt6=getDateObject(document.getElementById('txtdate1'+[i]).value,"-");
			if(dt6>dt4)
			{
				flag1++;
			}
		}
		
		if(flag1>0)
		{
			alert("Date of GOT Result can not be less than Observation Date");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
		if(dt5>dt4)
		{
			alert("Date of GOT Result can not be less than DOSD");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
		if(dt3<dt4)
		{
			alert("Date of GOT Result cannot be more than todays date");
			document.frmaddDept.txttotal.value="";
			document.frmaddDept.sdate.focus();
			return false;
		}
	}
	else
	{
		alert("Date of GOT Result cannot be Blank");
		document.frmaddDept.txttotal.value="";
		document.frmaddDept.sdate.focus();
		return false;
	}
	return true;
}

function genpuritychk(genval,cntinsitu)	
{	
	//alert(cntinsitu);
	document.frmaddDept.crmsitu.value="";
	var genpurity=0; var no=0;
	for(i=1; i<document.frmaddDept.replnositu.value; i++)
	{
		if(document.getElementById('txtinsitumean_'+[i]).checked==true)
		{
			genpurity = parseFloat(genpurity) + parseFloat(document.getElementById('txtgenpurity1_'+[i]).value);
			no++;
			if(document.frmaddDept.crmsitu.value!="")
				document.frmaddDept.crmsitu.value=document.frmaddDept.crmsitu.value+","+document.getElementById('txtinsitumean_'+[i]).value;
			else
				document.frmaddDept.crmsitu.value=document.getElementById('txtinsitumean_'+[i]).value;
		}
		/*else
		{
			if(document.frmaddDept.crmsitu.value!="")
				document.frmaddDept.crmsitu.value=document.frmaddDept.crmsitu.value+",No";
			else
				document.frmaddDept.crmsitu.value="No"
		}*/
	}
	document.frmaddDept.no.value=parseInt(no);
	document.frmaddDept.txtgenpurity.value = parseFloat(genpurity)/no;
	document.frmaddDept.txtgenpurity.value = parseFloat(document.frmaddDept.txtgenpurity.value).toFixed(3);
}
function genpuritychk1(genval,cntinterra,cntinsitu)	
{	
	document.frmaddDept.crmterra.value="";
	var genpurity1=0; 
	var cntinsitu = cntinsitu-1;
	var no=0; 
	for(i=1; i<document.frmaddDept.replnositu.value; i++)
	{	
		if(document.getElementById('txtinsitumean_'+[i]).checked==true)
		{
			genpurity1 = parseFloat(genpurity1) + parseFloat(document.getElementById('txtgenpurity1_'+[i]).value);
			no++;
		}
	}
	//alert(document.frmaddDept.replnoterra.value);
	for(i=1; i<document.frmaddDept.replnoterra.value; i++)
	{	//alert(document.getElementById('txtinterramean_'+[i]).value);
		if(document.getElementById('txtinterramean_'+[i]).checked==true)
		{
			genpurity1 = parseFloat(genpurity1) + parseFloat(document.getElementById('txtgenpurity2_'+[i]).value);
			no++;
			if(document.frmaddDept.crmterra.value!="")
				document.frmaddDept.crmterra.value=document.frmaddDept.crmterra.value+","+document.getElementById('txtinterramean_'+[i]).value;
			else
				document.frmaddDept.crmterra.value=document.getElementById('txtinterramean_'+[i]).value;
		}
		/*else
		{
			if(document.frmaddDept.crmterra.value!="")
				document.frmaddDept.crmterra.value=document.frmaddDept.crmterra.value+",No";
			else
				document.frmaddDept.crmterra.value="No";
		}*/
	}
	//alert(document.frmaddDept.crmterra.value);
	genpurity1 = parseFloat(genpurity1)/no;
	document.frmaddDept.txtgenpurity.value = parseFloat(genpurity1);
	document.frmaddDept.txtgenpurity.value = parseFloat(document.frmaddDept.txtgenpurity.value).toFixed(3);
}
function genchk(genval)	
{	
 	if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>100 || document.frmaddDept.txtgenpurity.value<0))
	{
		alert("Invalid Genetic Purity %. Value cannot be more than 100");
		document.frmaddDept.txtgenpurity.focus();
		//f=1;
		return false;
	}
	 if(document.frmaddDept.txtgenpurity.value!="" && (document.frmaddDept.txtgenpurity.value>99 && document.frmaddDept.result.value=="Fail"))
	{
		alert("Cannot update GOT Result as FAIL for Genetic Purity % more than 99");
		document.frmaddDept.txtgenpurity.focus();
		//f=1;
		return false;
	}		
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_got.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Result Update </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	 <form  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="gotssid" value="<?php echo $gotssid;?>" type="hidden">
	 <input name="gotsid" value="<?php echo $gotsid;?>" type="hidden"> 
	 <input name="txt" value="" type="hidden"> 
	 <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" /> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];

$quer3=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_tid='".$a."' "); 
$noticia = mysqli_fetch_array($quer3);
 $az=mysqli_num_rows($quer3);
 $a=$noticia['gottest_lotno'];
$oldlot=$noticia['gottest_oldlot'];
//echo "select * from tbl_qctest where lotno='".$a."'";
$sql_month=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$a."'")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);

$sql_spcode=mysqli_query($link,"select * from tblarrival_sub where orlot='".$row['gottest_oldlot']."'") or die(mysqli_error($link));
$row_spcode=mysqli_fetch_array($sql_spcode);
$grade=$row['grade'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row['gottest_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row['gottest_variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
$crop=$row31['cropname'];
$variety=$rowvv['popularname'];
$sap=$row['gottest_sampleno'];
$sampl=$tp1.$row['yearid'].sprintf("%000006d",$sap);
$tp22=$row['gottest_trstage'];
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
          <tr class="tblsubtitle" height="20">
            <td colspan="4" align="center" class="tblheading" >GOT Result Update</td>
          </tr>
  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Crop &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  id="vitem">&nbsp;<input name="txtstfp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $crop?>"onchange="upschk(this.value);" id="itm"/>  &nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"style="background-color:#CCCCCC" readonly="true" value="<?php echo $variety;?>"/>
      &nbsp;</td>
          </tr>
		   <tr class="Dark" height="25">
            <td align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $a?>"/>&nbsp;<input type="hidden" name="oldlot" value="<?php echo $oldlot;?>" /></td>
			  
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtstage" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp22?>"/>&nbsp;</td>
</tr>
<?php  
	$tdates=$row['gottest_srdate'];
	$tyear=substr($tdates,0,4);
	$tmonth=substr($tdates,5,2);
	$tday=substr($tdates,8,2);
	$tdates=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
	$tdatee=$row['gottest_dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 

?>
<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSR&nbsp;</td>
<td width="217" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdates;?>" maxlength="10"/>&nbsp;</td>
<td width="125" align="right" valign="middle" class="tblheading">&nbsp;DOSC&nbsp;</td>
<td width="223" align="left" valign="middle" class="tbltext">&nbsp;<input name="doscdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate1;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="175" align="right" valign="middle" class="tblheading">&nbsp;DOSD&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="dosdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdatee;?>" maxlength="10"/>&nbsp;</td> 

<td width="175" align="right" valign="middle" class="tblheading">&nbsp;Sample No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtsampl" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $sampl;?>" maxlength="20"/>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Male&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtspcodem" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodem'];?>" maxlength="10"/>&nbsp;</td>
	
	<td width="175" align="right" valign="middle" class="tblheading">&nbsp;SP Code Female&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtspcodef" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row_spcode['spcodef'];?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Dark" height="30">
    <td width="175" align="right" valign="middle" class="tblheading">&nbsp;Grade&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtspcodem" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $grade;?>" maxlength="10"/>&nbsp;</td>
 </tr>

</table>  
<br/>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="7" align="center" class="tblheading" >IN - SITU</td>
</tr>
<tr class="Dark" height="25">
	<td width="83" align="center" valign="middle" class="tblheading">Repl. No.</td>
	<td width="195" align="center" valign="middle" class="tblheading">Date of Observation</td>
	<td width="221" align="center" valign="middle" class="tblheading">Genetic Purity %</td>
	<td width="241" align="center" valign="middle" class="tblheading">Select for Mean </td>
</tr>
<?php 
$replinsitu=1;
//echo "select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-SITU'";
$sql_gotinsitu=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-SITU'") or die(mysqli_error($link));
$row_gotinsitu=mysqli_fetch_array($sql_gotinsitu);

$sql_insitu=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_gotinsitu['gottests_id']."' and gottestss_abortflg=0 order by gottestss_id asc") or die(mysqli_error($link));
while($row_insitu=mysqli_fetch_array($sql_insitu))
{	
	$sql_insitu1=mysqli_query($link,"select * from tbl_gottestsub_sub2 where gottestss_id='".$row_insitu['gottestss_id']."' order by gottestss2_id desc") or die(mysqli_error($link));
	$row_insitu1=mysqli_fetch_array($sql_insitu1);
	
	$obrdate=$row_insitu1['gottestss2_gelelctdate'];
	$tyear=substr($obrdate,0,4);
	$tmonth=substr($obrdate,5,2);
	$tday=substr($obrdate,8,2);
	$obrdate=$tday."-".$tmonth."-".$tyear; 
?>
<tr class="Dark" height="25">
	<td width="83" align="center" valign="middle" class="smalltbltext"><?php echo $replinsitu?></td>
	<td width="195" align="center" valign="middle" class="smalltbltext"><input name="txtdate" id="txtdate<?php echo $replinsitu?>" type="text" size="10" value="<?php echo $obrdate?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="221" align="center" valign="middle" class="smalltbltext"><input name="txtgenpurity1_<?php echo $replinsitu?>" id="txtgenpurity1_<?php echo $replinsitu?>" type="text" size="10" value="<?php echo $row_insitu1['gottestss2_genpurity']?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="241" align="center" valign="middle" class="smalltbltext"><input name="txtinsitumean_<?php echo $replinsitu?>" id="txtinsitumean_<?php echo $replinsitu?>" type="checkbox" size="5" onchange="genpuritychk(this.value,'<?php echo $replinsitu?>')" value="<?php echo $row_insitu1['gottestss2_id']?>" /></td>
</tr>
<?php 
$replinsitu++;
}

?>
</table><br />
<input type="hidden" name="no" value="" />
<input type="hidden" name="crmsitu" value="" />
<input type="hidden" name="replnositu" value="<?php echo $replinsitu?>" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="7" align="center" class="tblheading" >IN - TERRA</td>
</tr>
<tr class="Dark" height="25">
	<td width="83" align="center" valign="middle" class="tblheading">Repl. No.</td>
	<td width="195" align="center" valign="middle" class="tblheading">Date of Observation</td>
	<td width="223" align="center" valign="middle" class="tblheading">Genetic Purity %</td>
	<td width="239" align="center" valign="middle" class="tblheading">Select for Mean</td>
</tr>
<?php 
$replinterra=1;
$sql_gotinterra=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$tid."' and gottests_type='IN-TERRA'") or die(mysqli_error($link));
$row_gotinterra=mysqli_fetch_array($sql_gotinterra);

$sql_interra=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_gotinterra['gottests_id']."' and gottestss_abortflg=0 order by gottestss_id asc") or die(mysqli_error($link));
while($row_interra=mysqli_fetch_array($sql_interra))
{	$resid="";
	if($crop=="Maize Seed" || $crop=="Pearl Millet" || $crop=="Paddy Seed")
	{
		$sql_interra1=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottestss_id='".$row_interra['gottestss_id']."' order by gottestss4_id desc") or die(mysqli_error($link));
		$row_interra1=mysqli_fetch_array($sql_interra1);
		$resid=$row_interra1['gottestss4_id'];
		$obrdate=$row_interra1['gottestss4_doobr'];
		$tyear=substr($obrdate,0,4);
		$tmonth=substr($obrdate,5,2);
		$tday=substr($obrdate,8,2);
		$obrdate=$tday."-".$tmonth."-".$tyear; 
		$genpurity=$row_interra1['gottestss4_genpurity'];
	}
	else
	{
		$sql_interra1=mysqli_query($link,"select * from tbl_gottestsub_sub3 where gottestss_id='".$row_interra['gottestss_id']."' order by gottestss3_id desc") or die(mysqli_error($link));
		$row_interra1=mysqli_fetch_array($sql_interra1);
		$resid=$row_interra1['gottestss3_id'];
		$obrdate=$row_interra1['gottestss3_doobrdate'];
		$tyear=substr($obrdate,0,4);
		$tmonth=substr($obrdate,5,2);
		$tday=substr($obrdate,8,2);
		$obrdate=$tday."-".$tmonth."-".$tyear; 
		$genpurity=$row_interra1['gottestss3_genpurity'];
	}
if($genpurity!="")
{	
?>
<tr class="Dark" height="25">
	<td width="83" align="center" valign="middle" class="smalltbltext"><?php echo $replinterra?></td>
	<td width="195" align="center" valign="middle" class="smalltbltext"><input name="txtdate1" id="txtdate1<?php echo $replinterra?>" type="text" size="10" value="<?php echo $obrdate?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="221" align="center" valign="middle" class="smalltbltext"><input name="txtgenpurity2_<?php echo $replinterra?>" id="txtgenpurity2_<?php echo $replinterra?>" type="text" size="10" value="<?php echo $genpurity?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="241" align="center" valign="middle" class="smalltbltext"><input name="txtinterramean_<?php echo $replinterra?>" id="txtinterramean_<?php echo $replinterra?>" type="checkbox" size="5" onchange="genpuritychk1(this.value,'<?php echo $replinterra?>','<?php echo $replinsitu?>')" value="<?php echo $resid?>" /></td>
</tr>
<?php
}
$replinterra++;
}
?>
</table><br />
<input type="hidden" name="crmterra" value="" />
<input type="hidden" name="replnoterra" value="<?php echo $replinterra?>" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">Genetic Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtgenpurity" type="text" size="5" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background-color:#CCCCCC"/>  
&nbsp;%&nbsp;(Calculated Mean)</td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading" >GOT Result&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" id="gotresult">&nbsp;<select class="tbltext" name="txtresult" style="width:100px;" onchange="result()" >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
    <option value="BL" >BL</option>
  </select><font color="#FF0000">*</font>	</td>

<td align="right" valign="middle" class="tblheading">&nbsp;Date of GOT Result&nbsp;</td>
    <td align="left" valign="middle" class="tbltext">&nbsp;<input name="sdate" id="sdate1" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="resdate('sdate1')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>
<tr class="Dark" height="30">
  <td align="right"  valign="middle" class="tblheading">GOT Result Authorised By&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttotal" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" onchange="authorised()"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">GOT Doc Ref No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtloc" type="text" size="20" class="tbltext" tabindex="0"  value="" maxlength="20" onchange="docref()"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
</tr>	
		  
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" /></td>
</tr></table>
		<br />
  
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<a href="home_result.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  /><input type="hidden" name="tid" value="<?php echo $tid?>" /><input type="hidden" name="interrarepl" value="<?php echo $interrarepl?>" />&nbsp;&nbsp;</td>
</tr>
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
