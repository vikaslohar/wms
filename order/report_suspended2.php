<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$txtduration=$_REQUEST['txtduration'];
	$txtordtyp=$_REQUEST['txtordtyp'];
	
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
<title>Order - Report - Suspended Order Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-suspended.php?txtduration=<?php echo $txtduration?>&txtordtyp=<?php echo $txtordtyp?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php 
$sql="select * from tbl_orderm where plantcode='$plantcode' and orderm_supflag=1";	
if($txtduration !="ALL")
{
	$trdate=date("Y-m-d");
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;
	
	$m=$trmonth;
	$de=$trday;
	$y=$tryear;
	$dt=$txtduration;
	for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y)); }
	
	$sql.=" and orderm_date>='$dt1' and orderm_date<='$trdate' ";	
}
if($txtordtyp !="ALL")
{
	$sql.=" and order_trtype='$txtordtyp' ";	
}	 

$sql.="  order by orderm_date asc";	
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
  <tr height="25">
    <td valign="middle" align="center" class="subheading" style="color:#303918; ">Suspended Order Report - As on Date <?php echo date("d-m-Y");?></td>
  </tr>
</table><br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td width="40"align="center" valign="middle" class="tblheading">#</td> 
	<td width="92" align="center" valign="middle" class="tblheading">Order Date</td>
    <td width="114" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="150" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="329" align="center" valign="middle" class="tblheading">Party Name</td>
	<td align="center" valign="middle" class="tblheading">Order Details</td>
</tr>

<?php
$srno=1; 
if($tot_arr_home > 0)
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	
	$orno=""; $party="";  $orltype="";
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party'] > 0)
	$party=$row3['business_name'];
	else
	$party=$row_arr_home['orderm_partyname'];
	
	$orno=$row_arr_home['orderm_porderno'];
	$orltype=$row_arr_home['order_trtype'];
	if($orltype=="Order TDF" && $row_arr_home['orderm_partyselect']=="fillp")
	$orltype=$row_arr_home['order_trtype']." - TDF";
	else
	$orltype=$row_arr_home['order_trtype']." - ".$row_arr_home['orderm_party_type'];
if($srno%2!=0)
{
	
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="114" align="center" valign="middle" class="tblheading"><?php echo $orno?></td>
	<td width="150" align="center" valign="middle" class="tblheading"><?php echo $orltype?></td>
    <td width="329" align="center" valign="middle" class="tblheading"><?php echo $party?></td>
	<td width="111" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $arrival_id;?>');">Details</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="114" align="center" valign="middle" class="tblheading"><?php echo $orno?></td>
	<td width="150" align="center" valign="middle" class="tblheading"><?php echo $orltype?></td>
    <td width="329" align="center" valign="middle" class="tblheading"><?php echo $party?></td>
	<td width="111" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $arrival_id;?>');">Details</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
else
{
?>
<tr height="25"><td height="19" colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
<?php
}
?>
</table>

<br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-suspended.php?txtduration=<?php echo $txtduration?>&txtordtyp=<?php echo $txtordtyp?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>