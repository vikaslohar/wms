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
 
	if(isset($_POST['txtid'])) { $txtid=$_POST['txtid']; }
	if(isset($_POST['date'])) { $date=$_POST['date']; }
	if(isset($_POST['txtpp'])) { $txtpp=$_POST['txtpp']; }
	if(isset($_POST['txtstatesl'])) { $txtstatesl=$_POST['txtstatesl']; }
	if(isset($_POST['txtlocationsl'])) { $txtlocationsl=$_POST['txtlocationsl'];	}
	if(isset($_POST['locationname'])) { $locationname=$_POST['locationname']; }
	if(isset($_POST['txtstfp'])) { $txtstfp=$_POST['txtstfp']; }
	if(isset($_POST['txtstage'])) { $txtstage=$_POST['txtstage']; }
	if(isset($_POST['mchksel'])) { $mchksel=$_POST['mchksel']; }
	if(isset($_POST['ltchksel'])) { $ltchksel=$_POST['ltchksel']; }
	if(isset($_POST['sn'])) { $sn=$_POST['sn']; }
	if(isset($_POST['sno1'])) { $sno1=$_POST['sno1']; }
	if(isset($_POST['srno2'])) { $srno2=$_POST['srno2']; }
	if(isset($_POST['totnewsloc'])) { $totnewsloc=$_POST['totnewsloc']; }
	if(isset($_POST['newsloc'])) { $newsloc=$_POST['newsloc']; }
	if(isset($_POST['binshifting'])) { $binshifting=$_POST['binshifting']; }
	if(isset($_POST['nslval'])) { $nslval=$_POST['nslval']; }
	if(isset($_POST['sln'])) { $sln=$_POST['sln']; }
	if(isset($_POST['tsln'])) { $tsln=$_POST['tsln']; }
	
	if(isset($_POST['eseltyp'])) { $eseltyp=$_POST['eseltyp']; }
	if(isset($_POST['brflg'])) { $brflg=$_POST['brflg']; }
	if(isset($_POST['brchflg'])) { $brchflg=$_POST['brchflg']; }
	if(isset($_POST['barcode1'])) { $barcode=$_POST['barcode1']; }
	if(isset($_POST['allctyp'])) { $allctyp=$_POST['allctyp']; }

	if(isset($_POST['maintrid'])) { $maintrid=$_POST['maintrid']; }
	if(isset($_POST['subtrid'])) { $subtrid=$_POST['subtrid']; }
	if(isset($_POST['subsubtrid'])) { $subsubtrid=$_POST['subsubtrid']; }
	if($binshifting=="")$binshifting="no";

	//frm_action=submit&txt14=&txtid=1&logid=DP1&getdetflg=0&txtconchk=&txtptype=C%26F&txtcountrysl=&txtcountryl=&rettype=&extdcno=&plantcodes=D%2CG%2CH&yearcodes=A%2CD%2CF%2CK%2CN%2CP%2CS%2CV&trsbmval=0&date=30-03-2016&txtpp=C%26F&txtstatesl=Madhya%20Pradesh&txtlocationsl=135&locationname=135&txtstfp=413&adddchk=&ecrop1=Bottle%20Gourd&evariety1=Haruna%20(VNR-2-10)&eupstyp1=ST&eups1=50.000%20Gms&enop1=980&eqty1=49&eordno1=OT817%2F15-16%2FOB2&enoordno1=1&rnob1=2&txtnolots=2&rqty1=14&grswt1=&bnop1=35&selsh1=1&txtornos=OT817%2F15-16%2FOB2&txtveridno=471&txtupsnos=50.000%20Gms&txteqty=49&totbarcs=&sn=2&mchksel=1&txtecrop=Bottle%20Gourd&txtevariety=Haruna%20(VNR-2-10)&txteupstyp=ST&txteups=50.000%20Gms&txtenop=980&txtornomp=7&txteordno=OT817%2F15-16%2FOB2&txteoqty=49.000&txtallonolp=0&txtallnomp=7&txttobealqty=49.000&txttlonomp=2&txttlonolp=0&txtloqty=14&txtlonolots=1&txtorblnomp=5&txtorblnolp=0&txtorblqty=35&ewtmp=7&emptnop=140&etdunallctyp=edtunalcwise&edtunallocationtype=edtunalcwise&edtunseltyp=edtunalcwise&unallctyp=unbarcodewise&unallocationtype=unbarcodewise&eunseltyp=&allocationtype=&eseltyp=barsel&brflg3=0&brchflg3=1&barcode1=DV010005862&maintrid=14&subtrid=14&subsubtrid=

	$z1=$maintrid;
		
	$mainid=$maintrid;

	$tore=0; $qqt=0;
	if($barcode!="")
	{
		$sqlbar1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$barcode."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0") or die(mysqli_error($link));
		if($totbar1=mysqli_num_rows($sqlbar1) > 0)
		{
			$rowbar1=mysqli_fetch_array($sqlbar1);
			
			$pty=$rowbar1['mpmain_trtype'];
			if($pty=="PACKSMC") $packtyp="SMC";
			if($pty=="PACKLMC")	$packtyp="LMC";
			if($pty=="PACKMMC")	$packtyp="MMC";
			if($pty=="PACKNMC")	$packtyp="NMC";
			if($pty=="PACKNLC") $packtyp="NLC";
			
			//$lot=$rowbar1['mpmain_lotno'];
			$lotn=$rowbar1['mpmain_lotno'].",";
			$qty=$rowbar1['mpmain_wtmp'];
			$ups=$rowbar1['mpmain_upssize'];
			$crop2=$rowbar1['mpmain_crop'];
			$variety2=$rowbar1['mpmain_variety'];
			$lotnops=$rowbar1['mpmain_lotnop'];
			$lonops=explode(",",$lotnops);
			
			$lot=explode(",",$lotn);
			//print_r($lot);
			$x=count($lot);
			for($i=0; $i<$x-1; $i++)
			{
				$lotno=$lot[$i];
				$ltnps=$lonops[$i];
				$zz=explode(" ",$ups);
				if($zz[1]=="Gms")
				{
					$pty=$zz[0]/1000;
				}
				else
				{
					$pty=$zz[0];
				}
				if($packtyp=="SMC" || $packtyp=="SMC")
					$ltqt=$qty;
				else
					$ltqt=$ltnps*$pty;
				
				if($lotno<>"")	
				{
					$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno' and packtype='$ups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
					$tot_lot2=mysqli_num_rows($sql_lot2);
					$row_lot2=mysqli_fetch_array($sql_lot2);
								
					$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
					$tot_lot=mysqli_num_rows($sql_lot);
					$row_lot=mysqli_fetch_array($sql_lot);
										
					$lotallqty=$row_lot['lotldg_alqtys'];
					$lotallqty=$lotallqty-$ltqt;
					if($lotallqty<=0)$lotallqty=0;
					
					$lotallnmp=$row_lot['lotldg_alnomps'];
					$lotallnmp=$lotallnmp-1;
					if($lotallnmp<=0)$lotallnmp=0;
															
					$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=2, lotldg_alqtys='".$lotallqty."', lotldg_alnomps='".$lotallnmp."' where lotdgp_id='".$row_lot2[0]."'";
					$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
				}	
			}	
			$brqt=0;
			$sqbc3=mysqli_query($link,"Select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and dallocss3_barcode='$barcode'") or die(mysqli_error($link));
			if($tobc3=mysqli_num_rows($sqbc3) > 0)
			{
				while($robc3=mysqli_fetch_array($sqbc3))
				{					
					$brqt=$robc3['dallocss3_weight'];
					
					$sql_subsub2="delete from tbl_dallocsub_sub where dallocss_id='".$robc3['dallocss_id']."'";
					$poiujwe=mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));

					$sql_subsub2="delete from tbl_dallocsub_sub3 where dallocss3_barcode='$barcode'";
					$sdfg=mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));
				}
			}
		}
		$sqlb1="update tbl_mpmain set mpmain_alflg=0, mpmain_altrid=0 where mpmain_barcode='".$barcode."'";
		$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));	
							
		$rn2=0; $rq2=0; $rnbc2=0; $rqbc2=0;
		$sqbc23=mysqli_query($link,"Select distinct dallocss3_barcode from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and dallocs_id='$subtrid'") or die(mysqli_error($link));
		if($tobc23=mysqli_num_rows($sqbc23) > 0)
		{
			while($robc23=mysqli_fetch_array($sqbc23))
			{
				$sqbc2=mysqli_query($link,"Select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and dallocs_id='$subtrid' and dallocss3_barcode='".$robc23['dallocss3_barcode']."' LIMIT 0,1") or die(mysqli_error($link));
				if($tobc2=mysqli_num_rows($sqbc2) > 0)
				{
					while($robc2=mysqli_fetch_array($sqbc2))
					{
						$rn2=$rn2+1; 
						$rq2=$rq2+$robc2['dallocss3_weight']; 
					}
				}
			}
		}
		
		$nslnp=$rn2-1; $nslnq=$rq2-$brqt;
									
		$sql_sub4="update tbl_dallocsub_sub4 set dallocss4_nomp='$nslnp', dallocss4_qty='$nslnq' where dalloc_id='$mainid' and dallocs_id='$subtrid'";
		$aweds=mysqli_query($link,$sql_sub4) or die(mysqli_error($link));
		
	}	

	$tid=$z1;

	$sql_tbl=mysqli_query($link,"select * from tbl_dalloc where plantcode='".$plantcode."' and dalloc_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dalloc_id'];

	$tdate=$row_tbl['dalloc_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dalloc_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$subtid=$subtrid;
	$subsubtid=0;
?>	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Allocation</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dalloc_tcode']."/".$row_tbl['dalloc_yearcode']."/".$row_tbl['dalloc_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dalloc_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dalloc_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dalloc_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dalloc_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dalloc_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dalloc_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dalloc_state']."' and productionlocationid='".$row_tbl['dalloc_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dalloc_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dalloc_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dalloc_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dalloc_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dalloc_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dalloc_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dalloc_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dalloc_party'];?>"  /></td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dalloc_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>

</table>
</div>
<br />

<div id="orderdetails">
<?php
$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and orderm_party='".$row_tbl['dalloc_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 and order_trtype!='Order TDF' order by orderm_id")or die("Error:".mysqli_error($link));
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
	$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_crop") or die(mysqli_error($link));
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
			$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_crop='$atrid' and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety") or die(mysqli_error($link));
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
  <td colspan="14" align="center" class="tblheading">Pending Order(s) in Progress</td>
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
	<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>
</tr>
<?php 
$sn=1; $sn24=0; $sid=0; $dflg=0; $ordnos=""; $veridno=""; $upsnos=""; $totbarcs=""; $uupp="";
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
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_totbal_qty>0 and order_sub_hold_flag=0 order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}
//echo $orsid."<br/>";
$orsid10=explode(",",$orsid);
if(count($orsid10)>1)
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups ASC") or die(mysqli_error($link));
else
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and orderm_id in($arrivalid) and order_sub_id='$orsid' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
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

		

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1 and order_trtype!='Order TDF'")or die("Error:".mysqli_error($link));
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
		if($lotno!="")
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
		}
		

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
//echo $subtid;
//if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_id='$subtid' and dallocs_alflg!=1 and dalloc_id='$tid' and dallocs_upstype='$upstyp' and dallocs_ups='$up1'") or die(mysqli_error($link));
/*else
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_alflg!=1 and dalloc_id='$tid' and dallocs_upstype='$upstyp'") or die(mysqli_error($link));*/
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0; $nobarcs=""; $grswt=0; $nnomp=0;

