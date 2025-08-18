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
	 $sdate = $_GET['sdate'];
	 $edate = $_GET['edate'];
	   $itemid = $_GET['txtcrop'];
      $loc = $_GET['txtvariety'];
	  $typ = $_GET['txtvisualck'];
 	//exit;
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
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 

	if($loc=="ALL")
	{
	$vit="ALL";
	$sql_tbl_s=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$crop."' and plantcode='$plantcode' group by lotvariety, sstage") or die(mysqli_error($link));
	$tot_arsub=mysqli_num_rows($sql_tbl_s);
	}
	else
	{
	$sql_vit=mysqli_query($link,"select * from tblvariety where varietyid='".$loc."' ") or die(mysqli_error($link));
	$row_vit=mysqli_fetch_array($sql_vit);
	$vit=$row_vit['popularname'];
	$sql_tbl_s=mysqli_query($link,"select distinct sstage, lotvariety from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$vit."' and plantcode='$plantcode' group by lotvariety, sstage") or die(mysqli_error($link));
	$tot_arsub=mysqli_num_rows($sql_tbl_s);
	}
 	  if($typ=="Trading"){$typ1="Trading Arrival";$typ2="Trading_Arrival";}
	else if($typ=="Fresh Seed with PDN"){$typ1="Fresh Seed Arrival with PDN ";$typ2="Fresh_Seed_Arrival_with_PDN";}
	
	$dh="Consolidated_Arrival_".$typ2."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("Consolidated Arrival:Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
	$datahead1 = array($typ1,  "Crop:",  $crop);
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
		 //$datatitle1 = array("Preliminary QC");
     // $datatitle2 = array("","","","","","","","","","PP","Moist %","Germ %","","","","","");
	 $datatitle3 = array("#","Variety","Stage","Total Qty","Qty:GOT-R","Qty:GOT-NR");
/* $datatitle1 = array("Date","Transaction Type","Old Lotnumber","Lotnumber","SP-F","SP-M","Crop","Organiser","Farmer","Production Location","Production Personnel","Plot No.","Old Lotnumber,"Farmer",");
*/$d=1; $arr_id="";
if($tot_arsub > 0)	
{
while($row_tbl_s=mysqli_fetch_array($sql_tbl_s))
{
//echo $row_tbl_s[0]."<br>";
if($loc=="ALL")
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$row_tbl_s[1]."' and sstage='".$row_tbl_s[0]."' and plantcode='$plantcode' ") or die(mysqli_error($link));
}
else
{
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$crop."' and lotvariety='".$row_tbl_s[1]."' and sstage='".$row_tbl_s[0]."' and plantcode='$plantcode' ") or die(mysqli_error($link));
}
$tot_sub=mysqli_num_rows($sql_tbl_sub);
if($tot_sub > 0)
{
$sqty=0; $gotrq=0; $gotnrq=0; $cnt=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($arr_id!="")
$arr_id=$arr_id.",".$row_tbl_sub['arrival_id'];
else
$arr_id=$row_tbl_sub['arrival_id'];
$sql_armain=mysqli_query($link,"select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and arrival_id='".$row_tbl_sub['arrival_id']."' and plantcode='$plantcode' order by arrival_date desc") or die(mysqli_error($link));
$tot_armain=mysqli_num_rows($sql_armain);
if($tot_armain > 0)
{
	$arr_id=$row_tbl_sub['arrival_id'];
	$sqty=$sqty+$row_tbl_sub['act'];
	if($row_tbl_sub['got']=="GOT-R")
	{
		$gotrq=$gotrq+$row_tbl_sub['act'];
	}
	if($row_tbl_sub['got']=="GOT-NR")
	{
		$gotnrq=$gotnrq+$row_tbl_sub['act'];
	}
	$cnt++;
}
}
if($arr_id!="")$aaaa=" and arrival_id IN ($arr_id)";
else
$aaaa="";
//echo $sql="select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 $aaaa order by arrival_date desc";
$sql_armain12=mysqli_query($link,"select * from tblarrival where arrival_date <= '$edate' and arrival_date >= '$sdate' and arrival_type='".$typ."' and arrtrflag=1 and plantcode='$plantcode' $aaaa order by arrival_date desc") or die(mysqli_error($link));
$tot_armain12=mysqli_num_rows($sql_armain12);

						$sqty=$sqty+$row_tbl_sub['act'];
								$variety=$row_tbl_s[1];
				$gotrq=$gotrq+$row_tbl_sub['act'];
				$gotnrq=$gotnrq+$row_tbl_sub['act'];
				
				$stage=$row_tbl_s[0];
				
	
				
				
				
	
if($tot_armain12 > 0 && $cnt > 0)
{
$data1[$d]=array($d,$variety,$stage,$sqty,$gotrq,$gotnrq); 
$d++;
}
}
}
}
//},$per,$sstatus


# coading ends here............

echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datahead1) ;
echo "\n";

/*echo implode("\t", $datatitle1) ;
echo "\n";*/
echo implode("\t", $datatitle3) ;
echo "\n";

/*<!--echo implode("\t", $datatitle2) ;
echo "\n";
-->	*/
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;