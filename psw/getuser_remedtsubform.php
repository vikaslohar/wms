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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields



if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	
	/*if(isset($_GET['b']))
	{
	$tid = $_GET['b'];	 
	}	*/

$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_sub where plantcode='$plantcode' and pswremsub_id='".$a."'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row['pswrem_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];



$sql_issue=mysqli_query($link,"select distinct whid, binid, subbinid  from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop ='".$row['crop']."' and lotldg_variety='".$row['variety']."' and lotldg_sstage='Pack' and lotno='".$row['lotnumber']."'") or die(mysqli_error($link));
$tot_lot=mysqli_num_rows($sql_issue);
if($tot_lot > 0)
{
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row['crop']."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" name="txtcrop1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['cropname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtcrop" value="<?php echo $noticia['cropid'];?>" /></td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row['variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem" >&nbsp;<input type="text" name="txtvariety1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['popularname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtvariety" value="<?php echo $noticia['varietyid'];?>" /></td>
           </tr>
</table>		   
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
	<td width="20" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="120" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
	<td width="73" align="center" valign="middle" class="tblheading"rowspan="2" >UPS</td>
	<td width="104" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
	<td align="center" valign="middle" class="tblheading"  colspan="3">Actual Quantity</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Quantity Removed</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Balance Quantity</td>
</tr>
<tr class="tblsubtitle">
	<td width="60" align="center" valign="middle" class="tblheading" >NoP</td>
	<td width="65" align="center" valign="middle" class="tblheading" >NoMP</td>
	<td width="80" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="65" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="70" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="85" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="60" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="65" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="75" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $rtotalnop=0; $rtotalups=0; $rtotalqty=0; $cnt=0; 
$t=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'  and lotldg_crop ='".$row['crop']."' and lotldg_variety='".$row['variety']."' and lotldg_sstage='Pack' and lotno='".$row['lotnumber']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 and lotldg_alflg=0 and lotldg_dispflg!=1 and lotldg_rvflg=0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
  $cnt++;

 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0; $nob=""; $nomp=""; $qty=""; $baln="";  $balmp=""; $balq="";

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pswremsub_sub where plantcode='$plantcode' and pswremsub_id='".$a."' and pswrem_id='".$tid."' and subbinid='".$row_issue['subbinid']."'") or die(mysqli_error($link));
$row_subsub=mysqli_fetch_array($sql_tbl_subsub);

if($row_subsub['subbinid']==$row_issue['subbinid'])
{
$nob=$row_subsub['remnop'];
$nomp=$row_subsub['remnomp'];
$qty=$row_subsub['remqty'];
$baln=$row_subsub['balnop'];
$balmp=$row_subsub['balnomp'];
$balq=$row_subsub['balqty'];
}
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issue['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn;
else
$slocs=$wareh.$binn.$subbinn;

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
$nop2;

$bnmp=$row_issuetbl['balnomp'];
$bqty1=$row_issuetbl['balqty'];
$bnob=$bqty1*$ptp2;

$zz=str_split($row['lotnumber']);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='".$row['lotnumber']."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($row['lotnumber']==$lotarr[$i] && $ups==$upsarr)
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

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='".$row['variety']."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($row['lotnumber']==$lotarr[$i] && $ups==$upsarr)
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
			if($row['lotnumber']==$lotarr[$i] && $ups==$upsarr[$i])
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
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='".$row['lotnumber']."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($row['lotnumber']==$lotarr[$i] && $ups==$upsarr)
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

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='".$row['variety']."' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
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
			if($row['lotnumber']==$lotarr[$i] && $ups==$upsarr)
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
$avlqty=$row_issuetbl['balqty']-$totextqtys;
//$nop1=$bnob-$totextpouches;
if($bnmp>0)
$bnob=$bnob-$totextpouches;

//$nop1=$bnob;
//$avlqty=$nop1*$ptp1;
$nop1=$bnob;
if($packtp2[1]=="Gms")
$avlqty=$nop1*$ptp1;
else
$avlqty=$nop1/$ptp1;
//$nop1=$nop2-$totextpouches;

$rtotalnop=$rtotalnop+$nop1;
$rtotalups=$rtotalups+$nmp;
$rtotalqty=$rtotalqty+$row_issuetbl['balqty'];


if($srno%2!=0)
{
?>  
<tr class="Light" height="30">
	<td width="20" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno_<?php echo $srno;?>" id="txtlotno_<?php echo $srno;?>" type="text" size="18" class="tbltext"  maxlength="18" style="background-color:#CCCCCC" value="<?php echo $row['lotnumber'];?>"/></td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $upspacktype;?><input type="hidden" name="wtinmp_<?php echo $srno;?>" id="wtinmp_<?php echo $srno;?>" value="<?php echo $wtinmp;?>" /><input type="hidden" name="upspacktype_<?php echo $srno;?>" id="upspacktype_<?php echo $srno;?>" value="<?php echo $upspacktype;?>" /></td>
	<td width="104"  align="left" valign="middle" class="tbltext">&nbsp;
    <input name="sloc_<?php echo $srno;?>" id="sloc_<?php echo $srno;?>" type="text" size="13" class="tbltext" tabindex="" maxlength="13"  onkeypress="return isNumberKey(event)" value="<?php echo $slocs;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;<input type="hidden" name="wh_<?php echo $srno;?>" value="<?php echo $row_issue['whid'];?>" /><input type="hidden" name="bin_<?php echo $srno;?>" value="<?php echo $row_issue['binid'];?>" /><input type="hidden" name="sbin_<?php echo $srno;?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
	<td width="60"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp_<?php echo $srno;?>" id="txtdisp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php echo $nop1;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
	<td width="65"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtnomp_<?php echo $srno;?>" id="txtnomp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php if($nmp>0)echo $nmp; else echo "0";?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
	<td width="80" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtqty_<?php echo $srno;?>" id="txtqty_<?php echo $srno;?>" type="text" size="9" class="tbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $avlqty;?>"/>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp_<?php echo $srno;?>" id="txtrecbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)"  onchange="Bagschk1(this.value,'<?php echo $srno;?>');" value="<?php echo $nob;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecnomp_<?php echo $srno;?>" id="txtrecnomp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)"  onchange="nompchk1(this.value,'<?php echo $srno;?>');" value="<?php echo $nomp;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp_<?php echo $srno;?>" id="recqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value,'<?php echo $srno;?>');" style="background-color:#CCCCCC" readonly="true" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp_<?php echo $srno;?>" id="txtdbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $baln;?>" />  &nbsp; </td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdnomp_<?php echo $srno;?>" id="txtdnomp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $balmp;?>" />  &nbsp; </td>       
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp_<?php echo $srno;?>" id="txtdqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $balq;?>" /></td>
</tr>
 <?php
}
else
{
?>
<tr class="Light" height="30">
	<td width="20" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno_<?php echo $srno;?>" id="txtlotno_<?php echo $srno;?>" type="text" size="18" class="tbltext"  maxlength="18" style="background-color:#CCCCCC" value="<?php echo $row['lotnumber'];?>"/></td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $upspacktype;?><input type="hidden" name="wtinmp_<?php echo $srno;?>" id="wtinmp_<?php echo $srno;?>" value="<?php echo $wtinmp;?>" /><input type="hidden" name="upspacktype_<?php echo $srno;?>" id="upspacktype_<?php echo $srno;?>" value="<?php echo $upspacktype;?>" /></td>
	<td width="104"  align="left" valign="middle" class="tbltext">&nbsp;
    <input name="sloc_<?php echo $srno;?>" id="sloc_<?php echo $srno;?>" type="text" size="13" class="tbltext" tabindex="" maxlength="13"  onkeypress="return isNumberKey(event)" value="<?php echo $slocs;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;<input type="hidden" name="wh_<?php echo $srno;?>" value="<?php echo $row_issue['whid'];?>" /><input type="hidden" name="bin_<?php echo $srno;?>" value="<?php echo $row_issue['binid'];?>" /><input type="hidden" name="sbin_<?php echo $srno;?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
	<td width="60"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp_<?php echo $srno;?>" id="txtdisp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php echo $nop1;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
	<td width="65"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtnomp_<?php echo $srno;?>" id="txtnomp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php if($nmp>0)echo $nmp; else echo "0";?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
	<td width="80" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtqty_<?php echo $srno;?>" id="txtqty_<?php echo $srno;?>" type="text" size="9" class="tbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $avlqty;?>"/>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp_<?php echo $srno;?>" id="txtrecbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)"  onchange="Bagschk1(this.value,'<?php echo $srno;?>');" value="<?php echo $nob;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecnomp_<?php echo $srno;?>" id="txtrecnomp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)"  onchange="nompchk1(this.value,'<?php echo $srno;?>');" value="<?php echo $nomp;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp_<?php echo $srno;?>" id="recqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value,'<?php echo $srno;?>');" style="background-color:#CCCCCC" readonly="true" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp_<?php echo $srno;?>" id="txtdbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $baln;?>" />  &nbsp; </td>
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdnomp_<?php echo $srno;?>" id="txtdnomp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $balmp;?>" />  &nbsp; </td>       
	<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp_<?php echo $srno;?>" id="txtdqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $balq;?>" /></td>
</tr>


 <?php
}
$srno++;
}
}
?>
<input type="hidden" name="rtotalnop" value="<?php echo $rtotalnop;?>" />
<input type="hidden" name="rtotalups" value="<?php echo $rtotalups;?>" />
<input type="hidden" name="rtotalqty" value="<?php echo $rtotalqty;?>" />
</table>
<br />
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="srno1" value="<?php echo $cnt;?>" />
<?php } ?>