<?php
ob_start();session_start();
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
	 $edate = $_REQUEST['edate'];
	 $itemid = $_REQUEST['txtcrop'];
	 $vv= $_REQUEST['txtvariety'];
	 $result = $_REQUEST['result'];
 	
	$t=explode("-", $sdate);
	$sdate=$t[2]."-".$t[1]."-".$t[0];
	
	$t=explode("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 

	if($vv=="ALL")
	{
	if($result=="ALL")	
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
	}
	else
	{
	if($result=="ALL")	
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
	}

 $tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$vv."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $variet=$vv;
	 }
	 else
	 {
	  $variet=$tt;
	  }
	}
 	 
	 /* $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	 	
	$dh="Periodical_Qc_Report_Report:".$tlp."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("Periodical_Qc_Report_Report -Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
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
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","NoB","Qty","PP","Moist%","Germination %","DOT","QC Status","Previous QC Status","DOGR","GOT Status");
$d=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

if($vv=="ALL")
{
	if($result=="ALL")	
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
}
else
{
	if($result=="ALL")	
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and  qcflg=1 and qcstatus!='RT' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and testdate<='$edate' and testdate>='$sdate' and crop='".$itemid."' and variety='$vv' and qcflg=1 and qcstatus='$result' order by spdate asc ") or die(mysqli_error($link));
	}
}

$row_arr_home3=mysqli_fetch_array($sql_arr_home2);

$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' and sampleno='".$row_arr_home2['sampleno']."' and qcflg=1 order by spdate asc") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home3);
while($row_arr_home=mysqli_fetch_array($sql_arr_home3))
{	
	$trdate=$row_arr_home['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$extqcresult="UT";	
	$sql_qctest=mysqli_query($link,"select * from tbl_qctest where qcflg=1 and tid!='".$row_arr_home3[0]."' and qcstatus!='".$row_arr_home['qcstatus']."' and oldlot='".$row_arr_home['oldlot']."' order by tid desc ") or die(mysqli_error($link));
	if($subtblqctot=mysqli_num_rows($sql_qctest)>0)
	{
		$row_qctest=mysqli_fetch_array($sql_qctest);
		$extqcresult=$row_qctest['qcstatus'];
	}
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage="";
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";

$got=$row_arr_home['moist'];
$stage=$row_arr_home['gemp'];

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
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
$lotno=$row_arr_home['oldlot'];
$sstage=$row_arr_home['trstage'];

if($qcresult=="")
$qcresult=$row_arr_home['qcstatus'];
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
/*	//$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id." '") or die(mysqli_error($link));
	
		
		lotno
		
if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$itemid."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$crop."' and lotvariety='".$vv."'") or die(mysqli_error($link));
	}	
	echo  $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
		
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['qcstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $qcresult=$row_arr_home['qcstatus'];
		}*/
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
		}
		/*if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['lotno'];
		}
		else
		{
		$lotno=$row_arr_home['lotno'];
		}*/
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		/*if($qc!="")
		{
		$qc=$qc."<br>".$row_arr_home['pp'];
		}
		else
		{
		$qc=$row_arr_home['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['gemp'];
		}
		else
		{
		$stage=$row_arr_home['gemp'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_arr_home['sstatus'];
		}
		else
		{
		$sstatus=$row_arr_home['sstatus'];
		}*/
	
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
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
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
$cropp=$row31['cropname'];
if($tot_arr_home > 0)			
{
if($qcresult!="UT")
{
$data1[$d]=array($d,$cropp,$vv1,$lotno,$bags,$qty,$qc,$got,$stage,$trdate,$qcresult,$extqcresult,$trdate1,$gotresult); 
$d++;
}
}
}
}


//},$per,$sstatus


# coading ends here............
/**/echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

/*echo implode("\t", $datatitle1) ;
echo "\n";*/
/*echo implode("\t", $datatitle3) ;
echo "\n";*/

echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;