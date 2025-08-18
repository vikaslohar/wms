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

	if(isset($_GET['itmid']))
	{
		$tid = $_GET['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Dispatch-Gate Pass Out</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid;
 
$sql_tbl=mysqli_query($link,"select * from tbl_dbulk where  dbulk_id='$tid'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);			

$arrival_id=$row['dbulk_id'];
$ptype=$row['dbulk_partytype'];
 
$sql23="select * from tbluser where  scode='".$row['dbulk_logid']."'";
$row_23=mysqli_query($link,$sql23) or die(mysqli_error($link));
$totalrow23= mysqli_num_rows($row_23);
$ObjRS23= mysqli_fetch_array($row_23);

$username=$ObjRS23['loginid'];
$emp_id = $ObjRS23['password']; 

		
$sql_opr=mysqli_query($link,"select * from tblopr where  login='$username' and BinARY pass like '".$emp_id."'") or die(mysqli_error($link));
$row_opr=mysqli_fetch_array($sql_opr);
$logname=$row_opr['name'];
 
$sql_code1="SELECT * FROM tbl_gatepass where trid='$tid' and trtype='Dispatch Bulk Seed'";
$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
$row_code1=mysqli_fetch_array($res_code1);

$perticulars="Dispatch Bulk Seed";



	$tdate=$row['dbulk_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$ttime=$row['dbulk_ttime'];

$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];

$sql_code12="SELECT * FROM tbl_dispnote where  dnote_trid='$tid' and dnote_trtype='Dispatch Bulk Seed' and dnote_ptype='$ptype'";
$res_code12=mysqli_query($link,$sql_code12)or die(mysqli_error($link));
$row_code12=mysqli_fetch_array($res_code12);

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$code=$row_param['code']."/"."SD"."/".$row_code12['dnote_yearcode']."/".$row_code12['dnote_code'];
//$code=$row_param['code'].$ycode."/"."SD"."/".$row['dbulk_ncode'];
$code1="GP-P".$row_param['code']."/".$row['dbulk_yearcode']."/".$row_code1['gid'];

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
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;CIN:&nbsp;<?php echo $row_param['cin'];?>&nbsp;&nbsp;Seed License No.:&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
</td>
</tr>
</table><hr />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr  height="20">
  <td colspan="4" align="center" class="Mainheading"><font color="#000000">Gate Pass Out</font></td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Date/Time&nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;<?php echo $ttime;?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Gate Pass No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>
</tr>
 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;BSDN Ref. No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $code;?></td>
</tr>
<tr class="Light" height="20">
<?php
//if($row['pid']=="Yes")
//{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row['dbulk_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	//$tot=mysqli_num_rows($row3);		
 	$business_name=$row3['business_name'];
	$address=$row3['address'].", ".$row3['city'].", ".$row3['state'];
	if ($row3['phone']!="" && $row3['phone']!=0)
	{
	$phone="0".$row3['std']." ".$row3['phone'];
	}
	
?>

<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $business_name;?></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $address;?></div></td>
</tr>
<?php
$txt11=$row['tmode'];
if($txt11!= "") 
{
?>
<tr class="Light" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $txt11;?></td>
</tr>
<?php

if($txt11 == "Transport")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_name'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['trans_vehno']?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($txt11 == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['courier_name'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
}
?>
</table>
<br />
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_dbulk_sub where  dbulk_id='$arrival_id' and dbulks_flg=1 order by dbulks_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$cnt=0; $tqty=0; $tnob=0;
if($tot_arr_home >0) 
{ 
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		$tnob=$tnob+$row_arr_home['dbulks_nob'];
		$tqty=$tqty+$row_arr_home['dbulks_qty'];
	}
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td height="19" align="center" valign="middle" class="tblheading">Particulars</td>
			  <td width="27%" align="center" valign="middle" class="tblheading">No. of Units</td>
			  <td width="23%" align="center" valign="middle" class="tblheading">Qty</td>
		  </tr>
		  
<tr class="Light">
         <td width="50%" align="center" valign="middle" class="tblheading"><?php echo $perticulars?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $tnob;?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $tqty;?>&nbsp;Kgs.</td>
   </tr>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
	
		  <tr class="Light" height="25">
 <td width="174"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
   <td colspan="9" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txt12" type="radio" class="tbltext" value="Yes" onClick="clkp(this.value);" />&nbsp;Returnable&nbsp;&nbsp;<input name="txt12" type="radio" class="tbltext" value="No" onClick="clkp(this.value);" />&nbsp;Not Returnable&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><!----><br />
<br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" >
<td width="33%" align="center" valign="middle" class="smalltblheading">(<?php echo ucwords($logname);?>)</td>
<td width="34%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
<td width="33%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
<tr class="Light" >
<td width="33%" align="center" valign="middle" class="smalltblheading">Prepared By</td>
<td width="34%" align="center" valign="middle" class="smalltblheading">Checked By</td>
<td width="33%" align="center" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
</tr>
	    </table>
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" colspan="3"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
