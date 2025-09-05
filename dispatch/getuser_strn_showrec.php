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
if(isset($_GET['a']))
{
	$b = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$c = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	$h = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$g = $_GET['g'];	 
}

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="7" align="center" class="tblheading">Lot Details</td>
</tr> 
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
</tr>
<?php 
$sn=1;
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$b."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$cro=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$c."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variet=$noticia_item['popularname'];

$elotn=explode(",",$a);
foreach($elotn as $ltno)
{
if($ltno<>"")
{

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $gotyp=""; $got=""; $dogt=""; $pp=""; $moist="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$b."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$c."' and lotldg_sstage='".$g."' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$b."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$c."' and lotldg_sstage='".$g."' order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$qc=$row_issuetbl['lotldg_qc']; 
			$germ=$row_issuetbl['lotldg_gemp']; 
			$pp=$row_issuetbl['lotldg_vchk']; 
			$moist=$row_issuetbl['lotldg_moisture']; 
			
			$got1=explode(" ",$row_issuetbl['lotldg_got1']);
			$gotyp=$got1[0];
			$got2=$row_issuetbl['lotldg_got'];
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
			$totnob=$totnob+$row_issuetbl['lotldg_balbags'];		
			
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$dot=$rday."-".$rmonth."-".$ryear;
			
			$rgdate=$row_issuetbl['lotldg_gottestdate'];
			$rgyear=substr($rgdate,0,4);
			$rgmonth=substr($rgdate,5,2);
			$rgday=substr($rgdate,8,2);
			$dogt=$rgday."-".$rgmonth."-".$rgyear;
						
			if($dot=="00-00-0000" || $dot=="--")$dot="";	
			if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
			
			if($qc=="RT" || $qc=="UT")$dot="";
			if($got2=="RT" || $got2=="UT")$dogt="";
			
			if($germ<=0)$germ="";
			if($moist<=0)$moist="";
		}	
	}
}

if($totqty > 0)	 
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $b;?>" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $c;?>" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $ltno?><input type="hidden" name="eltno<?php echo $sn;?>" id="eltno_<?php echo $sn;?>" value="<?php echo $ltno;?>" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $g?><input type="hidden" name="estage<?php echo $sn;?>" id="estage_<?php echo $sn;?>" value="<?php echo $g;?>" />	<input type="hidden" name="eqc<?php echo $sn;?>" id="eqc_<?php echo $sn;?>" value="<?php echo $qc;?>" /><input type="hidden" name="edot<?php echo $sn;?>" id="edot_<?php echo $sn;?>" value="<?php echo $dot;?>" /><input type="hidden" name="epp<?php echo $sn;?>" id="epp_<?php echo $sn;?>" value="<?php echo $pp;?>" /><input type="hidden" name="emoist<?php echo $sn;?>" id="emoist_<?php echo $sn;?>" value="<?php echo $moist;?>" /><input type="hidden" name="egemp<?php echo $sn;?>" id="egemp_<?php echo $sn;?>" value="<?php echo $germ;?>" /><input type="hidden" name="egotyp<?php echo $sn;?>" id="egotyp_<?php echo $sn;?>" value="<?php echo $gotyp;?>" /><input type="hidden" name="egot<?php echo $sn;?>" id="egot_<?php echo $sn;?>" value="<?php echo $got2;?>" /><input type="hidden" name="edogt<?php echo $sn;?>" id="edogt_<?php echo $sn;?>" value="<?php echo $dogt;?>" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totnob;?><input type="hidden" name="enob<?php echo $sn;?>" id="enob_<?php echo $sn;?>" value="<?php echo $totnob;?>" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totqty;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $totqty;?>" /></td>
</tr>
<?php
$sn++;
}
}
}

?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" />
</table>