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
				
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		
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
	$qry="select Distinct(lotldg_crop), lotldg_variety from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_sstage='Condition'";
	if($crop!="ALL")
	{	
	$qry.="and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.="and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate' group by lotldg_crop, lotldg_variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	  $tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
<title>CSW - Report - Quality  Based Condition Seed report</title>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-arrival.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></a>&nbsp;</td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>-->
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#fa8283" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="105"  align="center" valign="middle" class="tblheading"rowspan="2" >Date of Drying Slip</td>
			<td width="100"  align="center" valign="middle" class="tblheading"rowspan="2" >Crop</td>
			<td width="158"  align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			    <td width="69" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
    <td align="center" valign="middle" class="tblheading"  colspan="2">Before Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">Damage Loss </td>
   
  </tr>
  <tr class="tblsubtitle">
    <td width="69" align="center" valign="middle" class="tblheading" >NoB</td>
    <td width="94" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="79" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="82" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="86" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="67" align="center" valign="middle" class="tblheading">%</td>
  </tr>
<?php


$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	//echo $row_arr_home1['lotldg_crop'];
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate'") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
	$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate'") or die(mysqli_error($link));

$srno=1;
$totqty=0; $totqcq=0; $totugq=0; $totuqq=0; $totufq=0; 
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_trdate <= '$edate' and lotldg_trdate >= '$sdate'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	
	if($row_issuetbl['lotldg_qc']=="OK")
	{
	$totqcq=$totqcq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got1']=="GOT-R Under Test" || $row_issuetbl['lotldg_got1']=="GOTR Under Test" || $row_issuetbl['lotldg_got1']=="GOTNR Under Test" || $row_issuetbl['lotldg_got1']=="Retest")
	{
	$totugq=$totugq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="Under Test" || $row_issuetbl['lotldg_qc']=="UnderTest")
	{
	$totuqq=$totuqq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="Fail" && $row_issuetbl['lotldg_got1']=="Fail")
	{
	$totufq=$totufq+$row_issuetbl['lotldg_balqty'];  
	}
	

}
}
}	
	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['lotldg_variety']."' ") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
		 $crop=$row31['cropname'];
		 $variety=$rowvv['popularname'];

 
if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="94" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="67" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
    
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="94" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="67" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
</tr>
<?php
}
$srno=$srno++;
}
}
/*}
}*/
?>
          </table><br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-arrival.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>