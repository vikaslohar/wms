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
	
	set_time_limit(0);
	ini_set("memory_limit","100M");
		
	if(isset($_REQUEST['pid']))
	{
		$pid = $_REQUEST['pid'];
	}
		
	$tid=$pid; 

	$sql_tbl=mysqli_query($link,"select * from tbl_stoutmpack where stoutmp_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$tdate=$row_tbl['stoutmp_ddate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
		
	$arrival_id=$row_tbl['stoutmp_id'];
	
	$quer5=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['stoutmp_plantid']."' order by stcode asc") or die(mysqli_error($link)); 
	$noticia2 = mysqli_fetch_array($quer5); 
	$toplantname=$noticia2['business_name'];
	$toplantcode=$noticia2['stcode'];
	
	
	$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$noticia3 = mysqli_fetch_array($quer6); 
	$fplant=$noticia3['company_name'];
	$fplantcode=$noticia3['code'];
	
	
	$sql_code1="SELECT * FROM tbl_dispnote where  dnote_trid='$tid' and dnote_trtype='Stock Transfer Out-Pack' ";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
	$row_code1=mysqli_fetch_array($res_code1);
	$ycode=$row_code1['dnote_yearcode'];

	$code1=$noticia3['code']."/"."PSP"."/".$ycode."/".$row_code1['dnote_code'];
	
	$dh="Stock_Transfer_Lots_Pack";
	$datahead = array("Stock Transfer-Plant");
	
	$filename=$dh.".csv";  
	$datahead1 = array("From Plant:",$fplant,$fplantcode,		"To Plant:",$plantname,$plantcode);
	$datahead3 = array("Dispatch Date:",$tdate,		"STDN Date:",$tdate,		"STDN No.:",$code1);
	$data1 = array();
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename"); 
	
	$datahead2= array("Crop","Variety","Lot Number","Lable1","Lable2","UPS","Loose NoP","NoP","NoMP","Qty","Arrival NoP","Arrival NoMP","Arrival Qty","Balance Nop","Balance NoMP","Balance Qty","Pack Types","QC Pack Date","QC Status","QC Date","PP","Moisture %","Germination %","GOT Type","GOT Status","GOT Test Date","DoP","DoV","Wtmp","SR Type","SR Status","SSR Type","SSR Status","Barcode Type","Barcode","Lot NoP","Lot Qty","Barcode Qty","Gross Wt.","Remarks","LE Duration","LE Upto"); 

