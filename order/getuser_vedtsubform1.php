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
/*if(isset($_GET['c']))
	{
$c = $_GET['c'];	 
	}
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$rid = $_GET['g'];	 
	}

if(isset($_REQUEST['id']))
	{
	 $id = $_REQUEST['id'];
	}*/

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);

$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$b."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
//$arrival_id=$row_tbl['orderm_id'];
$tid=$b;

$sql_tbl_sub2=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$b."' and order_sub_id!='".$a."'") or die(mysqli_error($link));
$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
$itmdchk="";$itmdchk1="";
while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub2['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub2['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub2['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub2['order_sub_ups_type'].",";
	}

}

?>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="smalltblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 
         <tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>

<td width="106" align="right"  valign="middle" class="smalltblheading">Select Crop&nbsp;</td>
<td width="210" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['cropid']==$row_tbl_sub['order_sub_crop']){ echo "Selected";} ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
			  			  <td width="116" align="right"  valign="middle" class="smalltblheading">Select Variety Type&nbsp;</td>
<td width="112" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtvartyp" style="width:80px;" onchange="vartypechk(this.value)">
<option value="" selected>--Select--</option>
<option <?php if($row_tbl_sub['order_sub_variety_typ']=="Hybrid"){ echo "Selected";} ?> value="Hybrid" >Hybrid</option>
<option <?php if($row_tbl_sub['order_sub_variety_typ']=="OP"){ echo "Selected";} ?> value="OP" >OP</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['order_sub_crop']."' and actstatus='Active' order by popularname Asc"); 

?>
	<td width="87" align="right"  valign="middle" class="smalltblheading" >Select Variety&nbsp;</td>
    <td width="205" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;" onchange="cropchk();" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($noticia_item['varietyid']==$row_tbl_sub['order_sub_variety']){ echo "Selected";} ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" /><input type="hidden" name="itmdchk1" value="<?php echo $itmdchk1;?>" />
 
		<tr class="Light" height="25">
<td align="right" width="106" valign="middle" class="smalltblheading" style="border-color:#cc30cc">&nbsp;Select UPS Type&nbsp;</td>
   <td colspan="5" align="left"  valign="middle" class="smalltbltext" ><input name="txtup" type="radio" class="smalltbltext" value="Yes" <?php if($row_tbl_sub['order_sub_ups_type']=="Yes"){ echo "Checked";} ?> onClick="clkp1(this.value);" />&nbsp;Standard&nbsp;&nbsp;<input name="txtup" type="radio" class="smalltbltext" value="No" <?php if($row_tbl_sub['order_sub_ups_type']=="No"){ echo "Checked";} ?> onClick="clkp1(this.value);"  />&nbsp;Non-Standard&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="txtupschk" value="<?php echo $row_tbl_sub['order_sub_ups_type'];?>" />
</table> 
<div id="selectupst" style="display:<?php if($row_tbl_sub['order_sub_ups_type']!=""){ echo "block";} else { echo "none"; }?>">
<?php
$sql_month=mysqli_query($link,"select * from tblvariety where cropname='".$row_tbl_sub['order_sub_crop']."' and varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
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
$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."'") or die(mysqli_error($link));
$row_var=mysqli_fetch_array($sql_var);
$upst=$row_var['ups']." ".$row_var['wt']; $srn++;

