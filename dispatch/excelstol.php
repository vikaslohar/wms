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
		
	if(isset($_REQUEST['pid']))
	{
		$pid = $_REQUEST['pid'];
	}
		
	$tid=$pid; 

	$sql_tbl=mysqli_query($link,"select * from tbl_stoutm where  stoutm_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$tdate=$row_tbl['stoutm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
		
	$arrival_id=$row_tbl['stoutm_id'];
	
	$quer5=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['stoutm_plant']."' order by stcode asc"); 
	$noticia2 = mysqli_fetch_array($quer5); 
	$plantname=$noticia2['business_name'];
	$plantcode=$noticia2['stcode'];
	
	$dh="Stock_Transfer_Lots";
	$datahead = array("Stock Transfer-Plant");
	$filename=$dh.".csv";  
	$datahead1 = array($plantname,$plantcode);
	$data1 = array();
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename"); 
	
	$datahead2= array("Dispatch Date","Crop","Variety","Lot Number","Stage","NoB","Qty","QC Status","PP","Reason","Moisture %","Germination %","Last Test Date","GOT Type","GOT Status","GOT Test Date","Pack Types","LE Duration","LE Upto"); 

$d=1;
$sql_sub=mysqli_query($link,"Select * from tbl_stouts where stoutm_id='$tid'") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stouts_crop']."' order by cropname") or die(mysqli_error($link));
	$noticia_class=mysqli_fetch_array($classqry);
	$crop=$noticia_class['cropname'];
	
	$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stouts_variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$noticia_item=mysqli_fetch_array($itemqry);
	$variety=$noticia_item['popularname'];
	
	$lotn=$row_sub['stouts_lotno'];
	$stgw=$row_sub['stouts_stage'];
	$nobs=$row_sub['stouts_nob'];
	$qtys=$row_sub['stouts_qty'];
	$remarks=$row_tbl['stoutm_ramarks'];
	$remarks=str_replace("&","and",$remarks);
	$remarks=str_replace(",","; ",$remarks);
	
	$qc=$row_sub['stouts_qc']; 
	$germ=$row_sub['stouts_germ']; 
	$pp=$row_sub['stouts_pp']; 
	$moist=$row_sub['stouts_moist']; 
	$gotyp=$row_sub['stouts_gottype'];
	$got=$row_sub['stouts_got'];
				
	$rdate=$row_sub['stouts_dot'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$dot=$rday."-".$rmonth."-".$ryear;
				
	$rgdate=$row_sub['stouts_dogt'];
	$rgyear=substr($rgdate,0,4);
	$rgmonth=substr($rgdate,5,2);
	$rgday=substr($rgdate,8,2);
	$dogt=$rgday."-".$rgmonth."-".$rgyear;
							
	if($dot=="00-00-0000" || $dot=="--")$dot="";	
	if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
	if($qc=="RT" || $qc=="UT")$dot="";
	if($got=="RT" || $got=="UT")$dogt="";
	if($germ<=0)$germ="";
	if($moist<=0)$moist="";	
	$ptyp="";
	$sql_spc=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$lotn."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	if($xx=mysqli_num_rows($sql_spc)>0)
	{
		$ledt=$row_lot['le_duration'];
		$leupto=$row_lot['le_upto'];
	}
	
	if($tot_sub=mysqli_num_rows($sql_sub) > 0)
	{
		$data1[$d]=array($tdate,$crop,$variety,$lotn,$stgw,$nobs,$qtys,$qc,$pp,$remarks,$moist,$germ,$dot,$gotyp,$got,$dogt,$ptyp,$ledt,$leupto); 
		$d++;
	}
}

echo implode($datahead);
echo "\n";
echo implode(",",$datahead1);
echo "\n";
echo implode(",", $datahead2);
echo "\n";
foreach($data1 as $row1)
 { 
 	#array_walk($row1, 'cleanData'); 
	echo implode(",", array_values($row1))."\n"; 
 }
