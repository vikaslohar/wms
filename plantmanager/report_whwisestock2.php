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
	
	$txtslwhgo = $_REQUEST['txtslwhg'];
	$txtslbing = $_REQUEST['txtslbing'];
	$txtslsubbing2 = $_REQUEST['txtslsubbing2'];
	
	$txtslreptype = $_REQUEST['txtslreptype'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
	$txtstage = $_REQUEST['txtstage'];
	$sdate = $_REQUEST['sdate'];
	
	$sdate2=explode("-",$sdate);
	$sdate=$sdate2[2]."-".$sdate2[1]."-".$sdate2[0];
		

?>
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>Plant Manager-Report - Warehouse wise Stock Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--<a href="excel-whwise.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtslbing=<?php echo $_REQUEST['txtslbing']?>&txtslsubbing2=<?php echo $txtslsubbing2;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" />--></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="tblheading" style="color:#303918;">Warehouse wise Stock Report</td>
</tr>  
</table>
<?php
if($txtslreptype=="Detailed")
{
	//echo "Detailed";
	$warehouse="ALL"; $bin="ALL"; $sbin="ALL"; $totwh=""; $totbin="";
		
	if($txtslwhgo!="ALL")
	{	
		$qryw="Select Distinct lotldg_whid from tbl_lot_ldg where lotldg_trdate<='$sdate' and  lotldg_whid='$txtslwhgo' and plantcode='$plantcode'";
		$qryw1="Select Distinct whid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='$txtslwhgo' and plantcode='$plantcode'";
	}
	else
	{
		$qryw="Select Distinct lotldg_whid from tbl_lot_ldg where lotldg_trdate<='$sdate' and plantcode='$plantcode'";
		$qryw1="Select Distinct whid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and plantcode='$plantcode'";
	}
	$sql_arr_homew1=mysqli_query($link,$qryw) or die(mysqli_error($link));
 	$tot_arr_homew=mysqli_num_rows($sql_arr_homew1);
	while($row_arr_homew1=mysqli_fetch_array($sql_arr_homew1))
	{
		if($totwh!="")
			$totwh=$totwh.",".$row_arr_homew1['lotldg_whid'];
		else
			$totwh=$row_arr_homew1['lotldg_whid'];
	}
	$sql_arr_homew2=mysqli_query($link,$qryw1) or die(mysqli_error($link));
 	$tot_arr_homew2=mysqli_num_rows($sql_arr_homew2);
	while($row_arr_homew2=mysqli_fetch_array($sql_arr_homew2))
	{
		if($totwh!="")
			$totwh=$totwh.",".$row_arr_homew2['whid'];
		else
			$totwh=$row_arr_homew2['whid'];
	}
	//echo $totwh;
	$crp2="";
	$cpw=explode(",",$totwh);
	$cpw=array_unique($cpw);
	sort($cpw);
	//print_r($cpw);
	
	
foreach($cpw as $txtslwhg)
{
if($txtslwhg<>"" && $txtslwhg>0)
{

if($txtslbing!="ALL" && $txtslsubbing2!="ALL")
	{	
		$qry="Select Distinct lotldg_binid from tbl_lot_ldg where  lotldg_trdate<='$sdate' and lotldg_subbinid='$txtslsubbing2' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
		$qry1="Select Distinct binid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and subbinid='$txtslsubbing2' and binid='$txtslbing' and whid='$txtslwhg' and plantcode='$plantcode'";
	}
	else if($txtslbing!="ALL" && $txtslsubbing2=="ALL")
	{	
		$qry="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
		$qry1="Select Distinct binid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and binid='$txtslbing' and whid='$txtslwhg' and plantcode='$plantcode'";
	}
	else
	{
		$qry="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
		$qry1="Select Distinct binid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='$txtslwhg' and plantcode='$plantcode'";
	}
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		if($totbin!="")
			$totbin=$totbin.",".$row_arr_home1['lotldg_binid'];
		else
			$totbin=$row_arr_home1['lotldg_binid'];
	}
	$sql_arr_home2=mysqli_query($link,$qry1) or die(mysqli_error($link));
 	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		if($totbin!="")
			$totbin=$totbin.",".$row_arr_home2['binid'];
		else
			$totbin=$row_arr_home2['binid'];
	}
	$crp2="";
	$cp=explode(",",$totbin);
	$cp=array_unique($cp);
	sort($cp);
	
foreach($cp as $binval)
{
if($binval<>"" && $binval>0)
{


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$txtslwhg."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin=$row_binn['binname'];

if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where sid='".$txtslsubbing2."' and binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin=$row_subbinn1['sname'];
}

?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;WH: <?php echo $row_whouse['perticulars'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Bin: <?php echo $row_binn['binname'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Sub-Bin: <?php echo $sbin;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="5%"align="center" valign="middle" class="smalltblheading">WH</td> 
			  <td width="5%"align="center" valign="middle" class="smalltblheading">Bin</td> 
			  <td width="5%"align="center" valign="middle" class="smalltblheading">Subbin</td> 
			  <td width="7%"align="center" valign="middle" class="smalltblheading">Lotno</td> 
              <td width="13%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="18%" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="6%" align="center" valign="middle" class="smalltblheading">Var. Type</td>
			  <td width="6%" align="center" valign="middle" class="smalltblheading">Stage</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">QC status</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">DoT</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">GOT Status</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Seed Status</td>
</tr>

<?php
//	echo $row_rr['lotldg_variety'];
$srno=0;
if($txtslsubbing2!='ALL')
$sql_subbinn=mysqli_query($link,"select * from tbl_subbin where sid='".$txtslsubbing2."' and binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));
else
$sql_subbinn=mysqli_query($link,"select * from tbl_subbin where binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));

while($row_subbinn=mysqli_fetch_array($sql_subbinn))
{
	$sid=$row_subbinn['sid'];
	
	$sql_tb="select distinct lotldg_lotno from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_whid='".$txtslwhg."' and lotldg_binid='".$binval."' and lotldg_subbinid='".$sid."' and plantcode='$plantcode'";  
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_tb.=" and lotldg_sstage='$txtstage' ";  
		}
	}
	
	if($txtcrop!="ALL")
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_crop='$txtcrop' and lotldg_variety='$txtvariety' ";  
		}
		else
		{
			$sql_tb.=" and lotldg_crop='$txtcrop'  ";  
		}
	}
	/*else
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_variety='$txtvariety' ";  
		}
	}	*/
	
	$sql_tb.=" order by lotldg_subbinid";  
	
	$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
	while($row_tbl=mysqli_fetch_array($sql_qry))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_whid='".$txtslwhg."' and lotldg_binid='".$binval."' and lotldg_subbinid='".$sid."' and lotldg_lotno='".$row_tbl['lotldg_lotno']."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));  
		$t1=mysqli_num_rows($sql_tbl1);
		while($row_tbl1=mysqli_fetch_array($sql_tbl1))
		{
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));
			$total_tbl=mysqli_num_rows($sql1);
			if($total_tbl > 0)
			{
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
				
					//$lrole=$row_tbl_sub['arr_role'];
					$arrival_id=$row_tbl_sub['lotldg_trid'];
					
					$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";
				
					$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}
					
					$an=explode(".",$row_tbl_sub['lotldg_balqty']);
					if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}
				
								
					$lotno=$row_tbl_sub['lotldg_lotno'];
					$bags=$ac;
					$qty=$acn;
					$stage=$row_tbl_sub['lotldg_sstage'];
					$qc=$row_tbl_sub['lotldg_qc'];
					$moist=$row_tbl_sub['lotldg_moisture'];
					$gemp=$row_tbl_sub['lotldg_gemp'];
					$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
					$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
					$sststus=$row_tbl_sub['lotldg_sstatus'];
					$stage=$row_tbl_sub['lotldg_sstage'];
					if($row_tbl_sub['lotldg_srflg'] > 0)
					{
						if($sststus!="")$sststus=$sststus."/"."S";
						else $sststus="S";
					}
					$trdate1=$row_tbl_sub['lotldg_qctestdate'];
					$tryear1=substr($trdate1,0,4);
					$trmonth1=substr($trdate1,5,2);
					$trday1=substr($trdate1,8,2);
					$trdate1=$trday1."-".$trmonth1."-".$tryear1;
					if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
					$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
					$row_crop=mysqli_fetch_array($sql_crop);
					
					$varietytype='';	
					$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' ") or die(mysqli_error($link));
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
					$varietytype=$row_variety['vt'];
						
					if($gemp==0)$gemp="";
					if($moist==0)$moist="";
					if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_binn['binname']?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_binn['binname']?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
	$sql_tb="select distinct lotno from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='".$txtslwhg."' and binid='".$binval."' and subbinid='".$sid."' and plantcode='$plantcode'";  
	if($txtstage!="ALL")
	{
		if($txtstage=="Pack")
		{
			$sql_tb.=" and lotldg_sstage='$txtstage' ";  
		}
	}
	
	if($txtcrop!="ALL")
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_crop='$txtcrop' and lotldg_variety='$txtvariety' ";  
		}
		else
		{
			$sql_tb.=" and lotldg_crop='$txtcrop'  ";  
		}
	}
	/*else
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_variety='$txtvariety' ";  
		}
	}	*/
	
	$sql_tb.=" order by subbinid";  
	
	//$sql_tb="select distinct lotno from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='".$txtslwhg."' and binid='".$binval."' and subbinid='".$sid."' order by subbinid";  
	$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
	while($row_tbl=mysqli_fetch_array($sql_qry))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='".$txtslwhg."' and binid='".$binval."' and subbinid='".$sid."' and lotno='".$row_tbl['lotno']."' and plantcode='$plantcode' order by lotdgp_id desc") or die(mysqli_error($link));  
		$t1=mysqli_num_rows($sql_tbl1);
		while($row_tbl1=mysqli_fetch_array($sql_tbl1))
		{
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));
			$total_tbl=mysqli_num_rows($sql1);
			if($total_tbl > 0)
			{
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
				
					//$lrole=$row_tbl_sub['arr_role'];
					$arrival_id=$row_tbl_sub['lotdgp_id'];
					
					$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";
				
					$aq=explode(".",$row_tbl_sub['balnomp']);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['balnomp'];}
					
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
					$stage=$row_tbl_sub['lotldg_sstage'];
					if($row_tbl_sub['lotldg_srflg'] > 0)
					{
						if($sststus!="")$sststus=$sststus."/"."S";
						else $sststus="S";
					}
					$trdate1=$row_tbl_sub['lotldg_qctestdate'];
					$tryear1=substr($trdate1,0,4);
					$trmonth1=substr($trdate1,5,2);
					$trday1=substr($trdate1,8,2);
					$trdate1=$trday1."-".$trmonth1."-".$tryear1;
					if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
					$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
					$row_crop=mysqli_fetch_array($sql_crop);
					$varietytype='';	
					$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' ") or die(mysqli_error($link));
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
					$varietytype=$row_variety['vt'];
							
					if($gemp==0)$gemp="";
					if($moist==0)$moist="";
					if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bin?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>

	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bin?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
