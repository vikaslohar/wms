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
	
		$txtslwhg = $_REQUEST['txtslwhg'];
		$txtslbing = $_REQUEST['txtslbing'];
		$txtslsubbing2 = $_REQUEST['txtslsubbing2'];
		
$wh="ALL"; $bin="ALL"; $sbin="ALL";$wh1="ALL"; $bin1="ALL"; $sbin1="ALL";
	if($txtslwhg!='ALL')
	{ 
	if($txtslbing!="ALL" && $txtslsubbing2!="ALL")
	{	
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and subbinid='$txtslsubbing2' and binid='$txtslbing' and whid='$txtslwhg' order by whid";
	}
	else if($txtslbing!="ALL" && $txtslsubbing2=="ALL")
	{	
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and binid='$txtslbing' and whid='$txtslwhg' order by whid";
	}
	else
	{
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and whid='$txtslwhg' order by whid";
	}
	}
	else
	{
	$qry.="Select Distinct whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' order by whid";
	}
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

if($txtslwhg!='ALL')
{ 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$txtslwhg."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wh1=$row_whouse['perticulars'];
}
if($txtslbing!='ALL')
{ 	
$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$txtslbing."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin1=$row_binn['binname'];
}	
if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$txtslsubbing2."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin1=$row_subbinn1['sname'];
}
?>
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
<title>psw-ReportQuality  Based Raw Seed report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-whwise1.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtslbing=<?php echo $_REQUEST['txtslbing']?>&txtslsubbing2=<?php echo $_REQUEST['txtslsubbing2'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="tblheading" style="color:#303918;">Warehouse wise Pack Seed Report</td>
</tr>
<tr height="25" >
	<td align="center" class="tblheading" style="color:#303918;">WH: <?php echo $wh1;?>&nbsp;&nbsp;|&nbsp;&nbsp;Bin: <?php echo $bin1;?>&nbsp;&nbsp;|&nbsp;&nbsp;Sub-Bin: <?php echo $sbin1;?></td>
</tr>
</table> 
<?php
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wh=$row_whouse['perticulars'];
if($txtslbing!='ALL')
{ 
$sql_binp=mysqli_query($link,"Select Distinct binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and binid='$txtslbing' and whid='".$row_arr_home1['whid']."' order by binid") or die(mysqli_error($link));
}
else
{
$sql_binp=mysqli_query($link,"Select Distinct binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_sstage='Pack' and whid='".$row_arr_home1['whid']."' order by binid") or die(mysqli_error($link));
}
$tt=mysqli_num_rows($sql_binp);
while($row_binp=mysqli_fetch_array($sql_binp))
{

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_binp['binid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin=$row_binn['binname'];

if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$txtslsubbing2."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin=$row_subbinn1['sname'];
}

?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;WH: <?php echo $row_whouse['perticulars'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Bin: <?php echo $bin;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#0BC5F4" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="6%"align="center" valign="middle" class="smalltblheading">Subbin</td> 
			  <td width="13%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="16%" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <!--<td width="6%" align="center" valign="middle" class="smalltblheading">Stage</td>-->
              <td width="5%" align="center" valign="middle" class="smalltblheading">Size</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
             <!-- <td width="5%" align="center" valign="middle" class="smalltblheading">QC status</td>
              <td width="8%" align="center" valign="middle" class="smalltblheading">DoT</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Moist %</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Germ %</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">GOT Status</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Seed Status</td>-->
</tr>

<?php

$srno=0;
if($txtslsubbing2=='ALL')
{ 
$sql_tb="select distinct(subbinid) from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' and binid='".$row_binp['binid']."' and lotldg_sstage='Pack' order by subbinid";  
}
else
{
$sql_tb="select distinct(subbinid) from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' and binid='".$row_binp['binid']."' and subbinid='".$txtslsubbing2."'  and lotldg_sstage='Pack' order by subbinid";  
}

$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  

while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row_arr_home1['whid']."' and binid='".$row_binp['binid']."' and subbinid='".$row_tbl['subbinid']."' and lotldg_sstage='Pack' group by lotno order by lotdgp_id desc") or die(mysqli_error($link));  
$t1=mysqli_num_rows($sql_tbl1);
while($row_tbl1=mysqli_fetch_array($sql_tbl1))
{

$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_tbl1[0]."' and lotldg_sstage='Pack' and balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl['subbinid']."' and binid='".$row_binp['binid']."' and whid='".$row_arr_home1['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

		  
	$lrole=$row_tbl_sub['arr_role'];
	$arrival_id=$row_tbl_sub['lotldg_trid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";

$aq=explode(".",$row_tbl_sub['balnop']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['balnop'];}

$an=explode(".",$row_tbl_sub['balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['balqty'];}

				
		$lotno=$row_tbl_sub['lotno'];
		$bags=$ac;
		$qty=$acn;
		$stage=$row_tbl_sub['lotldg_sstage'];
		$qc=$row_tbl_sub['lotldg_qc'];
		$moist=$row_tbl_sub['lotldg_moisture'];
		$gemp=$row_tbl_sub['lotldg_gemp'];
		$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
		$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
		$sststus=$row_tbl_sub['lotldg_sstatus'];
		$upssize=$row_tbl_sub['packtype']; 
		$stage=$row_tbl_sub['lotldg_sstage'];
		if($row_tbl_sub['lotldg_srflg'] > 0)
		{
			if($sststus!="")$sststus=$sststus."/"."S";
			else
			$sststus="S";
		}
		$trdate1=$row_tbl_sub['lotldg_qctestdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		$tot_variety=mysqli_num_rows($sql_variety);
		if($tot_variety>0)
		{
		$variet=$row_variety['popularname'];
		}
		else
		{
		$variet=$row_tbl_sub['lotldg_variety'];
		}
			
if($gemp==0)$gemp="";
if($moist==0)$moist="";
if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
    <!--<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
   <!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gemp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>-->
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
if($srno==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="tblheading" colspan="6">Empty Bin</td>
</tr>
<?php
}
?>
</table>			
<br />
<?php
}
}
}
?>
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-whwise1.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtslbing=<?php echo $_REQUEST['txtslbing']?>&txtslsubbing2=<?php echo $_REQUEST['txtslsubbing2'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>