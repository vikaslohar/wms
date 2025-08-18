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
	$txtpname=$_REQUEST['txtpname'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	$txtlocaion=$_REQUEST['txtlocaion'];
	$txtups=$_REQUEST['txtups'];
	$txtsrnno=$_REQUEST['txtsrnno'];
	
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	{$txtpp="C&F";}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Periodical Sales Return Report</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
</head>
<body topmargin="0" >
 <table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_periodsr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtpname=<?php echo $_REQUEST['txtpname']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>&txtlocaion=<?php echo $_REQUEST['txtlocaion']?>&txtups=<?php echo $_REQUEST['txtups']?>&txtsrnno=<?php echo $_REQUEST['txtsrnno']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table> 
<?php
$sd=split("-",$sdate);
$ed=split("-",$edate);
$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
$crp="ALL"; $variet="ALL"; $locname="ALL"; $pname="ALL"; $srnno="ALL";
	
if($crop!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crp=$row31['cropname'];		
}
if($variety!="ALL")
{
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variet=$rowvv['popularname'];
	}
	else
	{
		$variet=$variety;
	}
}
if($txtlocaion!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocaion."' order by productionlocation") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$locname=$row31['productionlocation'];		
}
if($txtpname!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtpname."' order by business_name") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$pname=$row31['business_name'];		
}	
if($txtsrnno!="ALL")
{
	$sql_crop=mysqli_query($link,"select * from tbl_salesrv where salesr_id='$txtsrnno' order by salesr_yearcode Asc, salesr_slrno ASC") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_crop);
	$srnno="SRN"."/".$row_tbl['salesr_yearcode']."/".sprintf("%00005d",$row_tbl['salesr_slrno']);
}	
?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="6" align="center" class="tblheading">Periodical Sales Return Report</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;State:&nbsp;<?php echo $txtstatesl?></td>
  <td align="right" class="tblheading">Location:&nbsp;<?php echo $locname?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Party Type:&nbsp;<?php echo $txtpp?></td>
  <td align="right" class="tblheading">Party Name:&nbsp;<?php echo $pname?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $crp;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $variet;?>&nbsp;&nbsp;</td>
</tr>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;UPS wise:&nbsp;<?php echo $txtups;?></td>
  <td align="right" class="tblheading">SRN No.:&nbsp;<?php echo $srnno;?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="29" height="24" align="Center" class="tblheading">#</td>
	<td width="72" align="Center" class="tblheading">Date</td>
	<td width="84" align="Center" class="tblheading">Party Type</td>
	<td width="93" align="Center" class="tblheading">Party Name</td>
	<td width="62" align="Center" class="tblheading">Location</td>
	<td width="50" align="Center" class="tblheading">SRN No.</td>
	<td width="43" align="Center" class="tblheading">State</td>
	<td width="39" align="Center" class="tblheading">Crop</td>
	<td width="57" align="Center" class="tblheading">Veriety</td>
	<td width="57" align="Center" class="smalltblheading">Lot No.</td>
	<?php if($txtups=="Yes"){?>
	<td width="48" align="Center" class="tblheading">UPS</td>
	<?php } ?>
	<td width="52" align="Center" class="tblheading">Total Qty</td>
	<td width="101" align="Center" class="tblheading">Actual Received Qty</td>
	<td width="72" align="Center" class="tblheading">Damage Qty</td>
	<td width="72" align="Center" class="tblheading">Ex.(+)/ Sh.(-) Qty</td>
	<td width="65" align="Center" class="smalltblheading">QC Status</td>
	<td width="65" align="Center" class="smalltblheading">QC DoT</td>
	<td width="65" align="Center" class="smalltblheading">Moist. %</td>
	<td width="65" align="Center" class="smalltblheading">Germ. %</td>
