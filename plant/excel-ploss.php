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
		
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$slchk = $_REQUEST['slchk'];
	$slchk2 = $_REQUEST['slchk2'];
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL";
	$qry="select * from tbl_pnpslipmain where pnpslipmain_date <='".$edt."' and pnpslipmain_date >='".$sdt."' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$qry.=" and pnpslipmain_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
		$qry.=" and pnpslipmain_variety='$variety' ";
	}
	
	$qry.=" group by pnpslipmain_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['pnpslipmain_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
	//$dat=date("d-m-Y H:i:s");	
	 
	$dh="Crop_Variety_wise_Packing_Loss_Report_Period_From_".$sdate."_To_".$edate;
	$datahead = array("Crop Variety wise Packing Loss Report");
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$d=1;
	$datahead0= array("Period From",$sdate,"To",$edate);
	$datahead1= array("Crop",$crp,"Variety",$ver);
	$datahead2= array("#","Crop","Veriety","UPS","Packing Machine Code","Picked for Packing Qty","Packing Loss","Packing Loss %","Pack Seed Qty"); 

$crps=explode(",",$crop2);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct pnpslipmain_variety from tbl_pnpslipmain where pnpslipmain_crop='".$crval."' and pnpslipmain_date <='".$edt."' and pnpslipmain_date >='".$sdt."' and plantcode='$plantcode'";
	if($variety!="ALL")
	{	
		$qry.=" and pnpslipmain_variety='$variety' ";
	}
	
	$qry.=" group by pnpslipmain_variety";
	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['pnpslipmain_variety']."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
			else
			$ver2=$row312['varietyid'];
		}
	}

	$verps=explode(",",$ver2);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		 $pnpmainid=''; $promaccode='';
		
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$verty=$row_var['popularname'];
	 	
		$sql_is=mysqli_query($link,"select pnpslipmain_id, pnpslipmain_promachcode from tbl_pnpslipmain where  pnpslipmain_crop='".$crval."' and pnpslipmain_variety='".$verval."' and pnpslipmain_date <='".$edt."' and pnpslipmain_date >='".$sdt."' and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			if($pnpmainid!="") {$pnpmainid=$pnpmainid.",".$row_is['pnpslipmain_id'];} else  {$pnpmainid=$row_is['pnpslipmain_id'];}
			$promaccode=$row_is['pnpslipmain_promachcode'];
		}
		if($pnpmainid!="")	
		{
		$sql_pnpsub=mysqli_query($link,"select Distinct pnpslipsub_ups from tbl_pnpslipsub where pnpslipmain_id IN ($pnpmainid) and plantcode='$plantcode' order by pnpslipsub_ups, pnpslipsub_id asc") or die(mysqli_error($link)); 
		$tpnpsub=mysqli_num_rows($sql_pnpsub);
		if($tpnpsub > 0)
		{
			while($row_pnpsub=mysqli_fetch_array($sql_pnpsub))
			{
			$totcqty=0; $totpqty=0; $ccnt=0; $totsrqty=0; $lossper=0; $pmc=""; 
			$ups=$row_pnpsub['pnpslipsub_ups'];
			$sql_istbl=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id IN ($pnpmainid) and pnpslipsub_ups='".$ups."' and plantcode='$plantcode' order by pnpslipsub_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$totcqty=$totcqty+$row_issuetbl['pnpslipsub_pickpqty']; 
					$totpqty=$totpqty+$row_issuetbl['pnpslipsub_packloss']; 
					$totsrqty=$totsrqty+$row_issuetbl['pnpslipsub_packqty']; 
					
					$ccnt++;
				}	
			}
			
			$sql_pmc=mysqli_query($link,"select * from tbl_rm_promac where promac_id='".$promaccode."' and plantcode='$plantcode'") or die(mysqli_error($link));
			$row_arr_pmc=mysqli_fetch_array($sql_pmc);
			$pmc=$row_arr_pmc['promac_mac'].$row_arr_pmc['promac_macid'];
			
		$lossper=round($totpqty/$totcqty*100,2);
if($ccnt > 0)
{
$data1[$d]=array($d,$crop1,$verty,$ups,$pmc,$totcqty,$totpqty,$lossper,$totsrqty); 
$d++;
}
}
}
}
}
}
}
}
echo implode($datahead) ;
echo "\n";
echo implode("\t", $datahead0) ;
echo "\n";
echo implode("\t", $datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
