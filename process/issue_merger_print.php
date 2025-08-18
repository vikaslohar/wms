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
<title>Processing - Transaction - Lot Blending Print Preview</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
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
	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$pid and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Blending</td>
</tr>
  

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TLB".$row['blendm_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Blending Request Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);

$explotno='';
$sql_indent_sub6=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_indent_sub6=mysqli_fetch_array($sql_indent_sub6);
$explotno=$row_indent_sub6['blends_newlot'];

?>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['blendm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots Blending&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['blendm_nolots'];?></td>
</tr>
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['blendm_lottype'];?></td>

<td align="right" valign="middle" class="tblheading">Export Lot&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="lotnshow" >&nbsp;<?php if($row['blendm_lottype']=="Export"){echo $explotno;}?></td>

</tr>
<!--<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['blendm_newlot'];?></td>
</tr>-->
</table>
</br>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >Blending Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#adad11" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="tblheading">#</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Lot No.</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">QC Status</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">GOT Status</td>
		<td width="8%" align="center" valign="middle" class="tblheading">GOT Grade</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Status</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
$gotgrade='';
$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_eindent_sub['blends_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
$gotgrade=$row_tbl_gotgrade['gotgrade_finalgrade'];

$qry_tbl_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$row_eindent_sub['blends_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tbl_gottest=mysqli_num_rows($qry_tbl_gottest);	
$row_tbl_gottest=mysqli_fetch_array($qry_tbl_gottest);	
if($row_tbl_gottest['grade']!='' && $row_tbl_gottest['grade']!=NULL && $row_tbl_gottest['grade']!='NULL')
{$gotgrade=$row_tbl_gottest['grade'];}

if($sr%2!=0)
{
?>		  
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") echo "bgcolor='#EE9A4D'"; else if($mlot>=90000 && $llot!="00000") echo "bgcolor='#FFE5B4'"; else "class='Light'"?> height="25">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_lotno'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qc'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_got'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $gotgrade;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_sstatus'];?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qty'];?></td>
	</tr>

<?php
}
else
{
?>
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") echo "bgcolor='#EE9A4D'"; else if($mlot>=90000 && $llot!="00000") echo "bgcolor='#FFE5B4'"; else "class='Dark'"?> height="25">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_lotno'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qc'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_got'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $gotgrade;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_sstatus'];?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qty'];?></td>
	</tr>
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr height="10"><td></td></tr>
  <tr height="20">
    <td width="448"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#EE9A4D" class="tblheading" >&nbsp;</td>
    <td width="80"  align="left" valign="middle" class="tblheading" >&nbsp;Blended Lot</td>
    <td width="15"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#FFE5B4" class="tblheading" >&nbsp;</td>
    <td width="147"  align="left" valign="middle" class="tblheading" >&nbsp;Sales Return Blended Lot</td>
  </tr>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp<?php echo $row['blendm_remarks'];?> </td>
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
