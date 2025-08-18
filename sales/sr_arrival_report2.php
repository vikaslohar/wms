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
	$txtcountryl=$_REQUEST['txtcountryl'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	$locationname=$_REQUEST['locationname'];
	$txtstfp=$_REQUEST['txtstfp'];
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Arrival Report</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
 <table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_srarrival.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtptype=<?php echo $_REQUEST['txtptype']?>&txtcountryl=<?php echo $_REQUEST['txtcountryl']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>&locationname=<?php echo $_REQUEST['locationname']?>&txtstfp=<?php echo $_REQUEST['txtstfp']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table> 
<?php	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[0])."-".sprintf("%02d",$sd[1]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[0])."-".sprintf("%02d",$ed[1]);
?>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="6" align="center" class="subheading">Periodical Party wise Sales Return Arrival Report</td>
</tr>
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<?php
if($txtptype!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$locationname."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
$location=$noticia['productionlocation'];
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$locationname."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
$location=$noticia['country'];
}
$sql_month2=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtstfp."' order by business_name")or die(mysqli_error($link));
$noticia2 = mysqli_fetch_array($sql_month2);
?>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;State:&nbsp;<?php echo $txtstatesl?></td>
  <td width="50%" align="right" class="tblheading">Location:&nbsp;<?php echo $location;?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">  
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Party Type:&nbsp;<?php echo $txtptype;?></td>
  <td width="50%" align="right" class="tblheading">Party:&nbsp;<?php echo $noticia2['business_name'];?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
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
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="25" height="24" align="Center" class="tblheading" rowspan="2">#</td>
	<td width="85" align="Center" class="tblheading" rowspan="2">Crop</td>
	<td width="125" align="Center" class="tblheading" rowspan="2">Variety</td>
	<td align="Center" class="tblheading" colspan="3">As per DC</td>
	<td align="Center" class="tblheading" colspan="5">As per Actuals</td>
	<td width="52" align="Center" class="tblheading" rowspan="2">Ex.(+) / Sh.(-)</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="Center" class="tblheading">UPS</td>
<td align="Center" class="tblheading">NoP/NoB</td>
<td align="Center" class="tblheading">Qty</td>
<td align="Center" class="tblheading">UPS</td>
<td align="Center" class="tblheading">NoP</td>
<td align="Center" class="tblheading">Total Qty</td>
<td align="Center" class="tblheading">Good</td>
<td align="Center" class="tblheading">Damage</td>
</tr>
<?php
$srno=1; $mid=""; $cnt=0;
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_party='".$txtstfp."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' ") or die(mysqli_error($link));
if($tot_srretm=mysqli_num_rows($sql_srretm) > 0)
{
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
/*if($mid!="")
$mid=$mid.",".$row_srretm['salesr_id'];
else
*/$mid=$row_srretm['salesr_id'];
//}
 
$sqlsrrets="select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id=$mid";
if($crop!="ALL")
{
	$sqlsrrets.=" and salesrs_crop='".$crop."' ";
}
if($variety!="ALL")
{
	$sqlsrrets.=" and salesrs_variety='".$variety."' ";
}
$sqlsrrets.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
while($row_tbl_sub=mysqli_fetch_array($sql_srrets))
{

$totqty=0; $cropn=""; $varietyn="";$slups=""; $slnob=""; $slqty="";

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$cropn=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."'  order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$varietyn=$noticia_item['popularname'];

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
/*$slocs="";
$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{

$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh.$binn.$subbinn;
if($slocs!="")
$slocs=$slocs."<br/>".$sloc;
else
$slocs=$sloc;
}*/

if($row_tbl_sub['salesrs_upstype']=="Standard")
$upstyp="ST";
if($row_tbl_sub['salesrs_upstype']=="Non-Standard")
$upstyp="NST";
else
$upstyp="ST";

$tdate1=$row_tbl_sub['salesrs_dov'];
$tyear1=substr($tdate1,0,4);
$tmonth1=substr($tdate1,5,2);
$tday1=substr($tdate1,8,2);
$dov=$tday1."-".$tmonth1."-".$tyear1;

$nob=0; $qty=0;


$diq2=explode(".",$row_tbl_sub['salesrs_qtydc']);
if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_tbl_sub['salesrs_qtydc'];}
$din2=explode(".",$row_tbl_sub['salesrs_nobdc']);
if($din2[1]==000){$difn2=$din2[0];}else{$difn2=$row_tbl_sub['salesrs_nobdc'];}

$diq3=explode(".",$row_tbl_sub['salesrs_qtydamage']);
if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_tbl_sub['salesrs_qtydamage'];}
$din3=explode(".",$row_tbl_sub['salesrs_nobdamage']);
if($din3[1]==000){$difn3=$din3[0];}else{$difn3=$row_tbl_sub['salesrs_nobdamage'];}

$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];

$totqty=$difq2+$difq3;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
	
if($srno%2==0)
{
?>	
<tr height="25">
	<td width="25" align="Center" class="smalltblheading"><?php echo $srno;?></td>
	<td width="85" align="Center" class="smalltblheading"><?php echo $cropn;?></td>
	<td width="125" align="Center" class="smalltblheading"><?php echo $varietyn;?></td>
	<td width="75" align="Center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $nob;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $qty;?></td>
	<td width="75" align="Center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $difn2;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $totqty;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $difq2;?></td>
	<td width="62" align="Center" class="smalltblheading"><?php echo $difq3;?></td>
	<td width="52" align="Center" class="smalltblheading"><?php echo ($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="25" align="Center" class="smalltblheading"><?php echo $srno;?></td>
	<td width="85" align="Center" class="smalltblheading"><?php echo $cropn;?></td>
	<td width="125" align="Center" class="smalltblheading"><?php echo $varietyn;?></td>
	<td width="75" align="Center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $nob;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $qty;?></td>
	<td width="75" align="Center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $difn2;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $totqty;?></td>
	<td width="65" align="Center" class="smalltblheading"><?php echo $difq2;?></td>
	<td width="62" align="Center" class="smalltblheading"><?php echo $difq3;?></td>
	<td width="52" align="Center" class="smalltblheading"><?php echo ($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;?></td>
</tr>
<?php
}
$srno=$srno+1;$cnt++;
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
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_srarrival.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtptype=<?php echo $_REQUEST['txtptype']?>&txtcountryl=<?php echo $_REQUEST['txtcountryl']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>&locationname=<?php echo $_REQUEST['locationname']?>&txtstfp=<?php echo $_REQUEST['txtstfp']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</body>
</html>
