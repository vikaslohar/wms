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
	
	$tp="Pack";
	
//frm_action=submit&code=1143&txtmtype=&rettyp=&oBags=172&oqty=5160&txtdate=05-04-2017&txtwhfrom=Deorjhal&txtwhto=WH-RO&txtcrop=24&txtvariety=452&itmdchk=&txtlot1=DI90500%2F00000%2F00P&rowid_1=368642&txtBagsg=172&txtnopsg=0&txtqtyg=5160&srno=2&chkbox=&srno1=&edtrowid=&orwoid=368642&trid=0&sno1=&txtslwhg1=12&txtslbing1=438&txtslsubbg1=8749&txtep=partial&barcode=ER990086877&brflg=4&brchflg=1&trid=0

	if(isset($_GET['code'])) { $code = $_GET['code']; }
	if(isset($_GET['txtdate'])) { $txtdate = $_GET['txtdate']; }
	if(isset($_GET['trid'])) { $trid = $_GET['trid']; }
	if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop']; }
	if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }	
	if(isset($_GET['txtlot1'])) { $txtlot1 = $_GET['txtlot1']; }	
	
	if(isset($_GET['oBags'])) { $oBags = $_GET['oBags']; }	
	if(isset($_GET['oqty'])) { $oqty = $_GET['oqty']; }	
	
	if(isset($_GET['otBags'])) { $otBags = $_GET['otBags']; }	
	if(isset($_GET['otqty'])) { $otqty = $_GET['otqty']; }	
		
	if(isset($_GET['txtwhfrom'])) { $txtwhfrom = $_GET['txtwhfrom']; }
	if(isset($_GET['txtwhto'])) { $txtwhto = $_GET['txtwhto']; }
	if(isset($_GET['txtslwhg1'])) { $txtslwhg1 = $_GET['txtslwhg1']; }
	if(isset($_GET['txtslbing1'])) { $txtslbing1 = $_GET['txtslbing1']; }
	if(isset($_GET['txtslsubbg1'])) { $txtslsubbg1 = $_GET['txtslsubbg1']; }
	
	if(isset($_GET['txtep'])) { $txtep = $_GET['txtep']; }
	if(isset($_GET['barcode'])) { $barcode = $_GET['barcode']; }
	if(isset($_GET['txtnopsg'])) { $txtnopsg = $_GET['txtnopsg']; }
	if(isset($_GET['txtBagsg'])) { $txtBagsg = $_GET['txtBagsg']; }
	if(isset($_GET['txtqtyg'])) { $txtqtyg = $_GET['txtqtyg']; }	
	if(isset($_GET['packtyp'])) { $packtyp = $_GET['packtyp']; }
	if(isset($_GET['bar'])) { $bar = $_GET['bar']; } else {$bar="nobar";}	
	
	if($txtep=="partial")$bar="nobar";
	
	if(isset($_GET['orwoid'])) { $orwoid = $_GET['orwoid']; }	
	
	$x=0;
	
	$tdate=$txtdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;
		
	
	$sqlbarcode=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$barcode."'") or die(mysqli_error($link));
	$totbarcode=mysqli_num_rows($sqlbarcode);
	$rowbarcode=mysqli_fetch_array($sqlbarcode);
	$a1=$rowbarcode['mpmain_lotnop'];
	$b1=1;
	$wtinmp=$rowbarcode['mpmain_wtmp'];
	$lotarr=explode(",", $rowbarcode['mpmain_lotno']);
	$noparr=explode(",", $rowbarcode['mpmain_lotnop']);
			
	for ($i=0; $i<count($lotarr); $i++)
	{
		if($lotarr[$i]<>"" && $lotarr[$i]==$txtlot1)
		{
			$nopl=$noparr[$i];
		
			$up23=explode(" ", $packtyp);
			if($up23[1]=="Gms")
			{
				$ptp=$up23[0]/1000;
			}
			else
			{
				$ptp=$up23[0];
			}
			$qtyl=$ptp*$nopl; $nompl=1; 
		}
	}		
	$c1=$qtyl;
		
		
