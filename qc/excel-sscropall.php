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
	$txtstage = $_REQUEST['txtstage'];	
	
	$dat=date("d-m-Y");		
	$dh="Crop_Variety_wise_Substandard_Seed_Report".$dat;
	$datahead = array("Crop Variety wise Substandard Seed Report".$dat);
	$filename=$dh.".xls";  
	//$datahead1 = array("Arrival Report",$typ);
	//$datahead2 = array("Item_on_Hold_Report_as_on ".$_REQUEST['sdate']);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$cnt1=1;	
	
	$crp="ALL"; $ver="ALL"; $stage="ALL";
	if($txtstage!="ALL")
	{
		if($txtstage=="Raw")
		{
			$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail')";
			$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_stage='Raw' and salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail')";
		}
		else if($txtstage=="Condition")
		{
			$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail')";
			$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_stage='Condition' and salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail')";
		}
		else if($txtstage=="Pack")
		{
			$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
			$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_stage='Pack' and salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail')";
		}
		else
		{
			$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
			$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
			$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail')";
		}
	}
	else
	{
		$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail')";
	}
	
	if($crop!="ALL")
	{	
		if($txtstage!="ALL")
		{
			if($txtstage!="Pack")
				$qry.=" and lotldg_crop='$crop' ";
			if($txtstage=="Pack")
				$qry2.=" and lotldg_crop='$crop' ";
			
			$qry3.=" and salesrs_crop='$crop' ";	
		}
		else
		{
			$qry.=" and lotldg_crop='$crop' ";
			$qry2.=" and lotldg_crop='$crop' ";
			$qry3.=" and salesrs_crop='$crop' ";
		}
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		if($txtstage!="ALL")
		{
			if($txtstage!="Pack")
				$qry.=" and lotldg_variety='$variety' ";
			if($txtstage=="Pack")
				$qry2.=" and lotldg_variety='$variety' ";
			
			$qry3.=" and salesrs_variety='$crop' ";	
		}
		else
		{
			$qry.=" and lotldg_variety='$variety' ";
			$qry2.=" and lotldg_variety='$variety' ";
			$qry3.=" and salesrs_variety='$crop' ";	
		}
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	$tot_arr_home=0; $tot_arr_home1=0;
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$qry.=" group by lotldg_crop";
			$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
			$tot_arr_home=mysqli_num_rows($sql_arr_home1);
			
			$qry3.=" group by salesrs_crop";
			$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
			$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
		}
		if($txtstage=="Pack")
		{
			$qry2.=" group by lotldg_crop";
			$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
			$tot_arr_home1=mysqli_num_rows($sql_arr_home2);
			
			$qry3.=" group by salesrs_crop";
			$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
			$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
		}
	}
	else
	{
		$qry.=" group by lotldg_crop";
		$qry2.=" group by lotldg_crop";
		$qry3.=" group by salesrs_crop";
		$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
		$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
		$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home1);
		$tot_arr_home1=mysqli_num_rows($sql_arr_home2);
		$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
	}
	
	
	$croparr="";
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
			{
				$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($croparr!="")
				$croparr=$croparr.",".$row312['cropname'];
				else
				$croparr=$row312['cropname'];
			}
			while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
			{
				$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home3['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($croparr!="")
				$croparr=$croparr.",".$row312['cropname'];
				else
				$croparr=$row312['cropname'];
			}
		}
		else
		{
			while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
			{
				$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($croparr!="")
				$croparr=$croparr.",".$row312['cropname'];
				else
				$croparr=$row312['cropname'];
			}
			while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
			{
				$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home3['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($croparr!="")
				$croparr=$croparr.",".$row312['cropname'];
				else
				$croparr=$row312['cropname'];
			}
		}
	}
	else
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
			else
			$croparr=$row312['cropname'];
		}
		while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
			else
			$croparr=$row312['cropname'];
		}
		while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home3['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
			else
			$croparr=$row312['cropname'];
		}
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
	
