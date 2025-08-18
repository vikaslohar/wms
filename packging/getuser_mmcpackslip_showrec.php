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
    <td align="center" valign="middle" class="tblheading" >Lot Details</td>
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
$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."'  and balqty > 0") or die(mysqli_error($link));
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
$nop1=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
}
else
{
	$ptp=$packtp[0];
}
$ptp;
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}
if($nop1<$row_issuetbl['balnop'])$nop1=$row_issuetbl['balnop'];
$nob=$nob+$nop1; 
$qty=$qty+$row_issuetbl['balqty'];

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
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];

	if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
		$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
		//echo $row_softr_sub[0];
		$sql_softr=mysqli_query($link,"Select * from tbl_softr where  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
		$tot_softr=mysqli_num_rows($sql_softr);
		$row_softr=mysqli_fetch_array($sql_softr);
		if($tot_softr > 0)
		{
		$trdate=$row_softr['softr_date'];
		$trdate=explode("-",$trdate);
		$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
		
		$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
		if($tot_softr_sub2 > 0)
		{
		$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
		//echo $row_softr_sub2[0];
		$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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
$sno++;
?>
 <tr class="tblsubtitle" height="25">
    <td width="87" align="center" valign="middle" class="tblheading">#</td>
    <td width="165" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="169" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="143" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="112" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="117" align="center" valign="middle" class="tblheading">Balance Pouches</td>
  </tr>

  <tr class="Light" height="25">
  <td align="center" valign="middle" class="smalltbltext"><?php echo $sno?></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $a;?><input type="hidden" name="lotno_<?php echo $sno?>" id="lotno_<?php echo $sno?>" value="<?php echo $a?>" /> <input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $ups;?><input type="hidden" name="upssize_<?php echo $sno?>" id="upssize_<?php echo $sno?>" value="<?php echo $ups;?>" /><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $uom;?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $nob;?><input type="hidden" name="txtonob" id="nopc_<?php echo $sno;?>" value="<?php echo $nob;?>" /></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $qty;?><input type="hidden" name="txtoqty" id="packqty_<?php echo $sno?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" title="Maximum - <?php echo $mptnop?>" onkeypress="return isNumberKey1(event)" onchange="balnopcheck(this.value, <?php echo $sno?>)"/><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
</tr> 

<tr class="Light" height="25">
<td align="center" valign="middle" width="968" colspan="7">
<table align="center" border="1" width="968" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td width="86" align="center" valign="middle" class="tblheading">WH</td>
<td width="165" align="center" valign="middle" class="tblheading">Bin</td>
<td width="169" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="143" align="center" valign="middle" class="tblheading">Master Packs</td>
<td width="164" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="112" align="center" valign="middle" class="tblheading">NoP</td>
<td width="116" align="center" valign="middle" class="tblheading">Balance Pouches</td>
</tr>
<?php
$sno33=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."'  and balqty > 0") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
$sno33=$sno33+1; $nob=0; $qty=0; $qty1=0;
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$a."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
}
else
{
	$ptp=$packtp[0];
}
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}
if($nop1<$row_issuetbl['balnop'])$nop1=$row_issuetbl['balnop'];
$nob=$nop1; 
$qty=$row_issuetbl['balnomp'];
$qty1=$row_issuetbl['balqty'];
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

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) {  if($row_tbl_subsub3['whid']==$noticia_whd1['whid']) echo $noticia_whd1['perticulars']; } ?>
</td>
<?php

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub3['whid']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) {  if($row_tbl_subsub3['binid']==$noticia_bing1['binid']) echo $noticia_bing1['binname']; } ?>
</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub3['binid']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) {  if($row_tbl_subsub3['subbinid']==$noticia_subbing1['sid']) echo $noticia_subbing1['sname']; } ?><input type="hidden" name="exwh<?php echo $sno;?>_<?php echo $sno33;?>" id="exwh<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['whid'];?>" /><input type="hidden" name="exbin<?php echo $sno;?>_<?php echo $sno33;?>" id="exbin<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['binid']?>" /><input type="hidden" name="exsubbin<?php echo $sno;?>_<?php echo $sno33;?>" id="exsubbin<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['subbinid']?>" /></td>

<td align="center" valign="middle" class="tbltext"><?php echo $qty;?><input type="hidden" name="extnomphs<?php echo $sno;?>_<?php echo $sno33;?>" id="extnomphs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $qty;?>" /></td> 
<td align="center" valign="middle" class="tbltext"><?php echo $nob;?><input type="hidden" name="extnophs<?php echo $sno;?>_<?php echo $sno33;?>" id="extnophs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $nob;?>" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nophs<?php echo $sno;?>_<?php echo $sno33;?>" id="nophs<?php echo $sno;?>_<?php echo $sno33;?>" value="" size="7"  onchange="pacpchk(this.value,<?php echo $sno;?>,<?php echo $sno33;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="balnophs<?php echo $sno;?>_<?php echo $sno33;?>" id="balnophs<?php echo $sno;?>_<?php echo $sno33;?>" value="" size="7" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<?php
}
?>
<input type="hidden" name="sno33_<?php echo $sno;?>" id="sno33_<?php echo $sno;?>" value="<?php echo $sno33;?>" />
 </table>
 </td>
 </tr>
<?php
}
}
}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="1" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="extwh" value="<?php echo $extwh;?>" />
<input type="hidden" name="extbin" value="<?php echo $extbin?>" />
<input type="hidden" name="extsubbin" value="<?php echo $extsubbin?>" />

</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0" style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><br />
