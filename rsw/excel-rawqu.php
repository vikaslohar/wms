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
	
	$cropo = $_REQUEST['txtcrop'];
	$varietyo = $_REQUEST['txtvariety'];
	
	$edate = $_REQUEST['sdate'];
	
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	
	 	
	$dh="Quality_Based_Raw_Seed_Stock_Report_as_on_date_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead2 = array("Quality Based Raw Seed Stock Report as on date ",$_REQUEST['sdate']);
//$datahead1 = array("Coded Seed - " ,$crp );
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
$s=1;	
	$crp="ALL"; $ver="ALL";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_sstage='Raw' and plantcode='$plantcode'";
	
	if($cropo!="ALL")
	{	
		$qry2.=" and lotldg_crop='$cropo' ";
	}	
	
 	$qry2.="and lotldg_trdate<='$edate'  group by lotldg_crop ";
	
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
		$crop1=$row_arr_home2['lotldg_crop'];
		
		$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_sstage='Raw' and lotldg_crop='".$crop1."' and plantcode='$plantcode'";
	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop1."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		if($varietyo!="ALL")
		{	
			$qry.=" and lotldg_variety='$varietyo' ";
			$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$varietyo."'  and vertype='PV'") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sql_var);
			$ver=$row_var['popularname'];
		}
		
 		$qry.="and lotldg_trdate<='$edate'  group by lotldg_variety ";
		//echo $qry;
		$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
			 
 	 $datatitle1[$s] = array("#","Crop","Variety","Total Qty"," ","QC"," "," "," ","GOT"," ");
	 $datatitle2[$s] = array(" "," "," "," ","OK","UT","Fail","NUT","OK","UT","Fail");
	 
	


$d=1;

while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{

$totqty=0; $totqcq=0; $totuqq=0; $totufq=0; $totgcq=0; $totugq=0; $totgfq=0; $totgnutq=0;
	
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop1."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		 $crop=$row31['cropname'];		
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home1['lotldg_variety']."'  and vertype='PV'") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
		}
		else
		{
		$variety=$row_arr_home1['lotldg_variety'];
		}
	//echo $row_arr_home1['lotldg_crop'];
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crop1."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_sstage='Raw' and plantcode='$plantcode' ") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
	$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and plantcode='$plantcode'") or die(mysqli_error($link));


 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_trdate <= '$edate' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_sstage='Raw' and plantcode='$plantcode' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and lotldg_sstage='Raw' and plantcode='$plantcode'") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	
	if($row_issuetbl['lotldg_qc']=="OK" || $row_issuetbl['lotldg_qc']==" ")
	{
	$totqcq=$totqcq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT")
	{
	$totuqq=$totuqq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_qc']=="Fail")
	{
	$totufq=$totufq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="OK")
	{
	$totgcq=$totgcq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
	{
	$totugq=$totugq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="Fail")
	{
	$totgfq=$totgfq+$row_issuetbl['lotldg_balqty'];  
	}
	if($row_issuetbl['lotldg_got']=="NUT" || $row_issuetbl['lotldg_got']==" " || $row_issuetbl['lotldg_got']=="" || $row_issuetbl['lotldg_got']=="NULL")
	{
	$totgnutq=$totgnutq+$row_issuetbl['lotldg_balqty'];  
	}

}
}
}	
		
	$bags=$row_arr_home['lotldg_balbags'];
    $qty=$row_arr_home['lotldg_balqty'];
   $qc=$row_arr_home['lotldg_sstatus'];
if($tot_arr_home > 0 && $totqty > 0)			
{
$data1[$s][$d]=array($d,$crop,$variety,$totqty,$totqcq,$totuqq,$totufq,$totgnutq,$totgcq,$totuqq,$totgfq); 
$d++;
}
}
$s++;
}
//},$per,$sstatus


# coading ends here............
/**/

echo implode($datahead2) ;
echo "\n";
for($i=1; $i<$s; $i++)
{
	echo implode($datatitle1[$i]) ;
	echo "\n";
	echo implode("\t", $datatitle2[$i]) ;
	echo "\n";
foreach($data1[$i] as $row1)
 { 
	echo implode("\t", array_values($row1))."\n"; 
 }
}
