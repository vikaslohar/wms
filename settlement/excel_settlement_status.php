<?php
ob_start();
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='login.php' ";
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
	
	$dat=date("d-m-Y");		
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	$ttpp=$row_param['sloc'];
	$typ11 = preg_replace("/ /", "_", $ttpp); 	
	
	$dh="Periodical_Settlement_Status_Report_As_on_Date_".$dat;
	$datahead = array("Periodical Settlement Status Report - As on Date ".$dat);
	$filename=$dh.".xls";  
	$datahead1 = array("Arrival Period of Lot(s) From ".$_REQUEST['sdate']." To ".$_GET['edate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
$cnt=1;
$qry="select arrival_id, arrival_date, yearcode from tblarrival where arrival_date <='".$edate."' and arrival_date >='".$sdate."' and arrival_type='Fresh Seed with PDN' and arrtrflag=1";
$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
$datahead3= array("Date of Arrival","Days","FRN No.","Lot No.","Prod. Location","Prod. Personel","Organiser","Farmer","Farmer ID","Farmer","Crop","Variety","Type","PDN Qty","Arrival Qty","Raw Seed Qty","Condition Seed Qty","Cond. Loss (RM + IM)","Date of Processing","GOT Result","DOGR","QC Result","DoT","Germination %","Genetic Purity %","SPS Date","SPS Status"); 


$d=1;$cntt=0;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$ycode=$row_arr_home1['yearcode'];
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$row_arr_home1['arrival_id']."' and sstage='Raw' order by orlot asc") or die(mysqli_error($link));

$tot_rr=mysqli_num_rows($sql_rr);

while($row_rr=mysqli_fetch_array($sql_rr))
{
$lgt=explode("/",$row_rr['orlot']);
$lotno1=$lgt[0];
$lotno=$row_rr['lotno'];
$ploc=$row_rr['ploc'];
$pper=$row_rr['pper'];
$farmer=$row_rr['farmer'];
$pqty=$row_rr['qty'];
$arrqty=$row_rr['act'];
$orgniser=$row_rr['organiser'];

$farmerid=''; $qcstatus=''; $dot='';
/*$sql_lotimp=mysqli_query($link,"select * from tbllotimp where lotnumber='".$row_rr['old']."'") or die(mysqli_error($link)); 
if(mysqli_num_rows($sql_lotimp)>0)
{
$row_lotimp=mysqli_fetch_array($sql_lotimp);
$farmerid=$row_lotimp['farmer_id'];
}*/

$sql_qctbl=mysqli_query($link,"select MIN(tid) from tbl_qctest where oldlot='".$row_rr['orlot']."'") or die(mysqli_error($link)); 
$row_qctbl=mysqli_fetch_array($sql_qctbl);

$sql_qctbl2=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_rr['orlot']."' and tid='".$row_qctbl[0]."'") or die(mysqli_error($link)); 
$row_qctbl2=mysqli_fetch_array($sql_qctbl2);

$sql_qctbl3=mysqli_query($link,"select MAX(tid) from tbl_qctest where oldlot='".$row_rr['orlot']."' and sampleno='".$row_qctbl2['sampleno']."' and yearid='".$row_qctbl2['yearid']."'") or die(mysqli_error($link)); 
$row_qctbl3=mysqli_fetch_array($sql_qctbl3);

$sql_qctbl4=mysqli_query($link,"select * from tbl_qctest where tid='".$row_qctbl3[0]."'") or die(mysqli_error($link)); 
$row_qctbl4=mysqli_fetch_array($sql_qctbl4);
$qcstatus=$row_qctbl4['qcstatus']; 
$dot=$row_qctbl4['testdate'];

if($dot!='' && $dot!='0000-00-00' && $dot!='--' && $dot!='- -')
{
	$dot2=explode("-",$dot);
	$dot=$dot2[2]."-".$dot2[1]."-".$dot2[0];
}
else
{
	$dot='';
}		
		
$frn="FRN/".$ycode."/".$row_rr['ncode'];

$tqty=0;$genpurity=""; $gemp="";
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$lotno."' ") or die(mysqli_error($link));
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $row_issue1[0];
$sql_issuetbl1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
while($row_issuetbl1=mysqli_fetch_array($sql_issuetbl1))
{ 
$tqty=$tqty+$row_issuetbl1['lotldg_balqty']; 
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


$sql_issue123=mysqli_query($link,"select min(lotldg_id) from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_issue123=mysqli_fetch_array($sql_issue123); 
//echo $row_issue1[0];
$sql_issuetbl123=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue123[0]."'") or die(mysqli_error($link)); 
$row_issuetbl123=mysqli_fetch_array($sql_issuetbl123);
$genpurity=$row_issuetbl123['lotldg_genpurity']; 

}
$rswqty=$tqty; 

	$sql_crp23=mysqli_query($link,"select * from tblcrop where cropname='".$row_rr['lotcrop']."'") or die(mysqli_error($link));
	$row_crp23=mysqli_fetch_array($sql_crp23);
	$crp23=$row_crp23['cropid'];
	$crpnm=$row_rr['lotcrop'];

	$sql_var23=mysqli_query($link,"select * from tblvariety where popularname='".$row_rr['lotvariety']."' ") or die(mysqli_error($link));
	$tot_ver23=mysqli_num_rows($sql_var23);
	$row_var23=mysqli_fetch_array($sql_var23);
	$ver23=$row_var23['varietyid'];
	if($tot_ver23 > 0)
	{
		$vernm=$row_var23['vt'];
	}
	else
	{
		$vernm="Coded";
	}
	$vername=$row_rr['lotvariety'];	
		 
