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
<title>Sales Return - Transaction - Sales Return - Re-Validate Note</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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
$sql_tbl=mysqli_query($link,"select * from tbl_srrevalidate where plantcode='$plantcode' AND srrv_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['srrv_id'];

	$tdate=$row_tbl['srrv_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['srrv_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['srrv_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
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
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Sales Return - Re-Validate Note</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "RV".$row_tbl['srrv_tcode']."/".$row_tbl['srrv_yearcode']."/".$row_tbl['srrv_logid'];?></td>

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
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_lotno'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_ups'];?></td>
</tr>
<?php

$dot="";
if($row_tbl['srrv_dot']!="")
{
$dt=explode("-",$row_tbl['srrv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_tbl['srrv_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$dvt=explode("-",$row_tbl['srrv_dorvp']);
$dorvp=$dvt[2]."-".$dvt[1]."-".$dvt[0];

$dovt=explode("-",$row_tbl['srrv_valupto']);
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
$orlot=$row_tbl['srrv_lotno'];
?>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_enop'];?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_eqty'];?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_qc'];?></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $row_tbl['srrv_got'];?></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?></td>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Re-Validation Details</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Re-Validate/Packing Slip Ref. No.&nbsp;</td>
<td width="111" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_rvpsrn'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">Date of Re-Validation/Packing&nbsp;</td>
<td width="121" align="left" valign="middle" class="tbltext" id="pltno">&nbsp;<?php echo $dorvp;?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">NoP for QC Sample&nbsp;</td>
<td width="111" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_qcnop'];?></td>
<td width="115" align="right" valign="middle" class="tblheading">Balance Pouches&nbsp;</td>
<td width="91" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_bnop'];?></td>
<td align="right" valign="middle" class="tblheading">Balance Quantity&nbsp;</td>
<td width="121" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_bqty'];?></td>
</tr>
<tr class="Light" height="25">
<td width="188" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="111" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_valperiod'];?>&nbsp;Months</td>
<td width="115" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="91" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $dov;?></td>
<td width="110" align="right" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="121" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_valdays'];?>&nbsp;From DoT</td>
</tr>
<tr class="Light" height="25">  
<td align="right" valign="middle" class="tblheading">Label No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $row_tbl['srrv_slable']." - ".$row_tbl['srrv_elable'];?></td>
</tr>
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table><br />
<?php
	
	$sql_sub=mysqli_query($link,"Select * from tbl_srrevalidate_sub where plantcode='$plantcode' AND srrv_id='$arrival_id'") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_sub);
	
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
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
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_sub['srrvs_whid']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_sub['srrvs_binid']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_sub['srrvs_sbinid']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
if($srno%2==0)
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_qty'];?></td>
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
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_qty'];?></td>
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
