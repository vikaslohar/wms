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
	$baryrcode=$_SESSION['baryrcode'];
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	
	if(isset($_GET['txtlot1']))
	{
    $txtlot1 = $_GET['txtlot1'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW - Utility - Barcode Details</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>

<body>
<table width="550" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  	<form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="txtlot1" value="<?php echo $txtlot1;?>" />	 
	  <br />
<?php
$sql_bar=mysqli_query($link,"Select * from tbl_barcodes where plantcode='$plantcode' and bar_barcode='".$txtlot1."'") or die(mysqli_error($link));
$tot_bar=mysqli_num_rows($sql_bar);
?>
<table align="center" border="1" bordercolor="#477bff" cellspacing="0" cellpadding="0" width="550" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
<td  align="center"  valign="middle" class="tblheading" colspan="2"><font size="+1">Barcode Details</font></td>
</tr>

<tr class="Light" height="20">
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;&nbsp;Barcode:&nbsp;<?php echo $txtlot1;?></td>
<td width="199" align="right"  valign="middle" class="tblheading">Pack Type:&nbsp;Master Pack&nbsp;&nbsp;</td>
</tr>
</table>
<?php
if($tot_bar > 0)
{
while($row_bar=mysqli_fetch_array($sql_bar))
{
$bararr=""; $lotn=""; $crop=""; $variety=""; $lotno=""; $bags=0; $qty=0; $got=""; $qc=""; $moist=""; $gemp=""; $got=""; $sststus=""; $ups=""; $wareh=""; $binn=""; $subbinn=""; $slocs=""; $totqty=0; $totnop=0; $totnomp=0; $wtmp=0; $nopmp=0; $lbls=""; $sts="In-Stock";
$zzz=implode(",", str_split($row_bar['bar_lotno']));
$lotn=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24]."P";

$sql_lot=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotn."'") or die(mysqli_error($link));
$row_lot=mysqli_fetch_array($sql_lot);

$sql_lot2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_lot[0]."'") or die(mysqli_error($link));
$row_lot2=mysqli_fetch_array($sql_lot2);
$bararr=$row_lot2['barcodes'];

$xx=array_values(array_unique(explode(",",$bararr)));
if (($key = array_search($txtlot1, $xx)) !== false) 
{
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_lot2['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$crop=$row31['cropname']; 
	$quer32=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_lot2['lotldg_variety']."' "); 
	$row32=mysqli_fetch_array($quer32);
	$tt=$row32['popularname'];
	$tot32=mysqli_num_rows($quer32);	
	if($tot32==0)
	{
		$vv=$row_lot2['lotldg_variety'];
	}
	else
	{
		$vv=$tt;
	}
	
	$trdate=explode("-",$row_lot2['lotldg_dop']);
	$trdate=$trdate[2]."-".$trdate[1]."-".$trdate[0];
	
	$trdate1=explode("-",$row_lot2['lotldg_valupto']);
	$trdate1=$trdate1[2]."-".$trdate1[1]."-".$trdate1[0];
	
	$trdate2=explode("-",$row_lot2['lotldg_qctestdate']);
	$trdate2=$trdate2[2]."-".$trdate2[1]."-".$trdate2[0];
	
	$trdate3=explode("-",$row_lot2['lotldg_gottestdate']);
	$trdate3=$trdate3[2]."-".$trdate3[1]."-".$trdate3[0];
	
	if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
	if($trdate2=="00-00-0000" || $trdate2=="--")$trdate2="";
	if($trdate3=="00-00-0000" || $trdate3=="--")$trdate3="";
	
	$lotno=$row_lot2['lotno'];
	$qc=$row_lot2['lotldg_qc'];
	$moist=$row_lot2['lotldg_moisture'];
	$gemp=$row_lot2['lotldg_gemp'];
	$got11=explode(" ",$row_lot2['lotldg_got1']);
	$got=$got11[0]." ".$row_lot2['lotldg_got'];
	$sststus=$row_lot2['lotldg_sstatus'];
	$ups=$row_lot2['packtype'];
	$wtmp=$row_bar['bar_wtmp'];
	$lbls=$row_lot2['packlabels'];
	
	
	if($row_lot2['lotldg_srflg'] > 0)
	{
		if($sststus!="")$sststus=$sststus."/"."S";
		else
		$sststus="S";
	}
	if($gemp==0)$gemp=""; 
	$upp=explode(" ", $ups);
	$nopmp=(1000/$upp[0])*$wtmp;
	$upc=floatval($upp[0]);
	$ups=$upc." ".$upp[1];
	$sql_main=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotn."' and lotldg_id = '".$row_lot2['lotldg_id']."'") or die(mysqli_error($link));
	while($row_main=mysqli_fetch_array($sql_main))
	{
		$slnop=0; $slnomp=0; $slqty=0;
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_main['whid']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_main['binid']."' and whid='".$row_main['whid']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_main['subbinid']."' and binid='".$row_main['binid']."' and whid='".$row_main['whid']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$slnop=$row_main['balnop'];
		$slnomp=$row_main['balnomp'];
		$slqty=$row_main['balqty'];
		
		$totnop=$totnop+$slnop; 
		$totnomp=$totnomp+$slnomp;
		$totqty=$totqty+$slqty; 
		
		if($slocs!="")
		$slocs=$slocs."<br/>".$wareh.$binn.$subbinn." | ".$slnop." | ".$slnomp." | ".$slqty;
		else
		$slocs=$wareh.$binn.$subbinn." | ".$slnop." | ".$slnomp." | ".$slqty;
	}
	$aq=explode(".",$totqty);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$totqty;}
	
	$aq=explode(".",$wtmp);
	if($aq[1]==000){$acwt=$aq[0];}else{$acwt=$wtmp;}
	$wtmp=$acwt;
}
}
if($lbls!="" || $lbls!="-")
{
$lbl=explode("-",$lbls);
$lbls=$lbl[0]."   -   ".$lbl[1];
}
else
$lbls="";

