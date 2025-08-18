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
<title>Transaction - Pack Seed Re-Printing Note</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
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
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_revalidate where plantcode='$plantcode' and rv_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['rv_id'];

	$tdate=$row_tbl['rv_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['rv_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['rv_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	
$sql_param=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);	
?>
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Pack Seed Re-Printing Note</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "RV".$row_tbl['rv_tcode']."/".$row_tbl['rv_yearcode']."/".$row_tbl['rv_logid'];?></td>

<td width="121" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="239" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>


<tr class="Light" height="30">
<td width="234" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_lotno'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_ups'];?></td>
</tr>
<?php

$dot="";
if($row_tbl['rv_dot']!="")
{
$dt=explode("-",$row_tbl['rv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_tbl['rv_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$dvt=explode("-",$row_tbl['rv_dorvp']);
$dorvp=$dvt[2]."-".$dvt[1]."-".$dvt[0];

$dovt=explode("-",$row_tbl['rv_valupto']);
$dov=$dovt[2]."-".$dovt[1]."-".$dovt[0];

if($dot!="")
{
	$trdate2=explode("-",$dot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
//echo $dp3;
$orlot=$row_tbl['rv_lotno'];

$np=$row_tbl['rv_bnop']+$row_tbl['rv_qcnop']+$row_tbl['rv_pl'];
$ups=explode(" ",$row_tbl['rv_ups']);
$pt="";
if($ups[1]=="Gms")
{
	$pt=(($ups[0])/1000);
}
else
{
	$pt=$ups[0];
}

$qt=$pt*$np;
$np=(int)$np;
$qt=(float)$qt;
$enp=(int)$row_tbl['rv_enop'];
$eqt=(float)$row_tbl['rv_eqty'];
$bnp=$enp-$np;
$bqt=$eqt-$qt;

$lotno=$row_tbl2['rv_lotno'];

$zzz=implode(",", str_split($lotno));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where plantcode='$plantcode' and SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where plantcode='$plantcode' and SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."P";
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";

$tflg=0;
if($row_tbl['rv_enop'] == 1)$tflg++;

$tflg++;
?>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_enop'];?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_eqty'];?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_qc'];?></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $row_tbl['rv_got'];?></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?></td>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td align="right" width="105"  valign="middle" class="tblheading">Re-Printing&nbsp;</td>
<td align="left" width="191" valign="middle" class="tblheading"   >&nbsp;<?php echo $row_tbl['rv_rvtyp'];?></td>
<td align="left"  valign="middle" class="tblheading" colspan="2" id="batchchk">&nbsp;<?php if($row_tbl['rv_rvtyp']=="partial") echo "Batch No. Generated - <font color=red>YES</font>"; else if($row_tbl['rv_rvtyp']=="entire") echo "Batch No. Generated - <font color=red>YES</font>"; else echo ""; ?></td>
<td align="right" width="113"  valign="middle" class="tblheading">Lot number&nbsp;</td>
<td align="left" width="221"  valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_newlot'];?></td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="105"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<?php echo $np;?></td>	
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right" width="113" valign="middle" class="tblheading">Balance NoP&nbsp;</td>
<td align="left" width="221" valign="middle" class="tbltext">&nbsp;<?php echo $bnp;?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right" width="105"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<?php echo $qt;?></td>	
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right" width="113" valign="middle" class="tblheading">Balance Qty&nbsp;</td>
<td align="left" width="221" valign="middle" class="tbltext">&nbsp;<?php echo $bqt;?></td>	
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Re-Printing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Re-Printing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoP</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoP</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoP</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0; $rqty=0; $rnob=0; $blqty=0; $blnob=0;
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row_tbl['rv_lotno']."'  and balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_tbl['rv_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgP_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;

$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 

if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
	$ptp1=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
	$ptp1=$packtp[0];
}
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

$nop=$nop1; 
//$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$row_issuetbl['balqty'];

$tqty=$qty;
$tnob=$nop; 
$totqty=$totqty+$tqty; 
$totnob=$totnob+$tnob; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;

$sql_sub2=mysqli_query($link,"Select * from tbl_revalidate_sub2 where plantcode='$plantcode' and rv_id='$arrival_id' and rvs_sbinid='".$row_issuetbl['subbinid']."'") or die(mysqli_error($link));
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2 > 0)	
{
$row_sub2=mysqli_fetch_array($sql_sub2);
$rnob=$row_sub2['rvs_nop']; 
$rqty=$row_sub2['rvs_qty'];
}
$blqty=$tqty-$rqty; 
$blnob=$tnob-$rnob;
?>
<tr class="Light" height="30">
	<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?></td>
	<td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $rnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $rqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $blnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $blqty;?></td>
</tr>
<?php
}
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Re-Printing Details</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Re-Printing/Packing Slip Ref. No.&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_rvpsrn'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">Date of Re-Printing/Packing&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<?php echo $dorvp;?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">NoP for QC Sample&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_qcnop'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">NoP - Re-Printing Packing Loss&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_pl'];?></td>
</tr>
<tr class="Light" height="25">
<td width="107" align="right" valign="middle" class="tblheading">Balance Pouches&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_bnop'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">Balance Quantity&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_bqty'];?></td>
</tr>
<tr class="Light" height="25">
<td width="191" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_valperiod'];?>&nbsp;Months</td>
<td width="107" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dov;?></td>
<td width="112" align="right" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['rv_valdays'];?>&nbsp;Days From DoT</td>
</tr>
<tr class="Light" height="25">  
<td align="right" valign="middle" class="tblheading">Label No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $row_tbl['rv_slable']." - ".$row_tbl['rv_elable'];?></td>
</tr>
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table><br />
<div id="pkgshow">
<?php 

?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Packaging Details</td>
</tr>

<tr class="Light">
<td width="116" align="right" valign="middle" class="tblheading">Convert to MP&nbsp;</td>
<td width="144" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_mptyp'];?></td>
<td width="76" align="center" valign="middle" class="tblheading">No. of MP</td>

<td width="83" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_pnomp'];?></td>
<td width="140" align="center" valign="middle" class="tblheading">Balance Pouches</td>

<td width="82" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_bpch'];?></td>
<td width="130" align="center" valign="middle" class="tblheading">Barcode Labels</td>
<td width="61" align="center" valign="middle" class="tbltext" id="dtail_1">Details</td>
</tr>
</table>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
</div><br />
<?php
	
	$sql_sub=mysqli_query($link,"Select * from tbl_revalidate_sub where plantcode='$plantcode' and rv_id='$arrival_id'") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_sub);
	
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">SR Condition Seed - SLOC Details</td>
  </tr>
  <!--<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>-->
  <tr class="tblsubtitle" height="20">
  	<td width="26" align="center" valign="middle" class="tblheading">#</td>
    <td width="143" align="center" valign="middle" class="tblheading">WH</td>
    <td width="140" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="167" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="179" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="181" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
  
$srno=1;
if($tot_sub>0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sub['rvs_whid']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sub['rvs_binid']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sub['rvs_sbinid']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
if($srno%2==0)
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['rvs_qty'];?></td>
</tr>
<?php
}$srno++;
}
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
