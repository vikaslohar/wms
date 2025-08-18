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
	
	 $trid = $_GET['itmid'];	

	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$trid")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	//$trid=$pid; 
	$drole=$row['blendm_logid'];
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
	$noticia_class=mysqli_fetch_array($classqry);
	$crop=$noticia_class['cropname'];
	
	$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."' ") or die(mysqli_error($link));
	$noticia_item=mysqli_fetch_array($itemqry);
	$variet=$noticia_item['popularname'];
	$stage=$row['blendm_stage'];
	 	
	$dh="Lot_Blending_Request_Raised_on_".$tdate;
	$datahead = array($dh);
	$datahead2 = array("Lot Blending Request Raised on ",$tdate);
	$datahead1 = array("Crop - " ,$crop, " ","Variety - ", $variet, " ","Stage - ", $stage);
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
 
	 $datatitle2 = array("#","Lot No.","NoB","Qty","SLOC","QC Status","DOT","Germination %","GOT Status","DOGT","Arrival Type","Production Location","State","Date of Harvest");
$d=1;

$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' order by blends_lotno asc, blends_group asc") or die(mysqli_error($link));
$tot_rows=mysqli_num_rows($sql_eindent_sub);
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0)$itmdchk++;

$subid=$row_eindent_sub['blends_id'];

$ltno=$row_eindent_sub['blends_lotno'];
$zzz=str_split($ltno);
$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];

 $olot2=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12];

$ploc=""; $pdate=""; $state="";
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class['cropname']."' and lotvariety='".$noticia_item['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' order by orlot asc") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
if($tot_rr > 0)
{
	$row_rr=mysqli_fetch_array($sql_rr);
	$ploc=$row_rr['ploc'];
	//if($row_rr['lotstate']!="")
	$state=$row_rr['lotstate'];
	$rpdate=$row_rr['harvestdate'];
	$rpyear=substr($rpdate,0,4);
	$rpmonth=substr($rpdate,5,2);
	$rpday=substr($rpdate,8,2);
	$pdate=$rpday."-".$rpmonth."-".$rpyear;
	
	if($pdate=="00-00-0000" || $pdate=="--")$pdate="";	
}

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row['blendm_variety']."' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."'  order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$qc=$row_issuetbl['lotldg_qc']; 
			$germ=$row_issuetbl['lotldg_gemp']; 
			$got1=split(" ",$row_issuetbl['lotldg_got1']);
			$got2=$row_issuetbl['lotldg_got']; 
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
			$totnob=$totnob+$row_issuetbl['lotldg_balbags'];		
			
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$dot=$rday."-".$rmonth."-".$ryear;
			
			$rgdate=$row_issuetbl['lotldg_gottestdate'];
			$rgyear=substr($rgdate,0,4);
			$rgmonth=substr($rgdate,5,2);
			$rgday=substr($rgdate,8,2);
			$dogt=$rgday."-".$rgmonth."-".$rgyear;
						
			if($dot=="00-00-0000" || $dot=="--")$dot="";	
			if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
			if($qc=="RT" || $qc=="UT")$dot="";
			if($got2=="RT" || $got2=="UT")$dogt="";
			if($germ<=0)$germ="";

			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
					
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
						
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
						
			$slups=$row_issuetbl['lotldg_balbags'];
			$slqty=$row_issuetbl['lotldg_balqty'];
						 
			if($sloc!="")
				$sloc=", ".$sloc.$wareh.$binn.$subbinn;
			else
				$sloc=$wareh.$binn.$subbinn;
			$cont++;
		}	
	}
}

if($trtype=="Fresh Seed with PDN")$trtype="Fresh Seed";

$zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot!="00000") {if($trtype=="Merger")$trtype="SR Merger";}


if($tot_rows > 0)			
{
$data1[$d]=array($d,$ltno,$totnob,$totqty,$sloc,$qc,$dot,$germ,$got,$dogt,$trtype,$ploc,$state,$pdate); 
$d++;
}
}


//},$per,$sstatus


# coading ends here............
/**/
echo implode($datahead2) ;
echo "\n";

echo implode($datahead1) ;
echo "\n";

echo implode("\t", $datatitle2) ;
echo "\n";
	
foreach($data1 as $row1)
{ 
 	#array_walk($row1, 'cleanData'); 
	echo implode("\t", array_values($row1))."\n"; 
}
#echo implode("\t", $datatitle3) ;