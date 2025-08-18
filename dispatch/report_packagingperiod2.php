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
	$withreprint = $_REQUEST['withreprint'];
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	if($txtupsdc=="")$txtupsdc="ALL";
	if($withreprint=="")$withreprint="ALL";
		
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	$cp=""; $pcktype='ALL'; $ndt=""; $crp="ALL"; $ver="ALL"; $dt=date("Y-m-d");
	
	if($withreprint!="ALL")
	{
		if($withreprint=="LMC")$pcktype='PACKLMC';if($withreprint=="MMC")$pcktype='PACKMMC';if($withreprint=="NLC")$pcktype='PACKNLC';
	}
	
	$sql_crp=mysqli_query($link,"select * from tblcrop order by cropname ASC") or die(mysqli_error($link));
	while($row_crp=mysqli_fetch_array($sql_crp))
	{
		if($cp!="")
			$cp=$cp.",".$row_crp['cropid'];
		else
			$cp=$row_crp['cropid'];
	}
	
	if($withreprint=="ALL")
	$qry6="select Distinct mpmain_date from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_date>='$sdt' and mpmain_date<='$edt' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKMMC' or mpmain_trtype='PACKNLC') and mpmain_barcode!='' order by mpmain_date ASC ";
	else
	$qry6="select Distinct mpmain_date from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_date>='$sdt' and mpmain_date<='$edt' and mpmain_trtype='$pcktype' and mpmain_barcode!='' order by mpmain_date ASC ";
	$sqlcrp=mysqli_query($link,$qry6) or die(mysqli_error($link));
	while($rowcrp=mysqli_fetch_array($sqlcrp))
	{
		if($ndt!="")
			$ndt=$ndt.",".$rowcrp['mpmain_date'];
		else
			$ndt=$rowcrp['mpmain_date'];
	}
	$ndt1=explode(",",$ndt);
	$ndt1=array_unique($ndt1);
	sort($ndt1);
	$ndt=$ndt1;
	
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	} 
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
?>
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
<title>Dispatch - Report - Periodical Packaging Report</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_packagingperiod.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $sdate;?>&txtupsdc=<?php echo $txtupsdc;?>&edate=<?php echo $edate;?>&withreprint=<?php echo $withreprint;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Periodical Packaging Report (LMC/NLC/MMC)</td>
  </tr>
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $ver;?>&nbsp;&nbsp;|&nbsp;&nbsp;Size: <?php echo $txtupsdc;?>&nbsp;&nbsp;|&nbsp;&nbsp;Packaging Type: <?php echo $withreprint;?>&nbsp;&nbsp;|&nbsp;&nbsp;From Date: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;To Date: <?php echo $edate;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="29" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="69"  align="center" valign="middle" class="smalltblheading">Date</td>
	<td width="83"  align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="113"  align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="102"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="95"  align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="45"  align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="51"  align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="72"  align="center" valign="middle" class="smalltblheading">Barcode</td>
	<td width="69"  align="center" valign="middle" class="smalltblheading">Packaging Type</td>
