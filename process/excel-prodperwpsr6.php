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
	$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$txtpmcode=$_REQUEST['txtpmcode'];
		$txtprodper = $_REQUEST['txtprodper'];
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
function dateDiff($start, $end) 
{
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);
}		
	$crp="ALL"; $ver="ALL";	
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
		
	
	$dat=date("d-m-Y");		
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$ttpp=$row_param['sloc'];
	$typ11 = preg_replace("/ /", "_", $ttpp); 	
	
	$dh="Production_Personnel_wise_Processing_Status_Report_for_".$typ11."_As_on_Date_".$dat;
	$datahead = array("Organiser wise Processing Status Report for ".$ttpp." - As on Date ".$dat);
	$filename=$dh.".xls";  
	$datahead2 = array("Production Personnel",$txtprodper,"Crop",$crp,"Variety",$ver);
	$datahead1 = array("Processing Period of Lot(s) From ".$_REQUEST['sdate']." To ".$_GET['edate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
$cnt=1;
$qry24="select distinct lotcrop from tblarrival_sub where pper='".$txtprodper."' and sstage='Raw'  ";
	if($crop!="ALL")
	{	
		$qry24.=" and lotcrop='".$crp."' ";
	}
	if($variety!="ALL")
	{
		$qry24.=" and lotvariety='".$ver."' ";
	}
	if($txtpmcode!="ALL")
	{
		$qry24.=" and organiser='".$txtpmcode."' ";
	}	
		$qry24.=" order by lotcrop";
	
	$sql_arr_home24=mysqli_query($link,$qry24) or die(mysqli_error($link));
	$tot_arr_home24=mysqli_num_rows($sql_arr_home24);
	
while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
{

$qry23="select distinct lotvariety from tblarrival_sub where pper='".$txtprodper."' and lotcrop='".$row_arr_home24['lotcrop']."' and sstage='Raw' ";
	if($variety!="ALL")
	{
		$qry23.=" and lotvariety='".$ver."' ";
	}
	if($txtpmcode!="ALL")
	{
		$qry23.=" and organiser='".$txtpmcode."' ";
	}	
	$qry23.=" order by lotvariety";
	
	$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
	$tot_arr_home23=mysqli_num_rows($sql_arr_home23);
	
while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
{	
$arid='';
	if($txtpmcode!="ALL")
	{
	$qry2="select arrival_id from tblarrival_sub where pper='".$txtprodper."' and organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' ";
	}
	else
	{
	$qry2="select arrival_id from tblarrival_sub where pper='".$txtprodper."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' ";
	}
	
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
if($arid!='')
$arid=$arid.",".$row_arr_home2['arrival_id'];
else
$arid=$row_arr_home2['arrival_id'];
}
if($arid!='')
{
$cropnm=$row_arr_home24['lotcrop'];
$verpnm=$row_arr_home23['lotvariety'];
$datahead4[$cnt] = array("Crop",$cropnm,"","","","","","","","","","","Variety",$verpnm,"",""); 

$qry="select arrival_id, arrival_date, yearcode from tblarrival where arrtrflag=1 and arrival_id IN($arid) ";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
$datahead3[$cnt] = array("Date of Arrival","Days","FRN No.","Lot No.","SP Code Female","SP Code Male","Prod. Location","Organizer","Farmer","PDN Qty","Arrival Qty","Balance Raw Seed Qty","Condition Seed Qty","Cond. Loss (RM + IM)","Date of Processing","GOT Result","DOGR","Physical Purity","Germination %","Genetic Purity %"); 


$d=1;$cntt=0;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$ycode=$row_arr_home1['yearcode'];
if($txtpmcode!="ALL")
{	

	$sql_rr=mysqli_query($link,"select * from tblarrival_sub where pper='".$txtprodper."' and arrival_id='".$row_arr_home1['arrival_id']."' and organiser='".$txtpmcode."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' order by orlot asc") or die(mysqli_error($link));
}
else
{
	$sql_rr=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_arr_home1['arrival_id']."' and pper='".$txtprodper."' and lotcrop='".$row_arr_home24['lotcrop']."' and lotvariety='".$row_arr_home23['lotvariety']."' and sstage='Raw' order by orlot asc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);

while($row_rr=mysqli_fetch_array($sql_rr))
{
$lgt=explode("/",$row_rr['orlot']);
$lotno1=$lgt[0];
$lotno=$row_rr['lotno'];
$ploc=$row_rr['ploc'];
$pper=$row_rr['organiser'];
$farmer=$row_rr['farmer'];
$pqty=$row_rr['qty'];
$arrqty=$row_rr['act'];
$spcfemale=$row_rr['spcodef'];
$spcmale=$row_rr['spcodem'];


$frn="FRN/".$ycode."/".$row_rr['ncode'];

$tqty=0;$genpurity=""; $gemp=""; $qcsts="";
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $row_issue1[0];
$sql_issuetbl1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
while($row_issuetbl1=mysqli_fetch_array($sql_issuetbl1))
{ 
$tqty=$tqty+$row_issuetbl1['lotldg_balqty']; 
$qcsts=$row_issuetbl1['lotldg_qc']; 
$gotr1=explode(" ", $row_issuetbl1['lotldg_got1']); 
$gotr=$gotr1[0]." ".$row_issuetbl1['lotldg_got']; 
$gemp=$row_issuetbl1['lotldg_gemp']; 
	$trdate=$row_issuetbl1['lotldg_gottestdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."/".$trmonth."/".$tryear;
	if($trdate=="//" || $trdate=="00-00-0000" || $trdate=="00/00/0000")$trdate="";
$dogr=$trdate; 


}


$sql_issue123=mysqli_query($link,"select min(lotldg_id) from tbl_lot_ldg where lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue123=mysqli_fetch_array($sql_issue123); 
//echo $row_issue1[0];
$sql_issuetbl123=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue123[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
$row_issuetbl123=mysqli_fetch_array($sql_issuetbl123);
$genpurity=$row_issuetbl123['lotldg_genpurity']; 
if($genpurity==""|| $genpurity=="NULL")$genpurity=$row_issuetbl1['lotldg_genpurity']; 
}
$rswqty=$tqty; 

	$sql_crp23=mysqli_query($link,"select * from tblcrop where cropname='".$row_rr['lotcrop']."'") or die(mysqli_error($link));
	$row_crp23=mysqli_fetch_array($sql_crp23);
	$crp23=$row_crp23['cropid'];

	$sql_var23=mysqli_query($link,"select * from tblvariety where popularname='".$row_rr['lotvariety']."' ") or die(mysqli_error($link));
	$row_var23=mysqli_fetch_array($sql_var23);
	$ver23=$row_var23['varietyid'];
		
		 
$cswqty=""; $tplqty="";  $flg=0; $prosldate=""; 
$sql="select * from tbl_proslipmain where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$sql.=" and proslipmain_crop='".$crp23."'";
	}
	if($variety!="ALL")
	{	
		$sql.=" and proslipmain_variety='".$ver23."'";
	}		
		 $sql.="  and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_date asc";
		 
	$sql_rr22=mysqli_query($link,$sql) or die(mysqli_error($link));
	if($tot_rr22=mysqli_num_rows($sql_rr22)>0)
	{ 
//$sql_rr22=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_crop='".$crp23."' and proslipmain_variety='".$ver23."' and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_id asc") or die(mysqli_error($link));

//$tot_rr22=mysqli_num_rows($sql_rr22);
while($row_rr22=mysqli_fetch_array($sql_rr22))
{
	$prosldate=$row_rr22['proslipmain_date'];
	$sql_issuetbl=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$row_rr22['proslipmain_id']."' and proslipsub_lotno='".$lotno."' and plantcode='$plantcode' order by proslipsub_lotno asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
	if($t > 0)
	{ $rmqty1=0;$imqty1=0;$flg++;
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{ 
			/*$an2=explode(".",$row_issuetbl['proslipsub_conqty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{*/
			$cqty1=$row_issuetbl['proslipsub_conqty'];
			//}
			
			/*$aq3=explode(".",$row_issuetbl['proslipsub_rm']);
			if($aq3[1]==000){$rmqty1=$aq3[0];}else{*/
			$rmqty1=$row_issuetbl['proslipsub_rm'];
			//}
			
			/*$an3=explode(".",$row_issuetbl['proslipsub_im']);
			if($an3[1]==000){$imqty1=$an3[0];}else{*/
			$imqty1=$row_issuetbl['proslipsub_im'];
			//}
		
			
		
			$tplqty=$tplqty+($rmqty1+$imqty1);
			$cswqty=$cswqty+$cqty1;
		}
	}
}
}


$sql_densitytbl=mysqli_query($link,"select * from tbl_density where density_lotno='".$lotno."' order by density_lotno asc") or die(mysqli_error($link)); 
$t_densitytbl=mysqli_num_rows($sql_densitytbl);
if($t_densitytbl > 0)
{ $rmqty1=0;$imqty1=0;$flg++;
	while($row_densitytbl=mysqli_fetch_array($sql_densitytbl))
	{ 
		$aq3=explode(".",$row_densitytbl['density_rqrltkg']);
		if($aq3[1]==000){$rmqty1=$aq3[0];}else{$rmqty1=$row_densitytbl['density_rqrltkg'];}
		
		$cqty1=$row_densitytbl['density_rawqty']-$rmqty1;
		
		$tplqty=$rmqty1+$imqty1;
		$cswqty=$cqty1;


		$sql_prosub=mysqli_query($link,"select * from tbl_proslipsub where proslipsub_lotno='".$row_densitytbl['density_blendedlot']."'  order by proslipsub_lotno asc") or die(mysqli_error($link)); 
		$row_prosub=mysqli_fetch_array($sql_prosub);
		
		$sql_promain=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$row_prosub['proslipmain_id']."' and proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."'  order by proslipmain_id asc") or die(mysqli_error($link));
		while($row_promain=mysqli_fetch_array($sql_promain))
		{
			$prosldate=$row_promain['proslipmain_date']; $flg++;
			$prosldate=$row_promain['proslipmain_date'];
		}
	}
}

	$trdate1=$row_arr_home1['arrival_date'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."/".$trmonth1."/".$tryear1;
	
	$prsldate="";
	if($prosldate!="")
	{
		$prsdt=explode("-",$prosldate);
		$prsldate=$prsdt[2]."/".$prsdt[1]."/".$prsdt[0];
	}
$seedsstatus="";	
$sql_qc=mysqli_query($link,"select max(tid) from tbl_qctest where lotno='$lotno' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_qc=mysqli_fetch_array($sql_qc);

$sqlqc=mysqli_query($link,"select * from tbl_qctest where lotno='$lotno' and tid='".$row_qc[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$rowqc=mysqli_fetch_array($sqlqc);
if($rowqc['qcstatus']!='UT' && $rowqc['qcstatus']!='RT')
$seedsstatus=$rowqc['pp'];	
//echo $lotno." ".$rowqc['qcstatus']." ";	
	//$trdate1="'$trdate1'";
$start1 = $row_arr_home1['arrival_date'];
$end1 = date("Y-m-d");
$diff=dateDiff($start1, $end1);
//if($genpurity==0)$genpurity="";
if($tot_rr > 0)
{
if($flg>0)
{
$data1[$cnt][$d]=array($trdate1,$diff,$frn,$lotno1,$spcfemale,$spcmale,$ploc,$pper,$farmer,$pqty,$arrqty,$rswqty,$cswqty,$tplqty,$prsldate,$gotr,$dogr,$seedsstatus,$gemp,$genpurity); 
$d++;$cntt++;
}
}

}
}

}
if($cntt==0)
{
$data1[$cnt][$d]=array("","","","","","","","","Record not Found","","","","","","","","","",""); 
}
$cnt++;
}
}

echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
for($i=1; $i<$cnt; $i++)
{
	echo implode("\t", $datahead4[$i]) ;
	echo "\n";
	echo implode("\t", $datahead3[$i]) ;
	echo "\n";
	foreach($data1[$i] as $row1)
	 { 
		echo implode("\t", array_values($row1))."\n"; 
	 }
}
