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
	
	$dh="Financial_Year_wise_Monthly_Sales_Return_Report_".$plantname;
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead1=array("Financial Year wise Monthly Sales Return Report-$plantname");
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
 	 $datatitle2 = array("Financial Year",htmlspecialchars($selectedYear),"Month",$selectedMonth);
	 $datatitle3 = array("#","Crop Type","Crop","Variety","Type","Size");
	  	
if ($selectedMonth!="ALL" && $startDate && $endDate){
array_push($datatitle3,$selectedMonth);
}elseif ($selectedMonth=="ALL" && count($monthList)){ 
foreach ($monthList as $item){
$m=$item['month'];
array_push($datatitle3,$m);
}}

$d=1;
if($selectedMonth!="ALL" && $startDate && $endDate)
{

	$sql_arr_home=mysqli_query($link,"select arrival_id from tblarrival where (arrival_type='Fresh Seed with PDN') and  arrival_date <= '$endDate' and arrival_date >= '$startDate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	$srno=1;$arrival_id=''; $x=0;
	if($tot_arr_home > 0)
	{
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{
			if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_arr_home['arrival_id'];} else {$arrival_id=$row_arr_home['arrival_id'];}
		}
	}
	$sql1="select distinct lotcrop from tblarrival_sub where arrival_id IN($arrival_id) ";
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql1.=" and lotcrop='".$row_crop['cropname']."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql1.=" and lotvariety='".$row_var['popularname']."'";
	}
		$sql1.=" order by lotcrop asc";
		//echo $sql;
	$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
	{
		$sql2="select distinct lotvariety from tblarrival_sub where arrival_id IN($arrival_id) ";
		$sql2.=" and lotcrop='".$row_tbl_sub1['lotcrop']."'";
		if($txtvariety!="ALL")
		{
			$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sq_var);
			$sql2.=" and lotvariety='".$row_var['popularname']."'";
		}
			$sql2.=" order by lotvariety asc";
			//echo $sql;
		$sql_tbl_sub2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
		while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
		{
			$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype FROM tblcrop where cropname='".$row_tbl_sub1['lotcrop']."' order by cropname Asc") or die(mysqli_error($link));
			$row_crop2=mysqli_fetch_array($sq_crop2);
			$crpsize=$row_crop2['seedsize'];
			$croptype=$row_crop2['croptype'];
			$sq_var2=mysqli_query($link,"select vt from tblvariety where popularname='".$row_tbl_sub2['lotvariety']."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$crop=$row_tbl_sub1['lotcrop'];
			$variety=$row_tbl_sub2['lotvariety'];	
			$vtype=$row_var2['vt'];	
			
			$sql="select SUM(act) from tblarrival_sub where arrival_id IN($arrival_id)  and lotcrop='".$row_tbl_sub1['lotcrop']."' and lotvariety='".$row_tbl_sub2['lotvariety']."' order by lotcrop, lotvariety asc";
				//echo $sql;
			$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				$aq=explode(".",$row_tbl_sub[0]);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub[0];}
				$x++;
			}
				
	


$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize,$ac); 
$d++;
}
}
}

