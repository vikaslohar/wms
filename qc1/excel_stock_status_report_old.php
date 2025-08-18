<?php
	ob_start();session_start();
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
	}
		
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	date_default_timezone_set('Asia/Calcutta');
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		$sdate = $_REQUEST['sdate'];
	
	$sd=split("-",$sdate);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and lotldg_trdate<='$stdate'";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and lotldg_trdate<='$stdate'";
	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$qry2.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
	}
	
	$qry.=" group by lotldg_crop";
	$qry2.=" group by lotldg_crop";

	$sql_arr_home1=mysql_query($qry) or die(mysql_error());
	$sql_arr_home2=mysql_query($qry2) or die(mysql_error());
 	$tot_arr_home=mysql_num_rows($sql_arr_home1);

	$croparr="";
	while($row_arr_home12=mysql_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysql_query("select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysql_error());
		$row312=mysql_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home22=mysql_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysql_query("select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysql_error());
		$row312=mysql_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysql_query("select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysql_error());
			$row312=mysql_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
	//$dat=date("d-m-Y H:i:s");	
	
	$dh="Stock_Status_Report_as_on_".$sdate;
	$datahead = array("Stock Status Report as on ".$sdate);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$cnt=1;
	
	$d=1;
		$datahead1= array("#","Crop","Variety","Total Stock","GOT OK and Germination based qty. (kg)","","","","","GOT Based qty. (kg)","",""); 
		$datahead2= array("","","","","OK","BL","UT","RT","Fail","GOT-BL","GOT-UT","GOT-Fail"); 
		
	

$srno=1; 
	$totalqty=0; $totalgotokqcokqty=0; $totalgotokqcblqty=0; $totalgotokqcutqty=0; $totalgotokqcrtqty=0; $totalgotokqcfailqty=0; $totalgotblqty=0; $totalgotutqty=0; $totalgotfailqty=0; 

 //if($tot_arr_home > 0)
{
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
	
	$sql_crop=mysql_query("select * from tblcrop where cropid='".$crval."'") or die(mysql_error());
	$row31=mysql_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$sql_var=mysql_query("select * from tblvariety where varietyid='".$variety."'") or die(mysql_error());
		$row_var=mysql_fetch_array($sql_var);
		$tot_var=mysql_num_rows($sql_var);
		if($tot_var>0)
		$ver=$row_var['popularname'];
		else
		$ver=$variety;
	}
	
	$qry.=" group by lotldg_variety";
	$qry2.=" group by lotldg_variety";

	$sql_arr_home12=mysql_query($qry) or die(mysql_error());
	$sql_arr_home22=mysql_query($qry2) or die(mysql_error());

	$verarr="";
	while($row_arr_home12=mysql_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysql_query("select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."' order by popularname asc") or die(mysql_error());
		$row312=mysql_fetch_array($sql_crop2);
		$tot312=mysql_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home12['lotldg_variety'];
		if($verarr!="")
		$verarr=$verarr.",".$vr;
		else
		$verarr=$vr;
	}
	
	while($row_arr_home22=mysql_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysql_query("select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."' order by popularname asc") or die(mysql_error());
		$row312=mysql_fetch_array($sql_crop2);
		$tot312=mysql_num_rows($sql_crop2);
		if($tot312>0)
		$vr=$row312['popularname'];
		else
		$vr=$row_arr_home22['lotldg_variety'];
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
			$sql_crop2=mysql_query("select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysql_error());
			$row312=mysql_fetch_array($sql_crop2);
			$tot312=mysql_num_rows($sql_crop2);
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

	$cvcod=$crop1."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
	$ver2=$ver2.",".$cvcod;
	
	
	
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
	
		$sql_crp=mysql_query("select * from tblcrop where cropid='".$crval."'") or die(mysql_error());
		$row_crp=mysql_fetch_array($sql_crp);
		$crpn=$row_crp['cropname'];
		$sql_var=mysql_query("select * from tblvariety where varietyid='".$verval."' ") or die(mysql_error());
		$vtot=mysql_num_rows($sql_var);
		if($vtot>0)
		{
			$row_var=mysql_fetch_array($sql_var);
			$verty=$row_var['popularname'];
			$vtyp=$row_var['vt'];
			if($vtyp=="Hybrid")$vtyp="HY";
		}
		else
		{
			$verty=$verval;
			$vtyp="";
		}
		$vern=$verty;
		
		$qrylt="select Distinct orlot from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'";
		$qrylt2="select Distinct orlot from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'";
		if($variety!="ALL")
		{	
			$qrylt.=" and lotldg_variety='$variety' ";
			$qrylt2.=" and lotldg_variety='$variety' ";
		}
		
		$qrylt.=" order by orlot";
		$qrylt2.=" order by orlot";
	
		$sql_arr_homelt12=mysql_query($qrylt) or die(mysql_error());
		$sql_arr_homelt22=mysql_query($qrylt2) or die(mysql_error());
	
		$ltarr="";
		while($row_arr_homelt12=mysql_fetch_array($sql_arr_homelt12))
		{
			if($ltarr!="")
			$ltarr=$ltarr.",".$row_arr_homelt12['orlot'];
			else
			$ltarr=$row_arr_homelt12['orlot'];
		}
		
		while($row_arr_homelt22=mysql_fetch_array($sql_arr_homelt22))
		{
			if($ltarr!="")
			$ltarr=$ltarr.",".$row_arr_homelt22['orlot'];
			else
			$ltarr=$row_arr_homelt22['orlot'];
		}
		
		$totqty=0; $totgotokqcokqty=0; $totgotokqcblqty=0; $totgotokqcutqty=0; $totgotokqcrtqty=0; $totgotokqcfailqty=0; $totgotblqty=0; $totgotutqty=0; $totgotfailqty=0; 
		
		$ltn2=explode(",",$ltarr);
		$ltn2=array_unique($ltn2);
		sort($ltn2);
		foreach($ltn2 as $lt2)
		{
		if($lt2<>"")
		{
		
		
		$sql_var=mysql_query("select * from tblvariety where varietyid='".$verval."' ") or die(mysql_error());
		$row_var=mysql_fetch_array($sql_var);
		$totvar=mysql_num_rows($sql_var);
		if($totvar>0)
		$verty=$row_var['popularname'];
		else
		$verty=$verval;
		
	 	
		$sql_qct1=mysql_query("select MAX(tid) from tbl_qctest where oldlot='".$lt2."'") or die(mysql_error());
		$row_qct1=mysql_fetch_array($sql_qct1);
		
		$sql_qct=mysql_query("select * from tbl_qctest where tid='".$row_qct1[0]."' and oldlot='".$lt2."'") or die(mysql_error());
		$row_qct=mysql_fetch_array($sql_qct);
		
		$gemp=$row_qct['gemp'];
		$qcresult=$row_qct['qcstatus'];
		
		$trdate=$row_qct['testdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$dot=$trday."-".$trmonth."-".$tryear;
		if($dot=="00-00-0000" || $dot=="--")$dot="";
		
		
		// Raw Seed Records
		//$sql_arhome=mysql_query("select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysql_error());
		//while($row_arhome=mysql_fetch_array($sql_arhome))
		{  
			$sql_is=mysql_query("select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' group by lotldg_subbinid order by lotldg_id asc") or die(mysql_error());
			while($row_is=mysql_fetch_array($sql_is))
			{ 
				$sql_is1=mysql_query("select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' order by lotldg_id desc ") or die(mysql_error());
				$row_is1=mysql_fetch_array($sql_is1); 
				$sql_istbl=mysql_query("select lotldg_balqty,lotldg_balbags,lotldg_got1,lotldg_got,lotldg_gemp,lotldg_gottestdate,lotldg_qc,lotldg_qctestdate from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotldg_id asc") or die(mysql_error()); 
				$t=mysql_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysql_fetch_array($sql_istbl))
					{ 
						$ccnt++;
						
						if($row_issuetbl['lotldg_got']=="OK")
						{
							if($row_issuetbl['lotldg_qc']=="OK")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcblqty=$totgotokqcblqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="UT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="RT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcrtqty=$totgotokqcrtqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="Fail")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
							}
						}
						else
						{
							if($row_issuetbl['lotldg_got']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotblqty=$totgotblqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="UT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="RT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="Fail")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotfailqty=$totgotfailqty+$row_issuetbl['lotldg_balqty']; 
							}
						}
					}	
				}
			}
		}
		
		
		// Condition Seed Records
		//$sql_arhome=mysql_query("select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysql_error());
		//while($row_arhome=mysql_fetch_array($sql_arhome))
		{  
			
			$sql_is=mysql_query("select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' group by lotldg_subbinid order by lotldg_id asc") or die(mysql_error());
			while($row_is=mysql_fetch_array($sql_is))
			{ 
				$sql_is1=mysql_query("select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' order by lotldg_id desc ") or die(mysql_error());
				$row_is1=mysql_fetch_array($sql_is1); 
				$sql_istbl=mysql_query("select lotldg_balqty,lotldg_balbags,lotldg_got1,lotldg_got,lotldg_gemp,lotldg_gottestdate,lotldg_qc,lotldg_qctestdate from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotldg_id asc") or die(mysql_error()); 
				$t=mysql_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysql_fetch_array($sql_istbl))
					{ 
						if($row_issuetbl['lotldg_got']=="OK")
						{
							if($row_issuetbl['lotldg_qc']=="OK")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcblqty=$totgotokqcblqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="UT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="RT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcrtqty=$totgotokqcrtqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="Fail")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
							}
						}
						else
						{
							if($row_issuetbl['lotldg_got']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotblqty=$totgotblqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="UT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="RT")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="Fail")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotfailqty=$totgotfailqty+$row_issuetbl['lotldg_balqty']; 
							}
						}
					}	
				}
			}
		}
		
		
		// Pack Seed Records
		//$sql_arhome=mysql_query("select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' group by lotno order by lotdgp_id asc") or die(mysql_error());
		//while($row_arhome=mysql_fetch_array($sql_arhome))
		{  
			$sql_is=mysql_query("select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_trdate<='$stdate' group by subbinid order by lotdgp_id asc") or die(mysql_error());
			while($row_is=mysql_fetch_array($sql_is))
			{ 
				$sql_is1=mysql_query("select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_trdate<='$stdate' order by lotdgp_id desc ") or die(mysql_error());
				$row_is1=mysql_fetch_array($sql_is1); 
				$sql_istbl=mysql_query("select balqty,balnomp,packtype,wtinmp,lotldg_got1,lotldg_got,lotldg_gemp,lotldg_gottestdate,lotldg_qc,lotldg_qctestdate from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotdgp_id asc") or die(mysql_error()); 
				$t=mysql_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysql_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						
						$ccnt++;
						
						if($row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']==NULL)
						{
							if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']=="NUT" || $row_issuetbl['lotldg_qc']=="" || $row_issuetbl['lotldg_qc']==NULL)
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotokqcblqty=$totgotokqcblqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="UT")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="RT")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotokqcrtqty=$totgotokqcrtqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="Fail")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['balqty']; 
							}
						}
						else
						{
							if($row_issuetbl['lotldg_got']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotblqty=$totgotblqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="UT")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotutqty=$totgotutqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="RT")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotutqty=$totgotutqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_got']=="Fail")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotfailqty=$totgotfailqty+$row_issuetbl['balqty']; 
							}
						}
					}	
				}
			}
		}
		
		}
		}
		
		$totalqty=$totalqty+$totqty;
		$totalgotokqcokqty=$totalgotokqcokqty+$totgotokqcokqty; 
		$totalgotokqcblqty=$totalgotokqcblqty+$totgotokqcblqty; 
		$totalgotokqcutqty=$totalgotokqcutqty+$totgotokqcutqty; 
		$totalgotokqcrtqty=$totalgotokqcrtqty+$totgotokqcrtqty; 
		$totalgotokqcfailqty=$totalgotokqcfailqty+$totgotokqcfailqty; 
		$totalgotblqty=$totalgotblqty+$totgotblqty; 
		$totalgotutqty=$totalgotutqty+$totgotutqty; 
		$totalgotfailqty=$totalgotfailqty+$totgotfailqty; 
if($totqty > 0)
{

	$data1[$d]=array($d,$crpn,$verty,$totqty,$totgotokqcokqty,$totgotokqcblqty,$totgotokqcutqty,$totgotokqcrtqty,$totgotokqcfailqty,$totgotblqty,$totgotutqty,$totgotfailqty); 
	$d++;
}
}
}
}
}
}
$datahead4= array("","","Total",$totalqty,$totalgotokqcokqty,$totalgotokqcblqty,$totalgotokqcutqty,$totalgotokqcrtqty,$totalgotokqcfailqty,$totalgotblqty,$totalgotutqty,$totalgotfailqty);
$cnt++;	
	
echo implode($datahead) ;
echo "\n";
echo implode("\t", $datahead1) ;
echo "\n";
echo implode("\t", $datahead2);
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
echo implode("\t", $datahead4) ;
echo "\n";