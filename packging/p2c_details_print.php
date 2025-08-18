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
<title>Packaging - Transaction - Pack Seed Unpacking - Pack to Condition (P2C)</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
			</script>
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
$sql_tbl=mysqli_query($link,"select * from tbl_psunpp2c where unp_logid='".$logid."' and unp_id='".$tid."'") or die(mysqli_error($link));
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
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Unpacking - Pack to Condition (P2C)</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TPC".$row_tbl['unp_tcode']."/".$row_tbl['unp_yearcode']."/".$row_tbl['unp_logid'];?></td>

<td width="138" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
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
</table>
<?php

$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

$nop=0; $qty=0; $qc=""; $dot=""; $got=""; $dogt=""; 
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
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
	if($packtp[1]=="Gms")
	$nop1=($ptp*$penqty);
	else
	$nop1=($penqty/$ptp);
}

$nop=$nop+$nop1; 
$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$qty+$row_issuetbl['balqty'];

$qc=$row_issuetbl['lotldg_qc'];
$orlot=$row_issuetbl['orlot'];

$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];

$dgt=explode("-",$row_issuetbl['lotldg_gottestdate']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$gt=explode(" ",$row_issuetbl['lotldg_got1']);
$got=$gt[0]." ".$row_issuetbl['lotldg_got'];

if($dot=="0000-00-00" || $dot=="--" || $dot=="- -")$dot="";
if($dogt=="0000-00-00" || $dogt=="--" || $dogt=="- -")$dogt="";
}
}

$zzz=implode(",", str_split($row_tbl['unp_lotno']));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
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
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."C";
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."C";

$tflg=0;
$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' and trtype='Qty-Rem'") or die(mysqli_error($link)); 
$tot_istbl=mysqli_num_rows($sql_istbl);

$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' and trtype='Dispatch'") or die(mysqli_error($link)); 
$tot_istbl2=mysqli_num_rows($sql_istbl2);

if($tot_istbl > 0 || $tot_istbl2 > 0)$tflg++;
if($nomp > 0)$tflg++;

?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<?php echo $nop;?></td>	
<td align="right" width="236" valign="middle" class="tblheading">NoMP&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<?php echo $nomp;?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<?php echo $qty;?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $qc;?></td>	
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<?php echo $got;?></td>
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $dogt;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">P2C&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<?php echo ucwords($row_tbl['unp_p2ctype']);?></td>
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;<?php if($row_tbl['unp_p2ctype']=="partial") echo "Batch No. Generated - <font color=red>YES</font>"; else if($row_tbl['unp_p2ctype']=="entire") echo "Batch No. Generated - <font color=red>NO</font>"; else echo ""; ?></td>
<td align="right"  valign="middle" class="tblheading">P2C Lot number&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['unp_newlotno'];?></td>
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />

</table>
<br />
<div id="showlotsloc">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="10" align="center" valign="middle" class="tblheading">Existing SLOC Details</td>
</tr>
<tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="tblheading">#</td>
	<td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">Nop</td>
	<td width="107" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance Nop</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance Qty</td>
</tr>
<?php
$sno=0;

$sql_sub=mysqli_query($link,"Select * from tbl_psunpp2c_sub where unp_id='$tid'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$enop=$row_sub['unp_onop']; 
$eqty=$row_sub['unp_oqty'];
$nop=$row_sub['unp_nop']; 
$qty=$row_sub['unp_qty'];
$bnop=$row_sub['unp_bnop']; 
$bqty=$row_sub['unp_bqty'];


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sub['unp_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sub['unp_bin']."' and whid='".$row_sub['unp_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sub['unp_sbin']."' and binid='".$row_sub['unp_bin']."' and whid='".$row_sub['unp_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$sno++;


?>
<tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $sno;?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
    <td width="87" align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
    <td width="107" align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $enop;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $eqty;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $nop;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $bnop;?></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $bqty;?></td>
</tr>
<?php
}
}

?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" />
</table>
<br />

</div>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Condition Seed - SLOC Details</td>
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
$sql_sub2=mysqli_query($link,"Select * from tbl_psunpp2c_sub2 where unp_id='$tid'") or die(mysqli_error($link));
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2 > 0)
{
while($row_sub2=mysqli_fetch_array($sql_sub2))
{

$nop2=$row_sub2['unp_nop']; 
$qty2=$row_sub2['unp_qty'];

$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whid='".$row_sub2['unp_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where binid='".$row_sub2['unp_bin']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where sid='".$row_sub2['unp_sbin']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
?>
<tr class="Light" height="30" >
	<td width="157" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="145" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="173" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="183"  valign="middle" class="tbltext">&nbsp;<?php echo $nop2;?></td>
	<td width="180" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $qty2;?></td>
</tr>

<?php
}
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
