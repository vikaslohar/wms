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
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
		
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
		
	$crp="ALL"; $ver="ALL";
	$qry="select * from tbl_cobdrying where plantcode='".$plantcode."' and   arrflg='1' and dflg='1' ";
	if($crop!="ALL")
	{	
	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.="and crop='$crp' ";
	}
	if($variety!="ALL")
	{	
	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.="and variety='$ver' ";
	}
	
	$qry.=" and dryingdate<='$edate' and dryingdate>='$sdate' order by dryingdate ASC";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
 	 
	$dh="Periodical_Drying_Report_Period_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	$datahead1 = array("Periodical Drying Report");
	$datahead2 = array("Period From: ",$_REQUEST['sdate']," To: ",$_REQUEST['edate']);
	$datahead3 = array("Crop: ",$crp,"Variety: ",$ver);
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
	$datatitle1 = array("#","Date of Drying Slip","Drying Slip Ref. No.","Crop","Variety","Lot No.","Before Drying","","After Drying","","Drying Loss","");
	$datatitle2 = array("","","","","","","NoB","Qty","NoB","Qty","Qty","%");
 
$d=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	$sql_issuetbl=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$row_arr_home1['trid']."'") or die(mysqli_error($link)); 
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{ 
		$drefno=""; $lotno=""; $onob=""; $oqty=""; $nob1=""; $qty1=""; $adnob=""; $adqty=""; 
		
		$rdate=$row_arr_home1['dryingdate'];
		$ryear=substr($rdate,0,4);
		$rmonth=substr($rdate,5,2);
		$rday=substr($rdate,8,2);
		$trdate=$rday."-".$rmonth."-".$ryear;
		
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['crop']."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
			
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['variety']."' ") or die(mysqli_error($link));
		$rowvv=mysqli_fetch_array($sql_variety);
		$cropn=$row_arr_home1['crop'];
		$varietyn=$row_arr_home1['variety'];
	
		$drefno=$row_arr_home1['drefno'];
		$lotno=$row_issuetbl['lotno'];
		$onob=$row_issuetbl['onob'];
		$oqty=$row_issuetbl['oqty'];
		$nob1=$row_issuetbl['nob1'];
		$qty1=$row_issuetbl['qty1'];
		$adnob=$row_issuetbl['adnob'];
		$adqty=$row_issuetbl['adqty'];
	
		if($tot_arr_home > 0)			
		{
			$data1[$d]=array($d,$trdate,$drefno,$cropn,$varietyn,$lotno,$onob,$oqty,$nob1,$qty1,$adnob,$adqty); 
			$d++;
		}
	}
}

# coading ends here............
echo implode("\t", $datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
echo implode("\t", $datatitle1) ;
echo "\n";
echo implode("\t", $datatitle2) ;
echo "\n";
foreach($data1 as $row1)
{ 
 	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}