$up=""; $qt=""; $np=""; $nowbp=""; $nompp=""; $ptp=""; $stdptv="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$b."' and order_sub_id='".$a."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
	if($row_sloc['order_sub_sub_ups']==$upst)
	{
	$qt=$row_sloc['order_sub_subqty'];
	$qt1=$row_sloc['order_sub_sublqty'];
	$np=$row_sloc['order_sub_sub_nop'];
	$nowbp=$row_sloc['order_sub_sub_nowb'];
	if($nowbp==0)$nowbp="";
	$nompp=$row_sloc['order_sub_sub_nomp'];
	if($nompp==0)$nompp="";
	$ptp=$row_sloc['order_sub_sub_pt'];
	$stdptv=$row_sloc['order_sub_sub_stdpt'];
	$qt=explode(".",$row_sloc['order_sub_subqty']);
	if($qt[1]==000){$qt=$qt[0];}else{$qt=$row_sloc['order_sub_subqty'];}
	$qt1=explode(".",$row_sloc['order_sub_sublqty']);
	if($qt1[1]==000){$qt1=$qt1[0];}else{$qt1=$row_sloc['order_sub_sublqty'];}
	$qt2=explode(".",$row_sloc['order_sub_sub_qty']);
	if($qt2[1]==000){$qt2=$qt2[0];}else{$qt2=$row_sloc['order_sub_sub_qty'];}
	}
	
}
if($stdptv=="")
{
if($mtyp[$cnt]=="Yes") { $stdptv=$wtmp[$cnt];} 
else if($wbtype[$cnt]=="Yes") { $stdptv=$wtnop[$cnt];} 
else { $stdptv=$row_var['uom'];}
}
?>
<tr class="Light" height="30">
<!--<td align="right" width="33" valign="middle" class="smalltblheading">UPS&nbsp;</td>-->
<td width="70" align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $upst;?>&nbsp;<input type="hidden" id="txtupsdc_<?php echo $srn?>" name="txtupsdc_<?php echo $srn?>" value="<?php echo $upst;?>" /></td>
<!--<td align="right" width="25" valign="middle" class="smalltblheading">PT&nbsp;</td>-->
<td width="105" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select name="txtuptypchk_<?php echo $srn?>" id="txtuptypchk_<?php echo $srn?>" class="smalltbltext" style="width:55px;" onchange="uptypchk(this.value,'<?php echo $srn?>','<?php echo $row_tbl_sub['order_sub_variety'];?>');">
	<?php if($mtyp[$cnt]=="Yes") { ?>
	<option <?php if($ptp=="MPack"){ echo "Selected";}?> value="MPack">MPack</option>
	<?php } ?>
	<?php if($wbtype[$cnt]=="Yes") { ?>
	<option <?php if($ptp=="WBox"){ echo "Selected";}?> value="WBox">WBox</option>
	<?php } ?>
	<!--<option <?php if($ptp=="Pouch"){ echo "Selected";}?> value="Pouch">Pouch </option>-->
	</select><div id="stdpt_<?php echo $srn?>" style="display:inline;" class="smalltbltext"><input type="text" name="stdptval_<?php echo $srn;?>" id="stdptval_<?php echo $srn;?>" value="<?php echo $stdptv;?>" size="2" readonly="true" style="background-color:#F0F0F0" /></div>
</td>
<!--<td align="right" width="50" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>-->
<td width="111"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc1_<?php echo $srn?>" id="txtqtydc1_<?php echo $srn?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="9" value="<?php echo $qt2;?>" onkeypress="return isNumberKey1(event)" onchange="nopchk(this.value,'<?php echo $row_var['ups']?>','<?php echo $row_var['wt'];?>','<?php echo $srn?>')"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="111"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtqtydc_<?php echo $srn?>" id="txtqtydc_<?php echo $srn?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="9" value="<?php echo $qt;?>"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<!--<td align="right" width="65" valign="middle" class="smalltblheading" >Loose Qty&nbsp;</td>-->
<td width="90"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtlqtydc_<?php echo $srn?>" id="txtlqtydc_<?php echo $srn?>" readonly="true" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" style="background-color:#CCCCCC" value="<?php echo $qt1;?>"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<!--<td align="right" width="30" valign="middle" class="smalltblheading" >NoP&nbsp;</td>-->
<td width="60"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_<?php echo $srn?>" id="txtnopdc_<?php echo $srn?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="<?php echo $np;?>"   />&nbsp;&nbsp;</td>

<!--<td align="right" width="40" valign="middle" class="smalltblheading" >NoWB&nbsp;</td>-->
<td width="55"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopwb_<?php echo $srn?>" id="txtnopwb_<?php echo $srn?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="<?php echo $nowbp;?>"   />&nbsp;&nbsp;</td>
<!--<td align="right" width="37" valign="middle" class="smalltblheading" >NoMP&nbsp;</td>-->
<td width="49"  align="center"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopmp_<?php echo $srn?>" id="txtnopmp_<?php echo $srn?>" type="text" size="2" class="smalltbltext" tabindex="" maxlength="6" readonly="true" style="background-color:#CCCCCC" value="<?php echo $nompp;?>"   />&nbsp;&nbsp;</td>
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

$snn=0;
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
<?php
/*foreach($toup as $val)
{
if($val<>"")
{
$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."'") or die(mysqli_error($link));
$row_var=mysqli_fetch_array($sql_var);
$upst=$row_var['ups']." ".$row_var['wt']; */

