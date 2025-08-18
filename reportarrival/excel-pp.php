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
	 $cid = $_REQUEST['txtclass'];
	// $itemid = $_REQUEST['itemid'];
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
		$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='".$plantcode."' order by arrival_date asc  ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	 
	
			 $sql_party=mysqli_query($link,"select * from tblarrival_sub where pper='".$cid."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	$row_party=mysqli_fetch_array($sql_party);   
			 while($noticia=mysqli_fetch_array($sql_party)){
         $dest=$noticia['pper'];
		 }
 

	$dh="Production_Personnel_wise".$dest."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	
	$datahead2 = array("Production Personnel wise Report:Period From From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
	$datahead1 = array("Production Personnel:" .$dest);
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
		      $datatitle2 = array("","","","","","","","","","PP","Moist %","","","","","");
	 $datatitle3 = array("#","Date of Arrival","Crop","Variety"," Stage","FRN No.","Lot No.","NoB","Qty","Preliminary QC","","GOT Status","Production Location","Oganiser","Farmer","Plot No.");
$d=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and pper='$cid' and plantcode='".$plantcode."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";$moist=""; $org=""; $pp=""; $pp1=""; $pp12=""; $farm=""; $farm1=""; $p="";$trdate1="";
	
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
		$org=$org."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$org=$row_tbl_sub['ploc'];
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
		if($pp1!="")
		{
		$pp1=$pp1."<br>".$row_tbl_sub['plotno'];
		}
		else
		{
		$pp1=$row_tbl_sub['plotno'];
		}
		if($pp12!="")
		{
		$pp12=$pp12."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$pp12=$row_tbl_sub['gemp'];
		}
		
		if($farm!="")
		{
		$farm=$farm."<br>".$row_tbl_sub['farmer'];
		}
		else
		{
		$farm=$row_tbl_sub['farmer'];
		}
		if($farm1!="")
		{
		$farm1=$farm1."<br>".$row_tbl_sub['organiser'];
		}
		else
		{
		$farm1=$row_tbl_sub['organiser'];
		}
		$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
	
	
		/*$bags= $acn;
		         $farm=$row_tbl_sub['farmer'];
				$qty= $ac;
				$farm1=$row_tbl_sub['organiser'];
				$loc=$row_pp['productionlocation'];
				$per=$row_pro['productionpersonnel'];
				$crop=$row_tbl_sub['lotcrop'];
				$variety=$row_tbl_sub['lotvariety'];
				$lotno=$row_tbl_sub['lotno'];
				$org=$row_tbl_sub['ploc'];
				$stage=$row_tbl_sub['sstage'];
				$sstatus=$row_tbl_sub['sstatus'];
				$pp12=$row_tbl_sub['gemp'];
				$qc=$row_tbl_sub['qc'];
				//$pp=$row_tbl_sub['vchk'];
				$moist=$row_tbl_sub['moisture'];
				$got=$row_tbl_sub['got1'];
				$sstatus=$row_tbl_sub['sstatus'];
				$pp1=$row_tbl_sub['plotno'];*/
				
		
								
				$sql_usr=mysqli_query($link,"select * from tbluser where scode='".$row_arr['logid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
				$row_usr=mysqli_fetch_array($sql_usr);
				
				$sql_opr1=mysqli_query($link,"select * from tblopr where id='".$row_usr['uid']."' and plantcode='".$plantcode."'") or die(mysqli_error($link));
				$row_opr1=mysqli_fetch_array($sql_opr1);
				$login=$row_opr1['name'];
				
	$tdate=$row_arr['ardate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$trdate,$crop,$variety,$stage,$stnno,$lotno,$bags,$qty,$pp,$moist,$got,$org,$farm1,$farm,$pp1); 
$d++;
}
}
}
}

//},$per,$sstatus


# coading ends here............

echo implode($datahead2) ;
echo "\n";

echo implode($datahead1) ;
echo "\n";

/*echo implode("\t", $datatitle1) ;
echo "\n";*/
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