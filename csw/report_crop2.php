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
	
	$edate=date("Y-m-d");
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
		
	$crp="ALL"; $ver="ALL";
	//$qry="select * from tbl_lot_ldg where lotldg_sstage='Condition' and lotldg_resverstatus=1 and lotldg_trdate<='$edate'";	
 
  $qry="select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_sstage='Condition' and lotldg_balqty > 0 and lotldg_resverstatus=1";

	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	?>

<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
<title>CSW - Report - Reserve Condition Seed Report</title>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="800" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;<a href="excel-arrival.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
   	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Reserve Seed Report - As on Date <?php echo date("d-m-Y");?></td>
  	</tr>
  	
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;&nbsp;</td>
  	</tr>
</table>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#fa8283" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="17" align="center" valign="middle" class="tblheading">#</td>
    <td width="83"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="207"  align="center" valign="middle" class="tblheading">Variety</td>
    <td width="106"  align="center" valign="middle" class="tblheading">Lot No.</td>
    <td width="40"  align="center" valign="middle" class="tblheading">NoB</td>
    <td width="52"  align="center" valign="middle" class="tblheading">Qty</td>
    <td width="57"  align="center" valign="middle" class="tblheading">QC status</td>
    <td width="53" align="center" valign="middle" class="tblheading">Moist %</td>
    <td width="72" align="center" valign="middle" class="tblheading">Germ %</td>
    <td width="66"  align="center" valign="middle" class="tblheading">DOT</td>
    <td width="66"  align="center" valign="middle" class="tblheading">GOT Status</td>
    <td width="45"  align="center" valign="middle" class="tblheading">Seed Status</td>
    <td width="58"  align="center" valign="middle" class="tblheading">Reserve Comment</td>
  </tr>
  <?php
$srno=1;

while($row_tbl_sub=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_tbl_sub['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_tbl_sub['lotldg_id'];
	
	
	
	$rdate=$row_tbl_sub['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$dot=$rday."-".$rmonth."-".$ryear;
	
	if($dot=="00-00-0000" || $dot=="--")
	$dot="";
	
	
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."'  order by popularname Asc"); 

$rowvv=mysqli_fetch_array($quer4);

   		$crop=$row31['cropname'];
		$variety=$rowvv['popularname'];
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$ac;
		$qty=$acn;
		$qc=$row_tbl_sub['lotldg_qc'];
		$got=$row_tbl_sub['lotldg_got1'];
		$stage=$row_tbl_sub['lotldg_sstage'];
		$per=$row_tbl_sub['lotldg_got1'];
		$loc1=$row_tbl_sub['lotldg_sstatus'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($loc1!="")$loc1=$loc1."/"."S";
			else
			$loc1="S";
		}
	if($srno%2!=0)
{

	
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="83" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="207" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
    <td width="106" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="52" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
    <td width="72" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_gemp']?></td>
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $dot?></td>
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="tblheading"><?php if($row_tbl_sub['lotldg_resverstatus'] > 0) {?><a href="javascript:void(0);" title="<?php echo $row_tbl_sub['lotldg_revcomment'];?>">Details</a><?php } else {?>Details<?php } ?></td>
    <!---->
  </tr
>
  <?php
}
else
{
?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
    <td width="83" align="center" valign="middle" class="tblheading"><?php echo $crop?></td>
    <td width="207" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
    <td width="106" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
    <td width="52" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_moisture'];?></td>
    <td width="72" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotldg_gemp']?></td>
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $dot?></td>
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $got?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
    <td align="center" valign="middle" class="tblheading"><?php if($row_tbl_sub['lotldg_resverstatus'] > 0) {?><a href="javascript:void(0);" title="<?php echo $row_tbl_sub['lotldg_revcomment'];?>">Details</a><?php } else {?>Details<?php } ?></td>
    <!---->
  </tr>
  <?php
}
$srno=$srno+1;
}
?>
</table>
<br/>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="800" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--<a href="excel-arrival.php?txtcrop=<?php echo $crop;?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>&txtvariety=<?php echo $variety;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>