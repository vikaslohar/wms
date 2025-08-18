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
<title>Dispatch - Transaction - Dispatch Stock Transfer - STON</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<HR width="750" align="center" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Stock Transfer Out Note (STON)</font></td>
</tr>
</table><br />	  

   <?php
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_stoutmpack where plantcode='".$plantcode."' and  stoutmp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

	$tdate=$row_tbl['stoutmp_ddate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$arrival_id=$row_tbl['stoutmp_id'];

$quer5=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['stoutmp_plantid']."' order by stcode asc"); 
$noticia2 = mysqli_fetch_array($quer5); 
$plantname=$noticia2['business_name'];
	
	$code1="DS".$row['stoutmp_code'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Stock Transfer Out&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;STON No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "DS".$row_tbl['stoutmp_code']."/".$row['stoutmp_yearid']."/".$row_tbl['stoutmp_logid'];?></td>
</tr>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Plant Name&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $plantname;?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia2['address'];?><?php if($noticia2['city']!="") { echo ", ".$noticia2['city']; }?>, <?php echo $noticia2['state'];?><?php if($noticia2['pin']!="" && $noticia2['pin']>0) { echo " - ".$noticia2['pin']."."; }?><?php if($noticia2['phone']!="" && $noticia2['phone']>0) { echo " Ph - 0".$noticia2['std']."-".$noticia2['phone']; }?><?php if($noticia2['mob']!="" && $noticia2['mob']>0) { echo " M - ".$noticia2['mob']; }?></div></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<?php echo $row_tbl['stoutmp_tmode'];?><input name="txt11" value="<?php echo $row_tbl['stoutmp_tmode'];?>" type="hidden"> </td>
</tr>
<?php
if($row_tbl['stoutmp_tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_tname'];?><input name="txttname" value="<?php echo $row_tbl['stoutmp_tname'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_lorryrepno'];?><input name="txtlrn" value="<?php echo $row_tbl['stoutmp_lorryrepno'];?>" type="hidden"></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_tbl['stoutmp_tvehno'];?><input name="txtvn" value="<?php echo $row_tbl['stoutmp_tvehno'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_paymode'];?>&nbsp;(Transport)<input name="txt13" value="<?php echo $row_tbl['trans_paymode'];?>" type="hidden"></td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['courier_name'];?><input name="txtcname" value="<?php echo $row_tbl['courier_name'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['docket_no'];?><input name="txtdc" value="<?php echo $row_tbl['docket_no'];?>" type="hidden"></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?><input name="txtpname" value="<?php echo $row_tbl['pname_byhand'];?>" type="hidden"></td>
</tr>
<?php
}
?>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Lot No.</td>
	<td width="88" align="center" class="smalltblheading">UPS</td>
	<td width="73" align="center" class="smalltblheading">NoP</td>
	<td width="73" align="center" class="smalltblheading">NoMP</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
</tr>
<?php 
$srno=1; $totnomp=0; $totqty=0;
$sql_sub=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and  stoutmp_id='$tid'") or die(mysqli_error($link));
if($tot_sub=mysqli_num_rows($sql_sub) > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stoutsp_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$crop=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stoutsp_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variety=$noticia_item['popularname'];

$lotn2=$row_sub['stouts_lotno'];
$zz2=str_split($lotn2);
$lotn=$zz2[0].$zz2[1].$zz2[2].$zz2[3].$zz2[4].$zz2[5].$zz2[6].$zz2[7].$zz2[8].$zz2[9].$zz2[10].$zz2[11].$zz2[12].$zz2[13].$zz2[14].$zz2[15];
$stgw=$row_sub['stoutsp_ups'];
$nop=$row_sub['stoutsp_loadnop'];
$nobs=$row_sub['stoutsp_loadnomp'];
$qtys=$row_sub['stoutsp_loadqty'];

$totnop=$totnop+$nop;
$totnomp=$totnomp+$nobs; 
$totqty=$totqty+$qtys; 

if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nop;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nop;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
</tr>
<?php
}
$srno++;
}
}
?>	
<tr class="Dark" height="30">
	<td width="275" align="right"  valign="middle" class="tbltext" colspan="5">Grand Total&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totnop;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totnomp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totqty;?>&nbsp;Kgs.</td>
</tr>	  
</table>

<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutm_ramarks'];?></td>
</tr></table>
</br>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
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

<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
--><br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="87" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="145"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="80" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="149" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="159" align="right" valign="middle" class="smalltblheading">&nbsp;Authorized&nbsp;Signatory</td>
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
