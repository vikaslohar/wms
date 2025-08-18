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
	$g = $_GET['g'];	 
	}
if(isset($_GET['h']))
	{
	$h = $_GET['h'];	 
	}
$lotno=$a;	
$sql_qcsub=mysqli_query($link,"SELECT orlot FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_crop='$b' and lotldg_variety='$c' and plantcode='$plantcode'");
$ttsub=mysqli_num_rows($sql_qcsub);
$sql_qcsub24=mysqli_query($link,"SELECT orlot FROM tbl_lot_ldg_pack WHERE orlot='".$lotno."' and lotldg_crop='$b' and lotldg_variety='$c' and plantcode='$plantcode'");
$ttsub24=mysqli_num_rows($sql_qcsub24);

$ttsub2=0;
if($f>0)
{
	$sql_qcsub2=mysqli_query($link,"SELECT cisub_lotno FROM tbl_cisub WHERE cisub_lotno='".$lotno."' and ci_id='$f' and plantcode='$plantcode'");
	$ttsub2=mysqli_num_rows($sql_qcsub2);
}

if($ttsub==0 && $ttsub24==0)
{
?>
<table align="center" width="850" cellpadding="0" cellspacing="0" border="1" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="tblsubtitle" >
<td valign="top" align="left">&nbsp;Lot Not Found in System</td>
</tr>
</table>	
<?php 
}	
else if($ttsub2>0)
{
?>
<table align="center" width="850" cellpadding="0" cellspacing="0" border="1" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="tblsubtitle" >
<td valign="top" align="left">&nbsp;Lot No. already posted in this transaction</td>
</tr>
</table>
<?php 
}	
else
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="3">Lot Details</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="73" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="70" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="70" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="65" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="80" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="90" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td width="80" align="center" valign="middle" class="tblheading">DoGR</td>
	<td width="222" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="80" align="center" valign="middle" class="tblheading">Status</td>
