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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
	
	if(isset($_REQUEST['p_id']))
	{
	 $pid = $_REQUEST['p_id'];
	}
	$tp="Trading";	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Drying-Transaction- Old Lot To New Note</title>
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
   <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" /><br />
<table align="center" border="0" width="650" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Old Lot to New Lot Note </font></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#adad11" style="border-collapse:collapse">
  <?php

$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arr_role='".$logid."' and arrival_type='Trading' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));

?>
  <tr class="tblsubtitle" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading">#</td>
   
	  <td width="12%" align="center" valign="middle" class="tblheading">Crop</td>
	   <td width="12%" align="center" valign="middle" class="tblheading">Vendor Variety </td>
    <td width="11%"  align="center" valign="middle" class="tblheading"> VendorLot No </td>
	<td width="21%" align="center" valign="middle" class="tblheading">VNR Variety </td>
    <td width="16%"  align="center" valign="middle" class="tblheading">VNR Lot No. </td>
	<!--<td width="17%" align="center" valign="middle" class="tblheading">Vendor Variety </td>-->
    <td width="10%"  align="center" valign="middle" class="tblheading">NoB</td>
    <td width="10%"  align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{ 
if($srno%2!=0)
{
 $row_tbl_sub['lotno'];
?>
  <tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotcrop'];?></td>
	<td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['vvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	<!-- /* <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotvariety'];?></td>*/-->
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Dark" height="20">
   <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
   <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotcrop'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['vvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <!--<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotvariety'];?></td>-->
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>

<table cellpadding="5" cellspacing="5" border="0" width="650" align="center">
<tr >
<td align="right" colspan="3"><!--<a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   /></a>&nbsp;-->&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