if($trid == 0)
{
 $sql_in1="insert into tbl_sloc_psw (code, sldate, crop, variety, lotno, yearcode, surole, stage, whfrom, whto, sluptype, plantcode) values ('$code', '$tdate', '$txtcrop', '$txtvariety', '$txtlot1', '$yearid_id', '$lgnid', '$tp', '$txtwhfrom', '$txtwhto', 'barcodewise', '$plantcode')";
 
if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
{
 $mainid=mysqli_insert_id($link);
	$bnop=$txtnopsg; $bnomp=$txtBagsg-$b1; $bqt=$txtqtyg-$c1;
	$sql_in="insert into tbl_sloc_psw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opnop, opnomp, opqty, nop, nomp, qty, balnop, balnomp, balqty, rowid, wtinmp, packtype, sltype, barcsts, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtnopsg', '$txtBagsg', '$txtqtyg', '$a1', '$b1', '$c1', '$bnop', '$bnomp', '$bqt', '$orwoid', '$wtinmp', '$packtyp', '$txtep', '$bar', '$plantcode')";
	mysqli_query($link,$sql_in) or die(mysqli_error($link));
	if($brflg==0)
	{
		$sq23=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where plantcode='$plantcode' and slocid='$mainid' and barcode='$barcode'") or die(mysqli_error($link));
		$totr=mysqli_num_rows($sq23);
		if($totr==0)
		{
			$sql_in2="insert into tbl_sloc_psw_sub2(slocid, crop, variety, lotno, whid, binid, subbinid, nop, nomp, qty, barcode, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$a1', '$b1', '$wtinmp', '$barcode', '$plantcode')";
			mysqli_query($link,$sql_in2) or die(mysqli_error($link));
		}
	}
}
$trid=$mainid;
}
else
{
	//$sql_in1="update tbl_sloc_psw set crop='$txtcrop', variety='$txtvariety', lotno='$txtlot1', yearcode='$yearid_id', stage='$tp',surole='$lgnid' where slid='".$trid."'";
	//if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))

	$mainid=$trid;
	//$sql_in="insert into tbl_sloc_psw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, nop, nomp, qty, rowid, wtinmp, packtype, sltype) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$a1', '$b1', '$c1', '$orwoid', '$wtinmp', '$packtyp', '$txtep')";
	//mysqli_query($link,$sql_in) or die(mysqli_error($link));
	if($brflg==0)
	{
		$sq23=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where plantcode='$plantcode' and slocid='$mainid' and barcode='$barcode'") or die(mysqli_error($link));
		$totr=mysqli_num_rows($sq23);
		if($totr==0)
		{
			$sql_in2="insert into tbl_sloc_psw_sub2(slocid, crop, variety, lotno, whid, binid, subbinid, nop, nomp, qty, barcode, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$a1', '$b1', '$wtinmp', '$barcode', '$plantcode')";
			mysqli_query($link,$sql_in2) or die(mysqli_error($link));
		}
	}
	$onop=0;$onomp=0;$oqt=0;$tnop=0;$tnomp=0;$tqt=0;
	$sq20=mysqli_query($link,"Select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='$mainid'") or die(mysqli_error($link));
 	$totr20=mysqli_num_rows($sq20);
	$row20=mysqli_fetch_array($sq20);
	$onop=$onop+$row20['opnop'];
	$onomp=$onomp+$row20['opnomp'];
	$oqt=$oqt+$row20['opqty'];
	$sq230=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where plantcode='$plantcode' and slocid='$mainid'") or die(mysqli_error($link));
	$totr230=mysqli_num_rows($sq230);
	while($row23=mysqli_fetch_array($sq230))
	{
		//echo $row23['qty'];
		$tnop=$tnop+$row23['nop'];
		$tnomp=$tnomp+$row23['nomp'];
		$tqt=$tqt+$row23['qty'];
	}
	$bnop=$onop; $bnomp=$onomp-$tnomp; $bqt=$oqt-$tqt;
 	$sql_in="update tbl_sloc_psw_sub set nop='$tnop', nomp='$tnomp', qty='$tqt', balnop='$bnop', balnomp='$bnomp', balqty='$bqt' where slocid='$mainid'";
	mysqli_query($link,$sql_in) or die(mysqli_error($link));
}
?>

<?php 
$trid=$mainid;
//exit;

