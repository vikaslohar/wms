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
 
if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
if(isset($_GET['b']))
{
	$b = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$c = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	$h = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$tid = $_GET['g'];	 
}
if(isset($_GET['l']))
{
	$subtid = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	$subsubtid = $_GET['m'];	 
}
if(isset($_GET['n']))
{
	$stageval = $_GET['n'];	 
}
if(isset($_GET['q']))
{
	$selups = $_GET['q'];	 
}
?>

<table id="lottbl" align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php

$sno1=1;

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$b'"); 
$row_dept5=mysqli_fetch_array($quer5);
$b=$row_dept5['cropid'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$c' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$c=$row_dept4['varietyid'];	
if($stageval!="Pack")
{
?>
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="112" align="center" class="smalltblheading">Crop</td>
	<td width="140" align="center" class="smalltblheading">Variety</td>
	<td width="125" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="65" align="center" class="smalltblheading">UPS</td>-->
	<td width="60" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="83" align="center" class="smalltblheading">DoT</td>
	<td width="187" align="center" class="smalltblheading">SLOC</td>
	<td width="66" align="center" class="smalltblheading">Select</td>
</tr>
<?php 
$sql_month=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='$b' and lotldg_variety='$c' and lotldg_sstage='$stageval'")or die("Error:".mysqli_error($link));
while($row_month=mysqli_fetch_array($sql_month))
{
	$flg=0;
	$lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; 

	$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_crop='$b' and lotldg_variety='$c' and lotldg_sstage='$stageval' and lotldg_lotno='".$row_month['lotldg_lotno']."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where lotldg_crop='$b' and lotldg_variety='$c' and lotldg_sstage='$stageval' and lotldg_lotno='".$row_month['lotldg_lotno']."' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$rowmonth2[0]."'")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$rowmonth3['lotldg_balbags']; 
			$qty=$rowmonth3['lotldg_balqty'];
			
			$qc=$rowmonth3['lotldg_qc'];
			
			$trdate=$rowmonth3['lotldg_qctestdate'];
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$rowmonth3['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$rowmonth3['lotldg_subbinid']."' and binid='".$rowmonth3['lotldg_binid']."' and whid='".$rowmonth3['lotldg_whid']."'") or die(mysqli_error($link));
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
				
				$totqty=$totqty+$qty; 
				$totnob=$totnob+$nob;
			}
			
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
			/*if($rowmonth3['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;*/
			if($zz[0]=="GOT-NR")
			{
				if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				if(($rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="OK" && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
			
			if($vflg > 0) $flg++;
		}
	}
	
	if($totqty==0)$flg++;
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$b."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$c."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$lotno=$row_month['lotldg_lotno'];
	
$aldnob=0; $aldqty=0;
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where dtdf_id='$tid' and dbss_lotno='$lotno'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	$aldnob=$aldnob+$roo['dbss_nob'];
	$aldqty=$aldqty+$roo['dbss_qty'];
}
$totnob=$totnob-$aldnob;
$totqty=$totqty-$aldqty;
if($totqty>0 && $totnob<=0)	$totnob=1;	
if($totqty<=0 && $totnob>0)	$totnob=0;
//echo $flg;
$llttn=""; $xcltn=array();
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where dtdfs_id='$subtid'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	if($llttn!="")
	$llttn=$llttn.",".$roo['dbss_lotno'];
	else
	$llttn=$roo['dbss_lotno'];
}
if($llttn!="")
{
	$xcltn=explode(",",$llttn);
}

if(!in_array($lotno,$xcltn))
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="tbltext"><input type="radio" name="lotsel" value="<?php echo $lotno?>" onclick="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $a;?>,'<?php echo $variety?>','<?php echo $stageval?>','<?php echo $selups?>')"  /></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
}
else
{
?>
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="112" align="center" class="smalltblheading">Crop</td>
	<td width="140" align="center" class="smalltblheading">Variety</td>
	<td width="125" align="center" class="smalltblheading">Lot No.</td>
	<td width="95" align="center" class="smalltblheading">UPS</td>
	<td width="60" align="center" class="smalltblheading">NoP</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="45" align="center" class="smalltblheading">QC at Packing</td>
	<td width="83" align="center" class="smalltblheading">DoT</td>
	<td width="167" align="center" class="smalltblheading">SLOC</td>
	<td width="56" align="center" class="smalltblheading">Select</td>
</tr>
<?php
$dq=explode(" ",$selups);
//if($dq[1]=="Gms")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
//echo "select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='$b' and lotldg_variety='$c' and packtype='$selups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 order by packtype ";
//echo "select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='$b' and lotldg_variety='$c' and packtype='$selups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 order by packtype ";
$sql_month=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='$b' and lotldg_variety='$c' and packtype='$selups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 order by packtype ")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sql_month);
while($row_month=mysqli_fetch_array($sql_month))
{
$flg=0;
$lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; 

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotldg_crop='$b' and lotldg_variety='$c' and packtype='$selups' and lotno='".$row_month['lotno']."' ")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where lotldg_crop='$b' and lotldg_variety='$c' and packtype='$selups' and lotno='".$row_month['lotno']."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$rowmonth2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 and balqty>0")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$rowmonth3['balnomp']; 
			$qty=$rowmonth3['balqty'];
			$lotallqty=$rowmonth3['lotldg_alqtys'];
			if($lotallqty<=0)$lotallqty=0;
			
			$lotallnmp=$rowmonth3['lotldg_alnomps'];
			if($lotallnmp<=0)$lotallnmp=0;
			
			$qc=$rowmonth3['lotldg_qc'];
			$lotups=$rowmonth3['packtype'];
			$dot=$rowmonth3['lotldg_qctestdate'];
			$ups=$lotups;
			
			$lotno=$rowmonth3['lotno'];
			
			$zz=str_split($lotno);
			$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
			$qcstsap="DoT";	$srfl=0; $qcdot2=""; $trdate23=""; $trdate24="";
				
			$sql_pnp2=mysqli_query($link,"Select max(pnpslipsub_id) from tbl_pnpslipsub where pnpslipsub_plotno='".$lotn."' order by pnpslipsub_id desc") or die(mysqli_error($link));
			$row_pnp2=mysqli_fetch_array($sql_pnp2);
							
			$sql_pnp=mysqli_query($link,"Select pnpslipsub_qcdot from tbl_pnpslipsub where pnpslipsub_plotno='".$lotn."' and pnpslipsub_id='".$row_pnp2[0]."' order by pnpslipsub_qcdot desc") or die(mysqli_error($link));
			$row_pnp=mysqli_fetch_array($sql_pnp);
			if($tot_pnp=mysqli_num_rows($sql_pnp)>0)
			{
				$trdate23=$row_pnp['pnpslipsub_qcdot'];
				$qcstsap=$row_pnp['pnpslipsub_qcdttype'];
				if($trdate23!="0000-00-00" && $trdate23!="--" && $trdate23!="- -" && $trdate23!="")
				{
					$qcdot2=$row_pnp['pnpslipsub_qcdot'];
					//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
								
			$sqlpnp2=mysqli_query($link,"Select max(rv_id) from tbl_revalidate where rv_newlot='".$lotn."' order by rv_id desc ") or die(mysqli_error($link));
			$rowpnp2=mysqli_fetch_array($sqlpnp2);
								
			$sqlpnp=mysqli_query($link,"Select rv_dot from tbl_revalidate where rv_newlot='".$lotn."' and rv_id='".$rowpnp2[0]."' order by rv_dot desc ") or die(mysqli_error($link));
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
						$qcdot2=$row_softr['softr_date'];
						//$trdate=explode("-",$trdate);
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
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
							$qcdot2=$row_softr2['softr_date'];
							//$trdate=explode("-",$trdate);
						//$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
						}
					}
				}
			}
									
			if($qcdot2!="")	{$dot=$qcdot2;  $qcstsap='DoSF';}
								
			/*$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
			$tot_pnp=mysqli_num_rows($sql_pnp);
			if($tot_pnp > 0)
			{	
				$row_pnp=mysqli_fetch_array($sql_pnp);
				$qcstsap=$row_pnp['pnpslipsub_qcdttype'];
				if($row_pnp['pnpslipsub_qcdttype']=="DoSF" || $row_pnp['pnpslipsub_qcdttype']=="DosF" || $row_pnp['pnpslipsub_qcdttype']=="DOSF")
				$srfl=1;
			}
			//echo $lotn."  ".$qcstsap." ";
									
			if($srfl==1)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
				//echo $qcdot2;
				if($qcdot2=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
			}
			if($srfl==1 && $qcdot2!=""){$dot=$qcdot2; $qcstsap='DoSF';}*/
			
			$trdate=$dot;
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$tdate=$rowmonth3['lotldg_valupto'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dov=$tday."-".$tmonth."-".$tyear;
			//echo $lotno." -- ".$flg."<br/>";
			$dt=date("Y-m-d");
			$diff = abs(strtotime($rowmonth3['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
			//if($days<30)$flg++;
			if($rowmonth3['lotno']!="DU91106/00000/01P"){if($days<30)$flg++;}
			
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$rowmonth3['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$rowmonth3['subbinid']."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				$diq=explode(".",$nob);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
				$nob=$difq;
				if($nob<0)$nob=0;
				
				$diq=explode(".",$qty);
				if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
				$qty=$difq1;
				
				$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
				
				if($sloc=="")
					$sloc=$slocs;
				else
					$sloc=$sloc."<br />".$slocs;
				
				$totqty=$totqty+$qty; 
				$totnob=$totnob+$nob;
			}
			
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
			/*if($rowmonth3['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;*/
			if($zz[0]=="GOT-NR")
			{
				/*if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}*/
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				/*if(($rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="OK" && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}*/
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
			if($vflg > 0) $flg++;
			
			
			
			$nop1=0; $nop2=0; $b1=0; $b2=0;
			$ups=$rowmonth3['packtype'];
			$wtinmp=$rowmonth3['wtinmp'];
			$upspacktype=$rowmonth3['packtype'];
			$packtp2=explode(" ",$upspacktype);
			$packtyp=$packtp2[0]; 
			if($packtp2[1]=="Gms")
			{ 
				$ptp2=(1000/$packtp2[0]);
				$ptp1=($packtp2[0]/1000);
			}
			else
			{
				if($packtp2[0]<1)
				{
					$ptp2=(1000/$packtp2[0])/1000;
					$ptp1=($packtp2[0]/1000)*1000;
				}
				else
				{
					$ptp2=$packtp2[0];
					$ptp1=$packtp2[0];
				}
			}
			$nmp=$rowmonth3['balnomp'];
			if($nmp<0)$nmp=0;
			$penqty=(($rowmonth3['balqty'])-($wtinmp*$nmp));
			//echo $ptp2;
			if($penqty > 0)
			{
				if($packtp2[1]=="Gms")
				{
					$nop1=($ptp2*$penqty);
				}
				else
				{
					if($packtp2[0]<1)
					$nop1=($penqty*$ptp2);
					else
					$nop1=($penqty/$ptp2);
				}
			}
			if($packtp2[1]=="Gms")
			{
				$nop2=($ptp2*$rowmonth3['balqty']);
			}
			else
			{
				if($packtp2[0]<1)
				$nop2=($rowmonth3['balqty']*$ptp2);
				else
				$nop2=($rowmonth3['balqty']/$ptp2);
			}
			$nop2;
			
			$bnmp=$rowmonth3['balnomp'];
			$bqty1=$rowmonth3['balqty'];
			if($packtp2[1]=="Gms")
			{$bnob=$bqty1*$ptp2;}
			else
			{
				if($packtp2[0]<1)
					$bnob=$bqty1*$ptp2;
				else
					$bnob=$bqty1/$ptp2;	
			}
		}
		
	}
	
	//echo $lotn."  ";
	$bqty=$totqty;
	//echo "  ";
	
	//$lotno=$lotn;
	$zz=str_split($lotno);
	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0; $talqt=0; $talnmp=0;
	$totextpouches=0; $totextqtys=0;
	$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where mpmain_trtype='PACKSMC' and mpmain_lotno='".$lotno."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mps=mysqli_num_rows($sql_mps);
	if($tot_mps > 0)
	{
		while($row_mps=mysqli_fetch_array($sql_mps))
		{
			$crparr=$row_mps['mpmain_crop'];
			$verarr=$row_mps['mpmain_variety'];
			$lotarr=explode(",", $row_mps['mpmain_lotno']);
			$upsarr=$row_mps['mpmain_upssize'];
			$noparr=explode(",", $row_mps['mpmain_mptnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nops=$nops+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
					/*if($row_mps['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					}*/
				}
			}
			
		}
	}
	
	$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where mpmain_trtype='PACKLMC' and mpmain_variety='".$c."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpl=mysqli_num_rows($sql_mpl);
	if($tot_mpl > 0)
	{
		while($row_mpl=mysqli_fetch_array($sql_mpl))
		{
			$crparr=$row_mpl['mpmain_crop'];
			$verarr=$row_mpl['mpmain_variety'];
			$lotarr=explode(",", $row_mpl['mpmain_lotno']);
			$upsarr=$row_mpl['mpmain_upssize'];
			$noparr=explode(",", $row_mpl['mpmain_lotnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nopl=$nopl+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
					if($row_mpl['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					}
				}
			}
			
		}
	}
	
	$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_alflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpm=mysqli_num_rows($sql_mpm);
	if($tot_mpm > 0)
	{
		while($row_mpm=mysqli_fetch_array($sql_mpm))
		{
			$crparr=explode(",", $row_mpm['mpmain_crop']);
			$verarr=explode(",", $row_mpm['mpmain_variety']);
			$lotarr=explode(",", $row_mpm['mpmain_lotno']);
			$upsarr=explode(",", $row_mpm['mpmain_upssize']);
			$noparr=explode(",", $row_mpm['mpmain_lotnop']);
			
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr[$i])
				{
					$nopm=$nopm+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtym=$qtym+($ptp*$noparr[$i]); $nompm=$nompm+$ct; 
					if($row_mpm['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					}
				}
			}
			
		}
	}
	$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where mpmain_trtype='PACKNMC' and mpmain_lotno='".$lotno."' and mpmain_dflg!=1 and mpmain_alflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpns=mysqli_num_rows($sql_mpns);
	if($tot_mpns > 0)
	{
		while($row_mpns=mysqli_fetch_array($sql_mpns))
		{
			$crparr=$row_mpns['mpmain_crop'];
			$verarr=$row_mpns['mpmain_variety'];
			$lotarr=explode(",", $row_mpns['mpmain_lotno']);
			$upsarr=$row_mpns['mpmain_upssize'];
			$noparr=explode(",", $row_mpns['mpmain_lotnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nopns=$nopns+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct;
					/*if($row_mpns['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					}*/ 
				}
			}
			
		}
	}
	
	$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where mpmain_trtype='PACKNLC' and mpmain_variety='".$c."' and mpmain_dflg!=1 and mpmain_alflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
	$tot_mpnl=mysqli_num_rows($sql_mpnl);
	if($tot_mpnl > 0)
	{
		while($row_mpnl=mysqli_fetch_array($sql_mpnl))
		{
			$crparr=$row_mpnl['mpmain_crop'];
			$verarr=$row_mpnl['mpmain_variety'];
			$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
			$upsarr=$row_mpnl['mpmain_upssize'];
			$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
			
			$ct=0;
			$variety;
			$crop;
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotno==$lotarr[$i] && $ups==$upsarr)
				{
					$nopnl=$nopnl+$noparr[$i];
					$ct++;
					$up=explode(" ", $ups);
					if($up[1]=="Gms")
					{
						$ptp=$up[0]/1000;
					}
					else
					{
						$ptp=$up[0];
					}
					$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$nompnl+$ct; 
					if($row_mpnl['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					}
				}
			}
			
		}
	}
	
	$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
	$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 
	$bqty=floatval($bqty);
	$totextqtys=floatval($totextqtys);	
	// $avlqty=($bqty1)-($qtyl+$qtynl)-($lotallqty);
	//echo $lotno."  =  ".$qtys."  -  ".$nomps." -> ".$totextqtys."  -  ".$bqty1."  =  ".$avlqty."<br/>";
	$totnomp1=$nomps+$nompl+$nompm+$nompns+$nompnl;
	$totnomp=$nomps+$nompm+$nompns;
	
	//$totnomp1=$nomps+$nompns;
	$qbnmp=$nmp-$totnomp1;
	//echo $lotno." - ";
	$zqt=$qbnmp*$wtinmp;
	$qbqty=$bqty-$zqt;
	//echo "<br/>";
	$balcqty=$lotallqty-$talqt;
	//$tewr=$balcqty/$wtinmp;
	//$tewr=round($tewr,3);
	//$terete=explode(".",$tewr);
	//if($terete[0]>0)
	$dfgrt=($lotallnmp-$talnmp)*$wtinmp;
	$bpchalcqty=$balcqty-$dfgrt;
	//$balcpchqty=$balcqty-($balcqty*$wtinmp);
	
	//$avlqty=($bqty-$totextqtys)-($bpchalcqty);
	$avlqty=($bqty)-($totextqtys);//-$lotallqty);
	
	if($bnmp>0)
	$bnob=$bnob-$totextpouches;
	
	$nop1=$bnob;
	//$avlqty=$nop1*$ptp1;
	$totnob=$nop1;
	//$totnob=$nmp-$lotallnmp;
	$totqty=$avlqty;
	//if($totqty>0)
	//echo $lotno."  =  ".$bqty."  =  ".$bnob." => ".$totextqtys."  =  ".$totnob."  =  ".$avlqty."<br/>";
	
	
	
	if($totnob<0)$totnob=0;
	if($totqty<=0)$totnob=0;
	if($totqty<=0)$flg++;
	if($bnob>0)
	if($totnob==0)$flg++;
	//echo $lotno."  =  ".$totnob."  =  ".$totqty."  =  ".$flg."<br/>";
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='".$c."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_var['cropname']."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	//$lotno=$lotn;
	//echo $lotno."  -  ".$bnob."  -  ".$totextpouches."  -  ".$flg."<br>";
	

$aldnob=0; $aldqty=0;
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where dtdf_id='$tid' and dbss_lotno='$lotno'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	$aldnob=$aldnob+$roo['dbss_nob'];
	$aldqty=$aldqty+$roo['dbss_qty'];
}
$totnob=$totnob-$aldnob;
$totqty=$totqty-$aldqty;
if($totqty>0 && $totnob<=0)	$totnob=1;
if($totqty<=0 && $totnob>0)	$totnob=0;

	$llttn=""; $xcltn=array();
	$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where dtdfs_id='$subtid'") or die(mysqli_error($link));
	while($roo=mysqli_fetch_array($sqq))
	{
		if($llttn!="")
		$llttn=$llttn.",".$roo['dbss_lotno'];
		else
		$llttn=$roo['dbss_lotno'];
	}
	if($llttn!="")
	{
		$xcltn=explode(",",$llttn);
	}
	
//$flg=0;	
if($llttn!="")
{//print_r($xcltn);
if(in_array($lotno,$xcltn))
{
$flg=1;
}
}
	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcstsap;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="tbltext"><input type="radio" name="lotsel" value="<?php echo $lotno?>" onclick="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $a;?>,'<?php echo $variety?>','<?php echo $stageval?>','<?php echo $selups?>')"  /></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
//}
?>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" /><input type="hidden" name="ltchksel" value="" />
</table><br />

<div id="postingsubsubtable" style="display:block">
<table id="lotdt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<table id="lotsldt" align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /></div>
