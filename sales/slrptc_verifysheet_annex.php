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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Transaction - Verification Sheet-Annexure</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
  
<table width="900" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['salesr_id'];

	$tdate=$row_tbl['salesr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['salesr_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return - Verification Sheet</td>
</tr>

<tr class="Dark" height="30">
<td width="155" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="159"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SR".$row_tbl['salesr_code']."/".$row_tbl['salesr_yearcode']."/".$row_tbl['salesr_logid'];?></td>
<td width="47" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="112" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
<td width="123" align="right" valign="middle" class="tblheading">&nbsp;SRV No.&nbsp;</td>
<td width="240" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SRV"."/".$yearid_id."/".sprintf("%00005d",$row_tbl['salesr_slrno']);?></td>
</tr>

<tr class="Light" height="30">
<td width="155" align="right" valign="middle" class="tblheading">Party DC Date&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">Party DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcno'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['salesr_partytype'];?></td>
<td width="123" align="right"  valign="middle" class="tblheading">SRI No.&nbsp;</td>
<td width="240" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo sprintf("%00005d",$row_tbl['salesr_slrno']);?></td>
</tr>

</table>
<div id="selectpartylocation"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{	
$sql_month=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['salesr_state']."' and productionlocationid='".$row_tbl['salesr_loc']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="155"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="322" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_state'];?></td>
	<td width="123"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="240" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia['productionlocation'];?></td>
  </tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="155"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="689" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_loc'];?></td>
</tr>
</table>
<?php
}
?>
</div>		   
<div id="selectparty"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$row_tbl['salesr_loc']."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$row_tbl['salesr_loc']."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where country='".$c."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
$noticia = mysqli_fetch_array($sql_month);

?>		   
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >   
 <tr class="Light" height="30">
<td width="156"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="688"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?></td>
	</tr>

<tr class="Dark" height="30">
<td width="156" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?></div></td>
</tr>
</table>
</div>	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse"  > 

<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Packages&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcnop'];?></td>

<td width="121" align="right"  valign="middle" class="tblheading">Type of Packages&nbsp;</td>
<td width="239" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_packtyp'];?></td>
</tr>-->
<tr class="Light" height="25">
<td width="156" align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td width="688" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_tmode'];?></td>
</tr>
</table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse; display:<?php if($row_tbl['salesr_tmode']=="Transport") echo "block"; else echo "none";?>" > 
<tr class="Light" height="30">
<td align="right" width="156" valign="middle" class="tblheading" >&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_tname'];?></td>
<td width="123" align="right"  valign="middle" class="tblheading" >Lorry Receipt No&nbsp;</td>
<td align="left" width="240" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="156" valign="middle" class="tblheading" >&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="321" valign="middle" class="tbltext"  >&nbsp;<?php echo $row_tbl['salesr_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading" >&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_pmode'];?>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse; display:<?php if($row_tbl['salesr_tmode']=="Courier") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="156" valign="middle" class="tblheading" >&nbsp;Courier Name&nbsp;</td>
<td align="left" width="321" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_cname'];?></td>
<td align="right" width="123" valign="middle" class="tblheading" >&nbsp;Docket No.&nbsp;</td>
<td align="left" width="240" valign="middle" class="tbltext"  >&nbsp;<?php echo $row_tbl['salesr_docket'];?></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse; display:<?php if($row_tbl['salesr_tmode']=="By Hand") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="156" valign="middle" class="tblheading" >&nbsp;Name of Person&nbsp;</td>
<td width="688" colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_pname'];?></td>
</tr>

</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" valign="middle" class="tblheading">Packages</td>
  </tr>
<tr class="Light" height="30">
<td width="195" align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="center"  valign="middle" class="tblheading">As per DC</td>
<td align="center"  valign="middle" class="tblheading">Actual Received</td>
<td align="center"  valign="middle" class="tblheading">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Cartons&nbsp;</td>
<td width="282" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_dnop'];?></td>
<td width="123" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1'];?></td>
<td width="240" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1']-$row_tbl['salesr_dnop'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags&nbsp;</td>
<td width="282" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_nob'];?></td>
<td width="123" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1'];?></td>
<td width="240" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1']-$row_tbl['salesr_nob'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Total Packages&nbsp;</td>
<td width="282" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_tnop'];?></td>
<td width="123" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1'];?></td>
<td width="240" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1']-$row_tbl['salesr_tnop'];?></td>
</tr>
</table>
<?php
$srsloc=""; $wareh=""; $binn=""; $wareh2=""; $binn2="";
if($row_tbl['salesr_nop'] > 0)
{
$sql_whouse=mysqli_query($link,"select perticulars from tblpvwarehouse where plantcode='$plantcode' AND whid='".$row_tbl['salesr_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tblpvbin where plantcode='$plantcode' AND binid='".$row_tbl['salesr_bin']."' and whid='".$row_tbl['salesr_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']." | ".$row_tbl['salesr_nop'];
}
if($row_tbl['salesr_nop1'] > 0)
{
$sql_whouse2=mysqli_query($link,"select perticulars from tblpvwarehouse where plantcode='$plantcode' AND whid='".$row_tbl['salesr_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse2=mysqli_fetch_array($sql_whouse2);
$wareh2=", ".$row_whouse2['perticulars']."/";

$sql_binn2=mysqli_query($link,"select binname from tblpvbin where plantcode='$plantcode' AND binid='".$row_tbl['salesr_bin']."' and whid='".$row_tbl['salesr_wh']."'") or die(mysqli_error($link));
$row_binn2=mysqli_fetch_array($sql_binn2);
$binn2=$row_binn2['binname']." | ".$row_tbl['salesr_nop1'];
}
$srsloc=$wareh.$binn.$wareh2.$binn2;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="195" valign="middle" class="tblheading" >&nbsp;SR-PV SLOC&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $srsloc;?></td>
</tr>

</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="18" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="71" align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
	<td width="98" align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td width="97" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
	<td width="65" align="center" valign="middle" class="smalltblheading" rowspan="2">DoV</td>
	<!--<td width="51" align="center" valign="middle" class="smalltblheading" rowspan="2">Old Lot No.</td>
	<td width="52" align="center" valign="middle" class="smalltblheading" rowspan="2">New Lot No.</td>-->
	<td align="center" valign="middle" class="smalltblheading" colspan="3">As per DC</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">Actual Good</td>
	<td width="94" align="center" valign="middle" class="smalltblheading" rowspan="2">Good SLOC<br />WH-SR
</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Actual Damage</td>
	<td width="65" align="center" valign="middle" class="smalltblheading" rowspan="2">Damage SLOC<br />
WH-DM</td>
	
</tr>
<tr class="tblsubtitle" height="20">
	<td width="65" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="65" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
  <?php
$srno=1;
for($i=0; $i<20; $i++)
{
?>
<tr class="Light" height="40">
    <td width="18" align="center" valign="middle" class="smallesttbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
    <td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smallesttbltext">&nbsp;</td>
</tr>
<?php
$srno++;
}
?>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_remarks'];?></td>
</tr>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="900">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
