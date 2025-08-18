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
    
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtptype=$_REQUEST['txtptype'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	$txtpp="C&F";
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Crop Variety wise Damage Sales Return Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
 <table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_cvwisedamagesr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtptype=<?php echo $_REQUEST['txtptype']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table> 
<?php
$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="6" align="center" class="tblheading">Crop Variety wise Damage Sales Return Report</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;State:&nbsp;<?php echo $txtstatesl?></td>
  <td align="right" class="tblheading">Party Type:&nbsp;<?php echo $txtpp?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<?php
$crp="ALL"; $variet="ALL";
	
	if($crop!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$crp=$row31['cropname'];		
	}
	if($variety!="ALL")
	{
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
			$rowvv=mysqli_fetch_array($sql_variety);
			$variet=$rowvv['popularname'];
		}
		else
		{
			$variet=$variety;
		}
	}
?>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $crp;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $variet;?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="44" height="24" align="Center" class="tblheading">#</td>
	<td width="160" align="Center" class="tblheading">State</td>
	<td width="210" align="Center" class="tblheading">Type</td>
	<td width="160" align="Center" class="tblheading">Crop</td>
	<td width="210" align="Center" class="tblheading">Variety</td>
	<td width="80" align="Center" class="tblheading">UPS</td>
	<td width="80" align="Center" class="tblheading">Total Qty</td>
	</tr>
<?php
$srno=1; $mid=""; $cnt=0;
$sqlsrrtm="select * from tbl_salesrv where salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' AND plantcode='$plantcode'";
if($txtstatesl!="ALL")
{
	$sqlsrrtm.=" and salesr_state='".$txtstatesl."' ";
}
if($txtpp!="ALL")
{
	$sqlsrrtm.=" and salesr_partytype='".$txtpp."' ";
}
$sqlsrrtm.=" order by salesr_id ASC ";
$sql_srretm=mysqli_query($link,$sqlsrrtm) or die(mysqli_error($link));

if($tot_srretm=mysqli_num_rows($sql_srretm) > 0)
{
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
	if($mid!="")
		$mid=$mid.",".$row_srretm['salesr_id'];
	else
		$mid=$row_srretm['salesr_id'];
}
$md=explode(",",$mid);
if(count($md) >1)
$sqlsrrets2="select distinct salesrs_crop from tbl_salesrv_sub where salesr_id IN ($mid) AND plantcode='$plantcode'";
else
$sqlsrrets2="select distinct salesrs_crop from tbl_salesrv_sub where salesr_id=$mid AND plantcode='$plantcode'";
if($crop!="ALL")
{
	$sqlsrrets2.=" and salesrs_crop='".$crop."' ";
}
$sqlsrrets2.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
$sql_srrets2=mysqli_query($link,$sqlsrrets2) or die(mysqli_error($link));
while($row_tbl_sub2=mysqli_fetch_array($sql_srrets2))
{

if(count($md) >1)
$sqlsrrets1="select distinct salesrs_variety from tbl_salesrv_sub where salesr_id IN ($mid) AND plantcode='$plantcode'";
else
$sqlsrrets1="select distinct salesrs_variety from tbl_salesrv_sub where salesr_id=$mid AND plantcode='$plantcode'";
$sqlsrrets1.=" and salesrs_crop='".$row_tbl_sub2['salesrs_crop']."' ";
if($variety!="ALL")
{
	$sqlsrrets1.=" and salesrs_variety='".$variety."' ";
}
$sqlsrrets1.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
$sql_srrets1=mysqli_query($link,$sqlsrrets1) or die(mysqli_error($link));
while($row_tbl_sub1=mysqli_fetch_array($sql_srrets1))
{
$tenb=0; $teqt=0.000; $tnnb=0; $tnqt=0.000; $tngqt=0.000; $tndqt=0.000; $tnexqt=0.000;
if(count($md) >1)
$sqlsrrets="select * from tbl_salesrv_sub where salesr_id IN ($mid) AND plantcode='$plantcode'";
else
$sqlsrrets="select * from tbl_salesrv_sub where salesr_id=$mid AND plantcode='$plantcode'";

$sqlsrrets.=" and salesrs_crop='".$row_tbl_sub2['salesrs_crop']."' ";
$sqlsrrets.=" and salesrs_variety='".$row_tbl_sub1['salesrs_variety']."' ";
$sqlsrrets.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
while($row_tbl_sub=mysqli_fetch_array($sql_srrets))
{
$totqty=0; $cropn=""; $varietyn="";$slups=""; $slnob=""; $slqty=""; $state=""; $ptype="";
$sqlsrretm=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$row_tbl_sub['salesr_id']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$rowsrretm=mysqli_fetch_array($sqlsrretm);

$state=$rowsrretm['salesr_state'];
$ptype=$rowsrretm['salesr_partytype'];

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$cropn=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$varietyn=$noticia_item['popularname'];

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}


/*if($row_tbl_sub['salesrs_upstype']=="Standard")
$upstyp="ST";
if($row_tbl_sub['salesrs_upstype']=="Non-Standard")
$upstyp="NST";
else
$upstyp="ST";

$tdate1=$row_tbl_sub['salesrs_dov'];
$tyear1=substr($tdate1,0,4);
$tmonth1=substr($tdate1,5,2);
$tday1=substr($tdate1,8,2);
$dov=$tday1."-".$tmonth1."-".$tyear1;*/

$nob=0; $qty=0;

/*$diq2=explode(".",$row_tbl_sub['salesrs_qtydc']);
if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_tbl_sub['salesrs_qtydc'];}
$din2=explode(".",$row_tbl_sub['salesrs_nobdc']);
if($din2[1]==000){$difn2=$din2[0];}else{$difn2=$row_tbl_sub['salesrs_nobdc'];}
*/
$diq3=explode(".",$row_tbl_sub['salesrs_qtydamage']);
if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_tbl_sub['salesrs_qtydamage'];}
/*$din3=explode(".",$row_tbl_sub['salesrs_nobdamage']);
if($din3[1]==000){$difn3=$din3[0];}else{$difn3=$row_tbl_sub['salesrs_nobdamage'];}

$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];

$totqty=$difq2+$difq3;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }*/

$slrno="SRN/".$rowsrretm['salesr_yearcode']."/".sprintf("%00005d",$rowsrretm['salesr_slrno']);

/*$exsh=($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;
$exsh=number_format($exsh,3);
$tenb=$tenb+$nob;
$teqt=$teqt+$qty;
$tnnb=$tnnb+$difn2;
$tnqt=$tnqt+$totqty;
$tngqt=$tngqt+$difq2;*/
$tndqt=$tndqt+$difq3;
/*$tnexqt=$tnexqt+($exsh);
$tnexqt=number_format($tnexqt,3);*/
if($srno%2==0)
{
?>	
<tr height="25">
	<td width="44" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $state;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $ptype;?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $slups;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $difq3;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="44" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $state;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $ptype;?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $slups;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $difq3;?></td>
</tr>
<?php
}
$srno=$srno+1;$cnt++;
}
?>
<tr class="tblsubtitle" height="25">
	<td align="Center" class="smalltblheading" colspan="6">Total</td>
	<td align="Center" class="smalltblheading"><?php echo $tndqt;?></td>
</tr>
<?php
}
}
}
if($cnt==0)
{
?>
<tr height="25">
	<td align="Center" class="tblheading" colspan="12">Record Not Found.</td>
</tr>
<?php
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_cvwisedamagesr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtptype=<?php echo $_REQUEST['txtptype']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</body>
</html>
