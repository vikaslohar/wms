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
	
	$sql_impsub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_lotno='".$b."' and stlotimpp_id='".$a."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$tot_impsub=mysqli_num_rows($sql_impsub);
$row_impsub=mysqli_fetch_array($sql_impsub);

$type="Expected NoP";
$crop=$row_impsub['stlotimpp_crop'];
$variety=$row_impsub['stlotimpp_variety'];
$ups=$row_impsub['stlotimpp_ups'];
$expnop=$row_impsub['stlotimpp_loosenop'];

$ups1=explode(" ",$ups);
if($ups1[1]=="Kgs")
	$expqty=$ups1[0]*$expnop;
if($ups1[1]=="Gms")
	$expqty=($ups1[0]/1000)*$expnop;

?>
	<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="12">Post Form</td>
</tr>
<tr class="Dark" height="25">
<td width="73" align="center" valign="middle" class="tblheading">Crop</td>
<td width="95" align="center" valign="middle" class="tblheading">Variety</td>
<td width="98" align="center"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td width="73" align="center" valign="middle" class="tblheading">Ups</td>
<td width="78" align="center"  valign="middle" class="tblheading">Expected Nop&nbsp;</td>
<td width="98" align="center"  valign="middle" class="tblheading">Expected Qty&nbsp;</td>
<td width="56" align="center"  valign="middle" class="tblheading">Enter Nop&nbsp;</td>
<td width="84" align="center"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="68" align="center"  valign="middle" class="tblheading">Loss NoP&nbsp;</td>
<td width="73" align="center" valign="middle" class="tblheading">Loss Qty</td>
<td width="48" align="center" valign="middle" class="tblheading">Bal NoP</td>
<!--<td width="8%" align="center" valign="middle" class="tblheading">Bal NoMP</td>-->
<td width="80" align="center" valign="middle" class="tblheading">Bal Qty</td>
</tr>
<tr class="Light" height="25">
<td width="73" align="center"  valign="middle" class="smalltbltext">&nbsp;<?php echo $crop;?></td>
<td width="95" align="center"  valign="middle" class="smalltbltext">&nbsp;<?php echo $variety;?></td>
<td width="98" align="center"  valign="middle" class="smalltbltext">&nbsp;<?php echo $b;?></td>
<td width="73" align="center"  valign="middle" class="smalltbltext">&nbsp;<?php echo $ups;?>
  <input type="hidden" name="ups" value="<?php echo $ups;?>" /></td>
<td width="78" align="center"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="pnop" id="pnop" size="4" class="smalltbltext" tabindex="0" value="<?php echo $expnop;?>" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="98" align="center"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="expqty" id="expqty" size="9" class="smalltbltext" tabindex="0" value="<?php echo $expqty;?>" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="56" align="center"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="arrnop" id="arrnop" size="4" class="smalltbltext" onChange="expnopcal(this.value)" tabindex="0" value="" /></td>
<td width="84" align="center"  valign="middle" class="smalltbltext">&nbsp;
  <input type="text" name="arrqty" id="arrqty" size="9" class="smalltbltext" tabindex="0" value="" readonly="true" style="background-color:#CCCCCC" /></td> 
<td width="68" align="center"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="lossnop" id="lossnop" size="4" class="smalltbltext" onchange="lossnopcal12(this.value)" tabindex="0" value="" /></td>
<td width="73" align="center" valign="middle" class="smalltbltext"><input type="text" name="lossqty" id="lossqty" size="9" maxlength="4" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="48" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtbalnop" id="txtbalnop" size="4" maxlength="4" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<!--<td width="8%" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtbalnomp" id="txtbalnomp" size="4" maxlength="4" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>-->
<td width="80" align="center" valign="middle" class="smalltbltext"><input type="text" name="txtbalqty" id="txtbalqty" size="9" maxlength="9" class="smalltbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td> 
</tr>
</table><br />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0" style="display:inline;cursor:Pointer;" onClick="pform('<?php echo $type;?>');" />&nbsp;&nbsp;</td>
</tr>
</table>