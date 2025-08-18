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

//frm_action=submit&txtid=3&plantcodes=D&yearcodes=A%2CD%2CK%2CN%2CS&cdate=30-09-2013&date=30-09-2013&dopc=30-09-2013&txtpsrn=sdfsdf&barcode=DA2345762&bardupchk=0&weight=20.2&txtstage=Pack&itmdchk=0&txtcrop=28&txtvariety=15&txtups=10.000%20Gms&txtlot1=DA02912%2F00000%2F01P&maintrid=0&subtrid=0&lotno_1=DA02912%2F00000%2F01P&softstatus=&upssize_1=10.000%20Gms&wtnopkg_1=0.010&upsname_1=10.000%20Gms&txtonob=54400&txtoqty=550&nomp_1=200&wtmp_1=6&wtnop_1=600&noofpacks_1=54200&nowb_1=&exwh1_1=1&exbin1_1=21&exsubbin1_1=418&extnomphs1_1=1&extnophs1_1=54400&nophs1_1=200&balnophs1_1=54200&sno33_1=1&sno=1&detmpbno=1&upsidno=&nopks=&extwh=1&extbin=21&extsubbin=418&sno3=0&tsno=0&txtwhg1=WH&txtbing1=Bin&txtsubbg1=Subbin&existview1=&trflg1=&tpflg1=&tflg1=&tpmflg1=&nopmpcs_1=&noppchs_1=&noptpchs_1=&noptqtys_1=&txtremarks=
	
if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
if(isset($_GET['date'])) { $date = $_GET['date']; }
if(isset($_GET['dopc'])) { $dopc = $_GET['dopc']; }
if(isset($_GET['txtpsrn'])) { $txtpsrn= $_GET['txtpsrn']; }
if(isset($_GET['barcode'])) { $barcode= $_GET['barcode']; }
if(isset($_GET['weight'])) { $weight= $_GET['weight']; }
if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop'];	}
if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }
if(isset($_GET['txtstage'])) { $txtstage = $_GET['txtstage']; }
if(isset($_GET['txtlot1'])) { $txtlot1 = $_GET['txtlot1']; }
if(isset($_GET['txtups'])) { $txtups = $_GET['txtups']; }

if(isset($_GET['upssize_1'])) { $upssize = $_GET['upssize_1']; }
if(isset($_GET['wtnopkg_1'])) { $wtnopkg_1 = $_GET['wtnopkg_1']; }
if(isset($_GET['txtonob'])) { $txtonob = $_GET['txtonob']; }
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
if(isset($_GET['detmpbno'])) { $detmpbno= $_GET['detmpbno']; }
if(isset($_GET['upsidno'])) { $upsidno= $_GET['upsidno']; }
if(isset($_GET['nopks'])) { $nopks= $_GET['nopks']; }
if(isset($_GET['extwh'])) { $extwh= $_GET['extwh']; }
if(isset($_GET['extbin'])) { $extbin= $_GET['extbin']; }
if(isset($_GET['extsubbin'])) { $extsubbin= $_GET['extsubbin']; }

if(isset($_GET['txtremarks'])) { $txtremarks= $_GET['txtremarks']; }

if(isset($_GET['maintrid'])) { $maintrid= $_GET['maintrid']; }
if(isset($_GET['subtrid'])) { $subtrid= $_GET['subtrid']; }
	
