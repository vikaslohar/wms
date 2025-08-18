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

//frm_action=submit&plantcodes=D%2CH&yearcodes=A%2CD%2CF%2CK%2CN%2CS&foccode=&tcode=4&rcrefcode=DF00004&rcrfcode=4&barcode=HF030002981&delbarcode=&txtbctyp=Un-Identified&txtbarcode=HF030002981&txtpacktype=SMC&txtedop=23-04-2014&txtcrop1=43&txtvariety1=360&txtelotn1=HS00437%2F00915%2F01P&txteups1=250.000%20Gms&txtenop1=80&txteqty1=20&txteqc1=OK&smplno1=&txtedot1=05-04-2014&txtegerm1=84&txtemoist1=7.80&txtepp1=Acceptable&txtegottyp1=GOT-NR%20OK&txtedgot1=20-05-2014&txtedov1=04-01-2015&sloclnktyp=same&txtwhg=4&txtbin=156&txtsubb=3119&txtsloclnk=same&sbinflg=0&txtwhg=WH&txtbin=Bin&txtsubb=Subbin&srno=1&maintrid=0&subtrid=0
	
	if(isset($_GET['tcode'])) { $tcode = $_GET['tcode']; }
	if(isset($_GET['rcrfcode'])) { $rcrfcode = $_GET['rcrfcode']; }
	if(isset($_GET['rcrefcode'])) { $rcrefcode = $_GET['rcrefcode']; }
	if(isset($_GET['barcode'])) { $barcode = $_GET['barcode']; }
	if(isset($_GET['txtbctyp'])) { $txtbctyp = $_GET['txtbctyp']; }
	if(isset($_GET['txtpacktype'])) { $txtpacktype = $_GET['txtpacktype']; }
	if(isset($_GET['txtedop'])) { $txtedop = $_GET['txtedop']; }
	if(isset($_GET['srno'])) { $srno = $_GET['srno']; }
	if(isset($_GET['sloclnktyp'])) { $sloclnktyp = $_GET['sloclnktyp']; }
	
	if($sloclnktyp=="same")
	{
		if(isset($_GET['txtewhg'])) { $txtwhg = $_GET['txtewhg']; }
		if(isset($_GET['txtebin'])) { $txtbin= $_GET['txtebin']; }
		if(isset($_GET['txtesubb'])) { $txtsubb = $_GET['txtesubb']; }
	}
	else
	{
		if(isset($_GET['txtwhg'])) { $txtwhg = $_GET['txtwhg']; }
		if(isset($_GET['txtbin'])) { $txtbin= $_GET['txtbin']; }
		if(isset($_GET['txtsubb'])) { $txtsubb = $_GET['txtsubb']; }
	}
	if(isset($_GET['maintrid'])) { $z1 = $_GET['maintrid'];	}
	if(isset($_GET['subtrid'])) { $subtrid = $_GET['subtrid']; }
	
	$date=date("Y-m-d");
	
	$dop1=explode("-",$txtedop);
	$dop=$dop1[2]."-".$dop1[1]."-".$dop1[0];
	
