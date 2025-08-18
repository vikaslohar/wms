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
  		$l = $_GET['a'];	 
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
	  	$h= $_GET['h'];	 
	}
	if(isset($_GET['g']))
	{
	  	$g = $_GET['g'];	 
	}
	if(isset($_GET['f']))
	{
	  	$f = $_GET['f'];	 
	}
	if(isset($_GET['l']))
	{
	  	$stge = $_GET['l'];	 
	}
?>

<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table width="968" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
 
<?php	
$sno=0;
$zz=explode(",", $l);
$as=count($l);
foreach($zz as $a)
{
if($a <> "")
{
  $extwh=""; $extbin=""; $extsubbin=""; $extnob=0; $extqty=0;
$lotqry=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $ups="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
		$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$a."' ") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
		
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{
			$nop1=0; $ptp1=0;
			$ups=$row_issuetbl['packtype'];
			$wtinmp=$row_issuetbl['wtinmp'];
			$upspacktype=$row_issuetbl['packtype'];
			$packtp=explode(" ",$upspacktype);
			$packtyp=$packtp[0]; 
			if($packtp[1]=="Gms")
			{ 
				$ptp=(1000/$packtp[0]);
				$ptp1=($packtp[0]/1000);
			}
			else
			{
				$ptp=$packtp[0];
				$ptp1=$packtp[0];
			}
			$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
			if($penqty > 0)
			{
				$nop1=($ptp*$penqty);
			}
			//if($nop1<$row_issuetbl['balnop'])
			//$nop1=$row_issuetbl['balnop'];
			//$nob=$nop1;
			
			$nob=$nob+$nop1; 
			$extqty=$extqty+$row_issuetbl['balqty'];//echo "  =  ";
			$extnob=($extqty*$ptp);//echo "<br/>";
			$qty=$nob*$ptp1;
			
			$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$c."' and actstatus='Active'") or die(mysqli_error($link));
			$totvariety=mysqli_num_rows($sqlvsriety);
			$rowvariety=mysqli_fetch_array($sqlvsriety);
			$srnonew=0; $uom="";
			//echo $rowvariety['varietyid'];
			$p1_array=explode(",",$rowvariety['gm']);
			$p1_array2=explode(",",$rowvariety['wtmp']);
			$p1_array3=explode(",",$rowvariety['mptnop']);
			foreach($p1_array as $val1)
			{
				if($val1<>"")
				{
					$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
					$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
					if($row1234=mysqli_num_rows($res)>0)
					{
						$row12=mysqli_fetch_array($res);
						$uom=$row12['uom'];
						$wtmp=$p1_array2[$srnonew];
						$mptnop=$p1_array3[$srnonew];
						
						//echo $ptp."  =>  ".$ptp1."  = ".$wtmp;
						$mmmpt=$ptp*$wtmp;
						if($mptnop!=$mmmpt)$mptnop=$mmmpt;
						//echo $mptnop;
					}
				}
				$srnonew++;
			}	
			
			
			$qc=$row_issuetbl['lotldg_qc'];
			if($qc=="OK")
			{
				$trdate=$row_issuetbl['lotldg_qctestdate'];
				$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				$qcdttype="DOT";
			}
			else
			{
				$zz=str_split($a);
				$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
				if($row_issuetbl['lotldg_srflg']==1)
				{
					$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
							$trdate=$row_softr['softr_date'];
							$trdate=explode("-",$trdate);
							$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
						}
					}
					if($qcdot2=="")
					{
						$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
								$trdate=$row_softr2['softr_date'];
								$trdate=explode("-",$trdate);
								$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
							}
						}
					}
				}
				$qcdttype="DOSF";
			}
			if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
		}
	}
	if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
	if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";
	
	if($qcdttype=="DOT")$qcdot=$qcdot1;
	else if($qcdttype=="DOSF")$qcdot=$qcdot2;
	else
	$qcdot="";
	$dp1="";$dp2="";$dp3="";
	if($qcdot!="")
	{
		$trdate2=explode("-",$qcdot);
		$m=$trdate2[1];
		$de=$trdate2[0];
		$y=$trdate2[2];
		
		$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
		$trdate2=explode("-",$trdt3);
		$m=$trdate2[1];
		$de=$trdate2[2];
		$y=$trdate2[0];
		
		$dt=3;
		if($dt!="")
		{
			for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
		}
		else
		{$dp1="";}
		
		$dt=6;
		if($dt!="")
		{
			for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
		}
		else
		{$dp2="";}
		
		$dt=9;
		if($dt!="")
		{
			for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
		}
		else
		{$dp3="";}
	}
	$mpno=floor($qty/$wtmp);
	$avlqty=$nob*$ptp;
	$sno++;
}




