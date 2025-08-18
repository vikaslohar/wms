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
	
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	
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
<title>Order - Report - Release Order Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-orrelrep.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php 
	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
		
	$tdate2=explode("-",$edate);
	$edate=$tdate2[2]."-".$tdate2[1]."-".$tdate2[0];
		
$sql_arr_home=mysqli_query($link,"select * from tbl_orderrelease where plantcode='$plantcode' and orel_date<='$edate' and orel_date>='$sdate' and orel_flg=1 order by orel_date asc ") or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
 <tr height="25">
    <td valign="middle" align="center" class="subheading" style="color:#303918; ">Release Order Report </td>
  </tr>
   <td valign="middle" align="center" class="subheading" style="color:#303918; ">Period From: <?php echo $_GET['sdate'];?> To: <?php echo $_GET['edate'];?></td>
  </tr>
</table><br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td width="31"align="center" valign="middle" class="tblheading">#</td> 
	<td width="72" align="center" valign="middle" class="tblheading">Date</td>
    <td width="91" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="299" align="center" valign="middle" class="tblheading">Party Name</td>
	<td align="center" valign="middle" class="tblheading">Order Release Type</td>
    <td align="center" valign="middle" class="tblheading">Current Order Status</td>
	
</tr>

<?php
$srno=1; 
if($tot_arr_home > 0)
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orel_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['orel_logid'];
	$arrival_id=$row_arr_home['orel_ordermid'];
	$oid=$row_arr_home['orel_id'];
	$orreltyp=$row_arr_home['orel_type'];
	
	$orno=""; $party=""; 
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='$arrival_id'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl_sub['orderm_party']."'"); 
	$totpr=mysqli_num_rows($quer3);
	$row3=mysqli_fetch_array($quer3);
	
	$orno=$row_tbl_sub['orderm_porderno'];
	if($totpr > 0)
	$party=$row3['business_name'];
	else
	$party=$row_tbl_sub['orderm_partyname'];
	
	$balqty=0; $qt=0; $rqt=0; $bqt=0;
	$sql_tblsub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbl_tot=mysqli_num_rows($sql_tblsub);
	while($row_tblsub=mysqli_fetch_array($sql_tblsub))
	{
		$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
		while($row_sloc=mysqli_fetch_array($sql_sloc))
		{
			$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
			if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
			$qt=$qt+$qt1;
			
			$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where orelsub_ordermsubsubid='".$row_sloc['order_sub_sub_id']."' and orel_id='$oid'")or die(mysqli_error($link));
			$tot_orrelss=mysqli_num_rows($sql_orrelss);
			$row_orrelss=mysqli_fetch_array($sql_orrelss);
			
			$rqt=$rqt+$row_orrelss['orelsubsub_relqty'];
			$bqt=$bqt+($row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty']);
		}
	
	}
	 $extqty=$qt; 
	 $relqty=$rqt; 
	 $balqty=$bqt;
	 if($balqty>0) {$status="Balance";}
	 else { $status="Complete"; }
	 
if($srno%2!=0)
{
	
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $orno?></td>
    <td width="299" align="center" valign="middle" class="tblheading"><?php echo $party?></td>
	<td width="126" align="center" valign="middle" class="tblheading"><?php echo $orreltyp?></td>
    <td width="126" align="center" valign="middle" class="tblheading"><?php echo $status?></td>
	
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $orno?></td>
    <td width="299" align="center" valign="middle" class="tblheading"><?php echo $party?></td>
	<td width="126" align="center" valign="middle" class="tblheading"><?php echo $orreltyp?></td>
    <td width="126" align="center" valign="middle" class="tblheading"><?php echo $status?></td>
	
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
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-orrelrep.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>