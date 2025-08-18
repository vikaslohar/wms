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
	
  		$edate = $_REQUEST['sdate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
		
		$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_sstage='Condition'";
	
	$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.="and lotldg_trdate <= '$edate'  group by lotldg_crop, lotldg_variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	 $tot_arr_home=mysqli_num_rows($sql_arr_home1);
	 ?>
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
<title>CSW-Report-Quality Based Condition Seed report</title>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-rawqu.php?sdate=<?php echo $_REQUEST['sdate'];?>&txtcrop=<?php echo $crop;?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
  
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Quality Based Condition Seed Stock Report - As on date: <?php echo date("d-m-Y");?></td>
  </tr>
		<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#fa8283" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			<td width="160" rowspan="2"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="226" rowspan="2"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="75" rowspan="2"  align="center" valign="middle" class="tblheading">Total Qty </td>
			<td colspan="3"  align="center" valign="middle" class="tblheading">QC</td>
			<td colspan="4"  align="center" valign="middle" class="tblheading">GOT</td>
			</tr>
<tr class="tblsubtitle" height="20">
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Fail</td>
  <td width="75"  align="center" valign="middle" class="tblheading">NUT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">OK</td>
  <td width="75"  align="center" valign="middle" class="tblheading">UT</td>
  <td width="75"  align="center" valign="middle" class="tblheading">Fail</td>
</tr>
<?php


$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$totqty=0; $totqcq=0; $totuqq=0; $totufq=0; $totgcq=0; $totugq=0; $totgfq=0; $totgnutq=0;
	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['lotldg_variety']."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_arr_home1['lotldg_variety'];
		}
	//echo $row_arr_home1['lotldg_crop'];
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Condition' ") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
	$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Condition' ") or die(mysqli_error($link));


 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_trdate <= '$edate' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Condition' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	
	if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']==" ")
	{
	$totqcq=$totqcq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT")
	{
	$totuqq=$totuqq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="Fail")
	{
	$totufq=$totufq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="OK")
	{
	$totgcq=$totgcq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
	{
	$totugq=$totugq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="Fail")
	{
	$totgfq=$totgfq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']==" " || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']=="NULL")
	{
	$totgnutq=$totgnutq+$row_issuetbl['lotldg_balqty'];  
	}

}
}
}	
	
if($totqty > 0) 
{ 
if($srno%2!=0)
{
?>			  
		  
<tr class="Light">
			<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
          	<td align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		  	<td align="center" valign="middle" class="tblheading"><?php echo $totqty?></td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totuqq;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totgnutq;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totgcq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totgfq;?></td>
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
         	<td align="center" valign="middle" class="tblheading"><?php echo $totqcq?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totuqq;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totufq;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totgnutq;?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totgcq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totugq;?></td>
           	<td align="center" valign="middle" class="tblheading"><?php echo $totgfq;?></td>
</tr>
<?php
}
$srno++;
}
}
}

?>
          </table>			
  <br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-rawqu.php?sdate=<?php echo $_REQUEST['sdate'];?>&txtcrop=<?php echo $crop;?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>