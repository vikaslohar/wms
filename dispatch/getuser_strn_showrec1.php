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
$ups=explode(" ",$g);
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="22" align="center" class="tblheading">Lot No. &nbsp;<?php echo $a." - Stock"?></td>
</tr> 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="3">Existing</td>
	<td align="center" class="smalltblheading" colspan="3">Allocated</td>
	<td align="center" class="smalltblheading" colspan="3">Available</td>
	<td align="center" class="smalltblheading" colspan="3">To be Dispatch</td>
	<td width="57" align="center" class="smalltblheading" rowspan="2">Loaded NoP</td>
	<td width="57" align="center" class="smalltblheading" rowspan="2">Loaded NoMP</td>
	<td width="55" align="center" class="smalltblheading" rowspan="2">Loaded Qty</td>
	<td width="52" align="center" class="smalltblheading" rowspan="2">Gross Wt.</td>
	<td align="center" class="smalltblheading" colspan="3">Balance To be Loaded</td>
	<td align="center" class="smalltblheading" colspan="3">Balance in Stock</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="32" align="center" class="smalltblheading">NoP</td>
	<td width="44" align="center" class="smalltblheading">NoMP</td>
	<td width="31" align="center" class="smalltblheading">Qty</td>
	<td width="32" align="center" class="smalltblheading">NoP</td>
	<td width="44" align="center" class="smalltblheading">NoMP</td>
	<td width="31" align="center" class="smalltblheading">Qty</td>
	<td width="29" align="center" class="smalltblheading">NoP</td>
	<td width="44" align="center" class="smalltblheading">NoMP</td>
	<td width="31" align="center" class="smalltblheading">Qty</td>
	<td width="45" align="center" class="smalltblheading">NoP</td>
	<td width="55" align="center" class="smalltblheading">NoMP</td>
	<td width="55" align="center" class="smalltblheading">Qty</td>
	<td width="43" align="center" class="smalltblheading">NoP</td>
	<td width="57" align="center" class="smalltblheading">NoMP</td>
	<td width="44" align="center" class="smalltblheading">Qty</td>
	<td width="42" align="center" class="smalltblheading">NoP</td>
	<td width="43" align="center" class="smalltblheading">NoMP</td>
	<td width="40" align="center" class="smalltblheading">Qty</td>
</tr>
<input type="hidden" name="ups" value="<?php echo $ups[0];?>" />
<input type="hidden" name="upstyp" value="<?php echo $ups[1];?>" />
<?php 
$sn=1;
//echo "select cropid, cropname from tblcrop where cropid='".$b."' order by cropname";
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$b."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$cro=$noticia_class['cropname'];
//echo "select varietyid, popularname from tblvariety where varietyid='".$c."'";
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$c."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variet=$noticia_item['popularname'];

$elotn=explode(",",$a);
foreach($elotn as $ltno)
{
if($ltno<>"")
{
//echo $g;
$nomp=0; $totnob=""; $qtynob=""; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $gotyp=""; $got=""; $dogt=""; $pp=""; $moist=""; $alqty=""; $alnomp=""; $alnob=""; $avlqty=""; $avlnomp=""; 
$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='".$b."' and lotno='".$ltno."' and lotldg_variety='".$c."' and packtype='".$g."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$b."' and lotno='".$ltno."' and lotldg_variety='".$c."' and packtype='".$g."' order by lotdgp_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$alqty=$row_issuetbl['lotldg_alqtys'];
			
			$alnomp=$row_issuetbl['lotldg_alnomps'];
			
			$alqty1=$alqty -($alnomp*$row_issuetbl['wtinmp']);
			
			$ups=explode(" ",$row_issuetbl['packtype']);
			
			if($ups[1]=="Gms")
				$alnob=($alqty1*1000)/$ups[0];
			if($ups[1]=="Kgs")
				$alnob=$alqty1/$ups[0];	
			
			
			$got1=explode(" ",$row_issuetbl['lotldg_got1']);
			$gotyp=$got1[0];
			$got2=$row_issuetbl['lotldg_got'];
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['balqty']; 
			$nomp=$nomp+$row_issuetbl['balnomp'];
			$qtynob=$totqty-($row_issuetbl['wtinmp']*$nomp);
			
			if($ups[1]=="Gms")
				$totnob=($qtynob*1000)/$ups[0];
			if($ups[1]=="Kgs")
				$totnob=$qtynob/$ups[0];	
			
			$avlqty=$totqty-$alqty; 
			$avlnomp=$nomp-$alnomp; 
			
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
			
			$wtinmp=$row_issuetbl['wtinmp'];
		}	
	}
}

if($totqty > 0)	 
{
?>
<input type="hidden" name="wtmp" value="<?php echo $wtinmp;?>" />
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?><input type="hidden" name="enop" value="<?php echo $totnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nomp?><input type="hidden" name="enomp" value="<?php echo $nomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?><input type="hidden" name="eqty" value="<?php echo $totqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $alnob;?><input type="hidden" name="txtalnop" value="<?php echo $alnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $alnomp;?><input type="hidden" name="txtalnomp" value="<?php echo $alnomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $alqty;?><input type="hidden" name="txtalqty" value="<?php echo $alqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob;?><input type="hidden" name="txtavlnop" value="<?php echo $totnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlnomp?><input type="hidden" name="txtavlnomp" id="eltno_<?php echo $sn;?>" value="<?php echo $avlnomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlqty?><input type="hidden" name="txtavlqty" id="estage_<?php echo $sn;?>" value="<?php echo $avlqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="txttobenop" id="txttobenop" value="" onchange="stocknop(this.value)"/></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="3" name="txttobenomp" id="txttobenomp" value="" onchange="stocknomp(this.value)" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="7" name="txttobeqty" id="txttobeqty" value="" onchange="stockqty(this.value)" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="hidden" name="loadnop" value=""/></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="hidden" name="loadnomp" value=""/></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="hidden" name="loadqty" value=""/></td>
	
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="loadgrswt" value="<?php echo $grswt;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob;?><input type="hidden" name="balloadnop" value="<?php echo $totnob;?>"/></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlnomp?><input type="hidden" name="balloadnomp" value="<?php echo $avlnomp;?>"/></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlqty?><input type="hidden" name="balloadqty" value="<?php echo $avlqty;?>"/></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balnop" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balnomp" value="" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balqty" value="" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
$sn++;
}
}
}

?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" />
</table>
