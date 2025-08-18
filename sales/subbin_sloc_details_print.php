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

	if(isset($_REQUEST['slid']))
	{
	$slid = $_REQUEST['slid'];
	}
	if(isset($_REQUEST['wid']))
	{
	$wid = $_REQUEST['wid'];
	}
	if(isset($_REQUEST['bid']))
	{
	$bid = $_REQUEST['bid'];
	}
	if(isset($_REQUEST['tp']))
	{
	$tp = $_REQUEST['tp'];
	}
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	if(isset($_REQUEST['lid']))
	{
	$lid = $_REQUEST['lid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales return - Sloc details</title>
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php 
$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$wid."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$bid."' and whid='".$wid."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);

$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$slid."' and binid='".$bid."' and whid='".$wid."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
?>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Dark" height="17">
<td width="399" align="left"  valign="middle" class="tblheading">&nbsp;Sub-Bin Card</td>
<td width="401" align="right"  valign="middle" class="tblheading">SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $row_subbinn['sname'];?>&nbsp;</td>
</tr>
<!--<tr class="Dark" height="17">
<td width="399" align="left"  valign="middle" class="tblheading">&nbsp;Crop:&nbsp;&nbsp;<?php echo $row31['cropname'];?></td>
<td width="401" align="right"  valign="middle" class="tblheading">Variety:&nbsp;&nbsp;<?php echo $varty;?>&nbsp;</td>
</tr>-->
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#a8a09e" style="border-collapse:collapse">
			 
<tr class="tblsubtitle">
	<td width="27" align="center" valign="middle" class="tblheading">#</td>
	<td width="92" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="73" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="127" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="69" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="67" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="107" align="center" valign="middle" class="tblheading">QC Status </td>
	<td width="95" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="100" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="95" align="center" valign="middle" class="tblheading">GOT Status</td>
</tr>
<?php
$srno=1; $cnt=0;
$sql_tbl=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrss_wh='".$wid."' and salesrss_bin='".$bid."' and salesrss_subbin='".$slid."'  order by salesrss_subbin") or die(mysqli_error($link));  
//echo $t=mysqli_num_rows($sql_tbl);
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
$sql_tbl1=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$row_tbl['salesrs_id']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl1['salesrs_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl1['salesrs_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_veriety);
$varty=$row_variety['popularname'];

$sups=$row_tbl1['salesrss_ups']; 

$snob=$row_tbl['salesrss_nob']; 
$sqty=$row_tbl['salesrss_qty'];

$diq=explode(".",$sqty);
if($diq[1]==000){$slqty=$diq[0];}else{$slqty=$sqty;}

$din=explode(".",$snob);
if($din[1]==000){$slups=$din[0];}else{$slups=$snob;}

if($row_tbl1['salesrs_upstype']=="Standard")
$upstyp="ST";
if($row_tbl1['salesrs_upstype']=="Non-Standard")
$upstyp="NST";
else
$upstyp="ST";

$tdate1=$row_tbl1['salesrs_dov'];
$tyear1=substr($tdate1,0,4);
$tmonth1=substr($tdate1,5,2);
$tday1=substr($tdate1,8,2);
$dov=$tday1."-".$tmonth1."-".$tyear1;

$lotno=$row_tbl1['salesrs_orlot'];
$cnt++;
if($srno%2!=0)
{
?>		  
<tr class="Light" height="20">
	<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    <td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
	<td width="158" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 	<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl1['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl1['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>		 
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $row_tbl1['salesrs_got']." ".$row_tbl1['salesrs_got1'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    <td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
	<td width="158" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 	<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl1['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl1['salesrs_qc'];?></td>	
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>	 
	<td width="100" align="center" valign="middle" class="tblheading"><?php echo $row_tbl1['salesrs_got']." ".$row_tbl1['salesrs_got1'];?></td>
</tr> 
<?php
}
$srno++;
}
if($cnt==0)
{
?> 
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading" colspan="11">No Records Found</td>
</tr>			 
<?php
}
?>	  
</table>
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
