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

	if(isset($_GET['barcode'])) { $barcode = $_GET['barcode']; }
	if(isset($_GET['txtpsrn'])) { $txtpsrn= $_GET['txtpsrn']; }
	if(isset($_GET['crop'])) { $crop = $_GET['crop'];	}
	if(isset($_GET['variety'])) { $variety = $_GET['variety']; }
	if(isset($_GET['lotno'])) { $lotno = $_GET['lotno']; }
	if(isset($_GET['txtbctyp'])) { $txtbctyp = $_GET['txtbctyp']; }
	if(isset($_GET['slocssyncs'])) { $slocssyncs = $_GET['slocssyncs']; }
	if(isset($_GET['txtwhg1'])) { $txtwhg1 = $_GET['txtwhg1']; }
	if(isset($_GET['txtbing1'])) { $txtbing1 = $_GET['txtbing1']; }
	if(isset($_GET['txtsubbg1'])) { $txtsubbg1 = $_GET['txtsubbg1']; }
//exit;

//frm_action=submit&crop=28&variety=461&txtpsrn=DF00001&lotno=HF04137%2F00000%2F00&slocssyncs=&maintrid=1&barcval=&conts=0&plantcodes=D%2CH&yearcodes=A%2CD%2CF%2CK%2CN%2CS&barcode=DA010000011&txtbctyp=Un-Identified&txtcrop=28&txtvariety=461&slslc=1&txtwhg1=4&txtbing1=156&txtsubbg1=3119&existview1=Allowed&trflg1=0&tpflg1=0&tflg1=0&tpmflg1=0&nopmpcs_1=5&sno3=1&slocseldet=1&sbincont=&foccode=&postval=

		$dt=date("Y-m-d");
		$stge="Pack";
		$sqlm=mysqli_query($link,"Select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn'") or die(mysqli_error($link));
		while($rowm=mysqli_fetch_array($sqlm))
		{
			$ttrid=$rowm['btsl_id']; $d=0;
			$sqls=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_barcode='$barcode' and btsl_id='$ttrid'") or die(mysqli_error($link));
			if($tots=mysqli_num_rows($sqls)>0)
			{
				$rows=mysqli_fetch_array($sqls);
				$sql_btsls="update tbl_srbtslsub set btslsub_lnkflg=2 where btsl_id='$ttrid' and btslsub_barcode='$barcode'";
				if($xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link)))
				{
					$suid=$rows['btslsub_id'];
					$d=1;
				}
			}
			else
			{
				$sql_btsls="Insert into tbl_srbtslsub (btsl_id, btslsub_barcode, btslsub_bctype, btslsub_crop, btslsub_variety, btslsub_lnkflg, plantcode) values('$ttrid', '$barcode', '$txtbctyp', '$crop', '$variety',2, '$plantcode')";
				if($xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link)))
				{
					$suid=mysqli_insert_id($link);
					$d=1;
				}
			}
			if($d==1)
			{
				
				if($txtbctyp=="Un-Identified")
				{
					$sql_btslss2="Insert into tbl_srbtslsub_sub2 (btslsub_id, btsl_id, btslss_wh, btslss_bin, btslss_subbin, plantcode) values('$suid', '$ttrid', '$txtwhg1', '$txtbing1', '$txtsubbg1', '$plantcode')";
					$xcxcs2=mysqli_query($link,$sql_btslss2) or die(mysqli_error($link));
				}
				if($txtbctyp=="Identified")
				{
					$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode='$barcode'") or die(mysqli_error($link));
					$tot_mpm=mysqli_num_rows($sql_mpm);
					$row_mpm=mysqli_fetch_array($sql_mpm);
					$lotno=$row_mpm['mpmain_lotno'];
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link)); 
					$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
					
					$ups=$row_issuetbl['packtype'];
					$wtinmp=$row_issuetbl['wtinmp'];
					$upspacktype=$row_issuetbl['packtype'];
					$packtp=explode(" ",$upspacktype);
					$packtyp=$packtp[0]; 
					if($packtp[1]=="Gms")
					{ 
						$ptp=(1000/$packtp[0]);
					}
					else
					{
						$ptp=$packtp[0];
					}
					$nop1=($ptp*$wtinmp);
					$gt=explode(" ",$row_issuetbl['lotldg_got1']);
					
					$sql_btslss="insert into tbl_srbtslsub_sub (btsl_id, btslsub_id, btslss_wh, btslss_bin, btslss_subbin, btslss_lotno, btslss_ups, btslss_qtympt, btslss_nopmpt, btslss_qcstatus, btslss_dot, btslss_gottype, btslss_gotstatus, btslss_dogt, btslss_gemp, btslss_moist, btslss_pp, btslss_dop, btslss_dov, plantcode) values('$ttrid', '$suid', '$txtwhg1', '$txtbing1', '$txtsubbg1', '$lotno', '$ups', '$wtinmp', '$nop1', '".$row_issuetbl['lotldg_qc']."', '".$row_issuetbl['lotldg_qctestdate']."', '".$gt[0]."', '".$row_issuetbl['lotldg_got']."', '".$row_issuetbl['lotldg_gottestdate']."', '".$row_issuetbl['lotldg_gemp']."', '".$row_issuetbl['lotldg_moisture']."', '".$row_issuetbl['lotldg_vchk']."', '".$row_issuetbl['lotldg_dop']."', '".$row_issuetbl['lotldg_valupto']."', '$plantcode')";
					$xcxcs=mysqli_query($link,$sql_btslss) or die(mysqli_error($link));
				}
			}
			else
			{
				$sql_btsls="update tbl_srbtslsub set btslsub_lnkflg=0 where btsl_id='$ttrid' and btslsub_barcode='$barcode'";
				$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
			}
		}

	
	
