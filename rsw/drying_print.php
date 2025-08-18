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
		 if(isset($_REQUEST['txtcrop']))
	{
	$txtcrop= $_REQUEST['txtcrop'];	 
	}
	if(isset($_REQUEST['txtvariety']))
	{
	$txtvariety = $_REQUEST['txtvariety'];	 
	}
	if(isset($_REQUEST['txtdrefno']))
	{
	$refno = $_REQUEST['txtdrefno'];	 
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
<title>RSW - Transaction-Drying Slip</title>
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
<script language='javascript'>

	
			</script>
</head>
<body topmargin="0" >
<?php  
/*$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$itmid."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$sql1=mysqli_query($link,"select * from tblarr_sloc where item_id='".$itmid."' order by whid")or die(mysqli_error($link));*/
?>
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <?php
 $tid=$itmid;

 
$sql_tbl=mysqli_query($link,"select * from tbl_drying where  trid='".$tid."' and stage='RSW' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
// $total_tbl=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;?>
	

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Drying   Preview</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TQS".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="269" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="179" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['variety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>

<td align="right"  valign="middle" class="tblheading">Variety�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $rowvv['popularname'];?></td>
 </tr>
 <tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">Drying slip reference No.�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['drefno'];?></td>
 </tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#e48324" style="border-collapse:collapse">

 
<tr class="tblsubtitle" height="20">
    <td width="43" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
    <td width="112" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
    <td align="center" valign="middle" class="tblheading"  colspan="2">Before Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">Damage Loss </td>
    </tr>
  <tr class="tblsubtitle">
    <td width="100" align="center" valign="middle" class="tblheading" >NoB</td>
    <td width="130" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="77" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="109" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="77" align="center" valign="middle" class="tblheading">%</td>
  </tr>
  <?php
 
$srno=1;
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adqty'];?></td>
        </tr>
  <?php
}
else
{
?>
    <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adqty'];?></td>
        </tr>
  <?php
}
$srno++;
}
}

?>
</table><br />



<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
