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
	
	if(isset($_GET['a']))
	{
  		$a = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
  		$trid = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
  		$typ = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
  		$f = $_GET['f'];	 
	}
	
$stge="Pack";
$flgs=0; $tbflg=0;

$sql_bar=mysqli_query($link,"select * from tbl_barcodes where plantcode='$plantcode' AND bar_barcode='".$a."'")or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
$tot_bar=mysqli_num_rows($sql_bar);

$sql_srbar=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_barcode='".$a."' and btslsub_lnkflg=1")or die(mysqli_error($link));
$row_srbar=mysqli_fetch_array($sql_srbar);
$tot_srbar=mysqli_num_rows($sql_srbar);

if($tot_bar > 0) $tbflg=1;
if($tot_srbar > 0)
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Barcode Details - <font color="#FF0000"\>Duplicate Barcode</font></td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Barcode Details - <?php if($tbflg > 0) {?><font color="#000099">Identified</font><input type="hidden" name="txtbctyp" value="Identified" /><?php } else {?><font color="#FF0000"\>Un-Identified</font><input type="hidden" name="txtbctyp" value="Un-Identified" /><?php } ?></td>
</tr>
</table>
<?php
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
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="156" align="right" valign="middle" class="smalltblheading">Barcode&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $a?><input type="hidden" name="txtbarcode" value="<?php echo $a;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">Packtype&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packtyp?><input type="hidden" name="txtpacktype" value="<?php echo $packtyp;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">DoP&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dop?><input type="hidden" name="txtedop" value="<?php echo $dop;?>" /></td>
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
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
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="156" align="right" valign="middle" class="smalltblheading">Barcode&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $a?><input type="hidden" name="txtbarcode" value="<?php echo $a;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">Packtype&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $packtyp?><input type="hidden" name="txtpacktype" value="<?php echo $packtyp;?>" /></td>
	<td width="156" align="right" valign="middle" class="smalltblheading">DoP&nbsp;</td>
	<td width="156" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $dop?><input type="hidden" name="txtedop" value="<?php echo $dop;?>" /></td>
</tr>
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">
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

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" ><font color="#FF0000"\>Barcode Not Generated</font></td>
</tr>
</table>
<br />
<!--
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" ><font color="#FF0000"\>Barcode cannot be added here, as it is already present in stock of other plant</font></td>
</tr>
</table>-->
<?php
}
}
?>
<br />
<?php
$slocs=""; $cont=0;
$sql_bstsubsub=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$row_srbar['btslsub_id']."' and btslss_slcflg=0") or die(mysqli_error($link));
if($tot_bstsubsub=mysqli_num_rows($sql_bstsubsub) > 0)
{
	while($row_bstsubsub=mysqli_fetch_array($sql_bstsubsub))
	{
		if($slocs!="")$slocs=$slocs.",".$row_bstsubsub['btslss_subbin'];
		else $slocs=$row_bstsubsub['btslss_subbin'];
		
		$cont++;
	}
}
$sql_bstsubsub2=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$row_srbar['btslsub_id']."' and btslss_slcflg=0") or die(mysqli_error($link));
if($tot_bstsubsub2=mysqli_num_rows($sql_bstsubsub2) > 0)
{
	while($row_bstsubsub2=mysqli_fetch_array($sql_bstsubsub2))
	{
		if($slocs!="")$slocs=$slocs.",".$row_bstsubsub2['btslss_subbin'];
		else $slocs=$row_bstsubsub2['btslss_subbin'];
		
		$cont++;
	}
} 
?>

<?php
}
?>