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

	if(isset($_REQUEST['slid']))
	{
	$slid = $_REQUEST['slid'];
	}
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
	if(isset($_REQUEST['lid']))
	{
	$lid = $_REQUEST['lid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw - Transaction - Sloc details</title>
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
<?php  
//$sql_main=mysqli_query($link,"select * from tblarr_sloc where subbin='".$slid."' and whid='".$wid."' and binid='".$bid."' group by item_id")or die(mysqli_error($link));
$sql_main123=mysqli_query($link,"select lotldg_crop, lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$lid."'") or die(mysqli_error($link));  
$row_tbl123=mysqli_fetch_array($sql_main123);
$crop=$row_tbl123['lotldg_crop'];
$vid=$row_tbl123['lotldg_variety'];

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl123['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl123['lotldg_variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);

$sql_main=mysqli_query($link,"select lotldg_subbinid, lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' and lotldg_whid='".$wid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$slid."' group by lotldg_subbinid, lotldg_variety order by lotldg_subbinid") or die(mysqli_error($link));  

$t=mysqli_num_rows($sql_main);
?>
  
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$wid."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$bid."' and whid='".$wid."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$slid."' and binid='".$bid."' and whid='".$wid."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
?>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;Sub-Bin Card</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $row_subbinn['sname'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;Crop:&nbsp;&nbsp;<?php echo $row31['cropname'];?></td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;Variety:&nbsp;&nbsp;<?php echo $rowvv['popularname'];;?></td>
</tr>

</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#0BC5F4" style="border-collapse:collapse">
			 
			<tr class="tblsubtitle">
			  <td width="5%" align="center" valign="middle" class="tblheading">#</td>
			  <td width="22%" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="6%" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="10%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Moist%</td>
					<td width="7%" align="center" valign="middle" class="tblheading">Germ%</td>
                    <td width="16%" align="center" valign="middle" class="tblheading">Quality Status </td>
                    <td width="15%" align="center" valign="middle" class="tblheading">GOT Status</td>
                    <td width="12%" align="center" valign="middle" class="tblheading">Seed Status</td>
		  </tr>
<?php
$srno=1;
while($row_tbl=mysqli_fetch_array($sql_main))
{
//echo $row_tbl['lotldg_crop'];
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_whid='".$wid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$slid."'  and lotldg_variety='".$vid."' and lotldg_crop='".$crop."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
$t1=mysqli_num_rows($sql_tbl1);
//echo $row_tbl1[0];
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_class=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_id='".$row_tbl_sub['lotldg_trid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$row_tbl_sub['lotldg_trid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$bid."' and whid='".$wid."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];

$g=explode(" ", $row_item['lotldg_got1']);
$got=$g[0].$row_item['lotldg_got'];
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="22%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balqty'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
 		     <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_gemp'];?></td>
 		     <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
             <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstatus'];?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="22%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balbags'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_balqty'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
 		     <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_gemp'];?></td>
 		     <td width="16%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
             <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstatus'];?></td>
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
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
