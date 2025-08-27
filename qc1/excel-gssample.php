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
	$rettyp = $_REQUEST['rettyp'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
	
$sdt1=explode("-",$sdate);
	$sdt2=explode("-",$edate);
	$sdate=$sdt1[2]."-".$sdt1[1]."-".$sdt1[0];
	$edate=$sdt2[2]."-".$sdt2[1]."-".$sdt2[0];
//echo $rettyp;
	
	
$ver="ALL";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	if($variety!="ALL")
	{	
		$ver=$variety;
	}
	
if($rettyp=="periodical")
{
	if($variety!="ALL")
	{
		$qry="select * from tbl_gsample where gsdate >= '$sdate' and gsdate <= '$edate' and  gscrop='$crp' and gsvariety='$ver' and gsdisflg=0 order by gsdate asc ";
	}
	else 
	{
		$qry="select * from tbl_gsample where gsdate >= '$sdate' and gsdate <= '$edate' and  gscrop='$crp' and gsdisflg=0 order by gsdate asc ";
	}
}
else
{
	if($variety!="ALL")
	{
		$qry="select * from tbl_gsample where gsdate <= '$sdate' and  gscrop='$crp' and gsvariety='$ver' and gsdisflg=0 order by gsdate asc ";
	}
	else 
	{
		$qry="select * from tbl_gsample where gsdate <= '$sdate' and  gscrop='$crp' and gsdisflg=0 order by gsdate asc ";
	}
}
//echo $qry;
		$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);

	 	
	$dh="Guard_Sample_Stock_Report";
	$datahead = array($dh);
	$data1 = array();
	if($rettyp=="periodical")
	{
	$datahead2 = array("Guard Sample Stock Report Period - From ".$_REQUEST['sdate']."  To ".$_REQUEST['edate']);
	}
	else
	{
	$datahead2 = array("Guard Sample Stock Report As on Date - ",$_REQUEST['sdate']);
	}
	
function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	    $filename=$dh.".xls";  
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel");
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","SLOC","DOA","GSRP","GSRP Mat. Date");
$d=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['gsdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
$arrival_id=$row_arr_home['gsid'];
	$qc1=$row_arr_home['sampleno'];

	
		$lotno=$row_arr_home['lotno'];
	
	$quer333=mysqli_query($link,"SELECT * FROM tblvariety where popularname ='".$row_arr_home['gsvariety']."' "); 
	$row333=mysqli_fetch_array($quer333);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer333);	
	 if($tot > 0)
	 {
	 $vv=$row333['gsdis'];
	 }
	 else
	 {
	  $vv=0;
	  }
	 $tt=$row_arr_home['gsvariety'];

$wh=""; $binn=""; $slocs="";
$wh1=$row_arr_home['gswh']."/";
$binn1=$row_arr_home['gsbin'];

$quer3=mysqli_query($link,"SELECT * FROM tblbin  where binid='".$binn1."'"); 
	$row31=mysqli_fetch_array($quer3);
	  $binn=$row31['binname'];
	
	$quer4=mysqli_query($link,"SELECT * from tblwarehouse where whid ='".$wh1."'"); 
	$row=mysqli_fetch_array($quer4);
	  $wh=$row['perticulars']."/";
$slocs=$wh.$binn."<br/>";

if($vv!=0)
{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=$vv;
		
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y)); }
		
	
	$trdate1=$dt1;
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
}
else
{
$vv="";
$trdate1="";
}	
if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$crop,$tt,$lotno,$slocs,$trdate,$vv,$trdate1); 
$d++;
}
}

echo implode($datahead2) ;
echo "\n";
echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
			echo implode("\t", array_values($row1))."\n"; 
		 }