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

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields

/*if(isset($_GET['a']))
	{
	$rid = $_GET['a'];	 
	}*/

if(isset($_REQUEST['b']))
	{
	$trid = $_REQUEST['b'];
	}


if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['salesr_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
		
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="89" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="209" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row_tbl_sub['salesrs_crop']==$noticia['cropid']) echo "selected"; ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where cropname='".$row_tbl_sub['salesrs_crop']."' and actstatus='Active' order by popularname Asc"); 
?>
	<td width="70" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk2(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($row_tbl_sub['salesrs_variety']==$noticia_item['varietyid']) echo "selected"; ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="70" align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td width="188" align="left"  valign="middle" class="tbltext"><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" <?php if($row_tbl_sub['salesrs_upstype']=="Standard") echo "checked";?> />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"<?php if($row_tbl_sub['salesrs_upstype']=="Non-Standard") echo "checked";?> />&nbsp;Non-Standard&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /></td>				
</tr>
<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="209" align="left"  valign="middle" class="tbltext" id="upschd">&nbsp;<?php if($row_tbl_sub['salesrs_ups']!="Standard") { ?><input type="text" class="tbltext" name="txtupsdc" id="txtupsdc" size="15" maxlength="15" onchange="verchk(this.value);" value="<?php if($row_tbl_sub['salesrs_ups']!="" && $row_tbl_sub['salesrs_ups']!="--Select UPS-") echo $row_tbl_sub['salesrs_ups'];?>" /><?php } else { ?><select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
	<?php foreach($toup as $val) { if($val<>"") { 
	$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$upst=$row_var['ups']." ".$row_var['wt']; ?>
		<option <?php if($row_tbl_sub['salesrs_ups']==$upst) echo "selected";?> value="<?php echo $upst;?>" />   
		<?php echo $upst;?>
		<?php }} ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;<?php } ?></td>
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="210"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtnopdc" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upchk(this.value);" value="<?php echo $row_tbl_sub['salesrs_nob'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="70"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="188"  valign="middle" class="smalltbltext" colspan="3"  >&nbsp;<input name="txtqtydc" type="text" size="9" class="smalltbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey1(event)" onchange="nopschk(this.value);" value="<?php echo $row_tbl_sub['salesrs_qty'];?>"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
 
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>