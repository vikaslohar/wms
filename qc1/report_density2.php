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
	
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		//$txtpmcode=$_REQUEST['txtpmcode'];
		
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
	$qry="select * from tbl_density where density_date <='".$edate."' and density_date >='".$sdate."' ";
	
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.="and density_crop='$crp' ";
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.="and density_variety='$ver' ";
	}
	
	$qry.="  order by density_crop, density_variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
<title>QC Supervisor - Report - Periodical Density Report</title>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="850" align="right">&nbsp;&nbsp;<!--<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel_density.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onclick="window.close()" /></a>&nbsp;</td>
</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
   <tr class="Dark" height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Periodical Density Report</td>
  	</tr>
	<tr class="Dark" height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Period From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
  <tr class="Dark" height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?></td>
  	</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="2%" align="center" valign="middle" class="smalltblheading" >#</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Arrival Date</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Processing Date</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading" >Crop</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading" >Variety</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >SP Codes</td>
	<td align="center" valign="middle" class="smalltblheading" >Lot No.</td>
	<td width="3%" align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading"  >Condition Loss</td>
	<td align="center" valign="middle" class="smalltblheading"  >Condition Loss %</td>
	<td align="center" valign="middle" class="smalltblheading" >Blended Lot No.</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Density - Raw</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Density - Condition</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Remnant qty (kg)</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Remmamt %</td>
</tr>
<?php
$srno=1; $crop=""; $variety=""; $arrdate=''; $prdate=''; $spcodes=''; $lotno=""; $rawqty=''; $conqty=''; $conloss=''; $conlossper=''; $blendedlot=''; $rawdensity=''; $condensity=''; $remqty=''; $remper='';

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	
	$crop=$row_arr_home1['density_crop'];
	$variety=$row_arr_home1['density_variety'];
	$spcodes=$row_arr_home1['density_spcode'];
	$lotno=$row_arr_home1['density_lotno'];
	$rawqty=$row_arr_home1['density_rawqty']; 
	$conqty=$row_arr_home1['density_conqty']; 
	$conloss=$row_arr_home1['density_proloss'];
	$conlossper=$row_arr_home1['density_plossper'];
	$blendedlot=$row_arr_home1['density_blendedlot'];
	$rawdensity=$row_arr_home1['density_rawdensity']; 
	$condensity=$row_arr_home1['density_condensity']; 
	$remqty=$row_arr_home1['density_rqrltkg'];
	$remper=$row_arr_home1['density_remperlot'];
	
	$rdate=$row_arr_home1['density_arrdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$arrdate=$rday."-".$rmonth."-".$ryear;
	
	$rdate2=$row_arr_home1['density_prodate'];
	$ryear2=substr($rdate2,0,4);
	$rmonth2=substr($rdate2,5,2);
	$rday2=substr($rdate2,8,2);
	$prdate=$rday2."-".$rmonth2."-".$ryear2;
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcodes;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conlossper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendedlot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawdensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $condensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remper?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $spcodes;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conlossper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendedlot;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rawdensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $condensity;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $remper?></td>
</tr>

<?php
}
$srno=$srno++;
}
}
?>		  	
</table>
<br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;<!--img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<<a href="excel_density.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;</td>
</tr>
</table>
