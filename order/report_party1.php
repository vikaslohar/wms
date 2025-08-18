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

<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
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
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='$plantcode' and arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));
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
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}
?>
<title>Arrival-Report-Crop Variety Wiser Stock Transfer report</title><table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-stcrop.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop Variety wise Compiled Pending Order Report  Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $row_dept['cropname'];?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variet;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="116"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="138"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="95"  align="center" valign="middle" class="tblheading">UPS</td>
			<td width="40"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="74" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="57" align="center" valign="middle" class="tblheading">Total Qty </td>
			<td width="57" align="center" valign="middle" class="tblheading">Order Date </td>
			<td width="69" align="center" valign="middle" class="tblheading">Order No. </td>
			<!--<td width="58" align="center" valign="middle" class="tblheading">Got</td>-->
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
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$loc1=$row_tbl_sub['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
         <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
         <td width="95" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="40" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='$plantcode' and arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>

         <td width="74" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
			<!--<td align="center" valign="middle" class="tblheading"><?php echo $got?></td>-->
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
         <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
         <td width="95" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="40" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>

         <td width="74" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
			<!--<td align="center" valign="middle" class="tblheading"><?php echo $got?></td>-->
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table><br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-stcrop.php?sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>