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
if(isset($_GET['h']))
{
	$vrids = $_GET['h'];	 
}
if(isset($_GET['g']))
{
	$upids = $_GET['g'];	 
}
if(isset($_GET['l']))
{
	$itmno = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	$brfg = $_GET['m'];	 
}
$verids=$vrids;
$upsids=$upids;


$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  orderm_porderno='$a' and orderm_tflag=1")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$arrivalid=$row_month['orderm_id'];
$sql_mon=mysqli_query($link,"select * from tbl_order_sub where plantcode='".$plantcode."' and  orderm_id='".$arrivalid."' order by order_sub_crop")or die("Error:".mysqli_error($link));

?>
<div id="barupdetails" >
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Loading IN-Progress</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="28" align="center" class="smalltblheading">#</td>
	<td width="99" align="center" class="smalltblheading">Crop</td>
	<td width="134" align="center" class="smalltblheading">Variety</td>
	<td width="92" align="center" class="smalltblheading">UPS</td>
	<td width="117" align="center" class="smalltblheading">Lot No.</td>
	<td width="54" align="center" class="smalltblheading">NoMP</td>
	<td width="82" align="center" class="smalltblheading">Qty</td>
	<td width="89" align="center" class="smalltblheading">DoV</td>
	<td width="74" align="center" class="smalltblheading">QC Status</td>
	<td width="79" align="center" class="smalltblheading">DoT</td>
	<td width="102" align="center" class="smalltblheading">Barcodes</td>
</tr>
</table>
<?php
$totrec=6;
?>
<div id="table-wrapper" style=" <?php if($totrec<=4) {?>height:auto; width:945px; overflow:hidden;<?php } else{?>height:101px; width:970px; overflow:auto;<?php } ?>">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse;" > 
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>
<tr class="Light" height="25">
	<td width="28" align="center" class="smalltbltext">1</td>
	<td width="97" align="center" class="smalltbltext">Bhindi</td>
	<td width="131" align="center" class="smalltbltext">VNR-999</td>
	<td width="90" align="center" class="smalltbltext">250.000 Gms</td>
	<td width="115" align="center" class="smalltbltext">DF90375/00000/00P</td>
	<td width="53" align="center" class="smalltbltext">1</td>
	<td width="80" align="center" class="smalltbltext">10</td>
	<td width="87" align="center" class="smalltbltext">16-09-2015</td>
	<td width="73" align="center" class="smalltbltext">OK</td>
	<td width="80" align="center" class="smalltbltext">21-12-2014</td>
	<td width="92" align="center" class="smalltbltext"><a href="Javascript:void(0);">Details</a></td>
</tr>


</table>
</div>
</div><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Latest Barcode View</td>
</tr>
<tr class="Light" height="25">
	<td width="20" align="center" class="smalltblheading">#</td>
	<td width="70" align="center" class="smalltblheading">Barcode</td>
	<td width="70" align="center" class="smalltblheading">Crop</td>
	<td width="95" align="center" class="smalltblheading">Variety</td>
	<td width="65" align="center" class="smalltblheading">UPS</td>
	<td width="75" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="60" align="center" class="smalltblheading">Qty</td>
	<td width="67" align="center" class="smalltblheading">Gross Weight</td>
	<td width="67" align="center" class="smalltblheading">DoV</td>
	<td width="40" align="center" class="smalltblheading">QC Status</td>
	<td width="67" align="center" class="smalltblheading">DoT</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php 
