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


	if(isset($_REQUEST['subid']))
	{
		$subid = $_REQUEST['subid'];
	}
	if(isset($_REQUEST['itmid']))
	{
		$itmid = $_REQUEST['itmid'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<script language='javascript'>

</script>
</head>
<body topmargin="0" >
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <?php
 $tid=$itmid;

$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$tot_crop=mysqli_num_rows($sql_crop);		
$crps=$row_crop['cropname'];

$sql_ver=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."'") or die(mysqli_error($link));
$row_ver=mysqli_fetch_array($sql_ver);
$tot_ver=mysqli_num_rows($sql_ver);		
$nvariety=$row_ver['popularname'];

$sql_tblsub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tblsub=mysqli_fetch_array($sql_tblsub);
$tot=mysqli_num_rows($sql_tblsub);	
$ups=$row_tblsub['pnpslipsub_ups'];
$lot23=$row_tblsub['pnpslipsub_plotno'];
?>
	

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Barcode(s) List</td>
</tr>
</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="Light" height="20">
  <td align="center" class="tblheading">Crop</td>
  <td align="center" class="tblheading"><?php echo $crps;?></td>
  <td align="center" class="tblheading">Variety</td>
  <td align="center" class="tblheading"><?php echo $nvariety;?></td>
   <td align="center" class="tblheading">UPS</td>
  <td align="center" class="tblheading"><?php echo $ups;?></td>
  <td align="center" class="tblheading">Lot No.</td>
  <td align="center" class="tblheading"><?php echo $lot23;?></td>
</tr>
<tr class="tblsubtitle" height="20">
<td width="55"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="100" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="85" align="center"  valign="middle" class="tbltext">Net Weight</td>
	<td width="126" align="center"  valign="middle" class="tbltext">Gross Weight</td>
	<td width="55"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="100" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="85" align="center"  valign="middle" class="tbltext">Net Weight</td>
	<td width="126" align="center"  valign="middle" class="tbltext">Gross Weight</td>
</tr>
   <tr class="tblsubtitle">
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
?><tr class="Light" height="20">
<?php
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$ssub3=mysqli_query($link,"select pnpslipbar_barcode from tbl_pnpslipbarcode where plantcode='$plantcode' and pnpslipbar_lotno='".$row_tbl_sub['pnpslipsub_plotno']."' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$tot_barcnomp=mysqli_num_rows($ssub3);
?>

<?PHP
if($srno%2==1)
{
?>
    <td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipbar_barcode'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipbar_wtmp'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipbar_grosswt'];?></td>
 <?php
}
else
{
?>
<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipbar_barcode'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipbar_wtmp'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['pnpslipbar_grosswt'];?></td>
</tr>  <?php
}
$srno++;
?>

<?PHP

}
}
?>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
