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

	if(isset($_GET['crop'])) { $crop = $_GET['crop']; }
	if(isset($_GET['variety'])) { $variety= $_GET['variety']; }
	if(isset($_GET['txtpsrn'])) { $txtpsrn = $_GET['txtpsrn'];	}
	if(isset($_GET['date'])) { $date = $_GET['date']; }
	if(isset($_GET['maintrid'])) { $maintrid = $_GET['maintrid']; }
	if(isset($_GET['txtwhg1'])) { $txtwhg1 = $_GET['txtwhg1']; }
	if(isset($_GET['txtbing1'])) { $txtbing1 = $_GET['txtbing1']; }
	if(isset($_GET['txtsubbg1'])) { $txtsubbg1 = $_GET['txtsubbg1']; }
	if(isset($_GET['sno33'])) { $sno33 = $_GET['sno33']; }
	if(isset($_GET['pcodeo'])) { $pcodeo = $_GET['pcodeo']; }
	if(isset($_GET['ycodeeo'])) { $ycodeeo = $_GET['ycodeeo']; }
	if(isset($_GET['txtlot2o'])) { $txtlot2o = $_GET['txtlot2o']; }
	if(isset($_GET['stcodeo'])) { $stcodeo = $_GET['stcodeo']; }
	if(isset($_GET['stcode2o'])) { $stcode2o = $_GET['stcode2o']; }
	if(isset($_GET['txtupsdc'])) { $txtupsdc = $_GET['txtupsdc']; }
	if(isset($_GET['txtwtmp'])) { $txtwtmp = $_GET['txtwtmp']; }
	if(isset($_GET['txtmptnop'])) { $txtmptnop = $_GET['txtmptnop']; }
	if(isset($_GET['txtnopdc'])) { $txtnopdc = $_GET['txtnopdc']; }
	if(isset($_GET['txtqtydc'])) { $txtqtydc = $_GET['txtqtydc']; }
	if(isset($_GET['txtqcstatus'])) { $txtqcstatus = $_GET['txtqcstatus']; }
	if(isset($_GET['dot'])) { $dot = $_GET['dot']; }
	if(isset($_GET['txtgerm'])) { $txtgerm = $_GET['txtgerm']; }
	if(isset($_GET['txtmoist'])) { $txtmoist = $_GET['txtmoist']; }
	if(isset($_GET['txtpp'])) { $txtpp = $_GET['txtpp']; }
	if(isset($_GET['txtgstat'])) { $txtgstat = $_GET['txtgstat']; }
	if(isset($_GET['qcsreq'])) { $qcsreq = $_GET['qcsreq']; }
	if(isset($_GET['txtgotstatus'])) { $txtgotstatus = $_GET['txtgotstatus']; }
	if(isset($_GET['dogt'])) { $dogt = $_GET['dogt']; }
	if(isset($_GET['dop'])) { $dop = $_GET['dop']; }
	if(isset($_GET['dov'])) { $dov = $_GET['dov']; }
	if(isset($_GET['foccode'])) { $foccode = $_GET['foccode']; }
	if(isset($_GET['srrno'])) { $srrno = $_GET['srrno']; }
	if(isset($_GET['postitmid'])) { $postitmid = $_GET['postitmid']; }
//exit;
	$lotno=$pcodeo.$ycodeeo.$txtlot2o."/".$stcodeo."/".$stcode2o."P";

