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
	 $status = $_REQUEST['qcstatus'];
	 
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
	
	if($itemid!="ALL" && $vv!="ALL")
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv=="ALL")
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_crop='".$itemid."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$edate' and softr_date >= '$sdate' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
}
else
{		
		$tdate=$ddate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$ddate=$tyear."-".$tmonth."-".$tday;
	
	if($itemid!="ALL" && $vv!="ALL")
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_crop='".$itemid."' and softr_variety='".$vv."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv=="ALL")
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_crop='".$itemid."' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_date <= '$ddate' and softr_tflg=1 order by softr_crop, softr_variety asc ") or die(mysqli_error($link));
	}
}
$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$var="ALL"; $crp="ALL";
	if($itemid!="ALL")
	{
		$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
		$row_dept=mysqli_fetch_array($quer2);
		$crp=$row_dept['cropname'];
	}
	if($vv!="ALL")
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$var=$row_dept4['popularname'];
	}


$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
$row_dept4=mysqli_fetch_array($quer4);
?>
<title>Report - Soft Release Status Report</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="650" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-report_sfr.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&ddate=<?php echo $_REQUEST['ddate'];?>&txtcrop=<?php echo $_REQUEST['cid'];?>&txtvariety=<?php echo $_REQUEST['itemid'];?>&qcstatus=<?php echo $_REQUEST['status'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Soft Release Status Report</td>
  	</tr>
<?php
if($sftyp=="periodical")
{
?>
<tr height="25">
<td align="center" class="subheading" style="color:#303918; " colspan="3" >Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
</tr>  
<?php
}
else
{
?>
<tr height="25">
<td align="center" class="subheading" style="color:#303918; " colspan="3">As on Date: <?php echo $_GET['ddate'];?></td>
</tr> 
<?php
}
?>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="center" class="subheading" style="color:#303918; ">Variety: <?php echo $var;?></td>
	<td align="right" class="subheading" style="color:#303918; ">QC Status: <?php echo $status;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="13%" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="17%" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="17%" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <!--<td width="10%" align="center" valign="middle" class="tblheading">NoB</td>-->
			  <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Dispatch Qty</td>
              <td width="9%" align="center" valign="middle" class="tblheading">SR Date</td>
              <td width="9%" align="center" valign="middle" class="tblheading">SR Status</td>
              <td width="8%" align="center" valign="middle" class="tblheading">QC Status</td>
			  <td width="9%" align="center" valign="middle" class="tblheading">DoT</td>
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
	
		$sql_crop=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='".$row_arr_home['softr_crop']."'"); 
		$row_crop=mysqli_fetch_array($sql_crop);
		$crop=$row_crop['cropname'];

		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['softr_variety']."' "); 
		$row_var=mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
if($sftyp=="periodical")
{	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$arrival_id."' and softrsub_srflg='1' and softrsub_srtyp!='condition' and  softrsub_srtyp!='raw'") or die(mysqli_error($link));
}
else
{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_softr_sub where softr_id='".$arrival_id."' and softrsub_srflg='1' and softrsub_srtyp!='condition' and  softrsub_srtyp!='raw'") or die(mysqli_error($link));
}	
$subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$totqty=0; $totnob=0; $dqty=0; $qcstatus=""; $dot="";
if($status=="fail")
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 and lotldg_qc='Fail'") or die(mysqli_error($link));
}
else if($status=="ok")
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 and lotldg_qc='OK'") or die(mysqli_error($link));
}
else if($status=="RT/UT")
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 and (lotldg_qc='RT' or lotldg_qc='UT')") or die(mysqli_error($link));
}
else
{
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."'  and balqty > 0 ") or die(mysqli_error($link));
}
$row_issue_num=mysqli_num_rows($sql_issue);
while($row_issue=mysqli_fetch_array($sql_issue))
{ 

if($status=="fail")
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and lotldg_whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and lotldg_qc='Fail'") or die(mysqli_error($link));
}
if($status=="ok")
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and lotldg_qc='OK'") or die(mysqli_error($link));
}
else if($status=="RT/UT")
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."' and (lotldg_qc='RT' or lotldg_qc='UT')") or die(mysqli_error($link));
}
else
{
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_tbl_sub['softrsub_lotno']."'") or die(mysqli_error($link));
}
//$row_issue1_num=mysqli_num_rows($sql_issue1);
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo "select * from tbl_lot_ldg_pack where lotldg_id='".$row_issue1[0]."' and balqty > 0";
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnomp'];
	//if($row_issuetbl['trtype']=="Qty-Rem" || $row_issuetbl['trtype']=="Dispatch" || $row_issuetbl['trtype']=="Dispatch TDF")
	//$dqty=$dqty+$row_issuetbl['tqty']; 
}
}

$sql_dqty=mysqli_query($link,"select * from tbl_lot_ldg_pack where orlot='".$row_tbl_sub['softrsub_lotno']."'") or die(mysqli_error($link));
while($row_dqty=mysqli_fetch_array($sql_dqty))
{
	if($row_dqty['trtype']=="Qty-Rem" || $row_dqty['trtype']=="Dispatch" || $row_dqty['trtype']=="Dispatch TDF")
	$dqty=$dqty+$row_dqty['tqty'];  
}


$sql_is=mysqli_query($link,"select * from tbl_lot_ldg_pack where  orlot='".$row_tbl_sub['softrsub_lotno']."' order by lotdgp_id desc limit 0,1") or die(mysqli_error($link));
$row_is=mysqli_fetch_array($sql_is);
$qcstatus=$row_is['lotldg_qc']; 
$dot=$row_is['lotldg_qctestdate'];

$trdate1=$row_is['lotldg_qctestdate'];
$tryear=substr($trdate1,0,4);
$trmonth=substr($trdate1,5,2);
$trday=substr($trdate1,8,2);
$dot=$trday."-".$trmonth."-".$tryear;

if($qcstatus=="UT")
$dot="";

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
if($row_issue_num>0)
{	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
		 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
         <!--<td width="10%" align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>-->
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $dqty?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $type?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $qcstatus?></td>
		 <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $dot?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
		 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
         <!--<td width="10%" align="center" valign="middle" class="tblheading"><?php echo $bags;?></td>-->
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $dqty?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $type?></td>
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $qcstatus?></td>
		 <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $dot?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
else
{
?>
<tr class="Dark">
         <td align="center" valign="middle" class="tblheading" colspan="10">Record not found.</td>
</tr>
<?php
}
?>
          </table>			
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="650" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-report_sfr.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&ddate=<?php echo $_REQUEST['ddate'];?>&qcstatus=<?php echo $_REQUEST['qcstatus'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>