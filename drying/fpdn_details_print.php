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
<title>Drying- Transaction- Arrival From Fresh Seed</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
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
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arr_role='".$logid."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
		
	$tdate2=$row_tbl['disp_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;


?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN</td>
</tr>

 <tr class="Dark" height="30">
<td width="182" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAF".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="133" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="191" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Type of Arrival&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;Fresh Seed Arrival with PDN</td>
	<td align="right"  valign="middle" class="tblheading"> Dispatch Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>
          </tr>
		   <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="182" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="133" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="182" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="234" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="182" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="234" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="133" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="182" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arr_role='".$logid."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
    <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="31" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="48" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="42" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="44" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
	<td width="65" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
	<td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC </td>
  	<td width="40" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
	<td width="40" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status </td>
	<td width="40" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td width="77" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    </tr>
 
<tr class="tblsubtitle">
    <td width="32" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="36" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="33" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="43" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="42" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="45" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="54" align="center" valign="middle" class="tblheading">Moist %</td>
    <td width="37" align="center" valign="middle" class="tblheading">PP</td>
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
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NACC";
}
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
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	  <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
  
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
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
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
  
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
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
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
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
