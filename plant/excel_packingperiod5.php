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
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtupsdc = $_REQUEST['txtupsdc'];
	$withreprint = $_REQUEST['withreprint'];
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	if($txtupsdc=="")$txtupsdc="ALL";
			
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$cp=""; 
	$sql_crp=mysqli_query($link,"select * from tblcrop order by cropname ASC") or die(mysqli_error($link));
	while($row_crp=mysqli_fetch_array($sql_crp))
	{
		if($cp!="")
			$cp=$cp.",".$row_crp['cropid'];
		else
			$cp=$row_crp['cropid'];
	}
		
	$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	if($withreprint=="yes")
	$qry="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='SRRV') and balqty > 0 ";
	else
	$qry="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP') and balqty > 0 ";

	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	} 
	else
	{
	$qry.=" and lotldg_crop IN ($cp) ";
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtupsdc!="ALL")
	{	
		$qry.=" and packtype='$txtupsdc' ";
	}
	$qry.=" group by lotldg_crop, lotldg_variety";
//echo $qry;
//exit;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	//$dat=date("d-m-Y");		
	
	$dh="Periodical_Packing_From_".$sdate."_To_".$edate;
	$datahead = array("Periodical Packing Report From ".$sdate." To ".$edate);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

		$cnt=1;

	$totalbags=0; $totalqty=0;
	$datahead1= array("Crop",$crp,"Variety",$variety,"UPS",$txtupsdc);
	$datahead2= array("#","Date","Crop","Variety","Lot Number","UPS","Type","Packing Machine Code","Picked for Packing Qty","Packing Loss","Packing Loss %","Total Qty"); 
	
$d=1; $totalbags=0;

while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($txtupsdc!="ALL")
{
	if($withreprint=="yes")
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='SRRV') order by lotdgp_id desc") or die(mysqli_error($link));
	else
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP') order by lotdgp_id desc") or die(mysqli_error($link));
}
else
{
	if($withreprint=="yes")
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='SRRV') order by lotdgp_id desc") or die(mysqli_error($link));
	else
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP') order by lotdgp_id desc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop=$row31['cropname'];		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
	}
	else
	{
		$variety=$row_rr['lotldg_variety'];
	}

	$totqty=0; 
	if($withreprint=="yes")
	$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='SRRV') order by packtype asc") or die(mysqli_error($link));
	else
	$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP') order by packtype asc") or die(mysqli_error($link));
	$tot_rr2=mysqli_num_rows($sql_rr2);
	//$row_rr2=mysqli_fetch_array($sql_rr2);
	while($row_rr2=mysqli_fetch_array($sql_rr2))
	{
		
		if($withreprint=="yes")
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='SRRV') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		else
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{$totqty=0; $totnob=0; $cnt=0; $txtdot=""; $type='';
			if($withreprint=="yes")	
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and packtype='".$row_rr2['packtype']."'and lotno='".$row_arr_home['lotno']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='SRRV') and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
			else
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and packtype='".$row_rr2['packtype']."'and lotno='".$row_arr_home['lotno']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP') and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					//echo $row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
					$cnt++; $nob=0;
					$totqty=$totqty+$row_issuetbl['balqty']; 
					$xc=explode(" ",$row_rr2['packtype']);
					$packtp=explode(".",$xc[0]);
					if($xc[1]=="Gms")
					{
						$np=1000/$xc[0];
					}
					else
					{
						if($packtp[0]<1)
						$np=(1000/$packtp[1])/1000;
						else
						$np=$xc[0];
					}
					if($xc[1]=="Gms")
					$nob=$np*$row_issuetbl['balqty']; 
					else
					$nob=$row_issuetbl['balqty']/$np; 
					$totnob=$totnob+$nob; 
					if($totnob<0) $totnob=0;
					if($totqty<0) $totqty=0;
					
					$rdate=$row_issuetbl['lotldg_trdate'];
					$ryear=substr($rdate,0,4);
					$rmonth=substr($rdate,5,2);
					$rday=substr($rdate,8,2);
					$txtdot=$rday."-".$rmonth."-".$ryear;
					
					
					$totcqty=0; $totpqty=0; $totsrqty=0; $pmc=''; $lossper='';
					if($row_issuetbl['trtype']=='PNPSLIP' || $row_issuetbl['trtype']=='NSTPNPSLIP')
					{
						$sql_is=mysqli_query($link,"select pnpslipmain_id, pnpslipmain_promachcode from tbl_pnpslipmain where  pnpslipmain_id='".$row_issuetbl['lotldg_id']."'  order by pnpslipmain_id asc") or die(mysqli_error($link));
						while($row_is=mysqli_fetch_array($sql_is))
						{ 
							$sql_istbl=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."'  order by pnpslipsub_id asc") or die(mysqli_error($link)); 
							$t=mysqli_num_rows($sql_istbl);
							if($t > 0)
							{
								while($row_pnpsub=mysqli_fetch_array($sql_istbl))
								{ 
									$totcqty=$totcqty+$row_pnpsub['pnpslipsub_pickpqty']; 
									$totpqty=$totpqty+$row_pnpsub['pnpslipsub_packloss']; 
									$totsrqty=$totsrqty+$row_pnpsub['pnpslipsub_packqty']; 
									
									$ccnt++;
								}	
							}
							
							$sql_pmc=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$row_is['pnpslipmain_promachcode']."' ") or die(mysqli_error($link));
							$row_arr_pmc=mysqli_fetch_array($sql_pmc);
							$pmc=$row_arr_pmc['promac_mac'].$row_arr_pmc['promac_macid'];
						}
						$lossper=round($totpqty/$totcqty*100,2);
					}
					else
					{
						$totcqty=0; $totpqty=0; $totsrqty=0; $pmc=''; $lossper='';
					}
					if($row_issuetbl['trtype']=='PNPSLIP') {	$type="ST"; }
					if($row_issuetbl['trtype']=='NSTPNPSLIP') {	$type="NST"; }
					if($row_issuetbl['trtype']=='PACKRV') {	$type="Re-Printing"; }
					if($row_issuetbl['trtype']=='SRRV') {	$type="SR Re-Validation"; }	
				}
			}
			$lotn=$row_arr_home['lotno'];
		//}
	//}
				
$ups=$row_rr2['packtype'];		
	$sql_rps=mysqli_query($link,"Select packaging_tflg from tbl_rpspackaging where plantcode='$plantcode' and packaging_lotno='".$row_arr_home['lotno']."' and (packaging_tflg=0 OR packaging_tflg=2) ") or die(mysqli_error($link));
	if($tot_rps=mysqli_num_rows($sql_rps)>0) {$cnt=0; }	
if($cnt>0)
{
//$totalqty=$totalqty+$totqty; 
//$totalbags=$totalbags+$totnob;
$data1[$d]=array($d,$txtdot,$crop,$variety,$lotn,$ups,$type,$pmc,$totcqty,$totpqty,$lossper,$totqty);
$d++;$cnt++;
}
}
}
}
}
echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}	