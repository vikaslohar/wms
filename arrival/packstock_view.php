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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
		$itmid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['remarks']))
	{
	 	$remarks = $_REQUEST['remarks'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival Transaction- Stock Transafer Plant</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_arrpack where arrpack_logid='".$logid."' and arrpack_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrpack_id'];


	$tdate=$row_tbl['arrpack_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$dc;

?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"> Arrival Pack Seed Stock Transfer - Plant - Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrpack_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['arrpack_plantcode']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Stock Transfer from Plant&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>

</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?>&nbsp;</td>
</tr>
<?php
if($row_tbl['arrpack_tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_transname'];?></td>
<td width="207" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['arrpack_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['arrpack_tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_couriername'];?></td>
<td align="right" width="207" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_docketno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_pname'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_arrpack where arrpack_logid='".$logid."' and arrpack_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrpack_id'];
?>
<tr class="tblsubtitle" height="20">
	<td width="31" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="55" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="75" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Dispatch</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Received</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
	<td width="48" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
	<td width="43" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
	<td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="50" rowspan="2" align="center" valign="middle" class="tblheading">Germ. %</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type</td>
	<td colspan="4" align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<tr class="tblsubtitle">
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">WH</td>
	<td width="33" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="33" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="51" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
$srno=1;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_arrpack_sub where arrpack_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

	$crop=$row_tbl_sub['arrpacks_crop'];
	$variety=$row_tbl_sub['arrpacks_variety'];
	$lotno=$row_tbl_sub['arrpacks_lotno'];
	$qc=$row_tbl_sub['arrpacks_qcstatus'];
	$moist=$row_tbl_sub['arrpacks_moist'];
	$germ=$row_tbl_sub['arrpacks_germ'];
	$got=$row_tbl_sub['arrpacks_gotstatus'];
	
	$dnop=$row_tbl_sub['arrpacks_eloosenop'];
	$dnomp=$row_tbl_sub['arrpacks_enomp'];
	$dqty=$row_tbl_sub['arrpacks_eqty'];
	
	$arrnop=$row_tbl_sub['arrpacks_loosenop'];
	$arrnomp=$row_tbl_sub['arrpacks_nomp'];
	$arrqty=$row_tbl_sub['arrpacks_qty'];
	
	$balnop=$row_tbl_sub['arrpacks_balloosenop'];
	$balnomp=$row_tbl_sub['arrpacks_balnomp'];
	$balqty=$row_tbl_sub['arrpacks_balqty'];
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
		
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act=""; $nomp="";
//echo "select * from tbl_arrpack_subsub where arrpack_id='".$arrival_id."' and arrpacks_id='".$row_tbl_sub['arrpacks_id']."'";
$sql_sloc=mysqli_query($link,"select * from tbl_arrpack_subsub where arrpack_id='".$arrival_id."' and arrpacks_id='".$row_tbl_sub['arrpacks_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
	$slups=0; $slqty=0;
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['arrpackss_whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['arrpackss_binid']."' and whid='".$row_sloc['arrpackss_whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['arrpackss_subbinid']."' and binid='".$row_sloc['arrpackss_binid']."' and whid='".$row_sloc['arrpackss_whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	if($slocs!="")
	$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
	else
	$slocs=$wareh.$binn.$subbinn."<br/>";
	if($act1!="")
	$act1=$act1.$row_sloc['arrpackss_nop']."<br/>";
	else
	$act1=$row_sloc['arrpackss_nop']."<br/>";
	if($nomp!="")
	$nomp=$nomp.$row_sloc['arrpackss_nomp']."<br/>";
	else
	$nomp=$row_sloc['arrpackss_nomp']."<br/>";
	if($act!="")
	$act=$act.$row_sloc['arrpackss_qty']."<br/>";
	else
	$act=$row_sloc['arrpackss_qty']."<br/>";
}
	
	
	if($row_tbl_sub['arrpacks_pp']=="Acceptable")
	{
	$cc="ACC";
	}
	else if($row_tbl_sub['arrpacks_pp']=="Not-Acceptable")
	{
	$cc="NAC";
	}
	if($srno%2!=0)
	{

?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tbltext"><?php echo $crop?></td>
    <td width="58" align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
    <td width="75" align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
    <td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnop;?></td>
	 <td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnomp;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $dqty;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnop;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnomp;?></td>
    <td width="41" align="center" valign="middle" class="tbltext"><?php echo $arrqty;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnop;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnomp;?></td>	
    <td width="52" align="center" valign="middle" class="tbltext"><?php echo $balqty;?></td>
    <td width="48" align="center" valign="middle" class="tbltext"><?php echo $qc;?></td>
    <td width="43" align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td width="44" align="center" valign="middle" class="tbltext"><?php echo $moist;?></td>
    <td width="50" align="center" valign="middle" class="tbltext"><?php echo $germ;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $act1;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $nomp;?></td>
	<td width="51" align="center" valign="middle" class="tbltext"><?php echo $act;?></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tbltext"><?php echo $crop?></td>
	<td width="58" align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td width="75" align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnop;?></td>
	 <td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnomp;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $dqty;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnop;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnomp;?></td>
    <td width="41" align="center" valign="middle" class="tbltext"><?php echo $arrqty;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnop;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnomp;?></td>	
    <td width="52" align="center" valign="middle" class="tbltext"><?php echo $balqty;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $qc;?></td>
	<td width="43" align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
	<td width="44" align="center" valign="middle" class="tbltext"><?php echo $moist;?></td>
	<td width="50" align="center" valign="middle" class="tbltext"><?php echo $germ;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $act1;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $nomp;?></td>
	<td width="51" align="center" valign="middle" class="tbltext"><?php echo $act;?></td>
</tr>
  <?php
}
$srno++;
}
}

?>
</table><br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="Dark" height="30">
<td width="58" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="20">&nbsp;<?php echo $row_tbl['arrpack_remarks'];?></td>
</tr>
</table> 
<table align="center" cellpadding="5" cellspacing="5" border="0" width="950">
<tr >
<td align="right" colspan="3">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
