<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
	 $cid = $_REQUEST['txtcrop'];
	 $itemid = $_REQUEST['txtvariety'];
	 $sdate1=date("d-m-Y");
 	
		$tdate=$sdate1;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
		
$sql="select distinct sampleno from tbl_qctest where gotflg=0 and (got='UT' or got='RT') and plantcode='$plantcode'";
if($cid!="ALL")
{	
$sql.=" and crop='".$cid."'";
}
if($itemid!="ALL")
{	
$sql.=" and variety='".$itemid."'";
}
$sql.=" order by dosdate asc, oldlot asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($cid!="ALL")
{	
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$cid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	
}
else
{
	$crop=$cid;	
}
		
	if($itemid!="ALL")
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$itemid'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$tot_var=mysqli_num_rows($quer4);
		if($tot_var > 0)
		{	
			$variet=$row_dept4['popularname'];
		}
		else 
		{
			$variet=$itemid;
		} 
	}
	else
	{
		$variet="ALL";
	}

 	  
	 /* $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <='$edate' and pldg_trdate >='$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));  */
	 	
	$dh="Under_Got_Report_Report_AS_on_".$sdate1;
	$datahead = array($dh);
	$datahead2 = array("Under_Got_Report_Report - As on",$sdate1);
/*$datahead1 = array("Crop - " ,$crop , " "," ", " ","Variety - " ,$variet);*/
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
 
	 $datatitle2 = array("#","Crop","Variety","Lot No. ","NoB","Qty","DOSR","DOSC","DOSD","GOT Status","Location","Mode");
$d=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$sqlmax2="select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and plantcode='$plantcode'";
if($cid!="ALL")
{
$sqlmax2.=" and crop='".$cid."'";
}
if($itemid!="ALL")
{	
$sqlmax2.=" and variety='".$itemid."'";
}
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_max2);
while($row_arr_home3=mysqli_fetch_array($sql_max2))
{
$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
{
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$trdate1=$row_arr_home['spdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	$trdate2=$row_arr_home['dosdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage=""; $got="";
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
$got=$row_tbl_sub['lotldg_got1'];
}
//echo $slups;
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
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage="";  $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";
$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 and plantcode='$plantcode' order by arrival_id asc") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	while($row_dtchk=mysqli_fetch_array($sql_dtchk))
	{
		$lid=explode(",",$row_dtchk['lotno']);
		foreach($lid as $fid)
		{
			if($fid <> "" && $fid!=0)
			{
				if($fid==$row_arr_home['tid'])
				{
				
				if($row_dtchk['pid']=="Yes")
				{
					$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_dtchk['party_id']."'"); 
					$row3=mysqli_fetch_array($quer3);
					$address=$row3['city'];
				}
				else
				{
					$address=$row_dtchk['city'];
				}
				$tmode=$row_dtchk['tmode'];
				}
			}	
		}
	}		
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['qcstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $qcresult=$row_arr_home['qcstatus'];
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
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['oldlot'];
		}
		else
		{
		$lotno=$row_arr_home['oldlot'];
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
		/*if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}*/
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
	
	
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['variety']."'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$tot_var=mysqli_num_rows($quer4);
		if($tot_var > 0)
		{	
			$varietyy=$row_dept4['popularname'];
		}
		else 
		{
			$varietyy=$row_arr_home['variety'];
		} 
$cropp=$row31['cropname'];

if($tot_arr_home > 0)			
{
$data1[$d]=array($d,$cropp,$varietyy,$lotno,$slups,$slqty,$trdate,$trdate1,$trdate2,$address,$tmode); 
$d++;
}
}
}
}
//},$per,$sstatus


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
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;