if($srno==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="tblheading" colspan="13">Empty Bin</td>
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
}
?>



<?php
}
else
{ //echo "Consolidated";
	$warehouse="ALL"; $bin="ALL"; $sbin="ALL"; $totwh=""; $totbin="";
		
	if($txtslwhgo!="ALL")
	{	
		$qryw="Select Distinct lotldg_whid from tbl_lot_ldg where lotldg_trdate<='$sdate' and  lotldg_whid='$txtslwhgo' and plantcode='$plantcode'";
		$qryw1="Select Distinct whid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='$txtslwhgo' and plantcode='$plantcode'";
	}
	else
	{
		$qryw="Select Distinct lotldg_whid from tbl_lot_ldg where lotldg_trdate<='$sdate' and plantcode='$plantcode'";
		$qryw1="Select Distinct whid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and plantcode='$plantcode'";
	}
	$sql_arr_homew1=mysqli_query($link,$qryw) or die(mysqli_error($link));
 	$tot_arr_homew=mysqli_num_rows($sql_arr_homew1);
	while($row_arr_homew1=mysqli_fetch_array($sql_arr_homew1))
	{
		if($totwh!="")
			$totwh=$totwh.",".$row_arr_homew1['lotldg_whid'];
		else
			$totwh=$row_arr_homew1['lotldg_whid'];
	}
	$sql_arr_homew2=mysqli_query($link,$qryw1) or die(mysqli_error($link));
 	$tot_arr_homew2=mysqli_num_rows($sql_arr_homew2);
	while($row_arr_homew2=mysqli_fetch_array($sql_arr_homew2))
	{
		if($totwh!="")
			$totwh=$totwh.",".$row_arr_homew2['whid'];
		else
			$totwh=$row_arr_homew2['whid'];
	}
	//echo $totwh;
	$crp2="";
	$cpw=explode(",",$totwh);
	$cpw=array_unique($cpw);
	sort($cpw);
	//print_r($cpw);
	
	
foreach($cpw as $txtslwhg)
{
if($txtslwhg<>"" && $txtslwhg>0)
{

if($txtslbing!="ALL" && $txtslsubbing2!="ALL")
	{	
		$qry="Select Distinct lotldg_binid from tbl_lot_ldg where  lotldg_trdate<='$sdate' and lotldg_subbinid='$txtslsubbing2' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
		$qry1="Select Distinct binid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and subbinid='$txtslsubbing2' and binid='$txtslbing' and whid='$txtslwhg' and plantcode='$plantcode'";
	}
	else if($txtslbing!="ALL" && $txtslsubbing2=="ALL")
	{	
		$qry="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_binid='$txtslbing' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
		$qry1="Select Distinct binid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and binid='$txtslbing' and whid='$txtslwhg' and plantcode='$plantcode'";
	}
	else
	{
		$qry="Select Distinct lotldg_binid from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_whid='$txtslwhg' and plantcode='$plantcode'";
		$qry1="Select Distinct binid from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='$txtslwhg' and plantcode='$plantcode'";
	}
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		if($totbin!="")
			$totbin=$totbin.",".$row_arr_home1['lotldg_binid'];
		else
			$totbin=$row_arr_home1['lotldg_binid'];
	}
	$sql_arr_home2=mysqli_query($link,$qry1) or die(mysqli_error($link));
 	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		if($totbin!="")
			$totbin=$totbin.",".$row_arr_home2['binid'];
		else
			$totbin=$row_arr_home2['binid'];
	}
	$crp2="";
	$cp=explode(",",$totbin);
	$cp=array_unique($cp);
	sort($cp);
	
foreach($cp as $binval)
{
if($binval<>"" && $binval>0)
{


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$txtslwhg."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$bin=$row_binn['binname'];

if($txtslsubbing2!='ALL')
{ 
$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where sid='".$txtslsubbing2."' and binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$sbin=$row_subbinn1['sname'];
}

?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;WH: <?php echo $row_whouse['perticulars'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Bin: <?php echo $row_binn['binname'];?>&nbsp;&nbsp;|&nbsp;&nbsp;Sub-Bin: <?php echo $sbin;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="5%"align="center" valign="middle" class="smalltblheading">WH</td> 
			  <td width="5%"align="center" valign="middle" class="smalltblheading">Bin</td> 
			  <td width="5%"align="center" valign="middle" class="smalltblheading">Subbin</td> 
			  <!--<td width="7%"align="center" valign="middle" class="smalltblheading">Lotno</td> -->
              <td width="13%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="18%" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="6%" align="center" valign="middle" class="smalltblheading">Var. Type</td>
			  <td width="6%" align="center" valign="middle" class="smalltblheading">Stage</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <!--<td width="5%" align="center" valign="middle" class="smalltblheading">QC status</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">DoT</td>
              <td width="9%" align="center" valign="middle" class="smalltblheading">GOT Status</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Seed Status</td>-->
</tr>

<?php
//	echo $row_rr['lotldg_variety'];
$srno=0;
if($txtslsubbing2!='ALL')
$sql_subbinn=mysqli_query($link,"select * from tbl_subbin where sid='".$txtslsubbing2."' and binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));
else
$sql_subbinn=mysqli_query($link,"select * from tbl_subbin where binid='".$binval."' and whid='".$txtslwhg."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));

while($row_subbinn=mysqli_fetch_array($sql_subbinn))
{
	$sid=$row_subbinn['sid'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";
	
	$sql_tb="select distinct lotldg_lotno from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_whid='".$txtslwhg."' and lotldg_binid='".$binval."' and lotldg_subbinid='".$sid."' and plantcode='$plantcode'";  
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_tb.=" and lotldg_sstage='$txtstage' ";  
		}
	}
	
	if($txtcrop!="ALL")
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_crop='$txtcrop' and lotldg_variety='$txtvariety' ";  
		}
		else
		{
			$sql_tb.=" and lotldg_crop='$txtcrop'  ";  
		}
	}
	else
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_variety='$txtvariety' ";  
		}
	}	
	
	$sql_tb.=" order by lotldg_subbinid";  
	
	$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
	while($row_tbl=mysqli_fetch_array($sql_qry))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_whid='".$txtslwhg."' and lotldg_binid='".$binval."' and lotldg_subbinid='".$sid."' and lotldg_lotno='".$row_tbl['lotldg_lotno']."' and plantcode='$plantcode' order by lotldg_id desc") or die(mysqli_error($link));  
		$t1=mysqli_num_rows($sql_tbl1);
		while($row_tbl1=mysqli_fetch_array($sql_tbl1))
		{
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_trdate<='$sdate' and lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));
			$total_tbl=mysqli_num_rows($sql1);
			if($total_tbl > 0)
			{
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
				
					//$lrole=$row_tbl_sub['arr_role'];
					$arrival_id=$row_tbl_sub['lotldg_trid'];
					
					
				
					$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}
					
					$an=explode(".",$row_tbl_sub['lotldg_balqty']);
					if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}
				
								
					$lotno=$row_tbl_sub['lotldg_lotno'];
					$bags=$bags+$ac;
					$qty=$qty+$acn;
					$stage=$row_tbl_sub['lotldg_sstage'];
					$qc=$row_tbl_sub['lotldg_qc'];
					$moist=$row_tbl_sub['lotldg_moisture'];
					$gemp=$row_tbl_sub['lotldg_gemp'];
					$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
					$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
					$sststus=$row_tbl_sub['lotldg_sstatus'];
					$stage=$row_tbl_sub['lotldg_sstage'];
					if($row_tbl_sub['lotldg_srflg'] > 0)
					{
						if($sststus!="")$sststus=$sststus."/"."S";
						else $sststus="S";
					}
					$trdate1=$row_tbl_sub['lotldg_qctestdate'];
					$tryear1=substr($trdate1,0,4);
					$trmonth1=substr($trdate1,5,2);
					$trday1=substr($trdate1,8,2);
					$trdate1=$trday1."-".$trmonth1."-".$tryear1;
					if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
					$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
					$row_crop=mysqli_fetch_array($sql_crop);
					
					$varietytype='';	
					$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' ") or die(mysqli_error($link));
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
					$varietytype=$row_variety['vt'];
						
					if($gemp==0)$gemp="";
					if($moist==0)$moist="";
					if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
				}
			}
		}
	}