//frm_action=submit&crop=28&variety=461&txtpsrn=DF00001&lotno=&maintrid=1&date=24-06-2014&txtlotno1=&txtwhg1=4&txtbing1=156&txtsubbg1=3119&nopmpcs_1=0&sno33=1&pcodeo=H&ycodeeo=F&txtlot2o=04137&stcodeo=00000&stcode2o=00&txtcrop=28&txtvariety=461&itmdchk=&txtupsdc=10.000%20Gms&txtwtmp=2.8&txtmptnop=280&txtnopdc=1400&txtqtydc=14&txtqcstatus=OK&dot=7-05-2014&txtgerm=89&txtmoist=1.3&txtpp=Acceptable&txtgstat=GOT-NR&qcsreq=OK&txtgotstatus=OK&dogt=20-05-2014&dop=14-05-2014&dov=12-08-2014&fetbarc=DF010000001&fetbarc=DF010000002&fetbarc=DF010000004&fetbarc=DF010000005&foccode=DF010000001%2CDF010000002%2CDF010000004%2CDF010000005&srrno=6&slslc=1&txtwhg1=4&txtbing1=156&txtsubbg1=3119&existview1=Allowed&trflg1=0&tpflg1=0&tflg1=0&tpmflg1=0&nopmpcs_1=0&sno3=1&slocseldet=1&sbincont=&postitmid=0&postval=

		$dt=date("Y-m-d");
		$stge="Pack";
		
		$dotd=explode("-",$dot);
		$dot2=$dotd[2]."-".$dotd[1]."-".$dotd[0];
		
		$dogtd=explode("-",$dogt);
		$dogt2=$dogtd[2]."-".$dogtd[1]."-".$dogtd[0];
		
		$dopd=explode("-",$dop);
		$dop2=$dopd[2]."-".$dopd[1]."-".$dopd[0];
		
		$dovd=explode("-",$dov);
		$dov2=$dovd[2]."-".$dovd[1]."-".$dovd[0];
		
		$sqlm=mysqli_query($link,"Select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn'") or die(mysqli_error($link));
		while($rowm=mysqli_fetch_array($sqlm))
		{
			$ttrid=$rowm['btsl_id']; $d=0;
			
			$brcs=explode(",",$foccode);
			foreach($brcs as $barcode)
			{
				if($barcode<>"")
				{
					$sqls=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_barcode='$barcode' and btsl_id='$ttrid'") or die(mysqli_error($link));
					if($tots=mysqli_num_rows($sqls)>0)
					{
						$rows=mysqli_fetch_array($sqls);
						$sql_btsls="update tbl_srbtslsub set btslsub_lnkflg=2 where btsl_id='$ttrid' and btslsub_barcode='$barcode'";
						if($xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link)))
						{
							$suid=$rows['btslsub_id'];
							$d=1;
							$sql_btslss="update tbl_srbtslsub_sub2 set btslss_wh='$txtwhg1', btslss_bin='$txtbing1', btslss_subbin='$txtsubbg1', btslss_lotno='$lotno', btslss_ups='$txtupsdc', btslss_qtympt='$txtwtmp', btslss_nopmpt='$txtmptnop', btslss_qcstatus='".$txtqcstatus."', btslss_dot='".$dot2."', btslss_gottype='".$txtgstat."', btslss_gotstatus='".$qcsreq."', btslss_dogt='".$dogt2."', btslss_gemp='".$txtgerm."', btslss_moist='".$txtmoist."', btslss_pp='".$txtpp."', btslss_dop='".$dop2."', btslss_dov='".$dov2."' where btsl_id='$ttrid' and btslsub_id='$suid'";
							if($xcxcs=mysqli_query($link,$sql_btslss) or die(mysqli_error($link)))
							{
								$postitmid++;
							}
						}
					}
					else
					{
						 $sql_btsls="Insert into tbl_srbtslsub (btsl_id, btslsub_barcode, btslsub_bctype, btslsub_crop, btslsub_variety, btslsub_lnkflg, plantcode) values('$ttrid', '$barcode', '$txtbctyp', '$crop', '$variety',2, '$plantcode')";
						if($xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link)))
						{
							$suid=mysqli_insert_id($link);
							$d=1;
							$sql_btslss="insert into tbl_srbtslsub_sub2 (btsl_id, btslsub_id, btslss_wh, btslss_bin, btslss_subbin, btslss_lotno, btslss_ups, btslss_qtympt, btslss_nopmpt, btslss_qcstatus, btslss_dot, btslss_gottype, btslss_gotstatus, btslss_dogt, btslss_gemp, btslss_moist, btslss_pp, btslss_dop, btslss_dov, plantcode) values('$ttrid', '$suid', '$txtwhg1', '$txtbing1', '$txtsubbg1', '$lotno', '$txtupsdc', '$txtwtmp', '$txtmptnop', '".$txtqcstatus."', '".$dot."', '".$txtgstat."', '".$qcsreq."', '".$dogt."', '".$txtgerm."', '".$txtmoist."', '".$txtpp."', '".$dop."', '".$dov."', '".$plantcode."')";
							if($xcxcs=mysqli_query($link,$sql_btslss) or die(mysqli_error($link)))
							{
								$postitmid++;
							}
						}
					}
					
					if($d==0)
					{
						$sql_btsls="update tbl_srbtslsub set btslsub_lnkflg=0 where btsl_id='$ttrid' and btslsub_barcode='$barcode'";
						$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
					}
				}
			}
		}

	
	
