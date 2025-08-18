<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	/*if(isset($_REQUEST['sdate']))
	{
  $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	  $edate = $_REQUEST['edate'];
	}
		 $itemid = $_REQUEST['txtcrop'];
		 $vv = $_REQUEST['txtvariety'];*/
	$age = $_REQUEST['age'];
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

	
	// Set timezone
  date_default_timezone_set("UTC");
 
  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }
  
?>

<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
 <?php
	
	
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
$age = $_REQUEST['age'];
	$qry="select distinct lotldg_lotno, lotldg_crop, lotldg_variety from tbl_lot_ldg where lotldg_sstage='Raw' ";
	if($age=="morethan60")
	{	
	$dt=date("d-m-Y", strtotime("-60 days"));
	$qry.="and lotldg_trdate<'$dt' ";
	}
	$qry.="and lotldg_variety REGEXP '[A-Za-z]'";
	
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	 $tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<title>Decode-Report- Coded Raw Seed Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="750" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-variety1.php?age=<?php echo $age;?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
 </tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Coded Raw Seed Report - As on Date <?php echo date("d-m-Y");?></td>
  </tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#7a9931" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="7%" align="center" valign="middle" class="tblheading">Date of Arrival</td>
			  <td width="11%" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="5%" align="center" valign="middle" class="tblheading">SP Code-F</td>
			  <td width="5%" align="center" valign="middle" class="tblheading">SP Code-M</td>
              <td width="14%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="4%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="4%" align="center" valign="middle" class="tblheading">QC</td>
              <td width="6%" align="center" valign="middle" class="tblheading">GOT</td>
			  <td width="8%" align="center" valign="middle" class="tblheading">Production Location</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Farmer</td>
			  <td width="6%" align="center" valign="middle" class="tblheading">Organiser</td>
              <td width="16%" align="center" valign="middle" class="tblheading">Duration</td>
</tr>
<?php
$cdt=date("d-m-Y");


$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$crop=""; $variety=""; $lotno="";  $slocs="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['lotldg_variety']."'  and vertype='PV' order by popularname Asc"); 

$rowvv=mysqli_num_rows($quer4);

//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
   		 $crop=$row31['cropname'];
		
		 $lotno=$row_arr_home['lotldg_lotno'];
	 $variety=$crop."-"."Coded";
	 
$ccnt=0; $nob=0; $qty=0; $qc=""; $got="";$trdate="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and lotldg_variety='".$variety."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and lotldg_variety='".$variety."'  order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 and lotldg_sstage='Raw' and lotldg_variety='".$variety."'  order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
$row_istbl=mysqli_fetch_array($sql_istbl);
	$arrival_id=$row_istbl['lotldg_trid'];
	$nob=$nob+$row_istbl['lotldg_balbags'];
	$qty=$qty+$row_istbl['lotldg_balqty'];

		
	$qc=$row_istbl['lotldg_qc'];
	$got=$row_istbl['lotldg_got'];

$ccnt++;	
}
}
//}
//echo $ccnt;
if($ccnt > 0)
{

$qry2="select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$variety."' and sstage='Raw' and lotno='".$row_arr_home['lotldg_lotno']."'";
$sql_rr=mysqli_query($link,$qry2) or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
$row_rr=mysqli_fetch_array($sql_rr);

$spcf=$row_rr['spcodef'];	
$spcm=$row_rr['spcodem'];	
$ploc=$row_rr['ploc'];	
$farmer=$row_rr['farmer'];
$organiser=$row_rr['organiser'];

$sql_arrmain=mysqli_query($link,"Select * from tblarrival where arrival_id='".$row_rr['arrival_id']."' ") or die(mysqli_error($link));
$row_arrmain=mysqli_fetch_array($sql_arrmain);

$ardt=$row_arrmain['arrival_date'];
	$trdate=$ardt;
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;

$ardt=explode("-",$row_arrmain['arrival_date']);
$trdate24=$ardt[0]."-".$ardt[1]."-".$ardt[2];
$cdt24=date("Y-m-d");
		
if(trdate!="")
{
$date1 = strtotime($trdate24);
$date2 = strtotime($cdt24);//time();
$diff=dateDiff(date('Y-m-d H:i:s',$date1),date('Y-m-d H:i:s',$date2));
}
else
{
$diff="";	
}	 

$ccnntt++;
if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="11%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
		  	<td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $nob;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $organiser;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="11%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
		  	<td width="14%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $nob;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $ploc;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $organiser;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
//}
?>
</table>			
  <br/>
  <table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
    <tr >
      <td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-variety1.php?age=<?php echo $age;?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></td>
    </tr>
  </table>
