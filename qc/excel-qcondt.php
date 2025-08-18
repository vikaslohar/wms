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
	 $edate = $_REQUEST['edate'];
	 $itemid = $_REQUEST['txtcrop'];
	 $vv= $_REQUEST['txtvariety'];
	 $result = $_REQUEST['result'];
 	
	$t=split("-", $edate);
	$edate=$t[2]."-".$t[1]."-".$t[0];
	
	$reslt="";
 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	 
	
	$qry="select distinct variety from tbl_qctest where spdate<='".$edate."' and crop='".$itemid."' ";
	
	
	if($vv!="ALL")
	{
		$qry.=" and variety='".$vv."' ";
	}
	if($result!="ALL")	
	{
		$qry.=" and qcstatus='".$result."' ";
		$reslt=" and qcstatus='".$result."' ";
	}
	
	$qry.=" order by variety asc,spdate asc ";
	//echo $qry;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

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
			$vv=$vv;
		}
		else
		{
			$vv=$tt;
		}
	}
 	 
	$dh="QC_Status_Report:".$tlp."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("QC Status Report As on Date: ",$_REQUEST['edate']);
$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$vv);
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
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","NoB","Qty","PP","Moist%","Germination %","DOT","QC Status","QC Doc. Ref. No.","DOGR","GOT Status");
$d=1;

while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$sql_arr_home2=mysqli_query($link,"select distinct oldlot from tbl_qctest where spdate<='$edate' and crop='".$itemid."'  and variety='".$row_arr_home1['variety']."' and state!='T' $reslt order by variety asc, spdate asc ") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_arr_home2);
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{

$sql_arr_home3=mysqli_query($link,"select MAX(tid) from tbl_qctest where spdate<='$edate' and crop='".$itemid."'  and variety='".$row_arr_home1['variety']."' and oldlot='".$row_arr_home2['oldlot']."' and state!='T' $reslt order by variety asc, spdate asc ") or die(mysqli_error($link));
while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
{
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where spdate<='$edate' and crop='".$itemid."'  and variety='".$row_arr_home1['variety']."' and oldlot='".$row_arr_home2['oldlot']."' and tid='".$row_arr_home3[0]."' $reslt order by variety asc, spdate asc ") or die(mysqli_error($link));

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$flg=0;	$qcresult="";
	$qcresult=$row_arr_home['qcstatus'];	
$slups=0; $slqty=0; $sstage="";	$qcrefno="";
$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where orlot='".$row_arr_home['oldlot']."'  order by lotldg_subbinid") or die(mysqli_error($link));
 $t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and orlot='".$row_arr_home['oldlot']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $row_arr_home['oldlot']."  ".$row_tbl1[0]."<br />";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; 

while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	$slups=$slups+$row_tbl_sub['lotldg_balbags'];
	$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
	if($qcresult=="" || $qcresult=="Abort")
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
}
$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where orlot='".$row_arr_home['oldlot']."'  order by subbinid") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
{
$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and orlot='".$row_arr_home['oldlot']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $row_arr_home['oldlot']."  ".$row_tbl1[0]."<br />";
$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; 

while($row_tbl_sub=mysqli_fetch_array($sql1))
{
	//$slups=$slups+$row_tbl_sub['lotldg_balbags'];
	$slqty=$slqty+$row_tbl_sub['balqty'];
	if($qcresult=="" || $qcresult=="Abort")
	$qcresult=$row_tbl_sub['lotldg_qc'];
	$gorr=explode(" ", $row_tbl_sub['lotldg_got1']);
	$gotresult=$gorr[0]." ".$row_tbl_sub['lotldg_got'];
	
	$qc=$row_tbl_sub['lotldg_vchk'];
	$got=$row_tbl_sub['lotldg_moisture'];
	$stage=$row_tbl_sub['lotldg_gemp'];
	$sstatus=$row_tbl_sub['lotldg_sstatus'];
	$trdate1=$row_tbl_sub['lotldg_gottestdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	if($trdate1=="00-00-0000" || $trdate1=="--")$trdate1="";
}
}
$lotno=$row_arr_home['oldlot'];
$sstage=$row_arr_home['trstage'];
if($got=="")
$got=$row_arr_home['moist'];
if($stage=="")
$stage=$row_arr_home['gemp'];

if($qcresult=="")
$qcresult=$row_arr_home['qcstatus'];
$qcrefno=$row_arr_home['qcrefno'];
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
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
	
	if($qc=="Acceptable")
	{
	$qc="Acc";
	}
	else
	{
	$qc="NAcc";
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  

    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($result!="ALL" && $result!=$qcresult)$flg++;	
if($qcresult=="NUT")$flg++;	
if(($qcresult=="OK" || $qcresult=="Fail") && $qty==0)$flg++;
if($qcresult=="RT" || $qcresult=="UT"){$stage=""; $trdate="";}
	
$cropp=$row31['cropname'];
if($tot_arr_home > 0)			
{
if($flg==0)
{
$cnt++;
$data1[$d]=array($d,$cropp,$vv,$lotno,$bags,$qty,$qc,$got,$stage,$trdate,$qcresult,$qcrefno,$trdate1,$gotresult); 
$d++;
}
}
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

echo implode("\t", $datatitle2) ;
echo "\n";
foreach($data1 as $row1)
{ 
 	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}
#echo implode("\t", $datatitle3) ;