?><?php
$conts=0;
$plantcodes=""; $yearcodes="";
	$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
	while($noticia = mysqli_fetch_array($quer4)) 
	{
		if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
		else
			$yearcodes=$noticia['ycode'];
	}
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$plantcodes=$row_month['code'];
	$pltcode=$row_month['code'];
	$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
	while($noticia2 = mysqli_fetch_array($quer5)) 
	{
		if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
		else
			$plantcodes=$noticia2['stcode'];
	}
?>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="14">SLOC - Un-Identified Barcodes</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="217" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="149" align="center" valign="middle" class="tblheading">WH</td>
<td width="121" align="center" valign="middle" class="tblheading">Bin</td>
<td width="119" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">Master Packs</td>
</tr>
<?php
	$abc=""; $abcdef="";
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' AND bar_lotno='".$lotno."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			$bc=$row_barcode2['bar_barcodes'];
			if($abc!="")
			$abc=$abc.","."'$bc'";
			else
			$abc="'$bc'";
			if($abcdef!="")
			$abcdef=$abcdef.",".$bc;
			else
			$abcdef=$bc;
		}
	}
	//echo $abc;
	$sql_btsls=mysqli_query($link,"select distinct(btsl_id) from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn' order by btsl_id asc") or die(mysqli_error($link));
	while($row_btsls=mysqli_fetch_array($sql_btsls))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btsls['btsl_id'];
		else
			$barlotslist=$row_btsls['btsl_id'];
	}
	//echo $barlotslist;
	$sbn1=""; $sbn2=""; $barcds="";
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btsl_id IN ($barlotslist) and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			/*$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
			}*/
			$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
				 
				$bc=$rowbarcsub2['btslsub_barcode'];
				if($barcds!="")
				$barcds=$barcds.","."'$bc'";
				else
				$barcds="'$bc'";
			}
		}
	}
	$lotno='';
	if($barcds!="")
	{
		$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode IN($barcds)") or die(mysqli_error($link));
		if($tot_mpm=mysqli_num_rows($sql_mpm)>0)
		{
			$row_mpm=mysqli_fetch_array($sql_mpm);
			$lotno=$row_mpm['mpmain_lotno'];
		}
	}
	$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
	$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
	while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
	{ 
		if($sbn2!="")
		$sbn2=$sbn2.",".$row_tbl_subsub3['subbinid'];
		else
		$sbn2=$row_tbl_subsub3['subbinid'];
	}
	
	//echo $sbn1;
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	$nm1=array_unique($nm);
	//print_r($nm1);
$xyz=explode(",",$abc);	
$conts=count($xyz);	

