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
		$ltn = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
		$subtid = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
		$tid = $_GET['c'];	 
	}
	if(isset($_GET['h']))
	{
		$eupsval = $_GET['h'];	 
	}
	if(isset($_GET['g']))
	{
		$evert = $_GET['g'];	 
	}
 		
	$nups=""; $nvariety="";
	$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_variety='$evert' and dalloc_id='$tid'") or die(mysqli_error($link));
	if($to2=mysqli_num_rows($sq2) > 0)
	{
		$ro2=mysqli_fetch_array($sq2);
		$nups=$ro2['dbulks_ups']; 
		$nvariety=$ro2['dbulks_nvariety']; 
	}
	
	if($nvariety=="")$nvariety=$evert;
	if($nups=="")$nups=$eupsval;
	
	$ssubid="";
	$sq3=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$subtid' and dalloc_id='$tid' and dallocss_lotno='$ltn'") or die(mysqli_error($link));
	if($to3=mysqli_num_rows($sq3) > 0)
	{
		$ro3=mysqli_fetch_array($sq3);
		$tnb=$ro3['dallocss_enomp']; 
		$tqt=$ro3['dallocss_eqty']; 
		$ssubid=$ro3['dallocss_id']; 
	}

?>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td width="277" align="center" class="smalltblheading">Lot No.</td>
	<td width="412" align="center" class="smalltblheading">Total NoMP</td>
	<td width="253" align="center" class="smalltblheading">Total Qty</td>
	<td width="253" align="center" class="smalltblheading">UPS</td>
</tr>
<tr class="Dark" height="30">
	<td align="center" valign="middle" class="tbltext"><?php echo $ltn;?><input type="hidden" name="txtolotno" id="txtolotno" value="<?php echo $ltn;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tnb?><input type="hidden" name="txtonob" id="txtonob" value="<?php echo $tnb;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tqt?><input type="hidden" name="txtoqty" id="txtoqty" value="<?php echo $tqt;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $nups;?><input type="hidden" name="txtnups" id="txtnups" class="tbltext" size="10" value="<?php echo $nups;?>" /></td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Allocate</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">Picked for Allocate</td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoMP</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="125" align="center" valign="middle" class="smalltblheading">NoLP</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoMP</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
<?php
$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0; $binsft="";
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$ltn."' and balqty > 0") or die(mysqli_error($link));
while($row_issue=mysqli_fetch_array($sql_issue))
{ 
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$ltn."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_issue1[0]."' and balqty > 0  and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 	$srno2++;
 	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnomp']; 
	$tqty=$row_issuetbl['balqty']; 
	$tnob=$row_issuetbl['balnomp']; 

	$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sloc=$wareh."/".$binn."/".$subbinn;
	
	
	$lotallqty=$row_issuetbl['lotldg_alqtys'];
	if($lotallqty<=0)$lotallqty=0;
	
	$nop1=0; $nop2=0; $b1=0; $b2=0;
	$ups=$row_issuetbl['packtype'];
	$wtinmp=$row_issuetbl['wtinmp'];
	$upspacktype=$row_issuetbl['packtype'];
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
	$nmp=$row_issuetbl['balnomp'];
	if($nmp<0)$nmp=0;
	$penqty=(($row_issuetbl['balqty'])-($wtinmp*$nmp));
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
		$nop2=($ptp2*$row_issuetbl['balqty']);
	}
	else
	{
		if($packtp2[0]<1)
			$nop2=($row_issuetbl['balqty']*$ptp2);
		else
			$nop2=($row_issuetbl['balqty']/$ptp2);
		//$nop2=($row_issuetbl['balqty']/$ptp2);
	}
	$nop2;
		
	$bnmp=$row_issuetbl['balnomp'];
	$bqty1=$row_issuetbl['balqty'];
	//$bnob=$bqty1*$ptp2;
	if($packtp2[1]=="Gms")
	{$bnob=$bqty1*$ptp2;}
	else
	{
		if($packtp2[0]<1)
			$bnob=$bqty1*$ptp2;
		else
			$bnob=$bqty1/$ptp2;	
	}	
		
	
	
	$lotno=$ltn;
	$zz=str_split($lotno);
	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
	$totextpouches=0; $totextqtys=0;
	$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKSMC' and mpmain_lotno='".$lotno."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
				}
			}
			
		}
	}
	
	$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKLMC' and mpmain_variety='".$row_issuetbl['lotldg_variety']."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
	}
	
	$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKMMC' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
	$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKNMC' and mpmain_lotno='".$lotno."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
	
	$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_trtype='PACKNLC' and mpmain_variety='".$row_issuetbl['lotldg_variety']."' and mpmain_dflg=0 and mpmain_alflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
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
	}
	
	$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
	$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 
	$bqty=floatval($bqty);
	$totextqtys=floatval($totextqtys);	
	$tqty=($bqty1)-($qtyl+$qtynl)-($lotallqty);
	//echo $lotno."  =  ".$qtys."  -  ".$nomps." -> ".$totextqtys."  -  ".$bqty1."  =  ".$tqty."<br/>";
	$totnomp1=$nomps+$nompl+$nompm+$nompns+$nompnl;
	$tnob=$nomps+$nompm+$nompns;
	
	$qbnmp=$nmp-$totnomp1;
	//echo $lotno." - ";
	$zqt=$qbnmp*$wtinmp;
	$qbqty=$bqty1-$zqt;
	//echo "<br/>";
	$tqty=($bqty1)-($qtyl+$qtynl)-($lotallqty);
	if($tqty<0)
	$tqty=(($bqty1)-($qtyl+$qtynl))-($lotallqty);
	
	if($bnmp>0)
	$bnob=$bnob-$totextpouches;
	
	//$tnob=$bnob;
	//$avlqty=$nop1*$ptp1;
	
	
	
	//$totnob=$totnomp;
	//$totqty=$avlqty;
	
	$sq33=mysqli_query($link,"Select * from tbl_dallocsub_sub2 where plantcode='".$plantcode."' and  dallocs_id='$subtid' and dallocss_id='$ssubid' and dalloc_id='$tid'") or die(mysqli_error($link));
	$to33=mysqli_num_rows($sq33);
	
	while($ro33=mysqli_fetch_array($sq33))
	{	$stnlb=$ro33['dallocss2_nolp']; 
		$stnb=$ro33['dallocss2_nomp']; 
		$stqt=$ro33['dallocss2_qty']; 
		$sbtnb=$ro33['dallocss2_bnomp']; 
		$sbtqt=$ro33['dallocss2_bqty']; 
		$binsft=$ro33['dallocss2_binshift'];
		if($binsft=="")$binsft="no";
	}	
	
	$tqty=$tqty+$stqt;
	$tnob=$stnb;
	$diq=explode(".",$tnob);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
	$tnob=$difq;
	if($tnob<0)$tnob=0;
	
	$diq=explode(".",$tqty);
	if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
	$tqty=$difq1;
	
	
