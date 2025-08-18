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
	
	$txtstage="Condition"; 
	$dt=date("d-m-Y");	
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_sstage='$txtstage' and plantcode='$plantcode'";
	$qry.=" group by lotldg_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	$crop2="";
	$cp=explode(",",$croparr);
	sort($cp);
	for($i=0; $i<count($cp); $i++)
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($crop2!="")
		$crop2=$crop2.",".$row312['cropid'];
		else
		$crop2=$row312['cropid'];
	}
		
	$dh="CSW_Crop_Variety_Lotno_wise_Stock_Report_As_on_Date_".$dt;
	$datahead = array("CSW Crop Variety Lotno wise Stock Report As on Date $dt");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	$data2 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

$datahead1 = array("Crop:$crp","Variety:$ver");
//$datahead2 = array("Sr. No.","Crop","NoB","Qty"); 
$cnt=1;
  
$crps=explode(",",$crop2);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$stage="Condition";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	

	$sql_ahome=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_sstage='$stage' and plantcode='$plantcode' group by lotldg_variety order by lotldg_id asc") or die(mysqli_error($link));
	while($row_ahome=mysqli_fetch_array($sql_ahome))
	{  
 		$tnob=0; $tqty=0; $d=1;
		$datahead3[$cnt] = array("Sr. No.","Crop","Variety","Lot Number", "Arrival Type","NoB","Qty","QC Status","DoT", "SLOC"); 
	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$row_ahome['lotldg_variety']."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$verty=$row_var['popularname'];
	 	
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$row_ahome['lotldg_variety']."' and lotldg_sstage='$stage' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$totnob=0; $totqty=0; $sloc="";
			$lotno=$row_arhome['lotldg_lotno'];
			$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$row_ahome['lotldg_variety']."' and lotldg_sstage='$stage' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		
			$row_is3=mysqli_fetch_array($sql_is3);
			$trtype=$row_is3['lotldg_trtype'];
			
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$row_ahome['lotldg_variety']."' and lotldg_sstage='$stage' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$row_ahome['lotldg_variety']."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
						$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
						
						$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0; $qc=""; $dot="";
						
						$qc=$row_issuetbl['lotldg_qc']; 
						
						$rdate=$row_issuetbl['lotldg_qctestdate'];
						$ryear=substr($rdate,0,4);
						$rmonth=substr($rdate,5,2);
						$rday=substr($rdate,8,2);
						$dot=$rday."-".$rmonth."-".$ryear;
						
						if($dot=="00-00-0000" || $dot=="--")
						$dot="";	
						if($qc=="RT" || $qc=="UT")$dot="";

						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
						
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
						
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
						
						$slups=$row_issuetbl['lotldg_balbags'];
						$slqty=$row_issuetbl['lotldg_balqty'];
						 
						if($sloc!="")
						$sloc=", ".$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
						else
						$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
						$cont++;
					}	
				}
			}
			
			if($trtype=="PROSLIPSUC")$trtype="Processing";
			
			if($totqty < 0)$totqty=0;
			if($totqty==0 && $totnob > 0)$totnob=0;
			
			if($totqty==0)$sloc="";
			
			$tnob=$tnob+$totnob; $tqty=$tqty+$totqty;
			
			$data1[$cnt][$d]=array($d,$crop1,$verty,$lotno,$trtype,$totnob,$totqty,$qc,$dot,$sloc); 
			$d++;
		}
	
	$data2[$cnt]=array("","","","","Total ",$tnob,$tqty,"","",""); 
	$cnt++;
	}
}
}
//echo $cnt;
echo implode($datahead) ;
echo "\n";
echo implode("\t", $datahead1) ;
echo "\n";
for($i=1; $i<$cnt; $i++)
{
	echo implode("\t", $datahead3[$i]) ;
	echo "\n";
	foreach($data1[$i] as $row1)
	{ 
		echo implode("\t", array_values($row1))."\n"; 
	}
	echo implode("\t", $data2[$i])."\n"; 
	echo "\n";
}