?>
<?php
$sno33=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; //$a=$lotno; 
foreach($nm1 as $sbinval)
{
if($sbinval<>"")
{ 
$totnompbar=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
	$nob=0; $qty=0; $qty1=0;
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nop1=0; $tcnt++;
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
		//if($nop1<$row_issuetbl['balnop'])
		$nop1=$row_issuetbl['balnop'];
		//$nob=$nop1;
		$nob=$nop1; 
		$qty=$row_issuetbl['balnomp'];
		$qty1=$row_issuetbl['balqty'];
	}
}

if($tcnt==0)
{
	$sql_sel2="select * from tblups where CONCAT(ups,' ',wt)='".$upsize."' order by uom Asc";
	$res2=mysqli_query($link,$sql_sel2) or die (mysqli_error($link));
	$row122=mysqli_fetch_array($res2);
	$upsize=$row122['uid'];
	
	$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
	$totvariety=mysqli_num_rows($sqlvsriety);
	$rowvariety=mysqli_fetch_array($sqlvsriety);
	
	$p1_array=explode(",",$rowvariety['gm']);
	$p1_array2=explode(",",$rowvariety['wtmp']);
	$p1_array3=explode(",",$rowvariety['mptnop']);
	$p1=array();
	for($i=0; $i<count($p1_array); $i++)
	{
		if($p1_array[$i]==$upsize)
		{
			$sql_sel="select * from tblups where uid='".$upsize."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			$wtinmp=$p1_array2[$i];
			if($row12['wt']=="Gms")
			{ 
				$ptp=(1000/$row12['ups']);
			}
			else
			{
				$ptp=$row12['ups'];
			}
		}
	}
}
	$nobcd="";
	$sqlsubbinn=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$sbinval."'") or die(mysqli_error($link));
	$rowsubbinn=mysqli_fetch_array($sqlsubbinn);
	$wid=$rowsubbinn['whid'];
	$bid=$rowsubbinn['binid'];	
	
	$stbar=0;
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg!=0 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  (btslss_lotno!='' || btslss_lotno!='NULL') order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				$brcod=$rowbarcsub['btslsub_barcode'];
				if($nobcd!="")
				$nobcd=$nobcd.",".$brcod;
				else
				$nobcd=$brcod;
				array_push($aval1,$brcod);
				$stbar++;
				$lotno=$row_btslm['btslss_lotno'];
			}
		}
	$totnompbar=$totnompbar+$stbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	
$sno33=$sno33+1;
	
//if($slocssyncs=="slocssyn")
{
?>
<tr class="light" height="25">
  <td align="center"  valign="middle" class="smalltbltext"><?php if($lotno==""){ ?><?php } else { echo $lotno; }?><input type="hidden" name="txtlotno<?php echo $sno33?>" value="<?php echo $lotno?>" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno33;?>" name="txtwhg<?php echo $sno33;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno33;?>" id="txtbing<?php echo $sno33;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno33;?>" id="txtsubbg<?php echo $sno33;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>


<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php if($totnompbar>0) { ?><a href="Javascript:void(0);" onClick="showbarc('<?php echo $nobcd;?>');"><?php echo $totnompbar;?></a><?php } else { echo $totnompbar; }?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno33;?>" id="nopmpcs_<?php echo $sno33;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno33;?>)"   /></td>
</tr>
<?php
}
}
}
?>

<input type="hidden" name="sno33" value="<?php echo $sno33;?>" />
</table>
<br />	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Update Lot Details</td>
</tr>	
</table>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
$row_month=mysqli_fetch_array($quer6);
$a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="25" >
<td width="100" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" width="694" valign="middle" class="smalltbltext" colspan="5">&nbsp;<select class="smalltbltext" name="pcodeo" style="width:40px;">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onChange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onKeyPress="return isNumberKey(event)" onChange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onKeyPress="return isNumberKey(event)"  value="" onChange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onChange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
</table>
<?php

