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
	
	date_default_timezone_set('Asia/Calcutta');
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0";
	$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_rettype='P2P'";
	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$qry2.=" and lotldg_crop='$crop' ";
		$qry3.=" and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$tot_var=mysqli_num_rows($sql_var);
		if($tot_var>0)
		$ver=$row_var['popularname'];
		else
		$ver=$variety;
	}
	
	$qry.=" group by lotldg_crop";
	$qry2.=" group by lotldg_crop";
	$qry3.=" group by salesrs_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home23['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
	$dat=date("d-m-Y");	
	
	$dh="Stock_Report_as_on_".$dat;
	$datahead = array("Stock Report as on ".$dat);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$d=1;
	$datahead1= array("Crop:$crp     Variety:$ver");
	$datahead2= array("#","Lot No.","Raw Seed","","Condition Seed","","Pack Seed","","","","Sales Return","","Total","","Quality Status","","","","","GP%","SLOC","Production Personnel","Production Location","Harvest Date","Arrival Year","Blended Year"); 
	$datahead3= array("","","NoB","Qty","NoB","Qty","UPS","NoP","NoMP","Qty","NoB","Qty","NoB","Qty","Germ %","QC Status","DoT","GOT Status","DoGR"); 
	
$srno=1; $totalrnob=0; $totalrqty=0; $totalcnob=0; $totalcqty=0; $totalpnob=0; $totalpnomp=0; $totalpqty=0; $totalnob=0; $totalqty=0; $totalsrnob=0; $totalsrqty=0; 

