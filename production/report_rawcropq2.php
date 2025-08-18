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
	
	date_default_timezone_set("Asia/Calcutta");
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$slchk = $_REQUEST['slchk'];
	$slchk2 = $_REQUEST['slchk2'];
	
?>
<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
<title>Viewer- Report - Quality based Stock Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropallq.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php

$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#ef0388" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Quality based Stock Report As on - <?php echo date("d-m-Y h:i:s A"); ?></td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $ver;?><span class="subheading" style="float:right; color:#FF0000; font-size:11px; vertical-align:text-bottom;">* OK and UT Qty includes both Germination and GOT based seed stocks&nbsp;&nbsp;</span></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#ef0388" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="160" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="226" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Raw Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Condition Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Pack Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Sales Return Seed</td>
	<td align="center" valign="middle" class="tblheading" colspan="4">Grand Total</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">BL</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Total</td>
</tr>
<?php
$srno=1; 

$sql_istbl=mysqli_query($link,"select * from tmp_vwasrrep where logid='".$logid."' order by crop asc, variety asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_istbl))
	{ 
	
	$crop1=""; $verty=""; $totrqok=0; $totrqut=0; $totrgotbl=0; $totrqty=0; $totcqok=0; $totcqut=0; $totcgotbl=0; $totcqty=0; $totpqok=0; $totpqut=0; $totpgotbl=0; $totpqty=0; $totsrqok=0; $totsrqut=0; $totsrqty=0; $totqok=0; $totqut=0; $totgotbl=0; $tqty=0;
	
	$crop1=$row_issuetbl['crop']; 
	$verty=$row_issuetbl['variety']; 
	$totrqok=$row_issuetbl['rsok']; 
	$totrqut=$row_issuetbl['rsut']; 
	$totrgotbl=$row_issuetbl['rsbl']; 
	$totrqty=$row_issuetbl['rstotal']; 
	$totcqok=$row_issuetbl['csok']; 
	$totcqut=$row_issuetbl['csut']; 
	$totcgotbl=$row_issuetbl['csbl']; 
	$totcqty=$row_issuetbl['cstotal']; 
	$totpqok=$row_issuetbl['psok']; 
	$totpqut=$row_issuetbl['psut']; 
	$totpgotbl=$row_issuetbl['psbl']; 
	$totpqty=$row_issuetbl['pstotal']; 
	$totsrqok=$row_issuetbl['srok']; 
	$totsrqut=$row_issuetbl['srut']; 
	$totsrqty=$row_issuetbl['srtotal']; 
	$totqok=$row_issuetbl['gtok']; 
	$totqut=$row_issuetbl['gtut']; 
	$totgotbl=$row_issuetbl['gtbl']; 
	$tqty=$row_issuetbl['gttotal']; 
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totcqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqok;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqut;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqut?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totgotbl;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>			

<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropallq.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>