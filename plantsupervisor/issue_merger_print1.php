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
	$pid = $_REQUEST['pid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transaction - Lot Merger Print Preview</title>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
   <?php
	$sql1=mysqli_query($link,"select * from tbl_mergermain where mergerm_id=$pid and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	
	$tdate=$row['mergerm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Merger</td>
</tr>
  

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TLM".$row['mergerm_tcode']."/".$row['mergerm_yearid']."/".$row['mergerm_logid'];?></td>

<td width="168" align="right" valign="middle" class="tblheading">Merger&nbsp;Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['mergerm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['mergerm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
?>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['mergerm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['mergerm_newlot'];?></td>
</tr>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['mergerm_nob'];?></td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['mergerm_qty'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">No. of Lots Merged&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['mergerm_oldlot'];?></td>
</tr>
</table>
</br>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >Merging Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="tblheading">#</td>
		<td align="left" valign="middle" class="tblheading">&nbsp;Lot No.</td>
	</tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_mergersub where mergerm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($sr%2!=0)
{
?>		  
	<tr class="Light" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_eindent_sub['mergers_lotno'];?></td>
	</tr>

<?php
}
else
{
?>
	<tr class="Dark" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_eindent_sub['mergers_lotno'];?></td>
	</tr>
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="tblsubtitle">
<td align="center" valign="middle" class="tblheading" colspan="5">SLOC Details</td>
</tr>
	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="tblheading">WH</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Bin</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Sub Bin</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$sr2=1; $itmdchk="";
$sql_eindent_sub2=mysqli_query($link,"select * from tbl_mergersubsub where mergerm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub2=mysqli_fetch_array($sql_eindent_sub2))
{

$wareh=""; $binn=""; $subbinn="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_eindent_sub2['mergerss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_eindent_sub2['mergerss_binid']."' and whid='".$row_eindent_sub2['mergerss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_eindent_sub2['mergerss_subbinid']."' and binid='".$row_eindent_sub2['mergerss_binid']."' and whid='".$row_eindent_sub2['mergerss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($sr2%2!=0)
{
?>		  
	<tr class="Light" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $wareh;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $binn;?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $subbinn;?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_qty'];?></td>
	</tr>

<?php
}
else
{
?>
	<tr class="Dark" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $wareh;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $binn;?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $subbinn;?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub2['mergerss_qty'];?></td>
	</tr>
<?php 
}
$sr2=$sr2+1;	
}
?>		
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp<?php echo $row['mergerm_remarks'];?> </td>
</tr></table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</td></tr>
</table>

</body>
</html>
