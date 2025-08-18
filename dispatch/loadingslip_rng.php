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

$sql_tbl=mysqli_query($link,"select * from tbl_disp where disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['disp_id'];
$ptype=$row_tbl['disp_partytype'];
if($ptype=="Dealer" || $ptype=="Export Buyer")
{
$ntitle="Pack Seed Dispatch Note (PSDN)";
$ntyps="PSDN";
}
if($ptype=="C&F" || $ptype=="Branch")
{
$ntitle="Stock Transfer Dispatch Note (STDN)";
$ntyps="STDN";
}	
	
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
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;CIN:&nbsp;<?php echo $row_param['cin'];?>&nbsp;&nbsp;Seed License No.:&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<HR width="750" align="center" />
<?php
	$tdate=$row_tbl['disp_dodc'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['disp_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;

$sql23="select * from tbluser where plantcode='".$plantcode."' and  scode='".$row_tbl['disp_logid']."'";
$row_23=mysqli_query($link,$sql23) or die(mysqli_error($link));
$totalrow23= mysqli_num_rows($row_23);
$ObjRS23= mysqli_fetch_array($row_23);

$username=$ObjRS23['loginid'];
$emp_id = $ObjRS23['password']; 

		
$sql_opr=mysqli_query($link,"select * from tblopr where plantcode='".$plantcode."' and  login='$username' and BinARY pass like '".$emp_id."'") or die(mysqli_error($link));
$row_opr=mysqli_fetch_array($sql_opr);
$logname=$row_opr['name'];

$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
	
$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='$tid' and dnote_trtype='Dispatch Pack Seed' and dnote_ptype='$ptype'";
$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
$row_code1=mysqli_fetch_array($res_code1);

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);


$code1=$row_param['code']."/"."SD"."/".$row_tbl['disp_yearcode']."/".$row_code1['dnote_code'];
	
$ordernos=""; $porefno="";
$sql_arrsub=mysqli_query($link,"select * from tbl_disp_sub where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  disp_id='".$pid."'") or die(mysqli_error($link));
$a_arrsub=mysqli_num_rows($sql_arrsub);
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
	if($ordernos!="")
	$ordernos=$ordernos.",".$row_arrsub['disps_ordno'];
	else
	$ordernos=$row_arrsub['disps_ordno'];
}	

if($ordernos!="")
{
$tid240=explode(",",$ordernos); 
//array_unique($tid240); 
$tid240=array_keys(array_flip($tid240));
$ordernos=implode(",",$tid240);
foreach($tid240 as $tid230)
{
	if($tid230<>"")
	{
		$sqordm=mysqli_query($link,"Select * from tbl_orderm where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  orderm_porderno='$tid230'") or die(mysqli_error($link));
		$totordm=mysqli_num_rows($sqordm);
		while($rowordm=mysqli_fetch_array($sqordm))
		{
			if($porefno!="")
				$porefno=$porefno.",".$rowordm['orderm_partyrefno'];
			else
				$porefno=$rowordm['orderm_partyrefno'];
		}
	}
}
}
if($porefno!="")
{
$tid24=explode(",",$porefno); 
$tid24=array_keys(array_flip($tid24));
$porefno=implode(",",$tid24);
}
?> 

<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Loading Slip</font></td>
</tr>
</table><br />	  


<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Dispatch&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;<?php echo $ntyps;?> No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>
</tr>
<!--<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Dispatch Challan&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['disp_dcno'];?></td>
</tr>-->
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['disp_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
?> 
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $noticia['business_name'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?></div></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
<!--<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Supplier's Reference No&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $porefno;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Order number(s)&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $ordernos;?></td>
</tr>-->
</table>

<?php
$sql_arr_home1=mysqli_query($link,"select distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 order by disps_variety asc") or die(mysqli_error($link));
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);
if($tot_arr_home1 >0) 
{ 
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_arr_home2=mysqli_query($link,"select distinct disps_upstype from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 and disps_variety='".$row_arr_home1['disps_variety']."' order by disps_upstype desc") or die(mysqli_error($link));
		$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
		if($tot_arr_home2 >0) 
		{ 
			while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
			{
				
				$sql_arr_home3=mysqli_query($link,"select distinct disps_ups from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 and disps_variety='".$row_arr_home1['disps_variety']."' and disps_upstype='".$row_arr_home2['disps_upstype']."' order by disps_id asc") or die(mysqli_error($link));
				$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
				if($tot_arr_home3 >0) 
				{ 
					while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
					{
				
						$sql_arr_home33=mysqli_query($link,"select * from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 and disps_variety='".$row_arr_home1['disps_variety']."' and disps_upstype='".$row_arr_home2['disps_upstype']."' and disps_ups='".$row_arr_home3['disps_ups']."' order by disps_id asc") or die(mysqli_error($link));
						$tot_arr_home33=mysqli_num_rows($sql_arr_home33);
						if($tot_arr_home33 >0) 
						{ 
							while($row_arr_home33=mysqli_fetch_array($sql_arr_home33))
							{
								$sid=$row_arr_home33['disps_id'];
								
								$crps=$row_arr_home33['disps_crop']; 
								$vers=$row_arr_home33['disps_variety'];
								$ups=$row_arr_home3['disps_ups'];
								$nvariety=$row_arr_home33['disps_nvariety']; 
								$sq2=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
								$totrec=mysqli_num_rows($sq2);
								if($totrec=mysqli_num_rows($sq2) > 0)
									{
										while($ro2=mysqli_fetch_array($sq2))
										{
											$lot23=$ro2['dpss_lotno']; 
											$lot2=$ro2['dpss_lotno']; 
											$zz24=str_split($ro2['dpss_lotno']);
											$lot23=$zz24[0].$zz24[1].$zz24[2].$zz24[3].$zz24[4].$zz24[5].$zz24[6].$zz24[7].$zz24[8].$zz24[9].$zz24[10].$zz24[11].$zz24[12].$zz24[13].$zz24[14].$zz24[15];
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
<tr class="Light" height="20">
  <td align="center" class="tblheading">Crop</td>
  <td align="center" class="tblheading"><?php echo $crps;?></td>
  <td align="center" class="tblheading">Variety</td>
  <td align="center" class="tblheading"><?php echo $nvariety;?></td>
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
$sq3=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  dpss_lotno='$lot2' and disps_id='$sid' and disp_id='$tid'") or die(mysqli_error($link));
while($ro3=mysqli_fetch_array($sq3))
{
$barcode=$ro3['dpss_barcode'];	
$tgrqty=$ro3['dpss_grosswt'];
$tqty=$ro3['dpss_qty'];
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
}
}
}
}
}
}
?>

<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" height="50" align="left"  valign="middle" class="tbltext">&nbsp;</td>
</tr></table>
</br>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="smalltbltext" colspan="6">Note: If you find any discripancies in quantity and weight of items mentioned above, please contact our customer care service, not later than 7 days of receipt of this document.</td>
</tr>
</table>
<br />
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
