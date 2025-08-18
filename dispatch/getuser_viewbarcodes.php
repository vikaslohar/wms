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
$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $sstage=""; $crop=""; $variety="";

$lotqry=mysqli_query($link,"select distinct orlot from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  orlot='".$a."' ") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
if($tot_row > 0)
{
	
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
		$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  orlot='".$a."' ") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
		
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{
			$nob=$nob+$row_issuetbl['balnomp']; 
			$qty=$qty+$row_issuetbl['balqty'];
			$sstage=$row_issuetbl['lotldg_sstage'];
			
			$tdate=$row_issuetbl['lotldg_dop'];
			$tdate=explode("-",$tdate);
			$dop=$tdate[2]."-".$tdate[1]."-".$tdate[0];
			
			$tdate=$row_issuetbl['lotldg_valupto'];
			$tdate=explode("-",$tdate);
			$dov=$tdate[2]."-".$tdate[1]."-".$tdate[0];
				
				
			$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_issuetbl['lotldg_crop']."' order by cropname Asc");
			$noticia = mysqli_fetch_array($quer3);
			$crop=$noticia['cropname'];
			
			$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
			$noticia_item = mysqli_fetch_array($quer4);
			$variety=$noticia_item['popularname'];
			
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


$lot=$a."P";
$barc=""; $barc1=""; $barc2=""; $barc3=""; 
$sqlbarc=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_lotno='".$lot."' and (mpmain_trtype='PACKSMC' OR mpmain_trtype='PACKNMC') and (mpmain_dflg=1 OR mpmain_spremflg=1)") or die(mysqli_error($link));
while($rowbarc=mysqli_fetch_array($sqlbarc))
{
	if($barc!="")
		$barc=$barc.",".$rowbarc['mpmain_barcode'];
	else
		$barc=$rowbarc['mpmain_barcode'];
}

$sqlbarc1=mysqli_query($link,"Select mpmain_lotno, mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  (mpmain_trtype='PACKLMC' OR mpmain_trtype='PACKNLC' OR mpmain_trtype='PACKMMC') and (mpmain_dflg=1 OR mpmain_spremflg=1)") or die(mysqli_error($link));
while($rowbarc1=mysqli_fetch_array($sqlbarc1))
{
	$ltn=explode(",",$rowbarc1['mpmain_lotno']);
	foreach($ltn as $ltno)
	{
		if($ltno<>"")
		{
			if($ltno==$lot)
			{
				if($barc!="")
					$barc=$barc.",".$rowbarc1['mpmain_barcode'];
				else
					$barc=$rowbarc1['mpmain_barcode'];
			}
		}
	}
}

$sqlbarc=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_lotno='".$lot."' and (mpmain_trtype='PACKSMC' OR mpmain_trtype='PACKNMC') and mpmain_dflg=2") or die(mysqli_error($link));
while($rowbarc=mysqli_fetch_array($sqlbarc))
{
	if($barc1!="")
		$barc1=$barc1.",".$rowbarc['mpmain_barcode'];
	else
		$barc1=$rowbarc['mpmain_barcode'];
}
$sqlbarc1=mysqli_query($link,"Select mpmain_lotno, mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  (mpmain_trtype='PACKLMC' OR mpmain_trtype='PACKNLC' OR mpmain_trtype='PACKMMC') and mpmain_dflg=2") or die(mysqli_error($link));
while($rowbarc1=mysqli_fetch_array($sqlbarc1))
{
	$ltn=explode(",",$rowbarc1['mpmain_lotno']);
	foreach($ltn as $ltno)
	{
		if($ltno<>"")
		{
			if($ltno==$lot)
			{
				if($barc1!="")
					$barc1=$barc1.",".$rowbarc1['mpmain_barcode'];
				else
					$barc1=$rowbarc1['mpmain_barcode'];
			}
		}
	}
}

$sqlbarc=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_lotno='".$lot."' and (mpmain_trtype='PACKSMC' OR mpmain_trtype='PACKNMC') and mpmain_upflg=1") or die(mysqli_error($link));
while($rowbarc=mysqli_fetch_array($sqlbarc))
{
	if($barc2!="")
		$barc2=$barc2.",".$rowbarc['mpmain_barcode'];
	else
		$barc2=$rowbarc['mpmain_barcode'];
}
$sqlbarc1=mysqli_query($link,"Select mpmain_lotno, mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  (mpmain_trtype='PACKLMC' OR mpmain_trtype='PACKNLC' OR mpmain_trtype='PACKMMC') and mpmain_upflg=1") or die(mysqli_error($link));
while($rowbarc1=mysqli_fetch_array($sqlbarc1))
{
	$ltn=explode(",",$rowbarc1['mpmain_lotno']);
	foreach($ltn as $ltno)
	{
		if($ltno<>"")
		{
			if($ltno==$lot)
			{
				if($barc2!="")
					$barc2=$barc2.",".$rowbarc1['mpmain_barcode'];
				else
					$barc2=$rowbarc1['mpmain_barcode'];
			}
		}
	}
}

$sqlbarc=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_lotno='".$lot."' and (mpmain_trtype='PACKSMC' OR mpmain_trtype='PACKNMC') and mpmain_dflg=0 and mpmain_spremflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
while($rowbarc=mysqli_fetch_array($sqlbarc))
{
	if($barc3!="")
		$barc3=$barc3.",".$rowbarc['mpmain_barcode'];
	else
		$barc3=$rowbarc['mpmain_barcode'];
}

$sqlbarc1=mysqli_query($link,"Select mpmain_lotno, mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  (mpmain_trtype='PACKLMC' OR mpmain_trtype='PACKNLC' OR mpmain_trtype='PACKMMC') and mpmain_dflg=0 and mpmain_spremflg=0 and mpmain_upflg=0") or die(mysqli_error($link));
while($rowbarc1=mysqli_fetch_array($sqlbarc1))
{
	$ltn=explode(",",$rowbarc1['mpmain_lotno']);
	foreach($ltn as $ltno)
	{
		if($ltno<>"")
		{
			if($ltno==$lot)
			{
				if($barc3!="")
					$barc3=$barc3.",".$rowbarc1['mpmain_barcode'];
				else
					$barc3=$rowbarc1['mpmain_barcode'];
			}
		}
	}
}
$t1=0; $t2=0; $t3=0; $t4=0;
if($barc3!="")
{
$nmp=explode(",",$barc3);
$nob=count($nmp);

$avlbar=explode(",",$barc3);
$tl=count($avlbar);
}
if($barc!="")
{
$drbar=explode(",",$barc);
$t2=count($drbar);
}
if($barc2!="")
{
$upbar=explode(",",$barc2);
$t3=count($upbar);
}
if($barc1!="")
{
$loadbar=explode(",",$barc1);
$t4=count($loadbar);
}
/*$barc=$barc.",";
$barc1=$barc1.",";
$barc2=$barc2.",";
$barc3=$barc3.",";*/

?>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Entered Lot Number: <?php echo $a;?> Details</td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">Crop&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
	<td width="75" align="right" class="smalltblheading">Variety&nbsp;</td>
	<td width="166" align="left" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
	<!--<td width="115" align="right" class="smalltblheading">Stage&nbsp;</td>
	<td width="100" align="left" class="smalltblheading">&nbsp;<?php echo $sstage;?></td>-->
</tr>
<!--<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">QC Status&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $qc;?></td>
	<td width="75" align="right" class="smalltblheading"><?php echo $qcdttype?>&nbsp;</td>
	<td width="166" align="left" class="smalltblheading">&nbsp;<?php echo $qcdot;?></td>
	<td width="115" align="right" class="smalltblheading">Soft Release Status&nbsp;</td>
	<td width="100" align="left" class="smalltblheading">&nbsp;<?php if($qcdttype=="DOT") echo "Not Applicable"; else if($qcdttype=="DOSF" && $qcdot!="") echo "Activated"; else if($qcdttype=="DOSF" && $qcdot=="") echo "Not Activated"; else echo "";?></td>
</tr>-->
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">NoMP&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $nob;?></td>
	<td width="75" align="right" class="smalltblheading">Qty&nbsp;</td>
	<td align="left" class="smalltblheading">&nbsp;<?php echo $qty;?></td>
</tr>
<tr class="Light" height="25">
	<td width="85" align="right" class="smalltblheading">DoP&nbsp;</td>
	<td width="145" align="left" class="smalltblheading">&nbsp;<?php echo $dop;?></td>
	<td width="75" align="right" class="smalltblheading">DoV&nbsp;</td>
	<td align="left" class="smalltblheading">&nbsp;<?php echo $dov;?></td>
</tr>
</table>
<br />
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="4">Available Barcodes <?php echo $tl;?></td>
</tr>

<tr class="tblsubtitle" height="25">
	<td width="120"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="224" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="123"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="223" align="center"  valign="middle" class="tbltext">Barcode</td>
</tr>
<?php
$sno=1;
if($tl>0)
{
foreach($avlbar as $avlbarc)
{
if($avlbarc<>"")
{
if($sno%2==1)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno;?></td>
	<td align="center" class="smalltblheading"><?php echo $avlbarc;?></td>
<?php
}
else
{
?>	
	<td align="center" class="smalltblheading"><?php echo $sno;?></td>
	<td align="center" class="smalltblheading"><?php echo $avlbarc;?></td>
</tr>
<?php
}
$sno++;
}
}
}
?>
</table>
<br />
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="4">Loaded for Dispatch Barcodes <?php echo $t4;?></td>
</tr>

