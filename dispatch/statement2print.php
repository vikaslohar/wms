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
	if(isset($_REQUEST['crop']))
	{
		$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['variety']))
	{
		$variety = $_REQUEST['variety'];
	}
	if(isset($_REQUEST['lotno']))
	{
		$lotno = $_REQUEST['lotno'];
	}
	if(isset($_REQUEST['relno']))
	{
		$relno = $_REQUEST['relno'];
	}
	if(isset($_REQUEST['ups']))
	{
		$ups = $_REQUEST['ups'];
	}
	if(isset($_REQUEST['txtpureseed']))
	{
		$txtpureseed = $_REQUEST['txtpureseed'];
	}
	if(isset($_REQUEST['txtgenp']))
	{
		$txtgenp = $_REQUEST['txtgenp'];
	}
	if(isset($_REQUEST['txtim']))
	{
		$txtim = $_REQUEST['txtim'];
	}
	if(isset($_REQUEST['txtgemp']))
	{
		$txtgemp = $_REQUEST['txtgemp'];
	}
	
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['disp_id'];

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  moznomarginboxes mozdisallowselectionprint>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Statement-II</title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<script>
function post_value()
{
document.form.submit();
}
</script>
<body topmargin="0" >
<?php 
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['disp_id'];

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['disp_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
$tqty=0; $tcnt=0;
$sq3=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  dpss_lotno='$lotno' and disp_id='$tid'") or die(mysqli_error($link));
while($ro3=mysqli_fetch_array($sq3))
{
$tqty=$tqty+$ro3['dpss_qty']; 
$tcnt++;
}


$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$lotno."' and packtype='$ups'")or die("Error:".mysqli_error($link));
$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
$rowmonth3=mysqli_fetch_array($sqlmonth3);

$lbl=explode("-", $rowmonth3['packlabels']);
$label1=$lbl[0];
$label2=$lbl[1];

if($lbl[0]=="" || $lbl[1]=="")
{
	$lbl2=explode(" -- ", $rowmonth3['packlabels']);
	$label1=$lbl2[0];
	$label2=$lbl2[1];
}


$trdate=$rowmonth3['lotldg_dop'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dop=$trday."-".$trmonth."-".$tryear;

$tdate2=$rowmonth3['lotldg_valupto'];
$tyear2=substr($tdate2,0,4);
$tmonth2=substr($tdate2,5,2);
$tday2=substr($tdate2,8,2);
$dov=$tday2."-".$tmonth2."-".$tyear2;

$tdate3=$row_tbl['disp_dodc'];
$tyear3=substr($tdate3,0,4);
$tmonth3=substr($tdate3,5,2);
$tday3=substr($tdate3,8,2);
$dodc=$tday3."-".$tmonth3."-".$tyear3;

$orlot=$rowmonth3['orlot'];
$up=explode(" ",$ups);
$dq=explode(".",$up[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
$ups=$qt1." ".$up[1];
	
?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="form" method="post" action="statement2print.php">
  	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="itmid" value="<?php echo $_REQUEST['itmid'];?>" />
	<input type="hidden" name="crop" value="<?php echo $_REQUEST['crop'];?>" />
	<input type="hidden" name="variety" value="<?php echo $_REQUEST['variety'];?>" />
	<input type="hidden" name="lotno" value="<?php echo $_REQUEST['lotno'];?>" />
	<input type="hidden" name="relno" value="<?php echo $_REQUEST['relno'];?>" />
	<input type="hidden" name="ups" value="<?php echo $_REQUEST['ups'];?>" />
	<br />

<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr  height="20">
  <td colspan="2" align="center" class="Mainheading"><font color="#000000">STATEMENT - II</font></td>
</tr>
</table>

<br />

<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 

<tr class="Light" height="20">
<td align="left" valign="middle" class="smalltblheading" colspan="4"><div style="padding-left:3px"><?php echo $row_param['company_name'];?></div></td>
</tr>
<tr class="Light" height="20">
<td align="left" valign="middle" class="smalltblheading" colspan="4"><div style="padding-left:3px"><?php echo $row_param['plant'];?></div></td>
</tr>
<tr class="Light" height="20">
<td align="right" valign="middle" class="smalltblheading"></td>
<td align="right" valign="middle" class="smalltblheading"></td>
<td width="98" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px">Certificate No.</div></td>
<td width="115" align="left" valign="middle" class="smalltblheading" ><div style="padding-left:3px"><?php echo sprintf("%00005d",$relno);?></div></td>
</tr>
<td align="right" valign="middle" class="smalltblheading"></td>
<td align="right" valign="middle" class="smalltblheading"></td>
<td width="98" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px">Date</div></td>
<td width="115" align="left" valign="middle" class="smalltblheading" ><div style="padding-left:3px"><?php echo $dodc;?></div></td>
</tr>
<tr class="Light" height="20"></tr>
<tr class="Light" height="20">
<td align="left" valign="middle" class="smalltblheading" colspan="4"><div style="padding-left:3px">This is to certify that the seed lot to which this certificate pertains has been produced according to and found to conform the standard prescribed under seeds Act, 1996 and seed Rules, 1968. The original records have been kept properly and will be produced as and when required. The responsibility of seed production tests with us.</div></td>
</tr>
</table><br />

<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;1. Name of seed Distributor</td>
<td align="left" valign="middle" class="smalltblheading" colspan="3"><div style="padding-left:3px"><?php echo $noticia['business_name'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?></div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;2. CROP</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $crop;?></div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;10. Date</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $dop;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;3. VARIETY</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $variety;?></div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;11. Valid upto</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $dov;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;4. Class of Seed</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px">T/L</div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;12. Pure Seed (Min)%</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $txtpureseed;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;5. Lot No.</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $orlot;?></div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;13. Genetic Purity (Min)%</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $txtgenp;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;6. Total Qty of Lot</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $tqty;?> Kgs</div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;14. Inert matter (Max)%</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $txtim;?></div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;7. Packing of Size</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $ups;?></div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;15. Weed seed (Max)</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px">Nil</div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;8. No.of Bags/Cartons.</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $tcnt;?></div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;16. Other crop seeds</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px">Nil</div></td>
</tr>
<tr class="Light" height="35">
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;9. Tag or label issued</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px">From&nbsp;:&nbsp;<?php echo $lbl[0];?>&nbsp;&nbsp;To&nbsp;:&nbsp;<?php echo $lbl[1]; ?></div></td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;17. Germination (Min)%</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $txtgemp;?></div></td>
</tr>
<tr class="Light" height="35">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;</td>
<td width="206" align="left" valign="middle" class="smalltblheading">&nbsp;&nbsp;&nbsp;&nbsp;18. Seed producers Name</td>
<td width="167" align="left" valign="middle" class="smalltblheading"><div style="padding-left:3px"><?php echo $row_param['company_name'];?></div></td>
</tr>

<tr class="Light" height="130">
<td align="left" valign="top" class="smalltblheading" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align="left" valign="top" class="smalltblheading" colspan="2"><br /><br /><br />&nbsp;Signature<br /><br /><br />&nbsp;Designation : Manager<br /><br /><br />&nbsp;Seal</td>
</tr>
</table>	  

<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="cc_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="35" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="35"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
