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
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Order-Sales Order Note- SON</title>
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>
<body topmargin="0" >
   <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);*/
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
if($row_tbl['order_trtype']=="Order Sales")
{
	?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  

 <table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >

<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000"> Sales Order Note (SON)</font></td>
</tr>
</table><table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="155" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="276"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "OS".$row_tbl['orderm_trcode']."/".$ycode."/".$lgnid;?></td>

<td width="131" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="178" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Order No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_porderno'];?></td>
<td align="right" width="131" valign="middle" class="tblheading">&nbsp;Party Order Ref. No.&nbsp;</td>
<td align="left" width="178" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_partyrefno'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row_tbl['orderm_party_type'];?></td>
</tr>

<?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['orderm_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
if($row_tbl['orderm_party_type']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_locstate'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['orderm_country'];?></td>
</tr>
<?php
}
$pin1="";
	if($row['pin']!="")
	 if ($row['pin'] >0 ){ 
	 $pin1=" - ".$row['pin'];} ?>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Invoice To&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>

<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php echo $row3['address'];?><?php if($row3['city']!=""){ echo ", ".$row3['city'];}?>-<?php if($pin1!=""){?> - <?php echo $pin1;}?>&nbsp;<?php echo $row3['state'];?><?php if($row3['mob']!="" && $row3['mob']!=0){echo ", Mob no.-".$row3['mob'];}?><?php if($row3['phone']!=""){echo ", Phone no. ".$row3['std']."-".$row3['phone'];}?><?php if($row3['tin']!=""){echo ", Tin no.-".$row3['tin'];}?><?php echo ".";?></div></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Consignee Applicable&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="5">&nbsp;<?php if($row_tbl['orderm_consigneeapp']=="Yes1"){ echo "Yes";} else{ echo "No";}?></td>
</tr>
<?php 
if($row_tbl['orderm_consigneeapp']=="Yes1")
{
$pin="";
	if($row_tbl['orderm_conpin']!="")
	 if ($row_tbl['orderm_conpin'] >0 ){ 
	 $pin=" - ".$row_tbl['orderm_conpin'];} ?>

<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Consignee Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['orderm_consigneename'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php echo $row_tbl['orderm_conadd'];?>,&nbsp;<?php echo $row_tbl['orderm_concity'];?>,&nbsp;<?php echo $row_tbl['orderm_constate'];?>&nbsp,<?php echo $row_tbl['orderm_country']?> <?php if($pin!=""){?>Pin <?php echo $pin;}?></div></td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Phone No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext" >&nbsp;<?php if($row_tbl['orderm_conphoneno']!=""){?> 
<?php echo $row_tbl['orderm_conphonestd']."-".$row_tbl['orderm_conphoneno'];}?></td>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Mobile No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext" >&nbsp;<?php if($row_tbl['orderm_conmobile']!=""){?> <?php echo $row_tbl['orderm_conmobile'];}?></td>
</tr>
<?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
?>
<tr class="Light" height="30">
<td align="right" width="196" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
<td align="left" width="216" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_contin'];?></td>
<td align="right" width="231" valign="middle" class="tblheading">&nbsp;CST&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_concst'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right" width="196" valign="middle" class="tblheading">&nbsp;UDF 1&nbsp;</td>
<td align="left" width="216" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_contin'];?></td>
<td align="right" width="231" valign="middle" class="tblheading">&nbsp;UDF 2&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_concst'];?></td>
</tr>
<?php
}
?>
<?php
}
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Dispatch&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_tmode'];?></td>
<?php
if($row_tbl['orderm_tmode'] == "Transport")
{
?>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_trname'];?></td>
<?php
}
else if($row_tbl['orderm_tmode'] == "Courier")
{
?>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_cname'];?></td>
<?php
}
else 
{
?> 
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_pname'];?></td>
<?php
}
?>
</tr>
<tr class="Light" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Order Placed By&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_placedby'];?></td>
</tr>
</table><br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="15%" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="21%" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="6%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="10%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="11%" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="6%" align="center" valign="middle" class="tblheading">PT</td>
        <td width="5%" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="5%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="6%" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="5%" align="center" valign="middle" class="tblheading">NoMP</td>
        <td width="5%" align="center" valign="middle" class="tblheading">Pending Qty. (Kgs.)</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		
$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1="";$bqt="";$bqt1="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$dq3=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq3[1]==000){$bqt1=$dq3[0];}else{$bqt1=$row_sloc['order_sub_subbal_qty'];}

if($bqt!="")
$bqt=$bqt.$bqt1."<br/>";
else
$bqt=$bqt1."<br/>";

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="140" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="225" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="139" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="5%" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $bqt;?></td>
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="140" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="225" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="139" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="5%" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $bqt;?></td>
  </tr>		
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="Dark" height="30">
<td width="58" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="20">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table> 
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td height="43" colspan="3" align="right">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
<br />
<?php
}
else if($row_tbl['order_trtype']=="Order Stock")
{
?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >

 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);*/
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

	?>

