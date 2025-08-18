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
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$orid = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
	$rid = $_GET['h'];	 
	}

$trid=$f;
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="7" align="center" valign="middle" class="tblheading">Transfer from</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="162" align="center" valign="middle" class="tblheading">UPS</td>
<td width="162" align="center" valign="middle" class="tblheading">WH</td>
<td width="152" align="center" valign="middle" class="tblheading">Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="182" align="center" valign="middle" class="tblheading">NoP</td>
<td width="182" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="160" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$whi=0;$bni=0;$sbni=0;
/*$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where lotldg_trclassid='".$c."' and lotldg_variety='".$b."'") or die(mysqli_error($link));

$srno=1; //$cnt=0;

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$b."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
*/$otBags=0; $otqty=0;$otnop=0;
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$orid."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $nop1=0;
$whi=$row_issuetbl['whid'];$bni=$row_issuetbl['binid'];$sbni=$row_issuetbl['subbinid'];   //$cnt++; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nop1=0; $nop2=0; $b1=0; $b2=0; $nop=0;
$upspacktype=$row_issuetbl['packtype'];
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$packtp=explode(" ",$row_issuetbl['packtype']);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp2=(1000/$packtp[0]);
}
else
{
	$ptp2=$packtp[0];
}
$bl=($row_issuetbl['balqty']*100)/100;
$b2=(($wtinmp*$row_issuetbl['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;


if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp2*$penqty);
	}
	else
	{
		$nop1=($penqty/$ptp2);
	}
}
if($packtp[1]=="Gms")
{
	$nop2=($ptp2*$row_issuetbl['balqty']);
}
else
{
	$nop2=($row_issuetbl['balqty']/$ptp2);
}

$nop2;
$zz=str_split($a);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$b' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
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

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$b' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($a==$lotarr[$i] && $ups==$upsarr)
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
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$ct; 
			}
		}
		
	}
}
//echo $nops."  -  ".$nopl;
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 	
$qty=$row_issuetbl['balqty']-$totextqtys;
$nop=$nop2-$totextpouches;
if($row_issuetbl['balqty']>0)
$nop=$nop2-$totextpouches;
//$qty=$nob*$ptp2;
$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop1);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop1;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}

$otnop=$otnop+$nop;
$otBags=$otBags+$nomp;
$otqty=$otqty+$bqty;

/*$otnop=$otnop+$nop1;
$otBags=$otBags+$row_issuetbl['balnomp'];
$otqty=$otqty+$row_issuetbl['balqty'];*/
if($otnop<=0)$otnop=0;
if($otBags<=0)$otBags=0;
if($otqty<=0)$otBags=0;
if($otqty<=0)$otqty=0;
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['packtype'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="osubid" value="<?php echo $row_issuetbl['subbinid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balnomp'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balqty'];?></td>
</tr>
<?php
}

?><input type="hidden" name="otBags" value="<?php echo $otBags;?>" /><input type="hidden" name="otnop" value="<?php echo $otnop;?>" /><input type="hidden" name="otqty" value="<?php echo $otqty;?>" /><input type="hidden" name="wtinmp" value="<?php echo $wtinmp;?>" /><input type="hidden" name="packtyp" value="<?php echo $upspacktype;?>" />
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="12" align="center" valign="middle" class="tblheading">Transfer to</td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="75" align="center" valign="middle" class="tblheading">WH</td>
<td width="60" align="center" valign="middle" class="tblheading">Bin</td>
<td width="59" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="60" align="center" valign="middle" class="tblheading">NoP</td>
<td width="56" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="73" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">NoP</td>
<td width="58" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1;  //echo $trid;
/*$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$c."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$b."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$itemid=$row_item['stores_item'];
*/

$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$c."' and lotldg_variety='".$b."' and lotno='".$a."'") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_issue);
$srno=1;
$totBags=0; $totqty=0; $cnt=0; $whid="";$binid="";$subbinid=""; $whid1="";$binid1="";$subbinid1="";
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
  
 // echo $whi; echo $bni; echo $sbni;
 $sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$b."' and lotno='".$a."'") or die(mysqli_error($link));
//$row_subtb=0;
$row_issue1=mysqli_fetch_array($sql_issue1); 