$cswqty=""; $tplqty=""; $prosldate="";
$sql_rr22=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_crop='".$crp23."' and proslipmain_variety='".$ver23."' and proslipmain_stage='".$row_rr['sstage']."' and proslipmain_tflag=1 order by proslipmain_id asc") or die(mysqli_error($link));

$tot_rr22=mysqli_num_rows($sql_rr22);
while($row_rr22=mysqli_fetch_array($sql_rr22))
{
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_proslipsub where proslipmain_id='".$row_rr22['proslipmain_id']."' and proslipsub_lotno='".$lotno."' order by proslipsub_lotno asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
	if($t > 0)
	{ $rmqty1=0;$imqty1=0;;
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
			
			$prosldate=$row_rr22['proslipmain_date'];
			
			$tplqty=$rmqty1+$imqty1;
			$cswqty=$cqty1;
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
		
		$sql_promain=mysqli_query($link,"select * from tbl_proslipmain where proslipmain_id='".$row_prosub['proslipmain_id']."'  order by proslipmain_id asc") or die(mysqli_error($link));
		$row_promain=mysqli_fetch_array($sql_promain);
		$prosldate=$row_promain['proslipmain_date'];
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
	
	//$trdate1="'$trdate1'";
$start1 = $row_arr_home1['arrival_date'];
$end1 = date("Y-m-d");
$diff=dateDiff($start1, $end1);
//if($genpurity==0)$genpurity="";

if($vernm=="OP"){$dt=20; }
else if($vernm=="OP"){$dt=120; }
else {$dt=120; }
$spsd='';
if($trdate1!="")
{
	$m=$trmonth1;
	$de=$trday1;
	$y=$tryear1;
	//$dt22=$dt;
	if($dt!="")
	{
		$edor=date('Y-m-d',mktime(0,0,0,$m,($de+$dt),$y)); 
		$gsetupdate=$edor;
		$gsetupdryear=substr($gsetupdate,0,4);
		$gsetupdrmonth=substr($gsetupdate,5,2);
		$gsetupdrday=substr($gsetupdate,8,2);
		$spsd=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear; 
	}
	else
	$spsd="";
}

$sql_lotimp=mysqli_query($link,"select * from tbllotimp where lotnumber='".$row_rr['old']."'") or die(mysqli_error($link));
$row_lotimp=mysqli_fetch_array($sql_lotimp);
$farmerid=$row_lotimp['farmer_id'];
$agreementid=$row_lotimp['agreement_id'];
$status='';
if($row_rr['psflg']==1)
{
	$trpsdate1=$row_rr['psdate'];
	$trpsyear1=substr($trpsdate1,0,4);
	$trpsmonth1=substr($trpsdate1,5,2);
	$trpsday1=substr($trpsdate1,8,2);
	$trpsdate=$trpsday1."-".$trpsmonth1."-".$trpsyear1;
	if($trpsdate=="00-00-0000" || $trpsdate=="--" || $trpsdate=="- -" || $trpsdate==NULL) {$trpsdate="";$status="Paid";}
	else {$status=$trpsdate;}
}
else
{
	$status='Pending';
}
if($tot_rr > 0)
{
$data1[$d]=array($trdate1,$diff,$frn,$lotno1,$ploc,$pper,$orgniser,$farmer,$farmerid,$agreementid,$crpnm,$vername,$vernm,$pqty,$arrqty,$rswqty,$cswqty,$tplqty,$prsldate,$gotr,$dogr,$qcstatus,$dot,$gemp,$genpurity,$spsd,$status); 
$d++;$cntt++;
}
}
}


if($cntt==0)
{
$data1[$d]=array("","","","","","","","Record not Found","","","","","","","","","",""); 
}


echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}