?>
<tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['subbinid'];?>" /></td>
    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>,'edit');" value="<?php echo $stnb;?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnolbp<?php echo $srno2?>" id="recnolbp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC" value="<?php echo $stnlb;?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>,'edit');"  onkeypress="return isNumberKey(event)"  value="<?php echo $stqt;?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="<?php echo $sbtnb;?>" style="background-color:#CCCCCC" readonly="true" /></td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $sbtqt;?>" /></td>
</tr><input type="hidden" name="stqt<?php echo $srno2?>" value="<?php echo $stqt;?>" /><input type="hidden" name="stnb<?php echo $srno2?>" value="<?php echo $stnb;?>" />
<?php

}
}
?>
<input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<?php

	$tot4=0; 
	if($binsft=="yes")
	{
		$sq4=mysqli_query($link,"Select * from tbl_dallocsub_sub4 where plantcode='".$plantcode."' and  dalloc_id='$tid'") or die(mysqli_error($link));
		$tot4=mysqli_num_rows($sq4);
	}
?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td width="50%" align="right" class="tblheading">Bin Shifting&nbsp;</td>
  <td align="left" valign="middle" class="tblheading"><input type="radio" name="binshift" value="yes" onclick="selnslsts(this.value);" <?php if($binsft=="yes") echo "checked"; ?> />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="binshift" value="no" onclick="selnslsts(this.value);" <?php if($binsft=="no") echo "checked"; ?> />&nbsp;No&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="barcupload"></span><input type="hidden" name="bcvalues" value="" /></td>
</tr>
<input type="hidden" name="binshifting" value="" /><input type="hidden" name="nslval" value="<?php echo $tot4;?>"  /><input type="hidden" name="nbarallval" value="0"  /><input type="hidden" name="nbarallnos" value=""  />
</table>
<div id="shownsloc" style="display:<?php if($binsft=="yes") echo "block"; else echo "none";?>">
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
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="7" align="right" class="tblheading"><?php if($tsln<5) {?><a href="Javascript:void(0);" onclick="addnewsl(<?php echo $tsln+1;?>)">ADD New Bin...</a>&nbsp;<?php } ?></td>
</tr>
</table>
<input type="hidden" name="totnewsloc" value="0" /><input type="hidden" name="newsloc" value="" /><input type="hidden" name="newslocsel" value="<?php echo $noticia_bing1['binid'];?>" />
</div>

<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $ssubid;?>"  />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right" id="frmbutn"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>