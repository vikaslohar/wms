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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	if(isset($_REQUEST['txtslbing1']))
	{
	 $bid = $_REQUEST['txtslbing1'];
	}
	if(isset($_REQUEST['txtslbing11']))
	{
   $bid1= $_REQUEST['txtslbing11'];
	}
	if(isset($_REQUEST['txtslsubbg1']))
	{
	$sid = $_REQUEST['txtslsubbg1'];
	}
	if(isset($_REQUEST['txtslwhg1']))
	{
	  $whid = $_REQUEST['txtslwhg1'];
	}
	if(isset($_REQUEST['txtslwhg11']))
	{
    $whid1 = $_REQUEST['txtslwhg11'];
	}
	 $txtcrop=trim($_REQUEST['txtcrop']);
 	 $txtvariety=trim($_REQUEST['txtvariety']);
	 $txtstage=trim($_REQUEST['txtstage']);
	 $reptyp=trim($_REQUEST['reptyp']);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival - Utility - SLOC Search</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>
 <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
     <input name="txtslbing1" value="<?php echo $bid?>" type="hidden"> 
     <input name="txtslsubbg1" value="<?php echo $sid;?>" type="hidden"> 
     <input name="txtslwhg1" value="<?php echo $whid;?>" type="hidden"> 
	    <input name="txtslbing11" value="<?php echo $bid1?>" type="hidden"> 
		<input name="txtslwhg11" value="<?php echo $whid1;?>" type="hidden"> 
     <input name="frm_action" value="submit" type="hidden">
<body> 
  <?php
