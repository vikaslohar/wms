<?php
	ob_start();session_start();
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
	
	date_default_timezone_set("Asia/Calcutta");
		
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$slchk = $_REQUEST['slchk'];
	$slchk2 = $_REQUEST['slchk2'];
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and plantcode='$plantcode'";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and plantcode='$plantcode'";
	$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_rettype='P2P' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$qry2.=" and lotldg_crop='$crop' ";
		$qry3.=" and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'  ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop";
	$qry2.=" group by lotldg_crop";
	$qry3.=" group by salesrs_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
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
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home23['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
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
	$dat=date("d-m-Y h:i:s A");
	
	$dh="Quality_based_Stock_Report As on -  ".$dat;
	$datahead = array("Quality based Stock Report As on - ".$dat);
	$filename=$dh.".xls";  
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$d=1;
	$datahead1= array("Crop:$crp     Variety:$ver");
	$datahead4= array("OK and UT Qty includes both Germination and GOT based seed stocks");
	
	$datahead3= array('','','','OK Qty','BL Qty','UT Qty','Total Qty','OK Qty','BL Qty','UT Qty','Total Qty');
$datahead2= array('#','Crop','Veriety','Raw Seed','','','Condition Seed','','','Pack Seed');
$upsizes=""; $upsids=""; $bsps=""; $i=0;
	$sql_ups=mysqli_query($link,"Select * from tblups") or die(mysqli_error($link));
	$tot_ups=mysqli_num_rows($sql_ups);
	while($row_ups=mysqli_fetch_array($sql_ups))
	{
		$i++;
		$ups=$row_ups['ups']." ".$row_ups['wt'];
		
		array_push($datahead3,$ups);
		array_push($datahead2,'');
		if($upsizes!="")
			$upsizes=$upsizes.",".$ups;
		else
			$upsizes=$ups;
		if($upsids!="")
			$upsids=$upsids.",".$row_ups['uid'];
		else
			$upsids=$row_ups['uid'];
		
		$uid='$upsid'.$i;	
		if($bsps!="")
			$bsps=$bsps.",".$uid;
		else
			$bsps=$uid;	
	}
array_push($datahead2,'','','Sales Return Seed','','','Grand Total'); 
array_push($datahead3,'OK Qty','BL Qty','UT Qty','Total Qty','OK Qty','BL Qty','UT Qty','Total Qty','OK Qty','BL Qty','UT Qty','Total Qty'); 

$crps=explode(",",$crop2);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$stage="Raw";
	$stage1="Condition";
	$stage2="Pack";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and plantcode='$plantcode'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and plantcode='$plantcode'";
	$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_crop='".$crval."' and plantcode='$plantcode'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_variety";
	$qry2.=" group by lotldg_variety";
	$qry3.=" group by salesrs_variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."' and actstatus='Active'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['salesrs_variety']."' order by popularname asc") or die(mysqli_error($link));
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
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' and actstatus='Active'  order by popularname asc") or die(mysqli_error($link));
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
		
		$totrnob=0; $totrqty=0; $totcnob=0; $totcqty=0; $totpnob=0; $totpnomp=0; $totpqty=0; $ccnt=0; $tqty=0; $totsrqty=0; $totrqok=0; $totrqut=0;  
		$totcqok=0; $totcqut=0; $totpqok=0; $totpqut=0; $totsrqok=0; $totsrqut=0; $totqok=0; $totqut=0; $totrqbl=0; $totcqbl=0; $totpqbl=0; $totqbl=0; $totsrqbl=0;
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' and actstatus='Active'  ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$verty=$row_var['popularname'];
	 	
		// Raw Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
						{
							$totrqty=$totrqty+$qt; 
							$totrnob=$totrnob+$row_issuetbl['lotldg_balbags']; 
							
							if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_got']=="BL" )
							{
								$totrqbl=$totrqbl+$qt;  
							}
							else if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
							{
								$totrqut=$totrqut+$qt;  
							}
							else{}
							$ccnt++;
						}
					}	
				}
			}
		}
		if($totrqty < 0)$totrqty=0;
		$totrqok=round(($totrqty-($totrqut+$totrqbl)),3);
		if($totrqok < 0)$totrqok=0;
		if($totrqut < 0)$totrqut=0;
		
		// Condition Seed Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_sstage='$stage1' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_sstage='$stage1' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
						{
							$totcqty=$totcqty+$qt; 
							$totcnob=$totcnob+$row_issuetbl['lotldg_balbags']; 
							
							if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_got']=="BL" )
							{
								$totcqbl=$totcqbl+$qt;  
							}
							else if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
							{
								$totcqut=$totcqut+$qt;  
							}
							else{}
							$ccnt++;
						}
					}	
				}
			}
		}
		if($totcqty < 0)$totcqty=0;
		$totcqok=round(($totcqty-($totcqut+$totcqbl)),3);
		if($totcqok < 0)$totcqok=0;
		if($totcqut < 0)$totcqut=0;
		
		// Pack Seed Records
		$upsizes;
		$up=explode(",",$upsizes);
		$ui=explode(",",$bsps);
		$ct=count($up);
		for($i=0; $i<$ct; $i++)
		{
			$totl=0;
			$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and packtype='".$up[$i]."' and plantcode='$plantcode' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
			$totarhome=mysqli_num_rows($sql_arhome);
			if($totarhome > 0)
			{
				while($row_arhome=mysqli_fetch_array($sql_arhome))
				{  
					$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and packtype='".$up[$i]."' and plantcode='$plantcode' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
					while($row_is=mysqli_fetch_array($sql_is))
					{ 
						$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and packtype='".$up[$i]."' and plantcode='$plantcode' order by lotdgp_id desc ") or die(mysqli_error($link));
						$row_is1=mysqli_fetch_array($sql_is1); 
						$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						if($t > 0)
						{
							while($row_issuetbl=mysqli_fetch_array($sql_istbl))
							{ 
								$qt=$row_issuetbl['balqty']; 
								if($qt<0)$qt=0;
								if($row_issuetbl['lotldg_qc']!="Fail" && $row_issuetbl['lotldg_got']!="Fail")
								{
									$totpqty=$totpqty+$qt; 
									$totpnob=$totpnob+$row_issuetbl['balnop']; 
									$totl=$totl+$qt; 
									if($row_issuetbl['lotldg_qc']=="BL" || $row_issuetbl['lotldg_got']=="BL" )
									{
										$totpqbl=$totpqbl+$qt;  
									}
									else if($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT" || $row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
									{
										$totpqut=$totpqut+$qt;  
									}
									else{}
									$ccnt++;
								}
							}	
						}
					}
					
				}
				$ui[$i]=$totl; 
			}
			else
			{
				$ui[$i]=""; 
			}
		}
		if($totpqty < 0)$totpqty=0;
		$totpqok=round(($totpqty-($totpqut+$totpqbl)),3);
		if($totpqok < 0)$totpqok=0;
		if($totpqut < 0)$totpqut=0;
		
		// Sales Return Seed Records
		$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and plantcode='$plantcode' order by 'salesrs_id'asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_issuetbl['salesrss_qty']; 
					if($qt<0)$qt=0;
					if($row_arhome['salesrs_qc']!="Fail" && $row_arhome['salesrs_got1']!="Fail")
					{
						if($qt<0)$qt=0;
						
						if($qt>0)
						{
							$tot_p2c=0; $tot_srrv=0;
							$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_srrv=mysqli_num_rows($sq_srrv);
							
							$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_p2c=mysqli_num_rows($sq_p2c);
							
							if($tot_p2c>0){}
							else if($tot_srrv > 0){}
							else
							{
								if($row_arhome['salesrs_qc']=="BL"|| $row_arhome['salesrs_got1']=="BL" )
								{
									$totsrqbl=$totsrqbl+$qt;  
									$totsrqty=$totsrqty+$qt; 
								}
								else if($row_arhome['salesrs_qc']=="UT" || $row_arhome['salesrs_qc']=="RT" || $row_arhome['salesrs_got1']=="UT" || $row_arhome['salesrs_got1']=="RT")
								{
									$totsrqut=$totsrqut+$qt;  
									$totsrqty=$totsrqty+$qt; 
								}
								else{}
								
								$ccnt++;
							}
						}
						
						/*if($row_arhome['salesrs_qc']=="OK" || $row_arhome['salesrs_qc']==" " || $row_arhome['salesrs_got1']=="OK" || $row_arhome['salesrs_got1']=="NUT" || $row_arhome['salesrs_got1']==" " || $row_arhome['salesrs_got1']=="" || $row_arhome['salesrs_got1']=="NULL")
						{
							$sql_is2=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['salesrs_newlot']."' and lotldg_variety='".$verval."' and trstage='$stage2' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
							while($row_is2=mysqli_fetch_array($sql_is2))
							{ 
								$sql_is12=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is2['subbinid']."' and binid='".$row_is2['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['salesrs_newlot']."' and trstage='$stage2' order by lotdgp_id desc ") or die(mysqli_error($link));
								$row_is12=mysqli_fetch_array($sql_is12); 
								$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is12[0]."' order by lotdgp_id asc") or die(mysqli_error($link)); 
								$t2=mysqli_num_rows($sql_istbl2);
								if($t2 == 0)
								{
									$totsrqok=$totsrqok+$row_issuetbl['salesrss_qty'];  
								}
							}	
						}
						if($row_arhome['salesrs_qc']=="UT" || $row_arhome['salesrs_qc']=="RT" || $row_arhome['salesrs_got1']=="UT" || $row_arhome['salesrs_got1']=="RT")
						{
							$totsrqut=$totsrqut+$qt;  
						}
						$ccnt++;*/
					}
				}	
			}
		}
		if($totsrqty < 0)$totsrqty=0;
		$totsrqok=round(($totsrqty-($totsrqut+$totsrqbl)),3);
		if($totsrqok < 0)$totsrqok=0;
		if($totsrqut < 0)$totsrqut=0;
		
if($ccnt > 0)
{
$tqty=$tqty+$totrqty+$totcqty+$totpqty+$totsrqty;
$totqok=$totqok+$totrqok+$totcqok+$totpqok+$totsrqok;
$totqbl=$totqbl+$totrqbl+$totcqbl+$totpqbl+$totsrqbl;
$totqut=$totqut+$totrqut+$totcqut+$totpqut+$totsrqut;

$data1[$d]=array($d,$crop1,$verty,$totrqok,$totrqbl,$totrqut,$totrqty,$totcqok,$totcqbl,$totcqut,$totcqty);
foreach($ui as $uidd)
{
array_push($data1[$d],$uidd);
}
array_push($data1[$d],$totpqok,$totpqbl,$totpqut,$totpqty,$totsrqok,$totsrqbl,$totsrqut,$totsrqty,$totqok,$totqut,$tqty); 

$d++;
}
}
}
}
}

echo implode($datahead) ;
echo "\n";
echo implode($datahead1) ;
echo "\n";
echo implode($datahead4) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}
