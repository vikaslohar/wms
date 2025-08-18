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

<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<?php 
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
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
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Trading' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
   
?>
<title>Arrival-Report-</title><table width="907" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination: <?php echo $cls['dest'];?></td>
  	</tr>-->
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="47" align="center" valign="middle" class="tblheading">Date </td>
			 <td width="186" align="center" valign="middle" class="tblheading">Party</td>
			<td width="83"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="129"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="94"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="65"  align="center" valign="middle" class="tblheading">No. Of Bag</td>
			<td width="52"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="52" align="center" valign="middle" class="tblheading">SLOC</td>
			<td width="67" align="center" valign="middle" class="tblheading" >Stage</td>
			<td width="66" align="center" valign="middle" class="tblheading" > QC status</td>
			<td width="51" align="center" valign="middle" class="tblheading">Status</td>
            <td width="37" align="center" valign="middle" class="tblheading">Got</td>
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
		//$sql_tbl_sub1=mysqli_query($link,"select * from tblarr_sloc where arrsloc_id='".$arrival_id."'") or die(mysqli_error($link));
	
	 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";
$aq=explode(".",$row_tbl_sub['qty1']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['qty'];}

$an=explode(".",$row_tbl_sub['qty1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['qty'];}

		
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
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
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
	
	
	
	//$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['lotvariety']."'  and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="47" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
			   <td width="186" align="center" valign="middle" class="tblheading"><?php echo $row3['business_name'];?></td>
                <td width="83" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
		 <td width="94" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="65" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="52" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <?php
		 
		 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
echo mysqli_num_rows($sql_sloc);
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
         <td width="52" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
         <td width="67" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $got?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="47" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
			   <td width="186" align="center" valign="middle" class="tblheading"><?php echo $row3['business_name'];?></td>
               <td width="83" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
		 <td width="94" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="65" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="52" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
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

         <td width="52" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 
         <td width="67" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $got?></td>
</tr
>
<?php
}
$srno=$srno+1;
}
}
}
else
{

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}

?>
</table>			
  <br/>
<table width="915" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>