$sql_main=mysqli_query($link,"Select * from tbl_sloc_psw where plantcode='$plantcode' and slid='$trid'") or die(mysqli_error($link));
$row_main=mysqli_fetch_array($sql_main);

$sql_sub=mysqli_query($link,"Select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='$trid'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

?>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation - WH-RO</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
  
<tr class="Light" height="25">
<td width="152"  align="right"  valign="middle" class="tblheading">&nbsp;From Warehouse&nbsp;</td>
<td width="244" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_main['whfrom']; ?><input class="tbltext" name="txtwhfrom" type="hidden"  value="<?php echo $row_main['whfrom']; ?>" style="background-color:#CCCCCC" readonly="true"  />	</td>
<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
<td width="108" align="right" valign="middle" class="tblheading">To Warehouse&nbsp;</td>
<td width="286" align="left" valign="middle" class="tbltext" id="whitem" >&nbsp;<?php echo $row_main['whto']; ?><input name="txtwhto" id="whitem" type="hidden" class="tbltext" value="<?php echo $row_main['whto']; ?>" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font></td>
</tr>
  
<?php 
$classqry=mysqli_query($link,"select * from tblcrop where cropid='".$row_main['crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Light" height="25">
 <td width="152"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
 <td width="244" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $noticia_class['cropid'];?>" /> </td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$row_main['crop']."' and varietyid='".$row_main['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item = mysqli_fetch_array($itemqry);
?>            
<td width="108" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="286" align="left" valign="middle" class="tbltext" id="vitem" >&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" name="txtvariety" id="itm" value="<?php echo $noticia_item['varietyid'];?>"  /> </td>
</tr><input type="hidden" name="itmdchk" value="" />
 <tr class="Light" height="25">
            <td height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_main['lotno']; ?><input name="txtlot1" id="smt" type="hidden" class="tbltext" value="<?php echo $row_main['lotno']; ?>" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>	
</table>
<br />
<div id="subdiv">
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
$c=$row_main['crop'];
$a=$row_main['lotno'];
$f=$row_main['variety'];
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

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$f' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$f' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
$balnop=$nop;
$balnomp=$nomp;
$balqty=$bqty;
if($row_sub['lotno']==$a)
{
$balnop=$nop-$row_sub['nop'];
$balnomp=$nomp-$row_sub['nomp'];
$balqty=$bqty-$row_sub['qty'];
}
if($balnop<=0)$balnop=0;
$totnop=$totnop+$nop;
$totnomp=$totnomp+$nomp;
$totqty=$totqty+$bqty;
$ups=$row_issuetbl['packtype'];
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
<td align="center" valign="middle" class="smalltbltext"><?php echo $balnop;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $balnomp;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
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
<td align="center" valign="middle" class="smalltbltext"><?php echo $balnop;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $balnomp;?></td>
<td align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
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

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{
		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
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
			$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
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
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sub['whid']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>
<tr class="Light" height="30" >
<td width="71" align="right"  valign="middle" class="tblheading">Warehouse&nbsp;</td>
<td width="80" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" name="txtslwhg<?php echo $srno;?>" value="<?php echo $noticia_whd1['whid'];?>" /> </td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_sub['whid']."' and binid='".$row_sub['binid']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>
<td width="47" align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
<td width="72" align="left"  valign="middle" class="smalltbltext" id="bing<?php echo $srno;?>">&nbsp;<?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtslbing<?php echo $srno;?>" value="<?php echo $noticia_bing1['binid'];?>" /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and whid='".$row_sub['whid']."' and binid='".$row_sub['binid']."' and sid='".$row_sub['subbinid']."' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	
<td width="58" align="right"  valign="middle" class="tblheading">SubBin&nbsp;</td>
<td width="69" align="left"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno;?>">&nbsp;<?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtslsubbg<?php echo $srno;?>" value="<?php echo $noticia_subbing1['sid'];?>" /> </td>

<td width="63" align="right"  valign="middle" class="tblheading">Details&nbsp;</td>
<td width="322" align="left"  valign="middle" class="smalltbltext" id="slocrow1"></td>
</tr>
</table><br />



<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<?php
if($row_sub['sltype']=="partial")
{
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="entire" disabled="disabled"  onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;Entire Shift</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="partial" checked="checked" onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Partial Shift</td>
</tr>
<?php
}
else if($row_sub['sltype']=="entire")
{
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="entire" checked="checked" onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;Entire Shift</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="partial" disabled="disabled" onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Partial Shift</td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="entire"   onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;Entire Shift</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="txtep" size="11" maxlength="11" value="partial"  onclick="showsloc('<?php echo $nomp;?>','<?php echo $bqty;?>','<?php echo $row_issue1[0]?>',this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Partial Shift</td>
</tr>
<?php
}
?>
</table><br />
<div id="subsubdiv">
<?php
if($row_sub['sltype']=="entire")
{
?>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<?php
if($row_sub['barcsts']=="withbar")
{
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="withbar" checked="checked" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;With Barcode</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="nobar" disabled="disabled" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Without Barcode</td>
</tr>
<?php
}
else if($row_sub['barcsts']=="nobar")
{
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="withbar" disabled="disabled" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;With Barcode</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="nobar" checked="checked" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Without Barcode</td>
</tr>
<?php
}
else 
{
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="withbar" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="225" align="left"  valign="middle" class="tblheading">&nbsp;With Barcode</td>
<td align="right"  valign="middle" class="smalltbltext" colspan="2"><input type="radio" name="bar" value="nobar" checked="checked" onclick="chkbar(this.value);"/>&nbsp;</td>
<td width="397" align="left"  valign="middle" class="tblheading">&nbsp;Without Barcode</td>
</tr>
<?php
}
?>

</table>
<?php
}
?>
<div id="bardiv">
<?php
if($row_sub['sltype']=="partial" || $row_sub['barcsts']=="withbar")
{
?>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Barcode View</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="119" align="center" valign="middle" class="tblheading">UPS</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">Lot NoP</td>
<td width="110" align="center" valign="middle" class="tblheading">Lot Qty</td>
<td width="110" align="center" valign="middle" class="tblheading">Barcode</td>
</tr>
</table>
<?php
$sno2=0; $totrec=0; $bchnflg=0; $totbarcs="";
$sq2=mysqli_query($link,"Select * from tbl_sloc_psw_sub2 where plantcode='$plantcode' and slocid='$trid'") or die(mysqli_error($link));
$totrec=mysqli_num_rows($sq2);
?>
<div id="table-wrapper" style=" <?php if($totrec<=4) {?>height:auto; width:800px; overflow:hidden;<?php } else{?>height:101px; width:800px; overflow:auto;<?php } ?>">
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse;" > 
<?php
if($totrec=mysqli_num_rows($sq2) > 0)
{
	while($ro2=mysqli_fetch_array($sq2))
	{
		$lot2=$ro2['lotno']; 
		$crps=$ro2['crop']; 
		$vers=$ro2['variety']; 
		$upss=$ups; 
		$nops=$ro2['nop']; 
		$nompt=$ro2['nomp'];
		$nqty2=$ro2['qty'];
		$barc=$ro2['barcode'];
			
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vts=$row_dept4['popularname'];
			
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$ro2['whid']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$ro2['binid']."' and whid='".$ro2['whid']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$ro2['subbinid']."' and binid='".$ro2['binid']."' and whid='".$ro2['whid']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		
		if($totbarcs!="")
			$totbarcs=$totbarcs.",".$ro2['barcode'];
		else
			$totbarcs=$ro2['barcode'];
		
$sno2++; 		
?>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext"><?php echo $sno2;?></td>
	<td width="97" align="center" class="smalltbltext"><?php echo $lot2;?></td>
	<td width="131" align="center" class="smalltbltext"><?php echo $upss;?></td>
	<td width="90" align="center" class="smalltbltext"><?php echo $sloc;?></td>
	<td width="115" align="center" class="smalltbltext"><?php echo $nops;?></td>
	<td width="73" align="center" class="smalltbltext"><?php echo $nqty2;?></td>
	<td width="92" align="center" class="smalltbltext"><?php echo $barc;?></td>
</tr>
<?php
}
}
?>
</table>
</div><br />

<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading" colspan="2">Scan Barcode&nbsp;</td>
<td width="686" align="left"  valign="middle" class="smalltbltext" colspan="6">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)"  value="" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<?php
}
?>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /><input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" />
</div>
</div>
</div>