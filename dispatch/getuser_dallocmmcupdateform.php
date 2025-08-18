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
	
	
	if(isset($_POST['snlo'])) { $snlo=$_POST['snlo']; }
	if(isset($_POST['sno1'])) { $sno1=$_POST['sno1']; }
	if(isset($_POST['sn'])) { $sn=$_POST['sn']; }
	if(isset($_POST['totnewsloc'])) { $totnewsloc=$_POST['totnewsloc']; }
	
	if(isset($_POST['maintrid'])) { $maintrid=$_POST['maintrid']; }
	if(isset($_POST['subtrid'])) { $subtrid=$_POST['subtrid']; }
	if(isset($_POST['subsubtrid'])) { $subsubtrid=$_POST['subsubtrid']; }

	//frm_action=submit&txt14=&txtid=1&logid=DP1&getdetflg=0&txtconchk=&txtptype=&txtcountrysl=&txtcountryl=&rettype=&extdcno=&plantcodes=&yearcodes=&trsbmval=0&date=30-11-2015&txtpp=Dealer&txtstatesl=Uttar%20Pradesh&txtlocationsl=289&locationname=289&txtstfp=744&adddchk=&ecrop1=Bhindi&evariety1=Deepika&eupstyp1=NST&eups1=100.000%20Gms&enop1=112&eqty1=10&eordno1=OS1132%2F15-16%2FOB2&enoordno1=1&rnob1=0&txtnolots=0&rqty1=11.200&grswt1=&bnop1=11.2&selsh1=1&ecrop2=Bhindi&evariety2=Deepika&eupstyp2=ST&eups2=100.000%20Gms&enop2=3640&eqty2=0&eordno2=OS1132%2F15-16%2FOB2&enoordno2=1&rnob2=4&txtnolots=0&rqty2=60.000&grswt2=&bnop2=4&selsh2=2&sn=3&mchksel=2&txtornos=&txtveridno=&txtupsnos=&txteqty=&totbarcs=&totlots=&ltno=HA01203%2F00441%2F00P&nolp=12&mqt=1.2&selmmc=1&ltno=DA01167%2F00000%2F00P&nolp=100&mqt=10&selmmc=2&sno1=3&ewtmp=&emptnop=&txtolotno1=HA01203%2F00441%2F00P&txtonob1=12&txtoqty1=1.2&txtnups1=100.000%20Gms&extslwhg11=1&extslbing11=133&extslsubbg11=2655&txtextnob11=12&txtextqty11=1.200&recnolbp11=10&recqtyp11=1.000&txtbalnobp11=2&txtbalqtyp11=0.200&srno2=1&txtolotno2=DA01167%2F00000%2F00P&txtonob2=100&txtoqty2=10&txtnups2=100.000%20Gms&extslwhg12=1&extslbing12=133&extslsubbg12=2655&txtextnob12=100&txtextqty12=10&recnolbp12=80&recqtyp12=8.000&txtbalnobp12=20&txtbalqtyp12=2.000&srno2=1&snlo=2&maintrid=3&subtrid=4&subsubtrid=&totnewsloc=0

	$mainid=$maintrid;
	$j=$mchksel;
	
	if($mchksel!="")
	{
		for($i=1; $i<=$snlo; $i++)
		{
			$srno2x="srno2".$i;
			$txtolotnox="txtolotno".$i;
			$txtonobx="txtonob".$i;
			$txtoqtyx="txtoqty".$i;
			$txtnupsx="txtnups".$i;
			if(isset($_POST[$srno2x])) { $srno2= $_POST[$srno2x]; }
			if(isset($_POST[$txtolotnox])) { $txtolotno= $_POST[$txtolotnox]; }
			if(isset($_POST[$txtonobx])) { $txtonob= $_POST[$txtonobx]; }
			if(isset($_POST[$txtoqtyx])) { $txtoqty= $_POST[$txtoqtyx]; }
			if(isset($_POST[$txtnupsx])) { $txtnups= $_POST[$txtnupsx]; }
			
			$blnop=0; $blqty=0; $t=0;
			
			for($k=1; $k<=$srno2; $k++)
			{
				$extslwhgx="extslwhg".$k.$i;
				$extslbingx="extslbing".$k.$i;
				$extslsubbgx="extslsubbg".$k.$i;
				$txtextnobx="txtextnob".$k.$i;
				$txtextqtyx="txtextqty".$k.$i;
				$recnolbpx="recnolbp".$k.$i;
				$recqtypx="recqtyp".$k.$i;
				$txtbalnobpx="txtbalnobp".$k.$i;
				$txtbalqtypx="txtbalqtyp".$k.$i;
				
				if(isset($_POST[$extslwhgx])) { $extslwhg= $_POST[$extslwhgx]; }
				if(isset($_POST[$extslbingx])) { $extslbing= $_POST[$extslbingx]; }
				if(isset($_POST[$extslsubbgx])) { $extslsubbg= $_POST[$extslsubbgx]; }
				if(isset($_POST[$txtextnobx])) { $txtextnob= $_POST[$txtextnobx]; }
				if(isset($_POST[$txtextqtyx])) { $txtextqty= $_POST[$txtextqtyx]; }
				if(isset($_POST[$recnolbpx])) { $recnolbp= $_POST[$recnolbpx]; }
				if(isset($_POST[$recqtypx])) { $recqtyp= $_POST[$recqtypx]; }
				if(isset($_POST[$txtbalnobpx])) { $txtbalnobp= $_POST[$txtbalnobpx]; }
				if(isset($_POST[$txtbalqtypx])) { $txtbalqtyp= $_POST[$txtbalqtypx]; }
				
				$sq=mysqli_query($link,"Select * from tbl_dallocsub_sub2 where plantcode='".$plantcode."' and  dalloc_id='$mainid' and dallocs_id='$subtrid' and dallocss2_lotno='$txtolotno'") or die(mysqli_error($link));
				$ro=mysqli_fetch_array($sq);
				$ssid=$ro['dallocss_id'];
				
				if($recqtyp > 0)
				{
					//$sql_subsub="insert into tbl_dallocmmc (dalloc_id, dallocs_id, dallocss_id, dmmc_lotno, dmmc_ewh, dmmc_ebin, dmmc_esubbin, dmmc_enolp, dmmc_enomp, dmmc_eqty, dmmc_nolp, dmmc_nomp, dmmc_qty, dmmc_bnolp, dmmc_bnomp, dmmc_bqty, dmmc_eups, dmmc_flg) values ('$mainid', '$subtrid', '$ssid', '$txtolotno', '$extslwhg', '$extslbing', '$extslsubbg', '$txtextnob', '0', '$txtextqty', '$recnolbp', '0', '$recqtyp', '$txtbalnobp', '0', '$txtbalqtyp', '$txtnups', '2')";
					$sql_subsub="insert into tbl_dallocmmc (dalloc_id, dallocs_id, dallocss_id, dmmc_lotno, dmmc_ewh, dmmc_ebin, dmmc_esubbin, dmmc_enolp, dmmc_enomp, dmmc_eqty, dmmc_nolp, dmmc_nomp, dmmc_qty, dmmc_bnolp, dmmc_bnomp, dmmc_bqty, dmmc_eups, dmmc_flg, plantcode) values ('$mainid', '$subtrid', '$ssid', '$txtolotno', '".$ro['dallocss2_wh']."', '".$ro['dallocss2_bin']."', '".$ro['dallocss2_subbin']."', '$txtextnob', '0', '$txtextqty', '$recnolbp', '0', '$recqtyp', '$txtbalnobp', '0', '$txtbalqtyp', '$txtnups', '2', '$plantcode')";
					if(mysqli_query($link,$sql_subsub) or die(mysqli_error($link)))
					{
						$mmcsid=mysqli_insert_id($link);
						$blnop=$blnop+$txtbalnobp; 
						$blqty=$blqty+$txtbalqtyp;
						$t++;
						$sql_subsub1="update tbl_dallocsub_sub2 set dallocss2_nolp='$txtbalnobp' where dalloc_id='$mainid' and dallocs_id='$subtrid' and dallocss2_lotno='$txtolotno' and dallocss2_subbin='".$ro['dallocss2_subbin']."'";
						$asdf1=mysqli_query($link,$sql_subsub1) or die(mysqli_error($link));	
					}
				}
			}
			if($t>0)
			{
				$sql_subsub2="update tbl_dallocsub_sub set dallocss_nolp='$blnop' where dalloc_id='$mainid' and dallocs_id='$subtrid' and dallocss_lotno='$txtolotno'";
				$asdf2=mysqli_query($link,$sql_subsub2) or die(mysqli_error($link));	
			}
		}
	}

	$tid=$mainid;

	$sql_tbl=mysqli_query($link,"select * from tbl_dalloc where plantcode='".$plantcode."' and  dalloc_id='".$tid."'") or die(mysqli_error($link));
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
  <td colspan="6" align="center" class="tblheading">Dispatch Allocation - MMC Allocation</td>
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
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">MMC Packaging List</td>
</tr>
<?php
	$sq_mmc2=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=1") or die(mysqli_error($link));
	$tot_mmc=mysqli_num_rows($sq_mmc2);
	
	$sq_mmc1=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=2") or die(mysqli_error($link));
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
$sq_mmc=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=1 and dmmc_barcode='".$row_mmc2['dmmc_barcode']."'") or die(mysqli_error($link));
while($row_mmc=mysqli_fetch_array($sq_mmc))
{
$mmcbrcd=$row_mmc['dmmc_barcode'];
$mmcwt=$row_mmc['dmmc_wtmp'];
$mmcgrswt=$row_mmc['dmmc_grosswt'];

$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' and  whid='".$row_mmc['dmmc_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' and  whid='".$row_mmc['dmmc_wh']."' and binid='".$row_mmc['dmmc_bin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$mmcsloc=$noticia_whd1['perticulars']."/".$noticia_bing1['binname'];


$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_id='".$row_mmc['dallocs_id']."' and dalloc_id='".$row_mmc['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

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
$mmcbrcd=$row_mmc1['dmmc_barcode'];
$mmcwt=$row_mmc1['dmmc_wtmp'];
$mmcgrswt=$row_mmc1['dmmc_grosswt'];

$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_id='".$row_mmc1['dallocs_id']."' and dalloc_id='".$row_mmc1['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

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
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsts;?></td>
</tr>
<?php
}
?>
</table>
<br />

<?php

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where plantcode='".$plantcode."' and  orderm_party='".$row_tbl['dalloc_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
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
	$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
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
			$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_crop='$atrid' order by order_sub_variety") or die(mysqli_error($link));
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
$sqlson=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) order by order_sub_variety")or die("Error:".mysqli_error($link));
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
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups ASC") or die(mysqli_error($link));
else
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='$orsid' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{ //echo $orsid."  =  ".$rowsloc['order_sub_sub_ups']."<br/>";
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{ 	//echo $verrid."  -  ".$rowsloc['order_sub_sub_ups']."  =  ".$rowsloc2['order_sub_id']."<br/>";
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

		

		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
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
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='".$plantcode."' and  orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' order by order_sub_sub_id") or die(mysqli_error($link));
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

if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_crop='$cro' and dallocs_variety='$variet'  and dallocs_alflg!=1 and dalloc_id='$tid' and dallocs_upstype='$upstyp' and dallocs_ups='$up1'") or die(mysqli_error($link));
else
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_alflg!=1 and dalloc_id='$tid' and dallocs_upstype='$upstyp' and dallocs_ups='$up1'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0; $nobarcs=""; $grswt=0; $tor=0; $mcflg=0; $nnolp=0; $mmcqty=0;

if($to=mysqli_num_rows($sq) > 0)
{
	$ro=mysqli_fetch_array($sq);
	$nups=$ro['dallocs_ups']; 
	$nnob=$ro['dallocs_nob']; 
	$nqty=$ro['dallocs_qty']; 
	//$nbqty=$ro['dallocs_bqty'];
	$nbqty=$qt-$nqty;
	$nbqty=round($qt,3)-round($nqty,3);
	if($nbqty<=0)$nbqty=0;
	$norno=$ro['dallocs_ordno'];
	//$nnomp=$ro['dallocs_nomp']; 
	$nnolp=$ro['dallocs_nop']; 
	$nnomp=0;
	
	$crpnm=$cp; 
	$vernm=$vt;
	$sid=$ro['dallocs_id'];
	$sn24=$sn;
	$dbsflg=$ro['dallocs_alflg'];
	if($sid==$subtid)$tor=1;
	
	$sq23=mysqli_query($link,"Select distinct dallocss3_barcode, dallocss3_grossweight from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
		if($nobarcs!="")
		$nobarcs=$nobarcs.",".$row23['dallocss3_barcode'];
		else
		$nobarcs=$row23['dallocss3_barcode'];
		$nnomp++;
		$grswt=$grswt+$row23['dallocss3_grossweight'];
	}



	$sq3=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
	$totre3=mysqli_num_rows($sq3);
	while($row3=mysqli_fetch_array($sq3))
	{
		$xc=explode(" ",$row3['dallocss_ups']);
		if($xc[1]=="Gms")
		{
			$ptp=$xc[0]/1000;
		}
		else
		{
			$ptp=$xc[0];
		}
		$qts=$ptp*$row3['dallocss_nolp'];
		$mmcqty=$mmcqty+$qts;
	}
	
if($grswt==0)$grswt="";
if(($nnomp==0 && $nqty>0)||$mmcqty>0){$mmcflg++; }
if($mmcqty<0)$mmcqty=0;
}

if($mmcqty>0){ 
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
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="grswt<?php echo $sn;?>" id="grswt_<?php echo $sn;?>" value="<?php echo $grswt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $mmcqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $mmcqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($tor>0 ){ ?><input type="radio" checked="checked" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $mmcqty?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $sid?>','<?php echo $tid?>')" value="<?php echo $sn;?>"  /><?php } else { ?><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $mmcqty?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $sid?>','<?php echo $tid?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
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
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:Pointer;" onClick="resetmmc('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $qt?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $subtid?>','<?php echo $tid?>');" />&nbsp;&nbsp;</td>
</tr>
</table>

<div id="showorsel">

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
	<td align="center" class="tblheading" colspan="12">Lots IN Progress - MMC Packaging List</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="25">
	<td width="19" align="center" class="smalltblheading">#</td>
	<td width="85" align="center" class="smalltblheading">Crop</td>
	<td width="115" align="center" class="smalltblheading">Variety</td>
	<td width="87" align="center" class="smalltblheading">Lot No.</td>
	<td width="67" align="center" class="smalltblheading">UPS</td>
	<td width="55" align="center" class="smalltblheading">NoLP</td>
	<td width="65" align="center" class="smalltblheading">Qty MMC</td>
	<!--<td width="67" align="center" class="smalltblheading">DoP</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>-->
	<td width="45" align="center" class="smalltblheading">QC Status</td>
	<td width="45" align="center" class="smalltblheading">QC at Packing</td>
	<td width="70" align="center" class="smalltblheading">DoT/DoSF</td>
	<td width="70" align="center" class="smalltblheading">DoV</td>
	<td width="64" align="center" class="smalltblheading">Days Remaining</td>
	<td width="140" align="center" class="smalltblheading">SLOC</td>
	<td width="40" align="center" class="smalltblheading"><a href="Javascript:void(0);" onclick="chkall('<?php echo $subtid;?>','<?php echo $tid?>','<?php echo $upstyp;?>','<?php echo $vt?>','','<?php echo $mmcqty?>','<?php echo $roo['dallocss_id']?>');">CA</a> / <a href="Javascript:void(0);" onclick="clrall();">CL</a></td>
</tr>
<?php 

$sno1=1;
$sqq_sub=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dalloc_id='$tid' and dallocs_id='$subtid'") or die(mysqli_error($link));

while($roo_sub=mysqli_fetch_array($sqq_sub))
{
$subtrid=$roo_sub['dallocs_id'];

$sqq=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dalloc_id='$tid' and dallocs_id='$subtrid'") or die(mysqli_error($link));
$tr=mysqli_num_rows($sqq);
while($roo=mysqli_fetch_array($sqq))
{

$quer4=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where popularname='".$roo_sub['dallocs_variety']."' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$verids=$row_dept4['varietyid'];
$upsids=$roo_sub['dallocs_ups'];
$c=$verids;		
$b=$row_dept4['cropname'];

$ltns=""; $dys="";
$sqlmonth=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_variety='$verids' and packtype='$upsids' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0")or die("Error:".mysqli_error($link));
$t2=mysqli_num_rows($sqlmonth);
while($rowmonth=mysqli_fetch_array($sqlmonth))
{
	$sqlmon3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$rowmonth['lotno']."'")or die("Error:".mysqli_error($link));
	$rowm3=mysqli_fetch_array($sqlmon3);
	
	$dt2=date("Y-m-d");
	$diff2 = abs(strtotime($rowm3['lotldg_valupto']) - strtotime($dt2));
	$days2 = floor($diff2 / (60*60*24));
		
	if($ltns=="")
		$ltns=$rowmonth['lotno'];
	else
		$ltns=$ltns.",".$rowmonth['lotno'];
		
	if($dys=="")
		$dys=$days2;
	else
		$dys=$dys.",".$days2;	
}
//echo $dys;
//echo $ltns;
$dayss=explode(",",$dys);
$ltnns=explode(",",$ltns);
//print_r($dayss);
natsort($ltnns);
natsort($dayss);

$value="";
foreach ($dayss as $key => $val) 
{
	$valu=$ltnns[$key];
	if($value=="")
		$value=$valu;
	else
		$value=$value.",".$valu;	
	//echo "$key = $val  -  $valu  \n";
}

//echo $value;
$ltno=explode(",",$value);
/*$sql_month=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_variety='$verids' and packtype='$upsids'")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sql_month);
while($row_month=mysqli_fetch_array($sql_month))
{*/
foreach($ltno as $lotn)
{
if($lotn<>"" && $lotn==$roo['dallocss_lotno'] )
{

$flg=0; $lotno=""; $nob=0; $qty=0; $totqty=0; $totnob=0; $crop=""; $variety=""; $qc=""; $dot=""; $sloc=""; $qcstsap='';

	$sqlmonth=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."'")or die("Error:".mysqli_error($link));
	while($rowmonth=mysqli_fetch_array($sqlmonth))
	{

		$sqlmonth2=mysqli_query($link,"select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_crop='$b' and lotldg_variety='$c' and packtype='$upsids' and lotno='".$lotn."' and subbinid='".$rowmonth['subbinid']."'")or die("Error:".mysqli_error($link));
		$rowmonth2=mysqli_fetch_array($sqlmonth2);
		
		$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$rowmonth2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0")or die("Error:".mysqli_error($link));
		while($rowmonth3=mysqli_fetch_array($sqlmonth3))
		{
			$nob=$rowmonth3['balnomp']; 
			$qty=$rowmonth3['balqty'];
			
			$qc=$rowmonth3['lotldg_qc'];
			$lotups=$rowmonth3['packtype'];
			$dot=$rowmonth3['lotldg_qctestdate'];
			
			$zz=str_split($lotn);
			$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
			$qcstsap="DoT";	$srfl=0; $qcdot2="";
			$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$lotn'") or die(mysqli_error($link));
			$row_pnp=mysqli_fetch_array($sql_pnp);
			$tot_pnp=mysqli_num_rows($sql_pnp);
			if($tot_pnp > 0)
			{
				$qcstsap=$row_pnp['pnpslipsub_qcdttype'];
				if($row_pnp['pnpslipsub_qcdttype']=="DoSF" || $row_pnp['pnpslipsub_qcdttype']=="DosF" || $row_pnp['pnpslipsub_qcdttype']=="DOSF")
				$srfl=1;
			}
									
			if($srfl==1)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
				$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
				if($tot_softr_sub > 0)
				{
					$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
					$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
					$tot_softr=mysqli_num_rows($sql_softr);
					$row_softr=mysqli_fetch_array($sql_softr);
					if($tot_softr > 0)
					{
						$qcdot2=$row_softr['softr_date'];
					}
				}
				if($qcdot2=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
					$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
					if($tot_softr_sub2 > 0)
					{
						$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
						$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
						$tot_softr2=mysqli_num_rows($sql_softr2);
						$row_softr2=mysqli_fetch_array($sql_softr2);
						if($tot_softr2 > 0)
						{
							$qcdot2=$row_softr2['softr_date'];
						}
					}
				}
			}
			if($srfl==1 && $qcdot2!=""){$dot=$qcdot2; $qcstsap='DoSF';}
			
			$trdate=$dot;
			$tryear=substr($trdate,0,4);
			$trmonth=substr($trdate,5,2);
			$trday=substr($trdate,8,2);
			$dot=$trday."-".$trmonth."-".$tryear;
			
			$tdate=$rowmonth3['lotldg_valupto'];
			$tyear=substr($tdate,0,4);
			$tmonth=substr($tdate,5,2);
			$tday=substr($tdate,8,2);
			$dov=$tday."-".$tmonth."-".$tyear;
			
			$dt=date("Y-m-d");
			$diff = abs(strtotime($rowmonth3['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
			if($days<30)$flg++;
			
			$vflg=0;
			
			if($qty > 0)
			{
				$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$rowmonth3['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars'];
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname'];
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$rowmonth3['subbinid']."' and binid='".$rowmonth3['binid']."' and whid='".$rowmonth3['whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				$diq=explode(".",$nob);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
				$nob=$difq;
				if($nob<0)$nob=0;
				
				$diq=explode(".",$qty);
				if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
				$qty=$difq1;
				
				$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
				
				if($sloc=="")

					$sloc=$slocs;
				else
					$sloc=$sloc."<br />".$slocs;
				
				$totqty=$totqty+$qty; 
				$totnob=$totnob+$nob;
			}
			
			$zz=explode(" ", $rowmonth3['lotldg_got1']);
		
			if($zz[0]=="GOT-NR")
			{
				if(($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				}
			}
			else
			{
				if(($rowmonth3['lotldg_got']=="UT" || $rowmonth3['lotldg_got']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="OK" && ($rowmonth3['lotldg_qc']=="UT" || $rowmonth3['lotldg_qc']=="RT") && $rowmonth3['lotldg_srflg']==0)
				{
					$vflg++; 
				}
				if($rowmonth3['lotldg_got']=="Fail" || $rowmonth3['lotldg_qc']=="Fail")
				{
					$vflg++; 
				} 
			}
			if($vflg > 0) $flg++;
		}
	}
	if($totnob<0)$totnob=0;
	if($totqty==0)$flg++;
	//if($totnob==0)$flg++;
	
	$sql_var=mysqli_query($link,"SELECT varietyid, popularname, cropname FROM tblvariety where varietyid='".$verids."' and actstatus='Active' order by popularname Asc"); 
	$row_var = mysqli_fetch_array($sql_var);
	$variety=$row_var['popularname'];
	
	$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_var['cropname']."' order by cropname Asc"); 
	$row_crp = mysqli_fetch_array($sql_crp);
	$crop=$row_crp['cropname'];
		
	$lotno=$lotn;
	//echo $flg;
	/*$llttn=""; $xcltn=array();
	
		if($llttn!="")
			$llttn=$llttn.",".$roo['dallocss_lotno'];
		else
			$llttn=$roo['dallocss_lotno'];
	}
	if($llttn!="")
	{
		$xcltn=explode(",",$llttn);
	}*/
$xc=explode(" ",$roo['dallocss_ups']);
if($xc[1]=="Gms")
{
	$ptp=$xc[0]/1000;
}
else
{
	$ptp=$xc[0];
}
$mmqty=$ptp*$roo['dallocss_nolp'];
//$mmqty=$mmcqty+$qttt;
			
//$mmqty=($roo['dallocss_qty']-($roo['dallocss_nomp']*$roo['dallocss_wtmp']));
$mq=0;	 $bnlp=0;
$sqmmc1=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dallocs_id='$subtid' and dmmc_lotno='$lotno' and dmmc_flg=2") or die(mysqli_error($link));
$totmmc1=mysqli_num_rows($sqmmc1);
while($rowmmc1=mysqli_fetch_array($sqmmc1))
{
	$mq=$mq+$rowmmc1['dmmc_bqty'];
	$bnlp=$bnlp+$rowmmc1['dmmc_bnolp'];
}
//echo $mq."  -  ".$mmqty;
if($mq==$mmqty)	{$mmqty=0;}
else
{
if($mq>0)
$mmqty=$mq;
}
if($mmqty>0)
{	
if($flg==0)	
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno1;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?><input type="hidden" name="ltno" id="ltno_<?php echo $sno1;?>" value="<?php echo $lotno?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $bnlp?><input type="hidden" name="nolp" id="nolp_<?php echo $sno1;?>" value="<?php echo $bnlp?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $mmqty?><input type="hidden" name="mqt" id="mqt_<?php echo $sno1;?>" value="<?php echo $mmqty?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcstsap;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $days;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><input type="checkbox" name="selmmc" id="selmmc_<?php echo $sno1;?>" value="<?php echo $sno1;?>"  onclick="selctmmc(this.value,'<?php echo $lotno;?>','<?php echo $subtid;?>','<?php echo $tid?>','<?php echo $lotups;?>','<?php echo $variety?>','<?php echo $roo['dallocss_nolp']?>','<?php echo $mmqty?>','<?php echo $roo['dallocss_id']?>')" /><input type="hidden" name="ssids" id="ssids_<?php echo $sno1;?>" value="<?php echo $roo['dallocss_id']?>" /></td>
	<!--<td align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>-->
</tr>
<?php
$sno1++;
}
}
}
}
}
}

?>
<input type="hidden" name="sno1" id="sno1" value="<?php echo $sno1;?>" />
</table>
<input type="hidden" name="ewtmp" id="ewtmp" value="<?php echo $wtmp;?>" /><input type="hidden" name="emptnop" id="emptnop" value="<?php echo $mptnop;?>" />
</div>
<br />
<div id="barupdetails" ></div>

<div id="lotnwise" style="display:none"></div>
<div id="postingsubtable" style="display:block">
<div id="postingsubsubtable" style="display:block">
<div id="shownsloc" style="display:">
<input type="hidden" name="sln" value="<?php echo $sln;?>"  /><input type="hidden" name="tsln" value="<?php echo $tsln;?>"  />
<input type="hidden" name="totnewsloc" value="0" /><input type="hidden" name="newsloc" value="" />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/mmc1.gif" border="0"style="display:inline;cursor:Pointer;" onClick="makemmcform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
</div>
</div></div>