if($reptyp=="lotno")
{ ?>
<table width="850" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">


	 <?php
		
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$bid."' and whid='".$whid."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);


if($sid=='ALL')
{ 
$subbinn="ALL";
}
else
{
$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$sid."' and binid='".$bid."' and whid='".$whid."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
 $subbinn=$row_subbinn['sname'];
}		
	
	
	?>
   <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Search - Bin wise Search</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $subbinn;?></td>
</tr>

  </table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">
  
<tr class="tblsubtitle" height="20">
              <td width="21" height="18" align="center" valign="middle" class="tblheading">#</td>
			 <!-- --><td width="77" align="center" valign="middle" class="tblheading">Sub Bin</td>
			  <td width="112" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="75" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="158" align="center" valign="middle" class="tblheading">Lot Number</td>
			  <td width="56" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="86" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="86" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="95" align="center" valign="middle" class="tblheading">Moist %</td>
			  <td width="100" align="center" valign="middle" class="tblheading">QC</td>
			  <td width="100" align="center" valign="middle" class="tblheading">DoT</td>
              <td width="100" align="center" valign="middle" class="tblheading">GOT Status</td>     
</tr>
<?php
$srno=1;
 // $sid;
if($sid=='ALL')
{ 
 	$sql_tb="select lotldg_subbinid, lotldg_variety, lotldg_crop,lotldg_lotno from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid";  
}
 else
{
	$sql_tb="select lotldg_subbinid, lotldg_variety, lotldg_crop,lotldg_lotno from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$sid."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid";  
 }

  $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
//echo  $T=mysqli_num_rows($sql_qry);
while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_variety='".$row_tbl['lotldg_variety']."' and lotldg_crop='".$row_tbl['lotldg_crop']."'  and lotldg_lotno='".$row_tbl['lotldg_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
  $t1=mysqli_num_rows($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_class=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_tbl_sub['lotldg_trid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_tbl_sub['lotldg_trid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$varchk=$row_crop['cropname']."-"."Coded";
$varchk2=$row_crop['cropname']."-"."Unidentified";
$varty="";
if($row_tbl_sub['lotldg_variety']!=$varchk && $row_tbl_sub['lotldg_variety']!=$varchk2)
{		
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."'and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_veriety);
	$varty=$row_variety['popularname'];
}
else
{
$varty=$row_tbl_sub['lotldg_variety'];
}

$gotr=explode(" ",$row_tbl_sub['lotldg_got1']);
$gotresult=$gotr[0]." ".$row_tbl_sub['lotldg_got'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$bid."' and whid='".$whid."'") or die(mysqli_error($link));
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
		<td width="77" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td><!---->
		<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="158" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>		 
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="21" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="77" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td><!---->
		<td width="112" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="158" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_lotno'];?></td>
		<td width="56" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="86" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_sstage'];?></td>		 
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_qc'];?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
 </tr> 
<?php
}
$srno++;
}
}
}
?> 
</table><br/>	
<?php
}
else if($reptyp=="select")
{	
$sql_arr_home=mysqli_query($link,"select distinct orlot from tbl_lot_ldg where lotldg_crop='$txtcrop' and lotldg_variety='$txtvariety'and  lotldg_sstage='$txtstage' order by lotldg_lotno desc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);


 if($tot_arr_home >0) {  
?>
 <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Search - Product wise Search</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;</td>
</tr>

  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">
  
<tr class="tblsubtitle" height="20">
              <td width="19" height="18" align="center" valign="middle" class="tblheading">#</td>
			<!--  <td width="77" align="center" valign="middle" class="tblheading">Sub Bin</td>-->
			  <td width="81" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="102" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="100" align="center" valign="middle" class="tblheading">Lot Number</td>
			  <td width="37" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="41" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="52" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="49" align="center" valign="middle" class="tblheading">Moist %</td>
			  <td width="37" align="center" valign="middle" class="tblheading">QC</td>
			  <td width="70" align="center" valign="middle" class="tblheading">DoT</td>
              <td width="80" align="center" valign="middle" class="tblheading">GOT Status</td>     
              <td width="156" align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1;
while($row_tbl_sub=mysqli_fetch_array($sql_arr_home))
{

/*$sql_class=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_tbl_sub['lotldg_trid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_tbl_sub['lotldg_trid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);*/
$lotno=$row_tbl_sub['orlot'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$txtcrop."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $slups="";$slqty=0; $slocs=""; $slocs2=""; $srn=1; $ccnntt=0; $varty=""; $stage=""; $qcrsult=""; $gotresult=""; $gemper="";
$sql_qc_sub=mysqli_query($link,"SELECT distinct lotldg_subbinid, lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='".$txtstage."'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='".$txtstage."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{
 $ccnntt++;
$lotno1=$row_month['lotldg_lotno'];
$stage=$row_month['lotldg_sstage']; 
$qcrsult=$row_month['lotldg_qc']; 
$gemper=$row_month['lotldg_gemp'];
$gotr=explode(" ",$row_month['lotldg_got1']);
$gotresult=$gotr[0]." ".$row_month['lotldg_got'];


 $varchk=$row_crop['cropname']."-"."Coded";
 $varchk2=$row_crop['cropname']."-"."Unidentified";

if($row_month['lotldg_variety']!=$varchk && $row_month['lotldg_variety']!=$varchk2)
{		
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_month['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_veriety);
	$varty=$row_variety['popularname'];
}
else
{
$varty=$row_month['lotldg_variety'];
}


	$tdate=$row_month['lotldg_qctestdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
if($tdate == "00-00-0000")
$tdate="";


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_month['lotldg_balbags'];
 $slqty=$slqty+$row_month['lotldg_balqty'];

if($slocs!="")
$slocs=$slocs."<br>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
}
}


if($ccnntt > 0) 	
{
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
		<td width="19" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="81" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="102" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $lotno1;?></td>
		<td width="37" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="41" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>		 
		<td align="center" valign="middle" class="tblheading"><?php echo $gemper;?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $qcrsult;?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="80" align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
        <td width="156" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<td width="19" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="81" align="center" valign="middle" class="tblheading"><?php echo $row_crop['cropname'];?></td>
    	<td width="102" align="center" valign="middle" class="tblheading"><?php echo $varty;?></td>
		<td width="100" align="center" valign="middle" class="tblheading"><?php echo $lotno1;?></td>
		<td width="37" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		<td width="41" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>	
		<td align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>		 
		<td align="center" valign="middle" class="tblheading"><?php echo $gemper;?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $qcrsult;?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
 		<td width="80" align="center" valign="middle" class="tblheading"><?php echo $gotresult;?></td>
        <td width="156" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
</tr> 
<?php
}
$srno++;
}
}
//}
?> 
</table>
<?php
}
}
else
{
?>
<?php
$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid1."' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wh=$row_whouse1['perticulars'];

if($bid1!="ALL")
{
$sql_binn1=mysqli_query($link,"select binname from tbl_bin where binid='".$bid1."' and whid='".$whid1."'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$bin=$row_binn1['binname'];
}
else
{
$bin=$bid1;
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="400" bordercolor="#F1B01E" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;SLOC Search - Empty Bin Search&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse1['perticulars'];?>/<?php echo $bin;?></td>
</tr>
 <?php
 $srno=1;

$cc="Empty";

if($bid1!="ALL")
{

?>
<tr class="tblsubtitle" height="20">
              <!--<td width="200" height="18" align="center" valign="middle" class="tblheading">#</td>-->
			  <td  align="center" valign="middle" class="tblheading">Sub Bin</td>
	    </tr>
<?php
$sql_subbinn2=mysqli_query($link,"select * from tbl_subbin where whid='".$whid1."' and binid='".$bid1."' and status='".$cc."' order by sname") or die(mysqli_error($link));
$T=mysqli_num_rows($sql_subbinn2);
while($row_subbinn2=mysqli_fetch_array($sql_subbinn2))
{
//$row_subbinn2=mysqli_fetch_array($sql_subbinn2);
 
/*	$sql_tb="select lotldg_lotno from tbl_lot_ldg where lotldg_whid='".$whid1."' and lotldg_binid='".$bid1."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid";  */


 /* $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
//
/*while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_whid='".$whid1."' and lotldg_binid='".$bid1."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
  echo $t1=mysqli_num_rows($sql_tbl1);
 $sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));

echo $total_tbl=mysqli_num_rows($sql1);*/
/*if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

*/

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
		<!--<td width="200" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>-->
		<td align="center" valign="middle" class="tblheading"><?php echo $row_subbinn2['sname'];?></td>
	    </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<!--<td width="200" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>-->
		<td align="center" valign="middle" class="tblheading"><?php echo $row_subbinn2['sname'];?></td>
		</tr> 
<?php
}
$srno++;
}

}
else
{
?>
<tr class="tblsubtitle" height="20">
             <!-- <td width="200" height="18" align="center" valign="middle" class="tblheading">#</td>-->
			  <td align="center" valign="middle" class="tblheading">Bin</td>
	    </tr>
<?php
$sql_subbinn111=mysqli_query($link,"select distinct(binid) from tbl_subbin where whid='".$whid1."' group by binid order by binid ") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_subbinn111);

while($rrr=mysqli_fetch_array($sql_subbinn111))
{
$sql_subbinn2=mysqli_query($link,"select * from tbl_subbin where whid='".$whid1."' and binid='".$rrr['binid']."' and status='".$cc."' order by binid") or die(mysqli_error($link));
$T=mysqli_num_rows($sql_subbinn2);
if($T==20)
{
$sql_binn11=mysqli_query($link,"select binname from tbl_bin where binid='".$rrr['binid']."'order by binname") or die(mysqli_error($link));
$row_binn11=mysqli_fetch_array($sql_binn11);
$bin1=$row_binn11['binname'];

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
		<!--<td width="200" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>-->
		<td align="center" valign="middle" class="tblheading"><?php echo $bin1;?></td>
	    </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
		<!--<td width="200" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>-->
		<td align="center" valign="middle" class="tblheading"><?php echo $bin1;?></td>
		</tr> 
<?php
}
$srno++;
}
}
}

}
?> 
</table>
<!-- <table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>-->
<?php
//}

?>       	  
</form>

		  

 <table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="slocreport.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">-->&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
</table>


</body>
</html>
