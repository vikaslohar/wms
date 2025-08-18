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
	
 if(isset($_REQUEST['sdate']))
	{
		$sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
		$edate = $_REQUEST['edate'];
	}
	if(isset($_REQUEST['txtprodp']))
	{
		$txtprodp = $_REQUEST['txtprodp'];
	}
	
if(isset($_GET['print']))
{
	$print = $_GET['print'];
	if($print=='add')
	{
		$pr="Record Added Successfully";
	}
}
if(isset($_POST['frm_action'])=='submit')
{

}
		
$t=split("-",$sdate);
	$z=sprintf("%02d",$t[0]);
	$sdate=$z."-".$t[1]."-".$t[2];

	$t=split("-",$edate);
	$z=sprintf("%02d",$t[0]);
	$edate=$z."-".$t[1]."-".$t[2];
	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;
	
	$edate=$edate;
	$tday=substr($edate,0,2);
	$tmonth=substr($edate,3,2);
	$tyear=substr($edate,6,4);
	$edate=$tyear."-".$tmonth."-".$tday;
	
	
$sql="select distinct gottest_sampleno from tbl_gottest where gottest_gotflg=1 order by gottest_dosdate asc, gottest_oldlot asc";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);

$dh="Soft Release Status Report".$_REQUEST['sdate'];
$datahead = array($dh);
$datahead2 = array("Soft Release Status Report As on Date",$_REQUEST['sdate']);

$data1 = array();
$filename=$dh.".xls";  
	  //exit;
header("Content-Disposition: attachment; filename=$filename"); 
header("Content-Type: application/vnd.ms-excel");
//$datatitle1 = array("Preliminary QC");
$datatitle2 = array("#","Crop","Variety","Lot No. ","Qty","Dispatch Qty","SR Date","SR Status","QC Status","DoT");

$d=1;

