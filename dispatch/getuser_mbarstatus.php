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

if(isset($_GET['tp']))
{
	$barcodes=$_GET['tp'];	 
}
if($barcodes!="")
{
$barcodes=$barcodes.",";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Direct Loading / Non-Allocation Type - Barcode Details</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Barcode Details</td>
</tr>
<tr class="Light" height="25">
	<td width="19" align="center" class="smalltblheading">#</td>
	<td width="73" align="center" class="smalltblheading">Barcode</td>
	<td width="27" align="center" class="smalltblheading">Type</td>
	<td width="75" align="center" class="smalltblheading">Crop</td>
	<td width="120" align="center" class="smalltblheading">Variety</td>
	<td width="75" align="center" class="smalltblheading">UPS</td>
	<td width="100" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="35" align="center" class="smalltblheading">QC Status</td>
	<td width="60" align="center" class="smalltblheading">DoT</td>
	<td width="60" align="center" class="smalltblheading">DoV</td>
	<td width="40" align="center" class="smalltblheading">Net Weight</td>
	<td width="40" align="center" class="smalltblheading">Gross Weight</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php
$sno=1;
$barc=explode(",",$barcodes);
foreach($barc as $barcode)
{
if($barcode<>"")
{
$sqlbarc1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."'") or die(mysqli_error($link));
$totbarc1=mysqli_num_rows($sqlbarc1);
$rowbarc1=mysqli_fetch_array($sqlbarc1);
if($totbarc1>0)
{
	$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
	$totbarcode=mysqli_num_rows($sqlbarcode);
	$rowbarcode=mysqli_fetch_array($sqlbarcode);
	$grwts2=$rowbarcode['bar_grosswt'];
	
	
	$pty=$rowbarc1['mpmain_trtype'];
	if($pty=="PACKSMC") $packtyp="SMC";
	if($pty=="PACKLMC") $packtyp="LMC";
	if($pty=="PACKMMC") $packtyp="MMC";
	if($pty=="PACKNMC")	$packtyp="NMC";
	if($pty=="PACKNLC") $packtyp="NLC";
							
	if($pty=="PACKSMC" || $pty=="PACKNMC")
	{
	
		$lotno=$rowbarc1['mpmain_lotno'];
		$vr1=$rowbarc1['mpmain_variety'];
		$ui1=$rowbarc1['mpmain_upssize'];
		$nqty6=$rowbarc1['mpmain_wtmp'];
		
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop   cropid='".$rowbarc1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
			
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$rowbarc1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
		
		
		
		
		$sql_lot24=mysqli_query($link,"Select Distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$ui1' order by lotdgp_id DESC") or die(mysqli_error($link));
		$tot_lot24=mysqli_num_rows($sql_lot24);
		while($row_lot24=mysqli_fetch_array($sql_lot24))
		{
			
			$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$row_lot24['lotno']."' and packtype='$ui1' order by lotdgp_id DESC") or die(mysqli_error($link));
			$tot_lot2=mysqli_num_rows($sql_lot2);
			$row_lot2=mysqli_fetch_array($sql_lot2);
				
			$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1  and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
			$tot_lot=mysqli_num_rows($sql_lot);
			$row_lot=mysqli_fetch_array($sql_lot);
				
					
			$qc=$row_lot['lotldg_qc'];
							
			$trdate=$row_lot['lotldg_qctestdate'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$trdate=$row_lot['lotldg_valupto'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			
			$dov=$trday."-".$trmonth."-".$tryear;
			
			$trdate=$row_lot['lotldg_dop'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dop=$trday."-".$trmonth."-".$tryear;			
				
			$diff = abs(strtotime($row_lot['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
					
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_lot['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
								
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_lot['binid']."' and whid='".$row_lot['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
								
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_lot['subbinid']."' and binid='".$row_lot['binid']."' and whid='".$row_lot['whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
								
				$diq=explode(".",$nob);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
					$nob=$difq;
				$diq=explode(".",$qty);
				if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
					$qty=$difq1;
								
				$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
							
				if($sloc=="")
					$sloc=$slocs;
				else
					$sloc=$sloc."<br />".$slocs;
								
			}
				
			$vflg=0;	
			$zz=explode(" ", $row_lot['lotldg_got1']);
						
			if($zz[0]=="GOT-NR")
			{
				if(($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				if(($row_lot['lotldg_got']=="UT" || $row_lot['lotldg_got']=="RT") && $row_lot['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($row_lot['lotldg_got']=="OK" && ($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
		
			$zz=str_split($row_lot24['lotno']);
			$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
		
			if($row_lot['lotldg_srflg']==1)
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
			if(($dot=="00-00-0000" || $dot=="--" || $dot==" ")&& $row_lot['lotldg_srflg']==1)$dot=$qcdot2;
			if(($dot=="00-00-0000" || $dot=="--" || $dot==" "))$dot="";
			
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $packtyp;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ui1?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
$sno++;	
}
}
else
{
	$cropval=""; $varietyval=""; $lotval=""; $upsval=""; $qcval=""; $dotval=""; $dovval="";
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
			$ltqt=$ptp2*$lotnop[$i];
				
								
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
			$dot=$row_lot['lotldg_qctestdate'];
			$dov=$row_lot['lotldg_valupto'];
											
			$zz=str_split($lotno);
			$ltno2=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
											
			$srfl=0; $qcdot2="";
			$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$lotno'") or die(mysqli_error($link));
			$row_pnp=mysqli_fetch_array($sql_pnp);
			$tot_pnp=mysqli_num_rows($sql_pnp);
			if($tot_pnp > 0)
			{
				if($row_pnp['pnpslipsub_qcdttype']=="DoSF" || $row_pnp['pnpslipsub_qcdttype']=="DosF")
					$srfl=1;
			}
									
			if($srfl==1)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno2."'") or die(mysqli_error($link));
				$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
				if($tot_softr_sub > 0)
				{
					$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
					$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
					$tot_softr=mysqli_num_rows($sql_softr);
					$row_softr=mysqli_fetch_array($sql_softr);
					if($tot_softr > 0)
					{
						$qcdot2=$row_softr['softr_date'];
					}
				}
				if($qcdot2=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno2."'") or die(mysqli_error($link));
					$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
					if($tot_softr_sub2 > 0)
					{
						$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
						$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
						$tot_softr2=mysqli_num_rows($sql_softr2);
						$row_softr2=mysqli_fetch_array($sql_softr2);
						if($tot_softr2 > 0)
						{
							$qcdot2=$row_softr2['softr_date'];
						}
					}
				}
			}
			
			if(($dot=="00-00-0000" || $dot=="--" || $dot==" ")&& $srfl==1 && $qcdot2!="")$dot=$qcdot2;
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
			
			if($varietyval!="")
				$varietyval=$varietyval."<br/>".$variety;
			else
				$varietyval=$variety;	
				
			if($cropval!="")
				$cropval=$cropval."<br/>".$crop;
			else
				$cropval=$crop;		
			
			if($lotval!="")
				$lotval=$lotval."<br/>".$lotno;
			else
				$lotval=$lotno;		
				
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
		}
	}								
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $packtyp;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cropval;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $varietyval?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upsval?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotval?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcval;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dotval;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dovval;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php	
$sno++;				
//}
//}
//}
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
</body>
</html>
<?php	
}
?>