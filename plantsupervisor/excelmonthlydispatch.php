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
	
	$dh="Financial_Year_wise_Monthly_Dispatch_Report_".$plantname;
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead1=array("Financial Year wise Monthly Dispatch Report-$plantname");
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

	$srno=1; $dbulk_id=''; $x=0; $disp_id=''; $varietylist='';
	$sql_bulkm=mysqli_query($link,"select dbulk_id from tbl_dbulk where dbulk_date<='$endDate' and dbulk_date>='$startDate' and dbulk_tflg=1 and plantcode='$plantcode' order by dbulk_date asc ") or die(mysqli_error($link));
	$tot_bulkm=mysqli_num_rows($sql_bulkm);
	if($tot_bulkm > 0)
	{
		while($row_bulkm=mysqli_fetch_array($sql_bulkm))
		{
			if($dbulk_id!=""){$dbulk_id=$dbulk_id.",".$row_bulkm['dbulk_id'];} else {$dbulk_id=$row_bulkm['dbulk_id'];}
		}
	}
	
	$sql_dispm=mysqli_query($link,"select disp_id from tbl_disp where disp_dodc<='$endDate' and disp_dodc>='$startDate' and disp_tflg=1 and plantcode='$plantcode' order by disp_dodc asc ") or die(mysqli_error($link));
	$tot_dispm=mysqli_num_rows($sql_dispm);
	if($tot_dispm > 0)
	{
		while($row_dispm=mysqli_fetch_array($sql_dispm))
		{
			if($disp_id!=""){$disp_id=$disp_id.",".$row_dispm['disp_id'];} else {$disp_id=$row_dispm['disp_id'];}
		}
	}
	
	
	$sql1="select distinct dbulks_crop from tbl_dbulk_sub where dbulk_id IN($dbulk_id) ";
	$sql2="select distinct dpss_crop from tbl_dispsub_sub where disp_id IN($disp_id) ";
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql1.=" and dbulks_crop='".$row_crop['cropname']."'";
		$sql2.=" and dpss_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql1.=" and dbulks_variety='".$row_var['popularname']."'";
		$sql2.=" and dpss_variety='".$txtvariety."'";
	}
	$sql1.=" order by dbulks_crop asc";
	$sql2.=" order by dpss_crop asc";
		//echo $disp_id;
	if($dbulk_id!="")	
	{

		$sql_dbulks=mysqli_query($link,$sql1) or die(mysqli_error($link));
		$subtbldbulks=mysqli_num_rows($sql_dbulks);
		while($row_dbulks=mysqli_fetch_array($sql_dbulks))
		{
			$sql21="select distinct dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id) and dbulks_crop='".$row_dbulks['dbulks_crop']."'";
			if($txtvariety!="ALL")
			{
				$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
				$row_var=mysqli_fetch_array($sq_var);
				$sql21.=" and dbulks_variety='".$row_var['popularname']."'";
			}
			$sql21.=" order by dbulks_variety asc";
				//echo $sql;
			$sql_dbulks2=mysqli_query($link,$sql2) or die(mysqli_error($link));
			$subtbldbulks2=mysqli_num_rows($sql_dbulks21);
			while($row_dbulks2=mysqli_fetch_array($sql_dbulks2))
			{
				$sq_var2=mysqli_query($link,"select varietyid from tblvariety where popularname='".$row_dbulks2['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				if($varietylist!="") {$varietylist=$varietylist.",".$row_var2['varietyid'];} else {$varietylist=$row_var2['varietyid'];}
			}
		}		
	}
	if($disp_id!="")	
	{
		$sql_disps=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbldisps=mysqli_num_rows($sql_disps);
		while($row_disps=mysqli_fetch_array($sql_disps))
		{
			$sql22="select distinct dpss_variety from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_crop='".$row_disps['dpss_crop']."'";
			if($txtvariety!="ALL")
			{
				$sql22.=" and dpss_variety='".$txtvariety."'";
			}
			$sql22.=" order by dpss_variety asc";
				//echo $sql22;
			$sql_disps2=mysqli_query($link,$sql22) or die(mysqli_error($link));
			$subtbldisps2=mysqli_num_rows($sql_disps2);
			while($row_disps2=mysqli_fetch_array($sql_disps2))
			{
				if($varietylist!="") {$varietylist=$varietylist.",".$row_disps2['dpss_variety'];} else {$varietylist=$row_disps2['dpss_variety'];}
			}
		}	
	}
//echo $varietylist;
	if($varietylist!="")
	{
		$vartylist=explode(",",$varietylist);
		array_unique($vartylist);
		foreach($vartylist as $verlist)
		{
			$qty=0;
			if($dbulk_id!='')
		{
			$dbulksid='';
			$sql213="select dbulks_id, dbulks_crop, dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id)  ";
			
			$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sq_var);
			$sql213.=" and dbulks_variety='".$row_var['popularname']."'";
			
			$sql213.=" order by dbulks_variety asc";
				
			$sql_dbulks23=mysqli_query($link,$sql213) or die(mysqli_error($link));
			$subtbldbulks23=mysqli_num_rows($sql_dbulks23);
			while($row_dbulks23=mysqli_fetch_array($sql_dbulks23))
			{
				if($dbulksid!=""){$dbulksid=$dbulksid.",".$row_dbulks23['dbulks_id'];}else{$dbulksid=$row_dbulks23['dbulks_id'];}
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype FROM tblcrop where cropname='".$row_dbulks23['dbulks_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$sq_var2=mysqli_query($link,"select vt from tblvariety where popularname='".$row_dbulks23['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$crop=$row_tbl_sub1['lotcrop'];
				$variety=$row_tbl_sub2['lotvariety'];	
				$vtype=$row_var2['vt'];

			}

			$dblksid=explode(",",$dbulksid);
			array_unique($dblksid);
			$dblksid2=implode(",",$dblksid);
			if($dblksid2!=""){
				$sql="select SUM(dbss_qty) from tbl_dbulksub_sub where dbulks_id IN ($dblksid2) order by dbss_id asc";
				//f($row_dbulks23['dbulks_variety']=="Kajal") {echo $sql; echo "<br />";}
	
				$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
				$subtbltot=mysqli_num_rows($sql_tbl_sub);
				while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
				{
					$ac=0;
					$aq=explode(".",$row_tbl_sub[0]);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub[0];}
					$qty=$qty+$ac;
					//if($row_dbulks23['dbulks_variety']=="Kajal") {echo $dbulk_id." = ".$qty;echo "<br />";}
					$x++;
				}
			}
		}			
			//echo "select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc";
			$sq_var2=mysqli_query($link,"select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$variety=$row_var2['popularname'];	
			$vtype=$row_var2['vt'];	

			$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropname='".$row_var2['cropid']."' ") or die(mysqli_error($link));
			$row_crop2=mysqli_fetch_array($sq_crop2);
			$crpsize=$row_crop2['seedsize'];
			$croptype=$row_crop2['croptype'];
			$crop=$row_crop2['cropname'];

			if($disp_id!="")
			{
				$sqls="select SUM(dpss_qty) from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_variety='".$verlist."' order by dpss_crop, dpss_variety asc";
					//echo $sql;
				$sql_tbl_subs=mysqli_query($link,$sqls) or die(mysqli_error($link));
				$subtbltots=mysqli_num_rows($sql_tbl_subs);
				while($row_tbl_subs=mysqli_fetch_array($sql_tbl_subs))
				{
					$aq=explode(".",$row_tbl_subs[0]);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_subs[0];}
					$qty=$qty+$ac;
					$x++;
				}
			}
				
	


$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize,$qty); 
$d++;
}
}
}

