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

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields

/*if(isset($_GET['a']))
	{
	$rid = $_GET['a'];	 
	}*/

if(isset($_REQUEST['b']))
	{
	$typ = $_REQUEST['b'];
	}


if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['salesr_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$trrid =$row_tbl['salesr_id'];
$txtpsrn = $row_tbl['salesr_recallrefno'];
$crop = $row_tbl_sub['salesrs_crop'];
$variety = $row_tbl_sub['salesrs_variety'];
$upsize = $row_tbl_sub['salesrs_ups'];
$oupsize = $row_tbl_sub['salesrs_ups'];
$otnop = $row_tbl_sub['salesrs_nob'];
$otqty = $row_tbl_sub['salesrs_qty'];
$ocrop = $row_tbl_sub['salesrs_crop'];
$overiety = $row_tbl_sub['salesrs_variety'];	
$lotno ='';

if($typ=="verrec")
{
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

$sql_salesvr_subsub2=mysqli_query($link,"select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."' and salesrss_lotno='$lotno'") or die(mysqli_error($link));
while($row_salesvr_subsub2=mysqli_fetch_array($sql_salesvr_subsub2))
{
$dqty=$row_salesvr_subsub2['salesrss_qty'];
}

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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="<?php echo $dqty?>" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
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

$sql_salesvr_subsub2=mysqli_query($link,"select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."' and salesrss_lotno='$lotno'") or die(mysqli_error($link));
while($row_salesvr_subsub2=mysqli_fetch_array($sql_salesvr_subsub2))
{
$dqty=$row_salesvr_subsub2['salesrss_qty'];
}

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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="<?php echo $dqty?>" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
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
$wdh=""; $bdn=""; $sbdh="";
$sql_salesvr_subsub2=mysqli_query($link,"select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub2=mysqli_fetch_array($sql_salesvr_subsub2))
{
$dnop=$dnop+$row_salesvr_subsub2['salesrss_nob'];
$dqty=$dqty+$row_salesvr_subsub2['salesrss_qty'];
$wdh=$row_salesvr_subsub2['salesrss_wh'];
$bdn=$row_salesvr_subsub2['salesrss_bin'];
$sbdh=$row_salesvr_subsub2['salesrss_subbin'];
}

$whd1_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhd1" style="width:70px;" onchange="whd1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option <?php if($wdh==$noticia_whd1['whid'])echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$sql_month=mysqli_query($link,"select binid, binname from tblsrbin where plantcode='$plantcode' AND whid='".$wdh."' order by binname")or die("Error:".mysqli_error($link));
?>		
    <td width="93" align="center"  valign="middle" class="tbltext" id="bind1">&nbsp;
        <select class="tbltext" name="txtslbind1" style="width:60px;" onchange="bind1(this.value);" >
        <option value="" selected>--Bin--</option>
		<?php while($noticia_bing1 = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($bdn==$noticia_bing1['binid'])echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$sql_month2=mysqli_query($link,"select sid, sname from tbldsubbin where plantcode='$plantcode' AND binid='".$bdn."' order by sid")or die("Error:".mysqli_error($link));
?>			
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbind1">&nbsp;
        <select class="tbltext" name="txtslsubbd1" style="width:80px;" onchange="subbind1(this.value);"  >
        <option value="" selected>--Sub Bin--</option>
		<?php while($noticia_subbing1 = mysqli_fetch_array($sql_month2)) { ?>
		<option <?php if($sbdh==$noticia_subbing1['sid'])echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsd1" id="Bagsd1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsfd1(this.value);" value="<?php echo $dnop;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qtyd1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd1(this.value);" value="<?php echo $dqty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<!--<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>-->
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Light" height="30" >
<td width="103" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" width="336" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="pcodeo" style="width:40px;">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onchange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="114" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
<td width="407" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode1(this.value)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>		
</table>	
<div id="crpvershow" style="display:block"></div>
<div id="subsubdivgood" style="display:block">
<?php
$subtid=0;
$subsubtid=0;
if($row_tbl_sub['salesrs_rettype']=="lotn")
{
?>
<?php
$ct=0;
$a=$a."P";
$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$a."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_newlot='".$a."' and salesr_id='".$g."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 && $row_month==0)$val++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
/*if($row_month>0)
{
if($b!=$noticia33['cropid'])$val1++;
if($c!=$noticia_item43['varietyid'])$val1++;
}*/
if($val1>0)$val++;

if($val==0)
{

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$g."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$g."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
//$tid=$row_tbl_sub['salesr_id'];
//$subtid=$row_tbl_sub['salesr_id'];


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

	$wtmp="";$mptnop=""; $srnonew=0;
	$p1_array=explode(",",$noticia_item['gm']);
	$p1_array2=explode(",",$noticia_item['wtmp']);
	$p1_array3=explode(",",$noticia_item['mptnop']);
	$p1=array();
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			if($ups==$rowmonth['packtype'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$rowmonth['packtype']);
	$packtyp=$packtp[0]; 
	$ptp=""; $ptp1="";
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
	
$doot1=explode("-",$rowmonth['lotldg_qctestdate']);
$doot=$doot1[2]."-".$doot1[1]."-".$doot1[0];
if($doot=="--" || $doot=="00-00-0000" || $doot=="NULL")$doot="";
$goot1=explode("-",$rowmonth['lotldg_gottestdate']);
$goot=$goot1[2]."-".$goot1[1]."-".$goot1[0];
if($goot=="--" || $goot=="00-00-0000" || $goot=="NULL")$goot="";

$dop1=explode("-",$rowmonth['lotldg_dop']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
if($dop=="--" || $dop=="00-00-0000" || $dop=="NULL")$dop="";

$dov1=explode("-",$rowmonth['lotldg_valupto']);
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];
if($dov=="--" || $dov=="00-00-0000" || $dov=="NULL")$dov="";
	
$ct++;

?><table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?><input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	


<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
	
?>

<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['packtype'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Wt. in MP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtwtmp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $wtmp;?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">NoP in MP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtmptnop" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $mptnop;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)" onchange="verchk();"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>-->
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoMP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="0" onkeypress="return isNumberKey(event)" onchange="upchk2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qc'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $doot;?>"  />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gemp'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_moisture'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_vchk'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_got'];?>" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgstat" value="<?php $gt=explode(" ",$rowmonth['lotldg_got1']); echo $gt[0];?>" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $goot;?>"  /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $dop;?>" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dov;?>"  /></td>
</tr>
</table>
<?php
}
else
{
require_once("../include/config1.php");
require_once("../include/connection1.php");

$a=$a."P";
$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$a."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_newlot='".$a."' and salesr_id='".$g."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 && $row_month==0)$val++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
/*if($row_month>0)
{
if($b!=$noticia33['cropid'])$val1++;
if($c!=$noticia_item43['varietyid'])$val1++;
}*/
if($val1>0)$val++;

if($val==0)
{

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$g."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$g."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
//$tid=$row_tbl_sub['salesr_id'];
//$subtid=$row_tbl_sub['salesr_id'];


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

	$wtmp="";$mptnop=""; $srnonew=0;
	$p1_array=explode(",",$noticia_item['gm']);
	$p1_array2=explode(",",$noticia_item['wtmp']);
	$p1_array3=explode(",",$noticia_item['mptnop']);
	$p1=array();
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			if($ups==$rowmonth['packtype'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$rowmonth['packtype']);
	$packtyp=$packtp[0]; 
	$ptp=""; $ptp1="";
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

$doot1=explode("-",$rowmonth['lotldg_qctestdate']);
$doot=$doot1[2]."-".$doot1[1]."-".$doot1[0];
if($doot=="--" || $doot=="00-00-0000" || $doot=="NULL")$doot="";
$goot1=explode("-",$rowmonth['lotldg_gottestdate']);
$goot=$goot1[2]."-".$goot1[1]."-".$goot1[0];
if($goot=="--" || $goot=="00-00-0000" || $goot=="NULL")$goot="";

$dop1=explode("-",$rowmonth['lotldg_dop']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
if($dop=="--" || $dop=="00-00-0000" || $dop=="NULL")$dop="";

$dov1=explode("-",$rowmonth['lotldg_valupto']);
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];
if($dov=="--" || $dov=="00-00-0000" || $dov=="NULL")$dov="";
	
$ct++;

?>
<table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?>
      <input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	


<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
	
?>

<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['packtype'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Wt. in MP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtwtmp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $wtmp;?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">NoP in MP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtmptnop" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $mptnop;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)" onchange="verchk();"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>-->
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoMP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="0" onkeypress="return isNumberKey(event)" onchange="upchk2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qc'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $doot;?>"  />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gemp'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_moisture'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_vchk'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_got'];?>" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgstat" value="<?php $gt=explode(" ",$rowmonth['lotldg_got1']); echo $gt[0];?>" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $goot;?>"  /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $dop;?>" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dov;?>"  /></td>
</tr>
</table>
<?php
}
}
if($ct==0)
{
?>
<table align="center" width="970" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;Cannot show Lot Details.</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;Reasons: 1. Lot not present in System(for current Plant application login)</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Lot not Packed(for current Plant application login)</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Crop/Variety mismatch for selected Lot with the verifying record</td>
</tr>
<tr class="Light" height="30">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Lot already received in this Transaction</td>
</tr>
</table>
<?php
}
}
else if($row_tbl_sub['salesrs_rettype']=="barc")
{
?>
<?php
$stge="Pack";
$flgs=0; $tbflg=0; $srno=0;

$sql_bar=mysqli_query($link,"select * from tbl_barcodes where plantcode='$plantcode' AND bar_barcode='".$a."'")or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
$tot_bar=mysqli_num_rows($sql_bar);

$sql_srbar=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_barcode='".$a."'")or die(mysqli_error($link));
$row_srbar=mysqli_fetch_array($sql_srbar);
$tot_srbar=mysqli_num_rows($sql_srbar);

if($tot_bar > 0) $tbflg=1;


if($tbflg > 0)
{

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
$row_mpm=mysqli_fetch_array($sql_mpm);
$pctp=$row_mpm['mpmain_trtype'];		

if($pctp=="PACKSMC")$packtyp="SMC";
if($pctp=="PACKLMC")$packtyp="LMC";
if($pctp=="PACKMMC")$packtyp="MMC";

$dop1=explode("-",$row_mpm['mpmain_date']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="156" align="right" valign="middle" class="smalltblheading">Barcode&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $a?><input type="hidden" name="txtbarcode" value="<?php echo $a;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">Packtype&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packtyp?><input type="hidden" name="txtpacktype" value="<?php echo $packtyp;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">DoP&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dop?><input type="hidden" name="txtedop" value="<?php echo $dop;?>" /></td>
</tr>
</table><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
<td width="14" align="center" valign="middle" class="smalltblheading">#</td>
<td width="80" align="center" valign="middle" class="smalltblheading">Crop</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Variety</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Lot No.</td>
<td width="85" align="center" valign="middle" class="smalltblheading">UPS</td>
<td width="45" align="center" valign="middle" class="smalltblheading">NoP</td>
<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
<td width="40" align="center" valign="middle" class="smalltblheading">QC Stauts</td>
<td width="64" align="center" valign="middle" class="smalltblheading">DoT</td>
<td width="44" align="center" valign="middle" class="smalltblheading">Germ. %</td>
<td width="45" align="center" valign="middle" class="smalltblheading">Moist. %</td>
<td width="51" align="center" valign="middle" class="smalltblheading">PP</td>
<td width="70" align="center" valign="middle" class="smalltblheading">GOT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DGoT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DoV</td>
</tr>
<?php
if($tot_mpm > 0)
{

$llttnn=explode(",",$row_mpm['mpmain_lotno']);
$ccrrop=explode(",",$row_mpm['mpmain_crop']);
$verty=explode(",",$row_mpm['mpmain_variety']);
$upssze=explode(",",$row_mpm['mpmain_upssize']);
$ltnnop=explode(",",$row_mpm['mpmain_lotnop']);
$cnt=count($llttnn);
for($i=0; $i<$cnt; $i++)
{

$lotno=$llttnn[$i];

$crop=""; $variety=""; $slocs=""; $crid=0; $verid=0; $ups=""; $qty=0; $nop=0; $qc=""; $dot=""; $gemp=""; $moist=""; $pp=""; $gottyp=""; $got=""; $dgot=""; $dop=""; $dov="";
	
	$pckt=explode(" ",$upssze[$i]);
	if($pckt[1]=="Gms")
	{ 
		$ptp1=(($pckt[0]*$ltnnop[$i])/1000);
	}
	else
	{
		$ptp1=($pckt[0]*$ltnnop[$i]);
	}
	
	$ups=$upssze[$i];
	$nop=$ltnnop[$i];
	$qty=$ptp1;
	
	$zzz=implode(",", str_split($row_bar['bar_lotno']));
	$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";
	$lotqry=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
	$tot_row=mysqli_num_rows($lotqry);
	
	if($tot_row > 0)
	{
		while($row_issue=mysqli_fetch_array($lotqry))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."'") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{
				$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
				$noticia = mysqli_fetch_array($quer3);
				$crop=$noticia['cropname'];
				$crid=$row_issuetbl['lotldg_crop'];
				
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$variety=$noticia_item['popularname'];
				$verid=$row_issuetbl['lotldg_variety'];
				
				
				
				
				$qc=$row_issuetbl['lotldg_qc'];
				$dot1=explode("-",$row_issuetbl['lotldg_qctestdate']);
				$gemp=$row_issuetbl['lotldg_gemp'];
				$moist=$row_issuetbl['lotldg_moisture'];
				$pp=$row_issuetbl['lotldg_vchk'];
				$gottyp1=explode(" ",$row_issuetbl['lotldg_got1']);
				$got=$row_issuetbl['lotldg_got'];
				$dgot1=explode("-",$row_issuetbl['lotldg_gottestdate']);
				
				$dov1=explode("-",$row_issuetbl['lotldg_valupto']);
				 
				 $gottyp=$gottyp1[0];
				 $dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
				 $dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
				 
				 $dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

				if($slocs!="")$slocs=$slocs.",".$row_issuetbl['subbinid'];
				else $slocs=$row_issuetbl['subbinid'];
			}
		}
	}
}
$samplno="";
if($qc=="UT" || $qc=="RT")
{
$sql_qc=mysqli_query($link,"Select max(tid) from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
$row_qc=mysqli_fetch_array($sql_qc);

$sqlqc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."' and tid='".$row_qc[0]."'") or die(mysqli_error($link));
$rowqc=mysqli_fetch_array($sqlqc);
$samplno=$rowqc['sampno'];
}
	$srno++;			
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?><input type="hidden" name="txtcrop<?php echo $srno;?>" id="txtcrop_<?php echo $srno;?>" value="<?php echo $crid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?><input type="hidden" name="txtvariety<?php echo $srno;?>" id="txtvariety_<?php echo $srno;?>" value="<?php echo $verid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?><input type="hidden" name="txtelotn<?php echo $srno;?>" id="txtelotn_<?php echo $srno;?>" value="<?php echo $lotno;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?><input type="hidden" name="txteups<?php echo $srno;?>" id="txteups_<?php echo $srno;?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nop?><input type="hidden" name="txtenop<?php echo $srno;?>" id="txtenop_<?php echo $srno;?>" value="<?php echo $nop;?>" /></td>	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty?><input type="hidden" name="txteqty<?php echo $srno;?>" id="txteqty_<?php echo $srno;?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?><input type="hidden" name="txteqc<?php echo $srno;?>" id="txteqc_<?php echo $srno;?>" value="<?php echo $qc;?>" /><input type="hidden" name="smplno<?php echo $srno;?>" id="smplno_<?php echo $srno;?>" value="<?php echo $samplno?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?><input type="hidden" name="txtedot<?php echo $srno;?>" id="txtedot_<?php echo $srno;?>" value="<?php echo $dot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp?><input type="hidden" name="txtegerm<?php echo $srno;?>" id="txtegerm_<?php echo $srno;?>" value="<?php echo $gemp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?><input type="hidden" name="txtemoist<?php echo $srno;?>" id="txtemoist_<?php echo $srno;?>" value="<?php echo $moist;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp?><input type="hidden" name="txtepp<?php echo $srno;?>" id="txtepp_<?php echo $srno;?>" value="<?php echo $pp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gottyp." ".$got?><input type="hidden" name="txtegottyp<?php echo $srno;?>" id="txtegottyp_<?php echo $srno;?>" value="<?php echo $gottyp." ".$got?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dgot?><input type="hidden" name="txtedgot<?php echo $srno;?>" id="txtedgot_<?php echo $srno;?>" value="<?php echo $dgot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dov?><input type="hidden" name="txtedov<?php echo $srno;?>" id="txtedov_<?php echo $srno;?>" value="<?php echo $dov;?>" /></td>
</tr>
<?php
}
?>
</table>
<?php
}
else
{
require_once("../include/config1.php");
require_once("../include/connection1.php");

$sql_bar=mysqli_query($link,"select * from tbl_barcodes where plantcode='$plantcode' AND bar_barcode='".$a."'")or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
$tot_bar=mysqli_num_rows($sql_bar);
if($tot_bar > 0)
{

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
$row_mpm=mysqli_fetch_array($sql_mpm);
$pctp=$row_mpm['mpmain_trtype'];		

if($pctp=="PACKSMC")$packtyp="SMC";
if($pctp=="PACKLMC")$packtyp="LMC";
if($pctp=="PACKMMC")$packtyp="MMC";

$dop1=explode("-",$row_mpm['mpmain_date']);
$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="156" align="right" valign="middle" class="smalltblheading">Barcode&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $a?><input type="hidden" name="txtbarcode" value="<?php echo $a;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">Packtype&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packtyp?><input type="hidden" name="txtpacktype" value="<?php echo $packtyp;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">DoP&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dop?><input type="hidden" name="txtedop" value="<?php echo $dop;?>" /></td>
</tr>
</table><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
<td width="14" align="center" valign="middle" class="smalltblheading">#</td>
<td width="80" align="center" valign="middle" class="smalltblheading">Crop</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Variety</td>
<td width="100" align="center" valign="middle" class="smalltblheading">Lot No.</td>
<td width="85" align="center" valign="middle" class="smalltblheading">UPS</td>
<td width="45" align="center" valign="middle" class="smalltblheading">NoP</td>
<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
<td width="40" align="center" valign="middle" class="smalltblheading">QC Stauts</td>
<td width="64" align="center" valign="middle" class="smalltblheading">DoT</td>
<td width="44" align="center" valign="middle" class="smalltblheading">Germ. %</td>
<td width="45" align="center" valign="middle" class="smalltblheading">Moist. %</td>
<td width="51" align="center" valign="middle" class="smalltblheading">PP</td>
<td width="70" align="center" valign="middle" class="smalltblheading">GOT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DGoT</td>
<td width="65" align="center" valign="middle" class="smalltblheading">DoV</td>
</tr>
<?php
if($tot_mpm > 0)
{

$llttnn=explode(",",$row_mpm['mpmain_lotno']);
$ccrrop=explode(",",$row_mpm['mpmain_crop']);
$verty=explode(",",$row_mpm['mpmain_variety']);
$upssze=explode(",",$row_mpm['mpmain_upssize']);
$ltnnop=explode(",",$row_mpm['mpmain_lotnop']);
$cnt=count($llttnn);
for($i=0; $i<$cnt; $i++)
{

$lotno=$llttnn[$i];

$crop=""; $variety=""; $slocs=""; $crid=0; $verid=0; $ups=""; $qty=0; $nop=0; $qc=""; $dot=""; $gemp=""; $moist=""; $pp=""; $gottyp=""; $got=""; $dgot=""; $dop=""; $dov="";
	
	$pckt=explode(" ",$upssze[$i]);
	if($pckt[1]=="Gms")
	{ 
		$ptp1=(($pckt[0]*$ltnnop[$i])/1000);
	}
	else
	{
		$ptp1=($pckt[0]*$ltnnop[$i]);
	}
	
	$ups=$upssze[$i];
	$nop=$ltnnop[$i];
	$qty=$ptp1;
	
	$zzz=implode(",", str_split($row_bar['bar_lotno']));
	$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";
	$lotqry=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
	$tot_row=mysqli_num_rows($lotqry);
	
	if($tot_row > 0)
	{
		while($row_issue=mysqli_fetch_array($lotqry))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."'") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{
				$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
				$noticia = mysqli_fetch_array($quer3);
				$crop=$noticia['cropname'];
				$crid=$row_issuetbl['lotldg_crop'];
				
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$variety=$noticia_item['popularname'];
				$verid=$row_issuetbl['lotldg_variety'];
				
				
				
				
				$qc=$row_issuetbl['lotldg_qc'];
				$dot1=explode("-",$row_issuetbl['lotldg_qctestdate']);
				$gemp=$row_issuetbl['lotldg_gemp'];
				$moist=$row_issuetbl['lotldg_moisture'];
				$pp=$row_issuetbl['lotldg_vchk'];
				$gottyp1=explode(" ",$row_issuetbl['lotldg_got1']);
				$got=$row_issuetbl['lotldg_got'];
				$dgot1=explode("-",$row_issuetbl['lotldg_gottestdate']);
				
				$dov1=explode("-",$row_issuetbl['lotldg_valupto']);
				 
				 $gottyp=$gottyp1[0];
				 $dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
				 $dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
				 
				 $dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

				if($slocs!="")$slocs=$slocs.",".$row_issuetbl['subbinid'];
				else $slocs=$row_issuetbl['subbinid'];
			}
		}
	}
}
if($qc=="UT" || $qc=="RT")
{

$sql_qc=mysqli_query($link,"Select max(tid) from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."'") or die(mysqli_error($link));
$row_qc=mysqli_fetch_array($sql_qc);

$sqlqc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' AND lotno='".$lotno."' and tid='".$row_qc[0]."'") or die(mysqli_error($link));
$rowqc=mysqli_fetch_array($sqlqc);
$samplno=$rowqc['sampno'];
}
	$srno++;			
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?><input type="hidden" name="txtcrop<?php echo $srno;?>" id="txtcrop_<?php echo $srno;?>" value="<?php echo $crid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?><input type="hidden" name="txtvariety<?php echo $srno;?>" id="txtvariety_<?php echo $srno;?>" value="<?php echo $verid;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?><input type="hidden" name="txtelotn<?php echo $srno;?>" id="txtelotn_<?php echo $srno;?>" value="<?php echo $lotno;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?><input type="hidden" name="txteups<?php echo $srno;?>" id="txteups_<?php echo $srno;?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nop?><input type="hidden" name="txtenop<?php echo $srno;?>" id="txtenop_<?php echo $srno;?>" value="<?php echo $nop;?>" /></td>	
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty?><input type="hidden" name="txteqty<?php echo $srno;?>" id="txteqty_<?php echo $srno;?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?><input type="hidden" name="txteqc<?php echo $srno;?>" id="txteqc_<?php echo $srno;?>" value="<?php echo $qc;?>" /><input type="hidden" name="smplno<?php echo $srno;?>" id="smplno_<?php echo $srno;?>" value="<?php echo $samplno?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?><input type="hidden" name="txtedot<?php echo $srno;?>" id="txtedot_<?php echo $srno;?>" value="<?php echo $dot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp?><input type="hidden" name="txtegerm<?php echo $srno;?>" id="txtegerm_<?php echo $srno;?>" value="<?php echo $gemp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?><input type="hidden" name="txtemoist<?php echo $srno;?>" id="txtemoist_<?php echo $srno;?>" value="<?php echo $moist;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp?><input type="hidden" name="txtepp<?php echo $srno;?>" id="txtepp_<?php echo $srno;?>" value="<?php echo $pp;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gottyp." ".$got?><input type="hidden" name="txtegottyp<?php echo $srno;?>" id="txtegottyp_<?php echo $srno;?>" value="<?php echo $gottyp." ".$got?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dgot?><input type="hidden" name="txtedgot<?php echo $srno;?>" id="txtedgot_<?php echo $srno;?>" value="<?php echo $dgot;?>" /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dov?><input type="hidden" name="txtedov<?php echo $srno;?>" id="txtedov_<?php echo $srno;?>" value="<?php echo $dov;?>" /></td>
</tr>
<?php
}
?>

</table>

<?php
}
else
{
?><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" ><font color="#FF0000"\>Barcode Not Generated</font></td>
</tr>
</table>
<?php
}
}
?>
<input type="hidden" name="srrno" value="<?php echo $srno?>" />
<?php
}
else
{
?>
<?php
}
?>
<div id="subsubdivdamage" style="display:block"></div>
</div>
<?php
}
?>
<input type="hidden" name="maintrid" value="<?php echo $trrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp;?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1;?>" /><input type="hidden" name="wtmp" id="wtmp" value="<?php echo $wtinmp;?>" /><input type="hidden" name="wtnop" id="wtnop" value="" /><input type="hidden" name="otnop" value="<?php echo $otnop?>" /><input type="hidden" name="otqty" value="<?php echo $otqty?>" /><input type="hidden" name="ocrp" value="<?php echo $ocrop?>" /><input type="hidden" name="overty" value="<?php echo $overiety?>" /><input type="hidden" name="oups" value="<?php echo $oupsize?>" />
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>