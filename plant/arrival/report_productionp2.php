<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
		
	
	 if(isset($_GET['txtclass']))
	{
	 $loc= $_GET['txtclass'];
	 
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
		
			
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc  ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
  $sql_party=mysqli_query($link,"select * from tblarrival_sub where pper='".$cid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_party=mysqli_fetch_array($sql_party);   
?>
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

<title>Arrival-Report-Production Personnel wise Seed Arrival Report </title><table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-pp.php?txtclass=<?php echo $loc;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  
	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="5"> Production Personnel wise Seed Arrival Report </td>
  	</tr>
 	<tr height="25" >
    
  	    <td align="left" class="subheading" style="color:#303918; ">Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td><td align="right" class="subheading" style="color:#303918; ">Production Personnel:  <?php echo $loc;?> </td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="63" align="center" valign="middle" class="tblheading" rowspan="2" >Date of Arrival </td>
			<td width="69"  align="center" valign="middle" class="tblheading" rowspan="2" >Crop</td>
			<td width="62" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
				<td width="48" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
				<td width="66" align="center" valign="middle" class="tblheading" rowspan="2">FRN No.</td>
			<td width="90"  align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
			<td width="57"  align="center" valign="middle" class="tblheading"rowspan="2" >NoB</td>
			<td width="51"  align="center" valign="middle" class="tblheading"rowspan="2" >Qty</td>
		 <td colspan="2" align="center" valign="middle" class="tblheading" >Preliminary QC</td>
			<!--<td width="90"  align="center" valign="middle" class="tblheading"rowspan="2" > Moisture % </td>-->
			<td width="48" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
	        <!--		<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Loc.</td>-->
				<td width="67" rowspan="2" align="center" valign="middle" class="tblheading">Production Location</td>
				<td width="62" align="center" valign="middle" class="tblheading"rowspan="2" >Organiser</td>
			    <td width="48" align="center" valign="middle" class="tblheading"rowspan="2" >Farmer </td>
			  <td width="40" align="center" valign="middle" class="tblheading" rowspan="2">Plot No.</td>
         <!-- <td width="58" align="center" valign="middle" class="tblheading">Login</td>-->
</tr>
<tr class="tblsubtitle">
			  <td width="36" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="48" align="center" valign="middle" class="tblheading">Moist %</td>
			<!-- <td width="62" align="center" valign="middle" class="tblheading">Germ %</td>
           <td width="58" align="center" valign="middle" class="tblheading">Login</td>-->
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	/*$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		*/
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and pper='$loc' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12=""; $farm=""; $farm1=""; $p="";$trdate1="";
	
$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	if($trdate1!="")
		{
		$trdate1=$trdate1."<br>".$trdate;
		}
		else
		{
		$trdate1=$trdate;
		}
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
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
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
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
		if($org!="")
		{
		$org=$org."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$org=$row_tbl_sub['ploc'];
		}
		if($row_tbl_sub['vchk'] =="Acceptable") { $p="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $p="NAcc";}
		
			if($pp!="")
		{
		$pp=$pp."<br>".$p;
		}
		else
		{
		$pp=$p;
		}
		if($pp1!="")
		{
		$pp1=$pp1."<br>".$row_tbl_sub['plotno'];
		}
		else
		{
		$pp1=$row_tbl_sub['plotno'];
		}
		if($pp12!="")
		{
		$pp12=$pp12."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$pp12=$row_tbl_sub['gemp'];
		}
		
		if($farm!="")
		{
		$farm=$farm."<br>".$row_tbl_sub['farmer'];
		}
		else
		{
		$farm=$row_tbl_sub['farmer'];
		}
		if($farm1!="")
		{
		$farm1=$farm1."<br>".$row_tbl_sub['organiser'];
		}
		else
		{
		$farm1=$row_tbl_sub['organiser'];
		}
		$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
		/*if($stnno!="")
		{
		$stnno=$stnno."<br>".$stnno1;
		}
		else
		{
		$stnno=$stnno1;
		}*/
	
	if($srno%2!=0)
{
?>			  

<tr class="Light" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
					<td align="center" valign="middle" class="smalltbltext"><?php echo $stnno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
			<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $pp12;?></td>-->
				<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $org;?></td>
			  <td align="center" valign="middle" class="smalltbltext"><?php echo $farm1;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $farm;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $pp1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
					<td align="center" valign="middle" class="smalltbltext"><?php echo $stnno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
			<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $pp12;?></td>-->
				<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $org;?></td>
		<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $pp12;?></td>-->
		  <td align="center" valign="middle" class="smalltbltext"><?php echo $farm1;?></td>
        <td align="center" valign="middle" class="smalltbltext"><?php echo $farm;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $pp1;?></td><!---->
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
<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="16">Record not found</td>
</tr>
<?php
}
?>
</table>			
  <br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<a href="excel-pp.php?txtclass=<?php echo $loc;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;-->&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
