<?php
ob_start();
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
	$edate = $_REQUEST['edate'];
	$loc = $_REQUEST['txtclass'];
	$state = $_REQUEST['state'];
	$txtorganiser = $_REQUEST['txtorganiser'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
 	
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
		
				$sql_arr_home=mysqli_query($link,"select * from tblarrival where (arrival_type='Fresh Seed with PDN' || arrival_type='Unidentified') and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

	/* $s = "select stores_item,uom from tbl_stores where items_id = $itemid";
	 		$r = mysqli_query($link,$s) or die(mysqli_error($link));	 
			$ro = mysqli_fetch_array($r);
			$stores_item = $ro['stores_item'];
			$uom = $ro['uom'];*/
			
		 	  
	 /*  $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	  	
	$dh="Production_Location_Report".$loc."_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead2 = array("Production Location Report:",$loc," Date From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
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
 $datatitle2 = array("","","","","","","","","","PP","Moisture%","","","","","");
	 $datatitle3 = array("#","Date of Arrival","Crop","Variety","Stage","FRN No.","Lot No.","NoB","Qty","Preliminary QC","","GOT Status","State","Production Location","Production Personnel","Organiser","Farmer","State","Production Location");
/* $datatitle1 = array("Date","Transaction Type","Old Lotnumber","Lotnumber","SP-F","SP-M","Crop","Organiser","Farmer","Production Location","Production Personnel","Plot No.","Old Lotnumber,"Farmer",");,"QC Status","Moisture %","Physical Purity","GOT"
*/$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{


	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	$sql="select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='".$plantcode."' ";
	if($state!="ALL")
	{
		$sql.=" and lotstate='".$state."'";
	}
	if($loc!="ALL")
	{
		$sql.=" and ploc='".$loc."'";
	}
	if($txtorganiser!="ALL")
	{
		$sql.=" and organiser='".$txtorganiser."'";
	}
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql.=" and lotcrop='".$row_crop['cropname']."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."'  and vertype='PV' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql.=" and lotvariety='".$row_var['popularname']."'";
	}
		$sql.=" order by lotstate asc, ploc asc, lotcrop asc, lotvariety asc";
		//echo $sql;
	$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
	$farm="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $state2=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12="";$trdate1=""; $p=""; $stnno1="";
$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate1!="")
		{
		$trdate1=$trdate1."<br>".$trdate;
		}
		else
		{
		$trdate1=$trdate;
		}	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];
if($ac>0 && $acn==0)$acn=1;
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
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
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$moist=$row_tbl_sub['moisture'];
		}
		if($org!="")
		{
		$org=$org."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$org=$row_tbl_sub['pper'];
		}
		if($row_tbl_sub['vchk'] =="Acceptable") { $p="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $p="NAcc";}
		if($pp!="")
		{
		$pp=$pp."<br>".$p;
		}
		else
		{
		$pp=$p;
		}
		if($state2!="")
		{
		$state2=$state2."<br>".$row_tbl_sub['lotstate'];
		}
		else
		{
		$state2=$row_tbl_sub['lotstate'];
		}
		if($pp1!="")
		{
		$pp1=$pp1."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$pp1=$row_tbl_sub['ploc'];
		}
		if($pp12!="")
		{
		$pp12=$pp12."<br>".$row_tbl_sub['organiser'];
		}
		else
		{
		$pp12=$row_tbl_sub['organiser'];
		}
		if($farm!="")
		{
		$farm=$farm."<br>".$row_tbl_sub['farmer'];
		}
		else
		{
		$farm=$row_tbl_sub['farmer'];
		}
		if($row_tbl_sub['ncode']!="" && $row_tbl_sub['ncode']!=0)
		{
		$stnno="FRN"."/".$row_arr_home['yearcode']."/".$row_tbl_sub['ncode'];
		}
		else
		{
		$stnno="";
		}
		
		if($row_tbl_sub['vchk'] =="Acceptable") { $p="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $p="NAcc";}
				//$stnno="FRN"."/".$yearid_id."/".$row_arr_home['ncode'];
		$pp12=$row_tbl_sub['organiser'];
		$org=$row_tbl_sub['pper'];
		$farm=$row_tbl_sub['farmer'];
		$crop=$row_tbl_sub['lotcrop'];
		$variety=$row_tbl_sub['lotvariety'];
		$loc1=$row_tbl_sub['ploc'];
		$state1=$row_tbl_sub['state'];
		//$stnno="FRN"."/".$yearid_id."/".$row_arr_home['ncode'];
		$stage=$row_tbl_sub['sstage'];
		$lotno=$row_tbl_sub['lotno'];
		$party=$row_party['business_name'];
		//$vchk=$row_tbl_sub['vchk'];
		         $bags= $acn;
				$qty= $ac;
					$moist=$row_tbl_sub['moisture'];
				//$org1=$row_tbl_sub['plotno'];
					//$loc=$row_tbl_sub['ploc'];
						//$pp1=$row_tbl_sub['plotno'];
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
				$qc=$row_tbl_sub['qc'];
				$vk=$row_tbl_sub['vchk'];
				$moist=$row_tbl_sub['moisture'];
				$got=$row_tbl_sub['got'];*/
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
$data1[$d]=array($d,$trdate,$crop,$variety,$stage,$stnno,$lotno,$bags,$qty,$pp,$moist,$got,$state1,$loc1,$org,$pp12,$farm,$state2,$pp1); 
$d++;
}
}
}
}
}
//},$sstatus,$moist,$vk,$got


/*# coading ends here............
echo implode($datahead1) ;
echo "\n";
*/
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
