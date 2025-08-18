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
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct salesrs_crop from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_stage='Condition'";
	if($crop!="ALL")
	{	
	$qry.="and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.="and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by salesrs_crop order by salesrs_crop asc";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	$dh="Sales_Return_Opening_Stock_Report";
	$datahead = array("Sales Return - Opening Stock Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	$datahead1 = array("Crop:$crp     Variety:$ver");
	$datahead2 = array("#","Date","Crop","Variety","Old Lot Number","New Lot Number","NoB","Qty","QC Status","DoT","Moisture %","Germination %","SLOC"); 
	
		$cnt=1;$d=1;
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($variety!="ALL")
{
	$sql_arr_home=mysqli_query($link,"select distinct salesrs_variety from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$variety."' ") or die(mysqli_error($link));
}
else
{
	$sql_arr_home=mysqli_query($link,"select distinct salesrs_variety from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
}	
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$sql_arr_home2=mysqli_query($link,"select *  from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$row_arr_home['salesrs_variety']."' ") or die(mysqli_error($link));
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
	$crop2=""; $variety2="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['salesrs_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$rowvv=mysqli_fetch_array($sql_variety);
	$crop2=$row31['cropname'];
	$variety2=$rowvv['popularname'];
	
	$sql_osrmain=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_id='".$row_arr_home2['salesr_id']."'") or die(mysqli_error($link));
	$row_osrmain=mysqli_fetch_array($sql_osrmain);
	
	$dtd=explode("-", $row_osrmain['salesr_date']);
	$trdate=$dtd[2]."-".$dtd[1]."-".$dtd[0];
 	
	$dtd2=explode("-", $row_arr_home2['salesrs_dot']);
	$dot=$dtd2[2]."-".$dtd2[1]."-".$dtd2[0];
	
	$slnob=$row_arr_home2['salesrs_nob']; 
	$slqty=$row_arr_home2['salesrs_qty'];
	
	$diq=explode(".",$slqty);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}
	
	$din=explode(".",$slnob);
	if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
	
	$slocs="";
	$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_arr_home2['salesrs_id']."'") or die(mysqli_error($link));
	while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
	{
	
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$sln=$row_salesvr_subsub['salesrss_nob']; 
	$slq=$row_salesvr_subsub['salesrss_qty'];
	
	$sloc=$wareh.$binn.$subbinn."  ".$sln." | ".$slq;
	
	if($slocs!="")
	$slocs=$slocs."<br/>".$sloc;
	else
	$slocs=$sloc;
	}
	
	$olot=$row_arr_home2['salesrs_oldlot'];
	$nlot=$row_arr_home2['salesrs_newlot'];
	$qc=$row_arr_home2['salesrs_qc'];
	$moist=$row_arr_home2['salesrs_moist'];
	$gemp=$row_arr_home2['salesrs_gemp'];
	if($tot_arr_home > 0)
	{	
		$data1[$d]=array($d,$trdate,$crop2,$variety2,$olot,$nlot,$difn,$difq,$qc,$dot,$moist,$gemp,$slocs);
		$d++;
	}
}
}
}
echo implode($datahead) ;
echo "\n";
echo implode($datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
