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
	
	 //$pid = $_GET['pid'];	
	 $sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
	 $txtparty = $_REQUEST['txtparty'];
	 $itemid = $_REQUEST['itemid'];
	 //$mtype = $_REQUEST['ret'];
 	
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
		
		$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Trading' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and party_id='".$txtparty."' and arrtrflag=1 and plantcode='".$plantcode."' order by ncode asc ") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
	 
	/* $s = "select stores_item,uom from tbl_stores where items_id = $itemid";
	 		$r = mysqli_query($link,$s) or die(mysqli_error($link));	 
			$ro = mysqli_fetch_array($r);
			$stores_item = $ro['stores_item'];
			$uom = $ro['uom'];*/
			
		
$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='$txtparty'");
		 while($noticia=mysqli_fetch_array($sql_party)){
         $a=$noticia['business_name'];

 	  
	 /*  $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	

	$dh="Trading_Vendor_Wise_Report ".$a."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead1 = array("Arrival:Trading Party Name : ",$a);
	$datahead2 = array("Period From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
	//$datahead2 = array("$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
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
  $datatitle2 = array("","","","","","","","","","PP","Moist %","","","","");
	 $datatitle3 = array("#","Crop","Variety","FRN No.","Vendor Lot No.","Lot No.","NoB","Qty"," Stage","Preliminary QC","","QC Status","GOT Status");
	 $d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";$vchk="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['lotvariety']."'  and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['lotcrop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_arr_home['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['lotvariety'];
		}
		else
		{
		$variety=$row_arr_home['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
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
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$per=$row_tbl_sub['moisture'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_party['business_name'];
		}
		else
		{
		$loc1=$row_party['business_name'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
		if($lotoldlot!="")
		{
		$lotoldlot=$lotoldlot."<br>".$row_tbl_sub['lotoldlot'];
		}
		else
		{
		$lotoldlot=$row_tbl_sub['vchk'];
		}
		if($vchk!="")
		{
		$vchk=$vchk."<br>".$row_tbl_sub['vchk'];
		}
		else
		{
		$vchk=$row_tbl_sub['lotoldlot'];
		}
		$stnno="FRN"."/".$yearid_id."/".$row_arr_home['ncode'];
		$farm=$row_tbl_sub['farmer'];
				$qty= $ac;
				$bags=$acn;
				$lotoldlot=$row_tbl_sub['lotoldlot'];
				$loc=$row_pp['productionlocation'];
				$per=$row_pro['productionpersonnel'];
				$crop=$row_arr_home['lotcrop'];
				$variety=$row_arr_home['lotvariety'];
				$lotno=$row_tbl_sub['lotno'];
				$org=$row_tbl_sub['ploc'];
				$stage=$row_tbl_sub['sstage'];
				$sstatus=$row_tbl_sub['sstatus'];
				//$qc=$row_tbl_sub['gemp'];
				//$qc=$row_tbl_sub['qc'];
				//$vchk=$row_tbl_sub['vchk'];
				$per=$row_tbl_sub['moisture'];
				$got=$row_tbl_sub['got1'];
				$sstatus=$row_tbl_sub['sstatus'];
				$qc=$row_tbl_sub['qc'];
				$pp1=$row_tbl_sub['plotno'];
				//$slocs=$wareh.$binn.$subbinn;
				/*$loc=$row_pp['productionlocation'];
				$per=$row_pro['productionpersonnel'];
				$crop=$row_tbl_sub['lotcrop'];
				$variety=$row_tbl_sub['lotvariety'];
				$lotno=$row_tbl_sub['lotno'];
				$loc1=$row_party['business_name'];
				$stage=$row_tbl_sub['sstage'];
				$sstatus=$row_tbl_sub['sstatus'];
				$lotoldlot=$row_tbl_sub['lotoldlot'];
				
				
				*/
			$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='".$plantcode."' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
				
				 //$lotno=$row_tbl_sub['lotno'];
				
				
				/*if($row_arr['trtype']=="Trading" || $row_arr['trtype']=="Existing")
				{
				$oldlot = $row_tbl_sub['oldlot'];
				}
				else
				{
				$oldlot = $row_arr['oldlot'];
				}
				$lotmerging=$row_arr['nooflots'];
				$organizer=$row_item['orgname'];
				$farmer=$row_item1['farmername'];
				$plotn=$row_tbl_sub['plotno'];
				*/
				
								
				$sql_usr=mysqli_query($link,"select * from tbluser where scode='".$row_arr['logid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
				$row_usr=mysqli_fetch_array($sql_usr);
				
				$sql_opr1=mysqli_query($link,"select * from tblopr where id='".$row_usr['uid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
				$row_opr1=mysqli_fetch_array($sql_opr1);
				$login=$row_opr1['name'];
				
	

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$crop,$variety,$stnno,$lotoldlot,$lotno,$bags,$qty,$stage,$vchk,$per,$qc,$got); 
$d++;}
}
}
}
//},$sstatus,$moist,$vk,$got


# coading ends here............
echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datatitle3) ;
echo "\n";
	
	echo implode("\t", $datatitle2) ;
echo "\n";
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;