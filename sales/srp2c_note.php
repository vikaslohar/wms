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
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$pid."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$row_arr_home=mysqli_fetch_array($sql_tbl_sub);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Transaction - SR Unpacking P2C Note</title>
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
$sql_tbl=mysqli_query($link,"select * from tbl_unpsp2c where plantcode='$plantcode' AND unp_logid='".$logid."' and unp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['unp_id'];

	$tdate=$row_tbl['unp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['unp_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['unp_variety']."' and actstatus='Active' order by popularname Asc"); 
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
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">SR Unpacking P2C Note</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "PC".$row_tbl['unp_code']."/".$row_tbl['unp_yearcode']."/".$row_tbl['unp_logid'];?></td>

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
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_ups'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_lotno'];?></td>
</tr>
<?php

$sql_arrival=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$row_tbl['unp_crop']."' and salesrs_variety='".$row_tbl['unp_variety']."' and salesrs_rettype='P2P' and salesrs_rvflg=0 and salesrs_ups='".$row_tbl['unp_ups']."' and salesrs_newlot='".$row_tbl['unp_lotno']."'") or die(mysqli_error($link));
$row_arrival=mysqli_fetch_array($sql_arrival);

$dot="";
if($row_arrival['salesrs_dot']!="")
{
$dt=explode("-",$row_arrival['salesrs_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_arrival['salesrs_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_arrival['salesrs_got']." ".$row_arrival['salesrs_got1'];

//echo $row_arrival['salesrs_typ'];

$nop="";$qty="";$ewh="";$ebin="";$esbin="";
//if($row_arrival['salesrs_typ']=="verrec")
//{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	/*else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}*/
else if($row_arrival['salesrs_typ']=="vernew")
{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}
else
{
	$nop=$row_arrival['salesrs_nobdc'];
	$qty=$row_arrival['salesrs_qtydc'];
	$ewh=$row_arrival['salesrs_wh'];
	$ebin=$row_arrival['salesrs_bin'];
	$esbin=$row_arrival['salesrs_subbin'];
}
?>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tbltext">&nbsp;<?php echo $nop;?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tbltext">&nbsp;<?php echo $qty;?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_arrival['salesrs_qc'];?></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $got;?></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?></td>
<input type="hidden" name="orlot" value="<?php echo $row_arrival['salesrs_orlot'];?>" />
</table>
<br />

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
    <td width="157" align="center" valign="middle" class="tblheading">WH</td>
    <td width="145" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="173" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="183" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="180" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_tbl['unp_cwh1']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_tbl['unp_cbin1']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_tbl['unp_csbin1']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
?>
<tr class="Light" height="30" >
	<td width="157" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="145" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="173" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="183"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cnob1'];?></td>
	<td width="180" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cqty1'];?></td>
</tr>
<?php
if($row_tbl['unp_cqty2'] > 0)
{
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_arrival['unp_cwh2']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg2 = mysqli_fetch_array($whg2_query);

$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_tbl['unp_cbin2']."'") or die(mysqli_error($link));
$noticia_bing2 = mysqli_fetch_array($bing2_query);

$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_tbl['unp_csbin2']."'") or die(mysqli_error($link));
$noticia_sbing2 = mysqli_fetch_array($subbing2_query);
?>
<tr class="Light" height="30" >
	<td width="157" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg2['perticulars'];?></td>
	<td width="145" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing2['binname'];?></td>
	<td width="173" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing2['sname'];?></td>
	<td align="center" width="183"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cnob2'];?></td>
	<td width="180" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cqty2'];?></td>
</tr>
<?php
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