if($qty>0)					
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_binn['binname']?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <!--<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_binn['binname']?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <!--<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>-->
</tr>

<?php
}
$srno=$srno+1;
}

	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $gemp=""; $sststus=""; $stage="";

	$sql_tb="select distinct lotno from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='".$txtslwhg."' and binid='".$binval."' and subbinid='".$sid."' and plantcode='$plantcode'";  
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_tb.=" and lotldg_sstage='$txtstage' ";  
		}
	}
	
	if($txtcrop!="ALL")
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_crop='$txtcrop' and lotldg_variety='$txtvariety' ";  
		}
		else
		{
			$sql_tb.=" and lotldg_crop='$txtcrop'  ";  
		}
	}
	else
	{
		if($txtvariety!="ALL")
		{
			$sql_tb.=" and lotldg_variety='$txtvariety' ";  
		}
	}	
	
	$sql_tb.=" order by subbinid";  
	
	//$sql_tb="select distinct lotno from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='".$txtslwhg."' and binid='".$binval."' and subbinid='".$sid."' order by subbinid";  
	$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
	while($row_tbl=mysqli_fetch_array($sql_qry))
	{
		$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and whid='".$txtslwhg."' and binid='".$binval."' and subbinid='".$sid."' and lotno='".$row_tbl['lotno']."' and plantcode='$plantcode' order by lotdgp_id desc") or die(mysqli_error($link));  
		$t1=mysqli_num_rows($sql_tbl1);
		while($row_tbl1=mysqli_fetch_array($sql_tbl1))
		{
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_trdate<='$sdate' and lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));
			$total_tbl=mysqli_num_rows($sql1);
			if($total_tbl > 0)
			{
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
				
					//$lrole=$row_tbl_sub['arr_role'];
					$arrival_id=$row_tbl_sub['lotdgp_id'];
				
					$aq=explode(".",$row_tbl_sub['balnomp']);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['balnomp'];}
					
					$an=explode(".",$row_tbl_sub['balqty']);
					if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['balqty'];}
				
								
					$lotno=$row_tbl_sub['lotno'];
					$bags=$bags+$ac;
					$qty=$qty+$acn;
					$stage=$row_tbl_sub['lotldg_sstage'];
					$qc=$row_tbl_sub['lotldg_qc'];
					$moist=$row_tbl_sub['lotldg_moisture'];
					$gemp=$row_tbl_sub['lotldg_gemp'];
					$ggoott=explode(" ",$row_tbl_sub['lotldg_got1']);
					$got=$ggoott[0]." ".$row_tbl_sub['lotldg_got'];
					$sststus=$row_tbl_sub['lotldg_sstatus'];
					$stage=$row_tbl_sub['lotldg_sstage'];
					if($row_tbl_sub['lotldg_srflg'] > 0)
					{
						if($sststus!="")$sststus=$sststus."/"."S";
						else $sststus="S";
					}
					$trdate1=$row_tbl_sub['lotldg_qctestdate'];
					$tryear1=substr($trdate1,0,4);
					$trmonth1=substr($trdate1,5,2);
					$trday1=substr($trdate1,8,2);
					$trdate1=$trday1."-".$trmonth1."-".$tryear1;
					if($trdate1=="--" || $trdate1== "00-00-0000")$trdate1="";
					$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
					$row_crop=mysqli_fetch_array($sql_crop);
					$varietytype='';	
					$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotldg_variety']."' ") or die(mysqli_error($link));
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
					$varietytype=$row_variety['vt'];
							
					if($gemp==0)$gemp="";
					if($moist==0)$moist="";
					if($qc=="RT" || $qc=="UT"){$gemp=""; $trdate1="";}
				}
			}
		}
	}	
if($qty>0)	
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bin?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
    <!--<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_whouse['perticulars'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bin?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_subbinn['sname'];?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crop['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variet;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietytype?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
   <!-- <td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sststus;?></td>-->
</tr>
<?php
}
$srno=$srno+1;
}
}
if($srno==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="tblheading" colspan="13">Empty Bin</td>
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
}
?>
<?php
}
?>
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--<a href="excel-whwise.php?txtslwhg=<?php echo $_REQUEST['txtslwhg']?>&txtslbing=<?php echo $_REQUEST['txtslbing']?>&txtslsubbing2=<?php echo $txtslsubbing2;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>