$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
				//$nops=$nops+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
					$ptp1=1000/$up[0];
				}
				else
				{
					$ptp=$up[0];
					$ptp1=$up[0];
				}
				$nops=$nops+($ptp1*$row_mps['mpmain_wtmp']);
				$qtys=$qtys+$row_mps['mpmain_wtmp']; $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$lotno' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$nompnl+$ct; 
			}
		}
		
	}
}
//echo $a."  -  ".$extnob."  -  ".$nops."  -  ".$nopl."  -  ".$nopm."  -  ".$nopns."  -  ".$nopnl."<br>";	
//echo $a."  -  ".$extqty."  -  ".$qtys."  -  ".$qtyl."  -  ".$qtym."  -  ".$qtyns."  -  ".$qtynl."<br>";
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;	
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl;	
$qty=$extqty-$totextqtys;
$nob=$extnob-$totextpouches;
$qty=floatval($qty);	
if($nob<0)$nob=0;
if($qty<0)$qty=0;
?>
 <tr class="tblsubtitle" height="25">
    <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="168" rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="99" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="112" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="112" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
    <td width="112" rowspan="2" align="center" valign="middle" class="smalltblheading" >Packaged</td>
    <td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packaging</td>
	<td width="105" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="92" rowspan="2" align="center" valign="middle" class="tblheading">NoP</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">Balance for Packaging</td>
  </tr>
 <tr class="tblsubtitle" height="25">
   <td width="80" align="center" valign="middle" class="smalltblheading">NoP</td>
   <td width="84" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="94" align="center" valign="middle" class="tblheading">NoP</td>
   <td width="99" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>

  <tr class="Light" height="25">
  <td align="center" valign="middle" class="smalltbltext"><?php echo $sno?></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $a;?><input type="hidden" name="lotno_<?php echo $sno?>" id="lotno_<?php echo $sno?>" value="<?php echo $a?>" /> <input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $ups;?><input type="hidden" name="upssize" value="<?php echo $ups;?>" /><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $uom;?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $extnob;?><input type="hidden" name="txtextnob" id="txtextnop_<?php echo $sno;?>" value="<?php echo $extnob;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $extqty;?><input type="hidden" name="txtextqty" id="packqty_<?php echo $sno?>" value="<?php echo $extqty;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="packagingdetails('<?php echo $a;?>','<?php echo $ups?>')">Details</a></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $nob;?><input type="hidden" name="txtonob" id="nopc_<?php echo $sno;?>" value="<?php echo $nob;?>" /></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $qty;?><input type="hidden" name="txtoqty" id="packoqty_<?php echo $sno?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="pqty_<?php echo $sno?>" value="" onkeypress="return isNumberKey1(event)" size="7" maxlength="7" onchange="balqtcheck(this.value, <?php echo $sno?>)" /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" title="Maximum - <?php echo $mptnop?>" onkeypress="return isNumberKey(event)" onchange="balnopcheck(this.value, <?php echo $sno?>)"/><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtbqty" size="7" maxlength="7" id="bqty_<?php echo $sno?>" value="" readonly="true" style="background-color:#CCCCCC" /></td>
</tr> 

<tr class="Light" height="25">
<td align="center" valign="middle" colspan="12">
<table align="center" border="1" width="968" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td width="76" rowspan="2" align="center" valign="middle" class="tblheading">WH</td>
<td width="108" rowspan="2" align="center" valign="middle" class="tblheading">Bin</td>
<td width="99" rowspan="2" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="111" rowspan="2" align="center" valign="middle" class="tblheading">Master Packs</td>
<td colspan="2" align="center" valign="middle" class="tblheading">Available</td>
<td width="105" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
<td width="92" rowspan="2" align="center" valign="middle" class="tblheading">NoP</td>
<td width="192" rowspan="2" align="center" valign="middle" class="tblheading">Balance NoP</td>
</tr>
<tr class="tblsubtitle" height="25">
  <td width="81" align="center" valign="middle" class="tblheading">NoP</td>
  <td width="84" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sno33=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."'") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
