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


if(isset($_REQUEST['b']))
	{
	$trid = $_REQUEST['b'];
	}

if(isset($_GET['a']))
	{
	$sid = $_GET['a'];	 
	}



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$sid."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['salesr_id'];
$subtid=$sid;
$subsubtid=0;

$tpg=$row_tbl_sub['salesrs_qtydc'];
$tpd=$row_tbl_sub['salesrs_qtydamage'];

$sql_srnsr=mysqli_query($link,"select * from tbl_salesrv_nsr where plantcode='$plantcode' AND salesrs_id='$sid' order by srnsr_tcode desc") or die(mysqli_error($link));
$tot_srnsr=mysqli_num_rows($sql_srnsr);
$row_srnsr=mysqli_fetch_array($sql_srnsr);

if($row_srnsr[0]=="" || $row_srnsr[0]==0)
{
	$sqlsrnsr=mysqli_query($link,"select MAX(srnsr_tcode) from tbl_salesrv_nsr where plantcode='$plantcode' AND srnsr_yearcode='$yearid_id' order by srnsr_tcode desc") or die(mysqli_error($link));
	$totsrnsr=mysqli_num_rows($sqlsrnsr);
	$rowsrnsr=mysqli_fetch_array($sqlsrnsr);
	if($totsrnsr>0)
	{
		if($rowsrnsr[0]=="" || $rowsrnsr[0]==0)
		{$nlt=90001;}
		else {$nlt=$rowsrnsr[0]+1;}
	}
	else
	{
		$nlt=90001;
	}
}
else 
{
	$nlt=$row_srnsr[0];
}
$ltnn2=sprintf("%00005d",($nlt));

$zzz2=implode(",", str_split($row_tbl_sub['salesrs_newlot']));
   
$lot1o=$zzz2[4].$zzz2[6].$zzz2[8].$zzz2[10].$zzz2[12];
$lot2o=$zzz2[16].$zzz2[18].$zzz2[20].$zzz2[22].$zzz2[24];
$lot3o=$zzz2[28].$zzz2[30];


$lntflg=0;
if($lot2o==$ltnn2) $lntflg=1; else $lntflg=0;

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);

	$edate1=explode("-",$row_tbl_sub['salesrs_dov']);
	$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
	
	$edate12=explode("-",$row_tbl['salesr_date']);
	$dogtdate=$edate12[2]."-".$edate12[1]."-".$edate12[0];

if($dot=="00-00-0000" || $dot=="--" || $dot=="- -" || $dot=="" || $dot=="NULL")$dot="";
if($dogtdate=="00-00-0000" || $dogtdate=="--" || $dogtdate=="- -" || $dogtdate=="" || $dogtdate=="NULL")$dogtdate="";
	
 $typ=$row_tbl_sub['salesrs_typ'];

