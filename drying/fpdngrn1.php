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
<title>Drying-Transaction- Fresh Arrival With PDN - FRN</title>
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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
	 <input name="frm_action" value="submit" type="hidden"> 
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate2=$row_tbl['disp_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$sub_ary="";
$sql_ar_sub=mysqli_query($link,"select distinct organiser from tbl_dryarrival_sub where  plantcode='".$plantcode."'  and arrival_id='".$arrival_id."'")or die(mysqli_error($link));
$t_ar_sub=mysqli_num_rows($sql_ar_sub);
if($t_ar_sub > 0)
{
while($roq_ar_sub=mysqli_fetch_array($sql_ar_sub))
{
?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr class="Light">
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != "" && $row_param['cphone1'] != 0){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>, <?php echo $row_param['pcity'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != "" && $row_param['pphone1'] != 0){  echo ", ".$row_param['pphone1']>0;}?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Fresh Seed Receipt Note (FRN)</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="203" align="right" valign="middle" class="tblheading">&nbsp;Type of Arrival&nbsp;</td>
<td width="273"  align="left" valign="middle" class="tbltext">&nbsp;Fresh Seed with PDN</td>
<td width="124" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="240" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Dispatch Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tdate2;?></td>
	<td align="right"  valign="middle" class="tblheading">FRN No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "FRN/".$yearid_id."/".$row_tbl['ncode'];?></td>
          </tr>
		  
		   <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="203" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="124" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="240" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="203" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="273" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="203" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="273" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="124" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="240" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="203" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="30%" align="left" rowspan="2" valign="left" class="tblheading">&nbsp;&nbsp;We acknowledge the receipt of following materials:</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' and organiser='".$roq_ar_sub['organiser']."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
    <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
	<td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Organiser</td>
	<td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Farmer</td>
	<td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Prod. Loc.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 	</tr>
 
<tr class="tblsubtitle">
    <td width="4%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="6%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="4%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
	 	$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
		$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$varty=$row_tbl_sub['lotvariety'];

$dq=explode(".",$row_tbl_sub['qty1']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty1'];}

$dn=explode(".",$row_tbl_sub['qty']);
if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty'];}

$aq=explode(".",$row_tbl_sub['act1']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act1'];}

$an=explode(".",$row_tbl_sub['act']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act'];}

$diq=explode(".",$row_tbl_sub['diff1']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff1'];}

$din=explode(".",$row_tbl_sub['diff']);
if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff'];}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $varty;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['organiser'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['farmer'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['ploc'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
    <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
	</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $varty;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['organiser'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['farmer'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['ploc'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
    <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
</tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="92" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="752" colspan="11" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table>
<br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"></div></td>
</tr>
</table><br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="183"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="78" align="right" valign="middle" class="smalltblheading">&nbsp;Verified By</td>
<td width="158" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="97" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="133" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
		<br />
<hr style="border-style:dashed" /><br />
		
<?php
}
}
?>	
	
<table cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"></a><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
