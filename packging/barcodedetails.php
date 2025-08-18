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
$tid=$pid; 

$sql_tbl=mysqli_query($link,"SELECT   * from tbl_pnpslipmain where plantcode='".$plantcode."' and  pnpslipmain_id ='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Direct Loading / Non-Allocation Type - Loading Slip</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td valign="top">
	<form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	<input name="frm_action" value="submit" type="hidden"> 

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Barcode Details</font></td>
</tr>
</table>
<HR width="750" align="center" />
<br />	  

<?php
$sql_arr_home1=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$tid."' ") or die(mysqli_error($link));
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);
if($tot_arr_home1 >0) 
{ 
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		
		$sid=$row_arr_home1['pnpslipsub_id'];
		
		$crps=$row_tbl['disps_crop']; 
		$vers=$row_tbl['disps_variety'];
		$ups=$row_arr_home1['pnpslipsub_ups'];
		
		$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['pnpslipmain_crop']."' order by cropname Asc");
		$noticia = mysqli_fetch_array($quer3);
		
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['pnpslipmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$noticia_item = mysqli_fetch_array($quer4);
		
		$sq2=mysqli_query($link,"Select distinct pnpslipbar_lotno from tbl_pnpslipbarcode where plantcode='".$plantcode."' and  pnpslipsub_id='$sid' and pnpslipmain_id='$tid'") or die(mysqli_error($link));
		$totrec=mysqli_num_rows($sq2);
		if($totrec=mysqli_num_rows($sq2) > 0)
			{
				while($ro2=mysqli_fetch_array($sq2))
				{
					$lot23=$ro2['pnpslipbar_lotno']; 
					$lot2=$ro2['pnpslipbar_lotno']; 
					$zz24=str_split($ro2['pnpslipbar_lotno']);
					$lot23=$zz24[0].$zz24[1].$zz24[2].$zz24[3].$zz24[4].$zz24[5].$zz24[6].$zz24[7].$zz24[8].$zz24[9].$zz24[10].$zz24[11].$zz24[12].$zz24[13].$zz24[14].$zz24[15];
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
<tr class="Light" height="20">
  <td align="center" class="tblheading">Crop</td>
  <td align="center" class="tblheading"><?php echo $noticia['cropname'];?></td>
  <td align="center" class="tblheading">Variety</td>
  <td align="center" class="tblheading"><?php echo $noticia_item['popularname'];?></td>
   <td align="center" class="tblheading">UPS</td>
  <td align="center" class="tblheading"><?php echo $ups;?></td>
  <td align="center" class="tblheading">Lot No.</td>
  <td align="center" class="tblheading"><?php echo $lot23;?></td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="55"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="100" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="85" align="center"  valign="middle" class="tbltext">Net Weight</td>
	<td width="126" align="center"  valign="middle" class="tbltext">Gross Weight</td>
	<td width="55"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="100" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="85" align="center"  valign="middle" class="tbltext">Net Weight</td>
	<td width="126" align="center"  valign="middle" class="tbltext">Gross Weight</td>
</tr>
<tr class="Dark">
<?php
$srno=1;
$sq3=mysqli_query($link,"Select * from tbl_pnpslipbarcode where plantcode='".$plantcode."' and  pnpslipbar_lotno='$lot2' and  pnpslipsub_id='$sid' and pnpslipmain_id='$tid'") or die(mysqli_error($link));
while($ro3=mysqli_fetch_array($sq3))
{
$barcode=$ro3['pnpslipbar_barcode'];	
$tgrqty=$ro3['pnpslipbar_grosswt'];
$tqty=$ro3['pnpslipbar_wtmp'];
?>

<?php
if($srno%2==1)
{
?>										
	<td width="55" height="20" align="center"  valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="100" align="center"  valign="middle" class="tbltext"><?php echo $barcode;?></td>
	<td width="85" align="center"  valign="middle" class="tbltext"><?php echo $tqty;?></td>
	<td width="126" align="center"  valign="middle" class="tbltext"><?php echo $tgrqty;?></td>
<?php
}
else
{
?>										
	<td width="55" height="20" align="center"  valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="100" align="center"  valign="middle" class="tbltext"><?php echo $barcode;?></td>
	<td width="85" align="center"  valign="middle" class="tbltext"><?php echo $tqty;?></td>
	<td width="126" align="center"  valign="middle" class="tbltext"><?php echo $tgrqty;?></td>
	</tr>
<?php
}
$srno++;
}

?>
</table>
<br />
<?php
}
}
}
}
?>

<br />
<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="cc_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
