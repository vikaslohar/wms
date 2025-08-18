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
	$lotn = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
	$crop = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	$variety = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
	$upss = $_GET['f'];	 
	}
//echo $a;  PNPSLIP

$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

$nop=0; $qty=0; $qc=""; $dot=""; $got=""; $dogt=""; 
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
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
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	$nop1=($ptp*$penqty);
	else
	$nop1=($penqty/$ptp);
}

$nop=$nop+$nop1; 
$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$qty+$row_issuetbl['balqty'];

$qc=$row_issuetbl['lotldg_qc'];
$orlot=$row_issuetbl['orlot'];

$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];

$dgt=explode("-",$row_issuetbl['lotldg_gottestdate']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$gt=explode(" ",$row_issuetbl['lotldg_got1']);
$got=$gt[0]." ".$row_issuetbl['lotldg_got'];

if($dot=="0000-00-00" || $dot=="--" || $dot=="- -")$dot="";
if($dogt=="0000-00-00" || $dogt=="--" || $dogt=="- -")$dogt="";
}
}

$zzz=implode(",", str_split($lotn));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where plantcode='$plantcode' and SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where plantcode='$plantcode' and SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."C";
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."C";

$tflg=0;
$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."' and trtype='Qty-Rem'") or die(mysqli_error($link)); 
$tot_istbl=mysqli_num_rows($sql_istbl);

$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."' and trtype='Dispatch'") or die(mysqli_error($link)); 
$tot_istbl2=mysqli_num_rows($sql_istbl2);

if($tot_istbl > 0 || $tot_istbl2 > 0)$tflg++;
if($nomp > 0)$tflg++;

?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<input name="txtenop" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nop;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right" width="236" valign="middle" class="tblheading">NoMP&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txtenomp" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nomp;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txteqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $qty;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txteqc" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $qc;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtedot" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dot;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtegot" type="text" size="15" class="tbltext" tabindex=""   maxlength="15" onkeypress="return isNumberKey1(event)" value="<?php echo $got;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtedogt" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dogt;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">P2C&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;Entire&nbsp;<input type="hidden" name="ptptype" value="Entire" /></td>
<td align="left"  valign="middle" class="tblheading" colspan="2" id="batchchk">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">P2C Lot number&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtnewlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" value="<?php echo $abc23;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />
</table>
<br />
<div id="showlotsloc">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="13" align="center" valign="middle" class="tblheading">Existing SLOC Details</td>
</tr>
<tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="tblheading">#</td>
	<td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing NoMP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance NoMP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance Qty</td>
</tr>
<?php
$sno=0;
//if($tflg == 0)
{
$lotqry2=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."'") or die(mysqli_error($link));
$tot_row2=mysqli_num_rows($lotqry2);

$enop=0; $eqty=0;
while($row_issue2=mysqli_fetch_array($lotqry2))
{ 
$sql_issue12=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue2['subbinid']."' and binid='".$row_issue2['binid']."' and whid='".$row_issue2['whid']."' and lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and packtype='".$upss."' and lotno='".$lotn."' ") or die(mysqli_error($link));
$row_issue12=mysqli_fetch_array($sql_issue12); 

$sql_issuetbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue12[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl2=mysqli_fetch_array($sql_issuetbl2))
{
$nop12=0; $ptp12=0;
$ups2=$row_issuetbl2['packtype'];
$wtinmp2=$row_issuetbl2['wtinmp'];
$upspacktype2=$row_issuetbl2['packtype'];
$packtp2=explode(" ",$upspacktype2);
$packtyp2=$packtp2[0]; 
if($packtp2[1]=="Gms")
{ 
	$ptp2=(1000/$packtp2[0]);
	$ptp12=($packtp2[0]/1000);
}
else
{
	$ptp2=$packtp2[0];
	$ptp12=$packtp2[0];
}
if($row_issuetbl2['balnomp']>0)
$penqty2=(($row_issuetbl2['balqty'])-($wtinmp2*$row_issuetbl2['balnomp']));
else
$penqty2=$row_issuetbl2['balqty'];
if($penqty2 > 0)
{
	if($packtp[1]=="Gms")
	$nop12=($ptp2*$penqty2);
	else
	$nop12=($penqty2/$ptp2);
}
if($row_issuetbl2['balnomp']>0 && $penqty2<=0)
$penqty2=$row_issuetbl2['balqty'];

$enop=$nop12; 
$enomp=$row_issuetbl2['balnomp'];
$eqty=$row_issuetbl2['balqty'];

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl2['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl2['binid']."' and whid='".$row_issuetbl2['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl2['subbinid']."' and binid='".$row_issuetbl2['binid']."' and whid='".$row_issuetbl2['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$sno++;
?>
<tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $sno;?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="ewh<?php echo $sno;?>" id="ewh_<?php echo $sno;?>" value="<?php echo $row_issuetbl2['whid'];?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="87" align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="ebin<?php echo $sno;?>" id="ebin_<?php echo $sno;?>" value="<?php echo $row_issuetbl2['binid'];?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="107" align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="esbin<?php echo $sno;?>" id="esbin_<?php echo $sno;?>" value="<?php echo $row_issuetbl2['subbinid'];?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $enop;?><input type="hidden" name="enop<?php echo $sno;?>" id="enop_<?php echo $sno;?>" value="<?php echo $enop;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $enop;?><input type="hidden" name="enomp<?php echo $sno;?>" id="enomp_<?php echo $sno;?>" value="<?php echo $enomp;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $eqty;?><input type="hidden" name="eqty<?php echo $sno;?>" id="eqty_<?php echo $sno;?>" value="<?php echo $eqty;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="nop<?php echo $sno;?>" id="nop_<?php echo $sno;?>" value="<?php echo $enop;?>" size="6" maxlength="6" onchange="chknop(this.value,'<?php echo $sno;?>')" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="nomp<?php echo $sno;?>" id="nomp_<?php echo $sno;?>" value="<?php echo $enomp;?>" size="6" maxlength="6" onchange="chknop(this.value,'<?php echo $sno;?>')" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="qty<?php echo $sno;?>" id="qty_<?php echo $sno;?>" value="<?php echo $eqty;?>" size="6" maxlength="6" onchange="chkqty(this.value,'<?php echo $sno;?>')" readonly="true" style="background-color:#CCCCCC"  /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="bnop<?php echo $sno;?>" id="bnop_<?php echo $sno;?>" value="0" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="bnomp<?php echo $sno;?>" id="bnomp_<?php echo $sno;?>" value="0" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="bqty<?php echo $sno;?>" id="bqty_<?php echo $sno;?>" value="0" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
}
}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" />
</table>
<br />

</div>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Condition Seed - SLOC Details</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,'1');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,'1');" >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,'1');"  >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td align="right" width="44"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'1');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="40"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'1');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,'2');" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,'2');"  >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,'2');" >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="83" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'2');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="40" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'2');" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

</table>