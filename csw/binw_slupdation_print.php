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

	//$logid="opr1";
	//$lgnid="OP1";
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW -Transaction  - Sloc Update SubBin wise</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<?php
		$sql1=mysqli_query($link,"select * from tbl_sloc_binw where slid='".$pid."' AND plantcode='".$plantcode."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_binw_sub where slocid='".$pid."' AND plantcode='".$plantcode."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
	
	$sql_wh=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whid='".$row['wh']."' AND plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
	$row_wh=mysqli_fetch_array($sql_wh);
	
	$sql_bn=mysqli_query($link,"select binid, binname from tbl_bin  where binid='".$row['bin']."' AND plantcode='".$plantcode."'") or die(mysqli_error($link));
	$row_bn=mysqli_fetch_array($sql_bn);
	
	$sql_sbn=mysqli_query($link,"select sid, sname from tbl_subbin where sid='".$row['subbin']."' AND plantcode='".$plantcode."' order by sname")or die("Error:".mysqli_error($link));
	$row_sbn=mysqli_fetch_array($sql_sbn);
	 ?>   
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation Sub-Bin wise</td>
</tr>
 <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">Existing SLOC</td>
  </tr>
<tr class="Light" height="25">
	<td width="110" align="right"  valign="middle" class="tblheading">&nbsp;WH&nbsp; </td>                                   
	<td width="163" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_wh['perticulars'];?></td>
	<td width="67" align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
	<td width="143" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_bn['binname'];?></td>
	<td width="73" align="right"  valign="middle" class="tblheading">Sub-Bin&nbsp;</td>
	<td width="180" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_sbn['sname'];?></td>
</tr>
</table>
<div id="showsloc" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse"  cols="2">
<tr class="tblsubtitle">
	<td width="70" align="center" valign="middle" class="tblheading" >#</td>
	<td width="318" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="296" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="256" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="256" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="56" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="56" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $cnt=0; $cropt="";$vert=""; $crpflg=0; $verflg=0; $stage=""; $stageflg=0;
$sql_iss=mysqli_query($link,"select distinct (lotldg_lotno)  from tbl_lot_ldg where lotldg_whid='".$row['wh']."' AND plantcode='".$plantcode."' and lotldg_binid='".$row['bin']."' and lotldg_subbinid='".$row['subbin']."'") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_iss);
while($row_iss=mysqli_fetch_array($sql_iss))
{ 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row['subbin']."' AND plantcode='".$plantcode."' and lotldg_binid='".$row['bin']."' and lotldg_whid='".$row['wh']."' and lotldg_lotno='".$row_iss['lotldg_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty>0 AND plantcode='".$plantcode."'") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
$cnt++;
$lot=$row_issuetbl['lotldg_lotno'];
if($cropt=="")
{
$cropt=$row_issuetbl['lotldg_crop'];
}
else
{
if($cropt!=$row_issuetbl['lotldg_crop'])
$crpflg++;
}
if($vert=="")
{
$vert=$row_issuetbl['lotldg_variety'];
}
else
{
if($vert!=$row_issuetbl['lotldg_variety'])
$verflg++;
}
if($stage=="")
{
$stage=$row_issuetbl['lotldg_sstage'];
}
else
{
if($stage!=$row_issuetbl['lotldg_sstage'])
$stageflg++;
}
$sql_crop=mysqli_query($link,"Select * from tblcrop where cropid='".$row_issuetbl['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crp=$row_crop['cropname'];
$sql_veriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_veriety=mysqli_fetch_array($sql_veriety);
$vv=$row_veriety['popularname'];

$tot_sub2=0;
$sql_sub2=mysqli_query($link,"select * from tbl_sloc_binw_sub where slocid='".$pid."' and lotno='".$lot."' AND plantcode='".$plantcode."' and whid='".$row_sub['whid']."' and binid='".$row_sub['binid']."' and subbinid='".$row_sub['subbinid']."'")or die(mysqli_error($link));
$row_sub2=mysqli_fetch_array($sql_sub2);
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2>0)
{
if($srno%2!=0)
{
?> 
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle"><?php echo $srno;?></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balbags'];?>&nbsp;</td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balqty'];?>&nbsp;</td>
</tr>
 <?php
}
else
{
?>
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" ><?php echo $srno;?></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balbags'];?>&nbsp;</td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balqty'];?>&nbsp;</td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
<input type="hidden" name="cnt" value="<?php echo $cnt;?>" /><input type="hidden" name="crpflg" value="<?php echo $crpflg;?>" /><input type="hidden" name="cropt" value="<?php echo $cropt;?>" /><input type="hidden" name="verflg" value="<?php echo $verflg;?>" /><input type="hidden" name="vert" value="<?php echo $vert;?>" /><input type="hidden" name="stageflg" value="<?php echo $stageflg;?>" /><input type="hidden" name="stage" value="<?php echo $stage;?>" />
 </table>
 <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse"> <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">New SLOC</td>
  </tr>
<?php
	$sql_wh2=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whid='".$row_sub['whid']."' AND plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
	$row_wh2=mysqli_fetch_array($sql_wh2);
	
	$sql_bn2=mysqli_query($link,"select binid, binname from tbl_bin  where binid='".$row_sub['binid']."' AND plantcode='".$plantcode."'") or die(mysqli_error($link));
	$row_bn2=mysqli_fetch_array($sql_bn2);
	
	$sql_sbn2=mysqli_query($link,"select sid, sname from tbl_subbin where sid='".$row_sub['subbinid']."' AND plantcode='".$plantcode."' order by sname")or die("Error:".mysqli_error($link));
	$row_sbn2=mysqli_fetch_array($sql_sbn2);
?>  
<tr class="Light" height="25">
	<td width="110" align="right"  valign="middle" class="tblheading">&nbsp;WH&nbsp; </td>                                   
	<td width="163" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_wh2['perticulars'];?></td>
	<td width="67" align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
	<td width="143" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_bn2['binname'];?></td>
	<td width="73" align="right"  valign="middle" class="tblheading">Sub-Bin&nbsp;</td>
	<td width="180" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_sbn2['sname'];?></td>
</tr>
</table>
</div>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
