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
		$itmid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Order-Transaction-Cancel Order Note - CON</title>
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
 //$tid=$itmid;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$itmid."'") or die(mysqli_error($link));
$row_tbl1=mysqli_fetch_array($sql_tbl);
$total_tbl=mysqli_num_rows($sql_tbl);			
$tid=$row_tbl1['orderm_id'];

?>	

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Order Details</font></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
?>
<tr class="tblsubtitle" height="20">
    	<td width="20" align="center" valign="middle" class="tblheading">#</td>
		<td width="137" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="198" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="46" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="102" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="109" align="center" valign="middle" class="tblheading">Ordered Quantity (Kgs.)</td>
        <td width="122" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
</tr>
  <?php
$srno24=1;$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$up=""; $qt=""; $np=""; $qt1=""; $np1=""; $up1=""; 
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$np1=$dq[0];}else{$np1=$row_sloc['order_sub_subbal_qty'];}

if($np!="")
$np=$np.$np1."<br/>";
else
$np=$np1."<br/>";

if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}

if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="20" align="center" valign="middle" class="tblheading"><?php echo $srno24;?>
    	  <input type="hidden" name="subsubid" id="subsubid_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="198" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="46" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="102" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="109" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="122" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="20" align="center" valign="middle" class="tblheading"><?php echo $srno24;?>
    	  <input type="hidden" name="subsubid" id="subsubid_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="198" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="46" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="102" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="109" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="122" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
</tr>		
<?php
}
$srno24++;
}
}
}
?>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" colspan="3"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
