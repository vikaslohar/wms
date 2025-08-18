<?php
	ob_start();
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
	 
	 $txttrans = $_REQUEST['txttrans'];
	 $txtcfa = $_REQUEST['txtcfa'];
	 $foccode = $_REQUEST['foccode'];
	 $txtcomp = $_REQUEST['txtcomp'];
	 $billdate = $_REQUEST['billdate'];
	 
	 $sql_transport=mysqli_query($link,"select * from tbl_trans where trans_id='".$txttrans."'") or die(mysqli_error($link));
	 $row_transport=mysqli_fetch_array($sql_transport);
	 
	 $sql_cfa=mysqli_query($link,"select * from tbl_cfamaster where cfa_id='".$txtcfa."'") or die(mysqli_error($link));
	 $row_cfa=mysqli_fetch_array($sql_cfa);
	 
	 $cdate=date('Y-m-d');
	 $cdate1=explode("-",$cdate);
	 $cdate2=str_split($cdate1[0]);
	 $yearcode=$cdate2[2].$cdate2[3];
	 $yearcode=intval($yearcode);
	 
	 $billdt=explode("-",$billdate);
	 $billdate1=$billdt[2]."-".$billdt[1]."-".$billdt[0];
	 
	 $sql_code="SELECT MAX(transbill_code) FROM tbl_transbill where yearcode='$yearcode'";
	 $res_code1=mysqli_query($link,$sql_code)or die(mysqli_error($link));
	 $res_code=mysqli_fetch_array($res_code1);		
	 if($res_code[0] > 0)
	 {
		 $t_code=$res_code['0'];
		 $tcode=$t_code+1;
	 }
	 else
	 {
		 $tcode=1;
	 }
	 
	 /*$sql_flg=mysqli_query($link,"Select * from tbl_vltmpmain where vltmp_id in ($foccode) and vltmp_trbillflg=0 order by vltmp_id desc ") or die (mysqli_error($link));
$tot_dispss=mysqli_num_rows($sql_dispss);*/
	 
	 $sql_transb="insert into tbl_transbill (transbill_code, transbill_transname, transbill_trtype, transbill_date, transbill_gen_date, transbill_logid, transbill_yearid, yearcode) values ('$tcode', '$txttrans', '".$row_transport['trtype']."', '$billdate1', '$cdate', '$logid', '$yearid_id', '$yearcode')";
	 if($result_transb=mysqli_query($link,$sql_transb) or die(mysqli_error($link)))
	 {
	 	$transbill_id=mysqli_insert_id($link);
	 }
	 
	$html ='<style type="text/css" media="print">
