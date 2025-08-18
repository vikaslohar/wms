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
	if(isset($_REQUEST['subid']))
	{
	$subid = $_REQUEST['subid'];
	}
			
	$sql_code="SELECT MAX(arr_code) FROM tblarrival where plantcode='$plantcode' and yearcode='$yearid_id'and arrival_type='Fresh Seed with PDN' ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Order- Utility-Details</title>
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
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
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_id='".$tid."'") or die(mysqli_error($link));
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
	
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$arrival_id."' and arrsub_id='".$subid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
	
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>
 <table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000"> Order Details</font></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">
  <?php
 $tid=$pid;
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order No.</td>
              <td width="58" align="center" valign="middle" class="tblheading">Order Date</td>
			 <td width="75" align="center" valign="middle" class="tblheading">Order Type</td>
			 <td width="43" align="center" valign="middle" class="tblheading">Party Name</td>
              <td width="48" align="center" valign="middle" class="tblheading">Address</td>
			   <td width="43" align="center" valign="middle" class="tblheading">Consignee to</td>
              <td width="48" align="center" valign="middle" class="tblheading">Trasport Details</td>
		  </tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

	if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?>&nbsp;</td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="75" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	<td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	<td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    
	 </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?>&nbsp;</td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="75" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	<td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	<td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>

	 <?php
}
$srno++;
}
}

?>
  <!--<tr class="Dark" height="30">
    <td width="58" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="20">&nbsp;
        <?php echo $remarks;?></td>
  </tr>
--></table>
<br />
<br />
<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Verified By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>-->
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />--></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