?><?php
$conts=0;
$plantcodes=""; $yearcodes="";
	$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
	while($noticia = mysqli_fetch_array($quer4)) 
	{
		if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
		else
			$yearcodes=$noticia['ycode'];
	}
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$plantcodes=$row_month['code'];
	$pltcode=$row_month['code'];
	$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
	while($noticia2 = mysqli_fetch_array($quer5)) 
	{
		if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
		else
			$plantcodes=$noticia2['stcode'];
	}
?>
	<input type="hidden" name="barcval" value="<?php echo $barcval;?>" />
	<input type="hidden" name="conts" value="<?php echo $conts?>">
	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" /></td>
</tr>
</table><br />	
<div id="showcvdet"></div>

<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">SLOC</td>
</tr>
<?php

	$abc=""; $abcdef="";
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' AND bar_lotno='".$lotno."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			$bc=$row_barcode2['bar_barcodes'];
			if($abc!="")
			$abc=$abc.","."'$bc'";
			else
			$abc="'$bc'";
			if($abcdef!="")
			$abcdef=$abcdef.",".$bc;
			else
			$abcdef=$bc;
		}
	}
	//echo $abc;
	$sql_btsls=mysqli_query($link,"select distinct(btsl_id) from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn' order by btsl_id asc") or die(mysqli_error($link));
	while($row_btsls=mysqli_fetch_array($sql_btsls))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btsls['btsl_id'];
		else
			$barlotslist=$row_btsls['btsl_id'];
	}
	//echo $barlotslist;
	$sbn1=""; $sbn2="";
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btsl_id IN ($barlotslist) and btslsub_lnkflg=1") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
			}
			$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
			}
		}
	}
	
	$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
	$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
	while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
	{ 
		if($sbn2!="")
		$sbn2=$sbn2.",".$row_tbl_subsub3['subbinid'];
		else
		$sbn2=$row_tbl_subsub3['subbinid'];
	}
	
	//echo $sbn1;
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	$nm1=array_unique($nm);
	//print_r($nm1);
