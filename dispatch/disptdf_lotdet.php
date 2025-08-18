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
 
	if(isset($_GET['pid']))
	{
		$pid = $_GET['pid'];	 
	}
	if(isset($_GET['sid']))
	{
		$sid = $_GET['sid'];	 
	}
	if(isset($_GET['sn']))
	{
		$sn = $_GET['sn'];	 
	}
	if(isset($_GET['nlots']))
	{
		$nlots = $_GET['nlots'];	 
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch TDF - Lot Details</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<body>

<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="97" align="center" class="smalltblheading">Crop</td>
	<td width="119" align="center" class="smalltblheading">Variety</td>
	<td width="109" align="center" class="smalltblheading">Lot No.</td>
	<td width="65" align="center" class="smalltblheading">NoB Released</td>
	<td width="70" align="center" class="smalltblheading">Qty Released</td>
</tr>
<?php

if($nlots!="" && $nlots > 0)
{
	$sno=1;
	$sqq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$pid'") or die(mysqli_error($link));
	while($roo=mysqli_fetch_array($sqq))
	{
		$sq23=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$pid'") or die(mysqli_error($link));
		$totre=mysqli_num_rows($sq23);
		while($row23=mysqli_fetch_array($sq23))
		{
			$lotno=$row23['dbss_lotno'];
			$vers=$roo['dtdfs_variety'];
			$crps=$roo['dtdfs_crop'];
			$nob=$row23['dbss_nob'];
			$qqt=$row23['dbss_qty'];
		
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crps;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vers?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qqt;?></td>
</tr>
<?php
$sno++;	
}
}
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="500">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</body>
</html>