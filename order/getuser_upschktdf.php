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
	}require_once("../include/config.php");
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

$sql_month=mysqli_query($link,"select * from tblups_tdf order by uom")or die(mysqli_error($link));

if($a=="Yes")
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$srn=0; $cnt=0;
while($row_month=mysqli_fetch_array($sql_month))
{ 
$toup=explode(";",$row_month['crop']);

foreach($toup as $val)
{
if($val<>"")
{ 
if($val==$b)
{
$upst=$row_month['ups']." ".$row_month['wt'];$srn++;
?>
<tr class="Dark" height="30">
<td align="right" width="106" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="214" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $upst;?>&nbsp;
  <input type="hidden" id="txtupsdc_<?php echo $srn?>" name="txtupsdc_<?php echo $srn?>" value="<?php echo $upst;?>" /></td>
<input type="hidden" name="stdptval_<?php echo $srn;?>" id="stdptval_<?php echo $srn;?>" value="<?php echo $row_month['uom'];?>" size="9" readonly="true" style="background-color:#F0F0F0" />
<td align="right" width="60" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="242"  align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtqtydc_<?php echo $srn?>" id="txtqtydc_<?php echo $srn?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey_Nowithdot(event)" onchange="nopchk(this.value,'<?php echo $row_month['ups']?>','<?php echo $row_month['wt'];?>','<?php echo $srn?>')"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="59" valign="middle" class="tblheading" >NoP&nbsp;</td>
<td width="155"  align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtnopdc_<?php echo $srn?>" id="txtnopdc_<?php echo $srn?>" type="text" size="6" class="tbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC"  />&nbsp;&nbsp;</td>
</tr>
<?php 
}
}
}
}
?><input type="hidden" name="srn" value="<?php echo $srn;?>" />
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
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_var['ups'];}

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
<td align="right" width="119" valign="middle" class="tblheading" >UPS&nbsp;</td>
<td width="119" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtupdc_1" id="txtupdc_1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" />
</td>
<td width="119" align="left" valign="middle" class="tbltext" >&nbsp;<select name="upssizetyp_1" id="upssizetyp_1" style="size:70px" onchange="updmerg(this.value,'1');">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_1" id="txtupsdc_1" value="" />
</td>
<td width="120" align="right" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="119" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqtydc_1" id="txtqtydc_1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_1','','1')"  />
</td>
<td align="right" width="119" valign="middle" class="tblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtnopdc_1" id="txtnopdc_1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" readonly="true" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="tblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtupdc_2" id="txtupdc_2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<select name="upssizetyp_2" id="upssizetyp_2" style="size:70px" onchange="updmerg(this.value,'2');">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_2" id="txtupsdc_2" value="" />
</td>
<td align="right" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtqtydc_2" id="txtqtydc_2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_2','','2')"  />
</td>
<td align="right" width="119" valign="middle" class="tblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtnopdc_2" id="txtnopdc_2" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="tblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtupdc_3" id="txtupdc_3" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<select name="upssizetyp_3" id="upssizetyp_3" style="size:70px" onchange="updmerg(this.value,'3');">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_3" id="txtupsdc_3" value="" />
</td>
<td align="right" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtqtydc_3" id="txtqtydc_3" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_3','','3')"  />
</td>
<td align="right" width="119" valign="middle" class="tblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtnopdc_3" id="txtnopdc_3" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"   />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="tblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtupdc_4" id="txtupdc_4" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<select name="upssizetyp_4" id="upssizetyp_4" style="size:70px" onchange="updmerg(this.value,'4');">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_4" id="txtupsdc_4" value="" />
</td>
<td align="right" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtqtydc_4" id="txtqtydc_4" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_4','','4')"  />
</td>
<td align="right" width="119" valign="middle" class="tblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtnopdc_4" id="txtnopdc_4" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="tblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');">
<option selected="selected" value=""></option>
<option  value="Kgs">Kgs.</option>
<option value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_5" id="txtupsdc_5" value="" />
</td>
<td align="right" valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtqtydc_5" id="txtqtydc_5" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_5','','5')"  />
</td>
<td align="right" width="119" valign="middle" class="tblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtnopdc_5" id="txtnopdc_5" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  readonly="true" style="background-color:#CCCCCC"   />&nbsp;
</td>
</tr>
<input type="hidden" name="srn" value="5" />
</table>
<?php
}
?>