$sno=1; $dt=date("Y-m-d");
//if($brfg==0)
{
$flg=0;
$lotno=""; $qty=""; $totqty=0; $crop=""; $variety=""; $lotno=""; $ups=""; $packtyp=""; $crid=""; $vrid=""; $sloc=""; $grweight="";

	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$b."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	//if($tot_barcode1==0)$flg=1;
	$vr=$row_barcode1['mpmain_variety'];
	$ui=$row_barcode1['mpmain_upssize'];
	//if($vr!=$verids)$flg=1; 
	//if($ui!=$upsids)$flg=1;
	
	if($tot_barcode1>0)
	{
		$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and  bar_barcode='".$b."'") or die(mysqli_error($link));
		$totbarcode=mysqli_num_rows($sqlbarcode);
		$rowbarcode=mysqli_fetch_array($sqlbarcode);
		$grweight=$rowbarcode['bar_grosswt'];
	}
	
	$pty=$row_barcode1['mpmain_trtype'];
	if($pty=="PACKSMC") $packtyp="SMC";
	if($pty=="PACKLMC") $packtyp="LMC";
	if($pty=="PACKMMC") $packtyp="MMC";
	if($pty=="PACKNMC")	$packtyp="NMC";
	if($pty=="PACKNLC") $packtyp="NLC";
							
	if($pty=="PACKSMC" || $pty=="PACKNMC")
	{
		
		$lotno=$row_barcode1['mpmain_lotno'];
		$qty=$row_barcode1['mpmain_wtmp'];
		$totqty=$row_barcode1['mpmain_wtmp'];
		$ups=$row_barcode1['mpmain_upssize'];
		
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where   cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where  varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
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
					$lotno=$lotno.",".$ltn;
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
	
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where   cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where   varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}

$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$lotno' and packtype='$ui' and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
$tot_lot2=mysqli_num_rows($sql_lot2);
$row_lot2=mysqli_fetch_array($sql_lot2);

$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
$tot_lot=mysqli_num_rows($sql_lot);
$row_lot=mysqli_fetch_array($sql_lot);

//$nob=$row_lot['balnomp']; 
//$qty=$row_lot['balqty'];
if($tot_barcode1>0)			
$qc=$row_lot['lotldg_qc'];
			
$trdate=$row_lot['lotldg_qctestdate'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dot=$trday."-".$trmonth."-".$tryear;

$trdate=$row_lot['lotldg_valupto'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
if($tot_barcode1>0)
$dov=$trday."-".$trmonth."-".$tryear;

$trdate=$row_lot['lotldg_dop'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dop=$trday."-".$trmonth."-".$tryear;			

$diff = abs(strtotime($row_lot['lotldg_valupto']) - strtotime($dt));
//$years = floor($diff / (365*60*60*24));
//$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor($diff / (60*60*24));
//printf("%d days\n", $days);
//echo $row_arr_home['lotldg_qctestdate']."  -  ".$dt2."  -  ".$dt24."<br />";
//if($days<=30)$flg++;
	
if($qty > 0)
{
	$wareh=""; $binn=""; $subbinn=""; $sBags=""; $sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_lot['whid']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
				
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_lot['binid']."' and whid='".$row_lot['whid']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
				
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_lot['subbinid']."' and binid='".$row_lot['binid']."' and whid='".$row_lot['whid']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
				
				
				
	$diq=explode(".",$nob);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$nob;}
		$nob=$difq;
	$diq=explode(".",$qty);
	if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$qty;}
		$qty=$difq1;
				
	$slocs=$wareh."/".$binn."/".$subbinn." | ".$nob." | ".$qty;
				
	if($sloc=="")
		$sloc=$slocs;
	else
		$sloc=$sloc."<br />".$slocs;
				
	}
$vflg=0;	
$zz=explode(" ", $row_lot['lotldg_got1']);
		
if($zz[0]=="GOT-NR")
{
	if(($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
	{
		//$vflg++; 
	}
	if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
	{
		$vflg++; 
	}
}
else
{
	if(($row_lot['lotldg_got']=="UT" || $row_lot['lotldg_got']=="RT") && $row_lot['lotldg_srflg']==0)
	{
		//$vflg++; 
	}
	if($row_lot['lotldg_got']=="OK" && ($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
	{
		//$vflg++; 
	}
	if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
	{
		$vflg++; 
	} 
}

	$zz=str_split($lotno);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	if($row_lot['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='".$plantcode."' and  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];
				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='".$plantcode."' and  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
				$tot_softr2=mysqli_num_rows($sql_softr2);
				$row_softr2=mysqli_fetch_array($sql_softr2);
				if($tot_softr2 > 0)
				{
					$trdate=$row_softr2['softr_date'];
					$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
				}
			}
		}
	}
if(($dot=="00-00-0000" || $dot=="--" || $dot==" ")&& $row_lot['lotldg_srflg']==1)$dot=$qcdot2;
if(($dot=="00-00-0000" || $dot=="--" || $dot==" "))$dot="";
//if($vflg > 0) $flg++;	
$nob=1;
//echo $flg;
if($flg==0 && $b!="")	 
{
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $b;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grweight;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
$sno++;
}
}
if($brfg!=0)
{
if($brfg==1)
$msgs="Barcode $b cannot be Dispatched. Reason: Barcode not present in System";
if($brfg==2)
$msgs="Barcode $b cannot be Dispatched. Reason: Barcode already Dispatched";
if($brfg==3)
$msgs="Barcode $b cannot be Dispatched. Reason: Barcode already Loaded in current OR other Operator's Transaction";
if($brfg==4)
$msgs="Barcode $b cannot be Dispatched. Reason: Variety not matching with Selected Line Item in Consolidated Pending Orders";
if($brfg==5)
$msgs="Barcode $b cannot be Dispatched. Reason: UPS not matching with Selected Line Item in Consolidated Pending Orders";
if($brfg==6)
$msgs="Barcode $b cannot be Dispatched. Reason: This Lot's current QC/GOT Status is FAIL";
if($brfg==7)
$msgs="Barcode $b cannot be Dispatched. Reason: This Lot's current QC/GOT Status is UT and Soft Release is not activated";
if($brfg==8)
$msgs="Barcode $b cannot be Dispatched. Reason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date";
if($brfg==9)
$msgs="Barcode $b cannot be Dispatched. Reason: This Barcode is already Unpackaged";
if($brfg==10)
$msgs="Barcode $b cannot be Dispatched. Reason: Lot is under Reserve Status";
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading" colspan="11"><font color="#FF0000"><?php echo $msgs;?></td>
</tr>
<?php
}
?>
</table><input type="hidden" name="maintrid" value="<?php echo $tid?>" /><br />
