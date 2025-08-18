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
		$sn = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
		$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
		$ordnos = $_GET['c'];	 
	}
	if(isset($_GET['h']))
	{
		$vrids = $_GET['h'];	 
	}
	if(isset($_GET['g']))
	{
		$upids = $_GET['g'];	 
	}
	if(isset($_GET['l']))
	{
		$itmno = $_GET['l'];	 
	}
	if(isset($_GET['m']))
	{
		$tid = $_GET['m'];	 
	}
	if(isset($_GET['n']))
	{
		$altyp = $_GET['n'];	 
	}
	if(isset($_GET['q']))
	{
		$euptyp = $_GET['q'];	 
	}
	if(isset($_GET['r']))
	{
		$subtid = $_GET['r'];	 
	}
	
	$verids=$vrids;
	$upsids=$upids;

	if($tid=="")$tid=0;
	if($subtid=="")$subtid=0;
	
	if($altyp=="lotwise")
	{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="tblheading" colspan="12">Lots IN Progress List</td>
</tr>
<?php
	$whd1query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
<tr class="light" height="25">
<td width="553" align="right" class="tblheading">Filter/Search Type&nbsp;</td> 
<td width="140" align="right" class="tblheading">&nbsp;Lot No. wise&nbsp;<input type="text" class="smalltbltext" size="5" maxlength="5" name="lsearch" id="lsearch" onkeyup="searchlotname(this.value)" onkeypress="return isNumberKey1(event)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="12345" />&nbsp;</td>
<td width="246" align="right" class="tblheading">&nbsp;Bin wise&nbsp;&nbsp;WH&nbsp;<select class="smalltbltext" id="txttblwhg1" name="txttblwhg1" style="width:70px;"  >
<option value="" selected>WH</option>
	<?php while($noticiawhd1 = mysqli_fetch_array($whd1query)) { ?>
	<option value="<?php echo $noticiawhd1['whid'];?>" />   
	<?php echo $noticiawhd1['perticulars'];?>
	<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;Bin&nbsp;<input type="text" class="smalltbltext" size="3" maxlength="3" name="bsearch" id="bsearch" onkeyup="searchbinname(this.value)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="A01" />&nbsp;</td>
  </tr>
</table> 

<div id="searchresult" name="searchresult"> 
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="19" align="center" class="smalltblheading">#</td>
	<td width="85" align="center" class="smalltblheading">Crop</td>
	<td width="115" align="center" class="smalltblheading">Variety</td>
	<td width="87" align="center" class="smalltblheading">Lot No.</td>
	<td width="67" align="center" class="smalltblheading">UPS</td>
	<td width="55" align="center" class="smalltblheading">NoMP</td>
	<td width="65" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="45" align="center" class="smalltblheading">QC at Packing</td>
	<td width="70" align="center" class="smalltblheading">DoT/DoSF</td>
	<td width="70" align="center" class="smalltblheading">DoV</td>
	<td width="64" align="center" class="smalltblheading">Days Remaining</td>
	<td width="140" align="center" class="smalltblheading">SLOC</td>
	<td width="40" align="center" class="smalltblheading">Select</td>
</tr>
<?php 
$sno1=1;

$quer4=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='$verids' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$c=$verids;		
$b=$row_dept4['cropname'];

//echo $tid." ".$subtid."  ".$row_dept4['popularname']."  ".$upids."  ".$euptyp;
if($tid>0 && ($subtid==0 || $subtid==""))
{
	$sql2tid=mysqli_query($link,"Select dalloc_id, dallocs_id from tbl_dalloc_sub where  dalloc_id='$tid' and dallocs_variety='".$row_dept4['popularname']."' and dallocs_ups='$upids' and dallocs_upstype='$euptyp' ") or die(mysqli_error($link));
	$tol2tid=mysqli_num_rows($sql2tid);
	if($tol2tid>0)
	{
		while($rol2tid=mysqli_fetch_array($sql2tid))
		{
			//$tid=$ro2tid['dalloc_id'];
			$subtid=$rol2tid['dallocs_id'];
		}
	}
}


$ltns=""; $dys="";
$sqlmonth=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_variety='$verids' and packtype='$upsids' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0")or die("Error:".mysqli_error($link));
$t2=mysqli_num_rows($sqlmonth);
while($rowmonth=mysqli_fetch_array($sqlmonth))
{
	$sqlmon3=mysqli_query($link,"select lotldg_valupto from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$rowmonth['lotno']."'")or die("Error:".mysqli_error($link));
	$rowm3=mysqli_fetch_array($sqlmon3);
	
	$dt2=date("Y-m-d");
	$diff2 = abs(strtotime($rowm3['lotldg_valupto']) - strtotime($dt2));
	$days2 = floor($diff2 / (60*60*24));
		
	if($diff2>0)
	{	
	if($ltns=="")
		$ltns=$rowmonth['lotno'];
	else
		$ltns=$ltns.",".$rowmonth['lotno'];
	}	
		
	if($dys=="")
		$dys=$days2;
	else
		$dys=$dys.",".$days2;	
}
//echo $dys;
//echo $ltns;
$dayss=explode(",",$dys);
$ltnns=explode(",",$ltns);
//print_r($dayss);
natsort($ltnns);
natsort($dayss);

$value="";
foreach ($dayss as $key => $val) 
{
	$valu=$ltnns[$key];
	if($value=="")
		$value=$valu;
	else
		$value=$value.",".$valu;	
	//echo "$key = $val  -  $valu  \n";
}

//echo $value;
$ltno=explode(",",$value);
/*$sql_month=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_variety='$verids' and packtype='$upsids'")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sql_month);
while($row_month=mysqli_fetch_array($sql_month))
{*/
foreach($ltno as $lotn)
{
if($lotn<>"")
{

	$flg=0; $lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; $qcstsap=''; $nmp=0; $bnmp=0; $bqty1=0; $bnob=0; $ebnomp=0;

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$rowmonth2[0]."' and balqty>0 and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			//$ebnomp=$rowmonth3['balnomp']; 
			$nob=$rowmonth3['balnomp'];  
			$qty=$rowmonth3['balqty'];
			
			$lotallqty=$rowmonth3['lotldg_alqtys'];
			if($lotallqty<=0)$lotallqty=0;
			
			$lotallnmp=$rowmonth3['lotldg_alnomps'];
			if($lotallnmp<=0)$lotallnmp=0;
			
			$ebnomp=$rowmonth3['balnomp']-$lotallnmp; 

			$qc=$rowmonth3['lotldg_qc'];
			$lotups=$rowmonth3['packtype'];
			$dot=$rowmonth3['lotldg_qctestdate'];
			$ups=$lotups;
			
			
			$zz=str_split($lotn);
			$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
			$qcstsap="DoT";	$srfl=0; $qcdot2="";
			$sql_pnp=mysqli_query($link,"Select pnpslipsub_qcdttype from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
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
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
			if($srfl==1 && $qcdot2!=""){$dot=$qcdot2; $qcstsap='DoSF';}
			
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
			
			$dt=date("Y-m-d");
			$diff = abs(strtotime($rowmonth3['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
			if($days<30)$flg++;
			//echo $lotn." = ".$days."  =  ".$flg."<br />";
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$rowmonth3['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$rowmonth3['subbinid']."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
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
			if($rowmonth3['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;
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
					$nop1=($penqty/$ptp2);
				}
			}
			if($packtp2[1]=="Gms")
			{
				$nop2=($ptp2*$rowmonth3['balqty']);
			}
			else
			{
				$nop2=($rowmonth3['balqty']/$ptp2);
			}
			$nop2;
			
			$bnmp=$bnmp+$rowmonth3['balnomp'];
		 	$bqty1=$bqty1+$rowmonth3['balqty'];
			//$bnob=$bqty1*$ptp2;
			
			
	
		}
		
	}
	$packtp2=explode(" ",$upspacktype);
	$packtyp=$packtp2[0]; 
	if($packtp2[1]=="Gms")
	{ 
		if($packtyp>0)
		{
			$ptp2=(1000/$packtp2[0]);
			$ptp1=($packtp2[0]/1000);
		}
	}
	else
	{
		if($packtyp>0)
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
	}
	if($packtp2[1]=="Gms")
	{$bnob=$bnob+($bqty1*$ptp2);}
	else
	{
		if($packtyp>0)
		{
			if($packtp2[0]<1)
				$bnob=$bnob+($bqty1*$ptp2);
			else
				$bnob=$bnob+($bqty1/$ptp2);	
		}	
	}	
	//echo $lotn."  ";
	$bqty=$totqty;
	//echo "  ";
	$lotno=$lotn;
	$zz=str_split($lotno);
	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
	$totextpouches=0; $totextqtys=0;
	if($ebnomp>0)
	{

		$sql_mps=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_trtype from tbl_mpmain where plantcode='".$plantcode."' and  (mpmain_trtype='PACKSMC' OR mpmain_trtype='PACKNMC' OR mpmain_trtype='PACKLMC' OR mpmain_trtype='PACKNLC')and mpmain_lotno='".$lotno."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
						if($row_mps['mpmain_trtype']=="PACKSMC")
						{
							$nops=$nops+$noparr[$i];
							$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct;
						}
						if($row_mps['mpmain_trtype']=="PACKLMC")
						{
							$nopl=$nopl+$noparr[$i];
							$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
						}
						if($row_mps['mpmain_trtype']=="PACKNMC")
						{
							$nopns=$nopns+$noparr[$i];
							$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct; 
						}
						if($row_mps['mpmain_trtype']=="PACKNLC")
						{
							$nopnl=$nopnl+$noparr[$i];
							$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$nompnl+$ct;  
						}
					}
				}
				
			}
		}
		
		/*$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKLMC' and mpmain_variety='".$verids."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
					}
				}
				
			}
		}*/
		
		$sql_mpm=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_trtype from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKMMC' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
					}
				}
				
			}
		}
		
		/*$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKNMC' and mpmain_lotno='".$lotno."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
					}
				}
				
			}
		}
		
		$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKNLC' and mpmain_variety='".$verids."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
					}
				}
				
			}
		}*/
	}
	$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
	$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 
	$bqty=floatval($bqty);
	$totextqtys=floatval($totextqtys);	
	// $avlqty=($bqty1)-($qtyl+$qtynl)-($lotallqty);
	//echo $lotno."  =  ".$qtys."  -  ".$nomps." -> ".$totextqtys."  -  ".$bqty."  =  ".$avlqty."<br/>";
	$totnomp1=$nomps+$nompl+$nompm+$nompns+$nompnl;
	$totnomp=$nomps+$nompm+$nompns;
	
	//$totnomp1=$nomps+$nompns;
	$qbnmp=$bnmp-$totnomp1;
	//echo $lotno." - ";
	$zqt=$qbnmp*$wtinmp;
	$qbqty=$bqty1-$zqt;
	//echo "<br/>";
	$avlqty=($bqty)-($qtyl+$qtynl)-($lotallqty);
	//$avlqty=($bqty1)-($totextqtys);
	
	
	if($bnmp>0)
	$bnob=$bnob-$totextpouches;
	
	$nop1=$bnob;
	//$avlqty=$nop1*$ptp1;
	
	$totnob=$bnmp-$lotallnmp;
	$totqty=$avlqty;
	
	//echo $lotno."  =  ".$bqty1."  =  ".$bnob."  =  ".$bnmp." => ".$totnob."  =  ".$nop1."  =  ".$avlqty."  ->  ".$totextqtys."<br/>";
	
	
	//echo $lotn." = ".$totqty."  =  ".$flg;
	if($totnob<0)$totnob=0;
	if($totqty<=0)$flg++;
	//if($totnob==0)$flg++;
	
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='".$verids."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_var['cropname']."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	$lotno=$lotn;
	
	$llttn=""; $xcltn=array();
	$sqq=mysqli_query($link,"Select dallocss_lotno from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dalloc_id='$tid'") or die(mysqli_error($link));
	while($roo=mysqli_fetch_array($sqq))
	{
		if($llttn!="")
			$llttn=$llttn.",".$roo['dallocss_lotno'];
		else
			$llttn=$roo['dallocss_lotno'];
	}
	if($llttn!="")
	{
		$xcltn=explode(",",$llttn);
	}
	
	/*if(in_array($lotno,$xcltn))
	{
		$sqq2=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dalloc_id='$tid' and dallocss_lotno='$lotno'") or die(mysqli_error($link));
		$roo2=mysqli_fetch_array($sqq2);
		//$subsubtid=$roo2['dallocss_id'];
	}*/
	
