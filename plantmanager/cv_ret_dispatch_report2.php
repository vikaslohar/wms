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
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtupsdc = $_REQUEST['txtupsdc'];
	
?>

<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Dispatch - Report - Crop Variety Wise C&F Dispatch Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_cvretdr.php?sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtupsdc=<?php echo $txtupsdc;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtupsdc = $_REQUEST['txtupsdc'];
  
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL"; $locname="ALL"; $partyname="ALL"; $totnqty=0; $totnomp=0;
	
	
	$nqry="select Distinct disp_dodc from tbl_disp where disp_dodc>='$sdt' and disp_dodc<='$edt' AND plantcode='$plantcode' order by disp_dodc asc";

	$sql_narr_home1=mysqli_query($link,$nqry) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$ndt="";
	while($row_narr_home12=mysqli_fetch_array($sql_narr_home1))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home12['disp_dodc']; else $ndt=$row_narr_home12['disp_dodc'];
	}
	
	$ndt1=explode(",",$ndt);
	$ndt1=array_unique($ndt1);
	sort($ndt1);
	$ndt=$ndt1;
	
	
	
	
	$qry="select Distinct disp_id from tbl_disp where disp_dodc>='$sdt' and disp_dodc<='$edt' AND plantcode='$plantcode' order by disp_dodc asc";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));

	$id1="";$id2="";$id3="";$id4="";//$id5="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		if($id1!="") $id1=$id1.",".$row_arr_home12['disp_id']; else $id1=$row_arr_home12['disp_id'];
	}
	
	$id11=explode(",",$id1);
	$id11=array_unique($id11);
	sort($id11);
	$id11=implode(",",$id11);
	
	if($id11!="")
		$qry="select Distinct disps_crop from tbl_disp_sub where disp_id IN ($id11) AND plantcode='$plantcode'";
	else
		$qry="select Distinct disps_crop from tbl_disp_sub where disp_id!=0 AND plantcode='$plantcode'";

	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.=" and disps_crop='$crp' ";
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
	}
	
	$qry.=" group by disps_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home12['disps_crop']."' order by cropname asc") or die(mysqli_error($link));
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

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop Variety Wise C&F Dispatch Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?>&nbsp;&nbsp;|&nbsp;&nbsp;Size: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
<td width="18" align="center" valign="middle" class="smalltblheading">#</td>	  
<td width="67" align="center" valign="middle" class="smalltblheading">Dispatch Date</td>
<td width="103" align="center" valign="middle" class="smalltblheading">Party Name</td>
<td width="88" align="center" valign="middle" class="smalltblheading">Location</td>
<td width="85" align="center" valign="middle" class="smalltblheading">State</td>
<td width="85" align="center" valign="middle" class="smalltblheading">Crop</td>
<td width="82" align="center" valign="middle" class="smalltblheading">Variety</td>
<td width="94" align="center" valign="middle" class="smalltblheading">Lot No.</td>
<td width="80" align="center" valign="middle" class="smalltblheading">UPS</td>
<td width="65" align="center" valign="middle" class="smalltblheading">Barcode</td>
<td width="75" align="center" valign="middle" class="smalltblheading">Net Wt.</td>
<td width="82" align="center" valign="middle" class="smalltblheading">Gross Wt.</td>
</tr>
<?php
$srno=1; $cnt=0;
foreach($ndt as $ndts)
{
if($ndts<>"")
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
	
	if($id11!="")
		$qry="select Distinct disps_variety from tbl_disp_sub where disps_crop='".$crop1."' and disp_id IN ($id11) AND plantcode='$plantcode'";
	else
		$qry="select Distinct disps_variety from tbl_disp_sub where disps_crop='".$crop1."' AND plantcode='$plantcode'";
	
	
	
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
	}
	
	$qry.=" group by disps_variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