$up=""; $qt=""; $np=""; $nowbp=""; $nompp=""; $ptp=""; $stdptv="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$b."' and order_sub_id='".$a."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
/*	if($row_sloc['order_sub_sub_ups']!=$upst)
	{*/
	$snn++;
	$qt=$row_sloc['order_sub_sub_qty'];
	$np=$row_sloc['order_sub_sub_nop'];
	$nowbp=$row_sloc['order_sub_sub_nowb'];
	if($nowbp==0)$nowbp="";
	$nompp=$row_sloc['order_sub_sub_nomp'];
	if($nompp==0)$nompp="";
	$ptp=$row_sloc['order_sub_sub_pt'];
	$stdptv=$row_sloc['order_sub_sub_stdpt'];
	$qt=explode(".",$row_sloc['order_sub_sub_qty']);
	
if($qt[1]==000){$qt=$qt[0];}else{$qt=$row_sloc['order_sub_sub_qty'];}
$upsiz=explode(" ",$row_sloc['order_sub_sub_ups']);
$upst=$row_sloc['order_sub_sub_ups'];
?>

<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtupdc_<?php echo $snn;?>" id="txtupdc_<?php echo $snn;?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" value="<?php echo $row_sloc['order_sub_sub_ups']?>" />
</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<select name="upssizetyp_<?php echo $snn;?>" id="upssizetyp_<?php echo $snn;?>" style="size:70px" onchange="updmerg(this.value,'<?php echo $snn;?>');">
<option selected="selected" value=""></option>
<option <?php if($upsiz[1]=="Kgs") echo "Selected";?> value="Kgs">Kgs.</option>
<option <?php if($upsiz[1]=="Gms") echo "Selected";?> value="Gms">Gms.</option>
</select><input type="hidden" name="txtupsdc_<?php echo $snn;?>" id="txtupsdc_<?php echo $snn;?>" value="<?php echo $upst?>" />
</td>
<td width="120" align="right" valign="middle" class="smalltblheading" >Quantity&nbsp;</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtqtydc_<?php echo $snn;?>" id="txtqtydc_<?php echo $snn;?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" value="<?php echo $qt;?>" onkeypress="return isNumberKey1(event)"  onchange="nopntchk(this.value,'ermsg_1','','<?php echo $snn;?>')"  />
</td>
<td align="right" width="119" valign="middle" class="smalltblheading" >NoP&nbsp;</td>
<td width="119" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtnopdc_<?php echo $snn;?>" id="txtnopdc_<?php echo $snn;?>" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" readonly="true" value="<?php echo $np;?>" style="background-color:#CCCCCC"  />&nbsp;
</td>
</tr>
<?php
}
/*}
}
}*/
?>
<?php
if($snn==0)
{
?>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<input name="txtupdc_1" id="txtupdc_1" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" />
</td>
<td width="119" align="left" valign="middle" class="smalltbltext" >&nbsp;<select name="upssizetyp_1" id="upssizetyp_1" style="size:70px" onchange="updmerg(this.value,'1');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_2" id="txtupdc_2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_2" id="upssizetyp_2" style="size:70px" onchange="updmerg(this.value,'2');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_3" id="txtupdc_3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_3" id="upssizetyp_3" style="size:70px" onchange="updmerg(this.value,'3');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_4" id="txtupdc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_4" id="upssizetyp_4" style="size:70px" onchange="updmerg(this.value,'4');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');">
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
<?php
}
if($snn==1)
{
?>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_2" id="txtupdc_2" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_2" id="upssizetyp_2" style="size:70px" onchange="updmerg(this.value,'2');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_3" id="txtupdc_3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_3" id="upssizetyp_3" style="size:70px" onchange="updmerg(this.value,'3');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_4" id="txtupdc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_4" id="upssizetyp_4" style="size:70px" onchange="updmerg(this.value,'4');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');">
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
<?php
}
if($snn==2)
{
?>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_3" id="txtupdc_3" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_3" id="upssizetyp_3" style="size:70px" onchange="updmerg(this.value,'3');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_4" id="txtupdc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_4" id="upssizetyp_4" style="size:70px" onchange="updmerg(this.value,'4');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');">
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
<?php
}
if($snn==3)
{
?>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_4" id="txtupdc_4" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_4" id="upssizetyp_4" style="size:70px" onchange="updmerg(this.value,'4');">
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
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');">
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
<?php
}
if($snn==4)
{
?>
<tr class="Dark" height="30">
<td align="right" width="119" valign="middle" class="smalltblheading" >UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<input name="txtupdc_5" id="txtupdc_5" type="text" size="9" class="smalltbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)"  />
</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<select name="upssizetyp_5" id="upssizetyp_5" style="size:70px" onchange="updmerg(this.value,'5');">
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
<?php
}
?>
</table>
<?php
}
?>
</div>
<div id="subsubdivgood" style="display:block"></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right" id="frmbutn" ><img src="../images/update.gif" border="0"style="display:inline;cursor:hand;" onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>