if($typ=="verrec")
{

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

/*$upspacktype=$row_issuetbl['packtype'];
	$packtp=explode(" ",$upspacktype);
	$packtyp=$packtp[0]; 
	if($packtp[1]=="Gms")
	{ 
		$ptp=(1000/$packtp[0]);
	}
	else
	{
		$ptp=$packtp[0];
	}*/
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit Item Form</td>
</tr>
<input type="hidden" name="tpys" value="edit" />
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
?>
<tr class="tblsubtitle" height="20">
	<td width="24" align="center" valign="middle" class="tblheading">#</td>
	<td width="171" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="283" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="142" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="173" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="163" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
</tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="right" class="tblheading" width="50%">Sales Return Item as per DC &amp; in matching UPS, found during verification&nbsp;</td>
  <td align="left" class="tblheading">&nbsp;<input type="radio" name="sritmrec" id="sritmrec" value="Yes" onclick="sritrecchk(this.value);" <?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "checked";?> />Yes&nbsp;&nbsp;<input type="radio" name="sritmrec" id="sritmrec" value="No" onclick="sritrecchk(this.value);" <?php if($row_tbl_sub['salesrs_rectyp']=="No") echo "checked";?> />No</td>
</tr>
</table>
<div id="postverrec" style="display:<?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "block"; else echo "none"; ?>">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="258" align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="smalltbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem" >&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="smalltbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
	<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl_sub['salesrs_upstype'];?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>		
</tr>
<input type="hidden" name="itmdchk" value="" />
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
$row_month=mysqli_fetch_array($quer6);
$a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 

$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
$zzz2=implode(",", str_split($row_tbl_sub['salesrs_newlot']));
   
$lotch1=$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
$lotch2=$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$lotch3=$zzz[28].$zzz[30];

$lotch1o=$zzz2[4].$zzz2[6].$zzz2[8].$zzz2[10].$zzz2[12];
$lotch2o=$zzz2[16].$zzz2[18].$zzz2[20].$zzz2[22].$zzz2[24];
$lotch3o=$zzz2[28].$zzz2[30];
if($lotch3o=="")$lotch3o="00";
$orlot=$zzz[0].$zzz[2].$lotch1."/".$lotch2."/".$lotch3;
$lotupschk="";

$sql_mth1=mysqli_query($link,"select distinct(packtype) from tbl_lot_ldg_pack where plantcode='$plantcode' AND orlot='".$orlot."' and lotldg_crop='".$row_tbl_sub['salesrs_crop']."' and lotldg_variety='".$row_tbl_sub['salesrs_variety']."'")or die("Error:".mysqli_error($link));
while($row_pack=mysqli_fetch_array($sql_mth1))
{
	if($lotupschk!="")
	$lotupschk=$lotupschk.",".$row_pack['packtype'];
	else
	$lotupschk=$row_pack['packtype'];
}

?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="258" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="pcodeo" id="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option <?php if($zzz[0]==$a) echo "selected"; ?> value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia1 = mysqli_fetch_array($quer5)) { ?>
    <option <?php if($zzz[0]==$noticia1['stcode']) echo "selected"; ?> value="<?php echo $noticia1['stcode'];?>" />  
    <?php echo $noticia1['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option <?php if($zzz[2]==$noticia['ycode']) echo "selected"; ?> value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();" value="<?php echo $lotch1;?>"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $lotch2;?>" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="<?php echo $lotch3;?>" onchange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $zzz2[0];?>" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $zzz2[2];?>" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();" value="<?php echo $lotch1o;?>"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $lotch2o;?>" onchange="stchk();" readonly="true" style="background-color:#ECECEC" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $lotch3o;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;<span id="lotnewsr" class="smalltbltext" style="color:#FF0000"><?php if($lotch2o==$ltnn2) echo "Temporary Lot Number"; else echo "";?></span><div id="lotchko"><input type="hidden" name="lotchecko" value="1" /><input type="hidden" name="lotupschko" value="<?php echo $lotupschk;?>" /></div></td>	
</tr>
	
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Date of Validity&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="dovdate" id="dovdate" type="text" size="10" class="smalltbltext" tabindex="" maxlength="10" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dot;?>" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dovdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >Select Return Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtsrtyp" style="width:80px;" onchange="srtchk(this.value)">
<option value="" selected>--Select--</option>
	<option <?php if($row_tbl_sub['salesrs_rettype']=="P2C") echo "selected"; ?> value="P2C" >P2C</option>
	<option <?php if($row_tbl_sub['salesrs_rettype']=="P2P") echo "selected"; ?> value="P2P" >P2P</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">SR Type&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="rettype" type="text" size="20" class="smalltbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="Sales Return - <?php echo $row_tbl_sub['salesrs_rettype'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">As per DC</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtupsdc" type="text" size="15" class="smalltbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_ups'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Total NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopd" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" value="<?php echo $row_tbl_sub['salesrs_nob'];?>" onkeypress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Total Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_qty'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6">Actual</td>
</tr>
<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="5">&nbsp;<input name="txtupsdc" type="text" size="10" class="smalltbltext" tabindex="" maxlength="10" onkeypress="return isNumberKey2400(event)" onchange="verchk();"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>-->
<tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>
<?
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

$nob=0; $qty=0;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }

$xn=$row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage'];
$xnob=$xn-$nob;
$xb=floatval($row_tbl_sub['salesrs_qtydc'])+floatval($row_tbl_sub['salesrs_qtydamage']);
$xqty=floatval($xb)-floatval($qty);
if($xnob==0 && $xqty!=0)$xqty=0;

?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value,'edit');" value="<?php echo $row_tbl_sub['salesrs_nobdc'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk2(this.value,'edit');" value="<?php echo $row_tbl_sub['salesrs_nobdamage'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopdc3" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $xnob;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="258" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="nopschk(this.value,'edit');" value="<?php echo $row_tbl_sub['salesrs_qtydc'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="125" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="195" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtydc2" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="nopschk2(this.value,'edit');" value="<?php echo $row_tbl_sub['salesrs_qtydamage'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtydc3" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $xqty;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="smalltbltext" name="txtgstat" size="10" value="GOT-NR" readonly="true" style="background-color:#CCCCCC"  /></td>
 <td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="qcsreq" size="5" style="background-color:#CCCCCC" readonly="true" value="OK"  /><input type="hidden" name="qcrequest" value="GOT-NR OK" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="<?php echo $dogtdate;?>" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
		
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit Item Form</td>
</tr>
<input type="hidden" name="tpys" value="edit" />
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="115" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row_tbl_sub['salesrs_crop']==$noticia['cropid']) echo "selected"; ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where cropname='".$row_tbl_sub['salesrs_crop']."' and actstatus='Active' order by popularname Asc"); 
?>
	<td width="125" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($row_tbl_sub['salesrs_variety']==$noticia_item['varietyid']) echo "selected"; ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
	<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" <?php if($row_tbl_sub['salesrs_upstype']=="Standard") echo "checked";?> />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)" <?php if($row_tbl_sub['salesrs_upstype']=="Non-Standard") echo "checked"; ?> />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>			
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
$row_month=mysqli_fetch_array($quer6);
$a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 

$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
$zzz2=implode(",", str_split($row_tbl_sub['salesrs_newlot']));
   
$lotch1=$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
$lotch2=$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$lotch3=$zzz[28].$zzz[30];

$lotch1o=$zzz2[4].$zzz2[6].$zzz2[8].$zzz2[10].$zzz2[12];
$lotch2o=$zzz2[16].$zzz2[18].$zzz2[20].$zzz2[22].$zzz2[24];
$lotch3o=$zzz2[28].$zzz2[30];
if($lotch3o=="")$lotch3o="00";
$orlot=$zzz[0].$zzz[2].$lotch1."/".$lotch2."/".$lotch3;
$lotupschk="";

$sql_mth1=mysqli_query($link,"select distinct(packtype) from tbl_lot_ldg_pack where plantcode='$plantcode' AND orlot='".$orlot."' and lotldg_crop='".$row_tbl_sub['salesrs_crop']."' and lotldg_variety='".$row_tbl_sub['salesrs_variety']."'")or die("Error:".mysqli_error($link));
while($row_pack=mysqli_fetch_array($sql_mth1))
{
	if($lotupschk!="")
	$lotupschk=$lotupschk.",".$row_pack['packtype'];
	else
	$lotupschk=$row_pack['packtype'];
}
?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="258" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="pcodeo" id="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option <?php if($zzz[0]==$a) echo "selected"; ?> value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia1 = mysqli_fetch_array($quer5)) { ?>
    <option <?php if($zzz[0]==$noticia1['stcode']) echo "selected"; ?> value="<?php echo $noticia1['stcode'];?>" />  
    <?php echo $noticia1['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option <?php if($zzz[2]==$noticia['ycode']) echo "selected"; ?> value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();" value="<?php echo $lotch1;?>"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $lotch2;?>" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="<?php echo $lotch3;?>" onchange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $zzz2[0];?>" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $zzz2[2];?>" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();" value="<?php echo $lotch1o;?>"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="<?php echo $lotch2o;?>" onchange="stchk();" readonly="true" style="background-color:#ECECEC" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="<?php echo $lotch3o;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;<span id="lotnewsr" class="smalltbltext" style="color:#FF0000"><?php if($lotch2o==$ltnn2) echo "Temporary Lot Number"; else echo "";?></span><div id="lotchko"><input type="hidden" name="lotchecko" value="1" /><input type="hidden" name="lotupschko" value="<?php echo $lotupschk;?>" /></div></td>	
</tr>
	
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Date of Validity&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="dovdate" id="dovdate" type="text" size="10" class="smalltbltext" tabindex="" maxlength="10" readonly="true" style="background-color:#CCCCCC" value="<?php echo $dot;?>" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dovdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" >Select Return Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtsrtyp" style="width:80px;" onchange="srtchk(this.value)">
<option value="" selected>--Select--</option>
	<option <?php if($row_tbl_sub['salesrs_rettype']=="P2C") echo "selected"; ?> value="P2C" >P2C</option>
	<option <?php if($row_tbl_sub['salesrs_rettype']=="P2P") echo "selected"; ?> value="P2P" >P2P</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">SR Type&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="rettype" type="text" size="20" class="smalltbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="Sales Return - <?php echo $row_tbl_sub['salesrs_rettype'];?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="258" align="left"  valign="middle" class="smalltbltext" id="upschd">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']=="Standard"){?><select class="smalltbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
	<?php foreach($toup as $val) { if($val<>"") { 
	$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$upst=$row_var['ups']." ".$row_var['wt']; ?>
		<option <?php if($row_tbl_sub['salesrs_ups']==$upst) echo "selected";?> value="<?php echo $upst;?>" />   
		<?php echo $upst;?>
	<?php }} ?></select><?php } else { ?><input type="text" class="smalltbltext" name="txtupsdc" id="txtupsdc" size="15" maxlength="15" onchange="verchk(this.value);" value="<?php echo $row_tbl_sub['salesrs_ups'];?>" /><?php } ?></td>
<td align="right"  valign="middle" class="tblheading">Total NoP&nbsp;</td>
<td align="left" width="195"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtnopd" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschks(this.value);" value="<?php echo $row_tbl_sub['salesrs_nob'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="65"  valign="middle" class="tblheading">Total Qty&nbsp;</td>
<td align="left" width="198"  valign="middle" class="smalltbltext" colspan="3"  >&nbsp;<input name="txtqtyd" type="text" size="9" class="smalltbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey1(event)" onchange="tnopchks(this.value)" value="<?php echo $row_tbl_sub['salesrs_qty'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
 <tr class="Dark" height="30">
<td align="Center"  valign="middle" class="tblheading" colspan="2">Good</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Damage</td>
<td align="Center"  valign="middle" class="tblheading" colspan="2">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="258" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);" value="<?php echo $row_tbl_sub['salesrs_nobdc'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="195" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopdc2" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" onchange="upchk2(this.value);" value="<?php echo $row_tbl_sub['salesrs_nobdamage'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="198" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtnopdc3" type="text" size="10" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_nob']-($row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage']);?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="115" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="258" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" onchange="nopschk(this.value);" value="<?php echo $row_tbl_sub['salesrs_qtydc'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="125" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="195" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtydc2" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" onchange="nopschk2(this.value);" value="<?php echo $row_tbl_sub['salesrs_qtydamage'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="65" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="198" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtqtydc3" type="text" size="10" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_qty']-($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage']);?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="smalltbltext" name="txtgstat" size="10" value="GOT-NR" readonly="true" style="background-color:#CCCCCC"  /></td>
 <td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="qcsreq" size="5" style="background-color:#CCCCCC" readonly="true" value="OK"  /><input type="hidden" name="qcrequest" value="GOT-NR OK" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="<?php echo $dogtdate;?>" size="10" maxlength="10" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>
