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
<title>Arrival -Utility -Lot Query</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>

<body>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="txtlot1" value="<?php echo $txtlot1;?>" />	 
 <?php	
 
$sql_whouse=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and lotno='".$txtlot1."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_tb1=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_id='".$row_whouse['arrival_id']."'")or die(mysqli_error($link));
$sql_tb2=mysqli_fetch_array($sql_tb1);
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;Lot Details:&nbsp;&nbsp;<?php echo $txtlot1;?></td>
</tr>

  </table>
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">

        <tr class="tblsubtitle" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading">#</td>
		   <td width="3%" align="center"  valign="middle" class="tblheading">Crop</td>
           <td width="5%" align="center"  valign="middle" class="tblheading">Variety</td>
          <?php if($sql_tb2['arrival_type']=="Trading") {?>
		  <td width="7%" align="center"  valign="middle" class="tblheading">UPS</td>
		  <?php } ?>
          <td width="7%" align="center"  valign="middle" class="tblheading">Qty</td>
            <td width="6%" align="center" valign="middle" class="tblheading">OrderNo.</td>
            <!--<td width="10%" align="center" valign="middle" class="tblheading">Variety</td>
		 <?php if($sql_tb2['arrival_type']=="Fresh Seed with PDN") {?>
          <td width="9%" align="center" valign="middle" class="tblheading">GI</td>
          <td width="8%" align="center" valign="middle" class="tblheading">Production Location</td>
          <td width="8%" align="center" valign="middle" class="tblheading">Production Personnel</td>
          <td width="7%" align="center" valign="middle" class="tblheading">Organiser</td>
          <td width="7%" align="center" valign="middle" class="tblheading">Farmer</td>
		  <?php } ?>
          <td width="6%" align="center" valign="middle" class="tblheading">Physical Purity</td>
		   <td width="6%" align="center" valign="middle" class="tblheading"> Got Status</td>
		    <td width="9%" align="center" valign="middle" class="tblheading"> Stage</td>
			<td width="9%" align="center" valign="middle" class="tblheading">Moisture %</td>
			<td width="9%" align="center" valign="middle" class="tblheading">Germination %</td>
			<td width="9%" align="center" valign="middle" class="tblheading">Qc Status</td>-->
			
        </tr>

	 <?php

$srno=1;
//$txtlot1;
 $sql_tbl=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and lotno='".$txtlot1."'")or die(mysqli_error($link));

	while($row_arr=mysqli_fetch_array($sql_tbl))
	{
		 $arrival_id=$row_arr['arrival_id'];
		
		 $sql_tbl1=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_id='".$arrival_id."'")or die(mysqli_error($link));
		 $sql_tbl2=mysqli_fetch_array($sql_tbl1);
		// $row_arr['lotcrop'];
		 $arr_type=$sql_tbl2['arrival_type'];

		$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot="";
		
				if($arr_type=="Fresh Seed with PDN")
				{
					$crop=$row_arr['lotcrop'];
					$tp="Fresh Seed with PDN";
					$org=$row_arr['organiser'];
					$far=$row_arr['farmer'];
					$variety=$row_arr['lotvariety'];
					$ploc=$row_arr['ploc'];
					$pper=$row_arr['pper'];
					$stage=$row_arr['sstage'];
					$moist=$row_arr['moisture'];
					$got=$row_arr['got1'];
					$qc=$row_arr['qc'];
					$lotno=$row_arr['lotno'];
					$gi=$row_arr['gi'];
					$vchk=$row_arr['vchk'];
				}
				else if($arr_type=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tbl2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tbl2['lotvariety']."' ") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
		
					$crop=$row_class['cropname'];
					$variety=$row0['popularname'];
					$stage=$sql_tbl2['sstage'];
					$moist=$row_arr['moisture'];
					$got=$row_arr['got1'];
					$qc=$row_arr['qc'];
					$lotno=$row_arr['lotno'];
					$vchk=$row_arr['vchk'];
					$oldlot = $row_arr['lotoldlot'];
				}
				else if($arr_type=="Stocktransfer From Plant")
				{
					$tp="Stocltransfer Arrival";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tbl2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tbl2['lotvariety']."' ") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
		
					$crop=$row_class['cropname'];
					$variety=$row0['popularname'];
					$stage=$sql_tbl2['sstage'];
					$moist=$row_arr['moisture'];
					$got=$row_arr['got1'];
					$qc=$row_arr['qc'];
					$lotno=$row_arr['lotno'];
					$vchk=$row_arr['vchk'];
				}
				else if($arr_type=="Unidentified")
				{
					$tp="Unidentified Arrival" ;
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$sql_tbl2['lotcrop']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					
					$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$sql_tbl2['lotvariety']."' ") or die(mysqli_error($link));
					$row0=mysqli_fetch_array($quer0);
		
					$crop=$row_class['cropname'];
					$variety=$row0['popularname'];
					$stage=$sql_tbl2['sstage'];
					$moist=$row_arr['moisture'];
					$got=$row_arr['got1'];
					$qc=$row_arr['qc'];
					$lotno=$row_arr['lotno'];
					$vchk=$row_arr['vchk'];
				}
				
				else
				{
				$crop=""; $variety=""; $org=""; $far=""; $ploc=""; $pper=""; $gi=""; $lotno=""; $pp=""; $stage=""; $moist=""; $germ=""; $got=""; $qc=""; $tp=""; $vchk=""; $oldlot="";
				}

	$trdate=$sql_tbl2['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
if($srno%2!=0)
{
?>

<tr class="Light" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
		  <?php if($arr_type=="Trading") {?>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
		  <?php } ?>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
    	 <!-- <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		  <?php if($arr_type=="Fresh Seed with PDN") {?>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $gi;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
          <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $pper;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $org;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $far;?></td>
		  <?php } ?>
          <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $vchk?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $got;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $stage;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $moist;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $germ;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $qc;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
		  <?php if($arr_type=="Trading") {?>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
		  <?php } ?>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
    	<!--  <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		  <?php if($arr_type=="Fresh Seed with PDN") {?>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $gi;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
          <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $pper;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $org;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $far;?></td>
		  <?php } ?>
          <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $vchk?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $got;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $stage;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $moist;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $germ;?></td>
		  <td align="center" valign="top" class="tblheading"><?php echo $qc;?></td>-->
			 
</tr>
</table>
<br/>
<?php
}
 $srno++;
}
?>
</form>

		  
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">-->&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
</table>


</body>
</html>
