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
	$txtptype=$_REQUEST['txtptype'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	if($txtpp=="C" || $txtpp=="CandF" || $txtpp=="CnF")	$txtpp="C&F";
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Periodical Party Type wise Sales Return Report</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
</head>
<body topmargin="0" >
 <table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_partytypewisesr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtptype=<?php echo $_REQUEST['txtptype']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table> 
<?php
$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="6" align="center" class="tblheading">Periodical Party Type wise Sales Return Report</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;State:&nbsp;<?php echo $txtstatesl?></td>
  <td align="right" class="tblheading">Party Type:&nbsp;<?php echo $txtpp?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<?php
$crp="ALL"; $variet="ALL";
	
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
?>
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $crp;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $variet;?>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="44" height="24" align="Center" class="tblheading">#</td>
	<td width="160" align="Center" class="tblheading">Crop</td>
	<td width="210" align="Center" class="tblheading">Variety</td>
	<td width="80" align="Center" class="tblheading">Total Qty</td>
	<td width="80" align="Center" class="tblheading">OK Qty</td>
	<td width="80" align="Center" class="tblheading">Fail Qty</td>
	<td width="80" align="Center" class="tblheading">UT Qty</td>
	</tr>
<?php
$srno=1; $mid=""; $cnt=0;
if($txtstatesl!="ALL")
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_state='".$txtstatesl."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$txtpp."'") or die(mysqli_error($link));
else
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and salesr_partytype='".$txtpp."'") or die(mysqli_error($link));
$tot_srretm=mysqli_num_rows($sql_srretm);
while($row_srretm=mysqli_fetch_array($sql_srretm))
{
if($mid!="")
$mid=$mid.",".$row_srretm['salesr_id'];
else
$mid=$row_srretm['salesr_id'];
}

if($mid==""){$mid='NULL';
$sqlsrrets="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id=$mid ";}
else{
$sqlsrrets="select distinct salesrs_variety, salesrs_crop from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id IN ($mid) ";}


if($crop!="ALL")
{
$sqlsrrets.=" and salesrs_crop='".$crop."' ";
}
if($variety!="ALL")
{
$sqlsrrets.=" and salesrs_variety='".$variety."' ";
}
$sqlsrrets.="  and salesrs_vflg=1 group by salesrs_variety order by salesrs_crop, salesrs_variety ";
$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
while($row_srrets=mysqli_fetch_array($sql_srrets))
{
$cropn=""; $varietyn=""; $totqty=0; $okqty=0; $failqty=0; $utqty=0; $lotnc=""; $lotnp="";
$sql_srretsub2=mysqli_query($link,"select distinct salesrs_newlot, salesrs_rettype from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id IN ($mid) and salesrs_vflg=1") or die(mysqli_error($link));
while($row_srretsub2=mysqli_fetch_array($sql_srretsub2))
{
	$ltno=$row_srretsub2['salesrs_newlot'];
	$ltno="'$ltno'";
	if($row_srretsub2['salesrs_rettype']=="P2C")
	{
		if($lotnc!="")
			$lotnc=$lotnc.",".$ltno;
		else
			$lotnc=$ltno;
	}
	if($row_srretsub2['salesrs_rettype']=="P2P")
	{
		if($lotnp!="")
			$lotnp=$lotnp.",".$ltno;
		else
			$lotnp=$ltno;
	}
}	
$sql_srretsub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_variety='".$row_srrets['salesrs_variety']."' and salesr_id IN ($mid) and salesrs_vflg=1") or die(mysqli_error($link));
while($row_srretsub=mysqli_fetch_array($sql_srretsub))
{
	/*$sql_srretss=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_srretsub['salesrs_id']."'") or die(mysqli_error($link));
	while($row_srretss=mysqli_fetch_array($sql_srretss))
	{
		if($row_srretsub['salesrs_qc']=="OK") 
		$okqty=$okqty+$row_srretss['salesrss_qty']; 
		
		if($row_srretsub['salesrs_qc']=="Fail") 
		$failqty=$failqty+$row_srretss['salesrss_qty'];
		
		if($row_srretsub['salesrs_qc']=="UT") 
		$utqty=$utqty+$row_srretss['salesrss_qty'];
	}*/
	
	$sql_srretss2=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_srretsub['salesrs_id']."'") or die(mysqli_error($link));
	while($row_srretss2=mysqli_fetch_array($sql_srretss2))
	{
		/*if($row_srretsub['salesrs_qc']=="OK") 
		$okqty=$okqty+$row_srretss2['salesrss_qty']; 
		
		if($row_srretsub['salesrs_qc']=="Fail") */
		$failqty=$failqty+$row_srretss2['salesrss_qty'];
		
		/*if($row_srretsub['salesrs_qc']=="UT") 
		$utqty=$utqty+$row_srretss2['salesrss_qty'];*/
	}
}	
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$row_srrets['salesrs_crop']."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT popularname FROM tblvariety  where varietyid='".$row_srrets['salesrs_variety']."' "); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	if($lotnc!="")
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND  lotldg_crop='".$row_srrets['salesrs_crop']."' and lotldg_variety='".$row_srrets['salesrs_variety']."' and lotldg_lotno IN($lotnc) and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trtype='Sales Return' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trtype='Sales Return' order by lotldg_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						if($row_issuetbl['lotldg_qc']=="OK") 
						$okqty=$okqty+$row_issuetbl['lotldg_balqty']; 
						
						if($row_issuetbl['lotldg_qc']=="Fail") 
						$failqty=$failqty+$row_issuetbl['lotldg_balqty'];
						
						if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT") 
						$utqty=$utqty+$row_issuetbl['lotldg_balqty'];
					}
				}
			}
		}
	}
	
	if($lotnp!="")
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where  plantcode='$plantcode' AND lotldg_crop='".$row_srrets['salesrs_crop']."' and lotldg_variety='".$row_srrets['salesrs_variety']."' and lotno IN($lotnp) and  (trtype='Sales Return' or trtype='SRRV') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and (trtype='Sales Return' or trtype='SRRV') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and (trtype='Sales Return' or trtype='SRRV') order by lotdgp_id asc") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0 and (trtype='Sales Return' or trtype='SRRV') order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						if($row_issuetbl['lotldg_qc']=="OK") 
						$okqty=$okqty+$row_issuetbl['balqty']; 
						
						if($row_issuetbl['lotldg_qc']=="Fail") 
						$failqty=$failqty+$row_issuetbl['balqty'];
						
						if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT") 
						$utqty=$utqty+$row_issuetbl['balqty'];
					}
				}
			}
		}
	}
	$totqty=$okqty+$failqty+$utqty;
if($srno%2==0)
{
?>	
<tr height="25">
	<td width="44" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $totqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $okqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $failqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $utqty;?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
	<td width="44" align="Center" class="tblheading"><?php echo $srno;?></td>
	<td width="160" align="Center" class="tblheading"><?php echo $cropn;?></td>
	<td width="210" align="Center" class="tblheading"><?php echo $varietyn;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $totqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $okqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $failqty;?></td>
	<td width="80" align="Center" class="tblheading"><?php echo $utqty;?></td>
</tr>
<?php
}
$srno=$srno+1;$cnt++;
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
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_partytypewisesr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtptype=<?php echo $_REQUEST['txtptype']?>&txtpp=<?php echo $_REQUEST['txtpp']?>&txtstatesl=<?php echo $_REQUEST['txtstatesl']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</body>
</html>
