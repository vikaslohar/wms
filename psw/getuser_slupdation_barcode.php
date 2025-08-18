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
	$orid = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
	 $rid = $_GET['h'];	 
	}

$trid=$f;
if($rid=="entire")
{
?>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="withbar" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;With Barcode</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="nobar" checked="checked" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Without Barcode</td>
</tr>
</table>
<div id="bardiv"><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<?php } else {?>
<div id="bardiv">
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading" colspan="2">Scan Barcode&nbsp;</td>
<td width="686" align="left"  valign="middle" class="smalltbltext" colspan="6">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)"  value="" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div><input type="hidden" name="trid" value="<?php echo $trid;?>" /><input type="hidden" name="totbarcs" value="" />
</div>
<?php } ?>
