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
	
	set_time_limit(0);
	ini_set("memory_limit","100M");
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety1 = $_REQUEST['txtvariety'];
	$txtvertype=$_REQUEST['txtvertype'];
		
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
	//$qry="select varietyid, popularname from tblvariety where proslipmain_date <='".$edate."' and proslipmain_date >='".$sdate."' ";
	
	$qry="select varietyid from tblvariety where cropname='$crop'";
	$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
	$row_crp=mysqli_fetch_array($sql_crp);
	$crp=$row_crp['cropname'];
	
	if($variety1!="ALL")
	{	
		$qry.="and varietyid='$variety1' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety1."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtvertype!="ALL")
	{	
		$qry.="and vt='$txtvertype' ";
	}
	
	$qry.=" order by popularname Asc";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	$dh="Periodical_Blending_Report_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array("Periodical Blending Report");
	$filename=$dh.".xls";  
	$datahead2 = array("Crop",$crp,"Variety Type",$txtvertype,"Variety",$ver);
	$datahead1 = array("Period From ".$_REQUEST['sdate']." To ".$_GET['edate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	
$datahead3 = array("Crop","Variety","Blending Date","Blended Lot No.","Qty","Constituent Lot No.","Qty"); 


$d=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['varietyid']."'") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
	}
	
$sql_rr=mysqli_query($link,"SELECT * FROM tbl_blendm WHERE blendm_variety='".$row_arr_home1['varietyid']."' and `blendm_date`<='$edate' and `blendm_date`>='$sdate' and blendm_bflg=1 AND plantcode='$plantcode' order by blendm_id asc") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
//{
	while($row_rr=mysqli_fetch_array($sql_rr))
	{
		$rdate=$row_rr['blendm_date'];
		$ryear=substr($rdate,0,4);
		$rmonth=substr($rdate,5,2);
		$rday=substr($rdate,8,2);
		$trdate=$rday."-".$rmonth."-".$ryear;
				
		$sqlmonth2=mysqli_query($link,"SELECT distinct blends_newlot FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_delflg=0 AND plantcode='$plantcode'")or die("Error:".mysqli_error($link));
		$t2=mysqli_num_rows($sqlmonth2);
		while($rowmonth2=mysqli_fetch_array($sqlmonth2))
		{
			$lotno=""; $cqty=""; 
			$sqlmonth1=mysqli_query($link,"SELECT * FROM tbl_blendss WHERE blendm_id='".$row_rr['blendm_id']."' and blendss_newlot='".$rowmonth2['blends_newlot']."' AND plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			$t1=mysqli_num_rows($sqlmonth1);
			$rowmonth1=mysqli_fetch_array($sqlmonth1);
		
			$lotno=$rowmonth2['blends_newlot'];
	
			$an2=explode(".",$rowmonth1['blendss_qty']);
			if($an2[1]==000){$cqty1=$an2[0];}else{$cqty1=$rowmonth1['blendss_qty'];}
			
			$sqlmonth3=mysqli_query($link,"SELECT * FROM tbl_blends WHERE blendm_id='".$row_rr['blendm_id']."' and blends_newlot='".$rowmonth2['blends_newlot']."' and blends_delflg=0 AND plantcode='$plantcode'")or die("Error:".mysqli_error($link));
			$t3=mysqli_num_rows($sqlmonth3);
			while($rowmonth3=mysqli_fetch_array($sqlmonth3))
			{
				$ctlotno=""; $rmqty=""; 
				$ctlotno=$rowmonth3['blends_lotno'];
				$aq3=explode(".",$rowmonth3['blends_qty']);
				if($aq3[1]==000){$rmqty1=$aq3[0];}else{$rmqty1=$rowmonth3['blends_qty'];}


				if($tot_rr > 0)
				{
					$data1[$d]=array($crp,$variety,$trdate,$lotno,$cqty1,$ctlotno,$rmqty1); 
					$d++;
				}
			}
		}
	}
}
echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
