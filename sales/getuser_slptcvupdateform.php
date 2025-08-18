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
		$yearidid=$_SESSION['yearid_id'];
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

//frm_action=submit&txt11=&txt14=&txtid=&logid=SR1&slrgln1=&txtconchk=&txtptype=&txtcountrysl=&txtcountryl=&sstage=Pack&date=21-03-2014&txtcrop=28&txtvariety=15&txtupstyp=Standard&itmdchk=&pcodeo=D&ycodeeo=N&txtlot2o=06066&stcodeo=00000&stcode2o=01&pcode=D&ycodee=N&txtlot2=06066&stcode=00001&stcode2=00&lotcheck1=0&dovdate=31-03-2014&txtsrtyp=P2P&rettype=Sales%20Return%20-%20P2P&txtupsdc=100.000%20Gms&txtnopd=50&txtqtyd=5.000&txtnopdc=48&txtnopdc2=2&txtnopdc3=0&txtqtydc=4.8&txtqtydc2=0.2&txtqtydc3=0&txtgstat=GOT-NR&qcsreq=UT&qcrequest=UT&dogt=&txtslwhg1=1&txtslbing1=1&txtslsubbg1=1&txtslBagsg1=48&txtslqtyg1=4.8&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&txtslBagsg2=&txtslqtyg2=&orowid2=0&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslBagsg3=&txtslqtyg3=&orowid3=0&txtslwhg4=--WH--&txtslbing4=--Bin--&txtslsubbg4=--Sub%20Bin--&txtslBagsg4=&txtslqtyg4=&orowid4=0&txtslwhg5=--WH--&txtslbing5=--Bin--&txtslsubbg5=--Sub%20Bin--&txtslBagsg5=&txtslqtyg5=&orowid5=0&txtslwhg6=--WH--&txtslbing6=--Bin--&txtslsubbg6=--Sub%20Bin--&txtslBagsg6=&txtslqtyg6=&orowid6=0&txtslwhg7=--WH--&txtslbing7=--Bin--&txtslsubbg7=--Sub%20Bin--&txtslBagsg7=&txtslqtyg7=&orowid7=0&txtslwhg8=--WH--&txtslbing8=--Bin--&txtslsubbg8=--Sub%20Bin--&txtslBagsg8=&txtslqtyg8=&orowid8=0&txtslwhd1=1&txtslbind1=1&txtslsubbd1=1&txtslBagsd1=2&txtslqtyd1=0.2&dorowid1=0&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubbd2=--Sub%20Bin--&txtslBagsd2=&txtslqtyd2=&dorowid2=0&maintrid=2&subtrid=2&subsubtrid=0&ptp=&ptp1=&wtmp=10&wtnop=100
	
	if(isset($_GET['sstage'])) { $sstage = $_GET['sstage']; }
	if(isset($_GET['date'])) { $date = $_GET['date']; }
	if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop']; }
	if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }
	if(isset($_GET['pcodeo'])) { $pcodeo = $_GET['pcodeo']; }
	if(isset($_GET['ycodeeo'])) { $ycodeeo = $_GET['ycodeeo']; }
	if(isset($_GET['txtlot2o'])) { $txtlot2o = $_GET['txtlot2o']; }
	if(isset($_GET['stcodeo'])) { $stcodeo = $_GET['stcodeo']; }
	if(isset($_GET['stcode2o'])) { $stcode2o = $_GET['stcode2o']; }
	if(isset($_GET['pcode'])) { $pcode = $_GET['pcode']; }
	if(isset($_GET['ycodee'])) { $ycodee = $_GET['ycodee']; }
	if(isset($_GET['txtlot2'])) { $txtlot2 = $_GET['txtlot2']; }
	if(isset($_GET['stcode'])) { $stcode = $_GET['stcode']; }
	if(isset($_GET['stcode2'])) { $stcode2 = $_GET['stcode2']; }
	if(isset($_GET['dovdate'])) { $dovdate = $_GET['dovdate']; }
	if(isset($_GET['txtupsdc'])) { $txtupsdc = $_GET['txtupsdc']; }
	if(isset($_GET['txtnopd'])) { $txtnopd = $_GET['txtnopd']; }
	if(isset($_GET['txtqtyd'])) { $txtqtyd = $_GET['txtqtyd']; }
	if(isset($_GET['txtnopdc'])) { $txtnopdc = $_GET['txtnopdc']; }
	if(isset($_GET['txtnopdc2'])) { $txtnopdc2 = $_GET['txtnopdc2']; }
	if(isset($_GET['txtnopdc3'])) { $txtnopdc3 = $_GET['txtnopdc3']; }
	if(isset($_GET['txtqtydc'])) { $txtqtydc = $_GET['txtqtydc']; }
	if(isset($_GET['txtqtydc2'])) { $txtqtydc2 = $_GET['txtqtydc2']; }
	if(isset($_GET['txtqtydc3'])) { $txtqtydc3 = $_GET['txtqtydc3']; }
	if(isset($_GET['txtgstat'])) { $txtgstat = $_GET['txtgstat']; }
	if(isset($_GET['qcsreq'])) { $qcsreq = $_GET['qcsreq']; }
	if(isset($_GET['dogt'])) { $dogt = $_GET['dogt']; }
	if(isset($_GET['txtupstyp'])) { $txtupstyp = $_GET['txtupstyp']; }
	if(isset($_GET['txtsrtyp'])) { $txtsrtyp = $_GET['txtsrtyp'];}
	if(isset($_GET['srptcvtype'])) { $srptcvtype = $_GET['srptcvtype']; } else {$srptcvtype="verrec";}
	
	if(isset($_GET['ltncode'])) { $ltncode = $_GET['ltncode']; }
	if(isset($_GET['ltnflg'])) { $ltnflg = $_GET['ltnflg']; }
	if(isset($_GET['ltnn2'])) { $ltnn2 = $_GET['ltnn2']; }
	
	$txtslwhd1 = ""; $txtslbind1 = ""; $txtslsubbd1 = ""; $txtslBagsd1 = ""; $txtslqtyd1 = ""; $txtslwhd2 = ""; $txtslbind2 = ""; 
	$txtslsubbd2 = ""; $txtslBagsd2 = ""; $txtslqtyd2 = "";
	
	if($txtqtydc2 > 0)
	{
		if(isset($_GET['txtslwhd1'])) { $txtslwhd1 = $_GET['txtslwhd1']; }
		if(isset($_GET['txtslbind1'])) { $txtslbind1 = $_GET['txtslbind1']; }
		if(isset($_GET['txtslsubbd1'])) { $txtslsubbd1 = $_GET['txtslsubbd1']; }
		if(isset($_GET['txtslBagsd1'])) { $txtslBagsd1 = $_GET['txtslBagsd1']; }
		if(isset($_GET['txtslqtyd1'])) { $txtslqtyd1 = $_GET['txtslqtyd1']; }
		if(isset($_GET['txtslwhd2'])) { $txtslwhd2 = $_GET['txtslwhd2']; }
		if(isset($_GET['txtslbind2'])) { $txtslbind2 = $_GET['txtslbind2']; }
		if(isset($_GET['txtslsubbd2'])) { $txtslsubbd2 = $_GET['txtslsubbd2']; }
		if(isset($_GET['txtslBagsd2'])) { $txtslBagsd2 = $_GET['txtslBagsd2']; }
		if(isset($_GET['txtslqtyd2'])) { $txtslqtyd2 = $_GET['txtslqtyd2']; }
	}
	
	if(isset($_GET['maintrid'])) { $z1 = $_GET['maintrid']; }
	if(isset($_GET['subtrid'])) { $subtrid = $_GET['subtrid']; }
	if(isset($_GET['subsubtrid'])) { $subsubtrid = $_GET['subsubtrid']; }
	if(isset($_GET['sritmrecsts'])) { $sritmrecsts = $_GET['sritmrecsts']; }
	
	$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
	$edate1=explode("-",$dovdate);
	$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
	
	$edate12=explode("-",$dogt);
	$dgot=$edate12[2]."-".$edate12[1]."-".$edate12[0];
	
	$god1=0;$god2=0;
	if($txtslqtyd1!="" && $txtslqtyd1 > 0) { $god1=1; }
	if($txtslqtyd2!="" && $txtslqtyd2 > 0) { $god2=1; }
	
	$stgsss="Condition"; $stgchr="C";
	if($txtsrtyp=="P2P"){$stgsss="Pack"; $stgchr="P";}
	
	
	