if($tot_arr_home > 0 || $tot_arr_home1 > 0)
{
$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	

	if($txtstage!="ALL")
	{
		if($txtstage=="Raw")
		{
			$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
			$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_stage='Raw' and salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' ";
		}
		else if($txtstage=="Condition")
		{
			$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
			$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_stage='Condition' and salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' ";
		}
		else if($txtstage=="Pack")
		{
			$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
			$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_stage='Pack' and salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' ";
		}
		else
		{
			$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
			$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
			$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' ";
		}
	}
	else
	{
		$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' ";
	}	

	if($variety!="ALL")
	{	
		if($txtstage!="ALL")
		{
			if($txtstage!="Pack")
			{
				$qry.=" and lotldg_variety='$variety' ";
			}
			else
			{
				$qry2.=" and lotldg_variety='$variety' ";
			}
		}
		else
		{
			$qry.=" and lotldg_variety='$variety' ";
			$qry2.=" and lotldg_variety='$variety' ";
		}
		$qry3.=" and salesrs_variety='$crop' ";			 
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$qry.=" group by lotldg_variety";
			$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
		}
		else
		{
			$qry2.=" group by lotldg_variety";
			$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
		}
		$qry3.=" and salesrs_variety='$crop' ";	
	}
	else
	{
		$qry.=" group by lotldg_variety";
		$qry2.=" group by lotldg_variety";
		$qry3.=" and salesrs_variety='$crop' ";	
		$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
		$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
		$sql_arr_home33=mysqli_query($link,$qry3) or die(mysqli_error($link));
	}	

	$verarr="";
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
			{
				$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($verarr!="")
				$verarr=$verarr.",".$row312['popularname'];
				else
				$verarr=$row312['popularname'];
			}
		}
		else
		{
			while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
			{
				$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($verarr!="")
				$verarr=$verarr.",".$row312['popularname'];
				else
				$verarr=$row312['popularname'];
			}
		}
		while($row_arr_home33=mysqli_fetch_array($sql_arr_home33))
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home33['salesrs_variety']."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
			else
			$verarr=$row312['popularname'];
		}
	}
	else
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
			else
			$verarr=$row312['popularname'];
		}
		while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
			else
			$verarr=$row312['popularname'];
		}
		while($row_arr_home33=mysqli_fetch_array($sql_arr_home33))
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home33['salesrs_variety']."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
			else
			$verarr=$row312['popularname'];
		}
	}
	
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."'  order by popularname asc") or die(mysqli_error($link));
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
	
	$ccnt=0;

	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage'  group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  order by lotldg_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
							$ccnt++;
					}
				}
			}
		}
		else
		{
			$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
			
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  order by lotdgp_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty>0 order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
							$ccnt++;
					}
				}
			}
		}
		
		$sql_istbl=mysqli_query($link,"select * from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' and salesrs_variety='".$verval."'  order by salesrs_id asc") or die(mysqli_error($link)); 
		$t=mysqli_num_rows($sql_istbl);
		if($t > 0)
		{
				$ccnt++;
		}
	}
	else
	{
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_lotno='".$row_arhome['lotldg_lotno']."'  order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					$ccnt++;
				}
			}
		}
			//echo $ccnt;
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty>0 order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					$ccnt++;
				}
			}
		}
		
		$sql_istbl=mysqli_query($link,"select * from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' and salesrs_variety='".$verval."'  order by salesrs_id asc") or die(mysqli_error($link)); 
		$t=mysqli_num_rows($sql_istbl);
		if($t > 0)
		{
				$ccnt++;
		}
	}

