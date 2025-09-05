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
	$snid = $_GET['b'];	 
}
if(isset($_GET['c']))
{
	$tid = $_GET['c'];	 
}
if(isset($_GET['h']))
{
	$tnb = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$tqt = $_GET['g'];	 
}
if(isset($_GET['l']))
{
	$esn = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	$subtid = $_GET['m'];	 
}
if(isset($_GET['n']))
{
	$subsubtid = $_GET['n'];	 
}
if(isset($_GET['q']))
{
	$evert = $_GET['q'];	 
}
if(isset($_GET['r']))
{
	$stageval = $_GET['r'];	 
}
if(isset($_GET['s']))
{
	$selups = $_GET['s'];	 
}

$nups=$selups; $nvariety="";
if($stageval=="Pack")
{
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='".$ltn."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
	$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
	
	if($nups=="" || $nups=="undefined")$nups=$row_issuetbl['packtype'];
}
$sq2=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_variety='$evert' and dtdf_id='$tid'") or die(mysqli_error($link));

if($to2=mysqli_num_rows($sq2) > 0)
{
	$ro2=mysqli_fetch_array($sq2);
	if($nups=="" || $nups=="undefined")$nups=$ro2['dtdfs_ups']; 
	$nvariety=$ro2['dtdfs_nvariety']; 
	$ovariety=$ro2['dtdfs_variety'];
	if($nvariety=="" || $nvariety=="undefined")$nvariety=$ovariety; 
}
if($nvariety=="")$nvariety=$evert;
?>
<table align="center" id="lotdt" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="277" align="center" class="smalltblheading">Lot No.</td>
	<td width="412" align="center" class="smalltblheading">Total NoB</td>
	<td width="253" align="center" class="smalltblheading">Total Qty</td>
	<td width="253" align="center" class="smalltblheading">UPS</td>
	<td width="253" align="center" class="smalltblheading">Variety</td>
</tr>

<tr class="Dark" height="30">
	<td align="center" valign="middle" class="tbltext"><?php echo $ltn;?><input type="hidden" name="txtolotno" value="<?php echo $ltn;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tnb?><input type="hidden" name="txtonob" value="<?php echo $tnb;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $tqt?><input type="hidden" name="txtoqty" value="<?php echo $tqt;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="txtnups" class="tbltext" size="10" value="<?php echo $nups;?>" readonly="true" style='background-color:#CCCCCC'  /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="txtnvariety" class="tbltext" size="20" value="<?php echo $nvariety;?>" /></td>