elseif ($selectedMonth=="ALL" && count($monthList)>0)
{
	$startDate2=$monthList[0]['start_date'];
	$endDate2=$monthList[11]['end_date'];
	$sqlarrhome=mysqli_query($link,"select arrival_id from tblarrival where (arrival_type='Fresh Seed with PDN') and  arrival_date <= '$endDate2' and arrival_date >= '$startDate2' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
	$totarrhome=mysqli_num_rows($sqlarrhome);
	
	$srno=1;$arrivalid=""; $x=0; $verty="";
	if($totarrhome > 0)
	{
		while($rowarrhome=mysqli_fetch_array($sqlarrhome))
		{
			if($arrivalid!=""){$arrivalid=$arrivalid.",".$rowarrhome['arrival_id'];} else {$arrivalid=$rowarrhome['arrival_id'];}
		}
	}
	$sql1o="select distinct lotcrop from tblarrival_sub where arrival_id IN($arrivalid) ";
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql1o.=" and lotcrop='".$row_crop['cropname']."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql1o.=" and lotvariety='".$row_var['popularname']."'";
	}
		$sql1o.=" order by lotcrop asc";
		//echo $sql;
	$sql_tbl_sub1o=mysqli_query($link,$sql1o) or die(mysqli_error($link));
	$subtbltot1o=mysqli_num_rows($sql_tbl_sub1o);
	while($row_tbl_sub1o=mysqli_fetch_array($sql_tbl_sub1o))
	{
		$sql2o="select distinct lotvariety from tblarrival_sub where arrival_id IN($arrivalid) ";
		$sql2o.=" and lotcrop='".$row_tbl_sub1o['lotcrop']."'";
		if($txtvariety!="ALL")
		{
			$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sq_var);
			$sql2o.=" and lotvariety='".$row_var['popularname']."'";
		}
			$sql2o.=" order by lotvariety asc";
			//echo $sql;
		$sql_tbl_sub2o=mysqli_query($link,$sql2o) or die(mysqli_error($link));
		$subtbltot2o=mysqli_num_rows($sql_tbl_sub2o);
		while($row_tbl_sub2o=mysqli_fetch_array($sql_tbl_sub2o))
		{
			if($verty!=""){$verty=$verty.",".$row_tbl_sub2o['lotvariety'];} else {$verty=$row_tbl_sub2o['lotvariety'];}
		}
	}

	$vert=explode(",",$verty);
	 $data2=array();
	foreach ($vert as $vertyname){ 
	 $temp=array();		
	$sq_var2=mysqli_query($link,"select vt, cropname from tblvariety where popularname='".$vertyname."' order by popularname Asc") or die(mysqli_error($link));
	$row_var2=mysqli_fetch_array($sq_var2);
	$variety=$vertyname;	
	$vtype=$row_var2['vt'];	
	
	$sq_crop2=mysqli_query($link,"SELECT seedsize, cropname, croptype FROM tblcrop where cropid='".$row_var2['cropname']."' order by cropname Asc") or die(mysqli_error($link));
	$row_crop2=mysqli_fetch_array($sq_crop2);
	$crop=$row_crop2['cropname'];
	$crpsize=$row_crop2['seedsize'];
	$croptype=$row_crop2['croptype'];
	
	$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize); 
	
	
	foreach ($monthList as $item){
		
		$startDate=$item['start_date'];
		$endDate=$item['end_date'];
		
		$sql_arr_home=mysqli_query($link,"select arrival_id from tblarrival where (arrival_type='Fresh Seed with PDN') and  arrival_date <= '$endDate' and arrival_date >= '$startDate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
		
		$arrival_id=''; $ac='';
		if($tot_arr_home > 0)
		{
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{
				if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_arr_home['arrival_id'];} else {$arrival_id=$row_arr_home['arrival_id'];}
			}
		}
		$x++;	
		if($arrival_id!="")
		{
			$sql1="select distinct lotcrop from tblarrival_sub where arrival_id IN($arrival_id) ";
			if($txtcrop!="ALL")
			{
				$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
				$row_crop=mysqli_fetch_array($sq_crop);
				$sql1.=" and lotcrop='".$row_crop['cropname']."'";
			}
				$sql1.=" and lotvariety='$vertyname' order by lotcrop asc";
				//echo $sql;
			$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
			$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
			$row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1);
				
			$sq_var2=mysqli_query($link,"select vt from tblvariety where popularname='".$vertyname."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$crop=$row_tbl_sub1['lotcrop'];
			$variety=$vertyname;	
			$vtype=$row_var2['vt'];	
				
			$sql="select SUM(act) from tblarrival_sub where arrival_id IN($arrival_id)  and lotcrop='".$row_tbl_sub1['lotcrop']."' and lotvariety='".$vertyname."' order by lotcrop, lotvariety asc";
			//echo $sql;
			$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			$ac = 0;  // default
			while($row_tbl_sub = mysqli_fetch_array($sql_tbl_sub))
			{
				$aq = explode(".", $row_tbl_sub[0]);
				if ($aq[0] !== null) {
					if (isset($aq[1]) && $aq[1] == 000) {
						$ac = $aq[0];
					} else {
						$ac = $row_tbl_sub[0];
					}
				}
			}
		}
		$temp[] = $ac;

	}//print_r($temp);
	//array_push($data1[$d],$temp);
	$data2[$d]=$temp;
//print_r($data2);
	$d++;

	}
		
}
//}
//print_r($data2);
//exit;
echo implode("\t", $datahead1);
echo "\n";
echo implode("\t", $datatitle2);
echo "\n";
echo implode("\t", $datatitle3);
echo "\n";
//foreach($data1 as $row1)
for($i=1; $i<$d; $i++)
{ 
	echo implode("\t", array_values($data1[$i] )); 
	echo "\t";
	echo implode("\t", array_values($data2[$i]));
	echo "\n";
}