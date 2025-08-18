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
	if(isset($_REQUEST['subid']))
	{
	$subid = $_REQUEST['subid'];
	}
	if(isset($_REQUEST['tp']))
	{
	$tp = $_REQUEST['tp'];
	
	}
	if(isset($_REQUEST['lid']))
	{
	$lid = $_REQUEST['lid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Arrival-Transaction- Post Harvest Seed Receipt Note (PHSRN)</title>
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial; background-color:#FFFFFF; background-image:none; color:#000000;} 
img.butn { display:none; visibility:hidden; }
#header{display:none; color:#FFFFFF}
.page-break { display:block; page-break-before:always; }
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
$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	

	
	$sql_param=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

	$sql_tbl_sub11=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub11);
	while($row_tbl_sub11=mysqli_fetch_array($sql_tbl_sub11))
	{
	$subid=$row_tbl_sub11['arrsub_id'];
	?>	
	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr class="Light">
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != "" && $row_param['cphone1'] != 0){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>, <?php echo $row_param['pcity'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != "" && $row_param['pphone1'] != 0){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />

<?php
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrsub_id='".$subid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$ln1=explode("/",$row_tbl_sub['lotno']);
//echo $ln1[0];
$a=implode($ln1);
$ln2=substr($a, 1,6);
//echo $ln2;
?>
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Post Harvest Seed Receipt Note (PHSRN)</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
 <tr class="Dark" height="20">
<td width="65" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="206"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate;?></td>

<td width="72" align="right" valign="middle" class="tblheading">Lot No.&nbsp;</td>
<td width="206" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $ln2;?></td>

<td width="74" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="153" align="left"  valign="middle" class="smalltbltext"  >&nbsp;<?php echo $row_tbl_sub['lotcrop'];?></td>
</tr>

<tr class="Light" height="20">
	<td align="right"  valign="middle" class="tblheading">Organiser&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl_sub['organiser'];?></td>

<td align="right"  valign="middle" class="tblheading">Farmer&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_tbl_sub['farmer'];?></td>

<td align="right"  valign="middle" class="tblheading">Plot No.&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl_sub['plotno'];?></td>
</tr>
<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">Prod. Loc.&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<?php echo $row_tbl_sub['ploc'];?></td>
<td align="right"  valign="middle" class="tblheading">Prod. Per.&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl_sub['pper'];?></td>
<?php
$dq=explode(".",$row_tbl_sub['act']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['act'];}
?>
<td align="right"  valign="middle" class="tblheading">Act. NoB/Qty&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl_sub['act1']." / ".$dcq;?>&nbsp;Kgs.</td>
</tr>
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="6">Preliminary Quality Status</td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">Moisture %&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"  >&nbsp;<?php echo $row_tbl_sub['moisture'];?></td>
<td align="right"  valign="middle" class="tblheading">Phys. Purity&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl_sub['vchk'];?></td>
<td width="55" align="right"  valign="middle" class="tblheading">Remarks&nbsp;</td>
<td width="1" align="left"  valign="middle" class="tbltext">&nbsp;</td>
</tr>
<?php
if($row_tbl_sub['vchk']=="Not-Acceptable")
{
?>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">Reason&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="6">&nbsp;<?php echo $row_tbl_sub['remarks'];?></td>
</tr>
<?php
}
?>
</table>

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="right" class="tblheading" colspan="6"><div  align="right" class="smalltbltext" style="padding:2px 5px 5px 5px">Computer generated Note, need not be signed</div></td>
</tr>
</table><br style="line-height:5px;" />

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="right" class="tblheading" colspan="6"><div  align="center" class="smalltbltext" style="padding:2px 5px 5px 5px;">------------------------------------------------------------------------------------------cut here------------------------------------------------------------------------------------------</div></td>
</tr>
</table><br style="line-height:5px;" />
<?php
}
?>

<table cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<a href="fpdnphsrnpdf.php?itmid=<?php echo $itmid?>"><img src="../images/imagepdf.gif" border="0" class="butn" height="30" width="30" alt="Export to PDF" style="cursor:pointer"   /></a>&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
