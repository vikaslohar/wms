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
	
	function getFinancialYears($count = 15) {
		$years = [];
		$currentYear = date('Y');
		$currentMonth = date('n');
		if ($currentMonth < 4) {
			$currentYear--;
		}
	
		for ($i = 0; $i < $count; $i++) {
			$start = $currentYear - $i;
			$end = $start + 1;
			$years[] = "$start-$end";
		}
		return $years;
	}
	
	// Ordered months in FY (April to March)
	$months = [
		"April" => 4,
		"May" => 5,
		"June" => 6,
		"July" => 7,
		"August" => 8,
		"September" => 9,
		"October" => 10,
		"November" => 11,
		"December" => 12,
		"January" => 1,
		"February" => 2,
		"March" => 3,
	];
	
	$selectedYear = '';
	$selectedMonth = '';
	$startDate = '';
	$endDate = '';
	$monthList = [];
	
	$financial_year = $_REQUEST['financial_year'];
	$month = $_REQUEST['month'];
	$txtorganiser = $_REQUEST['txtorganiser'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
	$plantcode = $_REQUEST['txtplant'];

	$selectedYear = $_REQUEST['financial_year'] ?? '';
    $selectedMonth = $_REQUEST['month'] ?? '';

    if (!empty($selectedYear)) {
        [$startYear, $endYear] = explode('-', $selectedYear);

        if (!empty($selectedMonth) && isset($months[$selectedMonth])) {
            // Specific month selected
            $monthNum = $months[$selectedMonth];
            $year = ($monthNum >= 4) ? $startYear : $endYear;

            $startDate = date("Y-m-d", strtotime("$year-$monthNum-01"));
            $endDate = date("Y-m-t", strtotime($startDate));
        } else {
            // Month is ALL ? build array of all months in FY
            foreach ($months as $monthName => $monthNum) {
                $year = ($monthNum >= 4) ? $startYear : $endYear;
                $start = date("Y-m-01", strtotime("$year-$monthNum-01"));
                $end = date("Y-m-t", strtotime($start));
                $monthList[] = [
                    'month' => $monthName,
                    'start_date' => $start,
                    'end_date' => $end
                ];
            }
        }
    }
	
	$plantname='';
	if($plantcode=="D"){ $plantname="Deorjhal Plant";} else if($plantcode=="B"){$plantname="Boriya Plant";} else {$plantname="";}
	
	$dh="Financial_Year_wise_Monthly_Processing_Report_".$plantname;
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead1=array("Financial Year wise Monthly Processing Report-$plantname");
	$data1 = array();
	$data2 = array();

	function cleanData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str); 
		$str = preg_replace("/\n/", "\\n", $str);
	} 
	   
		# file name for download $filename = "Order Details.xls";
		
		$filename=$dh.".xls";  
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel"); 
 		$datatitle2 = array("Financial Year",htmlspecialchars($selectedYear),"Month",$selectedMonth);
		$datatitle3 = array("#","Crop Type","Crop","Variety","Type","Size");
		$datatitle4 = array("","","","","","");
	  	
if ($selectedMonth!="ALL" && $startDate && $endDate){
array_push($datatitle3,$selectedMonth,"","","");
}elseif ($selectedMonth=="ALL" && count($monthList)){ 
foreach ($monthList as $item){
$m=$item['month'];
array_push($datatitle3,$m,"","","");
}}