//if(!in_array($lotno,$xcltn))
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcstsap;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $days;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="radio" name="lotsel" id="lotsel_<?php echo $sno1;?>" value="<?php echo $lotno?>" onclick="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $variety?>','<?php echo $upsids?>','<?php echo $tid?>','lotsel','<?php echo $wtinmp?>')"  /><input type="hidden" name="inptyp" id="inptyp_<?php echo $sno1;?>" value="lotsel" /></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
}
?>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="tblheading" colspan="12">LMC/NLC</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="19" align="center" class="smalltblheading">Barcode</td>
	<td width="85" align="center" class="smalltblheading">Crop</td>
	<td width="115" align="center" class="smalltblheading">Variety</td>
	<td width="87" align="center" class="smalltblheading">Lot No.</td>
	<td width="67" align="center" class="smalltblheading">UPS</td>
	<td width="55" align="center" class="smalltblheading">NoMP</td>
	<td width="65" align="center" class="smalltblheading">Qty</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="45" align="center" class="smalltblheading">QC at Packing</td>
	<td width="70" align="center" class="smalltblheading">DoT/DoSF</td>
	<td width="70" align="center" class="smalltblheading">DoV</td>
	<td width="64" align="center" class="smalltblheading">Days Remaining</td>
	<td width="140" align="center" class="smalltblheading">SLOC</td>
	<!--<td width="40" align="center" class="smalltblheading">Select</td>-->
