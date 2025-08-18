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
		$vv= $_REQUEST['txtvariety'];
	$loc= $_REQUEST['result'];
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

<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<title>Quality GOT-Report Periodical GOT Report</title><table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-pgot.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<?php	
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$loc = $_REQUEST['result'];
$t=split("-",$sdate);
$z=sprintf("%02d",$t[0]);
$sdate=$z."-".$t[1]."-".$t[2];
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
		$edate=$edate;
		$tday=substr($edate,0,2);
		$tmonth=substr($edate,3,2);
		$tyear=substr($edate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 

$sql="select distinct sampleno from tbl_qctest where gotdate<='$edate' and gotdate>='$sdate' and crop='".$itemid."' ";

	if($vv=="ALL")
	{	
	$sql.=" ";
	}
	else
	{
	$sql.=" and variety='$vv'";
	}
	
	if($loc=="ALL")
	{	
	$sql.="and gotstatus!='RT' ";
	}
	else
	{
	$sql.=" and gotstatus='$loc'";
	}
	
$sql.=" and gotflg=1 order by dosdate asc, oldlot asc ";

$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

 $tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Periodical GOT Report Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $variet;?></td>
  	</tr>
</table>
<?php
if($tot_arr_home > 0)
{
?>  
  <table  border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="79"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="148"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="110"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="40"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="49"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="64"  align="center" valign="middle" class="tblheading">Stage</td>
			<td width="73" align="center" valign="middle" class="tblheading">PP</td>
			<td width="42" align="center" valign="middle" class="tblheading" >Moist %</td>
			<td width="36" align="center" valign="middle" class="tblheading" >Germ %</td>
			<td width="70" align="center" valign="middle" class="tblheading">DOT</td>
            <td width="46" align="center" valign="middle" class="tblheading">GOT Result</td>
            <td width="46" align="center" valign="middle" class="tblheading">Genetic Purity<br />%</td>
</tr>

<?php
$srno=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

$sql2="select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and gotdate<='$edate' and gotdate>='$sdate' and crop='".$itemid."' ";

	if($vv=="ALL")
	{	
	$sql2.=" ";
	}
	else
	{
	$sql2.=" and variety='$vv'";
	}
	
	if($loc=="ALL")
	{	
	$sql2.="and gotstatus!='RT' ";
	}
	else
	{
	$sql2.=" and gotstatus='$loc'";
	}
	
$sql2.=" and gotflg=1 order by tid desc ";
//echo $sql2;
$sql_arr_home2=mysqli_query($link,$sql2) or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_arr_home2);
while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
{

$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	$trdate=$row_arr_home['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage="";
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
}
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
/*	//$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id." '") or die(mysqli_error($link));
	
		
		lotno
		
if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$itemid."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$crop."' and lotvariety='".$vv."'") or die(mysqli_error($link));
	}	
	echo  $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	*/
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
		
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['gotstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$qcresult=$row_arr_home['gotstatus'];
		}
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['oldlot'];
		}
		else
		{
		$lotno=$row_arr_home['oldlot'];
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
		$qc=$qc."<br>".$row_arr_home['pp'];
		}
		else
		{
		$qc=$row_arr_home['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['gemp'];
		}
		else
		{
		$stage=$row_arr_home['gemp'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_arr_home['sstatus'];
		}
		else
		{
		$sstatus=$row_arr_home['sstatus'];
		}
	
	$genpurper=$row_arr_home['genpurity'];
	if($genpurper==0)$genpurper="";
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."'"); 
	$rowvv=mysqli_fetch_array($quer3);
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

	if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="79" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="148" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
		 <td width="110" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="40" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="49" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <td width="64" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>
         <td width="73" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="42" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="36" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $genpurper;?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="79" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="148" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
		 <td width="110" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="40" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="49" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
		 <td width="64" align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>
         <td width="73" align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
         <td width="42" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
         <td width="36" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $qcresult?></td>
         <td align="center" valign="middle" class="tblheading"><?php echo $genpurper;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
else
{
?>
 <br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
</table>
   <br/>
<?php
}
?>			
  <br/>
  
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-pgot.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>