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
		$sdate = $_REQUEST['sdate'];
?>

<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<title>QC Manager-Report - Stock Status Report as on <?php echo $sdate; ?></title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_stock_status_report.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
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

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
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
	
	
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
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
	
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Stock Status Report As on - <?php echo $sdate; ?></td>
  </tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="120" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="226" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td align="center" valign="middle" class="tblheading" rowspan="2">Total Stock</td>
	<td align="center" valign="middle" class="tblheading" colspan="5">GOT OK and Germination based qty. (kg)</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">GOT Based qty. (kg)</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="60"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="60"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="60"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="60"  align="center" valign="middle" class="tblheading">RT</td>
  <td width="105"  align="center" valign="middle" class="tblheading">Fail</td>
  <td width="60"  align="center" valign="middle" class="tblheading">GOT-BL</td>
  <td width="60"  align="center" valign="middle" class="tblheading">GOT-UT</td>
  <td width="60"  align="center" valign="middle" class="tblheading">GOT-Fail</td>
</tr>
<?php
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
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$tot_var=mysqli_num_rows($sql_var);
		if($tot_var>0)
		$ver=$row_var['popularname'];
		else
		$ver=$variety;
	}
	
	$qry.=" group by lotldg_variety";
	$qry2.=" group by lotldg_variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."' order by popularname asc") or die(mysqli_error($link));
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
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."' order by popularname asc") or die(mysqli_error($link));
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
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysqli_error($link));
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

	$cvcod=$crop1."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
	$ver2=$ver2.",".$cvcod;
	
	
	
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crpn=$row_crp['cropname'];
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var);
		if($vtot>0)
		{
			$row_var=mysqli_fetch_array($sql_var);
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
	
		$sql_arr_homelt12=mysqli_query($link,$qrylt) or die(mysqli_error($link));
		$sql_arr_homelt22=mysqli_query($link,$qrylt2) or die(mysqli_error($link));
	
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
		
		$totqty=0; $totgotokqcokqty=0; $totgotokqcblqty=0; $totgotokqcutqty=0; $totgotokqcrtqty=0; $totgotokqcfailqty=0; $totgotblqty=0; $totgotutqty=0; $totgotfailqty=0; 
		
		$ltn2=explode(",",$ltarr);
		$ltn2=array_unique($ltn2);
		sort($ltn2);
		foreach($ltn2 as $lt2)
		{
		if($lt2<>"")
		{
		
		
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$totvar=mysqli_num_rows($sql_var);
		if($totvar>0)
		$verty=$row_var['popularname'];
		else
		$verty=$verval;
		
	 	$date1="";$date2=""; $date3="";
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
		if($dot!="")
		{
			$tempArr=explode('-', $row_qct['testdate']);
			$date3 = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[2], $tempArr[0]));
		}
		
		$dp1="";$dp2="";
		//if($dot!="")
		{
			$trdate2=explode("-",date("d-m-Y"));
			$m=$trdate2[1];
			$de=$trdate2[0];
			$y=$trdate2[2];
			
			$de=$de-1;
			
			$dt=3;
			if($dt!="")
			{
				for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0]; $date1 = date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y));} 
			}
			else
			{$dp1="";}
			
			$dt=5;
			if($dt!="")
			{
				for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0]; $date2 = date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y));} 
			}
			else
			{$dp2="";}
			
		}
		
		
	//echo "3 Months Back Date  ".$date1." === "."5 Months Back Date  ".$date2." =-= ".$dp1." -=- ".$dp2."<br />";	
		// Raw Seed Records
		//$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		//while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty,lotldg_balbags,lotldg_got1,lotldg_got,lotldg_gemp,lotldg_gottestdate,lotldg_qc,lotldg_qctestdate from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$ccnt++;
						//echo "  =  ".$row_issuetbl['lotldg_gemp']."<br />";	
						if($gemp=='')$gemp=$row_issuetbl['lotldg_gemp'];
						if($dot=='')
						{
							$dot=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$dot=$trday."-".$trmonth."-".$tryear;
							if($dot=="00-00-0000" || $dot=="--")$dot="";
							if($dot!="")
							{
								$tempArr=explode('-', $row_issuetbl['lotldg_qctestdate']);
								$date3 = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[2], $tempArr[0]));
							}
						}
						
						//if($row_issuetbl['lotldg_balqty']>0){echo "Raw  ".$lt2."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot."<br />";}	
						
						//$date3 = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[0], $tempArr[2]));
						
						if($row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']==NULL)
						{
							if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']=="NUT" || $row_issuetbl['lotldg_qc']=="" || $row_issuetbl['lotldg_qc']==NULL)
							{
								if($gemp>85)
								{
									if(strtotime($date3) < strtotime($date2))
									{ 
										//echo 'Raw DOT is less than 5 month ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is less than 5 month  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Raw DOT is in 5 months ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is in 5 months  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date2." - ".$date3."<br />";	
								}
								else if($gemp>=80 && $gemp<=85)
								{
									if(strtotime($date3) < strtotime($date1))
									{ 
										//echo 'Raw DOT is less than 3 month ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is less than 3 month  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Raw DOT is in 3 months ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is in 3 months  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date1." - ".$date3."<br />";	
								}
								else
								{
									if($row_issuetbl['lotldg_balqty']>0){echo "Raw  ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
									$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
								}
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								//$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcblqty=$totgotokqcblqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="UT")
							{
								if($gemp>85)
								{
									if(strtotime($date3) < strtotime($date2))
									{ 
										//echo 'Raw DOT is less than 5 month ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is less than 5 month  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Raw DOT is in 5 months ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is in 5 months  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date2." - ".$date3."<br />";	
								}
								else if($gemp>=80 && $gemp<=85)
								{
									if(strtotime($date3) < strtotime($date1))
									{ 
										//echo 'Raw DOT is less than 5 month ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is less than 5 month  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Raw DOT is in 5 months ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Raw DOT is in 5 months  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date1." - ".$date3."<br />";	
								}
								else
								{
									if($row_issuetbl['lotldg_balqty']>0){echo "Raw  ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
									$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
								}
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								//$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
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
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotblqty=$totgotblqty+$row_issuetbl['lotldg_balqty']; 
								}
							}
							if($row_issuetbl['lotldg_got']=="UT")
							{
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
								}
							}
							if($row_issuetbl['lotldg_got']=="RT")
							{
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
								}
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
		//$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and orlot='$lt2' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		//while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty,lotldg_balbags,lotldg_got1,lotldg_got,lotldg_gemp,lotldg_gottestdate,lotldg_qc,lotldg_qctestdate from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$ccnt++;
						//echo "  |  ".$row_issuetbl['lotldg_gemp']."<br />";	
						if($gemp=='')$gemp=$row_issuetbl['lotldg_gemp'];
						if($dot=='')
						{
							$dot=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$dot=$trday."-".$trmonth."-".$tryear;
							if($dot=="00-00-0000" || $dot=="--")$dot="";
							if($dot!="")
							{
								$tempArr=explode('-', $row_issuetbl['lotldg_qctestdate']);
								$date3 = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[2], $tempArr[0]));
							}
						}
						
						//echo "Condition  ".$lt2."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot."<br />";	
						
						if($row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']==NULL)
						{
							if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']=="NUT" || $row_issuetbl['lotldg_qc']=="" || $row_issuetbl['lotldg_qc']==NULL)
							{
								if($gemp>85)
								{
									if(strtotime($date3) < strtotime($date2))
									{ 
										//echo 'Condition DOT is less than 5 month ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is less than 5 month  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Condition DOT is in 5 months ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is in 5 months  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date2." - ".$date3."<br />";	
								}
								else if($gemp>=80 && $gemp<=85)
								{
									if(strtotime($date3) < strtotime($date1))
									{ 
										//echo 'Condition DOT is less than 3 month ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is less than 3 month  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
									//	echo 'Condition DOT is in 3 months ='.$date1.','.$date3;
									if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is in 3 months  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date1." - ".$date3."<br />";	
								}
								else
								{
									if($row_issuetbl['lotldg_balqty']>0){echo "Condition  ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
									$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
								}
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								//$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								$totgotokqcblqty=$totgotokqcblqty+$row_issuetbl['lotldg_balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="UT")
							{
								if($gemp>85)
								{
									if(strtotime($date3) < strtotime($date2))
									{ 
										//echo 'Condition DOT is less than 5 month ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is less than 5 month  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Condition DOT is in 5 months ='.$date2.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is in 5 months  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date2." - ".$date3."<br />";	
								}
								else if($gemp>=80 && $gemp<=85)
								{
									if(strtotime($date3) < strtotime($date1))
									{ 
										//echo 'Condition DOT is less than 3 month ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is less than 3 month  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
									}
									else
									{ 
										//echo 'Condition DOT is in 3 months ='.$date1.','.$date3;
										if($row_issuetbl['lotldg_balqty']>0){echo "Condition DOT is in 3 months  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['lotldg_balqty']; 
									}
									//echo "<br />".$date1." - ".$date3."<br />";	
								}
								else
								{
									if($row_issuetbl['lotldg_balqty']>0){echo "Condition  ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['lotldg_balqty']."  =  ".$dot." Lot in UT"."<br />";}
									$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
								}
								$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
								//$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['lotldg_balqty']; 
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
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotblqty=$totgotblqty+$row_issuetbl['lotldg_balqty']; 
								}
							}
							if($row_issuetbl['lotldg_got']=="UT")
							{
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
								}
							}
							if($row_issuetbl['lotldg_got']=="RT")
							{
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['lotldg_balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
									$totgotutqty=$totgotutqty+$row_issuetbl['lotldg_balqty']; 
								}
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
		//$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		//while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and orlot='$lt2' and lotldg_variety='".$verval."' and lotldg_trdate<='$stdate' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and orlot='$lt2' and lotldg_trdate<='$stdate' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select balqty,balnomp,packtype,wtinmp,lotldg_got1,lotldg_got,lotldg_gemp,lotldg_gottestdate,lotldg_qc,lotldg_qctestdate from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						
						$ccnt++;
						//echo "  >   ".$row_issuetbl['lotldg_gemp']."<br />";	
						if($gemp=='')$gemp=$row_issuetbl['lotldg_gemp'];
						if($dot=='')
						{
							$dot=$row_issuetbl['lotldg_qctestdate'];
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$dot=$trday."-".$trmonth."-".$tryear;
							if($dot=="00-00-0000" || $dot=="--")$dot="";
							if($dot!="")
							{
								$tempArr=explode('-', $row_issuetbl['lotldg_qctestdate']);
								$date3 = date("Y-m-d", mktime(0, 0, 0, $tempArr[1], $tempArr[2], $tempArr[0]));
							}
						}
						
						//echo "Pack  ".$lt2."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot."<br />";	
						
						if($row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']==NULL)
						{
							if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']=="NUT" || $row_issuetbl['lotldg_qc']=="" || $row_issuetbl['lotldg_qc']==NULL)
							{
								if($gemp>85)
								{
									if(strtotime($date3) < strtotime($date2))
									{ 
										//echo 'Pack DOT is less than 5 month ='.$date2.','.$date3;
										if($row_issuetbl['balqty']>0){echo "PacK DOT is less than 5 month  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
									}
									else
									{ 
										//echo 'Pack DOT is in 5 months ='.$date2.','.$date3;
										if($row_issuetbl['balqty']>0){echo "PacK DOT is in 5 months  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['balqty']; 
									}
									//echo "<br />".$date2." - ".$date3."<br />";	
								}
								else if($gemp>=80 && $gemp<=85)
								{
									if(strtotime($date3) < strtotime($date1))
									{ 
										//echo 'Pack DOT is less than 3 month ='.$date1.','.$date3;
										if($row_issuetbl['balqty']>0){echo "PacK DOT is less than 3 month  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
									}
									else
									{ 
									//	echo 'Pack DOT is in 3 months ='.$date1.','.$date3;
									if($row_issuetbl['balqty']>0){echo "PacK DOT is in 3 months  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['balqty']; 
									}
									//echo "<br />".$date1." - ".$date3."<br />";	
								}
								else
								{
									if($row_issuetbl['balqty']>0){echo "PacK  ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in UT"."<br />";}
									$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
								}
								$totqty=$totqty+$row_issuetbl['balqty']; 
								//$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="BL")
							{
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totgotokqcblqty=$totgotokqcblqty+$row_issuetbl['balqty']; 
							}
							if($row_issuetbl['lotldg_qc']=="UT")
							{
								if($gemp>85)
								{
									if(strtotime($date3) < strtotime($date2))
									{ 
									//	echo 'Pack DOT is less than 5 month ='.$date2.','.$date3;
									if($row_issuetbl['balqty']>0){echo "PacK DOT is less than 5 month  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
									}
									else
									{ 
									//	echo 'Pack DOT is in 5 months ='.$date2.','.$date3;
									if($row_issuetbl['balqty']>0){echo "PacK DOT is in 5 months  ".$date2.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['balqty']; 
									}
									//echo "<br />".$date2." - ".$date3."<br />";	
								}
								else if($gemp>=80 && $gemp<=85)
								{
									if(strtotime($date3) < strtotime($date1))
									{ 
									//	echo 'Pack DOT is less than 3 month ='.$date1.','.$date3;
									if($row_issuetbl['balqty']>0){echo "PacK DOT is less than 3 month  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in UT"."<br />";}
										$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
									}
									else
									{ 
									//	echo 'Pack DOT is in 3 months ='.$date1.','.$date3;
									if($row_issuetbl['balqty']>0){echo "PacK DOT is in 3 months  ".$date1.','.$date3." > ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in OK"."<br />";}
										$totgotokqcokqty=$totgotokqcokqty+$row_issuetbl['balqty']; 
									}
									//echo "<br />".$date1." - ".$date3."<br />";	
								}
								else
								{
									if($row_issuetbl['balqty']>0){echo "PacK  ".$lt2."  =  ".$gemp."  =  ".$row_issuetbl['lotldg_got']."  =  ".$row_issuetbl['lotldg_qc']."  =  ".$row_issuetbl['balqty']."  =  ".$dot." Lot in UT"."<br />";}
									$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
								}
								$totqty=$totqty+$row_issuetbl['balqty']; 
								//$totgotokqcutqty=$totgotokqcutqty+$row_issuetbl['balqty']; 
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
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['balqty']; 
									$totgotblqty=$totgotblqty+$row_issuetbl['balqty']; 
								}
							}
							if($row_issuetbl['lotldg_got']=="UT")
							{
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['balqty']; 
									$totgotutqty=$totgotutqty+$row_issuetbl['balqty']; 
								}
							}
							if($row_issuetbl['lotldg_got']=="RT")
							{
								if($row_issuetbl['lotldg_qc']=="Fail")
								{
									$totqty=$totqty+$row_issuetbl['balqty']; 
									$totgotokqcfailqty=$totgotokqcfailqty+$row_issuetbl['balqty']; 
								}
								else
								{
									$totqty=$totqty+$row_issuetbl['balqty']; 
									$totgotutqty=$totgotutqty+$row_issuetbl['balqty']; 
								}
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
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crpn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcokqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcblqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcutqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcrtqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcfailqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotblqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotutqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotfailqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crpn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcokqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcblqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcutqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcrtqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotokqcfailqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotblqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotutqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotfailqty?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" colspan="3">Total</td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotokqcokqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotokqcblqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotokqcutqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotokqcrtqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotokqcfailqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotblqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotutqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalgotfailqty?></td>
	
</tr>
</table>			
<br />
<?php


?>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_stock_status_report.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>