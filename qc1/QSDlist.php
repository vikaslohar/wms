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
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores-Transaction- GRN</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Vendor' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table></td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >

<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">QC Sample Dispatch List </font></td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
 <tr class="Dark" height="20">
<td width="102" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			<td width="139" rowspan="2" align="center" valign="middle" class="tblheading">Sample No. </td>
			<td width="49" colspan="1" align="center" valign="middle" class="tblheading">Crop </td>
			<td width="65" colspan="1" align="center" valign="middle" class="tblheading"> Variety</td>
			<td width="68" colspan="1" align="center" valign="middle" class="tblheading">Lot No. </td>
			<td width="107" colspan="1" align="center" valign="middle" class="tblheading">Test Type </td>
			<td width="31" colspan="1" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="136" colspan="1" align="center" valign="middle" class="tblheading">stage at Arival </td>
			<td width="133" colspan="1" align="center" valign="middle" class="tblheading">Quality Status</td>
</tr>
<tr class="tblsubtitle" height="25">
			<!--<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>-->
</tr>
<?php 
$srno=1;
while($row=mysqli_fetch_array($rs))
	{
	$id=$row['stld_trid'];
	$itemid=$row['stld_tritemid'];
	$cls=$row['stld_trclassid'];
	$stlg_trdate=$row['stld_trdate'];
	$stlg_trups=$row['stld_trups'];
	$stlg_trqty=$row['stld_trqty'];
	$stld_trpartyid=$row['stld_trpartyid'];
	
	
			$s = "select stores_item,uom from tbl_stores where items_id='".$itemid."'";
	 		$r = mysqli_query($link,$s) or die(mysqli_error($link));	 
			$ro = mysqli_fetch_array($r);
			$stores_item = $ro['stores_item'];
			$uom = $ro['uom'];
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
		
		
		$quer3=mysqli_query($link,"SELECT * FROM tbl_discard where tid='".$id."'"); 
 		$noticia = mysqli_fetch_array($quer3);
 		$p_name=$noticia['party_name'];
 		


if ($srno%2 != 0)
	{	

?>

<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $p_name;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trups;?></td>
			
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $p_name;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trups;?></td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
</tr>
<?php
}
}
?>
</table>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >

<tr  height="20">
 <td width="261" align="right"  valign="middle" class="tblheading">Send To &nbsp;</td>
 <td width="489" align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtuom" class="tbltext"  style="width:170px;" tabindex="" onChange="f2(this.value);">
		<option value="">---Select Color--</option>
		<option value="NOT tested">Not tested</option>
		<option value="accept">Acceptabel</option>
		<option value="naccept">Not acceptaable</option>
		</select></td>
</tr>
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">seed Sample________________________________ </font></td>
</tr>
</table>
<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="24%" align="left" rowspan="2" valign="left" class="tblheading">&nbsp;&nbsp;We acknowledge the receipt of the following goods:</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">
  <?php
//echo $arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));

?>
  <tr class="tblsubtitle" height="20">
    <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
    <td width="18%" align="center" rowspan="3" valign="middle" class="tblheading">Lot No </td>
    <td width="23%" rowspan="3" align="center" valign="middle" class="tblheading">Quantity</td>
 
  </tr>
  <tr class="tblsubtitle">
    <td colspan="2" align="center" valign="middle" class="tblheading">Dispatch</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Recived</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Difference</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{ 
$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="23%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Dark" height="20">
    <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="23%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
     </tr>
  <?php
}
$srno++;
}
}
?>
</table>-->
<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form></td></tr>
</table>

</body>
</html>
