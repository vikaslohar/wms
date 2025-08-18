<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
		$txtqcstatus = $_REQUEST['txtqcstatus'];
		$txtgotstatus = $_REQUEST['txtgotstatus'];
		$txtprodgrade = $_REQUEST['txtprodgrade'];
		$txtqcstatus=stripslashes($txtqcstatus);
		$txtqcstatus=stripslashes($txtqcstatus);
		$txtgotstatus=stripslashes($txtgotstatus);
		$txtgotstatus=stripslashes($txtgotstatus);
		$txtprodgrade=stripslashes($txtprodgrade);
		$txtprodgrade=stripslashes($txtprodgrade);
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg where lotldg_sstage='Condition' and plantcode='$plantcode'";

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
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<title>CSW-ReportQuality  Based Condition Seed report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&txtqcstatus=<?php echo $_REQUEST['txtqcstatus']?>&txtgotstatus=<?php echo $_REQUEST['txtgotstatus']?>&txtprodgrade=<?php echo $_REQUEST['txtprodgrade']?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php

if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($txtqcstatus!="ALL" && $txtgotstatus!="ALL")
{	
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Condition' and lotldg_qc IN ($txtqcstatus) and lotldg_got IN ($txtgotstatus) and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
}
else if($txtqcstatus!="ALL" && $txtgotstatus=="ALL")
{	
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Condition' and lotldg_qc IN ($txtqcstatus) and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
}
else if($txtqcstatus=="ALL" && $txtgotstatus!="ALL")
{	
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Condition' and lotldg_got IN ($txtgotstatus) and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
}
else
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Condition' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));
}
//$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Condition'") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."'") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_rr['lotldg_variety'];
		}
				$ccnt=0;
				
