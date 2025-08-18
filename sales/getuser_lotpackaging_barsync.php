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

	if(isset($_REQUEST['a']))
	{
		$txtpsrn = $_REQUEST['a'];
	}
	if(isset($_REQUEST['b']))
	{
		$trrid = $_REQUEST['b'];
	}
	if(isset($_REQUEST['c']))
	{
		$crop = $_REQUEST['c'];
	}
	if(isset($_REQUEST['f']))
	{
		$variety = $_REQUEST['f'];
	}
	if(isset($_REQUEST['g']))
	{
		$upsize = $_REQUEST['g'];
	}
	if(isset($_REQUEST['g']))
	{
		$oupsize = $_REQUEST['g'];
	}
	if(isset($_REQUEST['h']))
	{
		$tp = $_REQUEST['h'];
	}
	if(isset($_REQUEST['l']))
	{
		$otnop = $_REQUEST['l'];
	}
	if(isset($_REQUEST['p']))
	{
		$otqty = $_REQUEST['p'];
	}
	if(isset($_REQUEST['q']))
	{
		$subtid = $_REQUEST['q'];
	}
	
$lotno ='';
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="14">SLOC - Same Plant Barcodes</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="117" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="75" rowspan="2" align="center" valign="middle" class="tblheading">WH</td>
	<td width="63" rowspan="2" align="center" valign="middle" class="tblheading">Bin</td>
	<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="94" rowspan="2" align="center" valign="middle" class="tblheading">Master Packs</td>
	<td width="113" rowspan="2" align="center" valign="middle" class="tblheading">Damage Qty</td>
	<td width="123" rowspan="2" align="center" valign="middle" class="tblheading">Total Pouches</td>
	<td width="106" rowspan="2" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Barcodes</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="58" align="center" valign="middle" class="tblheading">Linked</td>
	<td width="70" align="center" valign="middle" class="tblheading">Un-Link</td>
	<td width="65" align="center" valign="middle" class="tblheading">Link New</td>
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
	$sbn1=""; $sbn2=""; $barcds="";$lotno='';
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btsl_id IN ($barlotslist) and btslsub_bctype='Identified'") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			$sql_btslm=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
				
				$bc=$rowbarcsub2['btslsub_barcode'];
				if($barcds!="")
				$barcds=$barcds.","."'$bc'";
				else
				$barcds="'$bc'";
			}
			/*$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
			}*/
		}
	}
	if($sbn1!="")
	{
	$sql_btslm22=mysqli_query($link,"select distinct btslss_lotno from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btsl_id IN ($barlotslist) and btslss_subbin IN ($sbn1) order by btslsub_id asc") or die(mysqli_error($link));
	$trt2=mysqli_num_rows($sql_btslm22);
	while($row_btslm22=mysqli_fetch_array($sql_btslm22))
	{
		if($lotno!="")
			$lotno=$lotno.','.$row_btslm22['btslss_lotno'];
		else
			$lotno=$row_btslm22['btslss_lotno'];
	}
	}
	
	if($barcds!="")
	{
		$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode IN ($barcds)") or die(mysqli_error($link));
		$tot_mpm=mysqli_num_rows($sql_mpm);
		$row_mpm=mysqli_fetch_array($sql_mpm);
		$lotno=$row_mpm['mpmain_lotno'];
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
	$nm1=explode(",",$sbn1);
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	
	//print_r($nm1);
$xyz=explode(",",$abc);	
$lotn=explode(",", $lotno);$lotn=array_unique($lotn);
$conts=count($xyz);	

?>
<?php
$sno3=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; //$a=$lotno; 
for($x=0; $x<count($lotn); $x++)
{
$sbinval=$nm1[$x];
$lotno=$lotn[$x];
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
	$stbar=0;
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btslsub_bctype='Identified'") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$lotno' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				$brcod=$rowbarcsub['btslsub_barcode'];
				if($nobcd!="")
				$nobcd=$nobcd.",".$brcod;
				else
				$nobcd=$brcod;
				array_push($aval1,$brcod);
				$stbar++;
			}
		}
	$totnompbar=$totnompbar+$stbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	

if($lotno!="")
{
$sno3=$sno3+1;	
?>
<tr class="light" height="25">
  <td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?><input type="hidden" name="txtlotno<?php echo $sno3?>" id="txtlotno<?php echo $sno3?>" value="<?php echo $lotno?>" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>


<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php if($totnompbar>0) { ?><a href="Javascript:void(0);" onclick="showbarc('<?php echo $nobcd;?>');"><?php echo $totnompbar;?></a><?php } else { echo $totnompbar; }?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="0" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $totpchbar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $tqtybar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $totnompbar?></td> 
<td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="unlinkbarc(<?php echo $sno3;?>);">Un-Link</a></td> 
<td align="center" valign="middle" class="tbltext"><a href="Javascript:void(0);" onclick="linkbarc('<?php echo $lotno?>');">Link</a></td> 
</tr>
<?php
}
}
}
?>


</table>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="14">SLOC - Other Plant Barcodes</td>
</tr>
<tr class="tblsubtitle" height="25">
  <td width="117" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="75" rowspan="2" align="center" valign="middle" class="tblheading">WH</td>