$ttype="MMC";
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
				
			for($i=1; $i<=$sno; $i++)
			{
				$ltno24=""; 
				$ltno24=trim($_GET["lotno_".$i]);
				$ssno33=trim($_GET["sno33_".$i]);
				for($x=1; $x<=$ssno33; $x++)
				{
					$exwh=""; $exbin=""; $exsubbin=""; $extnomphs=""; $extnophs=""; $nophs=""; $balnophs=""; $detmpbno24=0; 
					$txtremarks24="";
					$exwh24=trim($_GET["exwh".$i."_".$x]);
					$exbin24=trim($_GET["exbin".$i."_".$x]);
					$exsubbin24=trim($_GET["exsubbin".$i."_".$x]);
					$extnomphs24=trim($_GET["extnomphs".$i."_".$x]);
					$extnophs24=trim($_GET["extnophs".$i."_".$x]);
					$nophs24=trim($_GET["nophs".$i."_".$x]);
					$balnophs24=trim($_GET["balnophs".$i."_".$x]);
					if($nophs24!="")
					{
						$detmpbno24=1; 
						$txtremarks24=$txtremarks;
					}
				
					$sql_subsub="insert into tbl_packagingsub_sub (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, extwh, extbin, extsubbin, packagingsubsub_extnop, packagingsubsub_extqty, packagingsubsub_nop, packagingsubsub_balpch, packagingsubsub_barcodes, packagingsubsub_remarks, plantcode) values ('$suid', '$mainid', '$ltno24', '$upssize', '$exwh24', '$exbin24', '$exsubbin24', '$extnophs24', '$txtoqty', '$nophs24', '$balnophs24', '$detmpbno24', '$txtremarks24', '$plantcode')";
					mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
						
					$sql_barcode="insert into tbl_barcodestmp (bar_tid, bar_subid, bar_barcodes, bar_lotno, bar_logid, bar_psrn, bar_grosswt, bar_wtdate, plantcode) values ('$mainid', '$suid', '$barcode', '$ltno24', '$logid', '$txtpsrn', '$weight', '$tdate2', '$plantcode')";
					mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
				}
			}
			for($j=1; $j<=1; $j++)
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
	$sql_sub="insert into tbl_packaging_sub (packaging_id, packagingsub_crop, packagingsub_variety, plantcode) values ('$mainid', '$txtcrop', '$txtvariety', '$plantcode')";
	if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
	{
		$suid=mysqli_insert_id($link);
			
		for($i=1; $i<=$sno; $i++)
		{
			$ltno24=""; 
			$ltno24=trim($_GET["lotno_".$i]);
			$ssno33=trim($_GET["sno33_".$i]);
			for($x=1; $x<=$ssno33; $x++)
			{
				$exwh=""; $exbin=""; $exsubbin=""; $extnomphs=""; $extnophs=""; $nophs=""; $balnophs=""; $detmpbno24=0; 
				$txtremarks24="";
				$exwh24=trim($_GET["exwh".$i."_".$x]);
				$exbin24=trim($_GET["exbin".$i."_".$x]);
				$exsubbin24=trim($_GET["exsubbin".$i."_".$x]);
				$extnomphs24=trim($_GET["extnomphs".$i."_".$x]);
				$extnophs24=trim($_GET["extnophs".$i."_".$x]);
				$nophs24=trim($_GET["nophs".$i."_".$x]);
				$balnophs24=trim($_GET["balnophs".$i."_".$x]);
				if($nophs!="")
				{
					$detmpbno24=1; 
					$txtremarks24=$txtremarks;
				}
				
				$sql_subsub="insert into tbl_packagingsub_sub (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, extwh, extbin, extsubbin, packagingsubsub_extnop, packagingsubsub_extqty, packagingsubsub_nop, packagingsubsub_balpch, packagingsubsub_barcodes, packagingsubsub_remarks, plantcode) values ('$suid', '$mainid', '$ltno24', '$upssize', '$exwh24', '$exbin24', '$exsubbin24', '$extnophs24', '$txtoqty', '$nophs24', '$balnophs24', '$detmpbno24', '$txtremarks24', '$plantcode')";
				mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
						
				$sql_barcode="insert into tbl_barcodestmp (bar_tid, bar_subid, bar_barcodes, bar_lotno, bar_logid, bar_psrn, bar_grosswt, bar_wtdate, plantcode) values ('$mainid', '$suid', '$barcode', '$ltno24', '$logid', '$txtpsrn', '$weight', '$tdate2', '$plantcode')";
				mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
			}
		}
		for($j=1; $j<=1; $j++)
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
	$tot_psub=mysqli_num_rows($sql_tblsub);
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
	$subtid=0;
?>	

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
	<td colspan="8" align="center" class="tblheading">Add Packaging Slip </td>
</tr>
<tr height="15">
	<td colspan="8" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>

<tr class="Light" height="30">
	<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
	<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>
	
	<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
	<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
	<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['packaging_slipno'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
$upsize=""; $tonops=0;
$sql_tbl_sub24=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
while($subtbltot24=mysqli_fetch_array($sql_tbl_sub24))
{
	$upsize=$subtbltot24['packagingsubsub_upssize'];
	$tonops=$tonops+$subtbltot24['packagingsubsub_nop'];
}
$sql_bar=mysqli_query($link,"select  * from tbl_barcodestmp where plantcode='$plantcode' and bar_tid='".$arrival_id."' and bar_subid='".$row_tblsub['packagingsub_id']."' and bar_logid='".$row_tbl['packaging_logid']."' and bar_psrn='".$row_tbl['packaging_slipno']."'") or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
?>
<tr class="Light" height="30">
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Barcode&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltblheading" id="barserch">&nbsp;<input type="text" name="barcode" class="tbltext" size="10" maxlength="9" value="<?php echo $row_bar['bar_barcodes'];?>" onblur="barcheck(this.value)" onkeyup="searchbarcode(this.value)" onkeypress="return isNumberKey24(event)"  readonly="true"  style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="bardupchk" value="0" /></td>
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Gross MMC Weight&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltblheading">&nbsp;<input type="text" name="weight" id="w" class="tbltext" size="6" maxlength="6" onchange="chkmlt1(this.value);" onkeypress="return isNumberKey1(event)" value="<?php echo $row_bar['bar_grosswt'];?>"  readonly="true"  style="background-color:#CCCCCC"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>		

</table>
<br />
<?php
	$ptp=0;
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="79" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="130" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="115" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="95" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">Existing Pchs</td>
	<td width="75" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
    <td width="80" align="center" valign="middle" class="smalltblheading">Balance Pchs</td>
	<td width="65" align="center" valign="middle" class="smalltblheading">No. of Barcodes Attached</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Remarks</td>
	<td width="27" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="39" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>
<?php
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
	$nomps=1; 
	$nopchs=$row_tbl_subsub2['packagingsubsub_nop']; 
	$remarks=$row_tbl_subsub2['packagingsubsub_remarks']; 
	$blpch=$row_tbl_subsub2['packagingsubsub_balpch']; 
	$nobarc=1; 
	
	$upspacktype=$upss;
	$packtp=explode(" ",$upspacktype);
	if($packtp[1]=="Gms")
	{ 
		$ptp=(($packtp[0]*$nopchs)/1000);
	}
	else
	{
		$ptp=$packtp[0]*$nopchs;
	}
	$totpcqty=$totpcqty+$ptp;
	
	$difq="";$difq1="";
	$sloc=""; $sloc1=""; $cnt++; 
	
	$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_upssize='$upss' order by packagingsubsub_id asc") or die(mysqli_error($link));
	$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
	while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
	{
	
		$lnt=explode(",",$row_tbl_subsub['packagingsubsub_lotno']);
		foreach($lnt as $lntno)
		{
			if($lntno<>"" && $lntno==$lotno)
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
			
			if($sloc!=""){
			$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
			else{
			$sloc=$wareh.$binn.$subbinn." | ".$nomp." | ".$nop." | ".$totp." | ".$totqty;}
			}	
		}
	}
	
	$sql_crop=mysqli_query($link,"Select * from  tblcrop where cropid='".$row_tbl_sub['packagingsub_crop']."'") or die(mysqli_error($link));
	$row_crop=mysqli_fetch_array($sql_crop);
	
	$sql_variety=mysqli_query($link,"Select * from  tblvariety where varietyid='".$row_tbl_sub['packagingsub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$row_variety=mysqli_fetch_array($sql_variety);
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crop['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_variety['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $nopchs;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crop['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_variety['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $upss;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $nopchs;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $nomps;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blpch;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nobarc;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php if($remarks!=""){ ?><a href="Javascript:void(0)" title="<?php echo $remarks;?>" onmouseover="<?php echo $remarks;?>">Details</a><?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
	<td align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['packagingsub_id'];?>);" /></td>
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
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
 <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Post Item Form</td>
  </tr>
  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="240" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="240" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>

	<td width="240" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1(this.value);" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
 <tr class="Light" height="30">
<td width="240" align="right"  valign="middle" class="smalltblheading">UPS&nbsp;</td>
<td width="240" align="left"  valign="middle" class="smalltbltext" id="upstp" >&nbsp;<select class="smalltbltext" name="txtups" style="width:120px;" onchange="modetchk2(this.value)">
<option value="" selected>--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="240" align="right" valign="middle" class="smalltblheading">NoP in Master Pack&nbsp;</td>
<td width="240"  align="left" valign="middle" class="smalltbltext" id="tnopinmp">&nbsp;</td>

</tr>		   
<tr class="Light" height="30">
<td align="right" width="239" valign="middle" class="smalltblheading">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="241" valign="middle" class="smalltbltext">&nbsp;<input name="txtlot1" type="text" size="20" maxlength="20" value="" readonly="readonly" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="482" valign="middle" class="smalltblheading" colspan="3">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"> </div>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="100" maxlength="100" ></td>
</tr>
</table>
<br />
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
<tr class="light" height="25">
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid IN($extwh) order by perticulars") or die(mysqli_error($link));
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

</table>
<input type="hidden" name="tot_psub" value="<?php echo $tot_psub;?>" /><input type="hidden" name="totpcqty" value="<?php echo $totpcqty;?>">
</div>