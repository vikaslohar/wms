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
	$dotage = $_REQUEST['dotage'];
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return - Quality Report as on Date - <?php echo date("d-m-Y");?></title>
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
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_qualitysr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&dotage=<?php echo $_REQUEST['dotage']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table> 
<?php
	$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	if($dotage=="less45")
		$durations="Less than 45 days";
	if($dotage=="more45")
		$durations="More than 45 days";
?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="6" align="center" class="subheading">Sales Return Quality Report as on Date - <?php echo date("d-m-Y");?></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
	<tr height="25" >
	 <td width="33%" align="left" class="subheading">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
	 <td align="center" class="subheading">Variety: <?php echo $ver;?></td>
    <td width="33%" align="right" class="subheading">QC Test Duration: <?php echo $durations;?>&nbsp;&nbsp;</td>
  	</tr>
</table>
<?php
$crop1=$crop;
$variety1=$variety; 
$cont=0; $veriet="";

	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trtype='Sales Return' and lotldg_balqty > 0";

	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	
	
	if($tot_arr_home>0)
	{
		while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
		{ 
			$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND  lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."'  and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_balqty > 0 group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' order by lotldg_id asc ") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$flg=0;$qty=0;
							$qty=$row_issuetbl['lotldg_balqty'];
							$qcresult=$row_issuetbl['lotldg_qc'];
							$gotresult=$row_issuetbl['lotldg_got'];
							if($qcresult!="OK")$flg++;	
							if($gotresult=="Fail")$flg++;	
							if(($qcresult=="OK") && $qty==0)$flg++;
							
							$trdate2=$row_issuetbl['lotldg_qctestdate'];
							
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$trdate=$trday."-".$trmonth."-".$tryear;
							if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
							
							$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;
							
							if($dotage=="less45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt2="";
								}
								//echo $dt2;
								if($dt2!="")
								{
									if($trdate2<$dt2)$flg++;
								}
							}
							else if($dotage=="more45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt24="";
								}
								//echo $dt2;
								if($dt24!="")
								{
									if($trdate2>=$dt24)$flg++;
								}
							}
							else
							{
							}
							if($flg==0)
							{
								if($veriet!="")
								$veriet=$veriet.",".$row_issuetbl['lotldg_variety'];
								else
								$veriet=$row_issuetbl['lotldg_variety'];
								$cont++;
							}
							
						}
					}
				}
			}
		}
	}
	
	$qry2="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' AND trtype='Sales Return' and balqty > 0";

	if($crop!="ALL")
	{	
	$qry2.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
	$qry2.=" and lotldg_variety='$variety' ";
	}
	
	$qry2.=" group by lotldg_crop, lotldg_variety";
	$sql_arr_home12=mysqli_query($link,$qry2) or die(mysqli_error($link));
 	$tot_arr_home2=mysqli_num_rows($sql_arr_home12);
	
	
	
	if($tot_arr_home>0)
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
		{ 
			$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND  lotldg_crop='".$row_arr_home12['lotldg_crop']."' and lotldg_variety='".$row_arr_home12['lotldg_variety']."' and balqty > 0 and trtype='Sales Return' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0 group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$flg=0;$qty=0;
							$qty=$row_issuetbl['balqty'];
							$qcresult=$row_issuetbl['lotldg_qc'];
							$gotresult=$row_issuetbl['lotldg_got'];
							if($qcresult!="OK")$flg++;	
							if($gotresult=="Fail")$flg++;	
							if(($qcresult=="OK") && $qty==0)$flg++;
							
							$trdate2=$row_issuetbl['lotldg_qctestdate'];
							
							$trdate=$row_issuetbl['lotldg_qctestdate'];
							$tryear=substr($trdate,0,4);
							$trmonth=substr($trdate,5,2);
							$trday=substr($trdate,8,2);
							$trdate=$trday."-".$trmonth."-".$tryear;
							if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
							
							$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;
							
							if($dotage=="less45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt2="";
								}
								//echo $dt2;
								if($dt2!="")
								{
									if($trdate2<$dt2)$flg++;
								}
							}
							else if($dotage=="more45")
							{
								$dt=45;
								if($trdate!="")
								{
									$m=$trmonth;
									$de=$trday;
									$y=$tryear;
									$dt22=$dt;
									if($dt!="")
									{
										for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
									}
									else
									$dt24="";
								}
								//echo $dt2;
								if($dt24!="")
								{
									if($trdate2>=$dt24)$flg++;
								}
							}
							else
							{
							}
							if($flg==0)
							{
								if($veriet!="")
								$veriet=$veriet.",".$row_issuetbl['lotldg_variety'];
								else
								$veriet=$row_issuetbl['lotldg_variety'];
								$cont++;
							}
							
						}
					}
				}
			}
		}
	}
