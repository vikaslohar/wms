<?php
	ob_start();
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
  
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL"; $locname="ALL"; $partyname="ALL"; $totnqty=0; $totnomp=0;
	
	
	$nqry="select Distinct disp_dodc from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$sdt' and disp_dodc<='$edt' order by disp_dodc asc";

	$sql_narr_home1=mysqli_query($link,$nqry) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$ndt="";
	while($row_narr_home12=mysqli_fetch_array($sql_narr_home1))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home12['disp_dodc']; else $ndt=$row_narr_home12['disp_dodc'];
	}
	
	$ndt1=explode(",",$ndt);
	$ndt1=array_unique($ndt1);
	sort($ndt1);
	$ndt=$ndt1;
	
	
	
	
	$qry="select Distinct disp_id from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$sdt' and disp_dodc<='$edt' order by disp_dodc asc";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));

	$id1="";$id2="";$id3="";$id4="";//$id5="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		if($id1!="") $id1=$id1.",".$row_arr_home12['disp_id']; else $id1=$row_arr_home12['disp_id'];
	}
	
	$id11=explode(",",$id1);
	$id11=array_unique($id11);
	sort($id11);
	$id11=implode(",",$id11);
	
	if($id11!="")
		$qry="select Distinct disps_crop from tbl_disp_sub where plantcode='".$plantcode."' and disp_id IN ($id11) ";
	else
		$qry="select Distinct disps_crop from tbl_disp_sub where plantcode='".$plantcode."' and disp_id!=0 ";

	if($crop!="ALL")
	{	
		//echo "select * from tblcrop where cropid IN ($crop)";
		$crpname='';
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid IN ($crop)") or die(mysqli_error($link));
		while($row_crp=mysqli_fetch_array($sql_crp))
		{
		$txtcrp=$row_crp['cropname'];
		$txtcrp="'$txtcrp'";
		if($crpname!=""){$crpname=$crpname.",".$txtcrp;} else {$crpname=$txtcrp;}
		}
		$crp=$crpname;
		$qry.=" and disps_crop IN ($crpname) ";
		/*$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.=" and disps_crop='$crp' ";*/
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
	}
	
	$qry.=" group by disps_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home12['disps_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp); 
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
				$crop2=$crop2.",".$row312['cropid'];
			else
				$crop2=$row312['cropid'];
		}
	}
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$plcd="";
	if($row_param['code']=='D') $plcd="DJL";
	else if($row_param['code']=='H') $plcd="HYD";
	else if($row_param['code']=='B') $plcd="Boriya";
	else $plcd="";
$dh=$plcd."_Crop_Variety_Wise_C&F_Dispatch_Report_Period_From_".$sdate."_To_".$edate;
$datahead = array("Crop Variety Wise C&F Dispatch Report");
$filename=$dh.".csv";  
$datahead1 = array("Period From ",$sdate," To ",$edate);
$datahead2 = array("Crop",$crp,"Variety",$ver,"UPS",$txtupsdc);
$data1 = array();
header("Content-Disposition: attachment; filename=$filename"); 
header("Content-Type: text/csv");

$cnt=0;
$datahead3= array("#","Dispatch Date","Party Name","Location","State","Crop","Variety","PV Variety","Lot No.","UPS","Barcode","Packtype","Net Weight","Gross Weight","DoT","DoV","QC");


$d=1;
$srno=1; $cnt=0;
foreach($ndt as $ndts)
{
if($ndts<>"")
{


$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
$crop1=""; 
$stage="Raw";
$stage1="Condition";
$stage2="Pack";

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
$crop1=$row31['cropname'];	

if($id11!="")
	$qry="select Distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and disps_crop='".$crop1."' and disp_id IN ($id11) ";
else
	$qry="select Distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and disps_crop='".$crop1."' ";



if($variety!="ALL")
{	
	$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$ver=$row_var['popularname'];
	$qry.=" and disps_variety='$ver' ";
}

$qry.=" group by disps_variety";

$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
//echo $tret=mysqli_num_rows($sql_arr_home12);
$verarr="";
while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
{
	$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home12['disps_variety']."'  order by popularname asc") or die(mysqli_error($link));
	$row312=mysqli_fetch_array($sql_crop2);
	if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
	else
		$verarr=$row312['popularname'];
}

$ver2="";
$cp2=explode(",",$verarr);
sort($cp2);
for($i=0; $i<count($cp2); $i++)
{
	if($cp2[$i]!="")
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
		else
			$ver2=$row312['varietyid'];
	}
}
//echo $variety;
$cvcod=$crop1."-Coded";
if($variety=="ALL" || $variety==$cvcod)
	$ver2=$ver2.",".$cvcod;
