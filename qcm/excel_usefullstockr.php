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
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	//if($txtupsdc=="")$txtupsdc="ALL";
	
	$cp="";
	$sql_crp=mysqli_query($link,"select * from tblcrop where cropname IN('Paddy Seed','Maize Seed','Bajra Seed') order by cropname ASC") or die(mysqli_error($link));
	while($row_crp=mysqli_fetch_array($sql_crp))
	{
		if($cp!="")
			$cp=$cp.",".$row_crp['cropid'];
		else
			$cp=$row_crp['cropid'];
	}
		
	$upsize="";$upsiz="";
	if($txtupsdc!="ALL")
	{
		$sqlrr=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where packtype='".$txtupsdc."' and lotldg_crop IN ($cp) order by packtype asc") or die(mysqli_error($link));
	}
	else
	{
		$sqlrr=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop IN ($cp) order by packtype Asc") or die(mysqli_error($link));
	}
	$totrr=mysqli_num_rows($sqlrr);
	while($rowrr=mysqli_fetch_array($sqlrr))
	{
		$up=$rowrr['packtype'];
		if($up!="")
		{
			$up="'$up'";
			if($upsize!="")
				$upsize=$upsize.",".$up;
			else
				$upsize=$up;
				
			if($upsiz!="")
				$upsiz=$upsiz.",".$rowrr['packtype'];
			else
				$upsiz=$rowrr['packtype'];	
		}	
	}
	//echo $upsize;
	$upp=explode(",",$upsiz);
	$upp=array_unique($upp);
	sort($upp);
	//print_r($upp); 
	$uid='';
	foreach($upp as $usp)
	{
		if($usp<>"")
		{
			$upssize=explode(" ",$usp);
			$sql_sel="select * from tblups where ups='".$upssize[0]."' and wt='".$upssize[1]."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			if($row12['uid']!="")
			{
				if($uid!="")
					$uid=$uid.",".$row12['uid'];
				else
					$uid=$row12['uid'];
			}
		}
	}
	//echo $uid;
	$upsiz2="";
	$sql_sel="select * from tblups where uid IN ($uid) order by uom Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	while($row12=mysqli_fetch_array($res))
	{
		$ups=$row12['ups']." ".$row12['wt'];
		if($upsiz2!="")
			$upsiz2=$upsiz2.",".$ups;
		else
			$upsiz2=$ups;
	}
	//echo $upsiz2."  =  ";
	$upsiz2=$upsiz2.",".$upsiz;
	
	$upp3=explode(",",$upsiz2);
	$upp3=array_unique($upp3);
	sort($upp3);
	$upsiz2=implode(",",$upp3);
	
	
	$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	$qry="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_qc!='Fail' and lotldg_got!='Fail'  ";

	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	} 
	else
	{
	$qry.=" and lotldg_crop IN ($cp) ";
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtupsdc!="ALL")
	{	
		$qry.=" and packtype='$txtupsdc' ";
	}
	$qry.=" group by lotldg_crop, lotldg_variety";
//echo $qry."<br/>";
//exit;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	$dat=date("d-m-Y");		
	
	$dh="Ready_Stock_Report_As_On_Date_".$dat;
	$datahead = array("Ready Stock Report As ON Date ".$dat);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

		$cnt=1;

	$totalbags=0; $totalqty=0;
	$datahead1= array("Crop",$crp,"Variety",$ver,"UPS",$txtupsdc);
	$datahead2= array("#","Crop","Variety");
	$upp2=explode(",",$upsiz2);
	foreach($upp2 as $ups2)
	{
	if($ups2<>"")
	{
	$paktp=explode(" ",$ups2);
	$paktyp=explode(".",$paktp[0]); 
	if($paktyp[1]=="000")
	$ups23=$paktyp[0]." ".$paktp[1];
	else
	$ups23=$ups2;
	array_push($datahead2,$ups23); 
	}
	}
	array_push($datahead2,"Total Qty"); 
	
$d=1; $totalbags=0;

while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($txtupsdc!="ALL")
{
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  order by lotdgp_id desc") or die(mysqli_error($link));
}
else
{
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  order by lotdgp_id desc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{

	$crop=""; $variety="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['lotldg_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop=$row31['cropname'];		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_rr['lotldg_variety']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$variety=$rowvv['popularname'];
	}
	else
	{
		$variety=$row_rr['lotldg_variety'];
	}

	$upsval=""; $i=0; $totalqty=0; $cnt=0;
	$upp2=explode(",",$upsiz2);
	foreach($upp2 as $ups2)
	{
		if($ups2<>"")
		{	
			
			//echo $ups2;
			$totqty=0; 
			$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$ups2."' and lotldg_qc!='Fail' and lotldg_got!='Fail'   order by packtype asc") or die(mysqli_error($link));
			$tot_rr2=mysqli_num_rows($sql_rr2);
			//$row_rr2=mysqli_fetch_array($sql_rr2);
			while($row_rr2=mysqli_fetch_array($sql_rr2))
			{
				$totqty=0; $totnob=0; 
				$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotldg_qc!='Fail' and lotldg_got!='Fail'  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_arr_home=mysqli_fetch_array($sql_arr_home))
				{
					$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotno='".$row_arr_home['lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by subbinid") or die(mysqli_error($link));
					$t2=mysqli_num_rows($sql_tbl_sub1);
					while($row_tbl=mysqli_fetch_array($sql_tbl_sub1))
					{
				
						$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl['subbinid']."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotno='".$row_arr_home['lotno']."' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotdgp_id desc") or die(mysqli_error($link));  
						$row_tbl1=mysqli_fetch_array($sql_tbl1);
	
					
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0 and lotldg_qc!='Fail' and lotldg_got!='Fail' ") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_issuetbl);
						if($t > 0)
						{
							while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
							{ 
								//echo $row_arr_home1['lotldg_crop']." - ".$row_rr['lotldg_variety']." - ".$ups2." - ".$row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
								$cnt++;
								$totqty=$totqty+$row_issuetbl['balqty']; 
								$totnob=$totnob+$row_issuetbl['balnomp']; 
								if($totnob<0) $totnob=0;
								if($totqty<0) $totqty=0;
							}
						}
					}
				}
			}
			if($i>0)
				$upsval=$upsval.",".$totqty;
			else
				$upsval=$totqty;
			$i++;
		}
	}			
if($cnt>0)
{
//$totalqty=$totalqty+$totqty; 
//$totalbags=$totalbags+$totnob;
$data1[$d]=array($d,$crop,$variety);
$upp24=explode(",",$upsval);
for($j=0; $j<$i; $j++)
{
	$upsv24=$upp24[$j];
	$totalqty=$totalqty+$upsv24; 
	array_push($data1[$d],$upsv24);
}
array_push($data1[$d],$totalqty);
$d++;$cnt++;
}
}
}

echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}	