$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$a."' and packtype='".$upsval."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_newlot='".$a."' and salesr_id='".$trid."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 || $row_month==0)$sflg++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
if($row_month>0)
{
if($crop!=$noticia33['cropid'])$val1++;
if($variety!=$noticia_item43['varietyid'])$val1++;
}
if($val1>0)$val++;
if($val==0)
{

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$trid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$trid."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
//$tid=$row_tbl_sub['salesr_id'];
//$subtid=$row_tbl_sub['salesr_id'];


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crop."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$variety."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

	$wtmp="";$mptnop=""; $srnonew=0;
	$p1_array=explode(",",$noticia_item['gm']);
	$p1_array2=explode(",",$noticia_item['wtmp']);
	$p1_array3=explode(",",$noticia_item['mptnop']);
	$p1=array();
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			if($ups==$row_tbl_sub['salesrs_ups'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$row_tbl_sub['salesrs_ups']);
	$packtyp=$packtp[0]; 
	$ptp=""; $ptp1="";
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


?>
<table align="center" width="800" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="25">
<td width="99" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="190" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="80" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="150" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?>
      <input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	


<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
	
?>

<td width="50" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_ups']!="" && $row_tbl_sub['salesrs_ups']!="--Select UPS-") {?>
  <input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_ups'];?>"   /><?php } else { ?><?php if($row_tbl_sub['salesrs_upstype']!="Standard"){?><input type="text" class="tbltext" name="txtupsdc" id="txtupsdc" size="15" maxlength="15" onChange="verchk(this.value);" value="" /><?php } else { ?><select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onChange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
	<?php foreach($toup as $val) { if($val<>"") { 
	$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$upst=$row_var['ups']." ".$row_var['wt']; ?>
		<option <?php if($row_tbl_sub['salesrs_ups']==$upst) echo "selected";?> value="<?php echo $upst;?>" />   
		<?php echo $upst;?>
	<?php }} ?></select><?php } }?>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Wt. in MP&nbsp;</td>