<?php
}
?>
<div id="subsubdivgood" style="display:block">
<?php
if($tpg > 0)
{	
if($row_tbl_sub['salesrs_rettype']=="P2P")
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC - Good</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
<?php
$sql_sub_sloc=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$subtid."' order by salesrss_id") or die(mysqli_error($link));
$tot_sub_sloc=mysqli_num_rows($sql_sub_sloc);
$srno=1;
while($row_sub_sloc=mysqli_fetch_array($sql_sub_sloc))
{

$existview="";

if($srno%2!=0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_wh']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tblsrbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin(this.value,<?php echo $srno?>);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_bin']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tblsrsubbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' and binid='".$row_sub_sloc['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_qty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="" />
  </tr>
  <?php
 }
 else
 {
 ?>
  <tr class="Dark" height="25">
   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_wh']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tblsrbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin(this.value,<?php echo $srno?>);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_bin']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tblsrsubbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' and binid='".$row_sub_sloc['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
   
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_qty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_sub_sloc['rowid'];?>" />
  </tr>
  <?php 
 }
 $srno++;
 } 
?>
<?php
if($tot_sub_sloc==0)
{
?>

<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing1">&nbsp;<select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,1);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing1">&nbsp;<select class="smalltbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,1);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
<?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;<select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;<select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,2);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,2);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>