</tr>
<?php 
//$sno15=1;

$quer4=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where  varietyid='$verids' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$c=$verids;		
$b=$row_dept4['cropname'];

if($euptyp=="NST")$trtyp="PACKNLC";
else $trtyp="PACKLMC";

$ltns=""; $dys=""; $qtyl=0; $nompl=0; $nopl=0;

//echo"select distinct mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_variety='$verids' and mpmain_upssize='$upsids' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC') and mpmain_rvflg=0 and mpmain_dflg=0 and mpmain_spremflg=0 and mpmain_upflg=0 and mpmain_alflg=0";

$sqlmonth6=mysqli_query($link,"select distinct mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_variety='$verids' and mpmain_upssize='$upsids' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC') and mpmain_rvflg=0 and mpmain_dflg=0 and mpmain_spremflg=0 and mpmain_upflg=0 and mpmain_alflg=0")or die("Error:".mysqli_error($link));
$t2=mysqli_num_rows($sqlmonth6);
while($rowmonth6=mysqli_fetch_array($sqlmonth6))
{
	$flg=0; $lotno=""; $nobs=""; $qtys=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qcs=""; $dots=""; $dovs=""; $ndays="";  $sloc=""; $qcstsaps="";
	
	$sql_mpl=mysqli_query($link,"Select mpmain_lotno, mpmain_lotnop from tbl_mpmain where plantcode='".$plantcode."' and  (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC') and mpmain_barcode='".$rowmonth6['mpmain_barcode']."'") or die(mysqli_error($link));
	$tot_mpl=mysqli_num_rows($sql_mpl);
	if($tot_mpl > 0)
	{
		while($row_mpl=mysqli_fetch_array($sql_mpl))
		{
			$lotarr=explode(",", $row_mpl['mpmain_lotno']);
			$noparr=explode(",", $row_mpl['mpmain_lotnop']);
			
			for ($i=0; $i<count($lotarr); $i++)
			{
				if($lotarr[$i]<>"")
				{
					$nopl=$noparr[$i];
				
					$up23=explode(" ", $upsids);
					if($up23[1]=="Gms")
					{
						$ptp=$up23[0]/1000;
					}
					else
					{
						$ptp=$up23[0];
					}
					$qtyl=$ptp*$nopl; $nompl=1; 
					
					/*$sqlmon30=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$lotarr[$i]."'")or die("Error:".mysqli_error($link));
					$rowm30=mysqli_fetch_array($sqlmon30);
					
					$sqlmon3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$rowm30[0]."' and lotno='".$lotarr[$i]."'")or die("Error:".mysqli_error($link));
					$rowm3=mysqli_fetch_array($sqlmon3);
					
					$dt2=date("Y-m-d");
					$diff2 = abs(strtotime($rowm3['lotldg_valupto']) - strtotime($dt2));
					$days2 = floor($diff2 / (60*60*24));
						
					if($ltns=="")
						$ltns=$rowm3['lotno'];
					else
						$ltns=$rowm3['lotno'];
						
					if($dys=="")
						$dys=$days2;
					else
						$dys=$days2;	*/
				
//echo $dys;
//echo $ltns;
//$dayss=explode(",",$dys);
//$ltnns=explode(",",$ltns);
//print_r($dayss);
//natsort($ltnns);
//natsort($dayss);

/*$value="";
foreach ($dayss as $key => $val) 
{
	$valu=$ltnns[$key];
	if($value=="")
		$value=$valu;
	else
		$value=$value.",".$valu;	
	//echo "$key = $val  -  $valu  \n";
}*/

//echo $value;
//$ltno=explode(",",$value);
/*$sql_month=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_variety='$verids' and packtype='$upsids'")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sql_month);
while($row_month=mysqli_fetch_array($sql_month))
{*/
//foreach($ltno as $lotn)
//{
//if($lotn<>"")
//{

$lotn=$lotarr[$i];
$dot=""; $dov="";

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$rowmonth2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 and balqty>0 and tqty>0")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$nompl; 
			$qty=$qtyl;
			
			$qc=$rowmonth3['lotldg_qc'];
			$lotups=$rowmonth3['packtype'];
			$dot=$rowmonth3['lotldg_qctestdate'];
			
			$zz=str_split($lotn);
			$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
			$qcstsap="DoT";	$srfl=0; $qcdot2="";
			$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
			$row_pnp=mysqli_fetch_array($sql_pnp);
			$tot_pnp=mysqli_num_rows($sql_pnp);
			if($tot_pnp > 0)
			{
				$qcstsap=$row_pnp['pnpslipsub_qcdttype'];
				if($row_pnp['pnpslipsub_qcdttype']=="DoSF" || $row_pnp['pnpslipsub_qcdttype']=="DosF" || $row_pnp['pnpslipsub_qcdttype']=="DOSF")
				$srfl=1;
			}
									
			if($srfl==1)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
			if($srfl==1 && $qcdot2!=""){$dot=$qcdot2; $qcstsap='DoSF';}
			
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
			
			$dt=date("Y-m-d");
			$diff = abs(strtotime($rowmonth3['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
			if($days<30)$flg++;
			//echo $ltn." - ".$flg;
			$vflg=0;
			//echo $flg;
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$rowmonth3['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$rowmonth3['subbinid']."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
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
				$totnob=$nob;
			}
			if($rowmonth3['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
		
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
		}
	}
	//echo $flg;
	if($totnob<0)$totnob=0;
	if($totqty==0)$flg++;
	//if($totnob==0)$flg++;
	
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where  varietyid='".$verids."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	/*if($variety!="")
		$variety=$variety."<br/>".$row_var['popularname'];
	else
		$variety=$row_var['popularname'];*/
		
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where  cropid='".$row_var['cropname']."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
	
	/*if($crop!="")
		$crop=$crop."<br/>".$row_crp['cropname'];
	else
		$crop=$row_crp['cropname'];*/
			
	if($lotno!="")
		$lotno=$lotno."<br/>".$lotn;
	else
		$lotno=$lotn;
		
	if($nobs!="")
		$nobs=$nobs."<br/>".$nob;
	else
		$nobs=$nob;
	
	if($qtys!="")
		$qtys=$qtys."<br/>".$qty;
	else
		$qtys=$qty;	
	
	if($qcs!="")
		$qcs=$qcs."<br/>".$qc;
	else
		$qcs=$qc;	
		
	if($dots!="")
		$dots=$dots."<br/>".$dot;
	else
		$dots=$dot;	
	
	if($dovs!="")
		$dovs=$dovs."<br/>".$dov;
	else
		$dovs=$dov;	
	
	if($ndays!="")
		$ndays=$ndays."<br/>".$days;
	else
		$ndays=$days;	
	
	if($qcstsaps!="")
		$qcstsaps=$qcstsaps."<br/>".$qcstsap;
	else
		$qcstsaps=$qcstsap;							

$brcode=$rowmonth6['mpmain_barcode'];	
}
}
}
}
//}
//}				
//}	
//echo $rowmonth6['mpmain_barcode'];
//if(!in_array($lotno,$xcltn))
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $brcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcs;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcstsaps;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dots;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dovs;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ndays;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><input type="radio" name="lotsel" id="lotsel_<?php echo $sno1;?>" value="<?php echo $lotno?>" onclick="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $brcode?>','<?php echo $upsids?>','<?php echo $tid?>','barsel')"  /><input type="hidden" name="inptyp" id="inptyp_<?php echo $sno1;?>" value="barsel" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno15++;
}
}
}

?>
</table>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" /><input type="hidden" name="ltchksel" value="" />
</div>

<?php
}
else if($altyp=="barcodewise")	
{
	//echo $tid=$ordnos;
	$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_porderno='$a'")or die("Error:".mysqli_error($link));
	$row_month=mysqli_fetch_array($sql_month);
	$arrivalid=$row_month['orderm_id'];
	$sql_mon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id='".$arrivalid."' order by order_sub_crop")or die("Error:".mysqli_error($link));
	
	if($tid==0)
	{
		$sq2tid=mysqli_query($link,"Select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dallocss3_barcode='$b'") or die(mysqli_error($link));
		if($to2tid=mysqli_num_rows($sq2tid) > 0)
		{
			while($ro2tid=mysqli_fetch_array($sq2tid))
			{
				$tid=$ro2tid['dalloc_id'];
				$subtid=$ro2tid['dallocs_id'];
				$sid=$subtid;
			}
		}
	}
	
?>
<div id="barcwise" style=" <?php if($altyp=="barcodewise") echo "display:block"; else echo "display:none";?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td width="50%" align="right" class="tblheading">Bin Shifting&nbsp;</td>
  <td align="left" valign="middle" class="tblheading"><input type="radio" name="binshift" value="yes" onclick="selnslsts(this.value);" checked="checked"  />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="binshift" value="no" onclick="selnslsts(this.value);" disabled="disabled" />&nbsp;No&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="barcupload"></span><input type="hidden" name="bcvalues" value="" /></td>
</tr>
<input type="hidden" name="binshifting" value="yes" /><input type="hidden" name="nslval" value="1"  /><input type="hidden" name="nbarallval" value="0"  /><input type="hidden" name="nbarallnos" value=""  />
</table>
<div id="shownsloc" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">SLOC Details</td>
</tr>
<tr class="Light" height="25">
	<td width="40" align="center" class="smalltblheading">#</td>
	<td width="243" align="center" class="smalltblheading">WH</td>
	<td width="270" align="center" class="smalltblheading">Bin</td>
  	<td width="190" align="center" class="smalltblheading">NoMP</td>
 	<td width="195" align="center" class="smalltblheading">Qty</td>
</tr>
<?php
$sq4=mysqli_query($link,"Select * from tbl_dallocsub_sub4 where plantcode='".$plantcode."' and  dalloc_id='$tid'") or die(mysqli_error($link));
$tot4=mysqli_num_rows($sq4);
if($tot4>0)
{
$sln=0;
while($ro4=mysqli_fetch_array($sq4))
{
	$sln++;
?>
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' and  whid='".$ro4['dallocss4_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" name="txtwhg<?php echo $sln;?>" id="txtwhg<?php echo $sln;?>" value="<?php echo $noticia_whd1['whid'];?>"  /><!--<select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sln;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;--></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' and  whid='".$ro4['dallocss4_wh']."' and binid='".$ro4['dallocss4_bin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><?php echo $noticia_bing1['binname'];?><input type="hidden" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" value="<?php echo $noticia_bing1['binid'];?>"  /><!--<select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sln;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;--></td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="<?php echo $ro4['dallocss4_nomp'];?>" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinnomps_<?php echo $sln;?>" id="nbinnomps_<?php echo $sln;?>" value="<?php echo $ro4['dallocss4_nomp'];?>" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="<?php echo $ro4['dallocss4_qty'];?>" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinqtys_<?php echo $sln;?>" id="nbinqtys_<?php echo $sln;?>" value="<?php echo $ro4['dallocss4_qty'];?>" /></td>
</tr>
<?php
}
}
else
{
$sln=1;
?>
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sln;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sln;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinnomps_<?php echo $sln;?>" id="nbinnomps_<?php echo $sln;?>" value="0" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinqtys_<?php echo $sln;?>" id="nbinqtys_<?php echo $sln;?>" value="0" /></td>
</tr>
<?php 
} 
?>
</table>
<?php
$tsln=$sln;
while($sln<5)
{
$sln++;
?>
<div id="nwslocs<?php echo $sln;?>" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sln;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sln;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
</table>
</div>
<?php 
}
?>
<input type="hidden" name="sln" value="<?php echo $sln;?>"  /><input type="hidden" name="tsln" value="<?php echo $tsln;?>"  />
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="7" align="right" class="tblheading"><?php if($tsln<5) {?><a href="Javascript:void(0);" onclick="addnewsl(<?php echo $tsln+1;?>)">ADD New Bin...</a>&nbsp;<?php } ?></td>
</tr>
</table>
<input type="hidden" name="totnewsloc" value="0" /><input type="hidden" name="newsloc" value="" /><input type="hidden" name="newslocsel" value="<?php echo $noticia_bing1['binid'];?>" />
</div>


<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Enter Barcode</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0"  /></div>
</table><br />
</div>
<?php

}
else
{
?>
<?php
}
?>
<br />
<div id="postingsubsubtable" style="display:block">
<?php

