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
	if(isset($_GET['g']))
	{
		$shifttype = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
		$sftltno = $_GET['h'];	 
	}

$trid=$f; $ocnt=0;
?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" valign="middle" class="tblheading">Transfer to</td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">New SLOC</td>
  <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="86" align="center" valign="middle" class="tblheading">Bin</td>
<td width="100" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="65" align="center" valign="middle" class="tblheading">NoB</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">NoB</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1;  //echo $trid;
/*$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$c."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$b."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$itemid=$row_item['stores_item'];

Regular Warehouse
Cold Storage
Both

*/
$cnt=0;
if ($shifttype=="Regular Warehouse")
{

$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Regular' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,'add');"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg1" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
/*if($rid=="CS-01")
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01' order by perticulars") or die(mysqli_error($link));
else*/
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Regular' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>



<?php
}
else if ($shifttype=="Cold Storage")
{
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,'add');"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg1" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<?php
//$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01' order by perticulars") or die(mysqli_error($link));
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind3_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>

<?php
//$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg4" style="width:70px;" onchange="wh4(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind4_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing4">&nbsp;<select class="tbltext" name="txtslbing4" style="width:60px;" onchange="bin4(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind4_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing4">&nbsp;<select class="tbltext" name="txtslsubbg4" style="width:60px;" onchange="subbin4(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg4" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg4" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf4(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg4" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg4" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig4" value="0" />
</tr>
<?php
//$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg5" style="width:70px;" onchange="wh5(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing5">&nbsp;<select class="tbltext" name="txtslbing5" style="width:60px;" onchange="bin5(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing5">&nbsp;<select class="tbltext" name="txtslsubbg5" style="width:60px;" onchange="subbin5(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg5" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg5" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig5" value="0" />
</tr>
<?php
//$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg6" style="width:70px;" onchange="wh6(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing6">&nbsp;<select class="tbltext" name="txtslbing6" style="width:60px;" onchange="bin6(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing6">&nbsp;<select class="tbltext" name="txtslsubbg6" style="width:60px;" onchange="subbin6(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf6(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg6" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg6" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>


<?php
//$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg7" style="width:70px;" onchange="wh7(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing7">&nbsp;<select class="tbltext" name="txtslbing7" style="width:60px;" onchange="bin7(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing7">&nbsp;<select class="tbltext" name="txtslsubbg7" style="width:60px;" onchange="subbin7(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf7(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg7" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg7" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>
<?php
//$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg8" style="width:70px;" onchange="wh8(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing8">&nbsp;<select class="tbltext" name="txtslbing8" style="width:60px;" onchange="bin8(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing8">&nbsp;<select class="tbltext" name="txtslsubbg8" style="width:60px;" onchange="subbin8(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf8(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg8" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg8" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
//$whd9_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd9_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg9" style="width:70px;" onchange="wh9(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd9 = mysqli_fetch_array($whd9_query)) { ?>
		<option value="<?php echo $noticia_whd9['whid'];?>" />   
		<?php echo $noticia_whd9['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind9_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing9">&nbsp;<select class="tbltext" name="txtslbing9" style="width:60px;" onchange="bin9(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind9_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing9">&nbsp;<select class="tbltext" name="txtslsubbg9" style="width:60px;" onchange="subbin9(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow9">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg9" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg9" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow9">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg9" id="Bags9" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf9(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg9" id="qty9" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf9(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg9" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg9" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig9" value="0" />
</tr>
<?php
//$whd10_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd10_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg10" style="width:70px;" onchange="wh10(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd10 = mysqli_fetch_array($whd10_query)) { ?>
		<option value="<?php echo $noticia_whd10['whid'];?>" />   
		<?php echo $noticia_whd10['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind10_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing10">&nbsp;<select class="tbltext" name="txtslbing10" style="width:60px;" onchange="bin10(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind10_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing10">&nbsp;<select class="tbltext" name="txtslsubbg10" style="width:60px;" onchange="subbin10(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow10">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg10" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg10" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow10">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg10" id="Bags10" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf10(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg10" id="qty10" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf10(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg10" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg10" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig10" value="0" />
</tr>



<?php
}
else 
{
?>


<?php 
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Regular' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value,'add');"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg1" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Regular' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<?php
//$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind3_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg3" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>

<?php
//$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg4" style="width:70px;" onchange="wh4(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind4_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing4">&nbsp;<select class="tbltext" name="txtslbing4" style="width:60px;" onchange="bin4(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind4_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing4">&nbsp;<select class="tbltext" name="txtslsubbg4" style="width:60px;" onchange="subbin4(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg4" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg4" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf4(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg4" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg4" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig4" value="0" />
</tr>
<?php
//$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg5" style="width:70px;" onchange="wh5(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing5">&nbsp;<select class="tbltext" name="txtslbing5" style="width:60px;" onchange="bin5(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing5">&nbsp;<select class="tbltext" name="txtslsubbg5" style="width:60px;" onchange="subbin5(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg5" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg5" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig5" value="0" />
</tr>
<?php
//$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg6" style="width:70px;" onchange="wh6(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing6">&nbsp;<select class="tbltext" name="txtslbing6" style="width:60px;" onchange="bin6(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing6">&nbsp;<select class="tbltext" name="txtslsubbg6" style="width:60px;" onchange="subbin6(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf6(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg6" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg6" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>


<?php
//$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg7" style="width:70px;" onchange="wh7(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing7">&nbsp;<select class="tbltext" name="txtslbing7" style="width:60px;" onchange="bin7(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing7">&nbsp;<select class="tbltext" name="txtslsubbg7" style="width:60px;" onchange="subbin7(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf7(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg7" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg7" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>
<?php
//$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg8" style="width:70px;" onchange="wh8(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing8">&nbsp;<select class="tbltext" name="txtslbing8" style="width:60px;" onchange="bin8(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing8">&nbsp;<select class="tbltext" name="txtslsubbg8" style="width:60px;" onchange="subbin8(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf8(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg8" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg8" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
//$whd9_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd9_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg9" style="width:70px;" onchange="wh9(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd9 = mysqli_fetch_array($whd9_query)) { ?>
		<option value="<?php echo $noticia_whd9['whid'];?>" />   
		<?php echo $noticia_whd9['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind9_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing9">&nbsp;<select class="tbltext" name="txtslbing9" style="width:60px;" onchange="bin9(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind9_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing9">&nbsp;<select class="tbltext" name="txtslsubbg9" style="width:60px;" onchange="subbin9(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow9">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg9" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg9" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow9">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg9" id="Bags9" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf9(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg9" id="qty9" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf9(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg9" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg9" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig9" value="0" />
</tr>
<?php
//$whd10_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='CS-01'  order by perticulars") or die(mysqli_error($link));
$whd10_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whtype='Cold' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg10" style="width:70px;" onchange="wh10(this.value,'add');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd10 = mysqli_fetch_array($whd10_query)) { ?>
		<option value="<?php echo $noticia_whd10['whid'];?>" />   
		<?php echo $noticia_whd10['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind10_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing10">&nbsp;<select class="tbltext" name="txtslbing10" style="width:60px;" onchange="bin10(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind10_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing10">&nbsp;<select class="tbltext" name="txtslsubbg10" style="width:60px;" onchange="subbin10(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow10">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg10" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg10" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow10">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg10" id="Bags10" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf10(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg10" id="qty10" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf10(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg10" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg10" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig10" value="0" />
</tr>

<?php
}
?>



</table>
<input type="hidden" name="tblslocnod" value="0" /><input type="hidden" name="ocnt" value="<?php echo $ocnt;?>" />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>