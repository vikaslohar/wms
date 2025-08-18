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
  
if(isset($_GET['tp']))
{ 
	$barcodes = $_GET['tp'];	 
}
if(isset($_GET['mtrid']))
{
	$tid = $_GET['mtrid'];	 
}

if($barcodes!="")
{
	$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
		
	$arrival_id=$row_tbl['dtdf_id'];
	
	$sqlmmc=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dmmc_flg=1 and dmmc_barcode='$barcodes'") or die(mysqli_error($link));
	$rowmmc=mysqli_fetch_array($sqlmmc);
	$ntwt=$rowmmc['dmmc_wtmp'];
	$grwt=$rowmmc['dmmc_grosswt'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Direct Loading / Non-Allocation Type - Barcode Details</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">MMC Content List</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
	if($tt=mysqli_num_rows($quer33)>0)
	{
		$row33=mysqli_fetch_array($quer33);
		$name==$row33['business_name'];
		$address=$row33['address'];
		$city=$row33['city']; 
		$state=$row33['state'];
		$pincode=$row33['pin'];
	}
	else
	{
		$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='0' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
		$tt=mysqli_num_rows($sql_month2);
		$row_month2=mysqli_fetch_array($sql_month2);
		$name=$row_month2['orderm_partyname'];
		$address=$row_month2['orderm_partyaddress'];
		$city=$row_month2['orderm_partycity']; 
		$state=$row_month2['orderm_partystate'];
		$pincode=$row_month2['orderm_partypin'];
	}
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dtdf_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $name;?></td>
	</tr>
<?php
	
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div></td>
</tr>
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="123" align="right"  valign="middle" class="tblheading">Barcode&nbsp;</td>
<td width="128" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $barcodes;?></td>
<td width="102" align="right"  valign="middle" class="tblheading">Net Weight&nbsp;</td>
<td width="87" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $ntwt;?></td>
<td width="109" align="right"  valign="middle" class="tblheading">Gross Weight&nbsp;</td>
<td width="187" align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $grwt;?></td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="27" align="center" class="smalltblheading">#</td>
	<td width="94" align="center" class="smalltblheading">Crop</td>
	<td width="128" align="center" class="smalltblheading">Variety</td>
	<td width="101" align="center" class="smalltblheading">Lot No.</td>
	<td width="87" align="center" class="smalltblheading">UPS</td>
	<td width="54" align="center" class="smalltblheading">NoP</td>
	<td width="54" align="center" class="smalltblheading">Qty</td>
	<td width="88" align="center" class="smalltblheading">DoP</td>
	<td width="97" align="center" class="smalltblheading">DoV</td>
</tr>
<?php
$sno=1;
$sqlbarc1=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dmmc_flg=1 and dmmc_barcode='$barcodes'") or die(mysqli_error($link));
$totbarc1=mysqli_num_rows($sqlbarc1);
while($rowbarc1=mysqli_fetch_array($sqlbarc1))
{
	$zz24=str_split($rowbarc1['dmmc_lotno']);
	$lot2=$zz24[0].$zz24[1].$zz24[2].$zz24[3].$zz24[4].$zz24[5].$zz24[6].$zz24[7].$zz24[8].$zz24[9].$zz24[10].$zz24[11].$zz24[12].$zz24[13].$zz24[14].$zz24[15];
	$lotno=$lot2;
	$lotno1=$rowbarc1['dmmc_lotno'];
	$subtid=$rowbarc1['dtdfs_id'];
	$extslsubbg=$rowbarc1['dmmc_esubbin'];
	$ui1=$rowbarc1['dmmc_eups'];
	$nob=$rowbarc1['dmmc_nolp'];
	$qty=$rowbarc1['dmmc_qty'];
				
	$sqllot2=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdf_id='$tid' and dtdfs_id='$subtid'") or die(mysqli_error($link));
	$totlot2=mysqli_num_rows($sqllot2);
	$rowlot2=mysqli_fetch_array($sqllot2);
	
	$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno1' and packtype='$ui1' order by lotdgp_id DESC") or die(mysqli_error($link));
	$tot_lot2=mysqli_num_rows($sql_lot2);
	$row_lot2=mysqli_fetch_array($sql_lot2);
	
	$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_lot2[0]."'") or die(mysqli_error($link));
	$tot_lot=mysqli_num_rows($sql_lot);
	$row_lot=mysqli_fetch_array($sql_lot);
	
	$vers=$row_lot['lotldg_variety'];
	$crps=$row_lot['lotldg_crop'];
	
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cps2=$row_dept5['cropname'];
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$vts2=$row_dept4['popularname'];
			
	$tdate=$row_lot['lotldg_valupto'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dov2=$tday."-".$tmonth."-".$tyear;
	
	$tdate=$row_lot['lotldg_dop'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dop2=$tday."-".$tmonth."-".$tyear;
	
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cps2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vts2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ui1?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dop2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov2;?></td>
</tr>
<?php
$sno++;	
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</body>
</html>
<?php	
}
?>