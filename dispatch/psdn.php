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

	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_disp where plantcode='".$plantcode."' and  disp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['disp_id'];
$ptype=$row_tbl['disp_partytype'];

if($ptype=="Dealer" || $ptype=="Export Buyer")
{
$ntitle="Pack Seed Dispatch Note (PSDN)";
$ntyps="PSDN";
}
if($ptype=="C&F" || $ptype=="Branch")
{
$ntitle="Stock Transfer Dispatch Note (STDN)";
$ntyps="STDN";
}	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Direct Loading / Non-Allocation Type - <?php echo $ntyps;?></title>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
</head>
<body topmargin="0" >
<?php 
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;CIN:&nbsp;<?php echo $row_param['cin'];?>&nbsp;&nbsp;Seed License No.:&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<HR width="750" align="center" />
<?php
	$tdate=$row_tbl['disp_dodc'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['disp_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;

$sql23="select * from tbluser where plantcode='".$plantcode."' and  scode='".$row_tbl['disp_logid']."'";
$row_23=mysqli_query($link,$sql23) or die(mysqli_error($link));
$totalrow23= mysqli_num_rows($row_23);
$ObjRS23= mysqli_fetch_array($row_23);

$username=$ObjRS23['loginid'];
$emp_id = $ObjRS23['password']; 

		
$sql_opr=mysqli_query($link,"select * from tblopr where plantcode='".$plantcode."' and  login='$username' and BinARY pass like '".$emp_id."'") or die(mysqli_error($link));
$row_opr=mysqli_fetch_array($sql_opr);
$logname=$row_opr['name'];

$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
	
$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='$tid' and dnote_trtype='Dispatch Pack Seed' and dnote_ptype='$ptype'";
$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
$row_code1=mysqli_fetch_array($res_code1);

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

if($ptype=="Dealer" || $ptype=="Export Buyer")
$code1=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."SD"."/".sprintf("%004d",$row_code1['dnote_code']);
else
$code1=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."ST"."/".sprintf("%004d",$row_code1['dnote_code']);
	
$ordernos=""; $porefno="";  $veri=""; $ordernos2="";
$sql_arrsub=mysqli_query($link,"select * from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='".$pid."'") or die(mysqli_error($link));
$a_arrsub=mysqli_num_rows($sql_arrsub);
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
	if($ordernos!="")
	$ordernos=$ordernos.",".$row_arrsub['disps_ordno'];
	else
	$ordernos=$row_arrsub['disps_ordno'];
}
$sql_arrssub=mysqli_query($link,"select distinct dpss_variety from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='".$pid."'") or die(mysqli_error($link));
$a_arrssub=mysqli_num_rows($sql_arrssub);
while($row_arrssub=mysqli_fetch_array($sql_arrssub))
{	
	if($veri!="")
	$veri=$veri.",".$row_arrssub['dpss_variety'];
	else
	$veri=$row_arrssub['dpss_variety'];
}		

if($ordernos!="")
{
	$vid240=explode(",",$veri); 
	$tid240=explode(",",$ordernos); 
	//array_unique($tid240); 
	$tid240=array_keys(array_flip($tid240));
	//$ordernos=implode(",",$tid240);
	foreach($tid240 as $tid230)
	{
		if($tid230<>"")
		{
			$sqordm=mysqli_query($link,"Select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_porderno='$tid230'") or die(mysqli_error($link));
			$totordm=mysqli_num_rows($sqordm);
			while($rowordm=mysqli_fetch_array($sqordm))
			{
				$sqords=mysqli_query($link,"Select * from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id='".$rowordm['orderm_id']."'") or die(mysqli_error($link));
				$totords=mysqli_num_rows($sqords);
				while($rowords=mysqli_fetch_array($sqords))
				{
					$orver=$rowords['order_sub_variety'];
					if(in_array($orver,$vid240))
					{
						if($porefno!="")
							$porefno=$porefno.",".$rowordm['orderm_partyrefno'];
						else
							$porefno=$rowordm['orderm_partyrefno'];
						
						if($ordernos2!="")
							$ordernos2=$ordernos2.",".$rowordm['orderm_porderno'];
						else
							$ordernos2=$rowordm['orderm_porderno'];	
					}	
				}	
			}
		}
	}
}
if($porefno!="")
{
$tid24=explode(",",$porefno); 
$tid24=array_keys(array_flip($tid24));
$porefno=implode(",",$tid24);
}
if($ordernos2!="")
{
$tid24=explode(",",$ordernos2); 
$tid24=array_keys(array_flip($tid24));
$ordernos=implode(",",$tid24);
}
?> 

<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000"><?php echo $ntitle;?></font></td>
</tr>
</table><br />	  


<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Dispatch&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;<?php echo $ntyps;?> No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>
</tr>
<!--<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Dispatch Challan&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['disp_dcno'];?></td>
</tr>-->
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['disp_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
$country="";
if($noticia['classification']=="Export Buyer") 
{
	$sql_month2=mysqli_query($link,"select * from tblcountry where c_id='".$noticia['country']."' order by country")or die(mysqli_error($link));
	$noticia2 = mysqli_fetch_array($sql_month2);
	$country=$noticia2['country'];
}
?> 
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $noticia['business_name'];?><?php if($noticia['city']!="") { echo " ".$noticia['city']; }?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?><?php if($noticia['pin']!="" && $noticia['pin']>0) { echo " - ".$noticia['pin']."."; }?><?php if($noticia['classification']=="Export Buyer") { echo " (".$country.")"; }?> <?php if($noticia['phone']!="" && $noticia['phone']>0) { echo " Ph - 0".$noticia['std']."-".$noticia['phone']; }?><?php if($noticia['mob']!="" && $noticia['mob']>0) { echo " M - ".$noticia['mob']; }?></div></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">GSTIN&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><?php if($noticia['gstin']!="") { echo $noticia['gstin']; }?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Supplier's Reference No&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $porefno;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Order number(s)&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $ordernos;?></td>
</tr>
</table>
<br />
<?php
$vid="";
$sqlarrhome=mysqli_query($link,"select distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and  disp_id='$tid' and disps_flg=1 order by disps_crop ASC, disps_variety asc") or die(mysqli_error($link));
$totarrhome=mysqli_num_rows($sqlarrhome);
while($rowarrhome=mysqli_fetch_array($sqlarrhome))
{
	$sql_var=mysqli_query($link,"SELECT varietyid FROM tblvariety where popularname='".$rowarrhome['disps_variety']."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	if($vid!="")
	$vid=$vid.",".$row_var['varietyid'];
	else
	$vid=$row_var['varietyid'];
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Dispatch Details</td>
</tr>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Lot No.</td>
	<td width="275" align="center"  valign="middle" class="tbltext">DoT</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Validity Date</td>
	<td width="275" align="center"  valign="middle" class="tbltext">MP Type</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoMP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Total NoMP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Total Qty</td>
</tr>
<?php 
$sn=1; $totnomp=0; $totqty=0; $tnopc=0; $tnopb=0; 
$vids=explode(",", $vid);
foreach($vids as $vrid)
{
if($vrid<>"")
{



$sql_arr_home=mysqli_query($link,"select distinct dpss_variety from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='$tid' and dpss_variety='$vrid' and (dpss_barcodetype='SMC' or dpss_barcodetype='NMC')") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

$nvariety="";
$sql_arr_home3=mysqli_query($link,"select distinct dpss_ups from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='$tid' and dpss_variety='".$row_arr_home['dpss_variety']."' and (dpss_barcodetype='SMC' or dpss_barcodetype='NMC')") or die(mysqli_error($link));
$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
{

$nups=0; $nnob1=0; $nqty1=0; $lotno1=""; $tnob=0; $tqty=0; $dov=""; $tnomp=0; $dot="";  $nnob2=0; $nqty2=0; $nobtp="";
$sql_sub=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  dpss_variety='".$row_arr_home['dpss_variety']."' and dpss_ups='".$row_arr_home3['dpss_ups']."' and disp_id='$tid' and (dpss_barcodetype='SMC' or dpss_barcodetype='NMC')") or die(mysqli_error($link));
$zxc=mysqli_num_rows($sql_sub);
while($row_sub=mysqli_fetch_array($sql_sub))
{

//$sqq23=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where disps_id='".$row_sub['disps_id']."'") or die(mysqli_error($link));
//while($roo23=mysqli_fetch_array($sqq23))
//{
$nmp=1; $nnob=0; $nqty=0; $lotno=""; $nobtyp=""; 
$sqq=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  dpss_variety='".$row_arr_home['dpss_variety']."' and dpss_ups='".$row_arr_home3['dpss_ups']."' and disp_id='$tid' and (dpss_barcodetype='SMC' or dpss_barcodetype='NMC') and dpss_lotno='".$row_sub['dpss_lotno']."'") or die(mysqli_error($link));

while($roo=mysqli_fetch_array($sqq))
{

$sqq23=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and  disps_id='".$roo['disps_id']."'") or die(mysqli_error($link));
$roo23=mysqli_fetch_array($sqq23);
$nvariety=$roo23['disps_nvariety']; 
$crpnm=$roo['dpss_crop'];  

$nups=$roo['dpss_ups']; 
//$tnomp=$tnomp+$row_sub['disps_nomp']; 
//$totqty=$totqty+$row_sub['disps_qty']; 


/*if($lotno!="")
$lotno=$lotno."<br />".$roo['dpss_lotno'];
else*/
$lotno=$roo['dpss_lotno'];
/*if($nnob!="")
$nnob=$nnob."<br />".$nmp; 
else*/
$nnob=$nnob+$nmp;
//$tnomp=$nnob;
/*if($nqty!="")
$nqty=$nqty."<br />".$roo['dpss_qty']; 
else*/
$nqty=$nqty+$roo['dpss_qty']; 

$tqty=$tqty+$roo['dpss_qty']; 
//$tnon=$tnob+$roo['dpss_nob'];

$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crpnm."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);
$crop=$row_crp['cropname'];
		
$sql_var=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_arr_home['dpss_variety']."' and actstatus='Active' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);
$variety=$row_var['popularname'];

if($nvariety=="")$nvariety=$variety;

if($roo['dpss_barcodetype']=="SMC")
{
$packtp=explode(" ",$nups);
$srnonew=0; $uom="";
$p1_array=explode(",",$row_var['gm']);
$p1_array2=explode(",",$row_var['mtype']);
foreach($p1_array as $val1)
{
	if($val1<>"")
	{
		$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
		$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
		if($row1234=mysqli_num_rows($res)>0)
		{
			$nobtyp=$p1_array2[$srnonew];
			if($nobtyp=="Carton")
			{$tnopc=$tnopc+$nmp;}
			else if($nobtyp=="Bag")
			{$tnopb=$tnopb+$nmp;}
			else
			{$tnopc=$tnopc+$nmp;}
		}
	}
	$srnonew++;
}
}
else
{
	$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$roo['dpss_barcode']."'") or die(mysqli_error($link));
	$totbarcode=mysqli_num_rows($sqlbarcode);
	$rowbarcode=mysqli_fetch_array($sqlbarcode);
	$nobtyp=$rowbarcode['mpmain_mptype'];
	if($nobtyp=="Carton")
	{$tnopc=$tnopc+$nmp;}
	else if($nobtyp=="Bag")
	{$tnopb=$tnopb+$nmp;}
	else
	{$tnopc=$tnopc+$nmp;}
}

$vflg=0; $dot1=""; $dov1=""; $dot12="";
	
$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$crpnm' and lotldg_variety='".$row_arr_home['dpss_variety']."' and lotno='".$roo['dpss_lotno']."'")or die("Error:".mysqli_error($link));
$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
$rowmonth3=mysqli_fetch_array($sqlmonth3);

$qc=$rowmonth3['lotldg_qc'];

$tdate2=$roo['dpss_dov'];
$tyear2=substr($tdate2,0,4);
$tmonth2=substr($tdate2,5,2);
$tday2=substr($tdate2,8,2);
$dov1=$tday2."-".$tmonth2."-".$tyear2;

$dot12=$roo['dpss_dot'];
$trdate=explode("-",$roo['dpss_dot']);
$dot12=$trdate[2]."-".$trdate[1]."-".$trdate[0];
/*if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT"))
{
	$vflg++; 
}
if($vflg>0)
{*/
	$zz=str_split($roo['dpss_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qcdot2=""; $trdate23=""; $trdate24="";
	
	$sql_pnp2=mysqli_query($link,"Select max(pnpslipsub_id) from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='".$roo['dpss_lotno']."' order by pnpslipsub_id desc") or die(mysqli_error($link));
	$row_pnp2=mysqli_fetch_array($sql_pnp2);
	
	$sql_pnp=mysqli_query($link,"Select pnpslipsub_qcdot from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='".$roo['dpss_lotno']."' and pnpslipsub_id='".$row_pnp2[0]."' order by pnpslipsub_qcdot desc") or die(mysqli_error($link));
	$row_pnp=mysqli_fetch_array($sql_pnp);
	if($tot_pnp=mysqli_num_rows($sql_pnp)>0)
	{
		$trdate23=$row_pnp['pnpslipsub_qcdot'];
		if($trdate23!="0000-00-00" && $trdate23!="--" && $trdate23!="- -" && $trdate23!="")
		{
			$trdate=explode("-",$trdate23);
			$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
	}
	
	$sqlpnp2=mysqli_query($link,"Select max(rv_id) from tbl_revalidate where plantcode='".$plantcode."' and  rv_newlot='".$roo['dpss_lotno']."' order by rv_id desc ") or die(mysqli_error($link));
	$rowpnp2=mysqli_fetch_array($sqlpnp2);
	
	$sqlpnp=mysqli_query($link,"Select rv_dot from tbl_revalidate where plantcode='".$plantcode."' and  rv_newlot='".$roo['dpss_lotno']."' and rv_id='".$rowpnp2[0]."' order by rv_dot desc ") or die(mysqli_error($link));
	$rowpnp=mysqli_fetch_array($sqlpnp);
	if($totpnp=mysqli_num_rows($sqlpnp)>0)
	{
		$trdate24=$rowpnp['rv_dot'];
		if($trdate24!="0000-00-00" && $trdate24!="--" && $trdate24!="- -" && $trdate24!="")
		{
			if($trdate23!="" && ($trdate24>$trdate23))
			{ 
				$trdate24=explode("-",$trdate24);
				$qcdot2=$trdate24[2]."-".$trdate24[1]."-".$trdate24[0];
			}
		}
	}
	if($qcdot2=="")
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
		}
	}

if($qcdot2!="")	$dot12=$qcdot2;
//}
	
$trdate6=explode("-",$dot12);
$tryear6=$trdate6[2];
$trmonth6=$trdate6[1];
$trday6=$trdate6[0];
$dot1=$trday6."-".$trmonth6."-".$tryear6;


$mpt=$roo['dpss_barcodetype']."/C";
if($nobtyp=="Carton")
$mpt=$roo['dpss_barcodetype']."/C";
if($nobtyp=="Bag")
$mpt=$roo['dpss_barcodetype']."/B";
}				
if($dot!="")
$dot=$dot."<br />".$dot1;
else
$dot=$dot1;

if($dov!="")
$dov=$dov."<br />".$dov1;
else
$dov=$dov1;


if($lotno1!="")
$lotno1=$lotno1."<br />".$ltno;
else
$lotno1=$ltno;

if($nnob1!="")
$nnob1=$nnob1."<br />".$nnob; 
else
$nnob1=$nnob;

if($nobtp!="")
$nobtp=$nobtp."<br />".$mpt; 
else
$nobtp=$mpt;

$tnomp=$tnomp+$nnob;
if($nqty1!="")
$nqty1=$nqty1."<br />".$nqty; 
else
$nqty1=$nqty;

if($nnob2!="")
$nnob2=$nnob2+$nnob; 
else
$nnob2=$nnob;

if($nqty2!="")
$nqty2=$nqty2+$nqty; 
else
$nqty2=$nqty;

}
//}
//}

$dq=explode(" ",$nups);
$dqs=explode(".",$dq[0]);
if($dqs[1]>0)
$aqs=$dqs[0].".".$dqs[1];
else
$aqs=$dqs[0];
$nups=$aqs." ".$dq[1];

$totnomp=$totnomp+$tnomp; 
$totqty=$totqty+$tqty; 
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $crop?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nvariety?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nups;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotno1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dov;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nobtp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob2;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty2;?>&nbsp;Kgs.</td>
</tr>
<?php
$sn++;
}
}
}


}
}





/*$sql_sub=mysqli_query($link,"Select distinct dpss_barcode from tbl_dispsub_sub where disp_id='$tid' and dpss_barcodetype!='SMC' and dpss_barcodetype!='NMC'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
$nups=0; $nnob1=0; $nqty1=0; $lotno1=""; $tnob=0; $tqty=0; $dov=""; $tnomp=0; $dot="";  $nnob2=0; $nqty2=0; $nobtp="";$crpval=""; $verval=""; $upsval="";
$nmp=1; 
$sqq23=mysqli_query($link,"Select distinct dpss_lotno from tbl_dispsub_sub where disp_id='$tid' and dpss_barcodetype!='SMC' and dpss_barcodetype!='NMC' and dpss_barcode='".$row_sub['dpss_barcode']."'") or die(mysqli_error($link));
while($roo23=mysqli_fetch_array($sqq23))
{
$nnob=0; $nqty=0; $lotno=""; $nobtyp="";
$sqq=mysqli_query($link,"Select * from tbl_dispsub_sub where disp_id='$tid' and dpss_barcodetype!='SMC' and dpss_barcodetype!='NMC' and dpss_lotno='".$roo23['dpss_lotno']."' and dpss_barcode='".$row_sub['dpss_barcode']."'") or die(mysqli_error($link));

while($roo=mysqli_fetch_array($sqq))
{

$sqq233=mysqli_query($link,"Select disps_nvariety from tbl_disp_sub where disps_id='".$roo['disps_id']."'") or die(mysqli_error($link));
$roo233=mysqli_fetch_array($sqq233);
$nvariety=$roo233['disps_nvariety']; 
echo $roo['dpss_qty']; 
$nnob=$nmp;
$nqty=$nqty+$roo['dpss_qty']; 
	
$tqty=$tqty+$roo['dpss_qty']; 


$vflg=0; $dot1=""; $dov1=""; $dot12="";
	
$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where lotldg_crop='$crpnm' and lotldg_variety='".$roo['dpss_variety']."' and lotno='".$roo['dpss_lotno']."'")or die("Error:".mysqli_error($link));

$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
$rowmonth3=mysqli_fetch_array($sqlmonth3);

$qc=$rowmonth3['lotldg_qc'];

$tdate2=$roo['dpss_dov'];
$tyear2=substr($tdate2,0,4);
$tmonth2=substr($tdate2,5,2);
$tday2=substr($tdate2,8,2);
$dov1=$tday2."-".$tmonth2."-".$tyear2;

$trdate=explode("-",$roo['dpss_dot']);
$dot12=$trdate[2]."-".$trdate[1]."-".$trdate[0];

	
	$crpnm=$rowmonth3['lotdgp_crop'];  
	$nups=$rowmonth3['packtype']; 
	$lotno=$rowmonth3['lotno'];
	
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crpnm."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
			
	$sql_var=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$rowmonth3['lotdgp_variety']."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	if($nvariety=="")$nvariety=$variety;
	
	$packtp=explode(" ",$nups);
	$srnonew=0; $uom="";
	$p1_array=explode(",",$row_var['gm']);
	$p1_array2=explode(",",$row_var['mtype']);
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			if($row1234=mysqli_num_rows($res)>0)
			{
				$nobtyp=$p1_array2[$srnonew];
				if($nobtyp=="Carton")
				$tnopc=$tnopc+$nmp;
				if($nobtyp=="Bag")
				$tnopb=$tnopb+$nmp;
			}
		}
		$srnonew++;
	}

	
	
	$zz=str_split($rowmonth3['lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qcdot2=""; $trdate23=""; $trdate24="";
	
	$sql_pnp2=mysqli_query($link,"Select max(pnpslipsub_id) from tbl_pnpslipsub where pnpslipsub_plotno='".$rowmonth3['lotno']."' order by pnpslipsub_id desc") or die(mysqli_error($link));
	$row_pnp2=mysqli_fetch_array($sql_pnp2);
	
	$sql_pnp=mysqli_query($link,"Select pnpslipsub_qcdot from tbl_pnpslipsub where pnpslipsub_plotno='".$rowmonth3['lotno']."' and pnpslipsub_id='".$row_pnp2[0]."' order by pnpslipsub_qcdot desc") or die(mysqli_error($link));
	$row_pnp=mysqli_fetch_array($sql_pnp);
	if($tot_pnp=mysqli_num_rows($sql_pnp)>0)
	{
		$trdate23=$row_pnp['pnpslipsub_qcdot'];
		if($trdate23!="0000-00-00" && $trdate23!="--" && $trdate23!="- -" && $trdate23!="")
		{
			$trdate=explode("-",$trdate23);
			$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
	}
	
	$sqlpnp2=mysqli_query($link,"Select max(rv_id) from tbl_revalidate where rv_newlot='".$rowmonth3['lotno']."' order by rv_id desc ") or die(mysqli_error($link));
	$rowpnp2=mysqli_fetch_array($sqlpnp2);
	
	$sqlpnp=mysqli_query($link,"Select rv_dot from tbl_revalidate where rv_newlot='".$rowmonth3['lotno']."' and rv_id='".$rowpnp2[0]."' order by rv_dot desc ") or die(mysqli_error($link));
	$rowpnp=mysqli_fetch_array($sqlpnp);
	if($totpnp=mysqli_num_rows($sqlpnp)>0)
	{
		$trdate24=$rowpnp['rv_dot'];
		if($trdate24!="0000-00-00" && $trdate24!="--" && $trdate24!="- -" && $trdate24!="")
		{
			if($trdate23!="" && ($trdate24>$trdate23))
			{ 
				$trdate24=explode("-",$trdate24);
				$qcdot2=$trdate24[2]."-".$trdate24[1]."-".$trdate24[0];
			}
		}
	}
	if($qcdot2=="")
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
		}
	}

if($qcdot2!="")	$dot12=$qcdot2;
//}
	
$trdate6=explode("-",$dot12);
$tryear6=$trdate6[2];
$trmonth6=$trdate6[1];
$trday6=$trdate6[0];
$dot1=$trday6."-".$trmonth6."-".$tryear6;


$mpt=$roo['dpss_barcodetype']."/C";
if($nobtyp=="Carton")
$mpt=$roo['dpss_barcodetype']."/C";
if($nobtyp=="Bag")
$mpt=$roo['dpss_barcodetype']."/B";
}				
if($dot!="")
$dot=$dot."<br />".$dot1;
else
$dot=$dot1;

if($dov!="")
$dov=$dov."<br />".$dov1;
else
$dov=$dov1;


if($lotno1!="")
$lotno1=$lotno1."<br />".$lotno;
else
$lotno1=$lotno;

if($nnob1!="")
$nnob1=$nnob1."<br />".$nnob; 
else
$nnob1=$nnob;

if($nobtp!="")
$nobtp=$nobtp."<br />".$mpt; 
else
$nobtp=$mpt;

$tnomp=$nnob;
if($nqty1!="")
$nqty1=$nqty1."<br />".$nqty; 
else
$nqty1=$nqty;

if($nnob2!="")
$nnob2=$nnob2+$nnob; 
else
$nnob2=$nnob;

if($crpval!="")
$crpval=$crpval+$crop; 
else
$crpval=$crop;

if($verval!="")
$verval=$verval+$nvariety; 
else
$verval=$nvariety;

if($upsval!="")
$upsval=$upsval+$nups; 
else
$upsval=$nups;
}
//}
//}

$dq=explode(" ",$nups);
$dqs=explode(".",$dq[0]);
if($dqs[1]>0)
$aqs=$dqs[0].$dqs[1];
else
$aqs=$dqs[0];
$nups=$aqs." ".$dq[1];



$totnomp=$totnomp+$tnomp; 
$totqty=$totqty+$tqty; 
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $crpval?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $verval?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upsval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotno1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dov;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nobtp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob2;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty2;?>&nbsp;Kgs.</td>
</tr>
<?php
$sn++;
}
//}
//}
//}
*/

$sql_sub=mysqli_query($link,"Select distinct dpss_barcode from tbl_dispsub_sub where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  disp_id='$tid' and dpss_barcodetype!='SMC' and dpss_barcodetype!='NMC'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{



$barcodes=$row_sub['dpss_barcode'];
if($barcodes!="")
{
	$barcodes=$barcodes.",";
	$barc=explode(",",$barcodes);
	foreach($barc as $barcode)
	{
	if($barcode<>"")
	{
	$sqlbarc1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."'") or die(mysqli_error($link));
	$totbarc1=mysqli_num_rows($sqlbarc1);
	$rowbarc1=mysqli_fetch_array($sqlbarc1);
	if($totbarc1>0)
	{
		$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
		$totbarcode=mysqli_num_rows($sqlbarcode);
		$rowbarcode=mysqli_fetch_array($sqlbarcode);
		$grwts2=$rowbarcode['bar_grosswt'];
		
		
		$pty=$rowbarc1['mpmain_trtype'];
		if($pty=="PACKSMC") $packtyp="SMC";
		if($pty=="PACKLMC") $packtyp="LMC";
		if($pty=="PACKMMC") $packtyp="MMC";
		if($pty=="PACKNMC")	$packtyp="NMC";
		if($pty=="PACKNLC") $packtyp="NLC";
		
		$cropval=""; $varietyval=""; $lotval=""; $upsval=""; $qcval=""; $dotval=""; $dovval=""; $nnob1=1; $nqty1=""; $nnob2=0; $nqty2=0;
		
		$nobtyp=$rowbarc1['mpmain_mptype'];
		if($nobtyp=="Carton")
			{$tnopc=$tnopc+$nnob1;}
		else if($nobtyp=="Bag")
			{$tnopb=$tnopb+$nnob1;}
		else
			{$tnopc=$tnopc+$nnob1;}	
				
		$mpt=$packtyp."/C";
		if($nobtyp=="Carton")
			$mpt=$packtyp."/C";
		if($nobtyp=="Bag")
			$mpt=$packtyp."/B";
				
				
		
		
		$qty=$rowbarc1['mpmain_wtmp'];			
		$lotn=$rowbarc1['mpmain_lotno'].",";
		$ltnop1=$rowbarc1['mpmain_lotnop'].",";
		$ups1=$rowbarc1['mpmain_upssize'].",";
		$crop1=$rowbarc1['mpmain_crop'].",";
		$variety1=$rowbarc1['mpmain_variety'].",";
							
		$ltno=explode(",",$lotn);
		$lotnop=explode(",",$ltnop1);
		$ups3=explode(",",$ups1);
		$crop3=explode(",",$crop1);		
		$variety3=explode(",",$variety1);
		$ltcount=count($ltno);
		for($i=0; $i<$ltcount; $i++)
		{
			$lotno=$ltno[$i];
			if($lotno<>"")	
			{
			 $nobtp=""; 
				if($pty=="PACKMMC")
				{
					$variety2=$variety3[$i];
					$ups=$ups3[$i];
					$crop2=$crop3[$i];
				}
				else
				{
					$variety2=$variety3[0];
					$ups=$ups3[0];
					$crop2=$crop3[0];
				}
				$xc2=explode(" ",$ups);
				if($xc2[1]=="Gms")
				{
					$ptp2=$xc2[0]/1000;
				}
				else
				{
					$ptp2=$xc2[0];
				}
				//if($xc2[1]=="Gms")
					$ltqt=$ptp2*$lotnop[$i];
				/*else	
					$ltqt=$lotnop[$i]/$ptp2;*/
				
				$sqq=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='$tid' and dpss_barcodetype!='SMC' and dpss_barcodetype!='NMC' and dpss_barcode='".$barcode."' and dpss_lotno='$lotno'") or die(mysqli_error($link));
				$roo=mysqli_fetch_array($sqq);
				$nvariety="";
				$sqq233=mysqli_query($link,"Select disps_nvariety from tbl_disp_sub where plantcode='".$plantcode."' and  disps_id='".$roo['disps_id']."'") or die(mysqli_error($link));
				$roo233=mysqli_fetch_array($sqq233);
				$nvariety=$roo233['disps_nvariety']; 
				//echo $roo['disps_id']."<br/>";
									
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety2' and actstatus='Active'"); 
				$row_dept4=mysqli_fetch_array($quer4);
				$variety=$row_dept4['popularname'];	
								
					
				$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crop2."' order by cropname Asc"); 
				$row_crp = mysqli_fetch_array($sql_crp);
				$crop=$row_crp['cropname'];
				
				$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$ups' and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
				$tot_lot2=mysqli_num_rows($sql_lot2);
				$row_lot2=mysqli_fetch_array($sql_lot2);
												
				$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
				$tot_lot=mysqli_num_rows($sql_lot);
				$row_lot=mysqli_fetch_array($sql_lot);
												
				$qc=$row_lot['lotldg_qc'];
				$dot=$roo['dpss_dot'];
				$dov=$roo['dpss_dov'];
												
				$zz=str_split($lotno);
				$ltno2=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
												
				$srfl=0; $qcdot2=""; $trdate23=""; $trdate24="";
				
				$sql_pnp2=mysqli_query($link,"Select max(pnpslipsub_id) from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='".$roo['dpss_lotno']."' order by pnpslipsub_id desc") or die(mysqli_error($link));
				$row_pnp2=mysqli_fetch_array($sql_pnp2);
				
				$sql_pnp=mysqli_query($link,"Select pnpslipsub_qcdot from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='".$roo['dpss_lotno']."' and pnpslipsub_id='".$row_pnp2[0]."' order by pnpslipsub_qcdot desc") or die(mysqli_error($link));
				$row_pnp=mysqli_fetch_array($sql_pnp);
				if($tot_pnp=mysqli_num_rows($sql_pnp)>0)
				{
					$trdate23=$row_pnp['pnpslipsub_qcdot'];
					if($trdate23!="0000-00-00" && $trdate23!="--" && $trdate23!="- -" && $trdate23!="")
					{
						$qcdot2=$row_pnp['pnpslipsub_qcdot'];
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
					}
				}
				
				$sqlpnp2=mysqli_query($link,"Select max(rv_id) from tbl_revalidate where plantcode='".$plantcode."' and  rv_newlot='".$roo['dpss_lotno']."' order by rv_id desc ") or die(mysqli_error($link));
				$rowpnp2=mysqli_fetch_array($sqlpnp2);
				
				$sqlpnp=mysqli_query($link,"Select rv_dot from tbl_revalidate where plantcode='".$plantcode."' and  rv_newlot='".$roo['dpss_lotno']."' and rv_id='".$rowpnp2[0]."' order by rv_dot desc ") or die(mysqli_error($link));
				$rowpnp=mysqli_fetch_array($sqlpnp);
				if($totpnp=mysqli_num_rows($sqlpnp)>0)
				{
					$trdate24=$rowpnp['rv_dot'];
					if($trdate24!="0000-00-00" && $trdate24!="--" && $trdate24!="- -" && $trdate24!="")
					{
						if($trdate23!="" && ($trdate24>$trdate23))
						{ 
							$qcdot2=$trdate24;
							//$qcdot2=$trdate24[2]."-".$trdate24[1]."-".$trdate24[0];
						}
					}
				}
				if($qcdot2=="")
				{
					$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
					$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
					if($tot_softr_sub > 0)
					{
						$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
						//echo $row_softr_sub[0];
						$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
						$tot_softr=mysqli_num_rows($sql_softr);
						$row_softr=mysqli_fetch_array($sql_softr);
						if($tot_softr > 0)
						{
							$qcdot2=$row_softr['softr_date'];
							//$trdate=explode("-",$trdate);
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
						}
					}
					if($qcdot2=="")
					{
						$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
						$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
						if($tot_softr_sub2 > 0)
						{
							$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
							//echo $row_softr_sub2[0];
							$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
							$tot_softr2=mysqli_num_rows($sql_softr2);
							$row_softr2=mysqli_fetch_array($sql_softr2);
							if($tot_softr2 > 0)
							{
								$qcdot2=$row_softr2['softr_date'];
								//$trdate=explode("-",$trdate);
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
							}
						}
					}
				}
				
				if($qcdot2!="")	$dot=$qcdot2;

				/*$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipsub_plotno='$lotno'") or die(mysqli_error($link));
				$row_pnp=mysqli_fetch_array($sql_pnp);
				$tot_pnp=mysqli_num_rows($sql_pnp);
				if($tot_pnp > 0)
				{
					if($row_pnp['pnpslipsub_qcdttype']=="DoSF" || $row_pnp['pnpslipsub_qcdttype']=="DosF")
						$srfl=1;
				}
										
				if($srfl==1)
				{
					$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno2."'") or die(mysqli_error($link));
					$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
					if($tot_softr_sub > 0)
					{
						$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
						$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
						$tot_softr=mysqli_num_rows($sql_softr);
						$row_softr=mysqli_fetch_array($sql_softr);
						if($tot_softr > 0)
						{
							$qcdot2=$row_softr['softr_date'];
						}
					}
					if($qcdot2=="")
					{
						$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno2."'") or die(mysqli_error($link));
						$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
						if($tot_softr_sub2 > 0)
						{
							$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
							$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
							$tot_softr2=mysqli_num_rows($sql_softr2);
							$row_softr2=mysqli_fetch_array($sql_softr2);
							if($tot_softr2 > 0)
							{
								$qcdot2=$row_softr2['softr_date'];
							}
						}
					}
				}*/
				
				//if(($dot=="00-00-0000" || $dot=="--" || $dot==" ") && $qcdot2!="")$dot=$qcdot2;
				$trdate=$dot;
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$dot=$trday."-".$trmonth."-".$tryear;
				
				$trdate=$dov;
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$dov=$trday."-".$trmonth."-".$tryear;
				
				if(($dot=="00-00-0000" || $dot=="--" || $dot==" "))$dot="";
				if(($dov=="00-00-0000" || $dov=="--" || $dov==" "))$dov="";
				
				if($nvariety=="")$nvariety=$variety;
				/*$sql_var=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$variety2."' and actstatus='Active' order by popularname Asc"); 
				$row_var = mysqli_fetch_array($sql_var);
				$variety=$row_var['popularname'];
				if($nvariety=="")$nvariety=$variety;
				$packtp=explode(" ",$ups);
				$srnonew=0; $uom="";
				$p1_array=explode(",",$row_var['gm']);
				$p1_array2=explode(",",$row_var['mtype']);
				foreach($p1_array as $val1)
				{
					if($val1<>"")
					{
						$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
						$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
						if($row1234=mysqli_num_rows($res)>0)
						{
							$nobtyp=$p1_array2[$srnonew];
							if($nobtyp=="Carton")
							$tnopc=$tnopc+$nnob1;
							if($nobtyp=="Bag")
							$tnopb=$tnopb+$nnob1;
						}
					}
					$srnonew++;
				}
				
				$mpt=$packtyp."/C";
				if($nobtyp=="Carton")
				$mpt=$packtyp."/C";
				if($nobtyp=="Bag")
				$mpt=$packtyp."/B";*/

				if($varietyval!="")
					$varietyval=$varietyval."<br/>".$nvariety;
				else
					$varietyval=$nvariety;	
					
				if($cropval!="")
					$cropval=$cropval."<br/>".$crop;
				else
					$cropval=$crop;		
				
				if($lotval!="")
					$lotval=$lotval."<br/>".$ltno2;
				else
					$lotval=$ltno2;		
				
				$dq=explode(" ",$ups);
				$dqs=explode(".",$dq[0]);
				if($dqs[1]>0)
				$aqs=$dqs[0].".".$dqs[1];
				else
				$aqs=$dqs[0];
				$ups=$aqs." ".$dq[1];
				
					
				if($upsval!="")
					$upsval=$upsval."<br/>".$ups;
				else
					$upsval=$ups;		
				
				if($qcval!="")
					$qcval=$qcval."<br/>".$qc;
				else
					$qcval=$qc;		
					
				if($dotval!="")
					$dotval=$dotval."<br/>".$dot;
				else
					$dotval=$dot;	
					
				if($dovval!="")
					$dovval=$dovval."<br/>".$dov;
				else
					$dovval=$dov;	
				
				if($nobtp!="")
					$nobtp=$nobtp."<br />".$mpt; 
				else
					$nobtp=$mpt;	
					
				if($nqty1!="")
					$nqty1=$nqty1."<br />".$ltqt; 
				else
					$nqty1=$ltqt;	
				
				$nnob2=$nnob1;	
				$nqty2=$nqty2+$ltqt;
			}
		}	
$totnomp=$totnomp+$nnob2; 
$totqty=$totqty+$nqty2; 
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cropval?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $varietyval?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upsval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dotval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dovval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nobtp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob2;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty2;?>&nbsp;Kgs.</td>
</tr>
<?php
$sn++;
}	
}	
}
}
}

