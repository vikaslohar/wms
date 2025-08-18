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
	
	$sdate = $_REQUEST['sdate'];
	$edate = date("d-m-Y");
	$itemid = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$loc = $_REQUEST['result'];
 	
$edate=$edate;
		$tday=substr($edate,0,2);
		$tmonth=substr($edate,3,2);
		$tyear=substr($edate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
		
	$dt=1;
	if($edate!="")
	{
	$m=$tmonth;
	$de=$tday;
	$y=$tyear;
	$dt22=$dt;
	if($dt!="")
	{
	for($i=1; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,($m-$i),$de,$y)); } 
	}
	else
	$dt2="";
	}
	//echo $dt2;
$t=split("-",$dt2);
//$z=sprintf("%02d",$t[0]);
$sdate=$t[2]."-".$t[1]."-".$t[0];
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 
$vv=$variety;
$sql="select distinct lotno from tbl_qctest where gotdate<='$edate' and gotdate>='$sdate' and crop!='51' ";

	if($vv=="ALL")
	{	
	$sql.=" ";
	}
	else
	{
	$sql.=" and variety='$vv'";
	}
	
	if($loc=="ALL")
	{	
	$sql.=" and gotstatus!='RT' ";
	}
	else
	{
	$sql.=" and gotstatus='$loc'";
	}
	
$sql.=" and gotflg=1 order by crop, variety, dosdate asc ";

$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

	$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
$row_dept=mysqli_fetch_array($quer2);

	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vv' "); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
	}
 	  
	 /* $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	 	
	$dh="Periodical_GOT_Report_Report:".$tlp."_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	$datahead2 = array("Periodical_GOT_Report_Report -Period From ",$_REQUEST['sdate'],"  To ",$_REQUEST['edate']);
$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$variet);
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
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","Arrival Date","Stage","NoB","Qty","PP","Moist%","Germination %","DOT","GOT Result","Genetic Purity %");
$d=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

$sql2="select MAX(tid) from tbl_qctest where lotno='".$row_arr_home2['lotno']."' and gotdate<='$edate' and gotdate>='$sdate' and crop!='51' ";

	if($vv=="ALL")
	{	
	$sql2.=" ";
	}
	else
	{
	$sql2.=" and variety='$vv'";
	}
	
	if($loc=="ALL")
	{	
	$sql2.="and gotstatus!='RT' ";
	}
	else
	{
	$sql2.=" and gotstatus='$loc'";
	}
	
$sql2.=" and gotflg=1 order by tid desc ";
//echo $sql2;
$sql_arr_home2=mysqli_query($link,$sql2) or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_arr_home2);
while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
{

$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{	$trdate=$row_arr_home['testdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$zzz=implode(",", str_split($row_arr_home['lotno']));
	$oldlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
	$ardate="";	
	$sql_arrs=mysqli_query($link,"Select * from tblarrival_sub where orlot='".$oldlot."'") or die(mysqli_error($link));
	$tot_arrs=mysqli_num_rows($sql_arrs);
	if($tot_arrs>0)
	{
		$row_arrs=mysqli_fetch_array($sql_arrs);
		$sql_arr=mysqli_query($link,"Select * from tblarrival where arrival_id='".$row_arrs['arrival_id']."' and arrival_type='Fresh Seed with PDN'") or die(mysqli_error($link));
		$row_arr=mysqli_fetch_array($sql_arr);
		
		$trdate1=$row_arr['arrival_date'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$ardate=$trday1."-".$trmonth1."-".$tryear1;
	}
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage="";
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
}
//echo $slups;
$sstage=$row_arr_home['trstage'];
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
/*	//$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id." '") or die(mysqli_error($link));
	
		
		lotno
		
if($vv=="ALL")
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$itemid."'") or die(mysqli_error($link));
	}
	else
	{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."' and crop='".$crop."' and lotvariety='".$vv."'") or die(mysqli_error($link));
	}	
	echo  $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	*/
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
		
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['gotstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $qcresult=$row_arr_home['gotstatus'];
		}
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['lotno'];
		}
		else
		{
		$lotno=$row_arr_home['lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_arr_home['pp'];
		}
		else
		{
		$qc=$row_arr_home['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['gemp'];
		}
		else
		{
		$stage=$row_arr_home['gemp'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_arr_home['sstatus'];
		}
		else
		{
		$sstatus=$row_arr_home['sstatus'];
		}
	
	$genpurper=$row_arr_home['genpurity'];
	if($genpurper==0)$genpurper="";
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$rowvv=mysqli_fetch_array($quer3);
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	/*$varietyy=$row_arr_home['variety'];
$cropp=$row_arr_home['crop'];*/
if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$crop,$variety,$lotno,$ardate,$sstage,$bags,$qty,$qc,$got,$stage,$trdate,$qcresult,$genpurper); 
$d++;
}
}
}
}

//},$per,$sstatus


# coading ends here............
/**/echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

/*echo implode("\t", $datatitle1) ;
echo "\n";*/
/*echo implode("\t", $datatitle3) ;
echo "\n";*/

echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;