</tr>
<?php
$srno=1; $totalbags=0;
foreach($ndt as $ndts)
{
if($ndts<>"")
{

if($withreprint=="ALL")
	$qry="select Distinct mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_date='$ndts' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKMMC' or mpmain_trtype='PACKNLC') and mpmain_barcode!='' order by mpmain_barcode ASC ";
	else
	$qry="select Distinct mpmain_barcode from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_date='$ndts' and mpmain_trtype='$pcktype' and mpmain_barcode!='' order by mpmain_barcode ASC ";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	if($withreprint=="ALL")
	$sql_rr=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$row_arr_home1['mpmain_barcode']."' and mpmain_date='$ndts' and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKMMC' or mpmain_trtype='PACKNLC') order by mpmain_barcode ASC") or die(mysqli_error($link));
	else
	$sql_rr=mysqli_query($link,"select * from tbl_mpmain where plantcode='".$plantcode."' and  mpmain_barcode='".$row_arr_home1['mpmain_barcode']."' and mpmain_date='$ndts' and mpmain_trtype='$pcktype' order by mpmain_barcode ASC") or die(mysqli_error($link));

$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{
	$crparr=explode(",", $row_rr['mpmain_crop']);
	$verarr=explode(",", $row_rr['mpmain_variety']);
	$lotarr=explode(",", $row_rr['mpmain_lotno']);
	$upsarr=explode(",", $row_rr['mpmain_upssize']);
	$noparr=explode(",", $row_rr['mpmain_lotnop']);
	
	$tdt2=explode("-", $row_rr['mpmain_date']);
	$trdate=$tdt2[2]."-".$tdt2[1]."-".$tdt2[0];	
	$barcode=$row_rr['mpmain_barcode'];	
	$ptype1=$row_rr['mpmain_trtype'];	
	
	if($ptype1=="PACKLMC")$ptype='LMC';if($ptype1=="PACKMMC")$ptype='MMC';if($ptype1=="PACKNLC")$ptype='NLC';
	
	$ct=0; $varietynm=""; $cropnm=""; $lotno=""; $nop=""; $qty=""; $upssize="";
	for ($i=0; $i<count($lotarr); $i++)
	{
		$variety6=""; $crop6=""; 
		if($ptype=="MMC")
		{
			$crop6=$crparr[$i];
			$variety6=$verarr[$i];
			$ups=$upsarr[$i];
		}
		else
		{
			$crop6=$crparr[0];
			$variety6=$verarr[0];
			$ups=$upsarr[0];
		}
		//echo $lotarr[$i];
		if($lotarr[$i]!="")
		{
			if($crop!="ALL"){if($crop!=$crop6)$ct++; } 
			if($variety!="ALL"){if($variety!=$variety6)$ct++; }
			if($txtupsdc!="ALL"){if($ups!=$txtupsdc)$ct++; }
			//echo $ptype."  -  ".$ct."<br/>";
			$nopm=$noparr[$i];
			
			$up=explode(" ", $ups);
			if($up[1]=="Gms")
			{
				$ptp=$up[0]/1000;
			}
			else
			{
				$ptp=$up[0];
			}
			//echo $ptp."  =  ";
			if($up[1]=="Gms")
			$ptp6=$ptp*$noparr[$i];
			else
			$ptp6=$noparr[$i]*$ptp;
			
			$qtym=$ptp6; $nompm=$nompm+$ct; 
			$lotn=$lotarr[$i];
	
			$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop6."'") or die(mysqli_error($link));
			$row31=mysqli_fetch_array($sql_crop);
			$cropname=$row31['cropname'];		
			$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety6."' ") or die(mysqli_error($link));
			$ttt=mysqli_num_rows($sql_variety);
			if($ttt > 0)
			{
				$rowvv=mysqli_fetch_array($sql_variety);
				$varietyname=$rowvv['popularname'];
			}
			else
			{
				$varietyname=$row_rr['lotldg_variety'];
			}
		
			 if($varietynm!="") 
			 {
				 $varietynm=$varietynm."<br/>".$varietyname;
			 }
			 else
			 {
				 $varietynm=$varietyname;
			 }
			 if($cropnm!="")
			 {
				 $cropnm=$cropnm."<br/>".$cropname;
			 }
			 else
			 {
				 $cropnm=$cropname;
			 }
			 if($lotno!="")
			 {
				 $lotno=$lotno."<br/>".$lotn;
			 }
			 else
			 {
				 $lotno=$lotn;
			 }
			 if($nop!="")
			 {
				 $nop=$nop."<br/>".$nopm;
			 }
			 else
			 {
				 $nop=$nopm;
			 }
			 if($qty!="")
			 {
				 $qty=$qty."<br/>".$qtym;
			 }
			 else
			 {
				 $qty=$qtym;
			 }
			 if($upssize!="")
			 {
				 $upssize=$upssize."<br/>".$ups;
			 }
			 else
			 {
				 $upssize=$ups;
			 }
		}
	}		

if($qtym>0 && $ct==0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropnm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietynm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upssize;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ptype;?></td>
</tr>
<?php
  $srno++;
}
}
}
}
}
//}
//}
?>
</table>			
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="924" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<a href="excel_packagingperiod.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&sdate=<?php echo $sdate;?>&txtupsdc=<?php echo $txtupsdc;?>&edate=<?php echo $edate;?>&withreprint=<?php echo $withreprint;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>