if($row_bar['bar_dispflg']>0)$sts="Dispatched";
if($row_bar['bar_unpackflg']>0)$sts="Un-Packed";
?>   
<table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#477bff" style="border-collapse:collapse">
<tr class="Light" height="20">
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;&nbsp;Status:&nbsp;<?php echo $sts;?></td>
</tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Crop&nbsp;&nbsp;</td>
	 <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $crop;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Variety&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $vv;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" height="19" align="right" valign="middle" class="tblheading">Lot Number&nbsp;&nbsp;</td>
	  <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $lotno;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td align="center" valign="middle" class="tblheading" colspan="2">Master Pack Details</td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">UPS&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $ups;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Qty (in MP)&nbsp;&nbsp;</td>
	  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $wtmp;?>&nbsp;Kgs.</td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">NoP (in MP)&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $nopmp;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Gross weight of MP&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;</td>
   </tr>
    <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">DoP&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $trdate;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Valid Upto&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $trdate1;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Lable No(s).  (Range)&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $lbls;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td align="center" valign="middle" class="tblheading" colspan="2">Packing Incidence Details of Lot in PSW</td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">UPS&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $ups;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Total Qty&nbsp;&nbsp;</td>
	  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $ac;?>&nbsp;Kgs.</td>
   </tr>
   
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Total NoP&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $totnop;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Total NoMP&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $totnomp;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td align="center" valign="middle" class="tblheading" colspan="2">Quality Details</td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">QC Status&nbsp;&nbsp;</td>
	  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $qc;?></td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">Germination %&nbsp;&nbsp;</td>
	  <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $gemp;?></td>
   </tr>
   <tr class="Light" height="20">
     <td align="right" valign="middle" class="tblheading">DoT&nbsp;&nbsp;</td>
	 <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $trdate2?></td>
   </tr>
   <tr class="Light" height="20">
     <td align="right" valign="middle" class="tblheading">GOT Status&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $got;?></td>
   </tr>
   <tr class="Light" height="20">
     <td align="right" valign="middle" class="tblheading">DoGT&nbsp;&nbsp;</td>
	 <td align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $trdate3;?></td>
   </tr>
   <tr class="Dark" height="20">
     <td align="center" valign="middle" class="tblheading" colspan="2">SLOC Details</td>
   </tr>
   <tr class="Light" height="20">
     <td width="272" align="right" valign="middle" class="tblheading">SLOC&nbsp;&nbsp;</td>
	 <td width="272" align="left" valign="middle" class="tblheading">&nbsp;&nbsp;<?php echo $slocs;?></td>
   </tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" bordercolor="#477bff" cellspacing="0" cellpadding="0" width="550" style="border-collapse:collapse">
<tr class="light" height="20">
<td  align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;&nbsp;Status: Barcode Not in Record</td>
</tr>
</table>
<?php
}
?>
</form>

		  
<table align="center" width="550" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility_bs.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">&nbsp;--><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table></td><td width="30"></td>
</tr>
</table>


</body>
</html>