<?php
$whg3_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:70px;" onchange="wh(this.value,3);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg3 = mysqli_fetch_array($whg3_query)) { ?>
          <option value="<?php echo $noticia_whg3['whid'];?>" />  
          <?php echo $noticia_whg3['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:60px;" onchange="bin(this.value,3);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:80px;" onchange="subbin(this.value,3);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow3">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,3);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,3);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid3" value="0" />
  </tr>
  <?php
$whg4_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:70px;" onchange="wh(this.value,4);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg4 = mysqli_fetch_array($whg4_query)) { ?>
          <option value="<?php echo $noticia_whg4['whid'];?>" />  
          <?php echo $noticia_whg4['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:60px;" onchange="bin(this.value,4);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:80px;" onchange="subbin(this.value,4);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow4">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,4);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,4);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid4" value="0" />
  </tr>
  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==1)
{
?>
<?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;<select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;<select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,2);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,2);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>

<?php
$whg3_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:70px;" onchange="wh(this.value,3);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg3 = mysqli_fetch_array($whg3_query)) { ?>
          <option value="<?php echo $noticia_whg3['whid'];?>" />  
          <?php echo $noticia_whg3['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:60px;" onchange="bin(this.value,3);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:80px;" onchange="subbin(this.value,3);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow3">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,3);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,3);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid3" value="0" />
  </tr>
  <?php
$whg4_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:70px;" onchange="wh(this.value,4);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg4 = mysqli_fetch_array($whg4_query)) { ?>
          <option value="<?php echo $noticia_whg4['whid'];?>" />  
          <?php echo $noticia_whg4['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:60px;" onchange="bin(this.value,4);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:80px;" onchange="subbin(this.value,4);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow4">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,4);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,4);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid4" value="0" />
  </tr>
  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==2)
{
?>
<?php
$whg3_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:70px;" onchange="wh(this.value,3);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg3 = mysqli_fetch_array($whg3_query)) { ?>
          <option value="<?php echo $noticia_whg3['whid'];?>" />  
          <?php echo $noticia_whg3['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:60px;" onchange="bin(this.value,3);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:80px;" onchange="subbin(this.value,3);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow3">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,3);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,3);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid3" value="0" />
  </tr>
  <?php
$whg4_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:70px;" onchange="wh(this.value,4);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg4 = mysqli_fetch_array($whg4_query)) { ?>
          <option value="<?php echo $noticia_whg4['whid'];?>" />  
          <?php echo $noticia_whg4['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:60px;" onchange="bin(this.value,4);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:80px;" onchange="subbin(this.value,4);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow4">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,4);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,4);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid4" value="0" />
  </tr>
  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==3)
{
?>
<?php
$whg4_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:70px;" onchange="wh(this.value,4);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg4 = mysqli_fetch_array($whg4_query)) { ?>
          <option value="<?php echo $noticia_whg4['whid'];?>" />  
          <?php echo $noticia_whg4['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:60px;" onchange="bin(this.value,4);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:80px;" onchange="subbin(this.value,4);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow4">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,4);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,4);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid4" value="0" />
  </tr>
  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==4)
{
?>

  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==5)
{
?>

  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==6)
{
?>

  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==7)
{
?>

  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tblsrwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
<?php
}
?>                
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC - Good</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
<?php
$sql_sub_sloc=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$subtid."' order by salesrss_id") or die(mysqli_error($link));
$tot_sub_sloc=mysqli_num_rows($sql_sub_sloc);
$srno=1;
while($row_sub_sloc=mysqli_fetch_array($sql_sub_sloc))
{

$existview="";

if($srno%2!=0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_wh']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin(this.value,<?php echo $srno?>);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_bin']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' and binid='".$row_sub_sloc['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_qty'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="" />
  </tr>
  <?php
 }
 else
 {
 ?>
  <tr class="Dark" height="25">
   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_wh']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin(this.value,<?php echo $srno?>);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_bin']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND whid='".$row_sub_sloc['salesrss_wh']."' and binid='".$row_sub_sloc['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin(this.value,<?php echo $srno?>);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_sub_sloc['salesrss_subbin']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
   
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['salesrss_qty'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_sub_sloc['rowid'];?>" />
  </tr>
  <?php 
 }
 $srno++;
 } 
?>
<?php
if($tot_sub_sloc==0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing1">&nbsp;
        <select class="smalltbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,1);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing1">&nbsp;
        <select class="smalltbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,1);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340" valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;
        <select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;
        <select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340" valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
else if($tot_sub_sloc==1)
{
?>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;
        <select class="smalltbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;
        <select class="smalltbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340" valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
?>
</table>
<?php
}
}
?>
<?php
if($tpd > 0)
{
?>
<br />

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

$sql_sub_sloc2=mysqli_query($link,"select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$subtid."' order by salesrss_id") or die(mysqli_error($link));
$tot_sub_sloc2=mysqli_num_rows($sql_sub_sloc2);
$srno2=1;
while($row_sub_sloc2=mysqli_fetch_array($sql_sub_sloc2))
{

$existview2="";

if($srno2%2!=0)
{
?>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhd<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno2?>(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option <?php if($row_sub_sloc2['salesrss_wh']==$noticia_whd1['whid']) echo "selected";?> value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbin where plantcode='$plantcode' AND whid='".$row_sub_sloc2['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind<?php echo $srno2?>">&nbsp;<select class="smalltbltext" name="txtslbind<?php echo $srno2?>" style="width:60px;" onchange="bind<?php echo $srno2?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bind1 = mysqli_fetch_array($bind1_query)) { ?>
          <option <?php if($row_sub_sloc2['salesrss_bin']==$noticia_bind1['binid']) echo "selected";?> value="<?php echo $noticia_bind1['binid'];?>" />  
          <?php echo $noticia_bind1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbldsubbin where plantcode='$plantcode' AND 
whid='".$row_sub_sloc2['salesrss_wh']."' and binid='".$row_sub_sloc2['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind<?php echo $srno2?>">&nbsp;<select class="smalltbltext" name="txtslsubbd<?php echo $srno2?>" style="width:80px;" onchange="subbind<?php echo $srno2?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbind1 = mysqli_fetch_array($subbind1_query)) { ?>
          <option <?php if($row_sub_sloc2['salesrss_subbin']==$noticia_subbind1['sid']) echo "selected";?> value="<?php echo $noticia_subbind1['sid'];?>" />  
          <?php echo $noticia_subbind1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td colspan="2"  valign="middle"><div id="slocrowd<?php echo $srno2?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd<?php echo $srno2?>" id="Bagsd<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd<?php echo $srno2?>(this.value);" value="<?php echo $row_sub_sloc2['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd<?php echo $srno2?>" id="qtyd<?php echo $srno2?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd<?php echo $srno2?>(this.value);" value="<?php echo $row_sub_sloc2['salesrss_qty'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="dorowid<?php echo $srno2?>" value="" />

  </tr>
  <?php
 }
 else
 {
 ?>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhd<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno2?>(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option <?php if($row_sub_sloc2['salesrss_wh']==$noticia_whd1['whid']) echo "selected";?> value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbin where plantcode='$plantcode' AND whid='".$row_sub_sloc2['salesrss_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind<?php echo $srno2?>">&nbsp;<select class="smalltbltext" name="txtslbind<?php echo $srno2?>" style="width:60px;" onchange="bind<?php echo $srno2?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bind1 = mysqli_fetch_array($bind1_query)) { ?>
          <option <?php if($row_sub_sloc2['salesrss_bin']==$noticia_bind1['binid']) echo "selected";?> value="<?php echo $noticia_bind1['binid'];?>" />  
          <?php echo $noticia_bind1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbldsubbin where plantcode='$plantcode' AND 
whid='".$row_sub_sloc2['salesrss_wh']."' and binid='".$row_sub_sloc2['salesrss_bin']."' order by sname") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind<?php echo $srno2?>">&nbsp;<select class="smalltbltext" name="txtslsubbd<?php echo $srno2?>" style="width:80px;" onchange="subbind<?php echo $srno2?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbind1 = mysqli_fetch_array($subbind1_query)) { ?>
          <option <?php if($row_sub_sloc2['salesrss_subbin']==$noticia_subbind1['sid']) echo "selected";?> value="<?php echo $noticia_subbind1['sid'];?>" />  
          <?php echo $noticia_subbind1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td colspan="2"  valign="middle"><div id="slocrowd<?php echo $srno2?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" width="340" align="left" class="smalltbltext">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd<?php echo $srno2?>" id="Bagsd<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd<?php echo $srno2?>(this.value);" value="<?php echo $row_sub_sloc2['salesrss_nob'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd<?php echo $srno2?>" id="qtyd<?php echo $srno2?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd<?php echo $srno2?>(this.value);" value="<?php echo $row_sub_sloc2['salesrss_qty'];?>"  />
            &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="dorowid<?php echo $srno2?>" value="" />

  </tr>
  <?php 
 }
 $srno2++;
 } 
?>
<?php
if($tot_sub_sloc2==0)
{
?>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhd1" style="width:70px;" onchange="whd1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
          <option value="<?php echo $noticia_whd1['whid'];?>" />  
          <?php echo $noticia_whd1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind1">&nbsp;
        <select class="smalltbltext" name="txtslbind1" style="width:60px;" onchange="bind1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind1">&nbsp;
        <select class="smalltbltext" name="txtslsubbd1" style="width:80px;" onchange="subbind1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd1" id="Bagsd1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd1" id="qtyd1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <input type="hidden" name="dorowid1" value="0" />
<?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhd2" style="width:70px;" onchange="whd2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
          <option value="<?php echo $noticia_whd2['whid'];?>" />  
          <?php echo $noticia_whd2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind2">&nbsp;
        <select class="smalltbltext" name="txtslbind2" style="width:60px;" onchange="bind2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind2">&nbsp;
        <select class="smalltbltext" name="txtslsubbd2" style="width:80px;" onchange="subbind2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd2" id="Bagsd2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd2" id="qtyd2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="dorowid2" value="0" />
  </tr>
<?php
}
else if($tot_sub_sloc==1)
{
?>
<?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbldwarehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="smalltbltext">&nbsp;
        <select class="smalltbltext" name="txtslwhd2" style="width:70px;" onchange="whd2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
          <option value="<?php echo $noticia_whd2['whid'];?>" />  
          <?php echo $noticia_whd2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="smalltbltext" id="bind2">&nbsp;
        <select class="smalltbltext" name="txtslbind2" style="width:60px;" onchange="bind2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="smalltbltext" id="sbind2">&nbsp;
        <select class="smalltbltext" name="txtslsubbd2" style="width:80px;" onchange="subbind2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrowd2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsd2" id="Bagsd2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsfd2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyd2" id="qtyd2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyfd2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="dorowid2" value="0" />
  </tr>
<?php
}
?>  
</table>
<?php
}
?>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" id="postbutn" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1?>" /><input type="hidden" name="wtmp" id="wtmp" value="" /><input type="hidden" name="wtnop" id="wtnop" value="" /><input type="hidden" name="ltnn" id="ltnn" value="<?php echo $ltnn;?>" /><input type="hidden" name="ltnn2" id="ltnn2" value="<?php echo $ltnn2;?>" /><input type="hidden" name="ltncode" value="<?php echo $nlt;?>" /><input type="hidden" name="ltnflg" value="<?php echo $lntflg;?>" /><input type="hidden" name="sritmrecsts" value="<?php echo $row_tbl_sub['salesrs_rectyp']; ?>" /><input type="hidden" name="srptcvtype" value="<?php echo $typ;?>" />