if($altyp=="barcodewise")	
{
?>
<div id="barupdetails" ></div>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Lot wise Allocation IN-Progress View</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="28" align="center" class="smalltblheading">#</td>
	<td width="99" align="center" class="smalltblheading">Crop</td>
	<td width="134" align="center" class="smalltblheading">Variety</td>
	<td width="92" align="center" class="smalltblheading">UPS</td>
	<td width="117" align="center" class="smalltblheading">Lot No.</td>
	<td width="74" align="center" class="smalltblheading">QC Status</td>
	<td width="79" align="center" class="smalltblheading">DoT</td>
	<td width="89" align="center" class="smalltblheading">DoV</td>
	<td width="54" align="center" class="smalltblheading">NoMP</td>
	<td width="82" align="center" class="smalltblheading">Qty</td>
	<td width="102" align="center" class="smalltblheading">Barcodes</td>
</tr>
</table>
<?php
$sno2=0; $totrec=0; $bchnflg=0; 
$sq2=mysqli_query($link,"Select distinct dallocss3_lotno from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid' ") or die(mysqli_error($link));
$totrec=mysqli_num_rows($sq2);
?>
<div id="table-wrapper" style=" <?php if($totrec<=4) {?>height:auto; width:945px; overflow:hidden;<?php } else{?>height:101px; width:970px; overflow:auto;<?php } ?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse;" > 
<?php
if($totrec=mysqli_num_rows($sq2) > 0)
{
	while($ro2=mysqli_fetch_array($sq2))
	{
		$lot2=$ro2['dallocss3_lotno']; 
		$nompt=0; $nqty2=0; $barc="";
		$sq3=mysqli_query($link,"Select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dallocss3_lotno='$lot2' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
		while($ro3=mysqli_fetch_array($sq3))
		{
			$crps=$ro3['dallocss3_crop']; 
			$vers=$ro3['dallocss3_variety']; 
			$upss=$ro3['dallocss3_ups']; 
			$dovs=$ro3['dallocss3_dov']; 
			$qcss=$ro3['dallocss3_qc']; 
			$dots=$ro3['dallocss3_dot']; 
			
			$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
			$row_dept5=mysqli_fetch_array($quer5);
			$cps=$row_dept5['cropname'];
			$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where  varietyid='$vers' and actstatus='Active'"); 
			$row_dept4=mysqli_fetch_array($quer4);
			$vts=$row_dept4['popularname'];
			
			$tdate=$dovs;
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dov=$tday."-".$tmonth."-".$tyear;
			
			$tdate=$dots;
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dot=$tday."-".$tmonth."-".$tyear;
			
			$nompt=$nompt+1;
			$nqty2=$nqty2+$ro3['dallocss3_weight'];
			if($barc!="") 
				$barc=$barc.",".$ro3['dallocss3_barcode'];
			else
				$barc=$ro3['dallocss3_barcode'];
				
			$bchnflg++;
		}
$sno2++; 		
?>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext"><?php echo $sno2;?></td>
	<td width="97" align="center" class="smalltbltext"><?php echo $cps;?></td>
	<td width="131" align="center" class="smalltbltext"><?php echo $vts;?></td>
	<td width="90" align="center" class="smalltbltext"><?php echo $upss;?></td>
	<td width="115" align="center" class="smalltbltext"><?php echo $lot2;?></td>
	<td width="73" align="center" class="smalltbltext"><?php echo $qcss;?></td>
	<td width="80" align="center" class="smalltbltext"><?php echo $dot;?></td>
	<td width="87" align="center" class="smalltbltext"><?php echo $dov;?></td>
	<td width="53" align="center" class="smalltbltext"><?php echo $nompt;?></td>
	<td width="80" align="center" class="smalltbltext"><?php echo $nqty2;?></td>
	<td width="92" align="center" class="smalltbltext"><?php if($barc!=""){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $barc;?>')">Details</a><?php } ?></td>
</tr>
<?php
}
}
?>
</table>
</div>
<br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Latest Barcode View</td>
</tr>
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="70" align="center" class="smalltblheading">Barcode</td>
	<td width="70" align="center" class="smalltblheading">Crop</td>
	<td width="95" align="center" class="smalltblheading">Variety</td>
	<td width="65" align="center" class="smalltblheading">UPS</td>
	<td width="75" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="60" align="center" class="smalltblheading">Qty</td>
	<td width="67" align="center" class="smalltblheading">Gross Weight</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>
	<td width="40" align="center" class="smalltblheading">QC Status</td>
	<td width="67" align="center" class="smalltblheading">DoT</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php 
//$b="DP060000978";
$z=str_split($b);





$sno=1; $dt=date("Y-m-d");
if(count($z)==11)
{
	$sq6=mysqli_query($link,"Select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid' and dallocss3_barcode='$b'") or die(mysqli_error($link));
	$to6=mysqli_num_rows($sq6);

	$flg=0; $lotno=""; $qty=""; $totqty=0; $crop=""; $variety=""; $lotno=""; $ups=""; $packtyp=""; $crid=""; $vrid=""; $sloc=""; $grweight="";

	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$b."' and mpmain_dflg=0 and mpmain_alflg!=1 and mpmain_upflg=0 and mpmain_rvflg=0") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	$vr=$row_barcode1['mpmain_variety'];
	$ui=$row_barcode1['mpmain_upssize'];
	
	if($tot_barcode1>0)
	{
		$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$b."'") or die(mysqli_error($link));
		$totbarcode=mysqli_num_rows($sqlbarcode);
		$rowbarcode=mysqli_fetch_array($sqlbarcode);
		$grweight=$rowbarcode['bar_grosswt'];
	}
	
	$pty=$row_barcode1['mpmain_trtype'];
	if($pty=="PACKSMC") $packtyp="SMC";
	if($pty=="PACKLMC") $packtyp="LMC";
	if($pty=="PACKMMC") $packtyp="MMC";
	if($pty=="PACKNMC")	$packtyp="NMC";
	if($pty=="PACKNLC") $packtyp="NLC";
							
	if($pty=="PACKSMC" || $pty=="PACKNMC")
	{
		
		$lotno=$row_barcode1['mpmain_lotno'];
		$qty=$row_barcode1['mpmain_wtmp'];
		$totqty=$row_barcode1['mpmain_wtmp'];
		$ups=$row_barcode1['mpmain_upssize'];
		
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where  varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	
		$sql_lot24=mysqli_query($link,"Select Distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$ui' order by lotdgp_id DESC") or die(mysqli_error($link));
		$tot_lot24=mysqli_num_rows($sql_lot24);
		while($row_lot24=mysqli_fetch_array($sql_lot24))
		{
		
			$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$row_lot24['lotno']."' and packtype='$ui' order by lotdgp_id DESC") or die(mysqli_error($link));
			$tot_lot2=mysqli_num_rows($sql_lot2);
			$row_lot2=mysqli_fetch_array($sql_lot2);
			
			$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1  and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
			$tot_lot=mysqli_num_rows($sql_lot);
			$row_lot=mysqli_fetch_array($sql_lot);
			
			if($tot_barcode1>0)			
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
			if($tot_barcode1>0)
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
			if($row_lot['lotldg_got']=="BL")
			$vflg++;
			if($rowmonth3['lotldg_qc']=="BL")
			$vflg++;		
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
			//if($vflg > 0) $flg++;	
			$nob=1;
			//echo $flg;
if($flg==0 && $b!="")	 
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $b;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $row_lot24['lotno']?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grweight;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
}
$sno++;
}
}
else
{
	$ups=$row_barcode1['mpmain_upssize'];
	$lotn=explode(",",$row_barcode1['mpmain_lotno']);
	$ltnp=explode(",",$row_barcode1['mpmain_lotnop']);
	
	for($i=0; $i<count($lotn); $i++)
	{
		$ltn=$lotn[$i];
		
		if($ltn<>"")
		{
			$lotno=$ltn;

			$ltnop=$ltnp[$i];
			if($ltnop<>"")
			{
				$xc=explode(" ",$row_barcode1['mpmain_upssize']);
				if($xc[1]=="Gms")
				{
					$ptp=$xc[0]/1000;
				}
				else
				{
					$ptp=$xc[0];
				}
				$qty=$ptp*$ltnop;

			}
			
			$totqty=$row_tbl_sub['mpwtmp'];

			$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where  cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
			$row_crp = mysqli_fetch_array($sql_crp);
			$crop=$row_crp['cropname'];
			
			$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where  varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
			$row_var = mysqli_fetch_array($sql_var);
			$variety=$row_var['popularname'];






			$sql_lot24=mysqli_query($link,"Select Distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$ui' order by lotdgp_id DESC") or die(mysqli_error($link));
			$tot_lot24=mysqli_num_rows($sql_lot24);
			while($row_lot24=mysqli_fetch_array($sql_lot24))
			{
			
				$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$row_lot24['lotno']."' and packtype='$ui' order by lotdgp_id DESC") or die(mysqli_error($link));
				$tot_lot2=mysqli_num_rows($sql_lot2);
				$row_lot2=mysqli_fetch_array($sql_lot2);
				
				$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1  and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
				$tot_lot=mysqli_num_rows($sql_lot);
				$row_lot=mysqli_fetch_array($sql_lot);
				
				if($tot_barcode1>0)			
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
				if($tot_barcode1>0)
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
				if($row_lot['lotldg_got']=="BL")
				$vflg++;
				if($rowmonth3['lotldg_qc']=="BL")
				$vflg++;		
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
				//if($vflg > 0) $flg++;	
				$nob=1;
				//echo $flg;
if($flg==0 && $b!="")	 
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $b;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $row_lot24['lotno']?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grweight;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
}
}
}
$sno++;
}
}	

