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

	$ofoccode=trim($_REQUEST['ofoccode']);  //echo "<br />";
		$ofoccode1=trim($_REQUEST['ofoccode1']); // echo "<br />";
		$ofoccode2=trim($_REQUEST['ofoccode2']);  //echo "<br />";
		$ofoccode3=trim($_REQUEST['ofoccode3']); // echo "<br />";
		$ofoccode4=trim($_REQUEST['ofoccode4']);  //echo "<br />";
		$oflagcode=trim($_REQUEST['oflagcode']); //echo "<br />";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC - Transaction - QC Multiple Data Verification and Result Update - Print Preview</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>

</head>
<body topmargin="0" >
<table width="800" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">QC Data Verification and Result Pending List</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="19" height="22"align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="84" align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
	<td width="115" align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td width="101" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">Qty</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">GKD</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">DOE</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="4">SGT Data</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">FGT Data</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Germ. %</td>
	<td width="50" align="center" valign="middle" class="smalltblheading" rowspan="2">LE</td>
	<td width="80" align="center" valign="middle" class="smalltblheading" rowspan="2">QC Result</td>
	<td width="60" align="center" valign="middle" class="smalltblheading" rowspan="2">QC Doc Ref No.</td>
</tr>
<tr class="tblsubtitle" height="20">
<td width="39" align="center" valign="middle" class="smalltblheading">Normal</td>
<td width="54" align="center" valign="middle" class="smalltblheading">Abnrml</td>
<td align="center" valign="middle" class="smalltblheading">Hard / FUG</td>
<td align="center" valign="middle" class="smalltblheading">Dead</td>
<td align="center" valign="middle" class="smalltblheading">Normal</td>
<td align="center" valign="middle" class="smalltblheading">Abnrml</td>
<td align="center" valign="middle" class="smalltblheading">Dead</td>
<td align="center" valign="middle" class="smalltblheading">Select</td>
<td align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
$srno=1; $sel=1;
$xflagcode=explode(",",$oflagcode);
$xfoccode=explode(",",$ofoccode);
$xfoccode1=explode(",",$ofoccode1);
$xfoccode2=explode(",",$ofoccode2);
$xfoccode3=explode(",",$ofoccode3);
$xfoccode4=explode(",",$ofoccode4);