$nob=0; $qty=0; $qty1=0;
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$a."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
$rowsubsub5=mysqli_num_rows($sql_issuetbl);
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
	$nop1=0; $sno33=$sno33+1;
	$ups=$row_issuetbl['packtype'];
	$wtinmp=$row_issuetbl['wtinmp'];
	$upspacktype=$row_issuetbl['packtype'];
	$packtp=explode(" ",$upspacktype);
	$packtyp=$packtp[0]; 
	/*if($packtp[1]=="Gms")
	{ 
		$ptp=($packtp[0]/1000);
	}
	else
	{
		$ptp=$packtp[0];
	}*/
	if($packtp[1]=="Gms")
	{ 
		$ptp=(1000/$packtp[0]);
		$ptp4=(1000/$packtp[0]);
		$ptp1=($packtp[0]/1000);
	}
	else
	{
		$ptp=$packtp[0];
		$ptp4=$packtp[0];
		$ptp1=$packtp[0];
	}
	$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
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
	}
	/*if($penqty > 0)
	{
	$nop1=($ptp*$penqty);	
	//$nop1=$row_issuetbl['balnop'];
	}*/
	
	//if($nop1<$row_issuetbl['balnop'])$nop1=$row_issuetbl['balnop'];
	//$nob=$nop1; 
	$qty=$row_issuetbl['balnomp'];
	$qty1=$row_issuetbl['balqty'];
	$nob=$qty1*$ptp;
	$avlqty=$nob*$ptp1;
//}

$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;   $nopns=0; $qtyns=0; $nopnl=0; $qtynl=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
				/*$nops=$nops+$noparr[$i];
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
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; */
				//$nops=$nops+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
					$ptp1=1000/$up[0];
				}
				else
				{
					$ptp=$up[0];
					$ptp1=$up[0];
				}
				$nops=$nops+($ptp1*$row_mps['mpmain_wtmp']);
				$qtys=$qtys+$row_mps['mpmain_wtmp']; $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$lotno' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$nompns+$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg!=1") or die(mysqli_error($link));
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
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$nompnl+$ct; 
			}
		}
		
	}
}

//echo $qty1."  -  ".$totextqtys;

$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;	
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+qtynl;	
//$avlqty=$qty1-$totextqtys;

if($qty>0)
{
	$nob=$nob-$totextpouches;
	//$avlqty=$nob*$ptp1;
	$avlqty=$qty1-$totextqtys;
}

	if($extwh!="")
	$extwh=$extwh.",".$row_tbl_subsub3['whid'];
	else
	$extwh=$row_tbl_subsub3['whid'];
	
	if($extbin!="")
	$extbin=$extbin.",".$row_tbl_subsub3['binid'];
	else
	$extbin=$row_tbl_subsub3['binid'];
	
	if($extsubbin!="")
	$extsubbin=$extsubbin.",".$row_tbl_subsub3['subbinid'];
	else
	$extsubbin=$row_tbl_subsub3['subbinid'];

?>
<tr class="light" height="25">
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) {  if($row_tbl_subsub3['whid']==$noticia_whd1['whid']) echo $noticia_whd1['perticulars']; } ?></td>
<?php

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub3['whid']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) {  if($row_tbl_subsub3['binid']==$noticia_bing1['binid']) echo $noticia_bing1['binname']; } ?></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub3['binid']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) {  if($row_tbl_subsub3['subbinid']==$noticia_subbing1['sid']) echo $noticia_subbing1['sname']; } ?><input type="hidden" name="exwh<?php echo $sno;?>_<?php echo $sno33;?>" id="exwh<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['whid'];?>" /><input type="hidden" name="exbin<?php echo $sno;?>_<?php echo $sno33;?>" id="exbin<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['binid']?>" /><input type="hidden" name="exsubbin<?php echo $sno;?>_<?php echo $sno33;?>" id="exsubbin<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['subbinid']?>" /></td>

