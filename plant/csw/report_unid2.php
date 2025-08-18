<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
	echo '</script>';
	}
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
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
	$edate=date("Y-m-d");
	
	$qry="select * from tbl_lot_ldg where lotldg_sstage='Condition' and lotldg_trtype='Unidentified' and lotldg_trdate<='$edate' and plantcode='$plantcode'";	
  
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
<title>RSW-Report-Unidentified Condition Seed Report</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-unid2.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 <table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
	    <tr >
	        <td align="center" class="subheading" style="color:#303918; ">Unidentified Condition Seed Report - As on Date: <?php echo date("d-m-Y");?></td>
	    </tr></table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
   
  <tr class="tblsubtitle" height="25">
    <td width="17" align="center" valign="middle" class="tblheading">#</td>
    <td width="63"  align="center" valign="middle" class="tblheading">Date of Arrival</td>
    <td width="63"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="43"  align="center" valign="middle" class="tblheading">Lot Number</td>
    <td width="37"  align="center" valign="middle" class="tblheading">NoB</td>
    <td width="30"  align="center" valign="middle" class="tblheading">Qty</td>
    <td width="61"  align="center" valign="middle" class="tblheading">QC status</td>
    <td width="104"  align="center" valign="middle" class="tblheading">GOT Status</td>
    </tr>
  <?php
$srno=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_arr_home['lotldg_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id ='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
		 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";
$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$acn=$aq[0];}else{$acn=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$ac=$an[0];}else{$ac=$row_tbl_sub['lotldg_balqty'];}

		//$row_tbl_sub['lotldg_crop'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['lotldg_crop']."' order by popularname Asc"); 

$rowvv=mysqli_fetch_array($quer4);

   $crop=$row31['cropname'];
	$variety=$crop."-Unidentified";
		/*if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotldg_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotldg_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotldg_variety'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotldg_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotldg_lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['lotldg_qc'];
		}
		else
		{
		$qc=$row_tbl_sub['lotldg_qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['lotldg_got1'];
		}
		else
		{
		$got=$row_tbl_sub['lotldg_got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['lotldg_sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['lotldg_got1'];
		}
		else
		{
		$per=$row_tbl_sub['lotldg_got1'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_tbl_sub['lotldg_sstatus'];
		}
		else
		{
		$loc1=$row_tbl_sub['lotldg_sstatus'];
		}
		/*if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}*/
	 //$row_tbl_sub['arrsub_id'];
if($variety==$row_tbl_sub['lotldg_variety'])
{	
	
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td width="104" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
    <!---->
  </tr
>
  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td width="104" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
		          <!---->
  </tr>
  <?php
}
$srno=$srno+1;
}
}
}
?>
</table>
  
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-unid2.php?typ=<?php echo $typ;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