$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$stage="Raw";
	$stage1="Condition";
	$stage2="Pack";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."'";
	$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_crop='".$crval."'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$tot_var=mysqli_num_rows($sql_var);
		if($tot_var>0)
		$ver=$row_var['popularname'];
		else
		$ver=$variety;
	}
	
	$qry.=" group by lotldg_variety";
	$qry2.=" group by lotldg_variety";
	$qry3.=" group by salesrs_variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		$tot312=mysqli_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home12['lotldg_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		$tot312=mysqli_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home22['lotldg_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['salesrs_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		$tot312=mysqli_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home23['salesrs_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			$tot312=mysqli_num_rows($sql_crop2);
			if($tot312>0)
			$vr=$row312['varietyid'];
			else
			$vr=$cp2[$i];
			if($ver2!="")
			$ver2=$ver2.",".$vr;
			else
			$ver2=$vr;
		}
	}

	$verps=explode(",",$ver2);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$qrylt="select Distinct orlot from tbl_lot_ldg where lotldg_crop='".$crval."'";
		$qrylt2="select Distinct orlot from tbl_lot_ldg_pack where lotldg_crop='".$crval."'";
		$qrylt3="select Distinct salesrs_orlot from tbl_salesrv_sub where salesrs_crop='".$crval."'  and salesrs_rettype='P2P' ";
		if($variety!="ALL")
		{	
			$qrylt.=" and lotldg_variety='$variety' ";
			$qrylt2.=" and lotldg_variety='$variety' ";
			$qrylt3.=" and salesrs_variety='$variety' ";
		}
		
		$qrylt.=" order by orlot";
		$qrylt2.=" order by orlot";
		$qrylt3.=" order by salesrs_orlot";
	
		$sql_arr_homelt12=mysqli_query($link,$qrylt) or die(mysqli_error($link));
		$sql_arr_homelt22=mysqli_query($link,$qrylt2) or die(mysqli_error($link));
		$sql_arr_homelt23=mysqli_query($link,$qrylt3) or die(mysqli_error($link));
	
		$ltarr="";
		while($row_arr_homelt12=mysqli_fetch_array($sql_arr_homelt12))
		{
			if($ltarr!="")
			$ltarr=$ltarr.",".$row_arr_homelt12['orlot'];
			else
			$ltarr=$row_arr_homelt12['orlot'];
		}
		
		while($row_arr_homelt22=mysqli_fetch_array($sql_arr_homelt22))
		{
			if($ltarr!="")
			$ltarr=$ltarr.",".$row_arr_homelt22['orlot'];
			else
			$ltarr=$row_arr_homelt22['orlot'];
		}
		
		while($row_arr_homelt23=mysqli_fetch_array($sql_arr_homelt23))
		{
			if($ltarr!="")
			$ltarr=$ltarr.",".$row_arr_homelt23['salesrs_orlot'];
			else
			$ltarr=$row_arr_homelt23['salesrs_orlot'];
			//echo $row_arr_homelt23['salesrs_orlot']."<br />";
		}
		
		$ltn2=explode(",",$ltarr);
		$ltn2=array_unique($ltn2);
		sort($ltn2);
		foreach($ltn2 as $lt2)
		{
		if($lt2<>"")
		{
		
		$totrnob=0; $totrqty=0; $totcnob=0; $totcqty=0; $totpnob=0; $totpnomp=0; $totpqty=0; $ccnt=0; $tnob=0; $tqty=0; $totsrnob=0; $totsrqty=0; $ups=""; $slocs="";
		$gemp=''; $qcresult=''; $dot=''; $gotresult=''; $dogr=''; $gpurity=''; $harvestdt=''; $arryear=''; $ploc=""; $pper=""; $blendyear="";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$totvar=mysqli_num_rows($sql_var);
		if($totvar>0)
		$verty=$row_var['popularname'];
		else
		$verty=$verval;
	 	
		$sql_qct1=mysqli_query($link,"select MAX(tid) from tbl_qctest where oldlot='".$lt2."'") or die(mysqli_error($link));
		$row_qct1=mysqli_fetch_array($sql_qct1);
		
		$sql_qct=mysqli_query($link,"select * from tbl_qctest where tid='".$row_qct1[0]."' and oldlot='".$lt2."'") or die(mysqli_error($link));
		$row_qct=mysqli_fetch_array($sql_qct);
		
		$gemp=$row_qct['gemp'];
		$qcresult=$row_qct['qcstatus'];
		
		$trdate=$row_qct['testdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$dot=$trday."-".$trmonth."-".$tryear;
		if($dot=="00-00-0000" || $dot=="--")$dot="";
		
		
		$sql_gott1=mysqli_query($link,"select MAX(gottest_tid) from tbl_gottest where gottest_oldlot='".$lt2."'") or die(mysqli_error($link));
		$row_gott1=mysqli_fetch_array($sql_gott1);
		
		$sql_gott=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_gott1[0]."' and gottest_oldlot='".$lt2."'") or die(mysqli_error($link));
		$row_gott=mysqli_fetch_array($sql_gott);
		
		$gpurity=$row_gott['genpurity'];
		$gotresult=$row_gott['gottest_gotstatus'];
		
		$trdate=$row_gott['gottest_gotdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$dogr=$trday."-".$trmonth."-".$tryear;
		if($dogr=="00-00-0000" || $dogr=="--")$dogr="";
		
		
		$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where orlot='".$lt2."'") or die(mysqli_error($link));
		$row_arrsub=mysqli_fetch_array($sql_arrsub);
		
		$sql_arrm=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_arrsub['arrival_id']."'") or die(mysqli_error($link));
		$row_arrm=mysqli_fetch_array($sql_arrm);
		
		$trdate=$row_arrsub['harvestdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$harvestdt=$trday."-".$trmonth."-".$tryear;
		if($harvestdt=="00-00-0000" || $harvestdt=="--")$harvestdt="";
		
		$trdate=$row_arrm['arrival_date'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$arryear=$tryear;
		if($arryear=="0000" || $arryear=="--")$arryear="";
		
		$ploc=$row_arrsub['ploc'];
		$pper=$row_arrsub['pper'];
		
		
		$sql_qct=mysqli_query($link,"select * from tbl_blends where blends_orlot='".$lt2."'") or die(mysqli_error($link));
		$row_qct=mysqli_fetch_array($sql_qct);
		
		$blendyear=$row_qct['blends_arryear'];
		
		
		// Raw Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						$totrqty=$totrqty+$qt;
						$totrnob=$totrnob+$row_issuetbl['lotldg_balbags'];
						$totalrqty=$totalrqty+$totrqty;
						$totalrnob=$totalrnob+$totrnob; 
						$ccnt++;
						if($gotresult=="")
						{
						$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
						$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
						}
						if($gpurity=='' || $gpurity==0)
						$gpurity=$row_issuetbl['lotldg_genpurity'];
						if($gemp=="")
						$gemp=$row_issuetbl['lotldg_gemp'];
						if($dogr=="")
						{
						$trdate1=$row_issuetbl['lotldg_gottestdate'];
						$tryear1=substr($trdate1,0,4);
						$trmonth1=substr($trdate1,5,2);
						$trday1=substr($trdate1,8,2);
						$trdate1=$trday1."-".$trmonth1."-".$tryear1;
						if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
						$dogr=$trdate1;
						}
						if($qcresult=="")
						$qcresult=$row_issuetbl['lotldg_qc'];
						
						if($dot=="")
						{
						$trdate=$row_issuetbl['lotldg_qctestdate'];
						$tryear=substr($trdate,0,4);
						$trmonth=substr($trdate,5,2);
						$trday=substr($trdate,8,2);
						$dot=$trday."-".$trmonth."-".$tryear;
						if($dot=="00-00-0000" || $dot=="--")$dot="";
						}
						
						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
						
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
						
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
					
						$slups=$row_issuetbl['lotldg_balbags'];
						$slqty=$row_issuetbl['lotldg_balqty'];
						$aq1=explode(".",$slups);
						if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
						$an1=explode(".",$slqty);
						if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
						$slups=$ac1;
						$slqty=$acn1;
						if($slqty>0)
						{
							if($slocs!="")
							$slocs=$slocs.",".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
							else
							$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
						}
					}	
				}
			}
			if($totrqty < 0)$totrqty=0;
			if($totrqty==0 && $totrnob > 0)$totrnob=0;
		}
		
		
		// Condition Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage1' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						$totcqty=$totcqty+$qt; 
						$totcnob=$totcnob+$row_issuetbl['lotldg_balbags'];
						$totalcqty=$totalcqty+$totcqty;
						$totalcnob=$totalcnob+$totcnob; 
						$ccnt++;
						if($gotresult=="")
						{
						$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
						$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
						}
						if($gemp=="")
						$gemp=$row_issuetbl['lotldg_gemp'];
						
						if($dogr=="")
						{
						$trdate1=$row_issuetbl['lotldg_gottestdate'];
						$tryear1=substr($trdate1,0,4);
						$trmonth1=substr($trdate1,5,2);
						$trday1=substr($trdate1,8,2);
						$trdate1=$trday1."-".$trmonth1."-".$tryear1;
						if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
						$dogr=$trdate1;
						}
						if($gpurity=='' || $gpurity==0)
						$gpurity=$row_issuetbl['lotldg_genpurity'];
						if($qcresult=="")
						$qcresult=$row_issuetbl['lotldg_qc'];
						
						if($dot=="")
						{
						$trdate=$row_issuetbl['lotldg_qctestdate'];
						$tryear=substr($trdate,0,4);
						$trmonth=substr($trdate,5,2);
						$trday=substr($trdate,8,2);
						$dot=$trday."-".$trmonth."-".$tryear;
						if($dot=="00-00-0000" || $dot=="--")$dot="";
						}
						
						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
						
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
						
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
					
						$slups=$row_issuetbl['lotldg_balbags'];
						$slqty=$row_issuetbl['lotldg_balqty'];
						$aq1=explode(".",$slups);
						if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
						$an1=explode(".",$slqty);
						if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
						$slups=$ac1;
						$slqty=$acn1;
						if($slqty>0)
						{
							if($slocs!="")
							$slocs=$slocs.",".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
							else
							$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
						}
					}	
				}
			}
			if($totcqty < 0)$totcqty=0;
			if($totcqty==0 && $totcnob > 0)$totcnob=0;
		}
		
		
		// Pack Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						if($qt<0)$qt=0;
						$totpqty=$totpqty+$qt; 
						$nop1=0;
						$ups=$row_issuetbl['packtype'];
						$wtinmp=$row_issuetbl['wtinmp']; 
						$upspacktype=$row_issuetbl['packtype'];
						$upspacktype=trim($upspacktype);
						$packtp=explode(" ",$upspacktype);
						$packt=trim($packtp[0]);
						$packtyp=explode(".",$packt); 
						
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
						
						if($packtyp[1]=="000")
						$ups=$packtyp[0]." ".$packtp[1];
						
						$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
						if($penqty > 0)
						{
							$nop1=($ptp*$penqty);
						}
						
						$totpnob=$totpnob+$nop1; 
						$totpnomp=$totpnomp+$row_issuetbl['balnomp']; 
						$totalpqty=$totalpqty+$totpqty;
						$totalpnob=$totalpnob+$totpnob; 
						$totalpnomp=totalpnomp+$totpnomp;
						
						$ccnt++;
						if($gotresult=="")
						{
						$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
						$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
						}
						if($gemp=="")
						$gemp=$row_issuetbl['lotldg_gemp'];
						
						if($dogr=="")
						{
						$trdate1=$row_issuetbl['lotldg_gottestdate'];
						$tryear1=substr($trdate1,0,4);
						$trmonth1=substr($trdate1,5,2);
						$trday1=substr($trdate1,8,2);
						$trdate1=$trday1."-".$trmonth1."-".$tryear1;
						if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
						$dogr=$trdate1;
						}
						if($qcresult=="")
						$qcresult=$row_issuetbl['lotldg_qc'];
						
						if($dot=="")
						{
						$trdate=$row_issuetbl['lotldg_qctestdate'];
						$tryear=substr($trdate,0,4);
						$trmonth=substr($trdate,5,2);
						$trday=substr($trdate,8,2);
						$dot=$trday."-".$trmonth."-".$tryear;
						if($dot=="00-00-0000" || $dot=="--")$dot="";
						}
						
						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
						
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
						
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
					
						$slups=$row_issuetbl['balnomp'];
						$slqty=$row_issuetbl['balqty'];
						$aq1=explode(".",$slups);
						if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
						$an1=explode(".",$slqty);
						if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
						$slups=$ac1;
						$slqty=$acn1;
						if($slqty>0)
						{
							if($slocs!="")
							$slocs=$slocs.",".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
							else
							$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
						}
					}	
				}
			}
			if($totpqty < 0)$totpqty=0;
			if($totpnob < 0)$totpnob=0;
			if($totpqty==0 && $totpnob > 0)$totpnob=0;
			if($totpqty==0 && $totpnomp > 0)$totpnomp=0;
		}
		
		// Sales Return Seed Records
		$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_orlot='$lt2' order by 'salesrs_id' asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_issuetbl['salesrss_qty']; 
					if($qt<0)$qt=0;
					if($qt>0)
					{
						$tot_p2c=0; $tot_srrv=0;
						$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' ") or die(mysqli_error($link));
						$tot_srrv=mysqli_num_rows($sq_srrv);
							
						$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' ") or die(mysqli_error($link));
						$tot_p2c=mysqli_num_rows($sq_p2c);
							
						if($tot_p2c>0){}
						else if($tot_srrv > 0){}
						else
						{
							$totsrqty=$totsrqty+$qt;
							$totsrnob=$totsrnob+$row_issuetbl['salesrss_nob']; 
							$totalsrqty=$totalsrqty+$totsrqty;
							$totalsrnob=$totalsrnob+$totsrnob;
							$ccnt++;
						}
					}
				}	
			}
			if($totsrqty < 0)$totsrqty=0;
		}
