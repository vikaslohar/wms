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
	
	$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."' and balqty > 0") or die(mysqli_error($link));
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
	if($packtp[1]=="Gms")
	$nop1=($ptp*$penqty);
	else
	$nop1=($penqty/$ptp);
}
//if($nop1<$row_issuetbl['balnop'])
//$nop1=$row_issuetbl['balnop'];
//$nob=$row_issuetbl['balqty'];
$nob=$nob+$nop1; 
$extqty=$extqty+$row_issuetbl['balqty'];
$extnob=$extqty*$ptp;
$qty=$nob*$ptp1;

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$c."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=1; $srnonew=0; $uom="";
//echo $rowvariety['varietyid'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
$p1_array4=explode(",",$rowvariety['nowb']);
$p1_array5=explode(",",$rowvariety['wtnop']);
$p1_array6=explode(",",$rowvariety['wtnopkg']);
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
			$wbinmp=$p1_array4[$srnonew];
			$wbnop=$p1_array5[$srnonew];
			$wtnopkg=$p1_array6[$srnonew];
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
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
		$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
		//echo $row_softr_sub[0];
		$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
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
		$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
		if($tot_softr_sub2 > 0)
		{
		$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
		//echo $row_softr_sub2[0];
		$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg=0 and mpmain_upflg=0 ") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=explode(",", $row_mps['mpmain_crop']);
		$verarr=explode(",", $row_mps['mpmain_variety']);
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=explode(",", $row_mps['mpmain_upssize']);
		$noparr=explode(",", $row_mps['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nops=$nops+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtys=$ptp*$nops; $nomps=$nomps+$ct; 
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_dflg=0 and mpmain_upflg=0 ") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=explode(",", $row_mpl['mpmain_crop']);
		$verarr=explode(",", $row_mpl['mpmain_variety']);
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpl['mpmain_upssize']);
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopl=$nopl+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtyl=$ptp*$nopl; $nompl=$nompl+$ct; 
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg=0 and mpmain_upflg=0 ") or die(mysqli_error($link));
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
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtym=$ptp*$nopm; $nompm=$nompm+$ct; 
	}
}
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$a' and mpmain_dflg=0 and mpmain_upflg=0 ") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=explode(",", $row_mpns['mpmain_crop']);
		$verarr=explode(",", $row_mpns['mpmain_variety']);
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=explode(",", $row_mpns['mpmain_upssize']);
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopns=$nopns+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtyns=$ptp*$nopns; $nompns=$nompns+$ct; 
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC'  and mpmain_dflg=0 and mpmain_upflg=0 ") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=explode(",", $row_mpnl['mpmain_crop']);
		$verarr=explode(",", $row_mpnl['mpmain_variety']);
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpnl['mpmain_upssize']);
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopnl=$nopnl+$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtynl=$ptp*$nopnl; $nompnl=$nompnl+$ct; 
	}
}
$totextpouches=$nopl+$nopm+$nopns+$nopnl;
?>

<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td width="149" rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="113" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="98" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="98" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
    <!--<td width="113" rowspan="2" align="center" valign="middle" class="smalltblheading">Packaged</td>-->
	<td width="113" colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packaging</td>
	<td rowspan="2" align="center" valign="middle" class="tblheading">Max No. of MP</td>
	<td rowspan="2" align="center" valign="middle" class="tblheading">NoP in WB</td>
	<td rowspan="2" align="center" valign="middle" class="tblheading">WB Weight</td>
	<td rowspan="2" align="center" valign="middle" class="tblheading">WB in MP</td>
	<td rowspan="2" align="center" valign="middle" class="tblheading">MP Weight</td>
	<!--<td colspan="2" align="center" valign="middle" class="tblheading">Balance for Packaging</td>
	<td rowspan="2" align="center" valign="middle" class="tblheading">Barcode Labels</td>-->
  </tr>
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="smalltblheading">NoP</td>
    <td align="center" valign="middle" class="smalltblheading">Qty</td>
   <!-- <td align="center" valign="middle" class="tblheading">NoP</td>
    <td align="center" valign="middle" class="tblheading">Qty</td>-->
  </tr>

  <tr class="Light" height="25">
    <td width="149" align="center" valign="middle" class="smalltblheading"><?php echo $a;?><input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $ups;?><input type="hidden" name="upssize" value="<?php echo $ups;?>" /><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $uom;?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $ups;?>" /></td>
	<td width="98" align="center" valign="middle" class="smalltblheading"><?php echo $extnob;?><input type="hidden" name="txtextnob" value="<?php echo $extnob;?>" /></td>
    <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $extqty;?><input type="hidden" name="txtextqty" id="packqty_<?php echo $sno?>" value="<?php echo $extqty;?>" /></td>
	<!-- <td width="113" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="packagingdetails('<?php //echo $a;?>','<?php //echo $ups?>')">Details</a></td>-->
	  <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $nob;?><input type="hidden" name="txtonop" id="nopc_<?php echo $sno?>" value="<?php echo $nob;?>" /> <input type="hidden" name="totextpouches" id="totextpouches_<?php echo $sno?>" value="<?php echo $totextpouches;?>" /></td>
	   <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $qty;?><input type="hidden" name="txtoqty" id="packoqty_<?php echo $sno?>" value="<?php echo $qty;?>" /></td>
	<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $mpno?>" title="Maximum - <?php echo $mpno?>" readonly="true" style="background-color:#CCCCCC" /> <input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" />  </td>
	
	
	<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="wbnop_<?php echo $sno?>" id="wbnop_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $wbnop?>" title="Maximum - <?php echo $mpno?>" readonly="true" style="background-color:#CCCCCC" /></td>
	
	<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="wbwt_<?php echo $sno?>" id="wbwt_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $wtnopkg?>" readonly="true" style="background-color:#CCCCCC" /> </td>
	
	<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="wbinmp_<?php echo $sno?>" id="wbinmp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $wbinmp?>"  readonly="true" style="background-color:#CCCCCC" /> </td>
	
	<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $wtmp?>" readonly="true" style="background-color:#CCCCCC" /> <input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" />
	
<input type="hidden" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="0" readonly="true" style="background-color:#CCCCCC" />	<input type="hidden" name="balqty_<?php echo $sno?>" id="balqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="0.000" readonly="true" style="background-color:#CCCCCC" /></td>
<!--<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="0" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="balqty_<?php echo $sno?>" id="balqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="0.000" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="61" colspan="2" align="center" valign="middle" class="tbltext" id="dtail_<?php echo $sno;?>">Fill</td>-->
</tr> 
  <input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
</table>
<div id="slsync">
<?php $bpch=0;?>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
	<td width="20%" align="center" valign="middle" class="smalltblheading">MRP per UPS</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">MRP per Gms.</td>
  </tr>
<tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="mrpups" id="mrpups" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="mrpconv(this.value)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="mrpgms" id="mrpgms" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" readonly="true"  style="background-color:#CCCCCC" value=""   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr> 
</table><br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="120" maxlength="120" ></td>
</tr>
</table>

<input type="hidden" name="sno3" value="8" /><input type="hidden" name="slocseldet" value="" />

<div id="slocsync">
</div></div>
<br />

<?php
}
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
}
?> <input name="protype" value="Pack" type="hidden">