<td width="190" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtwtmp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $wtmp;?>" onKeyPress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="80" align="right"  valign="middle" class="tblheading">NoP in MP&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtmptnop" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onKeyPress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $mptnop;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="20">
<td align="center"  valign="middle" class="tblheading" colspan="6">Quantity Details</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="190" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onKeyPress="return isNumberKey(event)" onChange="upchk(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td width="80" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onKeyPress="return isNumberKey1(event)" onChange="nopschk(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="20">
<td align="center"  valign="middle" class="tblheading" colspan="6">Quality Details</td>
</tr>
<?php
if($sflg==0)
{
?>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qc'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qctestdate'];?>"  />&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gemp'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_moisture'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_vchk'];?>" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_got'];?>" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgstat" value="<?php $gt=explode(" ",$rowmonth['lotldg_got1']); echo $gt[0];?>" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gottestdate'];?>"  /></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_dop'];?>" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_valupto'];?>"  /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select name="txtqcstatus" class="tbltext" style="size:70px" onChange="qtychk();">
<option value="" selected="selected">--Select--</option>
<option value="OK">OK</option>
<option value="Fail">Fail</option>
<option value="UT">UT</option>
<option value="RT">RT</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right" valign="middle" class="tblheading" >DoT&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" value="" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dot');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" value="" onKeyPress="return isNumberKey(event)" onChange="qcchk();"  />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" value=""  onKeyPress="return isNumberKey1(event)" onChange="germpchk();" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select name="txtpp" class="tbltext" style="size:80px" onChange="moistchk();"  >
 <option value="" selected="selected">-Select-</option>
 <option value="Acceptable">Acceptable</option> 
 <option value="Not-Acceptable">Not-Acceptable</option> 
 </select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onChange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="qcsreq" style="width:80px;" onChange="qtchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="OK" >OK</option>
	<option value="UT" >UT</option>
	</select>&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgotstatus" value="" /></td>	
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dogt');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dop');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" value="" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dov');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<table align="center" width="800" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;Cannot show Lot Details.</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;Reasons: 1. Lot not present in System(for current Plant application login)</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Lot not Packed(for current Plant application login)</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Crop/Variety mismatch for selected Lot with the verifying record</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Lot already received in this Transaction</td>
</tr>
</table>
<?php
}
?><br />	
<div id="showcvdet">
<table align="center" border="1" width="200" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="2">Select&nbsp;Barcode(s) to Link</td>
</tr>
<!--<tr class="Dark" height="20">
<td width="40%" align="right" valign="middle" class="tblheading">CA&nbsp;&nbsp;|&nbsp;&nbsp;CL&nbsp;</td>
<td width="60%" align="left" valign="middle" class="tblheading">&nbsp;Barcode(s)</td>
</tr>-->
<?php
$srrno=0;
$sql_tbl_bar2=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
while($row_tbl_bar2=mysqli_fetch_array($sql_tbl_bar2))
{
$sql_tbl_barsub23=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and  btsl_id='".$row_tbl_bar2['btsl_id']."' and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
$subtbltotbar23=mysqli_num_rows($sql_tbl_barsub23);
while($rowbarcsub23=mysqli_fetch_array($sql_tbl_barsub23))
{
	$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub23['btslsub_id']."' and  (btslss_lotno='' || btslss_lotno='NULL') order by btslsub_id asc") or die(mysqli_error($link));
	$row_btslm2=mysqli_num_rows($sql_btslm2);
	if($row_btslm2==0)
	{
		$brcod2=$rowbarcsub23['btslsub_barcode'];
		if($xyz1!="")
			$xyz1=$xyz1.",".$brcod2;
		else
			$xyz1=$brcod2;
	}
}
}
$xyz=explode(",",$xyz1);
foreach($xyz as $sbinval23)
{
if($sbinval23<>"")
{ $srrno++;
?>
<tr class="light" height="22">
<td width="40%" align="right" valign="middle" class="tblheading"><input type="checkbox" name="fetbarc" class="input shiftCheckbox" id="fet" value="<?php echo $sbinval;?>"   /></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $sbinval23;?></td>
</tr>
<?php
}
}
?>
<input type="hidden" name="foccode" value="" /><input type="hidden" name="srrno" value="<?php echo $srrno;?>" />
</table><br />
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="6">SLOC</td>
</tr>
<?php

	$abc=""; $abcdef="";
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' AND bar_lotno='".$lotno."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			$bc=$row_barcode2['bar_barcodes'];
			if($abc!="")
			$abc=$abc.","."'$bc'";
			else
			$abc="'$bc'";
			if($abcdef!="")
			$abcdef=$abcdef.",".$bc;
			else
			$abcdef=$bc;
		}
	}
	//echo $abc;
	$sql_btsls=mysqli_query($link,"select distinct(btsl_id) from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn' order by btsl_id asc") or die(mysqli_error($link));
	while($row_btsls=mysqli_fetch_array($sql_btsls))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btsls['btsl_id'];
		else
			$barlotslist=$row_btsls['btsl_id'];
	}
	//echo $barlotslist;
	$sbn1=""; $sbn2="";
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btsl_id IN ($barlotslist) and btslsub_lnkflg=1 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			/*$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
			}*/
			$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
			}
		}
	}
	
	$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
	$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
	while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
	{ 
		if($sbn2!="")
		$sbn2=$sbn2.",".$row_tbl_subsub3['subbinid'];
		else
		$sbn2=$row_tbl_subsub3['subbinid'];
	}
	
	//echo $sbn1;
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	$nm1=array_unique($nm);
	//print_r($nm1);
