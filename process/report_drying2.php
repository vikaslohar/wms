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
	
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
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
		
	$crp="ALL"; $ver="ALL";
	$qry="select * from tbl_drying where arrflg='1' and dflg='1' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
	$qry.="and crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" and dryingdate<='$edate' and dryingdate>='$sdate' order by dryingdate ASC";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
<title>Processing - Report - Periodical Drying report</title>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-arrival.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></a>&nbsp;</td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Periodical Drying Report</td>
  	</tr>
	<tr class="Light" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
	<tr class="Light" height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;</td>
  	</tr>
</table>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="105"  align="center" valign="middle" class="smalltblheading"rowspan="2" >Date of Drying Slip</td>
	<td width="50"  align="center" valign="middle" class="smalltblheading"rowspan="2" >Drying Slip Ref. No.</td>
	<td width="100"  align="center" valign="middle" class="smalltblheading"rowspan="2" >Crop</td>
	<td width="158"  align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td width="69" align="center" valign="middle" class="smalltblheading"rowspan="2" >Lot No. </td>
	<td align="center" valign="middle" class="smalltblheading"  colspan="2">Before Drying </td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying </td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Damage Loss </td>
</tr>
<tr class="tblsubtitle">
    <td width="69" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="94" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="79" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="82" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="86" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="67" align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
$srno=1; 
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$sql_issuetbl=mysqli_query($link,"select * from tbl_dryingsub where trid='".$row_arr_home1['trid']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{ 
 
 	$rdate=$row_arr_home1['dryingdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$trdate=$rday."-".$rmonth."-".$ryear;
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['variety']."' ") or die(mysqli_error($link));
	$rowvv=mysqli_fetch_array($sql_variety);
	$cropn=$row31['cropname'];
	$varietyn=$rowvv['popularname'];

 
if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home1['drefno'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_issuetbl['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_issuetbl['onob'];?></td>
	<td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['oqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['nob1'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['qty1'];?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['adnob'];?></td>
	<td width="67" align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['adqty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home1['drefno'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_issuetbl['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_issuetbl['onob'];?></td>
	<td width="94" align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['oqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['nob1'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['qty1'];?></td>
	<td width="86" align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['adnob'];?></td>
	<td width="67" align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['adqty'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
          </table><br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-arrival.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
