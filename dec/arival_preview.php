<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['cropid']))
	{
	$pid = $_REQUEST['cropid'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode - Transaction - Decode Manual - Preview</title>
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
</head>
<body topmargin="0" >
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
		<input type="Hidden" name="txtcrop" value="<?php echo $pid?>" />
		</br>
     <?php 

$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblspdec where spdecid='".$tid."' ") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['spdecid'];

	$tdate=$row_tbl['spdecdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>


<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Decode Manual</td>
</tr>
 <tr class="Light" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="266"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "DM".$row_tbl['scode'];?></td>
<td width="142" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="259" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#7a9931"
 style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
   			  <td width="5%"  align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" r valign="middle" class="tblheading">SP Code-Female</td>
              <td width="12%"  align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="27%"  align="left" valign="middle" class="tblheading">&nbsp;Crop </td>
              <td width="31%"  align="lft" valign="middle" class="tblheading">&nbsp;Variety</td>
			  </tr>
  <?php

$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$arrival_id."' ") or die(mysqli_error($link));

$srno=1; $spfdchk=""; $spmdchk=""; $spcodedchk=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

/*if($spfdchk!="")
{
$spfdchk=$spfdchk.$row_tbl_sub['spcodef'].",";
}
else
{
$spfdchk=$row_tbl_sub['spcodef'].",";
}

if($spmdchk!="")
{
$spmdchk=$spmdchk.$row_tbl_sub['spcodem'].",";
}
else
{
$spmdchk=$row_tbl_sub['spcodem'].",";
}*/

	$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'"); 
	$row3=mysqli_fetch_array($quer3);

	$quer4=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' and vertype='PV'"); 
	$row4=mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodef'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td width="27%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row3['cropname'];?></td>
    <td width="31%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row4['popularname'];?></td>
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodef'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td width="27%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row3['cropname'];?></td>
    <td width="31%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row4['popularname'];?></td>
    </tr>
  <?php
}
$srno++;
}
}
?>			  
</table>
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" class="butn" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