body { font-family:Arial; background-color:#FFFFFF; background-image:none; color:#000000;} 
img.butn { display:none; visibility:hidden; }
#header{display:none; color:#FFFFFF}
.page-break { page-break-before:always; }
@page {size:landscape;}
</style>';
	$osdate=$sdate;
	$oedate=$edate;
	
	$tdate=explode("-",$sdate);
	$sdate=$tdate[2]."-".$tdate[1]."-".$tdate[0];
	
	$tdate=explode("-",$edate);
	$edate=$tdate[2]."-".$tdate[1]."-".$tdate[0];	
	
	$sql_gcn=mysqli_query($link,"Select * from tbl_gcn where vltmp_id in ($foccode) order by gcn_id asc") or die(mysqli_error($link));
	$row_gcn=mysqli_fetch_array($sql_gcn);
	
	$sql_ds=mysqli_query($link,"Select * from tbl_dispatch where disp_id='".$row_gcn['disp_id']."' ") or die(mysqli_error($link));
	$row_ds=mysqli_fetch_array($sql_ds);
	//echo "select * from tbl_cfamaster where cfa_name='".$row_ds['disp_cfa']."'";
	$sql_cfa12=mysqli_query($link,"select * from tbl_cfamaster where cfa_name='".$row_ds['disp_cfa']."'") or die(mysqli_error($link));
	$row_cfa12=mysqli_fetch_array($sql_cfa12);
	
	$tcomp="";
	$cn1=explode(",",$txtcomp);
	$cn=count($cn1);
	if($cn==1)
		$sql_di=mysqli_query($link,"select com_shcode from tbl_companymaster where comp_id='".$txtcomp."' order by com_shcode asc") or die(mysqli_error($link));
	else
		$sql_di=mysqli_query($link,"select com_shcode from tbl_companymaster where comp_id in ($txtcomp) order by com_shcode asc") or die(mysqli_error($link));
	
	while($row_di=mysqli_fetch_array($sql_di))
	{
		if($tcomp=="")
			$tcomp=$row_di['com_shcode'];
		else
			$tcomp=$tcomp.",".$row_di['com_shcode'];
	}
	$tcomp=explode(",",$tcomp);
	$tcompcnt=count($tcomp);
	for($i=0;$i<$tcompcnt;$i++)
	{
		$tc[$i][0]=0;
		$tc[$i][1]=0;
		$tc[$i][2]=0;
		$tc[$i][3]=0;
		$tc[$i][4]=0;
	}
	
	$addr=""; $addrr1="";
	$sql_cfa13=mysqli_query($link,"select * from tbl_cfamaster_sub where cfa_id='".$row_cfa['cfa_id']."' order by cfasub_location asc") or die(mysqli_error($link));
	$row_cfa13=mysqli_fetch_array($sql_cfa13);
	$addr=explode(",",$row_cfa13['cfasub_address']);
	$adrcnt=count($addr);
	
	$sql_cfacity=mysqli_query($link,"select * from tbl_citymaster where citym_id='".$row_cfa13['cfasub_city']."'") or die(mysqli_error($link));
	$row_cfacity=mysqli_fetch_array($sql_cfacity);
	/*for($i=0;$i<$adrcnt;$i++)
	{
		//echo $addr[$i];
		if($addrr1=="")
			$addrr1=$addr[$i];
		else
			$addrr1=$addrr1.",<br />".$addr[$i];
	}*/
	$addrr1=$row_cfa13['cfasub_address'].$row_cfacity['citym_name'];
	
	$sql_billno=mysqli_query($link,"select * from tbl_transbill where transbill_id='".$transbill_id."' ") or die(mysqli_error($link));
	$row_billno=mysqli_fetch_array($sql_billno);
	
	$tdate=$row_billno['transbill_date'];
	$tyear2=substr($tdate,0,4);
	$tmonth2=substr($tdate,5,2);
	$tday2=substr($tdate,8,2);
	$billdate=$tday2."-".$tmonth2."-".$tyear2;
	
	$tdate=$row_billno['transbill_gen_date'];
	$tyear2=substr($tdate,0,4);
	$tmonth2=substr($tdate,5,2);
	$tday2=substr($tdate,8,2);
	$bill_grn_date=$tday2."-".$tmonth2."-".$tyear2;
	
	//$billno=$yearcode.$row_transport['trans_no'].$tcode;
	$billno=$yearcode.sprintf("%0003d",$row_transport['trans_no']).sprintf("%0003d",$tcode);
	
	$sql_transb_update="update tbl_transbill set transbill_cfa='".$row_cfa['cfa_name']."', transbill_cfapan='".$row_cfa['cfa_panno']."', transbill_cfa_address='$addrr1' where transbill_id='$transbill_id' ";
	$result_transb_update=mysqli_query($link,$sql_transb_update) or die(mysqli_error($link));
	//$addr1=implode(",",$addr1);
	//echo $addr1;
	
$html=$html.'<table align="center" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr ><td align="center" class="Mainheading" style="font-size:10pt;"><font color="#000000" style="font-size:20pt;"><b>';$html=$html.$row_transport['trans_name'];$html=$html.'</b></font></td>
</tr>
<tr ><td align="center" class="Mainheading"><font color="#000000" style="font-size:10pt;">';$html=$html.$row_transport['trans_address'];$html=$html.'</td></tr>
<tr ><td align="center" class="Mainheading"><font color="#000000" style="font-size:10pt;">&nbsp;<b>GST No.</b>&nbsp;';$html=$html.$row_transport['trans_gstno'];$html=$html.'&nbsp;<b>PAN No.</b>&nbsp;';$html=$html.$row_transport['trans_pan'];$html=$html.'</font>';$html=$html.'</td></tr></table>
<table align="center" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr class="Light">
<td align="center" class="Mainheading"><font color="#000000" style="font-size:9pt;">';$html=$html.$osdate;$html=$html.'&nbsp;<b>To</b>&nbsp;';$html=$html.$oedate;$html=$html.'</font></td></tr>
</table><table align="center" border="0" width="1000" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr ><td align="left" class="Mainheading" style="font-size:10pt;"><b>Bill No. : ';$html=$html.$billno;$html=$html.'</b></td><td align="right" class="Mainheading" style="font-size:10pt;"><b>Bill Date. : ';$html=$html.$billdate;$html=$html.'</b></td>
</tr></table><hr style="border-bottom:thick; width:1000" />';
$html=$html.'<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" ><tr class="Dark"><td align="left" valign="middle" class="tbltext" style="font-size:10pt;"><b>M/s.';$html=$html.$row_cfa['cfa_name'];$html=$html.'</b></td><td align="right" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;PAN No.:';$html=$html.$row_cfa['cfa_panno'];$html=$html.'</td></tr><tr class="Dark"><td align="left" valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$addrr1;$html=$html.'</td><td align="right" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;GST No.:';$html=$html.$row_cfa['cfa_gstno'];$html=$html.'</td></tr></table>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" ><tr class="Light">
<td align="center" class="Mainheading" ><font color="#000000" style="font-size:9pt;" colspan="2"><b>Transportation Bill</b></font></td>
</tr>

</table><br /><table align="center" border="1" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" > 
<tr class="Dark" height="20">
<td width="17" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">&nbsp;SNo.&nbsp;</td>
<td width="36" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Date&nbsp;</td>
<td width="42" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Lr.No.&nbsp;</td>
<td width="32" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">GCN No.&nbsp;</td>
<td width="32" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">VLS No.&nbsp;</td>
<td width="59" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Veh No.&nbsp;</td>
<td width="61" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Inv. No.&nbsp;</td>
<td width="28" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Case&nbsp;</td>
<td width="87" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Party Name</td>
<td width="51"  align="center" valign="middle" class="smalltblheading" style="font-size:11pt;" rowspan="2">Area</td>
<td width="56" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Company</td>
<td width="28" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Del. Hops</td>
<td width="27" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Act. Veh. Type</td>
<td width="51" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Veh. Type</td>
<td width="49" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Advance</td>
<td width="48" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Adtl. Freight</td>
<td width="57" align="center" valign="middle" class="tblheading" style="font-size:11pt;" rowspan="2">Unload Charg</td>
<td align="center" valign="middle" class="tblheading" style="font-size:11pt;" colspan="3">Amount</td>
</tr><tr class="tblsubtitle" height="25">
	<td width="46" align="center" valign="middle" class="smalltblheading" style="font-size:11pt;">Freight</td>
	<td width="35" align="center" valign="middle" class="smalltblheading" style="font-size:11pt;">Hops</td>
	<td width="86" align="center" valign="middle" class="smalltblheading" style="font-size:11pt;">Total Freight</td>
</tr>';
$srno=1; $totweight=0; $grtotcase=0; $grtotweight=0; $totcaseamt=0; $tothopsamt=0; $totfreight=0; $totadvance=0; $totuncharg=0; $totcases=0; $totaddamt=0;
//echo "Select * from tbl_vltmpmain where vltmp_date>='$sdate' and vltmp_date<='$edate' and vltmp_transid='".$txttrans."' order by vltmp_id desc ";
$sql_dispss=mysqli_query($link,"Select * from tbl_vltmpmain where vltmp_date>='$sdate' and vltmp_date<='$edate' and vltmp_transid='".$txttrans."' and vltmp_id in ($foccode) order by vltmp_id desc ") or die (mysqli_error($link));
$tot_dispss=mysqli_num_rows($sql_dispss);
if($tot_dispss>0)
{
while($row_dispss=mysqli_fetch_array($sql_dispss))
{ 
	$caseamt=0; $hopsamt=0; $weight=0; $tfreight=0; $advance=0; $uncharg=0; $freight=0; $addamt=0; $tcase=0;
	 
	$invdate=""; $invno=""; $lrno=""; $comp=""; $area=""; $gcnno=""; $date=""; $transname=""; $product=""; $loadslip=""; $vehno=""; $actvehtype=""; $dhops=""; $distance=""; $vehname=""; $hops=""; $dis=""; $dcity=""; $parea=""; $dispid=""; $case1=""; $disp_id=""; $cfacity="";
	
	/*$tdate=$row_dispss['vltmp_date'];
	$tyear2=substr($tdate,0,4);
	$tmonth2=substr($tdate,5,2);
	$tday2=substr($tdate,8,2);
	$date=$tday2."-".$tmonth2."-".$tyear2;*/
	$date2=$row_dispss['vltmp_date'];
	
	$vehname=trim($row_dispss['vltmp_ratevehtype']);
	$lrno=$row_dispss['vltmp_lrno'];
	$addamt=$row_dispss['vltmp_addamt'];
	
	$sql_vlsno=mysqli_query($link,"select dispss_id from tbl_dispatch_stock where vehloadid='".$row_dispss['vltmp_id']."' ORDER BY dispss_id ASC") or die(mysqli_error($link));
	$row_vlsno=mysqli_fetch_array($sql_vlsno);
	
	$sql_vlsno1=mysqli_query($link,"select vehloadflg from tbl_dispatchsub_sub where dispss_id='".$row_vlsno['dispss_id']."' ORDER BY dispss_id ASC") or die(mysqli_error($link));
	$row_vlsno1=mysqli_fetch_array($sql_vlsno1);
	
	$loadslip=$row_vlsno1['vehloadflg'];
	
	 $sql_transbs="insert into tbl_transbill_sub (transbill_id, transbills_vltmpid, transbills_vltmpdate, transbill_vltmptransid, transbill_vltmptranssid, transbills_drvname, transbills_vlsno, transbills_lrno) values ('$transbill_id', '".$row_dispss['vltmp_id']."', '".$row_dispss['vltmp_date']."', '".$row_dispss['vltmp_transid']."', '".$row_dispss['vltmp_transsubid']."', '".$row_dispss['vltmp_drvname']."', '".$row_vlsno1['vehloadflg']."', '".$row_dispss['vltmp_lrno']."')";
	 if($result_transbs=mysqli_query($link,$sql_transbs) or die(mysqli_error($link)))
	 {
	 	$transbills_id=mysqli_insert_id($link);
	 }
	
	$sql_trans=mysqli_query($link,"select * from tbl_vltmpsub where vltmp_id='".$row_dispss['vltmp_id']."' ORDER BY vltmps_id ASC") or die(mysqli_error($link));
	while($row_trans=mysqli_fetch_array($sql_trans))
	{
		$area1="";
		
		if($disp_id=="")
			$disp_id=$row_trans['vltmps_dispid'];
		else
			$disp_id=$disp_id.",".$row_trans['vltmps_dispid'];
		
		$sql_trname=mysqli_query($link,"Select * from tbl_trans_sub where transsub_id='".$row_dispss['vltmp_transsubid']."' order by transsub_id asc") or die(mysqli_error($link));
		$row_trname=mysqli_fetch_array($sql_trname);
		
		if($vehname=="" || $vehname=="NULL"){$vehname=trim($row_trname['transsub_vt']);}
		$vehno=$row_trname['transsub_vrn'];
		$actvehtype=$row_trname['transsub_vt'];
		
		//if($row_trans['vltmps_steps']=="1 Step")
			$area1=$row_trans['vltmps_stto1'];
		/*else if($row_trans['vltmps_steps']=="2 Step")
			$area1=$row_trans['vltmps_stto2'];
		else
			$area1=$row_trans['vltmps_stto3'];*/
			
		if($cfacity=="")
			$cfacity="'".$row_trans['vltmps_stfrom1']."'";
		else
			$cfacity=$cfacity.",'".$row_trans['vltmps_stfrom1']."'";
			
		if($parea!=$area1)
		{
			if($dcity=="")
				$dcity=$area1;
			else
				$dcity=$dcity."<br />".$area1;
			$parea=$area1;
		}	
			
		if($area=="")
		{
			$area="'".$area1."'";
		}
		else
		{
			$area=$area.",'".$area1."'";
		}
		
		$rate_city=""; $rate_zone="";
		$area_zone=explode(" ",$area1);
		//$area_zone=array_unique($area_zone1);
		$count_area_zone=count($area_zone);
		
		if($rate_city==""){$rate_city="'".$area_zone[0]."'";}else{$rate_city=$rate_city.",'".$area_zone[0]."'";}	
		//echo $area_zone[$count_area_zone-2];
		if($count_area_zone>1)
		{
			if($area_zone[$count_area_zone-2]=="Zone")
			{
				if($rate_zone==""){$rate_zone=$area_zone[$count_area_zone-1];}else{$rate_zone=$rate_zone.",".$area_zone[$count_area_zone-1];}
			}
		}
		
		$sql_trans1=mysqli_query($link,"select * from tbl_trans where trans_id='".$txttrans."' ") or die(mysqli_error($link));
		$row_trans1=mysqli_fetch_array($sql_trans1);
		
		$transname=$row_trans1['trans_name'];
			
			
			//$sql_disp=mysqli_query($link,"select * from tbl_dispatch where disp_id='".$row_trans['vltmps_dispid']."' and disp_company in ($txtcomp) and disp_distributor in ($txtdis) ORDER BY disp_id ASC") or die(mysqli_error($link));
					
		$sql_disp=mysqli_query($link,"select * from tbl_dispatch where disp_id='".$row_trans['vltmps_dispid']."' and disp_cfa='".$row_cfa['cfa_name']."' ORDER BY disp_id ASC") or die(mysqli_error($link));
			
		$tot_disp=mysqli_num_rows($sql_disp);
		if($tot_disp>0)
		{
		$row_disp=mysqli_fetch_array($sql_disp);
		if($dispid=="")
			$dispid=$row_trans['vltmps_dispid'];
		else
			$dispid=$dispid.",".$row_trans['vltmps_dispid'];
			
		$sql_vltmps_update=mysqli_query($link,"update tbl_vltmpsub set vltmps_trbillflg1=1 where vltmps_dispid='".$row_disp['disp_id']."' and vltmps_id='".$row_trans['vltmps_id']."' ") or die(mysqli_error($link));
		
		$sql_dist=mysqli_query($link,"select * from tbl_dis where dis_id='".$row_disp['disp_distributor']."' ") or die(mysqli_error($link));
		$row_dist=mysqli_fetch_array($sql_dist);
		
		$sql_comp=mysqli_query($link,"select * from tbl_companymaster where comp_id='".$row_disp['disp_company']."' ") or die(mysqli_error($link));
		$row_comp=mysqli_fetch_array($sql_comp);
		
		$sql_gcn=mysqli_query($link,"select * from tbl_gcn where vltmp_id='".$row_dispss['vltmp_id']."' and disp_id='".$row_disp['disp_id']."' ") or die(mysqli_error($link));
		$row_gcn=mysqli_fetch_array($sql_gcn);
		if($gcnno=="")
			$gcnno=$row_gcn['gcn_code'];
		else
			$gcnno=$gcnno."<br />".$row_gcn['gcn_code'];
			
		if($row_gcn['gcn_date']=="0000-00-00")
			$tdate=$date2;
		else
			$tdate=$row_gcn['gcn_date'];
			
		//$tdate=$row_gcn['gcn_date'];
		$tyear2=substr($tdate,0,4);
		$tmonth2=substr($tdate,5,2);
		$tday2=substr($tdate,8,2);
		$date1=$tday2."-".$tmonth2."-".$tyear2;
		
		if($date1=="")
			$date=$date1;
		else
			$date=$date."<br />".$date1;
		
		if($comp=="")
			$comp=$row_comp['com_shcode'];
		else
			$comp=$comp."<br />".$row_comp['com_shcode'];
		
		if($dis=="")
		{
			$dis=$row_disp['disp_distributor'];
			$disname1=substr($row_dist['dis_name'],0,12);
			$disname=$disname1;
		}
		else
		{
			$dis=$dis.",".$row_disp['disp_distributor'];
			$disname1=substr($row_dist['dis_name'],0,12);
			$disname=$disname."<br />".$disname1;
		}
			
		if($invno=="")	
			$invno=$row_disp['disp_invnumber'];
		else
			$invno=$invno."<br />".$row_disp['disp_invnumber'];
			
		$tdate2=$row_disp['disp_invdate'];
		$tyear2=substr($tdate2,0,4);
		$tmonth2=substr($tdate2,5,2);
		$tday2=substr($tdate2,8,2);
		$tdate2=$tday2."-".$tmonth2."-".$tyear2;
		
		if($invdate=="")
			$invdate=$tdate2;
		else
			$invdate=$invdate."<br />".$tdate2;	
			
		$case=0; 
		$sql_disp_stock=mysqli_query($link,"Select * from tbl_vltmpsub_sub where vltmps_id='".$row_trans['vltmps_id']."' and vltmp_id='".$row_dispss['vltmp_id']."' order by vltmpss_id desc") or die(mysqli_error($link));
		$tot_disp_stock=mysqli_num_rows($sql_disp_stock);
		while($row_disp_stock=mysqli_fetch_array($sql_disp_stock))
		{
			$case=$case+$row_disp_stock['vltmpss_cases'];
			$weight=$weight+$row_disp_stock['vltmpss_wtkgs'];
			
			$sql_prod=mysqli_query($link,"select * from tbl_productmaster where pro_id='".$row_disp_stock['vltmpss_prodid']."' ") or die(mysqli_error($link));
			$row_prod=mysqli_fetch_array($sql_prod);
			if($product=="")
				$product="'".$row_prod['pro_code']."'";
			else
				$product=$product.",'".$row_prod['pro_code']."'";
		}
		if($case1=="")
			$case1=$case;
		else
			$case1=$case1."<br />".$case;
			
		$tcase=$tcase+$case;
		
		for($i=0;$i<$tcompcnt;$i++)
		{
			if($tcomp[$i]==$row_comp['com_shcode'])
			{
				if($tc[$i][0]==0)
					$tc[$i][0]=$case;
				else
					$tc[$i][0]=$tc[$i][0]+$case;
			}
		}
		
		 $sql_transbss="insert into tbl_transbill_sub_sub (transbills_id, transbill_id, transbillss_invno, transbillss_gcnno, transbillss_case, transbillss_partyname, transbillss_comp, transbillss_loc) values ('$transbills_id', '$transbill_id', '".$row_disp['disp_invnumber']."', '".$row_gcn['gcn_id']."', '".$case."', '".$row_dist['dis_name']."', '".$row_comp['com_shcode']."', '".$area1."')";
	 	$result_transbss=mysqli_query($link,$sql_transbss) or die(mysqli_error($link));			
	}
	
	/*if($dispid!="")
	{
		$sql_di=mysqli_query($link,"select * from tbl_dispatch where disp_id in ($dispid) and disp_cfa='".$row_cfa['cfa_name']."' ORDER BY disp_id ASC") or die(mysqli_error($link));
		while($row_di=mysqli_fetch_array($sql_di))
		{
			$sql_tmpsub=mysqli_query($link,"update tbl_vltmpsub set vltmps_trbillflg1=1 where vltmp_id='".$row_dispss['vltmp_id']."' and vltmps_dispid='".$row_di['disp_id']."' ") or die(mysqli_error($link));
		}
	}*/
	
	$sql_tmpsub2=mysqli_query($link,"select * from tbl_vltmpsub where vltmp_id='".$row_dispss['vltmp_id']."' and vltmps_trbillflg1=0 ORDER BY vltmp_id asc") or die(mysqli_error($link));
	$tot_tmpsub2=mysqli_num_rows($sql_tmpsub2);
	
	if($tot_tmpsub2>0)
	$sql_se=mysqli_query($link,"update tbl_vltmpmain set vltmp_trbillflg=2 where vltmp_id='".$row_dispss['vltmp_id']."' ") or die(mysqli_error($link));
	else
	$sql_se=mysqli_query($link,"update tbl_vltmpmain set vltmp_trbillflg=1 where vltmp_id='".$row_dispss['vltmp_id']."' ") or die(mysqli_error($link));
	
	$sql_gcndate=mysqli_query($link,"select dispst_date from tbl_dispatch_stock where vehloadid='".$row_dispss['vltmp_id']."' ORDER BY dispst_id desc") or die(mysqli_error($link));
	$row_gcndate=mysqli_fetch_array($sql_gcndate);
	
	//$row_gcndate['dispst_date'];
	
	if($area!="")
	{		
		$rate_city1=explode(",",$rate_city);
		$rate_city1=array_unique($rate_city1);
		$rate_city1_count=count($rate_city1);
		$rate_city=implode(",",$rate_city1);
		
		$rate_city=$rate_city.",".$area;
		
		$rate_zone1=explode(",",$rate_zone);
		$rate_zone1=array_unique($rate_zone1);
		$rate_zone1_count=count($rate_zone1);
		$rate_zone=implode(",",$rate_zone1);
		//echo $rate_zone."<br />";
		$sql="Select MAX(ratet_direct) from tbl_ratetemp where ratet_trname='".$transname."' and ratet_effdtfrom<='".$row_gcndate['dispst_date']."' and ratet_deliverycity in ($rate_city) and ratet_trcity in ($cfacity) and ratet_vehtype='".$vehname."' ";
		if($rate_zone1_count>1)
			$sql.=" and ratet_zone in ($rate_zone)";
		else
			$sql.=" and ratet_zone='$rate_zone' ";
			
		$sql.=" order by ratet_id desc limit 0,1";
		$sql_rate=mysqli_query($link,$sql)or die(mysqli_error($link));
		$row_rate=mysqli_fetch_array($sql_rate);	
		$caseamt=$row_rate[0]; 
		 if($caseamt=="")
		 {
			$sql_rate=mysqli_query($link,"Select MAX(ratet_direct) from tbl_ratetemp where ratet_trname='".$transname."' and ratet_effdtfrom<='".$row_gcndate['dispst_date']."' and ratet_deliverycity in ($area) and ratet_trcity in ($cfacity) and ratet_vehtype='".$vehname."' order by ratet_id desc limit 0,1 ")or die(mysqli_error($link));
			$row_rate=mysqli_fetch_array($sql_rate);	
			$caseamt=$row_rate[0]; 
			 if($caseamt=="")
			 {
				$sql_rate=mysqli_query($link,"Select MAX(ratet_direct) from tbl_ratetemp where ratet_trname='".$transname."' and ratet_effdtfrom<='".$row_gcndate['dispst_date']."' and ratet_deliverycity in ($area) and ratet_trcity in ($cfacity) and ratet_vehtype='".$actvehtype."' order by ratet_id desc limit 0,1 ")or die(mysqli_error($link));
				$row_rate=mysqli_fetch_array($sql_rate);	
				$caseamt=$row_rate[0]; 
				
				if($caseamt=="")
				{
					$sql_rate=mysqli_query($link,"Select MAX(ratem_direct) from tbl_ratemain where ratem_trname='".$transname."' and ratem_effdtfrom<='".$row_gcndate['dispst_date']."' and ratem_deliverycity in ($area) and ratem_trcity in ($cfacity) and ratem_vehtype='".$vehname."' order by ratem_id desc limit 0,1 ")or die(mysqli_error($link));
					$row_rate=mysqli_fetch_array($sql_rate);	
					$caseamt=$row_rate[0];
				}
			 }
		 }
		 
		$sql_rate1=mysqli_query($link,"Select * from tbl_ratetemp where ratet_trname='".$transname."' and ratet_effdtfrom<='".$row_gcndate['dispst_date']."' and ratet_deliverycity in ($area) and ratet_trcity in ($cfacity) order by ratet_id desc limit 0,1")or die(mysqli_error($link));
		$row_rate1=mysqli_fetch_array($sql_rate1);
		
		$dist1=explode(",",$dis);
		$dist=array_unique($dist1);
		$dhops=count($dist);
		$chops=$dhops-$row_rate1['ratet_freehops'];
		$hopsamt=$chops*$row_rate1['ratet_hoprate'];
		if($hopsamt<0 || $hopsamt==-0)
			$hopsamt=0;
		
		$area11=explode(",",$area);
		$area12=array_unique($area11);
		$area11=implode(",",$area12);
		
		$sql_cfacount=mysqli_query($link,"select distinct disp_cfa from tbl_dispatch where disp_id in ($disp_id)") or die(mysqli_error($link));
		$tot_cfacount=mysqli_num_rows($sql_cfacount);
		
		if($tot_cfacount!=0 || $tot_cfacount!="" || $tot_cfacount!=NULL){
			$caseamt=$caseamt/$tot_cfacount;
			$hopsamt=$hopsamt/$tot_cfacount;
		}else{
			$caseamt=$caseamt;
			$hopsamt=$hopsamt;
		}
		
		$tfreight=$caseamt+$hopsamt+$uncharg;
		
		$sql_transbs_update="update tbl_transbill_sub set transbills_tripamt='".$tfreight."' where transbills_id='$transbills_id' ";
		$results_transb_update=mysqli_query($link,$sql_transbs_update) or die(mysqli_error($link));
	}
}
if($dispid!="")
{	
	$sql_disp2=mysqli_query($link,"select distinct vehloadflg from tbl_dispatchsub_sub where disp_id in ($disp_id) and vehiclename='".$row_dispss['vltmp_transsubid']."' ORDER BY dispss_id ASC") or die(mysqli_error($link));
	$row_disp2=mysqli_fetch_array($sql_disp2);
	{
		//if($loadslip=="")
			//$loadslip=$row_disp2['vehloadflg'];
		//else
			//$loadslip=$loadslip."<br />".$row_disp2['vehloadflg'];	
	}
	
	if($advance==0)$advance="";
	//if($addamt==0)$addamt="";
	if($uncharg==0)$uncharg="";
	if($caseamt==0)$caseamt="";
	if($hopsamt==0)$hopsamt="";
	//if($tfreight==0)$tfreight="";
	if($totadvance==0)$totadvance="";
	//if($totaddamt==0)$totaddamt="";
	if($totuncharg==0)$totuncharg="";
	//if($totcaseamt==0)$totcaseamt="";
	if($tothopsamt==0)$tothopsamt="";
	//if($totfreight==0)$totfreight="";
	
	for($i=0;$i<$tcompcnt;$i++)
	{
		if($tcomp[$i]==$row_comp['com_shcode'])
		{
			if($tc[$i][1]=="")
				$tc[$i][1]=$caseamt;
			else
				$tc[$i][1]=$tc[$i][1]+$caseamt;
				
			if($tc[$i][2]=="")
				$tc[$i][2]=$hopsamt;
			else
				$tc[$i][2]=$tc[$i][2]+$hopsamt;
				
			if($tc[$i][3]=="")
				$tc[$i][3]=$addamt;
			else
				$tc[$i][3]=$tc[$i][3]+$addamt;
				
			if($tc[$i][4]=="")
				$tc[$i][4]=$tfreight;
			else
				$tc[$i][4]=$tc[$i][4]+$tfreight;
		}
	}
	//$caseamt=round($caseamt);
	//$caseamt1=explode(".",$caseamt);
	//if($caseamt1[1]=="00"){$caseamt=$caseamt1[0];}
	
$html=$html.'<tr class="Dark" height="20">
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$srno;$html=$html.'</td>
<td align="center" 	valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$date;$html=$html.'</td>
<td align="center" 	valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$lrno;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$gcnno;$html=$html.'</td>	
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$loadslip;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$vehno;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$invno;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$case1;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$disname;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$dcity;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">';$html=$html.$comp;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$dhops;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$actvehtype;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$vehname;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$advance;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$addamt;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$uncharg;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$caseamt;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$hopsamt;$html=$html.'</td>
<td align="center"  valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tfreight;$html=$html.'</td>
</tr>';
$srno=$srno+1;
if($advance!="")$totadvance=$totadvance+$advance; 
if($uncharg!="")$totuncharg=$totuncharg+$uncharg;
$totfreight=$totfreight+$tfreight; 
if($hopsamt!="")$tothopsamt=$tothopsamt+$hopsamt;
if($caseamt!=""){$totcaseamt=$totcaseamt+$caseamt;}
$totcases=$totcases+$tcase;
//echo $totcases." = ".$totcases." + ".$case;
if($addamt!=0)$totaddamt=$totaddamt+$addamt;
}
}
}

$html=$html.'<tr class="Light" height="25">
	<td align="right" valign="middle" class="tblheading" colspan=7>Total&nbsp;</td>
	<td width="28" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$totcases;$html=$html.'</td>
	<td align="center" valign="middle" class="tbltext" colspan=6></td>
	<td width="47" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totadvance;$html=$html.'</td>
	<td width="55" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totaddamt;$html=$html.'</td>
	<td width="45" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totuncharg;$html=$html.'</td>
	<td width="49" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totcaseamt;$html=$html.'</td>
	<td width="37" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$tothopsamt;$html=$html.'</td>
	<td width="54" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totfreight;$html=$html.'</td>
</tr></table><br />';

$html=$html.'<table align="center" border="1" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse" > 
<tr class="Dark" height="20"><td width="17" align="center" valign="middle" class="tblheading" style="font-size:11pt;" colspan="7">Company wise Summary&nbsp;</td></tr>
<tr class="Dark" height="20">
<td width="17" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Company&nbsp;</td>
<td width="36" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Case&nbsp;</td>
<td width="42" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Freight&nbsp;</td>
<td width="32" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Hops freight&nbsp;</td>
<td width="32" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Adtl. Freight&nbsp;</td>
<td width="32" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Total Freight&nbsp;</td>
<td width="32" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Grand Total&nbsp;</td></tr>';

for($i=0;$i<$tcompcnt;$i++)
{
if($tc[$i][0]!=0)
{
if($tc[$i][3]!=""){$grndtot=$tc[$i][4]+$tc[$i][3];}else{$grndtot=$tc[$i][4];}
$html=$html.'<tr class="Dark" height="20">
<td width="28" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tcomp[$i];$html=$html.'</td>
<td width="47" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tc[$i][0];$html=$html.'</td>
<td width="47" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tc[$i][1];$html=$html.'</td>
<td width="47" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tc[$i][2];$html=$html.'</td>
<td width="47" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tc[$i][3];$html=$html.'</td>
<td width="47" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$tc[$i][4];$html=$html.'</td>
<td width="47" align="center" valign="middle" class="tbltext" style="font-size:10pt;">&nbsp;';$html=$html.$grndtot;$html=$html.'</td></tr>';
}
}
if($totaddamt!=""){$grndtot1=$totfreight+$totaddamt;}else{$grndtot1=$totfreight;}
$html=$html.'<tr class="Light" height="25">
	<td width="17" align="center" valign="middle" class="tblheading" style="font-size:11pt;">Total&nbsp;</td>
	<td width="28" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totcases;$html=$html.'</td>
	<td width="47" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.round($totcaseamt);$html=$html.'</td>
	<td width="55" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$tothopsamt;$html=$html.'</td>
	<td width="45" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.$totaddamt;$html=$html.'</td>
	<td width="49" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.round($totfreight);$html=$html.'</td>
	<td width="49" align="center" valign="middle" class="tblheading" style="font-size:10pt;">&nbsp;';$html=$html.round($grndtot1);$html=$html.'</td>
</tr></table><br /><br /><table align="center" width="1000" cellspacing="0" style="border-collapse:collapse" >
<tr class="Light" height="25"><td width="17" align="left" valign="middle" class="tblheading" style="font-size:11pt;">Date:&nbsp;';$html=$html.$bill_grn_date;$html=$html.'</td><td width="17" align="right" valign="middle" class="tblheading" style="font-size:11pt;">for,&nbsp;';$html=$html.$row_transport['trans_name'];$html=$html.'</td></tr></table>';
//echo $html;
//exit;
include("../mpdf/mpdf1.php");
$mpdf=new mPDF('c'); 
//$mpdf=new mPDF('en-GB-x','A4','','',5,5,5,5,0,0); 

//$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)
$mpdf->SetDisplayMode('fullpage');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO} of {nbpg} pages||{PAGENO} of {nbpg} pages');

// LOAD a stylesheet
//$stylesheet = file_get_contents('mpdfstylePaged.css');
//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);
$flname="TransportBill_".$row_transport['trans_name']."_".$_REQUEST['sdate']."_to_".$_REQUEST['edate'].".pdf";
//$pathtosave=$_SERVER['DOCUMENT_ROOT']."/wms/Uploadfiles";
$mpdf->Output($flname,'D');
exit;
?>