$sql_arr_home2=mysqli_query($link,"select distinct dpss_barcode from tbl_dispsub_sub where disp_id='$tid' order by dpss_id asc") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
$tgrqty=0;
if($tot_arr_home2 >0) 
{ 
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_arr_home20=mysqli_query($link,"select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='$tid' and dpss_barcode='".$row_arr_home2['dpss_barcode']."' order by dpss_id asc Limit 0,1") or die(mysqli_error($link));
		$tot_arr_home20=mysqli_num_rows($sql_arr_home20);
		if($tot_arr_home20 >0) 
		{ 
			while($row_arr_home20=mysqli_fetch_array($sql_arr_home20))
			{
				$tgrqty=$tgrqty+$row_arr_home20['dpss_grosswt'];
			}
		}
	}
}
//}
?>
<tr class="Dark" height="30">
	<td width="275" align="right"  valign="middle" class="tbltext" colspan="10">Grand Total&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totnomp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totqty;?>&nbsp;Kgs.</td>
</tr>







<tr class="Dark" height="30">
	<td align="right"  valign="middle" class="tbltext" colspan="5">Total&nbsp;</td>
	<td align="right"  valign="middle" class="tbltext">Carton(s)&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tnopc;?></td>
	<td align="right"  valign="middle" class="tbltext">Bag(s)&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tnopb;?></td>
	<td align="right"  valign="middle" class="tbltext" colspan="2">Gross Weight&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tgrqty;?>&nbsp;Kgs.</td>
</tr>
</table>

<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['disp_remarks'];?></td>
</tr></table>
</br>
<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="65" align="right"  valign="middle" class="tblheading">&nbsp;GST No.:&nbsp;</td>
<td width="139" align="left"  valign="middle" class="tbltext">&nbsp;<?php //echo $row_param['gstin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td width="176" align="left"  valign="middle" class="tbltext">&nbsp;</td>

<td width="119" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<?php //echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />-->
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="smalltbltext" colspan="6">Note: If you find any discripancies in quantity and weight of items mentioned above, please contact our customer care service, not later than 7 days of receipt of this document.</td>
</tr>
</table>
<br />
<br />
<br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" >
<td width="33%" align="center" valign="middle" class="smalltblheading">(<?php echo ucwords($logname);?>)</td>
<td width="34%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
<td width="33%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
</tr>
<tr class="Light" >
<td width="33%" align="center" valign="middle" class="smalltblheading">Prepared By</td>
<td width="34%" align="center" valign="middle" class="smalltblheading">Checked By</td>
<td width="33%" align="center" valign="middle" class="smalltblheading">Authorised&nbsp;Signatory</td>
</tr>
	    </table>



<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><!--<a href="cc_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>-->&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