</tr>
<?php
$srno=1;
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups=""; $sqty=0; $slocs=""; $slocs2=""; $sts=""; $qc=""; $dot=""; $got=""; $dogr=""; $ac=0; $acn=0;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='Raw' and plantcode='$plantcode'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
if($tt_sub > 0)
{
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='Raw' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'  and lotldg_binid='".$row_qc_sub['lotldg_binid']."'  and lotldg_whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and plantcode='$plantcode'")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

	$trdate1=$row_month['lotldg_gottestdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$dogr=$trday."-".$trmonth."-".$tryear;	

$zzz=explode(" ", $row_month['lotldg_got1']);
//$zzz=explode(" ",$gggg[0]);
$got=$zzz[0]." ".$row_month['lotldg_got'];

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_qc_sub['lotldg_binid']."' and whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_qc_sub['lotldg_subbinid']."' and binid='".$row_qc_sub['lotldg_binid']."' and whid='".$row_qc_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_month['lotldg_balbags'];
$slqty=$row_month['lotldg_balqty'];

$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slqty>0)
{
if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}
$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
if($qty==0)$sts="Released";
if($qty>0)$sts="Availabe";

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' order by oldlot,tid desc limit 0,1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_tbl_sub1=mysqli_fetch_array($sql_arr_home);

	
	$trdate11=$row_tbl_sub1['testdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$dot=$trday."-".$trmonth."-".$tryear;	

$qc=$row_tbl_sub1['qcstatus'];
}
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading">Raw</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="tblheading"><?php if($dot=="00-00-0000")echo ""; else echo $dot;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td align="center" valign="middle" class="tblheading"><?php if($dogr=="00-00-0000")echo ""; else echo $dogr;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $sts;?></td>
</tr>
<?php
$srno=1; $conqty=0; $eslocs="";
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups=""; $sqty=0; $slocs=""; $slocs2=""; $sts=""; $qc=""; $dot=""; $got=""; $dogr=""; $ac=0; $acn=0;
$sql_qc_sub=mysqli_query($link,"SELECT distinct lotldg_subbinid FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='Condition' and plantcode='$plantcode'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
if($tt_sub > 0)
{
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE orlot='".$lotno."' and lotldg_sstage='Condition' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."' and plantcode='$plantcode'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and plantcode='$plantcode'")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

	$trdate1=$row_month['lotldg_gottestdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$dogr=$trday."-".$trmonth."-".$tryear;	

$zzz=explode(" ", $row_month['lotldg_got1']);
//$zzz=explode(" ",$gggg[0]);
$got=$zzz[0]." ".$row_month['lotldg_got'];

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$row_month['lotldg_balbags'];
$slqty=$row_month['lotldg_balqty'];

$conqty=$conqty+$slqty;

$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slqty>0)
{
if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;

if($eslocs!="")
$eslocs=$eslocs.",".$wareh.$binn.$subbinn;
else
$eslocs=$wareh.$binn.$subbinn;
}
$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}
$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
if($qty==0)$sts="Released";
if($qty>0)$sts="Availabe";

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' order by oldlot,tid desc limit 0,1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_tbl_sub1=mysqli_fetch_array($sql_arr_home);

	
	$trdate11=$row_tbl_sub1['testdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$dot=$trday."-".$trmonth."-".$tryear;	

$qc=$row_tbl_sub1['qcstatus'];
}

?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading">Condition</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?><input type="hidden" name="enob" value="<?php echo $ac;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?><input type="hidden" name="eqty" value="<?php echo $acn;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?><input type="hidden" name="eqc" value="<?php echo $qc;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php if($dot=="00-00-0000")echo ""; else echo $dot;?><input type="hidden" name="edot" value="<?php echo $dot;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $got;?><input type="hidden" name="egot" value="<?php echo $got;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php if($dogr=="00-00-0000")echo ""; else echo $dogr;?><input type="hidden" name="edogr" value="<?php echo $dogr;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?><input type="hidden" name="esloc" value="<?php echo $slocs;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $sts;?><input type="hidden" name="eqcsts" value="<?php echo $sts;?>" /></td>
</tr>
<?php
$srno=1;
$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups=""; $sqty=0; $slocs=""; $slocs2=""; $sts=""; $qc=""; $dot=""; $got=""; $dogr="";  $ac=0; $acn=0;
$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE orlot='".$lotno."' and plantcode='$plantcode'");
$tt_sub=mysqli_num_rows($sql_qc_sub);
if($tt_sub>0)
{
while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
{

$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE orlot='".$lotno."' and subbinid='".$row_qc_sub['subbinid']."'  and binid='".$row_qc_sub['binid']."'  and whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'");
$tt=mysqli_num_rows($sql_qc);
while($row_qc=mysqli_fetch_array($sql_qc))
{

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and plantcode='$plantcode'")or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_month);
while ($row_month=mysqli_fetch_array($sql_month))
{

	$trdate1=$row_month['lotldg_gottestdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$dogr=$trday."-".$trmonth."-".$tryear;	

$zzz=explode(" ", $row_month['lotldg_got1']);
//$zzz=explode(" ",$gggg[0]);
$got=$zzz[0]." ".$row_month['lotldg_got'];

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_qc_sub['binid']."' and whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_qc_sub['subbinid']."' and binid='".$row_qc_sub['binid']."' and whid='".$row_qc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
//$slups=$row_month['lotldg_balbags'];
$slqty=$row_month['balqty'];

/*$aq1=explode(".",$slups);
if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}*/

$an1=explode(".",$slqty);
if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
$slups=$ac1;
$slqty=$acn1;

if($slqty>0)
{
if($slocs!="")
$slocs=$slocs."<br />".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
$nob=$nob+$slups;
$qty=$qty+$slqty;
$srn++;
}
}
}
$aq=explode(".",$nob);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}

$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
if($qty==0)$sts="Released";
if($qty>0)$sts="Availabe";

$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where oldlot='$lotno' and plantcode='$plantcode' order by oldlot,tid desc limit 0,1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
$row_tbl_sub1=mysqli_fetch_array($sql_arr_home);

	
	$trdate11=$row_tbl_sub1['testdate'];
	$tryear=substr($trdate11,0,4);
	$trmonth=substr($trdate11,5,2);
	$trday=substr($trdate11,8,2);
	$dot=$trday."-".$trmonth."-".$tryear;	

$qc=$row_tbl_sub1['qcstatus'];
}
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="tblheading">Pack</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="tblheading"><?php if($dot=="00-00-0000")echo ""; else echo $dot;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
	<td align="center" valign="middle" class="tblheading"><?php if($dogr=="00-00-0000")echo ""; else echo $dogr;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $sts;?></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Form</td>
</tr>

<tr class="Dark" height="30" >
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="221" align="left" valign="middle" class="tbltext"  >&nbsp;Condition<input type="hidden" class="tbltext" name="txtstage" id="sstage" value="Condition" /></td>
<td width="140" align="right" valign="middle" class="tblheading">Qty&nbsp;</td>
<td width="280" align="left" valign="middle" class="tbltext" id="lotnshow">&nbsp;<input name="txtnewqty" type="text" size="10" class="tbltext" tabindex=""  maxlength="20"  value=""  >&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="hidden" name="txtconqty" value="<?php echo $conqty;?>" /></td>

</tr>	
<?php
if($conqty==0)
{
$zzz=implode(",", str_split($a));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where SUBSTRING(lotldg_lotno,1,13)='$abc' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where SUBSTRING(lotno,1,13)='$abc' and plantcode='$plantcode'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$abc20=sprintf("%02d",($abc2));
$abc23=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc23;
$abc25=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc20;

?>
 <tr class="Light" height="25">
            <td width="199" height="24"  align="right"  valign="middle" class="tblheading">Last Batch No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<input name="txtlotbatch" id="smt" type="text" class="tbltext" value="<?php echo $abc25;?>" style="background-color:#CCCCCC" readonly="true"  />&nbsp;</td>
		   <td width="140" align="right" valign="middle" class="tblheading">New Batch Number&nbsp;</td>
<td width="280" align="left" valign="middle" class="tbltext" id="lotnshow">&nbsp;<input name="txtnewlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $abc24;?>" readonly="true" style="background-color:#CCCCCC" >&nbsp;<input type="hidden" name="neworlot" value="<?php echo $abc24;?>" /></td>
 </tr>	
	<tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">Generate QC Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qc2"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 <td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqc" type="text" size="15" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="UT" maxlength="20"/></td>
</tr>
<?php
}
?>
</table><br />
	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td width="120" align="center" valign="middle" class="smalltblheading" >WH</td>
    <td width="149" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="242" align="center" valign="middle" class="smalltblheading">Subbin</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="164" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
<?php
if($conqty>0)
{ 
$eslocs=$eslocs.",";
$s=0;
$esl=explode(",",$eslocs);
foreach($esl as $slc)
{
if($slc<>"")
{
$sslc=explode("/",$slc);

$s++;
?>
  <tr class="Light" height="25">
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where perticulars='".$sslc[0]."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
$whid=$noticia_whd1['whid'];
?>
<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtslwhg<?php echo $s;?>" name="txtslwhg<?php echo $s;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$whid."' and binname='".$sslc[1]."' and plantcode='$plantcode' order by binname") or die(mysqli_error($link));
$t=mysqli_num_rows($bind1_query);
$noticia_bing1 = mysqli_fetch_array($bind1_query);
$binid=$noticia_bing1['binid'];
?>
<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $s;?>"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtslbing<?php echo $s;?>" id="txtslbing<?php echo $s;?>" value="<?php echo $noticia_bing1['binid'];?>" /></td>
<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where binid='".$binid."' and whid='".$whid."' and sname='".$sslc[2]."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	
<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $s;?>"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtslsubbg<?php echo $s;?>" id="txtslsubbg<?php echo $s;?>" value="<?php echo $noticia_subbing1['sid'];?>" /></td>

<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $s;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $s;?>" id="txtconslnob<?php echo $s;?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk<?php echo $s;?>(this.value,<?php echo $s;?>);" value=""  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $s;?>" id="txtconslqty<?php echo $s;?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk<?php echo $s;?>(this.value,<?php echo $s;?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
<?php
}
}
}
else
{
$s=1;
?>
  <tr class="Light" height="25">
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $s;?>" name="txtslwhg<?php echo $s;?>" style="width:70px;" onchange="wh1(this.value,<?php echo $s;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $s;?>"><select class="smalltbltext" name="txtslbing<?php echo $s;?>" style="width:60px;" onchange="bin<?php echo $s;?>(this.value,<?php echo $s;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $s;?>"><select class="smalltbltext" name="txtslsubbg<?php echo $s;?>" id="txtslsubbg<?php echo $s;?>" style="width:60px;" onchange="subbin<?php echo $s;?>(this.value,<?php echo $s;?>);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $s;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $s;?>" id="txtconslnob<?php echo $s;?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk<?php echo $s;?>(this.value,1);" value=""  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $s;?>" id="txtconslqty<?php echo $s;?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk<?php echo $s;?>(this.value,<?php echo $s;?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>

  <tr class="Light" height="25">
<?php
$s=2;
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $s;?>" name="txtslwhg<?php echo $s;?>" style="width:70px;" onchange="wh<?php echo $s;?>(this.value,<?php echo $s;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $s;?>"><select class="smalltbltext" name="txtslbing<?php echo $s;?>" style="width:60px;" onchange="bin<?php echo $s;?>(this.value,<?php echo $s;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>


<td align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $s;?>"><select class="smalltbltext" name="txtslsubbg<?php echo $s;?>" id="txtslsubbg<?php echo $s;?>" style="width:60px;" onchange="subbin<?php echo $s;?>(this.value,<?php echo $s;?>);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

	<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $s;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="txtconslnob<?php echo $s;?>" id="txtconslnob<?php echo $s;?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="8" onkeypress="return isNumberKey1(event)" onchange="qtychk<?php echo $s;?>(this.value,<?php echo $s;?>);" value=""  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtconslqty<?php echo $s;?>" id="txtconslqty<?php echo $s;?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="Bagschk<?php echo $s;?>(this.value,<?php echo $s;?>);"  onkeypress="return isNumberKey(event)"  value="" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
 </td> 
 
  </tr>
<?php
}
?>
 <input type="hidden" name="srn" value="<?php echo $s;?>" />
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>
<input type="hidden" name="maintrid" value="<?php echo $f;?>" /> <input type="hidden" name="subtrid" value="<?php echo $g;?>" />
