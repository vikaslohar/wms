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
	
	$dh="Financial_Year_wise_Monthly_Packing_Report_".$plantname;
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead1=array("Financial Year wise Monthly Packing Report-$plantname");
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
		$datatitle3 = array("#","Crop Type","Crop","Variety","UPS","Type","Size");
		$datatitle4 = array("","","","","","","");
	  	
if ($selectedMonth!="ALL" && $startDate && $endDate){
array_push($datatitle3,$selectedMonth,"","","");
}elseif ($selectedMonth=="ALL" && count($monthList)){ 
foreach ($monthList as $item){
$m=$item['month'];
array_push($datatitle3,$m,"","","");
}}

if ($selectedMonth!="ALL" && $startDate && $endDate){
array_push($datatitle4,"Picked for Packing Qty","Pack Seed Qty","Packing Loss","Packing Loss %");
}elseif ($selectedMonth=="ALL" && count($monthList)){ 
foreach ($monthList as $item){
array_push($datatitle4,"Picked for Packing Qty","Pack Seed Qty","Packing Loss","Packing Loss %");
}}
$d=1;
if($selectedMonth!="ALL" && $startDate && $endDate)
{

	$sql1="select distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP')  ";
	if($txtcrop!="ALL")
	{
		$sql1.=" and lotldg_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sql1.=" and lotldg_variety='".$txtvariety."'";
	}
		$sql1.=" order by lotldg_crop asc";
		//echo $sql;
	$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
	{
		
		$sql2="select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') ";
		$sql2.=" and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."'";
		if($txtvariety!="ALL")
		{
			$sql2.=" and lotldg_variety='".$txtvariety."'";
		}
			$sql2.=" order by lotldg_variety asc";
			//echo $sql;
		$sql_tbl_sub2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
		while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
		{
			$sql3="select distinct packtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' order by packtype asc";
			$sql_tbl_sub3=mysqli_query($link,$sql3) or die(mysqli_error($link));
			$subtbltot3=mysqli_num_rows($sql_tbl_sub3);
			while($row_tbl_sub3=mysqli_fetch_array($sql_tbl_sub3))
			{
				$ups=$row_tbl_sub3['packtype'];
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropid='".$row_tbl_sub1['lotldg_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$crop=$row_crop2['cropname'];
				
				$sq_var2=mysqli_query($link,"select vt, popularname from tblvariety where varietyid='".$row_tbl_sub2['lotldg_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$variety=$row_var2['popularname'];	
				$vtype=$row_var2['vt'];	
				$arrival_id='';
				$sql_srsub=mysqli_query($link,"select Distinct lotldg_id from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' ") or die(mysqli_error($link));
				$tot_arr_home=mysqli_num_rows($sql_srsub);
				while($row_srsub=mysqli_fetch_array($sql_srsub))
				{
					if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_srsub['lotldg_id'];} else {$arrival_id=$row_srsub['lotldg_id'];}
				}	
			
				$rawqty=0; $conqty=0; $totalpl=0; $totalplper=0;
				if($arrival_id!='')
				{
					$sql="select Distinct trtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' and lotldg_id IN($arrival_id) ";
					//echo $sql;
					$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
					$subtbltot=mysqli_num_rows($sql_tbl_sub);
					while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
					{
						if($row_tbl_sub['trtype']=='PNPSLIP' || $row_tbl_sub['trtype']=='NSTPNPSLIP')
						{
							$sql_is=mysqli_query($link,"select pnpslipmain_id from tbl_pnpslipmain where  pnpslipmain_id IN($arrival_id) and pnpslipmain_crop='".$row_tbl_sub1['lotldg_crop']."' and pnpslipmain_variety='".$row_tbl_sub2['lotldg_variety']."' and pnpslipmain_tflag=1 order by pnpslipmain_id asc") or die(mysqli_error($link));
							while($row_is=mysqli_fetch_array($sql_is))
							{ 
								$sql_istbl=mysqli_query($link,"select sum(pnpslipsub_pickpqty), sum(pnpslipsub_packqty), sum(pnpslipsub_packloss), sum(pnpslipsub_packcc) from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."' and pnpslipsub_ups='".$row_tbl_sub3['packtype']."' order by pnpslipsub_id asc") or die(mysqli_error($link)); 
								$t=mysqli_num_rows($sql_istbl);
								while($row_pnpsub=mysqli_fetch_array($sql_istbl))
								{ 
									$rawqty=$rawqty+$row_pnpsub[0]; 
									$totalpl=$totalpl+($row_pnpsub[2]+$row_pnpsub[3]); 
									$conqty=$conqty+$row_pnpsub[1]; 
								}	
							}
						}
						if($row_tbl_sub['trtype']=='PACKAGINGSLIP')
						{
							$sql_is=mysqli_query($link,"select packaging_id from tbl_rpspackaging where packaging_id IN($arrival_id) and packaging_crop='".$row_tbl_sub1['lotldg_crop']."' and packaging_variety='".$row_tbl_sub2['lotldg_variety']."' and packaging_upssize='".$row_tbl_sub3['packtype']."' and packaging_tflg=1 order by packaging_id asc") or die(mysqli_error($link));
							while($row_is=mysqli_fetch_array($sql_is))
							{ 
								$sql_istbl=mysqli_query($link,"select sum(packagingsub_extqty), sum(packagingsub_ccqty), sum(packagingsub_ccqty) from tbl_rpspackaging_sub where packaging_id='".$row_is['packaging_id']."' order by packagingsub_id asc") or die(mysqli_error($link)); 
								$t=mysqli_num_rows($sql_istbl);
								while($row_pnpsub=mysqli_fetch_array($sql_istbl))
								{ 
									$rawqty=$rawqty+$row_pnpsub[0]; 
									$totalpl=$totalpl+($row_pnpsub[1]+$row_pnpsub[2]); 
									$conqty=$conqty+($row_pnpsub[0]-($row_pnpsub[1]+$row_pnpsub[2])); 
								}	
							}
						}
						$x++;
					}
					$tot=$totalpl/$rawqty;
					if($tot>0)
					{
						$totalplper=round(($tot*100),3);
					}
				}
			//echo $rawqty." = ".$conqty." = ".$totalpl." = ".$totalplper."<br />";	


$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize,$rawqty,$conqty,$totalpl,$totalplper); 
$d++;
}
}
}
}
elseif ($selectedMonth=="ALL" && count($monthList)>0)
{
	$startDate2=$monthList[0]['start_date'];
	$endDate2=$monthList[11]['end_date'];
	$srno=1;$arrivalid=""; $x=0; $verty="";
	$sql1="select distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate2' and lotldg_trdate >= '$startDate2' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP')  ";
	if($txtcrop!="ALL")
	{
		$sql1.=" and lotldg_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sql1.=" and lotldg_variety='".$txtvariety."'";
	}
		$sql1.=" order by lotldg_crop asc";
		//echo $sql;
	$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
	{
		
		$sql2="select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate2' and lotldg_trdate >= '$startDate2' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') ";
		$sql2.=" and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."'";
		if($txtvariety!="ALL")
		{
			$sql2.=" and lotldg_variety='".$txtvariety."'";
		}
			$sql2.=" order by lotldg_variety asc";
			//echo $sql;
		$sql_tbl_sub2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
		while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
		{
			$sql3="select distinct packtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate2' and lotldg_trdate >= '$startDate2' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' order by packtype asc";
			$sql_tbl_sub3=mysqli_query($link,$sql3) or die(mysqli_error($link));
			$subtbltot3=mysqli_num_rows($sql_tbl_sub3);
			while($row_tbl_sub3=mysqli_fetch_array($sql_tbl_sub3))
			{
				$ups=$row_tbl_sub3['packtype'];
			
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropid='".$row_tbl_sub1['lotldg_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$crop=$row_crop2['cropname'];
				
				$sq_var2=mysqli_query($link,"select vt, popularname from tblvariety where varietyid='".$row_tbl_sub2['lotldg_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$variety=$row_var2['popularname'];	
				$vtype=$row_var2['vt'];	
	
	$data1[$d]=array($d,$croptype,$crop,$variety,$ups,$vtype,$crpsize); 
	
	$temp=array();
	foreach ($monthList as $item){
		
		$startDate=$item['start_date'];
		$endDate=$item['end_date'];
		
		$arrival_id='';
		$sql_srsub=mysqli_query($link,"select Distinct lotldg_id from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' ") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_srsub);
		while($row_srsub=mysqli_fetch_array($sql_srsub))
		{
			if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_srsub['lotldg_id'];} else {$arrival_id=$row_srsub['lotldg_id'];}
		}	
	
		$rawqty=0; $conqty=0; $totalpl=0; $totalplper=0;
		if($arrival_id!='')
		{
			$sql="select Distinct trtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' and lotldg_id IN($arrival_id) ";
			//echo $sql;
			$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($row_tbl_sub['trtype']=='PNPSLIP' || $row_tbl_sub['trtype']=='NSTPNPSLIP')
				{
					$sql_is=mysqli_query($link,"select pnpslipmain_id from tbl_pnpslipmain where  pnpslipmain_id IN($arrival_id) and pnpslipmain_crop='".$row_tbl_sub1['lotldg_crop']."' and pnpslipmain_variety='".$row_tbl_sub2['lotldg_variety']."' and pnpslipmain_tflag=1 order by pnpslipmain_id asc") or die(mysqli_error($link));
					while($row_is=mysqli_fetch_array($sql_is))
					{ 
						$sql_istbl=mysqli_query($link,"select sum(pnpslipsub_pickpqty), sum(pnpslipsub_packqty), sum(pnpslipsub_packloss), sum(pnpslipsub_packcc) from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."' and pnpslipsub_ups='".$row_tbl_sub3['packtype']."' order by pnpslipsub_id asc") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						while($row_pnpsub=mysqli_fetch_array($sql_istbl))
						{ 
							$rawqty=$rawqty+$row_pnpsub[0]; 
							$totalpl=$totalpl+($row_pnpsub[2]+$row_pnpsub[3]); 
							$conqty=$conqty+$row_pnpsub[1]; 
						}	
					}
				}
				if($row_tbl_sub['trtype']=='PACKAGINGSLIP')
				{
					$sql_is=mysqli_query($link,"select packaging_id from tbl_rpspackaging where packaging_id IN($arrival_id) and packaging_crop='".$row_tbl_sub1['lotldg_crop']."' and packaging_variety='".$row_tbl_sub2['lotldg_variety']."' and packaging_upssize='".$row_tbl_sub3['packtype']."' and packaging_tflg=1 order by packaging_id asc") or die(mysqli_error($link));
					while($row_is=mysqli_fetch_array($sql_is))
					{ 
						$sql_istbl=mysqli_query($link,"select sum(packagingsub_extqty), sum(packagingsub_ccqty), sum(packagingsub_ccqty) from tbl_rpspackaging_sub where packaging_id='".$row_is['packaging_id']."' order by packagingsub_id asc") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						while($row_pnpsub=mysqli_fetch_array($sql_istbl))
						{ 
							$rawqty=$rawqty+$row_pnpsub[0]; 
							$totalpl=$totalpl+($row_pnpsub[1]+$row_pnpsub[2]); 
							$conqty=$conqty+($row_pnpsub[0]-($row_pnpsub[1]+$row_pnpsub[2])); 
						}	
					}
				}
				$x++;
			}
			$tot=$totalpl/$rawqty;
			if($tot>0)
			{
				$totalplper=round(($tot*100),3);
			}
		}
	//echo $rawqty." = ".$conqty." = ".$totalpl." = ".$totalplper."<br />";	
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
		
}
}
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