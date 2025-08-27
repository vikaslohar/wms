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
		if($crop=="")$crop="ALL";
		if($variety=="")$variety="ALL";
		if($txtupsdc=="")$txtupsdc="ALL";
		
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
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
		$sqlrr=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='".$plantcode."' and packtype='".$txtupsdc."' and lotldg_crop IN ($cp) and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' order by packtype asc") or die(mysqli_error($link));
	}
	else
	{
		$sqlrr=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and lotldg_crop IN ($cp) and trtype='PNPSLIP' order by packtype Asc") or die(mysqli_error($link));
	}
	$totrr=mysqli_num_rows($sqlrr);
	while($rowrr=mysqli_fetch_array($sqlrr))
	{
		$up=$rowrr['packtype'];
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
			if($uid!="")
			$uid=$uid.",".$row12['uid'];
			else
			$uid=$row12['uid'];
		}
	}
	
	$upsiz2="";
	if($uid!="")
	{
		$sql_sel="select * from tblups where uid IN ($uid) order by uom Asc";
		$res=mysqli_query($link, $sql_sel) or die (mysqli_error($link));
		while($row12=mysqli_fetch_array($res))
		{
			$ups=$row12['ups']." ".$row12['wt'];
			if($upsiz2!="")
				$upsiz2=$upsiz2.",".$ups;
			else
				$upsiz2=$ups;
		}
	}
	//echo $upsiz2;
	
	$crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' and balqty > 0 ";

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
//echo $qry;
//exit;
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<title>Dispatch - Report - Periodical Packed Seed Activity Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_ppsar.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $sdate;?>&txtupsdc=<?php echo $txtupsdc;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
if($tot_arr_home > 0)
{
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Periodical Packed Seed Activity Report</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $variety;?>&nbsp;&nbsp;|&nbsp;&nbsp;UPS: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="26" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="126"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="90"  align="center" valign="middle" class="smalltblheading">Variety</td>
	<?php
	
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
	?>
	<td width="55"  align="center" valign="middle" class="smalltblheading"><?php echo $ups23;?></td>
	<?php
	}
	}
	?>
	<td width="70"  align="center" valign="middle" class="smalltblheading">Total Qty</td>
</tr>

<?php
$srno=1; $totalbags=0;

while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
if($txtupsdc!="ALL")
{
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and packtype='".$txtupsdc."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' order by lotdgp_id desc") or die(mysqli_error($link));
}
else
{
	$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_arr_home1['lotldg_variety']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' order by lotdgp_id desc") or die(mysqli_error($link));
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

	$upsval=""; $i=0; $totalqty=0;
	$upp2=explode(",",$upsiz2);
	foreach($upp2 as $ups2)
	{
		if($ups2<>"")
		{	
			$totqty=0; 
			$sql_rr2=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$ups2."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' and lotldg_qc!='Fail' and lotldg_got!='Fail' order by packtype asc") or die(mysqli_error($link));
			$tot_rr2=mysqli_num_rows($sql_rr2);
			//$row_rr2=mysqli_fetch_array($sql_rr2);
			while($row_rr2=mysqli_fetch_array($sql_rr2))
			{
				$totqty=0; $totnob=0; $cnt=0;
				$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotldg_crop='".$row_arr_home1['lotldg_crop']."' and lotldg_variety='".$row_rr['lotldg_variety']."' and packtype='".$row_rr2['packtype']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' and lotldg_qc!='Fail' and lotldg_got!='Fail' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_arr_home=mysqli_fetch_array($sql_arr_home))
				{
				
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and packtype='".$row_rr2['packtype']."'and lotno='".$row_arr_home['lotno']."' and lotldg_trdate>='$sdt' and lotldg_trdate<='$edt' and trtype='PNPSLIP' and balqty > 0 and lotldg_qc!='Fail' and lotldg_got!='Fail' order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							//echo $row_arr_home['lotno']."  =  ".$row_issuetbl['lotdgp_id']."<BR>";
							$cnt++;
							$totqty=$totqty+$row_issuetbl['balqty']; 
							$totnob=$totnob+$row_issuetbl['balnomp']; 
							if($totnob<0) $totnob=0;
							if($totqty<0) $totqty=0;
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
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<?php
	$upp24=explode(",",$upsval);
	for($j=0; $j<$i; $j++)
	{
	$upsv24=$upp24[$j];
	$totalqty=$totalqty+$upsv24; 
	?>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upp24[$j];?></td>
	<?php
	}
	?>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totalqty;?></td>
</tr>
<?php
 $srno++;
}
}
}
//}
//}
//}
?>
</table>			
<?php
}
?>
 
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_ppsar.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $sdate;?>&txtupsdc=<?php echo $txtupsdc;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
