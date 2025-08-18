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
	$txtupsdc = $_REQUEST['txtupsdc'];
  
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL"; $locname="ALL"; $partyname="ALL"; $totnqty=0; $totnomp=0;
	
	
	$nqry="select Distinct disp_dodc from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$sdt' and disp_dodc<='$edt' order by disp_dodc asc";
	$nqry2="select Distinct dbulk_date from tbl_dbulk where plantcode='".$plantcode."' and dbulk_date>='$sdt' and dbulk_date<='$edt' order by dbulk_date asc";
	$nqry3="select Distinct pswrem_date from tbl_pswrem where plantcode='".$plantcode."' and pswrem_date>='$sdt' and pswrem_date<='$edt' order by pswrem_date asc";
	$nqry4="select Distinct dtdf_date from tbl_dtdf where plantcode='".$plantcode."' and dtdf_date>='$sdt' and dtdf_date<='$edt' order by dtdf_date asc";
	//$qry5="select Distinct tid from tbl_discard where tdate>='$sdt' and tdate<='$edt' order by tdate asc";

	$sql_narr_home1=mysqli_query($link,$nqry) or die(mysqli_error($link));
	$sql_narr_home2=mysqli_query($link,$nqry2) or die(mysqli_error($link));
	$sql_narr_home3=mysqli_query($link,$nqry3) or die(mysqli_error($link));
	$sql_narr_home4=mysqli_query($link,$nqry4) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$ndt="";
	while($row_narr_home12=mysqli_fetch_array($sql_narr_home1))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home12['disp_dodc']; else $ndt=$row_narr_home12['disp_dodc'];
	}
	while($row_narr_home22=mysqli_fetch_array($sql_narr_home2))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home22['dbulk_date']; else $ndt=$row_narr_home22['dbulk_date'];
	}
	while($row_narr_home23=mysqli_fetch_array($sql_narr_home3))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home23['pswrem_date']; else $ndt=$row_narr_home23['pswrem_date'];
	}
	while($row_narr_home24=mysqli_fetch_array($sql_narr_home4))
	{
		if($ndt!="") $ndt=$ndt.",".$row_narr_home24['dtdf_date']; else $ndt=$row_narr_home24['dtdf_date'];
	}
	
	$ndt1=explode(",",$ndt);
	$ndt1=array_unique($ndt1);
	sort($ndt1);
	$ndt=$ndt1;
	
	
	
	
	$qry="select Distinct disp_id from tbl_disp where plantcode='".$plantcode."' and disp_dodc>='$sdt' and disp_dodc<='$edt' order by disp_dodc asc";
	$qry2="select Distinct dbulk_id from tbl_dbulk where plantcode='".$plantcode."' and dbulk_date>='$sdt' and dbulk_date<='$edt' order by dbulk_date asc";
	$qry3="select Distinct pswrem_id from tbl_pswrem where plantcode='".$plantcode."' and pswrem_date>='$sdt' and pswrem_date<='$edt' order by pswrem_date asc";
	$qry4="select Distinct dtdf_id from tbl_dtdf where plantcode='".$plantcode."' and dtdf_date>='$sdt' and dtdf_date<='$edt' order by dtdf_date asc";
	//$qry5="select Distinct tid from tbl_discard where tdate>='$sdt' and tdate<='$edt' order by tdate asc";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home4=mysqli_query($link,$qry4) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$id1="";$id2="";$id3="";$id4="";//$id5="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		if($id1!="") $id1=$id1.",".$row_arr_home12['disp_id']; else $id1=$row_arr_home12['disp_id'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		if($id2!="") $id2=$id2.",".$row_arr_home22['dbulk_id']; else $id2=$row_arr_home22['dbulk_id'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		if($id3!="") $id3=$id3.",".$row_arr_home23['pswrem_id']; else $id3=$row_arr_home23['pswrem_id'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home4))
	{
		if($id4!="") $id4=$id4.",".$row_arr_home24['dtdf_id']; else $id4=$row_arr_home24['dtdf_id'];
	}
	
	/*while($row_arr_home25=mysqli_fetch_array($sql_arr_home5))
	{
		if($id5!="") $id5=$id5.",".$row_arr_home25['tid']; else $row_arr_home25=$row312['tid'];
	}*/
	
	$id11=explode(",",$id1);
	$id11=array_unique($id11);
	sort($id11);
	$id11=implode(",",$id11);
	
	$id21=explode(",",$id2);
	$id21=array_unique($id21);
	sort($id21);
	$id21=implode(",",$id21);
	
	$id31=explode(",",$id3);
	$id31=array_unique($id31);
	sort($id31);
	$id31=implode(",",$id31);
	
	$id41=explode(",",$id4);
	$id41=array_unique($id41);
	sort($id41);
	$id41=implode(",",$id41);
	
	/*$id51=explode(",",$id5);
	$id51=array_unique($id51);
	sort($id51);
	$id51=implode(",",$id51);*/
	
	if($id11!="")
		$qry="select Distinct disps_crop from tbl_disp_sub where plantcode='".$plantcode."' and disp_id IN ($id11) ";
	else
		$qry="select Distinct disps_crop from tbl_disp_sub where plantcode='".$plantcode."' and disp_id!=0 ";
	if($id21!="")
		$qry2="select Distinct dbulks_crop from tbl_dbulk_sub where plantcode='".$plantcode."' and dbulk_id IN ($id21) ";
	else
		$qry2="select Distinct dbulks_crop from tbl_dbulk_sub where plantcode='".$plantcode."' and dbulk_id!=0 ";
	if($id31!="")
		$qry3="select Distinct crop from tbl_pswrem_sub where plantcode='".$plantcode."' and pswrem_id IN ($id31) ";
	else
		$qry3="select Distinct crop from tbl_pswrem_sub where plantcode='".$plantcode."' and pswrem_id!=0 ";
	if($id41!="")
		$qry4="select Distinct dtdfs_crop from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdf_id IN($id41) ";
	else
		$qry4="select Distinct dtdfs_crop from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdf_id!=0 ";
	/*if($id51!="")
		$qry5="select Distinct crop from tbl_discard_sub where tid IN($id51) ";
	else
		$qry5="select Distinct crop from tbl_discard_sub where did!=0 ";*/
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.=" and disps_crop='$crp' ";
		$qry2.=" and dbulks_crop='$crp' ";
		$qry3.=" and crop='$crop' ";
		$qry4.=" and dtdfs_crop='$crp' ";
		//$qry5.=" and crop='$crop' ";
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
		$qry2.=" and dbulks_variety='$ver' ";
		$qry3.=" and variety='$variety' ";
		$qry4.=" and dtdfs_variety='$ver' ";
		//$qry5.=" and variety='$variety' ";
	}
	
	$qry.=" group by disps_crop";
	$qry2.=" group by dbulks_crop";
	$qry3.=" group by crop";
	$qry4.=" group by dtdfs_crop";
	//$qry5.=" group by crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home4=mysqli_query($link,$qry4) or die(mysqli_error($link));
	//$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home12['disps_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home22['dbulks_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home23['crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home4))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_home24['dtdfs_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}
	
	/*while($row_arr_home25=mysqli_fetch_array($sql_arr_home5))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home25['crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
		else
			$croparr=$row312['cropname'];
	}*/
	
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

	
	$dh="Consolidated_Crop_Variety_Wise_Dispatch_Report_Period_From_".$sdate."_To_".$edate;
	$datahead = array("Consolidated Crop Variety Wise Dispatch Report");
	$filename=$dh.".xls";  
	$datahead1 = array("Period From ",$sdate," To ",$edate);
	$datahead2 = array("Crop",$crp,"Variety",$ver,"UPS",$txtupsdc);
	$data1 = array();
	header("Content-Disposition: attachment; filename=$filename"); 
	header("Content-Type: application/vnd.ms-excel");

	$cnt=0;
	$datahead3= array("#","Dispatch Date","Crop","Production Variety","Variety","Variety Type","UPS","Qty");
	
	
