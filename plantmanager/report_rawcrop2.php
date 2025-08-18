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
	
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		$sdate = $_REQUEST['sdate'];
?>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Plant Manager-Report - Crop Variety wise Stock Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
	$sd=explode("-",$sdate);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and lotldg_trdate<='$stdate' and plantcode='$plantcode'";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and lotldg_trdate<='$stdate' and plantcode='$plantcode'";
	$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_rettype='P2P' and plantcode='$plantcode'";
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
		$ver=$row_var['popularname'];
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
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop Variety wise Stock Report As on - <?php echo $sdate; ?></td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $ver;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="160" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="226" align="center" valign="middle" class="tblheading">Variety</td>
	<td align="center" valign="middle" class="tblheading">Raw Seed Qty</td>
	<td align="center" valign="middle" class="tblheading">Condition Seed Qty</td>
	<td align="center" valign="middle" class="tblheading">Pack Seed Qty</td>
	<td align="center" valign="middle" class="tblheading">Sales Return Qty</td>
	<td align="center" valign="middle" class="tblheading">Total Qty</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
$crps=explode(",",$crop2);
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


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate' and plantcode='$plantcode'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_trdate<='$stdate' and plantcode='$plantcode'";
	$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_crop='".$crval."' and plantcode='$plantcode'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
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
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['salesrs_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
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
			if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
			else
			$ver2=$row312['varietyid'];
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
		
		$totrnob=0; $totrqty=0; $totcnob=0; $totcqty=0; $totpnob=0; $totpnomp=0; $totpqty=0; $ccnt=0; $tqty=0; $totsrqty=0;
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
	 	
		// Raw Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' and lotldg_trdate<='$stdate' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						$totrqty=$totrqty+$qt; 
						$totrnob=$totrnob+$row_issuetbl['lotldg_balbags']; 
						$ccnt++;
					}	
				}
			}
			if($totrqty < 0)$totrqty=0;
			if($totrqty==0 && $totrnob > 0)$totrnob=0;
		}
		
		
		// Condition Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage1' and lotldg_trdate<='$stdate' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						$totcqty=$totcqty+$qt; 
						$totcnob=$totcnob+$row_issuetbl['lotldg_balbags']; 
						$ccnt++;
					}	
				}
			}
			if($totcqty < 0)$totcqty=0;
			if($totcqty==0 && $totcnob > 0)$totcnob=0;
		}
		
		
		// Pack Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$stdate' and plantcode='$plantcode' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$stdate' and plantcode='$plantcode' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and lotldg_trdate<='$stdate' and plantcode='$plantcode' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$stdate' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						if($qt<0)$qt=0;
						$totpqty=$totpqty+$qt; 
						$totpnob=$totpnob+$row_issuetbl['balnop']; 
						$totpnomp=$totpnomp+$row_issuetbl['balnomp']; 
						$ccnt++;
					}	
				}
			}
			if($totpqty < 0)$totpqty=0;
			if($totpqty==0 && $totpnob > 0)$totpnob=0;
			if($totpqty==0 && $totpnomp > 0)$totpnomp=0;
		}
		
		// Sales Return Seed Records
		$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and plantcode='$plantcode' order by 'salesrs_id'asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$s_srm=mysqli_query($link,"select * from tbl_salesrv where salesr_date<='$stdate' and salesr_id='".$row_arhome['salesr_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$t_srm=mysqli_num_rows($s_srm);
					if($t_srm > 0)
					{
						$qt=$row_issuetbl['salesrss_qty']; 
						if($qt<0)$qt=0;
						if($qt>0)
						{
							$tot_p2c=0; $tot_srrv=0;
							$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date<='$stdate' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_srrv=mysqli_num_rows($sq_srrv);
							
							$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date<='$stdate' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_p2c=mysqli_num_rows($sq_p2c);
							
							if($tot_p2c>0){}
							else if($tot_srrv > 0){}
							else
							{
								$totsrqty=$totsrqty+$qt;
								$ccnt++;
							}
						}
					}
				}	
			}
			if($totpqty < 0)$totpqty=0;
		}
if($ccnt > 0)
{
$tqty=$tqty+$totrqty+$totcqty+$totpqty+$totsrqty;
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totrnob;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totcnob;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnomp;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totrnob;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totcnob;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpnomp;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
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
</table>			

<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>