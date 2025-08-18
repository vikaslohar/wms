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
     
	if(isset($_REQUEST['pid']))
	{
		$itmid = $_REQUEST['pid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW - Transaction - Pack Seed SP Release Note - PSSPRN</title>
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<table width="780" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<?php
 $tid=$itmid;

$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];

	$tdate=$row_tbl['pswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['pswrem_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate2=$tday1."-".$tmonth1."-".$tyear1;
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);	
?>
<table align="center" border="1" width="780" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
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
	
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<HR />
<tr height="20">
  <td colspan="6" align="center" class="Mainheading">Pack Seed SP Release Note (PSSPRN)</td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "CR".$row_tbl['pswrem_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pswrem_dcno'];?>&nbsp;</td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#0BC5F4" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_sub where plantcode='$plantcode' and pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
 $subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No.</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >UPS</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Crop</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Variety</td>
	<td width="91" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
	<td align="center" valign="middle" class="tblheading"  colspan="3">Actual Quantity</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Quantity Removed</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Balance Quantity</td>
</tr>
<tr class="tblsubtitle">
	<td width="50" align="center" valign="middle" class="tblheading" >NoP</td>
	<td width="50" align="center" valign="middle" class="tblheading" >NoMP</td>
	<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="53" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="52" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $difq="";  $rtotalnop=0; $rtotalups=0; $rtotalqty=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['pswrem_id'];

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pswremsub_sub where plantcode='$plantcode' and pswremsub_id='".$row_tbl_sub['pswremsub_id']."' and pswrem_id='".$row_tbl_sub['pswrem_id']."'") or die(mysqli_error($link));
while($row_subsub=mysqli_fetch_array($sql_tbl_subsub))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=""; $slocs=""; $gd=""; $slups=0; $slqty=0; $onob=0; $onomp=0; $oqty=0; $nob=0; $nomp=0; $qty=0; $baln=0; $balmp=0; $balq=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_subsub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_subsub['subbinid']."' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$onob=$onob+$row_subsub['opnop'];
$onomp=$onomp+$row_subsub['opnomp'];
$oqty=$oqty+$row_subsub['opqty'];
$nob=$nob+$row_subsub['remnop'];
$nomp=$nomp+$row_subsub['remnomp'];
$qty=$qty+$row_subsub['remqty'];
$baln=$baln+$row_subsub['balnop'];
$balmp=$balmp+$row_subsub['balnomp'];
$balq=$balq+$row_subsub['balqty'];

}
$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['crop']."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);

$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);

$rtotalnop=$rtotalnop+$onob;
$rtotalups=$rtotalups+$onomp;
$rtotalqty=$rtotalqty+$oqty;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_crp['cropname'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_var['popularname'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $slocs;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $onob;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $balq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_crp['cropname'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_var['popularname'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $onob;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $balq;?></td>
  </tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />



<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