if ($selectedMonth!="ALL" && $startDate && $endDate){
array_push($datatitle4,"Raw Seed","Condition Seed","Remnant (RM)","Remnant (RM)%");
}elseif ($selectedMonth=="ALL" && count($monthList)){ 
foreach ($monthList as $item){
array_push($datatitle4,"Raw Seed","Condition Seed","Remnant (RM)","Remnant (RM)%");
}}
$d=1;
if($selectedMonth!="ALL" && $startDate && $endDate)
{

	$sql1="select distinct proslipmain_crop from tbl_proslipmain where proslipmain_date <= '$endDate' and proslipmain_date >= '$startDate' and plantcode='$plantcode'  ";
	if($txtcrop!="ALL")
	{
		$sql1.=" and proslipmain_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sql1.=" and proslipmain_variety='".$txtvariety."'";
	}
		$sql1.=" order by proslipmain_crop asc";
		//echo $sql;
	$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
	{
		
		$sql2="select distinct proslipmain_variety from tbl_proslipmain where proslipmain_date <= '$endDate' and proslipmain_date >= '$startDate' and plantcode='$plantcode' ";
		$sql2.=" and proslipmain_crop='".$row_tbl_sub1['proslipmain_crop']."'";
		if($txtvariety!="ALL")
		{
			$sql2.=" and proslipmain_variety='".$txtvariety."'";
		}
			$sql2.=" order by proslipmain_variety asc";
			//echo $sql;
		$sql_tbl_sub2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
		while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
		{
		
			$arrival_id='';
			$sql_srsub=mysqli_query($link,"select Distinct proslipmain_id from tbl_proslipmain where proslipmain_date <= '$endDate' and proslipmain_date >= '$startDate' and plantcode='$plantcode' and proslipmain_crop='".$row_tbl_sub1['proslipmain_crop']."' and proslipmain_variety='".$row_tbl_sub2['proslipmain_variety']."' ") or die(mysqli_error($link));
			$tot_arr_home=mysqli_num_rows($sql_srsub);
			while($row_srsub=mysqli_fetch_array($sql_srsub))
			{
				if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_srsub['proslipmain_id'];} else {$arrival_id=$row_srsub['proslipmain_id'];}
			}	
		
			$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropid='".$row_tbl_sub1['proslipmain_crop']."' order by cropname Asc") or die(mysqli_error($link));
			$row_crop2=mysqli_fetch_array($sq_crop2);
			$crpsize=$row_crop2['seedsize'];
			$croptype=$row_crop2['croptype'];
			$crop=$row_crop2['cropname'];
			
			$sq_var2=mysqli_query($link,"select vt, popularname from tblvariety where varietyid='".$row_tbl_sub2['proslipmain_variety']."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$variety=$row_var2['popularname'];	
			$vtype=$row_var2['vt'];	
			
			$rawqty=0; $conqty=0; $totalpl=0; $totalplper=0;
			if($arrival_id!='')
			{
				$sql="select SUM(proslipsub_oqty), SUM(proslipsub_conqty), SUM(proslipsub_tlqty), SUM(proslipsub_tlper) from tbl_proslipsub where proslipmain_id IN($arrival_id) ";
				//echo $sql;
				$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
				$subtbltot=mysqli_num_rows($sql_tbl_sub);
				while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
				{
					$rawqty=$rawqty+$row_tbl_sub[0];
					$conqty=$conqty+$row_tbl_sub[1];
					$totalpl=$rawqty+$row_tbl_sub[2];
					$x++;
				}
				$totalplper=round((($totalpl/$rawqty)*100),3);
			}
		//echo $rawqty." = ".$conqty." = ".$totalpl." = ".$totalplper."<br />";	


$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize,$rawqty,$conqty,$totalpl,$totalplper); 
$d++;
}
}
}