if($txtqcstatus!="ALL" && $txtgotstatus!="ALL")
{	
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_qc IN ($txtqcstatus) and lotldg_got IN ($txtgotstatus) and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
else if($txtqcstatus!="ALL" && $txtgotstatus=="ALL")
{	
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_qc IN ($txtqcstatus) and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
else if($txtqcstatus=="ALL" && $txtgotstatus!="ALL")
{	
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_got IN ($txtgotstatus) and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
else
{
$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}				
//$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."'  and lotldg_sstage='Condition' and lotldg_balqty > 0 group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	while($row_arhome=mysqli_fetch_array($sql_arhome))
{  
	$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='Condition'  and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_is=mysqli_fetch_array($sql_is))
 { 
$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id asc ") or die(mysqli_error($link));
$row_is1=mysqli_fetch_array($sql_is1); 

$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_sstage='Condition' and lotldg_balqty > 0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_istbl);
if($t > 0)
{
	if($txtprodgrade!="ALL")
	{
	 	$qryarrsub="select * from tblarrival_sub where old=SUBSTRING('".$row_arhome['lotldg_lotno']."',2,6) and prodgrade IN ($txtprodgrade) and plantcode='$plantcode'";
		$sqlarrsub=mysqli_query($link,$qryarrsub) or die(mysqli_error($link));
		If($totarrsub=mysqli_num_rows($sqlarrsub)>0)
		{
			$ccnt++;
		}
	}
	else
	{
		$ccnt++;
	}
}
}
}
//echo $ccnt;
if($ccnt > 0)
{
// 		Table code for crop & variety wise lot numbers
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Crop Variety wise Condition Seed Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="25" align="center" valign="middle" class="smalltblheading">#</td>
		<td width="121"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
			<td width="70"  align="center" valign="middle" class="smalltblheading">NoB</td>
			<td width="89"  align="center" valign="middle" class="smalltblheading">Qty</td>
			<?php if($slchk=="yes") { ?>
			<td width="158"  align="center" valign="middle" class="smalltblheading">SLOC</td>
			<?php } ?>
			<td width="64"  align="center" valign="middle" class="smalltblheading">QC Status</td>
			<td width="59" align="center" valign="middle" class="smalltblheading">Moist %</td>
			<td width="84" align="center" valign="middle" class="smalltblheading">Germ %</td>
	        <td width="95"  align="center" valign="middle" class="smalltblheading">DoT</td>
			<td width="85"  align="center" valign="middle" class="smalltblheading">GOT Status</td>
			<td width="85"  align="center" valign="middle" class="smalltblheading">Production Location</td>
			<td width="85"  align="center" valign="middle" class="smalltblheading">State</td>
			<td width="76"  align="center" valign="middle" class="smalltblheading">Seed Status</td>
			<td width="2%" align="center" valign="middle" class="tblheading">Prod. Grade</td>
			<td width="73"  align="center" valign="middle" class="smalltblheading">GOT Grade</td>
			<?php if($slchk2=="yes") { ?>
			<td width="70"  align="center" valign="middle" class="smalltblheading">Arrival Date</td>
			<td width="70"  align="center" valign="middle" class="smalltblheading">Harvest Date</td>
			<?php } ?>
			</tr>

<?php
//	echo $row_rr['lotldg_variety'];


$srno=0; $totalbags=0; $totalqty=0;

if($txtqcstatus!="ALL" && $txtgotstatus!="ALL")
{	
$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_qc IN ($txtqcstatus) and lotldg_got IN ($txtgotstatus) and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
else if($txtqcstatus!="ALL" && $txtgotstatus=="ALL")
{	
$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_qc IN ($txtqcstatus) and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
else if($txtqcstatus=="ALL" && $txtgotstatus!="ALL")
{	
$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_got IN ($txtgotstatus) and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
else
{
$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_sstage='Condition'  and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
}
//	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."'  and lotldg_sstage='Condition' and lotldg_balqty > 0 group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{  $srno++;
$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $txtdot=""; $sloc="";
	$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  and lotldg_sstage='Condition' and lotldg_balqty > 0 and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 


$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id asc ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_sstage='Condition' and lotldg_balqty > 0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 //echo $row_issuetbl['lotldg_id']."<BR>";
  $cnt++;
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL")
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	else
	$totgot=$row_issuetbl['lotldg_got1'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	if($row_issuetbl['lotldg_srflg'] > 0)
	{
		if($totsst!="")$totsst=$totsst."/"."S";
		else
		$totsst="S";
	}
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";
	if($totgemp==0 || $totgemp=="") $totgemp="";
	


$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$row_issuetbl['lotldg_balbags'];
 $slqty=$row_issuetbl['lotldg_balqty'];
 $aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;
if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
}
}
}

$zzz=implode(",", str_split($row_arr_home['lotldg_lotno']));
$lt=$zzz[28].$zzz[30];

$lot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];

$z="00";
$lot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$z;

if($lt==00 || $lt=="00")
{
$lotn=$lot;
}
else
{
$lotn=$lot1;
}

$qry2="select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$variety."' and orlot='".$lotn."' and plantcode='$plantcode'";

$sql_rr=mysqli_query($link,$qry2) or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
$row_rr=mysqli_fetch_array($sql_rr);
$row_rr['arrsub_id'];	
$ploc=$row_rr['ploc'];	
$pstate=$row_rr['lotstate'];
$harvesdt=$row_rr['harvestdate'];
$prodgrade='';
$prodgrade=$row_rr['prodgrade'];


$gotgrade='';
//echo "select * from tbl_gotgrade where gotgrade_orlot='".$lot."'";	 
//
$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_orlot='".$lot."' and plantcode='$plantcode'") or die(mysqli_error($link));
if($tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade)>0)
{
	$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
	$gotgrade=$row_tbl_gotgrade['gotgrade_finalgrade'];
}
//echo "<br />";
$qry_tbl_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_oldlot='".$lot."' and plantcode='$plantcode'") or die(mysqli_error($link));
if($tot_tbl_gottest=mysqli_num_rows($qry_tbl_gottest)>0)
{
	$row_tbl_gottest=mysqli_fetch_array($qry_tbl_gottest);	
	if($row_tbl_gottest['grade']!='' && $row_tbl_gottest['grade']!=NULL && $row_tbl_gottest['grade']!='NULL')
	{$gotgrade=$row_tbl_gottest['grade'];}
}


$sql_arrmain=mysqli_query($link,"Select * from tblarrival where arrival_id='".$row_rr['arrival_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_arrmain=mysqli_fetch_array($sql_arrmain);

$ardt=$row_arrmain['arrival_date'];

	$rdate=$harvesdt;
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$harvesdt=$rday."-".$rmonth."-".$ryear;
	
	$rdate=$ardt;
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$ardt=$rday."-".$rmonth."-".$ryear;
if($harvesdt=="00-00-0000" || $harvesdt=="--")
	$harvesdt="";
if($ardt=="00-00-0000" || $ardt=="--")
	$ardt="";	
if($txtprodgrade!="ALL")
{
	$qryarrsub="select * from tblarrival_sub where old=SUBSTRING('".$row_arr_home['lotldg_lotno']."',2,6) and prodgrade IN ($txtprodgrade) and plantcode='$plantcode'";
	$sqlarrsub=mysqli_query($link,$qryarrsub) or die(mysqli_error($link));
	If($totarrsub=mysqli_num_rows($sqlarrsub)>0)
	{
		$cnt++;
	}
	else
	{
		$cnt=0;
	}
}
else
{
	$cnt++;
}
/*
$gotgrade='';
$sql_gottest=mysqli_query($link,"Select * from tbl_gottest where gottest_lotno='".$row_arr_home['lotldg_lotno']."'") or die(mysqli_error($link));
$row_gottest=mysqli_fetch_array($sql_gottest);
$gotgrade=$row_gottest['grade'];*/

if($totqty==0)$cnt=0;
//echo $cnt;
if($cnt>0)
{
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($totqc=="RT"){$txtdot=""; $totgemp="";}
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<?php if($slchk=="yes") { ?>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
			<?php } ?>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $pstate;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $prodgrade;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade;?></td>
			<?php if($slchk2=="yes") { ?>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $ardt;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $harvesdt;?></td>
			<?php } ?>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<?php if($slchk=="yes") { ?>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
			<?php } ?>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $pstate;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $prodgrade;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade;?></td>
			<?php if($slchk2=="yes") { ?>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $ardt;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $harvesdt;?></td>
			<?php } ?>
</tr>
<?php
}
//$srno=$srno++;
}else{$srno--;}
}
//}
?>
<tr class="Dark">
			<td align="center" valign="middle" class="smalltblheading" colspan="2">Total</td>
         	<td align="center" valign="middle" class="smalltblheading"><?php echo $totalbags?></td>
		   	<td align="center" valign="middle" class="smalltblheading"><?php echo $totalqty;?></td>
			<td align="center" valign="middle" class="smalltblheading" colspan="13">&nbsp;</td>
</tr>
</table>			
<br />
<?php
}
}
}
}
?>
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel-cropall.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&txtqcstatus=<?php echo $_REQUEST['txtqcstatus']?>&txtgotstatus=<?php echo $_REQUEST['txtgotstatus']?>&txtprodgrade=<?php echo $_REQUEST['txtprodgrade']?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
