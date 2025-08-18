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
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct salesrs_crop from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_stage='Condition'";
	if($crop!="ALL")
	{	
	$qry.="and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by salesrs_crop order by salesrs_crop asc";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Pack Seed Pending Re-Validation Report</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
 <table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-srpprvlots.php?txtcrop=<?php echo $_REQUEST['crop']?>&txtvariety=<?php echo $_REQUEST['variety']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table> 
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return - Pack Seed Pending Re-Validation Report</td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="24" align="center" valign="middle" class="tblheading">#</td>
			<td width="66" align="center" valign="middle" class="tblheading">Date</td>
			<td width="85"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="127"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="115"  align="center" valign="middle" class="tblheading">Old Lot No.</td>
			<td width="110" align="center" valign="middle" class="tblheading">New Lot No.</td>
			<td width="45"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="40" align="center" valign="middle" class="tblheading">QC Status</td>
			<td width="65" align="center" valign="middle" class="tblheading">DoT</td>
			<td width="40" align="center" valign="middle" class="tblheading">Moist. %</td>
			<td width="40" align="center" valign="middle" class="tblheading">Germ. %</td>
			<td width="130" align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($variety!="ALL")
{
	$sql_arr_home=mysqli_query($link,"select distinct salesrs_variety from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$variety."' ") or die(mysqli_error($link));
}
else
{
	$sql_arr_home=mysqli_query($link,"select distinct salesrs_variety from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
}	
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$sql_arr_home2=mysqli_query($link,"select *  from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$row_arr_home['salesrs_variety']."' ") or die(mysqli_error($link));
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
	$crop2=""; $variety2="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['salesrs_variety']."' ") or die(mysqli_error($link));
	$rowvv=mysqli_fetch_array($sql_variety);
	$crop2=$row31['cropname'];
	$variety2=$rowvv['popularname'];
	
	$sql_osrmain=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_id='".$row_arr_home2['salesr_id']."'") or die(mysqli_error($link));
	$row_osrmain=mysqli_fetch_array($sql_osrmain);
	
	$dtd=explode("-", $row_osrmain['salesr_date']);
	$trdate=$dtd[2]."-".$dtd[1]."-".$dtd[0];
 	
	$dtd2=explode("-", $row_arr_home2['salesrs_dot']);
	$dot=$dtd2[2]."-".$dtd2[1]."-".$dtd2[0];
	
	$slnob=$row_arr_home2['salesrs_nob']; 
	$slqty=$row_arr_home2['salesrs_qty'];
	
	$diq=explode(".",$slqty);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}
	
	$din=explode(".",$slnob);
	if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
	
	$slocs="";
	$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_arr_home2['salesrs_id']."'") or die(mysqli_error($link));
	while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
	{
	
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sln=$row_salesvr_subsub['salesrss_nob']; 
	$slq=$row_salesvr_subsub['salesrss_qty'];
	
	$sloc=$wareh.$binn.$subbinn."  ".$sln." | ".$slq;
	
	if($slocs!="")
	$slocs=$slocs."<br/>".$sloc;
	else
	$slocs=$sloc;
	}
	
	
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop2;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_oldlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_newlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_moist']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_gemp']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop2;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_oldlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_newlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_moist']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_gemp']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
          </table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel-srpprvlots.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</body>
</html>