if($ccnt>0)	
{
	$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$verty=$row_var['popularname'];
	$srno=0; $totalbags=0; $totalqty=0;	
// 		Table code for crop & variety wise lot numbers
 $d=1;
	
	$datahead1[$cnt1] = array("Crop:$crop1     Variety:$verty");
	$datahead2[$cnt1] = array("#","Lot No.","Stage","NoB","Qty","SLOC","Qc Status","Moisture %","Germination %","DOT","GOT Status","Genetic Purity %","DOGR","Seed Status"); 
	
	
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$lotn=$row_arr_home['lotldg_lotno'];
				$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
				$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
				$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$txtdot=""; 
				
					$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' order by lotldg_id asc ") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
				
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							//echo $row_issuetbl['lotldg_id']."<BR>";
							$cnt++;
							$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
							$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
							
							$stage=$row_issuetbl['lotldg_sstage']; 
							$totqc=$row_issuetbl['lotldg_qc']; 
							$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
							$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
							$totmost=$row_issuetbl['lotldg_moisture']; 
							$totgemp=$row_issuetbl['lotldg_gemp']; 
							$genpp=$row_issuetbl['lotldg_genpurity']; 
							$totsst=$row_issuetbl['lotldg_sstatus']; 
							if($row_issuetbl['lotldg_srflg'] > 0)
							{
								if($totsst!="")$totsst=$totsst."/"."S";
								else
								$totsst="S";
							}
							if($txtdot=="")
							{
							$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
							$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
							}
							
							if($dogr=="")
							{
							$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
							$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
							}
							
							if($txtdot=="00-00-0000" || $txtdot=="--")
							$txtdot="";
							
							if($dogr=="00-00-0000" || $dogr=="--")
							$dogr="";
							if($totgemp==0 || $totgemp=="") $totgemp="";
							
							if($genpp=="0.00" || $genpp=="NULL")$genpp="";
						
						
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_subbinn=mysqli_fetch_array($sql_subbinn);
							$subbinn=$row_subbinn['sname'];
						
							$slups=$row_issuetbl['lotldg_balbags'];
							$slqty=$row_issuetbl['lotldg_balqty'];
							$aq1=explode(".",$slups);
							if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
						
							$an1=explode(".",$slqty);
							if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
							$slups=$ac1;
							$slqty=$acn1;
							if($sloc!="")
							$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
							else
							$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
						}
					}
				}
				if($cnt>0)
				{
					$srno++;
					$totalqty=$totalqty+$totqty; 
					$totalbags=$totalbags+$totnob;
					if($totqc=="UT")$txtdot="";
					$totalbags=0; $totalqty=0;
		
					$data1[$cnt1][$d]=array($d,$lotn,$stage,$totnob,$totqty,$sloc,$totqc,$totmost,$totgemp,$txtdot,$totgot,$genpp,$dogr,$totsst);
					$d++;
				}
			}
		}
		else
		{
			$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$lotn=$row_arr_home['lotno'];
				$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
				$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
				$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$txtdot=""; 
					
					$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
					
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							//echo $row_issuetbl['lotldg_id']."<BR>";
							$cnt++;
							$totqty=$totqty+$row_issuetbl['balqty']; 
							//$totnob=$totnob+$row_issuetbl['balbags']; 
							
							$stage="Pack"; 
							$totqc=$row_issuetbl['lotldg_qc']; 
							$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
							$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
							$totmost=$row_issuetbl['lotldg_moisture']; 
							$totgemp=$row_issuetbl['lotldg_gemp']; 
							$genpp=$row_issuetbl['lotldg_genpurity']; 
							$totsst=$row_issuetbl['lotldg_sstatus']; 
							if($row_issuetbl['lotldg_srflg'] > 0)
							{
								if($totsst!="")$totsst=$totsst."/"."S";
								else
								$totsst="S";
							}
							if($txtdot=="")
							{
								$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
								$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
							}
							
							if($dogr=="")
							{
								$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
								$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
							}
							
							if($txtdot=="00-00-0000" || $txtdot=="--")
							$txtdot="";
							
							if($dogr=="00-00-0000" || $dogr=="--")$dogr="";
							
							if($totgemp==0 || $totgemp=="") $totgemp="";
							
							if($genpp=="0.00" || $genpp=="NULL")$genpp="";
						
						
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
							$row_subbinn=mysqli_fetch_array($sql_subbinn);
							$subbinn=$row_subbinn['sname'];
							
							//$slups=$row_issuetbl['lotldg_balbags'];
							$slqty=$row_issuetbl['balqty'];
							//$aq1=explode(".",$slups);
							//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
							
							$an1=explode(".",$slqty);
							if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
							//$slups=$ac1;
							$slqty=$acn1;
							if($sloc!="")
								$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
							else
								$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
						}
					}
				}
				if($cnt>0)
				{
					$srno++;
					$totalqty=$totalqty+$totqty; 
					$totalbags=$totalbags+$totnob;
					if($totqc=="UT")$txtdot="";
					$data1[$cnt1][$d]=array($d,$lotn,$stage,$totnob,$totqty,$sloc,$totqc,$totmost,$totgemp,$txtdot,$totgot,$genpp,$dogr,$totsst);
					$d++;
				}
			}
		}
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$lotn=$row_arr_home['lotldg_lotno'];
			$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
			$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
			$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$txtdot=""; 
					
				$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotldg_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						//echo $row_issuetbl['lotldg_id']."<BR>";
						$cnt++;
						$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
						$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
							
						$stage=$row_issuetbl['lotldg_sstage']; 
						$totqc=$row_issuetbl['lotldg_qc']; 
						$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
						$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
						$totmost=$row_issuetbl['lotldg_moisture']; 
						$totgemp=$row_issuetbl['lotldg_gemp']; 
						$genpp=$row_issuetbl['lotldg_genpurity']; 
						$totsst=$row_issuetbl['lotldg_sstatus']; 
						if($row_issuetbl['lotldg_srflg'] > 0)
						{
							if($totsst!="")$totsst=$totsst."/"."S";
							else
							$totsst="S";
						}
						if($txtdot=="")
						{
							$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
							$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
						}
								
						if($dogr=="")
						{
							$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
							$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
						}
								
						if($txtdot=="00-00-0000" || $txtdot=="--")
							$txtdot="";
								
						if($dogr=="00-00-0000" || $dogr=="--")
							$dogr="";
						if($totgemp==0 || $totgemp=="") $totgemp="";
								
						if($genpp=="0.00" || $genpp=="NULL")$genpp="";
							
							
						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
								
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
								
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
							
						$slups=$row_issuetbl['lotldg_balbags'];
						$slqty=$row_issuetbl['lotldg_balqty'];
						$aq1=explode(".",$slups);
						if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
							
						$an1=explode(".",$slqty);
						if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
						$slups=$ac1;
						$slqty=$acn1;
						if($sloc!="")
							$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
						else
							$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
					}
				}
			}
			if($cnt>0)
			{
				$srno++;
				$totalqty=$totalqty+$totqty; 
				$totalbags=$totalbags+$totnob;
				if($totqc=="UT")$txtdot="";		
				$data1[$cnt1][$d]=array($d,$lotn,$stage,$totnob,$totqty,$sloc,$totqc,$totmost,$totgemp,$txtdot,$totgot,$genpp,$dogr,$totsst);
				$d++;
			}
		}
		
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$lotn=$row_arr_home['lotno'];
			$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
			$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
			$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$txtdot=""; 
					
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						//echo $row_issuetbl['lotldg_id']."<BR>";
						$cnt++;
						$totqty=$totqty+$row_issuetbl['balqty']; 
						//$totnob=$totnob+$row_issuetbl['balbags']; 
						
						$stage="Pack"; 
						$totqc=$row_issuetbl['lotldg_qc']; 
						$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
						$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
						$totmost=$row_issuetbl['lotldg_moisture']; 
						$totgemp=$row_issuetbl['lotldg_gemp']; 
						$genpp=$row_issuetbl['lotldg_genpurity']; 
						$totsst=$row_issuetbl['lotldg_sstatus']; 
						if($row_issuetbl['lotldg_srflg'] > 0)
						{
							if($totsst!="")$totsst=$totsst."/"."S";
							else
							$totsst="S";
						}
						if($txtdot=="")
						{
							$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
							$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
						}
							
						if($dogr=="")
						{
							$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
							$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
						}
							
						if($txtdot=="00-00-0000" || $txtdot=="--")
						$txtdot="";
							
						if($dogr=="00-00-0000" || $dogr=="--")$dogr="";
							
						if($totgemp==0 || $totgemp=="") $totgemp="";
							
						if($genpp=="0.00" || $genpp=="NULL")$genpp="";
						
						
						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
							
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
							
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
							
						//$slups=$row_issuetbl['lotldg_balbags'];
						$slqty=$row_issuetbl['balqty'];
						//$aq1=explode(".",$slups);
						//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
							
						$an1=explode(".",$slqty);
						if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
						//$slups=$ac1;
						$slqty=$acn1;
						if($sloc!="")
							$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
						else
							$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
					}
	
				}
			}
			if($cnt>0)
			{
				$totalqty=$totalqty+$totqty; 
				$totalbags=$totalbags+$totnob;
				if($totqc=="UT")$txtdot="";		
				$data1[$cnt1][$d]=array($d,$lotn,$stage,$totnob,$totqty,$sloc,$totqc,$totmost,$totgemp,$txtdot,$totgot,$genpp,$dogr,$totsst);
				$d++;
			}
		}
	}
	
