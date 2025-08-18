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
		 // $cid = $_REQUEST['txtclass'];
	
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

<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<?php 


/*$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
*/
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
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
		
	
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Unidentified' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	
	
		$sql_cit=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_cit=mysqli_fetch_array($sql_cit);
		$crop=$row_cit['cropname'];
				
	/*$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrival_date <= '$edate' and ardate >= '$arrival_date' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */
   
?>
<title>Arrival-Report-Unidentified Arrival Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-unid.php?txtcrop=<?php echo $itemid;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
  <td align="center" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?>
     - Period From
     <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>

</table>
  <?php
 if($tot_arr_home > 0)
{
?>  
  <table  border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
 <tr class="tblsubtitle" height="25">
    <td width="18" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="62"  align="center" valign="middle" class="tblheading" rowspan="2">DoA</td>
	<td width="121" align="center" valign="middle" class="tblheading" rowspan="2">Arrived In</td>
    <td width="85" align="center" valign="middle" class="tblheading" rowspan="2">Arrived From</td>
    <td width="70"  align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
    <td width="104"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	   
    <td width="88"  align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
    <td width="26"  align="center" valign="middle" class="tblheading" rowspan="2">NoB</td>
    <td width="35"  align="center" valign="middle" class="tblheading" rowspan="2">Qty</td>
	<td width="40" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
 <td colspan="2" align="center" valign="middle" class="tblheading">Prel. QC</td>
    <td width="39" align="center" valign="middle" class="tblheading" rowspan="2">QC Status</td>
    <td width="55" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
    <td width="110" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
  </tr>
  <tr class="tblsubtitle">
			  <td width="28" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="37" align="center" valign="middle" class="tblheading">Moist %</td>
			  <!--<td width="41" align="center" valign="middle" class="tblheading">Germ %</td>-->
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
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$crop."' and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $got1="";$qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$moist="";$vk=""; $location="";
$aq=explode(".",$row_tbl_sub['qty']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['qty'];}

$an=explode(".",$row_tbl_sub['qty1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['qty1'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		$tdate12=$row_tbl_sub['testd'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row_tbl_sub['gotdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;
		
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
		$qc=$qc."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$qc=$row_tbl_sub['gemp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$got=$row_tbl_sub['qc'];
		}
		if($got1!="")
		{
		$got1=$got1."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got1=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		
		if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$moist=$row_tbl_sub['moisture'];
		}
		/*if($vk!="")
		{
		$vk=$vk."<br>".$row_tbl_sub['vchk'];
		}
		else
		{
		$vk=$row_tbl_sub['vchk'];
		}*/
		if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}
	
		$loc1=$row_arr_home['type'];
		$location=$row_tbl_sub['ploc'];
		
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
		
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $location;?></td>
    <td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="104" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="88" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="26" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
  <td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
 <td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
   <!--  <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
     	 	 <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
			 <td width="55" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>

  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
	<td width="62" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $location;?></td>
    <td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
    <td width="104" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
    <td width="88" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td width="26" align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
?>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vk?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $moist?></td>
      <!-- <td width="48" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
     	 	    <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
				 <td width="55" align="center" valign="middle" class="smalltbltext"><?php echo $got1?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
  </tr>
  <?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
}
else
{
//}
//}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?>
  <br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-unid.php?txtcrop=<?php echo $itemid;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
