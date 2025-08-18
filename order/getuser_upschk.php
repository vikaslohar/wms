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
if(isset($_GET['f']))
{
	$f = $_GET['f'];	 
}

$sql_month=mysqli_query($link,"select * from tblvariety where cropname='".$b."' and varietyid='".$c."' and actstatus='Active'")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
if($a=="Yes")
{
?>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="20">
<td align="center" width="33" valign="middle" class="smalltblheading">UPS&nbsp;</td>
<td align="center" width="25" valign="middle" class="smalltblheading">PT&nbsp;</td>
<td align="center" width="50" valign="middle" class="smalltblheading" >Total Qty&nbsp;</td>
<td align="center" width="50" valign="middle" class="smalltblheading" >SMC Qty&nbsp;</td>
<td align="center" width="65" valign="middle" class="smalltblheading" >Loose Qty&nbsp;</td>
<td align="center" width="30" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td align="center" width="40" valign="middle" class="smalltblheading" >NoWB&nbsp;</td>
<td align="center" width="37" valign="middle" class="smalltblheading" >NoMP&nbsp;</td>
</tr>
<?php
$srn=0; $cnt=0; 
$toup=explode(",",$row_month['gm']);

$wbtype=explode(",",$row_month['wbtype']);
$wtnop=explode(",",$row_month['wtnop']);
$wtnopkg=explode(",",$row_month['wtnopkg']);
$mtyp=explode(",",$row_month['mtyp']);
$mtype=explode(",",$row_month['mtype']);
$wtmp=explode(",",$row_month['wtmp']);
$nowb=explode(",",$row_month['nowb']);
foreach($toup as $val)
{
if($val<>"")
{
$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
$row_var=mysqli_fetch_array($sql_var);
$upst=$row_var['ups']." ".$row_var['wt'];$srn++;
?>
<tr class="Light" height="30">
<!--<td align="right" width="33" valign="middle" class="smalltblheading">UPS&nbsp;</td>-->
<td width="70" align="center"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $upst;?>&nbsp;<input type="hidden" id="txtupsdc_<?php echo $srn?>" name="txtupsdc_<?php echo $srn?>" value="<?php echo $upst;?>" /></td>
<!--<td align="right" width="25" valign="middle" class="smalltblheading">PT&nbsp;</td>-->
<td width="105" align="center"  valign="middle" class="smalltbltext" >&nbsp;
  <select name="txtuptypchk_<?php echo $srn?>" id="txtuptypchk_<?php echo $srn?>" class="smalltbltext" style="width:55px;" onchange="uptypchk(this.value,'<?php echo $srn?>','<?php echo $c;?>');">
    <?php if($mtyp[$cnt]=="Yes") { ?>
    <option value="MPack">MPack</option>
    <?php } ?>
    <?php if($wbtype[$cnt]=="Yes") { ?>
    <option value="WBox">WBox</option>
    <?php } ?>
    <!--<option value="Pouch">Pouch </option>-->
  </select>
  &nbsp;
  <div id="stdpt_<?php echo $srn?>" style="display:inline;" class="smalltbltext"><input type="text" name="stdptval_<?php echo $srn;?>" class="smalltbltext" id="stdptval_<?php echo $srn;?>" value="<?php if($mtyp[$cnt]=="Yes") { echo $wtmp[$cnt];} else if($wbtype[$cnt]=="Yes") {echo $wtnop[$cnt];} else { echo $row_var['uom'];}?>" size="2" readonly="true" style="background-color:#F0F0F0" /></div></td>
<!--<td align="right" width="50" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>-->
<td width="111"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc1_<?php echo $srn?>" id="txtqtydc1_<?php echo $srn?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="nopchk(this.value,'<?php echo $row_var['ups']?>','<?php echo $row_var['wt'];?>','<?php echo $srn?>')"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="111"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_<?php echo $srn?>" id="txtqtydc_<?php echo $srn?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="9" style="background-color:#CCCCCC" />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<!--<td align="right" width="65" valign="middle" class="smalltblheading" >Loose Qty&nbsp;</td>-->
<td width="90"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtlqtydc_<?php echo $srn?>" id="txtlqtydc_<?php echo $srn?>" readonly="" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" style="background-color:#CCCCCC"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<!--<td align="right" width="30" valign="middle" class="smalltblheading" >NoP&nbsp;</td>-->
<td width="60"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_<?php echo $srn?>" id="txtnopdc_<?php echo $srn?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC"  />&nbsp;&nbsp;</td>

<!--<td align="right" width="40" valign="middle" class="smalltblheading" >NoWB&nbsp;</td>-->
<td width="55"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopwb_<?php echo $srn?>" id="txtnopwb_<?php echo $srn?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC"  />&nbsp;&nbsp;</td>
<!--<td align="right" width="37" valign="middle" class="smalltblheading" >NoMP&nbsp;</td>-->
<td width="49"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopmp_<?php echo $srn?>" id="txtnopmp_<?php echo $srn?>" type="text" size="2" class="smalltbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC"  />&nbsp;&nbsp;</td>
<input type="hidden" name="wbtype_<?php echo $srn?>" id="wbtype_<?php echo $srn?>" value="<?php echo $wbtype[$cnt];?>" />
<input type="hidden" name="mtyp_<?php echo $srn?>" id="mtyp_<?php echo $srn?>" value="<?php echo $mtyp[$cnt];?>" />
<input type="hidden" name="wtnop_<?php echo $srn?>" id="wtnop_<?php echo $srn?>" value="<?php echo $wtnop[$cnt];?>" />
<input type="hidden" name="wtnopkg_<?php echo $srn?>" id="wtnopkg_<?php echo $srn?>" value="<?php echo $wtnopkg[$cnt];?>" />
<input type="hidden" name="mtype_<?php echo $srn?>" id="mtype_<?php echo $srn?>" value="<?php echo $mtype[$cnt];?>" />
<input type="hidden" name="wtmp_<?php echo $srn?>" id="wtmp_<?php echo $srn?>" value="<?php echo $wtmp[$cnt];?>" />
<input type="hidden" name="nowb_<?php echo $srn?>" id="nowb_<?php echo $srn?>" value="<?php echo $nowb[$cnt];?>" />
</tr>
<?php $cnt++;
}
}
?><input type="hidden" name="srn" value="<?php echo $srn;?>" />
</table>
<?php
}
else
{

if($f=="Bulk")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="106" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="737"  align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_1" id="txtqtydc_1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopchk(this.value,'','','1')"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;
<input name="txtupsdc_1" id="txtupsdc_1" type="hidden" size="10" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" /><input name="txtnopdc_1" id="txtnopdc_1" type="hidden" size="9" class="smalltbltext" tabindex="" maxlength="9" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<input type="hidden" name="srn" value="1" />
</table>
<?php
}
else
{
$toup=explode(",",$row_month['gm']);

$wbtype=explode(",",$row_month['wbtype']);
$wtnop=explode(",",$row_month['wtnop']);
$wtnopkg=explode(",",$row_month['wtnopkg']);
$mtyp=explode(",",$row_month['mtyp']);
$mtype=explode(",",$row_month['mtype']);
$wtmp=explode(",",$row_month['wtmp']);
$nowb=explode(",",$row_month['nowb']);
$upstt="";
foreach($toup as $val)
{
if($val<>"")
{
$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
$row_var=mysqli_fetch_array($sql_var);
$dq=explode(".",$row_var['ups']);
//if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_var['ups'];}
$dcq=$row_var['ups'];

if($upstt!="")
$upstt=$upstt.",".$dcq." ".$row_var['wt'];
else
$upstt=$dcq." ".$row_var['wt'];
}
}
$upsqtytt=implode(",",$wtmp);
//echo $upstt;
//print_r($wtmp);
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<input type="hidden" name="upstt" value="<?php echo $upstt;?>" /><input type="hidden" name="upsqtytt" value="<?php echo $upsqtytt;?>" />
<!--<tr class="Dark" height="30">
<td align="right" width="106" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="737"  align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtqtydc_1" id="txtqtydc_1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopchk(this.value,'','','1')"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;
<input name="txtupsdc_1" id="txtupsdc_1" type="hidden" size="10" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" /><input name="txtnopdc_1" id="txtnopdc_1" type="hidden" size="9" class="tbltext" tabindex="" maxlength="9" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>-->
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtupdc_1" id="txtupdc_1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="updchk(this.value,'1');" />
</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<select name="upssizetyp_1" id="upssizetyp_1" style="size:70px" onchange="updmerg(this.value,'1');" class="smalltbltext">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_1" id="txtupsdc_1" value="" />
</td>
<td width="120" align="right" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtqtydc_1" id="txtqtydc_1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_1','','1')"  />
</td>
<td align="right" width="119" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_1" id="txtnopdc_1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" readonly="true" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_2" id="txtupdc_2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="updchk(this.value,'2');"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_2" id="upssizetyp_2" style="size:70px" onchange="updmerg(this.value,'2');" class="smalltbltext">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_2" id="txtupsdc_2" value="" />
</td>
<td align="right" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_2" id="txtqtydc_2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_2','','2')"  />
</td>
<td align="right" width="119" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_2" id="txtnopdc_2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_3" id="txtupdc_3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="updchk(this.value,'3');"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_3" id="upssizetyp_3" style="size:70px" onchange="updmerg(this.value,'3');" class="smalltbltext">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_3" id="txtupsdc_3" value="" />
</td>
<td align="right" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_3" id="txtqtydc_3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_3','','3')"  />
</td>
<td align="right" width="119" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_3" id="txtnopdc_3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"   />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_4" id="txtupdc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="updchk(this.value,'4');"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_4" id="upssizetyp_4" style="size:70px" onchange="updmerg(this.value,'4');" class="smalltbltext">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_4" id="txtupsdc_4" value="" />
</td>
<td align="right" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_4" id="txtqtydc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_4','','4')"  />
</td>
<td align="right" width="119" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_4" id="txtnopdc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="updchk(this.value,'5');"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');" class="smalltbltext">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_5" id="txtupsdc_5" value="" />
</td>
<td align="right" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_5" id="txtqtydc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_5','','5')"  />
</td>
<td align="right" width="119" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_5" id="txtnopdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"   />&nbsp;
</td>
</tr>
<input type="hidden" name="srn" value="5" />
</table>
<?php
}
}
?>