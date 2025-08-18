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
	
	//frm_action=submit&txtid=4&date=27-08-2013&dopc=27-08-2013&txtpsrn=gfdh&txtcrop=28&txtvariety=15&txtstage=Pack&itmdchk=0&txtlot1=DA02911%2F00000%2F01P&maintrid=0&subtrid=0&softstatus=&upssize=10.000%20Gms&wtnopkg_1=0.010&upsname_1=10.000%20Gms&txtonob=31000&txtoqty=310&nomp_1=2&wtmp_1=6&wtnop_1=600&noofpacks_1=29800&nowb_1=&sno=1&detmpbno=2&upsidno=&nopks=29800&singlebar=&rangebar=&mobar=&txtwhg1=1&txtbing1=22&txtsubbg1=439&existview1=&nopmpcs_1=2&noppchs_1=29800&noptpchs_1=31000&noptqtys_1=310&txtwhg2=WH&txtbing2=Bin&txtsubbg2=Subbin&existview2=&nopmpcs_2=&noppchs_2=&noptpchs_2=&noptqtys_2=&txtwhg3=WH&txtbing3=Bin&txtsubbg3=Subbin&existview3=&nopmpcs_3=&noppchs_3=&noptpchs_3=&noptqtys_3=&txtwhg4=WH&txtbing4=Bin&txtsubbg4=Subbin&existview4=&nopmpcs_4=&noppchs_4=&noptpchs_4=&noptqtys_4=&txtwhg5=WH&txtbing5=Bin&txtsubbg5=Subbin&existview5=&nopmpcs_5=&noppchs_5=&noptpchs_5=&noptqtys_5=&txtwhg6=WH&txtbing6=Bin&txtsubbg6=Subbin&existview6=&nopmpcs_6=&noppchs_6=&noptpchs_6=&noptqtys_6=&txtwhg7=WH&txtbing7=Bin&txtsubbg7=Subbin&existview7=&nopmpcs_7=&noppchs_7=&noptpchs_7=&noptqtys_7=&txtwhg8=WH&txtbing8=Bin&txtsubbg8=Subbin&existview8=&nopmpcs_8=&noppchs_8=&noptpchs_8=&noptqtys_8=&txtremarks=fdgh

if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
if(isset($_GET['date'])) { $date = $_GET['date']; }
if(isset($_GET['dopc'])) { $dopc = $_GET['dopc']; }
if(isset($_GET['txtpsrn'])) { $txtpsrn= $_GET['txtpsrn']; }
if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop'];	}
if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }
if(isset($_GET['txtstage'])) { $txtstage = $_GET['txtstage']; }
if(isset($_GET['txtlot1'])) { $txtlot1 = $_GET['txtlot1']; }
if(isset($_GET['softstatus'])) { $softstatus = $_GET['softstatus']; }

if(isset($_GET['upssize'])) { $upssize = $_GET['upssize']; }
if(isset($_GET['wtnopkg_1'])) { $wtnopkg_1 = $_GET['wtnopkg_1']; }
if(isset($_GET['txtonop'])) { $txtonob = $_GET['txtonop']; }
if(isset($_GET['txtoqty'])) { $txtoqty = $_GET['txtoqty']; }
if(isset($_GET['nomp_1'])) { $nomp_1 = $_GET['nomp_1']; }
if(isset($_GET['wtmp_1'])) { $wtmp_1 = $_GET['wtmp_1']; }
if(isset($_GET['wtnop_1'])) { $wtnop_1 = $_GET['wtnop_1']; }
if(isset($_GET['noofpacks_1'])) { $noofpacks_1 = $_GET['noofpacks_1']; }
if(isset($_GET['nowb_1'])) { $nowb_1 = $_GET['nowb_1']; }
if(isset($_GET['detmpbno'])) { $detmpbno = $_GET['detmpbno']; }
if(isset($_GET['upsidno'])) { $upsidno = $_GET['upsidno']; }
if(isset($_GET['nopks'])) { $nopks = $_GET['nopks']; }
if(isset($_GET['sno'])) { $sno= $_GET['sno']; }
if(isset($_GET['sno3'])) { $sno3= $_GET['sno3']; }
if(isset($_GET['txtremarks'])) { $txtremarks= $_GET['txtremarks']; }
if(isset($_GET['slocssyncs24'])) { $slocssyncs24= $_GET['slocssyncs24']; }
	
if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }
	
$ttype="NMC";
$zz=str_split($txtlot1);
$orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
	
	$z1=$maintrid;
		
	$tdate11=explode("-",$date);
	$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
		
	$tdate12=explode("-",$dopc);
	$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];

