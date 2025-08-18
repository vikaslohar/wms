<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
	 $ddate = $_REQUEST['ddate'];
	 $sftyp = $_REQUEST['sftyp'];
	 $itemid = $_REQUEST['txtcrop'];
	 $vv = $_REQUEST['txtvariety'];
	 
	if(isset($_POST['frm_action'])=='submit')
	{
	}

?>

<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<?php 

if($sftyp=="periodical")
{	 
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
	
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 order by softr_date asc ") or die(mysqli_error($link));
}
else
{		
		$tdate=$ddate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$ddate=$tyear."-".$tmonth."-".$tday;
	
	$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 order by softr_date asc ") or die(mysqli_error($link));
}
$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$var=$row_dept4['popularname'];


$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
$row_dept4=mysqli_fetch_array($quer4);
?>
<title>QC Manager-Report-Soft Release Report</title><table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="650" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Soft Release Report</td>
  	</tr>
<?php
if($sftyp=="periodical")
{
?>
<tr height="25">
<td align="center" class="subheading" style="color:#303918; " colspan="2" >Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
</tr>  
<?php
}
else
{
?>
<tr height="25">
<td align="center" class="subheading" style="color:#303918; " colspan="2">As on Date: <?php echo $_GET['ddate'];?></td>
</tr> 
<?php
}
?>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $var;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="6%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="19%" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="12%" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="12%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="15%" align="center" valign="middle" class="tblheading">SR Date</td>
              <td width="18%" align="center" valign="middle" class="tblheading">SR Status</td>
              <td width="18%" align="center" valign="middle" class="tblheading">Remarks</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['softr_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['softr_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $type=""; $remarks="";
	
if($sftyp=="periodical")
{	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$arrival_id."'") or die(mysqli_error($link));
}
else
{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$arrival_id."' and softrsub_srflg='1'") or die(mysqli_error($link));
}	
$subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$totqty=0; $totnob=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and lotldg_balqty > 0") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
}
}

$aq=explode(".",$totqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$totqty;}

$an=explode(".",$totnob);
if($an[1]==000){$acn=$an[0];}else{$acn=$totnob;}

		$lotno=$row_tbl_sub['softrsub_lotno'];
		$type=$row_tbl_sub['softrsub_srtyp'];
		$bags=$acn;
		$qty=$ac;
if($sftyp=="periodical")
{
	if($row_tbl_sub['softrsub_srflg']==0)
	$remarks="Completed";
	else
	$remarks="In Progress";
}
else
{
$remarks="In Progress";
}	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="19%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $type?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $remarks?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="19%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $type?></td>
         <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $remarks?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
else
{
?>
<tr class="Dark">
         <td align="center" valign="middle" class="tblheading" colspan="7">Record not found.</td>
</tr>
<?php
}
?>
          </table>			
  <br/>
<table width="650" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>