<td align="center" valign="middle" class="tbltext"><?php echo $qty;?><input type="hidden" name="extnomphs<?php echo $sno;?>_<?php echo $sno33;?>" id="extnomphs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $qty;?>" /></td> 
<td align="center" valign="middle" class="tbltext"><?php echo $nob;?><input type="hidden" name="extnophs<?php echo $sno;?>_<?php echo $sno33;?>" id="extnophs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $nob;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $avlqty;?><input type="hidden" name="extqtyhs<?php echo $sno;?>_<?php echo $sno33;?>" id="extqtyhs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $avlqty;?>" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="qtyphs<?php echo $sno;?>_<?php echo $sno33;?>" id="qtyphs<?php echo $sno;?>_<?php echo $sno33;?>" value="" size="7"  onchange="pacqtychk(this.value,<?php echo $sno;?>,<?php echo $sno33;?>)"  onkeypress="return isNumberKey1(event)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nophs<?php echo $sno;?>_<?php echo $sno33;?>" id="nophs<?php echo $sno;?>_<?php echo $sno33;?>" value="" size="7"  onchange="pacpchk(this.value,<?php echo $sno;?>,<?php echo $sno33;?>)" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="balnophs<?php echo $sno;?>_<?php echo $sno33;?>" id="balnophs<?php echo $sno;?>_<?php echo $sno33;?>" value="" size="7" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<?php
}
}
?>
<input type="hidden" name="sno33_<?php echo $sno;?>" id="sno33_<?php echo $sno;?>" value="<?php echo $sno33;?>" />
 </table> </td>
 </tr>
 <tr height="25">
<?php
}
}
//}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="1" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="extwh" value="<?php echo $extwh;?>" />
<input type="hidden" name="extbin" value="<?php echo $extbin?>" />
<input type="hidden" name="extsubbin" value="<?php echo $extsubbin?>" />
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">SLOC</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="160" align="center" valign="middle" class="tblheading">WH</td>
<td width="106" align="center" valign="middle" class="tblheading">Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Comments</td>
<td width="162" align="center" valign="middle" class="tblheading">Master Packs</td>
<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
</tr>
<?php
$tsno=0;
$sno3=0;
?>
<input type="hidden" name="sno3" value="<?php echo $sno3;?>" />
<input type="hidden" name="tsno" value="<?php echo $tsno;?>" />
<?php
if($sno3==0)
{
?>
<tr class="light" height="25">
  <?php
if($extwh!="")  
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid IN($extwh) order by perticulars") or die(mysqli_error($link));
else
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg1" name="txtwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing1" id="txtbing1" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg1" id="txtsubbg1" style="width:60px;" onchange="subbin(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /></td>
 	</tr>
</table><input type="hidden" name="trflg1" value="" /><input type="hidden" name="tpflg1" value="" /><input type="hidden" name="tflg1" value="" /><input type="hidden" name="tpmflg1" value="" />
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<!--
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg2" name="txtwhg2" style="width:70px;" onchange="wh(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn2"><select class="smalltbltext" name="txtbing2" id="txtbing2" style="width:60px;" onchange="bin(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn2"><select class="smalltbltext" name="txtsubbg2" id="txtsubbg2" style="width:60px;" onchange="subbin(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==1)
{
?>
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg2" name="txtwhg2" style="width:70px;" onchange="wh(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn2"><select class="smalltbltext" name="txtbing2" id="txtbing2" style="width:60px;" onchange="bin(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn2"><select class="smalltbltext" name="txtsubbg2" id="txtsubbg2" style="width:60px;" onchange="subbin(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==2)
{
?>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==3)
{
?>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==4)
{
?>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==5)
{
?>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==6)
{
?>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==7)
{
?>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>-->
<?php
}

?>
<input type="hidden" name="sno3" value="1" /><input type="hidden" name="slocseldet" value="" />
</table>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="100" maxlength="100" ></td>
</tr>
</table>
<br />
<!--<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0" style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
<?php
/*}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="light" height="25">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details cannot display reasons:</td>
</tr>
<tr class="light" height="25">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot number not Imported</td>
</tr>
<tr class="light" height="25">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already Processed.</td>
</tr>
</table>
<?php
}*/
?>
