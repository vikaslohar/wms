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

<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<?php 

$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$vv = $_REQUEST['txtvariety'];
	
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
		
			
	if($vv=="ALL")
	{	
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
	}

 $tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv'  and vertype='PV'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}
?>
<title>Arrival-Report-Crop Variety Wiser Stock Transfer report</title><table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-stcrop.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop  Variety wise StockTransfer Report Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variet;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="19"align="center" valign="middle" class="tblheading" rowspan="2">#</td> 
			<td width="60" align="center" valign="middle" class="tblheading" rowspan="2">Date of Arrival </td>
			<td width="135" align="center" valign="middle" class="tblheading" rowspan="2">Stock Transfer from Plant</td>
			<td width="119" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			<td width="94" align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
            <td width="52" align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
            <td width="62" align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
			<td width="54" align="center" valign="middle" class="tblheading" rowspan="2">Stage</td>
            <td colspan="3" align="center" valign="middle" class="tblheading"> QC</td>
    		<td width="54" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
    		<td width="68"  align="center" valign="middle" class="tblheading" rowspan="2">DoT</td>
    		<td width="43" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
    		<td width="66" align="center" valign="middle" class="tblheading" rowspan="2">DoGR</td>
</tr>

<tr class="tblsubtitle">
			<td width="42" align="center" valign="middle" class="tblheading">PP</td>
			<td width="35" align="center" valign="middle" class="tblheading">Moist %</td>
			<td width="35" align="center" valign="middle" class="tblheading">Germ %</td>
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
	/*and lotcrop='".$itemid."' 
		and lotcrop='".$itemid."' and lotvariety='".$vv."' */
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $subtbltot=0;
	
	if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$row_dept['cropname']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$row_dept['cropname']."' and lotvariety='".$variet."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	}
$subtbltot=mysqli_num_rows($sql_tbl_sub);
if($subtbltot > 0)
	{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
$acn=$row_tbl_sub['act1'];

$var=$row_tbl_sub['lotvariety'];
$crop=$row_tbl_sub['lotcrop'];
$lotno=$row_tbl_sub['lotno'];
$bags=$acn;
$qty=$ac;
$qc=$row_tbl_sub['gemp'];
$got=$row_tbl_sub['got'];
$got1=$got." ".$row_tbl_sub['got1'];
$stage=$row_tbl_sub['sstage'];
$moist=$row_tbl_sub['moisture'];
if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}

$loc1=$row_party['business_name'];
$sstatus=$row_tbl_sub['sstatus'];
$lotoldlot=$row_tbl_sub['lotoldlot'];
		
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc1=$row_tbl_sub['qc'];
	

		/*$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		*/
		$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);


		/*$crop=$row_crop['cropname'];
		$variety=$row_variety['popularname'];*/
		$stage=$row_tbl_sub['sstage'];
		$party=$row_party['business_name'];
		
		$tdate12=$row_tbl_sub['testd'];
		$tyear12=substr($tdate12,0,4);
		$tmonth12=substr($tdate12,5,2);
		$tday12=substr($tdate12,8,2);
		$tdate12=$tday12."-".$tmonth12."-".$tyear12;
		
		$tdate13=$row_tbl_sub['gotdate'];
		$tyear13=substr($tdate13,0,4);
		$tmonth13=substr($tdate13,5,2);
		$tday13=substr($tdate13,8,2);
		$tdate13=$tday13."-".$tmonth13."-".$tyear13;
		

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="19" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		 <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="135" align="center" valign="middle" class="smalltbltext"><?php echo $party;?></td>
		  <td width="119" align="center" valign="middle" class="smalltbltext"> <?php echo $var;?></td>
         <td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="52" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
       <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
          <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $qc1?></td>
			 <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $tdate12?></td>
			 <td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
			 <td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $tdate13?>  </td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
			 <td width="19" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		 <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="135" align="center" valign="middle" class="smalltbltext"><?php echo $party;?></td>
		  <td width="119" align="center" valign="middle" class="smalltbltext"> <?php echo $var;?></td>
         <td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="52" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
       <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
          <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $qc1?></td>
			 <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $tdate12?></td>
			 <td width="43" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
			 <td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $tdate13?>  </td>
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
         <td align="center" valign="middle" class="tblheading" colspan="15">Record not found.</td>
</tr>
<?php
}
?>
          </table><br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-stcrop.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>