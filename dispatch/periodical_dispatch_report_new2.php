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
	$txtstate = $_REQUEST['txtstate'];
	$txtloc = $_REQUEST['txtloc'];
	$txtparty = $_REQUEST['txtparty'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$txtlotno = $_REQUEST['txtlotno'];
	$txtupsdc = $_REQUEST['txtupsdc'];
	$txtdisptype = $_REQUEST['txtdisptype'];
?>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<title>Dispatch - Report - Periodical Dispatch Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_pdr.php?sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtstate=<?php echo $_REQUEST['txtstate']?>&txtloc=<?php echo $_REQUEST['txtloc']?>&txtparty=<?php echo $_REQUEST['txtparty']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtlotno=<?php echo $_REQUEST['txtlotno']?>&txtupsdc=<?php echo $txtupsdc;?>&txtdisptype=<?php echo $_REQUEST['txtdisptype']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php

	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	$crp="ALL"; $ver="ALL";
	
	
	$qry="select Distinct disp_id from tbl_disp where plantcode='".$plantcode."' and  disp_dodc>='$sdt' and disp_dodc<='$edt' order by disp_dodc asc";
	$qry2="select Distinct dbulk_id from tbl_dbulk where plantcode='".$plantcode."' and  dbulk_date>='$sdt' and dbulk_date<='$edt' order by dbulk_date asc";
	$qry3="select Distinct pswrem_id from tbl_pswrem where plantcode='".$plantcode."' and  pswrem_date>='$sdt' and pswrem_date<='$edt' order by pswrem_date asc";
	$qry4="select Distinct dtdf_id from tbl_dtdf where plantcode='".$plantcode."' and  dtdf_date>='$sdt' and dtdf_date<='$edt' order by dtdf_date asc";
	$qry5="select Distinct tid from tbl_discard where plantcode='".$plantcode."' and  tdate>='$sdt' and tdate<='$edt' order by tdate asc";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home4=mysqli_query($link,$qry4) or die(mysqli_error($link));
	$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

$id1="";$id2="";$id3="";$id4="";$id5="";
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
	
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home5))
	{
		if($id5!="") $id5=$id5.",".$row_arr_home25['tid']; else $row_arr_home25=$row312['tid'];
	}
	
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
	
	$id51=explode(",",$id5);
	$id51=array_unique($id51);
	sort($id51);
	$id51=implode(",",$id51);
	
	if($id11!="")
	$qry="select Distinct disps_crop from tbl_disp_sub where plantcode='".$plantcode."' and   disp_id IN ($id11) ";
	else
	$qry="select Distinct disps_crop from tbl_disp_sub where plantcode='".$plantcode."' and   disp_id!=0 ";
	if($id21!="")
	$qry2="select Distinct dbulks_crop from tbl_dbulk_sub where plantcode='".$plantcode."' and   dbulk_id IN ($id21) ";
	else
	$qry2="select Distinct dbulks_crop from tbl_dbulk_sub where plantcode='".$plantcode."' and   dbulk_id!=0 ";
	if($id31!="")
	$qry3="select Distinct crop from tbl_pswrem_sub where plantcode='".$plantcode."' and   pswrem_id IN ($id31) ";
	else
	$qry3="select Distinct crop from tbl_pswrem_sub where plantcode='".$plantcode."' and   pswrem_id!=0 ";
	if($id41!="")
	$qry4="select Distinct dtdfs_crop from tbl_dtdf_sub where plantcode='".$plantcode."' and   dtdf_id IN($id41) ";
	else
	$qry4="select Distinct dtdfs_crop from tbl_dtdf_sub where plantcode='".$plantcode."' and   dtdf_id!=0 ";
	if($id51!="")
	$qry5="select Distinct crop from tbl_discard_sub where plantcode='".$plantcode."' and   tid IN($id51) ";
	else
	$qry5="select Distinct crop from tbl_discard_sub where plantcode='".$plantcode."' and   did!=0 ";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
		$qry.=" and disps_crop='$crp' ";
		$qry2.=" and dbulks_crop='$crp' ";
		$qry3.=" and crop='$crop' ";
		$qry4.=" and dtdfs_crop='$crp' ";
		$qry5.=" and crop='$crop' ";
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
		$qry2.=" and dbulks_variety='$ver' ";
		$qry3.=" and variety='$variety' ";
		$qry4.=" and dtdfs_variety='$v' ";
		$qry5.=" and variety='$variety' ";
	}
	
	$qry.=" group by disps_crop";
	$qry2.=" group by dbulks_crop";
	$qry3.=" group by crop";
	$qry4.=" group by dtdfs_crop";
	$qry5.=" group by crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home4=mysqli_query($link,$qry4) or die(mysqli_error($link));
	$sql_arr_home5=mysqli_query($link,$qry5) or die(mysqli_error($link));

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
	
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home5))
	{
		$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home25['crop']."' order by cropname asc") or die(mysqli_error($link));
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

