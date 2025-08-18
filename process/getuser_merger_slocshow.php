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
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >List of Lots for Blending</td>
  </tr>
</table>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
  <!--<tr class="tblsubtitle" height="20">

 <td colspan="4" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>-->
<tr class="tblsubtitle" height="20">
<td width="30" align="center" valign="middle" class="tblheading">#</td>
<td width="90" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="146" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="76" align="center" valign="middle" class="tblheading">QC Status</td>
<td width="107" align="center" valign="middle" class="tblheading">GOT Status</td>
<td width="47" align="center" valign="middle" class="tblheading">GOT Grade</td>
<td width="97" align="center" valign="middle" class="tblheading">Status</td>
<td width="118" align="center" valign="middle" class="tblheading">NoB</td>
<td width="100" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $totalups=0; $totalqty=0; 
$pl=explode(",", $h);
foreach($pl as $val)
{
if($val<>"")
{
$rtotalups=0; $rtotalqty=0; $qc=""; $got=""; $blends_sstatus="";
if($stage=="Raw")
{ 
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$a."' and lotldg_variety='".$b."' and lotldg_sstage='".$c."' and lotldg_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
}
else if($stage=="Condition")
{ 
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$a."' and lotldg_variety='".$b."' and lotldg_sstage='".$c."' and lotldg_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
}
else
{ 
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$a."' and lotldg_variety='".$b."' and lotldg_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
}
$trtr=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$b."'  and lotldg_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
$cnt++;
$qc=$row_issuetbl['lotldg_qc']; 
$got123=explode(" ",$row_issuetbl['lotldg_got1']); 
$got=$got123[0]." ".$row_issuetbl['lotldg_got']; 
if($row_issuetbl['lotldg_srflg']==1 && $got123[0]=="GOT-R")
$blends_sstatus="SSR";
else if($row_issuetbl['lotldg_srflg']==1 && $got123[0]=="GOT-NR")
$blends_sstatus="SR";
else
$blends_sstatus=" ";
$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];

}
}

$gotgrade='';
$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
$gotgrade=$row_tbl_gotgrade['gotgrade_finalgrade'];

$qry_tbl_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$val."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tbl_gottest=mysqli_num_rows($qry_tbl_gottest);	
$row_tbl_gottest=mysqli_fetch_array($qry_tbl_gottest);	
if($row_tbl_gottest['grade']!='' && $row_tbl_gottest['grade']!=NULL && $row_tbl_gottest['grade']!='NULL')
{$gotgrade=$row_tbl_gottest['grade'];}

$totalups=$totalups+$rtotalups;
$totalqty=$totalqty+$rtotalqty;
if($srno%2!=0)
{
 ?>
 <tr <?php $zz=str_split($val);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") echo "bgcolor='#EE9A4D'"; else if($mlot>=90000 && $llot!="00000") echo "bgcolor='#FFE5B4'"; else "class='Light'"?> height="25">
 <td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" checked="checked" id="slocissue<?php echo $srno;?>" name="slocissue" value="<?php echo $val;?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="lotno_<?php echo $srno;?>" name="lotno_<?php echo $srno;?>" value="<?php echo $val;?>" /><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="qcst_<?php echo $srno;?>" name="qcst_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $qc;?>" size="10" /><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="gotst_<?php echo $srno;?>" name="gotst_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $got;?>" size="10" /><?php echo $got;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $gotgrade;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="srst_<?php echo $srno;?>" name="srst_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $blends_sstatus;?>" size="10" /><?php echo $blends_sstatus;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><input type="hidden" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalups;?>" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?><input type="hidden" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalqty;?>" size="10" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr <?php $zz=str_split($val);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") echo "bgcolor='#EE9A4D'"; else if($mlot>=90000 && $llot!="00000") echo "bgcolor='#FFE5B4'"; else "class='Dark'"?> height="25">
 <td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" checked="checked" id="slocissue<?php echo $srno;?>" name="slocissue" value="<?php echo $val;?>" onclick="checkchk('<?php echo $srno;?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="lotno_<?php echo $srno;?>" name="lotno_<?php echo $srno;?>" value="<?php echo $val;?>" /><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="qcst_<?php echo $srno;?>" name="qcst_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $qc;?>" size="10" /><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="gotst_<?php echo $srno;?>" name="gotst_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $got;?>" size="10" /><?php echo $got;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $gotgrade;?></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="srst_<?php echo $srno;?>" name="srst_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $blends_sstatus;?>" size="10" /><?php echo $blends_sstatus;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><input type="hidden" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalups;?>" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?><input type="hidden" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rtotalqty;?>" size="10" /></td>
 </tr>
 <?php
 }$srno++;
 }
 }
  ?>
  <tr class="Dark" height="25">
  <td align="center" valign="middle" class="tblheading" style="display:none">&nbsp;</td>
  <td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">Total</td>
<td align="center" valign="middle" class="tblheading" colspan="4">&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totalups;?><input name="totalmnob" id="totalmnob" class="tbltext" type="hidden" value="<?php echo $totalups;?>" readonly="true" style="background-color:#CCCCCC" size="9" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?><input name="totalmqty" id="totalmqty" class="tbltext" type="hidden" value="<?php echo $totalqty;?>" readonly="true" style="background-color:#CCCCCC" size="12" /></td>
 </tr>
</table>
<input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value="<?php echo $h?>"/> <input type="hidden" name="srno1" value="<?php echo $srno-1;?>"/><input type="hidden" name="srno2" value="" />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr height="10"><td></td></tr>
  <tr height="20">
    <td width="448"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#EE9A4D" class="tblheading" >&nbsp;</td>
    <td width="80"  align="left" valign="middle" class="tblheading" >&nbsp;Blended Lot</td>
    <td width="15"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#FFE5B4" class="tblheading" >&nbsp;</td>
    <td width="147"  align="left" valign="middle" class="tblheading" >&nbsp;Sales Return Blended Lot</td>
  </tr>
</table>
<!--
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Subbin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>

  <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg1" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing1"><select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing1"><select class="smalltbltext" name="txtslsubbg1" id="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob1" id="txtconslnob1" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,1);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty1" id="txtconslqty1" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,1);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
    <tr class="Light" height="25">
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg2" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bing2"><select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbing2"><select class="smalltbltext" name="txtslsubbg2" id="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
</table>-->
<br />
