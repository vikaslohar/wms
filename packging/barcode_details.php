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
<title>Packaging - Barcode Details</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<body topmargin="0" onload="onloadfocus();" >
 <?php	
$flgs=0;
$sql_bar=mysqli_query($link,"Select * from tbl_barcodes where plantcode='$plantcode' and bar_barcode='$a'") or die(mysqli_error($link));
if($tot_bar=mysqli_num_rows($sql_bar) == 0)	
$flgs=1;
$sql_bar2=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='$a'") or die(mysqli_error($link));
if($tot_bar2=mysqli_num_rows($sql_bar2) == 0)	
$flgs=1;
//echo $flgs;
if($flgs==0)
{

$row_bar=mysqli_fetch_array($sql_bar);

$mptyp=""; $dop=""; $ntwt=""; $gwwt=""; $sloc=""; $dpflg=0; $upflg=0;
$sql_mpmain=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='$a'") or die(mysqli_error($link));
$row_mpmain=mysqli_fetch_array($sql_mpmain);

$mptyp=$row_mpmain['mpmain_trtype'];

if($mptyp=="PACKSMC")$mptyp="SMC";
if($mptyp=="PACKLMC")$mptyp="LMC";
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


		
$ntwt=$row_bar['bar_netweight'];
$gwwt=$row_bar['bar_grosswt'];

if($ntwt==0)$ntwt=$row_mpmain['mpmain_wtmp'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_mpmain['mpmain_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_mpmain['mpmain_bin']."' and whid='".$row_mpmain['mpmain_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_mpmain['mpmain_subbin']."' and binid='".$row_mpmain['mpmain_bin']."' and whid='".$row_mpmain['mpmain_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh.$binn.$subbinn;

?><table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Barcode Details</td>
</tr>
<tr class="Light" height="25">
	<td width="147" align="right" class="smalltblheading">Packaging Status&nbsp;</td>
	<td width="223" align="left" class="smalltblheading">&nbsp;<?php if($upflg>0) echo "<b><font color='#FF0000'>UNPACKAGED</font></b>"; else echo "Packaged";?></td>
	<td width="121" align="right" class="smalltblheading">Dispatch Status&nbsp;</td>
	<td width="249" align="left" class="smalltblheading">&nbsp;<?php if($dpflg>0) echo "<b><font color='#FF0000'>DISPATCHED</font></b>"; else if($upflg>0) echo "Not Applicable"; else echo "Not Dispatched";?></td>
</tr>
<tr class="Light" height="25">
	<td width="147" align="right" class="smalltblheading">Type of Master Pack&nbsp;</td>
	<td width="223" align="left" class="smalltblheading">&nbsp;<?php echo $mptyp;?></td>
	<td width="121" align="right" class="smalltblheading">Date of Packaging&nbsp;</td>
	<td width="249" align="left" class="smalltblheading">&nbsp;<?php echo $dop;?></td>
</tr>
<tr class="Light" height="25">
	<td width="147" align="right" class="smalltblheading">Net Weight&nbsp;</td>
	<td width="223" align="left" class="smalltblheading">&nbsp;<?php echo $ntwt;?></td>
	<td width="121" align="right" class="smalltblheading">Gross Weight&nbsp;</td>
	<td width="249" align="left" class="smalltblheading">&nbsp;<?php echo $gwwt;?></td>
</tr>
<tr class="Light" height="25">
	<td width="147" align="right" class="smalltblheading">SLOC&nbsp;</td>
	<td align="left" class="smalltblheading" colspan="3">&nbsp;<?php echo $sloc;?></td>
</tr>

</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="11" align="center" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="25">
	<td width="35" align="center" class="smalltblheading">S. No.</td>
	<td width="66" align="center" class="smalltblheading">Crop</td>
	<td width="65" align="center" class="smalltblheading">Variety</td>
	<td width="68" align="center" class="smalltblheading">Lot No.</td>
	<td width="68" align="center" class="smalltblheading">UPS</td>
	<td width="68" align="center" class="smalltblheading">NoP</td>
	<td width="66" align="center" class="smalltblheading">Qty</td>
	<td width="68" align="center" class="smalltblheading">DoP</td>
	<td width="69" align="center" class="smalltblheading">DoV</td>
	<td width="79" align="center" class="smalltblheading">QC Status</td>
	<td width="74" align="center" class="smalltblheading">DoT</td>
</tr>
<?php
$srno=0;
for ($i=0; $i<count($lotarr); $i++)
{
	if($lotarr[$i]<>"")
	{
	
		
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotarr[$i]."' order by balqty desc") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
		
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
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
	if($up[1]=="Gms")
	$qtys=$ptp*$nops;	
	else
	$qtys=$nops/$ptp;	
	
	$tdt2=explode("-", $dop1);
	$dopc=$tdt2[2]."-".$tdt2[1]."-".$tdt2[0];
	
	$tdt3=explode("-", $valupto);
	$dov=$tdt3[2]."-".$tdt3[1]."-".$tdt3[0];	
	
	$tdt4=explode("-", $qctestdate);
	$dot=$tdt4[2]."-".$tdt4[1]."-".$tdt4[0];
	
	if($dopc=="--" || $dopc=="0000-00-00" || $dopc=="00-00-0000" || $dopc=="- -")$dopc="";
	if($dov=="--" || $dov=="0000-00-00" || $dov=="00-00-0000" || $dov=="- -")$dov="";
	if($dot=="--" || $dot=="0000-00-00" || $dot=="00-00-0000" || $dot=="- -")$dot="";
			
$srno++;
?>
<tr class="Light" height="25">
	<td width="35" align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td width="66" align="center" class="smalltblheading"><?php echo $ecrp?></td>
	<td width="65" align="center" class="smalltblheading"><?php echo $evariet?></td>
	<td width="68" align="center" class="smalltblheading"><?php echo $lotarr[$i]?></td>
	<td width="68" align="center" class="smalltblheading"><?php echo $ups?></td>
	<td width="68" align="center" class="smalltblheading"><?php echo $noparr[$i]?></td>
	<td width="66" align="center" class="smalltblheading"><?php echo $qtys?></td>
	<td width="68" align="center" class="smalltblheading"><?php echo $dopc?></td>
	<td width="69" align="center" class="smalltblheading"><?php echo $dov?></td>
	<td width="79" align="center" class="smalltblheading"><?php echo $qc?></td>
	<td width="74" align="center" class="smalltblheading"><?php echo $dot?></td>
</tr>
<?php
}
}
?>
</table><br />
<?php
if($dpflg>0)
{

$sqq=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='$plantcode' and dpss_barcode='$a'") or die(mysqli_error($link));
$roo=mysqli_fetch_array($sqq);
$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='$plantcode' and disp_id='".$roo['disp_id']."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['disp_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
$country="";
if($noticia['classification']=="Export Buyer") 
{
	$sql_month2=mysqli_query($link,"select * from tblcountry where c_id='".$noticia['country']."' order by country")or die(mysqli_error($link));
	$noticia2 = mysqli_fetch_array($sql_month2);
	$country=$noticia2['country'];
}

$ordernos=""; $porefno="";
$sql_arrsub=mysqli_query($link,"select * from tbl_disp_sub where plantcode='$plantcode' and disp_id='".$roo['disp_id']."'") or die(mysqli_error($link));
$a_arrsub=mysqli_num_rows($sql_arrsub);
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
	if($ordernos!="")
	$ordernos=$ordernos.",".$row_arrsub['disps_ordno'];
	else
	$ordernos=$row_arrsub['disps_ordno'];
}	

if($ordernos!="")
{
$tid240=explode(",",$ordernos); 
//array_unique($tid240); 
$tid240=array_keys(array_flip($tid240));
$ordernos=implode(",",$tid240);
foreach($tid240 as $tid230)
{
	if($tid230<>"")
	{
		$sqordm=mysqli_query($link,"Select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno='$tid230'") or die(mysqli_error($link));
		$totordm=mysqli_num_rows($sqordm);
		while($rowordm=mysqli_fetch_array($sqordm))
		{
			if($porefno!="")
				$porefno=$porefno.",".$rowordm['orderm_partyrefno'];
			else
				$porefno=$rowordm['orderm_partyrefno'];
		}
	}
}
}
if($porefno!="")
{
$tid24=explode(",",$porefno); 
$tid24=array_keys(array_flip($tid24));
$porefno=implode(",",$tid24);
}
$tdate=$row_tbl['disp_dodc'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['disp_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Details</td>
</tr>
<tr class="Light" height="25">
	<td width="100" align="right" class="smalltblheading">Order Number&nbsp;</td>
	<td width="334" align="left" class="smalltblheading">&nbsp;<?php echo $ordernos;?></td>
	<td width="111" align="right" class="smalltblheading">Date of Dispatch&nbsp;</td>
	<td width="195" align="left" class="smalltblheading">&nbsp;<?php echo $tdate;?></td>
</tr>
<tr class="Light" height="25">
	<td width="100" align="right" class="smalltblheading">Party Name&nbsp;</td>
	<td width="334" align="left" class="smalltblheading">&nbsp;<?php echo $noticia['business_name'];?></td>
	<td width="111" align="right" class="smalltblheading">Location&nbsp;</td>
	<td width="195" align="left" class="smalltblheading">&nbsp;<?php if($noticia['city']!="") { echo " ".$noticia['city']; }?></td>
</tr>

</table>
<?php
}
?>
<?php
}
else
{
?>	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">Barcode not found</td>
</tr>
</table>
<?php
}
?>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" /></td>
</tr>
</table>

</body>
</html>
