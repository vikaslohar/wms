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
		 $itemid = $_REQUEST['txtcrop'];
		 $vv = $_REQUEST['txtvariety'];
	
	 if(isset($_GET['print']))
	{
	 $print = $_GET['print'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
		
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		
}

?>

<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<?php 

$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv = $_REQUEST['txtvariety'];
	
		/*$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;*/
		
			
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
   $quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);


$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv'"); 
$row_dept4=mysqli_fetch_array($quer4);
?>
<title>Arrival-Report-Crop Variety Wiser Stock Transfer report</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $var;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="7%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="10%" align="center" valign="middle" class="tblheading">Date</td>
			  <td width="22%" align="center" valign="middle" class="tblheading">Stock Transfer from Plant</td>
			  <td width="15%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="10%" align="center" valign="middle" class="tblheading">Bags</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Stage</td>
			  <td align="center" valign="middle" class="tblheading">QC Status</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc=$row_tbl_sub['qc'];
	}

		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		
		$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);

		$crop=$row_crop['cropname'];
		$variety=$row_variety['popularname'];
		$stage=$row_arr_home['sstage'];
		$party=$row_party['business_name'];
		
		

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="22%" align="center" valign="middle" class="tblheading"><?php echo $party;?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="22%" align="center" valign="middle" class="tblheading"><?php echo $party;?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
else
{
?>
<tr class="Dark">
         <td align="center" valign="middle" class="tblheading" colspan="9">Record not found.</td>
</tr>
<?php
}
?>
          </table>			
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
