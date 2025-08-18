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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	
	if(isset($_GET['txtlot1']))
	{
    $txtlot1 = $_GET['txtlot1'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying - Utility - Lot Biography</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<script type="text/javascript">

</script>

<body>
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="txtlot1" value="<?php echo $txtlot1;?>" />	 
 <?php	
 
$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   orlot='".$txtlot1."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_tb1=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arrival_id='".$row_whouse['arrival_id']."'")or die(mysqli_error($link));
$sql_tb2=mysqli_fetch_array($sql_tb1);

		 $arr_type=$sql_tb2['arrival_type'];

		$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot=""; $spcm=""; $spcf=""; $plotno=""; $pdnno="";$plotsize="";$vendor="";$vendorvariety="";$dcno="";
		
				if($arr_type=="Fresh Seed with PDN")
				{
					$crop=$row_whouse['lotcrop'];
					$tp="Fresh Seed with PDN";
					$org=$row_whouse['organiser'];
					$far=$row_whouse['farmer'];
					$variety=$row_whouse['lotvariety'];
					$ploc=$row_whouse['ploc'];
					$pper=$row_whouse['pper'];
					$stage=$row_whouse['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got=$row_whouse['got1'];
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$gi=$row_whouse['gi'];
					$vchk=$row_whouse['vchk'];
					$spcm=$row_whouse['spcodem'];
					$spcf=$row_whouse['spcodef'];
					$plotno=$row_whouse['plotno'];
					$plotsize=$row_whouse['plotsize'];
					$pdnno=$row_whouse['pdnno'];
				}
				else if($arr_type=="StockTransfer Arrival")
				{
					$crop=$row_whouse['lotcrop'];
					$tp="Stock Transfer Arrival";
					$variety=$row_whouse['lotvariety'];
					$stage=$row_whouse['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got1=$row_whouse['got'];
					$got2=$row_whouse['got1'];
					$got=$got1." ".$got2;
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$vchk=$row_whouse['vchk'];
					$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$sql_tb2['party_id']."'") or die(mysqli_error($link));
					$tot_party=mysqli_num_rows($sql_party);
					if($tot_party > 0)
					{
					$row_party=mysqli_fetch_array($sql_party);
					$vendor=$row_party['business_name'];
					}
				}
				else if($arr_type=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tb2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tb2['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
					
					$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$sql_tb2['party_id']."'") or die(mysqli_error($link));
					$tot_party=mysqli_num_rows($sql_party);
					if($tot_party > 0)
					{
					$row_party=mysqli_fetch_array($sql_party);
					
					$vendor=$row_party['business_name']."<br/>".$row_party['address'].", ".$row_party['city'].", ".$row_party['state']." - ".$row_party['pin'];
					}
					$vendorvariety=$sql_tb2['vvariety'];
					$dcno=$sql_tb2['dcno'];
					
					$crop=$sql_tb2['lotcrop'];
					$variety=$sql_tb2['lotvariety'];
					$stage=$sql_tb2['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got=$row_whouse['got1'];
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$vchk=$row_whouse['vchk'];
					$oldlot = $row_whouse['lotoldlot'];
				}
				else if($arr_type=="Unidentified")
				{
					$tp="Unidentified";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tb2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tb2['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
					
					$vendor=$sql_tb2['type'];
					$ploc=$row_whouse['ploc'];
					$crop=$row_whouse['lotcrop'];
					$variety=$row_whouse['lotvariety'];
					$stage=$row_whouse['sstage'];
					$moist=$row_whouse['moisture'];
					$germ=$row_whouse['gemp'];
					$got=$row_whouse['got1'];
					$qc=$row_whouse['qc'];
					$lotno=$row_whouse['lotno'];
					$vchk=$row_whouse['vchk'];
					$oldlot = $row_whouse['lotoldlot'];
				}
				else
				{
				$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot=""; $spcm=""; $spcf=""; $plotno=""; $pdnno="";$plotsize="";$vendor="";$vendorvariety="";$dcno="";
				}
			
$germ=$row_whouse['gemp'];

if($vchk=="Acceptable"){$vchk="Acc";}
if($vchk=="Not-Acceptable"){$vchk="NAcc";}
$pp=$vchk;
	$trdate=$sql_tb2['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_whouse['harvestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_whouse['pdndate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
	
	$trdate3=$sql_tb2['dc_date'];
	$tryear3=substr($trdate3,0,4);
	$trmonth3=substr($trdate3,5,2);
	$trday3=substr($trdate3,8,2);
	$trdate3=$trday3."-".$trmonth3."-".$tryear3;
	
	$trdate4=$sql_tb2['dc_date'];
	$tryear4=substr($trdate4,0,4);
	$trmonth4=substr($trdate4,5,2);
	$trday4=substr($trdate4,8,2);
	$trdate4=$trday4."-".$trmonth4."-".$tryear4;
	
	$nob=0; $qty=0;
	$sql_tbl=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_id='".$row_whouse['arrsub_id']."' and arr_tr_id='".$sql_tb2['arrival_id']."'")or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_tbl);
	while($row_arr=mysqli_fetch_array($sql_tbl))
	{
	$nob=$nob+$row_arr['bags'];
	$qty=$qty+$row_arr['qty'];
	}
	
?><br />

<table align="center" border="1" bordercolor="#adad11" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading"><font size="+1">Lot Biography</font> </td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="135" align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
	<td width="255" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading">&nbsp;Variety&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td align="right"  valign="middle" class="tblheading">&nbsp;Lot No.&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $txtlot1;?></td>
	<td align="right"  valign="middle" class="tblheading">&nbsp;GOT on Arrival&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>

  </table>
<?php if($arr_type=="Fresh Seed with PDN") {?>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading">Arrival Type&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3" >&nbsp;<?php echo $tp;?></td>
	
</tr>
<tr class="Dark" height="20">
	<td width="135" align="right" valign="middle" class="tblheading">SP code Female&nbsp;</td>
	<td width="255" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $spcf;?></td>
	<td width="132" align="right"  valign="middle" class="tblheading">SP code Male&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $spcm;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading">Production Location&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $ploc;?></td>
    <td align="right" valign="middle" class="tblheading">Production Personnel&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pper;?></td>
</tr>
<tr class="Dark" height="20">	
    <td align="right" valign="middle" class="tblheading">Organiser&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $org;?></td>
    <td align="right" valign="middle" class="tblheading">Farmer&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $far;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading">Plot No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $plotno;?></td>
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading">GI&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $gi;?></td>
	<td align="right" valign="middle" class="tblheading">Harvest Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate1;?></td>
</tr>
<tr class="Dark" height="20">	
	<td align="right" valign="middle" class="tblheading">PDN No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pdnno;?></td>
	<td align="right" valign="middle" class="tblheading">PDN Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate2;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate3;?></td>
	<td align="right" valign="middle" class="tblheading">Arrival Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">QC on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading">GOT on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>

</table>
<?php } ?>
<?php if($arr_type=="StockTransfer Arrival") {?>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading">Arrival Type&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3" >&nbsp;<?php echo $tp;?></td>
	
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Stock Transfer From&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">	
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate3;?></td>
	<td align="right" valign="middle" class="tblheading">Arrival Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">QC on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading">GOT on Arrival&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>

</table>
<?php } ?>
<?php if($arr_type=="Trading") {?>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading">Arrival Type&nbsp;</td>
	<td width="255" align="left" valign="middle" class="tblheading" >&nbsp;<?php echo $tp;?></td>
	<td width="132" align="right" valign="middle" class="tblheading">Arrival Date&nbsp;</td>
	<td width="268" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Vendor&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Vendor Variety Name&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendorvariety;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Vendor Lot No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $oldlot;?></td>
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">DC No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dcno;?></td>
	<td align="right" valign="middle" class="tblheading">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate4;?></td>
</tr>
<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">QC Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading">GOT Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>
<!--<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $germ;?></td>
</tr>-->


</table>
<?php } ?>
<?php if($arr_type=="Unidentified") {?>
<!--<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Arrival Status-Unidentified Arrivals</td>
</tr>
</table>-->
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="135" align="right" valign="middle" class="tblheading">Arrival Type&nbsp;</td>
	<td width="255" align="left" valign="middle" class="tblheading" >&nbsp;<?php echo $tp;?></td>
	<td width="132" align="right" valign="middle"  class="tblheading">Arrival Date&nbsp;</td>
	<td width="268" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Unidentified Arrived In&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $vendor;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Location&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $ploc;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Vendor Lot No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $oldlot;?></td>
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">DC No.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dcno;?></td>
	<td align="right" valign="middle" class="tblheading">DC Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php if($trdate3!="" && $trdate3!="00-00-0000")echo $trdate3;?></td>
</tr>-->
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Actual NoB&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nob;?></td>
	<td align="right" valign="middle" class="tblheading">Actual Qty.&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">QC Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>
	<td align="right" valign="middle" class="tblheading">GOT Status&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>
<tr class="Light" height="20">		
    <td align="right" valign="middle" class="tblheading">PP&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $pp;?></td>
	<td align="right" valign="middle" class="tblheading">Moist %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $moist;?></td>
</tr>
<!--<tr class="Light" height="20">		
	<td align="right" valign="middle" class="tblheading">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $germ;?></td>
</tr>-->


</table>
<?php } ?>
<?php
$a=$txtlot1;
$zzz=implode(",", str_split($a));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
$baselot2=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26];
//echo $xxcc="select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and   SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where plantcode='".$plantcode."' and SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where plantcode='".$plantcode."' and SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$mxlot=$abc2;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2;

$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $sstage=""; $crop=""; $variety="";
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and   orlot='".$a."'  and lotldg_balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$a."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nob=$nob+$row_issuetbl['lotldg_balbags']; 
$qty=$qty+$row_issuetbl['lotldg_balqty'];
$sstage=$row_issuetbl['lotldg_sstage'];

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$variety=$noticia_item['popularname'];

$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
	$trdate=$row_issuetbl['lotldg_qctestdate'];
	$trdate=explode("-",$trdate);
	$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
	$qcdttype="DOT";
}
else
{
	$zz=str_split($a);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				$softstatus=$row_softr['softrsub_srtyp'];
			}

		}
		if($row_issuetbl['lotldg_got']=='UT' || $row_issuetbl['lotldg_got']=='RT')
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
					$softstatus=$row_softr2['softrsub_srtyp'];
				}
			}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
}
if($softstatus!="") 
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">SR/SSR Status</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="Light" height="20">
	<td width="105" align="center" valign="middle" class="tblheading" bgcolor="#fad682">SR/SSR Type</td>
	<td width="104" align="center" valign="middle" class="tblheading"><?php echo ucwords($softstatus);?></td>
	<td width="110" align="center" valign="middle" class="tblheading" bgcolor="#fad682">DoSR/DoSSR</td>
	<td width="109" align="center" valign="middle" class="tblheading"><?php echo $qcdot; ?></td>
</tr>

</table><br />

<?php
}
?>
</form>

		  
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;" class="butn"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">-->&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
</table>


</body>
</html>
