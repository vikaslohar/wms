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
<title>Arrival - Transaction - Opening Stock</title>
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
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_opspa where arr_role='".$logid."' and opspa_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['opspa_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_opspa_sub where opspa_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

	$tdate=$row_tbl['opspa_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Opening Stock - Condition Seed (Lots-listed in application)</td>
</tr>

 <tr class="Dark" height="30">
<td width="182" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TOP".$row_tbl['opspa_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="133" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="191" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">
    <?php
$sql_tbl=mysqli_query($link,"select * from tbl_opspa where arr_role='".$logid."' and opspa_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['opspa_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_opspa_sub where opspa_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
				<td width="32" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			    <td width="104" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
			    <td width="117" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="70" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="56" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
				<td width="53" rowspan="2" align="center" valign="middle" class="tblheading">Arrival Qty</td>
				<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Raw Seed Qty</td>
				<td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Difference Qty</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Condition Seed</td>
				<td width="95" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
                <td width="66" rowspan="2" align="center" valign="middle" class="tblheading">Difference in Seed Stock</td>
			    </tr>
<tr class="tblsubtitle" height="20">
  <td width="60" align="center" valign="middle" class="tblheading">NoB</td>
  <td width="47" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
$srno=1; $itmdchk="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.",".$row_tbl_sub['orlot'];
	}
	else
	{
		$itmdchk=$row_tbl_sub['orlot'];
	}


$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tbl_opspasub_sub where opspa_id='".$arrival_id."' and opspasub_id='".$row_tbl_sub['opspasub_id']."' order by opspasubsub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['nob']; 
$slqty=$slqty+$row_sloc['qty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['crop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['variety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['arrival_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['rsw_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_nob'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_qty'];?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_seed_stock'];?></td>
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['crop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['variety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['arrival_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['rsw_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_nob'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_qty'];?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_seed_stock'];?></td>
    </tr>
  <?php
}
$srno++;
}
}

?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
