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
	 $typ = $_REQUEST['typ'];
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
		
		$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='$typ' and  arrival_date ='$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	 
	/* $s = "select stores_item,uom from tbl_stores where items_id = $itemid";
	 		$r = mysqli_query($link,$s) or die(mysqli_error($link));	 
			$ro = mysqli_fetch_array($r);
			$stores_item = $ro['stores_item'];
			$uom = $ro['uom'];*/
			
		$sql_loc=mysqli_query($link,"select did, dest from tbldestination where did='$cid' and plantcode='$plantcode'"); 
		 while($noticia=mysqli_fetch_array($sql_loc)){
         $dest=$noticia['dest'];
		 }

 	  
	 /*  $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	 
	if($typ=="StockTransfer Arrival")	{$tlp="StockTransfer_Arrival";}
 		

	$dh="Daily_Arrival_Report:".$tlp."_From_".$_REQUEST['sdate'];
	$datahead = array($dh);
	//$datahead1 = array("Arrival Report");
	$datahead2 = array("Daily Arrival Report:".$tlp."as on:" ,$_REQUEST['sdate']);
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
 $datatitle2 = array("","","","","","","","","PP","Moist %","Germ %","","","","","");
	 $datatitle3 = array("#","Stock Transfer From Plant ","Crop","Variety","Lot No.","NoB","Qty","Stage","QC","","","QC Status","Last Test Date"," Got Status", "GOT Test Date","SLOC");
/* $datatitle1 = array("Date","Transaction Type","Old Lotnumber","Lotnumber","SP-F","SP-M","Crop","Organiser","Farmer","Production Location","Production Personnel","Plot No.","Old Lotnumber,"Farmer",");,"QC Status","Moisture %","Physical Purity","GOT"
*/$d=1;
if($typ=="StockTransfer Arrival")
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $lotoldlot="";
$moist="";$vk=""; $got=""; $got1="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['lotcrop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['lotvariety']."'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);

$sql_party=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['party_id']."'") or die(mysqli_error($link));
$row_party=mysqli_fetch_array($sql_party);
		
		$tdate12=$row_tbl_sub['testd'];
	$tyear1=substr($tdate12,0,4);
	$tmonth1=substr($tdate12,5,2);
	$tday1=substr($tdate12,8,2);
	$tdate12=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate13=$row_tbl_sub['gotdate'];
	$tyear1=substr($tdate13,0,4);
	$tmonth1=substr($tdate13,5,2);
	$tday1=substr($tdate13,8,2);
	$tdate13=$tday1."-".$tmonth1."-".$tyear1;
		
			$tdate=$row_arr['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
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
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub['gemp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($got1!="")
		{
		$got1=$got1."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got1=$row_tbl_sub['got1'];
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
		if($row_tbl_sub['vchk'] =="Acceptable") { $vk="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vk="NAcc";}
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
		$lotoldlot=$row_tbl_sub['lotoldlot'];
		}
		
	$gemp=$row_tbl_sub['gemp'];
		         $bags= $acn;
				$qty= $ac;
				//$slocs=$wareh.$binn.$subbinn;
				$loc=$row_pp['productionlocation'];
				$per=$row_pro['productionpersonnel'];
				$crop=$row_tbl_sub['lotcrop'];
				$variety=$row_tbl_sub['lotvariety'];
				$lotno=$row_tbl_sub['lotno'];
				$loc1=$row_party['business_name'];
				$stage=$row_tbl_sub['sstage'];
				$sstatus=$row_tbl_sub['sstatus'];
				$lotoldlot=$row_tbl_sub['lotoldlot'];
				$qc=$row_tbl_sub['qc'];
				$got1=$row_tbl_sub['got1']." ".$got;
				$moist=$row_tbl_sub['moisture'];
				$got=$row_tbl_sub['got'];
			$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode' order by arrsloc_id") or die(mysqli_error($link));
//echo mysqli_num_rows($sql_sloc);
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_sloc['bags'];
 $slqty=$slqty+$row_sloc['qty'];
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty.",";
else
$slocs=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty.",";}		
		
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
				
								
				$sql_usr=mysqli_query($link,"select * from tbluser where scode='".$row_arr['logid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_usr=mysqli_fetch_array($sql_usr);
				
				$sql_opr1=mysqli_query($link,"select * from tblopr where id='".$row_usr['uid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_opr1=mysqli_fetch_array($sql_opr1);
				$login=$row_opr1['name'];
				
	

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$loc1,$crop,$variety,$lotno,$bags,$qty,$stage,$vk,$moist,$gemp,$got1,$tdate12,$got,$tdate13,$slocs); 
$d++;
}
}
}
}
//},$sstatus,$moist,$vk,$got


# coading ends here............
/*echo implode($datahead1) ;
echo "\n";*/

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
