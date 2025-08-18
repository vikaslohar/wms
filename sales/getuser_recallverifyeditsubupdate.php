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

//frm_action=submit&txt11=&txt14=&txtid=&logid=SR1&slrgln1=&txtconchk=&txtptype=&txtcountrysl=&txtcountryl=&sstage=&date=17-07-2014&rbcrefno=DF00001&txtlotno1=HF04137%2F00000%2F00P&txtwhg1=4&txtbing1=156&txtsubbg1=3119&nopmpcs_1=2&noppchs_1=0&noptpchs_1=560&noptqtys_1=5.6&txtlotno2=HF04139%2F00000%2F00P&txtwhg2=4&txtbing2=156&txtsubbg2=3119&nopmpcs_2=1&noppchs_2=0&noptpchs_2=280&noptqtys_2=2.8&sno3=2&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin--&txtslBagsd1=&txtslqtyd1=&dorowid1=0&dorowid2=0&maintrid=1&subtrid=1&subsubtrid=&ptp=&ptp1=&wtmp=2.8&wtnop=&otnop=1400&otqty=14&ocrp=28&overty=461&oups=10.000%20Gms
	
	if(isset($_GET['txt11'])) { $txt11 = $_GET['txt11']; }
	if(isset($_GET['txt14'])) { $txt14 = $_GET['txt14']; }
	if(isset($_GET['txtid'])) { $txtid = $_GET['txtid']; }
	if(isset($_GET['date'])) { $date = $_GET['date']; }
	if(isset($_GET['rbcrefno'])) { $rbcrefno = $_GET['rbcrefno']; }
	
	if(isset($_GET['ocrp'])) { $txtcrop = $_GET['ocrp']; }
	if(isset($_GET['overty'])) { $txtvariety = $_GET['overty']; }
	if(isset($_GET['itmdchk'])) { $itmdchk = $_GET['itmdchk']; }
	if(isset($_GET['oups'])) { $txtupsdc = $_GET['oups']; }
	if(isset($_GET['otnop'])) { $txtnopdc = $_GET['otnop']; }
	if(isset($_GET['otqty'])) { $txtqtydc = $_GET['otqty']; }
	if(isset($_GET['maintrid'])) { $z1 = $_GET['maintrid']; }
	if(isset($_GET['subtrid'])) { $subtrid = $_GET['subtrid']; }
	if(isset($_GET['slrgln1'])) { $slrgln1 = $_GET['slrgln1']; }
	if(isset($_GET['wtmp'])) { $wtmp = $_GET['wtmp']; }
	
	if(isset($_GET['sno3'])) { $sno3 = $_GET['sno3']; }
	
	if(isset($_GET['txtslwhd1'])) { $txtslwhd1 = $_GET['txtslwhd1']; }
	if(isset($_GET['txtslbind1'])) { $txtslbind1 = $_GET['txtslbind1']; }
	if(isset($_GET['txtslsubbd1'])) { $txtslsubbd1 = $_GET['txtslsubbd1']; }
	if(isset($_GET['txtslBagsd1'])) { $txtslBagsd1 = $_GET['txtslBagsd1']; }
	
	if(isset($_GET['pcodeo'])) { $pcodeo = $_GET['pcodeo']; }
	if(isset($_GET['ycodeeo'])) { $ycodeeo = $_GET['ycodeeo']; }
	if(isset($_GET['txtlot2o'])) { $txtlot2o = $_GET['txtlot2o']; }
	if(isset($_GET['stcodeo'])) { $stcodeo = $_GET['stcodeo']; }
	if(isset($_GET['stcode2o'])) { $stcode2o = $_GET['stcode2o']; }
	if(isset($_GET['txtbarcode'])) { $txtbarcode = $_GET['txtbarcode']; }
	if(isset($_GET['txtpacktype'])) { $txtpacktype = $_GET['txtpacktype']; }
	if(isset($_GET['txtedop'])) { $txtedop = $_GET['txtedop']; }
	if(isset($_GET['txtcrop1'])) { $txtcrop1 = $_GET['txtcrop1']; }
	if(isset($_GET['txtvariety1'])) { $txtvariety1 = $_GET['txtvariety1']; }
	if(isset($_GET['txtelotn1'])) { $txtelotn1 = $_GET['txtelotn1']; }
	if(isset($_GET['txteups1'])) { $txteups1 = $_GET['txteups1']; }
	if(isset($_GET['txtenop1'])) { $txtenop1 = $_GET['txtenop1']; }
	if(isset($_GET['txteqty1'])) { $txteqty1 = $_GET['txteqty1']; }
	if(isset($_GET['txteqc1'])) { $txteqc1 = $_GET['txteqc1']; }
	if(isset($_GET['txtedot1'])) { $txtedot1 = $_GET['txtedot1']; }
	if(isset($_GET['txtegerm1'])) { $txtegerm1 = $_GET['txtegerm1']; }
	if(isset($_GET['txtemoist1'])) { $txtemoist1 = $_GET['txtemoist1']; }
	if(isset($_GET['txtepp1'])) { $txtepp1 = $_GET['txtepp1']; }
	if(isset($_GET['txtegottyp1'])) { $txtegottyp1 = $_GET['txtegottyp1']; }
	if(isset($_GET['txtedgot1'])) { $txtedgot1 = $_GET['txtedgot1']; }
	if(isset($_GET['txtedov1'])) { $txtedov1 = $_GET['txtedov1']; }
	if(isset($_GET['srrno'])) { $srrno = $_GET['srrno']; }
	if(isset($_GET['vtyp'])) { $vtyp = $_GET['vtyp']; } else { $vtyp = "verrec"; }
	
	$ltnno=$pcodeo.$ycodeeo.$txtlot2o."/".$stcodeo."/".$stcode2o."P";
	
	$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
	
	$god1=0;$god2=0;
	if($txtslqtyd1!="" && $txtslqtyd1 > 0) { $god1=1; }
	/*if($txtslqtyd2!="" && $txtslqtyd2 > 0) { $god2=1; }*/
		