//echo $ver2;
$verps=explode(",",$ver2);
$verps=array_unique($verps);
foreach($verps as $verval)
{
if($verval<>"")
{
	
	$vtyp="OP"; $cirec=0; $pvvername=''; $up='';
	$sql_var23=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."'") or die(mysqli_error($link));
	$vtot=mysqli_num_rows($sql_var23);
	if($vtot>0)
	{
		$row_var23=mysqli_fetch_array($sql_var23);
		$verty=$row_var23['popularname'];
		$vtyp=$row_var23['vt'];
		$up=$row_var23['gm'];
		if($vtyp=="Hybrid")$vtyp="Hybrid";
		if($row_var23['vertype']!='PV')
		{
			if($row_var23['pvverid']>0)
			{
				$sq_vr=mysqli_query($link,"select * from tblvariety where varietyid ='".$row_var23['pvverid']."'") or die(mysqli_error($link));
				$row_vr=mysqli_fetch_array($sq_vr);
				$pvvername=$row_vr['popularname'];
			}
			else
			{
				$pvvername=$verty;
			}
		}
		else
		{
			$pvvername=$verty;
		}
	}
	else
	{
		$verty=$verval;
		$pvvername=$verty;
		$vtyp="";
	}
	$xupout=0;//echo $up."  -=-  ";
	if($txtupsdc!="ALL")
	{
		$ups2=explode(" ",$txtupsdc);
		$ups3=explode(".",$ups2[0]);
		if($ups3[1]>0 || $ups3[1]!="000")$upsz=$ups3[0].".".$ups3[1];
		else
		$upsz=$ups3[0].".000";
		$sql_ups=mysqli_query($link,"select * from tblups where ups='$upsz' and wt='".$ups2[1]."'") or die(mysqli_error($link));
		$row_ups=mysqli_fetch_array($sql_ups);
		$xupout=$row_ups['uid'];
		$xupout=explode(",",$xupout);
		//echo "=-=";
		//$nupz=explode(",",$up);
		//$nup=array_merge(array_diff($nupz,$xupout));
		$nup=$xupout;
		//print_r($nup);
	}
	else
	{
		$nup=explode(",",$up);
	}
	//echo "<br/>";
	//echo $up."  -=-  ";
	if($up!="")
	{
		$xpl=count($nup);
		foreach($nup as $upsval)
		{
			if($upsval<>"")
			{
				$sql_ups=mysqli_query($link,"select * from tblups where uid=$upsval") or die(mysqli_error($link));
				while($row_ups=mysqli_fetch_array($sql_ups))	
				{
					$upssize=$row_ups['ups']." ".$row_ups['wt'];
					
					$nqty=0; $pname=''; $locn=''; $state=''; $barcode=''; $grosswt=''; $lotno=''; $packtype=''; $qc=''; 
					
	
					// Dispatch table with party Type as All         and (disp_partytype='C&F' or disp_partytype='Branch' or disp_partytype='Dealer')

					$sqdm="select * from tbl_disp where plantcode='".$plantcode."' and disp_dodc='$ndts' and disp_tflg=1 order by disp_dodc asc";
					$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($rowdispm=mysqli_fetch_array($sql_istbl))
						{
							$xc=0; 
							 $sqlis="select * from tbl_dispsub_sub where plantcode='".$plantcode."' and disp_id='".$rowdispm['disp_id']."' and dpss_crop='".$crval."' and dpss_variety='".$verval."' and dpss_ups='".$upssize."' order by disp_id asc";
							$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
							while($row_is=mysqli_fetch_array($sql_is))
							{ 
								$qt=$row_is['dpss_qty']; 
								if($qt<0)$qt=0;
								$xc=$xc+$qt;
								$nqty=$qt;
								//echo $row_is['dpss_lotno']."  =  ".$ndts."  =  ".$pvvername."  =  ".$upssize."  =  ".$nqty."<br />";
							
								$barcode=$row_is['dpss_barcode']; 
								$grosswt=$row_is['dpss_grosswt']; 
								$lotno=$row_is['dpss_lotno']; 
								$state=$rowdispm['disp_state'];
								$disptype=$rowdispm['disp_partytype'];
								$packtype=$row_is['dpss_barcodetype']; 
								$qc=$row_is['dpss_qc'];
								$ptype=$rowdispm['disp_partytype'];
								
								$qry_dispsub=mysqli_query($link,"select * from tbl_disp_sub where plantcode='".$plantcode."' and disps_id='".$row_is['disps_id']."' and disp_id='".$rowdispm['disp_id']."'"); 
								$row_dispsub = mysqli_fetch_array($qry_dispsub);
								$nvariety=$row_dispsub['disps_nvariety'];
								if($nvariety=="")$nvariety=$verty;
										
								$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
								$noticia3 = mysqli_fetch_array($quer3);
								$ycode=$noticia3['ycode'];
									
								$sql_code1="SELECT * FROM tbl_dispnote where dnote_trid='".$rowdispm['disp_id']."' and dnote_trtype='Dispatch Pack Seed' and dnote_ptype='$ptype'";
								$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
								$row_code1=mysqli_fetch_array($res_code1);
								
								$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['disp_party']."' order by business_name")or die(mysqli_error($link));
								$noticia = mysqli_fetch_array($sql_month24);
								$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
								$noticia240 = mysqli_fetch_array($sql_month240);
								$locn=$noticia240['productionlocation'];
								if($disptype=="Export Buyer")
								$locn=$rowdispm['disp_location'];								
								$pname=$noticia['business_name'];
								
									
								$tdate=$ndts;
								$tyear=substr($tdate,0,4);
								$tmonth=substr($tdate,5,2);
								$tday=substr($tdate,8,2);
								$trdate=$tday."-".$tmonth."-".$tyear;
								
								$tdate=$row_is['dpss_dov'];
								$tyear=substr($tdate,0,4);
								$tmonth=substr($tdate,5,2);
								$tday=substr($tdate,8,2);
								$trdate2=$tday."-".$tmonth."-".$tyear;
								
								$tdate=$row_is['dpss_dot'];
								$tyear=substr($tdate,0,4);
								$tmonth=substr($tdate,5,2);
								$tday=substr($tdate,8,2);
								$trdate3=$tday."-".$tmonth."-".$tyear;
		
								$barcode1=str_split($barcode);
								$alph=$barcode1[0].$barcode1[1];
								$row_code15=0;
								$sql_code15="SELECT * FROM tbl_retbarseries where retbar_series='$alph' ";
								$res_code15=mysqli_query($link,$sql_code15)or die(mysqli_error($link));
								$row_code15=mysqli_num_rows($res_code15);
					
										
if($nqty>0 && $row_code15>0)										
{						
$totnqty=$totnqty+$nqty;								
$data1[$d]=array($d,$trdate,$pname,$locn,$state,$crop1,$nvariety,$pvvername,$lotno,$upssize,$barcode,$packtype,$nqty,$grosswt,$trdate3,$trdate2,$qc);
$d++;$cnt++;
}
}
}
}
}


}
}
}
}
}

}
}
}
}
/*if($totnqty>0)
{
$data1[$d]=array('','','','','','','','','','','Grand Total',$totnqty,'');
}
if($cnt==0)
{
$data1[$d]=array("","","",'','','',"NO Record Found","","","",'','','');
}*/

echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
echo implode("\t", array_values($row1))."\n"; 
}	