$sql_issuetbl=mysqli_query($link,"select * from tbl_salesrv_sub where salesr_id!=0 and (salesrs_qc='Fail' OR salesrs_got1='Fail') and salesrs_crop='".$crval."' and salesrs_variety='".$verval."'  order by salesrs_id asc") or die(mysqli_error($link)); 
$t=mysqli_num_rows($sql_issuetbl);
if($t > 0)
{
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{ 
		$balqtyflg=0;
		
		$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0; $cnt=0; $totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage=""; $balqtyflg=0; $availflg=0; $balqtypackflg=0; $balqtyconflg=0;
		//echo $row_issuetbl['lotldg_id']."<BR>";
		$cnt++;
		$totqty=$totqty+$row_issuetbl['salesrs_qtydc']; 
		//$totnob=$totnob+$row_issuetbl['balbags']; 
		
		$stage="SR"; 
		$totqc=$row_issuetbl['salesrs_qc']; 
		$tgot=explode(" ", $row_issuetbl['salesrs_got']); 
		$totgot=$tgot[0]." ".$row_issuetbl['salesrs_got1'];
		$totmost=''; 
		$totgemp=''; 
		$genpp=''; 
		$totsst=''; 
		$lotn=$row_issuetbl['salesrs_newlot'];
		if($txtdot=="")
		{
			$rdate=explode("-",$row_issuetbl['salesrs_dot']);
			$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
		}
			
		if($dogr=="")
		{
			$rdate=explode("-",$row_issuetbl['salesrs_dogt']);
			$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
		}
			
		if($txtdot=="00-00-0000" || $txtdot=="--")
		$txtdot="";
			
		if($dogr=="00-00-0000" || $dogr=="--")$dogr="";
			
		if($totgemp==0 || $totgemp=="") $totgemp="";
			
		if($genpp=="0.00" || $genpp=="NULL")$genpp="";
		
		
		$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where whid='".$row_issuetbl['salesrs_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		if($row_whouse['perticulars']!="")$wareh=$row_whouse['perticulars']."/"; else $wareh='';
			
		$sql_binn=mysqli_query($link,"select binname from tblsrbin where binid='".$row_issuetbl['salesrs_bin']."' and whid='".$row_issuetbl['salesrs_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		if($row_binn['binname']="")$binn=$row_binn['binname']."/"; else $binn='';
			
		
		$subbinn='';
			
		//$slups=$row_issuetbl['lotldg_balbags'];
		$slqty=$row_issuetbl['salesrs_qtydc'];
		//$aq1=explode(".",$slups);
		//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
			
		$an1=explode(".",$slqty);
		if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
		//$slups=$ac1;
		$slqty=$acn1;
		if($sloc!="")
			$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
		else
			$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
			//}
		//}
				//}
		$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_issuetbl['salesrs_newlot']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		$t1=mysqli_num_rows($sql_issue);
		if($t1 > 0)
		{	$availflg++;
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_issuetbl['salesrs_newlot']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
					
				$sql_issuetbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t3=mysqli_num_rows($sql_issuetbl2);
				if($t3 > 0)
				{
					$balqtyflg++;
				}
			}
		}
		
		$sql_issue2=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_issuetbl['salesrs_newlot']."' and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));	
		$t1=mysqli_num_rows($sql_issue2);
		if($t1 > 0)
		{	$availflg++;
			while($row_issue2=mysqli_fetch_array($sql_issue2))
			{ 
				$sql_issue12=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue2['lotldg_subbinid']."' and lotldg_binid='".$row_issue2['lotldg_binid']."' and lotldg_whid='".$row_issue2['lotldg_whid']."' and lotldg_lotno='".$row_issuetbl['salesrs_newlot']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotldg_id asc ") or die(mysqli_error($link));
				$row_issue12=mysqli_fetch_array($sql_issue12); 
					
				$sql_issuetbl3=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue12[0]."' and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotldg_id asc") or die(mysqli_error($link)); 
				$t3=mysqli_num_rows($sql_issuetbl3);
				if($t3 > 0)
				{
					$balqtyflg++;
				}
			}
		}
			
				
		if($balqtyflg==0 && $slqty>0)$balqtyflg=1;
		//echo $cnt;
		if($cnt>0 && $balqtyflg>0)
		{
		$srno++;
		$totalqty=$totalqty+$totqty; 
		$totalbags=$totalbags+$totnob;
		if($totqc=="UT")$txtdot="";
		$data1[$cnt1][$d]=array($d,$lotn,$stage,$totnob,$totqty,$sloc,$totqc,$totmost,$totgemp,$txtdot,$totgot,$genpp,$dogr,$totsst);
		$d++;
		}
	}
}				
	$datahead3[$cnt1] = array("","","Total",$totalbags,$totalqty,"","","","","","","","",""); 
	//}
	//}
	$cnt1++;
	}
	}
	}
	}
	}
	}
echo $cnt1;
echo implode($datahead) ;
echo "\n";
for($i=1; $i<$cnt1; $i++)
{
	echo implode($datahead1[$i]) ;
	echo "\n";
	echo implode("\t", $datahead2[$i]) ;
	echo "\n";
 foreach($data1[$i] as $row1)
 { 
	echo implode("\t", array_values($row1))."\n"; 
 }
 	echo implode("\t", $datahead3[$i]) ;
	echo "\n";
}
	