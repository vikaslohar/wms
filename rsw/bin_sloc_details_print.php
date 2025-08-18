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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
	/*if(isset($_REQUEST['slid']))
	{
	$slid = $_REQUEST['slid'];
	}*/
	if(isset($_REQUEST['wid']))
	{
	$wid = $_REQUEST['wid'];
	}
	if(isset($_REQUEST['bid']))
	{
	$bid = $_REQUEST['bid'];
	}
	if(isset($_REQUEST['tp']))
	{
	$tp = $_REQUEST['tp'];
	}
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW-Bin card</title>
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<?php  
/*$sql1=mysqli_query($link,"select * from tblarr_sloc where whid='".$wid."' and binid='".$bid."'  and arr_tr_id='".$pid."' order by subbin")or die(mysqli_error($link));
$rowtblsub=mysqli_fetch_array($sql1);
$f=$rowtblsub['lotvariety'];*/
?>
  
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$wid."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$bid."' and whid='".$wid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);

?>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="17">
<td align="center"  valign="middle" class="tblheading" colspan="2">Stage: Raw/Condition</td>
</tr>
<tr class="Dark" height="30">
<td width="401" align="left"  valign="middle" class="tblheading">&nbsp;Bin Card</td>
<td width="399" align="right"  valign="middle" class="tblheading">SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>&nbsp;</td>
</tr>

</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#e48324" style="border-collapse:collapse">
			 
			<tr class="tblsubtitle">
			  <td width="21" height="18" align="center" valign="middle" class="tblheading">#</td>
			  <td width="77" align="center" valign="middle" class="tblheading">Sub Bin</td>
			  <td width="112" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="75" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="158" align="center" valign="middle" class="tblheading">Lot Number</td>
			  <td width="56" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="86" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="86" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="100" align="center" valign="middle" class="tblheading">QC status</td>
			  <td width="95" align="center" valign="middle" class="tblheading">Moist %</td>
			  <td width="100" align="center" valign="middle" class="tblheading">DoT</td>
              <td width="100" align="center" valign="middle" class="tblheading">GOT Status</td>     
          </tr>
<?php
$srno=1;
$sql_tbl=mysqli_query($link,"select lotldg_subbinid, lotldg_variety, lotldg_crop,lotldg_lotno from tbl_lot_ldg where lotldg_whid='".$wid."' and lotldg_binid='".$bid."' and plantcode='$plantcode' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));  
//echo $t=mysqli_num_rows($sql_tbl);
while($row_tbl=mysqli_fetch_array($sql_tbl))
{

$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$wid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_variety='".$row_tbl['lotldg_variety']."' and lotldg_crop='".$row_tbl['lotldg_crop']."'  and lotldg_lotno='".$row_tbl['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $t1=mysqli_num_rows($sql_tbl1);
//echo $row_tbl1[0];
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_class=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_tbl_sub['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_tbl_sub['lotldg_trid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$varchk=$row_crop['cropname']."-"."Coded";
$varchk2=$row_crop['cropname']."-"."Unidentified";
$varty="";
if($row_tbl_sub['lotldg_variety']!=$varchk && $row_tbl_sub['lotldg_variety']!=$varchk2)
{		
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_veriety);
	$varty=$row_variety['popularname'];
}
else
{
$varty=$row_tbl_sub['lotldg_variety'];
}



$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$bid."' and whid='".$wid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];

 	$tdate=$row_tbl_sub['lotldg_qctestdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
if($tdate == "00-00-0000")
$tdate="";
if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
		<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="77" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
		<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="158" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>		 
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_got1'];?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="77" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
		<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="158" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>	 
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_got1'];?></td>
 </tr> 
<?php
}
$srno++;
}
}
}
?>  			  
</table><br />
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="17">
<td align="center"  valign="middle" class="tblheading" colspan="2">Stage: Pack</td>
</tr>
<tr class="Dark" height="30">
<td width="401" align="left"  valign="middle" class="tblheading">&nbsp;Bin Card</td>
<td width="399" align="right"  valign="middle" class="tblheading">SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>&nbsp;</td>
</tr>

</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#e48324" style="border-collapse:collapse">
			 
			<tr class="tblsubtitle">
			  <td width="21" height="18" align="center" valign="middle" class="tblheading">#</td>
			  <td width="77" align="center" valign="middle" class="tblheading">Sub Bin</td>
			  <td width="112" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="75" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="158" align="center" valign="middle" class="tblheading">Lot Number</td>
			  <td width="56" align="center" valign="middle" class="tblheading">UPS</td>
			  <td width="56" align="center" valign="middle" class="tblheading">NoP</td>
			  <td width="56" align="center" valign="middle" class="tblheading">NoMP</td>
              <td width="86" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="86" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="100" align="center" valign="middle" class="tblheading">QC status</td>
			  <td width="95" align="center" valign="middle" class="tblheading">Moist %</td>
			  <td width="100" align="center" valign="middle" class="tblheading">DoT</td>
              <td width="100" align="center" valign="middle" class="tblheading">GOT Status</td>     
          </tr>
<?php
$srno=1;
$sql_tbl=mysqli_query($link,"select subbinid, lotldg_variety, lotldg_crop, lotno from tbl_lot_ldg_pack where whid='".$wid."' and binid='".$bid."' and plantcode='$plantcode' group by subbinid, lotldg_variety, lotno order by subbinid") or die(mysqli_error($link));  
//echo $t=mysqli_num_rows($sql_tbl);
while($row_tbl=mysqli_fetch_array($sql_tbl))
{

$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where whid='".$wid."' and binid='".$bid."' and subbinid='".$row_tbl['subbinid']."' and lotldg_variety='".$row_tbl['lotldg_variety']."' and lotldg_crop='".$row_tbl['lotldg_crop']."'  and lotno='".$row_tbl['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $t1=mysqli_num_rows($sql_tbl1);
//echo $row_tbl1[0];
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_class=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_tbl_sub['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_tbl_sub['lotldg_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$varchk=$row_crop['cropname']."-"."Coded";
$varchk2=$row_crop['cropname']."-"."Unidentified";
$varty="";
if($row_tbl_sub['lotldg_variety']!=$varchk && $row_tbl_sub['lotldg_variety']!=$varchk2)
{		
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_veriety);
	$varty=$row_variety['popularname'];
}
else
{
$varty=$row_tbl_sub['lotldg_variety'];
}



$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['subbinid']."' and binid='".$bid."' and whid='".$wid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

$slups=0; $slqty=0;
$slups=$row_tbl_sub['balnomp'];
$slqty=$row_tbl_sub['balqty'];
$slnop=$row_tbl_sub['balnop'];

 	$tdate=$row_tbl_sub['lotldg_qctestdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
if($tdate == "00-00-0000")
$tdate="";
if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
		<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="77" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
		<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="158" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['packtype'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slnop;?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>		 
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_got1'];?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="77" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
		<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="158" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['packtype'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slnop;?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>	 
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_got1'];?></td>
 </tr> 
<?php
}
$srno++;
}
}
}
?> 			  
          </table>
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn"  style="cursor:pointer" />&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