</tr>
<?php
$srno=1; $mid=""; $cnt=0;
$sq="select * from tbl_salesrv where salesr_trtype='Sales Return' ";
if($txtstatesl!="ALL")
$sq.=" and salesr_state='".$txtstatesl."' ";
if($txtlocaion!="ALL")
$sq.=" and salesr_loc='".$txtlocaion."' ";
if($txtpp!="ALL")
$sq.=" and salesr_partytype='".$txtpp."' ";
if($txtpname!="ALL")
$sq.=" and salesr_party='".$txtpname."' ";
if($txtsrnno!="ALL")
$sq.=" and salesr_id='".$txtsrnno."' ";

$sq.=" order by salesr_id ASC ";
$sql_srretm=mysqli_query($link,$sq) or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
	$mid=$row_srretm['salesr_id'];
	//echo $mid;
	if($txtups=="Yes")
	$sqlsrrets="select distinct salesrs_variety, salesrs_crop, salesrs_ups, salesrs_newlot, salesrs_id from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesr_id=$mid  and salesrs_vflg=1 ";
	else
	$sqlsrrets="select distinct salesrs_variety, salesrs_crop, salesrs_newlot, salesrs_id from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesr_id=$mid  and salesrs_vflg=1 ";
	
	if($crop!="ALL")
	{
		$sqlsrrets.=" and salesrs_crop='".$crop."' ";
	}
	if($variety!="ALL")
	{
		$sqlsrrets.=" and salesrs_variety='".$variety."' ";
	}
	if($txtups=="Yes")
	{
		//$sqlsrrets.=" group by salesrs_ups,salesrs_variety   ";
	}
	$sqlsrrets.="  order by salesrs_variety ";
	$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
	while($row_srrets=mysqli_fetch_array($sql_srrets))
	{
		$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $lotnp=""; $ups='';
		
		
		if($txtups=="Yes")
		{
			$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesrs_ups='".$row_srrets['salesrs_ups']."' and salesr_id='".$mid."' and salesrs_vflg=1 and salesrs_id='".$row_srrets['salesrs_id']."' ") or die(mysqli_error($link));
		}
		else
		{	
		$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_dovfy<='".$edt."' and salesrs_dovfy>='".$sdt."' and salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id='".$mid."' and salesrs_vflg=1 and salesrs_id='".$row_srrets['salesrs_id']."' ") or die(mysqli_error($link));
		}
		while($row_srretsub=mysqli_fetch_array($sql_srretsub))
		{
			if($row_srretsub['salesrs_typ']=="verrec") 
			$totqty=$totqty+$row_srretsub['salesrs_qty'];
			$okqty=$okqty+$row_srretsub['salesrs_qtydc']; 
			$failqty=$failqty+$row_srretsub['salesrs_qtydamage'];
			
			$ups=$row_srretsub['salesrs_ups'];
			
			$tdate=$row_srretsub['salesrs_dovfy'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$trdate=$tday."-".$tmonth."-".$tyear;
		}	
	
		$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets['salesrs_crop']."'");
		$noticia = mysqli_fetch_array($quer3);
		$cropn=$noticia['cropname'];
		 
		$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets['salesrs_variety']."' "); 
		$noticia_item = mysqli_fetch_array($quer4);
		$varietyn=$noticia_item['popularname'];
		
		/*$sql_srretsub2=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$rowsrretsub['salesr_id']."' and salesr_vflg=1") or die(mysqli_error($link));
		$row_srretsub2=mysqli_fetch_array($sql_srretsub2);*/
		
		//$ltno=$row_srretsub2['salesrs_newlot'];
		
		
		/*$tdate=$row_srretm['salesr_date'];
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$trdate=$tday."-".$tmonth."-".$tyear;*/
		$lotnos=$row_srrets['salesrs_newlot'];
		$ptype=$row_srretm['salesr_partytype'];
		
		$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_srretm['salesr_party']."' order by business_name")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month24);
		$panme=$noticia['business_name'];
		
		$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
		$noticia240 = mysqli_fetch_array($sql_month240);
		$locn=$noticia240['productionlocation'];
		if($ptype=="Export Buyer")
		$locn=$row_srretm['salesr_loc'];
		
		$srn_no="SRN"."/".$row_srretm['salesr_yearcode']."/".sprintf("%00005d",$row_srretm['salesr_slrno']);	
		$srstate=$row_srretm['salesr_state'];			
		//$totqty=$okqty+$failqty+$utqty;
		$exshqty=($okqty+$failqty)-$totqty;
		$qcsts=''; $dot=''; $germp=''; $moistp='';
		$sql_lot_ldg=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$row_srrets['salesrs_orlot']."' order by lotldg_id desc") or die(mysqli_error($link));
		$row_lot_ldg=mysqli_fetch_array($sql_lot_ldg);
		$tddate=explode("-",$row_lot_ldg['lotldg_qctestdate']);
		$dot=$tddate[2]."-".$tddate[1]."-".$tddate[0];
		if($dot=="00-00-0000" || $dot=="- -" || $dot=="--") {$dot="";}
		$qcsts=$row_lot_ldg['lotldg_qc'];
		$germp=$row_lot_ldg['lotldg_gemp']; 
		$moistp=$row_lot_ldg['lotldg_moisture'];
