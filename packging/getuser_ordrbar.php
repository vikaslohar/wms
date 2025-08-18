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
	}require_once("../include/config.php");
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
  $tid = $_GET['c'];	 
}


	
$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno='$a'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$arrivalid=$row_month['orderm_id'];
$sql_mon=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrivalid."' order by order_sub_crop")or die("Error:".mysqli_error($link));
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading">#</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Order No.</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Crop</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Variety</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="tbltext">UPS</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoP</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty</td>
	<td width="275" align="center"  valign="middle" class="tbltext">NoMP Loaded</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Loaded</td>
	<td width="275" align="center"  valign="middle" class="tbltext">Qty Balance</td>
</tr>
<?php 
$sn=1;
while($row_tbl_sub=mysqli_fetch_array($sql_mon))
{
$flg=0;
$lotno=""; $qty=""; $totqty=0; $crop=""; $variety=""; $lotno=""; $ups=""; $packtyp=""; $crid=""; $vrid=""; 

	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$b."'") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	if($tot_barcode1==0)$flg=1;
	
	$pty=$row_barcode1['mpmain_trtype'];
	if($pty=="PACKSMC")
	$packtyp="SMC";
	if($pty=="PACKLMC")
	$packtyp="LMC";
	if($pty=="PACKMMC")
	$packtyp="MMC";
	
	if($pty=="PACKSMC")
	{
		
		$lotno=$row_barcode1['mpmain_lotno'];
		$qty=$row_barcode1['mpmain_wtmp'];
		$totqty=$row_barcode1['mpmain_wtmp'];
		$ups=$row_barcode1['mpmain_upssize'];
		
		if($row_tbl_sub['order_sub_crop']!=$row_barcode1['mpmain_crop'])$flg=1;
		
		if($row_tbl_sub['order_sub_variety']!=$row_barcode1['mpmain_variety'])$flg=1;
		
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}
	else
	{
		$ups=$row_barcode1['mpmain_upssize'];
		$lotn=explode(",",$row_barcode1['mpmain_lotno']);
		foreach($lotn as $ltn)
		{
			if($ltn<>"")
			{
				if($lotno!="")
					$lotno=$lotno."<br/>".$ltn;
				else
					$lotno=$ltn;
			}
		}
		$ltnp=explode(",",$row_barcode1['mpmain_lotnop']);
		foreach($ltnp as $ltnop)
		{
			if($ltnop<>"")
			{
				$xc=explode(" ",$row_barcode1['mpmain_upssize']);
				if($xc[1]=="Gms")
				{
					$ptp=$xc[0]/1000;
				}
				else
				{
					$ptp=$xc[0];
				}
				$qt=$ptp*$ltnop;
				
				if($qty!="")
					$qty=$qty."<br/>".$qt;
				else
					$qty=$qt;
			}
		}
		$totqty=$row_tbl_sub['mpwtmp'];
		
		if($row_tbl_sub['order_sub_crop']!=$row_barcode1['mpmain_crop'])$flg=1;
		if($row_tbl_sub['order_sub_variety']!=$row_barcode1['mpmain_variety'])$flg=1;
		
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}
	

