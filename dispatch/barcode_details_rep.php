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

	if(isset($_GET['itmid']))
	{
  		$a = $_GET['itmid'];	 
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Barcode Details</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<body topmargin="0" onload="onloadfocus();" >
 <?php	
$flgs=0;
$sql_bar=mysqli_query($link,"Select * from tbl_barcodes where plantcode='".$plantcode."' and   bar_barcode='$a'") or die(mysqli_error($link));
if($tot_bar=mysqli_num_rows($sql_bar) == 0)	
$flgs=1;
$sql_bar2=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='$a'") or die(mysqli_error($link));
if($tot_bar2=mysqli_num_rows($sql_bar2) == 0)	
$flgs=1;
//echo $flgs;
if($flgs==0)
{

$row_bar=mysqli_fetch_array($sql_bar);

$mptyp=""; $dop=""; $ntwt=""; $gwwt=""; $sloc=""; $dpflg=0; $upflg=0;
$sql_mpmain=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='$a'") or die(mysqli_error($link));
$row_mpmain=mysqli_fetch_array($sql_mpmain);

$mptyp=$row_mpmain['mpmain_trtype'];

if($mptyp=="PACKSMC")$mptyp="SMC";
if($mptyp=="PACKLMC")$mptyp="LMC";
if($mptyp=="PACKNMC")$mptyp="NMC";
if($mptyp=="PACKNLC")$mptyp="NLC";
if($mptyp=="PACKMMC")$mptyp="MMC";

$dpflg=$row_mpmain['mpmain_dflg'];
$upflg=$row_mpmain['mpmain_upflg'];

$tdt=explode("-", $row_mpmain['mpmain_date']);
$dop=$tdt[2]."-".$tdt[1]."-".$tdt[0];


$crparr=explode(",", $row_mpmain['mpmain_crop']);
$verarr=explode(",", $row_mpmain['mpmain_variety']);
$lotarr=explode(",", $row_mpmain['mpmain_lotno']);
$upsarr=explode(",", $row_mpmain['mpmain_upssize']);
$noparr=explode(",", $row_mpmain['mpmain_lotnop']);

$ntwt=$row_mpmain['mpmain_wtmp'];
$gwwt=$row_bar['bar_grosswt'];

if($ntwt==0)$ntwt=$row_mpmain['mpmain_wtmp'];

?><table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Barcode Details</td>
</tr> 
<tr class="Dark" height="30">
<td width="123" align="right"  valign="middle" class="tblheading">Barcode&nbsp;</td>
<td width="128" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $a;?></td>
<td width="102" align="right"  valign="middle" class="tblheading">Net Weight&nbsp;</td>
<td width="87" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $ntwt;?></td>
<td width="109" align="right"  valign="middle" class="tblheading">Gross Weight&nbsp;</td>
<td width="187" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $gwwt;?></td>
</tr>
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="11" align="center" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="25">
	<td width="39" align="center" class="smalltblheading">S. No.</td>
	<td width="89" align="center" class="smalltblheading">Crop</td>
	<td width="141" align="center" class="smalltblheading">Variety</td>
	<td width="101" align="center" class="smalltblheading">Lot No.</td>
	<td width="80" align="center" class="smalltblheading">UPS</td>
	<td width="70" align="center" class="smalltblheading">NoP</td>
	<td width="70" align="center" class="smalltblheading">Qty</td>
	<td width="70" align="center" class="smalltblheading">DoP</td>
	<td width="70" align="center" class="smalltblheading">DoV</td>
	<!--<td width="79" align="center" class="smalltblheading">QC Status</td>
	<td width="74" align="center" class="smalltblheading">DoT</td>-->
</tr>
<?php
$srno=0;
for ($i=0; $i<count($lotarr); $i++)
{
	if($lotarr[$i]<>"")
	{
	
		
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$lotarr[$i]."' order by balqty desc") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
		
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
	$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
	
	$dop1=$row_issuetbl['lotldg_dop'];
	$valupto=$row_issuetbl['lotldg_valupto'];
	$qc=$row_issuetbl['lotldg_qc'];
	$qctestdate=$row_issuetbl['lotldg_qctestdate'];	
	
	$quer_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
	$noticiacrp = mysqli_fetch_array($quer_crp);
	$ecrp=$noticiacrp['cropname'];
	
	$quer_ver=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticiaver = mysqli_fetch_array($quer_ver);
	$evariet=$noticiaver['popularname'];
	
	$ups=$row_issuetbl['packtype'];
	
	$nops=$noparr[$i];
	
	$up=explode(" ", $ups);
	if($up[1]=="Gms")
	{
		$ptp=$up[0]/1000;
	}
	else
	{
		$ptp=$up[0];
	}
	//echo $nops."*".$ptp;
	if($up[1]=="Gms")
	$qtys=$ptp*$nops;	
	else
	$qtys=$nops*$ptp;	
	
	$tdt2=explode("-", $dop1);
	$dopc=$tdt2[2]."-".$tdt2[1]."-".$tdt2[0];
	
	$tdt3=explode("-", $valupto);
	$dov=$tdt3[2]."-".$tdt3[1]."-".$tdt3[0];	
	
	$tdt4=explode("-", $qctestdate);
	$dot=$tdt4[2]."-".$tdt4[1]."-".$tdt4[0];
	
	if($dopc=="--" || $dopc=="0000-00-00" || $dopc=="00-00-0000" || $dopc=="- -")$dopc="";
	if($dov=="--" || $dov=="0000-00-00" || $dov=="00-00-0000" || $dov=="- -")$dov="";
	if($dot=="--" || $dot=="0000-00-00" || $dot=="00-00-0000" || $dot=="- -")$dot="";
	if($qc=="UT" || $qc=="RT")	$dot="";
	
	$zzz=implode(",", str_split($lotarr[$i]));
	$oldlot2=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
			
$srno++;
?>
<tr class="Light" height="25">
	<td width="39" align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td width="89" align="center" class="smalltblheading"><?php echo $ecrp?></td>
	<td width="141" align="center" class="smalltblheading"><?php echo $evariet?></td>
	<td width="101" align="center" class="smalltblheading"><?php echo $oldlot2?></td>
	<td width="80" align="center" class="smalltblheading"><?php echo $ups?></td>
	<td width="70" align="center" class="smalltblheading"><?php echo $noparr[$i]?></td>
	<td width="70" align="center" class="smalltblheading"><?php echo round($qtys,3)?></td>
	<td width="70" align="center" class="smalltblheading"><?php echo $dopc?></td>
	<td width="70" align="center" class="smalltblheading"><?php echo $dov?></td>
	<!--<td width="79" align="center" class="smalltblheading"><?php echo $qc?></td>
	<td width="74" align="center" class="smalltblheading"><?php echo $dot?></td>-->
</tr>
<?php
}
}
?>
</table>
<?php
}
else
{
?>	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">Barcode not found</td>
</tr>
</table>
<?php
}
?>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>

</body>
</html>