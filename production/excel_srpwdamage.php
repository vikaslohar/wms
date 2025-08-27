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
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtptype=$_REQUEST['txtptype'];
	$txtcountryl=$_REQUEST['txtcountryl'];
	$txtpp=$_REQUEST['txtpp'];
	$txtstatesl=$_REQUEST['txtstatesl'];
	$locationname=$_REQUEST['locationname'];
	$txtstfp=$_REQUEST['txtstfp'];
	if($txtptype=="C" || $txtptype=="CandF" || $txtptype=="CnF")$txtptype="C&F";
	
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[0])."-".sprintf("%02d",$sd[1]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[0])."-".sprintf("%02d",$ed[1]);
	
	if($txtptype!="Export Buyer")
	{
		$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$locationname."' order by productionlocation")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month);
		$location=$noticia['productionlocation'];
	}
	else
	{
		$sql_month=mysqli_query($link,"select * from tblcountry where country='".$locationname."' order by country")or die(mysqli_error($link));
		$noticia = mysqli_fetch_array($sql_month);
		$location=$noticia['country'];
	}
	$sql_month2=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtstfp."' order by business_name")or die(mysqli_error($link));
	$noticia2 = mysqli_fetch_array($sql_month2);
	$pty=$noticia2['business_name'];
	
	$crp="ALL"; $variet="ALL";
	
	if($crop!="ALL")
	{
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row31=mysqli_fetch_array($sql_crop);
		$crp=$row31['cropname'];		
	}
	if($variety!="ALL")
	{
		$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$ttt=mysqli_num_rows($sql_variety);
		if($ttt > 0)
		{
			$rowvv=mysqli_fetch_array($sql_variety);
			$variet=$rowvv['popularname'];
		}
		else
		{
			$variet=$variety;
		}
	}
	
	$dh="Party_wise_Damage_Material_Return_Report";
	$datahead = array("Party wise Damage Material Return Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");
	
	
	$datahead1 = array("Period From: ",$sdate,"To: ",$edate);
	$datahead2 = array("State: ",$txtstatesl,"Location: ",$location);
	$datahead3 = array("Party Type: ",$txtptype,"Party: ",$pty);
	$datahead4 = array("Crop:$crp     Variety:$variet");
	$datahead5 = array("SRN No.","Crop","Variety","As per DC","","","As per Actuals","","","","","Ex.(+) / Sh.(-)"); 
	$datahead6 = array("","","","UPS","NoP/NoB","Qty","UPS","NoP","Total Qty","Good","Damage"); 
	