elseif ($selectedMonth=="ALL" && count($monthList)>0)
{
	$startDate2=$monthList[0]['start_date'];
	$endDate2=$monthList[11]['end_date'];
	$srno=1;$arrivalid=""; $x=0; $verty="";
	
	$sql1o="select distinct proslipmain_crop from tbl_proslipmain where proslipmain_date <= '$endDate2' and proslipmain_date >= '$startDate2' and plantcode='$plantcode'  ";
	if($txtcrop!="ALL")
	{
		$sql1o.=" and proslipmain_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sql1o.=" and proslipmain_variety='".$txtvariety."'";
	}
		$sql1o.=" order by proslipmain_crop asc";
		//echo $sql;
	$sql_tbl_sub1o=mysqli_query($link,$sql1o) or die(mysqli_error($link));
	$subtbltot1o=mysqli_num_rows($sql_tbl_sub1o);
	while($row_tbl_sub1o=mysqli_fetch_array($sql_tbl_sub1o))
	{
		
		$sql2o="select distinct proslipmain_variety from tbl_proslipmain where proslipmain_date <= '$endDate2' and proslipmain_date >= '$startDate2' and plantcode='$plantcode' ";
		$sql2o.=" and proslipmain_crop='".$row_tbl_sub1o['proslipmain_crop']."'";
		if($txtvariety!="ALL")
		{
			$sql2o.=" and proslipmain_variety='".$txtvariety."'";
		}
			$sql2o.=" order by proslipmain_variety asc";
			//echo $sql;
		$sql_tbl_sub2o=mysqli_query($link,$sql2o) or die(mysqli_error($link));
		$subtbltot2o=mysqli_num_rows($sql_tbl_sub2o);
		while($row_tbl_sub2o=mysqli_fetch_array($sql_tbl_sub2o))
		{
			if($verty!=""){$verty=$verty.",".$row_tbl_sub2o['proslipmain_variety'];} else {$verty=$row_tbl_sub2o['proslipmain_variety'];}
		}
	}

	$vert=explode(",",$verty);
	foreach ($vert as $vertyname){ 
			
	$sq_var2=mysqli_query($link,"select vt, cropname, popularname from tblvariety where varietyid='".$vertyname."' order by popularname Asc") or die(mysqli_error($link));
	$row_var2=mysqli_fetch_array($sq_var2);
	$variety=$row_var2['popularname'];	
	$vtype=$row_var2['vt'];	
	
	$sq_crop2=mysqli_query($link,"SELECT seedsize, cropname, croptype FROM tblcrop where cropid='".$row_var2['cropname']."' order by cropname Asc") or die(mysqli_error($link));
	$row_crop2=mysqli_fetch_array($sq_crop2);
	$crop=$row_crop2['cropname'];
	$crpsize=$row_crop2['seedsize'];
	$croptype=$row_crop2['croptype'];
	
	$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize); 
	
	$temp=array();
	foreach ($monthList as $item){
		
		$startDate=$item['start_date'];
		$endDate=$item['end_date'];
		
		$arrival_id='';
		$sql_srsub=mysqli_query($link,"select Distinct proslipmain_id from tbl_proslipmain where proslipmain_date <= '$endDate' and proslipmain_date >= '$startDate' and plantcode='$plantcode' and proslipmain_variety='".$vertyname."' ") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_srsub);
		while($row_srsub=mysqli_fetch_array($sql_srsub))
		{
			if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_srsub['proslipmain_id'];} else {$arrival_id=$row_srsub['proslipmain_id'];}
		}	
//echo $arrival_id;
		$sq_var2=mysqli_query($link,"select vt, popularname, cropname from tblvariety where varietyid='".$vertyname."' order by popularname Asc") or die(mysqli_error($link));
		$row_var2=mysqli_fetch_array($sq_var2);
		$variety=$row_var2['popularname'];	
		$vtype=$row_var2['vt'];	
		
		
		$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropid='".$row_var2['cropname']."' order by cropname Asc") or die(mysqli_error($link));
		$row_crop2=mysqli_fetch_array($sq_crop2);
		$crpsize=$row_crop2['seedsize'];
		$croptype=$row_crop2['croptype'];
		$crop=$row_crop2['cropname'];
		
		
		$rawqty=0; $conqty=0; $totalpl=0; $totalplper=0;
		if($arrival_id!='')
		{
			$sql="select SUM(proslipsub_pqty), SUM(proslipsub_conqty), SUM(proslipsub_tlqty), SUM(proslipsub_tlper) from tbl_proslipsub where proslipmain_id IN($arrival_id) ";
			//echo $sql;
			$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				$rawqty=$rawqty+$row_tbl_sub[0];
				$conqty=$conqty+$row_tbl_sub[1];
				$totalpl=$totalpl+$row_tbl_sub[2];
				$x++;
			}
			$totalplper=round((($totalpl/$rawqty)*100),3);
		}
	array_push($temp,$rawqty,$conqty,$totalpl,$totalplper);
	//$temp[]=$ac;		

	}
	
	$data2[$d]=$temp;
	$d++;
	}

	//array_push($data1[$d],$temp);
//print_r($data1);
//echo "<br />";
//print_r($data2);
//echo "<br />";
	}
		
//}
//}
//print_r($data1);
//exit;
echo implode("\t", $datahead1);
echo "\n";
echo implode("\t", $datatitle2);
echo "\n";
echo implode("\t", $datatitle3);
echo "\n";
echo implode("\t", $datatitle4);
echo "\n";
//foreach($data1 as $row1)
for($i=1; $i<$d; $i++)
{ 
	echo implode("\t", array_values($data1[$i] )); 
	echo "\t";
	echo implode("\t", array_values($data2[$i]));
	echo "\n";
}