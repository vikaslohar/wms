<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
	echo '</script>';
	}*/
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	if(isset($_REQUEST['typ']))
	{
	  $typ = $_REQUEST['typ'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
}

?>

<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	//$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['itemid'];
	$loc = $_REQUEST['txtloc'];	
	
	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	 	 
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='$typ' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date desc ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
<title>Arrival: Material Transit Difference Report </title><br/>
<?php if($typ=="Fresh Seed with PDN")
{
?>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-arrival1.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php
}
 if($typ=="Trading")
{
?>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-arrival2.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php
}
 if($typ=="StockTransfer Arrival")
{
?>

<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-arrival3.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php
}
?>	 	 

      <?php
if($tot_arr_home > 0)
{ 
 if($typ=="Fresh Seed with PDN")
{ 
?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
  <tr height="25" >
    <?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; } else{$typ}?>
   <td align="center" class="subheading" style="color:#303918; ">Fresh Seed  Arrival with PDN - Period from <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
    <td width="1%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Date of Arrival</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per PDN</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">As Per Actuals</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Loc.</td>	 
 	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Organiser </td>	 
	<td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Farmer</td>
	</tr>

<tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'and diff !=0  and diff1!=0 and plantcode='$plantcode'") or die(mysqli_error($link));
	 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$dq=explode(".",$row_tbl_sub['qty']);
		if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}
		
		$dn=explode(".",$row_tbl_sub['qty1']);
		if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty1'];}
		
		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		
		$diq=explode(".",$row_tbl_sub['diff']);
		if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}
		//$row_tbl_sub['diff1'];
		
		$din=explode(".",$row_tbl_sub['diff1']);
		if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff1'];}

		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];	
		$lotno=$row_tbl_sub['lotno'];
		$org=$row_tbl_sub['organiser'];
		$far=$row_tbl_sub['farmer'];
		$loc=$row_tbl_sub['ploc'];

	if($srno%2!=0)
	{
?> 
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $loc;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $org;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $far;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $loc;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $org;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $far;?></td>
</tr><?php
}
$srno++;
}
}
?>
</table>	
<?php
}
 if($typ=="Trading")
{ 
?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
  <tr height="25" >
    <?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; } else{$typ}?>
   <td align="center" class="subheading" style="color:#303918; ">Trading Arrival - Period from <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
    <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Date of Arrival</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Vendor</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading"> Variety</td>
    <td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">As Actuals</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 	</tr>

<tr class="tblsubtitle">
  <td width="9%" align="center" valign="middle" class="tblheading">Name</td>
    <td width="9%" align="center" valign="middle" class="tblheading">Variety Name</td>
    <td width="9%" align="center" valign="middle" class="tblheading">Vendor Lot No. </td>
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="5%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'and diff !=0  and diff1!=0 and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$dq=explode(".",$row_tbl_sub['qty']);
		if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}
		
		$dn=explode(".",$row_tbl_sub['qty1']);
		if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty1'];}
		
		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		
		$diq=explode(".",$row_tbl_sub['diff']);
		if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}
		
		$din=explode(".",$row_tbl_sub['diff1']);
		if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff1'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);

		$crop=$row_arr_home['lotcrop'];
		$variety=$row_arr_home['lotvariety'];
		$partyvariety=$row_arr_home['vvariety'];
		$oldlotno=$row_tbl_sub['lotoldlot'];
		$lotno=$row_tbl_sub['lotno'];
		$party=$row_party['business_name'];

	if($srno%2!=0)
	{
?> 
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $partyvariety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $oldlotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $partyvariety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $oldlotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td width="4%" align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
$srno++;
}
}
?>
</table>
<?php
}
 if($typ=="StockTransfer Arrival")
{ 
?> 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
  <tr height="25" >
    <?php  //if($typ=="Fresh Seed with PDN" ) { $typ1="Fresh Seed  Arrival with PDN"; } else{$typ}?>
   <td align="center" class="subheading" style="color:#303918; ">Stock Transfer-Plant - Period from <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
    <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="60" align="center" rowspan="2" valign="middle" class="tblheading">Date of Arrival</td>
		<td width="160" align="center" rowspan="2" valign="middle" class="tblheading">Arrival From Plant</td>
    <td width="73" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="130" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="90" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td width="75" align="center" rowspan="2" valign="middle" class="tblheading">STN No. </td>
	<!--<td width="90" align="center" rowspan="2" valign="middle" class="tblheading">Seed Stage  </td>-->

	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">As Per STN </td>
	<td align="center" valign="middle" class="tblheading" colspan="2">As Actuals</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 	</tr>

<tr class="tblsubtitle">
    <td width="35" height="19" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="40" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="35" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="40" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="35" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="40" align="center" valign="middle" class="tblheading">Qty</td>
	</tr>
<?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'and diff !=0  and diff1!=0 and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

		$dq=explode(".",$row_tbl_sub['qty']);
		if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}
		
		$dn=explode(".",$row_tbl_sub['qty1']);
		if($dn[1]==000){$dcn=$dn[0];}else{$dcn=$row_tbl_sub['qty1'];}
		
		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		
		$diq=explode(".",$row_tbl_sub['diff']);
		if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}
		
		$din=explode(".",$row_tbl_sub['diff1']);
		if($din[1]==000){$difn=$din[0];}else{$difn=$row_tbl_sub['diff1'];}

		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		
		$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);

		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];
		$stnno="STN"."/".$yearid_id."/".$row_arr_home['ncode'];
		$stage=$row_tbl_sub['sstage'];
		$lotno=$row_tbl_sub['lotno'];
		$party=$row_party['business_name'];

	if($srno%2!=0)
	{
?> 
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $stnno;?></td>
	<!--/*<td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>*/-->
	
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $stnno;?></td>
	<!--<td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $party;?></td>-->
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
</tr>
<?php
}
$srno++;
}
}
?>
</table><?php
}
?>

<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?> 		  <br/>
<br/>
<?php if($typ=="Fresh Seed with PDN")
{
?>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-arrival1.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php
}
 if($typ=="Trading")
{
?>

<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-arrival2.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php
}
 if($typ=="StockTransfer Arrival")
{
?>

<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-arrival3.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php
}
?>