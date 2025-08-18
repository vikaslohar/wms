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
	
	 //$pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
 	$gottest_trstage = $_REQUEST['txtstage'];
	
	$t=split("-", $sdate);
	$sdate=$t[2]."-".$t[1]."-".$t[0];
	
	if($gottest_trstage!="ALL")
	$sql_arr_home=mysqli_query($link,"select distinct(gottest_sampleno) from tbl_gottest where gottest_gotdate='$sdate' and gottest_trstage='$gottest_trstage' and gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc") or die(mysqli_error($link));
	else
	$sql_arr_home=mysqli_query($link,"select distinct(gottest_sampleno) from tbl_gottest where gottest_gotdate='$sdate' and gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	 	
	$dh="Daily_GOT_Result_Report_Result_Updated_on:".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("Daily GOT Result Report Result Updated on ",$_REQUEST['sdate']);
	$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$variet);
	$data1 = array();
	
	function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	   
	    # file name for download $filename = "Order Details.xls";
		
	    $filename=$dh.".xls";  
	   //exit;
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel");
		 //$datatitle1 = array("Preliminary QC");
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","NoB","Qty","PP","Moist%","Germination %","DOT","QC Status","DOGR","GOT Status","GOT Doc. Ref. No.");
$d=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

if($gottest_trstage!="ALL")
	$sql_arr_home2=mysqli_query($link,"select MAX(gottest_tid) from tbl_gottest where gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_gotdate='$sdate' and gottest_trstage='$gottest_trstage' and gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc") or die(mysqli_error($link));
else
	$sql_arr_home2=mysqli_query($link,"select MAX(gottest_tid) from tbl_gottest where gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_gotdate='$sdate' and gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc") or die(mysqli_error($link));
	$row_arr_home3=mysqli_fetch_array($sql_arr_home2);

$sql_arr_home3=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' and gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home3);
while($row_arr_home=mysqli_fetch_array($sql_arr_home3))
{	
	$trdate=$row_arr_home['gottest_gotdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['gottest_tid'];
	
if($row_arr_home['gottest_trstage']!="Pack")
{	
$slups=0; $slqty=0; $sstage="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
$got=$row_arr_home['moist'];
$stage=$row_arr_home['gemp'];
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
	 while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);


while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
$qcresult=$row_tbl_sub['lotldg_qc'];
$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
$lotno=$row_tbl_sub['lotldg_lotno'];
$qc=$row_tbl_sub['lotldg_vchk'];
if($got=="")
$got=$row_tbl_sub['lotldg_moisture'];
if($stage=="")
$stage=$row_tbl_sub['lotldg_gemp'];
$sstatus=$row_tbl_sub['lotldg_sstatus'];
$crop=$row_tbl_sub['lotldg_crop'];
$variety=$row_tbl_sub['lotldg_variety'];
	$trdate1=$row_tbl_sub['lotldg_qctestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
}
}
else
{
$slups=0; $slqty=0; $sstage="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
$got=$row_arr_home['moist'];
$stage=$row_arr_home['gemp'];
	$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid, lotldg_variety, lotldg_crop, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arr_home['gottest_lotno']."' group by subbinid, lotldg_variety, lotno order by subbinid") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
	 while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
	{
	
	$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);


while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups="";
$slqty=$slqty+$row_tbl_sub['balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
$qcresult=$row_tbl_sub['lotldg_qc'];
$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
$lotno=$row_tbl_sub['lotno'];
$qc=$row_tbl_sub['lotldg_vchk'];
if($got=="")
$got=$row_tbl_sub['lotldg_moisture'];
if($stage=="")
$stage=$row_tbl_sub['lotldg_gemp'];
$sstatus=$row_tbl_sub['lotldg_sstatus'];
$crop=$row_tbl_sub['lotldg_crop'];
$variety=$row_tbl_sub['lotldg_variety'];
	$trdate1=$row_tbl_sub['lotldg_qctestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
}
}
$lotno=$row_arr_home['gottest_oldlot'];
$sstage=$row_arr_home['gottest_trstage'];

if($qcresult=="")
$qcresult=$row_arr_home['qcstatus'];

$gotrefno=$row_arr_home['gotrefno'];
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

	$bags=$acn;
	$qty=$ac;
		
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$variety."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv1=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv1=$tt;
	  }
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$crop."'"); 
	$row31=mysqli_fetch_array($quer3);
	
$cropp=$row31['cropname'];
if($tot_arr_home > 0)			
{
$grr=explode(" ", $gotresult);	
if($grr[1]!="UT")
{
$data1[$d]=array($d,$cropp,$vv1,$lotno,$bags,$qty,$qc,$got,$stage,$trdate1,$qcresult,$trdate,$gotresult,$gotrefno); 
$d++;
}
}
}
}

# coading ends here............
/*echo implode($datahead1) ;
echo "\n";
*/
echo implode($datahead2) ;
echo "\n";


echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;