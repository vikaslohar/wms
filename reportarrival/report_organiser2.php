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
	if(isset($_REQUEST['txtclass']))
	{
		$txtclass= $_REQUEST['txtclass'];
	}
	
	
		 
	if(isset($_POST['frm_action'])=='submit')
	{
		
}

?>

<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	/*$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['itemid'];*/
	$txtclass = $_REQUEST['txtclass'];	
	
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
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$quer2=mysqli_query($link,"SELECT  organiser FROM tblarrival_sub where organiser='$txtclass' and plantcode='".$plantcode."'"); 
$row_dept=mysqli_fetch_array($quer2);
	?>
<title>Arrival-Report-Organiser</title><table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-organiser.php?txtclass=<?php echo $_REQUEST['txtclass'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<!--<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>-->
<tr height="25" >
  
   <td align="left" class="subheading" style="color:#303918; ">Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td> 
   <td align="right" class="subheading" style="color:#303918; ">Organiser: <?php echo $txtclass;?> </td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="18" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="59" align="center" valign="middle" class="tblheading" rowspan="2" >Date of Arrival </td>
			<td width="72"  align="center" valign="middle" class="tblheading" rowspan="2" >Crop</td>
			<td width="78" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
				<td width="45" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
				<td width="61" align="center" valign="middle" class="tblheading" rowspan="2">FRN No.</td>
			<td width="94"  align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
			<td width="47"  align="center" valign="middle" class="tblheading"rowspan="2" >NoB</td>
			<td width="50"  align="center" valign="middle" class="tblheading"rowspan="2" >Qty</td>
		 <td colspan="2" align="center" valign="middle" class="tblheading" >Preliminary QC</td>
			<!--<td width="90"  align="center" valign="middle" class="tblheading"rowspan="2" > Moisture % </td>-->
			<td width="56" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
			<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Loc.</td>
				<td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Personnel</td>
			<td width="93" align="center" valign="middle" class="tblheading"rowspan="2" >Farmer </td>
			  <td width="28" align="center" valign="middle" class="tblheading" rowspan="2">Plot No.</td>
         <!-- <td width="58" align="center" valign="middle" class="tblheading">Login</td>-->
</tr>
<tr class="tblsubtitle">
			  <td width="46" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="36" align="center" valign="middle" class="tblheading">Moist %</td>
			  </tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and organiser='$txtclass' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

$per="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $org="";$org1="";$vchk=""; $loc=""; $trdate1="";$vchk1="";

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
		$org=$org."<br>".$row_tbl_sub['farmer'];
		}
		else
		{
		$org=$row_tbl_sub['farmer'];
		}
		if($org1!="")
		{
		$org1=$org1."<br>".$row_tbl_sub['plotno'];
		}
		else
		{
		$org1=$row_tbl_sub['plotno'];
		}
			if($row_tbl_sub['vchk'] =="Acceptable") { $vchk1="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vchk1="NAcc";}
		
		if($vchk!="")
		{
		$vchk=$vchk."<br>".$vchk1;
		}
		else
		{
		$vchk=$vchk1;
		}
		
		if($loc!="")
		{
		$loc=$loc."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$loc=$row_tbl_sub['ploc'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}
		$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
	
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
			<td align="center" valign="middle" class="smalltbltext"><?php echo $vchk;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $loc;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org1;?></td>
           <!--/* <td align="center" valign="middle" class="tblheading"><?php echo $login;?></td>*/
</tr>-->
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
			<td align="center" valign="middle" class="smalltbltext"><?php echo $vchk;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $loc;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org1;?></td>
		       <!-- <td align="center" valign="middle" class="tblheading"><?php echo $login;?></td>-->
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
</table><br/>
<table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<a href="excel-organiser.php?txtclass=<?php echo $txtclass;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>