if($brfg!=0)
{
if($brfg==1)
$msgs="Barcode $b cannot be Allocated. Reason: Barcode not present in System";
if($brfg==2)
$msgs="Barcode $b cannot be Allocated. Reason: Barcode already Dispatched";
if($brfg==3)
$msgs="Barcode $b cannot be Allocated. Reason: Barcode already Loaded in current OR other Operator's Transaction";
if($brfg==4)
$msgs="Barcode $b cannot be Allocated. Reason: Variety not matching with Selected Line Item in Consolidated Pending Orders";
if($brfg==5)
$msgs="Barcode $b cannot be Allocated. Reason: UPS not matching with Selected Line Item in Consolidated Pending Orders";
if($brfg==6)
$msgs="Barcode $b cannot be Allocated. Reason: This Lot's current QC/GOT Status is FAIL";
if($brfg==7)
$msgs="Barcode $b cannot be Allocated. Reason: This Lot's current QC/GOT Status is UT and Soft Release is not activated";
if($brfg==8)
$msgs="Barcode $b cannot be Allocated. Reason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date";
if($brfg==9)
$msgs="Barcode $b cannot be Allocated. Reason: This Barcode is already Unpackaged";
if($brfg==10)
$msgs="Barcode $b cannot be Allocated. Reason: Lot is under Reserve Status";
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading" colspan="11"><font color="#FF0000"><?php echo $msgs;?></font></td>
</tr>
<?php
}
?>
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="light">
  <td align="center" class="tblheading"><font size="+4" color="<?php if($brfg>0){ echo '#FF0000'; } else { if($bchnflg%2==0) echo '#0000FF'; else echo '#009900';}?>"><?php echo $b;?></font></td>
</tr>
</table>
<?php
}
}
?>
<input type="hidden" name="maintrid" value="<?php echo $tid?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
