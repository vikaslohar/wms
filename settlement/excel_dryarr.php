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
	$edate = $_REQUEST['edate'];
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
		
	$crp="ALL"; $ver="ALL";
		
	$sql_arr_home=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	if($txtcrop!="ALL")
	{
		$qry_crop=mysqli_query($link,"select cropname from tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($qry_crop);
		$crp=$row_crop['cropname'];
	}
	if($txtvariety!="ALL")
	{
		$qry_ver=mysqli_query($link,"select popularname from tblvariety where varietyid='$txtvariety' order by popularname Asc") or die(mysqli_error($link));
		$row_ver=mysqli_fetch_array($qry_ver);
		$ver=$row_ver['popularname'];
	}
	  	
	$dh="Cob_Arrival_Report_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead2 = array("Cob Arrival Report Date From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
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
		
	$datatitle1 = array("Crop",$crp,"Variety",$ver);	
 	$datatitle2 = array("","","","","","Cob Arrival","","After Drying","","","","","","","");
	$datatitle3 = array("#","Date of Arrival","Crop","Variety","Lot No.","NoB","Qty","NoB","Qty","GOT Status","Production Personnel","Organiser","Farmer","Farmer ID","FRN No.","Production Location","State","Blend Lot No.","Mode of Transport","Transport Name","Lorry Receipt No.","Vehicle No.","Payment Mode","Courier Name","Docket No.","By Hand Person Name");
/* $datatitle1 = array("Date","Transaction Type","Old Lotnumber","Lotnumber","SP-F","SP-M","Crop","Organiser","Farmer","Production Location","Production Personnel","Plot No.","Old Lotnumber,"Farmer",");,"QC Status","Moisture %","Physical Purity","GOT"
*/$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	$yearid_id=$row_arr_home['yearcode'];
	
	$tmode=$row_arr_home1['tmode'];
	$trans_name=$row_arr_home1['trans_name'];
	$trans_lorryrepno=$row_arr_home1['trans_lorryrepno'];
	$trans_vehno=$row_arr_home1['trans_vehno'];
	$trans_paymode=$row_arr_home1['trans_paymode'];
	$courier_name=$row_arr_home1['courier_name'];
	$docket_no=$row_arr_home1['docket_no'];
	$pname_byhand=$row_arr_home1['pname_byhand'];
	
	$sql="select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' ";
	if($txtcrop!="ALL")
	{
		$sql.=" and lotcrop='".$crp."'";
	}
	if($txtvariety!="ALL")
	{
		$sql.=" and lotvariety='".$ver."'";
	}
	$sql.=" order by lotcrop asc, lotvariety asc";
	//echo $sql;
	
	$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
	$farm="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $bags2=""; $qty2=""; $stage=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12="";$trdate1=""; $p=""; $stnno1=""; $blendlot='';
	
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	if($trdate1!="") { $trdate1=$trdate1."<br>".$trdate; } else { $trdate1=$trdate; }	
	
	$aq=explode(".",$row_tbl_sub['act']);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}
	
	$an=explode(".",$row_tbl_sub['act1']);
	if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['act1'];}
	if($ac>0 && $acn==0)$acn=1;
	
	$lt=explode("/",$row_tbl_sub['lotno']);
	$ltn=$lt[0];
			
	if($crop!="") { $crop=$crop."<br>".$row_tbl_sub['lotcrop']; } else { $crop=$row_tbl_sub['lotcrop']; }
	if($variety!="") { $variety=$variety."<br>".$row_tbl_sub['lotvariety']; } else { $variety=$row_tbl_sub['lotvariety']; }
	//if($lotno!="") { $lotno=$lotno."<br>".$row_tbl_sub['lotno']; } else { $lotno=$row_tbl_sub['lotno']; }
	if($lotno!="") { $lotno=$lotno."<br>".$ltn; } else { $lotno=$ltn; }
	if($bags!="") { $bags=$bags."<br>".$acn; } else { $bags=$acn; } 
	if($qty!="") { $qty=$qty."<br>".$ac; } else { $qty=$ac; }
	if($got!="") { $got=$got."<br>".$row_tbl_sub['got1']; } else { $got=$row_tbl_sub['got1']; }
	if($stage!="") { $stage=$stage."<br>".$row_tbl_sub['lotstate']; } else { $stage=$row_tbl_sub['lotstate']; }
	if($moist!="") { $moist=$moist."<br>".$row_tbl_sub['ploc']; } else { $moist=$row_tbl_sub['ploc']; }
	if($org!="") { $org=$org."<br>".$row_tbl_sub['organiser']; } else { $org=$row_tbl_sub['organiser']; }
	if($pp12!="") { $pp12=$pp12."<br>".$row_tbl_sub['pper']; } else { $pp12=$row_tbl_sub['pper']; }
	if($farm!="") { $farm=$farm."<br>".$row_tbl_sub['farmer']; } else { $farm=$row_tbl_sub['farmer']; }
	
	$qry_cobdry=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));
	$row_cobdry=mysqli_fetch_array($qry_cobdry);
	
	$aq=explode(".",$row_cobdry['qty1']);
	if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_cobdry['qty1'];}
	
	$an=explode(".",$row_cobdry['nob1']);
	if($an[1]==000){$acn=$an[0];}else{$acn=$row_cobdry['nob1'];}
	if($ac>0 && $acn==0)$acn=1;
	
	if($bags2!="") { $bags2=$bags2."<br>".$acn; } else { $bags2=$acn; } 
	if($qty2!="") { $qty2=$qty2."<br>".$ac; } else { $qty2=$ac; }
	
	$zz=str_split($lotno);
 	$orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
 	
	$sql_cobblend=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   lotno='".$lotno."'") or die(mysqli_error($link));
	if($tot_cobblend=mysqli_num_rows($sql_cobblend)>0)
	{
		$row_cobblend=mysqli_fetch_array($sql_cobblend);
		$blendlot=$row_cobblend['newlono'];
	}
	
	$sql_lot=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   orlot='$orlot' and lotldg_trtype='Blending'") or die(mysqli_error($link));
	if($tot_lot=mysqli_num_rows($sql_lot)>0)
	{
		$row_lot=mysqli_fetch_array($sql_lot);
	
		$sql_blend=mysqli_query($link,"select * from tbl_blends where plantcode='".$plantcode."' and blends_lotno='".$row_lot['lotldg_lotno']."'") or die(mysqli_error($link));
		if($tot_blend=mysqli_num_rows($sql_blend)>0)
		{
			$row_blend=mysqli_fetch_array($sql_blend);
			$blendlot=$row_blend['blends_newlot'];
		}
	}
	
	$qry_lotimp=mysqli_query($link,"select farmer_id, farmer_code from tbllotimp where lotnumber='".$row_tbl_sub['old']."' ") or die(mysqli_error($link));
	$row_lotimp=mysqli_fetch_array($qry_lotimp);
	if($row_lotimp['farmer_id']!='' && $row_lotimp['farmer_id']!=NULL)
	{$farmerid=$row_lotimp['farmer_id'];}
	else if($row_lotimp['farmer_code']!='' && $row_lotimp['farmer_code']!=NULL)
	{$farmerid=$row_lotimp['farmer_code'];}
	else {$farmerid='';}
	
	$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
	
if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$trdate,$crop,$variety,$lotno,$bags,$qty,$bags2,$qty2,$got,$pp12,$org,$farm,$farmerid,$stnno,$moist,$stage,$blendlot, $tmode, $trans_name, $trans_lorryrepno, $trans_vehno, $trans_paymode, $courier_name, $docket_no, $pname_byhand); 
$d++;
}
}
}
}
//}
//},$sstatus,$moist,$vk,$got


/*# coading ends here............
echo implode($datahead1) ;
echo "\n";
*/
echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datatitle1) ;
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