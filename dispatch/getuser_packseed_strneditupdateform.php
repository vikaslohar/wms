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
	
if(isset($_REQUEST['a'])) { $maintrid= $_REQUEST['a']; }
if(isset($_REQUEST['b'])) { $subtrid= $_REQUEST['b']; }

	$z1=$maintrid;
		
	$tdate11=$date;
	$tday1=substr($tdate11,0,2);
	$tmonth1=substr($tdate11,3,2);
	$tyear1=substr($tdate11,6,4);
	$tdate1=$tyear1."-".$tmonth1."-".$tday1;
	
	$sql_m=mysqli_query($link,"SELECT * FROM tbl_stoutmpack where stoutmp_id='$z1'"); 
	$row_m=mysqli_fetch_array($sql_m);
	
	$txtstfp=$row_m['stoutmp_plantid'];
	
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$pltcode=$row_month['code'];
	
	$quer5=mysqli_query($link,"SELECT distinct stcode FROM tbl_partymaser where p_id='$txtstfp' order by stcode asc"); 
	$noticia2 = mysqli_fetch_array($quer5); 
	$plantcode=$noticia2['stcode'];
	//echo "SELECT * FROM tbl_stoutspack where stoutsp_id='$subtrid'";
	$sql_sub=mysqli_query($link,"SELECT * FROM tbl_stoutspack where stoutsp_id='$subtrid'"); 
	$row_sub=mysqli_fetch_array($sql_sub);
	$txtlot1=$row_sub['stoutsp_lotno'];
	$g=$row_sub['stoutsp_ups']; 
	$ups=explode(" ",$g);
?>	

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Form</td>
</tr>

<?php   
$quer33=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['stoutsp_variety']."'"); 
$row_quer33 = mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
	<td width="144" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
	<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_quer33['cropid']?><input name="txtcrop" type="hidden" value="<?php echo $row_quer33['cropname']?>" ></td>
	<td width="122" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
	<td width="347" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $row_quer33['popularname']?><input name="txtvariety" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $row_quer33['varietyid']?>" readonly="true" style="background-color:#CCCCCC" ></td>	
</tr>

<tr class="Dark" height="30">
	<td width="144" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext" id="upstp">&nbsp;<?php echo $row_sub['stoutsp_ups']?><input name="txtstage" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $row_sub['stoutsp_ups']?>" readonly="true" style="background-color:#CCCCCC" ></td>

	<td width="122" align="right"  valign="middle" class="tblheading">Select Lot Nos.&nbsp;</td>
	<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['stoutsp_lotno']?><input name="txtlot1" type="hidden" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $row_sub['stoutsp_lotno']?>" readonly="true" style="background-color:#CCCCCC" ></td>	
</tr>
</table>
<br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="22" align="center" class="tblheading">Lot No. &nbsp;<?php echo $txtlot1." - Stock"?></td>
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
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stoutsp_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$cro=$noticia_class['cropname'];
//echo "select varietyid, popularname from tblvariety where varietyid='".$c."'";
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stoutsp_variety']."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variet=$noticia_item['popularname'];

$elotn=explode(",",$txtlot1);
foreach($elotn as $ltno)
{
if($ltno<>"")
{
//echo $g;
$nomp=0; $totnob=""; $qtynob=""; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $gotyp=""; $got=""; $dogt=""; $pp=""; $moist=""; $alqty=""; $alnomp=""; $alnob=""; $avlqty=""; $avlnomp=""; 
$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$row_sub['stoutsp_crop']."' and lotno='".$ltno."' and lotldg_variety='".$row_sub['stoutsp_variety']."' and packtype='".$row_sub['stoutsp_ups']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$row_sub['stoutsp_crop']."' and lotno='".$ltno."' and lotldg_variety='".$row_sub['stoutsp_variety']."' and packtype='".$row_sub['stoutsp_ups']."' order by lotdgp_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
	//echo "select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc";			
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			//$qc=$row_issuetbl['lotldg_qc']; 
			//$germ=$row_issuetbl['lotldg_gemp']; 
			//$pp=$row_issuetbl['lotldg_vchk']; 
			//$moist=$row_issuetbl['lotldg_moisture']; 
			$alqty=$row_issuetbl['lotldg_alqtys'];
			$alnomp=$row_issuetbl['lotldg_alnomps'];
			
			$alqty1=$alqty-($alnomp*$row_issuetbl['wtinmp']);
			
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
$sql_sub1=mysqli_query($link,"SELECT * FROM tbl_stoutspack where stoutsp_id='$subtrid'"); 
$row_sub1=mysqli_fetch_array($sql_sub1);
$tobenop=$row_sub1['stoutsp_tbnop'];
$tobenomp=$row_sub1['stoutsp_tbnomp'];
$tobeqty=$row_sub1['stoutsp_tbqty'];
$loadnomp=$row_sub1['stoutsp_loadnomp'];
$loadqty=$row_sub1['stoutsp_loadqty'];
$grswt=$row_sub1['stoutsp_loadgrswt'];
$balnop=$row_sub1['stoutsp_balnop'];
$balnomp=$row_sub1['stoutsp_balnomp'];
$balqty=$row_sub1['stoutsp_balqty'];
//echo $totnob." - ".$tobenop;
$balstnop=$totnob-$tobenop;
$balstnomp=$avlnomp-$tobenomp;
$balstqty=$avlqty-$tobeqty;
//echo $balstnop;
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
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlnomp?><input type="hidden" name="txtavlnomp" id="eltno_<?php echo $sn;?>" value="<?php echo $ltno;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $avlqty?><input type="hidden" name="txtavlqty" id="estage_<?php echo $sn;?>" value="<?php echo $g;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="txttobenop" id="txttobenop" value="<?php echo $tobenop?>" onchange="stocknop(this.value)"/></td>    
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="3" name="txttobenomp" id="txttobenomp" value="<?php echo $tobenomp?>" onchange="stocknomp(this.value)" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="7" name="txttobeqty" id="txttobeqty" value="<?php echo $tobeqty?>" onchange="stockqty(this.value)" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $tobenop;?><input type="hidden" size="3" name="loadnop" id="enob_<?php echo $sn;?>" value="<?php echo $loadnop;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $loadnomp;?><input type="hidden" size="3" name="loadnomp" id="enob_<?php echo $sn;?>" value="<?php echo $loadnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $loadqty;?><input type="hidden" size="7" name="loadqty" id="eqty_<?php echo $sn;?>" value="<?php echo $loadqty;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="loadgrswt" id="enob_<?php echo $sn;?>" value="<?php echo $totnob;?>" /></td>
	
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $balnop;?><input type="hidden" name="balloadnop" value="<?php echo $totnob;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $balnomp;?><input type="hidden" name="balloadnomp" value="<?php echo $totqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $balqty;?><input type="hidden" name="balloadqty" value="<?php echo $totqty;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balnop" id="balnop" value="<?php echo $balstnop;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balnomp" id="balnomp" value="<?php echo $balstnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" size="4" name="balqty" id="balqty" value="<?php echo $balstqty;?>" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
$sn++;
}
}
}

?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" />
</table>
<br /><input type="hidden" name="totbarcs" value="<?php echo $barc;?>" />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Loading</td></tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcode" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Loading (Unloading)</td> </tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />&nbsp;<font color="#FF0000">*  Deleted Barcode will be stored back to its original SLOC Bin</font></td></tr>
</table><br />
<input type="hidden" name="maintrid" value="<?php echo $maintrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtrid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>