<tr class="tblsubtitle" height="25">
	<td width="120"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="224" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="123"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="223" align="center"  valign="middle" class="tbltext">Barcode</td>
</tr>
<?php
$sno1=1;
if($t4>0)
{
foreach($loadbar as $loadbarc)
{
if($loadbarc<>"")
{
if($sno1%2==1)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno1;?></td>
	<td align="center" class="smalltblheading"><?php echo $loadbarc;?></td>
<?php
}
else
{
?>	
	<td align="center" class="smalltblheading"><?php echo $sno1;?></td>
	<td align="center" class="smalltblheading"><?php echo $loadbarc;?></td>
</tr>
<?php
}
$sno1++;
}
}
}
?>
</table>
<br />

<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="4">Dispatched/Released Barcodes <?php echo $t2;?></td>
</tr>

<tr class="tblsubtitle" height="25">
	<td width="120"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="224" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="123"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="223" align="center"  valign="middle" class="tbltext">Barcode</td>
</tr>
<?php
$sno1=1;
if($t2>0)
{
foreach($drbar as $drbarc)
{
if($drbarc<>"")
{
if($sno1%2==1)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno1;?></td>
	<td align="center" class="smalltblheading"><?php echo $drbarc;?></td>
<?php
}
else
{
?>	
	<td align="center" class="smalltblheading"><?php echo $sno1;?></td>
	<td align="center" class="smalltblheading"><?php echo $drbarc;?></td>
</tr>
<?php
}
$sno1++;
}
}
}
?>
</table>
<br />
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="smalltblheading" colspan="4">Unpackaged Barcodes <?php echo $t3;?></td>
</tr>

<tr class="tblsubtitle" height="25">
	<td width="120"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="224" align="center"  valign="middle" class="tbltext">Barcode</td>
	<td width="123"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="223" align="center"  valign="middle" class="tbltext">Barcode</td>
</tr>
<?php
$sno2=1;
if($t3>0)
{
foreach($upbar as $upbarc)
{
if($upbarc<>"")
{
if($sno2%2==1)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $sno2;?></td>
	<td align="center" class="smalltblheading"><?php echo $upbarc;?></td>
<?php
}
else
{
?>	
	<td align="center" class="smalltblheading"><?php echo $sno2;?></td>
	<td align="center" class="smalltblheading"><?php echo $upbarc;?></td>
</tr>
<?php
}
$sno2++;
}
}
}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Barcodes Details not found for the selected Lot Number</td>
</tr>
</table>
<?php
}
?>