if($trid > 0)
{
$sql_subtb=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and subbinid='".$row_issue['subbinid']."' and  binid='".$row_issue['binid']."' and  whid='".$row_issue['whid']."' and lotno='".$a."'") or die(mysqli_error($link));
$row_subtb=mysqli_num_rows($sql_subtb);
}
else
{
//$sql_subtb=mysqli_query($link,"select * from tbl_gtod_sub where gid='".$trid."' and rowid!='".$row_issue1[0]."'") or die(mysqli_error($link));
$row_subtb=0;
}
//echo $row_subtb;
//echo $row_subtb=mysqli_num_rows($sql_subtb);
//echo $t=mysqli_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb == 0)
{
/*$sql_subtb=mysqli_query($link,"select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
$row_subtb=mysqli_num_rows($sql_subtb);
//echo $t=mysqli_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb > 0)
{*/
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
//echo $t=mysqli_num_rows($sql_issuetbl);
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
 $cnt++;
 
 $wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;$nop1=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totBags=$totBags+$row_issuetbl['balnomp'];
$totqty=$totqty+$row_issuetbl['balqty'];
//$whi=$wareh; $bni=$binn; $sbni=$subbinn;
$wtinmp=$row_issuetbl['wtinmp'];
$packtp=explode(" ",$row_issuetbl['packtype']);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
}
else
{
	$ptp=$packtp[0];
}
$bl=($row_issuetbl['balqty']*100)/100;
$b2=(($wtinmp*$row_issuetbl['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp*$penqty);
	}
	else
	{
		$nop1=($penqty/$ptp);
	}
	//$nop1=($ptp*$penqty);
}
 if($srno%2!=0)
{
if($whi==$row_issuetbl['whid'] && $bni==$row_issuetbl['binid'] && $sbni==$row_issuetbl['subbinid'])
{
 ?>
 <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno;?>" style="width:59px;" onchange="wh<?php echo $srno;?>(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($whi==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$whi."' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno;?>" style="width:43px;" onchange="bin<?php echo $srno;?>(this.value);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($bni==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$whi."' and binid='".$bni."' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno;?>" style="width:40px;" onchange="subbin<?php echo $srno;?>(this.value);"  >
<option value="" selected>SBin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($sbni==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otnop;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otBags;?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno;?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $otnop;?>"  />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno;?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $otBags;?>"  />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno;?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otnop;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otBags;?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['subbinid'];?>" /></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="smalltbltext" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $nop1;?>"  />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>"  />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno?>" class="smalltbltext" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issuetbl['lotdgp_id'];?>" />
</tr>
<?php
}
}
else
{
if($whi==$row_issuetbl['whid'] && $bni==$row_issuetbl['binid'] && $sbni==$row_issuetbl['subbinid'])
{
?>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno;?>" style="width:59px;" onchange="wh<?php echo $srno;?>(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($whi==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$whi."' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno;?>" style="width:43px;" onchange="bin<?php echo $srno;?>(this.value);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($bni==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$whi."' and binid='".$bni."' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno;?>" style="width:40px;" onchange="subbin<?php echo $srno;?>(this.value);"  >
<option value="" selected>SBin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($sbni==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otnop;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otBags;?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno;?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $otnop;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno;?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $otBags;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno;?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otnop;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otBags;?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
}
else
{
?>

 <tr class="Dark" height="25">

<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['subbinid'];?>" /></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="smalltbltext" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $nop1;?>"  />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>"  />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno?>" class="smalltbltext" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issuetbl['lotdgp_id'];?>" />
</tr>
 <?php
 } 
 }$srno++;
 } 
 } 
 }
 //echo $cnt;
 if($trid > 0 && $cnt < 8)
 { 
 $ct=0;$up=0;$qt=0;$nop1=0;
 $sql_gddist=mysqli_query($link,"select distinct whid, binid, subbinid from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."'") or die(mysqli_error($link));
while($t_gddist=mysqli_fetch_array($sql_gddist))
 {
 $sql_gdsum=mysqli_query($link,"select sum(nop), sum(nomp), sum(qty) from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysqli_error($link));
$t_gdsum=mysqli_fetch_array($sql_gdsum);
/*$up=$t_gdsum[0];
$qt=$t_gdsum[1];*/

$sql_iss=mysqli_query($link,"select max(slocsubid) from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysqli_error($link));
$t=mysqli_fetch_array($sql_iss);
//$srno=1;
$sql_issue=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocsubid='".$t[0]."'") or die(mysqli_error($link));
$totBags=0; $totqty=0; 
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 $nop1=$row_issue['balnop'];
 $up=$row_issue['balnomp'];
 $qt=$row_issue['balqty'];
 /*if($ct==0)
 {
 $sql_gdsum=mysqli_query($link,"select * from tbl_gtod_sub where gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysqli_error($link));
$t_gdsum=mysqli_fetch_array($sql_gdsum);
echo $up=$t_gdsum[0];
echo $qt=$t_gdsum[1];
}
 if($ct==1)
 {
 $sql_gdsum=mysqli_query($link,"select sum(Bags), sum(qty) from tbl_gtod_sub where gid='".$trid."' and whid='".$whid1."' and binid='".$binid1."' and subbinid='".$subbinid1."'") or die(mysqli_error($link));
$t_gdsum=mysqli_fetch_array($sql_gdsum);
echo $up=$t_gdsum[0];
echo $qt=$t_gdsum[1];
}*/

/* $sql_issue1=mysqli_query($link,"select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['subbinid']."' and stld_binid='".$row_issue['binid']."' and stld_whid='".$row_issue['whid']."' and stld_tritemid='".$row_issue['items_id']."'") or die(mysqli_error($link));

$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $t=mysqli_num_rows($sql_issue1);
//echo $row_issue1[0];
$sql_issuetbl=mysqli_query($link,"select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysqli_error($link)); */
//echo $t=mysqli_num_rows($sql_issuetbl);
 /*while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { */$cnt++;$ct++;
 $wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issue['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totBags=$totBags+$row_issue['nop'];
$totqty=$totqty+$row_issue['qty'];
 if($srno%2!=0)
{
if($whi==$row_issue['whid'] && $bni==$row_issue['binid'] && $sbni==$row_issue['subbinid'])
{
 ?>
   <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;
  <select class="smalltbltext" name="txtslwhg<?php echo $srno;?>" style="width:59px;" onchange="wh<?php echo $srno;?>(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($whi==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$whi."' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno;?>" style="width:43px;" onchange="bin<?php echo $srno;?>(this.value);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($bni==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$whi."' and binid='".$bni."' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno;?>" style="width:40px;" onchange="subbin<?php echo $srno;?>(this.value);"  >
<option value="" selected>SBin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($sbni==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $nop1;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno;?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $nop1;?>"   />&nbsp;<font color="#FF0000">*</font></td>
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno;?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $up;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno;?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $qt;?>"  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otnop;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otBags;?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig1" value="<?php echo $row_issue['rowid'];?>" />
</tr>
<?php
}
else
{
?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="smalltbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $nop1;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $up;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno?>" class="smalltbltext" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php
 }
 }
 else
 {
 if($whi==$row_issue['whid'] && $bni==$row_issue['binid'] && $sbni==$row_issue['subbinid'])
{
 ?>
    <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno;?>" style="width:59px;" onchange="wh<?php echo $srno;?>(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($whi==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$whi."' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno;?>" style="width:43px;" onchange="bin<?php echo $srno;?>(this.value);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($bni==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$whi."' and binid='".$bni."' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslsubbg<?php echo $srno;?>" style="width:40px;" onchange="subbin<?php echo $srno;?>(this.value);"  >
<option value="" selected>SBin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($sbni==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $nop1;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno;?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno;?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $nop1;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno;?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $up;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno;?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otnop;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otBags;?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno;?>" class="smalltbltext" value="<?php echo $otqty;?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig1" value="<?php echo $row_issue['rowid'];?>" />
</tr>
<?php
}
else
{
?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
<td colspan="3"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="smalltbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg<?php echo $srno?>" id="nops<?php echo $srno;?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf<?php echo $srno;?>(this.value);" value="<?php echo $nop1;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $up;?>"   />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg<?php echo $srno?>" class="smalltbltext" value="<?php echo $nop1;?>"  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg<?php echo $srno?>" class="smalltbltext" value="<?php if($row_issuetbl['balnomp']>0)echo $row_issuetbl['balnomp']; else echo '0';?>"  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="smalltbltext" value="<?php echo $row_issuetbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php
 } 
 }
 $srno++;
 } 
 }
 }
 ?>
<?php
if($cnt==0)
{
?>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg1" style="width:59px;" onchange="wh1(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing1">&nbsp;<select class="smalltbltext" name="txtslbing1" style="width:43px;" onchange="bin1(this.value);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing1">&nbsp;<select class="smalltbltext" name="txtslsubbg1" style="width:40px;" onchange="subbin1(this.value);"  >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg1" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg1" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg1" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td align="right" width="37"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td  align="left" width="60"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg1" id="nops1" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td align="right" width="51"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td  align="left" width="53"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td  align="right" width="31"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg1" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg1" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg1" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg2" style="width:59px;" onchange="wh2(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;<select class="smalltbltext" name="txtslbing2" style="width:43px;" onchange="bin2(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;<select class="smalltbltext" name="txtslsubbg2" style="width:40px;" onchange="subbin2(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg2" id="nops2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg2" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg2" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>






<tr class="Light" height="30"  >
<?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:59px;" onchange="wh3(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind3_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:43px;" onchange="bin3(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind3_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:40px;" onchange="subbin3(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg3" id="nops3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg3" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg3" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:59px;" onchange="wh4(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind4_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:43px;" onchange="bin4(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind4_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:40px;" onchange="subbin4(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg4" id="nops4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg4" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg4" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig4" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:59px;" onchange="wh5(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:43px;" onchange="bin5(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:40px;" onchange="subbin5(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>		
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg5" id="nops5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg5" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg5" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:59px;" onchange="wh6(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:43px;" onchange="bin6(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:40px;" onchange="subbin6(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg6" id="nops6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg6" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg6" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>



<?php
}
else if($cnt==1)
{
?>
<?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30"  >

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg2" style="width:59px;" onchange="wh2(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing2">&nbsp;<select class="smalltbltext" name="txtslbing2" style="width:43px;" onchange="bin2(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing2">&nbsp;<select class="smalltbltext" name="txtslsubbg2" style="width:40px;" onchange="subbin2(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg2" id="nops2" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg2" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg2" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg2" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>






<tr class="Light" height="30"  >
<?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:59px;" onchange="wh3(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind3_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:43px;" onchange="bin3(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind3_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:40px;" onchange="subbin3(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg3" id="nops3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg3" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg3" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:59px;" onchange="wh4(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind4_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:43px;" onchange="bin4(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind4_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:40px;" onchange="subbin4(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg4" id="nops4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg4" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg4" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig4" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:59px;" onchange="wh5(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:43px;" onchange="bin5(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:40px;" onchange="subbin5(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>		
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg5" id="nops5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg5" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg5" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:59px;" onchange="wh6(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:43px;" onchange="bin6(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:40px;" onchange="subbin6(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg6" id="nops6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg6" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg6" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
else if($cnt==2)
{
?>

<tr class="Light" height="30"  >
<?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg3" style="width:59px;" onchange="wh3(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind3_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing3">&nbsp;<select class="smalltbltext" name="txtslbing3" style="width:43px;" onchange="bin3(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind3_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing3">&nbsp;<select class="smalltbltext" name="txtslsubbg3" style="width:40px;" onchange="subbin3(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg3" id="nops3" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg3" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg3" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg3" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:59px;" onchange="wh4(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind4_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:43px;" onchange="bin4(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind4_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:40px;" onchange="subbin4(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg4" id="nops4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg4" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg4" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig4" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:59px;" onchange="wh5(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:43px;" onchange="bin5(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:40px;" onchange="subbin5(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>		
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg5" id="nops5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg5" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg5" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:59px;" onchange="wh6(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:43px;" onchange="bin6(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:40px;" onchange="subbin6(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg6" id="nops6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg6" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg6" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
else if($cnt==3)
{
?>

<tr class="Light" height="30"  >
<?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg4" style="width:59px;" onchange="wh4(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind4_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing4">&nbsp;<select class="smalltbltext" name="txtslbing4" style="width:43px;" onchange="bin4(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind4_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing4">&nbsp;<select class="smalltbltext" name="txtslsubbg4" style="width:40px;" onchange="subbin4(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg4" id="nops4" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg4" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg4" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg4" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig4" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:59px;" onchange="wh5(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:43px;" onchange="bin5(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:40px;" onchange="subbin5(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>		
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg5" id="nops5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg5" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg5" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:59px;" onchange="wh6(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:43px;" onchange="bin6(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:40px;" onchange="subbin6(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg6" id="nops6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg6" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg6" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
else if($cnt==4)
{
?>

<tr class="Light" height="30"  >
<?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg5" style="width:59px;" onchange="wh5(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind5_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing5">&nbsp;<select class="smalltbltext" name="txtslbing5" style="width:43px;" onchange="bin5(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind5_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing5">&nbsp;<select class="smalltbltext" name="txtslsubbg5" style="width:40px;" onchange="subbin5(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>		
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg5" id="nops5" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg5" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg5" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg5" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:59px;" onchange="wh6(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:43px;" onchange="bin6(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:40px;" onchange="subbin6(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg6" id="nops6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg6" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg6" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
else if($cnt==5)
{
?>

<tr class="Light" height="30"  >
<?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg6" style="width:59px;" onchange="wh6(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind6_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing6">&nbsp;<select class="smalltbltext" name="txtslbing6" style="width:43px;" onchange="bin6(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind6_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing6">&nbsp;<select class="smalltbltext" name="txtslsubbg6" style="width:40px;" onchange="subbin6(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow6">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg6" id="nops6" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>			
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf6(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value="" readonly="true" style="background:#CCCCCC"   />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg6" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg6" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg6" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig6" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
else if($cnt==6)
{
?>

<tr class="Light" height="30"  >
<?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg7" style="width:59px;" onchange="wh7(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind7_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing7">&nbsp;<select class="smalltbltext" name="txtslbing7" style="width:43px;" onchange="bin7(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind7_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing7">&nbsp;<select class="smalltbltext" name="txtslsubbg7" style="width:40px;" onchange="subbin7(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow7">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg7" id="nops7" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>		
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf7(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg7" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg7" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg7" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig7" value="0" />
</tr>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
else if($cnt==7)
{
?>

<tr class="Light" height="30"  >
<?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="75" align="center"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg8" style="width:59px;" onchange="wh8(this.value);" >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind8_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="60" align="center"  valign="middle" class="smalltbltext" id="bing8">&nbsp;<select class="smalltbltext" name="txtslbing8" style="width:43px;" onchange="bin8(this.value);"  >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$subbind8_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="59" align="center"  valign="middle" class="smalltbltext" id="sbing8">&nbsp;<select class="smalltbltext" name="txtslsubbg8" style="width:40px;" onchange="subbin8(this.value);" >
<option value="" selected>SBin</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td colspan="3"  valign="middle">
<div id="slcrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >	
<td width="32%" align="center" valign="middle" class="tblheading"><input type="text" name="exnopsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td>
<td width="30%" align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="5" /></td>
<td width="38%" align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="7" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow8">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >		
<tr>
<td width="79" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>	
<td width="37" align="right"  valign="middle" class="smalltblheading">&nbsp;NoP&nbsp;</td>
<td width="60" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslnopsg8" id="nops8" type="text" size="4" class="smalltbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="nopsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="51" align="right"  valign="middle" class="smalltblheading">&nbsp;NoMP&nbsp;</td>
<td width="53" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="3" class="smalltbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="Bagsf8(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font></td>	
<td width="31" align="right"  valign="middle" class="smalltblheading">&nbsp;Qty&nbsp;</td>
<td width="65"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" value=""  readonly="true" style="background:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font></td>
</tr></table></div></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnopg8" class="smalltbltext" value=""  size="6" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balnompg8" class="smalltbltext" value=""  size="5" readonly="true" style="background:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltbltext"><input type="text" name="balqtyg8" class="smalltbltext" value="" readonly="true" style="background:#CCCCCC" size="6" /></td> <input type="hidden" name="dorowig8" value="0" />
</tr>

<?php
}
?>
</table>
<input type="hidden" name="tblslocnod" value="0" />

<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>