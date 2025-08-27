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
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
 	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtpmcode=$_REQUEST['txtpmcode'];
	
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
	$sql_rr22=mysqli_query($link,"select * from tbl_qcgdata where str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1  order by qcg_sampleno asc") or die(mysqli_error($link));

 	$tot_rr22=mysqli_num_rows($sql_rr22);
 
	
	/*$qry="select * from tbl_qctest where  oldlot!=''  ";
	
	if($crop!="ALL")
	{	
		$qry.="and crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.="and variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.="  group by crop, variety";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);*/
	 	
	$dh="Periodical_Testing_Data_Report:".$tlp."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead1 = array("Periodical_Testing_Data_Report-Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
	$datahead2 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$variet);
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
 
	$datatitle1 = array("#","DOSR","Crop","Variety","Lot No. ","Total Qty (kg)","QC Tests","Sample no.","DOSC","Doc. Ref. No.","Moisture Test Report","""Physical Purity Test Report","","Germination Test Type","GKD","EDOR","","","","Standard Germination Test (SGT)","","","","","","Field Germination Test (FGT)","","","","Updated result","Result Submit Date","QC Status","Remarks","SLOC","","Guard Sample Discard Schedule","Soft Released Lots For Dispatch","","Arrival Details","","");
	
	$datatitle2 = array("","","","","","","","","","","Moisture (%)","Date of Test","PP Result","Date of test","","","","No of replication","Normal Seedlings (%)","Abormal Seedlings (%)","Dead Seeds (%)","Hard/FUG Seeds (%)","Vigor","Date of test","No of replication","Normal Seedlings (%)","Abormal Seedlings (%)","Dead Seeds (%)","Vigor","Date of Test","","","","","Working","Guard","","","Arrival Date","SP Code Female","SP Code Male","Harvest Date");
	
$d=1;


$srno=1; $lotno=""; $enob=""; $eqty=""; $pnob=""; $pqty=""; $rmqty1=""; $rmper1=""; $imqty1=""; $imper1=""; $plqty1=""; $plper1=""; $tplqty=""; $tplper=""; $pmc=""; $psn=""; $treats=""; $oprname="";
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
if($tot_rr22 > 0)
{
while($row_rr22=mysqli_fetch_array($sql_rr22))
{

$samplenum=str_split($row_rr22['qcg_sampleno']);
//print_r($samplenum);

 $smpn=$samplenum[2].$samplenum[3].$samplenum[4].$samplenum[5].$samplenum[6].$samplenum[7];

 $qry="select * from tbl_qctest where  sampleno='".$smpn."' AND yearid='".$samplenum[1]."'  ";
//exit;	
	if($crop!="ALL")
	{	
		$qry.="and crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.="and variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" order by tid desc LIMIT 0,1 ";
	//echo $qry; echo "<br />";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);



while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$sampno=$row_rr22['qcg_sampleno'];//$tp1.$row_arr_home1['yearid'].sprintf("%000006d",$row_arr_home1['sampleno']);
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$cropname=$row31['cropname'];	
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['variety']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$varietyname=$rowvv['popularname'];
	}
	else
	{
		$varietyname=$row_arr_home1['variety'];
	}
	

	$lotno=$row_arr_home1['lotno'];
	$tqty=0; $sloc='';
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
			
			/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl1['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
			
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl1['lotldg_binid']."' and whid='".$row_issuetbl1['lotldg_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
			
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl1['lotldg_subbinid']."' and binid='".$row_issuetbl1['lotldg_binid']."' and whid='".$row_issuetbl1['lotldg_whid']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
			
			if($sloc!="")
			$sloc=$sloc.$wareh.$binn.$subbinn."<br/>";
			else
			$sloc=$wareh.$binn.$subbinn."<br/>";*/
			
			if($row_issuetbl1['lotldg_srflg']>0)
			{
				$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$row_arr_home1['oldlot']."'") or die(mysqli_error($link));
				$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
				if($tot_softr_sub > 0)
				{
					$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
					//echo $row_softr_sub[0];
					$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
					$tot_softr=mysqli_num_rows($sql_softr);
					$row_softr=mysqli_fetch_array($sql_softr);
					if($tot_softr > 0)
					{
						$trdate=$row_softr['softr_date'];
						$trdate=explode("-",$trdate);
						$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
						$softstatus="SR";//$row_softr['softrsub_srtyp'];
					}
				}
				//if($row_issuetbl['lotldg_got']=='UT' || $row_issuetbl['lotldg_got']=='RT')
				if($softstatus=="")
				{
					$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$row_arr_home1['oldlot']."'") or die(mysqli_error($link));
					$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
					if($tot_softr_sub2 > 0)
					{
						$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
						//echo $row_softr_sub2[0];
						$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
						$tot_softr2=mysqli_num_rows($sql_softr2);
						$row_softr2=mysqli_fetch_array($sql_softr2);
						if($tot_softr2 > 0)
						{
							$trdate=$row_softr2['softr_date'];
							$trdate=explode("-",$trdate);
							$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
							$softstatus="SSR";//$row_softr2['softrsub_srtyp'];
						}
					}
				}
			
			}
			
		}
	}
	$totqty=$tqty;
	
	$srdate=$row_arr_home1['srdate'];
	$sryear=substr($srdate,0,4);
	$srmonth=substr($srdate,5,2);
	$srday=substr($srdate,8,2);
	$tsrdate=$srday."-".$srmonth."-".$sryear;
	
	$rdate=$row_arr_home1['spdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$scdate=$rday."-".$rmonth."-".$ryear;

	$dotdate=$row_arr_home1['testdate'];
	$dryear=substr($dotdate,0,4);
	$drmonth=substr($dotdate,5,2);
	$drday=substr($dotdate,8,2);
	$dot=$drday."-".$drmonth."-".$dryear;
	
	$slocgs='';
	$sql_gsm=mysqli_query($link,"select * from tbl_gsample where oldlot='".$row_arr_home1['oldlot']."'") or die(mysqli_error($link));
	$row_gsm=mysqli_fetch_array($sql_gsm);
	if($row_gsm['gswh']!=0 && $row_gsm['gswh']!=0)
	{
		$sql_gswhouse=mysqli_query($link,"select perticulars from tblwarehouse where whid='".$row_gsm['gswh']."' order by perticulars") or die(mysqli_error($link));
		$row_gswhouse=mysqli_fetch_array($sql_gswhouse);
		$warehgs=$row_gswhouse['perticulars']."/";
		
		$sql_gsbinn=mysqli_query($link,"select binname from tblbin where binid='".$row_gsm['gsbin']."' and whid='".$row_gsm['gswh']."'") or die(mysqli_error($link));
		$row_gsbinn=mysqli_fetch_array($sql_gsbinn);
		$binngs=$row_gsbinn['binname']."/";
		if($slocgs!="")
			$slocgs=$slocgs.$warehgs.$binngs."<br/>";
		else
			$slocgs=$warehgs.$binngs."<br/>";
	}
	if($row_arr_home1['state']=="P/M/G" || $row_arr_home1['state']=="P/M/G/T")
	{
		$sql_qcm=mysqli_query($link,"select * from tbl_qcmdata where qcm_sampno='".$sampno."'") or die(mysqli_error($link));
		$row_qcm=mysqli_fetch_array($sql_qcm);
		
		$mmavg=$row_qcm['qcm_mmrmoistper'];
		$haomavg=$row_qcm['qcm_haommoistper'];
		$mdot=$row_qcm['qcm_moistdt'];
		$moistper=$row_qcm['qcm_moistper'];
		
		$sql_qcp=mysqli_query($link,"select * from tbl_qcpdata where qcp_sampleno='".$sampno."'") or die(mysqli_error($link));
		$row_qcp=mysqli_fetch_array($sql_qcp);
		
		$pppureseed=$row_qcp['qcp_pureseedper'];
		$ppim=$row_qcp['qcp_imseedper'];
		$ppls=$row_qcp['qcp_lightseedper'];
		$ppocs=$row_qcp['qcp_ocseedinkg'];
		$ppodv=$row_qcp['qcp_odvseedinkg'];
		$ppdisc=$row_qcp['qcp_dcseedper'];
		$ppph=$row_qcp['qcp_phseedinkg'];
		$ppresult=$row_qcp['qcp_ppresult'];
		
		$ppdot=$row_qcp['qcp_ppdate'];
	
	}
	$qctests=$row_arr_home1['state'];


//echo "select * from tbl_qcgdata where qcg_sampleno='".$sampno."' and  str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1  order by qcg_sampleno asc"."<br />";	
// 		Table code for crop & variety wise lot numbers
//$sql_rr22=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' and  str_to_date(qcg_setupdt, '%d-%m-%Y') <='".date($edate)."' and str_to_date(qcg_setupdt, '%d-%m-%Y') >='".date($sdate)."' and qcg_setupflg=1  order by qcg_sampleno asc") or die(mysqli_error($link));

//$tot_rr22=mysqli_num_rows($sql_rr22);
//while($row_rr22=mysqli_fetch_array($sql_rr22))
//{	
	$docrefno=$row_rr22['qcg_docsrefno'];
	
	$qcg_testtype=$row_rr22['qcg_testtype'];
	
	$qcg_sgtnoofrep=$row_rr22['qcg_sgtnoofrep'];
	$qcg_sgtnormalavg=$row_rr22['qcg_sgtnormalavg'];
	$qcg_sgtabnormalavg=$row_rr22['qcg_sgtabnormalavg'];
	$qcg_sgthardfugavg=$row_rr22['qcg_sgthardfugavg'];
	$qcg_sgtdeadavg=$row_rr22['qcg_sgtdeadavg'];
	$qcg_sgtvremark=$row_rr22['qcg_sgtvremark'];
	
	$qcg_vignoofrep=$row_rr22['qcg_vignoofrep'];
	$qcg_vignormalavg=$row_rr22['qcg_vignormalavg'];
	$qcg_vigabnormalavg=$row_rr22['qcg_vigabnormalavg'];
	$qcg_vigdeadavg=$row_rr22['qcg_vigdeadavg'];
	$qcg_vigvremark=$row_rr22['qcg_vigvremark'];
	
	$qcg_germp=$row_rr22['qcg_germp'];
	$qcg_retult=$row_rr22['qcg_retult'];
	$remarks=$row_rr22['qcg_oprremark'];
	
	$germpdate=$row_rr22['qcg_germpdt'];
	$germpdryear=substr($germpdate,0,4);
	$germpdrmonth=substr($germpdate,5,2);
	$germpdrday=substr($germpdate,8,2);
	$qcg_germpdt=$germpdrday."-".$germpdrmonth."-".$germpdryear;
	if($qcg_germpdt=="0000-00-00"){$qcg_germpdt='';}
	
	
	$qcg_vigdt=$row_rr22['qcg_vigdt'];
	
	$gsetupdate=$row_rr22['qcg_setupdt'];
	$gsetupdryear=substr($gsetupdate,0,4);
	$gsetupdrmonth=substr($gsetupdate,5,2);
	$gsetupdrday=substr($gsetupdate,8,2);
	$gkd=$row_rr22['qcg_setupdt'];//$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear;
	if($gkd=="0000-00-00"){$gkd='';}
		
	$qcg_sgtdt=$row_rr22['qcg_sgtdt'];
	
	
	$dt=$row31['expdt']+1;
	if($gkd!="")
	{
		$m=$gsetupdrmonth;
		$de=$gsetupdrday;
		$y=$gsetupdryear;
		$dt22=$dt;
		if($dt!="")
		{
			$edor=date('Y-m-d',mktime(0,0,0,$m,($de-$dt),$y)); 
			$gsetupdate=$edor;
			$gsetupdryear=substr($gsetupdate,0,4);
			$gsetupdrmonth=substr($gsetupdate,5,2);
			$gsetupdrday=substr($gsetupdate,8,2);
			$edor=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear; 
		}
		else
		$edor="";
	}
	
	if($qcg_germpdt!='')
	{
		$m=$germpdrmonth;
		$de=$germpdrday;
		$y=$germpdryear;
		$dt=1;
		if($qcg_germpdt!="")
		{
			$gsdd=date('Y-m-d',mktime(0,0,0,$m,$de,($y+1))); 
			$gsetupdate=$gsdd;
			$gsetupdryear=substr($gsetupdate,0,4);
			$gsetupdrmonth=substr($gsetupdate,5,2);
			$gsetupdrday=substr($gsetupdate,8,2);
			$gsdd=$gsetupdrday."-".$gsetupdrmonth."-".$gsetupdryear;  
		}
		else
		$gsdd="";
	}
	
	$oltn=str_split($row_arr_home1['oldlot']);
	$oldlotnm=$oltn[1].$oltn[2].$oltn[3].$oltn[4].$oltn[5].$oltn[6];
	
	$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where old='".$oldlotnm."'") or die(mysqli_error($link));
	$row_arrsub=mysqli_fetch_array($sql_arrsub);
	
	$spcf=$row_arrsub['spcodef'];
	$spcm=$row_arrsub['spcodem'];
	
	
	$hardate=$row_arrsub['harvestdate'];
	$hardtyear=substr($hardate,0,4);
	$hardtmonth=substr($hardate,5,2);
	$hardtday=substr($hardate,8,2);
	$harvestdate=$hardtday."-".$hardtmonth."-".$hardtyear;
	if($harvestdate=="0000-00-00"){$harvestdate='';}
	
	$sql_arrmain=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_arrsub['arrival_id']."'") or die(mysqli_error($link));
	$row_arrmain=mysqli_fetch_array($sql_arrmain);
	
	$arrdate=$row_arrmain['arrival_date'];
	$arrdtyear=substr($arrdate,0,4);
	$arrdtmonth=substr($arrdate,5,2);
	$arrdtday=substr($arrdate,8,2);
	$arrivaldate=$arrdtday."-".$arrdtmonth."-".$arrdtyear;
	if($arrivaldate=="0000-00-00"){$arrivaldate='';}
	
if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$tsrdate,$cropname,$varietyname,$lotno,$totqty,$qctests,$sampno,$scdate,$docrefno,$moistper,$mdot,$ppresult,$ppdot,$qcg_testtype,$gkd,$edor,$qcg_sgtnoofrep,$qcg_sgtnormalavg,$qcg_sgtabnormalavg,$qcg_sgtdeadavg,$qcg_sgthardfugavg,$qcg_sgtvremark,$qcg_sgtdt,$qcg_vignoofrep,$qcg_vignormalavg,$qcg_vigabnormalavg,$qcg_vigdeadavg,$qcg_vigvremark,$qcg_vigdt,$qcg_germp,$qcg_germpdt,$qcg_retult,$remarks,$sloc,$slocgs,$gsdd,$softstatus,$arrivaldate,$spcf,$spcm,$harvestdate); 
$d++;
}
}
}
}

echo implode($datahead1) ;
echo "\n";
echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datatitle1) ;
echo "\n";
echo implode("\t", $datatitle2) ;
echo "\n";
	
foreach($data1 as $row1)
{ 
	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}
#echo implode("\t", $datatitle3) ;