//echo $veriet;
$variet=explode(",",$veriet);
$variet = array_unique($variet); 
sort($variet);

if($cont > 0)
{

foreach($variet as $verval)
{
if($verval <> "")
{
$srno=1; $cnt=0;	
	$quer4=mysqli_query($link,"SELECT popularname, cropname FROM tblvariety  where varietyid='".$verval."' "); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$noticia_item['cropname']."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	$trdate240=date("Y-m-d");
	$totalbags=0; $totalqty=0;
?> 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
	<tr height="25" >
	 <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $cropn;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $varietyn;?>&nbsp;&nbsp;</td>
  	</tr>
</table> 
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="22" align="center" valign="middle" class="tblheading">#</td>
	<td width="115"  align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="60"  align="center" valign="middle" class="tblheading">Stage</td>
	<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="65"  align="center" valign="middle" class="tblheading">NoP/NoB</td>
	<td width="65" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="130" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="45" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="64" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="51" align="center" valign="middle" class="tblheading">Duration from DoT</td>
	<td width="44" align="center" valign="middle" class="tblheading">GOT Status</td>
</tr>
<?php
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_crop='".$noticia_item['cropname']."' and lotldg_variety='".$verval."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		
		
			
		//$lrole=$row_arr_home['arr_role'];
		//$arrival_id=$row_arr_home['lotldg_id'];
		
		$flg=0;		
		$sups=0; $sqty=0; $sstage=""; $sloc="";
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $ups=""; $qcresult="";
		$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_balqty > 0  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  order by lotldg_id asc ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0  order by lotldg_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{	$slups=0; $slqty=0;
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					$slups=$row_issuetbl['lotldg_balbags'];
					$slqty=$row_issuetbl['lotldg_balqty'];
					
					$sups=$sups+$row_issuetbl['lotldg_balbags'];
					$sqty=$sqty+$row_issuetbl['lotldg_balqty'];
					
					$qcresult=$row_issuetbl['lotldg_qc'];
					$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
					if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
					$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
					else
					$gotresult=$gorr[0]." ".$gorr[1];
					
					$stage=$row_issuetbl['lotldg_sstage'];
				
				$aq=explode(".",$slqty);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
				
				$an=explode(".",$slups);
				if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
					
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars']."/";
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname']."/";
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
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
				
				$lotno=$row_arr_home['lotldg_lotno'];
				$sstage=$row_arr_home['lotldg_sstage'];
				if($got=="")
				$got=$row_arr_home['lotldg_moisture'];
				if($stage=="")
				$stage=$row_arr_home['lotldg_gemp'];
				
				if($qcresult=="")
				$qcresult=$row_arr_home['lotldg_qc'];
				
				if($bags!="")
				{
				$bags=$bags."<br>".$acn;
				}
				else
				{
				$bags=$acn;
				}
				if($qty!="")
				{
				$qty=$qty."<br>".$ac;
				}
				else
				{
				$qty=$ac;
				}
				
				$trdate2=$row_issuetbl['lotldg_qctestdate'];
				
				$trdate=$row_issuetbl['lotldg_qctestdate'];
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$trdate=$trday."-".$trmonth."-".$tryear;
				if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
			
			}
			}
			}

$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;

if($dotage=="less45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate2<$dt2)$flg++;
	}
}
else if($dotage=="more45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt24="";
	}
	//echo $dt2;
	if($dt24!="")
	{
		if($trdate2>=$dt24)$flg++;
	}
}
else
{
}

//echo $dt2;
$diff = abs(strtotime($trdate240) - strtotime($trdate));