$mid=""; $cnt=0; $d=1; $ct=1;
$sql_srretm=mysqli_query($link,"select * from tbl_salesrv where salesr_party='".$txtstfp."' and salesr_date<='".$edt."' and salesr_date>='".$sdt."' and salesr_trtype='Sales Return' and plantcode='$plantcode' ") or die(mysqli_error($link));
if($tot_srretm=mysqli_num_rows($sql_srretm) > 0)
{
	while($row_srretm=mysqli_fetch_array($sql_srretm))
	{
		if($mid!="")
			$mid=$mid.",".$row_srretm['salesr_id'];
		else
			$mid=$row_srretm['salesr_id'];
	}
	$md=explode(",",$mid);
	if(count($md) >1)
	$sqlsrrets2="select distinct salesrs_crop from tbl_salesrv_sub where salesr_id IN ($mid) and plantcode='$plantcode' ";
	else
	$sqlsrrets2="select distinct salesrs_crop from tbl_salesrv_sub where salesr_id=$mid and plantcode='$plantcode' ";
	if($crop!="ALL")
	{
		$sqlsrrets2.=" and salesrs_crop='".$crop."' ";
	}
	$sqlsrrets2.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
	$sql_srrets2=mysqli_query($link,$sqlsrrets2) or die(mysqli_error($link));
	while($row_tbl_sub2=mysqli_fetch_array($sql_srrets2))
	{
	
		if(count($md) >1)
		$sqlsrrets1="select distinct salesrs_variety from tbl_salesrv_sub where salesr_id IN ($mid) and plantcode='$plantcode' ";
		else
		$sqlsrrets1="select distinct salesrs_variety from tbl_salesrv_sub where salesr_id=$mid and plantcode='$plantcode' ";
		$sqlsrrets1.=" and salesrs_crop='".$row_tbl_sub2['salesrs_crop']."' ";
		if($variety!="ALL")
		{
			$sqlsrrets1.=" and salesrs_variety='".$variety."' ";
		}
		$sqlsrrets1.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
		$sql_srrets1=mysqli_query($link,$sqlsrrets1) or die(mysqli_error($link));
		while($row_tbl_sub1=mysqli_fetch_array($sql_srrets1))
		{
			$tenb=0; $teqt=0.000; $tnnb=0; $tnqt=0.000; $tngqt=0.000; $tndqt=0.000; $tnexqt=0.000;
			if(count($md) >1)
			$sqlsrrets="select * from tbl_salesrv_sub where salesr_id IN ($mid) and plantcode='$plantcode' ";
			else
			$sqlsrrets="select * from tbl_salesrv_sub where salesr_id=$mid and plantcode='$plantcode' ";
			
			$sqlsrrets.=" and salesrs_crop='".$row_tbl_sub2['salesrs_crop']."' ";
			$sqlsrrets.=" and salesrs_variety='".$row_tbl_sub1['salesrs_variety']."' ";
			$sqlsrrets.="  and salesrs_vflg!=0 order by salesrs_crop, salesrs_variety ";
			$sql_srrets=mysqli_query($link,$sqlsrrets) or die(mysqli_error($link));
			while($row_tbl_sub=mysqli_fetch_array($sql_srrets))
			{
		
				$sqlsrretm=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$row_tbl_sub['salesr_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$rowsrretm=mysqli_fetch_array($sqlsrretm);
			
				$totqty=0; $cropn=""; $varietyn="";$slups=""; $slnob=""; $slqty="";
				
				$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
				$noticia = mysqli_fetch_array($quer3);
				$cropn=$noticia['cropname'];
				
				$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."'  order by popularname Asc"); 
				$noticia_item = mysqli_fetch_array($quer4);
				$varietyn=$noticia_item['popularname'];
				
				$slups=$row_tbl_sub['salesrs_ups']; 
				$slnob=$row_tbl_sub['salesrs_nob']; 
				$slqty=$row_tbl_sub['salesrs_qty'];
				
				$diq=explode(".",$slqty);
				if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}
				
				$din=explode(".",$slnob);
				if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
				
				if($row_tbl_sub['salesrs_upstype']=="Standard")
				$upstyp="ST";
				if($row_tbl_sub['salesrs_upstype']=="Non-Standard")
				$upstyp="NST";
				else
				$upstyp="ST";
				
				$tdate1=$row_tbl_sub['salesrs_dov'];
				$tyear1=substr($tdate1,0,4);
				$tmonth1=substr($tdate1,5,2);
				$tday1=substr($tdate1,8,2);
				$dov=$tday1."-".$tmonth1."-".$tyear1;
				
				$nob=0; $qty=0;
				
				
				$diq2=explode(".",$row_tbl_sub['salesrs_qtydc']);
				if($diq2[1]==000){$difq2=$diq2[0];}else{$difq2=$row_tbl_sub['salesrs_qtydc'];}
				$din2=explode(".",$row_tbl_sub['salesrs_nobdc']);
				if($din2[1]==000){$difn2=$din2[0];}else{$difn2=$row_tbl_sub['salesrs_nobdc'];}
				
				$diq3=explode(".",$row_tbl_sub['salesrs_qtydamage']);
				if($diq3[1]==000){$difq3=$diq3[0];}else{$difq3=$row_tbl_sub['salesrs_qtydamage'];}
				$din3=explode(".",$row_tbl_sub['salesrs_nobdamage']);
				if($din3[1]==000){$difn3=$din3[0];}else{$difn3=$row_tbl_sub['salesrs_nobdamage'];}
				
				$zzz=implode(",", str_split($row_tbl_sub['salesrs_oldlot']));
				$lotno=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
				
				$totqty=$difq2+$difq3;
				if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
				$slrno="SRN/".$rowsrretm['salesr_yearcode']."/".sprintf("%00005d",$rowsrretm['salesr_slrno']);
				
				$exsh=($row_tbl_sub['salesrs_qtydc']+$row_tbl_sub['salesrs_qtydamage'])-$qty;
				$exsh=number_format($exsh,3);
				$tenb=$tenb+$nob;
				$teqt=$teqt+$qty;
				$tnnb=$tnnb+$difn2;
				$tnqt=$tnqt+$totqty;
				$tngqt=$tngqt+$difq2;
				$tndqt=$tndqt+$difq3;
				$tnexqt=$tnexqt+($exsh);
				$tnexqt=number_format($tnexqt,3);
	
				//if($tot_arr_home > 0)
				{	
					$data1[$d]=array($slrno,$cropn,$varietyn,$slups,$nob,$qty,$slups,$difn2,$totqty,$difq2,$difq3,$exsh);
					$d++;$cnt++;
				}
			}
			$data1[$d]=array("","","","Total",$tenb,$teqt,"",$tnnb,$tnqt,$tngqt,$tndqt,$tnexqt);
			$d++;	
		}
	}	
	if($cnt==0)
	{	
		$data1[$d]=array("","","","","","Record Not Found","","","","","","");
	}
}
echo implode($datahead) ;
echo "\n";
echo implode("\t", $datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
echo implode("\t", $datahead4) ;
echo "\n";
echo implode("\t", $datahead5) ;
echo "\n";
echo implode("\t", $datahead6) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
