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

	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['crop']))
	{
	$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['variety']))
	{
	$variety = $_REQUEST['variety'];
	}
	if(isset($_REQUEST['lotno']))
	{
	$lotno = $_REQUEST['lotno'];
	}
	if(isset($_REQUEST['relno']))
	{
	$relno = $_REQUEST['relno'];
	}
	if(isset($_REQUEST['dot']))
	{
	$dot = $_REQUEST['dot'];
	}
	
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['disp_id'];
$ptype=$row_tbl['disp_partytype'];
if($ptype=="Dealer" || $ptype=="Export Buyer")
{
$ntitle="Pack Seed Dispatch Note (PSDN)";
$ntyps="PSDN";
}
if($ptype=="C&F" || $ptype=="Branch")
{
$ntitle="Stock Transfer Dispatch Note (STDN)";
$ntyps="STDN";
}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Statement-I</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<script>
function post_value()
{
document.form.submit();
}
</script>
<body topmargin="0" >
<?php 
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
$zz=str_split($lotno);
$lotno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="form" method="post" action="statement1print.php">
  	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="itmid" value="<?php echo $_REQUEST['itmid'];?>" />
	<input type="hidden" name="crop" value="<?php echo $_REQUEST['crop'];?>" />
	<input type="hidden" name="variety" value="<?php echo $_REQUEST['variety'];?>" />
	<input type="hidden" name="lotno" value="<?php echo $_REQUEST['lotno'];?>" />
	<input type="hidden" name="relno" value="<?php echo $_REQUEST['relno'];?>" />
	<input type="hidden" name="dot" value="<?php echo $_REQUEST['dot'];?>" />
	<br />

<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr  height="20">
  <td colspan="2" align="center" class="Mainheading"><font color="#000000">STATEMENT - I</font></td>
</tr>
</table>

<br />

<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 

<tr class="Light" height="60">
<td width="389" align="left" valign="top" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;Name of Seed Producer &amp; Details Address</td>
<td width="391" align="left" valign="top" class="smalltblheading"><div style="padding-left:3px"><?php echo $row_param['company_name'];?><br />
<?php echo $row_param['plant'];?></div></td>
</tr>
<tr height="65">
  <td colspan="2" align="center" class="subheading"><font color="#000000">INFORMATION OF TRUTHFUL SEED PRODUCTION PROGRAMME</font></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;1. CROP</td>
<td width="391" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $crop;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;2. VARIETY</td>
<td width="391" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $variety;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;3. Information of parents used for seed production</td>
<td width="391" align="left" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Name of Parent</td>
<td width="391" align="left" valign="middle" class="smalltblheading">&nbsp;Female:&nbsp;<input type="text" class="smalltblheading" name="txtparent1" size="5" maxlength="5" value="" />&nbsp;&nbsp;Male:&nbsp;<input type="text" class="smalltblheading" name="txtparent2" size="5" maxlength="5" value="" /></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Developed By</td>
<td width="391" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $row_param['company_name'];?></div></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Lot No.</td>
<td width="391" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $lotno;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d. Release Report No. &amp; Date</td>
<td width="391" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo sprintf("%00005d",$relno)."/".$dot;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;4. Details of Seed Produced</td>
<td width="391" align="left" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
<tr class="Light" height="60">
<td width="389" align="left" valign="top" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Name & Address of seed Processing Plant</td>
<td width="391" align="left" valign="top" class="smalltblheading"><div style="padding-left:3px"><?php echo $row_param['company_name'];?><br />
<?php echo $row_param['plant'];?></div></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Sowing season</td>
<td width="391" align="left" valign="middle" class="smalltblheading">&nbsp;<input type="text" class="smalltblheading" name="txtswoing" size="30" value="" /></td>
</tr>
<tr class="Light" height="35">
<td width="389" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;5. Name of the person under whose Supervision of<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;seed production Programme organized</td>
<td width="391" align="left" valign="middle" class="smalltblheading"><input type="text" class="smalltblheading" name="txtperson" size="30" value="Mr. Raj Kumar Kundu" /></td>
</tr>
<tr class="Light" height="130">
<td width="389" align="left" valign="top" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td width="391" align="left" valign="top" class="smalltblheading"><br /><br /><br />&nbsp;Signature<br /><br /><br />&nbsp;Seal</td>
</tr>
</table>	  

<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="cc_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="35" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="post_value();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="35"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
