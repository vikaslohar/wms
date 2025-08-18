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
<title>Drying - Transaction- Cob Drying Slip Note - DSN</title>
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_cobdrying where plantcode='".$plantcode."' and   trid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $total_tbl=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
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
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Cob Drying Slip Note (CDSN)</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "PD".$row_tbl['ar_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="269" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="179" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
if($totver=mysqli_num_rows($quer3) > 0)
{
	$vername=$rowvv['popularname'];
	$verid=$rowvv['varietyid'];
}
else
{
	$vername=$row_tbl['variety'];
	$verid=$row_tbl['variety'];
}		
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropname='".$row_tbl['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>

<td align="right"  valign="middle" class="tblheading">Variety�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $vername;?></td>
 </tr>
 <tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">Drying slip reference No.�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['drefno'];?></td>
 </tr>
</table>

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="30%" align="left" rowspan="2" valign="left" class="tblheading">&nbsp;&nbsp;We acknowledge the receipt of following materials:</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">
       <tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
			   <td width="83" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No. </td>
			   <td width="106" align="center" valign="middle" class="smalltblheading" rowspan="2">Existing SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading"  colspan="2">Before Drying </td>
			    <td width="107" align="center" valign="middle" class="smalltblheading"rowspan="2" >Updated SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying  </td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
			   <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying Start</td>
			    <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying End</td>
				<td width="168" align="center" valign="middle" class="smalltblheading" rowspan="2">Total D.Time</td>
				 <td width="47" align="center" valign="middle" class="smalltblheading" rowspan="2">Drying Details</td>
              </tr>
  <tr class="tblsubtitle">
                    <td width="38" align="center" valign="middle" class="smalltblheading" >NoB</td>
                    <td width="51" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="36" align="center" valign="middle" class="smalltblheading">NoB</td>
                    <td width="56" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="36" align="center" valign="middle" class="smalltblheading">%</td>
                            </tr>
  <?php
 
$srno=1; $lotflg=1; $nlot="";
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{$sloc=""; $sloc1="";
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$nlot=$row_tbl_sub['newlono'];
$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
if($row_tbl_sub['drytyp']=='single'){$sloc=""; $sloc1=""; $lotflg=0; $nlot="";} $cnt++;
					
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_cobdryingsubsub where plantcode='".$plantcode."' and   subtrid='".$row_tbl_sub['subtrid']."' and trid='".$arrival_id."'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_subsub['owh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_subsub['osubbin']."' and binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_subsub['nwh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars']."/";

$sql_binn1=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname']."/";

$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_subsub['nsubbin']."' and binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];

$nb1=$row_tbl_subsub['onob']; 
//$qt1=$row_tbl_subsub['oqty']; 
$nb2=$row_tbl_subsub['nnob']; 
//$qt2=$row_tbl_subsub['nqty'];

$diq=explode(".",$row_tbl_subsub['oqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_subsub['nqty']);
if($diq[1]==000){$qt2=$diq[0];}else{$qt2=$row_tbl_subsub['nqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}

if($sloc1!=""){
$sloc1=$sloc1."<BR/>".$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}
else{
$sloc1=$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}

}	
$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	 <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="168" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="168" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<br />
<?php
if($lotflg>0)
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Light" height="30">
    <td width="50%" align="right" valign="middle" class="tblheading">New Lot No.</td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $nlot;?></td>
</tr>
</table><br />
<?php 
}
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="92" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="752" colspan="11" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table>
<!--<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="29" align="right"  valign="middle" class="tblheading">TIN:&nbsp;</td>
<td width="272" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="40" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="204" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="111" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="194" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>-->

<br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"></div></td>
</tr>
</table><br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="183"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="78" align="right" valign="middle" class="smalltblheading">&nbsp;Verified By</td>
<td width="158" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="97" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="133" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<table cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"></a><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
