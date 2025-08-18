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
	
if($vv=="ALL")
	{	
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
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
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv'  and vertype='PV'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}
		
	$dh="Arrival:_Stock_Transfer- Crop-Variety wise Report".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead2 = array("Arrival: Stock Transfer-Plant Crop-Variety wise Report -Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
		$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$variet);
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
 $datatitle2 = array("","","","","","","","PP","Moist %","Germ %","","","","");
	 $datatitle3 = array("#","Stock Transfer From Plant ","Variety","Lot No.","NoB","Qty","Stage","QC","","","QC Status","DoT"," GOT Status", "DoGR");
/* $datatitle1 = array("Date","Transaction Type","Old Lotnumber","Lotnumber","SP-F","SP-M","Crop","Organiser","Farmer","Production Location","Production Personnel","Plot No.","Old Lotnumber,"Farmer",");,"QC Status","Moisture %","Physical Purity","GOT"
*/$d=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	/*and lotcrop='".$itemid."' 
		and lotcrop='".$itemid."' and lotvariety='".$vv."' */
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $subtbltot=0;
	
	if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$row_dept['cropname']."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and lotcrop='".$row_dept['cropname']."' and lotvariety='".$variet."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	}
$subtbltot=mysqli_num_rows($sql_tbl_sub);
if($subtbltot > 0)
	{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
$acn=$row_tbl_sub['act1'];

$var=$row_tbl_sub['lotvariety'];
$crop=$row_tbl_sub['lotcrop'];
$lotno=$row_tbl_sub['lotno'];
$bags=$acn;
$qty=$ac;
$qc=$row_tbl_sub['gemp'];
$got=$row_tbl_sub['got'];
$got1=$got." ".$row_tbl_sub['got1'];
$stage=$row_tbl_sub['sstage'];
$moist=$row_tbl_sub['moisture'];
if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}

$loc1=$row_party['business_name'];
$sstatus=$row_tbl_sub['sstatus'];
$lotoldlot=$row_tbl_sub['lotoldlot'];
		
		$lotno=$row_tbl_sub['lotno'];
		$bags=$acn;
		$qty=$ac;
		$qc1=$row_tbl_sub['qc'];
	

		/*$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_variety);
		*/
		$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
		$row_party=mysqli_fetch_array($sql_party);

		/*$crop=$row_crop['cropname'];
		$variety=$row_variety['popularname'];*/
		$stage=$row_tbl_sub['sstage'];
		$party=$row_party['business_name'];
		
		$tdate12=$row_tbl_sub['testd'];
		$tyear12=substr($tdate12,0,4);
		$tmonth12=substr($tdate12,5,2);
		$tday12=substr($tdate12,8,2);
		$tdate12=$tday12."-".$tmonth12."-".$tyear12;
		
		$tdate13=$row_tbl_sub['gotdate'];
		$tyear13=substr($tdate13,0,4);
		$tmonth13=substr($tdate13,5,2);
		$tday13=substr($tdate13,8,2);
		$tdate13=$tday13."-".$tmonth13."-".$tyear13;

				 	

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$party,$var,$lotno,$bags,$qty,$stage,$vk,$moist,$qc,$qc1,$tdate12,$got1,$tdate13); 
$d++;
}
}
}
}
//},$sstatus,$moist,$vk,$got


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