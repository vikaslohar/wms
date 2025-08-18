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

$sql_tbl=mysqli_query($link,"select * from tbl_stoutmpack where plantcode='".$plantcode."' and  stoutmp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['stoutmp_id'];
$ptype=$row_tbl['disp_partytype'];

$ntitle="Stock Transfer Dispatch Note (PSTON)";
$ntyps="PSTON";

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Stock Transfer - <?php echo $ntyps;?></title>
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
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<HR width="750" align="center" />
<?php
	$tdate=$row_tbl['stoutmp_ddate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['stoutmp_date'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;

$sql23="select * from tbluser where plantcode='".$plantcode."' and  scode='".$row_tbl['stoutmp_logid']."'";
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
	
$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='$tid' and dnote_trtype='Stock Transfer Out-Pack' ";
$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
$row_code1=mysqli_fetch_array($res_code1);

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);


$code1=$row_param['code']."/"."PSP"."/".$ycode."/".$row_code1['dnote_code'];
	
$ordernos=""; $porefno="";  $veri=""; $ordernos2="";
$sql_arrssub=mysqli_query($link,"select distinct stoutsp_variety from tbl_stoutspack where plantcode='".$plantcode."' and  stoutmp_id='".$pid."'") or die(mysqli_error($link));
$a_arrssub=mysqli_num_rows($sql_arrssub);
while($row_arrssub=mysqli_fetch_array($sql_arrssub))
{	
	if($veri!="")
	$veri=$veri.",".$row_arrssub['stoutsp_variety'];
	else
	$veri=$row_arrssub['stoutsp_variety'];
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

<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['stoutmp_plantid']."' order by business_name")or die(mysqli_error($link));
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
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['stoutmp_tmode'];?></td>
</tr>
<?php
if($row_tbl['stoutmp_tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutmp_tname'];?></td>
<td align="right" valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutmp_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['stoutmp_tvehno'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutmp_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['stoutmp_tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutmp_couriername'];?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutmp_docketno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stoutmp_pnamebyhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<?php
$vid="";
//echo "select distinct stoutsp_variety from tbl_stoutspack where stoutmp_id='$tid' and stoutsp_subflg=1 order by stoutsp_crop ASC, stoutsp_variety asc";
$sqlarrhome=mysqli_query($link,"select distinct stoutsp_variety from tbl_stoutspack where plantcode='".$plantcode."' and  stoutmp_id='$tid'  order by stoutsp_crop ASC, stoutsp_variety asc") or die(mysqli_error($link));
$totarrhome=mysqli_num_rows($sqlarrhome);

	/*if($vid!="")
	$vid=$vid.",".$rowarrhome['stoutsp_variety'];
	else
	$vid=$row_var['stoutsp_variety'];
}*/
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
	<td width="275" align="center"  valign="middle" class="tbltext">Loose NoP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoMP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Total NoMP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Total Qty</td>
</tr>
<?php 
$sn=1; $totnomp=0; $totqty=0; $tnopc=0; $tnopb=0;
$vids=explode(",", $vid);
while($rowarrhome=mysqli_fetch_array($sqlarrhome))
{
	$nvariety=""; $lotno1=""; $nups=""; $nob=0; $qty=0; $tnob=0; $tqty=0; $bartyp=""; $dov=""; $dot=""; $loosenop=0; $nopqty=0; $grswt=0;
	
	$sql_arr_home3=mysqli_query($link,"select distinct stoutsp_lotno from tbl_stoutspack where stoutmp_id='$tid' and stoutsp_variety='".$rowarrhome['stoutsp_variety']."' order by stoutsp_id asc") or die(mysqli_error($link));
	$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
	while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
	{
		$nnob1=0; $nqty1=0; $nob1=0; $qty1=0; $tnomp=0;  $nnob2=0; $nqty2=0; $nobtp=""; $bartyp1=""; $nmp=0;
		$sql_sub=mysqli_query($link,"Select * from tbl_stoutsspack where stoutssp_lotno='".$row_arr_home3['stoutsp_lotno']."' and stoutmp_id='$tid' and (stoutssp_barcodetype='SMC' or stoutssp_barcodetype='NMC')") or die(mysqli_error($link));
		$zxc=mysqli_num_rows($sql_sub);
		while($row_sub=mysqli_fetch_array($sql_sub))
		{
			$nob1++; $nmp++;
			$qty1=$qty1+$row_sub['stoutssp_qty'];	
			$grswt=$grswt+$row_sub['stoutssp_grosswt'];
			if($bartyp1=="")
				$bartyp1=$row_sub['stoutssp_barcodetype'];
		}
		//echo "select * from tbl_stoutspack where stoutmp_id='$tid' and stoutsp_variety='".$rowarrhome['stoutsp_variety']."' and stoutsp_lotno='".$row_arr_home3['stoutsp_lotno']."' order by stoutsp_id asc";
		$sql_arr_home4=mysqli_query($link,"select * from tbl_stoutspack where stoutmp_id='$tid' and stoutsp_variety='".$rowarrhome['stoutsp_variety']."' and stoutsp_lotno='".$row_arr_home3['stoutsp_lotno']."' order by stoutsp_id asc") or die(mysqli_error($link));
		$row_arr_home4=mysqli_fetch_array($sql_arr_home4);
		
		$qtyups1=$row_arr_home4['stoutsp_ups'];
		$qtyups=explode(" ",$qtyups1);
		//echo $qtyups[1];
		if($qtyups[1]=="Gms")
			$nopqty=($qtyups[0]*$row_arr_home4['stoutsp_loadnop'])/1000;
		if($qtyups[1]=="Kgs")
			$nopqty=($qtyups[0]*$row_arr_home4['stoutsp_loadnop']);
		
		$qty1=$qty1+$nopqty;
		
		$sql_ups=mysqli_query($link,"select * from tbl_stoutspack where plantcode='".$plantcode."' and  stoutsp_lotno='".$row_arr_home3['stoutsp_lotno']."' and stoutmp_id='$tid'") or die(mysqli_error($link));
		$row_ups=mysqli_fetch_array($sql_ups);
		if($nups=="")
			$nups=$row_ups['stoutsp_ups'];
		else
			$nups=$nups."<br/>".$row_ups['stoutsp_ups'];
		
		$dot1=$row_ups['stoutsp_qcpackdate'];
		$tryear=substr($dot1,0,4);
		$trmonth=substr($dot1,5,2);
		$trday=substr($dot1,8,2);
		$dot2=$trday."-".$trmonth."-".$tryear;
		
		if($dot=="")
			$dot=$dot2;
		else
			$dot=$dot."<br/>".$dot2;
		
		$dov1=$row_ups['stoutsp_dov'];
		$tryear=substr($dov1,0,4);
		$trmonth=substr($dov1,5,2);
		$trday=substr($dov1,8,2);
		$dov2=$trday."-".$trmonth."-".$tryear;
		
		if($dov=="")
			$dov=$dov2;
		else
			$dov=$dov."<br/>".$dov2;
			
		if($loosenop==0)
			$loosenop=$row_ups['stoutsp_loadnop'];
		else
			$loosenop=$loosenop."<br/>".$row_ups['stoutsp_loadnop'];
		
		$sql_cropvar=mysqli_query($link,"select * from tblvariety where varietyid='".$rowarrhome['stoutsp_variety']."' ") or die(mysqli_error($link));
		$row_cropvar=mysqli_fetch_array($sql_cropvar);
		$crop=$row_cropvar['cropid'];
		$nvariety=$row_cropvar['popularname'];
		
		if($bartyp1=="SMC")
		{ 
			$packtp=explode(" ",$nups);
			$srnonew=0; $uom="";
			$p1_array=explode(",",$row_cropvar['gm']);
			$p1_array2=explode(",",$row_cropvar['mtype']);
			
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
						{
							$tnopc=$tnopc+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/C";
							else
								$bartyp=$bartyp1."/C";
								
						}
						else if($nobtyp=="Bag")
						{
							$tnopb=$tnopb+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/B";
							else
								$bartyp=$bartyp1."/B";
								
						}
						else
						{
							$tnopc=$tnopc+$nmp;
						}
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
			{
				$tnopc=$tnopc+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/C";
				else
					$bartyp=$bartyp1."/C";
			}
			else if($nobtyp=="Bag")
			{
				$tnopb=$tnopb+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/B";
				else
					$bartyp=$bartyp1."/B";
			}
			else
			{$tnopc=$tnopc+$nmp;}
		}
		
		/*if($bartyp!="")
			$bartyp=$bartyp."<br/>".$bartyp1;
		else
			$bartyp=$bartyp1;*/
		
		
		if($lotno1=="")
			$lotno1=$row_arr_home3['stoutsp_lotno'];
		else
			$lotno1=$lotno1."<br/>".$row_arr_home3['stoutsp_lotno'];
			
		if($nob==0)
			$nob=$nob1;
		else
			$nob=$nob."<br/>".$nob1;
			
		if($qty==0)
			$qty=$qty1;
		else
			$qty=$qty."<br/>".$qty1;
		
		$tnob=$tnob+$nob1; 
		$tqty=$tqty+$qty1;
	}
	//echo $tqty;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $crop?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nvariety?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nups;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotno1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dov;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $bartyp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $loosenop;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nob;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qty;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tnob;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tqty;?>&nbsp;Kgs.</td>
</tr>
<?php
$sn++;
$totnomp=$totnomp+$tnob;
$totqty=$totqty+$tqty;
$tgrqty=$tgrqty+$grswt;	
}


$sql_sub=mysqli_query($link,"Select distinct stoutssp_barcode from tbl_stoutsspack where plantcode='".$plantcode."' and  stoutmp_id='$tid' and stoutssp_barcodetype!='SMC' and stoutssp_barcodetype!='NMC'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
$barcodes=$row_sub['stoutssp_barcode'];
if($barcodes!="")
{
	$upsval=""; $lotval=""; $dotval=""; $dovval=""; $lotqty=""; $barqty=""; $nnob1=""; $nnob2=0; $crop=""; $var="";
	$sql_sub1=mysqli_query($link,"Select * from tbl_stoutsspack where plantcode='".$plantcode."' and  stoutssp_barcode='".$row_sub['stoutssp_barcode']."'stoutmp_id='$tid' and stoutssp_barcodetype!='SMC' and stoutssp_barcodetype!='NMC'") or die(mysqli_error($link));
	while($row_sub1=mysqli_fetch_array($sql_sub1))
	{
		if($lotval=="")
			$lotval=$row_sub1['stoutssp_lotno'];
		else
			$lotval=$lotval."<br/>".$row_sub1['stoutssp_lotno'];
			
		if($lotqty=="")
			$lotqty=$row_sub1['stoutssp_lotqty'];
		else
			$lotqty=$lotqty."<br/>".$row_sub1['stoutssp_lotqty'];
			
		if($barqty=="")
			$barqty=$row_sub1['stoutssp_qty'];
			
		if($nnob2==0)
			$nnob2++;
		if($nnob1=="")
			$nnob1=$nnob2;
		else
			$nnob1=$nnob1."<br/>".$nnob2;
			
		if($upsval=="")
			$upsval=$row_sub1['stoutssp_ups'];
		else
			$upsval=$upsval."<br/>".$row_sub1['stoutssp_ups'];
		
		$sql_sub11=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and  stoutsp_id='".$row_sub1['stoutsp_id']."' ") or die(mysqli_error($link));
		$row_sub11=mysqli_fetch_array($sql_sub11);
		
		$dot1=$row_sub11['stoutsp_qcpackdate'];
		$tryear=substr($dot1,0,4);
		$trmonth=substr($dot1,5,2);
		$trday=substr($dot1,8,2);
		$dot=$trday."-".$trmonth."-".$tryear;
		
		$dov1=$row_sub11['stoutsp_dov'];
		$tryear=substr($dov1,0,4);
		$trmonth=substr($dov1,5,2);
		$trday=substr($dov1,8,2);
		$dov=$trday."-".$trmonth."-".$tryear;	
		
		if($dotval=="")
			$dotval=$dot;
		else
			$dotval=$dotval."<br/>".$dot;
			
		if($dovval=="")
			$dovval=$dov;
		else
			$dovval=$dovval."<br/>".$dov;
			
		$sql_cropvar1=mysqli_query($link,"select cropid, popularname from tblvariety where varietyid='".$row_sub11['stoutsp_qcpackdate']."' ") or die(mysqli_error($link));
		$row_cropvar1=mysqli_fetch_array($sql_cropvar1);
			
		if($crop=="")
			$crop=$row_cropvar1['cropid'];
		else
			$crop=$crop."<br/>".$row_cropvar1['cropid'];
		
		if($var=="")
			$var=$row_cropvar1['popularname'];
		else
			$var=$var."<br/>".$row_cropvar1['popularname'];
			
			
		if($bartyp1=="SMC")
		{
			$packtp=explode(" ",$upsval);
			$srnonew=0; $uom="";
			$p1_array=explode(",",$row_cropvar1['gm']);
			$p1_array2=explode(",",$row_cropvar1['mtype']);
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
						{
							$tnopc=$tnopc+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/C";
							else
								$bartyp=$bartyp1."/C";
						}
						else if($nobtyp=="Bag")
						{
							$tnopb=$tnopb+$nmp;
							if($bartyp!="")
								$bartyp=$bartyp."<br/>".$bartyp1."/B";
							else
								$bartyp=$bartyp1."/B";
						}
						else
						{
							$tnopc=$tnopc+$nmp;
						}
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
			{
				$tnopc=$tnopc+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/C";
				else
					$bartyp=$bartyp1."/C";
			}
			else if($nobtyp=="Bag")
			{
				$tnopb=$tnopb+$nmp;
				if($bartyp!="")
					$bartyp=$bartyp."<br/>".$bartyp1."/B";
				else
					$bartyp=$bartyp1."/B";
			}
			else
			{$tnopc=$tnopc+$nmp;}
		}
		
	}
	//echo $barqty;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $crop?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $var?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upsval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dotval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dovval;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nobtp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php ?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob1;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotqty;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob2;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $barqty;?>&nbsp;Kgs.</td>
</tr>
<?php
$sn++;
}
$totnomp=$totnomp+$nnob2;
$totqty=$totqty+$barqty;
$tgrqty=$tgrqty+$grswt;
}	
?>
<tr class="Dark" height="30">
	<td width="275" align="right"  valign="middle" class="tbltext" colspan="11">Grand Total&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totnomp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $totqty;?>&nbsp;Kgs.</td>
</tr>
<tr class="Dark" height="30">
	<td align="right"  valign="middle" class="tbltext" colspan="5">Total&nbsp;</td>
	<td align="right"  valign="middle" class="tbltext">Carton(s)&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tnopc;?></td>
	<td align="right"  valign="middle" class="tbltext">Bag(s)&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tnopb;?></td>
	<td align="right"  valign="middle" class="tbltext" colspan="3">Gross Weight&nbsp;</td>
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="40" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="164" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="176" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="119" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />
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
<td width="33%" align="center" valign="middle" class="smalltblheading">Authorized By</td>
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
