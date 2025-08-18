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
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
?>
<link href="../include/vnrtrac_viewer.css" rel="stylesheet" type="text/css" />
<title>Viewer-Report - Periodical Crop Variety wise Classified Stock Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-stockladgerbob.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
	$sd=split("-",$sdate);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$ed=split("-",$edate);
	$etdate=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$dt2=date('Y-m-d',mktime(0,0,0,$sd[1],($sd[0]-1),$sd[2]));
		
	$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	

?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#ef0388" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Periodical Crop Variety wise Classified Stock Report</td>
  </tr>
  
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
	<td align="right" class="tblheading" style="color:#303918;">Veriety: <?php echo $ver;?>&nbsp;&nbsp;</td>
</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#ef0388" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="85" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="94" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="30" rowspan="2" align="center" valign="middle" class="tblheading">Type</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="tblheading">Opening Stock</td>
	<td colspan="7" align="center" valign="middle" class="tblheading">Inward Qty</td>
	<td colspan="8" align="center" valign="middle" class="tblheading">Outward Qty</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="tblheading">Closing Stock</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="55" align="center" valign="middle" class="tblheading">Fresh FRN</td>
  <td width="55" align="center" valign="middle" class="tblheading">Sales Return</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (Plant)</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (C&amp;F)</td>
  <td width="55" align="center" valign="middle" class="tblheading">IVT In</td>
  <td width="55" align="center" valign="middle" class="tblheading">CI</td>
  <td width="55" align="center" valign="middle" class="tblheading">Total Qty</td>
  <td width="55" align="center" valign="middle" class="tblheading">Sales</td>
  <td width="55" align="center" valign="middle" class="tblheading">Purchase Return</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (Plant)</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (C&amp;F)</td>
  <td width="55" align="center" valign="middle" class="tblheading">TDF</td>
  <td width="55" align="center" valign="middle" class="tblheading">IVT Out</td>
  <td width="55" align="center" valign="middle" class="tblheading">Loss</td>
  <td width="55" align="center" valign="middle" class="tblheading">Total Qty</td>
</tr>
<?php
$srno=1; 

$sql_istbl=mysqli_query($link,"select * from tmp_pmsldgrep2 where logid='".$logid."' order by crop asc, variety asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_istbl))
	{ 
	
	$crop1=""; $verty=""; $totfrn=0; $totsrn=0; $totstp=0; $totstcnf=0; $totinw=0; $totdisp=0; $totpret=0; $totstpo=0; $totstcnfo=0; $totloss=0; $tottdf=0; $tototw=0; $totopqty=0; $ccnt=0; $totclqty=0; $totivtin=0; $totivtout=0; $vtyp=""; $cirec=0;
	
	$crop1=$row_issuetbl['crop']; 
	$verty=$row_issuetbl['variety']; 
	$vtyp=$row_issuetbl['vertype']; 
	$totopqty=$row_issuetbl['opstock']; 
	$totfrn=$row_issuetbl['frnstock']; 
	$totsrn=$row_issuetbl['srinstock']; 
	$totstp=$row_issuetbl['stinplant']; 
	
	$totstcnf=$row_issuetbl['stincnf']; 
	$totivtin=$row_issuetbl['ivtin']; 
	$cirec=$row_issuetbl['cistock']; 
	$totinw=$row_issuetbl['totinstock']; 
	$totdisp=$row_issuetbl['salesstock']; 
	$totpret=$row_issuetbl['purretstock']; 
	$totstpo=$row_issuetbl['stoutplant']; 
	$totstcnfo=$row_issuetbl['stoutcnf']; 
	$tottdf=$row_issuetbl['tdfstock']; 
	$totivtout=$row_issuetbl['ivtout']; 
	$totloss=$row_issuetbl['totloss']; 
	$tototw=$row_issuetbl['totoutstock']; 
	$totclqty=$row_issuetbl['clstock']; 		
		
if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vtyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totopqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totfrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtin;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cirec;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totinw;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totdisp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpret?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstpo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnfo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tottdf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtout;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tototw?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totclqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vtyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totopqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totfrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtin;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cirec;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totinw;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totdisp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpret?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstpo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnfo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tottdf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtout;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tototw?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totclqty;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>			

<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-stockladgerbob.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>