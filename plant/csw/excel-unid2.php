<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
	 //$pid = $_GET['pid'];	
	
	echo  $edate = $_REQUEST['edate'];
		
 	
	
$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
		
$edate=date("Y-m-d");
	
	 $qry="select * from tbl_lot_ldg where lotldg_sstage='Condition' and lotldg_trtype='Unidentified' and lotldg_trdate<='$edate' and plantcode='$plantcode'";	
  
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	 	
	$dh="Unidentified_Condition_Seed_Report - As on Date: ".$edate;
	$datahead = array($dh);
	$datahead2 = array("Unidentified_Condition_Seed_Report - As on Date: ",$edate);
//$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$variet);
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
 
	 $datatitle2 = array("#","Date of Arrival","Crop","Lot No. ","NoB","Qty","QC Status","GOT Status");
$d=1;

			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['lotldg_trdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	 $arrival_id=$row_arr_home['lotldg_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id ='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
		 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";
$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$acn=$aq[0];}else{$acn=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$ac=$an[0];}else{$ac=$row_tbl_sub['lotldg_balqty'];}

		//$row_tbl_sub['lotldg_crop'];
$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotldg_crop']."'") or die(mysqli_error($link));
$row31=mysqli_fetch_array($sql_crop);
		
 $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['lotldg_crop']."' order by popularname Asc"); 

$rowvv=mysqli_fetch_array($quer4);

   $crop=$row31['cropname'];
	$variety=$crop."-Unidentified";
		/*if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotldg_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotldg_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotldg_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotldg_variety'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotldg_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotldg_lotno'];
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['lotldg_qc'];
		}
		else
		{
		$qc=$row_tbl_sub['lotldg_qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['lotldg_got1'];
		}
		else
		{
		$got=$row_tbl_sub['lotldg_got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['lotldg_sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['lotldg_got1'];
		}
		else
		{
		$per=$row_tbl_sub['lotldg_got1'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_tbl_sub['lotldg_sstatus'];
		}
		else
		{
		$loc1=$row_tbl_sub['lotldg_sstatus'];
		}

	
	
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."'"); 
	$rowvv=mysqli_fetch_array($quer3);
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$varietyy=$row_arr_home['variety'];
$cropp=$row_arr_home['crop'];*/
if($tot_arr_home > 0)			
{
if($variety==$row_tbl_sub['lotldg_variety'])
{	
$data1[$d]=array($d,$trdate,$crop,$lotno,$bags,$qty,$qc,$got); 
$d++;
}
}
}
}

//},$per,$sstatus


# coading ends here............
/*echo implode($datahead1) ;
echo "\n";*/

/**/echo implode($datahead2) ;
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