for($i=0; $i<count($xflagcode);$i++)
{
$flagcode=$xflagcode[$i];

$sql_arr_home=mysqli_query($link,"select distinct sampleno from tbl_qctest where bflg=1 and tid IN ($flagcode) and spdate IS NOT NULL and spdate!='0000-00-00' and qcflg=0 and state!='T' order by  spdate ASC, tid desc ") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{
while($row_arr_home24=mysqli_fetch_array($sql_arr_home))
{
	
	$flg=0;
	
	$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where bflg=1 and tid IN ($flagcode) and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
	
	$sql_arr_home24=mysqli_query($link,"select * from tbl_qctest where bflg=1 and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' and tid='".$row_arr_home2[0]."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home24))
	{
	$moistflg=0; $ppflg=0; $germflg=0; $resultflg=0; $moistpercentages=''; $ppresult='';
	
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	
	$tp1=$row_arr_home['plantcode'];
	$germper=''; $qcg_sgtnormalavg=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfugavg=0; $qcg_sgtdeadavg=0; $qcg_vignormalavg=0; $qcg_vigabnormalavg=0; $qcg_vigdeadavg=0; $qcg_testtype=''; $qcg_docsrefno=''; $qcg_setupdt=''; $dos=''; $qcg_germpdatadt='';
	$sampno=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$row_arr_home24['sampleno']);
	if($row_arr_home['state']!="G")
	{
		
		$sql_gdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' and qcg_retestflg=0 ") or die(mysqli_error($link));
		while($row_gdata=mysqli_fetch_array($sql_gdata))
		{
			if($row_gdata['qcg_germpflg']==1)
				{$germflg=1; }
			if($row_gdata['qcg_germpflg']==2)
				{$germflg=2;}
			if($row_gdata['qcg_germpflg']==0)
				{$germflg=3;}
			$qcg_sgtnormalavg=$row_gdata['qcg_sgtnormalavg']; 
			$qcg_sgtabnormalavg=$row_gdata['qcg_sgtabnormalavg']; 
			$qcg_sgthardfugavg=$row_gdata['qcg_sgthardfugavg']; 
			$qcg_sgtdeadavg=$row_gdata['qcg_sgtdeadavg']; 
			$qcg_vignormalavg=$row_gdata['qcg_vignormalavg']; 
			$qcg_vigabnormalavg=$row_gdata['qcg_vigabnormalavg']; 
			$qcg_vigdeadavg=$row_gdata['qcg_vigdeadavg']; 
			$qcg_testtype=$row_gdata['qcg_testtype']; 
			$qcg_docsrefno=$row_gdata['qcg_docsrefno'];	
			$qcg_setupdt=$row_gdata['qcg_setupdt'];	
			$qcg_germpdatadt=$row_gdata['qcg_germpdatadt'];		
		}
		
		if($moistflg==1 && $ppflg==1 && $germflg>0) {$resultflg=1;}
	}
	else
	{
		$sql_gdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' and qcg_retestflg=0 ") or die(mysqli_error($link));
		while($row_gdata=mysqli_fetch_array($sql_gdata))
		{
			if($row_gdata['qcg_germpflg']==1)
				{$germflg=1; }
			if($row_gdata['qcg_germpflg']==2)
				{$germflg=2;}
			if($row_gdata['qcg_germpflg']==0)
				{$germflg=3;}
			
			$qcg_sgtnormalavg=$row_gdata['qcg_sgtnormalavg']; 
			$qcg_sgtabnormalavg=$row_gdata['qcg_sgtabnormalavg']; 
			$qcg_sgthardfugavg=$row_gdata['qcg_sgthardfugavg']; 
			$qcg_sgtdeadavg=$row_gdata['qcg_sgtdeadavg']; 
			$qcg_vignormalavg=$row_gdata['qcg_vignormalavg']; 
			$qcg_vigabnormalavg=$row_gdata['qcg_vigabnormalavg']; 
			$qcg_vigdeadavg=$row_gdata['qcg_vigdeadavg']; 
			$qcg_testtype=$row_gdata['qcg_testtype']; 
			$qcg_docsrefno=$row_gdata['qcg_docsrefno'];	
			$qcg_setupdt=$row_gdata['qcg_setupdt'];	
			$qcg_germpdatadt=$row_gdata['qcg_germpdatadt'];	
				
		}
		if($germflg>0) {$resultflg=1;}
	}
	$setupdt=='';
	if($qcg_setupdt!='' && $qcg_setupdt!='0000-00-00' && $qcg_setupdt!='--' && $qcg_setupdt!='- -')
	{
		$setupdt=$qcg_setupdt;
	}	
	if($qcg_germpdatadt!='' && $qcg_germpdatadt!='0000-00-00' && $qcg_germpdatadt!='--' && $qcg_germpdatadt!='- -')
	{
		$qcg_germpdatadt2=explode("-",$qcg_germpdatadt);
		$dos=$qcg_germpdatadt2[2]."-".$qcg_germpdatadt2[1]."-".$qcg_germpdatadt2[0];
	}
	//echo $moistflg."  -  ".$ppflg."  -  ".$germflg."<br/>";
	if($moistflg>0 || $ppflg>0 || $germflg>0) 
	{
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno="";  $bags=0; $qty=0; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub1['qcstatus'];
		}
		else
		{
		$qc=$row_tbl_sub1['qcstatus'];
		}
	
		$trdate=$row_arr_home['srdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;	
		
		$trdate1=$row_arr_home['spdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
		
	
		$lrole=$row_arr_home['arr_role'];
		$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
		$row3=mysqli_fetch_array($quer3);
		
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
		$rowvv=mysqli_fetch_array($quer3);
		$tt=$rowvv['popularname'];
		$leduration=$rowvv['leduration'];
		$tot=mysqli_num_rows($quer3);	
		if($tot==0)
		{
		 $vv=$row_arr_home['variety'];
		}
		else
		{
		  $vv=$tt;
		}
		  
		$stage=$row_tbl_sub1['trstage'];
		$pp=$row_tbl_sub1['state'];	
		$lotn=$row_tbl_sub1['lotno'];
			 
		$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2="";
		if($stage!="Pack")
		{
			$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."'");
			$tt_sub=mysqli_num_rows($sql_qc_sub);
			while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
			{
			
				$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
				$tt=mysqli_num_rows($sql_qc);
				while($row_qc=mysqli_fetch_array($sql_qc))
				{
				
					$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
					$zz=mysqli_num_rows($sql_month);
					while ($row_month=mysqli_fetch_array($sql_month))
					{
					
					/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];*/
					
					$slups=$row_month['lotldg_balbags'];
					$slqty=$row_month['lotldg_balqty'];
					
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					
					$nob=$nob+$slups;
					$qty=$qty+$slqty;
					}
				}
			}
		}
		else
		{
			$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."'");
			$tt_sub=mysqli_num_rows($sql_qc_sub);
			while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
			{
			
				$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."' and subbinid='".$row_qc_sub['subbinid']."'");
				$tt=mysqli_num_rows($sql_qc);
				while($row_qc=mysqli_fetch_array($sql_qc))
				{
				
					$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and balqty > 0")or die(mysqli_error($link));
					$zz=mysqli_num_rows($sql_month);
					while ($row_month=mysqli_fetch_array($sql_month))
					{
					
					/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];*/
					
					//$slups=$row_month['lotldg_balbags'];
					$slqty=$row_month['balqty'];
					
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					
					$nob=$nob+$slups;
					$qty=$qty+$slqty;
					}
				}
			}
		}
	
		$aq=explode(".",$nob);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}
		
		$an=explode(".",$qty);
		if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
	
	
			
	
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
		$row31=mysqli_fetch_array($quer3);
	
		$tdate=$row_arr_home['testdate'];
		if($qc=="UT" && $tdate!='NULL')
		$flg++;
	}
//	echo $lotno."  =  ".$germflg."<br />";
if($germflg==2)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $setupdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dos;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode1[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode2[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode3[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode4[$i]?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $setupdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dos;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td> 
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode1[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode2[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode3[$i]?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xfoccode4[$i]?></td>
</tr>
<?php
}
$srno=$srno+1;$cont++;
}
}
}
}
}
}
?>				  
</table>

<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</td></tr>
</table>

</body>
</html>

