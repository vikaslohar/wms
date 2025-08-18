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
<title>Arrival - Utility - Lot Biography</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
 
$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where orlot='".$txtlot1."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_tb1=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_whouse['arrival_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));
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
				else if($arr_type=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tbl2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tbl2['lotvariety']."' ") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
					
					$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$sql_tbl2['party_id']."'") or die(mysqli_error($link));
					$tot_party=mysqli_num_rows($sql_party);
					if($tot_party > 0)
					{
					$row_party=mysqli_fetch_array($sql_party);
					
					$vendor=$row_party['business_name']."<br/>".$row_party['address'].", ".$row_party['city'].", ".$row_party['state']." - ".$row_party['pin'];
					}
					$vendorvariety=$sql_tbl2['vvariety'];
					$dcno=$sql_tbl2['dcno'];
					
					$crop=$sql_tbl2['lotcrop'];
					$variety=$sql_tbl2['lotvariety'];
					$stage=$sql_tbl2['sstage'];
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
	
	$trdate3=$row_whouse['dc_date'];
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
	$sql_tbl=mysqli_query($link,"select * from tblarr_sloc where arr_id='".$row_whouse['arrsub_id']."' and arr_tr_id='".$row_whouse['arrival_id']."' and plantcode='$plantcode'")or die(mysqli_error($link));

	while($row_arr=mysqli_fetch_array($sql_tbl))
	{
	$nob=$nob+$row_arr['balbags'];
	$qty=$qty+$row_arr['balqty'];
	}
	
?><br />

<table align="center" border="1" bordercolor="#2e81c1" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading"><font size="+1">Lot Biography</font> </td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="126" align="left"  valign="middle" class="tblheading">&nbsp;Crop:&nbsp;</td>
	<td width="264" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
	<td width="132" align="left"  valign="middle" class="tblheading">&nbsp;Variety:&nbsp;</td>
	<td width="268" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td align="left"  valign="middle" class="tblheading">&nbsp;Lot Details:&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $txtlot1;?></td>
	<td align="left"  valign="middle" class="tblheading">&nbsp;GOT Status on Arrival:&nbsp;</td><td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $got;?></td>
</tr>

  </table>
<?php if($arr_type=="Fresh Seed with PDN") {?>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="126" align="right" valign="middle" class="tblheading">Arrival Type&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<?php echo $tp;?></td>
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $stage;?></td>
</tr>
<tr class="Dark" height="20">
	<td width="126" align="right" valign="middle" class="tblheading">SP code Female&nbsp;</td>
	<td width="264" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $spcf;?></td>
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
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $plotno;?></td>
	<!--<td align="right" valign="middle" class="tblheading">Plot Size&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $plotsize;?></td>-->
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
<?php if($arr_type=="Trading") {?>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="Light" height="20">
	<td width="126" align="right" valign="middle" class="tblheading">Arrival Type&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" >&nbsp;<?php echo $tp;?></td>
	<td align="right" valign="middle" class="tblheading">Arrival Date&nbsp;</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $trdate;?></td>
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
<tr class="Dark" height="20">		
	<td align="right" valign="middle" class="tblheading">Germ %&nbsp;</td>
	<td align="left" valign="middle" class="tblheading" colspan="3">&nbsp;<?php echo $germ;?></td>
</tr>


</table>
<?php } ?>
</form>

		  
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">-->&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
</table>


</body>
</html>