$crop=""; $variety=""; $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";

			if($reptyp1=="hold")
	    	{	
				if($row_tbl_sub['order_sub_hold_flag']!=0)
				$statussub=$row_tbl_sub['order_sub_hold_type'];	
			}
			else
			{
			$statussub="";
			}


		$variet=$row_dept4['popularname'];
		$upstyp=$row_tbl_sub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['order_sub_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['order_sub_crop'];
		}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['order_sub_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['order_sub_variety'];	
		}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		/*if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}*/
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}
		//echo $row_tbl_sub['order_sub_id'];
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrivalid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	/*$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}*/
	
	//$up1=$qt1." ".$zz[1];
	$up=$row_sloc['order_sub_sub_ups'];
	/*if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";*/


	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{
		$sstatus=$row_sloc['order_sub_sub_nop'];
	}
	 //$row_tbl_sub['arrsub_id'];
}
//echo $up;
if($up!=$ups)$flg=1;
//echo $flg;
$dt=date("Y-m-d");
if($flg==0 && $b!="")	 
{
	if($tid==0)
	{
		$sql_main="Insert into tbls_disp (disp_date, disp_dcno, disp_dcdate, disp_ptype, disp_state, disp_location, disp_party, disp_orderno, disp_logid, disp_yearcode, plantcode) values('$dt', 'Demo', '".$dt."', '".$row_month['orderm_party_type']."', '".$row_month['orderm_locstate']."', '".$row_month['orderm_location']."', '".$row_month['orderm_party']."', '".$a."', '".$logid."', '".$yearid_id."', '$plantcode')";
		if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
		{
			$trid=mysqli_insert_id($link);
			$sql_sub="Insert into tbls_dispsub (disp_id, disps_crop, disps_variety, disps_upstype, disps_ups, disps_onop, disps_oqty, disps_orsubid, plantcode) values('$trid', '".$crop."', '".$variety."', '".$upstyp."', '".$up."', '".$sstatus."', '".$qt."', '".$row_tbl_sub['order_sub_id']."', '$plantcode')";
			if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
			{
				$subid=mysqli_insert_id($link);
				$bqty=$qt-$qty;
				$sql_subsub="Insert into tbls_dispsubsub (disp_id, disps_id, dispss_onomp, dispss_oqty, dispss_nomp, dispss_qty, dispss_balnomp, dispss_balqty, plantcode) values('$trid', '".$subid."', '0', '".$qt."', '1', '".$qty."', '1', '".$bqty."', '$plantcode')";
				$s=mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
			}
		}
	}
	else
	{
		$trid=$tid;
		$sql_s=mysqli_query($link,"Select max(disps_id) from tbls_dispsub where plantcode='$plantcode' and disp_id='$trid' and disps_crop='".$crop."' and disps_variety='".$variety."'") or die(mysqli_error($link));
		$row_s=mysqli_fetch_array($sql_s);
		$sql_sb=mysqli_query($link,"Select * from tbls_dispsub where plantcode='$plantcode' and disp_id='$trid' and disps_crop='".$crop."' and disps_variety='".$variety."' and disps_id='".$row_s[0]."'") or die(mysqli_error($link));
		$row_sb=mysqli_fetch_array($sql_sb);
		
		$sql_ss=mysqli_query($link,"Select max(dispss_id) from tbls_dispsubsub where plantcode='$plantcode' and disp_id='$trid' and disps_id='".$row_s[0]."'") or die(mysqli_error($link));
		$row_ss=mysqli_fetch_array($sql_ss);
		$sql_ssb=mysqli_query($link,"Select * from tbls_dispsubsub where plantcode='$plantcode' and disp_id='$trid' and disps_id='".$row_s[0]."' and dispss_id='".$row_ss[0]."'") or die(mysqli_error($link));
		$row_ssb=mysqli_fetch_array($sql_ssb);
		if($t=mysqli_num_rows($sql_ssb) > 0)	
		{	
			$bqty=$row_ssb['dispss_balqty']-$qty;
			$bnomp=$row_ssb['dispss_balnomp']+1;
		}
		else
		{
			$bqty=$qt-$qty;
			$bnomp=1;
		}
		$sql_sub="Insert into tbls_dispsub (disp_id, disps_crop, disps_variety, disps_upstype, disps_ups, disps_onop, disps_oqty, disps_orsubid, plantcode) values('$trid', '".$crop."', '".$variety."', '".$upstyp."', '".$up."', '".$sstatus."', '".$qt."', '".$row_tbl_sub['order_sub_id']."', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			
			$sql_subsub="Insert into tbls_dispsubsub (disp_id, disps_id, dispss_onomp, dispss_oqty, dispss_nomp, dispss_qty, dispss_balnomp, dispss_balqty, plantcode) values('$trid', '".$subid."', '".$row_ssb['dispss_balnomp']."', '".$row_ssb['dispss_balqty']."', '1', '".$qty."', '$bnomp', '".$bqty."', '$plantcode')";
			$s=mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
		}
	}
	$tid=$trid;
}
if($tid>0)
{
	$sql_s=mysqli_query($link,"Select max(disps_id) from tbls_dispsub where plantcode='$plantcode' and disp_id='$tid' and disps_crop='".$crop."' and disps_variety='".$variety."'") or die(mysqli_error($link));
	$row_s=mysqli_fetch_array($sql_s);
	$sql_sb=mysqli_query($link,"Select * from tbls_dispsub where plantcode='$plantcode' and disp_id='$tid' and disps_crop='".$crop."' and disps_variety='".$variety."' and disps_id='".$row_s[0]."'") or die(mysqli_error($link));
	$row_sb=mysqli_fetch_array($sql_sb);
			
	$sql_ss=mysqli_query($link,"Select max(dispss_id) from tbls_dispsubsub where plantcode='$plantcode' and disp_id='$tid' and disps_id='".$row_s[0]."'") or die(mysqli_error($link));
	$row_ss=mysqli_fetch_array($sql_ss);
	$sql_ssb=mysqli_query($link,"Select * from tbls_dispsubsub where plantcode='$plantcode' and disp_id='$tid' and disps_id='".$row_s[0]."' and dispss_id='".$row_ss[0]."'") or die(mysqli_error($link));
	$row_ssb=mysqli_fetch_array($sql_ssb);
	if($t=mysqli_num_rows($sql_ssb) > 0)	
	{	
	$bqty=$qt-$row_ssb['dispss_balqty'];
	$bnomp=$row_ssb['dispss_balnomp'];
	$balqty=$row_ssb['dispss_balqty'];
	}
	else
	{
		$bqty="";
		$bnomp="";
		$balqty="";
	}
}
else
{
	$bqty="";
	$bnomp="";
	$balqty="";
}	
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $a;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $bnomp;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $bqty;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $balqty;?></td>
</tr>
<?php
$sn++;
}
?>
</table><input type="hidden" name="maintrid" value="<?php echo $tid?>" />