$xyz=explode(",",$abc);	
$conts=count($xyz);	
?>
<tr class="tblsubtitle" height="20">
<td width="78" align="center" valign="middle" class="tblheading">Select</td>
<td width="165" align="center" valign="middle" class="tblheading">WH</td>
<td width="165" align="center" valign="middle" class="tblheading">Bin</td>
<td width="165" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="196" align="center" valign="middle" class="tblheading">Comments</td>
<td width="165" align="center" valign="middle" class="tblheading">Master Packs</td>
<!--<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>-->
</tr>
<?php
$sno3=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; //$a=$lotno; 
foreach($nm1 as $sbinval)
{
if($sbinval<>"")
{ 
$totnompbar=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
	$nob=0; $qty=0; $qty1=0;
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nop1=0; $tcnt++;
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
		//if($nop1<$row_issuetbl['balnop'])
		$nop1=$row_issuetbl['balnop'];
		//$nob=$nop1;
		$nob=$nop1; 
		$qty=$row_issuetbl['balnomp'];
		$qty1=$row_issuetbl['balqty'];
	}
}

if($tcnt==0)
{
	$sql_sel2="select * from tblups where CONCAT(ups,' ',wt)='".$upsize."' order by uom Asc";
	$res2=mysqli_query($link,$sql_sel2) or die (mysqli_error($link));
	$row122=mysqli_fetch_array($res2);
	$upsize=$row122['uid'];
	
	$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
	$totvariety=mysqli_num_rows($sqlvsriety);
	$rowvariety=mysqli_fetch_array($sqlvsriety);
	
	$p1_array=explode(",",$rowvariety['gm']);
	$p1_array2=explode(",",$rowvariety['wtmp']);
	$p1_array3=explode(",",$rowvariety['mptnop']);
	$p1=array();
	for($i=0; $i<count($p1_array); $i++)
	{
		if($p1_array[$i]==$upsize)
		{
			$sql_sel="select * from tblups where uid='".$upsize."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			$wtinmp=$p1_array2[$i];
			if($row12['wt']=="Gms")
			{ 
				$ptp=(1000/$row12['ups']);
			}
			else
			{
				$ptp=$row12['ups'];
			}
		}
	}
}
	$nobcd="";
	$sqlsubbinn=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$sbinval."'") or die(mysqli_error($link));
	$rowsubbinn=mysqli_fetch_array($sqlsubbinn);
	$wid=$rowsubbinn['whid'];
	$bid=$rowsubbinn['binid'];	
	$stbar=0;
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$lotno' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				$brcod=$rowbarcsub['btslsub_barcode'];
				if($nobcd!="")
				$nobcd=$nobcd.",".$brcod;
				else
				$nobcd=$brcod;
				array_push($aval1,$brcod);
				$stbar++;
			}
		}
	$totnompbar=$totnompbar+$stbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	
$sno3=$sno3+1;	
//if($subtbltotbar > 0)	
{
?>
<tr class="light" height="25">
<td align="center"  valign="middle" class="smalltbltext"><input type="radio" name="slslc" id="slslc<?php echo $sno3?>" value="<?php echo $sno3?>" checked="checked" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>

<td valign="middle">
<div id="slocr<?php echo $sno3;?>">
<table align="center" height="25" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview<?php echo $sno3?>" id="existview<?php echo $sno3?>" class="tbltext" value="Allowed" /><input type="hidden" name="trflg<?php echo $sno3?>" id="trflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tpflg<?php echo $sno3?>" id="tpflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tflg<?php echo $sno3?>" id="tflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tpmflg<?php echo $sno3?>" id="tpmflg<?php echo $sno3?>" value="0" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php echo $totnompbar;?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>
<!--<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $totpchbar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $tqtybar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>-->
</tr>
<?php
}
}
}
?>

<input type="hidden" name="sno3" value="<?php echo $sno3;?>" /><input type="hidden" name="slocseldet" value="<?php echo $sno3;?>" /><input type="hidden" name="sbincont" value="<?php echo $sbincont;?>" /><input type="hidden" name="postitmid" value="<?php echo $postitmid?>" />
</table>
<?php if($conts>0) { ?>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php } ?>
</div>