?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Periodical Dispatch Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?>&nbsp;&nbsp;|&nbsp;&nbsp;Size: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="18" align="center" valign="middle" class="smalltblheading">#</td>	  
	<td width="61" align="center" valign="middle" class="smalltblheading">Dispatch Date</td>
	<td width="77" align="center" valign="middle" class="smalltblheading">Party Name</td>
	<td width="73" align="center" valign="middle" class="smalltblheading">Location</td>
	<td width="64" align="center" valign="middle" class="smalltblheading">State</td>
	<td width="70" align="center" valign="middle" class="smalltblheading">Dispatch Type</td>
    <td width="64" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="70" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="70" align="center" valign="middle" class="smalltblheading">PV Variety</td>
	<td width="66" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="70" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="43" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="48" align="center" valign="middle" class="smalltblheading">DC No.</td>
</tr>
<?php
$srno=1; $cnt=0;
$crps=explode(",",$crop2);
//print_r($crps);
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
	
	if($id11!="")
	$qry="select Distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='".$crop1."' and disp_id IN ($id11) ";
	else
	$qry="select Distinct disps_variety from tbl_disp_sub where plantcode='".$plantcode."' and  disps_crop='".$crop1."' ";
	if($id21!="")
	$qry2="select Distinct dbulks_variety from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulks_crop='".$crop1."' and dbulk_id IN ($id21) ";
	else
	$qry2="select Distinct dbulks_variety from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulks_crop='".$crop1."' ";
	if($id31!="")
	$qry3="select Distinct variety from tbl_pswrem_sub where plantcode='".$plantcode."' and  crop='".$crval."' and pswrem_id IN ($id31) ";
	else
	$qry3="select Distinct variety from tbl_pswrem_sub where plantcode='".$plantcode."' and  crop='".$crval."'  ";
	if($id41!="")
	$qry4="select Distinct dtdfs_variety from tbl_dtdf_sub where plantcode='".$plantcode."' and  dtdfs_crop='".$crop1."' and dtdf_id IN ($id41) ";
	else
	$qry4="select Distinct dtdfs_variety from tbl_dtdf_sub where plantcode='".$plantcode."' and  dtdfs_crop='".$crop1."'  ";
	if($id51!="")
	$qry5="select Distinct variety from tbl_discard_sub where plantcode='".$plantcode."' and  crop='".$crval."' and  tid IN ($id51) ";
	else
	$qry5="select Distinct variety from tbl_discard_sub where plantcode='".$plantcode."' and  crop='".$crval."' ";
	
	
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
		$qry.=" and disps_variety='$ver' ";
		$qry2.=" and dbulks_variety='$ver' ";
		$qry3.=" and variety='$variety' ";
		$qry4.=" and dtdfs_variety='$ver' ";
		$qry5.=" and variety='$variety' ";
		
	}
	
	$qry.=" group by disps_variety";
	$qry2.=" group by dbulks_variety";
	$qry3.=" group by variety";
	$qry4.=" group by dtdfs_variety";
	$qry5.=" group by variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));
	$sql_arr_home24=mysqli_query($link,$qry4) or die(mysqli_error($link));
	$sql_arr_home25=mysqli_query($link,$qry5) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home12['disps_variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home22['dbulks_variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home23['variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home24=mysqli_fetch_array($sql_arr_home24))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$row_arr_home24['dtdfs_variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home25=mysqli_fetch_array($sql_arr_home25))
	{
		$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home25['variety']."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."' and actstatus='Active' order by popularname asc") or die(mysqli_error($link));
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
	
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$vtyp=""; $cirec=0; $pvvername='';
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' and actstatus='Active'") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var);
		if($vtot>0)
		{
			$row_var=mysqli_fetch_array($sql_var);
			$verty=$row_var['popularname'];
			$vtyp=$row_var['vt'];
			if($vtyp=="Hybrid")$vtyp="HY";
			if($row_var['vertype']!='PV')
			{
				if($row_var['pvverid']>0)
				{
					$sq_vr=mysqli_query($link,"select * from tblvariety where varietyid ='".$row_var['pvverid']."'") or die(mysqli_error($link));
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
		
		


			// Dispatch table with party Type as All
			if($txtdisptype!="ALL")
			$sqdm="select * from tbl_disp where plantcode='".$plantcode."' and  disp_dodc>='$sdt' and disp_dodc<='$edt' and disp_tflg=1 and disp_partytype='$txtdisptype'  ";
			else
			$sqdm="select * from tbl_disp where plantcode='".$plantcode."' and  disp_dodc>='$sdt' and disp_dodc<='$edt' and disp_tflg=1  ";
			if($txtstate!="ALL")
			$sqdm.=" and disp_state='$txtstate' ";
			if($txtloc!="ALL")
			$sqdm.=" and disp_location='$txtloc' ";
			if($txtparty!="ALL")
			$sqdm.=" and disp_party='$txtparty' ";
			
			
			$sqdm.=" order by disp_partytype asc, disp_dodc asc";
			$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($rowdispm=mysqli_fetch_array($sql_istbl))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					$sqlis1="select distinct dpss_lotno from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='".$rowdispm['disp_id']."' and dpss_crop='".$crval."' and dpss_variety='".$verval."' ";
					if($txtlotno!="")
					$sqlis1.=" and SUBSTRING(`dpss_lotno`,1,7)='".$txtlotno."' ";
					$sql_is1=mysqli_query($link,$sqlis1) or die(mysqli_error($link));
					while($row_is1=mysqli_fetch_array($sql_is1))
					{ 
						$xc=0; $lotno=''; $ups=''; $nqty=''; 
						$sqlis="select * from tbl_dispsub_sub where plantcode='".$plantcode."' and  disp_id='".$rowdispm['disp_id']."' and dpss_lotno='".$row_is1['dpss_lotno']."' and dpss_crop='".$crval."' and dpss_variety='".$verval."' ";
						if($txtupsdc!="ALL")
						$sqlis.=" and dpss_ups='".$txtupsdc."'  ";
						
						$sqlis.=" order by disp_id asc";
						$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
						while($row_is=mysqli_fetch_array($sql_is))
						{ 
							$qt=$row_is['dpss_qty']; 
							if($qt<0)$qt=0;
							$xc=$xc+$qt;
							
							$lotno=$row_is['dpss_lotno']; 
							$ups=$row_is['dpss_ups']; 
						}
					
						$tdate=$rowdispm['disp_dodc'];
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$trdate=$tday."-".$tmonth."-".$tyear;
						
						$state=$rowdispm['disp_state'];
						$disptype=$rowdispm['disp_partytype'];
						$nqty=$xc;
						
						$ptype=$rowdispm['disp_partytype'];
						
						if($ptype=="Dealer" || $ptype=="Export Buyer")
						{
						$ntitle="Pack Seed Dispatch Note (PSDN)";
						$ntyps="PSDN";
						}
						if($ptype=="C&F" || $ptype=="Branch")
						{
						$ntitle="Stock Transfer Dispatch Note (STDN)";
						$ntyps="STDN";
						}			
								
						$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
						$noticia3 = mysqli_fetch_array($quer3);
						$ycode=$noticia3['ycode'];
							
						$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='".$rowdispm['disp_id']."' and dnote_trtype='Dispatch Pack Seed' and dnote_ptype='$ptype'";
						$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));

						$row_code1=mysqli_fetch_array($res_code1);
						
						$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
						$row_param=mysqli_fetch_array($sql_param);
						
						$dcno=$row_param['code']."/"."SD"."/".$ycode."/".$row_code1['dnote_code'];		
						
						
						$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['disp_party']."' order by business_name")or die(mysqli_error($link));
						$noticia = mysqli_fetch_array($sql_month24);
						$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
						$noticia240 = mysqli_fetch_array($sql_month240);
						
						if($disptype=="Dealer")$disptype="Sales";
						if($disptype=="C&F")$disptype="Stock Transfer(Branch & C&F)";
						if($disptype=="Branch")$disptype="Stock Transfer(Branch & C&F)";
						if($disptype=="Export Buyer")$disptype="Export (Buyer)";
$cnt++;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
	

			// Dispatch  BULK table with party Type as All
			
			$sqlis11="select * from tbl_dbulk_sub where plantcode='".$plantcode."' and  dbulks_crop='".$crop1."' and dbulks_variety='".$verty."' ";
					
			$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
			$t23=mysqli_num_rows($sql_is11);
			while($row_is11=mysqli_fetch_array($sql_is11))
			{ 
			if($txtdisptype!="ALL")
			$sqdm2="select * from tbl_dbulk where plantcode='".$plantcode."' and  dbulk_id='".$row_is11['dbulk_id']."' and dbulk_date>='$sdt' and dbulk_date<='$edt' and dbulk_tflg=1 and dbulk_partytype='$txtdisptype'  ";
			else
			$sqdm2="select * from tbl_dbulk where plantcode='".$plantcode."' and  dbulk_id='".$row_is11['dbulk_id']."' and dbulk_date>='$sdt' and dbulk_date<='$edt' and dbulk_tflg=1  ";
			
			if($txtstate!="ALL")
			$sqdm2.=" and dbulk_state='$txtstate' ";
			if($txtloc!="ALL")
			$sqdm2.=" and dbulk_location='$txtloc' ";
			if($txtparty!="ALL")
			$sqdm2.=" and dbulk_party='$txtparty' ";
			
			
			$sqdm2.=" order by dbulk_partytype asc, dbulk_date asc";
			$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
			
			$t2=mysqli_num_rows($sql_istbl2);
			if($t2 > 0)
			{
				while($rowdispm2=mysqli_fetch_array($sql_istbl2))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					
					
						$sqlis12="select distinct dbss_lotno from tbl_dbulksub_sub where plantcode='".$plantcode."' and  dbulk_id='".$rowdispm2['dbulk_id']."' and dbulks_id='".$row_is11['dbulks_id']."'";
						if($txtlotno!="")
						$sqlis12.=" and SUBSTRING(`dbss_lotno`,1,7)='".$txtlotno."' ";
						
						$sql_is12=mysqli_query($link,$sqlis12) or die(mysqli_error($link));
						while($row_is12=mysqli_fetch_array($sql_is12))
						{ 
							$xc=0; $lotno=''; $ups=''; $nqty=''; 
							$sqlis2="select * from tbl_dbulksub_sub where plantcode='".$plantcode."' and  dbulk_id='".$rowdispm2['dbulk_id']."' and dbss_lotno='".$row_is12['dbss_lotno']."' and dbulks_id='".$row_is11['dbulks_id']."' ";
							
							$sqlis2.=" order by dbulk_id asc";
							$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
							while($row_is2=mysqli_fetch_array($sql_is2))
							{ 
								$qt=$row_is2['dbss_qty']; 
								if($qt<0)$qt=0;
								$xc=$xc+$qt;
								
								$lotno=$row_is2['dbss_lotno']; 
								$ups=$row_is11['dbulks_ups']; 
							}
						
							$tdate=$rowdispm2['dbulk_date'];
							$tyear=substr($tdate,0,4);
							$tmonth=substr($tdate,5,2);
							$tday=substr($tdate,8,2);
							$trdate=$tday."-".$tmonth."-".$tyear;
							
							$state=$rowdispm2['dbulk_state'];
							$disptype=$rowdispm2['dbulk_partytype'];
							$nqty=$xc;
							
							$ptype=$rowdispm2['dbulk_partytype'];
							
							$ntyps="BSDN";
										
								
							$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='".$rowdispm2['dbulk_id']."' and dnote_trtype='Dispatch Bulk Seed' and dnote_ptype='$ptype'";
							$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
							$row_code1=mysqli_fetch_array($res_code1);
							
							$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
							$row_param=mysqli_fetch_array($sql_param);
							
							$dcno=$row_param['code']."/"."SD"."/".$rowdispm2['dbulk_yearcode']."/".$row_code1['dnote_code'];
							
							$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['dbulk_party']."' order by business_name")or die(mysqli_error($link));
							$noticia = mysqli_fetch_array($sql_month24);
							
							$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
							$noticia240 = mysqli_fetch_array($sql_month240);
							$sql_arhome=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_trid='".$rowdispm2['dbulk_id']."' and lotldg_trtype='Dispatch Bulk' ") or die(mysqli_error($link));
							$row_arhome=mysqli_fetch_array($sql_arhome);
							$ups=$row_arhome['lotldg_sstage'];
$cnt++;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}


			// Pack Seed Release Table  with party Type as All
			if($txtdisptype!="ALL")	
			$sqdm2="select * from tbl_pswrem where plantcode='".$plantcode."' and  pswrem_date>='$sdt' and pswrem_date<='$edt' and pswrem_ptype='$txtdisptype'  ";
			else
			$sqdm2="select * from tbl_pswrem where plantcode='".$plantcode."' and  pswrem_date>='$sdt' and pswrem_date<='$edt' ";
			if($txtstate!="ALL")
			$sqdm2.=" and pswrem_state='$txtstate' ";
			if($txtloc!="ALL")
			$sqdm2.=" and pswrem_location='$txtloc' ";
			if($txtparty!="ALL")
			$sqdm2.=" and pswrem_party='$txtparty' ";
			
			
			$sqdm2.=" order by pswrem_ptype asc, pswrem_date asc";
			
			$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
			
			$t2=mysqli_num_rows($sql_istbl2);
			if($t2 > 0)
			{
				while($rowdispm2=mysqli_fetch_array($sql_istbl2))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					
					
						$sqlis12="select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_id='".$rowdispm2['pswrem_id']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Qty-Rem' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' ";
						if($txtlotno!="")
						$sqlis12.=" and SUBSTRING(`lotno`,1,7)='".$txtlotno."' ";
						
						$sql_is12=mysqli_query($link,$sqlis12) or die(mysqli_error($link));
						while($row_is12=mysqli_fetch_array($sql_is12))
						{ 
							$xc=0; $lotno=''; $ups=''; $nqty=''; 
							$sqlis2="select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotldg_id='".$rowdispm2['pswrem_id']."' and lotno='".$row_is12['lotno']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Qty-Rem' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' ";
							
							$sqlis2.=" order by lotdgp_id asc";
							$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
							while($row_is2=mysqli_fetch_array($sql_is2))
							{ 
								$qt=$row_is2['tqty']; 
								if($qt<0)$qt=0;
								$xc=$xc+$qt;
								
								$lotno=$row_is2['lotno']; 
								$ups=$row_is2['packtype']; 
							}
						
							$tdate=$rowdispm2['pswrem_date'];
							$tyear=substr($tdate,0,4);
							$tmonth=substr($tdate,5,2);
							$tday=substr($tdate,8,2);
							$trdate=$tday."-".$tmonth."-".$tyear;
							
							$state=$rowdispm2['pswrem_state'];
							$disptype=$rowdispm2['pswrem_ptype'];
							$nqty=$xc;
							
							$ptype=$rowdispm2['pswrem_ptype'];
							
										
							$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
							$row_param=mysqli_fetch_array($sql_param);
							
							$dcno="CR".$rowdispm2['pswrem_code']."/".$rowdispm2['yearcode']."/".$rowdispm2['logid'];
							
							$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['pswrem_party']."' order by business_name")or die(mysqli_error($link));
							$noticia = mysqli_fetch_array($sql_month24);
							
							if($state=="")$state=$noticia['state'];
							$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
							$noticia240 = mysqli_fetch_array($sql_month240);
							
							if($disptype=="Dealer")$disptype="Sales";
							if($disptype=="C&F")$disptype="Stock Transfer(Branch & C&F)";
							if($disptype=="Branch")$disptype="Stock Transfer(Branch & C&F)";
							if($disptype=="Export Buyer")$disptype="Export (Buyer)";
							if($disptype=="")$disptype="Pack Seed Release";
$cnt++;							
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}			


			// Stock Transfer Out table with party Type as All
			if($txtdisptype=="ALL" || $txtdisptype=="Stock Transfer-Plant")	
			{
			$sqdm="select * from tbl_stoutm where plantcode='".$plantcode."' and  stoutm_date>='$sdt' and stoutm_date<='$edt' and stoutm_tflg=1  ";
			
			/*if($txtstate!="ALL")
			$sqdm.=" and disp_state='$txtstate' ";
			if($txtloc!="ALL")
			$sqdm.=" and disp_location='$txtloc' ";*/
			if($txtparty!="ALL")
			$sqdm.=" and stoutm_plant='$txtparty' ";
			
			
			$sqdm.=" order by stoutm_date asc";
			$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($rowdispm=mysqli_fetch_array($sql_istbl))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					$sqlis1="select distinct stouts_lotno from tbl_stouts where plantcode='".$plantcode."' and  stoutm_id='".$rowdispm['stoutm_id']."' and stouts_crop='".$crval."' and stouts_variety='".$verval."' ";
					if($txtlotno!="")
					$sqlis1.=" and SUBSTRING(`stouts_lotno`,1,7)='".$txtlotno."' ";
					$sql_is1=mysqli_query($link,$sqlis1) or die(mysqli_error($link));
					while($row_is1=mysqli_fetch_array($sql_is1))
					{ 
						$xc=0; $lotno=''; $ups=''; $nqty=''; 
						$sqlis="select * from tbl_stouts where plantcode='".$plantcode."' and  stoutm_id='".$rowdispm['stoutm_id']."' and stouts_lotno='".$row_is1['stouts_lotno']."' and stouts_crop='".$crval."' and stouts_variety='".$verval."' ";
						/*if($txtupsdc!="ALL")
						$sqlis.=" and dpss_ups='".$txtupsdc."'  ";*/
						
						$sqlis.=" order by stoutm_id asc";
						$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
						while($row_is=mysqli_fetch_array($sql_is))
						{ 
							$qt=$row_is['stouts_qty']; 
							if($qt<0)$qt=0;
							$xc=$xc+$qt;
							
							$lotno=$row_is['stouts_lotno']; 
							$ups=$row_is['stouts_stage']; 
						}
					
						$tdate=$rowdispm['stoutm_date'];
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$trdate=$tday."-".$tmonth."-".$tyear;
						
						
						$disptype="Stock Transfer-(Plant)";
						$nqty=$xc;
						
						
						$dcno="DS".$rowdispm['stoutm_code']."/".$rowdispm['stoutm_yearid']."/".$rowdispm['stoutm_logid'];		
						
						
						$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['stoutm_plant']."' order by business_name")or die(mysqli_error($link));
						$noticia = mysqli_fetch_array($sql_month24);
						$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
						$noticia240 = mysqli_fetch_array($sql_month240);
						$state=$noticia['state'];
						
						
$cnt++;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}




			// Stock Transfer Out - Pack Seed table with party Type as All
			if($txtdisptype=="ALL" || $txtdisptype=="Stock Transfer-Plant")	
			{
			$sqdm="select * from tbl_stoutmpack where plantcode='".$plantcode."' and  stoutmp_date>='$sdt' and stoutmp_date<='$edt' and stoutmp_tflg=1  ";
			
			/*if($txtstate!="ALL")
			$sqdm.=" and disp_state='$txtstate' ";
			if($txtloc!="ALL")
			$sqdm.=" and disp_location='$txtloc' ";*/
			if($txtparty!="ALL")
			$sqdm.=" and stoutmp_plant='$txtparty' ";
			
			
			$sqdm.=" order by stoutmp_date asc";
			$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($rowdispm=mysqli_fetch_array($sql_istbl))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					$sqlis1="select distinct stoutsp_lotno from tbl_stoutspack where plantcode='".$plantcode."' and  stoutmp_id='".$rowdispm['stoutmp_id']."' and stoutsp_crop='".$crval."' and stoutsp_variety='".$verval."' ";
					if($txtlotno!="")
					$sqlis1.=" and SUBSTRING(`stoutsp_lotno`,1,7)='".$txtlotno."' ";
					$sql_is1=mysqli_query($link,$sqlis1) or die(mysqli_error($link));
					while($row_is1=mysqli_fetch_array($sql_is1))
					{ 
						$xc=0; $lotno=''; $ups=''; $nqty=0; 
						$sqlis="select * from tbl_stoutspack where plantcode='".$plantcode."' and  stoutmp_id='".$rowdispm['stoutmp_id']."' and stoutsp_lotno='".$row_is1['stoutsp_lotno']."' and stoutsp_crop='".$crval."' and stoutsp_variety='".$verval."' ";
						/*if($txtupsdc!="ALL")
						$sqlis.=" and dpss_ups='".$txtupsdc."'  ";*/
						
						$sqlis.=" order by stoutmp_id asc";
						$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
						while($row_is=mysqli_fetch_array($sql_is))
						{ 
							$qt=$row_is['stoutsp_loadqty']; 
							if($qt<0)$qt=0;
							$xc=$xc+$qt;
							
							$lotno=$row_is['stoutsp_lotno']; 
							$ups=$row_is['stoutsp_ups']; 
						}
					
						$tdate=$rowdispm['stoutmp_date'];
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$trdate=$tday."-".$tmonth."-".$tyear;
						
						
						$disptype="Stock Transfer Out-Pack";
						$nqty=$xc;
						
						
						$dcno="DS".$rowdispm['stoutmp_code']."/".$rowdispm['stoutmp_yearid']."/".$rowdispm['stoutmp_logid'];		
						
						
						$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm['stoutmp_plantid']."' order by business_name")or die(mysqli_error($link));
						$noticia = mysqli_fetch_array($sql_month24);
						$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
						$noticia240 = mysqli_fetch_array($sql_month240);
						$state=$noticia['state'];
						
						/*if($txtstate!="ALL" && $txtstate!=$noticia['state'])
						$nqty=0;
						else if($txtloc!="ALL" && $txtloc!=$noticia['location_id'])
						$nqty=0;*/

if($nqty>0)						
{
$cnt++;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia240['productionlocation'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
}



			// TDF Dispatch table with party Type as All
			if($txtdisptype=="ALL" || $txtdisptype=="TDF - Individual")	
			{
			$sqlis11="select * from tbl_dtdf_sub where plantcode='".$plantcode."' and  dtdfs_crop='".$crop1."' and dtdfs_variety='".$verty."' ";
					
			$sql_is11=mysqli_query($link,$sqlis11) or die(mysqli_error($link));
			$t23=mysqli_num_rows($sql_is11);
			while($row_is11=mysqli_fetch_array($sql_is11))
			{ 
			
			$sqdm2="select * from tbl_dtdf where plantcode='".$plantcode."' and  dtdf_id='".$row_is11['dtdf_id']."' and dtdf_date>='$sdt' and dtdf_date<='$edt' and dtdf_tflg=1  ";
			if($txtstate!="ALL")
			$sqdm2.=" and dtdf_state='$txtstate' ";
			if($txtloc!="ALL")
			$sqdm2.=" and dtdf_location='$txtloc' ";
			if($txtparty!="ALL")
			$sqdm2.=" and dtdf_party='$txtparty' ";
			
			
			$sqdm2.=" order by dtdf_partytype asc, dtdf_id asc";
			$sql_istbl2=mysqli_query($link,$sqdm2) or die(mysqli_error($link)); 
			
			$t2=mysqli_num_rows($sql_istbl2);
			if($t2 > 0)
			{
				while($rowdispm2=mysqli_fetch_array($sql_istbl2))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					
					
						$sqlis12="select distinct dbss_lotno from tbl_dtdfsub_sub where plantcode='".$plantcode."' and  dtdf_id='".$rowdispm2['dtdf_id']."' and dtdfs_id='".$row_is11['dtdfs_id']."'";
						if($txtlotno!="")
						$sqlis12.=" and SUBSTRING(`dbss_lotno`,1,7)='".$txtlotno."' ";
						
						$sql_is12=mysqli_query($link,$sqlis12) or die(mysqli_error($link));
						while($row_is12=mysqli_fetch_array($sql_is12))
						{ 
							$xc=0; $lotno=''; $ups=''; $nqty=''; 
							$sqlis2="select * from tbl_dtdfsub_sub where plantcode='".$plantcode."' and  dtdf_id='".$rowdispm2['dtdf_id']."' and dbss_lotno='".$row_is12['dbss_lotno']."' and dtdfs_id='".$row_is11['dtdfs_id']."' ";
							
							$sqlis2.=" order by dtdf_id asc";
							$sql_is2=mysqli_query($link,$sqlis2) or die(mysqli_error($link));
							while($row_is2=mysqli_fetch_array($sql_is2))
							{ 
								$qt=$row_is2['dbss_qty']; 
								if($qt<0)$qt=0;
								$xc=$xc+$qt;
								
								$lotno=$row_is2['dbss_lotno']; 
								$ups=$row_is11['dtdfs_ups']; 
							}
						
							$tdate=$rowdispm2['dtdf_date'];
							$tyear=substr($tdate,0,4);
							$tmonth=substr($tdate,5,2);
							$tday=substr($tdate,8,2);
							$trdate=$tday."-".$tmonth."-".$tyear;
							
							$state=$rowdispm2['dtdf_state'];
							$disptype=$rowdispm2['dtdf_partytype'];
							$nqty=$xc;
							
							$ptype=$rowdispm2['dtdf_partytype'];
							
							$ntyps="TDFSDN";
										
								
							$sql_code1="SELECT * FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trid='".$rowdispm2['dtdf_id']."' and dnote_trtype='Dispatch TDF Seed' and dnote_ptype='$ptype'";
							$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
							$row_code1=mysqli_fetch_array($res_code1);
							
							$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
							$row_param=mysqli_fetch_array($sql_param);
							
							$dcno=$row_param['code']."/".$row_code1['dnote_yearcode']."/"."TD"."/".$row_code1['dnote_code'];
							
							$bsname=""; $bslocation="";
							$sql_qc=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['dtdf_party']."' order by business_name");
							$tt=mysqli_num_rows($sql_qc);
							if($tt==0)
							{
								$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='".$plantcode."' and  order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_partyname='".$rowdispm2['dtdf_party']."' and orderm_holdflag=0 and orderm_dispatchflag!=1 and orderm_cancelflag!=1")or die("Error:".mysqli_error($link));
								$row_month=mysqli_fetch_array($sql_month);
								$bsname=$row_month['orderm_partyname'];
								$bslocation=$row_month['orderm_partycity'];
								$state=$row_month['orderm_partystate'];
							}
							else
							{
								
								$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$rowdispm2['dtdf_party']."' order by business_name")or die(mysqli_error($link));
								$noticia = mysqli_fetch_array($sql_month24);
								
								$sql_month240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
								$noticia240 = mysqli_fetch_array($sql_month240);
								$bsname=$noticia['business_name']; 
								$bslocation=$noticia240['productionlocation'];
								$state=$noticia240['state'];
							}
							$disptype="TDF - Individual";
							
$cnt++;
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bsname;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bslocation;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
}	


			// Dispatch table with party Type as All
			
			if($txtdisptype=="ALL" || $txtdisptype=="Discard")
			{	
			$sqdm="select * from tbl_discard where plantcode='".$plantcode."' and  tdate>='$sdt' and tdate<='$edt' and ddflg=1  ";
			if($txtstate!="ALL")
			$sqdm.=" and state='$txtstate' ";
			
			if($txtparty!="ALL")
			{
				$sqlmonth24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$txtparty."' order by business_name")or die(mysqli_error($link));
				$noticia24 = mysqli_fetch_array($sqlmonth24);
				$pname=$noticia24['business_name'];
				$sqdm.=" and party_name='$pname' ";
			}
			if($txtloc!="ALL")
			{
				$sqlmonth240=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$noticia['location_id']."' order by productionlocation")or die(mysqli_error($link));
				$noticia20 = mysqli_fetch_array($sqlmonth240);
				$ploc=$noticia20['productionlocation'];
				$sqdm.=" and city='$ploc' ";
			}	
			
			
			$sqdm.=" order by tdate asc";
			$sql_istbl=mysqli_query($link,$sqdm) or die(mysqli_error($link)); 
			
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($rowdispm=mysqli_fetch_array($sql_istbl))
				{
					$trdate=''; $state=''; $disptype=''; $dcno='';
					
					$sqlis1="select distinct lotnumber from tbl_discard_sub where plantcode='".$plantcode."' and  did_s='".$rowdispm['tid']."' and crop='".$crval."' and variety='".$verval."' ";
					if($txtlotno!="")
					{
						
						$sqlis1.=" and SUBSTRING(`lotnumber`,1,7)='".$txtlotno."' ";
					}
					$sql_is1=mysqli_query($link,$sqlis1) or die(mysqli_error($link));
					while($row_is1=mysqli_fetch_array($sql_is1))
					{ 
						$xc=0; $lotno=''; $ups=''; $nqty=''; 
						$sqlis="select * from tbl_discard_sub where plantcode='".$plantcode."' and  did_s='".$rowdispm['tid']."' and lotnumber='".$row_is1['lotnumber']."' and crop='".$crval."' and variety='".$verval."' ";
						if($txtupsdc!="ALL")
						$sqlis.=" and ups='".$txtupsdc."'  ";
						
						$sqlis.=" order by did_s asc";
						$sql_is=mysqli_query($link,$sqlis) or die(mysqli_error($link));
						while($row_is=mysqli_fetch_array($sql_is))
						{ 
							$qt=$row_is['qty']; 
							if($qt<0)$qt=0;
							$xc=$xc+$qt;
							
							$lotno=$row_is['lotnumber']; 
							$sql_dsloc=mysqli_query($link,"select * from tbl_discard_sloc where plantcode='".$plantcode."' and  discard_trid='".$rowdispm['tid']."' and discard_id='".$row_is['did']."' ") or die(mysqli_error($link));
							$row_dsloc=mysqli_fetch_array($sql_dsloc);
							$ups=$row_dsloc['sstage']; 
						}
					
						$tdate=$rowdispm['tdate'];
						$tyear=substr($tdate,0,4);
						$tmonth=substr($tdate,5,2);
						$tday=substr($tdate,8,2);
						$trdate=$tday."-".$tmonth."-".$tyear;
						
						$state=$rowdispm['state'];
						$disptype="Discard";
						$nqty=$xc;
						
						$ptype="Discard";
						
						
						$ntyps="MDN";
									
						
						$dcno="MD".$rowdispm['dd_code']."/".$rowdispm['yearcode']."/".$rowdispm['ncode'];		
$cnt++;						
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowdispm['party_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowdispm['city'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $state;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $disptype;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pvvername;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcno;?></td>
</tr>
<?php
$srno=$srno+1;
}
}
}
}
		
}
}
}
}
if($cnt==0)
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext" colspan="12">No Record Found</td>
</tr>
<?php
}
?>
</table>			
 
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_pdr.php?sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&txtstate=<?php echo $_REQUEST['txtstate']?>&txtloc=<?php echo $_REQUEST['txtloc']?>&txtparty=<?php echo $_REQUEST['txtparty']?>&txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&txtlotno=<?php echo $_REQUEST['txtlotno']?>&txtupsdc=<?php echo $txtupsdc;?>&txtdisptype=<?php echo $_REQUEST['txtdisptype']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>