$d=1;
$sql_sub=mysqli_query($link,"Select * from tbl_stoutspack where stoutmp_id='$tid'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$crop=''; $variety=''; $lotn=''; $lable1=''; $lable2=''; $stgw=''; $loosenop=''; $enop=''; $enomp=''; $eqty=''; $nop=''; $nobs=''; $qtys=''; $balnop=''; $balnomp=''; $balqty=''; $packtype=''; $dot=''; $qc=''; $qcdate=''; $pp=''; $moist=''; $germ=''; $gotyp=''; $got=''; $dogt=''; $dop=''; $dov=''; $wtmp=''; $srtype=''; $srstatus=''; $ssrtype=''; $ssrstatus=''; $bartyp=''; $barcode=''; $lotnop=''; $lotqty=''; $barqty=''; $grswt=''; $remarks=''; $ledt=''; $leupto='';
	
	$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stoutsp_crop']."' order by cropname") or die(mysqli_error($link));
	$noticia_class=mysqli_fetch_array($classqry);
	$crop=$noticia_class['cropname'];
	
	$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stoutsp_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$noticia_item=mysqli_fetch_array($itemqry);
	$variety=$noticia_item['popularname'];
	
	$lotn=$row_sub['stoutsp_lotno'];
	$stgw=$row_sub['stoutsp_ups'];
	
	$lable1=$row_sub['stoutsp_lable1'];
	$lable2=$row_sub['stoutsp_lable2'];
	
	$loosenop=$row_sub['stoutsp_loadnop'];
	$packtype=$row_sub['stoutsp_qcpacktype'];
	$qcdate=$row_sub['stoutsp_qcdate'];
	$enop=$row_sub['stoutsp_enop'];
	$enomp=$row_sub['stoutsp_enomp'];
	$eqty=$row_sub['stoutsp_eqty'];
	
	$nop=$row_sub['stoutsp_loadnop'];
	$nobs=$row_sub['stoutsp_loadnomp'];
	$qtys=$row_sub['stoutsp_loadqty'];
	
	$balnop=$enop-$nop;
	$balnomp=$enomp-$nobs;
	$balqty=$eqty-$qtys;
	
	$remarks=$row_tbl['stoutmp_remarks'];
	$remarks=str_replace("&","and",$remarks);
	$remarks=str_replace(",","; ",$remarks);
	
	$qc=$row_sub['stoutsp_qcstatus']; 
	$germ=$row_sub['stoutsp_germ']; 
	$pp=$row_sub['stoutsp_pp']; 
	$moist=$row_sub['stoutsp_moist']; 
	$gotyp=$row_sub['stoutsp_gottype'];
	$got=$row_sub['stoutsp_gotstatus'];
	$wtmp=$row_sub['stoutsp_wtmp'];
	
	$srtype=$row_sub['stoutsp_srtype'];
	$srstatus=$row_sub['stoutsp_srstatus'];
	$ssrtype=$row_sub['stoutsp_ssrtype'];
	$ssrstatus=$row_sub['stoutsp_ssrstatus'];
				
	$rdate=$row_sub['stoutsp_qcpackdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$dot=$rday."-".$rmonth."-".$ryear;
	
	$dop1=$row_sub['stoutsp_dop'];
	$ryear=substr($dop1,0,4);
	$rmonth=substr($dop1,5,2);
	$rday=substr($dop1,8,2);
	$dop=$rday."-".$rmonth."-".$ryear;
	
	$dov1=$row_sub['stoutsp_dov'];
	$ryear=substr($dov1,0,4);
	$rmonth=substr($dov1,5,2);
	$rday=substr($dov1,8,2);
	$dov=$rday."-".$rmonth."-".$ryear;
				
	$rgdate=$row_sub['stoutsp_gotdate'];
	$rgyear=substr($rgdate,0,4);
	$rgmonth=substr($rgdate,5,2);
	$rgday=substr($rgdate,8,2);
	$dogt=$rgday."-".$rgmonth."-".$rgyear;
							
	if($dot=="00-00-0000" || $dot=="--")$dot="";	
	if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
	if($qc=="RT" || $qc=="UT")$dot="";
	if($got=="RT" || $got=="UT")$dogt="";
	if($germ<=0)$germ="";
	if($moist<=0)$moist="";	
	$ptyp="";
	
	$sql_spc=mysqli_query($link,"select * from tbl_lemain where plantcode='".$plantcode."' and le_lotno='".$lotn."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	if($xx=mysqli_num_rows($sql_spc)>0)
	{
		$ledt=$row_lot['le_duration'];
		$leupto=$row_lot['le_upto'];
	}
	
	
	$sql_subsub=mysqli_query($link,"Select * from tbl_stoutsspack where plantcode='".$plantcode."' and stoutsp_id='".$row_sub['stoutsp_id']."'") or die(mysqli_error($link));
	while($row_subsub=mysqli_fetch_array($sql_subsub))
	{
		$bartyp=$row_subsub['stoutssp_barcodetype'];
		$barcode=$row_subsub['stoutssp_barcode'];
		$lotnop=$row_subsub['stoutssp_lotnop'];
		$lotqty=$row_subsub['stoutssp_lotqty'];
		$barqty=$row_subsub['stoutssp_qty'];
		$grswt=$row_subsub['stoutssp_grosswt'];
		$remarks=$row_tbl['stoutmp_remarks'];
		
		if($tot_subsub=mysqli_num_rows($sql_subsub) > 0)
		{
		//"Crop","Variety","Lot Number","Lable1","Lable2","UPS","Loose NoP","Pack Types","QC Pack Date","QC Status","QC Date","PP","Moisture %","Germination %","GOT Type","GOT Status","GOT Test Date","DoP","DoV","Wtmp","SR Type","SR Status","SSR Type","SSR Status","Barcode Type","Barcode","Lot NoP","Lot Qty","Barcode Qty","Gross Wt.","Remarks"
		
			$data1[$d]=array($crop,$variety,$lotn,$lable1,$lable2,$stgw,$loosenop,$enop,$enomp,$eqty,$nop,$nobs,$qtys,$balnop,$balnomp,$balqty,$packtype,$dot,$qc,$qcdate,$pp,$moist,$germ,$gotyp,$got,$dogt,$dop,$dov,$wtmp,$srtype,$srstatus,$ssrtype,$ssrstatus,$bartyp,$barcode,$lotnop,$lotqty,$barqty,$grswt,$remarks,$ledt,$leupto); 
			$d++;
		}
	}
	if($row_sub['stoutsp_loadnomp']==0)
	{
		$data1[$d]=array($crop,$variety,$lotn,$lable1,$lable2,$stgw,$loosenop,$enop,$enomp,$eqty,$nop,$nobs,$qtys,$balnop,$balnomp,$balqty,$packtype,$dot,$qc,$qcdate,$pp,$moist,$germ,$gotyp,$got,$dogt,$dop,$dov,$wtmp,$srtype,$srstatus,$ssrtype,$ssrstatus,$bartyp,$barcode,$lotnop,$lotqty,$barqty,$grswt,$remarks,$ledt,$leupto); 
		$d++;
	}
}

echo implode($datahead);
echo "\n";
echo implode(",",$datahead1);
echo "\n";
echo implode(",",$datahead3);
echo "\n";
echo implode(",", $datahead2);
echo "\n";
foreach($data1 as $row1)
{ 
 	#array_walk($row1, 'cleanData'); 
	echo implode(",", array_values($row1))."\n"; 
}