$d=1;
foreach($ndt as $ndts)
{
if($ndts<>"")
{
 
$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$crop1=""; 
	$stage="Raw";
	$stage1="Condition";
	$stage2="Pack";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	
	
	if($id11!="")
		$qry="select Distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and disps_crop='".$crop1."' and disp_id IN ($id11) ";
	else
		$qry="select Distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and disps_crop='".$crop1."' ";
	if($id21!="")
		$qry2="select Distinct dbulks_variety from tbl_dbulk_sub where plantcode='".$plantcode."' and dbulks_crop='".$crop1."' and dbulk_id IN ($id21) ";
	else
		$qry2="select Distinct dbulks_variety from tbl_dbulk_sub where plantcode='".$plantcode."' and dbulks_crop='".$crop1."' ";
	if($id31!="")
		$qry3="select Distinct variety from tbl_pswrem_sub where plantcode='".$plantcode."' and crop='".$crval."' and pswrem_id IN ($id31) ";
	else
		$qry3="select Distinct variety from tbl_pswrem_sub where plantcode='".$plantcode."' and crop='".$crval."'  ";
	if($id41!="")
		$qry4="select Distinct dtdfs_variety from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='".$crop1."' and dtdf_id IN ($id41) ";
	else
		$qry4="select Distinct dtdfs_variety from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='".$crop1."'  ";
	/*if($id51!="")
		$qry5="select Distinct variety from tbl_discard_sub where crop='".$crval."' and  tid IN ($id51) ";
	else
		$qry5="select Distinct variety from tbl_discard_sub where crop='".$crval."' ";*/
	
	
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
		$qry2.=" and dbulks_variety='$ver' ";
		$qry3.=" and variety='$variety' ";
		$qry4.=" and dtdfs_variety='$ver' ";
	//	$qry5.=" and variety='$variety' ";
	}
	
	$qry.=" group by disps_variety";
	$qry2.=" group by dbulks_variety";
	$qry3.=" group by variety";
	$qry4.=" group by dtdfs_variety";
	//$qry5.=" group by variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home24=mysqli_query($link,$qry4) or die(mysqli_error($link));
//	$sql_arr_home25=mysqli_query($link,$qry5) or die(mysqli_error($link));
//echo $tret=mysqli_num_rows($sql_arr_home12);
	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home12['disps_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home22['dbulks_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home24['dtdfs_variety']."'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}
	
	/*while($row_arr_home25=mysqli_fetch_array($sql_arr_home25))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home25['variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
		else
			$verarr=$row312['popularname'];
	}*/
	
	$ver2="";
	$cp2=explode(",",$verarr);
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
	//echo $variety;
	$cvcod=$crop1."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
		$ver2=$ver2.",".$cvcod;
	//echo $ver2;
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$vtyp="OP"; $cirec=0; $pvvername=''; $up='';
		$sql_var23=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."'") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var23);
		if($vtot>0)
		{
			$row_var23=mysqli_fetch_array($sql_var23);
			$verty=$row_var23['popularname'];
			$vtyp=$row_var23['vt'];
			$up=$row_var23['gm'];
			if($vtyp=="Hybrid")$vtyp="Hybrid";
			if($row_var23['vertype']!='PV')
			{
				if($row_var23['pvverid']>0)
				{
					$sq_vr=mysqli_query($link,"select * from tblvariety where varietyid ='".$row_var23['pvverid']."'") or die(mysqli_error($link));
					$row_vr=mysqli_fetch_array($sq_vr);
					$pvvername=$row_vr['popularname'];
				}
				else
				{
					$pvvername=$verty;
				}
			}
			else
			{
				$pvvername=$verty;
			}
		}
		else
		{
			$verty=$verval;
			$pvvername=$verty;
			$vtyp="";
		}
		$xupout=0;//echo $up."  -=-  ";
		if($txtupsdc!="ALL")
		{
			$ups2=explode(" ",$txtupsdc);
			$ups3=explode(".",$ups2[0]);
			if($ups3[1]>0 || $ups3[1]!="000")$upsz=$ups3[0].".".$ups3[1];
			else
			$upsz=$ups3[0].".000";
			$sql_ups=mysqli_query($link,"select * from tblups where ups='$upsz' and wt='".$ups2[1]."'") or die(mysqli_error($link));
			$row_ups=mysqli_fetch_array($sql_ups);
			$xupout=$row_ups['uid'];
			$xupout=explode(",",$xupout);
			//echo "=-=";
			//$nupz=explode(",",$up);
			//$nup=array_merge(array_diff($nupz,$xupout));
			$nup=$xupout;
			//print_r($nup);
		}
		else
		{
			$nup=explode(",",$up);
		}
		//echo "<br/>";
		//echo $up."  -=-  ";
		if($up!="")
		{
			$xpl=count($nup);
			foreach($nup as $upsval)
			{
				if($upsval<>"")
				{
					$sql_ups=mysqli_query($link,"select * from tblups where uid=$upsval") or die(mysqli_error($link));
					while($row_ups=mysqli_fetch_array($sql_ups))	
					{
						$upssize=$row_ups['ups']." ".$row_ups['wt'];
						
						$nqty=0; 
						
		
						// Dispatch table with party Type as All
						$sqdm="select * from tbl_disp where plantcode='".$plantcode."' and disp_dodc='$ndts' and disp_tflg=1 order by disp_dodc asc";
						$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						if($t > 0)
						{
							while($rowdispm=mysqli_fetch_array($sql_istbl))
							{
								$trdate=''; $state=''; $disptype=''; $dcno='';
									
								$xc=0; $lotno=''; $ups=''; 
								$sqlis="select * from tbl_dispsub_sub where plantcode='".$plantcode."' and disp_id='".$rowdispm['disp_id']."' and dpss_crop='".$crval."' and dpss_variety='".$verval."' and dpss_ups='".$upssize."' order by disp_id asc";
								$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
								while($row_is=mysqli_fetch_array($sql_is))
								{ 
									$qt=$row_is['dpss_qty']; 
									if($qt<0)$qt=0;
									$xc=$xc+$qt;
									$nqty=$nqty+$qt;
								}
								
								
							}			
						}
						// Pack Seed Release Table  with party Type as All
						$sqdm2="select * from tbl_pswrem where plantcode='".$plantcode."' and pswrem_date='$ndts' order by pswrem_date asc";
						$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
							
						$t2=mysqli_num_rows($sql_istbl2);
						if($t2 > 0)
						{
							while($rowdispm2=mysqli_fetch_array($sql_istbl2))
							{
								$xc=0; 
								$sqlis2="select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_id='".$rowdispm2['pswrem_id']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Qty-Rem' and lotldg_trdate='$ndts' and packtype='$upssize' order by lotdgp_id asc";
								$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
								while($row_is2=mysqli_fetch_array($sql_is2))
								{ 
									$qt=$row_is2['tqty']; 
									if($qt<0)$qt=0;
									$xc=$xc+$qt;
									$nqty=$nqty+$qt;
								}
							}
						}	
						
						// TDF Dispatch table with Pack seed
						$sqlis11="select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='".$crop1."' and dtdfs_variety='".$verty."' and dtdfs_ups='$upssize' and dtdfs_stage='Pack' ";
						$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
						$t23=mysqli_num_rows($sql_is11);
						while($row_is11=mysqli_fetch_array($sql_is11))
						{ 
							$sqdm2="select * from tbl_dtdf where plantcode='".$plantcode."' and dtdf_id='".$row_is11['dtdf_id']."' and dtdf_date='$ndts' and dtdf_tflg=1 order by dtdf_date asc, dtdf_id asc";
							$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
							
							$t2=mysqli_num_rows($sql_istbl2);
							if($t2 > 0)
							{
								while($rowdispm2=mysqli_fetch_array($sql_istbl2))
								{
									
									$xc=0; 
									$sqlis2="select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='".$rowdispm2['dtdf_id']."' and dtdfs_id='".$row_is11['dtdfs_id']."' order by dtdf_id asc";
									$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
									while($row_is2=mysqli_fetch_array($sql_is2))
									{ 
										$qt=$row_is2['dbss_qty']; 
										if($qt<0)$qt=0;
										$xc=$xc+$qt;
										$nqty=$nqty+$qt;
									}
								}			
							}
						}	
						
						$tdate=$ndts;
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$trdate=$tday."-".$tmonth."-".$tyear;
if($nqty>0)						
{						
$totnqty=$totnqty+$nqty;								
$data1[$d]=array($d,$trdate,$crop1,$verty,$pvvername,$vtyp,$upssize,$nqty);
$d++;$cnt++;
}
}
}
}
}
if($txtupsdc=="ALL")
{
	$nqty=0; 

	// Dispatch  BULK table with party Type as All
			
	$sqlis11="select * from tbl_dbulk_sub where plantcode='".$plantcode."' and dbulks_crop='".$crop1."' and dbulks_variety='".$verty."' ";
	$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
	$t23=mysqli_num_rows($sql_is11);
	while($row_is11=mysqli_fetch_array($sql_is11))
	{ 
		$sqdm2="select * from tbl_dbulk where plantcode='".$plantcode."' and dbulk_id='".$row_is11['dbulk_id']."' and dbulk_date='$ndts' and dbulk_tflg=1 order by dbulk_partytype asc, dbulk_date asc";
		$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
		$t2=mysqli_num_rows($sql_istbl2);
		if($t2 > 0)
		{
			while($rowdispm2=mysqli_fetch_array($sql_istbl2))
			{
				$xc=0; 
				$sqlis2="select * from tbl_dbulksub_sub where plantcode='".$plantcode."' and dbulk_id='".$rowdispm2['dbulk_id']."' and dbulks_id='".$row_is11['dbulks_id']."' order by dbulk_id asc";
				$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
				while($row_is2=mysqli_fetch_array($sql_is2))
				{ 
					$qt=$row_is2['dbss_qty']; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
					$nqty=$nqty+$qt;
				}
			}
		}					
	}
	// Stock Transfer Out table with party Type as All
	$sqdm="select * from tbl_stoutm where plantcode='".$plantcode."' and stoutm_date='$ndts' and stoutm_tflg=1 order by stoutm_date asc";
	$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)

	{
		while($rowdispm=mysqli_fetch_array($sql_istbl))
		{
			$xc=0;
			$sqlis="select * from tbl_stouts where plantcode='".$plantcode."' and stoutm_id='".$rowdispm['stoutm_id']."' and stouts_crop='".$crval."' and stouts_variety='".$verval."' order by stoutm_id asc";
			$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$qt=$row_is['stouts_qty']; 
				if($qt<0)$qt=0;
				$xc=$xc+$qt;
				$nqty=$nqty+$qt;
			}
		}
	}
	
	// TDF Dispatch table with Pack seed
	$sqlis11="select * from tbl_dtdf_sub where plantcode='".$plantcode."' and dtdfs_crop='".$crop1."' and dtdfs_variety='".$verty."' and dtdfs_stage='Condition' ";
	$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
	$t23=mysqli_num_rows($sql_is11);
	while($row_is11=mysqli_fetch_array($sql_is11))
	{ 
		$sqdm2="select * from tbl_dtdf where dtdf_id='".$row_is11['dtdf_id']."' and dtdf_date='$ndts' and dtdf_tflg=1 order by dtdf_date asc, dtdf_id asc";
		$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
		$t2=mysqli_num_rows($sql_istbl2);
		if($t2 > 0)
		{
			while($rowdispm2=mysqli_fetch_array($sql_istbl2))
			{
				
				$xc=0; 
				$sqlis2="select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and dtdf_id='".$rowdispm2['dtdf_id']."' and dtdfs_id='".$row_is11['dtdfs_id']."' order by dtdf_id asc";
				$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
				while($row_is2=mysqli_fetch_array($sql_is2))
				{ 
					$qt=$row_is2['dbss_qty']; 
					if($qt<0)$qt=0;
					$xc=$xc+$qt;
					$nqty=$nqty+$qt;
				}
			}			
		}
	}	
						
							
	$tdate=$ndts;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$trdate=$tday."-".$tmonth."-".$tyear;
			
	$upssize="Condition";
if($nqty>0)						
{							
$totnqty=$totnqty+$nqty;		
//$data1[$d]=array($d,$trdate,$crop1,$pvvername,$vtyp,$upssize,$nqty);
$data1[$d]=array($d,$trdate,$crop1,$verty,$pvvername,$vtyp,$upssize,$nqty);
$d++;$cnt++;
}
}


}
}
}
}
}
}
if($totnqty>0)
{
$data1[$d]=array('','','','','','','Grand Total',$totnqty);
}
if($cnt==0)
{
$data1[$d]=array("","","","NO Record Found","","","");
}

echo implode($datahead) ;
echo "\n";
echo implode("\t",$datahead1) ;
echo "\n";
echo implode("\t", $datahead2) ;
echo "\n";
echo implode("\t", $datahead3) ;
echo "\n";
foreach($data1 as $row1)
{ 
	echo implode("\t", array_values($row1))."\n"; 
}	