if($tot_arr_home > 0)
{		
if($ccnt > 0)
{
$tnob=$tnob+$totrnob+$totcnob+$totpnob+$totsrnob;
$tqty=$tqty+$totrqty+$totcqty+$totpqty+$totsrqty;

$totalnob=$totalnob+$tnob;
$totalqty=$totalqty+$tqty;
if($gpurity=='' || $gpurity==0)
$gpurity='';
if($gemp=="0")$gemp="";
if($qcresult!="OK")
{
//$gemp="";
//$dot="";
}
$gor=explode(" ", $gotresult);
if($gor[1]!="OK")
{
$dogr="";
}

if($tqty > 0)
{
$data1[$d]=array($d,$lt2,$totrnob,$totrqty,$totcnob,$totcqty,$ups,$totpnob,$totpnomp,$totpqty,$totsrnob,$totsrqty,$tnob,$tqty,$gemp,$qcresult,$dot,$gotresult,$dogr,$gpurity,$slocs,$pper,$ploc,$harvestdt,$arryear, $blendyear); 
$d++;
}
}
}
}
}
}
}
}
}
$datahead4= array("","Total",$totalrnob,$totalrqty,$totalcnob,$totalcqty,"",$totalpnob,$totalpnomp,$totalpqty,$totalsrnob,$totalsrqty,$totalnob,$totalqty,"","","","","");

echo implode($datahead) ;
echo "\n";
echo implode($datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
echo implode("\t", $datahead4) ;
echo "\n";