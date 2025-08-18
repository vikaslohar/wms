<?php
session_start(); 
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	 $cid = $_REQUEST['txtclss'];
	
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
		
		
		
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='$cid'") or die(mysqli_error($link));
	$row_crop=mysqli_fetch_array($sql_crop);
	$cropname=$row_crop['cropname'];
 
	 $sql = "select * from tblspcodes where altdate <= '$edate' and altdate >= '$sdate' and crop='$cid' ";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));	  
	
 	  
	

	$dh="Crop_Wise_Report_$cropname_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	$datahead1 = array("Crop Wise Report");
	$datahead2 = array("Crop: ",$cropname,"  Date From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
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

	 $datatitle1 = array("Date","SP Code Female","SP Code Male","Crop","Variety");
$d=0;
$t=mysqli_num_rows($rs);
while($row=mysqli_fetch_array($rs))
{ 
                $sql_class1=mysqli_query($link,"select * from tblcrop where cropid='".$row['crop']."'") or die(mysqli_error($link));
				$row_class1=mysqli_fetch_array($sql_class1);
						
	            $row0=mysqli_query($link,"select * from tblvariety where varietyid='".$row['variety']."' and vertype='PV'") or die(mysqli_error($link));
				$row0=mysqli_fetch_array($row0);
	
	           $spcodef = $row['spcodef'];
				$spcodem = $row['spcodem'];
				$crop=$row_class1['cropname'];
				$variety=$row0['popularname'];
				$stlg_trdate=$row['altdate'];
	
			
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
$tot_spdec==0;
	$sql_spdec=mysqli_query($link,"select * from tblspdec where spdecid = '".$row['spdecid']."' and spdectflg='1' ") or die(mysqli_error($link));
	$tot_spdec=mysqli_num_rows($sql_spdec);
	//$row_spdec=mysqli_fetch_array($sql_spdec);	
if($tot_spdec > 0)
{
$data1[$d]=array($tdate,$spcodef , $spcodem,$crop,$variety); 
$d++;
}
}
//}
//}
//}


# coading ends here............
echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datatitle1) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;