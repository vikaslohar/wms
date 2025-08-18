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
	 $edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['txtcrop'];
	 $vv = $_REQUEST['txtvariety'];
	 //$mtype = $_REQUEST['ret'];
 	
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
		
	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
	$row_dept=mysqli_fetch_array($quer2);
	$crop=$row_dept['cropname'];
	
if($_GET['txtvariety'] != 'ALL')
	 {
	 $ss = "select popularname from tblvariety where varietyid='".$_GET['txtvariety']."'  and vertype='PV'";
	 		$rr = mysqli_query($link,$ss) or die(mysqli_error($link));	 
			$ros = mysqli_fetch_array($rr);
			$cls = $ros['popularname'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
	 
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Trading' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ");

	$tot_arr_home=mysqli_num_rows($sql_arr_home); 
		 
$dh=" Crop_Variety_wise _Trading_Arrivals_Report ".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead2 = array("Crop-Variety wise Trading Arrival Report  -Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
		$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$cls);
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

	 $datatitle2 = array("","","","","","","","","PP","Moist %","","");
	 $datatitle3 = array("#","Variety"," V. Lot No."," Vendor Name"," Lot No.","NoB","Qty"," Stage","QC","","QC Status","GOT Status");
	 $d=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	if($vv=="ALL")
	{
	$sql="select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$crop."' and plantcode='".$plantcode."'";
	}
	else
	{
	$sql="select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$crop."' and lotvariety='".$cls."' and plantcode='".$plantcode."'";
	}
	$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arsub=mysqli_num_rows($sql_tbl_sub);

	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$vchk="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		$crop=$row_arr_home['lotcrop'];
		$variety=$row_arr_home['lotvariety'];	
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc=$row_tbl_sub['qc'];
		$got=$row_tbl_sub['got1'];
		$stage=$row_arr_home['sstage'];
		$per=$row_tbl_sub['moisture'];
		$loc1=$row_party['business_name'];
		$sstatus=$row_tbl_sub['sstatus'];
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		$vk="";
		if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}		
if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$variety,$loc1,$lotoldlot,$lotno,$bags,$qty,$stage,$vk,$per,$qc,$got); 
$d++;
}
}
}
//}
//},$sstatus$qc,


# coading ends here............


echo implode($datahead2) ;
echo "\n";

echo implode($datahead1) ;
echo "\n";

echo implode("\t", $datatitle3) ;
echo "\n";
echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;