if($z1 == 0)
{
   	$sql_main="insert into tbl_packaging (packaging_type, packaging_tdate, packaging_code,  packaging_date, packaging_slipno, packaging_remarks, packaging_yearid, packaging_logid, plantcode) values ('$ttype', '$tdate1', '$txtid', '$tdate2', '$txtpsrn', '$txtremarks', '$yearid_id', '$logid', '$plantcode')";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);
		
		$sql_sub="insert into tbl_packaging_sub (packaging_id, packagingsub_crop, packagingsub_variety, plantcode) values ('$mainid', '$txtcrop', '$txtvariety', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$suid=mysqli_insert_id($link);
			
			$sql_subsub="insert into tbl_packagingsub_sub (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_extnop, packagingsubsub_extqty, packagingsubsub_nomp, packagingsubsub_balpch, packagingsubsub_barcodes, packagingsubsub_remarks, packagingsubsub_sltyp, packagingsubsub_wtmp, packagingsubsub_wtnop, plantcode) values ('$suid', '$mainid', '$txtlot1', '$upssize', '$txtonob', '$txtoqty', '$nomp_1', '$noofpacks_1', '$detmpbno', '$txtremarks', '$slocssyncs24', '$wtmp_1', '$wtnop_1', '$plantcode')";
			mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
		
			for($j=1; $j<=$sno3; $j++)
			{
				$txtwhgx="txtwhg".$j;
				$txtbingx="txtbing".$j;
				$txtsubbgx="txtsubbg".$j;
				$existviewx="existview".$j;
				$nopmpcsx="nopmpcs_".$j;
				$noppchsx="noppchs_".$j;
				$noptpchsx="noptpchs_".$j;
				$noptqtysx="noptqtys_".$j;
				if(isset($_GET[$txtwhgx])) { $txtwhg= $_GET[$txtwhgx]; }
				if(isset($_GET[$txtbingx])) { $txtbing= $_GET[$txtbingx]; }
				if(isset($_GET[$txtsubbgx])) { $txtsubbg= $_GET[$txtsubbgx]; }
				if(isset($_GET[$existviewx])) { $existview= $_GET[$existviewx]; }
				if(isset($_GET[$nopmpcsx])) { $nopmpcs= $_GET[$nopmpcsx]; }
				if(isset($_GET[$noppchsx])) { $noppchs= $_GET[$noppchsx]; }
				if(isset($_GET[$noptpchsx])) { $noptpchs= $_GET[$noptpchsx]; }
				if(isset($_GET[$noptqtysx])) { $noptqtys= $_GET[$noptqtysx]; }
				if($noptqtys!="" || $noptqtys>0)
				{
				$sql_subsub4="insert into tbl_packagingsub_sub2 (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_wh, packagingsubsub_bin, packagingsubsub_subbin, packagingsubsub_nomp, packagingsubsub_nopch, packagingsubsub_totpch, packagingsubsub_totqty, plantcode) values ('$suid', '$mainid', '$txtlot1', '$upssize', '$txtwhg', '$txtbing', '$txtsubbg', '$nopmpcs', '$noppchs', '$noptpchs', '$noptqtys', '$plantcode')";
				mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
				}
			}
			$sql_barcode="update tbl_barcodestmp set bar_tid='$mainid', bar_subid='$suid' where bar_lotno='$txtlot1' and bar_logid='$logid' and bar_psrn='$txtpsrn'";
			mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
		}
	}
 $z1=$mainid;
}
else
{
/*$sql_main="update tbl_drying set  dryingdate='$tdate1',crop='$o',variety='$p',stage='RSW'  where trid='$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{*/
$mainid=$z1;
$sql_sub="update tbl_packaging_sub set packagingsub_crop='$txtcrop', packagingsub_variety='$txtvariety' where packaging_id='$mainid' and packagingsub_id='".$subtrid."'";

if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
	$suid=$subtrid;
	$s_sub="delete from tbl_packagingsub_sub where packagingsub_id='".$subtrid."' and packaging_id='".$mainid."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$sql_subsub="insert into tbl_packagingsub_sub (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_extnop, packagingsubsub_extqty, packagingsubsub_nomp, packagingsubsub_balpch, packagingsubsub_barcodes, packagingsubsub_remarks, packagingsubsub_sltyp, packagingsubsub_wtmp, packagingsubsub_wtnop, plantcode) values ('$suid', '$mainid', '$txtlot1', '$upssize', '$txtonob', '$txtoqty', '$nomp_1', '$noofpacks_1', '$detmpbno', '$txtremarks', '$slocssyncs24', '$wtmp_1', '$wtnop_1', '$plantcode')";
	mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
	
	$s_sub3="delete from tbl_packagingsub_sub2 where packagingsub_id='".$subtrid."' and packaging_id='".$mainid."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));
	for($j=1; $j<=$sno3; $j++)
	{
		$txtwhgx="txtwhg".$j;
		$txtbingx="txtbing".$j;
		$txtsubbgx="txtsubbg".$j;
		$existviewx="existview".$j;
		$nopmpcsx="nopmpcs_".$j;
		$noppchsx="noppchs_".$j;
		$noptpchsx="noptpchs_".$j;
		$noptqtysx="noptqtys_".$j;
		if(isset($_GET[$txtwhgx])) { $txtwhg= $_GET[$txtwhgx]; }
		if(isset($_GET[$txtbingx])) { $txtbing= $_GET[$txtbingx]; }
		if(isset($_GET[$txtsubbgx])) { $txtsubbg= $_GET[$txtsubbgx]; }
		if(isset($_GET[$existviewx])) { $existview= $_GET[$existviewx]; }
		if(isset($_GET[$nopmpcsx])) { $nopmpcs= $_GET[$nopmpcsx]; }
		if(isset($_GET[$noppchsx])) { $noppchs= $_GET[$noppchsx]; }
		if(isset($_GET[$noptpchsx])) { $noptpchs= $_GET[$noptpchsx]; }
		if(isset($_GET[$noptqtysx])) { $noptqtys= $_GET[$noptqtysx]; }
		if($noptqtys!="" || $noptqtys>0)
		{
			$sql_subsub4="insert into tbl_packagingsub_sub2 (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_wh, packagingsubsub_bin, packagingsubsub_subbin, packagingsubsub_nomp, packagingsubsub_nopch, packagingsubsub_totpch, packagingsubsub_totqty, plantcode) values ('$suid', '$mainid', '$txtlot1', '$upssize', '$txtwhg', '$txtbing', '$txtsubbg', '$nopmpcs', '$noppchs', '$noptpchs', '$noptqtys', '$plantcode')";
			mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
		}
	}
	$sql_barcode="update tbl_barcodestmp set bar_tid='$mainid', bar_subid='$suid' where bar_lotno='$txtlot1' and bar_logid='$logid' and bar_psrn='$txtpsrn'";
	mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
}
}
?>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<?php  
$tid=$z1;

	$sql_tbl=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	
	$tot=mysqli_num_rows($sql_tbl);		
	$arrival_id=$row_tbl['packaging_id'];

	$tdate=$row_tbl['packaging_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['packaging_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$sql_tblsub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
$subtid=0;
?>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Packaging Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="25%"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>

<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['packaging_slipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tblsub['packagingsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="25%" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tblsub['packagingsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="25%" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
</tr>	
<input type="hidden" name="txtstage" value="Pack" />
</table>
<br />

<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="1%" rowspan="2" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" rowspan="2" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="9%" rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="11%" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of MP</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td align="center" valign="middle" class="smalltblheading">PSW SLOC</td>
	<td width="8%" rowspan="2" align="center" valign="middle" class="smalltblheading">Remarks</td>
	<td width="3%" rowspan="2" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" rowspan="2" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>
<tr class="tblsubtitle">
	<td width="262" align="center" valign="middle" class="smalltblheading">SLOC | MP | Loose Pchs | Total Pchs | Total Qty</td>
</tr>  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
//$arrival_id=$row_tbl_sub['trid'];
$lotno=""; $exqty=""; $expch=""; $upss=""; $nomps=""; $nopchs=""; $blpch=""; $nobarc="";
$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{
$lotno=$row_tbl_subsub2['packagingsubsub_lotno']; 
$exqty=$row_tbl_subsub2['packagingsubsub_extqty']; 
$expch=$row_tbl_subsub2['packagingsubsub_extnop']; 
$upss=$row_tbl_subsub2['packagingsubsub_upssize']; 
$nomps=$row_tbl_subsub2['packagingsubsub_nomp']; 
$remarks=$row_tbl_subsub2['packagingsubsub_remarks']; 
$blpch=$row_tbl_subsub2['packagingsubsub_balpch']; 
$nobarc=$row_tbl_subsub2['packagingsubsub_barcodes']; 

$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_lotno='$lotno' and packagingsubsub_upssize='$upss' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['packagingsubsub_subbin']."' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nomp=$row_tbl_subsub['packagingsubsub_nomp']; 
$nop=$row_tbl_subsub['packagingsubsub_nopch']; 
$totp=$row_tbl_subsub['packagingsubsub_totpch']; 

$diq=explode(".",$row_tbl_subsub['packagingsubsub_totqty']);
if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_tbl_subsub['packagingsubsub_totqty'];}

if($totqty > 0)
{
if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
else{
$sloc=$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
}
}	

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_subsub2['packagingsubsub_id'];?>);" /></td>
</tr>
  <?php
}
$srno++;
}
}
}
?>
</table><br />

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"></div></div>