<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000"> Transfer Order Note (TON)</font></td>
</tr>
</table><table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="155" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="276"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "OS".$row_tbl['orderm_trcode']."/".$ycode."/".$lgnid;?></td>

<td width="145" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="164" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Order No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_porderno'];?></td>
<td align="right" width="145" valign="middle" class="tblheading">Party&nbsp;Order Ref. No.&nbsp;</td>
<td align="left" width="164" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_partyrefno'];?></td>
</tr>
<?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['orderm_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_locstate'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Stock Transfer To&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<div style="padding-left:4px"><?php echo $row3['address'];?><?php if($row3['city']!=""){ echo ", ".$row3['city'];}?>, <?php echo $row3['state'];?> - <?php echo $row3['pin'];?><?php if($row3['tin']!=""){?>, TIN: <?php echo $row3['tin'];}?><?php if($row3['cst']!=""){?>, CST: <?php echo $row3['cst'];}?></div></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Consignee Applicable&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="5">&nbsp;<?php echo $row_tbl['orderm_consigneeapp'];?></td>
</tr>
<?php 
if($row_tbl['orderm_consigneeapp']=="Yes")
{
$pin="";
	if($row_tbl['orderm_conpin']!="")
	 if ($row_tbl['orderm_conpin'] >0 ){ 
	 $pin=" - ".$row_tbl['orderm_conpin'];} ?>

<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Consignee Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['orderm_consigneename'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<div style="padding-left:4px"><?php echo $row_tbl['orderm_conadd'];?> , <?php echo $row_tbl['orderm_concity'];?> , <?php echo $row_tbl['orderm_constate'];?> <?php if($pin!=""){?>Pin <?php echo $pin;}?></div>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Phone No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext" >&nbsp;<?php if($row_tbl['orderm_conphoneno']!=""){?>
<?php echo $row_tbl['orderm_conphonestd']."-".$row_tbl['orderm_conphoneno'];}?></td>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Mobile No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext" >&nbsp;<?php if($row_tbl['orderm_conmobile']!=""){?><?php echo $row_tbl['orderm_conmobile'];}?></td>
</tr>
<?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
?>
<tr class="Light" height="30">
<td align="right" width="196" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
<td align="left" width="216" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_contin']!=""){?><?php echo $row_tbl['orderm_contin'];}?></td>
<td align="right" width="231" valign="middle" class="tblheading">&nbsp;CST&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_concst']!=""){?><?php echo $row_tbl['orderm_concst'];}?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right" width="196" valign="middle" class="tblheading">&nbsp;UDF 1&nbsp;</td>
<td align="left" width="216" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_contin']!=""){?><?php echo $row_tbl['orderm_contin'];}?></td>
<td align="right" width="231" valign="middle" class="tblheading">&nbsp;UDF 2&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_concst']!=""){?><?php echo $row_tbl['orderm_concst'];}?></td>
</tr>
<?php
}
?>
<?php
}
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Dispatch&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_tmode'];?></td>
<?php
if($row_tbl['orderm_tmode'] == "Transport")
{
?>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_trname'];?></td>
<?php
}
else if($row_tbl['orderm_tmode'] == "Courier")
{
?>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_cname'];?></td>
<?php
}
else 
{
?> 
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_pname'];?></td>
</tr>
<?php
}
?>

<tr class="Light" height="30">
<td width="155" height="32" align="right" valign="middle" class="tblheading">&nbsp;Order Placed By&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_placedby'];?></td>
</tr>
</table>

<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="15%" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="21%" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="6%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="10%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="11%" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="6%" align="center" valign="middle" class="tblheading">PT</td>
        <td width="5%" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="5%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="6%" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="5%" align="center" valign="middle" class="tblheading">NoMP</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		