for($i=1; $i<=$srno; $i++)
{
$crps="txtcrop".$i;
$vers="txtvariety".$i;
$txtlotn="txtelotn".$i;
if(isset($_GET[$crps])) { $crps1 = $_GET[$crps];	}
if(isset($_GET[$vers])) { $vers1 = $_GET[$vers]; }
if(isset($_GET[$txtlotn])) { $txtlotn1 = $_GET[$txtlotn]; }
}
if($z1 == 0)
{
  $sql_main="insert into tbl_srbtslmain (btsl_yearcode, btsl_trtyp, btsl_tcode, btsl_date, btsl_logid, btsl_trefno, btsl_trrefno, plantcode)values('$yearid_id', 'Recall', '$tcode', '$date', '$logid', '$rcrfcode', '$rcrefcode', '$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tbl_srbtslsub (btsl_id, btslsub_barcode, btslsub_bctype, btslsub_crop, btslsub_variety, btslsub_bartype, btslsub_lotno, plantcode) values('$mainid', '$barcode', '$txtbctyp', '$crps1', '$vers1', '$txtpacktype', '$txtlotn1', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($txtbctyp=="Identified")
{
for($i=1; $i<=$srno; $i++)
{
$txtlot="txtelotn".$i;
$crp="txtcrop".$i;
$ver="txtvariety".$i;
$ups1="txteups".$i;
$nop1="txtenop".$i;
$qty1="txteqty".$i;
$qc1="txteqc".$i;
$sampleno1="smplno".$i;
$dot1="txtedot".$i;
$gemp1="txtegerm".$i;
$moist1="txtemoist".$i;
$pp1="txtepp".$i;
$got1="txtegottyp".$i;
$dgot1="txtedgot".$i;
$dov1="txtedov".$i;

if(isset($_GET[$txtlot])) { $lotno = $_GET[$txtlot]; }
if(isset($_GET[$crp])) { $crp1 = $_GET[$crp];	}
if(isset($_GET[$ver])) { $ver1 = $_GET[$ver]; }
if(isset($_GET[$ups1])) { $ups = $_GET[$ups1]; }
if(isset($_GET[$nop1])) { $nop = $_GET[$nop1]; }
if(isset($_GET[$qty1])) { $qty = $_GET[$qty1]; }
if(isset($_GET[$qc1])) { $qc = $_GET[$qc1]; }
if(isset($_GET[$sampleno1])) { $sampleno = $_GET[$sampleno1]; }
if(isset($_GET[$dot1])) { $dot2 = $_GET[$dot1]; }
if(isset($_GET[$gemp1])) { $gemp = $_GET[$gemp1]; }
if(isset($_GET[$moist1])) { $moist = $_GET[$moist1]; }
if(isset($_GET[$pp1])) { $pp = $_GET[$pp1]; }
if(isset($_GET[$got1])) { $got2 = $_GET[$got1]; }
if(isset($_GET[$dgot1])) { $dgot2 = $_GET[$dgot1]; }
if(isset($_GET[$dov1])) { $dov2 = $_GET[$dov1]; }

$dot1=explode("-",$dot2);
$dgot1=explode("-",$dgot2);
$dov1=explode("-",$dov2);
$gottyp1=explode(" ",$got2);
$gottyp=$gottyp1[0];
$got=$gottyp1[1];

$dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
$dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

$sql_sub_sub="insert into tbl_srbtslsub_sub (btsl_id, btslsub_id, btslss_wh, btslss_bin, btslss_subbin, btslss_lotno, btslss_ups, btslss_qtympt, btslss_nopmpt, btslss_qcstatus, btslss_dot, btslss_gottype, btslss_gotstatus, btslss_dogt, btslss_gemp, btslss_moist, btslss_pp, btslss_dop, btslss_dov, plantcode) values('$mainid', '$subid', '$txtwhg', '$txtbin', '$txtsubb', '$lotno', '$ups', '$qty', '$nop', '$qc', '$dot', '$gottyp', '$got', '$dgot', '$gemp', '$moist', '$pp', '$dop', '$dov', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
}
else
{
for($i=1; $i<=$srno; $i++)
{
$txtlot="txtelotn".$i;
$crp="txtcrop".$i;
$ver="txtvariety".$i;
$ups1="txteups".$i;
$nop1="txtenop".$i;
$qty1="txteqty".$i;
$qc1="txteqc".$i;
$sampleno1="smplno".$i;
$dot1="txtedot".$i;
$gemp1="txtegerm".$i;
$moist1="txtemoist".$i;
$pp1="txtepp".$i;
$got1="txtegottyp".$i;
$dgot1="txtedgot".$i;
$dov1="txtedov".$i;

if(isset($_GET[$txtlot])) { $lotno = $_GET[$txtlot]; }
if(isset($_GET[$crp])) { $crp1 = $_GET[$crp];	}
if(isset($_GET[$ver])) { $ver1 = $_GET[$ver]; }
if(isset($_GET[$ups1])) { $ups = $_GET[$ups1]; }
if(isset($_GET[$nop1])) { $nop = $_GET[$nop1]; }
if(isset($_GET[$qty1])) { $qty = $_GET[$qty1]; }
if(isset($_GET[$qc1])) { $qc = $_GET[$qc1]; }
if(isset($_GET[$sampleno1])) { $sampleno = $_GET[$sampleno1]; }
if(isset($_GET[$dot1])) { $dot2 = $_GET[$dot1]; }
if(isset($_GET[$gemp1])) { $gemp = $_GET[$gemp1]; }
if(isset($_GET[$moist1])) { $moist = $_GET[$moist1]; }
if(isset($_GET[$pp1])) { $pp = $_GET[$pp1]; }
if(isset($_GET[$got1])) { $got2 = $_GET[$got1]; }
if(isset($_GET[$dgot1])) { $dgot2 = $_GET[$dgot1]; }
if(isset($_GET[$dov1])) { $dov2 = $_GET[$dov1]; }

$dot1=explode("-",$dot2);
$dgot1=explode("-",$dgot2);
$dov1=explode("-",$dov2);
$gottyp1=explode(" ",$got2);
$gottyp=$gottyp1[0];
$got=$gottyp1[1];

$dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
$dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

$sql_sub_sub="insert into tbl_srbtslsub_sub2 (btsl_id, btslsub_id, btslss_wh, btslss_bin, btslss_subbin, btslss_lotno, btslss_ups, btslss_qtympt, btslss_nopmpt, btslss_qcstatus, btslss_dot, btslss_gottype, btslss_gotstatus, btslss_dogt, btslss_gemp, btslss_moist, btslss_pp, btslss_dop, btslss_dov, plantcode) values('$mainid', '$subid', '$txtwhg', '$txtbin', '$txtsubb', '$lotno', '$ups', '$qty', '$nop', '$qc', '$dot', '$gottyp', '$got', '$dgot', '$gemp', '$moist', '$pp', '$dop', '$dov', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
}

}
}
$z1=$mainid;
}
else
{

/*$sql_main="update tbl_srbtslmain set salesr_yearcode='$yearid_id', salesr_trtype='Opening Stock Condition', salesr_tcode='$txtid', salesr_date='$date', salesr_logid='$logid'  where salesr_id = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{*/
$mainid=$z1;

$sql_sub="insert into tbl_srbtslsub (btsl_id, btslsub_barcode, btslsub_bctype, btslsub_crop, btslsub_variety, btslsub_bartype, btslsub_lotno, plantcode) values('$mainid', '$barcode', '$txtbctyp', '$crps1', '$vers1', '$txtpacktype', '$txtlotn1', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($txtbctyp=="Identified")
{
for($i=1; $i<=$srno; $i++)
{
$txtlot="txtelotn".$i;
$crp="txtcrop".$i;
$ver="txtvariety".$i;
$ups1="txteups".$i;
$nop1="txtenop".$i;
$qty1="txteqty".$i;
$qc1="txteqc".$i;
$sampleno1="smplno".$i;
$dot1="txtedot".$i;
$gemp1="txtegerm".$i;
$moist1="txtemoist".$i;
$pp1="txtepp".$i;
$got1="txtegottyp".$i;
$dgot1="txtedgot".$i;
$dov1="txtedov".$i;

if(isset($_GET[$txtlot])) { $lotno = $_GET[$txtlot]; }
if(isset($_GET[$crp])) { $crp1 = $_GET[$crp];	}
if(isset($_GET[$ver])) { $ver1 = $_GET[$ver]; }
if(isset($_GET[$ups1])) { $ups = $_GET[$ups1]; }
if(isset($_GET[$nop1])) { $nop = $_GET[$nop1]; }
if(isset($_GET[$qty1])) { $qty = $_GET[$qty1]; }
if(isset($_GET[$qc1])) { $qc = $_GET[$qc1]; }
if(isset($_GET[$sampleno1])) { $sampleno = $_GET[$sampleno1]; }
if(isset($_GET[$dot1])) { $dot2 = $_GET[$dot1]; }
if(isset($_GET[$gemp1])) { $gemp = $_GET[$gemp1]; }
if(isset($_GET[$moist1])) { $moist = $_GET[$moist1]; }
if(isset($_GET[$pp1])) { $pp = $_GET[$pp1]; }
if(isset($_GET[$got1])) { $got2 = $_GET[$got1]; }
if(isset($_GET[$dgot1])) { $dgot2 = $_GET[$dgot1]; }
if(isset($_GET[$dov1])) { $dov2 = $_GET[$dov1]; }

$dot1=explode("-",$dot2);
$dgot1=explode("-",$dgot2);
$dov1=explode("-",$dov2);
$gottyp1=explode(" ",$got2);
$gottyp=$gottyp1[0];
$got=$gottyp1[1];

$dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
$dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

$sql_sub_sub="insert into tbl_srbtslsub_sub (btsl_id, btslsub_id, btslss_wh, btslss_bin, btslss_subbin, btslss_lotno, btslss_ups, btslss_qtympt, btslss_nopmpt, btslss_qcstatus, btslss_dot, btslss_gottype, btslss_gotstatus, btslss_dogt, btslss_gemp, btslss_moist, btslss_pp, btslss_dop, btslss_dov, plantcode) values('$mainid', '$subid', '$txtwhg', '$txtbin', '$txtsubb', '$lotno', '$ups', '$qty', '$nop', '$qc', '$dot', '$gottyp', '$got', '$dgot', '$gemp', '$moist', '$pp', '$dop', '$dov', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
}
else
{
for($i=1; $i<=$srno; $i++)
{
$txtlot="txtelotn".$i;
$crp="txtcrop".$i;
$ver="txtvariety".$i;
$ups1="txteups".$i;
$nop1="txtenop".$i;
$qty1="txteqty".$i;
$qc1="txteqc".$i;
$sampleno1="smplno".$i;
$dot1="txtedot".$i;
$gemp1="txtegerm".$i;
$moist1="txtemoist".$i;
$pp1="txtepp".$i;
$got1="txtegottyp".$i;
$dgot1="txtedgot".$i;
$dov1="txtedov".$i;

if(isset($_GET[$txtlot])) { $lotno = $_GET[$txtlot]; }
if(isset($_GET[$crp])) { $crp1 = $_GET[$crp];	}
if(isset($_GET[$ver])) { $ver1 = $_GET[$ver]; }
if(isset($_GET[$ups1])) { $ups = $_GET[$ups1]; }
if(isset($_GET[$nop1])) { $nop = $_GET[$nop1]; }
if(isset($_GET[$qty1])) { $qty = $_GET[$qty1]; }
if(isset($_GET[$qc1])) { $qc = $_GET[$qc1]; }
if(isset($_GET[$sampleno1])) { $sampleno = $_GET[$sampleno1]; }
if(isset($_GET[$dot1])) { $dot2 = $_GET[$dot1]; }
if(isset($_GET[$gemp1])) { $gemp = $_GET[$gemp1]; }
if(isset($_GET[$moist1])) { $moist = $_GET[$moist1]; }
if(isset($_GET[$pp1])) { $pp = $_GET[$pp1]; }
if(isset($_GET[$got1])) { $got2 = $_GET[$got1]; }
if(isset($_GET[$dgot1])) { $dgot2 = $_GET[$dgot1]; }
if(isset($_GET[$dov1])) { $dov2 = $_GET[$dov1]; }

$dot1=explode("-",$dot2);
$dgot1=explode("-",$dgot2);
$dov1=explode("-",$dov2);
$gottyp1=explode(" ",$got2);
$gottyp=$gottyp1[0];
$got=$gottyp1[1];

$dot=$dot1[2]."-".$dot1[1]."-".$dot1[0];
$dgot=$dgot1[2]."-".$dgot1[1]."-".$dgot1[0];
$dov=$dov1[2]."-".$dov1[1]."-".$dov1[0];

$sql_sub_sub="insert into tbl_srbtslsub_sub2 (btsl_id, btslsub_id, btslss_wh, btslss_bin, btslss_subbin, btslss_lotno, btslss_ups, btslss_qtympt, btslss_nopmpt, btslss_qcstatus, btslss_dot, btslss_gottype, btslss_gotstatus, btslss_dogt, btslss_gemp, btslss_moist, btslss_pp, btslss_dop, btslss_dov, plantcode) values('$mainid', '$subid', '$txtwhg', '$txtbin', '$txtsubb', '$lotno', '$ups', '$qty', '$nop', '$qc', '$dot', '$gottyp', '$got', '$dgot', '$gemp', '$moist', '$pp', '$dop', '$dov', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
}

}
} 
//}
?>
<?php
$tid=$z1;
$subtid=0;
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode1(this.value)" /></td>
</tr>
</table><br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Delete Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="delbarcode" id="txtbarcoddel" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode24(this.value)" /></td>
</tr>
</table><br />


<div id="showcvdet"></div>
<br />
<table align="center" height="25" width="950"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="7">SLOC Details - Identified Barcodes</td>
  </tr>	
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">WH</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Sub-Bin</td>
    <td width="23%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="28%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="12%" align="center" valign="middle" class="smalltblheading">No. of Barcode(s)</td>
</tr>
<?php
$sno1=1; $nobrc=0; $nobcd="";
 $sql_identfy1=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
 $tot_identfy1=mysqli_num_rows($sql_identfy1);
 if($tot_identfy1 > 0)
 {
 while($row_identfy1=mysqli_fetch_array($sql_identfy1))
 {
 	if($isbn!="")
	$isbn=$isbn.",".$row_identfy1['btslss_subbin'];
	else
	$isbn=$row_identfy1['btslss_subbin'];

 $sql_identfy2=mysqli_query($link,"select max(btslss_id) from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."'") or die(mysqli_error($link));
 $tot_identfy2=mysqli_num_rows($sql_identfy2);
 $row_identfy2=mysqli_fetch_array($sql_identfy2);

	
 $sql_identfy=mysqli_query($link,"select *  from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_id='".$row_identfy2[0]."'") or die(mysqli_error($link));
 $tot_identfy=mysqli_num_rows($sql_identfy);
 while($row_identfy=mysqli_fetch_array($sql_identfy))
 {
 $ssid=$row_identfy['btslsub_id'];
 
 $sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_identfy['btslss_bin']."' and plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_identfy['btslss_subbin']."' and binid='".$row_identfy['btslss_bin']."' and whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sql_sub=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_id='".$row_identfy['btslsub_id']."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_sub['btslsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crp=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_sub['btslsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$ver=$noticia_item['popularname'];

$sql_identfy24=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."' and btsl_id='$tid'") or die(mysqli_error($link));
$nobrc=mysqli_num_rows($sql_identfy24);
while($rowbarcsub=mysqli_fetch_array($sql_identfy24))
{
	$brcod=$rowbarcsub['btslsub_barcode'];
	if($nobcd!="")
	$nobcd=$nobcd.",".$brcod;
	else
	$nobcd=$brcod;
}
?> 	
<tr>
	<td width="4%" align="center"  valign="middle" class="smalltbltext" ><?php echo $sno1?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $wareh?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $binn?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $subbinn?></td>
	<td width="23%" align="center"  valign="middle" class="smalltbltext" ><?php echo $crp?></td>
	<td width="28%" align="center"  valign="middle" class="smalltbltext" ><?php echo $ver?></td>
	<td width="12%" align="center"  valign="middle" class="smalltbltext" title="<?php echo $nobcd;?>" ><?php echo $nobrc?></td>
</tr>
<?php
}
}
}
?>
</table><br />

<table align="center" height="25" width="950"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="7">SLOC Details - Un-Identified Barcodes</td>
  </tr>	
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">WH</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Sub-Bin</td>
    <td width="23%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="28%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="12%" align="center" valign="middle" class="smalltblheading">No. of Barcode(s)</td>
</tr>	
<?php
$sno2=1; $nobrc=0; $nobcd="";
 $sql_identfy1=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
 $tot_identfy1=mysqli_num_rows($sql_identfy1);
 if($tot_identfy1 > 0)
 {
 while($row_identfy1=mysqli_fetch_array($sql_identfy1))
 {
 	if($isbn!="")
	$isbn=$isbn.",".$row_identfy1['btslss_subbin'];
	else
	$isbn=$row_identfy1['btslss_subbin'];

 $sql_identfy2=mysqli_query($link,"select max(btslss_id) from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."'") or die(mysqli_error($link));
 $tot_identfy2=mysqli_num_rows($sql_identfy2);
 $row_identfy2=mysqli_fetch_array($sql_identfy2);

	
 $sql_identfy=mysqli_query($link,"select *  from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_id='".$row_identfy2[0]."'") or die(mysqli_error($link));
 $tot_identfy=mysqli_num_rows($sql_identfy);
 while($row_identfy=mysqli_fetch_array($sql_identfy))
 {
 $ssid=$row_identfy['btslsub_id'];
 
 $sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_identfy['btslss_bin']."' and plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_identfy['btslss_subbin']."' and binid='".$row_identfy['btslss_bin']."' and whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sql_sub=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_id='".$row_identfy['btslsub_id']."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_sub['btslsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crp=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_sub['btslsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$ver=$noticia_item['popularname'];

$sql_identfy24=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."' and btsl_id='$tid'") or die(mysqli_error($link));
$nobrc=mysqli_num_rows($sql_identfy24);
while($rowbarcsub=mysqli_fetch_array($sql_identfy24))
{
	$brcod=$rowbarcsub['btslsub_barcode'];
	if($nobcd!="")
	$nobcd=$nobcd.",".$brcod;
	else
	$nobcd=$brcod;
}
?> 	
<tr>
	<td width="4%" align="center"  valign="middle" class="smalltbltext" ><?php echo $sno2?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $wareh?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $binn?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $subbinn?></td>
	<td width="23%" align="center"  valign="middle" class="smalltbltext" ><?php echo $crp?></td>
	<td width="28%" align="center"  valign="middle" class="smalltbltext" ><?php echo $ver?></td>
	<td width="12%" align="center"  valign="middle" class="smalltbltext" title="<?php echo $nobcd;?>" ><?php echo $nobrc?></td>
</tr>
<?php
}
}
}
?>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
