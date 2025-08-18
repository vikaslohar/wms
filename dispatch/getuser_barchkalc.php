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
	$upids = trim($_GET['g']);	 
}
if(isset($_GET['l']))
{
	$ptyid = $_GET['l'];	 
}
if(isset($_GET['m']))
{
	$eupstpy = $_GET['m'];	 
}
	
	$eloqty=0;	 
	$etbloqtyy=0;	 

	$sqlcode="SELECT dalloc_id FROM tbl_dalloc where dalloc_dflg!=1 and dalloc_party='$ptyid' ORDER BY dalloc_id DESC";
	$rescode=mysqli_query($link,$sqlcode)or die(mysqli_error($link));
	$t=mysqli_num_rows($rescode);
	$rowcode=mysqli_fetch_array($rescode);
	$dalcid=$rowcode['dalloc_id'];
	/*$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$vrids' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$vt=$row_dept4['varietyid'];
	
	$verids=$vt;
	$upsids=$upids;
	*/
	//echo $vrids;
	$verids=explode(",",$vrids);
	$upids=explode(",",$upids);
	$eupstpy=explode(",",$eupstpy);
	
	$flg=0;
	$sqlbarcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."'") or die(mysqli_error($link));
	$totbarcode1=mysqli_num_rows($sqlbarcode1);
	$rowbarcode1=mysqli_fetch_array($sqlbarcode1);
		if($totbarcode1==0)$flg=1;
	$sqlbarcode2=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and (mpmain_dflg=1 OR mpmain_spremflg=1)") or die(mysqli_error($link));
	$totbarcode2=mysqli_num_rows($sqlbarcode2);
		if($totbarcode2>0){if($flg==0)$flg=2;}
	$sqlbarcode3=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_dflg=2") or die(mysqli_error($link));
	$totbarcode3=mysqli_num_rows($sqlbarcode3);
		if($totbarcode3>0){if($flg==0)$flg=3;}
	$sqlbarcode4=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_upflg=1") or die(mysqli_error($link));
	$totbarcode4=mysqli_num_rows($sqlbarcode4);
		if($totbarcode4>0){if($flg==0)$flg=9;}
	$uitp=$rowbarcode1['mpmain_trtype'];
	$eloqty=$eloqty+$rowbarcode1['mpmain_wtmp'];
	
	if($eupstpy!="")
	{
		$utpy="";
		if($uitp=="PACKSMC" || $uitp=="PACKLMC")$utpy="ST";
		if($uitp=="PACKNMC" || $uitp=="PACKNLC" || $uitp=="PACKMMC")$utpy="NST";
		if(!in_array($utpy,$eupstpy)){if($flg==0)$flg=5;}
	}
	//if($uitp=="PACKSMC" || $uitp=="PACKNMC")
	{
		$vr1=$rowbarcode1['mpmain_variety'].",";
		$upl=$rowbarcode1['mpmain_upssize'].",";
		$vr1=array_unique(explode(",",$vr1));
		$upl=array_unique(explode(",",$upl));
		$found = null;
		foreach($vr1 as $num) {
			if (in_array($num,$verids)) {
				$found[$num] = true;
			} 
		}
		//var_dump($found);
		if($found==null) {if($flg==0)$flg=4;} 
		$found2 = null;
		foreach($upl as $num2) {
			if (in_array($num2,$upids)) {
				$found2[$num2] = true;
			} 
		}
		//var_dump($found2);
		if($found2==null){if($flg==0)$flg=5;}
	}
	/*else
	{
		$vr1=$rowbarcode1['mpmain_variety'].",";
		$upl=$rowbarcode1['mpmain_upssize'].",";
		$vr1=array_unique(explode(",",$vr1));
		$upl=array_unique(explode(",",$upl));
		$found = null;
		foreach($vr1 as $num) {
			if (in_array($num,$verids)) {
				$found[$num] = true;
			} 
		}
		//var_dump($found);
		if($found==null) {if($flg==0)$flg=4;} 
		$found2 = null;
		foreach($upl as $num2) {
			if (in_array($num2,$upids)) {
				$found2[$num2] = true;
			} 
		}
		//var_dump($found2);
		if($found2==null){if($flg==0)$flg=5;}
	}*/	
	
	//echo "Select mpmain_barcode from tbl_mpmain where mpmain_barcode='".$b."' and mpmain_altrid!=0 and mpmain_altrid!='$dalcid'";
	$sqlbarcode5=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_altrid!=0 and mpmain_altrid!='$dalcid'") or die(mysqli_error($link));
	$totbarcode5=mysqli_num_rows($sqlbarcode5);
	if($totbarcode5>0){if($flg==0)$flg=11;}
	//echo $flg;
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_porderno='$a'")or die("Error:".mysqli_error($link));
	$row_month=mysqli_fetch_array($sql_month);
	$arrivalid=$row_month['orderm_id'];
	$sql_mon=mysqli_query($link,"select * from tbl_order_sub where orderm_id='".$arrivalid."' order by order_sub_crop")or die("Error:".mysqli_error($link));*/
 
	$dt=date("Y-m-d");
	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	if($tot_barcode1>0)
	{
		$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where plantcode='".$plantcode."' and bar_barcode='".$b."'") or die(mysqli_error($link));
		$totbarcode=mysqli_num_rows($sqlbarcode);
		$rowbarcode=mysqli_fetch_array($sqlbarcode);
		$grweight=$rowbarcode['bar_grosswt'];
	}
	
	//echo $uitp;
	if($uitp=="PACKSMC" || $uitp=="PACKNMC")
	{
		$lotno=$row_barcode1['mpmain_lotno'];
		$ui1=$rowbarcode1['mpmain_upssize'];
		
		$sqlbarcode51=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocss_lotno='".$lotno."' and dalloc_id='$dalcid'") or die(mysqli_error($link));
		$totbarcode51=mysqli_num_rows($sqlbarcode51);
		if($totbarcode51==0){if($flg==0)$flg=11;}
		//echo $flg;
		$sqlbarcode5=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and mpmain_barcode='".$b."' and mpmain_altrid!=0 and mpmain_altrid!='$dalcid'") or die(mysqli_error($link));
		$totbarcode5=mysqli_num_rows($sqlbarcode5);
		if($totbarcode5>0)
		{
			$sql_lot33=mysqli_query($link,"Select Max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno' and packtype='$ui1' order by lotdgp_id DESC") or die(mysqli_error($link));
			$row_lot33=mysqli_fetch_array($sql_lot33);
			$sql_lot3=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno' and packtype='$ui1' and lotdgp_id='".$row_lot33[0]."'  order by lotdgp_id DESC") or die(mysqli_error($link));
			$tot_lot3=mysqli_num_rows($sql_lot3);
			if($tot_lot3>0)
			{
				$rowlot3=mysqli_fetch_array($sql_lot3);
				if($rowlot3['lotldg_alflg']>0 && $rowlot3['lotldg_altrids']!=0 && $rowlot3['lotldg_altrids']!="")
				{
					$xghk=explode(",",$rowlot3['lotldg_altrids']);
					if(!in_array($dalcid,$xghk)){ if($flg==0)$flg=11;}
				}
			}
			else
			{
				if($flg==0)$flg=11;
			}
		}
		else
		{
			$sql_lot2=mysqli_query($link,"Select Max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno' and packtype='$ui1' order by lotdgp_id DESC") or die(mysqli_error($link));
			$tot_lot2=mysqli_num_rows($sql_lot2);
			$row_lot2=mysqli_fetch_array($sql_lot2);
			
			$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
			$tot_lot=mysqli_num_rows($sql_lot);
			$row_lot=mysqli_fetch_array($sql_lot);
			
			$diff = abs(strtotime($row_lot['lotldg_valupto']) - strtotime($dt));
			$days = floor($diff / (60*60*24));
			if($days<=30){if($flg==0)$flg=8;}
			
			$sql_spc=mysqli_query($link,"select * from tbl_lemain where plantcode='".$plantcode."' and le_lotno='".$lotn."'") or die(mysqli_error($link));
			$row_spc=mysqli_fetch_array($sql_spc);
			if($xx=mysqli_num_rows($sql_spc)>0)
			{
				$diff = abs(strtotime($row_lot['le_upto']) - strtotime($dt));
				$days = floor($diff / (60*60*24));
				if($days<=30){if($flg==0)$flg=8;}
			}

			if($row_lot['lotldg_resverstatus'] > 0){if($flg==0)$flg=10;}
			
			$zz=explode(" ", $row_lot['lotldg_got1']);
			if($row_lot['lotldg_got']=="BL")
			$flg=7;
			if($row_lot['lotldg_qc']=="BL")
			$flg=7;
			if($zz[0]=="GOT-NR")
			{
				if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
				{
					if($flg==0)$flg=6;
				}
				if(($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
				{
					if($flg==0)$flg=7;
				}
			}
			else
			{
				if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
				{
					if($flg==0)$flg=6;
				} 
				if(($row_lot['lotldg_got']=="UT" || $row_lot['lotldg_got']=="RT") && $row_lot['lotldg_srflg']==0)
				{
					if($flg==0)$flg=7;
				}
			}
		}
	}
	else
	{
		$lotn=explode(",",$row_barcode1['mpmain_lotno']);
		$ui1=explode(",",$rowbarcode1['mpmain_upssize']);
		for($i=0; $i<count($lotn); $i++)
		{
			$lotno=$lotn[$i];
			if($lotno<>"")
			{
				if($uitp=="PACKMMC")
				$upps=$ui1[$i];
				else
				$upps=$ui1[0];
				//$lotno=$row_barcode1['mpmain_lotno'];
				//echo "Select * from tbl_dallocsub_sub where dallocss_lotno='".$lotno."' and dalloc_id='$dalcid' and dallocss_ups='".$ui1[$i]."'";
				$sqlbarcode51=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocss_lotno='".$lotno."' and dalloc_id='$dalcid' and dallocss_ups='".$upps."'") or die(mysqli_error($link));
				$totbarcode51=mysqli_num_rows($sqlbarcode51);
				if($totbarcode51==0){if($flg==0)$flg=11;}
				//echo $flg;
				$sql_lot2=mysqli_query($link,"Select Max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotno='$lotno' and packtype='".$upps."' order by lotdgp_id DESC") or die(mysqli_error($link));
				$tot_lot2=mysqli_num_rows($sql_lot2);
				$row_lot2=mysqli_fetch_array($sql_lot2);
				
				$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_lot2[0]."' and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
				$tot_lot=mysqli_num_rows($sql_lot);
				$row_lot=mysqli_fetch_array($sql_lot);
				
				$diff = abs(strtotime($row_lot['lotldg_valupto']) - strtotime($dt));
				$days = floor($diff / (60*60*24));
				if($days<=30){if($flg==0)$flg=8;}
				
				$sql_spc=mysqli_query($link,"select * from tbl_lemain where plantcode='".$plantcode."' and le_lotno='".$lotn."'") or die(mysqli_error($link));
				$row_spc=mysqli_fetch_array($sql_spc);
				if($xx=mysqli_num_rows($sql_spc)>0)
				{
					$diff = abs(strtotime($row_lot['le_upto']) - strtotime($dt));
					$days = floor($diff / (60*60*24));
					if($days<=30){if($flg==0)$flg=8;}
				}

				if($row_lot['lotldg_resverstatus'] > 0){if($flg==0)$flg=10;}
				
				$zz=explode(" ", $row_lot['lotldg_got1']);
				if($row_lot['lotldg_got']=="BL")
				$flg=7;
				if($row_lot['lotldg_qc']=="BL")
				$flg=7;
				if($zz[0]=="GOT-NR")
				{
					if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
					{
						if($flg==0)$flg=6;
					}
					if(($row_lot['lotldg_qc']=="UT" || $row_lot['lotldg_qc']=="RT") && $row_lot['lotldg_srflg']==0)
					{
						if($flg==0)$flg=7;
					}
				}
				else
				{
					if($row_lot['lotldg_got']=="Fail" || $row_lot['lotldg_qc']=="Fail")
					{
						if($flg==0)$flg=6;
					} 
					if(($row_lot['lotldg_got']=="UT" || $row_lot['lotldg_got']=="RT") && $row_lot['lotldg_srflg']==0)
					{
						if($flg==0)$flg=7;
					}
				}
			}
		}		
	}	
	//if($eloqty>$etbloqtyy){if($flg==0)$flg=12;}$rowbarcode1['mpmain_variety']$vr1
	
	if($tid>0)
	{
		$cot=count($vr1); $adx=0;
		foreach($vr1 as $virtds)
		{//echo " ".$virtds."  ";
			if($virtds<>"")
			{
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$virtds' and actstatus='Active'"); 
				$row_dept4=mysqli_fetch_array($quer4);
				$vt=$row_dept4['popularname'];
				
				$sqlbarcode5=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and disps_variety='".$vt."' and disp_id='".$tid."' and disps_upstype='$eupstpy'") or die(mysqli_error($link));
				$totbarcode5=mysqli_num_rows($sqlbarcode5);
				if($totbarcode5>0)
				{
					while($row_d=mysqli_fetch_array($sqlbarcode5))
					{
						$etbloqtyy=$etbloqtyy+$row_d['disps_bqty']; $adx++;
					}
				}
				
			}
		}
		
		if($eloqty>$etbloqtyy && $adx>0){if($flg==0)$flg=12;}
	}
	//echo $eloqty."  -  ".$etbloqtyy."  =  ";
	$lloott=$row_barcode1['mpmain_lotno'].",";
	$lotn=explode(",",$row_barcode1['mpmain_lotno']);
	$ui1=explode(",",$rowbarcode1['mpmain_upssize']);
	if($uitp=="PACKSMC" || $uitp=="PACKNMC")
	$mpltnop=explode(",",$rowbarcode1['mpmain_mptnop']);
	else
	$mpltnop=explode(",",$rowbarcode1['mpmain_lotnop']);
	for($i=0; $i<count($lotn); $i++)
	{
		
		$lotno=$lotn[$i];
		if($uitp=="PACKMMC")
		$upssiz=$ui1[$i];
		else
		$upssiz=$ui1[0];
		if($uitp=="PACKSMC" || $uitp=="PACKNMC")
		$mplotnop=$mpltnop[0];
		else
		$mplotnop=$mpltnop[$i];
		
		if($lotno<>"")
		{
			$qstt=0; $qts=0;
			$xc2=explode(" ",$upssiz);
			//$packtp=explode(".",$xc2);
			if($xc2[1]=="Gms")
			{
				$ptp2=$xc2[0]/1000;
			}
			else
			{
				if($xc2[0]<=0)
				$ptp2=$xc2[0]/1000;
				else
				$ptp2=$xc2[0];
				//$ptp2=$xc2[0];
			}
			//echo $ptp2."  *  ".$mplotnop."  =  ";
			//$qts=$ptp2*$mplotnop;
			//$qstt=$qstt+$ltqt;
			
			$sqlbarcode51=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and dallocss_lotno='".$lotno."' and dalloc_id='$dalcid' and dallocss_ups='$upssiz'") or die(mysqli_error($link));
			$totbarcode51=mysqli_num_rows($sqlbarcode51);
			while($row_d=mysqli_fetch_array($sqlbarcode51))
			{
				$qstt=$qstt+$row_d['dallocss_qty'];
			}
			$dsid=0;// echo "Select * from tbl_dispsub_sub where dpss_lotno='".$lotno."' and disp_id='".$tid."' and dpss_ups='$upssiz'";
			$sqlbarcode5=mysqli_query($link,"Select * from tbl_dispsub_sub where plantcode='".$plantcode."' and dpss_lotno='".$lotno."' and disp_id='".$tid."' and dpss_ups='$upssiz'") or die(mysqli_error($link));
			$totbarcode5=mysqli_num_rows($sqlbarcode5);
			if($totbarcode5>0)
			{
				while($row_d2=mysqli_fetch_array($sqlbarcode5))
				{
					$qts=$qts+$row_d2['dpss_qty'];
					$dsid=$row_d2['disps_id'];
				}
			}
			$sqlbarcode55=mysqli_query($link,"Select * from tbl_disp_sub where plantcode='".$plantcode."' and disps_id='".$dsid."' and disp_id='".$tid."' and disps_ups='$upssiz' and disps_upstype='$eupstpy' and disps_bqty=0") or die(mysqli_error($link));
			$totbarcode55=mysqli_num_rows($sqlbarcode55);
			if($totbarcode55>0)
			{
				if($flg==0)$flg=12;
			}
			
			$qts=round($qts,3);
			$qstt=round($qstt,3);
			//echo "  *  ".$qts."  -  ".$qstt;
			if($uitp=="PACKSMC" || $uitp=="PACKNMC")
			{if($qts>$qstt){if($flg==0)$flg=13;}}
		}
	}	
	// exit;	
	/*$sqlbarcode5=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where mpmain_barcode='".$b."' and mpmain_alflg!=0") or die(mysqli_error($link));
	$totbarcode5=mysqli_num_rows($sqlbarcode5);
	if($totbarcode5>0){if($flg==0)$flg=11;}*/
?>
<input type="hidden" name="brflg" value="<?php echo $flg;?>" /><input type="hidden" name="brchflg" value="1" />