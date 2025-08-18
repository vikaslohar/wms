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
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$pid."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$row_arr_home=mysqli_fetch_array($sql_tbl_sub);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Transaction - Sales Return Old Lot to New Lot Note</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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
	
$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);	
?>
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Sales Return Old Lot to New Lot Note (SRLCN)</font></td>
</tr>
</table><br style="line-height:5px" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="204" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="209"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="107" align="right" valign="middle" class="tblheading">&nbsp;SRN No.&nbsp;</td>
<td width="220" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SRN"."/".$yearid_id."/".sprintf("%00005d",$row_tbl['salesr_slrno']);?></td>
</tr>

<tr class="Light" height="30">
<td width="204" align="right" valign="middle" class="tblheading">Party DC Date&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">Party DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcno'];?></td>
</tr>
<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['salesr_partytype'];?></td>
</tr>-->

</table>
<!--<div id="selectpartylocation"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{	
$sql_month=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['salesr_state']."' and productionlocationid='".$row_tbl['salesr_loc']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?><table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_loc'];?></td>
</tr>
</table>
<?php
}
?>
</div>	-->	   
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >   
 <tr class="Light" height="30">
<td width="205"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?></td>
	</tr>

<tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?></div></td>
</tr>
</table>
</div>	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e"  > 

<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Packages&nbsp;</td>
<td width="275" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcnop'];?></td>

<td width="121" align="right"  valign="middle" class="tblheading">Type of Packages&nbsp;</td>
<td width="239" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_packtyp'];?></td>
</tr>
<tr class="Light" height="25">
<td width="205" align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['salesr_tmode'];?></td>
</tr>-->
</table>
<!--
<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Transport") echo "block"; else echo "none";?>" > 
<tr class="Light" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_tname'];?></td>
<td width="110" align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">Lorry Receipt No&nbsp;</td>
<td align="left" width="214" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="211" valign="middle" class="tbltext"  style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pmode'];?>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Courier") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="211" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_cname'];?></td>
<td align="right" width="110" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="214" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_docket'];?></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="By Hand") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Name of Person&nbsp;</td>
<td width="539" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pname'];?></td>
</tr>

</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse"  > 
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
<td width="211" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_dnop'];?></td>
<td width="110" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1'];?></td>
<td width="214" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1']-$row_tbl['salesr_dnop'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags&nbsp;</td>
<td width="211" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_nob'];?></td>
<td width="110" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1'];?></td>
<td width="214" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1']-$row_tbl['salesr_nob'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Total Packages&nbsp;</td>
<td width="211" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_tnop'];?></td>
<td width="110" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1'];?></td>
<td width="214" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1']-$row_tbl['salesr_tnop'];?></td>
</tr>
</table>-->
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#a8a09e" style="border-collapse:collapse">
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
	<td width="38" align="center" valign="middle" class="smalltblheading"  rowspan="2">#</td>
	<td width="149" align="center" valign="middle" class="smalltblheading"  rowspan="2">Crop</td>
	<td width="198" align="center" valign="middle" class="smalltblheading"  rowspan="2">Variety</td>
	<td width="184" align="center" valign="middle" class="smalltblheading"  rowspan="2">Old Lot No.</td>
	<td width="169" align="center" valign="middle" class="smalltblheading"  rowspan="2">New Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Actual Good</td>
	<!--<td width="51" align="center" valign="middle" class="smalltblheading" rowspan="2">Old Lot No.</td>
	<td width="52" align="center" valign="middle" class="smalltblheading" rowspan="2">New Lot No.</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="4">As per DC</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Actual Good</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Actual Damage</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Ex.(+) / Sh.(-)</td>-->
	
	<td width="117" align="center" valign="middle" class="smalltblheading" rowspan="2">SLOC</td>
	<!--<td width="26" align="center" valign="middle" class="smalltblheading" rowspan="2">Edit</td>
	<td width="45" align="center" valign="middle" class="smalltblheading" rowspan="2">Delete</td>-->
</tr>
<tr class="tblsubtitle" height="20">
	<!--<td width="75" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="35" align="center" valign="middle" class="smalltblheading">Type</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="40" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>-->
	<td width="40" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
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

if($row_tbl_sub['salesrs_upstype']=="Standard")
$upstyp="ST";
if($row_tbl_sub['salesrs_upstype']=="Non-Standard")
$upstyp="NST";
else
$upstyp="ST";

$tdate1=$row_tbl_sub['salesrs_dov'];
$tyear1=substr($tdate1,0,4);
$tmonth1=substr($tdate1,5,2);
$tday1=substr($tdate1,8,2);
$dov=$tday1."-".$tmonth1."-".$tyear1;

$nob=0; $qty=0;

$diq2=explode(".",$row_tbl_sub['salesrs_qtydc']);
if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_tbl_sub['salesrs_qtydc'];}
$din2=explode(".",$row_tbl_sub['salesrs_nobdc']);
if($din2[1]==000){$difn2=$din2[0];}else{$difn2=$row_tbl_sub['salesrs_nobdc'];}

$diq3=explode(".",$row_tbl_sub['salesrs_qtydamage']);
if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_tbl_sub['salesrs_qtydamage'];}
$din3=explode(".",$row_tbl_sub['salesrs_nobdamage']);
if($din3[1]==000){$difn3=$din3[0];}else{$difn3=$row_tbl_sub['salesrs_nobdamage'];}

$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];

$zzz2=implode(",", str_split($row_tbl_sub['salesrs_newlot']));
$newlotno=$zzz2[0].$zzz2[2].$zzz2[4].$zzz2[6].$zzz2[8].$zzz2[10].$zzz2[12].$zzz2[14].$zzz2[16].$zzz2[18].$zzz2[20].$zzz2[22].$zzz2[24].$zzz2[26].$zzz2[28].$zzz2[30];
$newlotno=$row_tbl_sub['salesrs_newlot'];
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="38" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $newlotno;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upstyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn2;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq2;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $difn3;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq3;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo ($row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage'])-$nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo ($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;?></td>
	<td align="center" valign="middle" class="smalltbltext">UT</td>-->
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
    <td width="38" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $newlotno;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upstyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn2;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq2;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $difn3;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq3;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo ($row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage'])-$nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo ($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;?></td>
	<td align="center" valign="middle" class="smalltbltext">UT</td>-->
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_remarks'];?></td>
</tr>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