$mainid=$z1;
	
if($subtrid == 0)
{
	$sql_sub="insert into tbl_salesrv_sub (salesr_id, salesrs_crop, salesrs_variety, salesrs_stage, salesrs_dovfy, salesrs_yearcode, salesrs_typ, salesrs_rettype, plantcode) values('$mainid', '$txtcrop', '$txtvariety', 'Pack', '$date', '$yearid_id', '$vtyp', '$rbcrefno', '$plantcode')";
	if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
	{
		$subid=mysqli_insert_id($link); $ltn="";
		for($j=1; $j<=$sno3; $j++)
		{
			$txtwhgx="txtwhg".$j;
			$txtbingx="txtbing".$j;
			$txtsubbgx="txtsubbg".$j;
			$txtnopmpcsx="nopmpcs_".$j;
			$txtnoppchsx="noppchs_".$j;
			$txtnoptpchsx="noptpchs_".$j;
			$txtnoptqtysx="noptqtys_".$j;
			$txtlotnox="txtlotno".$j;
			
			if(isset($_GET[$txtlotnox])) { $txtlotno= $_GET[$txtlotnox]; }
			if(isset($_GET[$txtwhgx])) { $txtslwhg= $_GET[$txtwhgx]; }
			if(isset($_GET[$txtbingx])) { $txtslbing= $_GET[$txtbingx]; }
			if(isset($_GET[$txtsubbgx])) { $txtslsubbg= $_GET[$txtsubbgx]; }
			if(isset($_GET[$txtnopmpcsx])) { $txtnopmpcs= $_GET[$txtnopmpcsx]; }
			if(isset($_GET[$txtnoptpchsx])) { $txtnoptpchs= $_GET[$txtnoptpchsx]; }
			if(isset($_GET[$txtnoptqtysx])) { $txtnoptqtys= $_GET[$txtnoptqtysx]; }
			if(isset($_GET[$txtnoppchsx])) { $txtnoppchs= $_GET[$txtnoppchsx]; }
			
			if($txtnoptqtys!="" || $txtnoptqtys > 0)
			{
				$nobcd="";
				$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$rbcrefno."'") or die(mysqli_error($link));
				while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
				{
					$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$txtcrop' and btslsub_variety='$txtvariety'") or die(mysqli_error($link));
					$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
					while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
					{
						if($rowbarcsub['btslsub_bctype']=='Identified')
						{
							$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$txtlotno' order by btslsub_id asc") or die(mysqli_error($link));
							while($row_btslm=mysqli_fetch_array($sql_btslm))
							{
								$brcod=$rowbarcsub['btslsub_barcode'];
								if($nobcd!="")
									$nobcd=$nobcd.",".$brcod;
								else
									$nobcd=$brcod;
							}
						}
						else
						{
							$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$txtlotno' order by btslsub_id asc") or die(mysqli_error($link));
							while($row_btslm=mysqli_fetch_array($sql_btslm))
							{
								$brcod=$rowbarcsub['btslsub_barcode'];
								if($nobcd!="")
									$nobcd=$nobcd.",".$brcod;
								else
									$nobcd=$brcod;
							}
						}
					}
				}
				$sql_sub_sub="insert into tbl_salesrvsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, salesrss_barcode, salesrss_lotno, salesrss_nomp, plantcode) values('$mainid', '$subid', '$txtslwhg', '$txtslbing', '$txtslsubbg', '$txtupsdc', '$txtnoptpchs', '$txtnoptqtys', '$nobcd', '$txtlotno', '$txtnopmpcs', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			}
		
			if($txtnoppchs!="" || $txtnoppchs > 0)
			{
				$packtp=explode(" ",$txtupsdc);
				$packtyp=$packtp[0]; 
				if($packtp[1]=="Gms") { $ptp=(1000/$packtp[0]);	}
				else { $ptp=$packtp[0]; }
				$nopsd=$ptp*$txtnoppchs;
				
				$sql_sub_sub3="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, salesrss_lotno, plantcode) values('$mainid', '$subid', '$txtslwhd1', '$txtslbind1', '$txtslsubbd1', '$txtupsdc', '$nopsd', '$txtnoppchs', '$txtlotno', '$plantcode')";
				mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link));
			}
		}
		/*if($god2==1)
		{
			$sql_sub_sub4="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty) values('$mainid', '$subid', '$txtslwhd2', '$txtslbind2', '$txtslsubbd2', '$txtupsdc', '$txtslBagsd2', '$txtslqtyd2')";
			mysqli_query($link,$sql_sub_sub4) or die(mysqli_error($link));
		}*/
	}	
	$z1=$mainid;
}
else
{
	$mainid=$z1;
	
	$sql_sub="update tbl_salesrv_sub  set salesrs_vflg='1', salesrs_dovfy='$date', salesrs_yearcode='$yearid_id', salesrs_typ='$vtyp', salesrs_rettype='$rbcrefno' where salesrs_id='$subtrid'";
	if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
	{
		$subid=$subtrid; $ltn="";
		
		$s_del="delete from tbl_salesrvsub_sub where salesrs_id='$subtrid'";
		$xsw=mysqli_query($link,$s_del) or die(mysqli_error($link));
		
		$s_del2="delete from tbl_salesrvsub_sub2 where salesrs_id='$subtrid'";
		$xsw2=mysqli_query($link,$s_del2) or die(mysqli_error($link));
		
		for($j=1; $j<=$sno3; $j++)
		{
			$txtwhgx="txtwhg".$j;
			$txtbingx="txtbing".$j;
			$txtsubbgx="txtsubbg".$j;
			$txtnopmpcsx="nopmpcs_".$j;
			$txtnoppchsx="noppchs_".$j;
			$txtnoptpchsx="noptpchs_".$j;
			$txtnoptqtysx="noptqtys_".$j;
			$txtlotnox="txtlotno".$j;
				
			if(isset($_GET[$txtlotnox])) { $txtlotno= $_GET[$txtlotnox]; }
			if(isset($_GET[$txtwhgx])) { $txtslwhg= $_GET[$txtwhgx]; }
			if(isset($_GET[$txtbingx])) { $txtslbing= $_GET[$txtbingx]; }
			if(isset($_GET[$txtsubbgx])) { $txtslsubbg= $_GET[$txtsubbgx]; }
			if(isset($_GET[$txtnopmpcsx])) { $txtnopmpcs= $_GET[$txtnopmpcsx]; }
			if(isset($_GET[$txtnoptpchsx])) { $txtnoptpchs= $_GET[$txtnoptpchsx]; }
			if(isset($_GET[$txtnoptqtysx])) { $txtnoptqtys= $_GET[$txtnoptqtysx]; }
			if(isset($_GET[$txtnoppchsx])) { $txtnoppchs= $_GET[$txtnoppchsx]; }
				
			if($txtnoptqtys!="" || $txtnoptqtys > 0)
			{
				$nobcd="";
				$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$rbcrefno."'") or die(mysqli_error($link));
				while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
				{
					$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$txtcrop' and btslsub_variety='$txtvariety'") or die(mysqli_error($link));
					$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
					while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
					{
						if($rowbarcsub['btslsub_bctype']=='Identified')
						{
							$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$txtlotno' order by btslsub_id asc") or die(mysqli_error($link));
							while($row_btslm=mysqli_fetch_array($sql_btslm))
							{
								$brcod=$rowbarcsub['btslsub_barcode'];
								if($nobcd!="")
									$nobcd=$nobcd.",".$brcod;
								else
									$nobcd=$brcod;
							}
						}
						else
						{
							$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$txtlotno' order by btslsub_id asc") or die(mysqli_error($link));
							while($row_btslm=mysqli_fetch_array($sql_btslm))
							{
								$brcod=$rowbarcsub['btslsub_barcode'];
								if($nobcd!="")
									$nobcd=$nobcd.",".$brcod;
								else
									$nobcd=$brcod;
							}
						}
					}
				}
				$sql_sub_sub="insert into tbl_salesrvsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, salesrss_barcode, salesrss_lotno, salesrss_nomp, plantcode) values('$mainid', '$subid', '$txtslwhg', '$txtslbing', '$txtslsubbg', '$txtupsdc', '$txtnoptpchs', '$txtnoptqtys', '$nobcd', '$txtlotno', '$txtnopmpcs', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			}
		
			if($txtnoppchs!="" || $txtnoppchs > 0)
			{
				$packtp=explode(" ",$txtupsdc);
				$packtyp=$packtp[0]; 
				if($packtp[1]=="Gms") { $ptp=(1000/$packtp[0]);	}
				else { $ptp=$packtp[0]; }
				$nopsd=$ptp*$txtnoppchs;
				
				$sql_sub_sub3="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty, salesrss_lotno, plantcode) values('$mainid', '$subid', '$txtslwhd1', '$txtslbind1', '$txtslsubbd1', '$txtupsdc', '$nopsd', '$txtnoppchs', '$txtlotno', '$plantcode')";
				mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link));
			}
		}
		/*if($god2==1)
		{
			$sql_sub_sub4="insert into tbl_salesrvsub_sub2 (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_ups, salesrss_nob, salesrss_qty) values('$mainid', '$subid', '$txtslwhd2', '$txtslbind2', '$txtslsubbd2', '$txtupsdc', '$txtslBagsd2', '$txtslqtyd2')";
			mysqli_query($link,$sql_sub_sub4) or die(mysqli_error($link));
		}*/
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
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Sales Recall' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."'") or die(mysqli_error($link));
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
$subtid=$row_tbl_sub['salesrs_id'];
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
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']!=1){?><a href="Javascript:void(0);" onclick="showverifysc('<?php echo $row_tbl['salesr_recallrefno'];?>','<?php echo $noticia['cropid'];?>','<?php echo $noticia_item['varietyid'];?>','<?php echo $slups;?>','<?php echo $difn;?>','<?php echo $difq;?>','<?php echo $subtid;?>');">Verify</a><?php }else{?>Verified<?php }?></td>
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
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']!=1){?><a href="Javascript:void(0);" onclick="showverifysc('<?php echo $row_tbl['salesr_recallrefno'];?>','<?php echo $noticia['cropid'];?>','<?php echo $noticia_item['varietyid'];?>','<?php echo $slups;?>','<?php echo $difn;?>','<?php echo $difq;?>','<?php echo $subtid;?>');">Verify</a><?php }else{?>Verified<?php }?></td>
</tr>
<?php
}
$srno++;
}
}

