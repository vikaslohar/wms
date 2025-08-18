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
	$pid = $_REQUEST['itmid'];
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
<title>Sales Return - Transaction</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['salesr_id'];

	$tdate=$row_tbl['salesr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['salesr_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return - Verification</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SR".$row_tbl['salesr_code']."/".$row_tbl['salesr_yearcode']."/".$row_tbl['salesr_logid'];?></td>

<td width="121" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="239" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Party DC Date&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">Party DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcno'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_partytype'];?></td>
<td width="121" align="right"  valign="middle" class="tblheading">SRI No.&nbsp;</td>
<td width="239" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo sprintf("%00005d",$row_tbl['salesr_slrno']);?></td>
</tr>
</table>
<div id="selectpartylocation"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{	
$sql_month=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['salesr_state']."' and productionlocationid='".$row_tbl['salesr_loc']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_state'];?></td>
	<td width="121"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="239" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia['productionlocation'];?></td>
  </tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="639" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_loc'];?></td>
</tr>
</table>
<?php
}
?>
</div>		   
<div id="selectparty"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$row_tbl['salesr_loc']."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$row_tbl['salesr_loc']."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where country='".$c."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
$noticia = mysqli_fetch_array($sql_month);

?>		   
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >   
 <tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="639"  colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['business_name'];?></td>
	</tr>

<tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?></div></td>
</tr>
</table>
</div>	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e"  > 

<!--<tr class="Light" height="30">
<td width="234" align="right"  valign="middle" class="tblheading">No. of Packages&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcnop'];?></td>

<td width="138" align="right"  valign="middle" class="tblheading">Type of Packages&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_packtyp'];?></td>
</tr>-->
<tr class="Light" height="25">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td width="639" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['salesr_tmode'];?></td>
</tr>
</table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Transport") echo "block"; else echo "none";?>" > 
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_tname'];?></td>
<td width="121" align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">Lorry Receipt No&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext"  style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pmode'];?>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Courier") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_cname'];?></td>
<td align="right" width="121" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_docket'];?></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="By Hand") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Name of Person&nbsp;</td>
<td width="639" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pname'];?></td>
</tr>

</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" valign="middle" class="tblheading">Packages</td>
  </tr>
<tr class="Light" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="center"  valign="middle" class="tblheading">As per DC</td>
<td align="center"  valign="middle" class="tblheading">Actual Received</td>
<td align="center"  valign="middle" class="tblheading">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Cartons&nbsp;</td>
<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_dnop'];?></td>
<td width="121" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1'];?></td>
<td width="239" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1']-$row_tbl['salesr_dnop'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags&nbsp;</td>
<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_nob'];?></td>
<td width="121" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1'];?></td>
<td width="239" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1']-$row_tbl['salesr_nob'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Total Packages&nbsp;</td>
<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_tnop'];?></td>
<td width="121" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1'];?></td>
<td width="239" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1']-$row_tbl['salesr_tnop'];?></td>
</tr>
</table>
<?php
$srsloc=""; $wareh=""; $binn=""; $wareh2=""; $binn2="";
if($row_tbl['salesr_nop'] > 0)
{
$sql_whouse=mysqli_query($link,"select perticulars from tblpvwarehouse where plantcode='$plantcode' AND whid='".$row_tbl['salesr_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tblpvbin where plantcode='$plantcode' AND binid='".$row_tbl['salesr_bin']."' and whid='".$row_tbl['salesr_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']." | ".$row_tbl['salesr_nop'];
}
if($row_tbl['salesr_nop1'] > 0)
{
$sql_whouse2=mysqli_query($link,"select perticulars from tblpvwarehouse where plantcode='$plantcode' AND whid='".$row_tbl['salesr_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse2=mysqli_fetch_array($sql_whouse2);
$wareh2=", ".$row_whouse2['perticulars']."/";

$sql_binn2=mysqli_query($link,"select binname from tblpvbin where plantcode='$plantcode' AND binid='".$row_tbl['salesr_bin']."' and whid='".$row_tbl['salesr_wh']."'") or die(mysqli_error($link));
$row_binn2=mysqli_fetch_array($sql_binn2);
$binn2=$row_binn2['binname']." | ".$row_tbl['salesr_nop1'];
}
$srsloc=$wareh.$binn.$wareh2.$binn2;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" >&nbsp;SR-PV SLOC&nbsp;</td>
<td width="639" colspan="8" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $srsloc;?></td>
</tr>

</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Pre Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_typ='verrec'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="123" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="191" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="114" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="124" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="115" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="202" align="center" valign="middle" class="tblheading">Verify</td>
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
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']==0){?><a href="Javascript:void(0);" onclick="showverifysc(<?php echo $row_tbl_sub['salesrs_id'];?>);">Verify</a><?php }else{?>verified<?php }?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']==0){?><a href="Javascript:void(0);" onclick="showverifysc(<?php echo $row_tbl_sub['salesrs_id'];?>);">Verify</a><?php }else{?>verified<?php }?></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_remarks'];?></td>
</tr>
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Post Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_vflg!=0") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="90" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">SR Item Found</td>
	<td width="51" align="center" valign="middle" class="tblheading" rowspan="2">Old Lot No.</td>
	<td width="52" align="center" valign="middle" class="tblheading" rowspan="2">New Lot No.</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">As per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Good</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Damage</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Excess / Shortage</td>
	<td width="36" align="center" valign="middle" class="tblheading" rowspan="2">QCSR</td>
	<td width="117" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
	<!--<td width="26" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
	<td width="45" align="center" valign="middle" class="tblheading" rowspan="2">Delete</td>-->
</tr>
<tr class="tblsubtitle" height="20">
	<td width="59" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="36" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="43" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="41" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="42" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="39" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
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
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
$slocs="";
$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{
	if($row_tbl_sub['salesrs_rettype']=="P2C")
	{
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
	else
	{
		$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
}

$nob=0; $qty=0;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
$xn=$row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage'];
$xnob=$xn-$nob;
$xb=floatval($row_tbl_sub['salesrs_qtydc'])+floatval($row_tbl_sub['salesrs_qtydamage']);
$xqty=floatval($xb)-floatval($qty);
if($xnob==0 && $xqty!=0)$xqty=0;
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_rectyp'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "UT"; else echo ""; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <!--  <td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
  <td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_rectyp'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "UT"; else echo ""; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<!--<td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
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
