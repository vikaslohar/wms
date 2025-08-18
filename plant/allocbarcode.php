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

	
	$tp="MD";
	if(isset($_REQUEST['itmid']))
	{
	  $pid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['itmid1']))
	{
	  $ttype = $_REQUEST['itmid1'];
	}
	$lotno1=$pid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - MDN</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<table width="650" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<?php
$lotno12=$lotno1."P";
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Allocated Barcodes</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="600" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="38" align="center" valign="middle" class="tblheading">#</td>
	<td width="111" align="center" valign="middle" class="tblheading">Barcode</td>
	<!--<td width="134" align="center" valign="middle" class="tblheading">Pack Type</td>-->
	<td width="105" align="center" valign="middle" class="tblheading">Gross Weight</td>
    <td width="100" align="center" valign="middle" class="tblheading">Net Weight</td>
	<td width="122" align="center" valign="middle" class="tblheading">Lot Net Weight</td>
	<td width="110" align="center" valign="middle" class="tblheading">UPS</td>  
</tr>
<?php
$srno=1;
//echo "select * from tbl_dallocsub_sub3 where dalloc_id='".$ttype."' and dallocss3_lotno='".$pid."' and dallocss3_dflg=0 order by dallocss3_id asc";
$sql_baralloc=mysqli_query($link,"select * from tbl_dallocsub_sub3 where dalloc_id='".$ttype."' and dallocss3_lotno='".$pid."' and dallocss3_dflg=0 AND plantcode='$plantcode' order by dallocss3_id asc") or die(mysqli_error($link));
while($row_baralloc=mysqli_fetch_array($sql_baralloc))
{
	$barcode=""; $grwt=""; $netwt=""; $ups=""; $lotnetwt="";
	$sql_dispss=mysqli_query($link,"select * from tbl_dallocsub_sub where dallocss_id='".$row_baralloc['dallocss_id']."' and dallocss_lotno='".$lotno1."' and dallocss_ups='".$row_baralloc['dallocss3_ups']."' AND plantcode='$plantcode' order by dallocss_id asc") or die(mysqli_error($link));
	$row_dispss=mysqli_fetch_array($sql_dispss);
	$lotnetwt=$row_dispss['dallocss_qty'];
	$barcode=$row_baralloc['dallocss3_barcode'];
	$grwt=$row_baralloc['dallocss3_grossweight'];
	$netwt=$row_baralloc['dallocss3_weight'];
	$ups=$row_baralloc['dallocss3_ups'];
	
	$dq=explode(" ",$ups);
	$dqs=explode(".",$dq[0]);
	if($dqs[1]>0)
	$aqs=$dqs[0].".".$dqs[1];
	else
	$aqs=$dqs[0];
	$ups=$aqs." ".$dq[1];
?> 
<tr class="Light" height="20">
	<td width="38" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<!--<td width="113" align="center" valign="middle" class="smalltbltext"><?php echo $row_baralloc['dpss_barcode'];?></td>-->
	<td align="center" class="smalltbltext" valign="middle"><?php echo $barcode;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $grwt;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $netwt;?></td>
	<td align="center" class="smalltbltext" valign="middle"><?php echo $lotnetwt;?></td>
	<td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
</tr>
<?php
$srno++;
}//}?>
</table><br /><?php //}?>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
</form>
</td></tr>
</table>

</body>
</html>