</tr>
</table>
<table align="center" id="lotsldt" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Dispatch</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Dispatch </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoB/NoP</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB/NoP</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
<?php
if($stageval!="Pack")
{

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_lotno='".$ltn."'") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
{ 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$ltn."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
 	$srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

	$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sloc=$wareh."/".$binn."/".$subbinn;
	
	$diq=explode(".",$tnob);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
	$tnob=$difq;
	$diq=explode(".",$tqty);
	if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
	$tqty=$difq1;
	

$aldnob=0; $aldqty=0;
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='$tid' and dbss_lotno='".$row_issuetbl['lotldg_lotno']."'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	$sqq2=mysqli_query($link,"Select * from tbl_dtdfsub_sub2 where plantcode='".$plantcode."' and dtdf_id='$tid' and dbss_is='".$roo['dbss_id']."' and dbsss_subbin='".$row_issuetbl['lotldg_subbinid']."' ") or die(mysqli_error($link));
	while($roo2=mysqli_fetch_array($sqq2))
	{
		$aldnob=$aldnob+$roo2['dbsss_nob'];
		$aldqty=$aldqty+$roo2['dbsss_qty'];
	}
}

$tnob=$tnob-$aldnob;
$tqty=$tqty-$aldqty;
if($tqty>0 && $tnob<=0)	$tnob=1;
if($tqty<=0 && $tnob>0)	$tnob=0;	
	/*$sql_tbl_subsub=mysqli_query($link,"select * from tbl_proslipsubsub where proslipsub_id='".$row['proslipsub_id']."' and proslipmain_id='".$tid."'  and proslipsubsub_wh='".$row_issuetbl['lotldg_whid']."' and proslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and proslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."'") or die(mysqli_error($link));
	$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
	$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);*/
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value=""  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="" /></td>
  </tr>
<?php
}
}
}
else
{

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='".$ltn."'") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
{ 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$ltn."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 	$srno2++;
 	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$row_issuetbl['balnop']; 
	$tqty=$row_issuetbl['balqty']; 
	$tnob=$row_issuetbl['balnop']; 

	$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sloc=$wareh."/".$binn."/".$subbinn;
	
	/*$diq=explode(".",$tnob);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
	$tnob=$difq;
	
	$diq=explode(".",$tqty);
	if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
	$tqty=$difq1;*/
	
		
	$lotallqty=$row_issuetbl['lotldg_alqtys'];
	if($lotallqty<=0)$lotallqty=0;
	
	$lotallnmp=$row_issuetbl['lotldg_alnomps'];
	if($lotallnmp<=0)$lotallnmp=0;
			
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
			$nop1=($penqty/$ptp2);
		}
	}
	if($packtp2[1]=="Gms")
	{
		$nop2=($ptp2*$row_issuetbl['balqty']);
	}
	else
	{
		$nop2=($row_issuetbl['balqty']/$ptp2);
	}
	//echo $nop2;
	//echo $bqty1."  *  ".$ptp2;	
	$bnmp=$row_issuetbl['balnomp'];
	$bqty1=$row_issuetbl['balqty'];
	$bnob=$nop2;
		
	
	
	$lotno=$ltn;
	$zz=str_split($lotno);
	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0; $talqt=0; $talnmp=0;
	$totextpouches=0; $totextqtys=0;
	$sql_mps=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_alflg, mpmain_lotnop from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKSMC' and mpmain_lotno='".$lotno."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
					if($row_mps['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					}
				}
			}
			
		}
	}
	
	$sql_mpl=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_alflg, mpmain_lotnop from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKLMC' and mpmain_variety='".$row_issuetbl['lotldg_variety']."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
	
	$sql_mpm=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_alflg, mpmain_lotnop from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
	$sql_mpns=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_alflg, mpmain_lotnop from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKNMC' and mpmain_lotno='".$lotno."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
					if($row_mpns['mpmain_alflg']>0)
					{
					$talqt=$talqt+($ptp*$noparr[$i]);
					$talnmp=$talnmp+1;
					} 
				}
			}
			
		}
	}
	
	$sql_mpnl=mysqli_query($link,"Select mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_mptnop, mpmain_alflg, mpmain_lotnop from tbl_mpmain where plantcode='".$plantcode."' and mpmain_trtype='PACKNLC' and mpmain_variety='".$row_issuetbl['lotldg_variety']."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
	//$tqty=(($bqty1)-($qtyl+$qtynl))-($lotallqty);
	
	$totnomp1=$nomps+$nompl+$nompm+$nompns+$nompnl;
	$tnob=$nomps+$nompm+$nompns;
	
	$qbnmp=$nmp-$totnomp1;
	//echo $lotno." - ";
	$zqt=$qbnmp*$wtinmp;
	$qbqty=$bqty1-$zqt;
	//echo $qtys."  -  ".$qtyl."  -  ".$qtym."  -  ".$qtyns."  -  ".$qtynl; 
	//echo "<br/>";
	//echo $lotno."  =  ".$qtys."  -  ".$nomps." -> ".$totextqtys."  -  ".$bqty1."  =  ".$tqty."  -  ".$nmp."  -  ".$totnomp1."  -  ".$qbnmp."  -  ".$zqt."  -  ".$qbqty."<br/>";
	//echo "<br/>";
	//$tqty=($qbqty)-($qtyl+$qtynl)-($lotallqty);
	 //$lotallqty." ".$talqt;
	$balcqty=$lotallqty-$talqt;
	//$tewr=$balcqty/$wtinmp;
	//$tewr=round($tewr,3);
	//$terete=explode(".",$tewr);
	//if($terete[0]>0)
//	$dfgrt=($lotallnmp-$talnmp)*$wtinmp;
	$tqty=$bqty1;
	
	
	$bpchalcqty=-($balcqty);//-$dfgrt;
	$balcpchqty=$totextqtys-$bpchalcqty;//-($balcqty*$wtinmp);
	if($bnmp>0)
	$tqty=($bqty1-$totextqtys);//-($bpchalcqty);
	//else
	
	//$avlqty=($bqty)-($totextqtys)-($lotallqty);
	//echo $bnob."  -  ".$totextpouches; 
	if($bnmp>0)
	$bnob=$bnob-$totextpouches;
	
	$tnob=$bnob;
	//$avlqty=$nop1*$ptp1;
	
	
	
	//$totnob=$totnomp;
	//$totqty=$avlqty;
	
	
	
	
	
	$diq=explode(".",$tnob);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
	$tnob=$difq;
	if($tnob<0)$tnob=0;
	
	$diq=explode(".",$tqty);
	if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
	$tqty=$difq1;

$aldnob=0; $aldqty=0;
$sqq=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='$tid' and dbss_lotno='".$row_issuetbl['lotno']."'") or die(mysqli_error($link));
while($roo=mysqli_fetch_array($sqq))
{
	$sqq2=mysqli_query($link,"Select * from tbl_dtdfsub_sub2 where plantcode='".$plantcode."' and dtdf_id='$tid' and dbss_is='".$roo['dbss_id']."' and dbsss_subbin='".$row_issuetbl['subbinid']."' ") or die(mysqli_error($link));
	while($roo2=mysqli_fetch_array($sqq2))
	{
		$aldnob=$aldnob+$roo2['dbsss_nob'];
		$aldqty=$aldqty+$roo2['dbsss_qty'];
	}
}
///echo $tqty."  -  ".$bnmp."<br />";
$tnob=$tnob-$aldnob;
 $tqty=$tqty-$aldqty;
if($tqty>0 && $tnob<=0)	$tnob=1;
if($tqty<=0 && $tnob>0)	$tnob=0;
	/*$sql_tbl_subsub=mysqli_query($link,"select * from tbl_proslipsubsub where proslipsub_id='".$row['proslipsub_id']."' and proslipmain_id='".$tid."'  and proslipsubsub_wh='".$row_issuetbl['lotldg_whid']."' and proslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and proslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."'") or die(mysqli_error($link));
	$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
	$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);*/
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['subbinid'];?>" /><input type="hidden" name="ewtmp" value="<?php echo $wtinmp;?>" /></td>
    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /><input type="hidden" name="extbnob<?php echo $srno2?>" id="extbnob<?php echo $srno2?>" value="<?php echo $bnob;?>" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value=""  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
   <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value=""  style="background-color:#CCCCCC" readonly="true" /></td>
   <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="" /></td>
  </tr>
<?php
}
}
}
?>

 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="0" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" id="postbutn" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>