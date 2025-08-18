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
	$step = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$srno = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$tid = $_GET['c'];	 
}
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td colspan="12" align="center" class="tblheading" id="rephead">IN-SITU : DNA - Replication <?php echo $srno?></td>
</tr>
<tr class="Dark" height="25">
	<td width="141" align="center" valign="middle" class="tblheading">Sample Receipt Date</td>
	<td width="162" align="center" valign="middle" class="tblheading">DNA Extraction Date</td>
	<td width="154" align="center" valign="middle" class="tblheading">DNA Extracted From</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">DNA Extraction Method</td>
	<td width="217" align="center" valign="middle" class="tblheading">Sample Age</td>
</tr>
<?php $step="DNA";?>
<tr class="Dark" height="25">
<!--<td width="34"align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>-->
 <td width="141"align="center" valign="middle" class="smalltbltext"><input name="recdate" id="recdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('recdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 
 <td width="162" align="center" valign="middle" class="smalltbltext"><input name="dnaextdate" id="dnaextdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('dnaextdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 
 <td width="154" align="center" valign="middle" class="smalltbltext"><select class="tbltext" name="txtdnaextfrom" style="width:100px;" onchange="locchk()">
<option value="" selected>--Select--</option>
<option value="Seed">Seed</option>
<option value="Seedling">Seedling</option>
<option value="Leaf">Leaf</option>
<option value="Fruit">Fruit</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
 
<td width="131" align="center" valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="txtextmet1" style="width:100px;" onchange="dnaextmet1()">
<option value="" selected>--Select--</option>
<option value="Block">Block</option>
<option value="Pestle Mortar">Pestle Mortar</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="131" align="center" valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="txtextmet2" style="width:100px;" onchange="dnaextmet2()">
<option value="" selected>--Select--</option>
<option value="Bulk">Bulk</option>
<option value="Individual">Individual</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>

<td width="217" align="center" valign="middle" class="smalltbltext">&nbsp;<input name="txtsampage" type="text" size="5" class="tbltext" tabindex=""  maxlength="3"  value="" onchange="sampleage()" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Days</td>
</tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><!--<a href="home_gotdata.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>--><!--<img src="../images/back.gif" border="0" onclick="window.close()" />&nbsp;-->
<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value" onclick="return mySubmit();" border="0" style="display:inline;cursor:pointer;"  /></td>
</tr>
</table>