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
<title>Drying- Transaction- Arrival From Stock Transafer</title>
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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
<?php  
/*$sql_item=mysqli_query($link,"select * from tbl_stores where plantcode='".$plantcode."' and   items_id='".$itmid."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$sql1=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   item_id='".$itmid."' order by whid")or die(mysqli_error($link));*/
?>
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arr_role='".$logid."' and arrival_type='Trading' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	    $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;

?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Trading Arrival Preview</td>
</tr>

 <tr class="Dark" height="30">
<td width="204" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="272"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAT".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="131" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="233" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Type of Arrival&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;Trading Arrival&nbsp;</td>
	<!--<td align="right"  valign="middle" class="tblheading">GRN No.�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;0000&nbsp;</td>-->

          </tr>
		   <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $tdate1;?>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DC No.�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?>&nbsp;</td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row3['classification'] == "Import Trader" )
	{
	$country="";
	$sql_country=mysqli_query($link,"Select * from tblcountry where c_id='".$row3['country']."'") or die(mysqli_error($link));
	$row_country=mysqli_fetch_array($sql_country);
	$country=$row_country['country'];
	$address=$row3['address'].",".$row3['city'].",".$row3['state'];
	if($country!="")
	$address.=",".$country;
	if($row3['pin'] > 0)
	$address.=" - ".$row3['pin'];
	}
	else
	{
	$address=$row3['address'].",".$row3['city'].",".$row3['state'];
	if($row3['pin'] > 0)
	$address.=" - ".$row3['pin'];
	}
?>
  <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $row3['business_name'];?>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Order Ref No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['orderno'];?>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Vendor&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $address;?>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?>&nbsp;</td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?>&nbsp;</td>
<td width="131" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="233" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?>&nbsp;</td>
<td align="right" width="131" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="233" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?>&nbsp;</td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?>&nbsp;</td>
</tr>
<?php
}
?>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	//echo $row31['cropname'];
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['lotcrop'];?>&nbsp;</td>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
<td align="right" width="131" valign="middle" class="tblheading">&nbsp;Variety&nbsp;</td>
<td align="left" width="233" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['lotvariety'];?>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">Vendor Variety&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['vvariety'];?>&nbsp;</td>
<td align="right" width="131" valign="middle" class="tblheading">No. of Lots&nbsp;</td>
<td align="left" width="233" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['nolot'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['sstage'];?>&nbsp;</td>
<!--<td align="right" width="99" valign="middle" class="tblheading">Seed&nbsp;status</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['sstatus'];?></td>-->
</tr>

</table><br />
<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">
<?php

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));

?>
			<tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">V. Lot No.</td>
	<td width="7%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per DC </td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>

	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>

		  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status </td>
		 	
		   <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
     </tr>
 
  <tr class="tblsubtitle">
    <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="6%" align="center" valign="middle" class="tblheading">Moist %</td>
      <td width="9%" align="center" valign="middle" class="tblheading">PP</td>
  </tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
	/*if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}
*/

/*$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$a."'");
$row= mysqli_fetch_array($lotqry)or die (mysqli_error($link));

  $lot=$row['lotcrop'];	
 $variety=$row['lotvariety'];
  $oldlot=$row['lotoldlot'];		


$sql_class=mysqli_query($link,"select * from tbl_classification where plantcode='".$plantcode."' and   classification_id='".$row_tbl_sub['classification_id']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where plantcode='".$plantcode."' and   items_id='".$row_tbl_sub['item_id']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
*/if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>	
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>
	  <?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>	
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
	<?php $aq1=explode(".",$row_tbl_sub['diff']); if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$row_tbl_sub['diff'];} ?>
    <td align="center" valign="middle" class="tblheading"><?php echo $ac1;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotoldlot'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>	
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
	  <?php $dq=explode(".",$row_tbl_sub['qty']); if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}?>
	  <?php $aq=explode(".",$row_tbl_sub['act']); if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];} ?>	
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
	<?php $aq1=explode(".",$row_tbl_sub['diff']); if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$row_tbl_sub['diff'];} ?>
    <td align="center" valign="middle" class="tblheading"><?php echo $ac1;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
     </tr> 
<?php
}
$srno++;
}
}
?>  			  
         <!-- </table>
		  <br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >-->
<tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="639" align="left"  valign="middle" class="tbltext" colspan="18">&nbsp;<?php echo $remarks;?></td>
</tr>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