?>
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
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Sales Recall' and salesr_id='".$tid."'") or die(mysqli_error($link));
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
	<td width="51" align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
	<td width="52" align="center" valign="middle" class="tblheading" rowspan="2">Barcodes</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">As per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Good</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Damage</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Excess / Shortage</td>
	<!--<td width="36" align="center" valign="middle" class="tblheading" rowspan="2">QCSR</td>-->
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

$slocs=""; $ltno=""; $brcod=""; $acnop=0; $acnomp=0; $acqty=0; $dnop=0; $dqty=0;
$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{
if($ltno!="")
$ltno=$ltno."<br />".$row_salesvr_subsub['salesrss_lotno'];
else
$ltno=$row_salesvr_subsub['salesrss_lotno'];

if($brcod!="")
$brcod=$brcod."<br />".count(explode(",",$row_salesvr_subsub['salesrss_barcode']));
else
$brcod=count(explode(",",$row_salesvr_subsub['salesrss_barcode']));

$acnop=$acnop+$row_salesvr_subsub['salesrss_nob'];
$acnomp=$acnomp+$row_salesvr_subsub['salesrss_nomp'];
$acqty=$acqty+$row_salesvr_subsub['salesrss_qty'];

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

$sql_salesvr_subsub2=mysqli_query($link,"select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub2=mysqli_fetch_array($sql_salesvr_subsub2))
{
$dnop=$dnop+$row_salesvr_subsub2['salesrss_nob'];
$dqty=$dqty+$row_salesvr_subsub2['salesrss_qty'];
}

$nob=0; $qty=0; $difnop=0; $difqty=0;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
$qt=$acqty+$dqty;
$difnop=$acnop+$dnop-$nob;
$difqty=$qt-$difq;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $brcod;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext">UT</td>-->
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
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $brcod;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext">UT</td>-->
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
<input type="hidden" name="maintrid" value="<?php echo $pid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="" /><input type="hidden" name="ptp1" value="" /><input type="hidden" name="wtmp" id="wtmp" value="" /><input type="hidden" name="wtnop" id="wtnop" value="" />
</div>
</div>