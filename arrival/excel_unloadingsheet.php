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
	
	$pid=$_GET['pid'];	
	global	$data1;	
	$dh="Unloading_Sheet";
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report",$typ);
	$datahead2 = array("Unloading_Sheet");
	$data1 = array(array());
	
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
	$datatitle1 = array("Unloading Sheet");
	$datatitle2 = array("Date: ".$dt);
	$datatitle3 = array("Vehicle No.: ".$vehno);
	//$datatitle4 = array("Vehicle No.: ".$vehno);
	$datatitle5 = array("#","Lot No.","Bags","B1"," B2","B3","B4","B5","B6","B7","B8","B9","B10","Total Wt.", "Tare Wt.", "Net Wt.");
	$cnt=1;
 	
	$dt=date("d-m-Y");
	$sql_arr_home=mysqli_query($link,"select * from tblarrival_unld where arrival_id='$pid' and plantcode='$plantcode'") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
    $row_ar_hom=mysqli_fetch_array($sql_arr_home);
	$vehno=$row_ar_hom['trans_vehno'];
	$state=$row_ar_hom['trans_vehno'];
	

	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub_unld where arrival_id='".$pid."' and plantcode='$plantcode' order by arrsub_id ASC") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
		$lotno=$row_tbl_sub['lotno']; $bags=0; $grqty=0; $trqty=0; $ntqty=0; 
		$sql_whouse=mysqli_query($link,"select * from tblarrsub_sub_unld where arrsub_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
		$tot_whouse=mysqli_num_rows($sql_whouse);
		while($row_whouse=mysqli_fetch_array($sql_whouse))
		{
			$grqty=$grqty+$row_whouse['grosswt'];
			$trqty=$trqty+$row_whouse['tarewt'];
			$ntqty=$ntqty+$row_whouse['netwt'];
		}
		if($grqty>0)
		$bags=$tot_whouse;
		
		$norows=ceil($tot_whouse/10); $rcnt=1; $tcnt=1; $d=1;
		$data1[$cnt][$d]=array($d,$lotno,$bags);
		
		$sqlwhouse=mysqli_query($link,"select * from tblarrsub_sub_unld where arrsub_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsubsub_id ASC ") or die(mysqli_error($link));
		$totwhouse=mysqli_num_rows($sqlwhouse);
		while($rowwhouse=mysqli_fetch_array($sqlwhouse))
		{ $b=$rowwhouse['grosswt'];
			if($tcnt<=10)
			{
				$data1[$cnt][$d]=$b;
				$tcnt++; $d++;
			}
			else
			{
				if($rcnt==1)
				{
					$data1[$cnt][$d]=$grqty;$d++;
					$data1[$cnt][$d]=$trqty;$d++;
					$data1[$cnt][$d]=$ntqty;$d++;
					$rcnt++;
				}
				$tcnt=1;$cnt++;
				$d=1;
			} 	
			
		}
	$cnt++;	
	}	
//print_r($data1);
//exit;
# coading ends here............
/*echo implode($datahead1) ;
echo "\n";*/

echo implode("\t", $datatitle1) ;
echo "\n";
echo implode("\t", $datatitle2) ;
echo "\n";
echo implode("\t", $datatitle3) ;
echo "\n";
/*echo implode("\t", $datatitle4) ;
echo "\n";*/
echo implode("\t", $datatitle5) ;
echo "\n";

for($i=1; $i<$cnt; $i++)
{
 foreach($data1[$i] as $row1)
 { 
	if($data1[$i]<>"")
	echo implode("\t", array_values($data1[$i]))."\n"; 
 }
} 
	
/*foreach($data1 as $row1)
{ 
	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}
*/
#echo implode("\t", $datatitle3) ;