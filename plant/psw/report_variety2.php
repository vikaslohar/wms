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

?>

<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
	$qry="select * from tbl_lot_ldg where lotldg_sstage='Pack' and plantcode='$plantcode'";
	if($age=="morethan60")
	{	
	$dt=date("d-m-Y", strtotime("-60 days"));
	$qry.="and lotldg_trdate<'$dt' ";
	}
	$qry.="and lotldg_balqty > 0 ";
	
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	 $tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<title>RSW-Report- Coded Pack Seed Report </title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="750" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-variety.php?age=<?php echo $age;?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
 </tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Coded Pack Seed Report - As on Date: <?php echo date("d-m-Y");?></td>
  </tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="10%" align="center" valign="middle" class="tblheading">Date of Arrival</td>
			  <td width="15%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="18%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="7%" align="center" valign="middle" class="tblheading">QC Status</td>
              <td width="7%" align="center" valign="middle" class="tblheading">GOT Status</td>
              <td width="22%" align="center" valign="middle" class="tblheading">Duration</td>
</tr>
<?php
$cdt=date("d-m-Y");

   function timeDiff($t1, $t2)
{
   if($t1 > $t2)
   {
      $time1 = $t2;
      $time2 = $t1;
   }
   else
   {
      $time1 = $t1;
      $time2 = $t2;
   }
   $diff = array(
      'Year(s)' => 0,
      'Month(s)' => 0,
	  'Day(s)' => 0
         );
   
   foreach(array('Year(s)','Month(s)','Day(s)')
         as $unit)
   {
      while(TRUE)
      {
         $next = strtotime("+1 $unit", $time1);
         if($next <= $time2)
         {
            $time1 = $next;
            $diff[$unit]++;
         }
         else
         {
            break;
         }
      }
   }
   return($diff);
}



$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;

$start = strtotime($trdate);
$end = strtotime($cdt);
$diff = timeDiff($start, $end);
$output = "The difference is:";
$a="";
$b="";
foreach($diff as $unit => $value)
{
	$a=$a.$value.",";
	$b=$b.$unit.",";
}


			$p_array=explode(",",$a);
			$p_array1=explode(",",$b);
			$p=array();
			$i=0;
			$co="";
			foreach($p_array as $val)
				{foreach($p_array1 as $val1)
				if($val <> "" && $val1 <> "")
				{
				$co[$i]=$p_array[$i].$p_array1[$i];
				}$i++;
				}
				
	 $diff=$co[0]." ".$co[1]." ".$co[2];
	





	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_arr_home['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno="";  $slocs="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		  
		 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['lotldg_variety']."' order by popularname Asc"); 

$rowvv=mysqli_num_rows($quer4);


//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
   		 $crop=$row31['cropname'];
		 //$variety=$rowvv['popularname'];
		 $lotno=$row_arr_home['lotldg_lotno'];
	
		 $variety=$crop."-"."Coded";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_arr_home['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_arr_home['lotldg_binid']."' and whid='".$row_arr_home['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_arr_home['lotldg_subbinid']."' and binid='".$row_arr_home['lotldg_binid']."' and whid='".$row_arr_home['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slocs=$slocs.$wareh.$binn.$subbinn;
if($row_arr_home['lotldg_variety']==$variety)
{

if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="15%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
		  	<td width="18%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balbags'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balqty'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_qc'];?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_got'];?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $diff;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          	<td width="15%" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
		  	<td width="18%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balbags'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_balqty'];?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_qc'];?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['lotldg_got'];?></td>
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
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-variety.php?age=<?php echo $age;?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