<td width="63" rowspan="2" align="center" valign="middle" class="tblheading">Bin</td>
<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="94" rowspan="2" align="center" valign="middle" class="tblheading">Master Packs</td>
<td width="113" rowspan="2" align="center" valign="middle" class="tblheading">Damage Qty</td>
<td width="123" rowspan="2" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="106" rowspan="2" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
<td colspan="3" align="center" valign="middle" class="tblheading">Barcodes</td>
</tr>
<tr class="tblsubtitle" height="25">
  <td width="58" align="center" valign="middle" class="tblheading">Linked</td>
  <td width="70" align="center" valign="middle" class="tblheading">Un-Link</td>
  <td width="65" align="center" valign="middle" class="tblheading">Link New</td>
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
	$sbn1=""; $sbn2=""; $barcds="";$lotno="";
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btsl_id IN ($barlotslist) and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			/*$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
			}*/
			$sql_btslm2=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
				 
				$bc=$rowbarcsub2['btslsub_barcode'];
				if($barcds!="")
				$barcds=$barcds.","."'$bc'";
				else
				$barcds="'$bc'";
			}
		}
	}
	if($sbn1!="")
	{
		$sql_btslm22=mysqli_query($link,"select distinct btslss_lotno from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btsl_id IN ($barlotslist) and btslss_subbin IN ($sbn1) order by btslsub_id asc") or die(mysqli_error($link));
		$trt2=mysqli_num_rows($sql_btslm22);
		while($row_btslm22=mysqli_fetch_array($sql_btslm22))
		{
			if($lotno!="")
				$lotno=$lotno.','.$row_btslm22['btslss_lotno'];
			else
				$lotno=$row_btslm22['btslss_lotno'];
		}
	}
	if($barcds!="")
	{
		$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode IN($barcds)") or die(mysqli_error($link));
		if($tot_mpm=mysqli_num_rows($sql_mpm)>0)
		{
		$row_mpm=mysqli_fetch_array($sql_mpm);
		$lotno=$row_mpm['mpmain_lotno'];
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
	$nm1=explode(",",$sbn1);
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	
	//print_r($nm1);
$xyz=explode(",",$abc);	
$lotn=explode(",", $lotno);$lotn=array_unique($lotn);
$conts=count($xyz);	

?>
<?php
$sno33=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; //$a=$lotno; 
for($x=0; $x<count($lotn); $x++)
{
$sbinval=$nm1[$x];
$lotno=$lotn[$x];
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
	
	$stbar=0;
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$lotno' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				$brcod=$rowbarcsub['btslsub_barcode'];
				if($nobcd!="")
				$nobcd=$nobcd.",".$brcod;
				else
				$nobcd=$brcod;
				array_push($aval1,$brcod);
				$stbar++;
				
			}
		}
		
	$totnompbar=$totnompbar+$stbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	
	
	
if($lotno!="")
{
$sno3=$sno3+1;
?>
<tr class="light" height="25">
  <td align="center"  valign="middle" class="smalltbltext"><?php if($lotno==""){ ?><a href="Javascript:void(0);" onclick="unidupdate('<?php echo $sbinval?>', '<?php echo $crop?>', '<?php echo $variety?>', '<?php echo $oupsize?>', '<?php echo $txtpsrn?>', '<?php echo $trrid?>', '<?php echo $otnop?>', '<?php echo $otqty?>')">Update</a><?php } else { echo $lotno; }?><input type="hidden" name="txtlotno<?php echo $sno3?>" id="txtlotno<?php echo $sno3?>" value="<?php echo $lotno?>" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>


<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php if($totnompbar>0) { ?><a href="Javascript:void(0);" onclick="showbarc('<?php echo $nobcd;?>');"><?php echo $totnompbar;?></a><?php } else { echo $totnompbar; }?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="0" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $totpchbar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $tqtybar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $totnompbar?></td> 
<td align="center" valign="middle" class="tbltext"><?php if($lotno!=""){ ?><a href="Javascript:void(0);" onclick="unlinkbarc(<?php echo $sno3;?>);">Un-Link</a><?php } ?></td> 
<td align="center" valign="middle" class="tbltext"><?php if($lotno!=""){ ?><a href="Javascript:void(0);" onclick="linkbarc('<?php echo $lotno?>');">Link</a><?php } ?></td> 
</tr>
<?php
}
}
}
?>


</table>
<br />
<input type="hidden" name="sno3" value="<?php echo $sno3;?>" />
<div id="subsubdivdamage" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC - Damage</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhd1" style="width:70px;" onchange="whd1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bind1">&nbsp;
        <select class="tbltext" name="txtslbind1" style="width:60px;" onchange="bind1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbind1">&nbsp;
        <select class="tbltext" name="txtslsubbd1" style="width:80px;" onchange="subbind1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsd1" id="Bagsd1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qtyd1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <input type="hidden" name="dorowid1" value="0" />
  <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <!--<tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhd2" style="width:70px;" onchange="whd2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
          <option value="<?php echo $noticia_whd2['whid'];?>" />  
          <?php echo $noticia_whd2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bind2">&nbsp;
        <select class="tbltext" name="txtslbind2" style="width:60px;" onchange="bind2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbind2">&nbsp;
        <select class="tbltext" name="txtslsubbd2" style="width:80px;" onchange="subbind2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsd2" id="Bagsd2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsfd2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qtyd2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>-->
      </table>
    </div></td>
    <input type="hidden" name="dorowid2" value="0" />
  </tr>

</table>
</div>

<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $trrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp;?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1;?>" /><input type="hidden" name="wtmp" id="wtmp" value="<?php echo $wtinmp;?>" /><input type="hidden" name="wtnop" id="wtnop" value="" /><input type="hidden" name="otnop" value="<?php echo $otnop?>" /><input type="hidden" name="otqty" value="<?php echo $otqty?>" /><input type="hidden" name="ocrp" value="<?php echo $_REQUEST['c']?>" /><input type="hidden" name="overty" value="<?php echo $_REQUEST['f']?>" /><input type="hidden" name="oups" value="<?php echo $_REQUEST['g']?>" /><input type="hidden" name="sreciptyp" value="verrec" />