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
	$loc = $_REQUEST['txtclass'];
	$state = $_REQUEST['state'];
	$txtorganiser = $_REQUEST['txtorganiser'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
 	
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
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where (arrival_type='Fresh Seed with PDN') and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);

	/* $s = "select stores_item,uom from tbl_stores where items_id = $itemid";
		$r = mysqli_query($link,$s) or die(mysqli_error($link));	 
		$ro = mysqli_fetch_array($r);
		$stores_item = $ro['stores_item'];
		$uom = $ro['uom'];*/
			
		 	  
	 /*  $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	  	
	$dh="Periodical_Arrival_and_Processing_Report_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead1=array("Periodical Arrival and Processing Report: Date From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
	$data1 = array();
	
	function cleanData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str); 
		$str = preg_replace("/\n/", "\\n", $str);
	} 
	   
	# file name for download $filename = "Order Details.xls";
		
		$filename=$dh.".xls";  
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel"); 
 	 $datatitle2 = array("","","","Arrival","","","","","","","Production Information","","","","","","Processing","","","Quality","");
	 $datatitle3 = array("#","Date of Arrival","Crop","SP-F","SP-M","Lot No.","NoB","Qty","Production Personnel","Organiser","Farmer","State","Production Location","Processing Date","Raw Qty (Picked)","Condition Qty","Total Condition Loss Qty","Raw Qty (Balance)","Duration (Days)","GOT Status","DOGR");
/* $datatitle1 = array("Date","Transaction Type","Old Lotnumber","Lotnumber","SP-F","SP-M","Crop","Organiser","Farmer","Production Location","Production Personnel","Plot No.","Old Lotnumber,"Farmer",");,"QC Status","Moisture %","Physical Purity","GOT"
*/$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql="select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode' ";
	if($state!="ALL")
	{
		$sql.=" and lotstate='".$state."'";
	}
	if($loc!="ALL")
	{
		$sql.=" and ploc='".$loc."'";
	}
	if($txtorganiser!="ALL")
	{
		$sql.=" and pper='".$txtorganiser."'";
	}
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql.=" and lotcrop='".$row_crop['cropname']."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."'  and vertype='PV' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql.=" and lotvariety='".$row_var['popularname']."'";
	}
		$sql.=" order by lotstate asc, ploc asc, lotcrop asc, lotvariety asc";
		//echo $sql;
	$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
		$farm="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $state2=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12="";$trdate1=""; $p=""; $stnno1="";
		$trdate=$row_arr_home['arrival_date'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;
		
		$trhdate=$row_tbl_sub['harvestdate'];
		$trhyear=substr($trhdate,0,4);
		$trhmonth=substr($trhdate,5,2);
		$trhday=substr($trhdate,8,2);
		$harvestdate=$trhday."-".$trhmonth."-".$trhyear;

		$aq=explode(".",$row_tbl_sub['act']);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
		
		$an=explode(".",$row_tbl_sub['act1']);
		if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
		if($ac>0 && $acn==0)$acn=1;
		
		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];	
		$spf=$row_tbl_sub['spcodef'];	
		$spm=$row_tbl_sub['spcodem'];	
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc=$row_tbl_sub['qc'];
		$got=$row_tbl_sub['got1'];
		$stage=$row_tbl_sub['sstage'];
		$moist=$row_tbl_sub['moisture'];
		$org=$row_tbl_sub['pper'];
		
		if($row_tbl_sub['vchk'] =="Acceptable") { $p="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $p="NAcc";}
		$pp=$p;
		$state2=$row_tbl_sub['lotstate'];
		$pp1=$row_tbl_sub['ploc'];
		$pp12=$row_tbl_sub['organiser'];
		$farm=$row_tbl_sub['farmer'];
		
		if($row_tbl_sub['ncode']!="" && $row_tbl_sub['ncode']!=0)
		{
			$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
		}
		else
		{
			$stnno="";
		}
		
		$pqty=0; $conqty=0; $tcl=0; $tclper=0; $bqty=0; $processdate=''; $duration='';
		$sq_prosub=mysqli_query($link,"SELECT * FROM tbl_proslipsub where proslipsub_lotno='$lotno' and plantcode='$plantcode' order by proslipsub_id Asc") or die(mysqli_error($link));
		while($row_prosub=mysqli_fetch_array($sq_prosub))
		{
			$pqty=$pqty+$row_prosub['proslipsub_pqty']; 
			$conqty=$conqty+$row_prosub['proslipsub_conqty']; 
			$tcl=$tcl+$row_prosub['proslipsub_tlqty']; 
			$tclper=$tclper+$row_prosub['proslipsub_tlper'];
			$bqty=round($qty,3)-round(($conqty+$tcl),3);
			$bqty=round($bqty,3);
			if($bqty<0){$bqty=0;}
			
			$sq_prom=mysqli_query($link,"SELECT * FROM tbl_proslipmain where proslipmain_id='".$row_prosub['proslipmain_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
			$row_prom=mysqli_fetch_array($sq_prom);
			
			$trhdate=$row_prom['proslipmain_date'];
			$trhyear=substr($trhdate,0,4);
			$trhmonth=substr($trhdate,5,2);
			$trhday=substr($trhdate,8,2);
			$processdate=$trhday."-".$trhmonth."-".$trhyear;
			
			$diff = abs(strtotime($row_arr_home['arrival_date']) - strtotime($row_prom['proslipmain_date']));
			$duration = floor($diff / (60*60*24));
		}
		$qcsts=''; $germper=''; $dot=''; $gotsts=''; $genpper=''; $dogr='';
		
		
		$sq_qctest=mysqli_query($link,"SELECT MAX(gemp) FROM tbl_qctest where oldlot='".$row_tbl_sub['orlot']."' order by gemp Desc") or die(mysqli_error($link));
		while($row_qctest=mysqli_fetch_array($sq_qctest))
		{	
			$sq_qctest1=mysqli_query($link,"SELECT * FROM tbl_qctest where oldlot='".$row_tbl_sub['orlot']."' and gemp='".$row_qctest[0]."' ") or die(mysqli_error($link));
			$row_qctest1=mysqli_fetch_array($sq_qctest1);
			
			$qcsts=$row_qctest1['qcstatus'];
			$germper=$row_qctest1['gemp'];
			
			$trdate1=$row_qctest1['testdate'];
			$tryear1=substr($trdate1,0,4);
			$trmonth1=substr($trdate1,5,2);
			$trday1=substr($trdate1,8,2);
			$dot=$trday1."-".$trmonth1."-".$tryear1;
			if($dot=="00-00-0000" || $dot=="--" || $dot=="- -" || $dot==NULL)
			{$dot='';}
			
			$gotsts=$row_qctest1['gotstatus'];
			$genpper=$row_qctest1['genpurity'];
			
			$trdate2=$row_qctest1['gotdate'];
			$tryear2=substr($trdate2,0,4);
			$trmonth2=substr($trdate2,5,2);
			$trday2=substr($trdate2,8,2);
			$dogr=$trday2."-".$trmonth2."-".$tryear2;
			if($dogr=="00-00-0000" || $dogr=="--" || $dogr=="- -" || $dogr==NULL)
			{$dogr='';}
		}
		
		$sq_gottest1=mysqli_query($link,"SELECT * FROM tbl_gottest where gottest_oldlot ='".$row_tbl_sub['orlot']."' order by gottest_tid DESC ") or die(mysqli_error($link));
		if(mysqli_num_rows($sq_gottest1)>0)
		{
			$row_gottest1=mysqli_fetch_array($sq_gottest1);
			
			$gotsts=$row_gottest1['gottest_gotstatus'];
			$genpper=$row_gottest1['genpurity'];
			
			$trdate2=$row_gottest1['gottest_gotdate'];
			$tryear2=substr($trdate2,0,4);
			$trmonth2=substr($trdate2,5,2);
			$trday2=substr($trdate2,8,2);
			$dogr=$trday2."-".$trmonth2."-".$tryear2;
			if($dogr=="00-00-0000" || $dogr=="--" || $dogr=="- -" || $dogr==NULL)
			{$dogr='';}
		}
				
	

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$trdate,$crop,$spf,$spm,$lotno,$bags,$qty,$org,$pp12,$farm,$state2,$pp1,$processdate,$pqty,$conqty,$tcl,$bqty,$duration,$gotsts,$dogr); 
$d++;
}
}
}
}
//}
echo implode("\t", $datahead1);
echo "\n";
echo implode("\t", $datatitle2);
echo "\n";
echo implode("\t", $datatitle3);
echo "\n";
foreach($data1 as $row1)
{ 
	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}
#echo implode("\t", $datatitle3) ;