if($qcsreq!="OK")$dgot="";

$olotno=$pcodeo.$ycodeeo.$txtlot2o."/".$stcodeo."/".$stcode2o.$stgchr;	
$oln=$pcodeo.$ycodeeo.$txtlot2o."/".$stcodeo."/".$stcode2o;	

$glotno=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2.$stgchr;	
$gln=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2;	
$mainid=$z1;
	
if($subtrid == 0)
{
	$sql_sub="insert into tbl_salesrv_sub (salesr_id, salesrs_crop, salesrs_variety, salesrs_stage, salesrs_oldlot, salesrs_newlot, salesrs_orlot, salesrs_ups, salesrs_nob, salesrs_qty, salesrs_upsdc, salesrs_nobdc, salesrs_qtydc, salesrs_upsdamage, salesrs_nobdamage, salesrs_qtydamage, salesrs_lotdamage, salesrs_vflg, salesrs_dov, salesrs_dovfy, salesrs_qc, salesrs_got, salesrs_got1, salesrs_dogt, salesrs_yearcode, salesrs_typ, salesrs_upstype, salesrs_rettype, salesrs_rectyp, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$stgsss', '$olotno', '$glotno', '$gln', '$txtupsdc', '$txtnopd', '$txtqtyd', '$txtupsdc', '$txtnopdc', '$txtqtydc', '$txtupsdc', '$txtnopdc2', '$txtqtydc2', '$glotno', '1', '$dot', '$date', 'UT', '$txtgstat', '$qcsreq', '$dgot', '$yearid_id', '$srptcvtype', '$txtupstyp', '$txtsrtyp', '$sritmrecsts', '$plantcode')";
	if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
	{
		$subid=mysqli_insert_id($link);
		
		if($ltnflg > 0)
		{
			$sqlsubsub="insert into tbl_salesrv_nsr (salesrs_id, srnsr_tcode, srnsr_logid, srnsr_yearcode, plantcode) values('$subid', '$ltncode', '$lgnid', '$yearidid', '$plantcode')";
			mysqli_query($link,$sqlsubsub) or die(mysqli_error($link));
		}
		
		for($j=1; $j<=8; $j++)
		{
			$txtwhgx="txtslwhg".$j;
			$txtbingx="txtslbing".$j;
			$txtsubbgx="txtslsubbg".$j;
			$txtslBagsgx="txtslBagsg".$j;
			$txtslqtygx="txtslqtyg".$j;
			if(isset($_GET[$txtwhgx])) { $txtslwhg= $_GET[$txtwhgx]; }
			if(isset($_GET[$txtbingx])) { $txtslbing= $_GET[$txtbingx]; }
			if(isset($_GET[$txtsubbgx])) { $txtslsubbg= $_GET[$txtsubbgx]; }
			if(isset($_GET[$existviewx])) { $existview= $_GET[$existviewx]; }
			if(isset($_GET[$txtslBagsgx])) { $txtslBagsg= $_GET[$txtslBagsgx]; }
			if(isset($_GET[$txtslqtygx])) { $txtslqtyg= $_GET[$txtslqtygx]; }
			if($txtslqtyg!="" && $txtslqtyg > 0)
			{
				$sql_sub_sub="insert into tbl_salesrvsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, plantcode) values('$mainid', '$subid', '$txtslwhg', '$txtslbing', '$txtslsubbg', '$txtupsdc', '$txtslBagsg', '$txtslqtyg', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			}
		}
		if($god1==1)
		{
			$sql_sub_sub3="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, plantcode) values('$mainid', '$subid', '$txtslwhd1', '$txtslbind1', '$txtslsubbd1', '$txtupsdc', '$txtslBagsd1', '$txtslqtyd1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link));
		}
		if($god2==1)
		{
			$sql_sub_sub4="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, plantcode) values('$mainid', '$subid', '$txtslwhd2', '$txtslbind2', '$txtslsubbd2', '$txtupsdc', '$txtslBagsd2', '$txtslqtyd2', '$plantcode')";
			mysqli_query($link,$sql_sub_sub4) or die(mysqli_error($link));
		}
	}
}
else
{
	if($sritmrecsts=="Yes")
	{
		$sql_sub="update tbl_salesrv_sub  set salesr_id='$mainid', salesrs_crop='$txtcrop', salesrs_variety='$txtvariety', salesrs_stage='$stgsss', salesrs_oldlot='$olotno', salesrs_newlot='$glotno', salesrs_orlot='$gln', salesrs_ups='$txtupsdc', salesrs_nob='$txtnopd', salesrs_qty='$txtqtyd', salesrs_upsdc='$txtupsdc', salesrs_nobdc='$txtnopdc', salesrs_qtydc='$txtqtydc', salesrs_upsdamage='$txtupsdc', salesrs_nobdamage='$txtnopdc2', salesrs_qtydamage='$txtqtydc2', salesrs_lotdamage='$glotno', salesrs_vflg='1', salesrs_dov='$dot', salesrs_dovfy='$date', salesrs_qc='UT', salesrs_got='$txtgstat', salesrs_got1='$qcsreq', salesrs_dogt='$dgot', salesrs_yearcode='$yearid_id', salesrs_typ='$srptcvtype', salesrs_upstype='$txtupstyp', salesrs_rettype='$txtsrtyp', salesrs_rectyp='$sritmrecsts' where salesrs_id='$subtrid'";
	
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=$subtrid;
			
			if($ltnflg > 0)
			{
				$sqlsubsub="insert into tbl_salesrv_nsr (salesrs_id, srnsr_tcode, srnsr_logid, srnsr_yearcode, plantcode) values('$subid', '$ltncode', '$lgnid', '$yearidid', '$plantcode')";
				mysqli_query($link,$sqlsubsub) or die(mysqli_error($link));
			}
			
			for($j=1; $j<=8; $j++)
			{
				$txtwhgx="txtslwhg".$j;
				$txtbingx="txtslbing".$j;
				$txtsubbgx="txtslsubbg".$j;
				$txtslBagsgx="txtslBagsg".$j;
				$txtslqtygx="txtslqtyg".$j;
				if(isset($_GET[$txtwhgx])) { $txtslwhg= $_GET[$txtwhgx]; }
				if(isset($_GET[$txtbingx])) { $txtslbing= $_GET[$txtbingx]; }
				if(isset($_GET[$txtsubbgx])) { $txtslsubbg= $_GET[$txtsubbgx]; }
				if(isset($_GET[$existviewx])) { $existview= $_GET[$existviewx]; }
				if(isset($_GET[$txtslBagsgx])) { $txtslBagsg= $_GET[$txtslBagsgx]; }
				if(isset($_GET[$txtslqtygx])) { $txtslqtyg= $_GET[$txtslqtygx]; }
				if($txtslqtyg!="" && $txtslqtyg > 0)
				{
					$sql_sub_sub="insert into tbl_salesrvsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, plantcode) values('$mainid', '$subid', '$txtslwhg', '$txtslbing', '$txtslsubbg', '$txtupsdc', '$txtslBagsg', '$txtslqtyg', '$plantcode')";
					mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				}
			}
			if($god1==1)
			{
				$sql_sub_sub3="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, plantcode) values('$mainid', '$subid', '$txtslwhd1', '$txtslbind1', '$txtslsubbd1', '$txtupsdc', '$txtslBagsd1', '$txtslqtyd1', '$plantcode')";
				mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link));
			}
			if($god2==1)
			{
				$sql_sub_sub4="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, plantcode) values('$mainid', '$subid', '$txtslwhd2', '$txtslbind2', '$txtslsubbd2', '$txtupsdc', '$txtslBagsd2', '$txtslqtyd2', '$plantcode')";
				mysqli_query($link,$sql_sub_sub4) or die(mysqli_error($link));
			}
		}
	}
	else
	{
		$sql_sub="update tbl_salesrv_sub set salesrs_upsdc='$txtupsdc', salesrs_nobdc='0', salesrs_qtydc='0', salesrs_upsdamage='$txtupsdc', salesrs_nobdamage='0', salesrs_qtydamage='0', salesrs_vflg='1', salesrs_dovfy='$date', salesrs_yearcode='$yearid_id', salesrs_typ='$srptcvtype', salesrs_upstype='$txtupstyp', salesrs_rettype='$txtsrtyp', salesrs_rectyp='$sritmrecsts' where salesrs_id='$subtrid'";
		mysqli_query($link,$sql_sub) or die(mysqli_error($link));
	}
}
$tid=$z1;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Pre Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_typ='verrec'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="123" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="191" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="114" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="124" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="115" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="202" align="center" valign="middle" class="tblheading">Verify</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']==0){?><a href="Javascript:void(0);" onclick="showverifysc(<?php echo $row_tbl_sub['salesrs_id'];?>);">Verify</a><?php }else{?>verified<?php }?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']==0){?><a href="Javascript:void(0);" onclick="showverifysc(<?php echo $row_tbl_sub['salesrs_id'];?>);">Verify</a><?php }else{?>verified<?php }?></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_remarks'];?></td>
</tr>
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Post Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_vflg!=0") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="90" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">SR Item Found</td>
	<td width="51" align="center" valign="middle" class="tblheading" rowspan="2">Old Lot No.</td>
	<td width="52" align="center" valign="middle" class="tblheading" rowspan="2">New Lot No.</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">As per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Good</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Damage</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Excess / Shortage</td>
	<td width="36" align="center" valign="middle" class="tblheading" rowspan="2">QCSR</td>
	<td width="117" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
	<td width="26" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
	<!--<td width="45" align="center" valign="middle" class="tblheading" rowspan="2">Delete</td>-->