elseif ($selectedMonth=="ALL" && count($monthList)>0)
{
	$startDate2=$monthList[0]['start_date'];
	$endDate2=$monthList[11]['end_date'];
	$srno=1; $dbulk_id=''; $x=0; $disp_id=''; $varietylist='';
	$sql_bulkm=mysqli_query($link,"select dbulk_id from tbl_dbulk where dbulk_date<='$endDate2' and dbulk_date>='$startDate2' and dbulk_tflg=1 and plantcode='$plantcode' order by dbulk_date asc ") or die(mysqli_error($link));
	$tot_bulkm=mysqli_num_rows($sql_bulkm);
	if($tot_bulkm > 0)
	{
		while($row_bulkm=mysqli_fetch_array($sql_bulkm))
		{
			if($dbulk_id!=""){$dbulk_id=$dbulk_id.",".$row_bulkm['dbulk_id'];} else {$dbulk_id=$row_bulkm['dbulk_id'];}
		}
	}
	
	$sql_dispm=mysqli_query($link,"select disp_id from tbl_disp where disp_dodc<='$endDate2' and disp_dodc>='$startDate2' and disp_tflg=1 and plantcode='$plantcode' order by disp_dodc asc ") or die(mysqli_error($link));
	$tot_dispm=mysqli_num_rows($sql_dispm);
	if($tot_dispm > 0)
	{
		while($row_dispm=mysqli_fetch_array($sql_dispm))
		{
			if($disp_id!=""){$disp_id=$disp_id.",".$row_dispm['disp_id'];} else {$disp_id=$row_dispm['disp_id'];}
		}
	}
	
	
	$sql1="select distinct dbulks_crop from tbl_dbulk_sub where dbulk_id IN($dbulk_id) ";
	$sql2="select distinct dpss_crop from tbl_dispsub_sub where disp_id IN($disp_id) ";
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql1.=" and dbulks_crop='".$row_crop['cropname']."'";
		$sql2.=" and dpss_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql1.=" and dbulks_variety='".$row_var['popularname']."'";
		$sql2.=" and dpss_variety='".$txtvariety."'";
	}
	$sql1.=" order by dbulks_crop asc";
	$sql2.=" order by dpss_crop asc";
		//echo $disp_id;
	if($dbulk_id!="")	
	{
		$sql_dbulks=mysqli_query($link,$sql1) or die(mysqli_error($link));
		$subtbldbulks=mysqli_num_rows($sql_dbulks);
		while($row_dbulks=mysqli_fetch_array($sql_dbulks))
		{
			$sql21="select distinct dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id) and dbulks_crop='".$row_dbulks['dbulks_crop']."'";
			if($txtvariety!="ALL")
			{
				$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
				$row_var=mysqli_fetch_array($sq_var);
				$sql21.=" and dbulks_variety='".$row_var['popularname']."'";
			}
			$sql21.=" order by dbulks_variety asc";
				//echo $sql;
			$sql_dbulks2=mysqli_query($link,$sql2) or die(mysqli_error($link));
			$subtbldbulks2=mysqli_num_rows($sql_dbulks21);
			while($row_dbulks2=mysqli_fetch_array($sql_dbulks2))
			{
				$sq_var2=mysqli_query($link,"select varietyid from tblvariety where popularname='".$row_dbulks2['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				if($varietylist!="") {$varietylist=$varietylist.",".$row_var2['varietyid'];} else {$varietylist=$row_var2['varietyid'];}
			}
		}		
	}
	if($disp_id!="")	
	{
		$sql_disps=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbldisps=mysqli_num_rows($sql_disps);
		while($row_disps=mysqli_fetch_array($sql_disps))
		{
			$sql22="select distinct dpss_variety from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_crop='".$row_disps['dpss_crop']."'";
			if($txtvariety!="ALL")
			{
				$sql22.=" and dpss_variety='".$txtvariety."'";
			}
			$sql22.=" order by dpss_variety asc";
				//echo $sql22;
			$sql_disps2=mysqli_query($link,$sql22) or die(mysqli_error($link));
			$subtbldisps2=mysqli_num_rows($sql_disps2);
			while($row_disps2=mysqli_fetch_array($sql_disps2))
			{
				if($varietylist!="") {$varietylist=$varietylist.",".$row_disps2['dpss_variety'];} else {$varietylist=$row_disps2['dpss_variety'];}
			}
		}	
	}
//echo $varietylist;
	if($varietylist!="")
	{
		$vartylist=explode(",",$varietylist);
		array_unique($vartylist);
		foreach($vartylist as $verlist)
		{
			//echo "select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc";
			$sq_var2=mysqli_query($link,"select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$variety=$row_var2['popularname'];	
			$vtype=$row_var2['vt'];	

			$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropname='".$row_var2['cropid']."' ") or die(mysqli_error($link));
			$row_crop2=mysqli_fetch_array($sq_crop2);
			$crpsize=$row_crop2['seedsize'];
			$croptype=$row_crop2['croptype'];
			$crop=$row_crop2['cropname'];
	
	$data1[$d]=array($d,$croptype,$crop,$variety,$vtype,$crpsize); 
	
	
	foreach ($monthList as $item){
		
		$startDate=$item['start_date'];
		$endDate=$item['end_date'];
		
		$dbulk_id=''; $x=0; $disp_id=''; $varietylist='';

		$sql_bulkm=mysqli_query($link,"select dbulk_id from tbl_dbulk where dbulk_date<='$endDate' and dbulk_date>='$startDate' and dbulk_tflg=1 and plantcode='$plantcode' order by dbulk_date asc ") or die(mysqli_error($link));
		$tot_bulkm=mysqli_num_rows($sql_bulkm);

		if($tot_bulkm > 0)
		{
			while($row_bulkm=mysqli_fetch_array($sql_bulkm))
			{
				if($dbulk_id!=""){$dbulk_id=$dbulk_id.",".$row_bulkm['dbulk_id'];} else {$dbulk_id=$row_bulkm['dbulk_id'];}
				//echo $dbulk_id;
			}
		}
		
		$sql_dispm=mysqli_query($link,"select disp_id from tbl_disp where disp_dodc<='$endDate' and disp_dodc>='$startDate' and disp_tflg=1 and plantcode='$plantcode' order by disp_dodc asc ") or die(mysqli_error($link));
		$tot_dispm=mysqli_num_rows($sql_dispm);
		if($tot_dispm > 0)
		{
			while($row_dispm=mysqli_fetch_array($sql_dispm))
			{
				if($disp_id!=""){$disp_id=$disp_id.",".$row_dispm['disp_id'];} else {$disp_id=$row_dispm['disp_id'];}
			}
		}
	
	//echo $dbulk_id;
	
		$qty=0;
		if($dbulk_id!='')
		{
			$dbulksid='';
			$sql213="select dbulks_id, dbulks_crop, dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id)  ";
			
			$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sq_var);
			$sql213.=" and dbulks_variety='".$row_var['popularname']."'";
			
			$sql213.=" order by dbulks_variety asc";
				
			$sql_dbulks23=mysqli_query($link,$sql213) or die(mysqli_error($link));
			$subtbldbulks23=mysqli_num_rows($sql_dbulks23);
			while($row_dbulks23=mysqli_fetch_array($sql_dbulks23))
			{
				if($dbulksid!=""){$dbulksid=$dbulksid.",".$row_dbulks23['dbulks_id'];}else{$dbulksid=$row_dbulks23['dbulks_id'];}
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype FROM tblcrop where cropname='".$row_dbulks23['dbulks_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$sq_var2=mysqli_query($link,"select vt from tblvariety where popularname='".$row_dbulks23['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$crop=$row_tbl_sub1['lotcrop'];
				$variety=$row_tbl_sub2['lotvariety'];	
				$vtype=$row_var2['vt'];

			}

			$dblksid=explode(",",$dbulksid);
			array_unique($dblksid);
			$dblksid2=implode(",",$dblksid);
			if($dblksid2!=""){
				$sql="select SUM(dbss_qty) from tbl_dbulksub_sub where dbulks_id IN ($dblksid2) order by dbss_id asc";
				//f($row_dbulks23['dbulks_variety']=="Kajal") {echo $sql; echo "<br />";}
	
				$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
				$subtbltot=mysqli_num_rows($sql_tbl_sub);
				while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
				{
					$ac=0;
					$aq=explode(".",$row_tbl_sub[0]);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub[0];}
					$qty=$qty+$ac;
					//if($row_dbulks23['dbulks_variety']=="Kajal") {echo $dbulk_id." = ".$qty;echo "<br />";}
					$x++;
				}
			}
		}
		
		//echo "select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc";
		$sq_var2=mysqli_query($link,"select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
		$row_var2=mysqli_fetch_array($sq_var2);
		$variety=$row_var2['popularname'];	
		$vtype=$row_var2['vt'];	

		$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropname='".$row_var2['cropid']."' ") or die(mysqli_error($link));
		$row_crop2=mysqli_fetch_array($sq_crop2);
		$crpsize=$row_crop2['seedsize'];
		$croptype=$row_crop2['croptype'];
		$crop=$row_crop2['cropname'];

		if($disp_id!="")
		{
			$sqls="select SUM(dpss_qty) from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_variety='".$verlist."' order by dpss_crop, dpss_variety asc";
				//echo $sql;
			$sql_tbl_subs=mysqli_query($link,$sqls) or die(mysqli_error($link));
			$subtbltots=mysqli_num_rows($sql_tbl_subs);
			while($row_tbl_subs=mysqli_fetch_array($sql_tbl_subs))
			{
				$ac=0;
				$aq=explode(".",$row_tbl_subs[0]);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_subs[0];}
				$qty=$qty+$ac;
				$x++;
			}
		}
			
		$temp[] = $qty;

	}//print_r($temp);
	//array_push($data1[$d],$temp);
	$data2[$d]=$temp;
//print_r($data2);
	$d++;

	}
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