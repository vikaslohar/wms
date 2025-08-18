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

	if(isset($_POST['frm_action'])=='submit')
	{
		
	}

?>

<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<title>Order-Report - All Party Consolidated Pending Order Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-party-all.php" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
  <tr height="25">
    <td  width="408" valign="middle" align="center" class="subheading" style="color:#303918; " colspan="3"><U>All Party Consolidated Pending Order Report: <?php echo date("d-m-Y");?></U></td>
  </tr>
</table>
<?php
$aa=" and order_sub_hold_flag=0";
$aa1=" and orderm_holdflag=0";
$date=date("Y-m-d");

$sql_arr_home22=mysqli_query($link,"select distinct order_trtype from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by order_trtype, orderm_date asc ") or die(mysqli_error($link));

$tot_arr_home22=mysqli_num_rows($sql_arr_home22);

if($tot_arr_home22 > 0)
{
while($row_22=mysqli_fetch_array($sql_arr_home22))
{
$sql_arr_home11=mysqli_query($link,"select distinct orderm_party_type from tbl_orderm where plantcode='$plantcode' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
$tot_arr_home11=mysqli_num_rows($sql_arr_home11);
while($row_11=mysqli_fetch_array($sql_arr_home11))
{
if($row_22['order_trtype']=="Order TDF" && $row_11['orderm_party_type']=="")
$ordptyp="TDF";
else
$ordptyp=$row_11['orderm_party_type'];
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
<tr height="25" >  
    <td align="left" class="subheading" style="color:#303918;" colspan="3">Party Type: <?php echo $row_22['order_trtype']." - ".$ordptyp;?></td>
  </tr>
</table>
<?php
if($row_11['orderm_party_type']!="")
{
$sql_arr_home33=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
}
else
{
$sql_arr_home33=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
}
$tot_arr_home33=mysqli_num_rows($sql_arr_home33);
if($tot_arr_home33 > 0)
{
while($row_33=mysqli_fetch_array($sql_arr_home33))
{
if($row_11['orderm_party_type']!="")
{
$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_33['orderm_party']."' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));

$sqlarrhome=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_33['orderm_party']."' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer3=mysqli_query($link,"SELECT p_id, business_name, state FROM tbl_partymaser where p_id='".$row_33['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name']." - ".$row3['state'];
	//$variet1=$row3['pid'];
}
else
{
$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$row_33['orderm_partyname']."' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));

$sqlarrhome=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$row_33['orderm_partyname']."' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

$quer3=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$row_33['orderm_partyname']."' and orderm_party_type='".$row_11['orderm_party_type']."' and order_trtype='".$row_22['order_trtype']."' and orderm_date <= '$date' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));

	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['orderm_partyname']." - ".$row3['orderm_partystate'];
}
if($tot_arr_home > 0)
{ 
	$parortot=0;
	while($rowarrhome=mysqli_fetch_array($sqlarrhome))
	{
		$sqltblsub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$rowarrhome['orderm_id']."' $aa order by order_sub_crop, order_sub_variety") or die(mysqli_error($link));
		$subtbl_tot=mysqli_num_rows($sqltblsub);
		while($rowtblsub=mysqli_fetch_array($sqltblsub))
		{
			$parortot=$parortot+$rowtblsub['order_sub_totbal_qty'];
		}
	}
if($parortot > 0)
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
<tr height="25" >  
    <td align="left" class="subheading" style="color:#303918;" colspan="3">Party Name: <?php echo $partyname;?></td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="69" align="center" valign="middle" class="tblheading">Order No. </td>
			<td width="57" align="center" valign="middle" class="tblheading">Order Date </td>
			<td width="57" align="center" valign="middle" class="tblheading">PO Ref. No.</td>
			<td width="116"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="138"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="95"  align="center" valign="middle" class="tblheading">UPS</td>
			<td width="40"  align="center" valign="middle" class="tblheading">UPS Type</td>
			<td width="40"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="74" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="57" align="center" valign="middle" class="tblheading">Total Ordered Qty </td>
            <td width="57" align="center" valign="middle" class="tblheading">Current Pending Qty</td>
</tr>

<?php
$srno=1; 
$totorqty=0; $totpenqty=0;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
		
		$status=""; $statussub=""; $status1="";
		
		
	$loc1="";
	 $arrival_id=$row_arr_home['orderm_id'];
	if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['orderm_porderno'];
		}
		else
		{
		$loc1=$row_arr_home['orderm_porderno'];
		}
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
			 $s_id=$subtbltot['orderm_id'];
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
    $crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus=""; $upstyp=""; $penqty="";

		$upstyp=$row_tbl_sub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		//$stage=$row_tbl_sub['order_sub_totbal_qty'];
		$dq=explode(".",$row_tbl_sub['order_sub_totbal_qty']);
		if($dq[1]==000){$stage=$dq[0];}else{$stage=$row_tbl_sub['order_sub_totbal_qty'];}
		
		//$totqty=$row_tbl_sub['order_sub_tot_qty'];
		$dq=explode(".",$row_tbl_sub['order_sub_tot_qty']);
		if($dq[1]==000){$totqty=$dq[0];}else{$totqty=$row_tbl_sub['order_sub_tot_qty'];}

		
		$variet=$row_dept4['popularname'];
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['order_sub_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['order_sub_crop'];
		}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['order_sub_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['order_sub_variety'];	
		}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
			


$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";

	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}

	$dq2=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq2[1]==000){$qt2=$dq2[0];}else{$qt2=$row_sloc['order_sub_subbal_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";

	if($penqty!="")
	$penqty=$penqty.$qt2."<br/>";
	else
	$penqty=$qt2."<br/>";
	
	
if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
		}
		else
		{
		$sstatus=$row_sloc['order_sub_sub_nop'];
		}
			if($sstatus==0){
	 
	 $sstatus="";
	 }
	 //$row_tbl_sub['arrsub_id'];
	 }
$porefno=$row_arr_home['orderm_partyrefno'];	 
if($stage > 0)	 
{	 
$totorqty=$totorqty+$totqty; 
$totpenqty=$totpenqty+$stage;	
	if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $porefno?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $upstyp;?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $penqty?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $porefno?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $upstyp;?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $penqty?></td>
</tr>
<?php
}$srno=$srno+1;
}
}
}
//}
if($totpenqty > 0)
{
?>
<tr class="Light" height="25">
	<td align="right" valign="middle" class="tblheading" colspan="9">Total&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $totorqty?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $totpenqty?></td>
</tr>
<?php
}
?>
</table>
<br />

<?php
}
}
}
}
}
}
}
?>
<br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-party-all.php" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
