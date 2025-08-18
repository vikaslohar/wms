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
<title>Processing - Transaction - Lot Blending - LMN</title>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<?php 


	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<HR width="750" align="center" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Lot Blending Note (LMN)</font></td>
</tr>
</table><br />	  

   <?php
	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id='".$pid."' and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; $erid=0;
	$t=mysqli_num_rows($sql1);
	
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
	
	$code1="LM".$row['blendm_code'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Blending&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;LMN No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "LM".$row['blendm_code']."/".$yearid_id."/".$row['blendm_code'];?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."'") or die(mysqli_error($link));
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
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['blendm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots Blending&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['blendm_nolots'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['blendm_newlot'];?></td>
</tr>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#adad11" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="3%"  align="center" valign="middle" class="tblheading">#</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Lot No.</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">QC Status</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">GOT Status</td>
		<td width="8%"  align="center" valign="middle" class="tblheading">Status</td>
		<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
        <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($sr%2!=0)
{
?>		  
	<tr class="Light" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_lotno'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qc'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_got'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_sstatus'];?></td>
		<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_nob'];?></td>
		<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qty'];?></td>
	</tr>

<?php
}
else
{
?>
	<tr class="Dark" height="20">
		<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_lotno'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_qc'];?></td>
		<td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['blends_got'];?></td>
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
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
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
$sql_eindent_sub2=mysqli_query($link,"select * from tbl_blendssub where blendm_id=$trid and plantcode='$plantcode'") or die(mysqli_error($link));
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
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['blendm_remarks'];?></td>
</tr></table>
</br>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="40" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="164" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="176" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="119" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />

<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
--><br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="87" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="145"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="80" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="149" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="159" align="right" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
<td width="130" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>

	    </table><br />

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