if($to=mysqli_num_rows($sq) > 0)
{

//echo $up1;
if($uupp=="")
$uupp=$up1;

$ro=mysqli_fetch_array($sq);
$crpnm=$cp; 
$vernm=$vt;
$sid=$ro['dallocs_id'];
$sn24=$sn;
$dbsflg=$ro['dallocs_alflg'];
$uptyp=$ro['dallocs_upstype']; 
$dispqty=$ro['dallocs_dispqty'];

$nups=$ro['dallocs_ups']; 
$nnob=$ro['dallocs_nob']; 
//$nqty=$ro['dallocs_qty']; 
$sql_dalcsubsub=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
$tot_dalcsubsub=mysqli_num_rows($sql_dalcsubsub);
while($row_dalcsubsub=mysqli_fetch_array($sql_dalcsubsub))
{
	$nqty=$nqty+$row_dalcsubsub['dallocss_qty'];
}
$nqty=$nqty-$dispqty;
//$nbqty=$ro['dallocs_bqty'];
$nbqty=$qt-$nqty;
$nbqty=round($qt,3)-round($nqty,3);
if($nbqty<=0)$nbqty=0;
$norno=$ro['dallocs_ordno'];
//$nnomp=$ro['dallocs_nomp']; 



$sql_dalcsubsub=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid' and dallocss_altype!='barcodewise'") or die(mysqli_error($link));
$tot_dalcsubsub=mysqli_num_rows($sql_dalcsubsub);
while($row_dalcsubsub=mysqli_fetch_array($sql_dalcsubsub))
{
	$nnomp=$nnomp+$row_dalcsubsub['dallocss_nomp'];
}

	$sql_dalcsubsub2=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid' and dallocss_altype='barcodewise'") or die(mysqli_error($link));
	if($tot_dalcsubsub2=mysqli_num_rows($sql_dalcsubsub2))
	while($row_dalcsubsub2=mysqli_fetch_array($sql_dalcsubsub2))
	{
		$sq231=mysqli_query($link,"Select distinct dallocss3_barcode from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid' and dallocss_id='".$row_dalcsubsub2['dallocss_id']."'  ") or die(mysqli_error($link));
		$totre231=mysqli_num_rows($sq231);
		while($row231=mysqli_fetch_array($sq231))
		{
			$nnomp=$nnomp+1;
		}
	}

$sqmmc1=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and dalloc_id='$tid' and dallocs_id='$sid' and dmmc_flg=1") or die(mysqli_error($link));
$totmmc1=mysqli_num_rows($sqmmc1);
while($rommc1=mysqli_fetch_array($sqmmc1))
{
	$nnomp=$nnomp+1;
}
$sq23=mysqli_query($link,"Select distinct dallocss3_barcode,dallocss3_grossweight from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
$totre=mysqli_num_rows($sq23);
while($row23=mysqli_fetch_array($sq23))
{
	$nolots++;
	if($nobarcs!="")
	$nobarcs=$nobarcs.",".$row23['dallocss3_barcode'];
	else
	$nobarcs=$row23['dallocss3_barcode'];
	
	$grswt=$grswt+$row23['dallocss3_grossweight'];
}
if($grswt==0)$grswt="";
$vrt=$vt;
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
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnomp;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nobarcs;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<a href="Javascript:void(0);" onClick="showmlots1('<?php echo $sid;?>')"><?php echo $nqty;?></a><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="grswt<?php echo $sn;?>" id="grswt_<?php echo $sn;?>" value="<?php echo $grswt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmain('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $qt?>','<?php echo $norno ?>','<?php echo $upstyp?>')" value="<?php echo $sn;?>"  /></td>
	<input type="hidden" name="txtornos" value="<?php echo $norno ?>" /><input type="hidden" name="txtveridno" value="<?php echo $vernm?>" /><input type="hidden" name="txtupsnos" value="<?php echo $nups?>" /><input type="hidden" name="txteqty" value="<?php echo $qt?>" /><input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" />
</tr>
<?php
$sn++;
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
</table>
</div>	
<br />
<div id="showorsel">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="16" align="center" class="tblheading">Allocation IN-Progress</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php

$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='$vrt' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$variet=$row_dept4['popularname'];
//echo $row_dept4['cropid'];
$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_dept4['cropname']."'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cro=$row_dept5['cropname'];	

//echo $up1;
?>
<tr class="tblsubtitle" height="30">
	<td width="83" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="142" align="center" valign="middle" class="tblheading"><?php echo $cro?><input type="hidden" name="txtecrop" id="txtecrop" value="<?php echo $cro;?>" /></td>
	<td width="77" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="245" align="center" valign="middle" class="tblheading"><?php echo $variet?><input type="hidden" name="txtevariety" id="txtevariety" value="<?php echo $variet;?>" /></td>
	<td width="76" align="center" valign="middle" class="tblheading">UPS Type</td>
	<td width="78" align="center" valign="middle" class="tblheading"><?php echo $uptyp?><input type="hidden" name="txteupstyp" id="txteupstyp" value="<?php echo $uptyp;?>" /></td>
	<td width="76" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="155" align="center" valign="middle" class="tblheading"><?php echo $uupp?><input type="hidden" name="txteups" id="txteups" value="<?php echo $uupp;?>" /></td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >

<tr class="Dark" height="30">
	<td colspan="3" align="center"  valign="middle" class="smalltblheading">As per Order</td>
	<td colspan="3" align="center"  valign="middle" class="smalltblheading">To be Allocated</td>
	<td colspan="4" align="center"  valign="middle" class="smalltblheading">Allocated</td>
	<td colspan="3" align="center"  valign="middle" class="smalltblheading">Post Allocation Balance As per Order</td>
	</tr>
<tr class="Dark" height="30">
  <td align="center"  valign="middle" class="smalltblheading">NoP</td>
  <td align="center"  valign="middle" class="smalltblheading">NoMP</td>
  <td align="center"  valign="middle" class="smalltblheading">Qty</td>
  <td align="center"  valign="middle" class="smalltblheading">NoLP</td>
  <td align="center"  valign="middle" class="smalltblheading">NoMP</td>
  <td align="center"  valign="middle" class="smalltblheading">Qty</td>
  <td width="74" align="center"  valign="middle" class="smalltblheading">NoMP</td>
  <td width="93" align="center"  valign="middle" class="smalltblheading">NoLP</td>
  <td align="center"  valign="middle" class="smalltblheading">Qty</td>
  <td align="center"  valign="middle" class="smalltblheading">No. of Lots</td>
  <td align="center"  valign="middle" class="smalltblheading">NoMP</td>
  <td align="center"  valign="middle" class="smalltblheading">NoLP</td>
  <td align="center"  valign="middle" class="smalltblheading">Qty</td>
</tr>
<?php
$totre=0; $nolots=0; //echo $sid;
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dallocs_alflg!=1 and dalloc_id='$tid'") or die(mysqli_error($link));
if($to=mysqli_num_rows($sq) > 0)
{
while($ro=mysqli_fetch_array($sq))
{
	$sid=$ro['dallocs_id'];
	$cro=$ro['dallocs_crop'];
	$variet=$ro['dallocs_variety'];
	$newvariet=$ro['dallocs_variety'];
	$orn=$ro['dallocs_ordno'];
	$upstyp=$ro['dallocs_upstype'];
	$up=$ro['dallocs_ups'];
	$qt=$ro['dallocs_oqty'];
	$dispqty1=$ro['dallocs_dispqty'];
	
	$onop=$ro['dallocs_onop'];
	$oqty=$ro['dallocs_oqty'];
	$onomp=$ro['dallocs_onomp'];
	$alnolp=$ro['dallocs_allocnop'];
	$alnomp=$ro['dallocs_allocnomp'];
	$alqty=$ro['dallocs_allocqty'];
	//$tnolp=$ro['dallocs_nop'];
	$tnolp=0;
	$tnomp=0;
	$tqty=0;
	//$tqty=$ro['dallocs_qty'];
	$sql_dalcsubsub=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
	$tot_dalcsubsub=mysqli_num_rows($sql_dalcsubsub);
	while($row_dalcsubsub=mysqli_fetch_array($sql_dalcsubsub))
	{
		$tqty=$tqty+$row_dalcsubsub['dallocss_qty'];
	}
	$tqty=$tqty-$dispqty1;
	//$bnolp=$ro['dallocs_bnop'];	//$bnomp=$ro['dallocs_bnomp'];	//$bqty=$ro['dallocs_bqty'];
	
	$sq23=mysqli_query($link,"Select distinct dallocss_lotno from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
	}
	
	
	$sql_dalcsubsub=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid' and dallocss_altype!='barcodewise'") or die(mysqli_error($link));
	$tot_dalcsubsub=mysqli_num_rows($sql_dalcsubsub);
	while($row_dalcsubsub=mysqli_fetch_array($sql_dalcsubsub))
	{
		$tnomp=$tnomp+$row_dalcsubsub['dallocss_nomp'];
		$tnolp=$tnolp+$row_dalcsubsub['dallocss_nolp'];
	}
	
	$sql_dalcsubsub2=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid' and dallocss_altype='barcodewise'") or die(mysqli_error($link));
	if($tot_dalcsubsub2=mysqli_num_rows($sql_dalcsubsub2))
	while($row_dalcsubsub2=mysqli_fetch_array($sql_dalcsubsub2))
	{
		$sq231=mysqli_query($link,"Select distinct dallocss3_barcode from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and dallocs_id='$sid' and dalloc_id='$tid' and dallocss_id='".$row_dalcsubsub2['dallocss_id']."'") or die(mysqli_error($link));
		$totre231=mysqli_num_rows($sq231);
		while($row231=mysqli_fetch_array($sq231))
		{
			$tnomp=$tnomp+1;
		}
	}
	
	$sqmmc1=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and dalloc_id='$tid' and dallocs_id='$sid' and dmmc_flg=1") or die(mysqli_error($link));
	$totmmc1=mysqli_num_rows($sqmmc1);
	while($rommc1=mysqli_fetch_array($sqmmc1))
	{
		$tnomp=$tnomp+1;
	}

	$zx=explode(" ",$up);
	
	$sql_sel="select * from tblups where wt='".$zx[1]."' and ups='".$zx[0]."' order by uom Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	$row1234=mysqli_num_rows($res);
	$row12=mysqli_fetch_array($res);
	$uid=$row12['uid'];
	
	$sqlvsriety=mysqli_query($link,"Select * from tblvariety where popularname='".$variet."' and actstatus='Active'") or die(mysqli_error($link));
	$totvariety=mysqli_num_rows($sqlvsriety);
	$rowvariety=mysqli_fetch_array($sqlvsriety);
	$srnonew=0;
	$p1_array=explode(",",$rowvariety['gm']);
	$p1_array2=explode(",",$rowvariety['wtmp']);
	$p1_array3=explode(",",$rowvariety['mptnop']);
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			if($val1==$uid)
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
		}
		$srnonew++;
	}	
	
	if($zx[1]=="Gms")
	{ 
		$ptp=(1000/$zx[0]);
		$ptp1=($zx[0]/1000);
	}
	else
	{
		$ptp=$zx[0];
		$ptp1=$zx[0];
	}
	$alnolp=$tnolp;
	$nnp=$ptp*($alnomp*$wtmp);
	$tlnomp=$onpmp-$tnomp;
	$nnp=$nnp+$alnolp;
	
	$bnolp=$onop-$tnolp;
	$bnomp=$onomp-$tnomp;
	$bqty=$oqty-$tqty;
	$bqty=round($oqty,3)-round($tqty,3);	
	if($bnomp<0)$bnomp=0;
	if($bqty<=0){$bnolp=0;$bnomp=0;$bqty=0;}
?>
<tr class="Dark" height="30">
	<td width="65" align="center"  valign="middle" class="smalltbltext"><?php echo $onop;?><input type="hidden" name="txtenop" id="txtenop" value="<?php echo $onop;?>" /></td>
	<td width="45" align="center"  valign="middle" class="smalltbltext"><?php echo $onomp;?><input type="hidden" name="txtornomp" id="txtornomp" value="<?php echo $onomp;?>" /> <input type="hidden" name="txteordno" id="txteordno" value="<?php echo $orn;?>" /></td>
	<td width="65" align="center"  valign="middle" class="smalltbltext"><?php echo $oqty;?><input type="hidden" name="txteoqty" id="txteoqty" value="<?php echo $oqty;?>" /></td>
	<td width="60" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="3" name="txtallonolp" id="txtallonolp" value="<?php echo $alnolp;?>" onchange="nompchk2(this.value);" readonly="true" style="background-color:#CCCCCC"  /></td>
	<td width="60" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" name="txtallnomp" size="3" id="txtallnomp" value="<?php echo $alnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="70" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" name="txttobealqty" size="5" id="txttobealqty" value="<?php echo $alqty;?>" onkeypress="return isNumberKey(event)" onchange="itmqtychk(this.value);"  />&nbsp;<font color="#FF0000"> *</font></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="3" name="txttlonomp" id="txttlonomp" value="<?php echo $tnomp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="3" name="txttlonolp" id="txttlonolp" value="<?php echo $tnolp;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="84" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="3" maxlength="5" name="txtloqty" id="txtloqty" value="<?php echo $tqty;?>" onchange="nompchk(this.value);" readonly="true" style="background-color:#CCCCCC"  /></td>
	<td width="80" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtlonolots" id="txtlonolots" value="<?php echo $nolots;?>" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="91" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="3" name="txtorblnomp" id="txtorblnomp" value="<?php echo $bnomp;?>" onchange="nompchk2(this.value);" readonly="true" style="background-color:#CCCCCC"  /></td>
	<td width="70" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtorblnolp" id="txtorblnolp" value="<?php echo $bnolp;?>" onchange="nompchk2(this.value);" readonly="true" style="background-color:#CCCCCC"  /></td>
	<td width="65" align="center"  valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" size="5" name="txtorblqty" id="txtorblqty" value="<?php echo $bqty;?>" onchange="nompchk2(this.value);" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<input type="hidden" name="ewtmp" value="<?php echo $wtmp;?>" /><input type="hidden" name="emptnop" value="<?php echo $mptnop;?>" />
<?php
}
}
?>
</table>
</div>
<?php 
if($totre==0)
{
?>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" onClick="backupform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>
</div>
<br />
<div id="unallc">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Type</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext"><input type="radio" name="etdunallctyp" class="tbltext" value="edtfralcwise" onClick="edtunalloctype(this.value);" />&nbsp;Further Allocation&nbsp;&nbsp;<input type="radio" name="etdunallctyp" class="tbltext" value="edtunalcwise" onClick="edtunalloctype(this.value);" />&nbsp;Un-Allocation&nbsp;<font color="#FF0000" >*</font>&nbsp;<input type="hidden" name="edtunallocationtype" value="" /><input type="hidden" name="edtunseltyp" value="" /></td></tr>
</table>
</div>
<br />
<div id="edtfrunalctyp" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Un-Allocation Type</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Un-Allocation type&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext"><input type="radio" name="unallctyp" class="tbltext" value="unlotwise" onClick="unalloctype(this.value);" />&nbsp;Pick to Un-Allocate&nbsp;&nbsp;<input type="radio" name="unallctyp" class="tbltext" value="unbarcodewise" onClick="unalloctype(this.value);" />&nbsp;Scan to Un-Allocate&nbsp;<font color="#FF0000" >*</font>&nbsp;<input type="hidden" name="unallocationtype" value="" /><input type="hidden" name="eunseltyp" value="" /></td></tr>
</table>
</div>
<div id="edtfralctyp" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Allocation Type</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Allocation type&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext"><input type="radio" name="allctyp" class="tbltext" value="lotwise" onClick="fralloctype(this.value);" />&nbsp;Pick to Allocate&nbsp;&nbsp;<input type="radio" name="allctyp" class="tbltext" value="barcodewise" onClick="fralloctype(this.value);" />&nbsp;Scan to Allocate&nbsp;<font color="#FF0000" >*</font>&nbsp;<input type="hidden" name="allocationtype" value="" /><input type="hidden" name="eseltyp" value="" /></td></tr>
</table>
</div>
<br />
<div id="altypdetails" style="display:block">

<div id="barcwise" style="display:block"></div>
<div id="lotnwise" style="display:none"></div>

<input type="hidden" name="sln" value="<?php echo $sln;?>"  /><input type="hidden" name="tsln" value="<?php echo $tsln;?>"  />
<input type="hidden" name="totnewsloc" value="0" /><input type="hidden" name="newsloc" value="" />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="bform2();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<!--<div id="postingsubsubtable" style="display:block">

</div>-->