//$years = floor($diff / (365*60*60*24));
//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor($diff / (60*60*24));

//printf("%d days\n", $days);
//echo $trdate."  -  ".$dt2."  -  ".$dt24."<br />";
$days=$days;
$gotres=explode(" ", $gotresult);
if($gotres[1]=="Fail")$flg=1;
if($qcresult!="OK")$flg=1;
if($flg==0)
{$cnt++;
$totalqty=$totalqty+$qty; 
$totalbags=$totalbags+$bags;
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $days?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $days?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
<?php
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$noticia_item['cropname']."' and lotldg_variety='".$verval."' and balqty > 0 and trtype='Sales Return' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		
		
			
		//$lrole=$row_arr_home['arr_role'];
		//$arrival_id=$row_arr_home['lotdgp_id'];
		
		$flg=0;		
		$sups=0; $sqty=0; $sstage=""; $sloc="";
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $ups=""; $qcresult="";
		$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0  group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0  order by lotdgp_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{	$slups=0; $slqty=0;
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					$slups=$row_issuetbl['balnop'];
					$slqty=$row_issuetbl['balqty'];
					
					$sups=$sups+$row_issuetbl['balnop'];
					$sqty=$sqty+$row_issuetbl['balqty'];
					
					$qcresult=$row_issuetbl['lotldg_qc'];
					$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
					if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
					$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
					else
					$gotresult=$gorr[0]." ".$gorr[1];
					
					$stage=$row_issuetbl['lotldg_sstage'];
				
				$aq=explode(".",$slqty);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
				
				$an=explode(".",$slups);
				if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
					
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars']."/";
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname']."/";
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				$slups=$row_issuetbl['balnop'];
				$slqty=$row_issuetbl['balqty'];
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
				
				$lotno=$row_arr_home['lotno'];
				$sstage=$row_arr_home['lotldg_sstage'];
				if($got=="")
				$got=$row_arr_home['lotldg_moisture'];
				if($stage=="")
				$stage=$row_arr_home['lotldg_gemp'];
				
				if($qcresult=="")
				$qcresult=$row_arr_home['lotldg_qc'];
				
				if($bags!="")
				{
				$bags=$bags."<br>".$acn;
				}
				else
				{
				$bags=$acn;
				}
				if($qty!="")
				{
				$qty=$qty."<br>".$ac;
				}
				else
				{
				$qty=$ac;
				}
				
				$trdate2=$row_issuetbl['lotldg_qctestdate'];
				
				$trdate=$row_issuetbl['lotldg_qctestdate'];
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$trdate=$trday."-".$trmonth."-".$tryear;
				if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
			
			}
			}
			}

$trdate6=explode("-", date("Y-m-d"));
							$tryear=$trdate6[0];
							$trmonth=$trdate6[1];
							$trday=$trdate6[2];
							$trdate240=$tryear."-".$trmonth."-".$trday;

if($dotage=="less45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate2<$dt2)$flg++;
	}
}
else if($dotage=="more45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt24=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt24="";
	}
	//echo $dt2;
	if($dt24!="")
	{
		if($trdate2>=$dt24)$flg++;
	}
}
else
{
}

//echo $dt2;
$diff = abs(strtotime($trdate240) - strtotime($trdate));

//$years = floor($diff / (365*60*60*24));
//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor($diff / (60*60*24));

//printf("%d days\n", $days);
//echo $trdate."  -  ".$dt2."  -  ".$dt24."<br />";
$days=$days;
$gotres=explode(" ", $gotresult);
if($gotres[1]=="Fail")$flg=1;
if($qcresult!="OK")$flg=1;
if($flg==0)
{$cnt++;
$totalqty=$totalqty+$qty; 
$totalbags=$totalbags+$bags;
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $days?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresult?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $days?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $gotresult;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
<tr class="Dark">
	<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $totalbags?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totalqty;?></td>
	<td align="center" valign="middle" class="tblheading" colspan="5">&nbsp;</td>
</tr>
</table>
<?php
}
}
}
?>	
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3">&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;<a href="excel_qualitysr.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&dotage=<?php echo $_REQUEST['dotage']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" /></td>
</tr>
</table>
</body>
</html>
