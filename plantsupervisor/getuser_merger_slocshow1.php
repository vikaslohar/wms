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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >Merging Lots</td>
  </tr>
</table>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
  <!--<tr class="tblsubtitle" height="20">

 <td colspan="4" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>-->
<tr class="tblsubtitle" height="20">
<td width="90" align="center" valign="middle" class="tblheading">#</td>
<td align="left" valign="middle" class="tblheading">&nbsp;Lot No.</td>
<!--<td width="76" align="center" valign="middle" class="tblheading">QC Status</td>
<td width="107" align="center" valign="middle" class="tblheading">GOT Status</td>
<td width="97" align="center" valign="middle" class="tblheading">Status</td>
<td width="118" align="center" valign="middle" class="tblheading">NoB</td>
<td width="100" align="center" valign="middle" class="tblheading">Qty</td>-->
</tr>
<?php
$srno=1; $totalups=0; $totalqty=0; 
for($i=1; $i<=$h; $i++)
{

$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 

if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<select class="tbltext" name="pcode<?php echo $srno;?>" id="pcode_<?php echo $srno;?>" style="width:40px;" onchange="plcchk(<?php echo $srno;?>)">
    <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" selected="selected" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee_<?php echo $srno;?>" style="width:40px;" onchange="ycodchk(<?php echo $srno;?>);">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2<?php echo $srno;?>" id="txtlot2_<?php echo $srno;?>" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return isNumberKey(event)"  onchange="lot2chk(<?php echo $srno;?>);"  /> <font size="+1"><b>/</b></font> <input name="stcode<?php echo $srno;?>" id="stcode_<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow(<?php echo $srno;?>);" /> <font size="+1"><b>/</b></font> <input name="stcode2<?php echo $srno;?>" id="stcode2_<?php echo $srno;?>" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00" onchange="slocshow2(<?php echo $srno;?>);"  />
	   &nbsp;<font color="#FF0000">*</font><input type="hidden" id="lotno_<?php echo $srno;?>" name="lotno_<?php echo $srno;?>" value="" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<select class="tbltext" name="pcode<?php echo $srno;?>" id="pcode_<?php echo $srno;?>" style="width:40px;" onchange="plcchk(<?php echo $srno;?>)">
    <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" selected="selected" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee_<?php echo $srno;?>" style="width:40px;" onchange="ycodchk(<?php echo $srno;?>);">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2<?php echo $srno;?>" id="txtlot2_<?php echo $srno;?>" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return isNumberKey(event)"  onchange="lot2chk(<?php echo $srno;?>);"  /> <font size="+1"><b>/</b></font> <input name="stcode<?php echo $srno;?>" id="stcode_<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow(<?php echo $srno;?>);" /> <font size="+1"><b>/</b></font> <input name="stcode2<?php echo $srno;?>" id="stcode2_<?php echo $srno;?>" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00" onchange="slocshow2(<?php echo $srno;?>);"  />
	   &nbsp;<font color="#FF0000">*</font><input type="hidden" id="lotno_<?php echo $srno;?>" name="lotno_<?php echo $srno;?>" value="" />&nbsp;</td>
 </tr>
 <?php
 }$srno++;
 }
?>
</table>
<input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value="<?php echo $h?>"/> <input type="hidden" name="srno1" value="<?php echo $srno-1;?>"/><input type="hidden" name="srno2" value="" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="left" valign="middle" class="tblheading" >&nbsp;Updated SLOC</td>
  </tr>
</table>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
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
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >		
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
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob2" id="txtconslnob2" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,2);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty2" id="txtconslqty2" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,2);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td>
  </tr>
</table>
<br />
