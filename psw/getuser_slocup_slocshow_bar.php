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
	$trid = $_GET['g'];	 
	}

?>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
   <td colspan="7" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
 </tr>
 <tr class="Light" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="119" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">NoP</td>
<td width="103" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="103" align="center" valign="middle" class="tblheading">NoP</td>
<td width="103" align="center" valign="middle" class="tblheading">NoMP</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php
$cnt=0;
//if($b=="WH-RO")
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotno='".$a."' and whid!='$b'") or die(mysqli_error($link));

$srno=1;
$totnop=0; $totnomp=0; $totqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sloc="";
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$f."' and lotno='".$a."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
  $cnt++; $nop=""; $nomp=""; $bqty=""; $nop1=0; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh.$binn.$subbinn;


$nop1=0; $nop2=0; $b1=0; $b2=0;
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
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0") or die(mysqli_error($link));
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

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$f' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0") or die(mysqli_error($link));
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

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0") or die(mysqli_error($link));
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

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$a' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0") or die(mysqli_error($link));
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

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$f' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_alflg=0") or die(mysqli_error($link));
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
//$qty=$nop*$ptp2;


//echo "  -  ".$nop;






$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}

$totnop=$totnop+$nop;
$totnomp=$totnomp+$nomp;
$totqty=$totqty+$bqty;

if($nomp<=0){$nomp=0;}
if($totnomp<=0){$totnomp=0;}
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $a;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['packtype'];?><input type="hidden" name="packtyp" value="<?php echo $row_issuetbl['packtype']?>" /></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nop;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotdgp_id']?>" /></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nop;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $a;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $row_issuetbl['packtype'];?><input type="hidden" name="packtyp" value="<?php echo $row_issuetbl['packtype']?>" /></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nop;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotdgp_id']?>" /></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nop;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $bqty;?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="4">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totnop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totnomp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 <td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="10">Variety not in Stock</td>
</tr>
 <?php
 }
// echo $trid;
 ?>
 <input type="hidden" name="txtBagsg" value="<?php echo $totnomp;?>" /> <input type="hidden" name="txtnopsg" value="<?php echo $totnop;?>" /><input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><br />
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
   <td colspan="7" align="center" valign="middle" class="tblheading">LMC/NLC Details</td>
</tr>
<tr class="Light" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="119" align="center" valign="middle" class="tblheading">UPS</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">Lot NoP</td>
<td width="110" align="center" valign="middle" class="tblheading">Lot Qty</td>
<td width="110" align="center" valign="middle" class="tblheading">Barcode</td>
</tr>
<?php 
$sno15=1;

$quer4=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='$f' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
//$c=$verids;		
//$b=$row_dept4['cropname'];

if($euptyp=="NST")$trtyp="PACKNLC";
else $trtyp="PACKLMC";

$ltns=""; $dys=""; $qtyl=0; $nompl=0; $nopl=0;

//echo"select distinct mpmain_barcode from tbl_mpmain where mpmain_variety='$f' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC') and mpmain_rvflg=0 and mpmain_dflg=0 and mpmain_spremflg=0 and mpmain_upflg=0 and mpmain_alflg=0";