</tr>
<tr class="tblsubtitle" height="20">
	<td width="59" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="36" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="43" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="41" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="42" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="39" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1; $itmdchk=""; $itmdchk2="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}
	
	if($itmdchk2!="")
	{
		$itmdchk2=$itmdchk2.$row_tbl_sub['salesrs_orlot'].",";
	}
	else
	{
		$itmdchk2=$row_tbl_sub['salesrs_orlot'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
$slocs="";
$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{
	if($row_tbl_sub['salesrs_rettype']=="P2C")
	{
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
	else
	{
		$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
}

$nob=0; $qty=0;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
$xn=$row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage'];
$xnob=$xn-$nob;
$xb=floatval($row_tbl_sub['salesrs_qtydc'])+floatval($row_tbl_sub['salesrs_qtydamage']);
$xqty=floatval($xb)-floatval($qty);
$xqty=number_format($xqty, 3, '.', ',');
if($xnob==0 && $xqty!=0)$xqty=0;
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_rectyp'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "UT"; else echo ""; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
   <!-- <td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_rectyp'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "UT"; else echo ""; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <!--<td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk2" value="<?php echo $itmdchk2;?>" />
</table><br />
<div id="postingsubsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15">
<td align="center" class="tblheading"><a href="Javascript:void(0);" onclick="showverifyscnew();">Post New Record</a></td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1?>" /><input type="hidden" name="wtmp" id="wtmp" value="" /><input type="hidden" name="wtnop" id="wtnop" value="" />
</div>
</div>
