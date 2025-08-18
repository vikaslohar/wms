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
   
	if(isset($_POST['barcode'])) { $barcode=$_POST['barcode']; }
	if(isset($_POST['mmcnetwt'])) { $mmcnetwt=$_POST['mmcnetwt']; }
	if(isset($_POST['mmcgrwt'])) { $mmcgrwt=$_POST['mmcgrwt']; }
	if(isset($_POST['txtwhg1'])) { $txtwhg1=$_POST['txtwhg1']; }
	if(isset($_POST['txtbing1'])) { $txtbing1=$_POST['txtbing1']; }
	if(isset($_POST['newslocsel'])) { $newslocsel=$_POST['newslocsel']; }
	if(isset($_POST['mptyp'])) { $mptyp=$_POST['mptyp']; }
	
	if(isset($_POST['maintrid'])) { $mainid=$_POST['maintrid']; }
	if(isset($_POST['subtrid'])) { $subtrid=$_POST['subtrid']; }
	if(isset($_POST['subsubtrid'])) { $subsubtrid=$_POST['subsubtrid']; }

//frm_action=submit&txt14=&txtid=1&logid=DP1&getdetflg=0&txtconchk=&txtptype=&txtcountrysl=&txtcountryl=&rettype=&extdcno=&plantcodes=D%2CH&yearcodes=A%2CD%2CF%2CK%2CN%2CP%2CS&trsbmval=0&date=04-12-2015&txtpp=C%26F&txtstatesl=Madhya%20Pradesh&txtlocationsl=135&locationname=135&txtstfp=413&adddchk=&brflg=0&brchflg=1&eseltyp=mmcbarsel&barcode=DP999999999&mmcnetwt=20&mmcgrwt=23.6&binshift=yes&bcvalues=&binshifting=yes&nslval=0&nbarallval=0&nbarallnos=&txtwhg1=1&txtbing1=1&bnnomps_1=1&bnqtys_1=20&txtwhg2=WH&txtbing2=Bin&bnnomps_2=&bnqtys_2=&txtwhg3=WH&txtbing3=Bin&bnnomps_3=&bnqtys_3=&txtwhg4=WH&txtbing4=Bin&bnnomps_4=&bnqtys_4=&txtwhg5=WH&txtbing5=Bin&bnnomps_5=&bnqtys_5=&sln=5&tsln=1&totnewsloc=0&newsloc=&newslocsel=1&maintrid=2&subtrid=&subsubtrid=

	$pid=$mainid;
	$arrival_date=date("Y-m-d");
	
	$blnop=0; $blqty=0; $t=0; $lotno2=""; $nopinmp=""; $ltnop=""; $packtype2=""; $crop2=""; $variety2=""; $orlot2=""; $x=0;
	
	$sq2=mysqli_query($link,"Select distinct dmmc_lotno from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$mainid' and dmmc_flg=2") or die(mysqli_error($link));
	while($ro2=mysqli_fetch_array($sq2))
	{
		$txtolotno=$ro2['dmmc_lotno'];
		$sq=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$mainid' and dmmc_flg=2 and dmmc_lotno='".$txtolotno."'") or die(mysqli_error($link));
		while($ro=mysqli_fetch_array($sq))
		{
			$dmmcid=$ro['dmmc_id'];
			$extslsubbg=$ro['dmmc_esubbin'];
			$txtbalnobp=$ro['dmmc_bnolp'];
			$txtbalqtyp=$ro['dmmc_bqty'];
			$sid=$ro['dtdfs_id'];
			$ssid=$ro['dbss_id'];
			$packtype=$ro['dmmc_eups'];
			$qty=$ro['dmmc_qty'];
			$nop=$ro['dmmc_nolp'];
			
			$nopinmp=$nopinmp+$nop;
			
			if($lotno2!="")
				$lotno2=$lotno2.",".$txtolotno;
			else
				$lotno2=$txtolotno;
			
			if($ltnop!="")
				$ltnop=$ltnop.",".$nop;
			else
				$ltnop=$nop;
			
			
			$sql_subsub="update tbl_dtdfmmc set dmmc_barcode='$barcode', dmmc_wtmp='$mmcnetwt', dmmc_grosswt='$mmcgrwt', dmmc_wh='$txtwhg1', dmmc_bin='$txtbing1', dmmc_bccode=1, dmmc_flg=1, dmmc_mptype='$mptyp' where dmmc_id='$dmmcid'";
			if(mysqli_query($link,$sql_subsub) or die(mysqli_error($link)))
			{
				//$mmcsid=mysqli_insert_id($link);
				
				$sql_arrsubsub=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='".$txtolotno."' and packtype='".$packtype."'") or die(mysqli_error($link));
				$a_sub=mysqli_num_rows($sql_arrsubsub);
				while($row_arrsubsub=mysqli_fetch_array($sql_arrsubsub))
				{
				
					$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and subbinid='".$row_arrsubsub['subbinid']."' and binid='".$row_arrsubsub['binid']."' and whid='".$row_arrsubsub['whid']."' and packtype='".$packtype."' and lotno='".$txtolotno."' order by balqty desc") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_issue1[0]."' and balqty>0") or die(mysqli_error($link)); 
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{
						$otrid=$row_issuetbl['lotldg_id'];
							
						$whid=$row_issuetbl['whid'];
						$binid=$row_issuetbl['binid'];
						$subbinid=$row_issuetbl['subbinid'];
						$packlabels=$row_issuetbl['packlabels'];
						$barcodes=$row_issuetbl['barcodes'];
						$wtinmp=$row_issuetbl['wtinmp'];
						$opnop=$row_issuetbl['balnop'];
						$opnomp=$row_issuetbl['balnomp'];
						$optqty=$row_issuetbl['balqty'];
						$pcktyp=$row_issuetbl['packtype'];
						$crop=$row_issuetbl['lotldg_crop'];
						$variety=$row_issuetbl['lotldg_variety'];
						$packnomp=1;
						
						if($packtype2!="")
							$packtype2=$packtype2.",".$pcktyp;
						else
							$packtype2=$pcktyp;
						
						if($crop2!="")
							$crop2=$crop2.",".$crop;
						else
							$crop2=$crop;
						
						if($variety2!="")
							$variety2=$variety2.",".$variety;
						else
							$variety2=$variety;
						 	
						$pckt=explode(" ",$pcktyp);
						$ptp=0; $nopinmp=0;
						if($pckt[1]=="Gms")
						{
							$ptp=(($pckt[0]*$zxcv)/1000);
							$nnoopp=$pckt[0];
							$nopinmp=$wtinmp*(1000/$nnoopp);
						}
						else
						{
							$ptp=($pckt[0]*$zxcv);
							$nnoopp=$pckt[0]*1000;
							$nopinmp=$wtinmp*(1000/$pckt[0]);
						}
							//echo $nopinmp;
						$balnop=$packnop-$opnop;
						$balnomp=$opnomp+$packnomp;
						$balqty=$optqty;
							
						$sstage=$row_issuetbl['lotldg_sstage'];
						$sstatus=$row_issuetbl['lotldg_sstatus'];
						$moist=$row_issuetbl['lotldg_moisture'];
						$gemp=$row_issuetbl['lotldg_gemp'];
						$vchk=$row_issuetbl['lotldg_vchk'];
						$got1=$row_issuetbl['lotldg_got1'];
						$qc=$row_issuetbl['lotldg_qc'];
							
						$gotstatus=$row_issuetbl['lotldg_got'];
						$qctestdate=$row_issuetbl['lotldg_qctestdate'];
						$gottestdate=$row_issuetbl['lotldg_gottestdate'];
						$orlot=$row_issuetbl['orlot'];
						$srtyp=$row_issuetbl['lotldg_srtyp'];
						$srflg=$row_issuetbl['lotldg_srflg'];
						$resverstatus=$row_issuetbl['lotldg_resverstatus'];
						$revcomment=$row_issuetbl['lotldg_revcomment'];
						$geneticpurity=$row_issuetbl['lotldg_genpurity'];
						$yearcode=$row_issuetbl['yearcode'];
						$dop1=$row_issuetbl['lotldg_dop'];
						$valperiod=$row_issuetbl['lotldg_valperiod'];
						$valupto=$row_issuetbl['lotldg_valupto'];
						$ltrvflg=$row_issuetbl['lotldg_rvflg'];
						$ltalflg=$row_issuetbl['lotldg_alflg'];
						$ltdispflg=$row_issuetbl['lotldg_dispflg'];
						$ltaltid=$row_issuetbl['lotldg_altrids'];
						$ltalqtr=$row_issuetbl['lotldg_alqtys'];
						$ltalnmpr=$row_issuetbl['lotldg_alnomps'];
						$ltsprmflg=$row_issuetbl['lotldg_spremflg'];
						$lttotqt=$row_issuetbl['lotldg_totalqty'];
						
						if($orlot2!="")
							$orlot2=$orlot2.",".$orlot;
						else
							$orlot2=$orlot;	
							
						$barcodes2=$barcodes;
						if($barcodes2!="")
							$barcodes2=$barcodes2.",".$a;
						else
							$barcodes2=$a;
										
						$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_srtyp, lotldg_srflg, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, trstage, packtype, packlabels, barcodes, wtinmp, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_spremflg, lotldg_totalqty,lotldg_alnomps,plantcode,plantcode) values('$yearid_id','PACKMMC', '$pid', '$arrival_date', '$txtolotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opnop', '$opnomp', '$optqty', '$nop', '$packnomp', '$qty', '$balnop', '$balnomp', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$srtyp', '$srflg', '$resverstatus', '$revcomment', '$geneticpurity', '$sstage', '$packtype', '$packlabels', '$barcodes2', '$wtinmp', '$dop1', '$valperiod', '$valupto', '$ltrvflg', '$ltalflg', '$ltdispflg', '$ltaltid', '$ltalqtr', '$ltsprmflg', '$lttotqt', '$ltalnmpr','$plantcode','$plantcode')";
							//exit;
						if(mysqli_query($link,$sql_ins_main) or die(mysqli_error($link)))
						{
							$oldtid1=mysqli_insert_id($link);
							$x++;
							if($oldtid!="")
								$oldtid=$oldtid.",".$oldtid1;
							else
								$oldtid=$oldtid1;
						}
					}
				}
				
				$blnop=$blnop+$txtbalnobp; 
				$blqty=$blqty+$txtbalqtyp;
				$t++;
			 	$sql_subsub1="update tbl_dtdfsub_sub2 set dbsss_mmcqty='$txtbalqtyp' where dtdf_id='$mainid' and dtdfs_id='$sid' and dbsss_subbin='$extslsubbg'";
				$asdf1=mysqli_query($link,$sql_subsub1) or die(mysqli_error($link));	
				
				
				/*$sql_subsub4="insert into tbl_dtdfsub_sub3 (dtdf_id, dtdfs_id, dbss_id, dallocss3_barcode, dallocss3_weight, dallocss3_grossweight, dallocss3_crop, dallocss3_variety, dallocss3_lotno, dallocss3_ups, dallocss3_dov, dallocss3_dot, dallocss3_qc,plantcode) values ('$mainid', '$sid', '$ssid', '$barcode', '$mmcnetwt', '$mmcgrwt', '$crop', '$variety', '$txtolotno', '$packtype', '$valupto', '$qctestdate', '$qc','$plantcode')";
				mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));*/
				
			}
		}	
		if($t>0)
		{
		 	$sql_subsub2="update tbl_dtdfsub_sub set dbss_mmcqty='$blqty' where dtdf_id='$mainid' and dtdfs_id='$sid'";
			$asdf2=mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));	
		}
	}
	/*if($t>0)
	{
	 	$sql_subsub4="insert into tbl_dtdfsub_sub3 (dtdf_id, dtdfs_id, dbss_id, dallocss3_barcode, dallocss3_weight, dallocss3_grossweight, dallocss3_crop, dallocss3_variety, dallocss3_lotno, dallocss3_ups, dallocss3_dov, dallocss3_dot, dallocss3_qc,plantcode) values ('$mainid', '$sid', '$ssid', '$barcode', '$mmcnetwt', '$mmcgrwt','$plantcode')";
		mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
	}*/
	
	if($x>0)
	{
		$sql_ins_main231="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_wtmp, mpmain_mptnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_lotnop, mpmain_alflg, mpmain_altrid, mpmain_mptype,plantcode) values('$arrival_date', '$pid', 'PACKMMC', '$crop2', '$variety2', '$lotno2', '$packtype2', '$barcode', '$mmcnetwt', '$nopinmp', '0', '0', '$nopinmp', '$mmcnetwt', '$nopinmp', '$mmcnetwt', '$txtwhg1', '$txtbing1', '1', '$yearid_id', '$logid', '$ltnop', '1', '$pid', '$mptyp','$plantcode')";
		mysqli_query($link,$sql_ins_main231) or die(mysqli_error($link));
					
		$sql_barcode="Insert into tbl_barcodes (bar_trid, bar_trtype, bar_subtrid, bar_lotno, bar_orlot, bar_barcode, bar_grosswt, bar_wtdate, logid, yearid,plantcode) values('$pid', 'PACKMMC', '$subtrid', '$lotno2', '$orlot', '$barcode', '$mmcgrwt', '$arrival_date', '$logid', '$yearid_id','$plantcode')";
		mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
	}			
				
	$tid=$mainid;

	$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dtdf_id'];

	$tdate=$row_tbl['dtdf_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dtdf_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$subtid=$subtrid;
	$subsubtid=0;
	
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch TDF - MMC Creation </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dtdf_tcode']."/".$row_tbl['dtdf_yearcode']."/".$row_tbl['dtdf_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dtdf_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dtdf_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dtdf_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dtdf_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dtdf_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dtdf_state']."' and productionlocationid='".$row_tbl['dtdf_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dtdf_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dtdf_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dtdf_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dtdf_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dtdf_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >-->
<?php
$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dtdf_party']."'"); 
	if($tt=mysqli_num_rows($quer33)>0)
	{
		$row33=mysqli_fetch_array($quer33);
		$name==$row33['business_name'];
		$address=$row33['address'];
		$city=$row33['city']; 
		$state=$row33['state'];
		$pincode=$row33['pin'];
	}
	else
	{
		$sql_month2=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1'")or die("Error:".mysqli_error($link));
		$tt=mysqli_num_rows($sql_month2);
		$row_month2=mysqli_fetch_array($sql_month2);
		$name=$row_month2['orderm_partyname'];
		$address=$row_month2['orderm_partyaddress'];
		$city=$row_month2['orderm_partycity']; 
		$state=$row_month2['orderm_partystate'];
		$pincode=$row_month2['orderm_partypin'];
	}
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dtdf_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $name;?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dtdf_party'];?>"  /></td>
	</tr>
<?php
	
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $address;?><?php if($city!="") { echo ", ".$city; }?>, <?php echo $state;?><?php if($pincode!="") { echo " - ".$pincode; }?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>

</table>
</div>
<br />

<div id="orderdetails">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">MMC Packaging List</td>
</tr>
<?php
	$sq_mmc2=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dmmc_flg=1") or die(mysqli_error($link));
	$tot_mmc=mysqli_num_rows($sq_mmc2);
	
	$sq_mmc1=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dmmc_flg=2") or die(mysqli_error($link));
	$tot_mmc1=mysqli_num_rows($sq_mmc1);
	$srmc=0;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcode</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Net Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Gross Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">SLOC</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Lot No.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Status</td>
</tr>
<?php
if($tot_mmc>0)
{
while($row_mmc2=mysqli_fetch_array($sq_mmc2))
{
$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
$sq_mmc=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dmmc_flg=1 and dmmc_barcode='".$row_mmc2['dmmc_barcode']."'") or die(mysqli_error($link));
while($row_mmc=mysqli_fetch_array($sq_mmc))
{
$mmcbrcd=$row_mmc['dmmc_barcode'];
$mmcwt=$row_mmc['dmmc_wtmp'];
$mmcgrswt=$row_mmc['dmmc_grosswt'];

$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_mmc['dmmc_ewh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and whid='".$row_mmc['dmmc_ewh']."' and binid='".$row_mmc['dmmc_ebin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$mmcsloc=$noticia_whd1['perticulars']."/".$noticia_bing1['binname'];

$sq2=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_id='".$row_mmc['dtdfs_id']."' and dtdf_id='".$row_mmc['dtdf_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dtdfs_crop'];
else
$mmccrp=$ro2['dtdfs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dtdfs_variety'];
else
$mmcver=$ro2['dtdfs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc['dmmc_lotno'];
else
$mmcltn=$row_mmc['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc['dmmc_eups'];
else
$mmcup=$row_mmc['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc['dmmc_nolp'];
else
$mmcnop=$row_mmc['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc['dmmc_qty'];
else
$mmcqtt=$row_mmc['dmmc_qty'];

$mmcsts="MMC Slip";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="printmmcslip('<?php echo $mmcbrcd;?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
}
?>
<?php
if($tot_mmc1>0)
{
$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
while($row_mmc1=mysqli_fetch_array($sq_mmc1))
{
$mtid=$row_mmc1['dtdf_id'];
$stid=$row_mmc1['dtdfs_id'];
$mmcbrcd=$row_mmc1['dmmc_barcode'];
$mmcwt=$row_mmc1['dmmc_wtmp'];
$mmcgrswt=$row_mmc1['dmmc_grosswt'];

$sq2=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_id='".$row_mmc1['dtdfs_id']."' and dtdf_id='".$row_mmc1['dtdf_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dtdfs_crop'];
else
$mmccrp=$ro2['dtdfs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dtdfs_variety'];
else
$mmcver=$ro2['dtdfs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc1['dmmc_lotno'];
else
$mmcltn=$row_mmc1['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc1['dmmc_eups'];
else
$mmcup=$row_mmc1['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc1['dmmc_nolp'];
else
$mmcnop=$row_mmc1['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc1['dmmc_qty'];
else
$mmcqtt=$row_mmc1['dmmc_qty'];


$mmcsloc='';
$mmcsts="Pack MMC";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="packmmc('<?php echo $mtid?>','<?php echo $stid?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
?>
<input type="hidden" name="totmmc" value="<?php echo $tot_mmc;?>" />
</table>
<br />

<?php
$upt="";
if($utyp=="ST")$upt="Yes";
if($utyp=="NST")$upt="No";

$arrivalid=""; 

	$sql_tbl=mysqli_query($link,"select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dtdf_id'];
if($tt=mysqli_num_rows($quer33)>0)
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}
else
{
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_partyname='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
}	
//$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where orderm_party='".$row_tbl['dtdf_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and order_trtype='Order TDF' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."'")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid;

$ver=""; $cpr="";
if($arrivalid!="")
{
	$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
	$totver1=mysqli_num_rows($sql_ver1);
	while($row_ver1=mysqli_fetch_array($sql_ver1))
	{
		if($cpr!="")
			$cpr=$cpr.",".$row_ver1['order_sub_crop'];
		else
			$cpr=$row_ver1['order_sub_crop'];
	}
	
	$cp="";
	$sq_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid IN ($cpr) order by cropname Asc") or die(mysqli_error($link));
	while($ro_crp=mysqli_fetch_array($sq_crp))
	{
		if($cp!="")
			$cp=$cp.",".$ro_crp['cropid'];
		else
			$cp=$ro_crp['cropid'];
	}
	
	$arid=explode(",",$cp);
	foreach($arid as $atrid)
	{
		if($atrid<>"")
		{
			$ver1="";
			$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_crop='$atrid' order by order_sub_variety") or die(mysqli_error($link));
			$totver2=mysqli_num_rows($sql_ver2);
			while($row_ver2=mysqli_fetch_array($sql_ver2))
			{
				if($ver1!="")
					$ver1=$ver1.",".$row_ver2['order_sub_variety'];
				else
					$ver1=$row_ver2['order_sub_variety'];
			}
			$vp="";
			$sq_vrp=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid IN ($ver1) and actstatus='Active' order by popularname Asc") or die(mysqli_error($link));
			while($ro_vrp=mysqli_fetch_array($sq_vrp))
			{
				if($vp!="")
					$vp=$vp.",".$ro_vrp['varietyid'];
				else
					$vp=$ro_vrp['varietyid'];
			}
			if($ver!="")
				$ver=$ver.",".$vp;
			else
				$ver=$vp;
			
		}
	}
}

?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">Pending Order(s) in Progress - MMC Packaging List</td>
</tr>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Order No</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoMP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcodes</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Allocated</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Gross Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty MMC</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>
</tr>
<?php 
$sn=1; $sn24=0; $sid=0; $dflg=0; $ordnos=""; $veridno=""; $upsnos=""; $totbarcs="";
if($arrivalid!="")
{
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{
$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}
//echo $orsid."<br/>";
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups ASC") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{ //echo $orsid."  =  ".$rowsloc['order_sub_sub_ups']."<br/>";
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{ 	//echo $verrid."  -  ".$rowsloc['order_sub_sub_ups']."  =  ".$rowsloc2['order_sub_id']."<br/>";
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

		

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
		if($tot=mysqli_num_rows($sql_m) > 0)
		{
			while($row_m=mysqli_fetch_array($sql_m))
			{
				if($ordno!="")
				$ordno=$ordno.",".$row_m['orderm_porderno'];
				else
				$ordno=$row_m['orderm_porderno'];
				$nord++;
			}
		}
		$orxd=explode(",",$ordno);
		$tid240=array_keys(array_flip($orxd));
		$ordno=implode(",",$tid240);
		
		if($reptyp1=="hold")
	    {	
			if($rowtblsub['order_sub_hold_flag']!=0)
				$statussub=$rowtblsub['order_sub_hold_type'];	
		}
		else
		{
			$statussub="";
		}


		$variet=$row_dept4['popularname'];
		$upstyp=$rowtblsub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		/*if($crop!="")
		{
		$crop=$crop."<br>".$rowtblsub['order_sub_crop'];
		// $rowtblsub['lotcrop'];
		}
		else
		{*/
		$crop=$rowtblsub['order_sub_crop'];
		//}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		/*if($variety!="")
		{
		$variety=$variety."<br>".$rowtblsub['order_sub_variety'];
		}
		else
		{*/
		$variety=$rowtblsub['order_sub_variety'];	
		//}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		/*if($lotno!="")
		{
			$lotno=$lotno."<br>".$rowtblsub['lotno'];
		}
		else
		{
			$lotno=$rowtblsub['lotno'];
		}
		if($bags!="")
		{
			$bags=$bags."<br>".$acn;
		}
		else
		{
			$bags=$acn;
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		if($qc!="")
		{
			$qc=$qc."<br>".$rowtblsub['qc'];
		}
		else
		{
			$qc=$rowtblsub['qc'];
		}
		if($got!="")
		{
			$got=$got."<br>".$rowtblsub['got'];
		}
		else
		{
			$got=$rowtblsub['got'];
		}
		if($stage!="")
		{
			$stage=$stage."<br>".$rowtblsub['order_sub_totbal_qty'];
		}
		else
		{
			$stage=$rowtblsub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
			$per=$per."<br>".$rowtblsub['pper'];
		}
		else
		{
			$per=$rowtblsub['pper'];
		}*/
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	$xfd=count($dq);
	if($upstyp=="NST")
	{
		//$dq[1]="000";
		//if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
		//if($dq[1]==000){$qt12=$dq[0];}else{$qt12=$dq[0].".".$dq[1];}
		if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
	}
	else
	{
		if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
	}
	$up1=$qt1." ".$zz[1];
	
	/*if($up!="")
		$up=$up.$up1."<br/>";
	else*/
		$up=$up1;

	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	/*if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{*/
		$sstatus=$sstatus+$row_sloc['order_sub_sub_nop'];
	//}
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($ordnos!="")
{
	$ordnos=$ordnos.",".$ordno;
}
else
{
	$ordnos=$ordno;
}

if($veridno!="")
{
	$veridno=$veridno.",".$variety;
}
else
{
	$veridno=$variety;
}
if($upsnos!="")
{
	$upsnos=$upsnos.",".$up1;
}
else
{
	$upsnos=$up1;
}
if($qt > 0)	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		
$selups=$rowsloc['order_sub_sub_ups'];
$dq=explode(" ",$selups);
//if($upstyp=="ST")
{
$diq=explode(".",$dq[0]);
if($diq[1]==000){$difq=$diq[0]."."."000";}else{$difq=$diq[0].".".$diq[1];}
$selups=$difq." ".$dq[1];
}
if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdf_id='$tid' and dtdfs_upstype='$upstyp' and dtdfs_ups='".$selups."' and dtdfs_stage='Pack'") or die(mysqli_error($link));
else
$sq=mysqli_query($link,"Select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='$cro' and dtdfs_variety='$variet' and dtdf_id='$tid' and dtdfs_upstype='$upstyp' and dtdfs_ups='".$selups."' and dtdfs_stage='Pack'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0; $nobarcs=""; $grswt=0; $tor=0; $mcflg=0; $nnolp=0; $mmcqty=0; $sid=0;

if($to=mysqli_num_rows($sq) > 0)
{
	$ro=mysqli_fetch_array($sq);
	$nups=$ro['dtdfs_ups']; 
	$nnob=$ro['dtdfs_nob']; 
	$nqty=$ro['dtdfs_qty']; 
	//$nbqty=$ro['dtdfs_bqty'];
	$nbqty=$qt-$nqty;
	$norno=$ro['dtdfs_ordno'];
	//$nnomp=$ro['dtdfs_nomp']; 
	$nnolp=$ro['dtdfs_nop']; 
	$nnomp=0;
	
	$crpnm=$cp; 
	$vernm=$vt;
	$sid=$ro['dtdfs_id'];
	$sn24=$sn;
	$dbsflg=$ro['dtdfs_alflg'];
	if($sid==$subtid)$tor=1;
	
	$sq23=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
		if($nobarcs!="")
		$nobarcs=$nobarcs.",".$row23['dmmc_barcode'];
		else
		$nobarcs=$row23['dmmc_barcode'];
		$sq232=mysqli_query($link,"Select dmmc_grosswt from tbl_dtdfmmc where plantcode='".$plantcode."' and dmmc_barcode='".$row23['dmmc_barcode']."'") or die(mysqli_error($link));
		$row232=mysqli_fetch_array($sq232);
		$grswt=$grswt+$row232['dmmc_grosswt'];
	}

	$sq3=mysqli_query($link,"Select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdfs_id='$sid' and dtdf_id='$tid'") or die(mysqli_error($link));
	$totre3=mysqli_num_rows($sq3);
	while($row3=mysqli_fetch_array($sq3))
	{
		$qts=$row3['dbss_mmcqty'];
		$mmcqty=$mmcqty+$qts;
	}
	
if($grswt==0)$grswt="";
if(($nnomp==0 && $nqty>0)||$mmcqty>0){$mmcflg++; }
if($mmcqty<0)$mmcqty=0;
}

if($mmcqty>0)
{ 
$totmmc1=0;
$sqmmc1=mysqli_query($link,"Select * from tbl_dtdfmmc where plantcode='".$plantcode."' and dtdf_id='$tid' and dtdfs_id='$sid' and dmmc_flg=2") or die(mysqli_error($link));
$totmmc1=mysqli_num_rows($sqmmc1);
$subtrid=$sid;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up1?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up1;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>

	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $norno ?>"><?php echo $norno;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $norno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nolots;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nobarcs;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="grswt<?php echo $sn;?>" id="grswt_<?php echo $sn;?>" value="<?php echo $grswt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $mmcqty;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($totmmc1>0){?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmmc('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $mmcqty?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $sid?>','<?php echo $tid?>')" value="<?php echo $sn;?>"  /><?php } else { ?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $mmcqty?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $sid?>','<?php echo $tid?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
//}
}
}
}
}
}
}
}
//}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" />
<input type="hidden" name="txtornos" value="" /><input type="hidden" name="txtveridno" value="" /><input type="hidden" name="txtupsnos" value="" /><input type="hidden" name="txteqty" value="" /><input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" /><input type="hidden" name="totlots" value="" />
</table>
<div id="showorsel"></div>
<br />
<div id="barupdetails" ></div>
</div>

<div id="lotnwise" style="display:none"></div>
<div id="postingsubtable" style="display:block">
<div id="postingsubsubtable" style="display:block">
<input type="hidden" name="maintrid" value="<?php echo $tid?>" />
<!--<input type="hidden" name="subtrid" value="<?php echo $subtrid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />-->
<div id="shownsloc" style="display:"></div>
</div>
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/mmc1.gif" border="0"style="display:inline;cursor:Pointer;" onClick="makemmcform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
</div>
</div>