$sqlmonth6=mysqli_query($link,"select distinct mpmain_barcode from tbl_mpmain where plantcode='$plantcode' and mpmain_variety='$f' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC') and mpmain_rvflg=0 and mpmain_dflg=0 and mpmain_spremflg=0 and mpmain_upflg=0 and mpmain_alflg=0")or die("Error:".mysqli_error($link));
$t2=mysqli_num_rows($sqlmonth6);
while($rowmonth6=mysqli_fetch_array($sqlmonth6))
{
	$flg=0; $lotno=""; $nobs=""; $qtys=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qcs=""; $dots=""; $dovs=""; $ndays="";  $sloc=""; $qcstsaps="";
	
	$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC') and mpmain_barcode='".$rowmonth6['mpmain_barcode']."'") or die(mysqli_error($link));
	$tot_mpl=mysqli_num_rows($sql_mpl);
	if($tot_mpl > 0)
	{
		while($row_mpl=mysqli_fetch_array($sql_mpl))
		{
			$lotarr=explode(",", $row_mpl['mpmain_lotno']);
			$noparr=explode(",", $row_mpl['mpmain_lotnop']);
			if(!in_array($a,$lotarr)){$lotarr=','; echo "not in array";}
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
					
					$sqlmon30=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotarr[$i]."'")or die("Error:".mysqli_error($link));
					$rowm30=mysqli_fetch_array($sqlmon30);
					
					$sqlmon3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$rowm30[0]."' and lotno='".$lotarr[$i]."'")or die("Error:".mysqli_error($link));
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
						$dys=$days2;	
				
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
/*$sql_month=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_variety='$f' and packtype='$upsids'")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sql_month);
while($row_month=mysqli_fetch_array($sql_month))
{*/
//foreach($ltno as $lotn)
//{
//if($lotn<>"")
//{

$lotn=$ltns;
$dot=""; $dov="";

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='$c' and lotldg_variety='$f' and packtype='$upsids' and lotno='".$lotn."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='$c' and lotldg_variety='$f' and packtype='$upsids' and lotno='".$lotn."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$rowmonth2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0 and balqty>0")or die("Error:".mysqli_error($link));
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
			$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='$plantcode' andpnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
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
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
				$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
				if($tot_softr_sub > 0)
				{
					$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
					$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
					$tot_softr=mysqli_num_rows($sql_softr);
					$row_softr=mysqli_fetch_array($sql_softr);
					if($tot_softr > 0)
					{
						$qcdot2=$row_softr['softr_date'];
					}
				}
				if($qcdot2=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
					$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
					if($tot_softr_sub2 > 0)
					{
						$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
						$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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
			
			$vflg=0;
			//echo $flg;
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$rowmonth3['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$rowmonth3['subbinid']."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
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
			if($row['lotldg_qc']=="BL")
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
	
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='".$f."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	/*if($variety!="")
		$variety=$variety."<br/>".$row_var['popularname'];
	else
		$variety=$row_var['popularname'];*/
		
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_var['cropname']."' order by cropname Asc"); 
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
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno15?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totnob?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $brcode;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><input type="radio" name="lotsel" id="lotsel_<?php echo $sno1;?>" value="<?php echo $lotno?>" onclick="sellot(this.value,<?php echo $sno1;?>,<?php echo $totnob;?>,<?php echo $totqty;?>,<?php echo $sn;?>,'<?php echo $brcode?>','<?php echo $upsids?>','<?php echo $tid?>','barsel')"  /><input type="hidden" name="inptyp" id="inptyp_<?php echo $sno1;?>" value="barsel" /></td>
	<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno15++;
}
}
}

?>
<input type="hidden" name="sno1" value="<?php echo $sno1;?>" />
</table><br />
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="8" align="center" class="tblheading">Destination SLOC</td>
</tr>
<?php
$srno=1;
if($b=="WH-RO")
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid=12 order by perticulars") or die(mysqli_error($link));
else
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid!=12 order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >
<td width="71" align="right"  valign="middle" class="tblheading">Warehouse&nbsp;</td>
<td width="80" align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtslwhg<?php echo $srno;?>" style="width:59px;" onchange="wh<?php echo $srno;?>(this.value);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($whi==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$whi."' order by binname") or die(mysqli_error($link));
?>
<td width="47" align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
<td width="72" align="left"  valign="middle" class="smalltbltext" id="bing<?php echo $srno;?>">&nbsp;<select class="smalltbltext" name="txtslbing<?php echo $srno;?>" style="width:43px;" onchange="bin<?php echo $srno;?>(this.value);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($bni==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$whi."' and binid='".$bni."' order by sname") or die(mysqli_error($link));
?>	
<td width="58" align="right"  valign="middle" class="tblheading">SubBin&nbsp;</td>
<td width="69" align="left"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno;?>">&nbsp;
  <select class="smalltbltext" name="txtslsubbg<?php echo $srno;?>" style="width:40px;" onchange="subbin<?php echo $srno;?>(this.value);"  >
<option value="" selected>SBin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($sbni==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font></td>

<td width="63" align="right"  valign="middle" class="tblheading">Details&nbsp;</td>
<td width="322" align="left"  valign="middle" class="smalltbltext" id="slocrow1"></td>
</tr>
</table><br />




<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="entire" onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;Entire Shift</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="partial" onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Partial Shift</td>
</tr>
</table><br />
<div id="subsubdiv">
<div id="bardiv">
<input type="hidden" name="trid" value="<?php echo $trid;?>" />
</div>
</div>