if($totqty>0 || $okqty>0)						
{
if($srno%2==0)
{
?>	
<tr height="25">
	<td width="29" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="72" align="Center" class="tblheading"><?php echo $trdate;?></td>
	<td width="84" align="Center" class="tblheading"><?php echo $ptype;?></td>
	<td width="93" align="Center" class="tblheading"><?php echo $panme;?></td>
	<td width="62" align="Center" class="tblheading"><?php echo $locn;?></td>
	<td width="50" align="Center" class="tblheading"><?php echo $srn_no;?></td>
	<td width="63" align="Center" class="tblheading"><?php echo $srstate;?></td>
	<td width="72" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="84" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<td width="99" align="Center" class="smalltbltext"><?php echo $lotnos;?></td>
	<?php if($txtups=="Yes"){?>
	<td width="93" align="Center" class="tblheading"><?php echo $ups;?></td>
	<?php }?>
	<td width="62" align="Center" class="tblheading"><?php echo $totqty;?></td>
	<td width="50" align="Center" class="tblheading"><?php echo $okqty;?></td>
	<td width="63" align="Center" class="tblheading"><?php echo $failqty;?></td>
	<td width="63" align="Center" class="tblheading"><?php echo $exshqty;?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $qcsts; ?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $dot;?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $moistp;?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $germp;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="29" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="72" align="Center" class="tblheading"><?php echo $trdate;?></td>
	<td width="84" align="Center" class="tblheading"><?php echo $ptype;?></td>
	<td width="93" align="Center" class="tblheading"><?php echo $panme;?></td>
	<td width="62" align="Center" class="tblheading"><?php echo $locn;?></td>
	<td width="50" align="Center" class="tblheading"><?php echo $srn_no;?></td>
	<td width="63" align="Center" class="tblheading"><?php echo $srstate;?></td>
	<td width="72" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="84" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<td width="99" align="Center" class="smalltbltext"><?php echo $lotnos;?></td>
	<?php if($txtups=="Yes"){?>
	<td width="93" align="Center" class="tblheading"><?php echo $ups;?></td>
	<?php }?>
	<td width="62" align="Center" class="tblheading"><?php echo $totqty;?></td>
	<td width="50" align="Center" class="tblheading"><?php echo $okqty;?></td>
	<td width="63" align="Center" class="tblheading"><?php echo $failqty;?></td>
	<td width="63" align="Center" class="tblheading"><?php echo $exshqty;?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $qcsts; ?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $dot;?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $moistp;?></td>
	<td width="65" align="Center" class="smalltbltext"><?php echo $germp;?></td>
</tr>
<?php
}
$srno=$srno+1;$cnt++;
}
}
}
if($cnt==0)
{
?>
<tr height="25">
	<td align="Center" class="tblheading" colspan="7">Record Not Found.</td>
</tr>
<?php
}
?>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_periodsr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtpname=<?php echo $_REQUEST['txtpname']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>&txtlocaion=<?php echo $_REQUEST['txtlocaion']?>&txtups=<?php echo $_REQUEST['txtups']?>&txtsrnno=<?php echo $_REQUEST['txtsrnno']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</body>
</html>