//echo $tret=mysqli_num_rows($sql_arr_home12);
	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home12['disps_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
				$ver2=$ver2.",".$row312['varietyid'];
			else
				$ver2=$row312['varietyid'];
		}
	}
	//echo $variety;
	$cvcod=$crop1."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
		$ver2=$ver2.",".$cvcod;
	//echo $ver2;
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$vtyp="OP"; $cirec=0; $pvvername=''; $up='';
		$sql_var23=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."'") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var23);
		if($vtot>0)
		{
			$row_var23=mysqli_fetch_array($sql_var23);
			$verty=$row_var23['popularname'];
			$vtyp=$row_var23['vt'];
			$up=$row_var23['gm'];
			if($vtyp=="Hybrid")$vtyp="Hybrid";
			if($row_var23['vertype']!='PV')
			{
				if($row_var23['pvverid']>0)
				{
					$sq_vr=mysqli_query($link,"select * from tblvariety where varietyid ='".$row_var23['pvverid']."'") or die(mysqli_error($link));
					$row_vr=mysqli_fetch_array($sq_vr);
					$pvvername=$row_vr['popularname'];
				}
				else
				{
					$pvvername=$verty;
				}
			}
			else
			{
				$pvvername=$verty;
			}
		}
		else
		{
			$verty=$verval;
			$pvvername=$verty;
			$vtyp="";
		}
		$xupout=0;//echo $up."  -=-  ";
		if($txtupsdc!="ALL")
		{
			$ups2=explode(" ",$txtupsdc);
			$ups3=explode(".",$ups2[0]);
			if($ups3[1]>0 || $ups3[1]!="000")$upsz=$ups3[0].".".$ups3[1];
			else
			$upsz=$ups3[0].".000";
			$sql_ups=mysqli_query($link,"select * from tblups where ups='$upsz' and wt='".$ups2[1]."'") or die(mysqli_error($link));
			$row_ups=mysqli_fetch_array($sql_ups);
			$xupout=$row_ups['uid'];
			$xupout=explode(",",$xupout);
			//echo "=-=";
			//$nupz=explode(",",$up);
			//$nup=array_merge(array_diff($nupz,$xupout));
			$nup=$xupout;
			//print_r($nup);
		}
		else
		{
			$nup=explode(",",$up);
		}
		//echo "<br/>";
		//echo $up."  -=-  ";
		if($up!="")
		{
			$xpl=count($nup);
			foreach($nup as $upsval)
			{
				if($upsval<>"")
				{
					$sql_ups=mysqli_query($link,"select * from tblups where uid=$upsval") or die(mysqli_error($link));
					while($row_ups=mysqli_fetch_array($sql_ups))	
					{
						$upssize=$row_ups['ups']." ".$row_ups['wt'];
						
						$nqty=0; $pname=''; $locn=''; $state=''; $barcode=''; $grosswt=''; $lotno='';
						
		
						// Dispatch table with party Type as All

						$sqdm="select * from tbl_disp where disp_dodc='$ndts' and disp_tflg=1 and disp_partytype='C&F' AND plantcode='$plantcode' order by disp_dodc asc";
						$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						if($t > 0)
						{
							while($rowdispm=mysqli_fetch_array($sql_istbl))
							{
								$xc=0; 
								 $sqlis="select * from tbl_dispsub_sub where disp_id='".$rowdispm['disp_id']."' and dpss_crop='".$crval."' and dpss_variety='".$verval."' and dpss_ups='".$upssize."' AND plantcode='$plantcode' order by disp_id asc";
								$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
								while($row_is=mysqli_fetch_array($sql_is))
								{ 
									$qt=$row_is['dpss_qty']; 
									if($qt<0)$qt=0;
									$xc=$xc+$qt;
									$nqty=$qt;
									//echo $row_is['dpss_lotno']."  =  ".$ndts."  =  ".$pvvername."  =  ".$upssize."  =  ".$nqty."<br />";
								
									$barcode=$row_is['dpss_barcode']; 
									$grosswt=$row_is['dpss_grosswt']; 
									$lotno=$row_is['dpss_lotno']; 
									$state=$rowdispm['disp_state'];
									$disptype=$rowdispm['disp_partytype'];
									//$nqty=$xc;
									
									$qry_dispsub=mysqli_query($link,"select * from tbl_disp_sub where disps_id='".$row_is['disps_id']."' and disp_id='".$rowdispm['disp_id']."' AND plantcode='$plantcode'"); 
									$row_dispsub = mysqli_fetch_array($qry_dispsub);
									$nvariety=$row_dispsub['disps_nvariety'];
									if($nvariety=="")$nvariety=$verty;
									
									$ptype=$rowdispm['disp_partytype'];
										
									$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
									$noticia3 = mysqli_fetch_array($quer3);
									$ycode=$noticia3['ycode'];
										
									$sql_code1="SELECT * FROM tbl_dispnote where dnote_trid='".$rowdispm['disp_id']."' and dnote_trtype='Dispatch Pack Seed' and dnote_ptype='$ptype' AND plantcode='$plantcode'";
									$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
									$row_code1=mysqli_fetch_array($res_code1);
									
									$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['disp_party']."' order by business_name")or die(mysqli_error($link));
									$noticia = mysqli_fetch_array($sql_month24);
									$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
									$noticia240 = mysqli_fetch_array($sql_month240);
									$locn=$noticia240['productionlocation'];
									if($disptype=="Export Buyer")
									$locn=$rowdispm['disp_location'];								
									$pname=$noticia['business_name'];
								
									
									$tdate=$ndts;
									$tyear=substr($tdate,0,4);
									$tmonth=substr($tdate,5,2);
									$tday=substr($tdate,8,2);
									$trdate=$tday."-".$tmonth."-".$tyear;
														
			
									$barcode1=str_split($barcode);
									$alph=$barcode1[0].$barcode1[1];
									$row_code15=0;
									$sql_code15="SELECT * FROM tbl_retbarseries where retbar_series='$alph' AND plantcode='$plantcode'";
									$res_code15=mysqli_query($link,$sql_code15)or die(mysqli_error($link));
									$row_code15=mysqli_num_rows($res_code15);
						
											
if($nqty>0 && $row_code15>0)						
{						
$cnt++; $totnqty=$totnqty+$nqty;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $locn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nvariety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $grosswt;?></td>
</tr>
<?php
$srno=$srno+1;
}

}
}			
}



}
}
}
}

}
}
}
}
}
}

if($totnqty>0)
{
?>
<tr class="Light">
	<td align="right" valign="middle" class="smalltblheading" colspan="10">Grand Total&nbsp;</td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $totnqty;?></td>
	<td align="center" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
<?php
}
if($cnt==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" colspan="12">No Record Found</td>
</tr>
<?php
}
?>
</table>			
 
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_cvretdr.php?sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtupsdc=<?php echo $txtupsdc;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>