$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="140" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="225" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="139" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="5%" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="140" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="225" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="139" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="5%" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>
</tr>		
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td height="43" colspan="3" align="right">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php 
}
else 
{
?>
<?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);*/
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

	?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000"> Demo Order Note (DON)</font></td>
</tr>
</table><table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="155" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="276"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "OS".$row_tbl['orderm_trcode']."/".$ycode."/".$lgnid;?></td>

<td width="145" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="164" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Order No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_porderno'];?></td>
<td align="right" width="145" valign="middle" class="tblheading">Party&nbsp;Order Ref. No.&nbsp;</td>
<td align="left" width="164" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_partyrefno'];?></td>
</tr>
<?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['orderm_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_locstate'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Stock Transfer To&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<div style="padding-left:4px"><?php echo $row3['address'];?><?php if($row3['city']!=""){ echo ", ".$row3['city'];}?>, <?php echo $row3['state'];?> - <?php echo $row3['pin'];?><?php if($row3['tin']!=""){?>, TIN: <?php echo $row3['tin'];}?><?php if($row3['cst']!=""){?>, CST: <?php echo $row3['cst'];}?></div></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Consignee Applicable&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="5">&nbsp;<?php if($row_tbl['orderm_consigneeapp']=="Yes1"){ echo "Yes";} else{ echo "No";}?></td>
</tr>
<?php 
if($row_tbl['orderm_consigneeapp']=="Yes")
{
$pin="";
	if($row_tbl['orderm_conpin']!="")
	 if ($row_tbl['orderm_conpin'] >0 ){ 
	 $pin=" - ".$row_tbl['orderm_conpin'];} ?>

<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Consignee Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php if($row_tbl['orderm_consigneeapp']=="Yes1"){ echo "Yes";} else{ echo "No";}?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<div style="padding-left:4px"><?php echo $row_tbl['orderm_conadd'];?> , <?php echo $row_tbl['orderm_concity'];?> , <?php echo $row_tbl['orderm_constate'];?> <?php if($pin!=""){?>Pin <?php echo $pin;}?></div>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Phone No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext" >&nbsp;<?php if($row_tbl['orderm_conphoneno']!=""){?>
<?php echo $row_tbl['orderm_conphonestd']."-".$row_tbl['orderm_conphoneno'];}?></td>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Mobile No.&nbsp;</td>
<td align="left" width="276" valign="middle" class="tbltext" >&nbsp;<?php if($row_tbl['orderm_conmobile']!=""){?><?php echo $row_tbl['orderm_conmobile'];}?></td>
</tr>
<?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
?>
<tr class="Light" height="30">
<td align="right" width="196" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
<td align="left" width="216" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_contin']!=""){?><?php echo $row_tbl['orderm_contin'];}?></td>
<td align="right" width="231" valign="middle" class="tblheading">&nbsp;CST&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_concst']!=""){?><?php echo $row_tbl['orderm_concst'];}?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right" width="196" valign="middle" class="tblheading">&nbsp;UDF 1&nbsp;</td>
<td align="left" width="216" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_contin']!=""){?><?php echo $row_tbl['orderm_contin'];}?></td>
<td align="right" width="231" valign="middle" class="tblheading">&nbsp;UDF 2&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php if($row_tbl['orderm_concst']!=""){?><?php echo $row_tbl['orderm_concst'];}?></td>
</tr>
<?php
}
?>
<?php
}
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Dispatch&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_tmode'];?></td>
<?php
if($row_tbl['orderm_tmode'] == "Transport")
{
?>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_trname'];?></td>
<?php
}
else if($row_tbl['orderm_tmode'] == "Courier")
{
?>
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['orderm_cname'];?></td>
<?php
}
else 
{
?> 
<td align="right" width="155" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_pname'];?></td>
</tr>
<?php
}
?>

<tr class="Light" height="30">
<td width="155" height="32" align="right" valign="middle" class="tblheading">&nbsp;Order Placed By&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderm_placedby'];?></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="15%" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="21%" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="6%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="10%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="11%" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="6%" align="center" valign="middle" class="tblheading">PT</td>
        <td width="5%" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="5%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="6%" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="5%" align="center" valign="middle" class="tblheading">NoMP</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		
$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_sub_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="140" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="225" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="139" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="5%" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="65" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="140" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="225" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="137" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="139" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="6%" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="5%" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>
</tr>		
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td height="43" colspan="3" align="right">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>
  </form>
</td></tr>
</table>

</body>
</html>
