<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	$plantcode=$_SESSION['plantcode'];
	$plantcode1=$_SESSION['plantcode1'];
	$plantcode2=$_SESSION['plantcode2'];
	$plantcode3=$_SESSION['plantcode3'];
	$plantcode4=$_SESSION['plantcode4'];
	}
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
		
	
	 if(isset($_REQUEST['txtparty']))
	{
	  $txtparty = $_REQUEST['txtparty'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
	 
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$classification=trim($_POST['txtcla']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysqli_query($link,"SELECT * FROM tbl_classification where classification='$classification'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Classification is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblclassification(classification) values(
											  '$class'
												)";
											
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_classification.php'</script>";	
		}
		}*/
}

?>

<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<?php 


/*$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
*/
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$txtparty1 = $_REQUEST['txtparty'];
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
		$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Trading' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and party_id='".$txtparty."' and arrtrflag=1 and plantcode='".$plantcode."' order by ncode asc ") or die(mysqli_error($link));
	
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);
?>


<title>Arrival-Report-Trading Wise</title><table width="970" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-vendor.php?txtparty=<?php echo $txtparty;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Trading Vendor Wise Report </td>
  </tr>
  	<tr height="25">
    
  	
    <td align="left" class="subheading" style="color:#303918; ">Period  From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
	<td align="right" class="subheading" style="color:#303918; ">Trading Party Name: <?php echo $row_party['business_name'];?></td>
  	</tr>
</table>

  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="112"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
			<td width="144"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			 <td width="76"  align="center" valign="middle" class="tblheading" rowspan="2">FRN No.</td>
			<td width="74"  align="center" valign="middle" class="tblheading" rowspan="2">V. Lot No.</td>
				<td width="119"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
			<td width="46"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
			<td width="70"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
			<td width="60" align="center" valign="middle" class="tblheading" rowspan="2">Stage</td>
			<td colspan="2" align="center" valign="middle" class="tblheading">Preliminary QC</td>
			<!--<td width="81" align="center" valign="middle" class="tblheading">Seed Stage</td>
			<td width="69" align="center" valign="middle" class="tblheading" rowspan="2">Moisture %</td>
			<td width="118" align="center" valign="middle" class="tblheading" rowspan="2">Party</td>-->
			<td width="48" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
			<td width="67" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
            <!--/*<td width="58" align="center" valign="middle" class="tblheading" rowspan="2">Status</td>*/-->
</tr>
<tr class="tblsubtitle">
			  <td width="49" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="37" align="center" valign="middle" class="tblheading">Moist %</td>
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
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$vchk=""; $pp=""; $stnno1="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_arr_home['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotvariety'];
		}
		else
		{
		$variety=$row_arr_home['lotvariety'];	
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
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$per=$row_tbl_sub['moisture'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_party['business_name'];
		}
		else
		{
		$loc1=$row_party['business_name'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
		if($lotoldlot!="")
		{
		$lotoldlot=$lotoldlot."<br>".$row_tbl_sub['lotoldlot'];
		}
		else
		{
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		}
			if($row_tbl_sub['vchk'] =="Acceptable") { $vchk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vchk="NAcc";}
		if($pp!="")
		{
		$pp=$pp."<br>".$vchk;
		}
		else
		{
		$pp=$vchk;
		}
		$stnno="FRN"."/".$yearid_id."/".$row_arr_home['ncode'];
		//$stnno1="FRN"."/".$yearid_id."/".$row_arr_home['ncode'];
		/*if($stnno!="")
		{
		$stnno=$stnno."<br>".$stnno1;
		}
		else
		{
		$stnno=$stnno1;
		}*/
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			  <td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="144" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
		  <td align="center" valign="middle" class="smalltbltext"><?php echo $stnno;?></td>
         <td width="74" align="center" valign="middle" class="smalltbltext"><?php echo $lotoldlot;?></td>
		    <td width="119" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="46" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>

         <td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $vchk;?></td>
         <!--<td width="69" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>-->
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
			<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
			  <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
				<!--/*<td align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>*/-->
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td height="20" align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			  <td width="112" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="144" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
		  <td align="center" valign="middle" class="smalltbltext"><?php echo $stnno;?></td>
         <td width="74" align="center" valign="middle" class="smalltbltext"><?php echo $lotoldlot;?></td>
		    <td width="119" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td width="46" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
         <td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
		 <td width="60" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
		 <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>

         <td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $vchk?></td>
         <!--<td width="69" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>-->
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
			<td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
			  <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
				<!--<td align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>-->
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
         <td width="2%" align="center" valign="middle" class="tblheading" colspan="13">Record not found.</td>
</tr>
<?php
}
?>
</table>			
  <br/>
<table width="970" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-vendor.php?txtparty=<?php echo $txtparty;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>