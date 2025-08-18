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
  
	if(isset($_POST['txtevariety'])) { $txtevariety=$_POST['txtevariety']; }
	if(isset($_POST['txteups'])) { $txteups=$_POST['txteups']; }
	if(isset($_POST['totenomp'])) { $totenomp=$_POST['totenomp']; }
	if(isset($_POST['txtelotno'])) { $txtelotno=$_POST['txtelotno']; }
	if(isset($_POST['barcode'])) { $barcode=$_POST['barcode'];	}
	if(isset($_POST['delbarcode'])) { $delbarcode=$_POST['delbarcode']; }
	
	if(isset($_POST['maintrid'])) { $maintrid=$_POST['maintrid']; }

	//frm_action=submit&txt14=&maintrid=&logid=DP1&txtevariety=337&txteups=500.000%20Gms&totenomp=2&txtelotno=HP01928%2F00000%2F00P&totbarcs=&totnobarcs=0&barcode=DP010052481&brflg=0&brchflg=1&delbarcode=

	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	
	$grweight=0;
	if($tot_barcode1>0)
	{
		$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
		$totbarcode=mysqli_num_rows($sqlbarcode);
		$rowbarcode=mysqli_fetch_array($sqlbarcode);
		$grweight=$rowbarcode['bar_grosswt'];
	}
	
	$pty=$row_barcode1['mpmain_trtype'];
	$wtmps=$row_barcode1['mpmain_wtmp'];
	$mptnops=$row_barcode1['mpmain_mptnop'];
	
	if($pty=="PACKSMC" || $pty=="PACKNMC")
	{
		$crp=""; $ver=""; $dov=""; $dot=""; $qc=""; $upss2="";
		
		$lot6=$row_barcode1['mpmain_lotno']; 
		$crp=$row_barcode1['mpmain_crop']; 
		$ver=$row_barcode1['mpmain_variety']; 
		$upss2=$row_barcode1['mpmain_upssize']; 
		$lotno=$row_barcode1['mpmain_lotno']; 
			
		$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lot6' and packtype='$upss2' order by lotdgp_id DESC") or die(mysqli_error($link));
		$tot_lot2=mysqli_num_rows($sql_lot2);
		$row_lot2=mysqli_fetch_array($sql_lot2);
		
		$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
		$tot_lot=mysqli_num_rows($sql_lot);
		$row_lot=mysqli_fetch_array($sql_lot);
		
		$qc=$row_lot['lotldg_qc'];
		$dovs2=$row_lot['lotldg_valupto'];
		$dots2=$row_lot['lotldg_qctestdate'];
		
		$zz=str_split($lot6);
		$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
								
		$srfl=0; $qcdot2="";
		$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$lot6'") or die(mysqli_error($link));
		$row_pnp=mysqli_fetch_array($sql_pnp);
		$tot_pnp=mysqli_num_rows($sql_pnp);
		if($tot_pnp > 0)
		{
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
		if($srfl==1 && $qcdot2!="")$dots2=$qcdot2;
			
		$dov=$dovs2;
		
		$dot=$dots2;
	}
	else if($pty=="PACKLMC" || $pty=="PACKNLC")
	{
		$crp=""; $ver=""; $dov=""; $dot=""; $qc=""; $upss2="";
		
		$crp=$row_barcode1['mpmain_crop']; 
		$ver=$row_barcode1['mpmain_variety']; 
		$upss2=$row_barcode1['mpmain_upssize']; 
		
		$lot60=$row_barcode1['mpmain_lotno']; 
		
		$lotno="";
		$lotn=explode(",",$lot60);
		foreach($lotn as $ltn)
		{
			if($ltn<>"")
			{
				$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$ltn' and packtype='$upss2' order by lotdgp_id DESC") or die(mysqli_error($link));
				$tot_lot2=mysqli_num_rows($sql_lot2);
				$row_lot2=mysqli_fetch_array($sql_lot2);
				
				$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
				$tot_lot=mysqli_num_rows($sql_lot);
				$row_lot=mysqli_fetch_array($sql_lot);
				
				$qcss2=$row_lot['lotldg_qc'];
				$dovs2=$row_lot['lotldg_valupto'];
				$dots2=$row_lot['lotldg_qctestdate'];
				
				$zz=str_split($ltn);
				$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
										
				$srfl=0; $qcdot2="";
				$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$ltn'") or die(mysqli_error($link));
				$row_pnp=mysqli_fetch_array($sql_pnp);
				$tot_pnp=mysqli_num_rows($sql_pnp);
				if($tot_pnp > 0)
				{
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
				if($srfl==1 && $qcdot2!="")$dots2=$qcdot2;
					
				if($qc!="")
					$qc=$qc.",".$qcss2;
				else
					$qc=$qcss2;
				
				if($dot!="")
					$dot=$dot.",".$dots2;
				else
					$dot=$dots2;
				
				if($dov!="")
					$dov=$dov.",".$dovs2;
				else
					$dov=$dovs2;
				
				if($lotno!="")
					$lotno=$lotno.",".$ltn;
				else
					$lotno=$ltn;
			}
		}
	}
	else if($pty=="PACKMMC")
	{
		$crp=""; $ver=""; $dov=""; $dot=""; $qc=""; $upss2="";
		
		$crps=$row_barcode1['mpmain_crop']; 
		$vers=$row_barcode1['mpmain_variety']; 
		$upss=$row_barcode1['mpmain_upssize']; 
		$lot60=$row_barcode1['mpmain_lotno']; 
		
		$lotno="";
		$lotn=explode(",",$lot60);
		$crps2=explode(",",$crps);
		$vers2=explode(",",$vers);
		$ups2=explode(",",$upss);
		for($i=0; $i<count($lotn); $i++)
		{
			$ltn=$lotn[$i];
			if($ltn<>"")
			{
				$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$ltn' and packtype='".$ups2[$i]."' order by lotdgp_id DESC") or die(mysqli_error($link));
				$tot_lot2=mysqli_num_rows($sql_lot2);
				$row_lot2=mysqli_fetch_array($sql_lot2);
				
				$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
				$tot_lot=mysqli_num_rows($sql_lot);
				$row_lot=mysqli_fetch_array($sql_lot);
				
				$qcss2=$row_lot['lotldg_qc'];
				$dovs2=$row_lot['lotldg_valupto'];
				$dots2=$row_lot['lotldg_qctestdate'];
				$crpss2=$crps2[$i];
				$verss2=$vers2[$i];
				$upss23=$ups2[$i];
				
				$zz=str_split($ltn);
				$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
										
				$srfl=0; $qcdot2="";
				$sql_pnp=mysqli_query($link,"Select * from tbl_pnpslipsub where plantcode='".$plantcode."' and  pnpslipsub_plotno='$ltn'") or die(mysqli_error($link));
				$row_pnp=mysqli_fetch_array($sql_pnp);
				$tot_pnp=mysqli_num_rows($sql_pnp);
				if($tot_pnp > 0)
				{
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
						$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 plantcode='".$plantcode."' and  where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
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
				if($srfl==1 && $qcdot2!="")$dots2=$qcdot2;
					
				if($qc!="")
					$qc=$qc.",".$qcss2;
				else
					$qc=$qcss2;
				
				if($dot!="")
					$dot=$dot.",".$dots2;
				else
					$dot=$dots2;
				
				if($dov!="")
					$dov=$dov.",".$dovs2;
				else
					$dov=$dovs2;
				
				if($crp!="")
					$crp=$crp.",".$crpss2;
				else
					$crp=$crpss2;
				
				if($ver!="")
					$ver=$ver.",".$verss2;
				else
					$ver=$verss2;
				
				if($lotno!="")
					$lotno=$lotno.",".$ltn;
				else
					$lotno=$ltn;
				
				if($upss2!="")
					$upss2=$upss2.",".$upss23;
				else
					$upss2=$upss23;
			}
		}
	}
	else
	{
	
	}
	
	$z1=$maintrid;
			
if($z1 == 0)
{
	if($barcode!="" && $brflg==0)
	{
		$sql_main="insert into tbl_dallocbarc_temp(dalloc_id, barc_crop, barc_variety, barc_lotno, barc_ups, barc_packtype, barc_barcode, barc_wtmp, barc_mptnop, barc_qc, barc_dot, barc_dov, barc_grosswt, barc_yearcode, barc_logid,plantcode) values ('$maintrid', '$crp', '$ver', '$lotno', '$upss2', '$pty', '$barcode', '$wtmps', '$mptnops', '$qc', '$dot', '$dov', '$grweight', '$yearid_id', '$logid','$plantcode')";
		mysqli_query($link,$sql_main) or die(mysqli_error($link));
		
		$sqlb1="update tbl_mpmain set mpmain_alflg=2 where mpmain_barcode='".$barcode."'";
		$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
	}
}
else
{
	if($barcode!="" && $brflg==0)
	{
		$sql_main="insert into tbl_dallocbarc_temp(dalloc_id, barc_crop, barc_variety, barc_lotno, barc_ups, barc_packtype, barc_barcode, barc_wtmp, barc_mptnop, barc_qc, barc_dot, barc_dov, barc_grosswt, barc_yearcode, barc_logid,plantcode) values ('$maintrid', '$crp', '$ver', '$lotno', '$upss2', '$pty', '$barcode', '$wtmps', '$mptnops', '$qc', '$dot', '$dov', '$grweight', '$yearid_id', '$logid','$plantcode')";
		mysqli_query($link,$sql_main) or die(mysqli_error($link));
		
		$sqlb1="update tbl_mpmain set mpmain_alflg=2 where mpmain_barcode='".$barcode."'";
		$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
	}
}


	$dtid=$z1;

	$sql_tbl=mysqli_query($link,"Select * from tbl_dallocbarc_temp where plantcode='".$plantcode."' and  dalloc_id='$dtid' and barc_logid='$logid' and barc_yearcode='$yearid_id'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);	
		
?>	
<div id="barupdetails" >
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Latest Barcode View</td>
</tr>
<tr class="Light" height="25">
	<!--<td width="20" align="center" class="smalltblheading">#</td>-->
	<td width="96" align="center" class="smalltblheading">Barcode</td>
	<td width="96" align="center" class="smalltblheading">Crop</td>
	<td width="130" align="center" class="smalltblheading">Variety</td>
	<td width="89" align="center" class="smalltblheading">UPS</td>
	<td width="102" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="67" align="center" class="smalltblheading">QC Status</td>
	<td width="90" align="center" class="smalltblheading">DoT</td>
	<td width="90" align="center" class="smalltblheading">DoV</td>
	<td width="80" align="center" class="smalltblheading">Net Weight</td>
	<td width="88" align="center" class="smalltblheading">Gross Weight</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php 
$sno=1; $barcode=""; $foccod="";
$sq6=mysqli_query($link,"Select * from tbl_dallocbarc_temp where plantcode='".$plantcode."' and  dalloc_id='$dtid' and barc_lotno='$txtelotno' and barc_logid='$logid' and barc_yearcode='$yearid_id'") or die(mysqli_error($link));
 $to6=mysqli_num_rows($sq6);
if($to6 > 0)
{
while($ro6=mysqli_fetch_array($sq6))
{
	$packtype2=$ro6['barc_packtype']; 
	$barcode=$ro6['barc_barcode']; 
	$grwts2=$ro6['barc_grosswt']; 
	$nqty6=$ro6['barc_wtmp'];
	
	if($foccod!="")
		$foccod=$foccod.",".$barcode;
	else
		$foccod=$barcode;
	
	if($packtype2=="PACKSMC" || $packtype2=="PACKNMC")
	{
		$crps=""; $vers=""; $dov=""; $dot=""; $qc=""; $upss2="";
		$lot6=$ro6['barc_lotno']; 
		$crps2=$ro6['barc_crop']; 
		$vers2=$ro6['barc_variety']; 
		$upss2=$ro6['barc_ups']; 
		$dovs2=$ro6['barc_dov']; 
		$qcss2=$ro6['barc_qc']; 
		$dots2=$ro6['barc_dot'];
		 
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$crps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vers=$row_dept4['popularname'];
			
		$tdate=$dovs2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dov=$tday."-".$tmonth."-".$tyear;
		
		$tdate=$dots2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dot=$tday."-".$tmonth."-".$tyear;
	}
	else if($packtype2=="PACKLMC" || $packtype2=="PACKNLC")
	{
		$crps=""; $vers=""; $dov=""; $dot=""; $qc=""; $upss2=""; 
		$crps2=$ro6['barc_crop']; 
		$vers2=$ro6['barc_variety']; 
		$upss2=$ro6['barc_ups'];
		
		$lot60=$ro6['barc_lotno']; 
		$dovs2=$ro6['barc_dov']; 
		$qcss2=$ro6['barc_qc']; 
		$dots2=$ro6['barc_dot'];
		
		$lotno="";
		$lotn=explode(",",$lot60);
		$dovs24=explode(",",$dovs2);
		$qcss24=explode(",",$qcss2);
		$qcss2=implode("<br/>",$qcss24);
		$dots24=explode(",",$dots2);
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
		$lot6=$lotno;
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
		


		 
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$crps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vers=$row_dept4['popularname'];
		
		foreach($dovs24 as $dov24)
		{
			if($dov24<>"")
			{	
				$tdate=$dov24;
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$dov2=$tday."-".$tmonth."-".$tyear;
				
				if($dov!="")
				$dov=$dov."<br/>".$dov2;
				else
				$dov=$dov2;
				
			}
		}	
		foreach($dots24 as $dot24)
		{
			if($dot24<>"")
			{	
				$tdate=$dot24;
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$dot2=$tday."-".$tmonth."-".$tyear;
				
				if($dot!="")
				$dot=$dot."<br/>".$dot2;
				else
				$dot=$dot2;
			}
		}	
	}
	else if($packtype2=="PACKMMC")
	{
		$lot6=$ro6['barc_lotno']; 
		$crps2=$ro6['barc_crop']; 
		$vers2=$ro6['barc_variety']; 
		$upss2=$ro6['barc_ups']; 
		$dovs2=$ro6['barc_dov']; 
		$qcss2=$ro6['barc_qc']; 
		$dots2=$ro6['barc_dot']; 
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$crps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vers=$row_dept4['popularname'];
			
		$tdate=$dovs2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dov2=$tday."-".$tmonth."-".$tyear;
		
		$tdate=$dots2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dot2=$tday."-".$tmonth."-".$tyear;
	}
	else
	{
	
	}
	
	
?>
<tr class="Dark" height="30">
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crps;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vers?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upss2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lot6?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcss2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
$sno++;
}
}
else
{
$sqlbarc1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$barcode."'") or die(mysqli_error($link));
$totbarc1=mysqli_num_rows($sqlbarc1);
$rowbarc1=mysqli_fetch_array($sqlbarc1);
if($totbarc1>0)
{
	$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$barcode."'") or die(mysqli_error($link));
	$totbarcode=mysqli_num_rows($sqlbarcode);
	$rowbarcode=mysqli_fetch_array($sqlbarcode);
	$grwts2=$rowbarcode['bar_grosswt'];
	
	$lotno=$rowbarc1['mpmain_lotno'];
	$vr1=$rowbarc1['mpmain_variety'];
	$ui1=$rowbarc1['mpmain_upssize'];
	$nqty6=$rowbarc1['mpmain_wtmp'];
	
	
	$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$ui1' and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
	$tot_lot2=mysqli_num_rows($sql_lot2);
	$row_lot2=mysqli_fetch_array($sql_lot2);
	
	$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
	$tot_lot=mysqli_num_rows($sql_lot);
	$row_lot=mysqli_fetch_array($sql_lot);
	
	$qcss2=$row_lot['lotldg_qc'];
	$vers=$row_lot['lotldg_variety'];
	$crps=$row_lot['lotldg_crop'];
	
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cps2=$row_dept5['cropname'];
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$vts2=$row_dept4['popularname'];
			
	$tdate=$row_lot['lotldg_valupto'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dov2=$tday."-".$tmonth."-".$tyear;
	
	$tdate=$row_lot['lotldg_qctestdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dot2=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Dark" height="30">
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cps2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vts2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ui1?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcss2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php	
}
}

if($brflg!=0)
{
	if($brflg==1)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode not present in System";
	if($brflg==2)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode already Dispatched";
	if($brflg==3)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode already Loaded in current OR other Operator's Transaction";
	if($brflg==4)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Variety not matching with Selected Line Item in Consolidated Pending Orders";
	if($brflg==5)
	$msgs="Barcode $barcode cannot be Allocated. Reason: UPS not matching with Selected Line Item in Consolidated Pending Orders";
	if($brflg==6)
	$msgs="Barcode $barcode cannot be Allocated. Reason: This Lot's current QC/GOT Status is FAIL";
	if($brflg==7)
	$msgs="Barcode $barcode cannot be Allocated. Reason: This Lot's current QC/GOT Status is UT and Soft Release is not activated";
	if($brflg==8)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date";
	if($brflg==9)
	$msgs="Barcode $barcode cannot be Allocated. Reason: This Barcode is already Unpackaged";
	if($brflg==10)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Lot is under Reserve Status";
	if($brflg==11)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode already Allocated";
	if($brflg==12)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Lot no. not matching with selected Barcode";
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading" colspan="10"><font color="#FF0000"><?php echo $msgs;?></font></td>
</tr>
<?php
}
?>
<input type="hidden" name="totbarcs" id="totbarcs" value="<?php echo $foccod;?>" /><input type="hidden" name="totnobarcs" id="totnobarcs" value="<?php echo $to6;?>" />
</table>
</div>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Loading</td></tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />

<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Loading (Unloading)</td> </tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />&nbsp;<font color="#FF0000">*  Deleted Barcode will be stored back to its original SLOC Bin</font></td></tr>
</table><br />