$xyz=explode(",",$abc);	
$conts=count($xyz);	
?>
<tr class="tblsubtitle" height="25">
<td width="78" align="center" valign="middle" class="tblheading">Select</td>
<td width="165" align="center" valign="middle" class="tblheading">WH</td>
<td width="165" align="center" valign="middle" class="tblheading">Bin</td>
<td width="165" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="196" align="center" valign="middle" class="tblheading">Comments</td>
<td width="165" align="center" valign="middle" class="tblheading">Master Packs</td>
<!--<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>-->
</tr>
<?php
$sno3=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; //$a=$lotno; 
foreach($nm1 as $sbinval)
{
if($sbinval<>"")
{ 
$totnompbar=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
	$nob=0; $qty=0; $qty1=0;
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nop1=0; $tcnt++;
		$ups=$row_issuetbl['packtype'];
		$wtinmp=$row_issuetbl['wtinmp'];
		$upspacktype=$row_issuetbl['packtype'];
		$packtp=explode(" ",$upspacktype);
		$packtyp=$packtp[0]; 
		if($packtp[1]=="Gms")
		{ 
			$ptp=(1000/$packtp[0]);
		}
		else
		{
			$ptp=$packtp[0];
		}
		$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
		if($penqty > 0)
		{
			$nop1=($ptp*$penqty);
		}
		//if($nop1<$row_issuetbl['balnop'])
		$nop1=$row_issuetbl['balnop'];
		//$nob=$nop1;
		$nob=$nop1; 
		$qty=$row_issuetbl['balnomp'];
		$qty1=$row_issuetbl['balqty'];
	}
}

if($tcnt==0)
{
	$sql_sel2="select * from tblups where CONCAT(ups,' ',wt)='".$upsize."' order by uom Asc";
	$res2=mysqli_query($link,$sql_sel2) or die (mysqli_error($link));
	$row122=mysqli_fetch_array($res2);
	$upsize=$row122['uid'];
	
	$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
	$totvariety=mysqli_num_rows($sqlvsriety);
	$rowvariety=mysqli_fetch_array($sqlvsriety);
	
	$p1_array=explode(",",$rowvariety['gm']);
	$p1_array2=explode(",",$rowvariety['wtmp']);
	$p1_array3=explode(",",$rowvariety['mptnop']);
	$p1=array();
	for($i=0; $i<count($p1_array); $i++)
	{
		if($p1_array[$i]==$upsize)
		{
			$sql_sel="select * from tblups where uid='".$upsize."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			$wtinmp=$p1_array2[$i];
			if($row12['wt']=="Gms")
			{ 
				$ptp=(1000/$row12['ups']);
			}
			else
			{
				$ptp=$row12['ups'];
			}
		}
	}
}
	$nobcd="";
	$sqlsubbinn=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$sbinval."'") or die(mysqli_error($link));
	$rowsubbinn=mysqli_fetch_array($sqlsubbinn);
	$wid=$rowsubbinn['whid'];
	$bid=$rowsubbinn['binid'];	
	
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$brcod=$rowbarcsub['btslsub_barcode'];
			if($nobcd!="")
			$nobcd=$nobcd.",".$brcod;
			else
			$nobcd=$brcod;
			array_push($aval1,$brcod);
		}
	$totnompbar=$totnompbar+$subtbltotbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	
$sno3=$sno3+1;	
//if($subtbltotbar > 0)	
{
?>
<tr class="light" height="25">
<td align="center"  valign="middle" class="smalltbltext"><input type="radio" name="slslc" id="slslc<?php echo $sno3?>" value="<?php echo $sno3?>" onClick="slocassgn(this.value)" checked="checked" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>

<td valign="middle">
<div id="slocr<?php echo $sno3;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview<?php echo $sno3?>" id="existview<?php echo $sno3?>" class="tbltext" value="Allowed" /><input type="hidden" name="trflg<?php echo $sno3?>" id="trflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tpflg<?php echo $sno3?>" id="tpflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tflg<?php echo $sno3?>" id="tflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tpmflg<?php echo $sno3?>" id="tpmflg<?php echo $sno3?>" value="0" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php echo $totnompbar;?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>
<!--<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $totpchbar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $tqtybar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>-->
</tr>
<?php
}
}
}
?>

<input type="hidden" name="sno3" value="<?php echo $sno3;?>" /><input type="hidden" name="slocseldet" value="<?php echo $sno3;?>" /><input type="hidden" name="sbincont" value="<?php echo $sbincont;?>" /><input type="hidden" name="foccode" value="" />
</table>
<?php if($conts>0) { ?>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php } ?>