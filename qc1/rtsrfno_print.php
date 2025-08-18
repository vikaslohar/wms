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
		$itmid = $_REQUEST['itmid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>QC Supervisor - Report- SEED  ANALYSIS REQUEST FORM(SRF)</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$pid=$itmid;

$sql1=mysqli_query($link,"select * from tbl_qcsrf_rt where srf_srfno='$pid'")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);
$trid=$pid; 

$tdate=$row['srf_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;
	

$sql_param=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">SEED  ANALYSIS REQUEST FORM (SRF) - RT</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;SI No&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $pid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Send Date&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Send To&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;</td>
</tr>

</table>

<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Crop</td>
		<td width="105" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
        <td width="74" rowspan="2" align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">Sample No.</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">Qty (Kgs)</td>
		<td colspan="4"  align="center" valign="middle" class="smalltblheading">Sample of</td>
		<td width="102" colspan="4"  align="center" valign="middle" class="smalltblheading">Test Required</td>
		<td width="45" rowspan="2"  align="center" valign="middle" class="smalltblheading">Remark</td>
	</tr>
	<tr class="tblsubtitle">
	  <td width="35"  align="center" valign="middle" class="smalltblheading">R</td>
	  <td width="60"  align="center" valign="middle" class="smalltblheading">C</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">P</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">SR</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">M</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">GOT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">G</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">P</td>
	</tr>
<?php


$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0; $sr=1;
$sql_sub=mysqli_query($link,"select * from tbl_qcsrf_rt where srf_srfno='$trid' order by srf_id asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	
$sql_eindent_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$row_sub['srf_tid']."' ") or die(mysqli_error($link));
$tot_rows=mysqli_num_rows($sql_eindent_sub);
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$crop=''; $variety=''; $sampleno=''; $ltno='';
$classqry2=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class2=mysqli_fetch_array($classqry2);
$crop=$noticia_class2['cropname'];

$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item2=mysqli_fetch_array($itemqry2);
$variety=$noticia_item2['popularname'];

$sampleno=$row_sub['srf_sampleno'];
$ltno1=$row_sub['srf_orlot'];
$ltno=$row_sub['srf_lotno'];
$zzz=str_split($ltno);
$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];

$olot2=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12];



$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row_eindent_sub['crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row_eindent_sub['variety']."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row_eindent_sub['crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row_eindent_sub['variety']."' order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$totqty=$totqty+$row_issuetbl['lotldg_trqty']; 
			$totnob=$totnob+$row_issuetbl['lotldg_trbags'];		
			
			$cont++;
		}	
	}
}
$stager=''; $stagec=''; $stagep=''; $stage=''; $statep=''; $statem=''; $stateg=''; $stategot='';
if($row_eindent_sub['trstage']=="Raw") { $stager='R'; } else if($row_eindent_sub['trstage']=="Condition") { $stagec='C'; } else if($row_eindent_sub['trstage']=="Pack") { $stagep='P'; } else { $stage=''; }

if($row_eindent_sub['state']=="P/M/G")
{
	$state=explode("/",$row_eindent_sub['state']);
	$statep='P'; $statem='M'; $stateg='G';
}
if($row_eindent_sub['state']=="P/M/G/T")
{
	$state=explode("/",$row_eindent_sub['state']);
	$statep='P'; $statem='M'; $stateg='G'; $stategot='T';
}
if($row_eindent_sub['state']=="G")
{
	$stateg='G';
}
if($row_eindent_sub['state']=="T")
{
	$stategot='T';
}
		
if($sr%2!=0)
{
?>		  
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno1?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sampleno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stager?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stagec?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stagep?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $statem?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stategot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stateg?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $statep?></td>
		<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
	</tr>

<?php
}
else
{
?>
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno1?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sampleno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stager?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stagec?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stagep?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $statem?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stategot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $stateg?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $statep?></td>
		<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
<?php 
}
$sr=$sr+1;	
//}
}
}
?>	
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="50%" align="left"  valign="middle" class="smalltbltext">&nbsp;No. of Samples&nbsp;</td>
<td width="50%" align="right"  valign="middle" class="smalltblheading">&nbsp;Accompanying Lots No. of Samples Tallied: YES/NO&nbsp;</td>
</tr></table><br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="60%" align="left"  valign="middle" class="smalltblheading">&nbsp;Sample Drawn By&nbsp;___________________________________________________________________</td>
<td width="40%" align="center"  valign="middle" class="smalltbltext">&nbsp;Name & Signature&nbsp;</td>
</tr></table>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="100%" align="left"  valign="middle" class="smalltblheading">&nbsp;Sample Collected By&nbsp;_____________________________________________________________</td>
</tr></table>
<br />

<table align="left" border="1" width="250" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="5%" align="right"  valign="middle" class="smalltbltext">&nbsp;M&nbsp;</td>
<td width="73%" align="left"  valign="middle" class="smalltbltext">&nbsp;Moisture</td>
<td width="4%" align="right"  valign="middle" class="smalltbltext">&nbsp;R&nbsp;</td>
<td width="18%" align="left"  valign="middle" class="smalltbltext">&nbsp;Raw Seed</td>
</tr>
<tr class="Light" height="20">
<td width="5%" align="right"  valign="middle" class="smalltbltext">&nbsp;GOT&nbsp;</td>
<td width="73%" align="left"  valign="middle" class="smalltbltext">&nbsp;Grow Out Test</td>
<td width="4%" align="right"  valign="middle" class="smalltbltext">&nbsp;C&nbsp;</td>
<td width="18%" align="left"  valign="middle" class="smalltbltext">&nbsp;Clean Seed</td>
</tr>
<tr class="Light" height="20">
<td width="5%" align="right"  valign="middle" class="smalltbltext">&nbsp;G&nbsp;</td>
<td width="73%" align="left"  valign="middle" class="smalltbltext">&nbsp;Germination</td>
<td width="4%" align="right"  valign="middle" class="smalltbltext">&nbsp;P&nbsp;</td>
<td width="18%" align="left"  valign="middle" class="smalltbltext">&nbsp;Pack Seed</td>
</tr>
<tr class="Light" height="20">
<td width="5%" align="right"  valign="middle" class="smalltblheading">&nbsp;P&nbsp;</td>
<td width="73%" align="left"  valign="middle" class="smalltblheading">&nbsp;Purity</td>
<td width="4%" align="right"  valign="middle" class="smalltbltext">&nbsp;SR&nbsp;</td>
<td width="18%" align="left"  valign="middle" class="smalltbltext">&nbsp;Sales Return</td>
</tr>
</table>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"></div></td>
</tr>
</table>

<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"></a><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