while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
	$sql2="select MAX(gottest_tid) from tbl_gottest where gottest_sampleno='".$row_arr_home2['gottest_sampleno']."'   ";
	$sql2.=" and gottest_gotflg=1 order by gottest_tid desc ";
	//echo $sql2;
	$sql_arr_home2=mysqli_query($link,$sql2) or die(mysqli_error($link));
	$tot_max2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home3=mysqli_fetch_array($sql_arr_home2))
	{
	
	$sql_max=mysqli_query($link,"select * from tbl_gottest where gottest_tid='".$row_arr_home3[0]."' ") or die(mysqli_error($link));
	$tot_max=mysqli_num_rows($sql_max);
	while($row_arr_home=mysqli_fetch_array($sql_max))
	{
		$trdate=$row_arr_home['gottest_gotdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;
			
		$genpurity=$row_arr_home['genpurity'];
		$arrival_id=$row_arr_home['gottest_tid'];
		$crop=""; $variety=""; $lotno=""; $spcodes=""; $qty=""; $nob=''; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
		
		$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
		$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
		if($T=mysqli_num_rows($sql_tbl_sub1)>0)
		{
		
			$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
			$row_tbl1=mysqli_fetch_array($sql_tbl1);
		
			$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
		
			$total_tbl=mysqli_num_rows($sql1);
			$slups=0; $slqty=0; $sstage="";
			while($row_tbl_sub=mysqli_fetch_array($sql1))
			{
				$slups=$slups+$row_tbl_sub['lotldg_balbags'];
				$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
				$sstage=$row_tbl_sub['lotldg_sstage'];
				$got=$row_tbl_sub['lotldg_got1'];
			}
		}
		else
		{
			/*$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid, variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['gottest_lotno']."' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
			$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
			if($T=mysqli_num_rows($sql_tbl_sub1)>0)
			{
			
				$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['gottest_lotno']."'") or die(mysqli_error($link));  
				$row_tbl1=mysqli_fetch_array($sql_tbl1);
			
				$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' ")or die(mysqli_error($link));
			
				$total_tbl=mysqli_num_rows($sql1);
				$slups=0; $slqty=0; $sstage="";
				while($row_tbl_sub=mysqli_fetch_array($sql1))
				{
					$slups=$slups+$row_tbl_sub['lotldg_balbags'];
					$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
					$sstage=$row_tbl_sub['lotldg_sstage'];
					$got=$row_tbl_sub['lotldg_got1'];
				}
			}*/
		}
		$got1=explode(" ",$got);
		$got2=$got1[0];
		//echo $slups;
		$aq=explode(".",$slqty);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
	
		$an=explode(".",$slups);
		if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
	
		
		
		if($qcresult!="")
		{
			$qcresult=$qcresult."<br>".$got2." ".$row_arr_home['gottest_gotstatus'];
			// $row_tbl_sub['lotcrop'];
		}
		else
		{
			$qcresult=$got2." ".$row_arr_home['gottest_gotstatus'];
		}
		
		if($crop!="")
		{
			$crop=$crop."<br>".$row_arr_home['gottest_crop'];
			// $row_tbl_sub['lotcrop'];
		}
		else
		{
			$crop=$row_arr_home['gottest_crop'];
		}
		if($variety!="")
		{
			$variety=$variety."<br>".$row_arr_home['gottest_variety'];
		}
		else
		{
			$variety=$row_arr_home['gottest_variety'];	
		}
		if($lotno!="")
		{
			$lotno=$lotno."<br>".$row_arr_home['gottest_oldlot'];
		}
		else
		{
			$lotno=$row_arr_home['gottest_oldlot'];
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		if($nob!="")
		{
			$nob=$nob."<br>".$acn;
		}
		else
		{
			$nob=$acn;
		}
		$arrdate='';	$flg=0; $pper=''; $prodloc=''; $farmer=''; $organiser='';
		if($txtprodp!='ALL')
		$qry23="select * from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."' and pper='$txtprodp'";
		else
		$qry23="select * from tblarrival_sub where orlot='".$row_arr_home['gottest_oldlot']."'";
		$sql_arr_home23=mysqli_query($link,$qry23) or die(mysqli_error($link));
		if($tot_arr_home23=mysqli_num_rows($sql_arr_home23)>0)
		{
			$row_arr_home23=mysqli_fetch_array($sql_arr_home23);
			
			$qry223="select arrival_date from tblarrival where arrival_id='".$row_arr_home23['arrival_id']."' and arrival_date>='$sdate' and arrival_date<='$edate'";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
				$flg++;
				$trdate=$row_arr_home223['arrival_date'];
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$arrdate=$trday."-".$trmonth."-".$tryear;
				
				$pper=$row_arr_home23['pper'];
				$prodloc=$row_arr_home23['ploc'];
				$farmer=$row_arr_home23['farmer'];
				$organiser=$row_arr_home23['organiser'];
			}
		}
		/*if($flg==0)
		{
			$qry223="select salesrs_dovfy from tbl_salesrv_sub where salesrs_orlot='".$row_arr_home['gottest_oldlot']."' and salesrs_dovfy>='$sdate' and salesrs_dovfy<='$edate'";
			$sql_arr_home223=mysqli_query($link,$qry223) or die(mysqli_error($link));
			if($tot_arr_home223=mysqli_num_rows($sql_arr_home223)>0)
			{
				$row_arr_home223=mysqli_fetch_array($sql_arr_home223);	
				$flg++;
				$trdate=$row_arr_home223['salesrs_dovfy'];
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$arrdate=$trday."-".$trmonth."-".$tryear;
			}
		}*/
		
		
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' "); 
		$rowvv=mysqli_fetch_array($quer3);
		
	    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
		$row31=mysqli_fetch_array($quer3);
		
		$quer32=mysqli_query($link,"SELECT * FROM tblspcodes where variety ='".$row_arr_home['gottest_variety']."' "); 
		$rowvv2=mysqli_fetch_array($quer32);
		if(mysqli_num_rows($quer32)>0)
		$spcodes=$rowvv2['spcodef']." x ".$rowvv2['spcodem'];

if($row_issue_num>0)
{
$data1[$d]=array($d,$crop,$variety,$lotno,$qty,$dqty,$trdate,$type,$qcstatus,$dot); 
$d++;
}
}
}
}
# coading ends here............
/*echo implode($datahead1) ;
echo "\n";*/
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
	echo implode("\t", array_values($row1))."\n"; 
}
#echo implode("\t", $datatitle3) ;