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
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch Bulk - BSDN</title>
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


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Bulk Seed Dispatch Note (BSDN)</font></td>
</tr>
</table><br />	  

   <?php
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_dbulk where plantcode='".$plantcode."' and  dbulk_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['dbulk_id'];
$ptype=$row_tbl['dbulk_partytype'];

	$tdate=$row_tbl['dbulk_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dbulk_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;

$sql23="select * from tbluser where plantcode='".$plantcode."' and  scode='".$row_tbl['dbulk_logid']."'";
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
	
$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='$tid' and dnote_trtype='Dispatch Bulk Seed' and dnote_ptype='$ptype'";
$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
$row_code1=mysqli_fetch_array($res_code1);

$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);


$code1=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."BD"."/".sprintf("%004d",$row_code1['dnote_code']);
	
$ordernos=""; $porefno="";
$sql_arrsub=mysqli_query($link,"select * from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulk_id='".$pid."'") or die(mysqli_error($link));
$a_arrsub=mysqli_num_rows($sql_arrsub);
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
	if($ordernos!="")
	$ordernos=$ordernos.",".$row_arrsub['dbulks_ordno'];
	else
	$ordernos=$row_arrsub['dbulks_ordno'];
}	

if($ordernos!="")
{
$tid240=explode(",",$ordernos); 
//array_unique($tid240); 
$tid240=array_keys(array_flip($tid240));
$ordernos=implode(",",$tid240);
foreach($tid240 as $tid230)
{
	if($tid230<>"")
	{
		$sqordm=mysqli_query($link,"Select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_porderno='$tid230' and orderm_tflag=1") or die(mysqli_error($link));
		$totordm=mysqli_num_rows($sqordm);
		while($rowordm=mysqli_fetch_array($sqordm))
		{
			if($porefno!="")
				$porefno=$porefno.",".$rowordm['orderm_partyrefno'];
			else
				$porefno=$rowordm['orderm_partyrefno'];
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
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Dispatch&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;BSDN No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>
</tr>
<!--<tr class="Light" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Dispatch Challan&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dbulk_dcno'];?></td>
</tr>-->
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dbulk_party']."' order by business_name")or die(mysqli_error($link));
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
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $noticia['business_name'];?></td>
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
	<td width="275" align="center"  valign="middle" class="tbltext">NoB</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Total Qty</td>
</tr>
<?php 
$sn=1; 

$sql_arr_home=mysqli_query($link,"select distinct dbulks_variety from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulk_id='$tid' and dbulks_flg=1 order by dbulks_id asc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$nups=""; $nnob=""; $nqty=""; $lotno=""; $dot=""; $tnob=0; $tqty=0;

$sql_sub=mysqli_query($link,"Select * from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulks_variety='".$row_arr_home['dbulks_variety']."' and dbulk_id='$tid'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
$crpnm=$row_sub['dbulks_crop'];  
$nvariety=$row_sub['dbulks_nvariety']; 
$nups=$row_sub['dbulks_ups']; 

if($nvariety=="" || $nvariety=="undefined")$nvariety=$row_arr_home['dbulks_variety'];

$sqq=mysqli_query($link,"Select * from tbl_dbulksub_sub where plantcode='".$plantcode."' and  dbulks_id='".$row_sub['dbulks_id']."'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
$zz2=str_split($roo['dbss_lotno']);
$ltno2=$zz2[0].$zz2[1].$zz2[2].$zz2[3].$zz2[4].$zz2[5].$zz2[6].$zz2[7].$zz2[8].$zz2[9].$zz2[10].$zz2[11].$zz2[12].$zz2[13].$zz2[14].$zz2[15];
if($lotno!="")
$lotno=$lotno."<br />".$ltno2;
else
$lotno=$ltno2;
if($nnob!="")
$nnob=$nnob."<br />".$roo['dbss_nob']; 
else
$nnob=$roo['dbss_nob']; 
if($nqty!="")
$nqty=$nqty."<br />".$roo['dbss_qty']; 
else
$nqty=$roo['dbss_qty']; 

//$tnon=$tnob+$roo['dbss_nob']; 
$tqty=$tqty+$roo['dbss_qty']; 

$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='".$crpnm."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);
$crop=$row_crp['cropid'];
		
$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='".$row_arr_home['dbulks_variety']."' and actstatus='Active' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);
$variety=$row_var['varietyid'];

$vflg=0; $dot1=""; $qcdot2="";
	
$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='$crop' and lotldg_variety='$variety' and lotldg_sstage='Condition' and lotldg_lotno='".$roo['dbss_lotno']."'")or die("Error:".mysqli_error($link));
$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
$rowmonth3=mysqli_fetch_array($sqlmonth3);

$qc=$rowmonth3['lotldg_qc'];

$trdate=$rowmonth3['lotldg_qctestdate'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dot1=$trday."-".$trmonth."-".$tryear;
//$mkdot=mktime(0,0,0,$trmonth,$trday,$tryear);
if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT"))
{
	$vflg++; 
}
if($vflg>0)
{
	$zz=str_split($roo['dbss_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	if($rowmonth3['lotldg_srflg']==1 && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT" || $rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT"))
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
					
					//$mkdot1=mktime(0,0,0,$trdate[1],$trdate[2],$trdate[0]);
					//if($mkdot1<$mkdot)$qcdot2="";
				}
			}
		}
	}//echo $dot1."  -  ".$qcdot2."<br />";
	if($qcdot2!="" )	$dot1=$qcdot2;
	//$dot1=$qcdot2;
}

$dq=explode(" ",$nups);
$dqs=explode(".",$dq[0]);
if($dqs[1]>0)
$aqs=$dqs[0].".".$dqs[1];
else
$aqs=$dqs[0];
$nups=$aqs." ".$dq[1];
				
if($dot!="")
$dot=$dot."<br />".$dot1;
else
$dot=$dot1;
}
}
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $crpnm?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nvariety?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nups;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;</td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nnob;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $nqty;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $tqty;?>&nbsp;Kgs.</td>
	
</tr>
<?php
$sn++;
}
}

//}
//}
//}
?>
</table>

<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dbulk_remarks'];?></td>
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
