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
	
	$sdate = $_REQUEST['sdate'];
 	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['cid'];
	$vv = $_REQUEST['itemid'];
	
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
<title>Quality GOT-Report GOT Sample Dispatch Report</title><table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--<a href="excel-pgot.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;</td>
</tr>
</table>
<?php	
		$ddate1=explode("-",$sdate);
		$sdate=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
		$pdate1=explode("-",$edate);
		$edate=$pdate1[2]."-".$pdate1[1]."-".$pdate1[0];
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 

	if($itemid=="ALL" && $vv=="ALL")
	{	
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where dosdate <= '$edate' and dosdate >= '$sdate' and  gotsmpdflg=1 order by dosdate asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv=="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where dosdate <= '$edate' and dosdate >= '$sdate' and crop='".$itemid."' and  gotsmpdflg=1 order by dosdate asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv!="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where dosdate <= '$edate' and dosdate >= '$sdate' and crop='".$itemid."' and variety='$vv' and  gotsmpdflg=1 order by dosdate asc ") or die(mysqli_error($link));
	}
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

	if($itemid=="ALL")
	{
		$crop="ALL";
	}
	else
	{
		$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
		$row_dept=mysqli_fetch_array($quer2);
		$crop=$row_dept['cropname'];
	}
	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$vv."'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$vv;
	 }
	 else
	 {
	  $vv=$tt;
	  }
	}
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="2">GOT Sample Dispatch Report</td>
  	</tr>
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vv;?></td>
  	</tr>
	</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="21" align="center" valign="middle" class="tblheading">#</td>
			<td width="98"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="184"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="102"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="81"  align="center" valign="middle" class="tblheading">Sample No.</td>
			<td width="70"  align="center" valign="middle" class="tblheading">DOSR</td>
			<td width="72"  align="center" valign="middle" class="tblheading">DOSC</td>
			<td width="77" align="center" valign="middle" class="tblheading">DOSD</td>
			<td width="66" align="center" valign="middle" class="tblheading" >Location</td>
			<td width="57" align="center" valign="middle" class="tblheading" >Mode</td>
			<td width="57" align="center" valign="middle" class="tblheading" >GSDN No.</td>
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$trdate1=$row_arr_home['spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_arr_home['dosdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
				
	


	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//echo $row_arr_home['tid'];
	$gsdnid="";
	$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 order by arrival_id asc") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	while($row_dtchk=mysqli_fetch_array($sql_dtchk))
	{
		$lid=explode(",",$row_dtchk['lotno']);
		foreach($lid as $fid)
		{
			if($fid <> "" && $fid!=0)
			{
				if($fid==$row_arr_home['tid'])
				{
				$gsdnid="GSD"."/".$row_dtchk['year_code']."/".$row_dtchk['gsdn'];
				
				if($row_dtchk['pid']=="Yes")
				{
					$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_dtchk['party_id']."'"); 
					$row3=mysqli_fetch_array($quer3);
					$address=$row3['city'];
				}
				else
				{
					$address=$row_dtchk['city'];
				}
				
				$tmode=$row_dtchk['tmode'];
					$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
				$qc1=$row_arr_home['sampleno'];

if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
		 <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="98" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="184" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="102" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['oldlot'];?></td>
         <td width="81" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
         <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
		 <td width="57" align="center" valign="middle" class="tblheading"><?php echo $gsdnid;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
		 <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="98" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="184" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="102" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['oldlot'];?></td>
         <td width="81" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
         <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
		 <td width="57" align="center" valign="middle" class="tblheading"><?php echo $gsdnid;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
else
{
?>
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
<?php
}
?>
  </table>				
  <br/>
  
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--<a href="excel-pgot.php?txtcrop=<?php echo $itemid;?>&txtvariety=<?php echo $vv;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&result=<?php echo $_REQUEST['result'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;</td>
</tr>
</table>