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
	
	
	if(isset($_REQUEST['txtslwhg1']))
	{
	  $whid = $_REQUEST['txtslwhg1'];
	}
	else
	{
	$whid =1;
	}
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
<table width="850" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">


	 <?php
$sid="ALL";		
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname,binid from tbl_bin where whid='".$whid."' order by binid asc") or die(mysqli_error($link));
 $zx=mysqli_num_rows($sql_binn);
while($row_binn=mysqli_fetch_array($sql_binn))
{
$bid=$row_binn['binid'];

$subbinn="ALL";
	
	
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
 	$sql_tb="select lotldg_subbinid, lotldg_variety, lotldg_crop,lotldg_lotno from tbl_lot_ldg where lotldg_whid='".$whid."' and lotldg_binid='".$bid."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid";  

  $sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
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
	$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
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
?>
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
